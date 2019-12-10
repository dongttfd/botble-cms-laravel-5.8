<?php

namespace Botble\ACL\Http\Controllers;

use Artisan;
use Assets;
use Auth;
use Botble\ACL\Forms\PasswordForm;
use Botble\ACL\Forms\ProfileForm;
use Botble\ACL\Forms\UserForm;
use Botble\ACL\Tables\UserTable;
use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Http\Requests\UpdatePasswordRequest;
use Botble\ACL\Http\Requests\UpdateProfileRequest;
use Botble\ACL\Models\UserMeta;
use Botble\ACL\Repositories\Interfaces\RoleInterface;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\ACL\Services\ChangePasswordService;
use Botble\ACL\Services\CreateUserService;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Media\Services\ThumbnailService;
use Botble\Media\Services\UploadsManager;
use Botble\ACL\Http\Requests\AvatarRequest;
use Exception;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class UserController extends BaseController
{

    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * @var RoleInterface
     */
    protected $roleRepository;

    /**
     * @var MediaFileInterface
     */
    protected $fileRepository;

    /**
     * UserController constructor.
     * @param UserInterface $userRepository
     * @param RoleInterface $roleRepository
     * @param MediaFileInterface $fileRepository
     */
    public function __construct(
        UserInterface $userRepository,
        RoleInterface $roleRepository,
        MediaFileInterface $fileRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display all users
     * @param UserTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(UserTable $dataTable)
    {
        page_title()->setTitle(trans('core/acl::users.users'));

        Assets::addScripts(['bootstrap-editable'])
            ->addStyles(['bootstrap-editable'])
            ->addScriptsDirectly('vendor/core/js/user.js');

        return $dataTable->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(__('Create new user'));

        return $formBuilder->create(UserForm::class)->renderForm();
    }

    /**
     * @param CreateUserRequest $request
     * @param CreateUserService $service
     * @return BaseHttpResponse
     */
    public function postCreate(CreateUserRequest $request, CreateUserService $service, BaseHttpResponse $response)
    {
        $user = $service->execute($request);

        event(new CreatedContentEvent(USER_MODULE_SCREEN_NAME, $request, $user));

        return $response
            ->setPreviousUrl(route('users.list'))
            ->setNextUrl(route('user.profile.view', $user->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete($id, Request $request, BaseHttpResponse $response)
    {
        if ($request->user()->getKey() == $id) {
            return $response
                ->setError()
                ->setMessage(trans('core/acl::users.delete_user_logged_in'));
        }

        try {
            $user = $this->userRepository->findById($id);
            $this->userRepository->delete($user);
            event(new DeletedContentEvent(USER_MODULE_SCREEN_NAME, $request, $user));

            return $response->setMessage(trans('core/acl::users.deleted'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/acl::users.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postDeleteMany(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            if ($request->user()->getKey() == $id) {
                return $response
                    ->setError()
                    ->setMessage(trans('core/acl::users.delete_user_logged_in'));
            }
            try {
                $user = $this->userRepository->findOrFail($id);
                $this->userRepository->delete($user);
                event(new DeletedContentEvent(USER_MODULE_SCREEN_NAME, $request, $user));
            } catch (Exception $ex) {
                return $response
                    ->setError()
                    ->setMessage(trans('core/acl::users.cannot_delete'));
            }
        }

        return $response->setMessage(trans('core/acl::users.deleted'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View| \Illuminate\Http\RedirectResponse
     */
    public function getUserProfile($id, Request $request, FormBuilder $formBuilder)
    {

        Assets::addScripts(['bootstrap-pwstrength', 'cropper'])
            ->addScriptsDirectly('vendor/core/js/profile.js');

        $user = $this->userRepository->findOrFail($id);

        page_title()->setTitle(__('User profile ":name"', ['name' => $user->getFullName()]));

        $form = $formBuilder
            ->create(ProfileForm::class, ['model' => $user])
            ->setUrl(route('users.update-profile', $user->id));
        $password_form = $formBuilder
            ->create(PasswordForm::class)
            ->setUrl(route('users.change-password', $user->id));

        $can_change_profile = $request->user()->getKey() == $id || $request->user()->isSuperUser();

        if (!$can_change_profile) {
            $form->disableFields();
            $form->removeActionButtons();
            $password_form->disableFields();
            $password_form->removeActionButtons();
        }

        if ($request->user()->isSuperUser()) {
            $password_form->remove('old_password');
        }
        $form = $form->renderForm();
        $password_form = $password_form->renderForm();

        return view('core/acl::users.profile.base', compact('user', 'form', 'password_form', 'can_change_profile'));
    }

    /**
     * @param int $id
     * @param UpdateProfileRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postUpdateProfile($id, UpdateProfileRequest $request, BaseHttpResponse $response)
    {
        $user = $this->userRepository->findById($id);

        $currentUser = $request->user();
        if (($currentUser->hasPermission('users.update-profile') && $currentUser->getKey() === $user->id) ||
            $currentUser->isSuperUser()
        ) {
            if ($user->email !== $request->input('email')) {
                $users = $this->userRepository->getModel()
                    ->where('email', $request->input('email'))
                    ->where('id', '<>', $user->id)
                    ->count();
                if ($users) {
                    return $response
                        ->setError()
                        ->setMessage(trans('core/acl::users.email_exist'))
                        ->withInput();
                }
            }

            if ($user->username !== $request->input('username')) {
                $users = $this->userRepository->getModel()
                    ->where('username', $request->input('username'))
                    ->where('id', '<>', $user->id)
                    ->count();
                if ($users) {
                    return $response
                        ->setError()
                        ->setMessage(trans('core/acl::users.username_exist'))
                        ->withInput();
                }
            }
        }

        $user->fill($request->input());
        $user->completed_profile = 1;
        $this->userRepository->createOrUpdate($user);
        do_action(USER_ACTION_AFTER_UPDATE_PROFILE, USER_MODULE_SCREEN_NAME, $request, $user);

        return $response->setMessage(trans('core/acl::users.update_profile_success'));
    }

    /**
     * @param int $id
     * @param UpdatePasswordRequest $request
     * @param ChangePasswordService $service
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postChangePassword(
        $id,
        UpdatePasswordRequest $request,
        ChangePasswordService $service,
        BaseHttpResponse $response
    )
    {
        $request->merge(['id' => $id]);
        $result = $service->execute($request);

        if ($result instanceof Exception) {
            return $response
                ->setError()
                ->setMessage($result->getMessage());
        }

        return $response->setMessage(trans('core/acl::users.password_update_success'));
    }

    /**
     * @param AvatarRequest $request
     * @param UploadsManager $uploadManager
     * @param ImageManager $imageManager
     * @param ThumbnailService $thumbnailService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postAvatar(
        AvatarRequest $request,
        UploadsManager $uploadManager,
        ImageManager $imageManager,
        ThumbnailService $thumbnailService,
        BaseHttpResponse $response
    )
    {
        try {
            $fileUpload = $request->file('avatar_file');

            $file_ext = $fileUpload->getClientOriginalExtension();

            $folder_path = '/users';

            $fileName = $this->fileRepository->createName(File::name($fileUpload->getClientOriginalName()), 0);

            $fileName = $this->fileRepository->createSlug($fileName, $file_ext, $uploadManager->uploadPath($folder_path));

            $user = $this->userRepository->findById($request->user()->getKey());

            $image = $imageManager->make($request->file('avatar_file')->getRealPath());
            $avatarData = json_decode($request->input('avatar_data'));
            $image->crop((int)$avatarData->height, (int)$avatarData->width, (int) $avatarData->x, (int) $avatarData->y);
            $path = $folder_path . '/' . $fileName;

            $uploadManager->saveFile($path, $image->stream()->__toString());

            $readable_size = explode('x', config('media.sizes.thumb'));

            $thumbnailService
                ->setImage($fileUpload->getRealPath())
                ->setSize($readable_size[0], $readable_size[1])
                ->setDestinationPath($folder_path)
                ->setFileName(File::name($fileName) . '-' . config('media.sizes.thumb') . '.' . $file_ext)
                ->save();

            $data = $uploadManager->fileDetails($path);

            $file = $this->fileRepository->getModel();
            $file->name = $fileName;
            $file->url = $data['url'];
            $file->size = $data['size'];
            $file->mime_type = $data['mime_type'];
            $file->folder_id = 0;
            $file->user_id = 0;
            $file->options = [];
            $file = $this->fileRepository->createOrUpdate($file);

            $this->fileRepository->forceDelete(['id' => $user->avatar_id]);

            $user->avatar_id = $file->id;

            $this->userRepository->createOrUpdate($user);

            return $response
                ->setMessage(trans('core/acl::users.update_avatar_success'))
                ->setData(['url' => url($data['url'])]);
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param string $lang
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function getLanguage($lang, Request $request)
    {
        if ($lang != false && array_key_exists($lang, Assets::getAdminLocales())) {
            if (Auth::check()) {
                UserMeta::setMeta('admin-locale', $lang);
                cache()->forget(md5('cache-dashboard-menu-' . $request->user()->getKey()));
            }
            session()->put('admin-locale', $lang);
        }

        return redirect()->back();
    }

    /**
     * @param string $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getTheme($theme)
    {
        if (Auth::check()) {
            UserMeta::setMeta('admin-theme', $theme);
        }

        session()->put('admin-theme', $theme);

        try {
            return redirect()->back();
        } catch (Exception $exception) {
            return redirect()->route('access.login');
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getImpersonate($id, Request $request)
    {
        $user = $this->userRepository->findOrFail($id);
        $request->user()->impersonate($user);

        Artisan::call('cache:clear');

        return redirect()->route('dashboard.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leaveImpersonation(Request $request)
    {
        $request->user()->leaveImpersonation();
        return redirect()->route('dashboard.index');
    }

    /**
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function makeSuper($id, BaseHttpResponse $response)
    {
        try {
            $user = $this->userRepository->findOrFail($id);

            $user->updatePermission('superuser', true);
            $user->updatePermission('manage_supers', true);
            $user->super_user = 1;
            $user->manage_supers = 1;
            $this->userRepository->createOrUpdate($user);

            return $response
                ->setNextUrl(route('users.list'))
                ->setMessage(trans('core/base::system.supper_granted'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setNextUrl(route('users.list'))
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function removeSuper($id, Request $request, BaseHttpResponse $response)
    {
        if ($request->user()->getKey() == $id) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::system.cannot_revoke_yourself'));
        }

        $user = $this->userRepository->findOrFail($id);

        $user->updatePermission('superuser', false);
        $user->updatePermission('manage_supers', false);
        $user->super_user = 0;
        $user->manage_supers = 0;
        $this->userRepository->createOrUpdate($user);

        return $response
            ->setNextUrl(route('users.list'))
            ->setMessage(trans('core/base::system.supper_revoked'));
    }
}

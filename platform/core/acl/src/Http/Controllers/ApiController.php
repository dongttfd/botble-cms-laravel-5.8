<?php

namespace Botble\ACL\Http\Controllers;

use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\ACL\Http\Requests\ApiLoginRequest;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Passport\Token;
use RvMedia;
use Validator;

class ApiController extends BaseController
{
    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * AuthenticationController constructor.
     *
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login to system
     *
     * @bodyParam email email required The email of the user.
     * @bodyParam password string required The password of user to create.
     *
     * @group ACL
     *
     * @param ApiLoginRequest $request
     * @param BaseHttpResponse $response
     *
     * @return BaseHttpResponse
     */
    public function login(ApiLoginRequest $request, BaseHttpResponse $response)
    {
        $user = $this->userRepository->getFirstBy(['username' => $request->input('username')]);

        if ($user && Hash::check($request->input('password'), $user->password)) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;

            return $response
                ->setData(['token' => $token]);
        }

        return $response
            ->setError()
            ->setCode(422)
            ->setMessage(__('Username or password is not correct!'));
    }

    /**
     * Logout of the system
     *
     * @group ACL
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function logout(Request $request, BaseHttpResponse $response)
    {
        /**
         * @var Token $token
         */
        $token = $request->user()->token();
        $token->revoke();

        return $response
            ->setMessage(__('You have been successfully logged out!'));
    }

    /**
     * Update profile
     *
     * @bodyParam first_name string required First name.
     * @bodyParam last_name string required Last name.
     * @bodyParam email string Email.
     * @bodyParam avatar file Avatar file.
     *
     * @group ACL
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function updateProfile(Request $request, BaseHttpResponse $response)
    {
        $userId = auth()->id();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:120|min:2',
            'last_name'  => 'required|max:120|min:2',
            'email'      => 'nullable|max:60|min:6|email|unique:users,email,' . $userId,
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return $response
                ->setError()
                ->setCode(422)
                ->setMessage(__('Data invalid!') . ' ' . implode(' ', $validator->errors()->all()) . '.');
        }

        try {
            $dataInput = $request->only(['first_name', 'last_name', 'email']);

            if ($request->hasFile('avatar')) {
                $file = RvMedia::handleUpload($request->file('avatar'), 0, 'users');
                if (Arr::get($file, 'error') !== true) {
                    $dataInput['avatar'] = $file['data']->url;
                }
            }

            $user = $this->userRepository->createOrUpdate($dataInput, ['id' => $userId]);

            return $response
                ->setData([
                    'id'         => $user->id,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'avatar'     => $user->avatar,
                ])
                ->setMessage(__('Update profile successfully!'));

        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * Update password
     *
     * @bodyParam old_password string required The current password of the user.
     * @bodyParam password string required The new password of user.
     * @bodyParam password_confirmation string required The password confirmation.
     *
     * @group ACL
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function updatePassword(Request $request, BaseHttpResponse $response)
    {
        $validator = Validator::make($request->input(), [
            'old_password'          => 'required|min:6|max:60',
            'password'              => 'required|min:6|max:60',
            'password_confirmation' => 'same:password',
        ]);

        if ($validator->fails()) {
            return $response
                ->setError()
                ->setCode(422)
                ->setMessage(__('Data invalid!') . ' ' . implode(' ', $validator->errors()->all()) . '.');
        }

        $currentUser = $request->user();

        if (!Hash::check($request->input('old_password'), $currentUser->getAuthPassword())) {
            return $response
                ->setError()
                ->setMessage(trans('core/acl::users.current_password_not_valid'));
        }

        $this->userRepository->update(['id' => $currentUser->getKey()], [
            'password' => bcrypt($request->input('password')),
        ]);

        return $response->setMessage(trans('core/acl::users.password_update_success'));
    }
}

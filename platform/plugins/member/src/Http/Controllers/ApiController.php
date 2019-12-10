<?php

namespace Botble\Member\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Member\Http\Requests\LoginRequest;
use Botble\Member\Repositories\Interfaces\MemberInterface;
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
     * @var MemberInterface
     */
    protected $memberRepository;

    /**
     * AuthenticationController constructor.
     *
     * @param MemberInterface $memberRepository
     */
    public function __construct(MemberInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * Register new account
     *
     * @bodyParam first_name string required The first_name of user.
     * @bodyParam last_name string required The last_name of user.
     * @bodyParam email string required The email of the user.
     * @bodyParam password string  required The password of user to create.
     * @bodyParam password_confirmation string required The password confirmation.
     *
     * @group Member
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:120',
            'last_name'  => 'required|string|max:120',
            'email'      => 'required|string|email|max:255|unique:members',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $member = $this->memberRepository->create($request->toArray());

        $token = $member->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];

        return response($response, 200);

    }

    /**
     * Login to system
     *
     * @bodyParam email string required The email of the user.
     * @bodyParam password string required The password of user to create.
     *
     * @group Member
     *
     * @param LoginRequest $request
     * @param BaseHttpResponse $response
     *
     * @return BaseHttpResponse
     */
    public function login(LoginRequest $request, BaseHttpResponse $response)
    {
        $member = $this->memberRepository->getFirstBy(['email' => $request->input('email')]);

        if ($member) {
            if (Hash::check($request->input('password'), $member->password)) {
                $token = $member->createToken('Laravel Password Grant Client')->accessToken;

                return $response
                    ->setData(['token' => $token]);
            }
        }

        return $response
            ->setError()
            ->setCode(422)
            ->setMessage(__('Username or password is not correct!'));
    }

    /**
     * Logout of the system
     *
     * @group Member
     * @authenticated
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
     * @group Member
     * @authenticated
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
            'email'      => 'nullable|max:60|min:6|email|unique:members,email,' . $userId,
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
                $file = RvMedia::handleUpload($request->file('avatar'), 0, 'members');
                if (Arr::get($file, 'error') !== true) {
                    $dataInput['avatar'] = $file['data']->url;
                }
            }

            $user = $this->memberRepository->createOrUpdate($dataInput, ['id' => $userId]);

            return $response
                ->setData([
                    'id'         => $user->id,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'avatar'     => $user->avatar_url,
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
     * @bodyParam old_password string required The current password of the member.
     * @bodyParam password string required The new password of member.
     * @bodyParam password_confirmation string required The password confirmation.
     *
     * @group Member
     * @authenticated
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function updatePassword(Request $request, BaseHttpResponse $response)
    {
        $validator = Validator::make($request->all(), [
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

        $currentUser = auth()->user();

        if (!Hash::check($request->input('old_password'), $currentUser->getAuthPassword())) {
            return $response
                ->setError()
                ->setMessage(trans('core/acl::users.current_password_not_valid'));
        }

        $this->memberRepository->update(['id' => $currentUser->getKey()], [
            'password' => bcrypt($request->input('password')),
        ]);

        return $response->setMessage(trans('core/acl::users.password_update_success'));
    }
}

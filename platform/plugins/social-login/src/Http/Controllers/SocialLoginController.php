<?php

namespace Botble\SocialLogin\Http\Controllers;

use AclManager;
use Assets;
use Auth;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Setting\Supports\SettingStore;
use Botble\SocialLogin\Http\Requests\SocialLoginRequest;
use Exception;
use Socialite;

class SocialLoginController extends BaseController
{

    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Redirect the user to the {provider} authentication page.
     *
     * @param $provider
     * @return mixed
     *
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from {provider}.
     * @param $provider
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function handleProviderCallback($provider, BaseHttpResponse $response)
    {
        try {
            /**
             * @var \Laravel\Socialite\AbstractUser $oAuth
             */
            $oAuth = Socialite::driver($provider)->user();
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setNextUrl(route('access.login'))
                ->setMessage($ex->getMessage());
        }

        $user = $this->userRepository->getFirstBy(['email' => $oAuth->getEmail()]);

        if ($user) {
            if (!AclManager::getActivationRepository()->completed($user)) {
                return $response
                    ->setError()
                    ->setMessage(trans('core/acl::auth.login.not_active'));
            }

            Auth::login($user, true);
            return $response
                ->setNextUrl(route('dashboard.index'))
                ->setMessage(trans('core/acl::auth.login.success'));
        }
        return $response
            ->setError()
            ->setNextUrl(route('access.login'))
            ->setMessage(trans('core/acl::auth.login.dont_have_account'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getSettings()
    {
        page_title()->setTitle(trans('plugins/social-login::social-login.settings.title'));

        Assets::addScriptsDirectly('vendor/core/plugins/social-login/js/social-login.js');

        return view('plugins/social-login::settings');
    }

    /**
     * @param SocialLoginRequest $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     *
     */
    public function postSettings(SocialLoginRequest $request, BaseHttpResponse $response, SettingStore $setting)
    {
        foreach ($request->except(['_token']) as $setting_key => $setting_value) {
            $setting->set($setting_key, $setting_value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('social-login.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}

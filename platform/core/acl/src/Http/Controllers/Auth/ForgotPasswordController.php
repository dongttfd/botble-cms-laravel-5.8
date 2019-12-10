<?php

namespace Botble\ACL\Http\Controllers\Auth;

use Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @var BaseHttpResponse
     */
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @param BaseHttpResponse $response
     */
    public function __construct(BaseHttpResponse $response)
    {
        $this->middleware('guest');
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        page_title()->setTitle(trans('core/acl::auth.reset.title'));

        Assets::addScripts(['jquery-validation'])
            ->addScriptsDirectly('vendor/core/js/login.js')
            ->removeStyles([
                'select2',
                'fancybox',
                'spectrum',
                'simple-line-icons',
                'custom-scrollbar',
                'datepicker',
            ])
            ->removeScripts([
                'select2',
                'fancybox',
                'cookie',
            ]);

        return view('core/acl::auth.forgot-password');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param  string $response
     * @return BaseHttpResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->response->setMessage(trans($response));
    }
}

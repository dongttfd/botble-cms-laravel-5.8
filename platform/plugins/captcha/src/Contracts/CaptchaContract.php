<?php

namespace Botble\Captcha\Contracts;

use Botble\Captcha\Contracts\Utilities\AttributesContract;
use Botble\Captcha\Contracts\Utilities\RequestContract;

interface CaptchaContract
{
    /**
     * Set HTTP Request Client.
     *
     * @param  RequestContract $request
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setRequestClient(RequestContract $request);

    /**
     * Set noCaptcha Attributes.
     *
     * @param  AttributesContract $attributes
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setAttributes(AttributesContract $attributes);

    /**
     * Display Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function display($name, array $attributes = []);

    /**
     * Display image Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function image($name, array $attributes = []);

    /**
     * Display audio Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function audio($name, array $attributes = []);

    /**
     * Verify Response.
     *
     * @param  string $response
     * @param  string $clientIp
     *
     * @return bool
     * @author ARCANEDEV
     */
    public function verify($response, $clientIp = null);

    /**
     * Get script tag.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function script();

    /**
     * Get script tag with a callback function.
     *
     * @param  array $captcha
     * @param  string $callbackName
     *
     * @return string
     * @author ARCANEDEV
     */
    public function scriptWithCallback(array $captcha, $callbackName = 'captchaRenderCallback');
}

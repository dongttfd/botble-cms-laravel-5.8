<?php

namespace Botble\Captcha;

use Botble\Captcha\Contracts\CaptchaContract;
use Botble\Captcha\Contracts\Utilities\AttributesContract;
use Botble\Captcha\Contracts\Utilities\RequestContract;
use Botble\Captcha\Exceptions\ApiException;
use Botble\Captcha\Utilities\Attributes;
use Botble\Captcha\Utilities\Request;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class Captcha implements CaptchaContract
{
    const CLIENT_URL = 'https://www.google.com/recaptcha/api.js';
    const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';
    const CAPTCHA_NAME = 'g-recaptcha-response';

    /**
     * The shared key between your site and ReCAPTCHA
     *
     * @var string
     */
    protected $secret;

    /**
     * Your site key
     *
     * @var string
     */
    protected $siteKey;

    /**
     * Forces the widget to render in a specific language.
     * Auto-detects the user's language if unspecified.
     *
     * @var string
     */
    protected $lang;

    /**
     * Decides if we've already loaded the script file or not.
     *
     * @var bool
     */
    protected $scriptLoaded = false;

    /**
     * HTTP Request Client
     *
     * @var \Botble\Captcha\Contracts\Utilities\RequestContract
     */
    protected $request;

    /**
     * Captcha Attributes
     *
     * @var \Botble\Captcha\Contracts\Utilities\AttributesContract
     */
    protected $attributes;

    /**
     * Captcha constructor.
     *
     * @param  string $secret
     * @param  string $siteKey
     * @param  string|null $lang
     * @param  array $attributes
     * @author ARCANEDEV
     * @throws ApiException
     */
    public function __construct($secret, $siteKey, $lang = null, array $attributes = [])
    {
        $this->setSecret($secret);
        $this->setSiteKey($siteKey);
        $this->setLang($lang);

        $this->setRequestClient(new Request);
        $this->setAttributes(new Attributes($attributes));
    }

    /**
     * Set the secret key.
     *
     * @param  string $secret
     *
     * @return self
     * @author ARCANEDEV
     * @throws ApiException
     */
    protected function setSecret($secret)
    {
        $this->checkKey('secret key', $secret);

        $this->secret = $secret;

        return $this;
    }

    /**
     * Set Site key.
     *
     * @param  string $siteKey
     *
     * @return self
     * @author ARCANEDEV
     * @throws ApiException
     */
    protected function setSiteKey($siteKey)
    {
        $this->checkKey('site key', $siteKey);

        $this->siteKey = $siteKey;

        return $this;
    }

    /**
     * Set language code.
     *
     * @param  string $lang
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get script source link.
     *
     * @param  string|null $callbackName
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function getScriptSrc($callbackName = null)
    {
        $queries = [];

        if ($this->hasLang()) {
            Arr::set($queries, 'hl', $this->lang);
        }

        if ($this->hasCallbackName($callbackName)) {
            Arr::set($queries, 'onload', $callbackName);
            Arr::set($queries, 'render', 'explicit');
        }

        return static::CLIENT_URL . (count($queries) ? '?' . http_build_query($queries) : '');
    }

    /**
     * Set HTTP Request Client.
     *
     * @param  RequestContract $request
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setRequestClient(RequestContract $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set Captcha Attributes.
     *
     * @param  AttributesContract $attributes
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setAttributes(AttributesContract $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Display Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function display($name = null, array $attributes = [])
    {
        $output = $this->attributes->build($this->siteKey, array_merge(
            $this->attributes->prepareNameAttribute($name),
            $attributes
        ));

        return '<div ' . $output . '></div>';
    }

    /**
     * Display image Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function image($name = null, array $attributes = [])
    {
        return $this->display(
            $name,
            array_merge($attributes, $this->attributes->getImageAttribute())
        );
    }

    /**
     * Display audio Captcha.
     *
     * @param  string|null $name
     * @param  array $attributes
     *
     * @return string
     * @author ARCANEDEV
     */
    public function audio($name = null, array $attributes = [])
    {
        return $this->display(
            $name,
            array_merge($attributes, $this->attributes->getAudioAttribute())
        );
    }

    /**
     * Verify Response.
     *
     * @param  string $response
     * @param  string $clientIp
     *
     * @return bool
     * @author ARCANEDEV
     */
    public function verify($response, $clientIp = null)
    {
        if (empty($response)) {
            return false;
        }

        $response = $this->sendVerifyRequest([
            'secret'   => $this->secret,
            'response' => $response,
            'remoteip' => $clientIp,
        ]);

        return isset($response['success']) && $response['success'] === true;
    }

    /**
     * Calls the reCAPTCHA site verify API to verify whether the user passes CAPTCHA
     * test using a PSR-7 ServerRequest object.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return bool
     * @author ARCANEDEV
     */
    public function verifyRequest(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();
        $server = $request->getServerParams();

        $response = isset($body[self::CAPTCHA_NAME])
            ? $body[self::CAPTCHA_NAME]
            : '';

        $remoteIp = isset($server['REMOTE_ADDR'])
            ? $server['REMOTE_ADDR']
            : null;

        return $this->verify($response, $remoteIp);
    }

    /**
     * Get script tag.
     *
     * @param  string|null $callbackName
     *
     * @return string
     * @author ARCANEDEV
     */
    public function script($callbackName = null)
    {
        $script = '';

        if (!$this->scriptLoaded) {
            $script = '<script src="' . $this->getScriptSrc($callbackName) . '" async defer></script>';
            $this->scriptLoaded = true;
        }

        return $script;
    }

    /**
     * Get script tag with a callback function.
     *
     * @param  array $captcha
     * @param  string $callbackName
     *
     * @return string
     * @author ARCANEDEV
     */
    public function scriptWithCallback(array $captcha, $callbackName = 'captchaRenderCallback')
    {
        $script = $this->script($callbackName);

        if (empty($script) || empty($captcha)) {
            return $script;
        }

        return implode(PHP_EOL, [implode(PHP_EOL, [
            '<script>',
            'var ' . $callbackName . ' = function() {',
            $this->renderCaptchas($captcha),
            '};',
            '</script>',
        ]), $script]);
    }

    /**
     * Rendering captcha with callback function.
     *
     * @param  array $captcha
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function renderCaptchas(array $captcha)
    {
        return implode(PHP_EOL, array_map(function ($captcha) {
            return 'if (document.getElementById("' . $captcha . '")) { grecaptcha.render("' . $captcha . '", {"sitekey" : "' . $this->siteKey . '"}); }';
        }, $captcha));
    }

    /**
     * Check if has lang.
     *
     * @return bool
     * @author ARCANEDEV
     */
    protected function hasLang()
    {
        return !empty($this->lang);
    }

    /**
     * Check if callback is not empty.
     *
     * @param  string|null $callbackName
     *
     * @return bool
     * @author ARCANEDEV
     */
    protected function hasCallbackName($callbackName)
    {
        return !(empty($callbackName) || trim($callbackName) === '');
    }

    /**
     * Check key.
     *
     * @param  string $name
     * @param  string $value
     * @author ARCANEDEV
     * @throws ApiException
     */
    private function checkKey($name, &$value)
    {
        $this->checkIsString($name, $value);

        $value = trim($value);

        $this->checkIsNotEmpty($name, $value);
    }

    /**
     * Check if the value is a string value.
     *
     * @param  string $name
     * @param  string $value
     *
     * @throws ApiException
     * @author ARCANEDEV
     */
    protected function checkIsString($name, $value)
    {
        if (!is_string($value)) {
            throw new ApiException(
                'The ' . $name . ' must be a string value, ' . gettype($value) . ' given'
            );
        }
    }

    /**
     * Check if the value is not empty.
     *
     * @param string $name
     * @param string $value
     *
     * @throws ApiException
     * @author ARCANEDEV
     */
    protected function checkIsNotEmpty($name, $value)
    {
        if (empty($value)) {
            throw new ApiException('The ' . $name . ' must not be empty');
        }
    }

    /**
     * Send verify request to API and get response.
     *
     * @param  array $query
     *
     * @return array
     * @author ARCANEDEV
     */
    protected function sendVerifyRequest(array $query = [])
    {
        $query = array_filter($query);
        $url = static::VERIFY_URL . '?' . http_build_query($query);
        $response = $this->request->send($url);

        return $response;
    }
}

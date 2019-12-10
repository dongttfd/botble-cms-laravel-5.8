<?php

namespace Botble\Base\Supports;

use Botble\Setting\Supports\SettingStore;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ixudra\Curl\CurlService;

class MembershipAuthorization
{
    /**
     * @var CurlService
     */
    protected $curl;

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * @var Request
     */
    protected $request;

    /**
     * MembershipAuthorization constructor.
     * @param CurlService $curl
     * @param SettingStore $settingStore
     * @param Request $request
     */
    public function __construct(CurlService $curl, SettingStore $settingStore, Request $request)
    {
        $this->curl = $curl;
        $this->settingStore = $settingStore;
        $this->request = $request;
    }

    /**
     * @return boolean
     */
    public function authorize()
    {
        try {

            if ($this->isInvalidDomain()) {
                return false;
            }

            $authorizeDate = $this->settingStore->get('membership_authorization_at');
            if (!$authorizeDate) {
                return $this->processAuthorize();
            }

            $authorizeDate = Carbon::createFromFormat('Y-m-d h:i:s', $authorizeDate);
            if (now()->diffInDays($authorizeDate) > 7) {
                return $this->processAuthorize();
            }

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function processAuthorize()
    {
        $this->curl->to('https://botble.com/membership/authorize')
            ->withData(['website' => rtrim(url('/'), '/')])
            ->post();

        $this->settingStore
            ->set('membership_authorization_at', now()->toDateTimeString())
            ->save();

        return true;
    }

    /**
     * @return bool
     */
    protected function isInvalidDomain()
    {
        $blacklistIp = [
            '127.0.0.1',
            '::1',
        ];

        if (in_array($this->request->ip(), $blacklistIp)) {
            return true;
        }

        $blacklistDomains = [
            'localhost',
            '8000',
            '.local',
            '.test',
            '192.168',
        ];

        foreach ($blacklistDomains as $blacklistDomain) {
            if (Str::contains(url('/'), $blacklistDomain)) {
                return true;
            }
        }

        return false;
    }
}
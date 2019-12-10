<?php

namespace Botble\Base\Providers;

use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $mail_config = [
            'driver'     => setting('email_driver', config('mail.driver')),
            'host'       => setting('email_host', config('mail.host')),
            'port'       => (int)setting('email_port', config('mail.port')),
            'encryption' => setting('email_encryption', config('mail.encryption')),
            'username'   => setting('email_username', config('mail.username')),
            'password'   => setting('email_password', config('mail.password')),
            'from'       => [
                'address' => setting('email_from_address', config('mail.from.address')),
                'name'    => setting('email_from_name', config('mail.from.name')),
            ],
            'sendmail' => setting('email_sendmail_path', config('mail.sendmail'))
        ];

        config(['mail' => $mail_config]);

        if (setting('email_driver', config('mail.driver')) === 'mailgun') {
            config([
                'services.mailgun' => [
                    'domain' => setting('email_mail_gun_domain', config('services.mailgun.domain')),
                    'secret' => setting('email_mail_gun_secret', config('services.mailgun.secret')),
                ],
            ]);
        }
    }
}

<?php

namespace Botble\Base\Supports;

use Botble\Base\Events\SendMailEvent;
use Botble\Base\Jobs\SendMailJob;
use Exception;
use MailVariable;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use URL;

class EmailHandler
{

    /**
     * @param $view
     *
     */
    public function setEmailTemplate($view)
    {
        config()->set('core.base.general.email_template', $view);
    }

    /**
     * @param string $content
     * @param string $title
     * @param string $to
     * @param array $args
     * @param bool $debug
     * @throws \Throwable
     *
     */
    public function send($content, $title, $to = null, $args = [], $debug = false)
    {
        try {
            if (empty($to)) {
                $to = setting('email_from_address', setting('admin_email', config('mail.from.address')));
            }

            $content = MailVariable::prepareData($content);
            $title = MailVariable::prepareData($title);

            if (env('SEND_MAIN_USING_JOB_QUEUE', false)) {
                dispatch(new SendMailJob($content, $title, $to, $args, $debug));
            } else {
                event(new SendMailEvent($content, $title, $to, $args, $debug));
            }
        } catch (Exception $ex) {
            if ($debug) {
                throw $ex;
            }
            info($ex->getMessage());
            $this->sendErrorException($ex);
        }
    }

    /**
     * Sends an email to the developer about the exception.
     *
     * @param  \Exception $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function sendErrorException(Exception $exception)
    {
        try {
            $ex = FlattenException::create($exception);

            $handler = new SymfonyExceptionHandler;

            $url = URL::full();
            $error = $handler->getContent($ex);

            $this->send(
                view('core/base::emails.error-reporting', compact('url', 'ex', 'error'))->render(),
                $exception->getFile(),
                !empty(config('core.base.general.error_reporting.to')) ?
                    config('core.base.general.error_reporting.to') :
                    setting('admin_email')
            );
        } catch (Exception $ex) {
            info($ex->getMessage());
        }
    }
}

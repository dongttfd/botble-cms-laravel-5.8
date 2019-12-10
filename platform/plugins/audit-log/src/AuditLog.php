<?php

namespace Botble\AuditLog;

use Botble\ACL\Models\User;
use Botble\AuditLog\Events\AuditHandlerEvent;
use Eloquent;

class AuditLog
{
    /**
     * @param string $screen
     * @param \Eloquent|false $data
     * @param string $action
     * @param string $type
     * @return bool
     */
    public function handleEvent($screen, $data, $action, $type = 'info')
    {
        if (!$data instanceof Eloquent || !$data->id) {
            return false;
        }

        event(new AuditHandlerEvent($screen, $action, $data->id, $this->getReferenceName($screen, $data), $type));

        return true;
    }

    /**
     * @param string $screen
     * @param \stdClass|User|Eloquent $data
     * @return string
     *
     */
    public function getReferenceName($screen, $data)
    {
        $name = null;
        switch ($screen) {
            case USER_MODULE_SCREEN_NAME:
            case AUTH_MODULE_SCREEN_NAME:
                $name = $data->getFullName();
                break;
            default:
                if (!empty($data)) {
                    if (isset($data->name)) {
                        $name = $data->name;
                    } elseif (isset($data->title)) {
                        $name = $data->title;
                    }
                }
        }

        return $name;
    }
}

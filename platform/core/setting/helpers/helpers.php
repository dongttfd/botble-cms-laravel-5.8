<?php

use Botble\Setting\Facades\SettingFacade;

if (!function_exists('setting')) {
    /**
     * Get the setting instance.
     *
     * @param $key
     * @param $default
     * @return array|\Botble\Setting\Supports\SettingStore|string|null
     *
     */
    function setting($key = null, $default = null)
    {
        if (!empty($key)) {
            try {
                return Setting::get($key, $default);
            } catch (Exception $exception) {
                info($exception->getMessage());
                return $default;
            }
        }

        return SettingFacade::getFacadeRoot();
    }
}

if (!function_exists('get_setting_email_template_content')) {
    /**
     * Get content of email template if module need to config email template
     * @param $module_type string type of module is system or plugins
     * @param $module_name string
     * @param $email_template_key string key is config in config.email.templates.$key
     * @return bool|mixed|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_setting_email_template_content($module_type, $module_name, $email_template_key)
    {
        $default_path = platform_path($module_type . '/' . $module_name . '/resources/email-templates/' . $email_template_key . '.tpl');
        $storage_path = get_setting_email_template_path($module_name, $email_template_key);

        if ($storage_path != null && File::exists($storage_path)) {
            return get_file_data($storage_path, false);
        }

        return File::exists($default_path) ? get_file_data($default_path, false) : '';
    }
}

if (!function_exists('get_setting_email_template_path')) {
    /**
     * Get user email template path in storage file
     * @param $module_name string
     * @param $email_template_key string key is config in config.email.templates.$key
     * @return string
     */
    function get_setting_email_template_path($module_name, $email_template_key)
    {
        return storage_path('app/email-templates/' . $module_name . '/' . $email_template_key . '.tpl');
    }
}

if (!function_exists('get_setting_email_subject_key')) {
    /**
     * get email subject key for setting() function
     * @param $module_name string
     * @param $mail_template string
     * @return string
     */
    function get_setting_email_subject_key($module_type, $module_name, $email_template_key)
    {
        return $module_type . '_' . $module_name . '_' . $email_template_key . '_subject';
    }
}

if (!function_exists('get_setting_email_subject')) {
    /**
     * Get email template subject value
     * @param $module_type : plugins or core
     * @param $name : name of plugin or core component
     * @param $mail_key : define in config/email/templates
     * @return array|\Botble\Setting\Supports\SettingStore|null|string
     */
    function get_setting_email_subject($module_type, $module_name, $email_template_key)
    {
        $setting_email_subject = setting(get_setting_email_subject_key($module_type, $module_name, $email_template_key),
            trans(config($module_type . '.' . $module_name . '.email.templates.' . $email_template_key . '.subject',
                '')));
        return $setting_email_subject;
    }
}

if (!function_exists('get_setting_email_status_key')) {
    /**
     * Get email on or off status key for setting() function
     * @param $module_type
     * @param $module_name
     * @param $email_template_key
     * @return string
     */
    function get_setting_email_status_key($module_type, $module_name, $email_template_key)
    {
        return $module_type . '_' . $module_name . '_' . $email_template_key . '_' . 'status';
    }
}

if (!function_exists('get_setting_email_status')) {
    /**
     * @param $module_type
     * @param $module_name
     * @param $email_template_key
     * @return array|\Botble\Setting\Supports\SettingStore|null|string
     */
    function get_setting_email_status($module_type, $module_name, $email_template_key)
    {
        return setting(get_setting_email_status_key($module_type, $module_name, $email_template_key), true);
    }
}
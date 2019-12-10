<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;

require_once __DIR__ . '/../vendor/autoload.php';

register_sidebar([
    'id'          => 'top_sidebar',
    'name'        => __('Top sidebar'),
    'description' => __('This is top sidebar section'),
]);

register_sidebar([
    'id'          => 'footer_sidebar',
    'name'        => __('Footer sidebar'),
    'description' => __('This is footer sidebar section'),
]);

add_shortcode('google-map', 'Google map', 'Custom map', 'add_google_map_shortcode');

/**
 * @param $shortcode
 * @return mixed
 * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
 * @throws FileNotFoundException
 */
function add_google_map_shortcode($shortcode)
{
    return Theme::partial('google-map', ['address' => $shortcode->content]);
}

try {
    shortcode()->setAdminConfig('google-map', Theme::partial('google-map-admin-config'));
} catch (FileNotFoundException $exception) {
    info($exception->getMessage());
}

add_shortcode('youtube-video', 'Youtube video', 'Add youtube video', 'add_youtube_video_shortcode');

/**
 * @param $shortcode
 * @return mixed
 * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
 * @throws FileNotFoundException
 */
function add_youtube_video_shortcode($shortcode)
{
    return Theme::partial('video', ['url' => $shortcode->content]);
}

try {
    shortcode()->setAdminConfig('youtube-video', Theme::partial('youtube-admin-config'));
} catch (FileNotFoundException $exception) {
    info($exception->getMessage());
}

theme_option()
    ->setArgs(['debug' => config('app.debug')])
    ->setSection([
        'title'      => __('General'),
        'desc'       => __('General settings'),
        'id'         => 'opt-text-subsection-general',
        'subsection' => true,
        'icon'       => 'fa fa-home',
    ])
    ->setSection([
        'title'      => __('Logo'),
        'desc'       => __('Change logo'),
        'id'         => 'opt-text-subsection-logo',
        'subsection' => true,
        'icon'       => 'fa fa-image',
        'fields'     => [
            [
                'id'         => 'logo',
                'type'       => 'mediaImage',
                'label'      => __('Logo'),
                'attributes' => [
                    'name'  => 'logo',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setField([
        'id'         => 'copyright',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'text',
        'label'      => __('Copyright'),
        'attributes' => [
            'name'    => 'copyright',
            'value'   => __('© 2017 Botble Technologies. All right reserved. Designed by Nghia Minh'),
            'options' => [
                'class'        => 'form-control',
                'placeholder'  => __('Change copyright'),
                'data-counter' => 255,
            ],
        ],
        'helper'     => __('Copyright on footer of site'),
    ])
    ->setField([
        'id'         => 'primary_font',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'googleFonts',
        'label'      => __('Primary font'),
        'attributes' => [
            'name'   => 'primary_font',
            'value'  => 'Roboto',
        ],
    ]);

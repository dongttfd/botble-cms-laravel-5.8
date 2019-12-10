<?php

return [
    'offline'        => env('ASSETS_OFFLINE', true),
    'enable_version' => env('ASSETS_ENABLE_VERSION', false),
    'version'        => env('ASSETS_VERSION', time()),
    'scripts'        => [
        'core',
        'pace',
        'app',
        'fancybox',
        'toastr',
    ],
    'styles'         => [
        'fontawesome',
        'pace',
        'fancybox',
    ],
    'resources'      => [
        'scripts' => [
            'core'                => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/js/core.js',
                ],
            ],
            'app'                 => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/js/app.js',
                ],
            ],
            'jquery-validation'   => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => [
                        '/vendor/core/libraries/jquery-validation/jquery.validate.min.js',
                        '/vendor/core/libraries/jquery-validation/additional-methods.min.js',
                    ],
                ],
            ],
            'jquery-ui'           => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/jquery-ui/jquery-ui.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js',
                ],
            ],
            'fancybox'            => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/fancybox/jquery.fancybox.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js',
                ],
            ],
            'bootstrap-tagsinput' => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js',
                ],
            ],
            'typeahead'           => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => [
                        '/vendor/core/libraries/typeahead.js/typeahead.jquery.min.js',
                        '/vendor/core/libraries/typeahead.js/bloodhound.min.js',
                    ],
                    'cdn'   => [
                        '//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js',
                        '//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/bloodhound.min.js',
                    ],
                ],
            ],
            'are-you-sure'        => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/jquery.are-you-sure/jquery.are-you-sure.js',
                ],
            ],
            'toastr'                 => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/toastr/toastr.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js',
                ],
            ],
            'datatables'             => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => [
                        '/vendor/core/libraries/datatables/media/js/jquery.dataTables.min.js',
                        '/vendor/core/libraries/datatables/media/js/dataTables.bootstrap.min.js',
                        '/vendor/core/libraries/datatables/extensions/Buttons/js/dataTables.buttons.min.js',
                        '/vendor/core/libraries/datatables/extensions/Buttons/js/buttons.bootstrap.min.js',
                    ],
                ],
            ],
            'datepicker'             => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                ],
            ],
            'moment'                 => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/moment-with-locales.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js',
                ],
            ],
            // End JS
        ],
        /* -- STYLESHEET ASSETS -- */
        'styles'  => [
            'fontawesome'         => [
                'use_cdn'    => true,
                'location'   => 'header',
                'src'        => [
                    'local' => '/vendor/core/libraries/font-awesome/css/fontawesome.min.css',
                    'cdn'   => '//use.fontawesome.com/releases/v5.0.13/css/all.css',
                ],
                'attributes' => [
                    'integrity'   => 'sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp',
                    'crossorigin' => 'anonymous',
                ],
            ],
            'core'                => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/css/core.css',
                ],
            ],
            'jquery-ui'           => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/vendor/core/libraries/jquery-ui/jquery-ui.min.css',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css',
                ],
            ],
            'pace'                => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/libraries/pace/pace-theme-minimal.css',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-minimal.css',
                ],
            ],
            'bootstrap-tagsinput' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => [
                        '/vendor/core/libraries/bootstrap-tagsinput/bootstrap-tagsinput.css',
                    ],
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css',
                ],
            ],
            'fancybox'            => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/libraries/fancybox/jquery.fancybox.min.css',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css',
                ],
            ],
            'datatables'          => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => [
                        '/vendor/core/libraries/datatables/media/css/dataTables.bootstrap.min.css',
                    ],
                ],
            ],
            'datepicker'          => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/libraries/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                ],
            ],
        ],
    ],
];

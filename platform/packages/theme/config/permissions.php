<?php

return [
    [
        'name'        => 'Theme',
        'flag'        => 'theme.list',
        'parent_flag' => 'core.appearance',
    ],
    [
        'name'        => 'Activate',
        'flag'        => 'theme.activate',
        'parent_flag' => 'theme.list',
    ],
    [
        'name'        => 'Remove',
        'flag'        => 'theme.remove',
        'parent_flag' => 'theme.list',
    ],
    [
        'name'        => 'Theme options',
        'flag'        => 'theme.options',
        'parent_flag' => 'core.appearance',
    ],
    [
        'name'        => 'Custom CSS',
        'flag'        => 'theme.custom-css',
        'parent_flag' => 'core.appearance',
    ],
];
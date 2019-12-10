<?php

return [
    [
        'name'        => 'Plugins',
        'flag'        => 'plugins.list',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Activate/Deactivate',
        'flag'        => 'plugins.edit',
        'parent_flag' => 'plugins.list',
    ],
    [
        'name'        => 'Remove',
        'flag'        => 'plugins.remove',
        'parent_flag' => 'plugins.list',
    ],
    [
        'name' => 'System',
        'flag' => 'core.system',
    ],
    [
        'name' => 'Appearance',
        'flag' => 'core.appearance',
    ],
];
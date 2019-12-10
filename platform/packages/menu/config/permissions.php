<?php

return [
    [
        'name'        => 'Menu',
        'flag'        => 'menus.list',
        'parent_flag' => 'core.appearance',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'menus.create',
        'parent_flag' => 'menus.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'menus.edit',
        'parent_flag' => 'menus.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'menus.delete',
        'parent_flag' => 'menus.list',
    ],
];
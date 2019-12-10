<?php

return [
    [
        'name'        => 'Users',
        'flag'        => 'users.list',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'users.create',
        'parent_flag' => 'users.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'users.edit',
        'parent_flag' => 'users.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'users.delete',
        'parent_flag' => 'users.list',
    ],
    [
        'name'        => 'Impersonate',
        'flag'        => 'users.impersonate',
        'parent_flag' => 'users.list',
    ],

    [
        'name'        => 'Roles',
        'flag'        => 'roles.list',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'roles.create',
        'parent_flag' => 'roles.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'roles.edit',
        'parent_flag' => 'roles.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'roles.delete',
        'parent_flag' => 'roles.list',
    ],
];
<?php

return [
    [
        'name' => 'Members',
        'flag' => 'member.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'member.create',
        'parent_flag' => 'member.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'member.edit',
        'parent_flag' => 'member.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'member.delete',
        'parent_flag' => 'member.list',
    ],
];
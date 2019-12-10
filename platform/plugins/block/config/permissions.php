<?php

return [
    [
        'name' => 'Block',
        'flag' => 'block.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'block.create',
        'parent_flag' => 'block.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'block.edit',
        'parent_flag' => 'block.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'block.delete',
        'parent_flag' => 'block.list',
    ],
];
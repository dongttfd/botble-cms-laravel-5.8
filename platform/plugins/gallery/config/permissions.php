<?php

return [
    [
        'name' => 'Galleries',
        'flag' => 'galleries.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'galleries.create',
        'parent_flag' => 'galleries.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'galleries.edit',
        'parent_flag' => 'galleries.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'galleries.delete',
        'parent_flag' => 'galleries.list',
    ],
];
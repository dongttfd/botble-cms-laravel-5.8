<?php

return [
    [
        'name' => 'Page',
        'flag' => 'pages.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'pages.create',
        'parent_flag' => 'pages.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'pages.edit',
        'parent_flag' => 'pages.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'pages.delete',
        'parent_flag' => 'pages.list',
    ],
];
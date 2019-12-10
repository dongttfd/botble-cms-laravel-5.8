<?php

return [
    [
        'name' => 'Blog',
        'flag' => 'plugins.blog',
    ],
    [
        'name'        => 'Posts',
        'flag'        => 'posts.list',
        'parent_flag' => 'plugins.blog',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'posts.create',
        'parent_flag' => 'posts.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'posts.edit',
        'parent_flag' => 'posts.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'posts.delete',
        'parent_flag' => 'posts.list',
    ],

    [
        'name'        => 'Categories',
        'flag'        => 'categories.list',
        'parent_flag' => 'plugins.blog',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'categories.create',
        'parent_flag' => 'categories.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'categories.edit',
        'parent_flag' => 'categories.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'categories.delete',
        'parent_flag' => 'categories.list',
    ],

    [
        'name'        => 'Tags',
        'flag'        => 'tags.list',
        'parent_flag' => 'plugins.blog',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'tags.create',
        'parent_flag' => 'tags.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'tags.edit',
        'parent_flag' => 'tags.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'tags.delete',
        'parent_flag' => 'tags.list',
    ],
];
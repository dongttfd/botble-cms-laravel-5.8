<?php

return [
    [
        'name' => 'Languages',
        'flag' => 'languages.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'languages.create',
        'parent_flag' => 'languages.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'languages.edit',
        'parent_flag' => 'languages.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'languages.delete',
        'parent_flag' => 'languages.list',
    ],
];
<?php

return [
    [
        'name' => 'Custom Fields',
        'flag' => 'custom-fields.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'custom-fields.create',
        'parent_flag' => 'custom-fields.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'custom-fields.edit',
        'parent_flag' => 'custom-fields.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'custom-fields.delete',
        'parent_flag' => 'custom-fields.list',
    ],
];
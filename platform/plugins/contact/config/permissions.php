<?php

return [
    [
        'name' => 'Contacts',
        'flag' => 'contacts.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'contacts.create',
        'parent_flag' => 'contacts.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'contacts.edit',
        'parent_flag' => 'contacts.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'contacts.delete',
        'parent_flag' => 'contacts.list',
    ],
];
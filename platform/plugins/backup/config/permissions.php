<?php

return [
    [
        'name' => 'Backup',
        'flag' => 'backups.list',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'backups.create',
        'parent_flag' => 'backups.list',
    ],
    [
        'name'        => 'Restore',
        'flag'        => 'backups.restore',
        'parent_flag' => 'backups.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'backups.delete',
        'parent_flag' => 'backups.list',
    ],
];
<?php

return [
    [
        'name'        => 'Activity Logs',
        'flag'        => 'audit-log.list',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'audit-log.delete',
        'parent_flag' => 'audit-log.list',
    ],
];
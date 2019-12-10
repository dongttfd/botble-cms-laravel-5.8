<?php

return [
    [
        'name'        => 'Request Logs',
        'flag'        => 'request-log.list',
        'parent_flag' => 'core.system',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'request-log.delete',
        'parent_flag' => 'request-log.list',
    ],
];
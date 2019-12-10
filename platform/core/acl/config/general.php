<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Activations
    |--------------------------------------------------------------------------
    |
    | Here you may specify the activations model used and the time (in seconds)
    | which activation codes expire. By default, activation codes expire after
    | three days. The lottery is used for garbage collection, expired
    | codes will be cleared automatically based on the provided odds.
    |
    */

    'activations' => [

        'expires' => 259200,

        'lottery' => [2, 100],

    ],
];

<?php

return [
    'tries' => env('TRIES', 100),
    'guessNumber' => env('GUESS_NUMBER', 50),
    'rangeStart' => env('RANGE_START', 0),
    'rangeEnd' => env('RANGE_END', 100),
    'chainLength' => env('CHAIN_LENGTH', 2),
    'backoff' => env('BACK_OFF', 0),
];

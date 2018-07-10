<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Passphrase
    |--------------------------------------------------------------------------
    | The passphrase that will be added to the row for hashing.
    */
    'passphrase' => env('SIGNER_PASSPHRASE', 'Your super secret passphrase'),

    /*
    |--------------------------------------------------------------------------
    | Cost
    |--------------------------------------------------------------------------
    | Cost which denotes the algorithmic cost that should be used.
    */
    'cost' => env('SIGNER_COST', 10),
];

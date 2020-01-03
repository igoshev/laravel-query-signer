# Simple query signer for Laravel
Supported versions: 5.6 and above
## Installing query signer
Note: If you do not have Composer yet, you can install it by following the instructions on https://getcomposer.org
#### Install package
```bash
composer require bonecms/laravel-query-signer
```

## Using query signer

Generate signature:
```php
<?php 

use Bone\Signer\Facades\Signer;

$array = [
    5,
    'string' => 'example',
    'array'  => [
        'example'
    ]
];

$sign = Signer::sign($array);
```

Check Signature:
```php
<?php 

use Bone\Signer\Facades\Signer;

$array = [
    5,
    'string' => 'example',
    'array'  => [
        'example'
    ]
];
$sign = '$2y$10$wDtYOVXK5J9XCD6Vx.taNevviw5aVsVp1rBrkpaB.9xLwHHORgqya';

$verified = Signer::verify($array, $sign);
if ($verified) {
    // do something
}
```

### Configuration
```bash
php artisan vendor:publish --tag=bone-data-signer-config
```
```php
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
```

<?php

namespace Bone\Signer\Facades;

use Illuminate\Support\Facades\Facade;
use Bone\Signer\Service\Signer as SignerService;

/**
 * @method static string sign(array $data)
 * @method static string verify(array $data, string $hash)
 * 
 * @see \Signer\Service\Signer
 */
class Signer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SignerService::class;
    }  
}

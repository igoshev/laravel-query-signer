<?php

namespace Bone\Signer;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Bone\Signer\Service\Signer;

class SignerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/bone/signer.php', 'bone.signer');

        $this->publishes([__DIR__ . '/config' => config_path()], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Signer::class, function (Application $app) {
            return new Signer(
                $app['config']['bone']['signer']['cost'],
                $app['config']['bone']['signer']['passphrase']
            );
        });
    }
}

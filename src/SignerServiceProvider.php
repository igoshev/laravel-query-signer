<?php

namespace Bone\Signer;

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

        $this->publishes([__DIR__ . '/config' => app()->basePath() . '/config'], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Signer::class, function ($app) {
            return new Signer(
                $app['config']['bone']['signer']['cost'],
                $app['config']['bone']['signer']['passphrase']
            );
        });
    }
}

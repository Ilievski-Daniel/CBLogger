<?php

namespace CodeBridge\CBLogger\Provider;

use CodeBridge\CBLogger\MultiChannelLogger;
use Illuminate\Support\ServiceProvider;


class CBLoggerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/cblogger.php' => config_path('cblogger.php')
        ]);

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'CodeBridge\CBLogger\MultiChannelLogger', function ( $app ) {
            return new MultiChannelLogger(config( 'cblogger' ));
        } );
    }

}
<?php

namespace App\Ship\Parents\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider as LaravelBroadcastServiceProvider;

/**
 * Class BroadcastsProvider
 *
 * A.K.A app/Providers/BroadcastServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class BroadcastsProvider extends LaravelBroadcastServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

//        require base_path('routes/channels.php');
    }
}

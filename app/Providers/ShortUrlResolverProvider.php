<?php

namespace App\Providers;

use App\Services\Resolver;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class ShortUrlResolverProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Resolver::class , function () {
            return new Resolver(new Agent());
        });
    }


}

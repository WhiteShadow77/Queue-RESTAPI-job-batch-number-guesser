<?php

namespace App\Providers;

use App\Library\BatchHandler;
use App\Library\BatchHandlerInterface;
use App\Services\HomeControllerService;
use App\Services\HomeControllerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(BatchHandlerInterface::class, function(){
//            return new BatchHandler();
//        });

        $this->app->singleton(HomeControllerServiceInterface::class, function(){
            return new HomeControllerService(new BatchHandler);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

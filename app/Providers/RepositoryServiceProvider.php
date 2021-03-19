<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'Staff',
            'Home',
            'Product',
            'Admin',
            'Language'
        );

        foreach ($models as $model) {
            $this->app->bind(
                "App\Http\Interfaces\\{$model}Interface",
                "App\Http\Repositories\\{$model}Repository"
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

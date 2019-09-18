<?php

namespace App\Providers;

use Core\Domain\Factory\ActionFactoryInterface;
use Core\Domain\Factory\ShapeFactoryInterface;
use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Infrastructure\Factory\ActionFactory;
use Core\Infrastructure\Factory\ShapeFactory;
use Core\Infrastructure\Repository\ActionRepository;
use Core\Infrastructure\Repository\ShapeRepository;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            ShapeRepositoryInterface::class,
            ShapeRepository::class
        );

        $this->app->bind(
            ActionRepositoryInterface::class,
            ActionRepository::class
        );

        $this->app->bind(
            ShapeFactoryInterface::class,
            ShapeFactory::class
        );

        $this->app->bind(
            ActionFactoryInterface::class,
            ActionFactory::class
        );
    }
}

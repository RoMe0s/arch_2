<?php

namespace App\Providers;

use Core\Domain\Factory\{
    ActionFactoryInterface,
    ShapeFactoryInterface
};
use Core\Domain\Repository\{
    ActionRepositoryInterface,
    ShapeRepositoryInterface
};
use Core\Domain\Service\{
    BaseCommandFactory,
    RollbackCommandsServiceInterface
};
use Core\Infrastructure\Factory\{
    ActionFactory,
    ShapeFactory
};
use Core\Infrastructure\Repository\{
    ActionRepository,
    ShapeRepository
};
use Core\Infrastructure\Service\{
    CommandFactory,
    RollbackCommandsService
};
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

        $this->app->bind(
            BaseCommandFactory::class,
            CommandFactory::class
        );

        $this->app->bind(
            RollbackCommandsServiceInterface::class,
            RollbackCommandsService::class
        );
    }
}

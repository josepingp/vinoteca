<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInteface;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\SessionCartRepository;
use App\Repositories\Wine\EloquentWineRepository;
use App\Repositories\Wine\WineRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInteface::class,
            EloquentCategoryRepository::class
        );

        $this->app->bind(
            WineRepositoryInterface::class,
            EloquentWineRepository::class
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            SessionCartRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

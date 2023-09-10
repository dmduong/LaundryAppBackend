<?php

namespace App\Providers;

use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\EloquentRepositoryInterface;
use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Repositories\AccountEloquentRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\StoreEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, EloquentRepository::class);
        $this->app->bind(StoreEloquentRepositoryInterface::class, StoreEloquentRepository::class);
        $this->app->bind(AccountEloquentRepositoryInterFace::class, AccountEloquentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

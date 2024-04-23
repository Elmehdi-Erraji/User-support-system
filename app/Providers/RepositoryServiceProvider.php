<?php

namespace App\Providers;

use App\Repositories\Contracts\ActivityLogInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\DashboardInterface;
use App\Repositories\Contracts\DepartmentsInterface;
use App\Repositories\Contracts\FaqInterface;
use App\Repositories\Contracts\NotificationsInterface;
use App\Repositories\Contracts\TicketsInterface;
use App\Repositories\Contracts\UsersInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\DashboardRepository;
use App\Repositories\Eloquent\DepartmentsRepository;
use App\Repositories\Eloquent\FaqRepository;
use App\Repositories\Eloquent\NotificationsRepository;
use App\Repositories\Eloquent\TicketsRepository;
use App\Repositories\Eloquent\UsersRepository;
use App\Repositories\Eloquent\ActivityLogRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */ 
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(DepartmentsInterface::class, DepartmentsRepository::class);
        $this->app->bind(FaqInterface::class, FaqRepository::class);
        $this->app->bind(ActivityLogInterface::class, ActivityLogRepository::class);
        $this->app->bind(NotificationsInterface::class, NotificationsRepository::class);
        $this->app->bind(TicketsInterface::class, TicketsRepository::class);
        $this->app->bind(UsersInterface::class, UsersRepository::class);
        $this->app->bind(DashboardInterface::class, DashboardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

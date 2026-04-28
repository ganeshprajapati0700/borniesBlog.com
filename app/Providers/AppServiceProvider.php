<?php

namespace App\Providers;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\SubCategoryRepository;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\SubCategoryServiceInterface;
use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\SubCategoryService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(SubCategoryServiceInterface::class, SubCategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

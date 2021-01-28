<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Categories;
use App\User;
use Illuminate\Support\Facades\View;
use App\Core\Repositories\Post\IPost;
use App\Core\Repositories\Post\PostImpl;
use App\Core\Repositories\Comment\IComment;
use App\Core\Repositories\Comment\CommentImpl;
use App\Core\Repositories\Category\ICategory;
use App\Core\Repositories\Category\CategoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* $this->app->bind(
            'App\Core\Repositories\Post\PostRepositoryInterface',
            'App\Core\Repositories\Post\PostEloquentRepository'
        ); */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('partials.sidebar', function($view){
            $view->with('categories', Categories::all())->with('authors', User::all());
        });
        // view()->share('categories', $categories);
    }
    public $bindings = [
        IComment::class => CommentImpl::class,
        ICategory::class => CategoryImpl::class,
        IPost::class => PostImpl::class,
    ];
}

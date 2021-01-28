<?php

namespace App\Core\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Repositories\Post\IPost;
use App\Core\Repositories\Post\PostImpl;
use App\Core\Repositories\Comment\IComment;
use App\Core\Repositories\Comment\CommentImpl;
use App\Core\Repositories\Category\ICategory;
use App\Core\Repositories\Category\CategoryImpl;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
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

    public $bindings = [
        IPost::class => PostImpl::class,
        IComment::class => CommentImpl::class,
        ICategory::class => CategoryImpl::class,
    ];
}

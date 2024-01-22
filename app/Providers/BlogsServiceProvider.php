<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Blog;

class BlogsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            $trendingBlogs = Blog::orderBy('created_at', 'desc')->where('status', 1)->limit(4)->get();
            $view->with('trendingBlogs', $trendingBlogs);
        });
    }
}

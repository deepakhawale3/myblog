<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Blogger\BloggerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AllblogController;
use App\Http\Controllers\Admin\AllbloggerController;
use App\Http\Controllers\Blogger\BlogController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
// Route to show blogs for a specific category
Route::get('/category/{categorySlug}', [HomeController::class, 'showCategoryBlogs'])->name('category.show');
Route::get('/blog/{blogSlug}', [HomeController::class, 'showBlog'])->name('blog.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/store-comment', [HomeController::class, 'storeComment'])->name('comments.store');
Route::post('/subscribe-newsletter', [HomeController::class, 'subscribeNewsletter'])->name('subscribe.newsletter');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('allblog', AllblogController::class);
    Route::resource('allblogger', AllbloggerController::class);
    Route::resource('categories', CategoryController::class);
    
    // Add other admin routes here
});



Route::prefix('blogger')->group(function () {
    Route::get('/dashboard', [BloggerController::class, 'index'])->name('blogger.dashboard');
    Route::resource('blogs', BlogController::class);
    Route::get('/blogs/{blog}/comments', [BlogController::class, 'showComments'])->name('blogs.comments');

    Route::post('/comments/{comment}/allow', [CommentController::class, 'allow'])->name('comments.allow');
    Route::post('/comments/{comment}/block', [CommentController::class, 'block'])->name('comments.block');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Add other customer routes here
});

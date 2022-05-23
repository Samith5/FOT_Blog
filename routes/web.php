<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\FrondEndController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

// Auth::routes();
// Route::get('/a', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('login');
// Route::get('/', function () {
//     return redirect()->route('home');
// })->name('login');
// Route::get('/login', function () {
//     return redirect()->route('home');
// })->name('login');


Route::get('/home', [FrondEndController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/login', function () {
    return redirect()->route('home');
});
Route::get('/blog/{url}/', [FrondEndController::class, 'blogIndex'])->name('blog');
Route::get('/pages/{url}/', [FrondEndController::class, 'pagesIndex'])->name('pages');


// Dashboard Routes 
Route::get('/admin/dashboard/login', [LoginController::class, 'loginIndex']);
Route::post('/admin/dashboard/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/dashboard/logout', [LoginController::class, 'logout'])->name('adminLogout');

    Route::get('/admin/dashboard/home', function () {
        return view('dashboard.home');
    })->name('dashboard.home');

    Route::get('/admin/dashboard/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/admin/dashboard/blogs/details', [BlogController::class, 'indexDetails'])->name('blogs.details');
    Route::post('/admin/dashboard/blogs/add-new', [BlogController::class, 'addNewBlog'])->name('blogs.addNew');
    Route::post('/admin/dashboard/blogs/update', [BlogController::class, 'updateBlog'])->name('blogs.update');
    Route::post('/admin/dashboard/blogs/one/details', [BlogController::class, 'blogDetails'])->name('blog.details');
    Route::post('/admin/dashboard/blogs/delete', [BlogController::class, 'blogDelete'])->name('blog.delete');
    Route::post('/admin/dashboard/blogs/change/status', [BlogController::class, 'blogStatusChange'])->name('blog.change');
});

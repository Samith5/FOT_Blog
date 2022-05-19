<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\LoginController as DashboardLoginController;
use App\Http\Controllers\PageController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Dashboard Routes 
Route::get('/admin/dashboard/login', function () {
    return view('dashboard.login');
});
Route::post('/admin/dashboard/login', [DashboardLoginController::class, 'adminLogin'])->name('adminLogin');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/dashboard/logout', [DashboardLoginController::class, 'adminLogout'])->name('adminLogout');

    Route::get('/admin/dashboard/home', function () {
        return view('dashboard.home');
    })->name('dashboard.home');

    Route::get('/admin/dashboard/blogs', [PageController::class, 'index'])->name('blogs.index');
    Route::get('/admin/dashboard/blogs/details', [PageController::class, 'indexDetails'])->name('blogs.details');
    Route::post('/admin/dashboard/blogs/add-new', [PageController::class, 'addNewPage'])->name('blogs.addNew');
    Route::post('/admin/dashboard/blogs/a-new', [PageController::class, 'addNewPage'])->name('blogs.update');
});

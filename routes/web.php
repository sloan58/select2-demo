<?php

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

// Big help from this Stack Overflow post
// https://stackoverflow.com/questions/68403473/how-can-i-perform-a-select2-result-infinite-scroll-with-laravel-pagination
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', function () {
        return \App\Models\User::when(request()->get('q'), function ($q) {
            $q->where('name', 'like', '%' . request()->get('q') . '%');
        })->orderBy('name')->paginate(10, ['*'], 'page', request()->get('page'));
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

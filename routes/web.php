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
    $posts = DB::select('SELECT * FROM posts');
    return view('welcome')->with('posts', $posts);
});

Auth::routes();
Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

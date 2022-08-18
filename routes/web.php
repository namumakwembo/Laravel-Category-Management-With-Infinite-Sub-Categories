<?php

use App\Http\Livewire\Category;
use App\Http\Livewire\Home;
use App\Http\Livewire\Post\CreatePost;
use App\Http\Livewire\Search;
use App\Http\Livewire\Tag;
use App\Http\Livewire\Test;
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


Route::get('/search/{query}', Search::class )->middleware(['auth'])->name('search');


Route::get('/category', Category::class )->middleware(['auth'])->name('category');

Route::get('/tag', Tag::class)->middleware(['auth'])->name('tag');


Route::get('/home', Home::class)->middleware(['auth'])->name('home');


Route::get('/create-post', CreatePost::class)->middleware(['auth'])->name('post.create');
 


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




















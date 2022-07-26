<?php

use App\Http\Livewire\Widget;
use App\Http\Livewire\Featured;
use App\Http\Livewire\Product;
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

Route::view('/','welcome')->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return to_route('welcome');
    })->name('dashboard');
    Route::get('/widgets',Widget::class)->name('widgets');
    Route::get('/products', Product::class)->name('products');
});

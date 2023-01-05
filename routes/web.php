<?php

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

Route::redirect('/', '/home');

Auth::routes();

Route::group(['middleware' => 'auth'] , function()  {
    Route::post('register' , [App\Http\Controllers\Auth\RegisterController::class , 'register' ]);

//    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', \App\Http\Livewire\Symbol\Symbols::class)->name('home');

    Route::get('/setting', \App\Http\Livewire\SettingForm::class)->name('setting');

    Route::get('/currencies', \App\Http\Livewire\Symbol\Symbols::class)->name('currency');
    Route::get('/currency/{id?}', \App\Http\Livewire\Symbol\Edit::class)->name('currency.edit');

    Route::get('/currency/{symbol}/messages', App\Http\Livewire\Message\Messages::class)->name('messages');
    Route::get('/currency/{symbol}/message/{message?}', App\Http\Livewire\Message\Edit::class)->name('message.create');
    Route::get('/currency/{symbol}/message/{message}/delete', App\Http\Livewire\Message\Delete::class)->name('message.delete');

    Route::get('/admin', \App\Http\Livewire\Admin\Users::class)->name('admin');
    Route::get('/admin/{id}', \App\Http\Livewire\Admin\Edit::class)->name('admin.edit');

});

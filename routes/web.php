<?php

use App\Notifications\Telegram;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Notification::route('telegram', env('TELEGRAM_CHAT_ID'))
//    ->notify(new Telegram);
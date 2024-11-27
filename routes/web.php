<?php

use App\Livewire\UsersDisplay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if(env('APP_ENV') == 'local')
{
    Auth::login(User::find(1));
}

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('users-display', UsersDisplay::class)->middleware(['auth']);

require __DIR__.'/auth.php';

<?php

use App\Livewire\AdminPanel;
use App\Livewire\UserSearchBar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//if(env('APP_ENV') == 'local')
//{
//    Auth::login(User::find(1));
//}

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    } else {
        return redirect('login');
    }
})->name('home');

Route::get('search', UserSearchBar::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('panneau-admin', AdminPanel::class)
    ->middleware(['auth'])
    ->name('panneau-admin');

Route::get('classe', \App\Livewire\Notes::class)
    ->middleware(['auth'])
    ->name('classe');

require __DIR__.'/auth.php';

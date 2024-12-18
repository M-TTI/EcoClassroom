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

Route::view('/', 'welcome');

Route::get('search', UserSearchBar::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('manage-classrooms', AdminPanel::class)->middleware(['auth']);

require __DIR__.'/auth.php';

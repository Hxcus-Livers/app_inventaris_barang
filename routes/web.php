<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\DistributorComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ItemComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', HomeComponent::class)->middleware('auth', 'verified')->name('home');
Route::get('/item', ItemComponent::class)->middleware('auth')->name('item');
Route::get('/distributor', DistributorComponent::class)->middleware('auth')->name('distributor');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

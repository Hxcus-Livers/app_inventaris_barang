<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AssetsCategoryComponent;
use App\Livewire\BrandComponent;
use App\Livewire\CalculateDepreciationComponent;
use App\Livewire\DepreciationComponent;
use App\Livewire\DistributorComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ItemComponent;
use App\Livewire\LocationComponent;
use App\Livewire\LocationMutationComponent;
use App\Livewire\OpnameComponent;
use App\Livewire\ProcurementComponent;
use App\Livewire\SubCategoryAssetsComponent;
use App\Livewire\UnitComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Routes yang bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // Redirect dashboard ke home
    Route::redirect('/dashboard', '/home')->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Home route
    Route::get('/dashboard', HomeComponent::class)->middleware('verified')->name('home');

    // Route yang bisa diakses admin dan accountant
    Route::get('/calculate-depreciation', CalculateDepreciationComponent::class)
        ->middleware(\App\Http\Middleware\RoleMiddleware::class . ':0,1')
        ->name('calculate-depreciation');

    // Routes khusus admin
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/item', ItemComponent::class)->name('item');
        Route::get('/distributor', DistributorComponent::class)->name('distributor');
        Route::get('/location', LocationComponent::class)->name('location');
        Route::get('/assets-category', AssetsCategoryComponent::class)->name('assets-category');
        Route::get('/asset-subcategory', SubCategoryAssetsComponent::class)->name('asset-subcategory');
        Route::get('/brand', BrandComponent::class)->name('brand');
        Route::get('/unit', UnitComponent::class)->name('unit');
        Route::get('/procurement', ProcurementComponent::class)->name('procurement');
        Route::get('/location-mutation', LocationMutationComponent::class)->name('location-mutation');
        Route::get('/depreciation', DepreciationComponent::class)->name('depreciation');
        Route::get('/opname', OpnameComponent::class)->name('opname');
    });
});

require __DIR__.'/auth.php';
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
use App\Livewire\ProcurementCreateComponent;
use App\Livewire\SubCategoryAssetsComponent;
use App\Livewire\UnitComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', HomeComponent::class)->middleware('auth', 'verified')->name('home');
Route::get('/item', ItemComponent::class)->middleware('auth')->name('item');
Route::get('/distributor', DistributorComponent::class)->middleware('auth')->name('distributor');
Route::get('/location', LocationComponent::class)->middleware('auth')->name('location');
Route::get('/assets-category', AssetsCategoryComponent::class)->middleware('auth')->name('assets-category');
Route::get('/asset-subcategory', SubCategoryAssetsComponent::class)->middleware('auth')->name('asset-subcategory');
Route::get('/brand', BrandComponent::class)->middleware('auth')->name('brand');
Route::get('/unit', UnitComponent::class)->middleware('auth')->name('unit');
Route::get('/procurement', ProcurementComponent::class)->middleware('auth')->name('procurement');
Route::get('/location-mutation', LocationMutationComponent::class)->middleware('auth')->name('location-mutation');
Route::get('/depreciation', DepreciationComponent::class)->middleware('auth')->name('depreciation');
Route::get('/calculat-depreciation', CalculateDepreciationComponent::class)->middleware('auth')->name('calculat-depreciation');
Route::get('/opname', OpnameComponent::class)->middleware('auth')->name('opname');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

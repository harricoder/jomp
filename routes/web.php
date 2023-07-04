<?php

declare(strict_types=1);

use App\Http\Controllers\Categories\DeleteController as CategoryDeleteController;
use App\Http\Controllers\Categories\ListController as CategoryListController;
use App\Http\Controllers\Categories\StoreController as CategoryCreateController;
use App\Http\Controllers\Categories\UpdateController as CategoryUpdateController;
use App\Http\Controllers\Categories\ViewController as CategoryViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manufacturers\DeleteController as ManufacturerDeleteController;
use App\Http\Controllers\Manufacturers\ListController as ManufacturerListController;
use App\Http\Controllers\Manufacturers\StoreController as ManufacturerCreateController;
use App\Http\Controllers\Manufacturers\UpdateController as ManufacturerUpdateController;
use App\Http\Controllers\Manufacturers\ViewController as ManufacturerViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tags\DeleteController as TagsDeleteController;
use App\Http\Controllers\Tags\ListController as TagsListController;
use App\Http\Controllers\Tags\StoreController as TagsCreateController;
use App\Http\Controllers\Tags\UpdateController as TagsUpdateController;
use App\Http\Controllers\Tags\ViewController as TagsViewController;
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

Route::get('/', fn () => view('welcome'));

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('tags', TagsListController::class)->name('tags');
    Route::post('tags', TagsCreateController::class)->name('tags.store');
    Route::get('tags/{tag}', TagsViewController::class)->name('tags.edit');
    Route::put('tags/{tag}', TagsUpdateController::class)->name('tags.update');
    Route::delete('tags/{tag}', TagsDeleteController::class)->name('tags.destroy');

    Route::get('categories', CategoryListController::class)->name('categories');
    Route::post('categories', CategoryCreateController::class)->name('category.store');
    Route::get('categories/{category}', CategoryViewController::class)->name('category.edit');
    Route::put('categories/{category}', CategoryUpdateController::class)->name('category.update');
    Route::delete('categories/{category}', CategoryDeleteController::class)->name('category.destroy');

    Route::get('manufacturers', ManufacturerListController::class)->name('manufacturers');
    Route::post('manufacturers', ManufacturerCreateController::class)->name('manufacturer.store');
    Route::get(
        'manufacturers/{manufacturer}',
        ManufacturerViewController::class
    )->name('manufacturer.edit');
    Route::put(
        'manufacturers/{manufacturer}',
        ManufacturerUpdateController::class
    )->name('manufacturer.update');
    Route::delete(
        'manufacturers/{manufacturer}',
        ManufacturerDeleteController::class
    )->name('manufacturer.destroy');
});

Route::middleware('auth')->group(function (): void {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

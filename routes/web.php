<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\Catalog\AttributesController;
use App\Http\Controllers\Admin\Catalog\AttributeFamiliesController;
use App\Http\Controllers\Admin\Catalog\CategoriesController;
use App\Models\AttributeFamily;

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

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
  Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
  })->name('dashboard');

  Route::get('/sales/orders', function () {
    return Inertia::render('Admin/Sales/Orders/Index');
  })->name('sales.orders.index');

  Route::get('/sales/invoices', function () {
    return Inertia::render('Admin/Sales/Invoices/Index');
  })->name('sales.invoices.index');


  Route::prefix('catalog')->group(function () {
    Route::get('/products', function () {
      return Inertia::render('Admin/Catalog/Products/Index');
    })->name('catalog.products.index');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('catalog.categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('catalog.categories.create');
    Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('catalog.categories.edit');
    Route::post('/categories/{category}', [CategoriesController::class, 'update'])->name('catalog.categories.update');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('catalog.categories.store');

    Route::get('/attributes', [AttributesController::class, 'index'])->name('catalog.attributes.index');

    Route::get('/attributes/create', [AttributesController::class, 'create'])->name('catalog.attributes.create');

    Route::get('/attributes/{attribute}/edit', [AttributesController::class, 'edit'])->name('catalog.attributes.edit');

    Route::post('/attributes', [AttributesController::class, 'store'])->name('catalog.attributes.store');

    Route::put('/attributes/{attribute}', [AttributesController::class, 'update'])->name('catalog.attributes.update');

    Route::get('/families', [AttributeFamiliesController::class, 'index'])->name('catalog.families.index');
    Route::get('/families/create', [AttributeFamiliesController::class, 'create'])->name('catalog.families.create');
    Route::get('/families/{attribute_familiy}/edit', [AttributeFamiliesController::class, 'edit'])->name('catalog.families.edit');
    Route::put('/families/{attribute_familiy}', [AttributeFamiliesController::class, 'update'])->name('catalog.families.update');
    Route::post('/families', [AttributeFamiliesController::class, 'store'])->name('catalog.families.store');
  });
});


Route::get('/test', function () {
  $f = AttributeFamily::with(['attribute_groups', 'attribute_groups.custom_attributes'])->first();
  dd($f);
});

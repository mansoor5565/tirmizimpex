<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LeatherController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\Purchase_Leather_Controller;
use App\Http\Controllers\Purchase_Accessories_Controller;
use App\Http\Controllers\Accessories_Inventory_Controller;
use App\Http\Controllers\Leather_Inventory_Controller;
use App\Http\Controllers\Leather_Vendor_Controller;
use App\Http\Controllers\Leather_Transaction_Controller;
use App\Http\Controllers\Leather_Vendor_Bill_Controller;

use App\Http\Controllers\Menu;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', '/dashboard');
Auth::routes([
    'register' => false
]);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Accessories
    Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories.index');
    Route::post('/accessories', [AccessoriesController::class, 'store']);
    Route::get('/accessories/create', [AccessoriesController::class, 'create']);
    Route::get('/accessories/delete/{id}', [AccessoriesController::class, 'destroy']);
    Route::get('/accessories/edit/{id}', [AccessoriesController::class, 'edit']);
    Route::post('/accessories/update/{id}', [AccessoriesController::class, 'update']);
    Route::get('/accessories/show/{id}', [AccessoriesController::class, 'show']);
    //registeration

    //leather Router
    Route::resource('/leather', LeatherController::class);
    Route::get('/leather/create', [LeatherController::class, 'create']);
    Route::get('/leather/delete/{id}', [LeatherController::class, 'destroy']);
    Route::get('/leather/edit/{id}', [LeatherController::class, 'edit']);
    Route::post('/leather/update/{id}', [LeatherController::class, 'update']);
    Route::get('/leather/show/{id}', [LeatherController::class, 'show']);

    //Product Routes
    Route::resource('/product', ProductController::class);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::get('/product/show/{id}', [ProductController::class, 'show']);

    //venue Routes
    Route::middleware('permission:venues.list')->group(function(){
        Route::resource('/venue', VenueController::class);
        Route::get('/venue/create', [VenueController::class, 'create']);
        Route::get('/venue/delete/{id}', [VenueController::class, 'destroy']);
        Route::get('/venue/edit/{id}', [VenueController::class, 'edit']);
        Route::get('/venue/show/{id}', [VenueController::class, 'show']);
        Route::post('/venue/update/{id}', [VenueController::class, 'update']);
    });
    //purchase_leather
    Route::resource('/purchase_leather', Purchase_Leather_Controller::class);
    Route::get('/purchase_leather/create', [Purchase_Leather_Controller::class, 'create']);
    Route::get('/purchase_leather/delete/{id}', [Purchase_Leather_Controller::class, 'destroy']);
    Route::get('/purchase_leather/edit/{id}', [Purchase_Leather_Controller::class, 'edit']);
    Route::get('/purchase_leather/show/{id}', [Purchase_Leather_Controller::class, 'show']);
    Route::post('purchase_leather/update/{id}', [Purchase_Leather_Controller::class, 'update']);

    //purchase_accessories
    Route::resource('/purchase_accessories', Purchase_Accessories_Controller::class);
    Route::get('/purchase_accessories/create', [Purchase_Accessories_Controller::class, 'create']);
    Route::get('/purchase_accessories/delete/{id}', [Purchase_Accessories_Controller::class, 'destroy']);
    Route::get('/purchase_accessories/edit/{id}', [Purchase_Accessories_Controller::class, 'edit']);
    Route::get('/purchase_accessories/show/{id}', [Purchase_Accessories_Controller::class, 'show']);
    Route::post('/purchase_accessories/update/{id}', [Purchase_Accessories_Controller::class, 'update']);

    //accessories_inventory
    Route::resource('/accessories_inventory', Accessories_Inventory_Controller::class);
    Route::get('/accessories_inventory/create', [Accessories_Inventory_Controller::class, 'create']);
    Route::get('/accessories_inventory/delete/{id}', [Accessories_Inventory_Controller::class, 'destroy']);
    Route::get('/accessories_inventory/edit/{id}', [Accessories_Inventory_Controller::class, 'edit']);
    Route::get('/accessories_inventory/show/{id}', [Accessories_Inventory_Controller::class, 'show']);
    Route::post('/accessories_inventory/update/{id}', [Accessories_Inventory_Controller::class, 'update']);

    //leather_inventory
    Route::resource('/leather_inventory', Leather_Inventory_Controller::class);
    Route::get('/leather_inventory/create', [Leather_Inventory_Controller::class, 'create']);
    Route::get('/leather_inventory/delete/{id}', [Leather_Inventory_Controller::class, 'destroy']);
    Route::get('/leather_inventory/edit/{id}', [Leather_Inventory_Controller::class, 'edit']);
    Route::get('/leather_inventory/show/{id}', [Leather_Inventory_Controller::class, 'show']);
    Route::post('/leather_inventory/update/{id}', [Leather_Inventory_Controller::class, 'update']);

    //leather_vendor
    Route::resource('/leather_vendor', Leather_Vendor_Controller::class);
    Route::get('/leather_vendor/create', [Leather_Vendor_Controller::class, 'create']);
    Route::get('/leather_vendor/delete/{id}', [Leather_Vendor_Controller::class, 'destroy']);
    Route::get('/leather_vendor/edit/{id}', [Leather_Vendor_Controller::class, 'edit']);
    Route::get('/leather_vendor/show/{id}', [Leather_Vendor_Controller::class, 'show']);
    Route::post('/leather_vendor/update/{id}', [Leather_Vendor_Controller::class, 'update']);
    //leather_transaction
    Route::resource('/leather_transaction', Leather_Transaction_Controller::class);
    Route::get('/leather_transaction/show/{id}', [Leather_Transaction_Controller::class, 'show']);
    //leather_vendor_bill
    Route::resource('/leather_vendor_bill', Leather_Vendor_Bill_Controller::class);
    Route::get('/leather_vendor_bill/pay/{id}', [Leather_Vendor_Bill_Controller::class, 'pay']);

    //Menu Management
    Route::middleware('permission:menu.list')->group(function(){
        Route::resource('menu', Menu::class);
        Route::get('/menu/delete/{id}', [Menu::class, 'destroy']);
    });
    //user registeration
    Route::middleware('permission:users.list')->group(function () {
        Route::resource('users', User::class);
        Route::get('/users/delete/{id}', [User::class, 'destroy']);
    });
    //permission registeration
    Route::middleware('permission:permissions.list')->group(function () {
        Route::resource('/permissions', PermissionController::class);
        Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy']);
    });
});

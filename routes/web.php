<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ApplicationController;

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

Route::get('/', function() {
    return redirect('/home');
});

Route::get('/redirect', function() {
    $profile_id = auth()->user()->profile_id;

    if($profile_id === 5) {
        return redirect('/home');
    }

    return redirect('/dashboard');
})->middleware(['auth']);

Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
//Route::get('delete-cart', [CartController::class, 'destroy']);

Route::get('/home{any}', [HomeController::class, 'index'])->name('home')->where('any', '.*');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/filters', [HomeController::class, 'filters'])->name('filters');
Route::get('/user', [AuthController::class, 'getUser'])->middleware(['auth:sanctum']);
Route::get('/account/user', [AccountController::class, 'user'])->name('account.user')->middleware(['auth:sanctum']);
Route::put('/account/{user}/personal-info', [AccountController::class, 'updatePersonalInfo'])->name('account.update-personal-info')->middleware(['auth:sanctum']);
Route::post('/account/{user}/password', [AccountController::class, 'updatePassword'])->name('account.update-password')->middleware(['auth:sanctum']);
Route::get('/account/addresses', [AccountController::class, 'addresses'])->name('account.addresses')->middleware(['auth:sanctum']);
Route::post('/account/addresses', [AccountController::class, 'storeAddress'])->name('account.create-address')->middleware(['auth:sanctum']);
Route::put('/account/addresses/{address}', [AccountController::class, 'updateAddress'])->name('account.update-address')->middleware(['auth:sanctum']);
Route::delete('/account/addresses/{address}', [AccountController::class, 'destroyAddress'])->name('account.destroy-address')->middleware(['auth:sanctum']);
Route::get('/account/departments', [AccountController::class, 'departments'])->name('account.departments')->middleware(['auth:sanctum']);
Route::get('/account/towns', [AccountController::class, 'towns'])->name('account.towns')->middleware(['auth:sanctum']);

Route::get('/merchants/register', [MerchantController::class, 'register'])->name('register-merchant');
Route::post('/merchants/register/merchant-logo', [MerchantController::class, 'uploadLogo'])->name('merchant-logo');
Route::post('/merchants/register/avatar', [MerchantController::class, 'uploadAvatar'])->name('merchant-avatar');
Route::post('/merchants/register/id', [MerchantController::class, 'uploadId'])->name('merchant-id');

Route::get('/store/products/{product}', [StoreController::class, 'show'])->name('store.product');

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {
    Route::get('products/list', [ProductController::class, 'list'])->name('products.list');
    Route::post('products/image', [ProductController::class, 'uploadImage'])->name('products.upload-image');
    Route::get('products/images', [ProductController::class, 'images'])->name('products.images');
    Route::post('products/images', [ProductController::class, 'uploadImages'])->name('products.upload-images');
    Route::resource('products', ProductController::class);

    Route::get('applications/list', [ApplicationController::class, 'list'])->name('applications.list');
    Route::resource('applications', ApplicationController::class)->except(['create', 'edit']);

    Route::get('actions/list', [ActionController::class, 'list'])->name('actions.list');
    Route::resource('actions', ActionController::class)->except(['create', 'edit']);

    Route::get('profiles/list', [ProfileController::class, 'list'])->name('profiles.list');
    Route::resource('profiles', ProfileController::class)->except(['create', 'edit']);

    Route::get('users/list', [UserController::class, 'list'])->name('users.list');
    Route::resource('users', UserController::class)->except(['create', 'edit']);

    Route::get('attributes/search', [AttributeController::class, 'search'])->name('attributes.search');
    Route::get('attributes/list', [AttributeController::class, 'list'])->name('attributed.list');
    Route::get('attributes/select', [AttributeController::class, 'select'])->name('attributed.select');
    Route::post('attributes/{attribute}/values', [AttributeController::class, 'storeValue'])->name('attributes.store-value');
    Route::get('attributes/{attribute}/values', [AttributeController::class, 'values'])->name('attributes.values');
    Route::get('attributes/{id}/values/search', [AttributeController::class, 'searchValues'])->name('attributes.search-values');
    Route::get('attributes/{id}/values/list', [AttributeController::class, 'listValues'])->name('attributes.list-values');
    Route::resource('attributes', AttributeController::class)->except(['create', 'edit']);

    Route::get('commerce', [CommerceController::class, 'show'])->name('commerce.index');
    Route::put('commerce/{merchant}', [CommerceController::class, 'update'])->name('commerce.update');
    Route::post('commerce/{merchant}/accounts', [CommerceController::class, 'storeAccount'])->name('commerce.store-account');
    Route::post('commerce/{merchant}/logo', [CommerceController::class, 'uploadLogo'])->name('commerce.upload-logo');

    Route::get('merchants/list', [MerchantController::class, 'list'])->name('merchants.list');
    Route::resource('merchants', MerchantController::class)->except(['create', 'store', 'edit']);
});

Route::resource('dashboard', DashboardController::class)->middleware(['auth']);
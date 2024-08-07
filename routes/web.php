<?php

use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ClientProductController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\User;

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

// Route Client
Route::get('/', [ClientProductController::class, 'indexProduct'])->name('index');
Route::get('/shop', [ClientProductController::class, 'shopProduct'])->name('shop');
Route::get('/detail/{id}', [ClientProductController::class, 'productDetail'])->name('detail');
// Route::get('/my-account', function () {
//     return view('clients.my-account');
// })->name('my-account');
Route::get('/contact', function () {
    return view('clients.contact');
})->name('contact');
Route::get('/about', function () {
    return view('clients.about');
})->name('about');

// Route Order
// Route::get('/checkout', function () {
//     return view('clients.checkout');
// })->name('checkout');
Route::middleware('auth')->prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/',                [OrderController::class, 'index'])->name('index');
                Route::get('/create',          [OrderController::class, 'create'])->name('create');
                Route::post('/store',          [OrderController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [OrderController::class, 'show'])->name('show');
                Route::put('/{id}/update',     [OrderController::class, 'update'])->name('update');
            });




//Cart
Route::get('/list-cart',         [CartController::class, 'listCart'] )->name('cart.list');
Route::post('/add-cart',         [CartController::class, 'addCart'] )->name('cart.add');
Route::post('/update-cart',      [CartController::class, 'updateCart'] )->name('cart.update');




// Route Auth
Route::get('login',      [AuthController::class, 'showFormLogin']);
Route::post('login',     [AuthController::class, 'login'])->name('login');
Route::get('register',   [AuthController::class, 'showFormRegister']);
Route::post('register',  [AuthController::class, 'register'])->name('register');
Route::post('logout',    [AuthController::class, 'logout'])->name('logout');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route Amin
Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admins.dashboard');
        })->name('dashboard');
        // Route: Danh mục
        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/',                [CategoryController::class, 'index'])->name('index');
                Route::get('/create',          [CategoryController::class, 'create'])->name('create');
                Route::post('/store',          [CategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [CategoryController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [CategoryController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [CategoryController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
            });
            // Route: Sản phẩm
        Route::prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/',                [ProductController::class, 'index'])->name('index');
            Route::get('/create',          [ProductController::class, 'create'])->name('create');
            Route::post('/store',          [ProductController::class, 'store'])->name('store');
            Route::get('/show/{id}',       [ProductController::class, 'show'])->name('show');
            Route::get('/{id}/edit',       [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}/update',     [ProductController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
        });Route::prefix('users')
        ->as('users.')
        ->group(function () {
            Route::get('/',                [UserController::class, 'index'])->name('index');
            Route::get('/create',          [UserController::class, 'create'])->name('create');
            Route::post('/store',          [UserController::class, 'store'])->name('store');
            Route::get('/show/{id}',       [UserController::class, 'show'])->name('show');
            Route::get('/{id}/edit',       [UserController::class, 'edit'])->name('edit');
            Route::put('/{id}/update',     [UserController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('orders')
        ->as('orders.')
        ->group(function () {
            Route::get('/',                [AdminOrderController::class, 'index'])->name('index');
            Route::get('/show/{id}',       [AdminOrderController::class, 'show'])->name('show');
            Route::put('/{id}/update',     [AdminOrderController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [AdminOrderController::class, 'destroy'])->name('destroy');
        });
    });

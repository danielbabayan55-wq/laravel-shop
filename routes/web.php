<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');



Route::view('/about', 'about')->name('about');
Route::post('/about/feedback', function () {
    return back()->with('feedback', true);
});

Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', function () {
    return back()->with('sent', true);
});
Route::view('/news', 'news')->name('news');
Route::view('/news', 'news')->name('news');


Route::resource('products', ProductController::class);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

Route::resource('products', ProductController::class)->only(['index', 'show']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});

Route::get('/catalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalog');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/wishlist', [CartController::class, 'wishlist'])->name('wishlist.index');
Route::post('/wishlist/toggle', [CartController::class, 'toggleWishlist'])->name('wishlist.toggle');

Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/wishlist/clear', [CartController::class, 'clearWishlist'])->name('wishlist.clear');


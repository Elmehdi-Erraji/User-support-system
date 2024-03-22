<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth routes start here
Route::get('/register', [AuthController::class, 'RegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('showResetForm');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
// Auth routes endss here




Route::resource('users' , UsersController::class);
Route::resource('categories' , CategoriesController::class);
// Route::resource('faqs' , FaqsController::class);
Route::resource('department' , DepartmentsController::class);




Route::get('dashboard', function (){
    return view('dash');
})->name('dashboard');


// Route::get('users_index', function (){
//     return view('dashboard.admin.users.index');
// })->name('users_index');

// Route::get('users_edit', function (){
//     return view('dashboard.admin.users.edit');
// })->name('users_edit');




Route::get('home', function (){
    return view('home');
})->name('home');

Route::get('about', function (){
    return view('about');
})->name('about');


Route::get('contact', function (){
    return view('contact');
})->name('contact');


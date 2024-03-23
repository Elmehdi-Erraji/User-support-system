<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TickesController;
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

//departments routes start here
Route::resource('department' , DepartmentsController::class);
Route::put('department/{id}/restore', [DepartmentsController::class , 'restore'])->name('department.restore');
Route::delete('departments/{id}/force-delete',[DepartmentsController::class , 'forceDelete'])->name('department.forceDelete');
//departments routes ends here

//categories routes start here
Route::resource('categories' , CategoriesController::class);
//categories routes ends here

//users routes start here
Route::resource('users' , UsersController::class);
Route::put('users/{user}/restore', [UsersController::class, 'restore'])->name('users.restore');
Route::delete('users/{user}/force-delete', [UsersController::class, 'forceDelete'])->name('users.force-delete');
//users routes ends here


Route::resource('Faq', FaqController::class);

Route::resource('ticket', TickesController::class);















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


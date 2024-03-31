<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\TickesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Client\TicketsController as ClientTicketsController;
use App\Http\Controllers\Agent\TicketsController as AgentTicketsController;
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

// Route::get('dashboard', function (){
//     return view('dashboard.admin.dashboard');
// })->name('dashboard');


Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');



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
Route::get('clinets_list', [UsersController::class, 'clientsList'])->name('clinets_list');
Route::get('agent_show/{id}', [UsersController::class, 'agentShow'])->name('agent_show');
//users routes ends here

//Faq's routes start here
Route::resource('Faq', AdminFaqController::class);
//Faq's routes ends here

//tickets routes start here
Route::resource('ticket', TickesController::class);
Route::put('/tickets/{id}/restore', [TickesController::class , 'restore'])->name('tickets.restore');
Route::delete('/tickets/{id}/force-delete', [TickesController::class , 'forceDelete'])->name('tickets.force-delete');
//tickets routes ends here


Route::resource('profile', ProfileController::class);
Route::put('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');



Route::resource('client_ticket', ClientTicketsController::class);





Route::get('agent_dashboard', [AgentDashboardController::class,'index']);
Route::resource('agent_ticket', AgentTicketsController::class);




// Route::middleware(['admin'])->group(function () {
  
// });
// Route::middleware(['agent'])->group(function () {
  
// });
// Route::middleware(['client'])->group(function () {
  
// });
// Route::middleware(['auth'])->group(function () {
  
// });



Route::post('/users/search', [UsersController::class, 'search'])->name('users.search');
Route::post('clinets_search', [UsersController::class, 'clientSearch'])->name('clients.search');
Route::post('categories_search', [CategoriesController::class, 'search'])->name('categories.search');
Route::post('department_search' , [DepartmentsController::class,'search'])->name('departments.search');



Route::post('Faq_search', [AdminFaqController::class,'search'])->name('faq.search');





Route::get('FaqHome', [FaqController::class,'index'])->name('FaqHome');



// Route::get('FaqHome', function (){
//     return view('dashboard.faqAll');
// })->name('FaqHome');













Route::get('home', function (){
    return view('home');
})->name('home');

Route::get('about', function (){
    return view('about');
})->name('about');


Route::get('contact', function (){
    return view('contact');
})->name('contact');


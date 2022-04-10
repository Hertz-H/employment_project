<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPagController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
 

/**----------------------
 *    front rootes
 *------------------------**/
Route::get('/home',[HomeController::class,"load"]);

Route::get('/jobs',[JobPagController::class,"load"]);
Route::get('/jobDetails',[JobPagController::class,"loadDetails"]);

Route::get('/companies',[CompanyController::class,"load"]);
Route::get('/services',[ServiceController::class,"load"]);

Route::get('/contact',[ContactController::class,"load"]);
Route::get('/about',[AboutController::class,"load"]);

Route::get('/signup',[UserController::class,"signup"]);
Route::post('/signup',[UserController::class,"register"])->name('signUser');

Route::get('/login',[UserController::class,"login"]);
Route::post('/login',[UserController::class,"doLogin"])->name('doLogin');

// Route::get('/update_service',[ServiceController::class,"updatePage"]);

 /**----------------------
  *    admin  operations
  *------------------------**/

Route::group(['middleware'=>'auth'],function(){
    
	Route::group(['middleware'=>'role:admin'],function(){

  /**----------------------
 *    Service Routes
 *------------------------**/ 
        
        Route::get('/add_service',[ServiceController::class,"loadAdd"]);
        Route::get('/list_services',[ServiceController::class,"list"]);
        Route::get('/update_service/{id}',[ServiceController::class,"updatePage"]);
        Route::post('/update_service',[ServiceController::class,"update"])->name('save_update');
        Route::get('/activate_service/{id}/{active}',[ServiceController::class,"activate"]);
        Route::post('/add_service',[ServiceController::class,"add"])->name('save_service');
  /**----------------------
 *    Ad Routes
 *------------------------**/      

        Route::post('/add_ad',[AdController::class,"add"])->name('save_ad');
        Route::get('/add_ad',[AdController::class,"loadAdd"]);
        Route::get('/list_ads',[AdController::class,"list"]);
        Route::get('/update_ad/{id}',[AdController::class,"updatePage"]);
        Route::post('/update_ad',[AdController::class,"update"])->name('updateAd');
        Route::get('/activate_ad/{id}/{active}',[AdController::class,"activate"]);
        
/**----------------------
 *    Company Routes
 *------------------------**/
        
        Route::post('/add_company',[ServiceController::class,"add"])->name('save_company');
        Route::get('/add_company',[CompanyController::class,"loadAdd"]);
        Route::post('/add_company',[CompanyController::class,"add"])->name('save_company');
        Route::get('/list_companies',[CompanyController::class,"list"]);
        Route::get('/update_company/{id}',[CompanyController::class,"updatePage"]);
        Route::post('/update_company',[CompanyController::class,"update"])->name('updateCompany');
        Route::get('/activate_company/{id}/{active}',[CompanyController::class,"activate"]);
        
/**----------------------
 *    Job  Routes
 *------------------------**/
        Route::get('/add_job',[JobPagController::class,"loadAdd"]);
        Route::post('/add_job',[JobPagController::class,"add"])->name('save_job');
        Route::get('/list_jobs',[JobPagController::class,"list"]);
        Route::get('/update_job/{id}',[JobPagController::class,"updatePage"]);
        Route::post('/update_job',[JobPagController::class,"update"])->name('updatejob');
        Route::get('/activate_job/{id}/{active}',[JobPagController::class,"activate"]);
  
	});
	

    /**----------------------
  *    Change password
  *------------------------**/
Route::get('/change-password', [HomeController::class, 'changePassword']);
Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('update_password');


 /**----------------------
  *   log out
  *------------------------**/
Route::get('/logout',[UserController::class,'logout'])->name('logout');
	
});


Route::get('/dashboard',function(){
    return view("dashboard.user.dashboard");
});
// Route::get('/logout',[UserController::class,"logout"]);

 








Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// Route::get('/log',function(){
//     return view("auth.log_in");
// });

// Route::get('/log',function(){
//     return view("auth_2.log");
// });

// Route::get('/email',function(){
//     return view("auth.email");
// });
// Route::get('/reset',function(){
//     return view("auth.reset");
// });

// Route::get('/confirm',function(){
//     return view("auth.confirm");
// });



// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');



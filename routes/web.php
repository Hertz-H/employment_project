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

Route::get('/index',[HomeController::class,"load"]);
Route::get('/jobs',[JobPagController::class,"load"]);
Route::get('/jobDetails',[JobPagController::class,"loadDetails"]);
Route::get('/companies',[CompanyController::class,"load"]);
Route::get('/contact',[ContactController::class,"load"]);
Route::get('/about',[AboutController::class,"load"]);
Route::get('/signup',[UserController::class,"signup"]);
Route::post('/signup',[UserController::class,"register"])->name('signUser');



Route::get('/login',[UserController::class,"login"]);
Route::get('/add_service',[ServiceController::class,"loadAdd"]);
Route::get('/services',[ServiceController::class,"load"]);
Route::get('/services',[ServiceController::class,"load"]);
Route::get('/list_services',[ServiceController::class,"list"]);
Route::get('/update_service',[ServiceController::class,"updatePage"]);
Route::get('/update_service/{id}',[ServiceController::class,"updatePage"]);
Route::post('/update_service',[ServiceController::class,"update"])->name('save_update');
Route::get('/activate_service/{id}/{active}',[ServiceController::class,"activate"]);

Route::post('/add_service',[ServiceController::class,"add"])->name('save_service');

Route::post('/add_ad',[AdController::class,"add"])->name('save_ad');
Route::get('/add_ad',[AdController::class,"loadAdd"]);
Route::get('/list_ads',[AdController::class,"list"]);


Route::post('/add_company',[ServiceController::class,"add"])->name('save_company');
Route::get('/add_company',[CompanyController::class,"loadAdd"]);
Route::post('/add_company',[CompanyController::class,"add"])->name('save_company');
Route::get('/list_companies',[CompanyController::class,"list"]);
Route::get('/update_company/{id}',[CompanyController::class,"updatePage"]);
Route::post('/update_company',[CompanyController::class,"update"])->name('updateCompany');
Route::get('/activate_company/{id}/{active}',[CompanyController::class,"activate"]);

Route::get('/add_job',[JobPagController::class,"loadAdd"]);
Route::post('/add_job',[JobPagController::class,"add"])->name('save_job');
Route::get('/list_jobs',[JobPagController::class,"list"]);
Route::get('/update_job/{id}',[JobPagController::class,"updatePage"]);
Route::post('/update_job',[JobPagController::class,"update"])->name('updatejob');
Route::get('/activate_job/{id}/{active}',[JobPagController::class,"activate"]);





Route::get('/dashboard',function(){
    return view("dashboard.user.dashboard");
});
// Route::get('/add_services',function(){
//     return view("dashboard.services");
// });

// Route::get('/add_about',function(){
//     return view("dashboard.about");
// });
// // Route::get('/add_job',function(){
// //     return view("dashboard.job");
// // });
// Route::get('/add_adds',function(){
//     return view("dashboard.job");
// });

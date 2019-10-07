<?php

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
Auth::routes();
Route::get('/', function () {
    return redirect('login');
});
Route::get('logout', 'Auth\LoginController@logout');
Route::get('password_request', 'Auth\LoginController@forgotPassword');
Route::post('password_request/send', 'Auth\LoginController@passwordRequest');

 

// Corn Jobs
Route::get('hr/payroll/promotion-jobs', 'Hr\Recruitment\BenefitController@promotionJobs');
Route::get('hr/payroll/increment-jobs', 'Hr\Recruitment\BenefitController@incrementJobs');
Route::get('hr/timeattendance/shift-jobs', 'Hr\TimeAttendance\ShiftRoasterController@shiftJobs');


Route::group(['middleware' => 'auth'], function(){ 
	Route::get('dashboard', 'DashboardController@index'); 
	//---------USER MANAGEMENT-----------//
	Route::get('users_management/users', 'Users_Management\UsersController@index');
	Route::post('users_management/user/data', 'Users_Management\UsersController@getUserData');
	Route::get('users_management/user/create', 'Users_Management\UsersController@create');
	Route::post('users_management/user/create', 'Users_Management\UsersController@store');
	Route::get('users_management/user/edit/{id}', 'Users_Management\UsersController@edit');
	Route::post('users_management/user/edit/{id}', 'Users_Management\UsersController@update'); 
	Route::get('users_management/user/delete/{id}', 'Users_Management\UsersController@destroy');
	Route::get('system-all-user-dropdown-list', 'Users_Management\UsersController@userDropdown');
	Route::get('users_management/permissions', 'Users_Management\PermissionsController@index');
	Route::post('users_management/permissions/store', 'Users_Management\PermissionsController@store');
	Route::get('users_management/permissions/edit/{id}', 'Users_Management\PermissionsController@edit');
	Route::post('users_management/permissions/edit/{id}', 'Users_Management\PermissionsController@update');
	Route::get('users_management/permissions/delete/{id}', 'Users_Management\PermissionsController@destroy');
	Route::get('users_management/roles', 'Users_Management\RolesController@index');
	Route::post('users_management/roles/store', 'Users_Management\RolesController@store');
	Route::get('users_management/roles/edit/{id}', 'Users_Management\RolesController@edit');
	Route::post('users_management/roles/edit/{id}', 'Users_Management\RolesController@update');
	Route::get('users_management/roles/delete/{id}', 'Users_Management\RolesController@destroy'); 

	//---------MODULES-----------//
	// hr routes
	include 'modules/hr.php';
	// merch routes
	include 'modules/merch.php';
	// merch routes
	include 'modules/commercial.php';
	// Planning routes
	include 'modules/planning.php';
	// Planning routes
	include 'modules/manufacturing.php';
	// Planning routes
	include 'modules/wash.php';
	// Planning routes
	include 'modules/store.php';
	// Planning routes
	include 'modules/csr.php';
	// Planning routes
	include 'modules/compliance.php';
	// Planning routes
	include 'modules/account_finance.php';
});
 
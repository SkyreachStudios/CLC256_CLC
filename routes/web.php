<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('loginForm');
});

Route::get('/loginForm',function(){

    return view('loginForm');

});


Route::get('/home','LoginController@home');


Route::post('/adminUpdate', 'adminController@update');
Route::post('/adminDelete', 'adminController@delete');


Route::post('/dologin','LoginController@index');
Route::post('/doEdit','editCOntroller@editData');

Route::get('/edit', 'editController@index');

Route::get('/login',function(){return view('login');});
Route::get('/adminDashboard','adminController@index');

Route::post('/doregister','RegistrationController@index');
Route::get('/register',function(){return view('register');});

//employment routes
Route::post('/updateEmploymentData','editController@updateEmploymentData');
Route::post('/deleteEmployer','editController@deleteEmploymentData');
Route::post('/addEmployer','editController@addEmploymentData');

//skill routes
Route::post('/updateSkill','editController@updateSkill');
Route::post('/deleteSkill','editController@deleteSkill');
Route::post('/addSkill','editController@addSkill');

Route::get('/jobs','jobsController@index');
Route::post('/updateJob','jobsController@updateJob');
Route::post('/deleteJob','jobsController@deleteJob');
Route::post('/addJob','jobsController@addJob');
Route::post('/searchJobs','jobsController@searchJob');
Route::post('/apply', 'jobsController@apply');
Route::post('/submitApply','jobsController@submitApply');

Route::get('/groups','groupsController@index');
Route::post('/updateGroup','groupsController@updateGroup');
Route::post('/deleteGroup','groupsController@deleteGroup');
Route::post('/addGroup','groupsController@addGroup');
Route::post('/visitPage','groupsController@visitPage');
Route::post('/joinGroup','groupsController@joinGroup');
Route::post('/leaveGroup','groupsController@leaveGroup');

Route::resource('/rest', 'RestController');




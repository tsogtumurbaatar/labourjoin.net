<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// Route::get('/', function () {
//     return view('/home');   
// }); 
Route::get('/', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/workers', 'HomeController@workers');
Route::get('/companies', 'HomeController@companies');
Route::get('/jobs', 'HomeController@jobs');
Route::get('/requests', 'HomeController@requests');
Route::get('/requestsforagenta', 'HomeController@requestsforagenta');
Route::get('/requestsforagentb', 'HomeController@requestsforagentb');
Route::get('/jobrequestconf/{id}', 'HomeController@confirmJobRequest')->name('confirmjobreq');
Route::get('/reportsagent', 'ReportController@indexagent');
Route::post('/generatedreport', 'ReportController@generate');

//-----------------APIs---------------------

Route::get('/api/workers', 'WorkersController@index');
Route::post('/api/workers', 'WorkersController@store');
Route::post('/api/workersput', 'WorkersController@update');
Route::post('/api/workerschange', 'WorkersController@changestatus');
Route::post('/api/workersdelete', 'WorkersController@deleteworker');

Route::get('/api/companies', 'CompaniesController@index');
Route::post('/api/companies', 'CompaniesController@store');
Route::post('/api/companiesput', 'CompaniesController@update');
Route::post('/api/companieschange', 'CompaniesController@changestatus');
Route::post('/api/companiesdelete', 'CompaniesController@deletecompany');

Route::get('/api/jobs', 'JobsController@index');
Route::post('/api/jobs', 'JobsController@store');
Route::post('/api/jobsdelete', 'JobsController@deletejob');

Route::get('/api/requests', 'RequestController@index');
Route::get('/api/requestsforagenta', 'RequestController@indexforagenta');
Route::get('/api/requestsforagentb', 'RequestController@indexforagentb');


Route::post('/api/workersforagent', 'RequestController@listforagent');

Route::post('/api/requestchange', 'RequestController@changestatus');

Route::post('/api/infoforworker', 'RequestController@infoforworker');
Route::post('/api/infofortime', 'RequestController@infofortime');
Route::post('/api/saveworkertime', 'RequestController@saveworkertime');


Route::post('/api/requests', 'RequestController@store');
Route::post('/api/agentsentrequest', 'RequestController@agentsentrequest');
Route::post('/api/agentassign', 'RequestController@agentassign');
Route::post('/api/requestsdelete', 'RequestController@deleterequest');


// http://itsolutionstuff.com/post/laravel-52-and-angularjs-crud-with-search-and-pagination-exampleexample.html



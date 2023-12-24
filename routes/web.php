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
    return view('welcome');
});

Route::group(['prefix'=>'admin','namespace'=> 'Admin'], function () {
    Route::get('/','MainController@index')->name('admin.index');
    Route::resource('/dormitories', 'DormitoryController');
    Route::resource('/condition_rooms', 'ConditionController');
    Route::resource('/rooms', 'RoomController');
    Route::resource('/posts', 'PostController');
    Route::resource('/staff', 'StaffController');
    Route::resource('/properties', 'PropertyController');
    Route::resource('/students', 'StudentController');
    Route::resource('/types_applications', 'TypeApplicationController');
    Route::resource('/applications', 'ApplicationController');
    Route::resource('/washing_machines', 'WashingMachineController');
    Route::resource('/laundries', 'LaundryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/news', 'NewController');
});

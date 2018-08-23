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


Route::resource('reports', 'CamerasController')->middleware('auth');

Route::redirect('/', '/reports' )->middleware('auth');

Route::get('profil', function() {
    return view('myprofil');
})->middleware('auth');


Route::get('livecams', function () {
    return view('livecamera');
})->middleware('auth');

// Route::get('/', function () {
//     return view('report');
// })->middleware('auth');

// Route::get('profil', function () {
//     return view('myprofil');
// });

// Route::get('welcome', function () {
//     return view('welcome');
// });
Route::get('/reports/excel', 'CamerasController@excel')->name('reports.excel')->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//
// Route::get('/profil', 'HomeController@profil')->name('profil');

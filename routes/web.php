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

#isautenticatedonly
/*
Route::group([
    'middleware' => ['auth'],
], function() {
    Auth::routes();
    Route::get('/', function () {
        return view('dashboard');
    });
    #Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
   
});*/


Auth::routes();

#dashboard items
Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');

#pacients
Route::get('pacients', 'PacientController@index')->name('pacients');
Route::get('pacients/add', array('as' => 'pacients.add', 'uses' => 'PacientController@create'));
Route::post('pacients/store', array('as' => 'pacients.store', 'uses' => 'PacientController@store'));
Route::get('pacients/edit/{id}', array('as' => 'pacients.edit', 'uses' => 'PacientController@edit'));
Route::post('pacients/update/{id}', array('as' => 'pacients.update', 'uses' => 'PacientController@update'));
Route::get('pacients/delete/{id}', array('as' => 'pacients.destroy', 'uses' => 'PacientController@destroy'));
Route::get('pacients/{id}', array('as' => 'pacients.show', 'uses' => 'PacientController@show'));

#consults
Route::get('consults', 'ConsultsController@index')->name('consults');
Route::get('consults/add', array('as' => 'consults.add', 'uses' => 'ConsultsController@create'));
Route::post('consults/store', array('as' => 'consults.store', 'uses' => 'ConsultsController@store'));
Route::get('consults/edit/{id}', array('as' => 'consults.edit', 'uses' => 'ConsultsController@edit'));
Route::post('consults/update/{id}', array('as' => 'consults.update', 'uses' => 'ConsultsController@update'));
Route::get('consults/delete/{id}', array('as' => 'consults.destroy', 'uses' => 'ConsultsController@destroy'));
Route::get('consults/{id}', array('as' => 'consults.show', 'uses' => 'ConsultsController@show'));

#programari
Route::get('program', 'ProgramariController@index')->name('program');
Route::get('program/add', array('as' => 'program.add', 'uses' => 'ProgramariController@create'));
Route::post('program/store', array('as' => 'program.store', 'uses' => 'ProgramariController@store'));
Route::get('program/edit/{id}', array('as' => 'program.edit', 'uses' => 'ProgramariController@edit'));
Route::post('program/update/{id}', array('as' => 'program.update', 'uses' => 'ProgramariController@update'));
Route::get('program/delete/{id}', array('as' => 'program.destroy', 'uses' => 'ProgramariController@destroy'));
Route::get('program/{id}', array('as' => 'program.show', 'uses' => 'ProgramariController@show'));

#concedii
Route::get('concedii', 'ConcediimedicaleController@index')->name('concedii');
Route::get('concedii/add', array('as' => 'concedii.add', 'uses' => 'ConcediimedicaleController@create'));
Route::post('concedii/store', array('as' => 'concedii.store', 'uses' => 'ConcediimedicaleController@store'));
Route::get('concedii/edit/{id}', array('as' => 'concedii.edit', 'uses' => 'ConcediimedicaleController@edit'));
Route::post('concedii/update/{id}', array('as' => 'concedii.update', 'uses' => 'ConcediimedicaleController@update'));
Route::get('concedii/delete/{id}', array('as' => 'concedii.destroy', 'uses' => 'ConcediimedicaleController@destroy'));
Route::get('concedii/{id}', array('as' => 'concedii.show', 'uses' => 'ConcediimedicaleController@show'));


#users
Route::get('users', 'UserController@index')->name('users');
Route::get('users/add', array('as' => 'users.add', 'uses' => 'UserController@create'));
Route::post('users/store', array('as' => 'users.store', 'uses' => 'UserController@store'));
Route::get('users/edit/{id}', array('as' => 'users.edit', 'uses' => 'UserController@edit'));
Route::post('users/update/{id}', array('as' => 'users.update', 'uses' => 'UserController@update'));
Route::get('users/changepassword/{id}', array('as' => 'users.updatepass', 'uses' => 'UserController@updatepassword'));
Route::post('users/storepassword/{id}', array('as' => 'users.storepassword', 'uses' => 'UserController@storepassword'));
Route::get('users/delete/{id}', array('as' => 'users.destroy', 'uses' => 'UserController@destroy'));
Route::get('users/{id}', array('as' => 'users.show', 'uses' => 'UserController@show'));

#reports
Route::get('/raports/concedii', array('as' => 'raports.concedii', 'uses'=>'RaportsController@indexconcedii'));
Route::post('/raports/concedii', array('as' => 'raports.concedii', 'uses'=>'RaportsController@indexconcedii'));
Route::get('/raports/boli', array('as' => 'raports.boli', 'uses'=>'RaportsController@indexboli'));
Route::post('/raports/boli', array('as' => 'raports.boli', 'uses'=>'RaportsController@indexboli'));
Route::get('/raports/pacienti', array('as' => 'raports.pacienti', 'uses'=>'RaportsController@indexpacient'));
Route::post('/raports/pacienti', array('as' => 'raports.pacienti', 'uses'=>'RaportsController@indexpacient'));

Route::post('/raports/concedii/pdf', array('as' => 'raports.concedii.pdf', 'uses'=>'RaportsController@displayReport'));
Route::post('/raports/boli/pdf', array('as' => 'raports.boli.pdf', 'uses'=>'RaportsController@displayReport1'));

#ws
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses'=>'PacientController@autocomplete'));
Route::get('/eventscomplete', array('as' => 'eventscomplete', 'uses'=>'ProgramariController@eventscomplete'));
Route::get('/autousername/{pacientid}', array('as' => 'autousername', 'uses'=>'PacientController@autousername'));
Route::get('/concediiconsult', array('as' => 'eventscomplete', 'uses'=>'ConcediimedicaleController@ws_concediiconsult'));
Route::get('/doctorslist', array('as' => 'doctorslist', 'uses'=>'UserController@autocomplete'));
Route::get('/autodoctorname/{medicid}', array('as' => 'autodoctorname', 'uses'=>'UserController@autousername'));
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

#test
Route::get('test', 'TestController@index');
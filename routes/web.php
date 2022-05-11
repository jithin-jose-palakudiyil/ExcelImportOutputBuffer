<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Constants variables
|--------------------------------------------------------------------------
|
| Here is where you can register Constants variables for your application. These
| variables are loaded by the application. Now create something great!
|
*/


define("token", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTA3NTIyNTIsImV4cCI6MTYxOTM5MjI1MiwidHlwZSI6ImV4Y2VsLWFwaS1hY2Nlc3MtdG9rZW4iLCJwcml2aWxhZ2VzIjoicHJvZHVjdC1saXN0aW5nIiwic2VjdGlvbnMiOiJhZGQtcHJvZHVjdCxhZGQtc2VyaWVzLGFkZC1saXN0aW5nIn0.wDKJNoR-CDHkH24i6H7tkX1engY2IVRd3Z-SE5cMC6g");

 
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

    define("meezzaa_prefix", "/");
    define("meezzaa_guard", "meezzaa");

    Route::group([ 'middleware' => 'preventBackHistory','prefix' => meezzaa_prefix], function()
    {
        Route::get('/', 'LoginMemberController@index')->name('meezzaa_login');
        Route::post('/meezzaa_login', 'LoginMemberController@login')->name('meezzaa_post_login');

        Route::group(['middleware' => ['meezzaa_auth:'.meezzaa_guard] ], function()
        {
            Route::get('/dashboard', 'ExcelImportController@index')->name('import_index');
            Route::post('/import', 'ExcelImportController@import')->name('import');
//            Route::any('/ajax-data', 'ExcelImportController@allQueue')->name('allQueue'); 
            Route::get('/meezzaa_logout', 'LoginMemberController@logout')->name('meezzaa_logout');
            Route::get('/change-password', 'ChangePasswordController@index')->name('change_password');
            Route::post('/change-password-update', 'ChangePasswordController@update')->name('change_password_update');
            
            Route::get('/log', 'LogController@index')->name('log_index');
            Route::get('/get_log', 'LogController@get_log')->name('get_log');
            
            Route::get('/export', 'ExportController@index')->name('export_index');
           
             
        });
    });
 
    
    
    Route::group(['prefix' => meezzaa_prefix], function()
    {
        Route::group(['middleware' =>  'meezzaa_auth:'.meezzaa_guard], function()
        {
            Route::get('download-log/{queue_id}', 'ExcelImportController@download_export')->name('download_register_group');
            Route::post('/export-save', 'ExportController@save')->name('export_save');
           
        });
    });


/*
|--------------------------------------------------------------------------
|Admin  Routes
|--------------------------------------------------------------------------
*/
    define("meezzaa_admin_prefix", "meezzaa_admin");
    define("meezzaa_admin_guard", "meezzaa_admin");
 
    Route::group([ 'middleware' => 'preventBackHistory','prefix' => meezzaa_admin_prefix], function()
    {
        Route::get('/', 'LoginController@index')->name('meezzaa_admin');
        Route::post('/meezzaa_admin_login', 'LoginController@login')->name('meezzaa_admin_login');


        Route::group(['middleware' => ['meezzaa_admin_auth:'.meezzaa_admin_guard] ], function()
        { 
            Route::get('/meezzaa_admin_dashboard', 'LoginController@dashboard')->name('meezzaa_admin_dashboard');
            Route::get('/meezzaa_admin_logout', 'LoginController@logout')->name('meezzaa_admin_logout'); 
            Route::post('/meezzaa_admin_user_creation', 'UserController@store')->name('meezzaa_admin_user_creation');
            Route::post('/meezzaa_admin_user_updation/{id}', 'UserController@update')->name('meezzaa_admin_user_updation');
            Route::get('/meezzaa_admin_user_deletion/{id}', 'UserController@destroy')->name('meezzaa_admin_user_deletion');


        });





    });
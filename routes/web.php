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

Route::get('/', function () {
    return view('auth.custom_login');
})->name('custom.login');

Route::get('/panduan', 'UtilitiesController@userManual')->name('user.manual');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'password'], function () {
    Route::get('forget', 'PasswordController@showEmailValidation')->name('password.forget');
    Route::post('validate', 'PasswordController@validateUser')->name('password.validate');
    Route::post('reset', 'PasswordController@reset')->name('password.reset');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');
    // File and Folder
    Route::group(['namespace' => 'File', 'prefix' => 'manage'], function () {

        Route::group(['prefix' => 'folder'], function () {
            Route::post('create', 'FolderController@createFolder')->name('folder.create');
            Route::post('rename', 'FolderController@rename')->name('folder.rename');
            Route::post('delete', 'FolderController@deleteFolder')->name('folder.delete');
            Route::match(['get', 'post'], 'next', 'FolderController@next')->name('folder.next');
            Route::match(['get', 'post'], 'back', 'FolderController@back')->name('folder.back');
        });

        Route::group(['prefix' => 'file'], function () {
            Route::get('shared', 'FileController@sharedFiles')->name('file.shared');
            Route::get('unit', 'FileController@unitFiles')->name('file.unit');
            // Route::post('upload', 'FileController@upload')->name('file.upload');
            Route::get('download', 'FileController@download')->name('file.download');
            Route::post('rename', 'FileController@rename')->name('file.rename');
            Route::post('delete', 'FileController@delete')->name('file.delete');

            // Route::get('multi-upload', 'FileController@multi')->name('file.multi');
            Route::post('file-multi-upload', 'FileController@multiUpload')->name('file.multi.upload');
            Route::post('update-keterangan', 'FileController@updateKeterangan')->name('file.keterangan.update');
        });

        Route::post('status', 'FileController@changeSharedStatus')->name('status.change');
    });

    // Master Data
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
        Route::resource('unit', 'UnitController');
        Route::resource('jabatan', 'JabatanController');
        Route::resource('user', 'UserController');
        Route::get('log', 'LogController@index')->name('log.index');
        Route::get('akses', 'PermissionController@index')->name('akses.index');
        Route::post('akses/update', 'PermissionController@updateAkses')->name('akses.update');
    });

    // Global Search
    Route::post('search', 'UtilitiesController@search')->name('search');
    Route::match(['get', 'post'], 'to', 'UtilitiesController@toDestination')->name('toDestination');

    // Change Password
    Route::group(['prefix' => 'setting'], function () {
        Route::get('change-password', 'PasswordController@showChangePasswordForm')->name('password.form');
        Route::post('change', 'PasswordController@change')->name('password.change');
    });

    // get detail
    Route::match(['get', 'post'], 'detail', 'UtilitiesController@detail')->name('file.detail');
});

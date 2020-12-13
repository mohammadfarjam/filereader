<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['preventbackbutton','auth']], function () {
    Route::get('/', 'Frontend\HomeController@index');
    Route::post('get_evidence', 'Backend\GetEvidenceController@getevidence')->name('get.evidence');
    Route::post('upload_image', 'Frontend\UploadImageController@upload_image')->name('upload.image');
    Route::post('store', 'Frontend\HomeController@store')->name('store');
    Route::post('read_storage', 'Frontend\HomeController@readstorage')->name('read.storage');
    Route::post('re', 'Frontend\HomeController@re')->name('re');
    Route::post('delete_finalImage', 'Frontend\HomeController@deleteFinalImage')->name('delete.finalImage');
    Route::post('delete_upload_photos', 'Frontend\HomeController@deleteUploadPhotos')->name('delete.upload.photos');
    Route::post('delete_upload_photos_after_confirm', 'Frontend\HomeController@deletePhotosAfterConfirm')->name('delete.Photos.After.Confirm');

    Route::post('read_storage_final', 'Frontend\HomeController@readstorageFinal')->name('read.storage.final');

    Route::post('continue_ducument', 'Frontend\HomeController@continueDocument')->name('continue.document');

    Route::post('delete_file_by_user', 'Frontend\HomeController@deleteFileByUser')->name('delete.file.by.user');

    Route::post('checkFolder', 'Frontend\HomeController@checkFolder')->name('check.folder');

    Route::post('code_samab', 'Frontend\HomeController@getCodeSamab')->name('get.samab');
    Route::post('overview', 'Frontend\HomeController@overView')->name('overView');
    Route::post('access_upload', 'Frontend\HomeController@accessUpload')->name('access.upload');
    Route::post('one_over_view', 'Frontend\HomeController@OneOverView')->name('oneOverView');
    Route::post('info_edit', 'Frontend\HomeController@InfoEdit')->name('info.edit');
    Route::get('edit', 'Frontend\HomeController@edit')->name('edit');
    Route::post('edit_save', 'Frontend\HomeController@edit_save')->name('edit.save');
    Route::post('sum_total_count', 'Frontend\HomeController@sum_total_count')->name('sum.total.count');
});
Route::get('reset', 'Frontend\HomeController@reset')->name('reset');
Route::post('resetPa','Frontend\HomeController@resetPass')->name('reset.pa');

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth','isAdmin']], function () {
    Route::prefix('/adm')->group(function () {
        Route::get('/', 'Backend\MainController@index');
        Route::get('details', 'Backend\MainController@detail')->name('details');
        Route::get('report_upload', 'Backend\MainController@report')->name('report.upload');
        Route::get('compare_date', 'Backend\MainController@compare_date')->name('compare.date');
        Route::post('get_user_upload', 'Backend\MainController@count_upload_user')->name('get.user.upload');
        Route::get('report_upload_daily', 'Backend\MainController@report_upload_daily')->name('report.upload.daily');
        Route::get('report_daily', 'Backend\MainController@report_daily')->name('report.daily');
    });
    });

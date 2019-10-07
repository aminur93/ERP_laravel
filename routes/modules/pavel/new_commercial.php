<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/27/2019
 * Time: 11:54 AM
 */

/*---------------------New Import Data Entry Routes --------------------------*/
Route::get('comm/newimportdata','Commercial\Import\NewImportData\NewImportController@index');
Route::get('comm/import/importdata/importcode','Commercial\Import\NewImportData\NewImportController@autocode');
Route::post('comm/import/importdata/voyage','Commercial\Import\NewImportData\NewImportController@vesselVoyage');
Route::get('comm/import/importdata/fileUnit','Commercial\Import\NewImportData\NewImportController@fileUnit');
Route::get('comm/import/importdata/supplierIlcNo','Commercial\Import\NewImportData\NewImportController@supplierIlcNo');
Route::get('comm/pi_no/{id}','Commercial\Import\NewImportData\NewImportController@piNo');
Route::get('comm/Pi_bom/{id}','Commercial\Import\NewImportData\NewImportController@piBom');
Route::get('comm/pidate','Commercial\Import\NewImportData\NewImportController@piDate');
Route::post('comm/newimportstore','Commercial\Import\NewImportData\NewImportController@store');

/*---------------------New Chalan Data Entry Routes---------------------------*/

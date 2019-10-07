<?php 
	// route file
	Route::group(['prefix' => 'comm/import','namespace' => 'Commercial\Xinnah\Import'], function(){

		//pass book and volume number entry section

		Route::get('pass-book-and-volume-number', 'PassBookVolumeNumberController@index');
		Route::get('pass-book-and-volume-number-list', 'PassBookVolumeNumberController@listOfPassbookVolume');
		Route::get('pass-book-and-volume-number-list-data', 'PassBookVolumeNumberController@listOfPassbookVolumeData');
		Route::get('passbook-and-volume-number-check', 'PassBookVolumeNumberController@checkDataLoad');
		Route::post('pass-book-and-volume-save', 'PassBookVolumeNumberController@saveData');
		Route::post('pass-book-and-volume-action', 'PassBookVolumeNumberController@actionWise');
		Route::get('pass-book-and-volume-number-search', 'PassBookVolumeNumberController@importDataEntrySearch');
		Route::get('filewise-lcno/{fileId}', 'PassBookVolumeNumberController@fileWiseLcNo');
		Route::get('lcnowise-supplier/{lcId}', 'PassBookVolumeNumberController@lcnoWiseSupplier');

		// import data update section
		Route::group(['prefix' => 'import-data-update'], function(){
			Route::get('consignment/{type}', 'ImportDataUpdateController@index');
			Route::get('consignment/{type}/list', 'ImportDataUpdateController@list');
			Route::get('consignment/{type}/{id}/edit', 'ImportDataUpdateController@edit');
			Route::get('consignment-seas-list-data', 'ImportDataUpdateController@listOfSeaData');
			Route::get('consignment-port-list-data', 'ImportDataUpdateController@listOfPortData');
			Route::post('consignment-sea-port-action-delete', 'ImportDataUpdateController@actionWiseDelete');
			Route::get('filewise-value/{fileId}', 'ImportDataUpdateController@fileWiseValue');
			Route::get('valuewise-package/{valueId}', 'ImportDataUpdateController@valueWisePackage');
			Route::get('consignment-seas-port-search', 'ImportDataUpdateController@ConsignmentSeasPortSearch');
			Route::get('consignment-seas-port-check', 'ImportDataUpdateController@checkDataLoad');
			Route::post('consignment-sea-port-save', 'ImportDataUpdateController@saveData');
		});

		//asset/others pi entry section
		Route::group(['prefix' => 'asset'], function(){
			Route::resource('others-pi-entry', 'AssetOtherPIEntryController');
			Route::get('pi-entry-get-machine-type', 'AssetOtherPIEntryController@getMachineType');
			Route::get('load-data-others-pi-entry', 'AssetOtherPIEntryController@loadData');
			Route::post('others-pi-entry-delete', 'AssetOtherPIEntryController@deleteOthersPi');
		});
		

	});


?>
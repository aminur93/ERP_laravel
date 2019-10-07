<?php

/*
|--------------------------------------------------------------------------
| COMMERCIAL============= MATI
|--------------------------------------------------------------------------
*/
 #--------- Dashboard ------------------ #
Route::get('commercial/dashboard','Commercial\DashboardController@index');

#--------- Import ------------------ #
// PI Master_Fabric / Accessories file assign by commercial
Route::get('commercial/import/pi/master_fabric', 'Commercial\Import\PI\PiMasterFabricController@showForm');
Route::get('commercial/import/pi/get_order_list', 'Commercial\Import\PI\PiMasterFabricController@getOrderList');
Route::get('commercial/import/pi/get_bom_info', 'Commercial\Import\PI\PiMasterFabricController@getBomInfo');
Route::post('commercial/import/pi/master_fabric', 'Commercial\Import\PI\PiMasterFabricController@saveForm');

Route::get('commercial/import/pi/master_fabric_list', 'Commercial\Import\PI\PiMasterFabricController@piList');
Route::get('commercial/import/pi/master_fabric_list_data', 'Commercial\Import\PI\PiMasterFabricController@piListData');

Route::get('commercial/import/pi/master_fabric/{id}/delete', 'Commercial\Import\PI\PiMasterFabricController@piDelete');
Route::get('commercial/import/pi/master_fabric/{id}/edit', 'Commercial\Import\PI\PiMasterFabricController@editForm');
Route::post('commercial/import/pi/master_fabric/{id}/update', 'Commercial\Import\PI\PiMasterFabricController@updateForm');

// BTB Entry
Route::get('commercial/import/ilc/btb_entry', 'Commercial\Import\ILC\BTBEntryController@showForm');
Route::post('commercial/import/ilc/btb_entry', 'Commercial\Import\ILC\BTBEntryController@saveForm');
Route::get('commercial/import/ilc/cancel_close_info', 'Commercial\Import\ILC\BTBEntryController@cancelCloseInfo');
Route::get('commercial/import/ilc/pi_bom_info', 'Commercial\Import\ILC\BTBEntryController@piBomInfo');


Route::get('commercial/import/ilc/btb_list', 'Commercial\Import\ILC\BTBEntryController@btbList');
Route::get('commercial/import/ilc/btb_list_data', 'Commercial\Import\ILC\BTBEntryController@btbListData');

Route::get('commercial/import/ilc/btb/{id}/delete', 'Commercial\Import\ILC\BTBEntryController@btbDelete');

Route::get('commercial/import/ilc/btb/{id}/edit', 'Commercial\Import\ILC\BTBEntryController@btbEdit');

Route::post('commercial/import/ilc/btb_update', 'Commercial\Import\ILC\BTBEntryController@btbUpdate');

// BTB Asset/ Others

Route::get('commercial/import/ilc/btb_asset', 'Commercial\Import\ILC\BTBAssetController@showForm');
Route::post('commercial/import/ilc/btb_asset', 'Commercial\Import\ILC\BTBAssetController@saveForm');
Route::get('commercial/import/ilc/asset_list', 'Commercial\Import\ILC\BTBAssetController@showList');
Route::get('commercial/import/ilc/asset_list_data', 'Commercial\Import\ILC\BTBAssetController@assetListData');
Route::get('commercial/import/ilc/get_file_info', 'Commercial\Import\ILC\BTBAssetController@getFileInfo');

Route::get('commercial/import/ilc/btb_asset/{id}/delete', 'Commercial\Import\ILC\BTBAssetController@deleteForm');
Route::get('commercial/import/ilc/btb_asset/{id}/edit', 'Commercial\Import\ILC\BTBAssetController@editForm');
Route::post('commercial/import/ilc/btb_asset_update', 'Commercial\Import\ILC\BTBAssetController@assetUpdate');

/*
|--------------------------------------------------------------------------
| COMMERCIAL============= TANZIAH
|--------------------------------------------------------------------------
*/

//--EXPORT-Sales Contract

Route::get('commercial/export/sales_contract/sales_contract_entry', 'Commercial\Export\Salescontract\SalesContractController@entryForm');
Route::get('commercial/export/sales_contract/getcontractlist', 'Commercial\Export\Salescontract\SalesContractController@getContractList');
Route::post('commercial/export/sales_contract/sales_contract_store', 'Commercial\Export\Salescontract\SalesContractController@salesStore');
Route::get('commercial/export/sales_contract/getorderlist', 'Commercial\Export\Salescontract\SalesContractController@getOrderList');
Route::get('commercial/export/sales_contract/sales_contract_list', 'Commercial\Export\Salescontract\SalesContractController@salesContractList');
Route::get('commercial/export/sales_contract/sales_contract_get_data', 'Commercial\Export\Salescontract\SalesContractController@getData');
Route::get('commercial/export/sales_contract/sales_contract_edit/{id}', 'Commercial\Export\Salescontract\SalesContractController@edit');
Route::post('commercial/export/sales_contract/sales_contract_update', 'Commercial\Export\Salescontract\SalesContractController@salesUpdate');

Route::get('commercial/export/sales_contract/sales_contract_delete/{id}','Commercial\Export\Salescontract\SalesContractController@salesDelete');

//--EXPORT-LC Entry
Route::get('commercial/export/exportlc', 'Commercial\Export\ExportLc\ExportLcController@showForm');
Route::post('commercial/exportlc/store', 'Commercial\Export\ExportLc\ExportLcController@exportLcStore');
Route::get('commercial/export/exportlcnolist', 'Commercial\Export\ExportLc\ExportLcController@exportLcnoList');
Route::get('commercial/export/exportlcinputlist', 'Commercial\Export\ExportLc\ExportLcController@exportInputList');
Route::get('commercial/export/exportlc_edit/{id}', 'Commercial\Export\ExportLc\ExportLcController@exportLcEdit');
Route::post('commercial/export/exportlcupdate', 'Commercial\Export\ExportLc\ExportLcController@exportLcUpdate');
Route::get('commercial/export/exportlclist', 'Commercial\Export\ExportLc\ExportLcController@exportLcList');
Route::get('commercial/exportlclist_data', 'Commercial\Export\ExportLc\ExportLcController@exportLcListData');
Route::get('commercial/export/exportlcdelete/{file_id}/{lc_id}', 'Commercial\Export\ExportLc\ExportLcController@exportLcDelete');

//--EXPORT-Data Entry

Route::get('commercial/export/expordataentry', 'Commercial\Export\ExportData\ExportDataEntryController@showForm');
Route::get('commercial/export/filelist', 'Commercial\Export\ExportData\ExportDataEntryController@fileList');
Route::get('commercial/export/elclist', 'Commercial\Export\ExportData\ExportDataEntryController@elcList');
Route::get('commercial/export/invoiceno', 'Commercial\Export\ExportData\ExportDataEntryController@invNo');

Route::get('commercial/export/elcinfolist', 'Commercial\Export\ExportData\ExportDataEntryController@elcInfoList');
Route::get('commercial/export/polist', 'Commercial\Export\ExportData\ExportDataEntryController@poList');
Route::get('commercial/export/cashincentive', 'Commercial\Export\ExportData\ExportDataEntryController@cashIncentive');

Route::get('commercial/export/povalues', 'Commercial\Export\ExportData\ExportDataEntryController@poValues');
Route::post('commercial/export/store_exportdata', 'Commercial\Export\ExportData\ExportDataEntryController@storeExportData');

// export lc entry update screen
Route::get('commercial/export/export-lc-update-screen', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@getEntryUpdateScreen');
Route::post('commercial/export/export-lc-update-screen-save', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@entryUpdateScreenSave');
Route::get('commercial/export/get-invoice-no-by-hr-unit-id/{id}', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@ajaxgetInvoiceNoByUnitId');
Route::get('commercial/export/get-agent-code-by-invoice-no/{id}', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@ajaxgetAgentCodeByInvoiceNo');
Route::get('commercial/export/export-lc-update-screen3', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@getEntryUpdateScreen3');
Route::post('commercial/export/export-lc-update-screen3-save', 'Commercial\Export\ExportLc\EntryUpdateScreen\ExportLcEntryUpdateScreenController@entryUpdateScreen3Save');
















/*
|--------------------------------------------------------------------------
| COMMERCIAL============ ...After checking.... added
|--------------------------------------------------------------------------
*/


/*----------------------------------------------------------------------------------------- 

UD Routes
------------------------------------------------------------------------------------------*/
Route::get('comm/import/ud_master/list', 'Commercial\Import\UD\UdSystemController@udMasterList');
Route::get('comm/import/ud_master/list_data', 'Commercial\Import\UD\UdSystemController@getUdMasterListData');
#form
Route::get('comm/import/ud_master/new', 'Commercial\Import\UD\UdSystemController@showForm');
Route::post('comm/import/ud_master/save', 'Commercial\Import\UD\UdSystemController@saveUDmasterInfo');
#ud amount
Route::get('comm/import/ud_amount/get_info_by_file/{id}', 'Commercial\Import\UD\UdSystemController@ajaxGetInfobyFile');
Route::post('comm/import/ud_amount/save', 'Commercial\Import\UD\UdSystemController@saveUDAmount');

#edit
Route::get('comm/import/ud_master/edit/{id}', 'Commercial\Import\UD\UdSystemController@editForm');
#master information
Route::post('comm/import/ud_master/master_information', 'Commercial\Import\UD\UdSystemController@saveMasterInformation');
Route::post('comm/import/ud_master/master_information_update', 'Commercial\Import\UD\UdSystemController@updateMasterInformation');
#library
Route::post('comm/import/ud_master/library_fabric', 'Commercial\Import\UD\UdSystemController@saveLibraryFabric');
Route::get('comm/import/ud_master/library_fabric_edit/{id}', 'Commercial\Import\UD\UdSystemController@editLibraryFabric');
Route::post('comm/import/ud_master/library_fabric_update', 'Commercial\Import\UD\UdSystemController@updateLibraryFabric');
Route::get('comm/import/ud_master/library_fabric_delete/{id}', 'Commercial\Import\UD\UdSystemController@deleteLibraryFabric');
Route::post('comm/import/ud_master/library_accessories', 'Commercial\Import\UD\UdSystemController@saveLibraryAccessories');
Route::get('comm/import/ud_master/library_accessories_edit/{id}', 'Commercial\Import\UD\UdSystemController@editLibraryAccessories');
Route::post('comm/import/ud_master/library_accessories_update', 'Commercial\Import\UD\UdSystemController@updateLibraryAccessories');
Route::get('comm/import/ud_master/library_accessories_delete/{id}', 'Commercial\Import\UD\UdSystemController@deleteLibraryAccessories');
#ud quantity
Route::get('comm/import/ud_master/get_library_fabric_by_code', 'Commercial\Import\UD\UdSystemController@getLibraryFabricByCode');

//----------------------------------UD Routes End---------------------------------------------

//.........
///---IMPORT =>FOC Entry And Update
//.........
Route::get('comm/import/importlc/foc', 'Commercial\Import\ImportLC\FocController@showForm');
Route::post('comm/import/importlc/focstore', 'Commercial\Import\ImportLC\FocController@focStore');
Route::get('comm/import/importlc/foclist', 'Commercial\Import\ImportLC\FocController@focList');
Route::get('comm/import/importlc/foclistdata', 'Commercial\Import\ImportLC\FocController@focListData');

Route::get('comm/import/importlc/focedit/{lc_id}', 'Commercial\Import\ImportLC\FocController@focEdit');
Route::post('comm/import/importlc/focupdate/{id}', 'Commercial\Import\ImportLC\FocController@focUpdate');
Route::get('comm/import/importlc/focdelete/{lc_id}', 'Commercial\Import\ImportLC\FocController@focDelete');

Route::get('comm/import/importlc/foc/getdata/{id}', 'Commercial\Import\ImportLC\FocController@getData');
Route::get('comm/import/importlc/foc/getFileorder/{id}', 'Commercial\Import\ImportLC\FocController@getFileorder');
///---IMPORT =>FOC Entry And Update...end



/* -----------------------------------------------------------------------------------------------
Import, Chalan, Asset/Other Entry Routes...
---------------------------------------------------------------------------------------------*/

/*--------------------Import data entry------------*/
Route::get('comm/import/importdata/importdata','Commercial\Import\ImportData\ImportDataController@importDataEntry');
Route::post('comm/import/importdata/voyage','Commercial\Import\ImportData\ImportDataController@vesselVoyage');
Route::get('comm/import/importdata/importcode','Commercial\Import\ImportData\ImportDataController@autocode');
Route::get('comm/import/importdata/pidate','Commercial\Import\ImportData\ImportDataController@piDate');
Route::get('comm/import/importdata/getpiTable','Commercial\Import\ImportData\ImportDataController@piTable');
Route::get('comm/import/importdata/editTable','Commercial\Import\ImportData\ImportDataController@editTable');
Route::get('comm/import/importdata/fileUnit','Commercial\Import\ImportData\ImportDataController@fileUnit');
Route::get('comm/import/importdata/supplierIlcNo','Commercial\Import\ImportData\ImportDataController@supplierIlcNo');
Route::post('comm/import/importdata/importdatastore','Commercial\Import\ImportData\ImportDataController@importDataStore');
Route::get('comm/import/importdata/importdataview','Commercial\Import\ImportData\ImportDataController@view');
Route::get('comm/import/importdata/importdataviews','Commercial\Import\ImportData\ImportDataController@getData');
Route::match(['get','post'],'comm/import/importdata/importdataedit/{id}','Commercial\Import\ImportData\ImportDataController@edit');
Route::get('comm/import/importdata/importDelete/{id}','Commercial\Import\ImportData\ImportDataController@destroy');
/*--------------------Import data entry end------------*/


/*----------------------LOcal chalan entry screen-----------*/
Route::get('comm/import/chalan/localchalanlist','Commercial\Import\ChalanData\ChalanController@index');
Route::get('comm/importchalantdata/fileUnit','Commercial\Import\ChalanData\ChalanController@fileUnit');
Route::get('comm/import/chalandata/supplierIlcNo','Commercial\Import\ChalanData\ChalanController@supplierIlcNo');
Route::get('comm/import/chalandata/getpiTable','Commercial\Import\ChalanData\ChalanController@piTable');
Route::get('comm/import/chalandata/editTable','Commercial\Import\ChalanData\ChalanController@editTable');
Route::get('comm/import/chalandata/pidate','Commercial\Import\ChalanData\ChalanController@piDate');
Route::post('comm/import/chalan/chalanstore','Commercial\Import\ChalanData\ChalanController@store');
Route::get('comm/import/chalan/chalanview','Commercial\Import\ChalanData\ChalanController@view');
Route::get('comm/import/chalan/chalanviews','Commercial\Import\ChalanData\ChalanController@getData');
Route::match(['get','post'],'comm/import/chalan/chalanedit/{id}','Commercial\Import\ChalanData\ChalanController@edit');
Route::get('comm/import/chalan/chalanDelete/{id}','Commercial\Import\ChalanData\ChalanController@destroy');
/*----------------------LOcal chalan entry screen  end-----------*/



//----Asset and other data entry screen------------------*/
Route::get('comm/import/asset/assets','Commercial\Import\AssetData\AssetController@index');
Route::post('comm/import/asset/assetstore','Commercial\Import\AssetData\AssetController@store');
Route::post('comm/import/asset/voyage','Commercial\Import\ImportData\ImportDataController@vesselVoyage');
Route::get('comm/import/asset/assetimportcode','Commercial\Import\ImportData\ImportDataController@autocode');
Route::get('comm/import/asset/pidate','Commercial\Import\ImportData\ImportDataController@piDate');
Route::get('comm/import/asset/getpiTable','Commercial\Import\ImportData\ImportDataController@piTable');
Route::get('comm/import/asset/fileUnit','Commercial\Import\ImportData\ImportDataController@fileUnit');
Route::get('comm/import/asset/supplierIlcNo','Commercial\Import\ImportData\ImportDataController@supplierIlcNo');
Route::get('comm/import/asset/assetview','Commercial\Import\AssetData\AssetController@view');
Route::get('comm/import/asset/assetviews','Commercial\Import\AssetData\AssetController@getData');
Route::match(['get','post'],'comm/import/asset/assetedit/{id}','Commercial\Import\AssetData\AssetController@edit');

// ----------- Asset data and chalan data Routes END -------------------------------

/*------------------New Import Data Entry Route*/
include 'pavel/new_commercial.php';


/*-------------------------------------------
// shipping guarantee date updated
----------------------------------------------*/

Route::get('comm/import/shipping_guarantee_date_update', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@index');
Route::get('comm/import/shipping_guarantee/get_lc_no_by_file/{id}', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@ajaxGetLcNobyFile');
Route::get('comm/import/shipping_guarantee/get_data_entry_info_by_file/{id}', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@ajaxGetDataEntrybyFile');
Route::get('comm/import/importdata/filewise-lcno/{id}', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@filewiselcno');
Route::get('comm/import/importdata/filewise-supplier/{id}', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@filewisesupplier');
Route::get('comm/import/importdata/shipping-guarantee-date-update-search', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeSearch');
Route::get('comm/import/importdata/shipping-guarantee-edit', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeEdit');
Route::post('comm/import/importdata/shipping-guarantee-date-update-save', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeSave');
Route::get('comm/import/importdata/shipping-guarantee-date-update-list', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeList');
Route::get('comm/import/importdata/shipping-guarantee-date-update-list-data', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@getShippingGuaranteeListData');
Route::get('comm/import/importdata/shipping-guarantee-date-update-by-id', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@getShippingGuaranteeInfoById');
Route::post('comm/import/shipping-guarantee-date-update-edit', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeDateEdit');
Route::post('comm/import/shipping-guarantee-date-update-delete', 'Commercial\Import\Shipping_Guarantee_Date_Update\ShippingGuaranteeDateUpdateController@shippingGuaranteeDateDelete');

// shipping guarantee date updated end----------------------------------------






























































































































/*
|--------------------------------------------------------------------------
| COMMERCIAL============= ABIR
|--------------------------------------------------------------------------
*/

//-------------SETUP--------------------------//

Route::get('commercial/setup/setup', 'Commercial\Setup\SetupController@showForm');
//PI Type-Routes
Route::post('commercial/setup/pistore', 'Commercial\Setup\SetupController@piStore' );
Route::get('commercial/setup/pi_edit/{id}', 'Commercial\Setup\SetupController@piEdit' );
Route::post('commercial/setup/pi_update', 'Commercial\Setup\SetupController@piUpdate' );
Route::get('commercial/setup/pi_delete/{id}', 'Commercial\Setup\SetupController@piDelete' );

//Bank-Routes
Route::post('commercial/setup/bankstore', 'Commercial\Setup\SetupController@bankStore' );
Route::get('commercial/setup/bank_edit/{id}', 'Commercial\Setup\SetupController@bankEdit' );
Route::post('commercial/setup/bank_update', 'Commercial\Setup\SetupController@bankUpdate' );
Route::get('commercial/setup/bank_delete/{id}', 'Commercial\Setup\SetupController@bankDelete' );

//Machine-Routes
Route::post('commercial/setup/machinestore', 'Commercial\Setup\SetupController@machineStore' );
Route::get('commercial/setup/machine_edit/{id}', 'Commercial\Setup\SetupController@machineEdit' );
Route::post('commercial/setup/machine_update', 'Commercial\Setup\SetupController@machineUpdate' );
Route::get('commercial/setup/machine_delete/{id}', 'Commercial\Setup\SetupController@machineDelete' );

//--L/C Type-Routes
Route::post('commercial/setup/lcstore', 'Commercial\Setup\SetupController@lcStore' );
Route::get('commercial/setup/lc_edit_1/{id}', 'Commercial\Setup\SetupController@lcEdit' );
Route::post('commercial/setup/lc_update', 'Commercial\Setup\SetupController@lcUpdate' );
Route::get('commercial/setup/lc_delete/{id}', 'Commercial\Setup\SetupController@lcDelete' );

//--L/C Period
Route::post('commercial/setup/lcperiodstore', 'Commercial\Setup\SetupController@lcPeriodStore' );
Route::get('commercial/setup/lc_period_edit_1/{id}', 'Commercial\Setup\SetupController@lcPeriodEdit' );
Route::post('commercial/setup/lc_period_update', 'Commercial\Setup\SetupController@lcPeriodUpdate' );
Route::get('commercial/setup/lc_period_delete/{id}', 'Commercial\Setup\SetupController@lcPeriodDelete' );

//--Item(FOC)-Routes
Route::post('commercial/setup/itemstore', 'Commercial\Setup\SetupController@itemStore' );
Route::get('commercial/setup/item_edit_1/{id}', 'Commercial\Setup\SetupController@itemEdit' );
Route::post('commercial/setup/item_update', 'Commercial\Setup\SetupController@itemUpdate' );
Route::get('commercial/setup/item_delete/{id}', 'Commercial\Setup\SetupController@itemDelete' );


//--Port-Routes
Route::post('commercial/setup/portstore', 'Commercial\Setup\SetupController@portStore' );
Route::get('commercial/setup/port_edit_1/{id}', 'Commercial\Setup\SetupController@portEdit' );
Route::post('commercial/setup/port_update', 'Commercial\Setup\SetupController@portUpdate' );
Route::get('commercial/setup/port_delete/{id}', 'Commercial\Setup\SetupController@portDelete' );

//--Vessel-Routes
Route::post('commercial/setup/vesselstore', 'Commercial\Setup\SetupController@vesselStore' );
Route::get('commercial/setup/vessel_edit/{id}', 'Commercial\Setup\SetupController@vesselEdit' );
Route::post('commercial/setup/vessel_update', 'Commercial\Setup\SetupController@vesselUpdate' );
Route::get('commercial/setup/vessel_delete/{id}', 'Commercial\Setup\SetupController@vesselDelete' );

//--Agent-Routes
Route::post('commercial/setup/agentstore', 'Commercial\Setup\SetupController@agentStore' );
Route::get('commercial/setup/agent_edit/{id}', 'Commercial\Setup\SetupController@agentEdit' );
Route::post('commercial/setup/agent_update', 'Commercial\Setup\SetupController@agentUpdate' );
Route::get('commercial/setup/agent_delete/{id}', 'Commercial\Setup\SetupController@agentDelete' );

//--Cash Incentive
Route::post('commercial/setup/incentivestore', 'Commercial\Setup\SetupController@incentiveStore' );
Route::get('commercial/setup/incentive_edit/{id}', 'Commercial\Setup\SetupController@incentiveEdit' );
Route::post('commercial/setup/incentive_update', 'Commercial\Setup\SetupController@incentiveUpdate' );
Route::get('commercial/setup/incentive_delete/{id}', 'Commercial\Setup\SetupController@incentiveDelete' );

//--Payment Type
Route::post('commercial/setup/paymenttype_store', 'Commercial\Setup\SetupController@paymenttypeStore' );
Route::get('commercial/setup/paymenttype_edit/{id}', 'Commercial\Setup\SetupController@paymenttypeEdit' );
Route::post('commercial/setup/paymenttype_update', 'Commercial\Setup\SetupController@paymenttypeUpdate' );
Route::get('commercial/setup/paymenttype_delete/{id}', 'Commercial\Setup\SetupController@paymenttypeDelete' );

//--Category No
Route::post('commercial/setup/category_no_store', 'Commercial\Setup\SetupController@categoryNoStore' );
Route::get('commercial/setup/category_no_edit/{id}', 'Commercial\Setup\SetupController@categoryNoEdit' );
Route::post('commercial/setup/category_no_update', 'Commercial\Setup\SetupController@categoryNoUpdate' );
Route::get('commercial/setup/category_no_delete/{id}', 'Commercial\Setup\SetupController@categoryNoDelete' );

//--Section
Route::post('commercial/setup/section_store', 'Commercial\Setup\SetupController@sectionStore' );
Route::get('commercial/setup/section_edit/{id}', 'Commercial\Setup\SetupController@sectionEdit' );
Route::post('commercial/setup/section_update', 'Commercial\Setup\SetupController@sectionUpdate' );
Route::get('commercial/setup/section_delete/{id}', 'Commercial\Setup\SetupController@sectionDelete' );

//--Hub
Route::post('commercial/setup/hub_store', 'Commercial\Setup\SetupController@hubStore' );
Route::get('commercial/setup/hub_edit/{id}', 'Commercial\Setup\SetupController@hubEdit' );
Route::post('commercial/setup/hub_update', 'Commercial\Setup\SetupController@hubUpdate' );
Route::get('commercial/setup/hub_delete/{id}', 'Commercial\Setup\SetupController@hubDelete' );

//--Passbook
Route::post('commercial/setup/passbook_store', 'Commercial\Setup\SetupController@passbookStore' );
Route::get('commercial/setup/passbook_edit/{id}', 'Commercial\Setup\SetupController@passbookEdit' );
Route::post('commercial/setup/passbook_update', 'Commercial\Setup\SetupController@passbookUpdate' );
Route::get('commercial/setup/passbook_delete/{id}', 'Commercial\Setup\SetupController@passbookDelete' );

//--Insurance
Route::post('commercial/setup/insurance_store', 'Commercial\Setup\SetupController@insuranceStore' );
Route::get('commercial/setup/insurance_edit/{id}', 'Commercial\Setup\SetupController@insuranceEdit' );
Route::post('commercial/setup/insurance_update', 'Commercial\Setup\SetupController@insuranceUpdate' );
Route::get('commercial/setup/insurance_delete/{id}', 'Commercial\Setup\SetupController@insuranceDelete' );

//--Period
Route::post('commercial/setup/period_store', 'Commercial\Setup\SetupController@periodStore' );
Route::get('commercial/setup/period_edit/{id}', 'Commercial\Setup\SetupController@periodEdit' );
Route::post('commercial/setup/period_update', 'Commercial\Setup\SetupController@periodUpdate' );
Route::get('commercial/setup/period_delete/{id}', 'Commercial\Setup\SetupController@periodDelete' );

//--From Date
Route::post('commercial/setup/from_date_store', 'Commercial\Setup\SetupController@from_dateStore' );
Route::get('commercial/setup/from_date_edit/{id}', 'Commercial\Setup\SetupController@from_dateEdit' );
Route::post('commercial/setup/from_date_update', 'Commercial\Setup\SetupController@from_dateUpdate' );
Route::get('commercial/setup/from_date_delete/{id}', 'Commercial\Setup\SetupController@from_dateDelete' );

//--Inco Term
Route::post('commercial/setup/inco_term_store', 'Commercial\Setup\SetupController@inco_termStore' );
Route::get('commercial/setup/inco_term_edit/{id}', 'Commercial\Setup\SetupController@inco_termEdit' );
Route::post('commercial/setup/inco_term_update', 'Commercial\Setup\SetupController@inco_termUpdate' );
Route::get('commercial/setup/inco_term_delete/{id}', 'Commercial\Setup\SetupController@inco_termDelete' );


//---------------------Bank Entry Forms-------------------------------------////
//Bank Acceptance entry Screen

Route::get('commercial/bank/bank_acceptance_entry', 'Commercial\Bank\BankController@bankAcceptanceEntryView');
Route::get('commercial/bank/imp_data_entry_asset', 'Commercial\Bank\BankController@searchResultReturn');
Route::post('commercial/bank/cm_bank_acceptance_imp_save', 'Commercial\Bank\BankController@entrySave');
Route::get('commercial/bank/cm_bank_acceptance_imp_entry_preview', 'Commercial\Bank\BankController@entryPreview');
Route::get('commercial/bank/bank_acceptance_entry_edit/{id}', 'Commercial\Bank\BankController@viewBankAccepEntryEdit');
Route::post('commercial/bank/cm_bank_acceptance_imp_update', 'Commercial\Bank\BankController@bankAccepEntryUpdate');
Route::get('commercial/bank/bank_acceptance_entry_delete/{id}', 'Commercial\Bank\BankController@bankAccepEntryDelete');



//Fund Transffer Entry Screen
Route::get('commercial/bank/fund_transfer_entry', 'Commercial\Bank\BankFundTransferController@bankFundTransferEntryView');
Route::get('commercial/bank/get_buyer_and_bank', 'Commercial\Bank\BankFundTransferController@returnBuyerAndBank');

Route::get('commercial/bank/get_pre_amount', 'Commercial\Bank\BankFundTransferController@returnPreAmount');
Route::get('commercial/bank/get_pre_amount_from', 'Commercial\Bank\BankFundTransferController@returnPreAmountFrom');

Route::get('commercial/bank/set_balance', 'Commercial\Bank\BankFundTransferController@setAmount');
Route::get('commercial/bank/set_balance_edit', 'Commercial\Bank\BankFundTransferController@setAmountInFromEdit');

Route::get('commercial/bank/get_buyer_balance_to', 'Commercial\Bank\BankFundTransferController@getBuyerBalance');
Route::get('commercial/bank/get_pre_amount_2', 'Commercial\Bank\BankFundTransferController@returnPreAmount2');
Route::get('commercial/bank/set_balance_2', 'Commercial\Bank\BankFundTransferController@setAmount2');
Route::post('commercial/bank/save_entry', 'Commercial\Bank\BankFundTransferController@saveEntry');
Route::get('commercial/bank/fund_transfer_entry_preview', 'Commercial\Bank\BankFundTransferController@viewFundTransferEntry');
	//edit//
Route::get('commercial/bank/fund_transfer_from_to_edit/{id}', 'Commercial\Bank\BankFundTransferController@edtiEntry');
Route::post('commercial/bank/fund_transfer_from_to_update', 'Commercial\Bank\BankFundTransferController@updateFromToEntry');
Route::post('commercial/bank/fund_transfer_from_update', 'Commercial\Bank\BankFundTransferController@updateFromEntry');

Route::get('commercial/bank/fund_transfer_entry_delete/{id}', 'Commercial\Bank\BankFundTransferController@deleteEntry');




//Export Bill Discouting Entry Screen
Route::get('commercial/bank/export_bill_discounting_entry',
			'Commercial\Bank\BankExportBillDiscountingController@bankExportBillDiscountingEntryView');
			//continued to Dipta's section...
			//.....................




//Export Reibrusment Entry
Route::get('commercial/bank/bank_export_reibrusment_entry',
			'Commercial\Bank\BankExpReibrusmentController@bankExpReimbrusmentEntryView');
Route::get('commercial/bank/ajax_get_invoice', 'Commercial\Bank\BankExpReibrusmentController@getInvoiceNo');
Route::get('commercial/bank/show_search_result', 'Commercial\Bank\BankExpReibrusmentController@getSearchResult');
Route::post('commercial/bank/save_reimb_entry', 'Commercial\Bank\BankExpReibrusmentController@saveReimbEntry');
Route::get('commercial/bank/bank_export_reibrusment_entry_preview',
			'Commercial\Bank\BankExpReibrusmentController@viewReimbursementEntry');
Route::get('commercial/bank/exp_reimbursement_edit/{id}', 'Commercial\Bank\BankExpReibrusmentController@expReimbursementEdit');
Route::post('commercial/bank/exp_reimb_entry_update', 'Commercial\Bank\BankExpReibrusmentController@updateReimbEntry');
Route::get('commercial/bank/exp_reimbursement_delete/{id}', 'Commercial\Bank\BankExpReibrusmentController@expReimbursementDelete');

//Forward Sales Master
Route::get('commercial/bank/bank_forward_sales_master_entry',
			'Commercial\Bank\BankForwardSalesMasterController@bankForwardSalesMasterView');
		//(..ajax call..)
Route::get('commercial/bank/bank_forward_sales_amounts_return',
			'Commercial\Bank\BankForwardSalesMasterController@amountsReturn');

Route::post('commercial/bank/bank_forward_sales_entry_save',
			'Commercial\Bank\BankForwardSalesMasterController@all_entry_save');
		//view the entries
Route::get('commercial/bank/bank_forward_sales_entry_view',
			'Commercial\Bank\BankForwardSalesMasterController@all_entry_view');
		//edit
Route::get('commercial/bank/bank_forward_sales_entry_edit/{id}',
			'Commercial\Bank\BankForwardSalesMasterController@entry_edit');
		//update
Route::post('commercial/bank/bank_forward_sales_entry_update',
			'Commercial\Bank\BankForwardSalesMasterController@entry_update');
		//delete
Route::get('commercial/bank/bank_forward_sales_entry_delete/{id}',
			'Commercial\Bank\BankForwardSalesMasterController@entry_delete');



include('abr/commercial.php');

#End-Abir-------------------------------------------------------------------------------------



//Dipta

//--------Import Bill Settlement Part---------//

Route::get('commercial/bank/import_bill_settlement', 'Commercial\Bank\ImportBillSettlementController@selectdata');
Route::get('commercial/bank/showdata', 'Commercial\Bank\ImportBillSettlementController@showdata');
Route::post('commercial/bank/enterdata', 'Commercial\Bank\ImportBillSettlementController@enterdata');
Route::get('commercial/bank/import_bill_settlement_view', 'Commercial\Bank\ImportBillSettlementController@dataList');


//------Export Bill Discouting Entry Screen---------//
Route::get('commercial/bank/export_bill_discounting_entry',
			'Commercial\Bank\BankExportBillDiscountingController@bankExportBillDiscountingEntryView');
Route::get('commercial/bank/getInvoice',
			'Commercial\Bank\BankExportBillDiscountingController@getInvoice');
Route::get('commercial/bank/showTable',
			'Commercial\Bank\BankExportBillDiscountingController@showTable');
Route::post('commercial/bank/entryForm',
			'Commercial\Bank\BankExportBillDiscountingController@entryForm');



//------Payment Planning---------//

Route::get('commercial/bank/payment_planning',
			'Commercial\Bank\PaymentPlanningController@paymentPlanningView');
Route::get('commercial/bank/invoiceID',
			'Commercial\Bank\PaymentPlanningController@getInvoice');
Route::get('commercial/bank/getExpData',
			'Commercial\Bank\PaymentPlanningController@getExpData');
Route::post('commercial/bank/postExportBills',
			'Commercial\Bank\PaymentPlanningController@postExportBills');

Route::get('commercial/bank/getBill',
			'Commercial\Bank\PaymentPlanningController@getBill');
Route::get('commercial/bank/getImpData',
			'Commercial\Bank\PaymentPlanningController@getImpData');
Route::post('commercial/bank/postImportBills',
			'Commercial\Bank\PaymentPlanningController@postImportBills');
Route::get('commercial/bank/showPlanningData',
			'Commercial\Bank\PaymentPlanningController@showPlanningData');




//Dipta End


//xinnah route file
include 'xinnah/commercial.php';

include('rubel/commercial.php');


// Export bill
Route::resource('commercial/export/exportbill','Commercial\Export\Exportbill\ExportbillController');
Route::get('commercial/export/invoiceno/{id}','Commercial\Export\Exportbill\ExportbillController@invoiceNo');
Route::get('commercial/export/invoicedata/{id}','Commercial\Export\Exportbill\ExportbillController@invoiceData');
Route::get('commercial/export/invoicedatamore/{id}','Commercial\Export\Exportbill\ExportbillController@invoiceDataMore');

<?php

// Rubel commercial route list

// bill of entry section
Route::match(['get','post'],'commercial/import/billofentry', 'Commercial\Rubel\BillofEntryController@index');
Route::post('commercial/import/billofentry_fetchlcsup', 'Commercial\Rubel\BillofEntryController@billofentryFetchlcsup');
Route::post('commercial/import/billofentry_fetchsup', 'Commercial\Rubel\BillofEntryController@billofentryFetchsup');
Route::post('commercial/import/billofentry_fetchbtbdata', 'Commercial\Rubel\BillofEntryController@billofentry_fetchBtbData');
Route::post('commercial/import/save_bill_of_entry', 'Commercial\Rubel\BillofEntryController@saveBillOfEntry');
Route::get('commercial/import/billofentry_list', 'Commercial\Rubel\BillofEntryController@billofentryList');
Route::get('commercial/import/billofentry_listData', 'Commercial\Rubel\BillofEntryController@billofentryListData');
Route::post('commercial/import/billofentry_fetchbillentryform', 'Commercial\Rubel\BillofEntryController@billofentry_fetchBillEntryForm');

// Import C&F Bill Monitoring
Route::match(['get','post'],'commercial/import/cf_bill_monitoring', 'Commercial\Rubel\CfBillMonitoringController@index');
Route::get('commercial/import/cf_bill_monitoring_list', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_list');
Route::get('commercial/import/cf_bill_monitoring_list_data', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_listData');
Route::post('commercial/import/cf_bill_monitoring_search', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_Search');
Route::post('commercial/import/cf_bill_monitoring_shipmode_search', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_shipmodeSearch');
Route::post('commercial/import/cf_bill_monitoring_save', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_save');
Route::post('commercial/import/cf_bill_monitoring_delete/{id}', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_delete');
Route::post('commercial/import/cf_bill_monitoring_update/{id}', 'Commercial\Rubel\CfBillMonitoringController@cfBillMonitoring_update');

// C&F Expenses air
Route::match(['get','post'],'commercial/import/cf_expenses', 'Commercial\Rubel\CfExpensesController@index');
Route::get('commercial/import/cf_expenses_list', 'Commercial\Rubel\CfExpensesController@cfExpenses_list');
Route::get('commercial/import/cfexpenses_fetchlist', 'Commercial\Rubel\CfExpensesController@cfExpenses_listData');
Route::post('commercial/import/cfexpenses_update/{id}', 'Commercial\Rubel\CfExpensesController@cfExpenses_updateData');
Route::post('commercial/import/cfexpenses_save', 'Commercial\Rubel\CfExpensesController@cfExpenses_saveData');
Route::get('commercial/import/cf_expenses_edit/{id}', 'Commercial\Rubel\CfExpensesController@cfExpenses_edit');
Route::post('commercial/import/cf_expenses_delete/{id}', 'Commercial\Rubel\CfExpensesController@cfExpenses_delete');
Route::post('commercial/import/cfexpenses_fetchtransdoc', 'Commercial\Rubel\CfExpensesController@cfExpenses_fetchTransDoc');
Route::post('commercial/import/cfexpenses_fetchentrydata', 'Commercial\Rubel\CfExpensesController@cfExpenses_fetchEntryData');


// C&F Expenses sea
Route::match(['get','post'],'commercial/import/cfExpensesSea', 'Commercial\Rubel\CfExpensesSeaController@index');
Route::get('commercial/import/cfExpensesSea_list', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_list');
Route::get('commercial/import/cfexpensesSea_fetchlist', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_listData');
Route::post('commercial/import/cfexpensesSea_update/{id}', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_updateData');
Route::post('commercial/import/cfexpensesSea_save', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_saveData');
Route::get('commercial/import/cfExpensesSea_edit/{id}', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_edit');
Route::post('commercial/import/cfExpensesSea_delete/{id}', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_delete');
Route::post('commercial/import/cfexpensesSea_fetchtransdoc', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_fetchTransDoc');
Route::post('commercial/import/cfexpensesSea_fetchentrydata', 'Commercial\Rubel\CfExpensesSeaController@cfExpensesSea_fetchEntryData');


// Export L/C Entry
Route::match(['get','post'],'commercial/export/exportLcEntry', 'Commercial\Rubel\ExportLcEntryController@index');
Route::get('commercial/export/exportLcEntry_list', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_list');
Route::post('commercial/export/exportLcEntry_fetchunit', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_fetchunit');
Route::post('commercial/export/exportLcEntry_fetchentryform', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_fetchentryform');
Route::post('commercial/export/exportLcEntry_save', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_save');
Route::get('commercial/export/exportLcEntry_fetchlist', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_listData');
Route::post('commercial/export/exportLcEntry_delete/{id}', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_delete');
Route::get('commercial/export/exportLcEntry_edit/{id}', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_edit');
Route::post('commercial/export/exportLcEntry_delete/{id}', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_delete');
Route::post('commercial/export/exportLcEntry_update/{id}', 'Commercial\Rubel\ExportLcEntryController@exportLcEntry_update');

// ELC File Close Entry
Route::match(['get','post'],'commercial/export/elcFileClose', 'Commercial\Rubel\ElcFileCloseController@index');
Route::post('commercial/export/elcFileClose_save', 'Commercial\Rubel\ElcFileCloseController@elcFileClose_save');
Route::post('commercial/export/elcFileClose_checkExist', 'Commercial\Rubel\ElcFileCloseController@elcFileClose_checkExist');

// Export Fabric Consumption Entry
Route::match(['get','post'],'commercial/export/expFabricConsEntry', 'Commercial\Rubel\ExpFabricConsEntryController@index');
Route::post('commercial/export/expFabricConsEntry_save', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_save');
Route::get('commercial/export/expFabricConsEntry_list', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_list');
Route::post('commercial/export/expFabricConsEntry_fetchunitinvoice', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_fetchunitinvoice');
Route::post('commercial/export/expFabricConsEntry_fetchentryform', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_fetchentryform');
Route::get('commercial/export/expFabricConsEntry_fetchrow', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_fetchrow');
Route::post('commercial/export/expFabricConsEntry_fetchinvdate_qty', 'Commercial\Rubel\ExpFabricConsEntryController@expFabricConsEntry_fetchinvdate_qty');

// Freight Charge
Route::get('commercial/export/freight_charge', 'Commercial\Rubel\FreightChargeController@index');
Route::post('commercial/export/ajax_freight_charge_loadtr', 'Commercial\Rubel\FreightChargeController@ajaxFreightChargeLoadtr');
Route::post('commercial/export/ajax_freight_charge_master_data', 'Commercial\Rubel\FreightChargeController@ajaxFreightChargeMasterData');
Route::post('commercial/export/freight_charge_fetchinvno', 'Commercial\Rubel\FreightChargeController@freightChargeFetchinvno');
Route::post('commercial/export/freight_charge_save', 'Commercial\Rubel\FreightChargeController@freightChargeSave');
Route::get('commercial/export/freight_charge_list_ajax', 'Commercial\Rubel\FreightChargeController@freightChargeList');
Route::get('commercial/export/freight_charge_list', 'Commercial\Rubel\FreightChargeController@getFreightChargeList');

// Export Bill (Sea)
Route::match(['get','post'],'commercial/export/export_bill_sea', 'Commercial\Rubel\ExportBillSeaController@index');
Route::get('commercial/export/export_bill_sea_list', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_list');
Route::get('commercial/export/export_bill_sea_fetchlist', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_listData');
Route::post('commercial/export/export_bill_sea_update/{id}', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_updateData');
Route::post('commercial/export/export_bill_sea_save', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_saveData');
Route::get('commercial/export/export_bill_sea_edit/{id}', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_edit');
Route::post('commercial/export/export_bill_sea_delete/{id}', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_delete');
Route::post('commercial/export/export_bill_sea_fetchinvno', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_fetchInvNo');
Route::post('commercial/export/export_bill_sea_fetchentrydata', 'Commercial\Rubel\ExportBillSeaController@exportBillSea_fetchEntryData');

// Export Bill (Air)
Route::match(['get','post'],'commercial/export/export_bill_air', 'Commercial\Rubel\ExportBillAirController@index');
Route::get('commercial/export/export_bill_air_list', 'Commercial\Rubel\ExportBillAirController@exportBillAir_list');
Route::get('commercial/export/export_bill_air_fetchlist', 'Commercial\Rubel\ExportBillAirController@exportBillAir_listData');
Route::post('commercial/export/export_bill_air_update/{id}', 'Commercial\Rubel\ExportBillAirController@exportBillAir_updateData');
Route::post('commercial/export/export_bill_air_save', 'Commercial\Rubel\ExportBillAirController@exportBillAir_saveData');
Route::get('commercial/export/export_bill_air_edit/{id}', 'Commercial\Rubel\ExportBillAirController@exportBillAir_edit');
Route::post('commercial/export/export_bill_air_delete/{id}', 'Commercial\Rubel\ExportBillAirController@exportBillAir_delete');
Route::post('commercial/export/export_bill_air_fetchinvno', 'Commercial\Rubel\ExportBillAirController@exportBillAir_fetchInvNo');
Route::post('commercial/export/export_bill_air_fetchentrydata', 'Commercial\Rubel\ExportBillAirController@exportBillAir_fetchEntryData');

// Cash Incentive
Route::get('commercial/export/cash_incentive', 'Commercial\Rubel\CashIncentiveController@index');
Route::get('commercial/export/cash_incentivelist', 'Commercial\Rubel\CashIncentiveController@invoiceList');
Route::post('commercial/export/ajax_cash_incentive_loadtr', 'Commercial\Rubel\CashIncentiveController@ajaxCashIncentiveLoadtr');
Route::post('commercial/export/ajax_cash_incentive_master_data', 'Commercial\Rubel\CashIncentiveController@ajaxCashIncentiveMasterData');
Route::post('commercial/export/cash_incentive_fetchinvno', 'Commercial\Rubel\CashIncentiveController@cashIncentiveFetchinvno');
Route::post('commercial/export/cash_incentive_save', 'Commercial\Rubel\CashIncentiveController@cashIncentiveSave');






?>

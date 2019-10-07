<?php

/*
|--------------------------------------------------------------------------
| MERCHANDISING
|--------------------------------------------------------------------------
*/
Route::get('merch/dashboard','Merch\DashboardController@index');

/*
*--------------------------------------------------------------
* SETUP
*--------------------------------------------------------------
*/
//Supplier
Route::get('merch/setup/supplier', 'Merch\Setup\SupplierController@showForm');
Route::post('merch/setup/supplier', 'Merch\Setup\SupplierController@saveData');
Route::post('merch/setup/ajax_save_supplier', 'Merch\Setup\SupplierController@ajaxSaveSupplier');
Route::get('merch/setup/supplier_delete/{sup_id}', 'Merch\Setup\SupplierController@SupplierDelete');
Route::get('merch/setup/supplier_edit/{sup_id}', 'Merch\Setup\SupplierController@SupplierEdit');
Route::post('merch/setup/supplier_update', 'Merch\Setup\SupplierController@SupplierUpdate');

//Buyer Info & Brand
Route::get('merch/setup/buyer_info', 'Merch\Setup\BuyerController@showForm');

//Buyer Info  Store
Route::match(['get','post'],'merch/setup/buyer_info_store', 'Merch\Setup\BuyerController@buyerInfoStore');

//Buyer Info Data
Route::get('merch/setup/buyerinfo_listdata', 'Merch\Setup\BuyerController@buyerinfoListData');
//Buyer Profile
Route::get('merch/setup/buyer_profile/{buyer_id}', 'Merch\Setup\BuyerController@getBuyerProfile');
//Buyer Info Update
Route::get('merch/setup/buyer_info_edit/{b_id}', 'Merch\Setup\BuyerController@buyerUpdate');
Route::post('merch/setup/update','Merch\Setup\BuyerController@buyerUpdateAction');
//Buyer Info delete
Route::get('merch/setup/buyerdelete/{b_id}', 'Merch\Setup\BuyerController@buyerDelete');

//Brand
Route::get('merch/setup/brand', 'Merch\Setup\BuyerController@brand');
//Brand Store
Route::post('merch/setup/brandstore', 'Merch\Setup\BuyerController@brandStore');
//Brand Update
Route::get('merch/setup/brandupdate/{b_id}', 'Merch\Setup\BuyerController@brandUpdate');
Route::post('merch/setup/brandUpdateAction','Merch\Setup\BuyerController@brandUpdateAction');
//Brand delete
Route::get('merch/setup/brand_delete/{br_id}', 'Merch\Setup\BuyerController@brandDelete');

//Style Type
Route::get("merch/setup/product_type", "Merch\Setup\ProductTypeController@showForm");
Route::post("merch/setup/product_type_store", "Merch\Setup\ProductTypeController@store");
Route::get("merch/setup/product_type_edit/{id}", "Merch\Setup\ProductTypeController@edit");
Route::post("merch/setup/product_type_update", "Merch\Setup\ProductTypeController@update");
Route::get("merch/setup/product_type_delete/{id}", "Merch\Setup\ProductTypeController@destroy");
//Garments Type
Route::get("merch/setup/garments_type", "Merch\Setup\GarmentsTypeController@showForm");
Route::post("merch/setup/garments_type_store", "Merch\Setup\GarmentsTypeController@store");
Route::get("merch/setup/garments_type_edit/{id}", "Merch\Setup\GarmentsTypeController@edit");
Route::post("merch/setup/garments_type_update", "Merch\Setup\GarmentsTypeController@update");
Route::get("merch/setup/garments_type_delete/{id}", "Merch\Setup\GarmentsTypeController@destroy");
//Season Type
Route::get("merch/setup/season", "Merch\Setup\SeasonController@showForm");
Route::post("merch/setup/season_store", "Merch\Setup\SeasonController@store");
Route::get("merch/setup/season_edit/{id}", "Merch\Setup\SeasonController@edit");
Route::post("merch/setup/season_update", "Merch\Setup\SeasonController@update");
Route::get("merch/setup/season_delete/{id}", "Merch\Setup\SeasonController@destroy");
Route::get('merch/setup/season_input', 'Merch\Setup\SeasonController@searchSeason');


//Materials item
Route::get('merch/setup/item', 'Merch\Setup\MaterialController@itemForm');
Route::post('merch/setup/item_store', 'Merch\Setup\MaterialController@itemStore');
Route::post('merch/setup/main_category_store', 'Merch\Setup\MaterialController@mainCategoryStore');
Route::get('merch/setup/main_category_delete/{mcat_id}', 'Merch\Setup\MaterialController@mainCategoryDelete');
Route::get('merch/setup/item_edit/{mcat_id}', 'Merch\Setup\MaterialController@itemEdit');
Route::post('merch/setup/item_update', 'Merch\Setup\MaterialController@itemUpdate');
Route::get('merch/setup/item_delete/{mcat_id}', 'Merch\Setup\MaterialController@itemDelete');

//Materials Color
Route::get('merch/setup/color', 'Merch\Setup\MaterialController@color');
//Materials Color Store
Route::post('merch/setup/colorstore', 'Merch\Setup\MaterialController@colorStore');
//Materials Color Delete
Route::get('merch/setup/colordelete/{clr_id}', 'Merch\Setup\MaterialController@colorDelete');
//Materials Color update
Route::get('merch/setup/coloredit/{clr_id}', 'Merch\Setup\MaterialController@colorEdit');
Route::post('merch/setup/colorupdate', 'Merch\Setup\MaterialController@colorUpdate');
//Article & Dimension Booking
Route::get('merch/setup/articledimension', 'Merch\Setup\articledimensionController@article');

//Sample type
Route::get('merch/setup/sampletype', 'Merch\Setup\SampleController@sampleType');
//Sample type Store
Route::post('merch/setup/sampletypestore', 'Merch\Setup\SampleController@sampletypeStore');
//Sample type Delete
Route::get('merch/setup/sampletypedelete/{clr_id}', 'Merch\Setup\SampleController@sampletypeDelete');
//Sample type update
Route::get('merch/setup/sampletypedit/{clr_id}', 'Merch\Setup\SampleController@sampletypeEdit');
Route::post('merch/setup/sampletypeupdate', 'Merch\Setup\SampleController@sampletypeUpdate');
Route::get('merch/setup/sampletypecheck', 'Merch\Setup\SampleController@sampletypeCheck');

//Product Size
Route::get('merch/setup/productsize', 'Merch\Setup\ProductsizeController@productSize');
//Product Size
Route::get('merch/setup/productsize_brand_generate', 'Merch\Setup\ProductsizeController@brandGenerate');

//Product Size Store
Route::post('merch/setup/productsizestore', 'Merch\Setup\ProductsizeController@productSizeStore');

//Product Size Group Ajax Save
Route::get('merch/setup/sizegroupsave', 'Merch\Setup\ProductsizeController@sizegroupSave');
//Product Size Delete
Route::get('merch/setup/productsizedelete/{prdsz_id}', 'Merch\Setup\ProductsizeController@productSizeDelete');
//Product Size update
Route::get('merch/setup/productsizedit/{prdsz_id}', 'Merch\Setup\ProductsizeController@productSizeEdit');
Route::post('merch/setup/productsizeupdate', 'Merch\Setup\ProductsizeController@productSizeUpdate');
//Operation
// added by rubel
Route::get('merch/style/fetchoperations', 'Merch\Setup\OperationController@fetchOperations');
// end
Route::get('merch/setup/operation', 'Merch\Setup\OperationController@operation');
//Operation Store
Route::post('merch/setup/operationstore', 'Merch\Setup\OperationController@operationStore');
//Operation Delete
Route::get('merch/setup/operationdelete/{op_id}', 'Merch\Setup\OperationController@operationDelete');
//Operation update
Route::get('merch/setup/operationedit/{op_id}', 'Merch\Setup\OperationController@operationEdit');
Route::post('merch/setup/operationupdate', 'Merch\Setup\OperationController@operationUpdate');


//Special Machine
Route::get('merch/setup/spmachine', 'Merch\Setup\SpmachineController@spmachine');
//Special Machine Store
Route::post('merch/setup/spmachinestore', 'Merch\Setup\SpmachineController@spmachineStore');
//Special Machine Delete
Route::get('merch/setup/spmachinedelete/{spmachine_id}', 'Merch\Setup\SpmachineController@spmachineDelete');
//Special Machine update
Route::get('merch/setup/spmachineedit/{spmachine_id}', 'Merch\Setup\SpmachineController@spmachineEdit');
Route::post('merch/setup/spmachineupdate', 'Merch\Setup\SpmachineController@spmachineUpdate');

// Material Item
Route::post('merch/setup/item', 'Merch\Setup\MaterialController@itemStore');
Route::get('merch/setup/item_delete/{matitem_id}', 'Merch\Setup\MaterialController@itemDelete');
Route::get('merch/setup/item_edit/{matitem_id}', 'Merch\Setup\MaterialController@itemEdit');
Route::post('merch/setup/item_update', 'Merch\Setup\MaterialController@itemUpdate');
Route::get('merch/setup/sub_cat_by_main_cat', 'Merch\Setup\MaterialController@getSubCatByMainCat');
Route::get('merch/setup/item_code', 'Merch\Setup\MaterialController@itemCode');

//Materials Color & Size
Route::get('merch/setup/colorsize', 'Merch\Setup\MaterialController@colorSize');
Route::get('merch/setup/size', 'Merch\Setup\MaterialController@sizeForm');
Route::post('merch/setup/size', 'Merch\Setup\MaterialController@sizeStore');
Route::get('merch/setup/size_delete/{sz_id}', 'Merch\Setup\MaterialController@sizeDelete');
Route::get('merch/setup/size_edit/{sz_id}', 'Merch\Setup\MaterialController@sizeEdit');
Route::post('merch/setup/size_update', 'Merch\Setup\MaterialController@sizeUpdate');
Route::get('merch/setup/size_code', 'Merch\Setup\MaterialController@sizeCode');


//Article & Dimension Booking
Route::get('merch/setup/article/{sup_id}', 'Merch\Setup\ArticleController@articleForm');
Route::get('merch/setup/article', 'Merch\Setup\ArticleController@articleForm');
Route::post('merch/setup/article_store', 'Merch\Setup\ArticleController@articleStore');
Route::get('merch/setup/article_edit/{type}/{a_id}', 'Merch\Setup\ArticleController@articleEdit');
// Route::get('merch/setup/composition_edit/{a_id}', 'Merch\Setup\ArticleController@compositionEdit');
// Route::get('merch/setup/construction_edit/{a_id}', 'Merch\Setup\ArticleController@constructionEdit');
Route::post('merch/setup/article_update', 'Merch\Setup\ArticleController@articleUpdate');

Route::get('merch/setup/article_delete/{art_id}', 'Merch\Setup\ArticleController@articleDelete');
Route::get('merch/setup/comp_delete/{com_id}', 'Merch\Setup\ArticleController@compositionDelete');
Route::get('merch/setup/cons_delete/{cons_id}', 'Merch\Setup\ArticleController@constructionDelete');

Route::get('merch/setup/size_by_item', 'Merch\Setup\ArticleController@getSizeByItem');
Route::get('merch/setup/size_by_item', 'Merch\Setup\ArticleController@getSizeByItem');
Route::get('merch/setup/article_by_supllier', 'Merch\Setup\ArticleController@getArticleBySupplier');
Route::get('merch/setup/composition_by_article', 'Merch\Setup\ArticleController@getCompByArticle');
Route::get('merch/setup/add_new_article', 'Merch\Setup\ArticleController@addNewByArticle');
Route::get('merch/setup/add_new_composition', 'Merch\Setup\ArticleController@addNewComposition');

//Approval Hierarchy
Route::get('merch/setup/approval', 'Merch\Setup\ApprovalController@showForm');
Route::post('merch/setup/approval_store', 'Merch\Setup\ApprovalController@approvalStore');
Route::get('merch/setup/approval_edit/{id}', 'Merch\Setup\ApprovalController@approvalEdit');
Route::post('merch/setup/approval_update', 'Merch\Setup\ApprovalController@approvalUpdate');
Route::get('merch/setup/approv_delete/{id}','Merch\Setup\ApprovalController@deleteApprov');
//Wash Type
Route::get('merch/setup/wash_type','Merch\Setup\WashTypeController@showForm');
Route::post('merch/setup/wash_type','Merch\Setup\WashTypeController@saveForm');
Route::get('merch/setup/wash_type_edit/{id}','Merch\Setup\WashTypeController@editForm');
Route::post('merch/setup/wash_type_update','Merch\Setup\WashTypeController@updateForm');
Route::get('merch/setup/wash_type_delete/{id}','Merch\Setup\WashTypeController@deleteWash');
Route::post('merch/setup/wash_category_add','Merch\Setup\WashTypeController@saveWashCategory');

//Wash Category
Route::get('merch/setup/wash_category','Merch\Setup\WashCategoryController@showForm');
Route::post('merch/setup/wash_category_save','Merch\Setup\WashCategoryController@saveForm');
Route::get('merch/setup/wash_category_edit/{id}','Merch\Setup\WashCategoryController@editForm');
Route::post('merch/setup/wash_category_update','Merch\Setup\WashCategoryController@updateForm');
Route::get('merch/setup/wash_category_delete/{id}','Merch\Setup\WashCategoryController@deleteEntry');
/*
*--------------------------------------------------------------
* Style
*--------------------------------------------------------------
*/

Route::get('merch/style/style_new', 'Merch\Style\NewStyleController@showForm');
Route::post('merch/style/check-style-no', 'Merch\Style\NewStyleController@checkStlNo');
Route::get('merch/style/sample_season', 'Merch\Style\NewStyleController@getSampleByBuyer');
Route::post('merch/style/style_store', 'Merch\Style\NewStyleController@store');
Route::get('merch/style/style_list', 'Merch\Style\NewStyleController@showList');
Route::get("merch/style/delete/{id}", "Merch\Style\NewStyleController@styleDelete");

Route::get('merch/style/style_list_data', 'Merch\Style\NewStyleController@getData');
Route::get('merch/style/style_new_edit/{stl_id}', 'Merch\Style\NewStyleController@styleDevelopmentEditForm');
Route::post('merch/style/style_update', 'Merch\Style\NewStyleController@styleUpdate');

Route::get('merch/style/style_copy/{stl_id}', 'Merch\Style\NewStyleController@styleCopyForm');
Route::post('merch/style/style_copy_store', 'Merch\Style\NewStyleController@storeCopy');
// Route::post('merch/style/style_copy_store', 'Merch\Style\NewStyleController@styleNewCopy');
Route::get('merch/style/create_bulk', 'Merch\Style\NewStyleController@styleBulkForm');
Route::get('merch/style/style_copy_search', 'Merch\Style\NewStyleController@styleCopySearchForm');
Route::get('merch/style/style_profile/{stl_id}', 'Merch\Style\NewStyleController@getStyleProfile');

// Route::get('merch/style/find_bulk', 'Merch\Style\NewStyleController@styleFindBulk');

Route::post('merch/style/bulk_store', 'Merch\Style\NewStyleController@storeBulk');

Route::get('merch/style/product', 'Merch\Style\NewStyleController@productList');
Route::get('merch/style/season', 'Merch\Style\NewStyleController@seasonList');
Route::get('merch/style/wash', 'Merch\Style\NewStyleController@washList');
// added by rubel
Route::get('merch/style/fetchsizegroup/{buyerid}/{p_type}', 'Merch\Style\NewStyleController@fetchSizeGroup');
// end
Route::get('merch/style/sizegroup', 'Merch\Style\NewStyleController@sizegroupList');
Route::get('merch/style/buyerlist', 'Merch\Style\NewStyleController@buyerList');

// added by rubel
Route::get('merch/style/get_sz_grp_modal_data', 'Merch\Style\NewStyleController@getSzGrpModalData');
Route::get('merch/style/get_sz_grp_details', 'Merch\Style\NewStyleController@getSzGrpDetails');
Route::get('merch/style/fetchspecialmechines', 'Merch\Style\NewStyleController@fetchspecialmechines');


/*
*--------------------------------------------------------------
* STYLE BOM
*--------------------------------------------------------------
*/
Route::get("merch/style_bom", "Merch\StyleBOM\StyleBomController@showList");
Route::post("merch/style_bom_data", "Merch\StyleBOM\StyleBomController@getListData");
Route::get("merch/style_bom/{id}/create", "Merch\StyleBOM\StyleBomController@showForm");
Route::get("merch/style_bom/get_item_data", "Merch\StyleBOM\StyleBomController@getItemData");
Route::get("merch/style_bom/get_article_by_supplier", "Merch\StyleBOM\StyleBomController@article");
Route::get("merch/style_bom/get_composition_by_supplier", "Merch\StyleBOM\StyleBomController@composition");
Route::get("merch/style_bom/get_construction_by_supplier", "Merch\StyleBOM\StyleBomController@construction");
Route::post("merch/style_bom/{id}/store", "Merch\StyleBOM\StyleBomController@store");
Route::get("merch/style_bom/new_article", "Merch\StyleBOM\StyleBomController@createArticle");
Route::get("merch/style_bom/new_composition", "Merch\StyleBOM\StyleBomController@createComposition");
Route::get("merch/style_bom/new_construction", "Merch\StyleBOM\StyleBomController@createConstruction");
Route::get("merch/style_bom/{id}/edit", "Merch\StyleBOM\StyleBomController@editForm");
Route::post("merch/style_bom/{id}/update", "Merch\StyleBOM\StyleBomController@update");
Route::get("merch/style_bom/{id}/delete", "Merch\StyleBOM\StyleBomController@destroy");


Route::get("merch/style_bom/get_composition_by_article", "Merch\StyleBOM\StyleBomController@compositionByArticle");

/*
*--------------------------------------------------------------
* STYLE BOM Costing
*--------------------------------------------------------------
*/
Route::get("merch/style_costing", "Merch\StyleCosting\StyleCostingController@showList");
Route::post("merch/style_costing_data", "Merch\StyleCosting\StyleCostingController@getListData");
Route::get("merch/style_costing/{id}/create", "Merch\StyleCosting\StyleCostingController@showForm");
Route::post("merch/style_costing/{id}/create", "Merch\StyleCosting\StyleCostingController@store");
Route::get("merch/style_costing/{id}/edit", "Merch\StyleCosting\StyleCostingController@editForm");
Route::post("merch/style_costing/{id}/edit", "Merch\StyleCosting\StyleCostingController@update");
#----------------- Capacity Reservation by MATI --------------#
#-------------------------------------------------------------#
Route::get('merch/reservation/reservation','Merch\Reservation\ReservationController@showForm');
Route::post('merch/reservation/reservation','Merch\Reservation\ReservationController@storeData');
Route::get('merch/reservation/reservation_list','Merch\Reservation\ReservationController@getReservationList');
Route::get('merch/reservation/reservation_list_data','Merch\Reservation\ReservationController@getReservationListData');
Route::get('merch/reservation/reservation_edit/{res_id}','Merch\Reservation\ReservationController@resEdit');
Route::post('merch/reservation/reservation_update','Merch\Reservation\ReservationController@resUpdate');
Route::get('merch/orders/order_list','Merch\Orders\OrderController@orderList');
Route::post('merch/orders/order_list_data','Merch\Orders\OrderController@orderListData');
Route::get("merch/orders/delete/{id}", "Merch\Orders\OrderController@orderDelete");

Route::get('merch/orders/order_entry/{res_id}', 'Merch\Orders\OrderController@orderEntry');
Route::post('merch/orders/order_entry', 'Merch\Orders\OrderController@orderStore');
Route::get('merch/orders/order_edit/{order_id}', 'Merch\Orders\OrderController@orderEdit');
Route::post('merch/orders/order_update', 'Merch\Orders\OrderController@orderUpdate');

Route::get('merch/orders/order_copy/{order_id}', 'Merch\Orders\OrderController@orderCopyForm');
Route::post('merch/orders/order_copy/{order_id}', 'Merch\Orders\OrderController@orderCopyStore');


Route::get('merch/orders/purchase_order/{order_id}', 'Merch\Orders\OrderController@poEntry');
Route::get('merch/orders/sub_style_generate', 'Merch\Orders\OrderController@generateSubStyle');
Route::post('merch/orders/purchase_order_store', 'Merch\Orders\OrderController@poStore');
Route::get('merch/orders/purchase_order_delete/{order_id}/{po_id}', 'Merch\Orders\OrderController@poDelete');

/*
*--------------------------------------------------------------
* Time and Action
*--------------------------------------------------------------
*/

// TNA Library
Route::get('merch/time_action/library', 'Merch\TimeAction\TimeActionController@timeActionForm');
Route::post('merch/time_action/library_store', 'Merch\TimeAction\TimeActionController@libraryStore');
Route::get('merch/time_action/library_edit/{id}', 'Merch\TimeAction\TimeActionController@libraryEdit');
Route::post('merch/time_action/library_update', 'Merch\TimeAction\TimeActionController@libraryUpdate');
Route::get('merch/time_action/library_delete/{id}', 'Merch\TimeAction\TimeActionController@libraryDelete');

// TNA Template
Route::get('merch/time_action/tna_template', 'Merch\TimeAction\TimeActionController@templateForm');
Route::post('merch/time_action/tna_temp_store', 'Merch\TimeAction\TimeActionController@templateStore');
Route::get('merch/time_action/tna_template_edit/{id}', 'Merch\TimeAction\TimeActionController@templateEdit');
Route::post('merch/time_action/tna_template_update', 'Merch\TimeAction\TimeActionController@templateUpdate');
Route::get('merch/time_action/tna_template_delete/{id}', 'Merch\TimeAction\TimeActionController@templateDelete');
// Route::get('merch/time_action/tna_template_list', 'Merch\Style\TimeActionController@showTnaList');
// Route::get('merch/style/tna_template_data', 'Merch\TimeAction\TimeActionController@templateData');

// TNA Order
Route::get('merch/time_action/tna_order_list',
	'Merch\TimeAction\TnaOrderController@tnaOrderList');
Route::post('merch/time_action/tna_order_list_data',
	'Merch\TimeAction\TnaOrderController@tnaOrderListData');
Route::get('merch/time_action/tna_order', 'Merch\TimeAction\TnaOrderController@orderForm');
Route::get('merch/orders/po_edit_modal_data', 'Merch\Orders\OrderController@poEdit');
Route::get('merch/time_action/tna_order_edit/{id}',
	'Merch\TimeAction\TnaOrderController@tnaOrderEdit');
Route::post('merch/time_action/tna_order_update',
	'Merch\TimeAction\TnaOrderController@tnaOrderUpdate');
Route::get('merch/time_action/tna_order_delete/{id}',
	'Merch\TimeAction\TnaOrderController@tnaOrderDelete');

//
Route::post('merch/orders/purchase_order_update', 'Merch\Orders\OrderController@poUpdate');
Route::get('merch/time_action/tna_generate1', 'Merch\TimeAction\TnaOrderController@tnaGenerate1');
Route::get('merch/time_action/tna_generate', 'Merch\TimeAction\TnaOrderController@tnaGenerate');
Route::get('merch/time_action/templates_list', 'Merch\TimeAction\TnaOrderController@templatesList');


Route::post('merch/time_action/tna_generate_store', 'Merch\TimeAction\TnaOrderController@tnaGenerateStore');



#----------------- Order BOM by MATI --------------#
#-------------------------------------------------------------#
Route::get("merch/order_bom", "Merch\OrderBOM\OrderBomController@showList");
Route::post("merch/order_bom_data", "Merch\OrderBOM\OrderBomController@getListData");
Route::get("merch/order_bom/{id}/create", "Merch\OrderBOM\OrderBomController@showForm");
Route::get("merch/order_bom/{id}/preview", "Merch\OrderBOM\OrderBomController@previewOrder");
Route::get("merch/order_bom/get_item_data", "Merch\OrderBOM\OrderBomController@getItemData");
Route::post("merch/order_bom/{id}/store", "Merch\OrderBOM\OrderBomController@storeData");
Route::get("merch/order_bom/get_article_by_supplier", "Merch\OrderBOM\OrderBomController@article");

#----------------- Order Costing by MATI --------------#
#-------------------------------------------------------------#
Route::get("merch/order_costing", "Merch\OrderCosting\OrderCostingController@showList");
Route::post("merch/order_costing_data", "Merch\OrderCosting\OrderCostingController@getListData");
Route::get("merch/order_costing/{id}/create", "Merch\OrderCosting\OrderCostingController@showForm");
Route::post("merch/order_costing/{id}/create", "Merch\OrderCosting\OrderCostingController@store");
Route::get("merch/order_costing/{id}/edit", "Merch\OrderCosting\OrderCostingController@editForm");
Route::post("merch/order_costing/{id}/edit", "Merch\OrderCosting\OrderCostingController@update");


#----------------- Order Booking by MATI --------------#
#-------------------------------------------------------------#
Route::get("merch/order_booking", "Merch\OrderBooking\OrderBookingController@showList");
Route::post("merch/order_booking_data", "Merch\OrderBooking\OrderBookingController@getListData");
Route::get("merch/order_booking/{id}/create", "Merch\OrderBooking\OrderBookingController@showForm");
Route::post("merch/order_booking/{id}/create", "Merch\OrderBooking\OrderBookingController@store");
Route::get("merch/order_booking/{id}/edit", "Merch\OrderBooking\OrderBookingController@editForm");


/*----------------- Order Profile by Pavel ---------------------*/
Route::get('merch/order_profile','Merch\OrderProfile\ProfileController@index');
Route::get('merch/orders/order_profile_data','Merch\OrderProfile\ProfileController@orderProfileData');
Route::get('merch/orders/order_profile_show/{id}','Merch\OrderProfile\ProfileController@orderProfileShow');

/*-------------------order color and size breakdown-------------*/
Route::get('merch/order_breakdown','Merch\OrderBreakdown\OrderBreakDownController@index');
Route::get('merch/getOrder','Merch\OrderBreakdown\OrderBreakDownController@orderData');
Route::get('merch/order_breakdown/show/{id}','Merch\OrderBreakdown\OrderBreakDownController@show');
Route::post('merch/order_breakdown_store','Merch\OrderBreakdown\OrderBreakDownController@store');
Route::get('merch/order_breakdown_edit/{id}','Merch\OrderBreakdown\OrderBreakDownController@edit');
Route::post('merch/order_breakdown_update','Merch\OrderBreakdown\OrderBreakDownController@update');

Route::get('merch/order_booking_edit/{id}','Merch\OrderBooking\OrderBookingController@edit');
Route::post('merch/order_booking_update','Merch\OrderBooking\OrderBookingController@update');

// order bom details
Route::resource('order-bom-details', "Merch\OrderBOM\OrderBomDetailsController");
Route::get('merch/order_bom/single-order-details-info', "Merch\OrderBOM\OrderBomDetailsController@orderIdItemIdWise");
Route::get('merch/order_bom/item-wise-size-group', "Merch\OrderBOM\OrderBomDetailsController@itemWiseSizeGroup");
Route::get('merch/order_bom/item-wise-placement', "Merch\OrderBOM\OrderBomDetailsController@itemWisePlacement");

//MERCHANDISING reporting
Route::get('merch/report/report_view', "Merch\Report\ReportController@getReport");





// Abir's Additional 
Route::get('merch/report/report_view/tna_due_report', "Merch\Report\TimeActionDueReportController@tnaDueViewReport");
Route::get('merch/report/tna_report_ajax_call', "Merch\Report\TimeActionDueReportController@tnaDueReportResult");


// pavel supplier info update


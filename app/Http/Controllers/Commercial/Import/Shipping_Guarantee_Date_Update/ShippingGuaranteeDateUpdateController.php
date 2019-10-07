<?php

namespace App\Http\Controllers\Commercial\Import\Shipping_Guarantee_Date_Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\UdMaster;
use App\Models\Commercial\UdAmend;
use App\Models\Commercial\CmUdAmount;
use App\Models\Commercial\UdMasterHistory;
use App\Models\Commercial\UdLibraryFabric;
use App\Models\Commercial\UdLibraryAccessories;
use App\Models\Commercial\CmFile;

use DB, Validator, DataTables, Response;

class ShippingGuaranteeDateUpdateController extends Controller
{

   //loading shipping guarante initial page
   public function index(){
     $fileList = CmFile::select('file_no','id')
                        ->get();
     $sgNo = DB::table('cm_imp_data_update_sea_port')
                 ->pluck('id','sg_no');

     $piMasterid = DB::table('cm_invoice_pi_bom')
                      ->pluck('cm_pi_master_id');
      $piNo = DB::table('cm_pi_master')
                 ->whereIn('id',$piMasterid)
                 ->pluck('pi_no');

     return view("commercial/import/shipping_guarantee/shipping_guarantee_date_update",compact(
       "fileList",
       "sgNo",
       "piNo"
     ));
   }


   //get file wise lc_no
   public function filewiselcno($fileId){

     $lc_no = DB::table('cm_btb')
                  ->where('cm_file_id','=',$fileId)
                  ->select('id','lc_no')
                  ->get();

      return view("commercial/import/shipping_guarantee/file_wise_lc",compact(
        "lc_no"
      ));
   }

  //get file wise supplier
   public function filewisesupplier($fileId){

      $dtaEntryInfo = DB::table('cm_imp_data_entry')
                       ->where('cm_file_id',$fileId)
                       ->pluck('mr_supplier_sup_id');

      $supplier =  DB::table('mr_supplier')
                        ->whereIn('sup_id',$dtaEntryInfo)
                        ->select('sup_id','sup_name')
                        ->get();

      return view("commercial/import/shipping_guarantee/file_wise_supplier",compact(
        "supplier"
      ));

   }

   //shipping Guarantee Search
   public function shippingGuaranteeSearch(Request $request){

     $cm_file_id = $request->cm_file_id;
     $lcNo = $request->lcNo;
     $sgNo = $request->sgNo;
     $piNo = $request->piNo;
     $mode = $request->mode;
     $supplierId = $request->mr_supplier_sup_id;
     $value = $request->value;

        $query = DB::table('cm_imp_data_entry')
        ->leftJoin('cm_file','cm_imp_data_entry.cm_file_id','=','cm_file.id')
        ->leftJoin('mr_supplier','cm_imp_data_entry.mr_supplier_sup_id','=','mr_supplier.sup_id')
        ->leftJoin('cm_imp_data_update_sea_port','cm_imp_data_entry.id','=',
               'cm_imp_data_update_sea_port.cm_imp_data_entry_id')
        ->leftJoin('cm_btb','cm_imp_data_entry.cm_file_id','=','cm_btb.cm_file_id')
        ->select('cm_imp_data_entry.id as cm_imp_data_entry_id',
                 'cm_imp_data_entry.cm_file_id as cm_file_id',
                 'cm_file.file_no as file_no','mr_supplier.sup_name as sup_name',
                 'cm_imp_data_update_sea_port.sg_no as sg_no',
                 'cm_imp_data_update_sea_port.id as cm_imp_data_update_sea_port_id',
                 'cm_imp_data_entry.ship_mode as mode','cm_btb.lc_no as lc_no',
                 'cm_imp_data_entry.mr_supplier_sup_id as mr_supplier_sup_id',
                 'cm_imp_data_entry.value as value','cm_btb.id as cm_btb_id');

        if($cm_file_id != null){
            $query->where('cm_imp_data_entry.cm_file_id', $cm_file_id);
        }
        if($lcNo != null){
            $query->where('cm_btb.lc_no',$lcNo);
        }
        if($supplierId != null){
            $query->where('cm_imp_data_entry.mr_supplier_sup_id', $supplierId);
        }
        if($mode != null){
            $query->where('cm_imp_data_entry.ship_mode', $mode);
        }
        if($value != null){
            $query->where('cm_imp_data_entry.value', $value);
        }
        if($sgNo != null){
            $query->where('cm_imp_data_update_sea_port.sg_no', $sgNo);
        }
        $result = $query->get();
        return view("commercial/import/shipping_guarantee/search_result",
           compact(
          "result"
        ));

   }

   //shipping guarantee edit
   public function shippingGuaranteeEdit(Request $request){

     $cmImpDataEntryId = $request->cm_imp_data_entry_id;
     $cmbtbId = $request->cm_btb_id;
     $cmFileId = $request->cm_file_id;
     $cmImpDateUpdateSeaPortId= $request->cm_imp_date_update_sea_port_id;

     $data = DB::table('cm_ship_guarantee_update')
                ->where([['cm_imp_data_entry_id','=',$cmImpDataEntryId],['cm_btb_id','=',$cmbtbId]])
                ->first();
     return view("commercial/import/shipping_guarantee/edit_form",compact(
       "cmImpDataEntryId",
       "cmbtbId",
       "cmImpDateUpdateSeaPortId",
       "cmFileId",
       "data"
     ));
   }

   //shipping guarante save and update
   public function shippingGuaranteeSave(Request $request){

     $cmImpDataEntryId = $request->cm_imp_data_entry_id;
     $cmbtbId = $request->cm_btb_id;
     $cmFileId = $request->cm_file_id;
     $cmImpDataUpdateSeaPortId= $request->cm_imp_date_update_sea_port_id;
     $shipGurantRcvDate = $request->ship_gurant_rcv_date;
     $originalBlToCnfDate = $request->original_bl_to_cnf_date;
     $originalDocRcvDate = $request->original_doc_rcv_date;
     $sgSubBankDate = $request->sg_sub_bank_date;
     $sgRcvFromCnf = $request->sg_rcv_from_cnf;

    $cmShipGuaranteeUpdateId = $request->cm_ship_guarantee_update_id;

    if(!empty($cmShipGuaranteeUpdateId)){
      DB::table('cm_ship_guarantee_update')
         ->where('id', $cmShipGuaranteeUpdateId)
         ->update(
          [
           'cm_file_id' => $cmFileId,
           'cm_imp_data_entry_id' => $cmImpDataEntryId,
           'cm_btb_id' => $cmbtbId,
           'cm_imp_data_update_sea_port_id' => $cmImpDataUpdateSeaPortId,
           'ship_gurant_rcv_date' => $shipGurantRcvDate,
           'original_bl_to_cnf_date' => $originalBlToCnfDate,
           'original_doc_rcv_date' => $originalDocRcvDate,
           'sg_sub_bank_date' => $sgSubBankDate,
           'sg_rcv_from_cnf' => $sgRcvFromCnf
         ]
      );

    }else{
     DB::table('cm_ship_guarantee_update')
        ->insert(
         [
          'cm_file_id' => $cmFileId,
          'cm_imp_data_entry_id' => $cmImpDataEntryId,
          'cm_btb_id' => $cmbtbId,
          'cm_imp_data_update_sea_port_id' => $cmImpDataUpdateSeaPortId,
          'ship_gurant_rcv_date' => $shipGurantRcvDate,
          'original_bl_to_cnf_date' => $originalBlToCnfDate,
          'original_doc_rcv_date' => $originalDocRcvDate,
          'sg_sub_bank_date' => $sgSubBankDate,
          'sg_rcv_from_cnf' => $sgRcvFromCnf
        ]
     );
   }
     return back()->with("success", "Save Successful.");
   }

    //get shipping guarantee list
   public function shippingGuaranteeList(){
     return view("commercial/import/shipping_guarantee/shipping_guarantee_list");
   }

   //get shipping guarantee list data
   public function getShippingGuaranteeListData(){
     $data = DB::table('cm_ship_guarantee_update')
                ->leftJoin('cm_file','cm_ship_guarantee_update.cm_file_id','=','cm_file.id')
                ->leftJoin('cm_btb','cm_ship_guarantee_update.cm_btb_id','=','cm_btb.id')
                ->leftJoin('cm_imp_data_update_sea_port','cm_ship_guarantee_update.cm_imp_data_update_sea_port_id','=','cm_imp_data_update_sea_port.id')
                ->leftJoin('cm_imp_data_entry','cm_ship_guarantee_update.cm_imp_data_entry_id','=','cm_imp_data_entry.id')
                ->leftJoin('mr_supplier','cm_imp_data_entry.mr_supplier_sup_id','=','mr_supplier.sup_id')
                ->select( 'cm_ship_guarantee_update.id as id',
                          'cm_ship_guarantee_update.ship_gurant_rcv_date as ship_gurant_rcv_date',
                         'cm_file.file_no as file_no',
                         'cm_btb.lc_no as lc_no',
                         'cm_imp_data_update_sea_port.sg_no as sg_no',
                         'cm_imp_data_entry.ship_mode as mode',
                         'mr_supplier.sup_name as sup_name',
                         'cm_imp_data_entry.value as value',
                         'cm_ship_guarantee_update.cm_imp_data_entry_id as cm_imp_data_entry_id',
                         'cm_ship_guarantee_update.cm_btb_id as cm_btb_id',
                         'cm_ship_guarantee_update.cm_file_id as cm_file_id',
                         'cm_ship_guarantee_update.cm_imp_data_update_sea_port_id as cm_imp_data_update_sea_port_id'
                        )
                ->orderBy('cm_ship_guarantee_update.id','DESC')
                ->get();
       return DataTables::of($data)
           ->addColumn('action', function ($data) {
               return "<div class=\"btn-group\">
                   <a id=\"actionBtn\" class=\"btn btn-info btn-sm\" data-content-id=\"$data->id\"><i class=\"ace-icon fa fa-pencil bigger-120\"></i></a>
                   <a id=\"deleteBtn\" class=\"btn btn-danger btn-sm\" data-id=\"$data->id\"><i class=\"ace-icon fa fa-trash bigger-120\"></i></a>
               </div>";
           })
           ->rawColumns(['action'])
           ->toJson();
   }

   // get shipping guarante date info by shipGuaranteeUpdateId
   public function getShippingGuaranteeInfoById(Request $request){
        $result = DB::table('cm_ship_guarantee_update')->where('id','=',$request->shipGuaranteeId)->first();
        // echo json_encode($result);exit;
        return Response::json($result);
   }

   // shipping Guarantee edit post
   public function shippingGuaranteeDateEdit(Request $request){

     $shipGurantRcvDate = $request->ship_gurant_rcv_date;
     $originalBlToCnfDate = $request->original_bl_to_cnf_date;
     $originalDocRcvDate = $request->original_doc_rcv_date;
     $sgSubBankDate = $request->sg_sub_bank_date;
     $sgRcvFromCnf = $request->sg_rcv_from_cnf;

        DB::table('cm_ship_guarantee_update')
           ->where('id', $request->ship_guarantee_id)
           ->update(
            [
             'ship_gurant_rcv_date' => $shipGurantRcvDate,
             'original_bl_to_cnf_date' => $originalBlToCnfDate,
             'original_doc_rcv_date' => $originalDocRcvDate,
             'sg_sub_bank_date' => $sgSubBankDate,
             'sg_rcv_from_cnf' => $sgRcvFromCnf
           ]
        );

        return back()->with("success", "Save Successful.");
   }

   //shipping guarantee date delete
   public function shippingGuaranteeDateDelete(Request $request){

        DB::table('cm_ship_guarantee_update')
           ->where('id', $request->ship_guarantee_id)
           ->delete();

        return back()->with("success", "Delete Successful.");
   }

}

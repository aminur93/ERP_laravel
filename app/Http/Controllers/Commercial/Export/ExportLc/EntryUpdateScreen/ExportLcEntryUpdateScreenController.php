<?php
namespace App\Http\Controllers\Commercial\Export\ExportLc\EntryUpdateScreen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Buyer;
use App\Models\Commercial\Bank;
use App\Models\Commercial\BankAccNo;
use App\Models\Commercial\SalesContract;
use App\Models\Commercial\SalesContractOrder;
use App\Models\Merch\Country;
use App\Models\Merch\OrderEntry;
use App\Models\Hr\Unit;
use Validator, DB, ACL, Auth, DataTables;



class ExportLcEntryUpdateScreenController extends Controller
{

 //get entry update screen2
 public function getEntryUpdateScreen(){
   $hr_unit = DB::table('hr_unit')
                 ->pluck('hr_unit_short_name','hr_unit_id');
   return view("commercial/export/export_lc/entry_update_screen/export_lc_entry_update_screen2", compact(
     "hr_unit"
   ));

 }
 public function getEntryUpdateScreen3(){
   $hr_unit = DB::table('hr_unit')
                 ->pluck('hr_unit_short_name','hr_unit_id');
   $hub = DB::table('cm_hub')
              ->pluck('hub_name','id');

   $passBookVol = DB::table('cm_passbook_volume')
                      ->pluck('volume_no','volume_no');
   $passBookPage = DB::table('cm_passbook_volume')
                       ->pluck('page_no','page_no');

   return view("commercial/export/export_lc/entry_update_screen/export_lc_entry_update_screen3", compact(
     "hr_unit",
     "hub",
     "passBookVol",
     "passBookPage"
   ));

 }
 //entry update screen2 save
 public function entryUpdateScreenSave(Request $request){

     $validator = Validator::make($request->all(), [
         "unit"                                    => "required",
         "invoiceno"                               => "required",
         "cf_doc_dispatch_date"                    => "required|date",
         "ex_fty_date"                             => "required|date",
         "shipping_company"                        => "required",
         "staffing_date"                           => "required|date",
         "feeder_vessel_name_no"                   => "required",
         "vessel_berth"                            => "required",
         "transport_doc_no_of_ship_co"             => "required",
         "transport_doc_date_of_ship_co"           => "required|date",
         "shipping_bill_no"                        => "required",
         "shipping_bill_date"                      => "required|date",
         "examine_date"                            => "required|date",
         "exp_release_date"                        => "required|date",
         "data"                                    => "required",
     ]);

   if ($validator->fails())
   {
       return back()
           ->withErrors($validator)
           ->withInput()
           ->with('error', "Incorrect Input!!");
   }
   else
   {
     $update2 = DB::table('cm_exp_update2')->insert([
           'unit_id'                 => $request->unit,
           'invoice_no'              =>$request->invoiceno,
           'cnf_doc_dispatch_date'   => $request->cf_doc_dispatch_date,
           'ex_fty_date'             => $request->ex_fty_date,
           'agent_inv_no'            => $request->agent_invoice_no,
           'ship_company'            =>$request->shipping_company,
           'staffing_date'           => $request->staffing_date,
           'feeder_vessel_details'   =>$request->feeder_vessel_name_no,
           'vessel_berth'            => $request->vessel_berth,
           'transp_doc_no'           => $request->transport_doc_no_of_ship_co,
           'transp_doc_date'         => $request->transport_doc_date_of_ship_co,
           'ship_bill_no'            => $request->shipping_bill_no,
           'ship_bill_date'          => $request->shipping_bill_date,
           'examine_date'            => $request->examine_date,
           'exp_release_date'        => $request->exp_release_date,
           'final_date_status'       =>isset($request->final_date)?1:0
         ]);

       if($update2){
          $containerDatas = $request->data;
          $update2Id = DB::getPdo()->lastInsertId('cm_exp_update2');

            foreach ($containerDatas as $containerData) {
              DB::table('cm_exp_update2_container')->insert([
                    'cm_exp_update2_id'  => $update2Id,
                    'container_no'       => $containerData['containerno'],
                    'size'               => $containerData['size'],
                    'container_sl'       => $containerData['containersi'],
                    'qty'                => $containerData['qty'],
                    'uom'                => $containerData['uom'],
                    'pkg'                =>$containerData['pkg']

              ]);
            }
        }else{
          return back()->with("error", "Something went wrong.Please try again");
        }
      return back()->with("success", "Save Successful.");
   }
 }

 //entry update screen3 save
 public function entryUpdateScreen3Save(Request $request){

     $validator = Validator::make($request->all(), [
         "unit"                            => "required",
         "invoiceno"                       => "required",
         "vessel_sail"                     => "required",
         "forwarder_name"                  => "required",
         "fcr_no"                          => "required",
         "fcr_date"                        => "required|date",
         "hub"                             => "required",
         "mother_vessel"                   => "required",
         "voyage"                          => "required",
         "etd_hub"                         => "required",
         "eta_destination"                 => "required",
         "doc_sub_to_buyer"                => "required",
         "payment_invoice_sd"              => "required",
         "bi_surrender_date"               => "required|date",
         "ic_rec_date"                     => "required|date",
         "f_amount"                        => "required",
         "f_amount_currancy"               => "required",
         "marine_insurance_value"          => "required",
         "marine_insurance_value_currancy" => "required",
         "insurance_charge"                => "required",
         "insurance_charge_currancy"       => "required",
         "shipping_doc_courier_name"       => "required",
         "shipping_doc_courier_number"     => "required",
         "shipping_doc_courier_date"       => "required|date",
         "carrier_name"                    => "required",
         "actual_freight_amt"              => "required",
         "actual_freight_amt_currancy"     => "required",
         "actual_freight_date"             => "required|date",
         "import_fabric_from_epz"          => "required",
         "pass_book_vol_no"                => "required",
         "pass_book_page_no"               => "required",
     ]);

   if ($validator->fails())
   {
       return back()
           ->withErrors($validator)
           ->withInput()
           ->with('error', "Incorrect Input!!");
   }
   else
   {
     $cm_passbook_volume = DB::table('cm_passbook_volume')
                                 ->where('volume_no',$request->pass_book_vol_no)
                                 ->where('page_no',$request->pass_book_page_no)
                                 ->first();

     $update3 = DB::table('cm_exp_update3')->insert([
           'hr_unit'                   => $request->unit,
           'invoice_no'                =>$request->invoiceno,
           'vessel_sail'               => $request->vessel_sail,
           'forwarder_name'            => $request->forwarder_name,
           'fcr_no'                    => $request->fcr_no,
           'cm_hub_id'                 =>$request->hub,
           'mother_vessel'             => $request->mother_vessel,
           'voyage'                    =>$request->voyage,
           'etd_hub'                   => $request->etd_hub,
           'eta_destination'           => $request->eta_destination,
           'doc_sub_buyer'             => $request->doc_sub_to_buyer,
           'payment_inv_sd'            => $request->payment_invoice_sd,
           'bl_surrender_date'         => $request->bi_surrender_date,
           'f_amount'                  => $request->f_amount,
           'amount_currency'           => $request->f_amount_currancy,
           'marine_ins_value'          => $request->marine_insurance_value,
           'marine_ins_currency'       => $request->marine_insurance_value_currancy,
           'insurance_charge'          => $request->insurance_charge,
           'insurance_currency'        => $request->insurance_charge_currancy,
           'shipping_doc_courier_name' => $request->shipping_doc_courier_name,
           'shipping_doc_courier_no'   => $request->shipping_doc_courier_number,
           'shipping_doc_courier_date' => $request->shipping_doc_courier_date,
           'carrier_name'              => $request->carrier_name,
           'actual_fright_amt'         => $request->actual_freight_amt,
           'actual_fright_currency'    => $request->actual_freight_amt_currancy,
           'actual_fright_date'        => $request->actual_freight_date,
           'import_from_epz'           => $request->import_fabric_from_epz,
           'cm_passbook_volume_id'     => $cm_passbook_volume->id,

     ]);
     if($update3){
      return back()->with("success", "Save Successful.");
    }else{
      return back()->with("error", "Something Went Wrong Please Try Again");
    }
   }
 }

//get invoice no by unit id
 public function ajaxgetInvoiceNoByUnitId($hrUnitId){

   $result = DB::table('cm_exp_data_entry_1')
                ->where('unit_id',$hrUnitId)
                ->pluck('inv_no','inv_no');
   echo $result;exit;

 }

 //get agent code by invoice no
 public function ajaxgetAgentCodeByInvoiceNo($invoiceNo){
   $result = DB::table('cm_exp_data_entry_1')
                 ->join('cm_agent','cm_exp_data_entry_1.cm_agent_id' ,'=','cm_agent.id')
                 ->where('cm_exp_data_entry_1.inv_no',$invoiceNo)
                 ->select('cm_agent.agent_name as agent_name')
                 ->first();

    $agentName = $result->agent_name;
    $agentInvoiceNo = strtoupper(substr($agentName, 0,2)).$this->randomnum(5);

   echo $agentInvoiceNo;exit;
 }

 function randomnum($length)
    {
        $randstr = "";
        srand((double)microtime() * 1000000);
        //our array add all letters and numbers if you wish
        $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        for ($rand = 0; $rand <= $length; $rand++) {
            $random = rand(0, count($chars) - 1);
            $randstr .= $chars[$random];
        }
        return $randstr;
    }

}

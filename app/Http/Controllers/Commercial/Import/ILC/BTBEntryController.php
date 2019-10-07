<?php

namespace App\Http\Controllers\Commercial\Import\ILC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Supplier;
// use App\Models\Commercial\PiType;
// use App\Models\Commercial\FromDateOf;
// use App\Models\Commercial\LcPeriod;
// use App\Models\Commercial\LcType;
use App\Models\Commercial\BTBEntry;
use App\Models\Commercial\BTBAmend;
// use App\Models\Commercial\B2BAmendment;
// use App\Models\Commercial\B2BHistory;
use DB, ACL, DataTables, Auth, Validator;

class BTBEntryController extends Controller
{
    //Entry Form
    public function showForm(){

    	$fileList= DB::table('cm_file')->where('file_type', 1)->where('status', 1)->pluck('file_no', "id");
        $paymentTypeList= DB::table('cm_payment_type')->pluck('type_name', 'id');
        $supplierList= Supplier::pluck('sup_name', 'sup_id');
        $termList= DB::table('cm_inco_term')->pluck('name', 'id');
    	$periodList= DB::table('cm_period')->pluck('period_name', 'id');
        $dateList= DB::table('cm_from_date')->pluck('from_date', 'id');
        $lcTypeList= DB::table('cm_lc_type')->pluck('lc_type_name', 'id');

    	return view('commercial/import/ilc/btb_entry', compact('fileList', 'paymentTypeList', 'supplierList', 'termList', 'periodList', 'dateList', 'lcTypeList'));
    }

    //Cancel Close Information
    public function cancelCloseInfo(Request $request){

        $lc_sum=0;
        $last_cancel_date= null;
        $is_file_closed= null;
        $file_close_date= null;

        
        //chech whether file is closed or not
        $is_file_closed= DB::table('cm_file')
                            ->where('id', $request->file_no)
                            ->pluck('status')
                            ->first();
       
        //if file is not closed check for cancelled date and amount      
        if($is_file_closed==1){

            //get the "cancelled id's" from "cm_btb" table
            //this is the primary key against a file number
            $cancelled_btbs= DB::table('cm_btb')
                        ->where('cm_file_id', $request->file_no)
                        ->where('lc_active_status', 0)
                        ->pluck('id AS btb_id')
                        ->toArray();
            
            //get cancelled amount
            for($i=0; $i<sizeof($cancelled_btbs); $i++){
                $lc_sum+= DB::table('cm_btb_amend')
                                    ->where('cm_btb_id', $cancelled_btbs[$i])
                                    ->orderBy('id', "DESC")
                                    ->pluck('amend_total_lc_amount')
                                    ->first();
                
                //last Cancelled date
                if($i== (sizeof($cancelled_btbs)-1)){
                    $last_cancel_date = DB::table('cm_btb')
                                        ->where('id', $cancelled_btbs[$i])
                                        ->pluck('cancel_date')
                                        ->first();
                }
            }
        }



            //get supplier list

            //get pi master list of that file id
            $pi_masters= DB::table('cm_pi_master')
                            ->where('cm_file_id', $request->file_no)
                            ->pluck('id')
                            ->toArray();

            //get supplier list from pi bom table of the above masters
            $supplier= DB::table('cm_pi_bom AS pib')
                            ->select('bom.mr_supplier_sup_id')
                            ->whereIn('pib.cm_pi_master_id', $pi_masters)
                            ->leftJoin('mr_order_bom_costing_booking AS bom', 'bom.id', 'pib.mr_order_bom_costing_booking_id')
                            ->groupBy('mr_supplier_sup_id')
                            ->get();

            $suppliers= Array();
            foreach ($supplier as $sup) {
                $suppliers[]= $sup->mr_supplier_sup_id;
            }
            $suppliers= Supplier::whereIn('sup_id', $suppliers)
                                ->pluck('sup_name', 'sup_id');

            $supplierList= '<option value="">Select Supplier</option>';

            foreach ($suppliers as $key => $value) {
                $supplierList.='<option value="'.$key.'">'.$value.'</option>';
            }
            
        $data[0]= $lc_sum;
        $data[1]= $last_cancel_date;
        $data[2]= $is_file_closed;
        $data[3]= $last_cancel_date;
        $data[4]= $supplierList;
        return $data;
    }


    //get PI BOM information
    public function piBomInfo(Request $request){
        
        $masterPis= DB::table('cm_pi_master')
                        ->where('mr_supplier_sup_id', $request->supplier)
                        ->whereNUll('btb_lc_no')
                        ->select([
                            "pi_no",
                            "total_pi_value"
                        ])
                        ->get();

        $sum= $masterPis->sum('total_pi_value');
        $pi_raws= "";
        foreach ($masterPis as $master) {
            $pi_raws.='<tr>
            <td>'.$master->pi_no.'</td>
            <td>'.$master->total_pi_value.'</td>
            </tr>';
        }
        $data= array();

        $data[0]= $sum;
        $data[1]= $pi_raws;

        return $data;
    }

    //Save form data
    public function saveForm(Request $request){

    	$validator= Validator::make($request->all(), [
                              "cm_file_id" => "required| max:11",
                              "mr_supplier_sup_id" => "required| max:11",
                              "cm_payment_type_id" => "required| max:11",
                              "lc_no" => "required| max:45",
                              "lc_status" => "required",
                              "lc_date" => "required",
                              "cm_inco_term_id" => "required",
                              "b2b_amend_total_amount" => "required",
                              "lc_currency" => "required",
                              "amend_remark" => "required| max:45",
                              "marine_ins_no" => "required| max:45",
                              "marine_ins_cover_date" => "required",
                              "lca_no" => "required| max:45",
                              "last_ship_date" => "required",
                              "expiry_date" => "required",
                              "cm_period_id" => "required| max:11",
                              "cm_from_date_id" => "required| max:11",
                              "cm_lc_type_id" => "required| max:11",
                              "interest" => "required",
                	       ]);

    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{
    		$btb= new BTBEntry();
    		$btb->cm_file_id          = $request->cm_file_id;
    		$btb->mr_supplier_sup_id  = $request->mr_supplier_sup_id;
    		$btb->cm_payment_type_id  = $request->cm_payment_type_id;
    		$btb->lc_no               = $request->lc_no;
            $btb->lc_status           = $request->lc_status;
    		$btb->lc_date             = $request->lc_date;
    		$btb->cm_inco_term_id     = $request->cm_inco_term_id;
    		$btb->lc_currency         = $request->lc_currency;
    		$btb->cm_period_id        = $request->cm_period_id;
    		$btb->cm_from_date_id     = $request->cm_from_date_id;
    		$btb->interest            = $request->interest;
    		$btb->cm_lc_type_id       = $request->cm_lc_type_id;
    		$btb->lc_active_status    = 1;
    		$btb->save();

    		$btb_id= $btb->id;
            //Keep Log
            $this->logFileWrite("BTB Entry(Fabric, Accessories) Created", $btb_id);

            //Save amendment
    		$amendment= new BTBAmend();
    		$amendment->amend_no  = 0;
    		$amendment->amend_date  = date("Y-m-d");
    		$amendment->amend_reason  = "New";
    		$amendment->last_ship_date  = $request->last_ship_date;
    		$amendment->expiry_date  = $request->expiry_date;
    		$amendment->lca_no  = $request->lca_no;
    		$amendment->amend_remark  = $request->amend_remark;
    		$amendment->amend_total_lc_amount  = $request->b2b_amend_total_amount;
            $amendment->marine_ins_no  = $request->marine_ins_no;
            $amendment->marine_ins_cover_date  = $request->marine_ins_cover_date;
            $amendment->cm_btb_id  = $btb_id;
    		$amendment->save();

            //Keep Log
            $this->logFileWrite("BTB Amendment Created", $amendment->id);

    		return back()
    			->with('success', "BTB Saved Successfully!!");


    	}
    }

    //BTB List
    public function btbList(){

        $supplierList = Supplier::pluck('sup_name');
        $typeList= DB::table('cm_period')->pluck('period_name');

        return view('commercial/import/ilc/btb_list', compact('supplierList','typeList'));
    }

    //BTB List data
    public function btbListData(){

        //get list data from cm_btb table
        $data= DB::table('cm_btb AS b')
                ->select([
                    "b.id",
                    "b.cm_file_id",
                    "b.mr_supplier_sup_id",
                    "b.lc_no",
                    "b.lc_status",
                    "b.lc_date",
                    "b.cm_lc_type_id",
                    "b.lc_active_status",
                    "f.file_no",
                    "s.sup_name",
                    "l.lc_type_name",
                ])
                ->leftJoin('cm_file AS f', 'f.id', 'b.cm_file_id')
                ->leftJoin('mr_supplier AS s', 's.sup_id', 'b.mr_supplier_sup_id')
                ->leftJoin('cm_lc_type AS l', 'l.id', 'b.cm_lc_type_id')
                ->get();

        return DataTables::of($data)->addIndexColumn()
                ->editColumn('lc_active_status', function($data){
                    if($data->lc_active_status == 1)
                        return "Active";
                    else
                        return "Cancel";
                })
                ->addColumn('action', function($data){
                     $action_buttons= "<div class=\"btn-group\">  
                            <a href=".url('commercial/import/ilc/btb/'.$data->id.'/edit')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
                                <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                            </a> 
                            <a href=".url('commercial/import/ilc/btb/'.$data->id.'/delete')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" style=\"height:25px; width:26px;\">
                                <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                            </a> ";
                        $action_buttons.= "</div>";

                        return $action_buttons;
                })
                ->toJson();
    }

    //Delete BTB
    public function btbDelete($id){

        //delete BTB Entry
        BTBEntry::where('id', $id)->delete();
        //Keep Log
        $this->logFileWrite("BTB Entry(Fabric, Accessories) Deleted", $id);
        
        //Delete Amendments
        DB::table('cm_btb_amend')->where('cm_btb_id', $id)->delete();
        //Keep Log
        $this->logFileWrite("BTB Amendment (Fabric, Accessories) Deleted", $id);
        
        return redirect('commercial/import/ilc/btb_list')
                ->with('success', "BTB deleted!");
    }

        //BTB Edit
    public function btbEdit($id){

        $fileList= DB::table('cm_file')->where('status', 1)->pluck('file_no', "id");
        $paymentTypeList= DB::table('cm_payment_type')->pluck('type_name', 'id');
        $supplierList= Supplier::pluck('sup_name', 'sup_id');
        $termList= DB::table('cm_inco_term')->pluck('name', 'id');
        $periodList= DB::table('cm_period')->pluck('period_name', 'id');
        $dateList= DB::table('cm_from_date')->pluck('from_date', 'id');
        $lcTypeList= DB::table('cm_lc_type')->pluck('lc_type_name', 'id');

        $btb= BTBEntry::where('id', $id)->first();
        $amendments= DB::table('cm_btb_amend')->where('cm_btb_id', $id)->get();
        // getting lca amount after last ammendment
        $last_amend= DB::table('cm_btb_amend')
                        ->where('cm_btb_id', $id)
                        ->orderBy('id', "DESC")
                        ->first();
        // dd($last_amend);
        return view('commercial/import/ilc/btb_edit', compact('fileList', 'paymentTypeList', 'supplierList', 'termList', 'periodList', 'dateList', 'lcTypeList', 'btb', 'amendments', 'last_amend'));

        
        
        
        $amendments= B2BAmendment::where('b2b_id', $id)->get();
        

            if($btb->b2b_item == 1){
                $supplierList= DB::table('com_master_pi_fabric')
                    ->where('exp_lc_fileno', $btb->file_no)
                    ->groupBy('master_pi_fab_sup_code')
                    ->pluck('master_pi_fab_sup_code', 'master_pi_fab_sup_code');
            }
            else if($btb->b2b_item == 2){
                $supplierList= DB::table('com_master_pi_accessories')
                    ->where('exp_lc_fileno', $btb->file_no)
                    ->groupBy('master_pi_acss_sup_code')
                    ->pluck('master_pi_acss_sup_code', 'master_pi_acss_sup_code');
            }
            else if($btb->b2b_item == 3){
                $sup_fab= DB::table('com_master_pi_fabric')
                    ->where('exp_lc_fileno', $btb->exp_lc_fileno)
                    ->groupBy('master_pi_fab_sup_code')
                    ->pluck('master_pi_fab_sup_code', 'master_pi_fab_sup_code');
                $sup_acc= DB::table('com_master_pi_accessories')
                    ->where('exp_lc_fileno', $btb->exp_lc_fileno)
                    ->groupBy('master_pi_acss_sup_code')
                    ->pluck('master_pi_acss_sup_code', 'master_pi_acss_sup_code');

                $supplierList= $sup_fab->merge($sup_acc);
            }
            //get supplier Name and Amount
            $sup_info = $this->getNameAmount($btb->exp_lc_fileno, $btb->b2b_lc_sup_code);
        // dd($amendments);
        return view('commercial/import/ilc/btb_edit', compact('btb', 'amendments', 'supplierList', 'piTypeList', 'dateOfList', 'periodList', 'lcTypeList', 'sup_info'));
    }

    //BTB Update

    public function btbUpdate(Request $request){
        
        $validator= Validator::make($request->all(), [
                            "btb_id"            =>"required| max:11",
                            "cm_file_id"        => "required| max:11",
                            "mr_supplier_sup_id"=> "required| max:11",
                            "cm_payment_type_id"=> "required| max:11",
                            "lc_no"             => "required| max:45",
                            "lc_status"         => "required",
                            "lc_date"           => "required",
                            "cm_inco_term_id"   => "required",
                            "lc_currency"       => "required",
                            "cm_period_id"      => "required| max:11",
                            "cm_from_date_id"   => "required| max:11",
                            "cm_lc_type_id"     => "required| max:11",
                            "interest"          => "required"
                           ]);

        if($validator->fails()){
            return back()
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        else{
            $btb_id= $request->btb_id;

            BTBEntry::where('id', $btb_id)
                        ->update([
                            "cm_file_id"        => $request->cm_file_id,
                            "mr_supplier_sup_id"=> $request->mr_supplier_sup_id,
                            "cm_payment_type_id"=> $request->cm_payment_type_id, 
                            "lc_no"             => $request->lc_no,
                            "lc_status"         => $request->lc_status,
                            "lc_date"           => $request->lc_date,
                            "cm_inco_term_id"   => $request->cm_inco_term_id,
                            "lc_currency"       => $request->lc_currency,
                            "cm_period_id"      => $request->cm_period_id, 
                            "cm_from_date_id"   => $request->cm_from_date_id, 
                            "cm_lc_type_id"     => $request->cm_lc_type_id,
                            "interest"          => $request->interest,
                            "lc_active_status"          => $request->btb_status
                        ]);
            if($request->btb_status== 0){
                BTBEntry::where('id', $btb_id)
                        ->update([
                            "cancel_date"          => $request->btb_cancel_date
                        ]);
            }

            //Keep Log
            // $this->logFileWrite("BTB Entry(Fabric, Accessories) Created", $btb_id);

            //Save amendment
            if($request->has('am_amend_id')){

                $validator= Validator::make($request->all(),[
                            "am_amend_id"       => "required",
                            "am_amend_date"     => "required",
                            "am_reason"         => "required",
                            "am_amend_value"    => "required",
                            "am_ship_date"      => "required",
                            "am_expiry_date"    => "required",
                            "am_lca_no"         => "required",
                            "am_remark"         => "required",
                            "am_total_amount"   => "required",
                            "marine_ins_no"     => "required",
                            "marine_ins_cover_date" => "required"
                ]);
                if(!($validator->fails())){
                    
                    $amendment= new BTBAmend();
                    $amendment->amend_no  = $request->am_amend_id;
                    $amendment->amend_date  = $request->am_amend_date;
                    $amendment->amend_reason  = $request->am_reason;
                    $amendment->amend_value  = $request->am_amend_value;
                    $amendment->last_ship_date  = $request->am_ship_date;
                    $amendment->expiry_date  = $request->am_expiry_date;
                    $amendment->lca_no  = $request->am_lca_no;
                    $amendment->amend_remark  = $request->am_remark;
                    $amendment->amend_total_lc_amount  = $request->am_total_amount;
                    $amendment->marine_ins_no  = $request->marine_ins_no;
                    $amendment->marine_ins_cover_date  = $request->marine_ins_cover_date;
                    $amendment->cm_btb_id  = $btb_id;
                    $amendment->save();
                    //Keep Log
                    // $this->logFileWrite("BTB Amendment Created", $amendment->id);
                }
            }
             return back()
                    ->with('success', "BTB updated Successfully!!");
        }
    }
    //previous code=======================================
    public function cancelCloseInformation(Request $request){
        
        if($request->has('file_no')){
            //get the "exp_lc_id" from "com_exp_lc_entry" table
            //this is the primary key against a file number
            $lc_entry= DB::table('com_exp_lc_entry')
                        ->where('exp_lc_fileno', $request->file_no)
                        ->select(['exp_lc_id', 'exp_lc_file_status'])
                        ->first();

            $status=1;
            $date=null;
            //if this files status is closed then take the close date
            if($lc_entry->exp_lc_file_status == 0){
                $status=0;
                $date= DB::table('com_exp_lc_close')
                            ->where('exp_lc_id', $lc_entry->exp_lc_id)
                            ->pluck('exp_lc_close_date')
                            ->first();
            }
            $data['status']= $status;
            $data['date']= $date;
            //Get the lc numbers whose status is cancelled
            $cancelled_lc= B2BEntry::where('exp_lc_fileno', $request->file_no)
                            ->where('b2b_status', 0)
                            ->select([
                                'b2b_id',
                                'exp_lc_fileno',
                                'b2b_lc_no',
                                'b2b_lc_cancel_date'
                            ])
                            ->get();

            //get the last lc cancelled date from B2b entry table
            $cancelled_date=null;
            $cancelled_date= B2BEntry::where('exp_lc_fileno', $request->file_no)
                            ->where('b2b_status', 0)
                            ->orderBy('b2b_lc_cancel_date', 'DESC')
                            ->pluck('b2b_lc_cancel_date')
                            ->first();
            if($cancelled_date != "")
                $cancelled_date= date("Y-m-d",strtotime($cancelled_date));
            
            //For every b2b number calculate the total summation of the lc no's whose status is calcelled
            $canceled_amount=0;
            foreach($cancelled_lc AS $clc){
                $canceled_amount+= DB::table('com_b2b_entry_amendment')
                                    ->where('b2b_id', $clc->b2b_id)
                                    ->pluck(
                                        DB::raw('SUM(b2b_amend_total_amount) AS total')
                                    )
                                    ->first();
            }
            $data['canceled_amount']= $canceled_amount;
            $data['cancelled_date']= $cancelled_date;
            return $data;
        }
    }
    public function getSupCode(Request $request){
        // dd($request->all());
        if($request->has('b2b_item')){
            if($request->b2b_item == 1){
                $sup= DB::table('com_master_pi_fabric')
                    ->where('exp_lc_fileno', $request->file_no)
                    ->groupBy('master_pi_fab_sup_code')
                    ->pluck('master_pi_fab_sup_code', 'master_pi_fab_sup_code');
                $data="<option value=\"\">Select Supplier Code</option>";
                foreach ($sup as $key => $value) {
                    $data.= "<option value=\"$key\">$value</option>";
                }
            }
            else if($request->b2b_item == 2){
                $sup= DB::table('com_master_pi_accessories')
                    ->where('exp_lc_fileno', $request->file_no)
                    ->groupBy('master_pi_acss_sup_code')
                    ->pluck('master_pi_acss_sup_code', 'master_pi_acss_sup_code');
                $data="<option value=\"\">Select Supplier Code</option>";
                foreach ($sup as $key => $value) {
                    $data.= "<option value=\"$key\">$value</option>";
                }
            }
            else if($request->b2b_item == 3){
                $sup= DB::table('com_master_pi_fabric')
                    ->where('exp_lc_fileno', $request->file_no)
                    ->groupBy('master_pi_fab_sup_code')
                    ->pluck('master_pi_fab_sup_code', 'master_pi_fab_sup_code');
                $data="<option value=\"\">Select Supplier Code</option>";
                foreach ($sup as $key => $value) {
                    $data.= "<option value=\"$key\">$value</option>";
                }
                $sup= DB::table('com_master_pi_accessories')
                    ->where('exp_lc_fileno', $request->file_no)
                    ->groupBy('master_pi_acss_sup_code')
                    ->pluck('master_pi_acss_sup_code', 'master_pi_acss_sup_code');
                foreach ($sup as $key => $value) {
                    $data.= "<option value=\"$key\">$value</option>";
                }
            }
        }
        else{
                $data= "<option value=\"\">No Supplier Code found!!</option>";
            }
        return $data;
    }

    public function getSupInfo(Request $request){
        // getting supplier Name
        $sup_id= DB::table('com_master_pi_fabric')
                        ->where('master_pi_fab_sup_code', $request->sup_code)
                        ->pluck('sup_id')
                        ->first();

        if($sup_id == ""){
            $sup_id= DB::table('com_master_pi_accessories')
                        ->where('master_pi_acss_sup_code', $request->sup_code)
                        ->pluck('sup_id')
                        ->first();
        }
        $sup_name= DB::Table('mr_supplier')
                    ->where('sup_id', $sup_id)
                    ->pluck('sup_name')
                    ->first();

        // getting Amount

            $fab_amount=0; //intial fabric amount is 0
            $acc_amount=0; //initial accessories amount is 0

            //Fabrics for requested file no
            $fab_id= DB::table('com_master_pi_fabric')
                        ->where('exp_lc_fileno', $request->file_no)
                        ->select('master_pi_fab_id')
                        ->get();
            
            //Accessories for requested file no
            $acc_id= DB::table('com_master_pi_accessories')
                        ->where('exp_lc_fileno', $request->file_no)
                        ->select('master_pi_acss_id')
                        ->get();

            //Fabric Amount
            if($fab_id!= ""){
                foreach($fab_id AS $fab){
                    $fab_amount+= DB::table("com_master_pi_fabric_item")
                                ->where('master_pi_fab_id', $fab->master_pi_fab_id)
                                ->pluck(DB::raw('sum(master_pi_fab_item_quantity*master_pi_fab_item_unit_price) AS total'))
                                ->first();
                }
            }

            //accessories amount
            if($acc_id!=""){
                foreach($acc_id AS $acc){
                    $acc_amount+= DB::table("com_master_pi_accessories_item")
                                ->where('master_pi_acss_id', $acc->master_pi_acss_id)
                                ->pluck(DB::raw('sum(master_pi_acss_item_quantity*master_pi_acss_item_unit_price) AS total'))
                                ->first();
                }
            }
            //total amount = Fabric amount + Accessories amount
            //if only Fabric selected then Accessories amount will be zero (initialy initialized to acc_amount=0)
            //if only accessories selected then Fabric amount will be zero(initialy initialized to fab_amount=0)
            $amount= $fab_amount+$acc_amount;

            $data['sup_name'] =$sup_name;
            $data['amount']= $amount;

            return $data;
    }

    
    


    //BTB (Amendment) Update
    public function btbdUpdate(Request $request){
    	// dd($request->all());
    	if($request->b2b_status == "0"){
    		B2BEntry::where('b2b_id', $request->b2b_id)
    					->update([
    						'b2b_lc_cancel_date' => $request->b2b_lc_cancel_date,
    						'b2b_status' => 0
    					]);
    		return back()
    				->with('success', "BTB Cancelled Successfully!!");
    	}
    	else{
    	$validator= Validator::make($request->all(), [
    		"exp_lc_fileno" => "required| max:45",
			"b2b_item" => "required| max:11",
			"b2b_lc_status" => "max:45",
			"b2b_lc_no" => "max:45",
			"b2b_lc_date" => "date",
			"b2b_inco_term" => "max:45",
			"b2b_lc_sup_code" => "required|max:45",
			"b2b_lc_currency" => "max:45",
			"b2b_lc_marine_ins_no" => "max:45",
			"b2b_lc_ins_cover_date" => "date",
			"lc_period_id" => "max:11",
			"from_date_of_id" => "max:11",
			"b2b_lc_interest" => "max:45",
			"lc_id" => "max:11",
  			"am_amend_date" => "required|date",
  			"am_reason" => "required|max:45",
			"am_amend_value" => "required|max:45",
			"am_ship_date" => "required|date",
			"am_expiry_date" => "required|date",
			"am_lca_no" 	=> "required|max:45",
			"am_remark" => "required|max:255",
			"am_total_amount" => "max:45"
    	]);
    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with("error", "Incorrect Input");
    	}

    	B2BEntry::where('b2b_id', $request->b2b_id)
    				->update([
						"b2b_item" => $request->b2b_item,
						"b2b_lc_status" => $request->b2b_lc_status,
						"b2b_lc_no" => $request->b2b_lc_no,
						"b2b_lc_date" => $request->b2b_lc_date,
						"b2b_inco_term" => $request->b2b_inco_term,
						"b2b_lc_sup_code" => $request->b2b_lc_sup_code,
						"b2b_lc_currency" => $request->b2b_lc_currency,
						"b2b_lc_marine_ins_no" => $request->b2b_lc_marine_ins_no,
						"b2b_lc_ins_cover_date" => $request->b2b_lc_ins_cover_date,
						"lc_period_id" => $request->lc_period_id,
						"from_date_of_id" => $request->from_date_of_id,
						"b2b_lc_interest" => $request->b2b_lc_interest,
						"lc_id" => $request->lc_id
    				]);

    	B2BAmendment::insert([
    					"b2b_id" => $request->b2b_id,
    					"b2b_amend_date" => $request->am_amend_date,
			  			"b2b_amend_reason" => $request->am_reason,
						"b2b_amend_value" => $request->am_amend_value,
						"b2b_amend_last_ship_date" => $request->am_ship_date,
						"b2b_amend_expiry_date" => $request->am_expiry_date,
						"b2b_amend_lca_no" 	=> $request->am_lca_no,
						"b2b_amend_remark" => $request->am_remark,
						"b2b_amend_total_amount" => $request->am_total_amount
    				]);
    	$user= Auth()->user()->associate_id;
    		B2BHistory::insert([
    			'b2b_id' => $request->b2b_id,
    			'b2b_history_desc' => "update",
    			'b2b_history_user_id' => $user
    		]);
    }
    	return back()
    			->with('success', 'BTB Updated Successfully!!');	
    }

    //get supplier info for edit
    public function getNameAmount($file_no, $sup_code){
    	// getting supplier Name
    	$sup_id= DB::table('com_master_pi_fabric')
    					->where('master_pi_fab_sup_code', $sup_code)
    					->pluck('sup_id')
    					->first();

    	if($sup_id == ""){
    		$sup_id= DB::table('com_master_pi_accessories')
    					->where('master_pi_acss_sup_code', $sup_code)
    					->pluck('sup_id')
    					->first();
    	}
    	$sup_name= DB::Table('mr_supplier')
    				->where('sup_id', $sup_id)
    				->pluck('sup_name')
    				->first();

    	// getting Amount

    		$fab_amount=0; //intial fabric amount is 0
    		$acc_amount=0; //initial accessories amount is 0

    		//Fabrics for requested file no
    		$fab_id= DB::table('com_master_pi_fabric')
    					->where('exp_lc_fileno', $file_no)
    					->select('master_pi_fab_id')
    					->get();
    		
    		//Accessories for requested file no
    		$acc_id= DB::table('com_master_pi_accessories')
    					->where('exp_lc_fileno', $file_no)
    					->select('master_pi_acss_id')
    					->get();

    		//Fabric Amount
    		if($fab_id!= ""){
    			foreach($fab_id AS $fab){
		    		$fab_amount+= DB::table("com_master_pi_fabric_item")
	    						->where('master_pi_fab_id', $fab->master_pi_fab_id)
	    						->pluck(DB::raw('sum(master_pi_fab_item_quantity*master_pi_fab_item_unit_price) AS total'))
	    						->first();
    			}
    		}

    		//accessories amount
    		if($acc_id!=""){
    			foreach($acc_id AS $acc){
		    		$acc_amount+= DB::table("com_master_pi_accessories_item")
								->where('master_pi_acss_id', $acc->master_pi_acss_id)
								->pluck(DB::raw('sum(master_pi_acss_item_quantity*master_pi_acss_item_unit_price) AS total'))
								->first();
				}
    		}
    		//total amount = Fabric amount + Accessories amount
    		//if only Fabric selected then Accessories amount will be zero (initialy initialized to acc_amount=0)
    		//if only accessories selected then Fabric amount will be zero(initialy initialized to fab_amount=0)
    		$amount= $fab_amount+$acc_amount;

    		$data['sup_name'] =$sup_name;
    		$data['amount']= $amount;

    		return $data;
    }

    //Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }

}

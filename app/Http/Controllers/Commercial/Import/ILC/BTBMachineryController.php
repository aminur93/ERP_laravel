<?php

namespace App\Http\Controllers\Commercial\Import\ILC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\PiType;
use App\Models\Commercial\FromDateOf;
use App\Models\Commercial\LcPeriod;
use App\Models\Commercial\LcType;
use App\Models\Commercial\BTBMachinery;
use App\Models\Commercial\BTBMachineryAmend;
use App\Models\Commercial\BTBMachineryHistory;
use DB, DataTables, ACL, Validator;

class BTBMachineryController extends Controller
{
    //show machinery Form
    public function showForm(){
    	$fileList= DB::Table('com_machinery_pi')
    				->groupBy('machinery_pi_fileno')
    				->pluck('machinery_pi_fileno', 'machinery_pi_fileno');
    	$bankList= DB::table('com_bank')
    				->pluck('bank_name', 'bank_id');
    	$piTypeList = PiType::pluck('pi_type_name', 'pi_id');
    	$dateOfList = FromDateOf::pluck('from_date_of_name', 'from_date_of_id');
    	$periodList = LcPeriod::pluck('lc_period_name', 'lc_period_id');
    	$lcTypeList = LcType::pluck('lc_type_name', 'lc_id');
    	// dd($bankList);
    	$supCodeList= DB::table('com_machinery_pi')
    					->pluck('machinery_pi_sup_code', 'machinery_pi_sup_code');

    		// dd($supCodeList);

    	return view('commercial/import/ilc/btb_machinery', compact('fileList', 'bankList', 'dateOfList', 'periodList', 'lcTypeList', 'piTypeList', 'supCodeList'));
    }
    //get supplier information from supplier code
    public function getSupInfoMachine(Request $request){
    	$data['sup_name']= "";
    	$data['amount']= 0;
    	$sup= DB::table('com_machinery_pi')
    				->where('machinery_pi_sup_code', $request->sup_code)
    				->select('sup_id', 'machinery_pi_pi_amount')
    				->first();
    	$sup_name= DB::table('mr_supplier')
    				->where('sup_id', $sup->sup_id)
    				->pluck('sup_name')
    				->first();

    	$data['sup_name']= $sup_name;
    	$data['amount']= $sup->machinery_pi_pi_amount;
    	return $data;
    }
    public function saveForm(Request $request){
    	
    	$validator= Validator::make($request->all(), [
					"machinery_pi_fileno" => "required|max:45",
					"b2b_machinery_item" => "required",
					"b2b_machinery_lc_no" => "max:45",
					"b2b_machinery_inco_term" => "max:45",
					"bank_id" => "max:11",
					"b2b_machinery_lc_status" => "max:45",
					"b2b_machinery_date" => "date",
					"b2b_machinery_sup_code" => "max:45",
					"b2b_machine_amend_lca_no" => "max:45",
					"b2b_machine_amend_last_ship_date" => "date",
					"b2b_machine_amend_expiry_date" => "date",
					"b2b_machine_amend_remark" => "max:255",
					"b2b_machine_amend_total_amount" => "max:45",
					"b2b_machinery_currency" => "max:45",
					"lc_period_id" => "max:11",
					"b2b_machinery_lc_type" => "max:11",
					"b2b_machinery_marine_ins_no" => "max:45",
					"b2b_machinery_ins_cover_date" => "date",
					"from_date_of_id" => "max:11",
					"b2b_machinery_interest" => "max:45"
    			]);
    	if($validator->fails()){
    		return back()
    				->withInput()
    				->with('error', "Incorrect Input");
    	}
    	else{
    		 $data= new BTBMachinery();
    		 $data->machinery_pi_fileno = $request->machinery_pi_fileno;
    		 $data->b2b_machinery_item = $request->b2b_machinery_item;
    		 $data->b2b_machinery_lc_no = $request->b2b_machinery_lc_no;
    		 $data->b2b_machinery_inco_term = $request->b2b_machinery_inco_term;
    		 $data->bank_id = $request->bank_id;
    		 $data->b2b_machinery_lc_status = $request->b2b_machinery_lc_status;
    		 $data->b2b_machinery_date = $request->b2b_machinery_date;
    		 $data->b2b_machinery_sup_code = $request->b2b_machinery_sup_code;
    		 $data->b2b_machinery_currency = $request->b2b_machinery_currency;
    		 $data->lc_period_id = $request->lc_period_id;
    		 $data->b2b_machinery_lc_type = $request->b2b_machinery_lc_type;
    		 $data->b2b_machinery_marine_ins_no = $request->b2b_machinery_marine_ins_no;
    		 $data->b2b_machinery_ins_cover_date = $request->b2b_machinery_ins_cover_date;
    		 $data->from_date_of_id = $request->from_date_of_id;
    		 $data->b2b_machinery_interest = $request->b2b_machinery_interest;
    		$data->save();
    		$last_id= $data->id;
    		BTBMachineryAmend::insert([
    			"b2b_machinery_id"=> $last_id,
    			"b2b_machine_amend_reason"=> "New",
    			"b2b_machine_amend_total_amount" => $request->b2b_machine_amend_total_amount,
    			"b2b_machine_amend_last_ship_date" => $request->b2b_machine_amend_last_ship_date,
				"b2b_machine_amend_expiry_date" => $request->b2b_machine_amend_expiry_date,
    			"b2b_machine_amend_lca_no" => $request->b2b_machine_amend_lca_no,
				
				"b2b_machine_amend_remark" => $request->b2b_machine_amend_remark,
				
    		]);
    		$user= Auth()->user()->associate_id;
    		BTBMachineryHistory::insert([
    			'b2b_machinery_id' => $last_id,
    			'b2b_machn_history_desc' => "Create",
    			'b2b_machn_history_user_id' => $user
    		]);
    		return back()
    				->withInput()
    				->with("success", "BTB Entry(Machinery) saved successfully!!");
    	}
    }
    public function btbMachineryList(){
        $typeList= LcType::pluck('lc_type_name');
        $periodList= LcPeriod::pluck('lc_period_name');
        return view('commercial/import/ilc/btb_machinery_list', compact('typeList','periodList'));
    }
    //BTB (Machinery) List data
    public function btbMachineryListData(){


        DB::statement(DB::raw('set @sl=0')); 
        $data= DB::table('com_b2b_machinery AS b2b_m')
                ->select(
                    DB::raw('@sl := @sl + 1 AS serial_no'),
                    "b2b_m.*"
                )
                ->get();

        return DataTables::of($data)
        ->editColumn('b2b_machinery_lc_type', function($data){
            $lc= LcType::where('lc_id', $data->b2b_machinery_lc_type)
                    ->pluck('lc_type_name')
                    ->first();
            return $lc;
        })
        ->editColumn('lc_period_id', function($data){
            $period= LcPeriod::where('lc_period_id', $data->lc_period_id)
                    ->pluck('lc_period_name')
                    ->first();
            return $period;
        })
        ->editColumn('b2b_machinery_item', function($data){
            if($data->b2b_machinery_item == 1)
                return "Fabric";
            if($data->b2b_machinery_item == 2)
                return "Accessories";
            if($data->b2b_machinery_item == 3)
                return "Fabric+Accessories";
        })
        ->addColumn('action', function($data){
             return "<a href=".url('comm/import/ilc/machinery_edit/'.$data->b2b_machinery_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                                    <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                                </a>
                            </div>";
        })
        ->toJson();
        dd($data);
    }
    public function btbMachineryEdit($id){
        $fileList= DB::Table('com_machinery_pi')
                    ->groupBy('machinery_pi_fileno')
                    ->pluck('machinery_pi_fileno', 'machinery_pi_fileno');
        $bankList= DB::table('com_bank')
                    ->pluck('bank_name', 'bank_id');
        $piTypeList = PiType::pluck('pi_type_name', 'pi_id');
        $dateOfList = FromDateOf::pluck('from_date_of_name', 'from_date_of_id');
        $periodList = LcPeriod::pluck('lc_period_name', 'lc_period_id');
        $lcTypeList = LcType::pluck('lc_type_name', 'lc_id');
        // dd($bankList);
        $supCodeList= DB::table('com_machinery_pi')
                        ->pluck('machinery_pi_sup_code', 'machinery_pi_sup_code');

        $machinery= BTBMachinery::where('b2b_machinery_id', $id)->first();

        $last_ammend= BTBMachineryAmend::where('b2b_machinery_id', $machinery->b2b_machinery_id)
                    ->orderBy('b2b_machine_amend_id', 'DESC')
                    ->first();
        // $machinery
        // dd($last_ammend);
        $machinery->b2b_machine_amend_total_amount= $last_ammend->b2b_machine_amend_total_amount;
        $machinery->b2b_machine_amend_last_ship_date= $last_ammend->b2b_machine_amend_last_ship_date;
        $machinery->b2b_machine_amend_expiry_date= $last_ammend->b2b_machine_amend_expiry_date;
        $machinery->b2b_machine_amend_lca_no= $last_ammend->b2b_machine_amend_lca_no;
        $machinery->b2b_machine_amend_remark= $last_ammend->b2b_machine_amend_remark;
        $machinery->b2b_machine_amend_id= $last_ammend->b2b_machine_amend_id;

        $sup= DB::table('com_machinery_pi')
                    ->where('machinery_pi_sup_code', $machinery->b2b_machinery_sup_code)
                    ->select('sup_id', 'machinery_pi_pi_amount')
                    ->first();

        $sup_name= DB::table('mr_supplier')
                    ->where('sup_id', $sup->sup_id)
                    ->pluck('sup_name')
                    ->first();
        $sup_info['sup_name']= "";
        $sup_info['amount']= 0;
        $sup_info['sup_name']= $sup_name;
        $sup_info['amount']= $sup->machinery_pi_pi_amount;

        $amendments= BTBMachineryAmend::where('b2b_machinery_id', $machinery->b2b_machinery_id)->get();
    $amm_num= $amendments->count();
    

        return view('commercial/import/ilc/btb_machinery_edit', compact('machinery', 'fileList', 'bankList', 'piTypeList', 'dateOfList', 'periodList', 'lcTypeList', 'supCodeList', 'amendments','sup_info','amm_num'));
    }
    public function btbMachineryUpdate(Request $request){
        // dd($request->all());

        $validator= Validator::make($request->all(), [
                    "bank_id" => "max:11",
                    "b2b_machinery_item" => "required",
                    "b2b_machinery_lc_no" => "max:45",
                    "b2b_machinery_inco_term" => "max:45",
                    "b2b_machinery_lc_status" => "max:45",
                    "b2b_machinery_date" => "date",
                    "b2b_machinery_sup_code" => "max:45",
                    "b2b_machinery_currency" => "max:45",
                    "lc_period_id" => "max:11",
                    "b2b_machinery_lc_type" => "max:11",
                    "b2b_machinery_marine_ins_no" => "max:45",
                    "b2b_machinery_ins_cover_date" => "date",
                    "from_date_of_id" => "max:11",
                    "b2b_machinery_interest" => "max:45",
                    "am_amend_date"=> "date",
                    "am_reason"=> "max:45",
                    "am_amend_value"=> "max:45",
                    "am_lca_no" => "max:45",
                    "am_ship_date" => "date",
                    "am_expiry_date" => "date",
                    "am_remark" => "max:255",
                    "am_total_amount" => "max:45",
                ]);
        if($validator->fails()){
            return back()
                    ->withInput()
                    ->with("error", "Incorrect Input");
        }
        else{
            BTBMachinery::where('b2b_machinery_id', $request->b2b_machinery_id)
                        ->update([
                            "bank_id" => $request->bank_id,
                            "b2b_machinery_item" => $request->b2b_machinery_item,
                            "b2b_machinery_lc_no" => $request->b2b_machinery_lc_no,
                            "b2b_machinery_inco_term" => $request->b2b_machinery_inco_term,
                            "b2b_machinery_lc_status" => $request->b2b_machinery_lc_status,
                            "b2b_machinery_date" => $request->b2b_machinery_date,
                            "b2b_machinery_sup_code" => $request->b2b_machinery_sup_code,
                            "b2b_machinery_currency" => $request->b2b_machinery_currency,
                            "lc_period_id" => $request->lc_period_id,
                            "b2b_machinery_lc_type" => $request->b2b_machinery_lc_type,
                            "b2b_machinery_marine_ins_no" => $request->b2b_machinery_marine_ins_no,
                            "b2b_machinery_ins_cover_date" => $request->b2b_machinery_ins_cover_date,
                            "from_date_of_id" => $request->from_date_of_id,
                            "b2b_machinery_interest" => $request->b2b_machinery_interest
                        ]);

                BTBMachineryAmend::insert([
                    "b2b_machinery_id" => $request->b2b_machinery_id,
                    "b2b_machine_amend_date" => $request->am_amend_date,
                    "b2b_machine_amend_reason" => $request->am_reason,
                    "b2b_machine_amend_value" => $request->am_amend_value,
                    "b2b_machine_amend_last_ship_date" => $request->am_ship_date,
                    "b2b_machine_amend_expiry_date" => $request->am_expiry_date,
                    "b2b_machine_amend_total_amount" => $request->am_total_amount,
                    "b2b_machine_amend_lca_no" => $request->am_lca_no,
                    "b2b_machine_amend_remark" => $request->am_remark
                ]);


            return back()
                    ->withInput()
                    ->with('success', "BTB Machinery updated successfully!!");
        }
    }
}

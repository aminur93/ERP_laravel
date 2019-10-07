<?php

namespace App\Http\Controllers\commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\CmFreightChargeMaster;
use App\Models\Commercial\CmFreightChargeChild;
use App\Models\Commercial\Export\CmExpDataEntry;
use App\Models\Commercial\Export\CmExpUpdate3;
use DB, Validator, DataTables, Redirect;

class FreightChargeController extends Controller
{
    public function index()
	{
		$data['fileList'] 	= DB::table('cm_exp_data_entry_1 AS a')
								->leftjoin('cm_file AS b', 'a.cm_file_id','b.id')
								->pluck("b.file_no", "b.id")
								->toArray();
		$data['invoiceList'] = DB::table('cm_exp_data_entry_1')
								->pluck("inv_no", "inv_no")
								->toArray();
		return view('commercial.export.rubel.freight_charge', $data);
	}

	public function ajaxFreightChargeLoadtr(Request $request)
	{
		$data['master_data'] 	= $request->input('masterData');
		$data['master_row_key'] = $request->input('masterRowKey');
		$data['total_po'] 		= $request->input('masterTotalpo');
		$update3_table_where 	= ['invoice_no' => $data['master_data']['inv_no']];
		$data['update3_table'] 	= CmExpUpdate3::where($update3_table_where)->first();
		// calculate total qty
		$data['total_qty'] = 0;
		if(isset($data['master_data']['cm_exp_entry1_po'][0])) {
			foreach($data['master_data']['cm_exp_entry1_po'] as $k=>$entry1_po) {
				$data['total_qty'] += $entry1_po['po_qty'];
			}
		}
		return view('commercial.export.rubel.ajax_freight_charge_loadtr', $data)->render();
	}

	public function ajaxFreightChargeMasterData(Request $request)
	{
		$whereCon = [];
		if($request->input('file_no')) {
			$whereCon['cm_file_id'] = $request->input('file_no');
		}
		if($request->input('inv_no')) {
			$whereCon['inv_no'] 	= $request->input('inv_no');
		}
		if($request->input('inv_value')) {
			$whereCon['inv_value'] = $request->input('inv_value');
		}
		$data['masterDataList'] = CmExpDataEntry::where($whereCon)->get();
		// return $data['freightChargeMasterList'];
		return view('commercial.export.rubel.ajax_freight_charge_masterdata', $data)->render();
	}

	public function freightChargeSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
		    "freight_tk"    		=> "required|array",
		    "freight_tk.*"  		=> "required",
		    "rate"    				=> "required|array",
		    "rate.*"  				=> "required",
		    "freight_rcv_pcs"    	=> "required|array",
		    "freight_rcv_pcs.*"  	=> "required",
		    "freight_rcv_usd"    	=> "required|array",
		    "freight_rcv_usd.*"  	=> "required",
		    "due_date"  			=> "required",
		    "type"  				=> "required"
		]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        // master table data
        $cm_exp_data_entry_1_id_list = $request->input('cm_exp_data_entry_1_id');
        $cm_file_id 				 = $request->input('cm_file_id');
        $freight_master_id 			 = $request->input('freight_master_id');
        $due_date 					 = $request->input('due_date');
        $type 						 = $request->input('type');
        // child table data
        $freight_tk 		= $request->input('freight_tk');
        $rate 				= $request->input('rate');
        $freight_rcv_pcs 	= $request->input('freight_rcv_pcs');
        $freight_rcv_usd 	= $request->input('freight_rcv_usd');
        $invoice_no 		= $request->input('invoice_no');

        $CmFreightChargeMaster = new CmFreightChargeMaster;
        $CmFreightChargeChild  = new CmFreightChargeChild;
        // save data to master table
    	// $CmFreightChargeMaster->cm_exp_data_entry_1_id 	= $dataEntry_1_id;
    	$CmFreightChargeMaster->cm_file_id 			= $cm_file_id;
    	$CmFreightChargeMaster->freight_master_id 	= $freight_master_id;
    	$CmFreightChargeMaster->due_date 			= $due_date;
    	$CmFreightChargeMaster->type 				= $type;
    	$CmFreightChargeMaster->save();
    	// return table primary key
        $CmFreightChargeMaster_id 					= $CmFreightChargeMaster->id;
    	// save data to child table
        foreach($cm_exp_data_entry_1_id_list as $keyOne=>$dataEntry_1_id) {
        	$CmFreightChargeChild->cm_freight_charge_master_id 	= $CmFreightChargeMaster_id;
        	$CmFreightChargeChild->cm_exp_data_entry_1_id 		= $dataEntry_1_id;
        	$CmFreightChargeChild->freight_tk 					= $freight_tk[$keyOne];
        	$CmFreightChargeChild->rate 						= $rate[$keyOne];
        	$CmFreightChargeChild->freight_rcv_pcs 				= $freight_rcv_pcs[$keyOne];
        	$CmFreightChargeChild->freight_rcv_usd 				= $freight_rcv_usd[$keyOne];
        	$CmFreightChargeChild->invoice_no 					= $invoice_no[$keyOne];
        	$CmFreightChargeChild->save();
        }
        return redirect('commercial/export/freight_charge')
                 ->with('success', 'Successfuly Save.');

	}

	public function freightChargeFetchinvno(Request $request)
	{
		$file_id = $request->input('file_id');
		if($request->input('file_id') != '') {
			$fetch_invList  = DB::table('cm_exp_data_entry_1')
								->where(['cm_file_id' => $file_id])
								->pluck("inv_no", "inv_no")
								->toArray();
		} else {
			// if file id not found than show all invoice no list
			$fetch_invList = DB::table('cm_exp_data_entry_1')
								->pluck("inv_no", "inv_no")
								->toArray();
		}
		$invOptions = '';
		// generate invoice list
		if(count($fetch_invList) > 0) {
			$invOptions .= '<option value="">Select Invoice No</option>';
			foreach($fetch_invList as $k1 => $inv) {
				$invOptions .= '<option value="'.$inv.'">'.$inv.'</option>';
			}
		} else  {
			$invOptions = '<option value="">Not Found</option>';
		}
		return $invOptions;
	}
public function freightChargeList(){
  $data = DB::table('cm_exp_update5 AS a')
      ->leftjoin('hr_unit AS b','a.hr_unit','b.hr_unit_id')
      ->select($this->exportLcEntry_listData_select())
      ->get();
  return DataTables::of($data)->addIndexColumn()
    ->addColumn('action', function ($data) {
      $edit_url = url('commercial/export/exportLcEntry_edit/'.$data->id);
              $action_buttons= "<div class=\"btn-group\">
                        <a href=\"$edit_url\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
                            <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                        </a>
                        <a onclick=\"deleteModal($data->id)\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" style=\"height:25px; width:26px;\">
                            <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                        </a> ";
                  $action_buttons.= "</div>";
                  return $action_buttons;
              })
    ->rawColumns(['action'])
    ->toJson();
  }

  public function getFreightChargeList(){
    $freightCharges = DB::table('cm_freight_charge_master')
                 ->leftjoin('cm_file','cm_file.id','=','cm_freight_charge_master.cm_file_id')
                 ->get();
                 //dd($freightCharges);exit;
                 // return $freightCharges;
    return view('commercial.export.rubel.freight_charge_list',compact(
      "freightCharges"
    ));
  }
}

<?php

namespace App\Http\Controllers\commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Export\CmCashIncentiveMaster;
use App\Models\Commercial\Export\CmCashIncentiveChild;
use App\Models\Commercial\Export\CmExpDataEntry;
use DB, Validator, DataTables, Redirect;

class CashIncentiveController extends Controller
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
  		return view('commercial.export.rubel.cash_incentive', $data);
  	}

	public function ajaxCashIncentiveLoadtr(Request $request)
	{
		$data['master_data'] 		  = $request->input('masterData');
		$data['master_incentive_ref'] = $request->input('masterIncentiveref');
		return view('commercial.export.rubel.ajax_cash_incentive_loadtr', $data)->render();
	}

	public function ajaxCashIncentiveMasterData(Request $request)
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
		// return $data['masterDataList'];
		return view('commercial.export.rubel.ajax_cash_incentive_masterdata', $data)->render();
	}

	public function cashIncentiveSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
		    "incentive_percent"    		=> "required",
		    "bgmea_cert_date"    		=> "required",
		    "bank_subm_date"    		=> "required",
		    "bank_cert_date"    		=> "required",
		    "resp_person"    			=> "required",
		    "act_credit_date"    		=> "required"
		]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        $cm_exp_data_entry_1_id_list = $request->input('cm_exp_data_entry_1_id');
        // master table data
        $CmCashIncentiveMaster 	= new CmCashIncentiveMaster;
        $CmCashIncentiveMaster->cm_file_id 			= $request->input('cm_file_id');
        $CmCashIncentiveMaster->incentive_ref 		= $request->input('incentive_ref');
        $CmCashIncentiveMaster->incentive_percent 	= $request->input('incentive_percent');
        $CmCashIncentiveMaster->bgmea_cert_date 	= $request->input('bgmea_cert_date');
        $CmCashIncentiveMaster->bank_subm_date 		= $request->input('bank_subm_date');
        $CmCashIncentiveMaster->bank_cert_date 		= $request->input('bank_cert_date');
        $CmCashIncentiveMaster->resp_person 		= $request->input('resp_person');
        $CmCashIncentiveMaster->act_credit_date 	= $request->input('act_credit_date');
        $CmCashIncentiveMaster->save();
        $CmCashIncentiveMaster_id = $CmCashIncentiveMaster->id;

        // child table data
        $invoice_no_list 		= $request->input('invoice_no');
        $CmCashIncentiveChild  	= new CmCashIncentiveChild;
        foreach($cm_exp_data_entry_1_id_list as $keyOne=>$dataEntry_1_id) {
        	// save data to child table
        	$CmCashIncentiveChild->cm_cash_incentive_master_id 	= $CmCashIncentiveMaster_id;
        	$CmCashIncentiveChild->cm_exp_data_entry_1_id 		= $dataEntry_1_id;
        	$CmCashIncentiveChild->invoice_no 					= $invoice_no_list[$keyOne];
        	$CmCashIncentiveChild->save();
        }
        return redirect('commercial/export/cash_incentive')
                 ->with('success', 'Successfuly Save.');
	}

	public function cashIncentiveFetchinvno(Request $request)
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
  public function invoiceList()
  {
    $datas = DB::table('cm_cash_incentive_master')
                 ->select(
                     'cm_cash_incentive_master.id',
                     'cm_cash_incentive_master.incentive_percent',
                     'cm_cash_incentive_master.bank_subm_date',
                     'cm_file.file_no',
                     'cm_file.hr_unit',
                     'cm_cash_incentive_status.incentive',
                     'cm_cash_incentive_child.invoice_no'
                   )
                 ->join('cm_cash_incentive_child','cm_cash_incentive_master.id','=','cm_cash_incentive_child.cm_cash_incentive_master_id')
                 ->join('cm_cash_incentive_status','cm_cash_incentive_master.id','=','cm_cash_incentive_status.id')
                 ->join('cm_file','cm_cash_incentive_master.cm_file_id','=','cm_file.id')
                 //->where('cm_cash_incentive_master.id')
                 ->get()
                 ->toArray();
                 // dd($datas);exit;

    $notR = array_column($datas,'id');
    // return $notR;
    $vals = array_count_values($notR);
    // dd($vals);exit;

    // $data = [];
    // foreach ($datas as $value) {
    //     $data[$value->id][] = $value;
    // }
    //dd($data);exit;
    //////////////////////

    /////////////////////
    return view('commercial.export.rubel.cashincentivelist',compact('datas','vals'));
    // foreach ($datas as $data) {
    //   // return $data;
    //   $invoices = CmCashIncentiveChild::where('cm_cash_incentive_master_id',$data->id)->pluck('invoice_no');
    //   foreach ($invoices as $invoice) {
    //     $data->invoice = $invoice;
    //   }
    //   return $data;
    // }
    // return $datas;
    // return view('commercial.export.rubel.cashincentivelist',compact('datas'));
  }
}

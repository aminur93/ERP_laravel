<?php

namespace App\Http\Controllers\Commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ImportDataEntry;
use DB, Validator, DataTables, Redirect;

class CfBillMonitoringController extends Controller
{
	public function index()
	{
		$data = [];
		$data['cmFileList'] = DB::table('cm_file')
						->select('id','file_no')
						->pluck("file_no", "id")
						->toArray();
		$data['cmShipModeList'] = DB::table('cm_imp_data_entry')
						->select('ship_mode')
						->pluck("ship_mode", "ship_mode")
						->toArray();
		return view('commercial.import.rubel.cf_bill_monitoring', $data);
	}

	public function cfBillMonitoring_list()
	{
		return view('commercial.import.rubel.cf_bill_monitoring_list');
	}

	public function cfBillMonitoring_listData_select()
	{
		return [
			'b_monitor.id',
			'b_monitor.cm_imp_data_entry_id',
			'b_monitor.imp_cnf_bill_no',
			'b_monitor.imp_cnf_bill_date',
			'b_monitor.imp_cnf_bill_amount'
		];
	}

	public function cfBillMonitoring_listData()
	{
		$data= DB::table('cm_imp_cnf_bill_monitor AS b_monitor')
    			->select($this->cfBillMonitoring_listData_select())
    			->get();
    	return DataTables::of($data)->addIndexColumn()
				->addColumn('action', function ($data) {
	                $action_buttons= "<div class=\"btn-group\">
                            <a onclick=\"editModal($data->id,$data->cm_imp_data_entry_id,$data->imp_cnf_bill_no,'$data->imp_cnf_bill_date',$data->imp_cnf_bill_amount)\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
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

	public function cfBillMonitoring_shipmodeSearch()
	{
		$file_id = request()->input('file_id');
		if(request()->input('file_id') != '') {
			$shipmodeList = DB::table('cm_imp_data_entry')
								->select('ship_mode')
								->where(['cm_file_id' => $file_id])
								->pluck('ship_mode','ship_mode')
								->toArray();
		} else {
			$shipmodeList = DB::table('cm_imp_data_entry')
						->select('ship_mode')
						->pluck("ship_mode", "ship_mode")
						->toArray();
		}
		$shipmodeOptions = '';
		if(!empty($shipmodeList)) {
			$shipmodeOptions .= '<option value="">Select Shipment Mode</option>';
			foreach($shipmodeList as $k => $shipmode) {
				$shipmodeOptions .= '<option value="'.$shipmode.'">'.$shipmode.'</option>';
			}
		} else  {
			$shipmodeOptions = '<option value="">Not Found</option>';
		}
		return $shipmodeOptions;
	}

	public function cfBillMonitoring_Search_select()
	{
		return [
			'cm_file.file_no',
			'a.id AS cm_data_entry_id',
			'a.value',
			'a.package',
			'a.imp_code',
			'b.port_examine_date AS examine_date',
			'b.port_assess_date AS assess_date',
			'd.mr_buyer_b_id AS b_id',
			'e.id AS bill_monitor_id',
			'e.imp_cnf_bill_no',
			'e.imp_cnf_bill_date',
			'e.imp_cnf_bill_amount'
		];
	}

	public function cfBillMonitoring_Search()
	{
		$data = [];
		$query = DB::table('cm_imp_data_entry AS a')
			->leftjoin('cm_imp_data_update_sea_port AS b', 'a.id','b.cm_imp_data_entry_id')
			->leftjoin('cm_file', 'a.cm_file_id', 'cm_file.id')
			->leftjoin('cm_exp_lc_entry AS c', 'a.cm_file_id', 'c.cm_file_id')
			->leftjoin('cm_sales_contract AS d', 'c.cm_sales_contract_id', 'd.id')
			->leftjoin('cm_imp_cnf_bill_monitor AS e','a.id','e.cm_imp_data_entry_id')
			->select($this->cfBillMonitoring_Search_select());
		if(request()->input('data.file_id') != '') {
			$query->where('a.cm_file_id', request()->input('data.file_id'));
		}
		if(request()->input('data.value') != '') {
			$query->where('a.value', request()->input('data.value'));
		}
		if(request()->input('data.ship_mode') != '') {
			$query->where('a.ship_mode', request()->input('data.ship_mode'));
		}
		$data['dataList'] = $query->get();
		$data['buyerList'] = DB::table('mr_buyer')
								->pluck('b_name','b_id')
								->toArray();
		return view('commercial.import.rubel.ajax_cf_bill_monitoring_form', $data)->render();
	}

	public function cfBillMonitoring_save_except()
	{
		return [
			'_token',
			'file_no',
			'buyer_id',
			'value',
			'package',
			'examini_date',
			'asse_date',
			'factory_arr',
			'imp_no'
		];
	}

	public function cfBillMonitoring_save()
	{
		$data = request()->except($this->cfBillMonitoring_save_except());
		foreach (request()->input('id') as $key => $bill_monitor_id) {
			$bill_monitor = [
				'cm_imp_data_entry_id' 	=> $data['cm_imp_data_entry_id'][$key],
				'imp_cnf_bill_no' 		=> $data['imp_cnf_bill_no'][$key],
				'imp_cnf_bill_date' 	=> $data['imp_cnf_bill_date'][$key],
				'imp_cnf_bill_amount' 	=> $data['imp_cnf_bill_amount'][$key],
				'updated_at' 			=> date('Y-m-d H:i:s', time())
			];
			if($bill_monitor_id != NULL) {
				$info = DB::table('cm_imp_cnf_bill_monitor')
							->where('id',$bill_monitor_id)
							->update($bill_monitor);
				// update log file
				$this->logFileWrite('Update bill monitor info (cm_imp_cnf_bill_monitor)', $bill_monitor_id);
			} else {
				$bill_monitor['created_at'] = date('Y-m-d H:i:s', time());
				$insert_id = DB::table('cm_imp_cnf_bill_monitor')
							->insertGetId($bill_monitor);
				// update log file
				$this->logFileWrite('Insert bill monitor info (cm_imp_cnf_bill_monitor)', $insert_id);
			}
		}
		return redirect('commercial/import/cf_bill_monitoring_list')->with('success','Data update success');
	}

	public function cfBillMonitoring_delete($bill_monitor_id)
	{
		$check = DB::table('cm_imp_cnf_bill_monitor')
					->where('id', $bill_monitor_id)
					->first();
		if($check) {
			DB::table('cm_imp_cnf_bill_monitor')->where('id', $bill_monitor_id)->delete();
			return redirect('commercial/import/cf_bill_monitoring_list')
					->with('success','Data delete success');
		} else {
			return redirect('commercial/import/cf_bill_monitoring_list')
					->with('error','Data delete error');
		}
	}

	public function cfBillMonitoring_update($bill_monitor_id)
	{
		$check = DB::table('cm_imp_cnf_bill_monitor')->where('id', $bill_monitor_id)->first();
		if(count($check) > 0) {
			$update_bill_monitor = request()->except('_token');
			$update_bill_monitor['updated_at'] = date('Y-m-d H:i:s', time());
			DB::table('cm_imp_cnf_bill_monitor')
				->where('id',$bill_monitor_id)
				->update($update_bill_monitor);
			// update log file
			$this->logFileWrite('Update bill monitor info (cm_imp_cnf_bill_monitor)', $bill_monitor_id);
			return redirect('commercial/import/cf_bill_monitoring_list')
					->with('success','Data update success');
		} else {
			return redirect('commercial/import/cf_bill_monitoring_list')
					->with('error','Data update error');
		}
	}

	//Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

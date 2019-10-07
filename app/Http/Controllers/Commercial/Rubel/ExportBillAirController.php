<?php

namespace App\Http\Controllers\Commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator, DataTables, Redirect;

class ExportBillAirController extends Controller
{
	public function index()
	{
		$data['fileList'] = DB::table('cm_exp_data_entry_1 AS a')
						->leftjoin('cm_file AS b', 'a.cm_file_id', 'b.id')
						->select('b.id','b.file_no')
						->pluck("b.file_no", "b.id")
						->toArray();
		$data['invNoList'] = DB::table('cm_exp_data_entry_1')
						->select('id','inv_no')
						->pluck("inv_no", "inv_no")
						->toArray();
		return view('commercial.export.rubel.export_bill_air', $data);
	}

	public function exportBillAir_list()
	{
		return view('commercial.export.rubel.export_bill_air_list');
	}

	public function exportBillAir_listData_select()
	{
		return [
			'a.id',
			'a.cm_exp_data_entry_1_id',
			'a.job_start_date',
			'a.job_end_date'
		];
	}

	public function exportBillAir_listData()
	{
    	$data = DB::table('cm_export_bill_air AS a')
    			->select($this->exportBillAir_listData_select())
    			->get();
    	return DataTables::of($data)->addIndexColumn()
				->addColumn('action', function ($data) {
					$edit_url = url('commercial/export/export_bill_air_edit/'.$data->id);
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

    public function exportBillAir_edit_select()
    {
    	return [
    		'b.id AS d_entry1_id',
			'a.id AS exp_bill_air_id',
			'c.ship_bill_no',
			'c.ship_bill_date',
			'c.transp_doc_no',
			'c.transp_doc_date',
			'a.job_start_date',
			'a.job_end_date',
			'a.a1', 'a.a2', 'a.a3', 'a.a4', 'a.a5', 'a.a6',
			'a.b1', 'a.b2', 'a.b3', 'a.b4',
			'a.c1', 'a.c2', 'a.c3', 'a.c4',
			'a.d1', 'a.d2', 'a.d3', 'a.d4',
			'a.e1', 'a.e2'
    	];
    }

    public function exportBillAir_edit($exp_air_id)
    {
    	$check = DB::table('cm_export_bill_air')
    				->where('id', $exp_air_id)
    				->first();
		if(count($check) > 0) {
			$data['exportBillAirData'] = DB::table('cm_export_bill_air AS a')
										->leftjoin('cm_exp_data_entry_1 AS b','a.cm_exp_data_entry_1_id','b.id')
										->leftjoin('cm_exp_update2 AS c','a.inv_no','c.invoice_no')
										->select($this->exportBillAir_edit_select())
										->where(['a.id' => $exp_air_id])
										->first();
			return view('commercial.export.rubel.export_bill_air_edit', $data);
		} else {
			return redirect('commercial/export/export_bill_air_list')
					->with('error','Data not found');
		}
    }

    public function exportBillAir_updateData_except()
    {
    	return [
    		'_token',
			'file_id',
			'exp_bill_air_id',
			'bill_entry_no',
			'bill_entry_date',
			't_doc_no',
			'to_doc_date',
			'a_total',
			'b_total',
			'c_total',
			'd_total',
			'e_total',
			'total_tk',
			'less_res_tk',
			'total_misc_exp_tk'
    	];
    }

    public function exportBillAir_updateData($exp_air_id)
    {
    	$check = DB::table('cm_export_bill_air')->where('id', $exp_air_id)->first();
		if(count($check) > 0) {
			$input_data 				= request()->except($this->exportBillAir_updateData_except());
			$input_data['updated_at'] 	= date('Y-m-d H:i:s', time());
			DB::table('cm_export_bill_air')
				->where('id',$exp_air_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update export bill air info (cm_export_bill_air)', $exp_air_id);
			return redirect('commercial/export/export_bill_air_list')
					->with('success','Data update success');
		} else {
			return redirect('commercial/export/export_bill_air_list')
					->with('error','Data not found');
		}
    }

    public function exportBillAir_delete($exp_air_id)
    {
    	$check = DB::table('cm_export_bill_air')
    				->where('id', $exp_air_id)
    				->first();
		if(count($check) > 0) {
			DB::table('cm_export_bill_air')
				->where('id', $exp_air_id)
				->delete();
			// update log file
			$this->logFileWrite('Delete export bill air info (cm_export_bill_air)', $exp_air_id);
			return redirect('commercial/export/export_bill_air_list')
					->with('success','Data delete success');
		} else {
			return redirect('commercial/export/export_bill_air_list')
					->with('error','Data delete error');
		}
    }

    public function exportBillAir_saveData_except()
    {
    	return [
    		'_token',
			'file_id',
			'exp_bill_air_id',
			'bill_entry_no',
			'bill_entry_date',
			't_doc_no',
			'to_doc_date',
			'a_total',
			'b_total',
			'c_total',
			'd_total',
			'e_total',
			'total_tk',
			'less_res_tk',
			'total_misc_exp_tk'
    	];
    }

	public function exportBillAir_saveData()
	{
		$exp_bill_air_id = request()->input('exp_bill_air_id');
		$input_data = request()->except($this->exportBillAir_saveData_except());
		if($exp_bill_air_id != NULL) {
			$input_data['updated_at'] = date('Y-m-d H:i:s', time());
			DB::table('cm_export_bill_air')
				->where('id',$exp_bill_air_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update export bill air info (cm_export_bill_air)', $exp_bill_air_id);
			return redirect('commercial/export/export_bill_air_list')
					->with('success','Data update success');
		} else {
			$exp_bill_air_id = DB::table('cm_export_bill_air')
				->insertGetId($input_data);
			// update log file
			$this->logFileWrite('Insert export bill air info (cm_export_bill_air)', $exp_bill_air_id);
			return redirect('commercial/export/export_bill_air_list')
					->with('success','Data insert success');
		}
	}

	public function exportBillAir_fetchInvNo()
	{
		$file_id = request()->input('file_id');
		if(request()->input('file_id') != '') {
			$fetch_invNoList  = DB::table('cm_exp_data_entry_1')
								->where(['cm_file_id' => $file_id])
								->pluck("inv_no", "inv_no")
								->toArray();
		} else {
			// if file id not found than show all invoice no
			$fetch_invNoList = DB::table('cm_exp_data_entry_1')
								->select('id','inv_no')
								->pluck("inv_no", "inv_no")
								->toArray();
		}
		$invNoOptions = '';
		// generate invoice no list
		if(count($fetch_invNoList) > 0) {
			$invNoOptions .= '<option value="">Select Invoice No</option>';
			foreach($fetch_invNoList as $k1 => $lc) {
				$invNoOptions .= '<option value="'.$lc.'">'.$lc.'</option>';
			}
		} else  {
			$invNoOptions = '<option value="">Not Found</option>';
		}
		return ['status' => TRUE,'inv_no' => $invNoOptions];
	}

	public function exportBillAir_fetchEntryData_select()
	{
		return [
			'a.id AS d_entry1_id',
			'b.id AS exp_bill_air_id',
			'c.ship_bill_no',
			'c.ship_bill_date',
			'c.transp_doc_no',
			'c.transp_doc_date',
			'b.job_start_date',
			'b.job_end_date',
			'b.a1', 'b.a2', 'b.a3', 'b.a4', 'b.a5', 'b.a6',
			'b.b1', 'b.b2', 'b.b3', 'b.b4',
			'b.c1', 'b.c2', 'b.c3', 'b.c4',
			'b.d1', 'b.d2', 'b.d3', 'b.d4',
			'b.e1', 'b.e2'
		];
	}

	public function exportBillAir_fetchEntryData()
	{
		$file_id = request()->input('file_no');
		$inv_no  = request()->input('inv_no');
		if($file_id != '' && $inv_no != '') {
			$data['exportBillAirData'] = DB::table('cm_exp_data_entry_1 AS a')
										->leftjoin('cm_export_bill_air AS b','a.id','b.cm_exp_data_entry_1_id')
										->leftjoin('cm_exp_update2 AS c','a.inv_no','c.invoice_no')
										->select($this->exportBillAir_fetchEntryData_select())
										->where(['a.cm_file_id' => $file_id, 'a.inv_no' => $inv_no])
										->first();
			$render = view('commercial.export.rubel.ajax_export_bill_air_form', $data)->render();
			return ['status' => TRUE,'render' => $render];
		} else {
			return ['status' => FALSE];
		}
	}



	//Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

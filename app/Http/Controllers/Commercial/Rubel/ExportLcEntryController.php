<?php

namespace App\Http\Controllers\commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator, DataTables, Redirect;

class ExportLcEntryController extends Controller
{
    public function index()
    {
    	$data['invoicNoList'] 	= DB::table('cm_exp_data_entry_1')
									->select('id','inv_no')
									->pluck("inv_no", "inv_no")
									->toArray();
		$data['unitIdList'] 	= DB::table('cm_exp_data_entry_1 AS a')
									->leftjoin('hr_unit AS b','a.unit_id','b.hr_unit_id')
									->select('b.hr_unit_id','b.hr_unit_name')
									->pluck("b.hr_unit_name", "b.hr_unit_id")
									->toArray();
		return view('commercial.export.rubel.export_lc_entry', $data);
    }

    public function exportLcEntry_save()
    {
    	$input_data = request()->except('_token','update_id');
    	$update_id 	= request()->input('update_id');
		if($update_id != NULL) {
			$input_data['updated_at'] = date('Y-m-d H:i:s', time());
			DB::table('cm_exp_update5')
				->where('id',$update_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update exp_update info (cm_exp_update5)', $update_id);
			return redirect('commercial/export/exportLcEntry_list')
					->with('success','Data update success');	
		} else {
			$exp_update5_id = DB::table('cm_exp_update5')
				->insertGetId($input_data);
			// update log file
			$this->logFileWrite('Insert exp_update info (cm_exp_update5)', $exp_update5_id);
			return redirect('commercial/export/exportLcEntry_list')
					->with('success','Data insert success');	
		}
    }

    public function exportLcEntry_list()
    {
    	return view('commercial.export.rubel.export_lc_entry_list');
    }

    public function exportLcEntry_edit($exp_update_id)
    {
    	$check = DB::table('cm_exp_update5 AS a')
    				->where('id', $exp_update_id)
    				->first();
		if(count($check) > 0) {
			$data['exportLcEntry'] = DB::table('cm_exp_update5 AS a')
				->leftjoin('hr_unit AS b','a.hr_unit','b.hr_unit_id')
				->where(['a.id' => $exp_update_id])
				->first();
    			return view('commercial.export.rubel.export_lc_entry_edit', $data);
		} else {
			return redirect('commercial/export/exportLcEntry_list')
					->with('error','Data not found');
		}
    }

    public function exportLcEntry_updateData_except()
    {
    	return [
    		'_token'
    	];
    }

    public function exportLcEntry_update($exp_update_id)
    {
    	$check = DB::table('cm_exp_update5')->where('id', $exp_update_id)->first();
		if(count($check) > 0) {
			$input_data 				= request()->except($this->exportLcEntry_updateData_except());
			$input_data['updated_at'] 	= date('Y-m-d H:i:s', time());
			DB::table('cm_exp_update5')
				->where('id',$exp_update_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update exp_update info (cm_exp_update5)', $exp_update_id);
			return redirect('commercial/export/exportLcEntry_list')
					->with('success','Data update success');	
		} else {
			return redirect('commercial/export/exportLcEntry_list')
					->with('error','Data not found');
		}
    }

    public function exportLcEntry_delete($exp_update_id)
    {
    	$check = DB::table('cm_exp_update5 AS a')
    				->where('id', $exp_update_id)
    				->first();
		if(count($check) > 0) {
			DB::table('cm_exp_update5')
				->where('id', $exp_update_id)
				->delete();
			// update log file
			$this->logFileWrite('Delete expense update info (cm_exp_update5)', $exp_update_id);
			return redirect('commercial/export/exportLcEntry_list')
					->with('success','Data delete success');
		} else {
			return redirect('commercial/export/exportLcEntry_list')
					->with('error','Data delete error');
		}
    }

    public function exportLcEntry_listData_select()
	{
		return [
			'a.id',
			'b.hr_unit_name',
			'a.invoice_no',
			'a.bank_sub_date'
		];
	}

	public function exportLcEntry_listData()
	{
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

    public function exportLcEntry_fetchentryform()
    {
    	$invoice_no = request()->input('invoice_no');
		$hr_unit  	= request()->input('hr_unit');
		if($invoice_no != '' && $hr_unit != '') {
			$data['expUpdateData'] = DB::table('cm_exp_update5 AS a')
										->leftjoin('hr_unit AS b','a.hr_unit','b.hr_unit_id')
										->where(['a.invoice_no' => $invoice_no, 'a.hr_unit' => $hr_unit])
										->first();
			$render = view('commercial.export.rubel.ajax_export_lc_entry_form', $data)->render();
			return ['status' => TRUE,'render' => $render];	
		} else {
			return ['status' => FALSE];
		}
    }

    public function exportLcEntry_fetchunit()
    {
    	$invoice_no = request()->input('invoice_no');
		if(request()->input('invoice_no') != '') {
			$fetch_unitList  = DB::table('cm_exp_data_entry_1 AS a')
								->leftjoin('hr_unit AS b','a.unit_id','b.hr_unit_id')
								->select('b.hr_unit_id','b.hr_unit_name')
								->where(['a.inv_no' => $invoice_no])
								->pluck("b.hr_unit_name", "b.hr_unit_id")
								->toArray();
		} else {
			// if file id not found than show all unit data
			$fetch_unitList = DB::table('cm_exp_data_entry_1 AS a')
									->leftjoin('hr_unit AS b','a.unit_id','b.hr_unit_id')
									->select('b.hr_unit_id','b.hr_unit_name')
									->pluck("b.hr_unit_name", "b.hr_unit_id")
									->toArray();
		}
		$unitOptions = '';
		// generate unit data list
		if(count($fetch_unitList) > 0) {
			$unitOptions .= '<option value="">Select Unit</option>';
			foreach($fetch_unitList as $k1 => $unit) {
				$unitOptions .= '<option value="'.$unit.'">'.$unit.'</option>';
			}
		} else  {
			$unitOptions = '<option value="">Not Found</option>';
		}
		return ['status' => TRUE,'unit' => $unitOptions];
    }


    //Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

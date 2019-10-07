<?php

namespace App\Http\Controllers\Commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator, DataTables, Redirect;

class CfExpensesController extends Controller
{
	public function index()
	{
		$data['fileList'] = DB::table('cm_imp_data_entry AS a')
						->leftjoin('cm_file AS b', 'a.cm_file_id', 'b.id')
						->select('b.id','b.file_no')
						->pluck("b.file_no", "b.id")
						->toArray();
		$data['lcDocNoList'] = DB::table('cm_imp_data_entry')
						->select('id','transp_doc_no1')
						->pluck("transp_doc_no1", "id")
						->toArray();
		return view('commercial.import.rubel.cf_expenses', $data);
	}

	public function cfExpenses_list()
	{
		return view('commercial.import.rubel.cf_expenses_list');
	}

	public function cfExpenses_listData_select()
	{
		return [
			'a.id',
			'a.cm_imp_data_entry_id',
			'a.job_start_date',
			'a.job_end_date'
		];
	}

	public function cfExpenses_listData()
	{
    	$data = DB::table('cm_clear_expense_imp_air AS a')
    			->select($this->cfExpenses_listData_select())
    			->get();
    	return DataTables::of($data)->addIndexColumn()
				->addColumn('action', function ($data) {
					$edit_url = url('commercial/import/cf_expenses_edit/'.$data->id);
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

    public function cfExpenses_edit_select()
    {
    	return [
    		'b.id AS d_entry_id',
			'a.id AS imp_air_id',
			'c.sup_name',
			'b.hr_unit',
			'b.package',
			'b.weight',
			'b.cubic_measurement',
			'b.transp_doc_no1',
			'b.transp_doc_date',
			'a.job_start_date',
			'a.job_end_date',
			'a.a1', 'a.a2', 'a.a3', 'a.a4', 'a.a5',
			'a.b1', 'a.b2', 'a.b3', 'a.b4', 'a.b5', 'a.b6', 'a.b7', 'a.b8',
			'a.c1', 'a.c2', 'a.c3', 'a.c4', 'a.c5',
			'a.d1', 'a.d2', 'a.d3', 'a.d4', 'a.d5',
			'a.e1', 'a.e2', 'a.e3',
			'a.f1', 'a.f2', 'a.f3', 'a.f4'
    	];
    }

    public function cfExpenses_edit($imp_air_id)
    {
    	$check = DB::table('cm_clear_expense_imp_air')->where('id', $imp_air_id)->first();
		if(!empty($check)) {
			$data['cfExpensesData'] = DB::table('cm_clear_expense_imp_air AS a')
				->leftjoin('cm_imp_data_entry AS b','a.cm_imp_data_entry_id','b.id')
				->leftjoin('mr_supplier AS c','b.mr_supplier_sup_id','c.sup_id')
				->select($this->cfExpenses_edit_select())
				->where(['a.id' => $imp_air_id])
				->first();
    			return view('commercial.import.rubel.cf_expenses_edit', $data);
		} else {
			return redirect('commercial/import/cf_expenses_list')
					->with('error','Data not found');
		}
    }

    public function cfExpenses_updateData_except()
    {
    	return [
    		'_token',
			'file_id',
			'trans_doc',
			'imp_air_id',
			'exp_for',
			'package',
			'weight',
			'cbm',
			'item',
			'supplier',
			'doc_value',
			'bill_entry_no',
			'bill_entry_date',
			't_doc_no',
			'to_doc_date',
			'a_total',
			'b_total',
			'c_total',
			'd_total',
			'e_total',
			'f_total',
			'total_tk',
			'less_res_tk',
			'labor',
			'total_misc_exp_tk'
    	];
    }

    public function cfExpenses_updateData($imp_air_id)
    {
    	$check = DB::table('cm_clear_expense_imp_air')
    				->where('id', $imp_air_id)
    				->first();
		if(count($check) > 0) {
			$input_data 				= request()->except($this->cfExpenses_updateData_except());
			$input_data['updated_at'] 	= date('Y-m-d H:i:s', time());
			DB::table('cm_clear_expense_imp_air')
				->where('id',$imp_air_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update imp_air info (cm_clear_expense_imp_air)', $imp_air_id);
			return redirect('commercial/import/cf_expenses_list')
					->with('success','Data update success');
		} else {
			return redirect('commercial/import/cf_expenses_list')
					->with('error','Data not found');
		}
    }

    public function cfExpenses_delete($imp_air_id)
    {
    	$check = DB::table('cm_clear_expense_imp_air')
					->where('id', $imp_air_id)
					->first();
		if(count($check) > 0) {
			DB::table('cm_clear_expense_imp_air')
				->where('id', $imp_air_id)
				->delete();
			// update log file
			$this->logFileWrite('Delete imp_air info (cm_clear_expense_imp_air)', $imp_air_id);
			return redirect('commercial/import/cf_expenses_list')
					->with('success','Data delete success');
		} else {
			return redirect('commercial/import/cf_expenses_list')
					->with('error','Data delete error');
		}
    }

    public function cfExpenses_saveData_except()
    {
    	return [
    		'_token',
			'file_id',
			'trans_doc',
			'imp_air_id',
			'exp_for',
			'package',
			'weight',
			'cbm',
			'item',
			'supplier',
			'doc_value',
			'bill_entry_no',
			'bill_entry_date',
			't_doc_no',
			'to_doc_date',
			'a_total',
			'b_total',
			'c_total',
			'd_total',
			'e_total',
			'f_total',
			'total_tk',
			'less_res_tk',
			'labor',
			'total_misc_exp_tk'
    	];
    }

	public function cfExpenses_saveData()
	{
		$imp_air_id = request()->input('imp_air_id');
		$input_data = request()->except($this->cfExpenses_saveData_except());
		if($imp_air_id != NULL) {
			$input_data['updated_at'] = date('Y-m-d H:i:s', time());
			DB::table('cm_clear_expense_imp_air')
				->where('id',$imp_air_id)
				->update($input_data);
			// update log file
			$this->logFileWrite('Update imp_air info (cm_clear_expense_imp_air)', $imp_air_id);
			return redirect('commercial/import/cf_expenses_list')
					->with('success','Data update success');
		} else {
			$imp_air_id = DB::table('cm_clear_expense_imp_air')
				->insertGetId($input_data);
			// update log file
			$this->logFileWrite('Insert imp_air info (cm_clear_expense_imp_air)', $imp_air_id);
			return redirect('commercial/import/cf_expenses_list')
					->with('success','Data insert success');
		}
	}

	public function cfExpenses_fetchTransDoc()
	{
		$file_id = request()->input('file_id');
		if(request()->input('file_id') != '') {
			$fetch_transDocList  = DB::table('cm_imp_data_entry')
									->where(['cm_file_id' => $file_id])
									->pluck("transp_doc_no1", "id")
									->toArray();
		} else {
			// if file id not found than show all trans_doc_no
			$fetch_transDocList = DB::table('cm_imp_data_entry')
									->select('id','transp_doc_no1')
									->pluck("transp_doc_no1", "id")
									->toArray();
		}
		$transDocOptions = '';
		// generate trans_doc_no list
		if(count($fetch_transDocList) > 0) {
			$transDocOptions .= '<option value="">Select Doc No</option>';
			foreach($fetch_transDocList as $k1 => $lc) {
				$transDocOptions .= '<option value="'.$lc.'">'.$lc.'</option>';
			}
		} else  {
			$transDocOptions = '<option value="">Not Found</option>';
		}
		return ['status' => TRUE,'trans_doc' => $transDocOptions];
	}

	public function cfExpenses_fetchEntryData_select()
	{
		return [
			'a.id AS d_entry_id',
			'b.id AS imp_air_id',
			'c.sup_name',
			'a.hr_unit',
			'a.package',
			'a.weight',
			'a.cubic_measurement',
			'a.transp_doc_no1',
			'a.transp_doc_date',
			'b.job_start_date',
			'b.job_end_date',
			'b.a1', 'b.a2', 'b.a3', 'b.a4', 'b.a5',
			'b.b1', 'b.b2', 'b.b3', 'b.b4', 'b.b5', 'b.b6', 'b.b7', 'b.b8',
			'b.c1', 'b.c2', 'b.c3', 'b.c4', 'b.c5',
			'b.d1', 'b.d2', 'b.d3', 'b.d4', 'b.d5',
			'b.e1', 'b.e2', 'b.e3',
			'b.f1', 'b.f2', 'b.f3', 'b.f4'
		];
	}

	public function cfExpenses_fetchEntryData()
	{
		$file_id = request()->input('file_no');
		$doc_no  = request()->input('doc_no');
		if($file_id != '' && $doc_no != '') {
			$data['cfExpensesData'] = DB::table('cm_imp_data_entry AS a')
				->leftjoin('cm_clear_expense_imp_air AS b','a.id','b.cm_imp_data_entry_id')
				->leftjoin('mr_supplier AS c','a.mr_supplier_sup_id','c.sup_id')
				->select($this->cfExpenses_fetchEntryData_select())
				->where(['a.cm_file_id' => $file_id, 'a.transp_doc_no1' => $doc_no])
				->first();
			$render = view('commercial.import.rubel.ajax_cfexpenses_form', $data)
						->render();
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

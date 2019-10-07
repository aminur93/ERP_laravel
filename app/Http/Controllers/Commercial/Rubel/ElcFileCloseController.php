<?php

namespace App\Http\Controllers\commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator, DataTables, Redirect;

class ElcFileCloseController extends Controller
{
    public function index()
    {      
    	$data['fileList'] = DB::table('cm_exp_data_entry_1 AS a')
							->leftjoin('cm_file AS b', 'a.cm_file_id', 'b.id')
							->select('b.id','b.file_no')
							->pluck("b.file_no", "b.id")
							->toArray();
    	return view('commercial.export.rubel.export_lc_close', $data);
    }

  	public function elcFileClose_save()
  	{           
        $data_inputs = request()->except('_token');
        $file_close_id = DB::table('cm_exp_file_close')
        	->insertGetId($data_inputs);
    	// update log file
		$this->logFileWrite('Insert file close info (cm_exp_file_close)', $file_close_id);
		return redirect('commercial/export/elcFileClose')
					->with('success','FIle close success');
  	}

  	public function elcFileClose_checkExist()
  	{
  		$file_id = request()->input('file_id');
  		$check = DB::table('cm_exp_file_close')
  			->where('cm_file_id', $file_id)
  			->first();
		if($check) {
			return ['status' => TRUE, 'elcFileClose' => $check];
		} else {
			return ['status' => FALSE, 'elcFileClose' => ''];
		}
  	}

  	//Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

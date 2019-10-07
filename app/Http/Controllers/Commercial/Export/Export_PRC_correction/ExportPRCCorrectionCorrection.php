<?php

namespace App\Http\Controllers\Commercial\Export\Export_PRC_correction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Export\CmPrcCorrection;
use DB;
use Response;
use Validator;

class ExportPRCCorrectionCorrection extends Controller
{
    public function viewInvoiceList(){

    	$exp_entry_data = DB::table('cm_exp_data_entry_1 as exp')
    								->join('cm_file as file','file.id','=', 'exp.cm_file_id' )
    								->leftjoin('cm_prc_correction as prc', 'prc.cm_file_id','=', 'exp.cm_file_id')
    								->join('cm_exp_update2 as exp_2', 'exp_2.invoice_no', '=', 'exp.inv_no')
    								->select('exp.cm_file_id','file.file_no','exp.inv_no','exp.inv_value', 'prc.remburse_value', 
    									     'exp_2.transp_doc_date', 'prc.id as prc_id')
    								->get();
        // dd($exp_entry_data->all() );
    	// $prc_data = DB::table('cm_prc_correction')->get();
    	// $prc_data_file_ids = DB::table('cm_prc_correction')->select('cm_file_id')->get();

    	return view('commercial.export.export_prc_correction.export_prc_correction' , compact('exp_entry_data') );
    }

    public function prc_correction_save(Request $request){
    		
    		  $validator = Validator::make($request->all(),[
                        'file_no_id'   	=> 'required',
                        'invoice_no'    => 'required|max:45',
                        'invoice_value' => 'required|max:45',
                        'reimb_value'   => 'required'
                ]);
            
                 if($validator->fails()){
                    return back()
                        ->withInput()
                        ->with('error', "Incorrect Input!!");
                }
                else{
                	// dd($request->all() );
    				$data = new CmPrcCorrection();
    				$data->cm_file_id 		= $request->file_no_id ;
    				$data->invoice_no 		= $request->invoice_no ;
    				$data->value 			= $request->invoice_value ;
    				$data->remburse_value 	= $request->reimb_value ;

    				$data->save();

    				return Response::json('Data Saved');
				}


    }

    public function prc_correction_update(Request $request){
    			$validator = Validator::make($request->all(),[
                        'reimb_value'   => 'required'
                ]);
            
                 if($validator->fails()){
                    return back()
                        ->withInput()
                        ->with('error', "Incorrect Input!!");
                }
                else{
                	// dd($request->all());
                	CmPrcCorrection::where('id', $request->prc_id )->update([
                		'remburse_value' => $request->reimb_value
                	]);

                	return Response::json('Data Updated');
                }

    }

    public function prc_correction_delete($id){
    	CmPrcCorrection::where('id', $id)->delete();
    	return back()->with('success', "Data deleted successfully");
    }

}

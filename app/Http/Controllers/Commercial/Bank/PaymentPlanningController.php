<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ExportDataEntry;
use App\Models\Commercial\Bank\CmUpdate5;
use App\Models\Commercial\Bank\EntryPO;
use App\Models\Commercial\Bank\CmFileTransfer;
use App\Models\Commercial\Bank\PaymentPlanning;




use Validator;

use DB;
use Response;

class PaymentPlanningController extends Controller{

	public function paymentPlanningView(){

		$file_id=DB::table('cm_exp_data_entry_1 as a')
    			->select('a.cm_file_id','b.id','b.file_no')
    			->join('cm_file as b','b.id','=','a.cm_file_id')
                ->distinct()
    			->get();

    	$inv_no="";
    	$tdoc=DB::table('cm_imp_data_entry as a')
    				->select('a.transp_doc_no1','a.id')
    				->get();


	
    	//dd($tdoc);
		

    	return view('commercial.bank.payment_planning',compact('file_id','inv_no','tdoc'));

	}

	public function getInvoice(Request $request){
            
          $inv_no=DB::table('cm_exp_data_entry_1 as e')
          ->select('e.inv_no','e.cm_file_id')
          ->where('e.cm_file_id', '=', $request->file_no_id) 
          ->get();

          $tdoc_no=DB::table('cm_imp_data_entry as a')
          			->select('a.transp_doc_no1','a.id')
          			->where('a.cm_file_id','=',$request->file_no_id)
          			->get();

		foreach($inv_no as $inv){
			$data['invoice'][]=$inv->inv_no;
		}
		foreach($tdoc_no as $td){
		    $data['trans_doc_no'][]=$td->transp_doc_no1;
		    $data['trans_doc_id'][]=$td->id;

	    }
		// dd($data);
		// $data['file_id'] = $request->file_no_id;
    	return Response::json($data);

    }

    public function getExpData(Request $request){

    	$t_data=DB::table('cm_exp_data_entry_1 as a')
    		 ->select('a.inv_no',
    		 		  'a.id',
    		 		  'a.inv_date',
    		 		  'a.inv_value',
    		 		  'b.bill_no',
    		 		  'b.bank_sub_date',
    		 		  'c.cm_exp_data_entry_1_id',
    		 		  'c.po_qty'
    				  )
    		 ->leftjoin('cm_exp_update5 as b', 'a.inv_no','=','b.invoice_no')
    		 ->leftjoin('cm_exp_entry1_po as c','c.cm_exp_data_entry_1_id','=','a.id')
    		 ->where('a.inv_no','=',$request->invoice_no)
    		 ->first();

    	// $dad_cal=DB::table('cm_exp_data_entry_1 as e')
    	// 			->select('t.amount','e.cm_file_id as cid','t.cm_file_id')
    	// 			->leftjoin('cm_file_transfer as t','t.cm_file_id','=','e.cm_file_id')
    	// 			->where('t.cm_file_id','=',$request->file_no_id)
    	// 			->get();
    				// ->sum('t.amount');
    	$dad_cal=DB::table('cm_file_transfer as a')
    					//->select('b.id as acc_id','a.cm_file_id','b.acc_type_name','a.amount')
    					->join('cm_acc_type as b','b.id','=','a.cm_acc_type_id')
    					->where('a.cm_file_id','=',$request->file_no_id )
    					->where('b.acc_type_name','=','DAD')
    					->sum('amount');

    	$dad_cal_other=DB::table('cm_file_transfer as a')
    					//->select('b.id as acc_id','a.cm_file_id','b.acc_type_name','a.amount')
    					->join('cm_acc_type as b','b.id','=','a.cm_acc_type_id')
    					->where('a.cm_file_id','!=',$request->file_no_id )
    					->where('b.acc_type_name','=','DAD')
    					->sum('amount');

    	//dd($dad_cal);


    	/*$dad_cal = DB::table('cm_file_transfer')
    					->where('cm_file_id','=', $request->file_no_id )
    					->where('cm_acc_type_id','=',3)
    					->sum('amount');*/

    	/*$dad_cal_other=DB::table('cm_file_transfer')
    					->where('cm_file_id','!=',$request->file_no_id)
    					->where('cm_acc_type_id','=',3)
    					->sum('amount');*/

    		 //dd('File ID:',$request->file_no_id, 'DAD:',$dad_cal_other);
    	
    		 return Response::json(
    		 						['inv_date'=>$t_data->inv_date,
    								'bill_no'=>$t_data->bill_no,
    								'bill_date'=>$t_data->bank_sub_date,
    								'value'=>$t_data->inv_value,
    								'pcs'=>$t_data->po_qty,
    								'dad_amount'=>$dad_cal,
    								'other_dad_amount'=>$dad_cal_other
    								]
    							  );

    	//$data[]=$t_data->inv_date.$t_data->inv_value;


    		 //dd($t_data);
    }


    	public function postExportBills(Request $request){
    			// dd($request->all());
    		 $validator = Validator::make($request->all(),[
    				 	'hidd_file_id' =>'required'
    			]);
    			 if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Empty Input");
         		}

         		else{
         			// dd($request->all());
         			$cm_imp_data_entry_id = DB::table('cm_imp_data_entry')
         											->where('cm_file_id','=', $request->hidd_file_id)
         											->value('id');

         			$cm_exp_data_entry_id = DB::table('cm_exp_data_entry_1')
         											->where('cm_file_id','=', $request->hidd_file_id)
         											->value('id');
         			$data= new PaymentPlanning();
         			$data->cm_exp_data_entry_1_id = $cm_exp_data_entry_id;
         			$data->cm_imp_data_entry_id = $cm_imp_data_entry_id;
         			$data->planning_code = $request->rand;
         			$data->save();
         			return back()->with('success', 'Export Entry Saved');
         		}




    	}

			public function getBill(Request $request){
			            
			          $bill_no=DB::table('cm_bank_acceptance_imp as a')
			          ->select('a.bank_bill_no','a.cm_imp_data_entry_id','b.id')
			          ->join('cm_imp_data_entry as b','b.id','=','a.cm_imp_data_entry_id')
			          ->where('b.id', '=', $request->tdoc_number) 
			          ->get();


			        //dd($bill_no);
                    if($bill_no->isempty()){
                        $data[]="empty";
                    }

                    else{
					foreach($bill_no as $bn){
						$data[]=$bn->bank_bill_no;
					   }
                    }
					//dd($data);
					// $data['file_id'] = $request->file_no_id;
			    	return Response::json($data);

			    }

			public function getImpData(Request $request){

				$due_bill_date=DB::table('cm_bank_acceptance_imp as a')
							->select('a.due_date','a.cm_imp_data_entry_id')
					        ->where('a.bank_bill_no', '=', $request->imp_bill_no) 
					        ->first();

				$imp_value=DB::table('cm_bank_acceptance_imp as a')
					  ->select('a.cm_imp_data_entry_id','b.id','b.value')
			          ->join('cm_imp_data_entry as b','b.id','=','a.cm_imp_data_entry_id')
			          ->where('b.id', '=', $request->tdoc_number) 
			          ->first();
				//dd($due_bill_date);

			    return Response::json(['due_date'=>$due_bill_date->due_date,
									   'imp_value'=>$imp_value->value]);
			}


			public function postImportBills(Request $request){
    			// dd($request->all());
    		 $validator = Validator::make($request->all(),[
    				 	'hidd_file_id2' =>'required'
    			]);
    			 if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Please check Input");
         		}

         		else{
         			// dd($request->all());
         			$cm_imp_data_entry_id = DB::table('cm_imp_data_entry')
         											->where('cm_file_id','=', $request->hidd_file_id2)
         											->value('id');

         			$cm_exp_data_entry_id = DB::table('cm_exp_data_entry_1')
         											->where('cm_file_id','=', $request->hidd_file_id2)
         											->value('id');
         			$data= new PaymentPlanning();
         			$data->cm_exp_data_entry_1_id = $cm_exp_data_entry_id;
         			$data->cm_imp_data_entry_id = $cm_imp_data_entry_id;
         			$data->planning_code = $request->rand2;
         			$data->save();
         			return back()->with('success', 'Entry Saved');
         		}




    	}


    	public function showPlanningData(){
    	$payment_planning_data = PaymentPlanning::get();
    	//dd($payment_planning_data);
    	$table_data=DB::table('cm_payment_planning as a')
    			->select('a.cm_exp_data_entry_1_id','a.planning_code','b.cm_file_id as expfileid','b.id','c.id','c.cm_file_id as impfileid','d.id','d.file_no as expfile','e.file_no as impfile')
    			->join('cm_exp_data_entry_1 as b','b.id','=','a.cm_exp_data_entry_1_id')
    			->join('cm_imp_data_entry as c','c.id','=','a.cm_imp_data_entry_id')
    			->join('cm_file as d','d.id','=','b.cm_file_id')
    			->join('cm_file as e','e.id','=','c.cm_file_id')
    			->get();
    	//dd($table_data);
    	/*$imp_data=DB::table('cm_payment_planning as a')
    				->select('a.cm_imp_data_entry_id','b.cm_file_id','b.id','c.id','c.file_no')
    				->join('cm_imp_data_entry as b','b.id','=','a.cm_imp_data_entry_id')
    				->join('cm_file as c','c.id','=','b.cm_file_id')
    				->get();*/
    	//dd($imp_data);

		return view( 'commercial.bank.payment_planning_data', compact('payment_planning_data','table_data')); //compact('bank_acceptance_imp_data') ); 
    		}



}
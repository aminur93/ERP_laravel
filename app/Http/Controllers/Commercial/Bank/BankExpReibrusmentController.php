<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ExportDataEntry;
use App\Models\Commercial\Bank\BankExpReimbursement;
use App\Models\Commercial\Bank\BankFundTransfer;


use Validator;
use DB;
use Response;
use DateTime;

class BankExpReibrusmentController extends Controller
{

    public function bankExpReimbrusmentEntryView(){
    	// $export_data_entry = ExportDataEntry::get();

    	$file_list = DB::table('cm_file as f')->select('f.id', 'f.file_no')->distinct()
    					->leftJoin('cm_exp_data_entry_1 as ast', 'f.id' , '=', 'ast.cm_file_id')
    					->get();

    	return view('commercial.bank.bank_export_reibrusment_entry', compact('file_list') );
    }

    public function getInvoiceNo(Request $request){
    	$invoice_nos = ExportDataEntry::where('cm_file_id', $request->file_id )
    									->select('inv_no')->get();
        // $invoice_nos = DB::table()->where('cm_file_id','=', $request->file_id )
        //                                  ->select('inv_no')->get();
    	$t_val = DB::table('cm_exp_lc_entry as lc')->select('lc.cm_file_id', 'bk.id', 'bk.bank_name')
    											 ->leftJoin('cm_sales_contract as sal', 'lc.cm_sales_contract_id', '=', 'sal.id')
    											 ->leftJoin('cm_bank as bk', 'sal.lc_open_bank_id','=', 'bk.id')
    											 ->get();

    	// dd('Invoice:',$invoice_nos,'Value:',$t_val);
    	$val = new \stdClass();

    	foreach($t_val as $t_v){
    		if($t_v->cm_file_id == $request->file_id ){
    			$val->id = $t_v->id;
    			$val->bank_name = $t_v->bank_name;
    			break;
    		}
    		else
    		{
    			continue;
    		}
    	}
    	// dd($val);

         foreach($invoice_nos as $inv){
            $data['invoice'][]=$inv->inv_no;
         }
         $data['bank_id'][]=$val->id;
         $data['bank_nm'][]=$val->bank_name;

         // dd($data);
          return Response::json($data);
    }

    public function getSearchResult(Request $request){

    	$file_no = DB::table('cm_file')->select('id','file_no')->where('id','=', $request->file_no_id)->first();
    	//dd($file_no);
    	$dis_amnt = DB::table('cm_exp_bill_discounting')->select('disc_rcv_amnt')
    													->where('invoice_no','=', $request->invoice_no)
    												    ->get();
       // dd($dis_amnt->disc_rcv_amnt);

    	if(isset($request->file_no_id) && !isset($request->invoice_no)){
    			$q =  ['cm_file_id' => $request->file_no_id ];
    	}
    	else {
    			$q =  ['cm_file_id' => $request->file_no_id, 'inv_no' => $request->invoice_no  ];	
    	}

    	$exp_data_entry_1 = ExportDataEntry::select('id','cm_file_id','inv_value', 'inv_no')
    									->where($q)
    									->get();
    	// dd($exp_data_entry_1);
    	$bill_no = DB::table('cm_exp_update5 as a')->select('a.bill_no')
    											   ->where('a.invoice_no', '=', $request->invoice_no )
    											   ->get();
    	$trans_doc_date = DB::table('cm_exp_update2 as b')->select('b.transp_doc_date')
    											     ->where('b.invoice_no', '=', $request->invoice_no )
    											     ->get();

        // dd('Bill', $bill_no, 'Transp doc date', $trans_doc_date );
    	$current_date = date('Y-m-d');
    	// dd('Current Date:',$current_date);
    	$curr_date = new DateTime($current_date);

    	foreach ($exp_data_entry_1 as $exp_data) {
    			foreach ($bill_no as $bill) {
    		       $exp_data->bill_no = $bill->bill_no;
    	         }
    	}
    	
		foreach ($exp_data_entry_1 as $exp_data) {
		    	foreach ($trans_doc_date as $tdd) {

		    		$trans_date = new DateTime($tdd->transp_doc_date);

		    		$difference = $curr_date->diff($trans_date);
		    		$exp_data->trans_doc_date = $tdd->transp_doc_date;
		    		$exp_data->diff_days = $difference->days;	
		    	}
		    	foreach ($dis_amnt as $disa) {
		    		$exp_data->disc_amt = $disa->disc_rcv_amnt;
		    	}
		    }
         
       // dd('Data: ',$exp_data_entry_1); 
        $data = "";
    	for($i=0; $i<sizeof($exp_data_entry_1); $i++){
    	  	   $data .= '<tr>  <td>'.$file_no->file_no.'</td> 
                        <td>'.$exp_data_entry_1[$i]->bill_no.'</td>
                        <td>'.$exp_data_entry_1[$i]->inv_value.'</td>
                        <td>'.$exp_data_entry_1[$i]->inv_no.'</td>
                        <td>'.$exp_data_entry_1[$i]->trans_doc_date.'</td>
                        <td>'.$exp_data_entry_1[$i]->diff_days.' 
		                     
                        </td>
                        <td> 
                            <input type="radio" name="check[]" id="check" value = "'.$exp_data_entry_1[$i]->id.'" class="ck" />
                            <input type="hidden" name="file_id" id="file_id" class="file_id" value="'.$file_no->id.'"/>
                            <input type="hidden" name="inv_td" id="inv_td" class="inv_td" value="'.$exp_data_entry_1[$i]->inv_no.'"/>
                            <input type="hidden" id="d_bill_amt" name="d_bill_amt" class="d_bill_amt" value="'.$exp_data_entry_1[$i]->disc_amt.'" />    
                        </td>	</tr>';
                    }
                   //dd($data);

    	return Response::json($data);

    }

    public function saveReimbEntry(Request $request){
    			
    			$validator = Validator::make($request->all(),[

						  // 'date_entry'				=>  'required',
						  'reimbrusement_amount'	=>	'required',
						  'exchange_rate'			=>	'required',
						  'fc_amount_dollar'		=>	'required',
						  'fc_amount_per'			=>	'required',
						  'cd_amount_dollar'		=>	'required',
						  'cd_amount_per'			=>	'required',
						  'a_tax_amount_bdt'		=>	'required',
						  'a_tax_amount_per'		=>	'required',
						  'tax_source_bdt'			=>	'required',
						  'tax_source_per'			=>	'required',
						  'central_fund_bdt'		=>	'required',
						  'central_fund_per'		=>	'required',
						  'discount_interest_usd'	=>	'required'
    			]);

    			if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         		}
         		else{
         			// dd($request->all());

         			$data = new BankExpReimbursement();
         			$data->cm_exp_data_entry_1_id   =   $request->exp_data_entry_1_id;
         			$data->invoice_no 				=	$request->inv_no;
         			$data->date 					=	$request->date_entry;
         			$data->reimburse_amount 		=	$request->reimbrusement_amount;
         			$data->exchange_rate 			=	$request->exchange_rate;
         			$data->fc_amount_dollar 		=	$request->fc_amount_dollar;
         			$data->fc_amount_percent 		=	$request->fc_amount_per;
         			$data->cd_amount_dollar 		=	$request->cd_amount_dollar;
         			$data->cd_amount_percent 		=	$request->cd_amount_per;
         			$data->a_tax_amount_bdt 		=	$request->a_tax_amount_bdt;
         			$data->a_tax_percent 			=	$request->a_tax_amount_per;
         			$data->tax_source_bdt 			=	$request->tax_source_bdt;
         			$data->tax_source_bdt_percent 	=	$request->tax_source_per;
         			$data->central_fund 			=	$request->central_fund_bdt;
         			$data->central_fund_percent 	=	$request->central_fund_per;
         			$data->discount_interest_usd 	=	$request->discount_interest_usd;

         			$data->save();
                    $last_id = $data->id;

                //internal input to fund transfer table(cm_file_transfer)......//
                    $file_id = $request->file_id;
                    $acc_type_ERQ_id  = DB::table('cm_acc_type')->where('acc_type_name','=', 'ERQ')->value('id');
                    $acc_type_CD_id   = DB::table('cm_acc_type')->where('acc_type_name','=', 'CD')->value('id');
                    $acc_type_DAD_id  = DB::table('cm_acc_type')->where('acc_type_name','=', 'DAD')->value('id');

                    $fund_data = new BankFundTransfer();
                    //For Acc---ERQ
                    $fund_data->cm_file_id          = $file_id;
                    $fund_data->cm_acc_type_id      = $acc_type_ERQ_id;
                    $fund_data->date                = $request->date_entry;
                    $fund_data->narration           = 'Export Payment Receive('.$last_id.')';
                    $fund_data->amount              = $request->fc_amount_dollar;
                    $fund_data->currency            = 'USD';
                    $fund_data->save();

                    $fund_data1 = new BankFundTransfer();
                    //For Acc---CD
                    $fund_data1->cm_file_id          = $file_id;
                    $fund_data1->cm_acc_type_id      = $acc_type_CD_id ;
                    $fund_data1->date                = $request->date_entry;
                    $fund_data1->narration           = 'Export Payment Receive('.$last_id.')';
                    $fund_data1->amount              = $request->cd_amount_dollar;
                    $fund_data1->currency            = 'USD';
                    $fund_data1->save();

                    $fund_data2 = new BankFundTransfer();
                    //For Acc---DAD
                    $amount_here = ($request->reimbrusement_amount - $request->fc_amount_dollar - $request->cd_amount_dollar);
                    $fund_data2->cm_file_id          = $file_id;
                    $fund_data2->cm_acc_type_id      = $acc_type_DAD_id ;
                    $fund_data2->date                = $request->date_entry;
                    $fund_data2->narration           = 'Export Payment Receive('.$last_id.')';
                    $fund_data2->amount              = $amount_here;
                    $fund_data2->currency            = 'USD';
                    $fund_data2->save();
                 //internal input to fund transfer table end............//


         			return back()->with('success', 'Entry Saved');

         		}

    }

     public function viewReimbursementEntry(){
     	     $exp_reimb_data = BankExpReimbursement::get();
     	     //Files
     	     $tmpF = DB::table('cm_exp_reimburse as rmb')->select('f.file_no')
     	     					->leftJoin('cm_exp_data_entry_1 as ede','rmb.cm_exp_data_entry_1_id','=', 'ede.id')
     	     					->leftJoin('cm_file as f', 'ede.cm_file_id', '=', 'f.id')
     	     					->get();
     	     //Bills
     	     $tmpB = DB::table('cm_exp_reimburse as rmb')->select('eu5.bill_no')
     	     					->leftJoin('cm_exp_update5 as eu5', 'rmb.invoice_no','=', 'eu5.invoice_no')
     	     					->get();
     	     //Trans Doc Dates
     	     $tmpTDD = DB::table('cm_exp_reimburse as rmb')->select('eu2.transp_doc_date')
     	     					->leftJoin('cm_exp_update2 as eu2', 'rmb.invoice_no','=', 'eu2.invoice_no')
     	     					->get();
     	     					// dd($tmpTDD);
     	     
     	     //Value
     	     $tmpV = DB::table('cm_exp_reimburse as rmb')->select('ede.inv_value')
     	     					->leftJoin('cm_exp_data_entry_1 as ede','rmb.cm_exp_data_entry_1_id','=', 'ede.id')
     	     					->get();
     	     
     	     //Taking sys time to calculate difference
     	     $current_date = date('Y-m-d');
			 $curr_date = new DateTime($current_date);
     	     //Attaching 
     	     foreach ($exp_reimb_data as $erd) {
		     	   foreach ($tmpF as $t) {
		     	     	$erd->file_no = $t->file_no;				
		     	      }
		     	   foreach ($tmpB as $t) {
		     	     	$erd->bill_no = $t->bill_no;				
		     	      }
		     	   foreach ($tmpTDD as $t) {
		     	     	$erd->transp_doc_date = $t->transp_doc_date;
		     	     	$trans_date = new DateTime($t->transp_doc_date);
			 	     	$difference = $curr_date->diff($trans_date);
			 	     	$erd->diff_days = $difference->days;
		     	      }
		     	   foreach ($tmpV as $t) {
		     	     	$erd->value = $t->inv_value;				
		     	      }		
     	     }

    	     // dd($exp_reimb_data);
    	     

     	     return view('commercial.bank.bank_export_reibrusment_entry_view', compact('exp_reimb_data') );
     }

     //edit
     public function expReimbursementEdit($id){
     	 $exp_reimb_data = BankExpReimbursement::where('id', $id)->first();
     	  // dd($exp_reimb_data);
     	 $cm_exp_data_entry_id = $exp_reimb_data->cm_exp_data_entry_1_id; 
     	 // dd($cm_exp_data_entry_id);
     	 $invoice_no = $exp_reimb_data->invoice_no;
     	 //File
     	     $tmpF = DB::table('cm_exp_reimburse as rmb')->select('f.file_no', 'rmb.cm_exp_data_entry_1_id')
     	     					->leftJoin('cm_exp_data_entry_1 as ede', 'rmb.cm_exp_data_entry_1_id', '=', 'ede.id')
     	     					->leftJoin('cm_file as f', 'ede.cm_file_id', '=', 'f.id')
     	     					->get();
     	     					// dd($tmpF);
     	     foreach ($tmpF as $t) {
     	     	if($t->cm_exp_data_entry_1_id ==  $cm_exp_data_entry_id){
     	     		$file = $t->file_no;
     	     		break;
     	     	}
     	     }
     	     // dd($file);
     	 //Bill
     	     $tmpB = DB::table('cm_exp_update5 as eu5')
     	     					->where( 'eu5.invoice_no','=', $invoice_no )
     	     					->value('eu5.bill_no');
     	     					// dd($tmpB);
     	 //Trans Doc Date
     	     $tmpTDD = DB::table('cm_exp_update2 as eu2')
     	     					->where('eu2.invoice_no' ,'=', $invoice_no )
     	     					->value('eu2.transp_doc_date');
     	     					 // dd($tmpTDD);
     	     

     	     //Value
     	     $tmpV = DB::table('cm_exp_data_entry_1 as ede')
     	     					->where('ede.id' , '=', $cm_exp_data_entry_id)
     	     					->value('ede.inv_value');
     	     					// dd($tmpV);
     	     //Dicount amount					
     	     $dis_amnt = DB::table('cm_exp_bill_discounting')
    										->where('invoice_no','=', $exp_reimb_data->invoice_no)
    										->value('disc_rcv_amnt');
    										// dd($dis_amnt);
     	     
     	     //Taking sys time to calculate difference
     	     	$current_date = date('Y-m-d');
			 	$curr_date = new DateTime($current_date);
     	     //Attaching 
     	     $exp_reimb_data->file_no 			=  $file;
     	     $exp_reimb_data->bill_no 			=  $tmpB;
     	     $exp_reimb_data->transp_doc_date 	=  $tmpTDD;
		     	$trans_date = new DateTime($tmpTDD);
			 	$difference = $curr_date->diff($trans_date);
			 $exp_reimb_data->diff_days 		= $difference->days;
		     $exp_reimb_data->value 			= $tmpV;
		     $exp_reimb_data->disc_amount 		= $dis_amnt;				
     	    
     	     

    	      // dd($exp_reimb_data);

    	  return view('commercial.bank.bank_export_reibrusment_entry_edit', compact('exp_reimb_data') );

     }

     public function updateReimbEntry(Request $request){
     	$validator = Validator::make($request->all(),[

						  // 'date_entry'				=>  'required',
						  'reimbrusement_amount'	=>	'required',
						  'exchange_rate'			=>	'required',
						  'fc_amount_dollar'		=>	'required',
						  'fc_amount_per'			=>	'required',
						  'cd_amount_dollar'		=>	'required',
						  'cd_amount_per'			=>	'required',
						  'a_tax_amount_bdt'		=>	'required',
						  'a_tax_amount_per'		=>	'required',
						  'tax_source_bdt'			=>	'required',
						  'tax_source_per'			=>	'required',
						  'central_fund_bdt'		=>	'required',
						  'central_fund_per'		=>	'required',
						  'discount_interest_usd'	=>	'required'
    			]);

    			if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         		}
         		else{

             //updation in fund transfer table(cm_file_transfer)..............//
                     $ck_string = 'Export Payment Receive('.$request->reimb_id.')';
                     $fund_transfer_rows_to_update = DB::table('cm_file_transfer')->where('narration', '=', $ck_string) 
                                                                                  ->select('id')      
                                                                                  ->get();

                     // dd($fund_transfer_rows_to_update);
                     
                     BankFundTransfer::where('id', $fund_transfer_rows_to_update[0]->id)
                                                  ->update([
                                                        'date'     => $request->date_entry,
                                                        'amount'   => $request->fc_amount_dollar
                                                  ]);
                     BankFundTransfer::where('id', $fund_transfer_rows_to_update[1]->id)
                                                  ->update([
                                                        'date'     => $request->date_entry,
                                                        'amount'   => $request->cd_amount_dollar
                                                  ]);
                     $amount_here = ($request->reimbrusement_amount - $request->fc_amount_dollar - $request->cd_amount_dollar);
                     BankFundTransfer::where('id', $fund_transfer_rows_to_update[2]->id)
                                                  ->update([
                                                        'date'     => $request->date_entry,
                                                        'amount'   => $amount_here
                                                  ]);     

             //updation in fund transfer table end...................................//   




         			$update_data = BankExpReimbursement::where('id', $request->reimb_id )->update([
         						'cm_exp_data_entry_1_id'    =>  $request->exp_data_entry_1_id,
			         			'invoice_no' 				=>	$request->inv_no,
			         			'date' 						=>	$request->date_entry,
			         			'reimburse_amount' 			=>	$request->reimbrusement_amount,
			         			'exchange_rate'				=>	$request->exchange_rate,
			         			'fc_amount_dollar' 			=>	$request->fc_amount_dollar,
			         			'fc_amount_percent' 		=>	$request->fc_amount_per,
			         			'cd_amount_dollar' 			=>	$request->cd_amount_dollar,
			         			'cd_amount_percent' 		=>	$request->cd_amount_per,
			         			'a_tax_amount_bdt' 			=>	$request->a_tax_amount_bdt,
			         			'a_tax_percent' 			=>	$request->a_tax_amount_per,
			         			'tax_source_bdt' 			=>	$request->tax_source_bdt,
			         			'tax_source_bdt_percent' 	=>	$request->tax_source_per,
			         			'central_fund' 				=>	$request->central_fund_bdt,
			         			'central_fund_percent' 		=>	$request->central_fund_per,
			         			'discount_interest_usd' 	=>	$request->discount_interest_usd

							]);
             


                //for viewing..//
				     
                     $exp_reimb_data = BankExpReimbursement::get();
		     	     //Files
		     	     $tmpF = DB::table('cm_exp_reimburse as rmb')->select('f.file_no')
		     	     					->leftJoin('cm_exp_data_entry_1 as ede','rmb.cm_exp_data_entry_1_id','=', 'ede.id')
		     	     					->leftJoin('cm_file as f', 'ede.cm_file_id', '=', 'f.id')
		     	     					->get();
		     	     //Bills
		     	     $tmpB = DB::table('cm_exp_reimburse as rmb')->select('eu5.bill_no')
		     	     					->leftJoin('cm_exp_update5 as eu5', 'rmb.invoice_no','=', 'eu5.invoice_no')
		     	     					->get();
		     	     //Trans Doc Dates
		     	     $tmpTDD = DB::table('cm_exp_reimburse as rmb')->select('eu2.transp_doc_date')
		     	     					->leftJoin('cm_exp_update2 as eu2', 'rmb.invoice_no','=', 'eu2.invoice_no')
		     	     					->get();
		     	     					// dd($tmpTDD);
		     	     
		     	     //Value
		     	     $tmpV = DB::table('cm_exp_reimburse as rmb')->select('ede.inv_value')
		     	     					->leftJoin('cm_exp_data_entry_1 as ede','rmb.cm_exp_data_entry_1_id','=', 'ede.id')
		     	     					->get();
		     	     
		     	     //Taking sys time to calculate difference
		     	     $current_date = date('Y-m-d');
					 $curr_date = new DateTime($current_date);
		     	     //Attaching 
		     	     foreach ($exp_reimb_data as $erd) {
				     	   foreach ($tmpF as $t) {
				     	     	$erd->file_no = $t->file_no;				
				     	      }
				     	   foreach ($tmpB as $t) {
				     	     	$erd->bill_no = $t->bill_no;				
				     	      }
				     	   foreach ($tmpTDD as $t) {
				     	     	$erd->transp_doc_date = $t->transp_doc_date;
				     	     	$trans_date = new DateTime($t->transp_doc_date);
					 	     	$difference = $curr_date->diff($trans_date);
					 	     	$erd->diff_days = $difference->days;
				     	      }
				     	   foreach ($tmpV as $t) {
				     	     	$erd->value = $t->inv_value;				
				     	      }		
		     	          }         	


         			return redirect('commercial/bank/bank_export_reibrusment_entry_preview')->with('exp_reimb_data','success','Enrtry Updated');

         		}

     }

     public function expReimbursementDelete($id){
     	#delete
     	BankExpReimbursement::where('id', $id )->delete();
          //delete from fund transfer table(cm_file_transfer) also..
          $ck_string = 'Export Payment Receive('.$id.')';
          BankFundTransfer::where('narration', $ck_string)->delete();
          
     	return back()->with('success', 'Entry Deleted');
     }

}

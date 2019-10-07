<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ForwardSalesChild1;
use App\Models\Commercial\Bank\ForwardSalesChild2;
use App\Models\Commercial\Bank\ForwardSalesMaster;



use Validator;
use DB;
use Response;
use DateTime;

class BankForwardSalesMasterController extends Controller
{
	public function bankForwardSalesMasterView(){
		    //File 
			$file_list = DB::table('cm_file as c')->select('c.id', 'c.file_no')->get();
			//Account Type	
			$acc_type = DB::table('cm_acc_type as a')->select('a.id', 'a.acc_type_name')->get();
			//Bank
			$bank = DB::table('cm_bank as b')->select('b.id', 'b.bank_name')->get();
 

		return view('commercial.bank.bank_forward_sales_master', compact('file_list', 'acc_type', 'bank') );
	}
	public function amountsReturn(Request $request){
		// dd($request->all());
		$f_id = $request->file_id;
		$act_id = $request->acc_type_id;
		$available_amount=0;
		$liability=0;
		$exp_receiv_amount=0;

		//Available Amount calculation..
		$q =  ['cm_file_id' => $f_id, 'cm_acc_type_id' => $act_id];
		$fund_trans_amount = DB::table('cm_file_transfer')->where($q)->sum('amount');

		//**need to update later...(17-04-2019)
		$reim_amount = DB::table('cm_exp_reimburse')->where('date','=', null)->sum('reimburse_amount');

		$bank_id_file_id = DB::table('cm_imp_data_entry as imp_d')->select( 'imp_d.id', 'imp_d.cm_file_id', 'imp_d.cm_bank_id')
																  ->distinct()
																  ->leftjoin('cm_imp_bill_settle as bill_s', 'imp_d.id', '=',
																  	                   'bill_s.cm_imp_data_entry_id')
															      ->where(['imp_d.cm_file_id' => $f_id ])
																  ->get();
		// dd($bank_id_file_id);
		$bank_id = $bank_id_file_id[0]->cm_bank_id;
		$bank = DB::table('cm_bank')->where('id', '=', $bank_id)->value('bank_name');

		$imp_bill_sattle_amount = DB::table('cm_imp_bill_settle')->where(['cm_acc_type_id' => $act_id, 
																	'cm_imp_data_entry_id' => $bank_id_file_id[0]->id ])
																  ->sum('amount');
																  //->get();
		
		// dd('cm_imp_data_entry_id bank_id file_id',$bank_id_file_id, 'imp_bill_settle_amount', $imp_bill_sattle_amount, 'Bank_name',$bank );
		
		$available_amount = ($fund_trans_amount+$reim_amount)-$imp_bill_sattle_amount;
		

		//Liability Calculation
		$q =  ['payment_date' => null, 'cm_acc_type_id' => $act_id, 'cm_imp_data_entry_id' => $bank_id_file_id[0]->id];
		$liability = DB::table('cm_imp_bill_settle')->where($q)->sum('amount');
		// dd('Laiabilty:', $liability);

		//**need to update later...(17-04-2019)
		$exp_receiv_amount = $reim_amount;

		// dd($fund_trans_amount,'+', $reim_amount,'-', $imp_bill_sattle_amount,  'Available Amount: ', $available_amount, "Liability", $liability, 'Export Recieved:', $exp_receiv_amount);

		$data['available_amount']	=	$available_amount;
		$data['liability']			=	$liability;
		$data['export_recieved']	=	$exp_receiv_amount;
		$data['bank']				=	$bank;

		return Response::json($data);

	}

	public function all_entry_save(Request $request){
		// dd($request->all());

		$validation = Validator::make($request->all(), [
					'acc_type'			=> 'required',
					'widthdraw_amount' 	=> 'required',
					'booking_date' 		=> 'required',
					'buying_bank' 		=> 'required',
					'forward_amt' 		=> 'required',
					'sales_done' 		=> 'required',
					'remarks' 			=> 'required|max:255',
					'exchange_rate' 	=> 'required',
					'm_start_date' 		=> 'required',
					'm_end_date' 		=> 'required',
					'encashment_date' 	=> 'required',
					'amount_child' 		=> 'required'

		     ]);

		if($validation->fails()){
			return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
		}
		else{
			// $acc_type = DB::table('cm_acc_type as a')->where('id', $request->acc_type[1])->value('acc_type_name');

			// dd($request->all(), 'Rows on child 1',  sizeof($request->fno), 'Rows on child 2',  sizeof($request->amount_child) );

			$master_data = new ForwardSalesMaster();
			
			

			$master_data->booking_date 			= $request->booking_date;
			$master_data->cm_bank_id 			= $request->buying_bank;
			$master_data->forward_amnt 			= $request->forward_amt;
			$master_data->sales_done 			= $request->sales_done;
			$master_data->remarks 				= $request->remarks;
			$master_data->exchange_rate 		= $request->exchange_rate;
			$master_data->maturity_window_start = $request->m_start_date;
			$master_data->maturity_window_end 	= $request->m_end_date;

			$master_data->save();

			$last_id = $master_data->id;
			//for child1 entry
			for ($i=0; $i < sizeof($request->fno); $i++) { 
					$child1_data = new ForwardSalesChild1();
					$child1_data->cm_forward_sales_id	= $last_id;
					$child1_data->cm_file_id 			= $request->fno[$i];
					$acc_type = DB::table('cm_acc_type as a')->where('id', $request->acc_type[$i])->value('acc_type_name');
					$child1_data->account_type 			= $acc_type;
					$child1_data->withdrawal_amnt 		= $request->widthdraw_amount[$i];

					$child1_data->save();
			}
			//for child2 entry
			for ($i=0; $i < sizeof($request->amount_child); $i++) { 
					$child2_data = new ForwardSalesChild2();
					$child2_data->cm_forward_sales_id	= $last_id;
					$child2_data->encashment_date 		= $request->encashment_date[$i];
					$child2_data->amount 				= $request->amount_child[$i];
					$child2_data->balance 				= $request->balance[$i];

					$child2_data->save();
			}
			

			return back()->with('success', "Entry Done");

			
		}


	}
#----entry end

	public function all_entry_view(){

		$forward_sales_master = ForwardSalesMaster::get();
		foreach ($forward_sales_master as $f_s_master) {
			$bank = DB::table('cm_bank')->where('id', '=', $f_s_master->cm_bank_id)->value('bank_name');
			$f_s_master->bank = $bank;

			$get_val = ForwardSalesChild1::where('cm_forward_sales_id', $f_s_master->id )->get();
			$f_s_master->child1 = $get_val;
			
			$get_val = ForwardSalesChild2::where('cm_forward_sales_id', $f_s_master->id )->get();
			$f_s_master->child2 = $get_val;
		}

		foreach ($forward_sales_master as $fs) {
			foreach ($fs->child1 as $child1) {
					$file_name = DB::table('cm_file')->where('id', '=', $child1->cm_file_id)->value('file_no');
					$child1->file = $file_name;
			}
		}

		// dd($forward_sales_master);
		
		return view('commercial.bank.bank_forward_sales_entry_view', compact('forward_sales_master'));
	}

	public function entry_edit($id){
			//File 
			$file_list = DB::table('cm_file as c')->select('c.id', 'c.file_no')->get();
			//Account Type	
			$acc_type = DB::table('cm_acc_type as a')->select('a.id', 'a.acc_type_name')->get();
			//Bank
			$bank = DB::table('cm_bank as b')->select('b.id', 'b.bank_name')->get();

			$forward_sales_master = ForwardSalesMaster::where('id','=', $id)->get();
			// dd($forward_sales_master);
			foreach ($forward_sales_master as $f_s_master) {
				$bk = DB::table('cm_bank')->where('id', '=', $f_s_master->cm_bank_id)->value('bank_name');
				$f_s_master->bank = $bk;

				$get_val = ForwardSalesChild1::where('cm_forward_sales_id', $f_s_master->id )->get();
				$f_s_master->child1 = $get_val;
				
				$get_val = ForwardSalesChild2::where('cm_forward_sales_id', $f_s_master->id )->get();
				$f_s_master->child2 = $get_val;
			}

			foreach ($forward_sales_master as $fs) {

				foreach ($fs->child1 as $child1) {
						$file_name = DB::table('cm_file')->where('id', '=', $child1->cm_file_id)->value('file_no');
						$child1->file = $file_name;
						$acc_typ_id = DB::table('cm_acc_type')->where('acc_type_name', '=', $child1->account_type)->value('id');
						$child1->acc_typ_id = $acc_typ_id;

						//the amounts calculation..
							$act_id = $child1->acc_typ_id;
							$f_id = $child1->cm_file_id;

							$available_amount=0;
							$liability=0;
							$exp_receiv_amount=0;

							//Available Amount calculation..
							$q =  ['cm_file_id' => $f_id, 'cm_acc_type_id' => $act_id];
							$fund_trans_amount = DB::table('cm_file_transfer')->where($q)->sum('amount');

							//**need to update later...(17-04-2019)
							$reim_amount = DB::table('cm_exp_reimburse')->where('date','=', null)->sum('reimburse_amount');

							$bank_id_file_id = DB::table('cm_imp_data_entry as imp_d')
													->select( 'imp_d.id', 'imp_d.cm_file_id', 'imp_d.cm_bank_id')
													->distinct()
													->leftjoin('cm_imp_bill_settle as bill_s', 'imp_d.id', '=',
																			'bill_s.cm_imp_data_entry_id')
													->where(['imp_d.cm_file_id' => $f_id ])
													->get();
							// dd($bank_id_file_id);
							$bank_id = $bank_id_file_id[0]->cm_bank_id;
							$bank__ = DB::table('cm_bank')->where('id', '=', $bank_id)->value('bank_name');

							$imp_bill_sattle_amount = DB::table('cm_imp_bill_settle')
																	->where(['cm_acc_type_id' => $act_id, 
																			 'cm_imp_data_entry_id' => $bank_id_file_id[0]->id ])
																	->sum('amount');
																	//->get();
							
							// dd('cm_imp_data_entry_id bank_id file_id',$bank_id_file_id, 'imp_bill_settle_amount', $imp_bill_sattle_amount, 'Bank_name',$bank__ );
							
							$available_amount = ($fund_trans_amount+$reim_amount)-$imp_bill_sattle_amount;
							

							//Liability Calculation
							$q =  ['payment_date' => null, 'cm_acc_type_id' => $act_id, 'cm_imp_data_entry_id' => $bank_id_file_id[0]->id];
							$liability = DB::table('cm_imp_bill_settle')->where($q)->sum('amount');
							// dd('Laiabilty:', $liability);

							//**need to update later...(17-04-2019)
							$exp_receiv_amount = $reim_amount;

							$child1->available_amount  = $available_amount;
							$child1->liability_amount  = $liability;
							$child1->exp_recv_amount   = $exp_receiv_amount;
							$child1->bank_nm  		   = $bank__;

						//the amounts calculation end..

				}
			}
			// $widthdraw_total = DB::table('cm_forward_sales_child2')->where('cm_forward_sales_id','=', $id)
			// 													   ->sum('');			
			// dd($forward_sales_master);  
			

		return view('commercial.bank.bank_forward_sales_entry_edit',compact('file_list','acc_type','bank', 'forward_sales_master'));
	}

	public function entry_update(Request $request){
		// dd($request->all());
		$validation = Validator::make($request->all(), [
					'acc_type'			=> 'required',
					'widthdraw_amount' 	=> 'required',
					'booking_date' 		=> 'required',
					'buying_bank' 		=> 'required',
					'forward_amt' 		=> 'required',
					'sales_done' 		=> 'required',
					'remarks' 			=> 'required|max:255',
					'exchange_rate' 	=> 'required',
					'm_start_date' 		=> 'required',
					'm_end_date' 		=> 'required',
					'encashment_date' 	=> 'required',
					'amount_child' 		=> 'required'

		     ]);

		if($validation->fails()){
			return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
		}

		else{
			 $update = ForwardSalesMaster::where('id',$request->forward_sales_id)->update([
			 			'booking_date'			=>	$request->booking_date,
			 			'cm_bank_id'			=>	$request->buying_bank,
			 			'forward_amnt'			=>	$request->forward_amt,
			 			'sales_done'			=>	$request->sales_done,
			 			'remarks'				=>	$request->remarks,
			 			'exchange_rate'			=>	$request->exchange_rate,
			 			'maturity_window_start'	=>	$request->m_start_date,
			 			'maturity_window_end'	=>	$request->m_end_date
			 ]);

			 ForwardSalesChild1::where('cm_forward_sales_id', $request->forward_sales_id )->delete();
			 ForwardSalesChild2::where('cm_forward_sales_id', $request->forward_sales_id )->delete();

			 //for child1 entry
			for ($i=0; $i < sizeof($request->fno); $i++) { 
					$child1_data = new ForwardSalesChild1();
					$child1_data->cm_forward_sales_id	= $request->forward_sales_id;
					$child1_data->cm_file_id 			= $request->fno[$i];
					$acc_type = DB::table('cm_acc_type as a')->where('id', $request->acc_type[$i])->value('acc_type_name');
					$child1_data->account_type 			= $acc_type;
					$child1_data->withdrawal_amnt 		= $request->widthdraw_amount[$i];

					$child1_data->save();
			}
			//for child2 entry
			for ($i=0; $i < sizeof($request->amount_child); $i++) { 
					$child2_data = new ForwardSalesChild2();
					$child2_data->cm_forward_sales_id	= $request->forward_sales_id;
					$child2_data->encashment_date 		= $request->encashment_date[$i];
					$child2_data->amount 				= $request->amount_child[$i];
					$child2_data->balance 				= $request->balance[$i];

					$child2_data->save();
			}


			$forward_sales_master = ForwardSalesMaster::get();
			foreach ($forward_sales_master as $f_s_master) {
				$bank = DB::table('cm_bank')->where('id', '=', $f_s_master->cm_bank_id)->value('bank_name');
				$f_s_master->bank = $bank;

				$get_val = ForwardSalesChild1::where('cm_forward_sales_id', $f_s_master->id )->get();
				$f_s_master->child1 = $get_val;
				
				$get_val = ForwardSalesChild2::where('cm_forward_sales_id', $f_s_master->id )->get();
				$f_s_master->child2 = $get_val;
			}

			foreach ($forward_sales_master as $fs) {
				foreach ($fs->child1 as $child1) {
						$file_name = DB::table('cm_file')->where('id', '=', $child1->cm_file_id)->value('file_no');
						$child1->file = $file_name;
				}
			}

			// dd('View' ,$forward_sales_master);
		

			return redirect('commercial/bank/bank_forward_sales_entry_view')->with('success', 'Entry Updated', $forward_sales_master);


		}


	}

	public function entry_delete($id){

			ForwardSalesMaster::where('id', $id)->delete();
			ForwardSalesChild1::where('cm_forward_sales_id', $id )->delete();
			ForwardSalesChild2::where('cm_forward_sales_id', $id )->delete();

			return back()->with('success','Entry Deleted');
	}

}


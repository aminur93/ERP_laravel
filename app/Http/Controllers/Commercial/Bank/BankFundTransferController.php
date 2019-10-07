<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\BankFundTransfer;
use Validator;
use DB;
use Response;

class BankFundTransferController extends Controller{
		public function bankFundTransferEntryView(){
			//File 
			$file_list = DB::table('cm_file as c')->select('c.id', 'c.file_no')->get();
			//Account Type	
			$acc_type = Db::table('cm_acc_type as a')->select('a.id', 'a.acc_type_name')->get();
			//Agent
			$agent_list = Db::table('cm_agent as a')->select('a.id', 'a.agent_name')->get();

				return view('commercial.bank.bank_fund_transfer_entry', compact('file_list', 'acc_type', 'agent_list') );
			}

		public function returnBuyerAndBank(Request $request){
			// dd($request->all());
			// $ok="Working";
			// return Response::json($ok);
			$sales_cont_id = DB::table('cm_exp_lc_entry as lc')
							->select('lc.cm_sales_contract_id')
							->where('lc.cm_file_id', '=', $request->file_id)
							->first();
		     //dd($sales_cont_id);
			$buyer_and_bank_id = DB::table('cm_sales_contract as slc')
							->select('slc.mr_buyer_b_id', 'slc.btb_bank_id')
							->where('slc.id','=', $sales_cont_id->cm_sales_contract_id)
							->first();
			//dd($buyer_and_bank_id);
			$buyer_name = DB::table('mr_buyer as byr')->where('byr.b_id','=',$buyer_and_bank_id->mr_buyer_b_id)->value('byr.b_name');	
			$bank_name = DB::table('cm_bank as bk')->where('bk.id', '=', $buyer_and_bank_id->btb_bank_id)->value('bk.bank_name');
			//dd($buyer_name, $bank_name);
			
			

			
			$data["buyer"] = $buyer_name;
			$data["bank"] = $bank_name;
			$data["buyer_id"] = $buyer_and_bank_id->mr_buyer_b_id;
			$data["bank_id"] = $buyer_and_bank_id->btb_bank_id;

			
			return Response::json($data);			

		}

		public function returnPreAmount(Request $request){

				$pre_amount = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->file_id)
															 ->where('ft.cm_acc_type_id', '=', $request->acc_type_id)
															 ->sum('ft.amount');
									//dd($pre_amount);
			$data["pre_amount"] = $pre_amount;
			return Response::json($data);						 	
		}

		//for from edit only.............................................
		public function returnPreAmountFrom(Request $request){


			$pre_amount = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->file_id)
															 ->where('ft.cm_acc_type_id', '=', $request->acc_type_id)
															 ->where('ft.id', '!=', $request->id )
															 ->sum('ft.amount');
									//dd($pre_amount);
			$data["pre_amount"] = $pre_amount;
			return Response::json($data);						 	
		}
		//....................................................................


		public function setAmount(Request $request){
			 // dd($request->all());
			$pre_amount = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->file_id)
															 ->where('ft.cm_acc_type_id','=', $request->acc_type_id)
															 ->sum('ft.amount');
			$fr_balance = $request->amount + $pre_amount;

			$from_balance["from_balance"] = $fr_balance;

			return Response::json($from_balance);
		}

		//for from edit only............................................	
		public function setAmountInFromEdit(Request $request){
			 // dd($request->all());
			$pre_amount = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->file_id)
															 ->where('ft.cm_acc_type_id','=', $request->acc_type_id)
															 ->where('ft.id', '!=', $request->id )
															 ->sum('ft.amount');
			$fr_balance = $request->amount + $pre_amount;

			$from_balance["from_balance"] = $fr_balance;

			return Response::json($from_balance);
		}
		//.................................................................


		public function getBuyerBalance(Request $request){
			// dd($request->all());
			$sales_cont_id_cpy = DB::table('cm_exp_lc_entry as lc')
							->select('lc.cm_sales_contract_id')
							->where('lc.cm_file_id', '=', $request->to_file_id)
							->first();
		     //dd($sales_cont_id);
			$buyer_cpy = DB::table('cm_sales_contract as slc')
							->select('slc.mr_buyer_b_id')
							->where('slc.id','=', $sales_cont_id_cpy->cm_sales_contract_id)
							->first();
			//dd($buyer);
			$buyer_name_to = DB::table('mr_buyer as byr')->where('byr.b_id','=',$buyer_cpy->mr_buyer_b_id)->value('byr.b_name');
			$to_balance = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->to_file_id)
															 ->where('ft.cm_acc_type_id', '=', $request->to_acc_type_id)
															 ->sum('ft.amount');

			$to_data["buyer"] = $buyer_name_to;
			$to_data["to_balance"] = $to_balance;

			return Response::json($to_data);

		}

		public function setAmount2(Request $request){

			$pre_amount = DB::table('cm_file_transfer as ft')->where('ft.cm_file_id','=', $request->to_file_id)
															 ->where('ft.cm_acc_type_id','=', $request->to_acc_type_id)
															 ->sum('ft.amount');
			$to_balance = $request->amount + $pre_amount;
			$fr_balance = $request->amount;

			$balance["balance_minus"] = $fr_balance;
			$balance["balance_plus"] = $to_balance;

			return Response::json($balance);


		}

		public function saveEntry(Request $request){

				 // dd($request->all());
			$data_validation = Validator::make($request->all(), [
						// 'from_file_no_id' => 'required',
						// 'from_account_type' => 'required',
						'date_entry' => 'required',
						'naration' => 'required|max:45',
						'amount' => 'required',
						'currency' => 'required|max:45',
						'agent' => 'required',
						'exchange_rate' => 'required|max:45'
						// 'to_file_no_id' => 'required',
						// 'to_account_type' => 'required'
			]);
			if($data_validation->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         	}
         		
         	else{
         		
         		
         		if($request->to_file_no_id == -1 && $request->to_account_type == -1){
         			// dd('IF',$request->all());
         			$data = new BankFundTransfer();
         			$data->cm_file_id   	=  $request->from_file_no_id;
         			$data->cm_acc_type_id 	=  $request->from_account_type;
         			$data->date 			=  $request->date_entry;
         			$data->narration 		=  $request->naration;
         			$data->amount 			=  $request->amount;
         			$data->currency 		=  $request->currency;
         			$data->cm_agent_id 		=  $request->agent;
         			$data->exchange_rate	=  $request->exchange_rate;

         			$data->save();
         			return back()->with('success', 'Entry Saved');
         		}
         		else{
         			// dd('ELSE',$request->all());

         		$from_amount =  DB::table('cm_file_transfer as ft')
         									->where('ft.cm_file_id','=', $request->from_file_no_id)
											->where('ft.cm_acc_type_id','=', $request->from_account_type)
											->sum('ft.amount');
				if($from_amount < $request->amount){
					return back()->with('error', 'Account Balance is less then Amount');
				}

         			$data1 = new BankFundTransfer();

         			$data1->cm_file_id   	=  $request->from_file_no_id;
         			$data1->cm_acc_type_id 	=  $request->from_account_type;
         			$data1->date 			=  $request->date_entry;
         			$data1->narration 		=  $request->naration;
         			$data1->amount 			=  (-1.0) * $request->amount;
         			$data1->currency 		=  $request->currency;
         			$data1->cm_agent_id 	=  $request->agent;
         			$data1->exchange_rate	=  $request->exchange_rate;

         			$data1->save();

         			$data2 = new BankFundTransfer();
         			$data2->date 					=  $request->date_entry;
         			$data2->narration 				=  $request->naration;
         			$data2->amount 					=  $request->amount;
         			$data2->currency 				=  $request->currency;
         			$data2->cm_agent_id 			=  $request->agent;
         			$data2->exchange_rate			=  $request->exchange_rate;
         			$data2->cm_file_id   			=  $request->to_file_no_id;
         			$data2->cm_acc_type_id 			=  $request->to_account_type;
         			$data2->transfer_ref_file_no	=  $request->from_file_no_id;

         			$data2->save();

         			return back()->with('success', 'Entry Saved');
         		}
         		

         	}
		}

		public function viewFundTransferEntry(){

			$fund_trans_data = BankFundTransfer::get();

		    foreach ($fund_trans_data as $ftd) {
    				      	$tmp = DB::table('cm_file')->where('id', $ftd->cm_file_id)->select('file_no')->get();
    	      				$ftd->file = $tmp;
    	       			}

    	    foreach ($fund_trans_data as $ftd) {
    				     $tmp = DB::table('cm_acc_type')->where('id', $ftd->cm_acc_type_id)->select('acc_type_name')->get();
    	      			 $ftd->acc = $tmp;
    	       			}

    	    foreach ($fund_trans_data as $ftd) {
    				     $tmp = DB::table('cm_agent')->where('id', $ftd->cm_agent_id)->select('agent_name')->get();
    	      		     $ftd->agent = $tmp;
    	       			}

    	    foreach ($fund_trans_data as $ftd) {
    				     $tmp = DB::table('cm_file')->where('id', $ftd->transfer_ref_file_no)->select('file_no')->get();
    	      		     $ftd->ref_file = $tmp;
    	       			}

		 	 // dd($fund_trans_data);

			return view('commercial.bank.bank_fund_transfer_view', compact('fund_trans_data') );
		}

		public function edtiEntry($id){
			$data_to_edit = BankFundTransfer::where('id', $id)->first();
				//Getting values for dropdowns
					//File 
					$file_list = DB::table('cm_file as c')->select('c.id', 'c.file_no')->get();
					//Account Type	
					$acc_type = Db::table('cm_acc_type as a')->select('a.id', 'a.acc_type_name')->get();
					//Agent
					$agent_list = Db::table('cm_agent as a')->select('a.id', 'a.agent_name')->get();

			if(!empty($data_to_edit->transfer_ref_file_no)){
				$from = BankFundTransfer::where('id', $id-1 )->first();	
				$to	= BankFundTransfer::where('id', $id )->select('cm_file_id','cm_acc_type_id')->first();

				// dd('From',$from,'To' ,$to);

				//getting from file no
				$from_file_no = DB::table('cm_file')->where('id', $from->cm_file_id)->select('id','file_no')->first();
				// dd($from_file_no->id);
				$from->from_file = $from_file_no;
				//getting to file no
				$to_file_no = DB::table('cm_file')->where('id', $to->cm_file_id)->select('id','file_no')->first();
				$to->to_file = $to_file_no;
				//getting from acc
				$from_acc_no = DB::table('cm_acc_type')->where('id', $from->cm_acc_type_id)->select('id','acc_type_name')
													   ->first();
				$from->from_acc = $from_acc_no;									   
				//getting to acc
				$to_acc_no = DB::table('cm_acc_type')->where('id', $to->cm_acc_type_id)->select('id','acc_type_name')
													 ->first();
				$to->to_acc = $to_acc_no;

				// dd('From',$from,'To' ,$to);
				
				//getting currency
				if($from->currency == 'USD')	{ $from->curr = 'USD $'; }
				elseif($from->currency == 'EUR'){ $from->curr = 'EUR €'; }
				elseif($from->currency == 'GBP'){ $from->curr = 'GBP £'; }
				else 							{ $from->curr = 'TK ৳' ; }
				//getting agent
				$from_agnt = DB::table('cm_agent')->where('id', $from->cm_agent_id)->select('id','agent_name')
													 ->first();
				$from->agent = $from_agnt;

				// dd('From',$from,'To' ,$to);
				// dd($from->from_file->id);
				
				
				

				return view('commercial.bank.bank_fund_transfer_from_to_edit', compact('from','to','file_list','acc_type', 
					'agent_list') );	
			}

			else{

				$from = BankFundTransfer::where('id', $id )->first();
				$from_file_no = DB::table('cm_file')->where('id', $from->cm_file_id)->select('id','file_no')->first();
				// dd($from_file_no->id);
				$from->from_file = $from_file_no;
				$from_acc_no = DB::table('cm_acc_type')->where('id', $from->cm_acc_type_id)->select('id','acc_type_name')
													   ->first();
				$from->from_acc = $from_acc_no;	
				//getting currency
				if($from->currency == 'USD')	{ $from->curr = 'USD $'; }
				elseif($from->currency == 'EUR'){ $from->curr = 'EUR €'; }
				elseif($from->currency == 'GBP'){ $from->curr = 'GBP £'; }
				else 							{ $from->curr = 'TK ৳' ; }
				//getting agent
				$from_agnt = DB::table('cm_agent')->where('id', $from->cm_agent_id)->select('id','agent_name')
													 ->first();
				$from->agent = $from_agnt;

				// dd($from);

				return view('commercial.bank.bank_fund_transfer_from_edit', compact('from','file_list','acc_type', 
					'agent_list') );

			}
		}

		public function updateFromToEntry(Request $request){
			// dd($request->all());
			$data_validation = Validator::make($request->all(), [
						// 'from_file_no_id' => 'required',
						// 'from_account_type' => 'required',
						'date_entry' => 'required',
						'naration' => 'required|max:45',
						'amount' => 'required',
						'currency' => 'required|max:45',
						'agent' => 'required',
						'exchange_rate' => 'required|max:45'
						// 'to_file_no_id' => 'required',
						// 'to_account_type' => 'required'
			]);
			if($data_validation->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         	}
         		
         	else{
         		BankFundTransfer::where('id', $request->from_id)->update([
         				 	'cm_file_id'		=>	$request->from_file_no_id,
							'cm_acc_type_id'	=>	$request->from_account_type,
							'date'				=>	$request->date_entry,
							'narration'			=>	$request->naration,
							'amount'			=>	$request->amount * (-1.0),
							'currency'			=>	$request->currency,
							'cm_agent_id'		=>	$request->agent,
							'exchange_rate'		=>	$request->exchange_rate
         		]);

         		BankFundTransfer::where('id', $request->to_id)->update([
							'date'				=>	$request->date_entry,
							'narration'			=>	$request->naration,
							'amount'			=>	$request->amount,
							'currency'			=>	$request->currency,
							'cm_agent_id'		=>	$request->agent,
							'exchange_rate'		=>	$request->exchange_rate,
							'cm_file_id'		=>	$request->to_file_no_id,
							'cm_acc_type_id'	=>	$request->to_account_type,
							'transfer_ref_file_no'=> $request->from_file_no_id
         		]);

	            $fund_trans_data = BankFundTransfer::get();
			    foreach ($fund_trans_data as $ftd) {
	    				      	$tmp = DB::table('cm_file')->where('id', $ftd->cm_file_id)->select('file_no')->get();
	    	      				$ftd->file = $tmp;
	    	      			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_acc_type')->where('id', $ftd->cm_acc_type_id)->select('acc_type_name')->get();
	    	      			 $ftd->acc = $tmp;
	    	       			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_agent')->where('id', $ftd->cm_agent_id)->select('agent_name')->get();
	    	      		     $ftd->agent = $tmp;
	    	       			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_file')->where('id', $ftd->transfer_ref_file_no)->select('file_no')->get();
	    	      		     $ftd->ref_file = $tmp;
	    	       			}

         		return redirect('commercial/bank/fund_transfer_entry_preview')->with('fund_trans_data','success','Entry Updated');

         	}

		}

		public function updateFromEntry(Request $request){
			$data_validation = Validator::make($request->all(), [
						// 'from_file_no_id' => 'required',
						// 'from_account_type' => 'required',
						'date_entry' => 'required',
						'naration' => 'required|max:45',
						'amount' => 'required',
						'currency' => 'required|max:45',
						'agent' => 'required',
						'exchange_rate' => 'required|max:45'
						// 'to_file_no_id' => 'required',
						// 'to_account_type' => 'required'
			]);
			if($data_validation->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         	}
         		
         	else{

         		BankFundTransfer::where('id', $request->from_id)->update([
         				 	'cm_file_id'		=>	$request->from_file_no_id,
							'cm_acc_type_id'	=>	$request->from_account_type,
							'date'				=>	$request->date_entry,
							'narration'			=>	$request->naration,
							'amount'			=>	$request->amount,
							'currency'			=>	$request->currency,
							'cm_agent_id'		=>	$request->agent,
							'exchange_rate'		=>	$request->exchange_rate
         		]);
         		 $fund_trans_data = BankFundTransfer::get();
			    foreach ($fund_trans_data as $ftd) {
	    				      	$tmp = DB::table('cm_file')->where('id', $ftd->cm_file_id)->select('file_no')->get();
	    	      				$ftd->file = $tmp;
	    	      			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_acc_type')->where('id', $ftd->cm_acc_type_id)->select('acc_type_name')->get();
	    	      			 $ftd->acc = $tmp;
	    	       			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_agent')->where('id', $ftd->cm_agent_id)->select('agent_name')->get();
	    	      		     $ftd->agent = $tmp;
	    	       			}
	    	    foreach ($fund_trans_data as $ftd) {
	    				     $tmp = DB::table('cm_file')->where('id', $ftd->transfer_ref_file_no)->select('file_no')->get();
	    	      		     $ftd->ref_file = $tmp;
	    	       			}

         		return redirect('commercial/bank/fund_transfer_entry_preview')->with('fund_trans_data','success','Entry Updated');
         	}
		}

		public function deleteEntry($id){
			$data_to_delete = BankFundTransfer::where('id', $id)->first();
			if(!empty($data_to_delete->transfer_ref_file_no)){
				// dd('If',$data_to_delete);
				BankFundTransfer::where('id', $id)->delete();
				BankFundTransfer::where('id', $id-1 )->delete();
			}
			else{
				// dd('Else',$data_to_delete);
				BankFundTransfer::where('id', $id)->delete();
			}
			return back()->with('success','Entry Deleted');	
		}


}
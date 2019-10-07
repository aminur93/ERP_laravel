<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\Bank\BankAcceptanceImport;
use App\Models\Commercial\Bank\BankAcceptanceImpDuedates;
use DB;
use Response;
use Validator;

class BankController extends Controller
{
    public function bankAcceptanceEntryView(){
    	$import_data_entry = ImportDataEntry::get();
    	//dd($import_data_entry);
        $file = DB::table('cm_imp_data_entry as d_e')->select('f.id', 'f.file_no')->distinct()
                                                     ->join('cm_file as f','f.id','=', 'd_e.cm_file_id')
                                                     ->get();   
        // dd('file', $file);
        $ilc_list = DB::table('cm_imp_data_entry as d_e')->select('btb.lc_no')->distinct()
                                                    ->join('cm_btb as btb', 'btb.id', '=', 'd_e.cm_btb_id')
                                                    ->get();
        // dd('ilc_list no', $ilc_list);
        $bank = DB::table('cm_imp_data_entry as d_e')->select('b.id', 'b.bank_name')->distinct()
                                                     ->join('cm_bank as b','b.id','=', 'd_e.cm_bank_id')
                                                     ->get();   
        // dd('bank', $bank);

        $supplier = DB::table('cm_imp_data_entry as d_e')->select('b.sup_id', 'b.sup_name')->distinct()
                                                     ->join('mr_supplier as b','b.sup_id','=', 'd_e.mr_supplier_sup_id')
                                                     ->get();
        // dd('supplier', $supplier);
        
    	return view('commercial.bank.bank_acceptance_entry', compact('import_data_entry','file', 'ilc_list', 'bank', 'supplier') );
    }

//ajax return
    public function searchResultReturn(Request $request){
        // dd($request->all());
        $bank_id = $request->bank_id;
        $ilc_number = $request->ilc_number;
        $file_no_id = $request->file_no_id;
        $supplier_id = $request->supplier_id;

        $ilc_number_to_btb = DB::table('cm_btb')->where('lc_no','=',$ilc_number)->value('id');
        // dd($ilc_number_to_btb);

        //only one selected
        if(isset($bank_id) && !isset($ilc_number) && !isset($file_no_id) && !isset($supplier_id)  ){
            $query = ['cm_bank_id'=> $bank_id];
        }
        else if(!isset($bank_id) && isset($ilc_number) && !isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_btb_id'=> $ilc_number_to_btb];
        }
        else if(!isset($bank_id) && !isset($ilc_number) && isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_file_id'=> $file_no_id];   
        }
        else if(!isset($bank_id) && !isset($ilc_number) && !isset($file_no_id) && isset($supplier_id)){
            $query = ['mr_supplier_sup_id'=> $supplier_id];
        }
        //two selection
        else if(isset($bank_id) && isset($ilc_number) && !isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_bank_id'=> $bank_id , 'cm_btb_id'=> $ilc_number_to_btb ];
        }
        else if(isset($bank_id) && !isset($ilc_number) && isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_bank_id'=> $bank_id , 'cm_file_id'=> $file_no_id ];
        }
        else if(isset($bank_id) && !isset($ilc_number) && !isset($file_no_id) && isset($supplier_id)){
            $query = ['cm_bank_id'=> $bank_id , 'mr_supplier_sup_id'=> $supplier_id ];
        }
        else if(!isset($bank_id) && isset($ilc_number) && isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_btb_id'=> $ilc_number_to_btb , 'cm_file_id'=> $file_no_id ];
        }
        else if(!isset($bank_id) && isset($ilc_number) && !isset($file_no_id) && isset($supplier_id)){
            $query = ['cm_btb_id'=> $ilc_number_to_btb , 'mr_supplier_sup_id'=> $supplier_id ];
        }
        else if(!isset($bank_id) && !isset($ilc_number) && isset($file_no_id) && isset($supplier_id)){
            $query = ['cm_file_id'=> $file_no_id , 'mr_supplier_sup_id'=> $supplier_id ];
        }
        //three selection
        else if(isset($bank_id) && isset($ilc_number) && isset($file_no_id) && !isset($supplier_id)){
            $query = ['cm_bank_id'=> $bank_id , 'cm_btb_id'=> $ilc_number_to_btb , 'cm_file_id'=> $file_no_id ];
        }
        else if(isset($bank_id) && isset($ilc_number) && !isset($file_no_id) && isset($supplier_id)){
            $query = ['cm_bank_id'=> $bank_id , 'cm_btb_id'=> $ilc_number_to_btb , 'mr_supplier_sup_id'=> $supplier_id ];   
        }
        else if(!isset($bank_id) && isset($ilc_number) && isset($file_no_id) && isset($supplier_id)){
            $query = ['cm_btb_id'=> $ilc_number_to_btb , 'cm_file_id'=> $file_no_id , 'mr_supplier_sup_id'=> $supplier_id ];
        }
        //all four selected
        else{
            $query = ['cm_bank_id'=> $bank_id , 'cm_btb_id'=> $ilc_number_to_btb , 'cm_file_id'=> $file_no_id , 'mr_supplier_sup_id'=> $supplier_id ];
        }

        $search_result = DB::table('cm_imp_data_entry as imp')
                                    ->select('imp.id', 'imp.transp_doc_no1', 'imp.transp_doc_date', 'imp.value','imp.cm_btb_id')
                                    ->where($query)
                                    ->get();
        // dd('Search Result:',$search_result);
        

        $data = "";
        foreach ($search_result as $s_r) {
            $ilc_no = DB::table('cm_btb')->where('id', '=', $s_r->cm_btb_id)->value('lc_no');
            $data .= '<tr>
                            <td>'.$s_r->transp_doc_no1.'</td>
                            <td>'.$s_r->transp_doc_date.'</td>
                            <td>'.$s_r->value.'</td>
                            <td> 
                                <input type="radio" id="check"  name="check" class="ck" value="'.$s_r->id.'"/>
                                <input type="hidden" name="imp_data_entry_id" id="imp_data_entry_id" value="'.$s_r->id.'" />
                                <input type="hidden" name="ilc_no" id="ilc_no" class="ilc_no" value="'.$ilc_no.'" /> 
                            </td>
                     </tr>';
        }
        // dd($data);
        return Response::json($data);
    }


//insert....
    public function entrySave(Request $request){
            // dd($request->all());

            $validator = Validator::make($request->all(),[
                        'bill_ex_rec_date'   => 'required',
                        //'libor_rate'       => 'required',
                        'acceptance_date'    => 'required',
                        'negotiation_date'   => 'required',
                        'bank_bill_no'       => 'required|max:45',
                        'discre_date'        => 'required',
                        'discre_acp_date'    => 'required',
                        'days'               => 'required',
                        'exchange_rate'      => 'required',
                        'acceptance_comm'    => 'required'
                ]);
            
                 if($validator->fails()){
                    return back()
                        ->withInput()
                        ->with('error', "Incorrect Input!!");
                }
                else{
                    $data = new BankAcceptanceImport();
                                    $data->cm_imp_data_entry_id  =  $request->import_id;
                                    $data->bill_ex_rec_date      =  $request->bill_ex_rec_date;
                                    $data->acceptance_date       =  $request->acceptance_date;
                                    $data->negotiation_date      =  $request->negotiation_date;
                                    $data->bank_bill_no          =  $request->bank_bill_no;
                                    $data->discre_date           =  $request->discre_date;
                                    $data->discre_acp_date       =  $request->discre_acp_date;
                                    $data->days                  =  $request->days;
                                    $data->exchange_rate         =  $request->exchange_rate;
                                    $data->acceptance_comm       =  $request->acceptance_comm;
                                    $data->due_provided_by       =  $request->due_date_provide;

                    }
                    if($request->libor == 'lib_yes'){
                                    $data->libor_rate            =  $request->libor_rate; 
                                    }
                    $data->save();

                    $last_id = $data->id;

                    //again entry the due dates
                        if(!empty($request->due_dates_cal)){
                            //dd($request->due_dates_cal);
                            BankAcceptanceImpDuedates::insert([
                                    'cm_bank_acceptance_imp_id'   => $last_id,
                                    'due_date'    => $request->due_dates_cal
                            ]);
                        }   
                        else{
                            for($i=0; $i<sizeof($request->due_dates); $i++){ 
                                    BankAcceptanceImpDuedates::insert([
                                        'cm_bank_acceptance_imp_id'   => $last_id,
                                        'due_date'    => $request->due_dates[$i]
                                        ]);
                            }   
                        }

            return back()->with('success','Entry Saved');
    }

//view...
    public function entryPreview(){
        $bank_acceptance_imp_data = BankAcceptanceImport::get();

        foreach ($bank_acceptance_imp_data as $imp_accep) {
                $tmp_imp_data_entry = ImportDataEntry::where('id', $imp_accep->cm_imp_data_entry_id)
                                                        ->select('transp_doc_no1','transp_doc_date', 'value')
                                                        ->get();
                $imp_accep->bnk_acc_entry = $tmp_imp_data_entry;

                $tmp_due_dates =  BankAcceptanceImpDuedates::where('cm_bank_acceptance_imp_id',  $imp_accep->id )
                                                            ->select('due_date')
                                                            ->get();
                $imp_accep->due_dates_all = $tmp_due_dates;
        }

        // dd($bank_acceptance_imp_data);
        return view('commercial.bank.bank_acceptance_entry_view', compact('bank_acceptance_imp_data') );
    }

//edit....
    public function viewBankAccepEntryEdit($id){
    	$bank_acceptance_imp_data = BankAcceptanceImport::where('id',$id)->first();
    	$tmp = ImportDataEntry::where('id', $bank_acceptance_imp_data->cm_imp_data_entry_id)->select('transp_doc_no1',
    	      	          'transp_doc_date' ,'value')->get();
    	$bank_acceptance_imp_data->bnk_acc_entry = $tmp;
    	//dd($bank_acceptance_imp_data);
    	 // $ilc_list = DB::table('cm_btb as btb')
     //    				->leftJoin('cm_imp_data_entry as ast', 'btb.id', '=', 'ast.cm_btb_id')
     //    				->leftJoin('cm_lc_type as lct', 'btb.cm_lc_type_id', '=', 'lct.id')
     //    			    ->select('ast.id', 'ast.cm_btb_id','btb.lc_no', 'btb.cm_lc_type_id', 'lct.lc_type_name')
     //    				->get();
     //    dd($ilc_list);
     //    		foreach ($ilc_list as $ilc) {
     //    			//dd($ilc->id);
     //    		    	if($id == $ilc->id){
     //    		    		$ilc_n = $ilc->lc_type_name;
     //    		    		$bank_acceptance_imp_data->ilc_name = $ilc_n;
     //    		    		break;
     //    		    	}
     //    		}
    	       	    
    	$tmp = BankAcceptanceImpDuedates::where('cm_bank_acceptance_imp_id', $id)
    	       	    									->get();
    	// dd($tmp);
    	$bank_acceptance_imp_data->due_dates_all = $tmp;

        // dd($bank_acceptance_imp_data);

    	return view('commercial.bank.bank_acceptance_entry_edit', compact('bank_acceptance_imp_data'));
    }

    public function bankAccepEntryUpdate(Request $request){
    		$validator = Validator::make($request->all(),[
    				 	'bill_ex_rec_date'   => 'required',
    				 	//'libor_rate'		 =>	'required',
					 	'acceptance_date'	 => 'required',
						'negotiation_date'	 =>	'required',
						'bank_bill_no'		 => 'required|max:45',
						'discre_date'		 => 'required',
						'discre_acp_date'	 => 'required',
						'days'				 =>	'required',
						'exchange_rate'		 => 'required',
						'acceptance_comm'	 => 'required'
    			]);
            
    			 if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Incorrect Input!!");
         		}
         		else{
             			$update_data = BankAcceptanceImport::where('id', $request->bank_accep_id)->update([
             						'bill_ex_rec_date'  	=>  $request->bill_ex_rec_date,
             						'acceptance_date'  		=>  $request->acceptance_date,
             						'negotiation_date'  	=>  $request->negotiation_date,
             						'bank_bill_no'  		=>  $request->bank_bill_no,
             						'discre_date'  			=>  $request->discre_date,
             						'discre_acp_date'  		=>  $request->discre_acp_date,
             						'days'  				=>  $request->days,
             						'exchange_rate'  		=>  $request->exchange_rate,
             						'acceptance_comm' 		=>  $request->acceptance_comm,
             						'due_provided_by'		=>	$request->due_date_provide
             			]);
             			if($request->libor == 'lib_yes'){
             					BankAcceptanceImport::where('id', $request->bank_accep_id)->update([
             								'libor_rate'			=>	$request->libor_rate 
             				     		  ]);
             				}

             			$delete_pre_due_dates = BankAcceptanceImpDuedates::where('cm_bank_acceptance_imp_id',$request->bank_accep_id)->delete();

             			//again entry the due dates
             			if(!empty($request->due_dates_cal)){
             				//dd($request->due_dates_cal);
             				BankAcceptanceImpDuedates::insert([
             						'cm_bank_acceptance_imp_id'   => $request->bank_accep_id,
                            	    'due_date'    => $request->due_dates_cal
             				]);
             			}	
             			else{
             				for($i=0; $i<sizeof($request->due_dates); $i++){ 
                        			BankAcceptanceImpDuedates::insert([
                            			'cm_bank_acceptance_imp_id'   => $request->bank_accep_id,
                            			'due_date'    => $request->due_dates[$i]
                        				]);
                			}	
             			}

             			 $bank_acceptance_imp_data = BankAcceptanceImport::get();
             			 //dd($bank_acceptance_imp_data);
    		    	      	foreach ($bank_acceptance_imp_data as $add) {
        				      	    $tmp = ImportDataEntry::where('id', $add->cm_imp_data_entry_id)->select('transp_doc_no1',
        	      	    										      'transp_doc_date' ,'value')->get();
        	      					$add->bnk_acc_entry = $tmp;
        	       				}
        	       			foreach ($bank_acceptance_imp_data as $add) {
        	       	    			$tmp = BankAcceptanceImpDuedates::where('cm_bank_acceptance_imp_id', $add->id)->get();
        	       	    			$add->due_dates_all = $tmp;
        	       				}
        	       				// dd($bank_acceptance_imp_data);

             			 return redirect('commercial/bank/cm_bank_acceptance_imp_entry_preview')
                                            ->with('success', 'Entry Updated', 'bank_acceptance_imp_data');
         			
         		}

    }

    public function bankAccepEntryDelete($id){
    	$delete = BankAcceptanceImport::where('id', $id)->delete();
    	$delete2 = BankAcceptanceImpDuedates::where('cm_bank_acceptance_imp_id', $id)->delete();

    	return back()->with('success', 'Entry Deleted');
    }

}

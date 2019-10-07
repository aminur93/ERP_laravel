<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\Bank\CmFile;
use App\Models\Commercial\Bank\BankAcceptanceImport;
use App\Models\Commercial\Bank\ImportBillSettle;
use App\Models\Commercial\Bank\AccountType;


use Validator;

use DB;
use Response;

class ImportBillSettlementController extends Controller{

	public function selectdata(){

		//$imp_data_entry=ImportDataEntry::get();
		//return view('Commercial.Bank.import_bill_settlement');

		$fileno=DB::table('cm_file as c')->select('c.file_no', 'd.value','c.id','d.transp_doc_no1')
    					->join('cm_imp_data_entry as d', 'c.id', '=', 'd.cm_file_id')
    					->get();
        //dd($fileno);

    	return view('commercial.bank.import_bill_settlement', compact('fileno'));

	}


	public function showdata(Request $request){

		//dd($request->all());

        $fileno=$request->file_no;
        $value=$request->value;
        $doc=$request->tdoc;
		$join_result=DB::table('cm_imp_data_entry as c')
		                ->select(
		                	'c.transp_doc_no1',
		                	'c.value',
		                	'e.discre_acp_date',
		                	'e.due_date',		                	
		                	'd.lc_no',
		                	'c.id',
                            'f.file_no'
		                	)
						->join('cm_file as f', 'f.id', '=', 'c.cm_file_id')
    					->join('cm_btb as d', 'c.cm_btb_id', '=', 'd.id')
    					->join('cm_bank_acceptance_imp as e','c.id', '=','e.cm_imp_data_entry_id' )
    					
    					/*->where('f.id','=',$request->file_no)
    					->orWhere('c.id','=',$request->value)
    					->orWhere('c.id','=',$request->tdoc)*/
                        ->where(function($condition) use ($fileno,$value,$doc){
                            if(!empty($fileno)){
                                $condition->where('f.id',$fileno);
                            }
                            if(!empty($value)){
                                $condition->where( 'c.id' , $value);
                            }
                            if(!empty($doc)){
                                $condition->where('c.id', $doc);
                            }

                        })
    					->get();

    					//dd($join_result);
      // $days = 200;
      // $date= BankAcceptanceImport::whereRaw('DATEDIFF(discre_acp_date,due_date) < ?')
           // ->setBindings([$days])
            //->get();

			

    	$data = "";
    	for($i=0; $i<sizeof($join_result); $i++){
        //foreach ($join_result as $j_result) {
                
              


            $pre_data = DB::table('cm_imp_bill_settle as d')
                                        ->select('d.cm_imp_data_entry_id',
                                                'd.payment_date',
                                                'd.days_interest',
                                                'd.interest_rate',
                                                'd.amount',
                                                'd.cm_acc_type_id'
                                                )
                                        ->where('d.cm_imp_data_entry_id',$join_result[$i]->id);
       
                  $pre_data_exist=$pre_data->exists();
                  $pre_data_first=$pre_data->first(); 

                             //dd($pre_data_first);

    		
			$diff=(strtotime($join_result[$i]->due_date))-strtotime(($join_result[$i]->discre_acp_date));
			if($diff<0) $diff= $diff*(-1);
			$diff= (($diff/60)/60)/24;

            if($pre_data_exist){

			
    	  	   $data .= '<tr>  <td>'.$join_result[$i]->file_no.'</td>
                        <td>'.$join_result[$i]->transp_doc_no1.'</td>
                        <td>'.$join_result[$i]->lc_no.'</td>
                        <td>'.$join_result[$i]->value.'</td>
                        <td>'.$join_result[$i]->discre_acp_date.'</td>
                        <td>'.$join_result[$i]->due_date.'</td>
                        <td>'.$diff.'</td>
                        <td> <input type="radio" name="check[]" id="check" value="'.$join_result[$i]->id.'" class="ck" /> 
                        <input class="settle_id" type="hidden" value="'.$pre_data_first->cm_imp_data_entry_id.'"/>
                        <input class="payment_date" type="hidden" value="'.$pre_data_first->payment_date.'"/>
                        <input class="days_interest" type="hidden" value="'.$pre_data_first->days_interest.'"/>
                        <input class="interest_rate" type="hidden" value="'.$pre_data_first->interest_rate.'"/>
                        <input class="amount" type="hidden" value="'.$pre_data_first->amount.'"/>
                        <input class="accounttype" type="hidden" value="'.$pre_data_first->cm_acc_type_id.'"/>
                        <input class="status" type="hidden" value="1"/>
                        </td>	
                        </tr>';
                    }

                else{

                    $data .= '<tr>  <td>'.$join_result[$i]->file_no.'</td>
                        <td>'.$join_result[$i]->transp_doc_no1.'</td>
                        <td>'.$join_result[$i]->lc_no.'</td>
                        <td>'.$join_result[$i]->value.'</td>
                        <td>'.$join_result[$i]->discre_acp_date.'</td>
                        <td>'.$join_result[$i]->due_date.'</td>
                        <td>'.$diff.'</td>
                        <td> <input type="radio" name="check[]" id="check" value="'.$join_result[$i]->id.'" class="ck" /> 
                        <input class="settle_id" type="hidden" value="0"/>
                        <input class="payment_date" type="hidden" value="0"/>
                        <input class="days_interest" type="hidden" value="0"/>
                        <input class="interest_rate" type="hidden" value="0"/>
                        <input class="amount" type="hidden" value="0"/>
                        <input class="accounttype" type="hidden" value="0"/>
                        <input class="status" type="hidden" value="1"/>
                        </td> 
                        </tr>';

                }
            }
                 //dd($data);
                

    	return Response::json($data);
    }

			


	public function enterdata(Request $request){

//dd($request->acc_radio);

				$acc_id=AccountType::where('acc_type_name','=',$request->acc_radio)
						  		->first();

                $imp_bill_settle_id=DB::table('cm_imp_bill_settle as a')
                                    ->select('a.cm_imp_data_entry_id')
                                    ->where('a.cm_imp_data_entry_id','=',$request->import_id)
                                    ->get();
//dd($import_id);


				$validator = Validator::make($request->all(),[
    				 	'doi'   => 'required',
					 	'ir'	 => 'required',
						'amount'	 =>	'required',
						'acc_radio' =>'required'
						
    			]);
    			 if($validator->fails()){
            		return back()
            			->withInput()
            			->with('error', "Please fill all required Input!!");
         		}
         		
                elseif(count($imp_bill_settle_id)>0){

                ImportBillSettle::where('cm_imp_data_entry_id',$request->import_id)->update([
                'payment_date' => $request->paydate,
                'days_interest'=> $request->doi,
                'interest_rate' => $request->ir,
                'amount'=> $request->amount,
                'cm_acc_type_id'=>$acc_id->id

                ]);

                return back()->with('success', 'Entry Saved');

                }

                else{

         			
         			$data = new ImportBillSettle();
         			$data->cm_imp_data_entry_id  = $request->import_id;
         			$data->payment_date = $request->paydate;
         			$data->days_interest= $request->doi;
         			$data->interest_rate= $request->ir;
         			$data->amount= $request->amount;
         			$data->cm_acc_type_id=$acc_id->id;


         			$data->save();

         			//dd('saved');
         			return back()->with('success', 'Entry Saved');	
         		}

					//return view('commercial.enterdata');


			}

			
    public function dataList(){
    	$imp_bill_settle_data = ImportBillSettle::get();
    	      // //dd($bank_acceptance_imp_data);

    	      // foreach ($imp_bill_settle_data as $ibs) {
    	      //  	    $tmp = ImportBillSettle::where('id', $ibs->cm_imp_data_entry_id)->select('transp_doc_no1','transp_doc_date' ,'value')->get();
    	      //  		$add->bill_entry = $tmp;
    	      //   }
    	      
    	     // dd($bank_acceptance_imp_data);
		return view( 'commercial.bank.import_bill_settlement_view', compact('imp_bill_settle_data')); //compact('bank_acceptance_imp_data') );
    		}




}
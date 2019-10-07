<?php

namespace App\Http\Controllers\Commercial\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Bank\ExportDataEntry;
use App\Models\Commercial\Bank\ExportLCEntry;
use App\Models\Commercial\Bank\SalesContract;
use App\Models\Commercial\Bank\ExportUpdate2;
use App\Models\Commercial\Bank\ExportBillDiscount;
use App\Models\Commercial\Bank\CmFile;
use App\Models\Commercial\Bank\HRUnit;
use App\Models\Commercial\Bank\Buyer;
use App\Models\Commercial\Bank\Bank;



use DB;
use Response;
use Validator;


class BankExportBillDiscountingController extends Controller
{
    
    public function bankExportBillDiscountingEntryView(){

        $file_id=DB::table('cm_file as a')
                ->select('a.file_no','a.id')
                ->distinct()
                ->get();
        $inv_no=DB::table('cm_exp_data_entry_1 as e')
                ->select('e.inv_no')
                // ->where('e.cm_file_id', '=', $request->file_no_id)
                //->orwhere('e.cm_file_id','=','')
                ->get();

                //dd($file_no);
        return view('commercial.bank.export_bill_discounting_entry', compact('file_id','inv_no'));
    }

    public function getInvoice(Request $request){

            //$file_name=$request->file_no_id;
           // dd($file_name);
            
          $inv_no=DB::table('cm_exp_data_entry_1 as e')
          ->select('e.inv_no')
          ->where('e.cm_file_id', '=', $request->file_no_id)
               
          ->get();

        // $data = "";
        // for($i=0; $i<sizeof($inv_no); $i++){
        //         $data .= $inv_no->inv_no;
     //                }
         // dd($inv_no->all());
        if($inv_no->isEmpty()){
            $data[]="empty";
        }

        else{
        foreach($inv_no as $inv){
            $data[]=$inv->inv_no;
          }
        }
        // dd($data);

        return Response::json($data);

    }

    public function showTable(Request $request){
     //    $tik = 0;
        // if(isset($request->file_no_id) && !isset($request->invoice_no_id))
     //    {
     //            $xx=['a.cm_file_id' => $request->file_no_id];
     //            $tik = 1;
     //    }
     //    else if(!isset($request->file_no_id) && isset($request->invoice_no_id))
     //    {
     //            $xx=['a.inv_no' => $request->invoice_no_id];
     //            $tik = 2;
     //    }
     //    else
     //    {
     //           $xx=['a.cm_file_id' => $request->file_no_id, 'a.inv_no' => $request->invoice_no_id ];
     //    }

        $fileid=$request->file_no_id;
        $invid=$request->invoice_no_id;
        $join_result=DB::table('cm_exp_data_entry_1 as a')
                        ->select(
                            'a.cm_file_id',
                            'a.cm_exp_lc_entry_id',
                            'a.id as dataid',
                            'a.unit_id as uid',
                            'a.inv_no',
                            'a.inv_date',
                            'a.cm_port_id',
                            'a.inv_value',
                            'b.cm_file_id',
                            'b.cm_sales_contract_id',
                            'c.mr_buyer_b_id',
                            'c.lc_contract_no',
                            'c.btb_bank_id',
                            'd.ex_fty_date',
                            'd.ship_bill_date',
                            'd.invoice_no',
                            'c.id',
                            'e.file_no',
                            'h.hr_unit_name',
                            'm.b_name',
                            'bank.bank_name'
                            
                            )
                        ->leftJoin('cm_exp_lc_entry as b', 'b.id', '=', 'a.cm_exp_lc_entry_id')
                        ->leftJoin('cm_sales_contract as c', 'b.cm_sales_contract_id', '=', 'c.id')
                        ->leftJoin('cm_exp_update2 as d','a.inv_no', '=','d.invoice_no' )
                        ->leftJoin('cm_file as e','e.id','=','a.cm_file_id')
                        ->leftJoin('hr_unit as h', 'a.unit_id','=','h.hr_unit_id')
                        ->leftJoin('mr_buyer as m','m.b_id','=','c.mr_buyer_b_id')
                        ->leftJoin('cm_bank as bank','bank.id','=','c.btb_bank_id')
                        //->where($xx)  
                        ->where(function($condition) use ($fileid,$invid){
                            if(!empty($fileid)){
                                $condition->where('a.cm_file_id',$fileid);
                            }
                            if(!empty($invid)){
                                $condition->where( 'a.inv_no' , $invid);
                            }

                           
                        })

                                
                        ->get();

           //dd($join_result);
                        
      // $days = 200;
      // $date= BankAcceptanceImport::whereRaw('DATEDIFF(discre_acp_date,due_date) < ?')
           // ->setBindings([$days])
            //->get();
        // for ($i=0; $i < sizeof($join_result); $i++) { 
        //  $dataid_arr[] = $join_result[$i]->dataid;
        $status=" ";                
        $data ="";
        foreach($join_result as $jr){
                //dd($dataid_arr);
                $pre_data = DB::table('cm_exp_bill_discounting as bill_d')
                                        ->select('bill_d.cm_exp_data_entry_1_id as id_check',
                                                'bill_d.discount_percent',
                                                'bill_d.disc_rcv_amnt',
                                                'bill_d.discount_date',
                                                'bill_d.remarks',
                                                'bill_d.id',
                                                'bill_d.invoice_no'
                                                )
                                        ->where('bill_d.cm_exp_data_entry_1_id',$jr->dataid);
                  $pre_data_exist=$pre_data->exists();
                  $pre_data_first=$pre_data->first();                     

                //dd($pre_data_first);      

                if($pre_data_exist) { $status="Done";


                                        $data .= '<tr>  
                                        <td class="fileno">'.$jr->file_no. '</td>
                                        <td class="invno">'.$jr->inv_no.'</td>
                                        <td class="invdate">'.$jr->inv_date.'</td>
                                        <td class="buyid">'.$jr->b_name.'</td>
                                        <td class="bankid">'.$jr->bank_name.'</td>
                                        <td class="invval">'.$jr->inv_value.'</td>
                                        <td class="shipdate">'.$jr->ship_bill_date.'</td>
                                        <td class="ftydate">'.$jr->ex_fty_date.'</td>
                                        <td class="portid">'.$jr->cm_port_id.'</td>
                                        <td class="lcno">'.$jr->lc_contract_no.'</td>
                                        <td class="status">'.$status.'</td>
                                        <td class="checkvalue"> <input type="radio" name="check[]" id="check" value="'.$jr->dataid.'" class="ck" />

                                        <input class="uid" type="hidden" value="'.$jr->uid.'"/>   
                                        <input class="disp" type="hidden" value="'.$pre_data_first->discount_percent.'"/>
                                        <input class="discount_date" type="hidden" value="'.$pre_data_first->discount_date.'"/>
                                        <input class="disc_rcv_amount" type="hidden" value="'.$pre_data_first->disc_rcv_amnt.'"/>
                                        <input class="remarks" type="hidden" value="'.$pre_data_first->remarks.'"/>
                                        <input class="dis_id" type="hidden" value="'.$pre_data_first->id.'"/>
                                        <input class="unitname" type="hidden" value="'.$jr->hr_unit_name.'"/>
                                        <input class="buyer" type="hidden" value="'.$jr->b_name.'"/>
                                        <input class="bank" type="hidden" value="'.$jr->bank_name.'"/>

                                        </td> 

                                        </tr>

                                      
                                        ';

                }

                else{$status=" ";
                     $data .= '<tr>  
                                <td class="fileno">'.$jr->file_no.'</td>
                                <td class="invno">'.$jr->inv_no.'</td>
                                <td class="invdate">'.$jr->inv_date.'</td>
                                <td class="buyid">'.$jr->b_name.'</td>
                                <td class="bankid">'.$jr->bank_name.'</td>
                                <td class="invval">'.$jr->inv_value.'</td>
                                <td class="shipdate">'.$jr->ship_bill_date.'</td>
                                <td class="ftydate">'.$jr->ex_fty_date.'</td>
                                <td class="portid">'.$jr->cm_port_id.'</td>
                                <td class="lcno">'.$jr->lc_contract_no.'</td>
                                <td class="status">'.$status.'</td>
                                <td class="checkvalue">
                                <input type="radio" name="check[]" id="check" value="'.$jr->dataid.'" class="ck" />

                                <input class="uid" type="hidden" value="'.$jr->uid.'"/>
                                <input class="unitname" type="hidden" value="'.$jr->hr_unit_name.'"/>
                                <input class="buyer" type="hidden" value="'.$jr->b_name.'"/>
                                <input class="bank" type="hidden" value="'.$jr->bank_name.'"/>
                                <input class="disp" type="hidden" value="0"/>
                                <input class="discount_date" type="hidden" value="0"/>
                                <input class="disc_rcv_amount" type="hidden" value="0"/>
                                <input class="remarks"  type="hidden" value="0"/>
                                <input class="dis_id" type="hidden" value="0"/>


                                 </td> 

                                </tr>

                                

                                ';

                }



     }                            

                //dd($pre_data);

     


        //dd($status);

  


      

            return Response::json($data);
}

    public function entryForm(Request $request){
        // dd($request->all());
            $discount_id=DB::table('cm_exp_bill_discounting as a')
                        ->select('a.cm_exp_data_entry_1_id')
                        ->where('a.cm_exp_data_entry_1_id','=',$request->import_id)
                        ->get();

                        //dd($discount_id);

            $validator = Validator::make($request->all(),[
                        'remarks'   => 'required|max:45',
                        'discount_date'  => 'required',
                        'disc_rcv_amount'    => 'required',
                        'discount_percent' =>'required'
                        
                ]);
                 if($validator->fails()){
                    return back()
                        ->withInput()
                        ->with('error', "Please fill all required Input!!");
                }
                elseif(count($discount_id)>0){

                ExportBillDiscount::where('id', $request->dis_id)->update([
               'invoice_no' => $request->invoice_no_view,
               'discount_percent' => $request->discount_percent,
               'disc_rcv_amnt' => $request->disc_rcv_amount,
               'discount_date' => $request->discount_date,
               'remarks' => $request->remarks
                        ]);

                return back()->with('success', 'Entry Updated');

                }
                else{
                    
                    
                    $data = new ExportBillDiscount();
                    $data->cm_exp_data_entry_1_id  = $request->import_id;
                    $data->invoice_no = $request->invoice_no_view;
                    $data->discount_percent= $request->discount_percent;
                    $data->disc_rcv_amnt= $request->disc_rcv_amount;
                    $data->discount_date= $request->discount_date;
                    $data->remarks=$request->remarks;


                    $data->save();

                    //dd('saved');
                    return back()->with('success', 'Entry Saved');  
                }

        
    }
}

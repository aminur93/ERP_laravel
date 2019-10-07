<?php
namespace App\Http\Controllers\Commercial\Export\ExportData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Commercial\Bank;
use App\Models\Commercial\BankAccNo;
use App\Models\Commercial\SalesContract;
use App\Models\Commercial\SalesContractOrder;
use App\Models\Merch\Country;
use App\Models\Merch\OrderEntry;
use App\Models\Commercial\ExpLcEntry;
use App\Models\Commercial\ExpLcAmmendment;
use App\Models\Commercial\ExpLcAddress;
use App\Models\Commercial\CFile;
use App\Models\Commercial\Agent;
use App\Models\Commercial\Port;
use App\Models\Commercial\Incoterm;
use App\Models\Commercial\CategoryNo;
use App\Models\Commercial\ExpDataEntry;
use App\Models\Commercial\HSCode;
use App\Models\Commercial\ExpEntryDelivery;
use App\Models\Commercial\ExpDataPO;


use Validator, DB, ACL, Auth, DataTables;
class ExportDataEntryController extends Controller
{
# Export LC Form
    public function showForm()
    {
      $buyer= Buyer::pluck('b_name','b_id');
      $bank= Bank::pluck('bank_name','id');
      $country= Country::pluck('cnt_name','cnt_id'); 
      $unit= Unit::pluck('hr_unit_name','hr_unit_id');
      $agent= Agent::pluck('agent_name','id');
      $fileno= CFile::pluck('file_no','id');
      $lcno=SalesContract::pluck('lc_contract_no','id');
      $port=Port::pluck('port_name','id');
      $incoterm=Incoterm::pluck('name','id');
      $category=CategoryNo::get();
  

    return view('commercial.export.export_data.export_data_entry', compact('buyer', 'bank', 'country','unit','agent','fileno','lcno','port','incoterm','category'));
    }
  
# Return File No List by Unit ID
    public function fileList(Request $request)
    {
        $list = "<option value=\"\">Select</option>";
        if (!empty($request->unit_id))
        { 

            $fileList  = CFile::where('hr_unit', $request->unit_id)
                        ->pluck('file_no','id'); 

            foreach ($fileList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }  
# Return ELC List by File No
    public function elcList(Request $request)
    {
        $list = "<option value=\"\">Select  </option>";
        if (!empty($request->file_id))
        { 

        	$elcList= DB::table('cm_exp_lc_entry AS elc')
                    ->select([
                        
                          'sc.lc_contract_no',
                          'sc.id as lcid'
                        ])

                    ->leftJoin("cm_sales_contract AS sc", 'sc.id', 'elc.cm_sales_contract_id')
                    ->where('elc.cm_file_id', $request->file_id)     
                    ->get();
                              
            //dd($elcList);
            foreach ($elcList as  $value) 
            {
             $list .= "<option value=\"$value->lc_contract_no\">$value->lc_contract_no</option>";
            }
        }
        return $list;
    }  

# Invoice No. Generate
  public function invNo(Request $request){
      

       if (!empty($request->unt_id))
        {
            $list =01; 
	        $entryList  = ExpDataEntry::where('unit_id', $request->unt_id)
	                     ->get();
	        $entry = $entryList->count(); 
	        $list=$entry+$list;  
            //dd($list);
            $formatted_unit= sprintf("%02d", $request->unt_id);
            $formatted_list= sprintf("%06d", $list);
            $finalval=$formatted_unit.$formatted_list;

	        return $finalval;


       } 

    }   


# ELC No. Input Values
  public function elcInfoList(Request $request){
      

       if (!empty($request->elc_id))
        {
          
         // $elcinfo= SalesContract::select('elc_date','surname')->where('id', 1)->get();
          $elcinfo= DB::table('cm_sales_contract AS csc')
                    ->select([
                    	  'csc.id',
                          'csc.elc_date',
                          'bu.b_name', 
                          'bu.b_id',
                          'b.bank_name AS lc_bank',
                          'b.id AS lc_bank_id'
                        ])

                    ->leftJoin("mr_buyer AS bu", 'bu.b_id', 'csc.mr_buyer_b_id')
                    ->leftJoin("cm_bank AS b", 'b.id', 'csc.lc_open_bank_id')
                    ->where('lc_contract_no', $request->elc_id)     
                    ->first(); 

        /* Json Multiple variable return*/
         return response()->json([
           'buyername'       =>$elcinfo->b_name, 
           'buyerid'         =>$elcinfo->b_id, 
           'elcdate'         =>$elcinfo->elc_date, 
           'lc_bank'         =>$elcinfo->lc_bank,
           'lc_bank_id'      =>$elcinfo->lc_bank_id,
           'contract_id'     =>$elcinfo->id

         ]);

       } 

    }   

# Return PO Table by File No
    public function poList(Request $request)
    {
        $list = "";
        $po = "<option value=''>Select</option>";
        if (!empty($request->file_no))
        {
        	$orderList= DB::table('cm_file AS f')
                    ->select([                        
                          'o.*',
                          's.stl_no',
                          's.stl_id',
                          'b.agent_fob'
                        ])
                    ->leftJoin("cm_exp_lc_entry AS lc", 'lc.cm_file_id', 'f.id')

                    ->leftJoin("cm_sales_contract AS sc", 'sc.id', 'lc.cm_sales_contract_id')

                    ->leftJoin("cm_sales_contract_order AS co", 'co.cm_sales_contract_id', 'sc.id')

                    ->leftJoin("mr_order_entry AS o", 'o.order_id', 'co.mr_order_entry_order_id')

                    ->leftJoin("mr_style AS s", 's.stl_id', 'o.mr_style_stl_id')
                    ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'co.mr_order_entry_order_id')

                    //->leftJoin("mr_purchase_order AS po", 'po.mr_order_entry_order_id', 'o.order_id')

                    ->where('f.id', $request->file_no)     
                    ->get();
                              
           $po_quantity=0;
           $order_qty=0;


            foreach ($orderList as  $value) 
            {
         
                $poList= DB::table('mr_purchase_order AS p')
                    ->select([                        
                          'p.po_id',
                          'p.po_no',
                          'p.po_qty as order_quantity'

                        ])
                    ->where('p.mr_order_entry_order_id', $value->order_id)     
                    ->get();

               	// dd($poList);
                     $order_qty=0;
               
                    foreach ($poList as  $pval){
                    	
	                 	$po.='<option value="'.$pval->po_id.'">'.$pval->po_no.'</option>';

	                 
                      
                       $entryList  = ExpDataPO::where('mr_purchase_order_po_id', 
	                    	          $pval->po_id)->get(['po_qty']);
                        foreach ($entryList as $povalue) {
	                     	$po_quantity+=$povalue->po_qty;
	                     	$order_qty+=  $pval->order_quantity;
	                     }
	                 }     
	                      // dd($po_quantity);

                
                       $list .= '<tr class="purchase_row">
	                       <td><select name="pono[]" class="form-control pono">'.$po.'</select></td>
	                       <td><input type="text" class="form-control" name="mbm_order[]"  placeholder="" value="'.$value->order_code.'" readonly/>
	                           <input type="hidden" class="form-control" name="mbm_order_no[]" id="mbm_order_no[]" placeholder="" value="'.$value->order_id.'" readonly/>
	                       </td>
	                       <td><input type="text" class="form-control" name="stl[]" id="stl[]" placeholder="" value="'.$value->stl_no.'" readonly/>
	                           <input type="hidden" class="form-control" name="stl_no[]" id="stl_no[]" placeholder="" value="'.$value->stl_id.'" readonly/>
	                       </td>
	                       <td><input type="text" class="form-control" name="dept_isd[]" id="dept_isd[]" placeholder="Enter" value="" /></td>
	                       <td><input type="text" name="po_qty[]" id="po_qty[]" class="form-control po_qty" placeholder="" value="" readonly/></td>
	                       <td><input type="text" class="form-control inv_qty" name="inv_qty[]" id="inv_qty[]" placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control unit_price1" name="unit_price1[]" id="unit_price1[]" placeholder="Enter" value="'.$value->agent_fob.'" readonly/></td>
	                       <td><input type="text" class="form-control" name="unit_price2[]" id="unit_price2[]" placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control unit_value" name="unit_value[]" id="unit_value[]" value="" readonly /></td>
	                       <td><select name="currency[]" class="form-control">
	                               <option value="USD">$ USD</option>
	                               <option value="EUR">€ EUR</option>
	                               <option value="GBP">£ GBP</option>
	                               <option value="Tk"> ৳ Tk</option>
	                           </select>
	                       </td>
	                       <td><input type="text" class="form-control cnt" name="cnt[]" id="cnt[]" placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control agent_unit_price" name="agent_unit_price[]" id="agent_unit_price[]"  placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control agent_value" name="agent_value[]" id="agent_value[]"  placeholder="Enter" value="" readonly /></td>
	                       <td><input type="text" class="form-control fob_date" name="fob_date[]" id="fob_date[]"  placeholder="Enter" value="'.$value->order_delivery_date.'" /></td>
	                       <td><input type="text" class="form-control total_exp_qty" name="total_exp_qty[]" id="total_exp_qty[]"  placeholder="Enter" value="'.$order_qty.'" /></td>
	                       <td><input type="text" class="form-control cbm" name="cbm[]" id="cbm[]"  placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control gross_weight" name="gross_weight[]" id="gross_weight[]"  placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control net_weight" name="net_weight[]" id="net_weight[]"  placeholder="Enter" value="" /></td>
	                       <td><input type="text" class="form-control nn_weight" name="nn_weight[]" id="nn_weight[]"  placeholder="Enter" value="" /></td>
	                       <td><button type="button" class="btn btn-sm btn-success AddBtn_tbl" style="padding:2px;">+</button>
                               <button type="button" class="btn btn-sm btn-danger RemoveBtn_tbl" style="padding:2px;">-</button> </td>
                      <tr/>';
            }
        }
        return $list;
    }  

# Return PO Input Values 
  public function poValues(Request $request){
      
  //dd($request->all());  
        if (!empty($request->po_no))
        {

         $poinfo= DB::table('mr_purchase_order AS po')
                    ->select([
                    	  'po.po_qty'
                        ])
                    ->where('po_id', $request->po_no)     
                    ->first(); 	
          //dd($poinfo);       

        /* Json Multiple variable return*/
         return response()->json([
           'poqty'      =>$poinfo->po_qty

         ]);

       } 

   } 

# Return Cash Incentive Value 
  public function cashIncentive(Request $request){
  	    if (!empty($request->cnt_id))
        {
            $ci= Country::where('cnt_id', $request->cnt_id)     
                 ->pluck('cnt_cash_incentive');

       /* Json Multiple variable return*/
         return response()->json([
           'cashincentive'      =>$ci

         ]);

       } 

   }    
# Export Data Store        
  public function storeExportData(Request $request){
 
    #------------------------------------------------#
   
       $validator= Validator::make($request->all(),[
           
            // 'unit'          => 'required|max:11',
            // 'agentname'     => 'required|max:45',
            // 'fileno'        => 'required|max:45',
            // 'invoiceno'     => 'required|max:45'
            

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

           $newdata= new ExpDataEntry();
           $newdata->unit_id              = $request->unit;
           $newdata->cm_agent_id          = $request->agentname;
           $newdata->cm_file_id           = $request->fileno;        
           $newdata->inv_no               = $request->invoiceno;
           $newdata->inv_date             = $request->invoice_date;
           $newdata->cm_exp_lc_entry_id   = $request->elcno;

           $newdata->cm_sales_contract_id = $request->salescontractid;

           $newdata->cancel_status        = $request->cancelmark;
           $newdata->cancel_reason        = $request->reason;
           $newdata->canel_date           = $request->cancel_date;

           //$newdata->cm_exp_data_entry_1col   = $request->;

           $newdata->cm_inco_term_id      = $request->incoterms;
           $newdata->exp_no               = $request->exp_no;
           $newdata->exp_date             = $request->exp_date;

           $newdata->cnt_id               = $request->destination;
           $newdata->fabric_desc          = $request->fab_desc;
           $newdata->garment_desc         = $request->garm_desc;

           $newdata->mode                 = $request->mode;
           $newdata->cm_port_id           = $request->port_destination;
           $newdata->inspec_order_no      = $request->insp_order_no;

           $newdata->brand_name           = $request->brand_name;
           $newdata->inv_value            = $request->total_value;

           $newdata->save();
           $last_id = $newdata->id;

         // HS Code insert  

         for($i=0; $i<sizeof($request->hs_code); $i++)
          {
              HSCode::insert([
                  'cm_exp_data_entry_1_id'     => $last_id,
                  'hs_code'                    => $request->hs_code[$i]
              ]);
          }

       // Delivery center Code insert  

        for($j=0; $j<sizeof($request->delv_cnt_code); $j++)
          {
              ExpEntryDelivery::insert([
                  'cm_exp_data_entry_1_id'     => $last_id,
                  'delivery_centre_code'       => $request->delv_cnt_code[$j],
                  'qty'                        => $request->quantity[$j],
                  'cartoon'                    => $request->carton[$j],
              ]);
          }

       // PO insert       
        for($k=0; $k<sizeof($request->pono); $k++)
          {

          	ExpDataPO::insert([
                  'cm_exp_data_entry_1_id'     => $last_id,
                  'mr_purchase_order_po_id'    => $request->pono[$k],
                  'mr_order_entry_order_id'    => $request->mbm_order_no[$k],
                  'mr_style_stl_id'            => $request->stl_no[$k],
                  'dept_no_isd'                => $request->dept_isd[$k],
                  'po_qty'                     => $request->po_qty[$k],
                  'inv_qty'                    => $request->inv_qty[$k],
                  'unit_price'                 => $request->unit_price1[$k],
                  'unit_price2'                => $request->unit_price2[$k],
                  'currency'                   => $request->currency[$k],
                  'ctn'                        => $request->cnt[$k],
                  'agent_unit_price'           => $request->agent_unit_price[$k],
                  'cbm'                        => $request->cbm[$k],
                  'gross_wt'                   => $request->gross_weight[$k],
                  'net_wt'                     => $request->net_weight[$k],
                  'n_n_wt'                     => $request->nn_weight[$k]
              ]);

          }
      
        return back()
                ->with('success', "Export Data Saved Successfully !!!");
       }

    }
}

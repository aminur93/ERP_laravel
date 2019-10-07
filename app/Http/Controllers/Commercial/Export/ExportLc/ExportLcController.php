<?php
namespace App\Http\Controllers\Commercial\Export\ExportLc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Merch\Buyer;
use App\Models\Commercial\Bank;
use App\Models\Commercial\BankAccNo;
use App\Models\Commercial\SalesContract;
use App\Models\Commercial\SalesContractOrder;
use App\Models\Merch\Country;
use App\Models\Merch\OrderEntry;
use App\Models\Hr\Unit;

use App\Models\Commercial\ExpLcEntry;
use App\Models\Commercial\ExpLcAmmendment;
use App\Models\Commercial\ExpLcAddress;
use App\Models\Commercial\CFile;
// use App\Models\Commercial\ExpLcHistory;
// use App\Models\Commercial\ExpLcClose;




use Validator, DB, ACL, Auth, DataTables;
class ExportLcController extends Controller
{
# Export LC Form
    public function showForm()
    {
      $buyer=Buyer::pluck('b_name','b_id');
      $bank=Bank::pluck('bank_name','id');
      $country=Country::pluck('cnt_name','cnt_id');
      $unit=Unit::pluck('hr_unit_name','hr_unit_id');

    return view('commercial.export.export_lc.export_lc', compact('buyer', 'bank', 'country','unit'));
    }
# Export No. list
    public function exportLcnoList(Request $request){

       $list = "<option value=\" \">Select</option>";
        if (!empty($request->lc_val))
        {

            $orderList  = SalesContract::where('lc_contract_type', $request->lc_val)
                          ->pluck('lc_contract_no','lc_contract_no');

            foreach ($orderList as $key => $value)
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }

        return $list;

    }
# Export No. Input Values
    public function exportInputList(Request $request){
        $list = "";
        $po_list="";

        if (!empty($request->ex_id))
        {
          // dd($request->ex_id);exit;
          // $orderList  = SalesContract::where('lc_contract_no', $request->ex_id)
          //                 ->first();
          // $temp_lc_contract_no =
          $orderList= DB::table('cm_sales_contract AS csc')
                        ->select([
                          'csc.*',
                          'bu.b_name',
                          'bu.b_id',
                          'cb.bank_name AS lc_bank',
                          'b.bank_name AS btb_bank',
                          'b.id AS btb_bank_id'
                        ])

                    ->leftJoin("mr_buyer AS bu", 'bu.b_id', 'csc.mr_buyer_b_id')
                    ->leftJoin("cm_bank AS cb", 'cb.id', 'csc.lc_open_bank_id')
                    ->leftJoin("cm_bank AS b", 'b.id', 'csc.btb_bank_id')
                    ->where('csc.lc_contract_no', $request->ex_id)
                    ->first();

                  // dd('Order List:',$orderList);

          $sales_order = DB::table('cm_sales_contract_order AS co')
            ->select(
                "co.*",
                "m.order_code",
                "m.order_id",
                "m.order_qty",
                "b.agent_fob"
            )
            ->leftJoin('mr_order_entry AS m', 'm.order_id', '=', 'co.mr_order_entry_order_id')
            ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')
            ->where('co.cm_sales_contract_id', $orderList->id)
            ->get();

            //dd("Sales Order:",$sales_order);exit;

          $sum_qty=0;
          $sum_value=0;

         // Order TAble
          foreach ($sales_order as  $value)
            {
               $cvalue=$value->order_qty*$value->agent_fob;
                $list.= '<tr>
                           <td><input type="hidden" class="form-control" name="order_id[]" value="'.$value->id.'" readonly/>
                           <input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$value->order_code.'" readonly/></td>
                           <td><input type="text" class="form-control qty" name="qty[]" placeholder="" value="'.$value->order_qty.'"  readonly/></td>
                           <td><input type="text" class="form-control" name="fob[]"  placeholder="" value="'.$value->agent_fob.'"  readonly/></td>
                           <td>
                           <input type="text" class="form-control order_value" name="order_value[]" value="'.$cvalue.'"  readonly/></td>
                        </tr>';


                    $sum_qty += $value->order_qty;
                    $sum_value += $cvalue;

              // Purchase order table

                    $po = DB::table('mr_purchase_order AS po')
                          ->select(
                              "po.*",
                              "m.order_code",
                              "m.order_id",
                              "m.order_qty",
                              "b.agent_fob",
                              "bu.b_name",
                              "se.se_name",
                              "s.stl_no",
                              "s.stl_description",
                              "mc.cnt_name"
                            )

                      ->leftJoin('mr_order_entry AS m', 'm.order_id', '=', 'po.mr_order_entry_order_id')
                      ->leftJoin('mr_country AS mc', 'mc.cnt_id', '=', 'po.po_delivery_country')
                      ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')
                      ->leftJoin('mr_style AS s', 's.stl_id', '=', 'm.mr_style_stl_id')
                      ->leftJoin('mr_buyer AS bu', 'bu.b_id', '=', 'm.mr_buyer_b_id')
                      ->leftJoin('mr_season AS se', 'se.se_id', '=', 'm.mr_season_se_id')
                      ->where('po.mr_order_entry_order_id', $value->id)
                      ->get();

                      // dd();exit;
               // Style Table
                  foreach ($po as $pvalue)
                  {

                   $po_list.='<tr>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->stl_no.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->po_no.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->b_name.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->stl_description.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->se_name.'" readonly/></td>

                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->order_qty.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->po_ex_fty.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->cnt_name.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$value->agent_fob.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->country_fob.'" readonly/></td>
                                 <td><input type="text" class="form-control" name="order_no[]" id="items[]" placeholder="" value="'.$pvalue->order_qty*$value->agent_fob.'" readonly/></td>
                               <tr/>';
                  }
            //dd($orderList);
            }

      }

      /* Json Multiple variable return*/
         return response()->json([
           'buyername'   =>$orderList->b_name,
           'buyerid'     =>$orderList->b_id,
           'elcdate'     =>$orderList->elc_date,
           'contractqty' =>$orderList->contract_qty,
           'contractval' =>$orderList->contract_value,
           'exdate'      =>$orderList->expiry_date,
           'initial_val' =>$orderList->initial_value,
           'lcbank'      =>$orderList->lc_bank,
           'currency'    =>$orderList->currency_type,
           'btbbank'     =>$orderList->btb_bank,
           'btbbankid'   =>$orderList->btb_bank_id,
           'lc_contract' =>$orderList->lc_contract_no,
           'orderList'   =>$list,
           'sum_qty'     =>(int)$sum_qty,
           'sum_value'   =>number_format((float)$sum_value, 2, '.', ''),
           'polist'      =>$po_list,
           'salescontractid'  =>$orderList->id,
           'remark'      => $orderList->remarks

         ]);



    }

# Export LC Store
    public function exportLcStore(Request $request)
    {
    	#-----------------------------------------------#
          //dd($request->all());exit;
          $validator= Validator::make($request->all(),[
            'fileno'              => 'required|max:45|unique:cm_file,file_no',
            'buyer'               => 'required|max:11',
            'unit'                => 'required|max:11',
            'lctype'              => 'required|max:45',
            'exlc_contract_no'    => 'required|max:45',
            'contract_qty'        => 'required|max:45',
            'contract_value'      => 'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            // Store in File Table
              $dataFile= new CFile();
              $dataFile->file_no     = $request->fileno;
              $dataFile->hr_unit     = $request->unit;
              // $dataFile->file_type   = $request->lctype;
              // $dataFile->file_type   = 1;
              $dataFile->save();
              $last_id = $dataFile->id;

            // Store in  Export Lc Entry Table
              $data= new ExpLcEntry();
              $data->cm_file_id	           = $last_id;
              $data->cm_sales_contract_id  = $request->salescontractid;
              $data->hr_unit_id            = $request->unit;

              $data->save();

              $last_lc_id = $data->id;

            // Update Sales Entry Table
              $lc_bank_id = DB::table('cm_bank')->where('bank_name', $request->lc_bank)->value('id');
              // dd('LC bank id:', $lc_bank_id);exit;

               SalesContract::where('id', $request->salescontractid)->update([
                'mr_buyer_b_id'   => $request->buyer,
                'hr_unit_id'      => $request->unit,
                'contract_qty'    => $request->contract_qty,
                'contract_value'  => $request->contract_value,
                'elc_date'        => $request->elc_date,
                'expiry_date'     => $request->exp_date,
                'initial_value'   => $request->initial_value,
                'currency_type'   => $request->currency,
                'btb_bank_id'     => $request->btb_bank,
                'lc_open_bank_id' => $lc_bank_id
              ]);


            // Store in ammendment table
              for($i=0; $i<sizeof($request->amend_no); $i++)
                {
                    if($request->amend_no[$i]!=null){
                      ExpLcAmmendment::insert([
                       'cm_exp_lc_entry_id'  => $last_lc_id,
                       'amend_no'            => $request->amend_no[$i],
                       'amend_date'          => $request->amend_date[$i],
                       'expiry_date'         => $request->amend_ex_date[$i],
                       'elc_amount'          => $request->elc_ammount[$i],
                       'total'               => $request->elc_total_ammount[$i],
                       'remarks'             => $request->remarks[$i]
                     ]);
                 }
            }

        if($request->notify_addrss!=null){

            $data_addrs= new ExpLcAddress();
            $data_addrs->mr_country_cnt_id   = $request->country;
            $data_addrs->buyer_address       = $request->buyer_addrss;
            $data_addrs->notify_adress       = $request->notify_addrss;;
            $data_addrs->notify_address2     = $request->notify_addrss2;
            $data_addrs->notify_address3     = $request->notify_addrss3;
            $data_addrs->cm_exp_lc_entry_id           = $last_lc_id;
            $data_addrs->save();
            }

            return back()
            ->with('success', "Export LC Successfully added!!");
         }
    }
#----Export LC List----------/
    public function exportLcList(){

    #----------------------------#
      $buyer= Buyer::pluck('b_name','b_id');
      $bank= Bank::pluck('bank_name','id');
      $country= Country::pluck('cnt_name','cnt_id');
      $unit= Unit::pluck('hr_unit_name','hr_unit_id');

    return view('commercial.export.export_lc.export_lc_list',compact('buyer','bank', 'country','unit'));
  }

   public function exportLcListData(){

        #-------------------------------#
         $data=  DB::table('cm_file AS fle')
                    ->select([
                      'fle.*',
                      'fle.id as file_id',
                      'expe.*',
                      'b.b_name',
                      'ebn.bank_name',
                      'u.hr_unit_name',
                      'sc.elc_date',
                      'sc.lc_contract_no',
                      'sc.expiry_date',
                      'sc.lc_contract_type',
                      'expe.id as lc_id'

                    ])
                    ->leftJoin("cm_exp_lc_entry AS expe", 'expe.cm_file_id', 'fle.id')
                    ->leftJoin("hr_unit AS u", 'u.hr_unit_id', 'fle.hr_unit')
                    ->leftJoin("cm_sales_contract AS sc", 'sc.id', 'expe.cm_sales_contract_id')
                    ->leftJoin("mr_buyer AS b", 'b.b_id', 'sc.mr_buyer_b_id')
                    ->leftJoin("cm_bank AS ebn", 'ebn.id', 'sc.btb_bank_id')
                    ->get();

                    //dd($data);


              return DataTables::of($data)



          /// Query for Action
            ->editColumn('action', function ($data) {
                  // dd($data);exit;

                  $btn = "
                    <a href=".url('commercial/export/exportlc_edit/'.$data->file_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-pencil\"></i>
                        </a>
                    </div>
                   <a href=".url('commercial/export/exportlcdelete/'.$data->file_id.'/'.$data->lc_id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"delete\" onclick=\"return confirm('Are you sure you want to delete this LC?');\">
                        <i class=\"fa fa-trash\"></i>
                        </a>


                    ";


                return $btn;
              })
            ->rawColumns(['action'])
            ->toJson();

  }

# Export LC Update

  public function exportLcEdit($id){

    #------------------------------------------------#
       $buyer= Buyer::pluck('b_name','b_id');
       $bank= Bank::pluck('bank_name','id');
       $country= Country::pluck('cnt_name','cnt_id');
       $unit= Unit::pluck('hr_unit_name','hr_unit_id');

       // Main Table
       $exportlc= DB::table('cm_file AS fle')
                    ->select([
                      'fle.*',
                      'expe.*',
                      'u.hr_unit_name',
                      'expe.id AS lc_id'

                    ])
                    ->leftJoin("cm_exp_lc_entry AS expe", 'expe.cm_file_id', 'fle.id')
                    ->leftJoin("hr_unit AS u", 'u.hr_unit_id', 'fle.hr_unit')
                    ->where('fle.id', $id)
                    ->first();

                    // dd($exportlc->lc_id);


      // Query for data based on Export Lc No.
        $orderList= DB::table('cm_sales_contract AS csc')
                    ->select([
                      'csc.*',
                      'bu.b_name',
                      'bu.b_id',
                      'cb.bank_name AS lc_bank',
                      'b.bank_name AS btb_bank',
                      'b.id AS btb_bank_id'
                    ])

                    ->leftJoin("mr_buyer AS bu", 'bu.b_id', 'csc.mr_buyer_b_id')
                    ->leftJoin("cm_bank AS cb", 'cb.id', 'csc.lc_open_bank_id')
                    ->leftJoin("cm_bank AS b", 'b.id', 'csc.btb_bank_id')
                    ->where('csc.id', $exportlc->cm_sales_contract_id)
                    ->first();
           // dd($orderList);
      // Query for Order Table
        $sales_order = DB::table('cm_sales_contract_order AS co')
                      ->select(
                          "co.*",
                          "m.order_code",
                          "m.order_id",
                          "m.order_qty",
                          "b.agent_fob"
                      )
                      ->leftJoin('mr_order_entry AS m', 'm.order_id', '=', 'co.mr_order_entry_order_id')
                      ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')
                      ->where('co.cm_sales_contract_id', $orderList->id)
                      ->get();

        // Query for Ammendment Table
        $ammendment= ExpLcAmmendment::where('cm_exp_lc_entry_id', $exportlc->lc_id)
                      ->get();
        $ammendmentexist= ExpLcAmmendment::where('cm_exp_lc_entry_id', $exportlc->lc_id)->first();


        $lcaddress= ExpLcAddress::where('cm_exp_lc_entry_id', $exportlc->lc_id)
                      ->first();
          //dd($lcaddress);
        // Purchase order table

        $po = DB::table('mr_purchase_order AS po')
                  ->select(
                      "po.*",
                      "m.order_code",
                      "m.order_id",
                      "m.order_qty",
                      "b.agent_fob",
                      "bu.b_name",
                      "se.se_name",
                      "s.stl_no",
                      "s.stl_description",
                      "mc.cnt_name"
                    )

                  ->leftJoin('mr_order_entry AS m', 'm.order_id', '=', 'po.mr_order_entry_order_id')
                  ->leftJoin('mr_country AS mc', 'mc.cnt_id', '=', 'po.po_delivery_country')
                  ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')
                  ->leftJoin('mr_style AS s', 's.stl_id', '=', 'm.mr_style_stl_id')
                  ->leftJoin('mr_buyer AS bu', 'bu.b_id', '=', 'm.mr_buyer_b_id')
                  ->leftJoin('mr_season AS se', 'se.se_id', '=', 'm.mr_season_se_id')
                  ->where('po.mr_order_entry_order_id', $orderList->id)
                  ->get();
          //dd($po);

          return view('commercial.export.export_lc.export_lc_edit', compact('buyer','machine','unit','bank','country','exportlc','ammendment','ammendmentexist','lcaddress','orderList','sales_order','po'));

  }

  public function exportLcUpdate(Request $request){

        #-----------------------------------------------#


          $validator= Validator::make($request->all(),[
            'fileno'              => 'required|max:45',
            'buyer'               => 'required|max:11',
            'unit'                => 'required|max:11',
            'lctype'              => 'required|max:45',
            'exlc_contract_no'    => 'required|max:45',
            'contract_qty'        => 'required|max:45',
            'contract_value'      => 'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

       //File Table Update

            CFile::where('id', $request->exp_lc_id)->update([

                   'file_no'       => $request->fileno,
                   'hr_unit'       => $request->unit,
                   'file_type'     => $request->lctype

                ]);

            ExpLcEntry::where('cm_file_id', $request->exp_lc_id)->update([

                'cm_sales_contract_id'  => $request->salescontractid,
                'hr_unit_id'            => $request->unit
            ]);

              ExpLcAmmendment::where('cm_exp_lc_entry_id', $request->exp_lc_entry_id)->delete();
              for($i=0; $i<sizeof($request->amend_no); $i++)
                {
                    if($request->amend_no[$i]!=null){
                      ExpLcAmmendment::insert([
                       'cm_exp_lc_entry_id'  => $request->exp_lc_entry_id,
                       'amend_no'            => $request->amend_no[$i],
                       'amend_date'          => $request->amend_date[$i],
                       'expiry_date'         => $request->amend_ex_date[$i],
                       'elc_amount'          => $request->elc_ammount[$i],
                       'total'               => $request->elc_total_ammount[$i],
                       'remarks'             => $request->remarks[$i]
                     ]);
                 }
            }

        if($request->notify_addrss!=null){


             ExpLcAddress::where('cm_exp_lc_entry_id', $request->exp_lc_entry_id)->update([

                'mr_country_cnt_id'   => $request->country,
                'buyer_address'       => $request->buyer_addrss,
                'notify_adress'       => $request->notify_addrss,
                'notify_address2'     => $request->notify_addrss2,
                'notify_address3'     => $request->notify_addrss3

              ]);
            }
         return back()
            ->with('success', "Export LC Successfully Updated!!");
         }
  }
///----Export LC Delete
      public function exportLcDelete($file_id,$lc_id){


        #------------------------------------------------#
        CFile::where('id', $file_id)->delete();
        ExpLcEntry::where('id', $lc_id)->delete();
        ExpLcAmmendment::where('cm_exp_lc_entry_id', $lc_id)->delete();
        ExpLcAddress::where('cm_exp_lc_entry_id', $lc_id)->delete();
        return redirect('commercial/export/exportlclist')
        ->with('success', "LC Deleted Successfully!!");
    }

/// Export Lc Close Form
    public function exportLcClose()
    {
    $fileno=ExpLcEntry::groupBy('exp_lc_fileno')
            ->pluck('exp_lc_fileno','exp_lc_fileno');

    return view('commercial.export.export_lc.export_lc_close', compact('fileno'));
    }

  public function exportLcCloseAction(Request $request){

        #-----------------------------------------------#

          $validator= Validator::make($request->all(),[
             'fileno_confirmation'   =>'required',
             'close_date'            =>'required',
             'remarks'               =>'required|max:145'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }

        else{

          if(($request->fileno_confirmation)==($request->fileno)){

          $data= new ExpLcClose();
          $data->exp_lc_fileno          = $request->fileno_confirmation;
          $data->exp_lc_close_date      = $request->close_date;
          $data->exp_lc_close_remarks   = $request->remarks;
          $data->save();

          $last_id = $data->id;

              ExpLcEntry::where('exp_lc_fileno', $request->fileno_confirmation)->update([

                'exp_lc_file_status'    => 0

              ]);

         return back()
            ->with('success', "Export LC Successfully Closed!!");
          }

          else {
           return back()
            ->withInput()
            ->with('error', "File No. Does Not Match");
           }
        }

  }


}

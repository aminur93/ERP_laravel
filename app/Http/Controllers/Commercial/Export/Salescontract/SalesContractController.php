<?php
namespace App\Http\Controllers\Commercial\Export\Salescontract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Buyer;
use App\Models\Commercial\Bank;
use App\Models\Commercial\BankAccNo;
use App\Models\Commercial\SalesContract;
use App\Models\Commercial\SalesContractOrder;
use App\Models\Merch\Country;
use App\Models\Hr\Unit;
use App\Models\Merch\OrderEntry;

use Validator, DB, ACL, Auth, DataTables;
class SalesContractController extends Controller
{
# show form
    public function entryForm()
    {
      $buyer=Buyer::pluck('b_name','b_id');
      $bank=Bank::pluck('bank_name','id');
      $country=Country::pluck('cnt_name','cnt_id');
      $unit=Unit::pluck('hr_unit_name','hr_unit_id');

      return view('commercial/export/salescontract/salescontract_entry', compact('buyer','bank','unit'));
    }
# Contract list
    public function getContractList(Request $request){

        $list =1;
        $orderList  = SalesContract::where('hr_unit_id', $request->unit_id)
                     ->where('mr_buyer_b_id', $request->b_id)
                     ->get();
        $order = $orderList->count();
        $list=$order+$list;
        return $list;

    }
# Order list
    public function getOrderList(Request $request){
     // dd($request->all());

        $list = "";
        // $orderList  = OrderEntry::where('mr_buyer_b_id', $request->buyer_id)
        //              ->where('unit_id', $request->unit_id)
        //              ->pluck('order_code', 'order_id');

        $orderList = DB::table('mr_order_entry AS m')
            ->select(

                "m.order_code",
                "m.order_id",
                "m.order_qty",
                "b.agent_fob"

            )
            ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')

            ->where('m.mr_buyer_b_id', $request->buyer_id)
            ->where('m.unit_id', $request->unit_id)
            ->get();
            //dd($orderList);

            foreach ($orderList as  $value)
            {
               //$list .= "<option value=\"$key\">$value</option>";
                $list.='<label>
                          <input name="selected_item[]" type="checkbox" value="'.$value->order_id.'" class="ace checkbox-input">
                          <span class="lbl">'. $value->order_code.'</span>
                           <input type="hidden" class="qty" value="'.$value->order_qty.'">
                           <input type="hidden" class="fob" value="'.$value->agent_fob.'">
                        </label>';
            }

        return $list;

    }
# Sales Store
  public function salesStore(Request $request){

        #------------------------------------------------#

       $validator= Validator::make($request->all(),[
            'buyer'               => 'required|max:11',
            'unit'                => 'required|max:11',
            'contract_no'         => 'required|max:45',
            'exlc_contract_no'    => 'required|max:45',
            'contract_qty'        => 'required|max:45',
            'contract_value'      => 'required|max:45'


        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
           $newsales= new SalesContract();
           $newsales->mr_buyer_b_id   = $request->buyer;
           $newsales->hr_unit_id      = $request->unit;
           $newsales->contract_no_by  = $request->contract_no;
           $newsales->lc_contract_no  = $request->exlc_contract_no;
           $newsales->contract_qty    = $request->contract_qty;
           $newsales->contract_value  = $request->contract_value;
           $newsales->elc_date        = $request->elc_date;
           $newsales->lc_contract_type= $request->lctype;
           $newsales->expiry_date     = $request->exp_date;
           $newsales->initial_value   = $request->initial_value;
           $newsales->currency_type   = $request->currency;
           $newsales->btb_bank_id     = $request->btb_bank;
           $newsales->remarks         = $request->remark;
           $newsales->lc_open_bank_id = $request->lc_bank;

           $newsales->save();
           $last_id = $newsales->id;


           if(!empty($request->order_id)){
             for($i=0; $i<sizeof($request->order_id); $i++)
              {
                  SalesContractOrder::insert([
                      'cm_sales_contract_id'     => $last_id,
                      'mr_order_entry_order_id'  => $request->order_id[$i]
                  ]);
              }
            }

          return back()
                ->with('success', "Contract Sales Saved Successfully !!!");
       }

    }
# Contract Sales list
    public function salesContractList(){

      $buyer=Buyer::pluck('b_name','b_id');
      $bank=Bank::pluck('bank_name','id');
      $country=Country::pluck('cnt_name','cnt_id');
      $unit=Unit::pluck('hr_unit_name','hr_unit_id');

    return view('commercial/export/salescontract/salescontract_list', compact('buyer','bank','unit'));

    }

# Contract Sales Data
    public function getData(){

      DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('cm_sales_contract AS co')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),

                "co.*",
                "b.b_name",
                "u.hr_unit_name"
            )

            ->leftJoin('mr_buyer AS b', 'b.b_id', '=', 'co.mr_buyer_b_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'co.hr_unit_id')
            ->orderBy('co.id', 'desc')
            ->get();


        return DataTables::of($data)

            ->editColumn('action', function ($data) {
                $return = "<div class=\"btn-group\">";

                    $return .= "<a href=".url('commercial/export/sales_contract/sales_contract_edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit Bulk\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>";

                    $return .= "<a href=".url('commercial/export/sales_contract/sales_contract_delete/'.$data->id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete Bulk\" onclick=\"return confirm('Are you sure?')\">
                        <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                    </a>";

                $return .= "</div>";

              return $return;
            })
            ->rawColumns([
                'serial_no',
                'action'
            ])
            ->toJson();

    }
# Edit form
    public function edit($id)
    {
      $buyer=Buyer::pluck('b_name','b_id');
      $bank=Bank::pluck('bank_name','id');
      $country=Country::pluck('cnt_name','cnt_id');
      $unit=Unit::pluck('hr_unit_name','hr_unit_id');
      $sales=SalesContract::where('id',$id)->first();

      //$sales_order=SalesContractOrder::where('cm_sales_contract_id',$id)->get();

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
            ->where('co.cm_sales_contract_id', $id)
            ->get();

      $orderLists = DB::table('mr_order_entry AS m')
            ->select(

                "m.order_code",
                "m.order_id",
                "m.order_qty",
                "b.agent_fob"

            )
            ->leftJoin('mr_order_bom_other_costing AS b', 'b.mr_order_entry_order_id', '=', 'm.order_id')

            ->where('m.mr_buyer_b_id', $sales->mr_buyer_b_id)
            ->where('m.unit_id', $sales->hr_unit_id)
            ->get();
//dd($sales_order);

      return view('commercial/export/salescontract/salescontract_edit', compact('buyer','bank','unit','sales','sales_order','orderLists'));
    }

# Sales Update action
    public function salesUpdate(Request $request){

        #------------------------------------------------#

       $validator= Validator::make($request->all(),[
            'buyer'               => 'required|max:11',
            'unit'                => 'required|max:11',
            'contract_no'         => 'required|max:45',
            'exlc_contract_no'    => 'required|max:45',
            'contract_qty'        => 'required|max:45',
            'contract_value'      => 'required|max:45'


        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            //dd($request->all());

           SalesContract::where('id', $request->con_id)->update([
             'mr_buyer_b_id'   => $request->buyer,
             'hr_unit_id'      => $request->unit,
             'contract_no_by'  => $request->contract_no,
             'lc_contract_no'  => $request->exlc_contract_no,
             'contract_qty'    => $request->contract_qty,
             'contract_value'  => $request->contract_value,
             'elc_date'        => $request->elc_date,
             'lc_contract_type'=> $request->lctype,
             'expiry_date'     => $request->exp_date,
             'initial_value'   => $request->initial_value,
             'currency_type'   => $request->currency,
             'btb_bank_id'     => $request->btb_bank,
             'remarks'         => $request->remark,
             'lc_open_bank_id' => $request->lc_bank
          ]);

         SalesContractOrder::where('cm_sales_contract_id', $request->con_id)->delete();

          for($i=0; $i<sizeof($request->order_id); $i++)
          {
              SalesContractOrder::insert([
                  'cm_sales_contract_id'     => $request->con_id,
                  'mr_order_entry_order_id'  => $request->order_id[$i]
              ]);
          }

          return back()
                ->with('success', "Contract Sales Updated Successfully !!!");
       }


    }

    public function salesDelete($id){
          SalesContract::where('id', $id)->delete();
          SalesContractOrder::where('cm_sales_contract_id', $id)->delete();

          return back()->with('success', 'Deleted Successfully');  
    }
}

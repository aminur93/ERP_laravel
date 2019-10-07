<?php

namespace App\Http\Controllers\Merch\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Merch\Brand;
use App\Models\Merch\Style;
use App\Models\Merch\Season;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\PurchaseOrder;
use App\Models\Merch\Reservation;
use App\Models\Merch\PoInseamSize;
use App\Models\Merch\PoSubStyle;
use App\Models\Merch\Country;
use App\Models\Merch\OrderBOM;
use App\Models\Merch\OrderBomCostingBooking;
use App\Models\Merch\OrderBomOtherCosting;
use App\Models\Merch\OrderOperationNCost;
use App\Models\Merch\OrdBomPlacement;
use App\Models\Merch\OrdBomGmtColor;
use App\Models\Merch\OrdBomItemColorMeasurement;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use DB, ACL, Validator,DataTables;
class OrderController extends Controller
{
	//Order List
	public function orderList()
    {
		$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
		$buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
		$brandList= Brand::pluck('br_name','br_id');
		$styleList= Style::pluck('stl_no', 'stl_id');
    	$seasonList= Season::pluck('se_name', 'se_id');
		return view("merch/orders/order_list", compact('unitList','buyerList','brandList','styleList','seasonList'));
	}
	//Order Entry List Data
	public function orderListData()
    {
		$data= DB::table('mr_order_entry AS OE')
                //->where('OE.order_status', "Active")
				->select([
					"OE.order_id",
					"OE.order_code",
					"u.hr_unit_name",
					"b.b_name",
					"br.br_name",
					"s.se_name",
					"stl.stl_no",
					"OE.order_ref_no",
					"OE.order_qty",
					"OE.order_delivery_date"
				])
				->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
				->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
                ->whereIn('b.b_id', auth()->user()->buyer_permissions())
				->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
				->leftJoin('mr_season AS s', 's.se_id', 'OE.mr_season_se_id')
				->leftJoin('mr_style AS stl', 'stl.stl_id', "OE.mr_style_stl_id")
				->orderBy('order_id', 'DESC')
				->get();
		return $this->orderListData_datatable($data);
	}

    //Order Entry List Data Datatable
    public function orderListData_datatable($data)
    {
        return DataTables::of($data)->addIndexColumn()
                ->addColumn('po', function($data){
                    $pos= DB::table('mr_purchase_order AS po')
                        ->where('mr_order_entry_order_id', $data->order_id)
                        ->select([
                            "po.*"
                        ])
                        ->get();
                    $poColumn="";
                    foreach ($pos as $po) {
                            $poColumn.='<p>'.$po->po_no .'</p>';
                    }
                    return $poColumn;
                })  
                ->addColumn('action', function ($data) {
                    $action_buttons= $this->orderListData_datatable_button($data);
                        return $action_buttons;
                    })
                ->rawColumns(['action', 'po'])
                ->toJson();
    }

    //Order Entry List Data Datatable Action Button
    public function orderListData_datatable_button($data)
    {
        $action_buttons= "<div class=\"btn-group\" style=\"width:55px\">  
                            <a href=".url('merch/orders/order_edit/'.$data->order_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
                                <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                            </a> 
                            <a href=".url('merch/orders/order_copy/'.$data->order_id)." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Copy Order\"  style=\"height:25px; width:26px;\"><i class=\"ace-icon fa fa-copy bigger-120\"></i>
                            </a>  
                            <a href=".url('merch/orders/purchase_order/'.$data->order_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Add Purachase Order\"  style=\"margin-top:1px; height:25px; width:26px;\"><i class=\"ace-icon fa fa-plus bigger-120\"></i>
                            </a>
                            <a href=".url('merch/orders/delete/'.$data->order_id)." class=\"btn btn-xs btn-danger\" onClick=\"return window.confirm('Are you sure?')\" title=\"Delete\" data-toggle=\"tooltip\" >
                              <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                            </a>";
        $action_buttons.= "</div>";
        return $action_buttons;
    }

	//Order Entry Form 
    public function orderEntry($id)
    {
    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
    	$buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
    	$po_list= PurchaseOrder::pluck('po_no', 'po_id');
    	$reseravtion= DB::table('mr_capacity_reservation AS cr')
    					->select(
    						'cr.*',
    						'u.hr_unit_name',
    						'b.b_name'
    					)
    					->where('res_id', $id)
    					->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'cr.hr_unit_id')
    					->leftJoin('mr_buyer AS b', 'b.b_id', 'cr.b_id')
    					->first();
        $reseravtion->res_month= date('F', mktime(0, 0, 0, $reseravtion->res_month, 10));
		$ordered= DB::table('mr_order_entry')
                    ->where('res_id', $reseravtion->res_id)
                    ->select(DB::raw("SUM(order_qty) AS sum"))
                    ->first();
        $reseravtion->res_quantity= $reseravtion->res_quantity- $ordered->sum;
    	$brandList= Brand::where('b_id', $reseravtion->b_id)->pluck('br_name','br_id');
        $style_order_type= "Bulk";
    	$styleList= Style::where('mr_buyer_b_id', $reseravtion->b_id)
                        ->where('stl_type', "=", $style_order_type)
                        ->pluck('stl_no', 'stl_id');
    	$seasonList= Season::where('b_id', $reseravtion->b_id)->pluck('se_name', 'se_id');		
    	return view('merch/orders/order_entry', compact('unitList', 'buyerList', 'po_list', 'reseravtion', 'brandList', 'styleList','seasonList'));
    }
    //Order Store
    public function orderStore(Request $request)
    {    	
    	$validator= Validator::make($request->all(),[
			  	"res_id" => "required|max:11",
			  	"unit_id" => "required|max:11",
			  	"mr_buyer_b_id" => "required|max:11",
			  	"mr_brand_br_id" => "max:11",
			  	"mr_season_se_id" => "required|max:11",
			  	"mr_style_stl_id" => "required|max:11",
			  	"order_ref_no" => "required|max:60",
			  	"order_qty" => "required|max:11",
			  	"order_delivery_date" => "required"
    	]);    	
    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with('error',"Incorrect Input!!");
    	} else {
            $unit_id= auth()->user()->unit_id();
            $order_month= date("m", strtotime($request->order_month));
            // Generate Order Code
            $reseravtion= DB::table('mr_capacity_reservation AS cr')
                            ->where('cr.res_id', $request->res_id)
                            ->select([
                                'u.hr_unit_name',
                                'b.b_name'
                            ])
                            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'cr.hr_unit_id')
                            ->leftJoin('mr_buyer AS b', 'b.b_id', 'cr.b_id')
                            ->first();
            $order_code = (new ShortCodeLib)::generate([
                'table'            => 'mr_order_entry',  
                'column_primary'   => 'order_id',  
                'column_shortcode' => 'order_code',  
                'first_letter'     => $reseravtion->hr_unit_name,        
                'second_letter'    => $reseravtion->b_name       
                ]);
            //... End of Order Code generate

    		$data= new OrderEntry();
    		$data->order_code = $order_code;
    		$data->res_id = $request->res_id;
    		$data->unit_id = $request->unit_id;
    		$data->mr_buyer_b_id = $request->mr_buyer_b_id;
    		$data->mr_brand_br_id = $request->mr_brand_br_id;
    		$data->mr_season_se_id = $request->mr_season_se_id;
    		$data->mr_style_stl_id = $request->mr_style_stl_id;
    		$data->order_ref_no = $request->order_ref_no;
    		$data->order_qty = $request->order_qty;
            $data->order_delivery_date = $request->order_delivery_date;

            // If user reloads the page, then it will redirect to purchase order page with last inserted Order Entry data
            $exists= OrderEntry::where('order_code', $request->order_code)->exists();
            if($exists){
            	$order_id= OrderEntry::where('order_code', $request->order_code)
            						->pluck('order_id')
            						->first();
            	return redirect("merch/orders/purchase_order/".$order_id)->with('error', 'Order already exists !');
            } else {
            	if($data->save()){
    				$order_id= $data->id;
		    		$this->logFileWrite("Order Created", $order_id);
		    		return redirect("merch/orders/order_edit/".$order_id)->with('success', 'Order Saved Successfully!');
	    		}
	    		else{
	    			return back()
	    				->withInput()
	    				->with("error", "error saving data!!");
	    		}
            }
    	}
    }

    //Order Edit 
    public function orderEdit($id)
    {
        $order= DB::table('mr_order_entry AS OE')
                    ->where('OE.order_id', $id)
                    ->select([
                        'OE.*',
                        'u.hr_unit_name',
                        'b.b_name',
                        'cr.res_quantity',
                        'cr.res_month',
                        'cr.res_year',
                    ])
                    ->leftJoin('mr_capacity_reservation AS cr', 'OE.res_id', 'cr.res_id')
                    ->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
                    ->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
                    ->whereIn('b.b_id', auth()->user()->buyer_permissions())
                    ->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
                    ->first();
        $order->res_month= date('F', mktime(0, 0, 0, $order->res_month, 10));
        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
        $buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
        $po_list= PurchaseOrder::pluck('po_no', 'po_id');
        $ordered= DB::table('mr_order_entry')
                    ->where('res_id', $order->res_id)
                    ->select(DB::raw("SUM(order_qty) AS sum"))
                    ->first();

        $order->res_quantity= $order->res_quantity- $ordered->sum;

        $brandList= Brand::where('b_id', $order->mr_buyer_b_id)->pluck('br_name','br_id');
        $style_order_type= "Bulk";
        $styleList= Style::where('mr_buyer_b_id', $order->mr_buyer_b_id)
                        ->where('stl_type', "=", $style_order_type)
                        ->pluck('stl_no', 'stl_id');
        $seasonList= Season::where('b_id', $order->mr_buyer_b_id)->pluck('se_name', 'se_id');

        //check whether BOM is created or not of this Order Id
        $isBom= OrderBOM::where('order_id', $id)->exists();

        return view('merch/orders/order_edit', compact('unitList', 'buyerList', 'po_list', 'order','brandList', 'styleList','seasonList', 'isBom'));
    }
    //Order Update
    public function orderUpdate(Request $request)
    {        
        OrderEntry::where('order_id', $request->order_id)
                    ->update([
                        'mr_brand_br_id' => $request->mr_brand_br_id,
                        'mr_season_se_id' => $request->mr_season_se_id,
                        'mr_style_stl_id' => $request->mr_style_stl_id,
                        'order_ref_no' => $request->order_ref_no,
                        'order_qty' => $request->order_qty,
                        'order_delivery_date' => $request->order_delivery_date
                    ]);
        $this->logFileWrite("Order Updated", $request->order_id);
        return back()->with("success", "Order updated Successfully!");
    }
    
    // Delete Style
    public function orderDelete($id)
    {
        
    // OrderEntry::where('order_id', $id)->delete();
    //  OrderBomCostingBooking::where('order_id', $id)->delete();
       
       $placement_id= OrdBomPlacement::where('order_id', $id)->first();
       if(!empty($placement_id)){
       $gmt_clr_id= OrdBomGmtColor::where('mr_ord_bom_placement_id', $placement_id->id)->findOrFail(); dd($placement_id);
       OrdBomPlacement::where('order_id', $id)->delete();
       OrdBomGmtColor::where('mr_ord_bom_placement_id', $placement_id->id)->delete();
       OrdBomItemColorMeasurement::where('mr_ord_bom_gmt_color_id', $gmt_clr_id->id)->delete();
           
       }
      
   //dd($placement_id);
       PurchaseOrder::where('mr_order_entry_order_id', $id)->delete();     

      return back()
        ->with('success', "Order Deleted Successfully!!");
    }   

    //Order Copy Form
    public function orderCopyForm($id)
    {
        $order= DB::table('mr_order_entry AS OE')
                ->where('OE.order_id', $id)
                ->select([
                    'OE.*',
                    'b.b_name',
                    'br.br_name',
                    'se.se_name',
                    'u.hr_unit_name',
                    'cr.res_month AS order_month',
                    'cr.res_year AS order_year',
                    'cr.res_quantity'
                ])
                ->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
                ->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
                ->whereIn('b.b_id', auth()->user()->buyer_permissions())
                ->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
                ->leftJoin('mr_season AS se', 'se.se_id', 'OE.mr_season_se_id')
                ->leftJoin('mr_capacity_reservation AS cr', 'cr.res_id', 'OE.res_id')
                ->first();
            $ordered= DB::table('mr_order_entry')
                    ->where('res_id', $order->res_id)
                    ->select(DB::raw("SUM(order_qty) AS sum"))
                    ->first();
                    
            $order->res_quantity= $order->res_quantity- $ordered->sum;
            $order->order_month= date('F', mktime(0, 0, 0, $order->order_month, 10));
            
        return view('merch/orders/order_copy', compact('order'));
    }
    //Order Copy Store
    public function orderCopyStore(Request $request)
    {
        //validate data
        $validator= Validator::make($request->all(),[
                "res_id" => "required|max:11",
                "unit_id" => "required|max:11",
                "mr_buyer_b_id" => "required|max:11",
                "mr_brand_br_id" => "max:11",
                "mr_season_se_id" => "required|max:11",
                "mr_style_stl_id" => "required|max:11",
                "order_ref_no" => "required|max:60",
                "order_qty" => "required|max:11",
                "order_delivery_date" => "required"
        ]);
        
        //If validator fails return with error message 
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('error',"Incorrect Input!!");
        } //else do copy
        else{

            $unit_name= Unit::where('hr_unit_id', $request->unit_id)->pluck('hr_unit_name')->first();
            $buyer_name= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->where('b_id', $request->mr_buyer_b_id)->pluck('b_name')->first();
            //Generate Order Code
            $order_code = (new ShortCodeLib)::generate([
                                'table'            => 'mr_order_entry',  
                                'column_primary'   => 'order_id',  
                                'column_shortcode' => 'order_code',  
                                'first_letter'     => $unit_name,        
                                'second_letter'    => $buyer_name       
                            ]);

            //Copy Order
            $unit_id= auth()->user()->unit_id();
            $order_month= date("m", strtotime($request->order_month));
            $data= new OrderEntry();
            $data->order_code = $order_code;
            $data->res_id = $request->res_id;
            $data->unit_id = $request->unit_id;
            $data->mr_buyer_b_id = $request->mr_buyer_b_id;
            $data->mr_brand_br_id = $request->mr_brand_br_id;
            $data->mr_season_se_id = $request->mr_season_se_id;
            $data->mr_style_stl_id = $request->mr_style_stl_id;
            $data->order_ref_no = $request->order_ref_no;
            $data->order_qty = $request->order_qty;
            $data->order_delivery_date = $request->order_delivery_date;
            if($data->save()){
                //alert message
                $ret_msg="Order coppied successfully";
           
                //new order id
                $new_order= $data->id;

                //log entry
                $this->logFileWrite("Order Copied", $new_order);

                //old(which the new order copied from) order id
                $old_order= $request->order_id;

                //Existing BOM checking
                $bomExists= OrderBOM::where('order_id', $old_order);

                //Existing Costing Checking
                $check_costing= OrderBOM::where('order_id', $old_order)
                                        ->where('bom_term', '!=', null)
                                        ->exists();

                //Make Success Messeage for return alert 
                if($bomExists->exists()){
                    $ret_msg.=" with BOM";
                }  
                if($check_costing) {
                    $ret_msg.=" and Costing";
                }
                
                //if bom exists then copy BOMS also for new order
                if($bomExists->exists()){                    
                    $boms= $bomExists->get();
                    //Save each BOM of the old Order for New Order
                    foreach($boms AS $bom){
                        $newBom= new OrderBOM();
                        $newBom->mr_style_stl_id    = $bom->mr_style_stl_id;
                        $newBom->mr_material_category_mcat_id = $bom->mr_material_category_mcat_id;
                        $newBom->mr_cat_item_id     = $bom->mr_cat_item_id;
                        $newBom->item_description   = $bom->item_description;
                        $newBom->clr_id             = $bom->clr_id;
                        $newBom->size               = $bom->size;
                        $newBom->mr_supplier_sup_id = $bom->mr_supplier_sup_id;
                        $newBom->mr_article_id      = $bom->mr_article_id;
                        $newBom->mr_composition_id  = $bom->mr_composition_id;
                        $newBom->mr_construction_id = $bom->mr_construction_id;
                        $newBom->uom                = $bom->uom;
                        $newBom->consumption        = $bom->consumption;
                        $newBom->extra_percent      = $bom->extra_percent;
                        $newBom->order_id           = $new_order;
                        
                        //If there is Costing and Copy Costing also
                        if($check_costing){
                            $newBom->bom_term = $bom->bom_term;
                            $newBom->precost_fob = $bom->precost_fob;
                            $newBom->precost_lc = $bom->precost_lc;
                            $newBom->precost_freight = $bom->precost_freight;
                            $newBom->precost_req_qty = $bom->precost_req_qty;
                            $newBom->precost_unit_price = $bom->precost_unit_price;
                            $newBom->precost_value = $bom->precost_value;
                        }

                        $newBom->save();
                        $show_id= $newBom->id;
                        //log entry
                        $this->logFileWrite("Order Copied", $show_id);

                    }
                    //check other costing
                    $other_costing= OrderBomOtherCosting::where('mr_order_entry_order_id', $old_order);

                    $operationCost= OrderOperationNCost::where('mr_order_entry_order_id', $old_order);
                    //Other Costing Copy is exists
                    if($check_costing && $other_costing->exists()){
                        $other= $other_costing->get();
                        foreach ($other as $otherCost) {
                            $newOther= new OrderBomOtherCosting();
                            $newOther= $otherCost;
                            $newOther->id= OrderBomOtherCosting::max('id')+1;
                            $newOther->mr_order_entry_order_id= $new_order;
                            $newOther->save();
                            //log entry
                            $this->logFileWrite("Order BOM Other Costing Copied", $newOther->id);
                        }
                    }

                    //Special Operations Costing Coppied if exists
                    if($check_costing && $operationCost->exists()){
                        $operation= $operationCost->get();
                        foreach ($operation as $spo) {
                            $newSpo= new OrderOperationNCost();
                            $newSpo->mr_style_stl_id =$spo->mr_style_stl_id;
                            $newSpo->mr_operation_opr_id =$spo->mr_operation_opr_id;
                            $newSpo->opr_type =$spo->opr_type;
                            $newSpo->uom =$spo->uom;
                            $newSpo->unit_price =$spo->unit_price;
                            $newSpo->mr_order_entry_order_id =$new_order;
                            
                            $newSpo->save();
                            //log entry
                            $this->logFileWrite("Order BOM Special Operation Costing Copied", $newSpo->id);
                        }
                    }
                }
                
                $ret_msg.="!";
                //If BOM exists then copy BOMS for new order
                return redirect("merch/orders/order_list")->with('success', $ret_msg);
            }
            else{
                return back()
                    ->withInput()
                    ->with("error", "error saving data!!");
            }
        }
    }

    //Purchase Order Entry
    public function poEntry($order_id)
    {
    	$data= DB::table('mr_order_entry AS OE')
				->where('OE.order_id', $order_id)
				->select([
					'OE.*',
					'b.b_name',
					'br.br_name',
					'se.se_name',
					'u.hr_unit_name',
					'cr.res_month AS order_month',
					'cr.res_year AS order_year'
				])
				->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
				->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
                ->whereIn('b.b_id', auth()->user()->buyer_permissions())
				->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
				->leftJoin('mr_season AS se', 'se.se_id', 'OE.mr_season_se_id')
				->leftJoin('mr_capacity_reservation AS cr', 'cr.res_id', 'OE.res_id')
				->first();
        $colorGroupSizeList = DB::table('mr_order_entry AS a')
                            ->where(['a.order_id' => $order_id])
                            ->leftJoin('mr_stl_size_group AS b','a.mr_style_stl_id', 'b.mr_style_stl_id')
                            ->leftJoin('mr_product_size AS c', 'b.mr_product_size_group_id', 'c.mr_product_size_group_id')
                            ->leftJoin('mr_product_size_group AS d', 'b.mr_product_size_group_id', 'd.id')
                            ->select([
                                'd.id AS size_grp_id',
                                'd.size_grp_name',
                                'c.mr_product_pallete_name',
                                'c.id AS size_id'
                            ])
                            ->get();
        foreach($colorGroupSizeList as $k=>$colorGroupSize) {
            $colorGroupSizeList_n[$colorGroupSize->size_grp_name][] = $colorGroupSize;
        }
		$countryList= Country::pluck('cnt_name', 'cnt_id');
		$colorList= DB::table('mr_material_color')
						->pluck('clr_name', 'clr_id')
						->toArray();
		$poList= DB::table('mr_purchase_order AS po')
						->select([
							'po.*',
							'oe.order_code',
							'c.cnt_name'
						])
                        ->where('po.mr_order_entry_order_id', $order_id)
						->leftJoin('mr_order_entry AS oe', 'oe.order_id', 'po.mr_order_entry_order_id')
						->leftJoin('mr_country AS c', 'c.cnt_id', 'po.po_delivery_country')
						->get();
        $total_po = $this->get_total_po($order_id);
        // Check whether BOM created or not
         $isBom= OrderBOM::where('order_id', $order_id)->exists();

		return view('merch/orders/purchase_order',compact('data', 'countryList', 'colorList', 'poList', 'total_po', 'isBom', 'colorGroupSizeList','colorGroupSizeList_n'));
    }

    //generate sub style according size group and sizes Generate table row
    public function generateSubStyle_tableRow($szg, $size, $clr_name, $color)
    {
        $data = '<tr>
                    <td style="margin: 0px; padding: 0px;">
                        <input type="text" id="size_group" name="size_group[]" placeholder="Size Group" class="form-control" style="width: 100%;" value="'.$szg->size_grp_name.'" readonly/>
                        <input type="hidden" name="size_group_id[]" value="'. $szg->id.'"></input>
                    </td>
                    <td style="margin: 0px; padding: 0px;">
                        <input type="text" name="mr_product_size[]" id="mr_product_size" placeholder="Size" class="form-control" style="width: 100%;" value="'.$size->mr_product_pallete_name.'" readonly/>
                        <input type="hidden" name="mr_product_size_id[]" value="'. $size->id.'"></input>
                    </td>
                    <td style="margin: 0px; padding: 0px;">
                        <input type="text" name="clr_id[]" id="clr_id" placeholder="Color" class="form-control" style="width: 100%;" value="'.$clr_name.'" readonly/>
                        <input type="hidden" name="mr_product_color[]" value="'. $color.'"></input>
                    </td>   

                    <td style="margin: 0px; padding: 0px;">
                        <input type="text" name="po_sub_style_qty[]" id="po_sub_style_qty" placeholder="PO Quantity" class="form-control subStleQtyCalc" style="width: 100%;" data-validation="length number" data-validation-length="0-11" value="0"/>
                    </td>
                    <td style="margin: 0px; padding: 0px;">
                        <input type="date" name="po_sub_style_deliv_date[]" id="po_sub_style_deliv_date" style="width: 100%;" class="form-control"  value="'.$date.'"/>
                    </td>
                </tr>';
        return $data;
    }

    //generate sub style according size group and sizes
    public function generateSubStyle(Request $request)
    {
        if (!is_array($request->selected_colors) || sizeof($request->selected_colors) ==0) return "false";
    	$date= date('Y-m-d', strtotime(!empty($request->po_ex_fty)?$request->po_ex_fty: date('Y-m-d') ));

        $sizeGroup= DB::table('mr_stl_size_group AS ssg')
                            ->select([
                                "ssg.*",
                                "psg.*"
                            ])
                            ->where('ssg.mr_style_stl_id', $request->style_id)
                            ->leftJoin('mr_product_size_group as psg', 'psg.id', 'ssg.mr_product_size_group_id')
                            ->get();
    	// $sizeGroup= DB::table('mr_product_size_group')
    	// 			->where('b_id', $request->b_id)
    	// 			->where('br_id', $request->br_id)
        //          ->whereIn('id', $styleSizeGroup)
    	// 			->get();

    	$data="";
    	foreach ($sizeGroup as $szg) {
    		$sizes= DB::table('mr_product_size')
    					->where('mr_product_size_group_id', $szg->mr_product_size_group_id)
    					->get();
               
	    	foreach ($sizes as $size) {
	    		foreach ($request->selected_colors as $color) {
	    			$clr_name= DB::table('mr_material_color')
							->where('clr_id', $color)
							->pluck('clr_name')
							->first();
					$data.= $this->generateSubStyle_tableRow($szg, $size, $clr_name, $color);
	    		}
	    	}
    	}
    	return $data;
    }
    // Purchase Order Store
    public function poStore(Request $request)
    {        
    	$validator= Validator::make($request->all(),[
    		'order_id_for_po' => 'required|max:11',
    		'po_number' => 'required|max:45',
    		'po_qty' => 'required|max:11',
    		'po_ex_fty' => 'required',
    		'po_delivery_country' => 'required|max:11'
    	]);
    	if($validator->fails()){
    		return redirect("merch/orders/purchase_order/".$request->order_id_for_po)
    					->withInput()
    					->with('error', 'Incorrect Input');
    	} else {
    		//Store Purachase Order
    		$po= new PurchaseOrder();
    		$po->mr_order_entry_order_id = $request->order_id_for_po; 
    		$po->po_no = $request->po_number; 
    		$po->po_qty = $request->po_qty; 
    		$po->po_ex_fty = $request->po_ex_fty; 
            $po->po_delivery_country = $request->po_delivery_country; 
            $po->country_fob = $request->country_fob; 
    		$po->remarks = $request->po_remarks; 
    		$po->save();
    		//get Last inserted Purchase order id
    		$po_id= $po->id;

            $this->logFileWrite("Purchase Order Created", $po_id);

    		//store inseam and size
            if (is_array($request->po_inseam)){
        		for($i= 0; $i<sizeof($request->po_inseam); $i++){
        			$inseamSize= new PoInseamSize();
        			$inseamSize->po_inseam = $request->po_inseam[$i];
        			$inseamSize->po_size = $request->po_size[$i];
        			$inseamSize->mr_purchase_order_po_id = $po_id;
        			$inseamSize->save();
                    $this->logFileWrite("Inseam And Size Created", $inseamSize->id);
        		}
            }
    		//Store PO sub style Details
            if (is_array($request->mr_product_color)){
        		for($i=0; $i<sizeof($request->mr_product_color); $i++){
        			$po_sub_style= new PoSubStyle();
        			$po_sub_style->po_id = $po_id;
        			$po_sub_style->clr_id = $request->mr_product_color[$i];
        			$po_sub_style->po_sub_style_qty = $request->po_sub_style_qty[$i];
        			$po_sub_style->po_sub_style_deliv_date = $request->po_sub_style_deliv_date[$i];
        			$po_sub_style->save();
                    $this->logFileWrite("Purachase Order Sub Style Created", $po_sub_style->id);
        		}
            }
    		return redirect("merch/orders/purchase_order/".$request->order_id_for_po)
    					->with('success', 'Purchase Order Saved Successfully!');
    	}
    }
    // Purchase Order Delete
    public function poDelete($order_id, $po_id)
    {
        // Delete existing PO Sub Styles
        PoSubStyle::where('po_id', $po_id)->delete();
        // Delete existing Inseams and Sizes
        PoInseamSize::where('mr_purchase_order_po_id', $po_id)->delete();
        // Delete purchase order
    	PurchaseOrder::where('po_id', $po_id)->delete();
        $this->logFileWrite("Purachase Order Deleted", $po_id);
    	return redirect("merch/orders/purchase_order/".$order_id)
    					->with('success', 'Purchase Order Deleted Successfully!');
    }

    //Return total po
    public function get_total_po($order_id) 
    {
        $total_po = PurchaseOrder::where('mr_order_entry_order_id', $order_id)
                                ->select(DB::raw("SUM(po_qty) AS sum_po"))->first();
        return $total_po->sum_po;         
    }

    //Edit data of Purchase order of oder inseam
    public function poEdit_inseam($inseam = '')
    {
        if($inseam) {
            $inseamData = '<div class="form-group col-sm-6" style="margin-bottom: 15px;">
                            <label class="col-sm-3 control-label no-padding-right" style="font-size: 10px;" for="po_number"> Inseam &amp; Size<span style="color: red">*</span> </label>
                            <div class="col-sm-7" style="padding-left: 0;">
                                <input type="text" id="po_inseam" name="po_inseam[]" class="col-xs-6" value="'. $inseam->po_inseam .'" placeholder="Inseam"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;"/>
                                <input type="text" id="po_size" name="po_size[]" class="col-xs-6" value="'. $inseam->po_size .'" placeholder="Size"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;"/>
                            </div>
                            <div class="col-sm-2" style="padding-left: 0; padding-right: 0;">
                                <button style="width: 25px;height: 29px;margin: 0px;padding: 0px;" type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                <button style="width: 25px; height: 29px; margin: 0px; padding: 0px;" type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                            </div>
                        </div>';
        } else {
            $inseamData ='<div class="form-group col-sm-6" style="margin-bottom: 15px;">
                            <label class="col-sm-3 control-label no-padding-right" style="font-size: 10px;" for="po_number"> Inseam &amp; Size<span style="color: red">*</span> </label>
                            <div class="col-sm-7" style="padding-left: 0;">
                                <input type="text" id="po_inseam" name="po_inseam[]" class="col-xs-6" placeholder="Inseam"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;"/>
                                <input type="text" id="po_size" name="po_size[]" class="col-xs-6" placeholder="Size"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;"/>
                            </div>
                            <div class="col-sm-2" style="padding-left: 0; padding-right: 0;">
                                <button style="width: 25px;height: 29px;margin: 0px;padding: 0px;" type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                <button style="width: 25px; height: 29px; margin: 0px; padding: 0px;" type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                            </div>
                        </div>';
        }
        return $inseamData;
    }

    //Edit data of Purchase order of table row
    public function poEdit_tableRow($tr_id, $poSub)
    {
        $data = '<tr id="color_'.$poSub->clr_id.'">
                    <td>
                        <input type="text" name="clr_id[]" id="clr_id" value="'.$poSub->clr_name.'" tabindex = "-1" readonly/>
                        <input type="hidden" name="mr_product_color[]" value="'. $poSub->clr_id.'"></input>
                    </td>   
                    
                    <td>
                        <input type="text" name="po_sub_style_qty[]" class="subStleQtyCalcEdit" data-validation="length number" data-validation-length="0-11" value="'.$poSub->po_sub_style_qty.'"/>
                    </td>
                    <td>
                        <input type="text" name="po_sub_style_deliv_date[]" class="close-datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="'.$poSub->po_sub_style_deliv_date.'"/>
                    </td>
                </tr>';
        return $data;
    }

    //Edit data of Purchase order of oder
    public function poEdit(Request $request)
    {
        $countryList = Country::select('cnt_name', 'cnt_id')->get();
        $purchase_order = PurchaseOrder::where('po_id', $request->po_id)->first();
        $cnt_dropdown = "";
        $total_po = $this->get_total_po($request->order_id);
        foreach ($countryList as $country) {
            $cnt_dropdown.= "<option value=\"$country->cnt_id\"";
            if($country->cnt_id== $purchase_order->po_delivery_country) {
                $cnt_dropdown.= "selected"; 
            }
            $cnt_dropdown.=">$country->cnt_name</option>";
        }
        $data = '<div class="row col-sm-12" id="edit_po_section">
                        <div class="col-sm-4">
                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_number"> PO Number<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="po_number" name="po_number" class="form-control" placeholder="PO Number" value="'.$purchase_order->po_no .'" data-validation="required custom length" data-validation-length="1-20" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                        <input type="hidden" name="po_id" value="'. $purchase_order->po_id .'">
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_qty_edit">Total PO Quantity<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="po_qty_edit" name="po_qty_edit" class="form-control po_qty_edit" placeholder="Total PO Quantity" value="'. $purchase_order->po_qty .'" data-validation="required number length" data-validation-length="1-11"/>
                                    <input type="hidden" id="old_po_qty" name="old_po_qty" value="'.$purchase_order->po_qty.'">
                                    <input type="hidden" name="ordered_po" value="'.$total_po.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_remarks"> PO Remarks</label>
                                <div class="col-sm-8">
                                    <textarea name="po_remarks" id="po_remarks" class="form-control" placeholder="PO Remarks"  data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" data-validation-optional="true" style="height: 34px; width: 168px;" value="">'. $purchase_order->remarks .'</textarea>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="country_fob">Country FOB</label>
                                <div class="col-sm-8">
                                    <input type="text" id="country_fob" name="country_fob" class="form-control" placeholder="Country FOB" data-validation="custom" value="'.$purchase_order->country_fob.'" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_delivery_country">Del. Country<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                <select name="po_delivery_country" id="po_delivery_country" style="width: 160px;" class="form-control no-select" data-validation="required">
                                    <option value="">Delivery Country</option>'.$cnt_dropdown.'
                                </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;" >
                                <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_ex_fty">Ex-Fty Date<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="po_ex_fty" name="po_ex_fty" value="'. date("Y-m-d", strtotime($purchase_order->po_ex_fty)) .'" class="form-control close-datepicker" placeholder="Ex-Fty Date" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off"  data-validation="required"/>
                                </div>
                            </div>
                        </div>
                    </div>';
            $inseamList= PoInseamSize::where('mr_purchase_order_po_id', $request->po_id)->get();
            $inseamData='<div class="row col-sm-12" id="inseam_size_for_edit">';
            if($inseamList->isNotEmpty()){
                foreach ($inseamList as $inseam) {
                    $inseamData.= $this->poEdit_inseam($inseam);
                }
            } else {
                $inseamData.= $this->poEdit_inseam();
            }
            $inseamData.='</div><hr>';
            $colorList= DB::table('mr_material_color')
                        ->select('clr_name', 'clr_id')
                        ->get();

            $data.=$inseamData;
            $colorGroupSizeList = DB::table('mr_order_entry AS a')
                            ->where(['a.order_id' => $request->order_id])
                            ->leftJoin('mr_stl_size_group AS b','a.mr_style_stl_id', 'b.mr_style_stl_id')
                            ->leftJoin('mr_product_size AS c', 'b.mr_product_size_group_id', 'c.mr_product_size_group_id')
                            ->leftJoin('mr_product_size_group AS d', 'b.mr_product_size_group_id', 'd.id')
                            ->select([
                                'd.id AS size_grp_id',
                                'd.size_grp_name',
                                'c.mr_product_pallete_name',
                                'c.id AS size_id'
                            ])
                            ->get();
            foreach($colorGroupSizeList as $k=>$colorGroupSize) {
                $colorGroupSizeList_n[$colorGroupSize->size_grp_name][] = $colorGroupSize;
            }
            $poSubStyleList= DB::table('mr_po_sub_style AS Sub')
                                ->where('Sub.po_id', $request->po_id)
                                ->select([
                                    'Sub.*',
                                    'sg.size_grp_name',
                                    'sz.mr_product_pallete_name',
                                    'clr.clr_name'
                                ])
                                ->leftJoin('mr_product_size_group AS sg', 'sg.id', 'Sub.size_group_id')
                                ->leftJoin('mr_product_size AS sz', 'sz.id', 'Sub.mr_product_size_id')
                                ->leftJoin('mr_material_color AS clr', 'clr.clr_id', 'Sub.clr_id')
                                ->get();
            $data.= view("merch/orders/ajax_po_color_size_edit", compact('colorList','colorGroupSizeList_n','poSubStyleList'))->render();
            $SelectedColors= DB::table('mr_po_sub_style')
                                ->where('po_id', $request->po_id)
                                ->pluck(DB::raw('DISTINCT clr_id'))
                                ->toArray();
            
            $color_select='<div class="row" id="color_add">
                        <div class="control-group">'; 
            foreach ($colorList as $color){
                $checked="";
                if(in_array($color->clr_id, $SelectedColors)) $checked="Checked";
                $color_select.='<div class="checkbox col-xs-2" style="margin-bottom: 10px;">
                <label>
                    <input class="po_color_select_edit" name="po_color_select_edit[]" type="checkbox" value="'.$color->clr_id.'" class="ace" data-validation="checkbox_group" data-validation-qty="min1" '. $checked .'>
                    <span class="lbl">'.$color->clr_name.'</span>
                </label>
            </div>'; 
            }
            $color_select.='</div>
                       </div>
                        <div class="row widget-header text-right" style="margin-bottom: 15px;">
                                <button type="button" class="btn btn-xs btn-primary" id="size_chart_generate_edit">Generate Size Chart</button>
                        </div>';

            //$data.=$color_select;
            $sub_style_code= '<div class="row" id="addColorSizeGroupTableEdit">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #2C6AA0">
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Del Date</th>
                            </thead>
                            <tbody id="addRemoveEdit">';            
            foreach ($poSubStyleList as $poSub) {
                $tr_id = $poSub->clr_name.'_'.$poSub->mr_product_size_id.'_'.$poSub->mr_product_pallete_name.'_edit';
                $sub_style_code.= $this->poEdit_tableRow($tr_id, $poSub);
            }
            $sub_style_code.='
                            </tbody>
                        </table>
                    </div>';
            $data.= $sub_style_code;
        return $data;
    }

    //PO Update Inseam
    public function poUpdate_inseam($request)
    {
        if (is_array($request->po_inseam)){
            for($i= 0; $i<sizeof($request->po_inseam); $i++){
                $inseamSize= new PoInseamSize();

                $inseamSize->po_inseam = $request->po_inseam[$i];
                $inseamSize->po_size = $request->po_size[$i];
                $inseamSize->mr_purchase_order_po_id = $request->po_id;
                $inseamSize->save();
                //Keep Log
                $this->logFileWrite("Inseam And Size Created", $inseamSize->id);
            }
        }
    }

    //PO Update sub style Details
    public function poUpdate_color($request)
    {
        if(is_array($request->mr_product_color)){
            for($i=0; $i<sizeof($request->mr_product_color); $i++){
                $po_sub_style= new PoSubStyle();
                $po_sub_style->po_id = $request->po_id;
                $po_sub_style->clr_id = $request->mr_product_color[$i];
                $po_sub_style->po_sub_style_qty = $request->po_sub_style_qty[$i];
                $po_sub_style->po_sub_style_deliv_date = $request->po_sub_style_deliv_date[$i];
                $po_sub_style->save();
                //Keep Log
                $this->logFileWrite("Purachase Order Sub Style Created", $po_sub_style->id);
            }
        }
    }

    //PO Update
    public function poUpdate(Request $request) 
    {
        $validator= Validator::make($request->all(),[
            'po_id' => 'required|max:11',
            'order_id_for_po' => 'required|max:11',
            'po_number' => 'required|max:45',
            'po_qty_edit' => 'required|max:11',
            'po_ex_fty' => 'required',
            'po_delivery_country' => 'required|max:11'
        ]);
        if($validator->fails()){
            return redirect("merch/orders/purchase_order/".$request->order_id_for_po)
                        ->withInput()
                        ->with('error', 'Incorrect Input');
        } else {
            //Update Purchase Order
            PurchaseOrder::where('po_id', $request->po_id)
                        ->update([
                            'po_no' => $request->po_number,
                            'po_qty' => $request->po_qty_edit,
                            'po_ex_fty' => $request->po_ex_fty,
                            'po_delivery_country' => $request->po_delivery_country,
                            'country_fob' => $request->country_fob,
                            'remarks' => $request->po_remarks
                        ]);
            //Keep Log
            $this->logFileWrite("Purchase Order Updated", $request->po_id);

            //Delete existing Inseams and Sizes
            PoInseamSize::where('mr_purchase_order_po_id', $request->po_id)->delete();
            //Keep Log
            $str= "Inseams and Sizes of Purachse Order". $request->po_id. "Deleted";
            $this->logFileWrite($str, $request->po_id);

            //store inseam and size
            $this->poUpdate_inseam($request);
            //Delete existing PO Sub Styles
            PoSubStyle::where('po_id', $request->po_id)->delete();
            //Keep Log
            $str= "Sub style of Purchase Order". $request->po_id. "Deleted";
            $this->logFileWrite($str, $request->po_id);

            //Store PO sub style Details
            $this->poUpdate_color($request);
            return redirect("merch/orders/purchase_order/".$request->order_id_for_po)
                        ->with('success', 'Purchase Order Updated Successfully!');
        }
    }
    //Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

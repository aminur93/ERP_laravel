<?php

namespace App\Http\Controllers\Merch\OrderBooking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit; 
use App\Models\Merch\Buyer; 
use App\Models\Merch\Brand;
use App\Models\Merch\Style; 
use App\Models\Merch\Season;
use App\Models\Merch\OrderBOM;
use App\Models\Merch\BomOtherCosting;
use App\Models\Merch\OrderBomOtherCosting;
use App\Models\Merch\OrderOperationNCost;
use DB,Validator, ACL, DataTables, Form;
class OrderBookingController extends Controller
{
    public function showList(){
    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
		$buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
		$brandList= Brand::pluck('br_name','br_id');
		$styleList= Style::pluck('stl_no', 'stl_id');
    	$seasonList= Season::pluck('se_name', 'se_id');
    	return view("merch.order_booking.order_booking_list", compact('buyerList', 'seasonList', 'unitList', 'brandList', 'styleList'));
    }
    public function getListData(){

        $orders = DB::table('mr_order_entry as moe')
            ->select(
                "moe.order_id",
                "moe.order_code",
                "hu.hr_unit_name",
                "mb.b_name",
                "mbr.br_name",
                "ms.se_name",
                "mstl.stl_no",
                "moe.order_qty",
                "moe.order_delivery_date"
            )
            ->leftJoin("hr_unit AS hu", "hu.hr_unit_id", "=",  "moe.unit_id")
            ->leftJoin("mr_buyer As mb", "mb.b_id","=","moe.mr_buyer_b_id")
            ->leftJoin("mr_brand As mbr", "mbr.br_id","=", "moe.mr_brand_br_id")
            ->leftJoin("mr_season As ms","ms.se_id","=","moe.mr_season_se_id")
            ->leftJoin("mr_style As mstl", "mstl.stl_id","=","moe.mr_style_stl_id")
            ->orderBy('moe.order_id','desc')
            ->get();
        //dd($orders);exit;


        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('action', function ($orders) {
                $return = "<div class=\"btn-group\">";
//                if(!empty($dd)){
                    $return .= "
                                  <a href=".url('merch/order_booking_edit/'.$orders->order_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                                 <i class=\"ace-icon fa fa-edit \"></i>
                                  </a>
                                  ";
//                }else{
//                    $return .= "<a href=".url('merch/order_breakdown/show/'.$orders->order_id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\">
//                                 <i class=\"ace-icon fa fa-plus \"></i>
//                                  </a>
//
//                                  ";
//                }



                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action'
            ])

            ->make(true);
    }

    public function edit($id)
    {
        $order = DB::table('mr_order_entry')
            ->join('hr_unit','mr_order_entry.unit_id','=','hr_unit.hr_unit_id')
            ->join('mr_buyer','mr_order_entry.mr_buyer_b_id','=','mr_buyer.b_id')
            ->join('mr_brand','mr_order_entry.mr_brand_br_id','mr_brand.br_id')
            ->join('mr_season','mr_order_entry.mr_season_se_id','=','mr_season.se_id')
            ->join('mr_style','mr_order_entry.mr_style_stl_id','=','mr_style.stl_id')
            ->where('mr_order_entry.order_id',$id)
            ->first();


        $order_break = DB::table('mr_order_detail_n_booking')
            //->groupBy('mr_order_detail_n_booking.mr_material_color_clr_id')
            ->select(
                "mr_order_detail_n_booking.*",
                "mr_order_bom_costing_booking.item_description",
                "mr_order_bom_costing_booking.consumption",
                "mr_order_bom_costing_booking.extra_percent",
                "mr_order_bom_costing_booking.uom",
                "mr_order_bom_costing_booking.precost_unit_price",
                "mr_order_bom_costing_booking.order_id",
                "mr_order_bom_costing_booking.mr_cat_item_id",
                "mr_order_bom_costing_booking.mr_material_category_mcat_id",
                "mr_material_category.mcat_name",
                "mr_cat_item.item_name",
                "mr_cat_item.item_code",
                "mr_cat_item.dependent_on",
                "mr_supplier.sup_name",
                "mr_article.art_name",
                "mr_composition.comp_name",
                "mr_construction.construction_name",
                "mr_material_color.clr_name",
                "mr_material_color.clr_id"
            )

            ->leftJoin('mr_material_color','mr_order_detail_n_booking.mr_material_color_clr_id','=','mr_material_color.clr_id')

            ->leftJoin('mr_order_bom_costing_booking','mr_order_detail_n_booking.mr_order_bom_costing_booking_id','=','mr_order_bom_costing_booking.id')

            ->leftJoin('mr_material_category','mr_order_bom_costing_booking.mr_material_category_mcat_id','=','mr_material_category.mcat_id')

            ->leftJoin('mr_cat_item','mr_order_bom_costing_booking.mr_cat_item_id','=','mr_cat_item.id')

            ->leftJoin('mr_supplier','mr_order_bom_costing_booking.mr_supplier_sup_id','=','mr_supplier.sup_id')

            ->leftJoin('mr_article','mr_order_bom_costing_booking.mr_article_id','=','mr_article.id')

            ->leftJoin('mr_composition','mr_order_bom_costing_booking.mr_composition_id','=','mr_composition.id')

            ->leftJoin('mr_construction','mr_order_bom_costing_booking.mr_construction_id','=','mr_construction.id')

            ->where('mr_order_detail_n_booking.mr_order_entry_order_id',$id)
            ->get()
            ->toArray();

        $catRow = array_column($order_break, 'item_name');
        $vals = array_count_values($catRow);
        //echo "<pre>"; print_r($vals);exit;

        $colors = DB::table('mr_order_entry')
            ->groupBy('mr_material_color.clr_name')
            ->selectRaw('sum(mr_po_sub_style.po_sub_style_qty) as sum, mr_material_color.clr_name as clr_name, mr_material_color.clr_id')
            //->select( "mr_order_entry.order_id as id", 'mr_material_color.clr_name', 'mr_po_sub_style.po_sub_style_qty')

            ->leftJoin('mr_purchase_order','mr_order_entry.order_id','=','mr_purchase_order.mr_order_entry_order_id')
            ->leftJoin('mr_po_sub_style','mr_purchase_order.po_id','=','mr_po_sub_style.po_id')
            ->leftJoin('mr_material_color','mr_po_sub_style.clr_id','=','mr_material_color.clr_id')
            ->where('mr_order_entry.order_id',$id)
            ->get();
        //dd($colors);exit;


        return view('merch.order_booking.order_bookingEdit',
            compact('order','boms','colors','purchase','sizes','groupedByValue','care_label',
                'filter','order_break','vals','filters'));
    }

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            //dd($data);exit;

            $orders = DB::table('mr_order_detail_n_booking')->get();
            //dd($order);exit;
            $order = [];
            $input = $request->all();

            for($i=0; $i<sizeof($orders); $i++){

                //dd($request->items);exit;
                if(isset($input['bom_costing_booking_id-'.$i])) {
                    $mr_order_id = $input['id-'.$i];
                    $bom_id = $input['bom_costing_booking_id-'.$i];
                    $order_id = $input['order_entry_order_id-'.$i];
                    $cat_id = $input['cat_item_id-'.$i];
                    $cat_mcat = $input['cat_item_mcat_id-'.$i];

                    for ($k=0; $k<sizeof($bom_id); $k++)
                    {
                        $order['id'] = $mr_order_id[$k];
                        $order['mr_order_bom_costing_booking_id'] = $bom_id[$k];
                        $order['mr_order_entry_order_id'] = $order_id[$k];
                        $order['mr_cat_item_id'] = $cat_id[$k];
                        $order['mr_cat_item_mcat_id'] = $cat_mcat[$k];
                    }

                }

                if (isset($input['clr_id-' . $i])) {
                    $mr_order_id = $input['id-'.$i];
                    $color = $input['clr_id-' . $i];
                    $qtys = $input['qty-'.$i];
                    $req_qty = $input['req_qty-' . $i];

                    for ($j = 0; $j < sizeof($color); $j++) {
                        //dd($color);exit;
                        $order['id'] = $mr_order_id[$j];
                        $order['mr_material_color_clr_id'] = $color[$j];
                        $order['qty'] = $qtys[$j];
                        $order['req_qty'] = $req_qty[$j];
                        $data [] = $order;
                        DB::table('mr_order_detail_n_booking')->where('id',$mr_order_id)->update($order);
                    }

                }

                if (isset($input['sizer-'.$i]))
                {
                    $mr_order_id = $input['id-'.$i];
                    $sizes = $input['sizer-'.$i];
                    $sqs = $input['size_qtyss-'.$i];
                    $req_qtys = $input['req_qtyr-'.$i];

                    for($c=0; $c < sizeof($sizes); $c++)
                    {
                        $order['id'] = $mr_order_id[$c];
                        $order['size'] = $sizes[$c];
                        $order['qty'] = $sqs[$c];
                        $order['req_qty'] = $req_qtys[$c];
                        $data [] = $order;
                        DB::table('mr_order_detail_n_booking')->where('id',$mr_order_id)->update($order);
                    }
                }


                if(isset($input['s_qtyss-'.$i]))
                {
                    $mr_order_id = $input['id-'.$i];
                    $sizess = $input['sizes-' . $i];
                    $yqs = $input['s_qtyss-'.$i];
                    $colors = $input['clr_ids-'.$i];
                    $req_qtyes = $input['req_qtys-' . $i];


                    for ($z = 0; $z < sizeof($colors); $z++) {
                        $order['id'] = $mr_order_id[$z];
                        $order['mr_material_color_clr_id'] = $colors[$z];
                        $order['size'] = $sizess[$z];
                        $order['qty'] = $yqs[$z];
                        $order['req_qty'] = $req_qtyes[$z];

                        $data [] = $order;
                        DB::table('mr_order_detail_n_booking')->where('id',$mr_order_id)->update($order);
                    }

                }

                if(isset($input['booking_qty-'.$i]))
                {
                    $b_qty = $input['booking_qty-'.$i];

                    for ($a=0; $a<sizeof($b_qty); $a++)
                    {
                        $order['booking_qty'] = $b_qty[$a];

                        $data [] = $order;
                        DB::table('mr_order_detail_n_booking')->where('id',$mr_order_id)->update($order);
                    }
                }

                if(isset($input['delivery_date-'.$i]))
                {
                    $d_date = $input['delivery_date-'.$i];

                    for ($b=0; $b<sizeof($d_date); $b++)
                    {
                        $order['delivery_date'] = $d_date[$b];

                        $data [] = $order;
                        DB::table('mr_order_detail_n_booking')->where('id',$mr_order_id)->update($order);
                    }
                }

            }

            return back()->with('success', "Order Break Down Information Successfully Updated!!!");
        }
    }


    public function showForm(Request $request)
    {

    	$order_id = $request->id;
    	//order info
    	$order= DB::table('mr_order_entry AS OE')
    				->where('OE.order_id', $order_id)
    				->select([
						"OE.order_id",
						"OE.order_code",
						"u.hr_unit_name",
						"b.b_name",
						"br.br_name",
						"s.se_name",
						"stl.stl_no",
						"OE.mr_style_stl_id",
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
					->first();
			
		$id= $order->mr_style_stl_id;
        //sampleTypes
	    $samples = DB::table("mr_stl_sample AS ss")
	    	->select(DB::raw("GROUP_CONCAT(st.sample_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_sample_type AS st", "st.sample_id", "ss.sample_id")
	    	->where("ss.stl_id", $id)
	    	->first();

        //operations
	    $operations = DB::table("mr_style_operation_n_cost AS oc")
	    	->select("o.opr_name")
	    	->select(DB::raw("GROUP_CONCAT(o.opr_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_operation AS o", "o.opr_id", "oc.mr_operation_opr_id")
	    	->where("oc.mr_style_stl_id", $id)
	    	->first();

        //machines
	    $machines = DB::table("mr_style_sp_machine AS sm")
	    	->select(DB::raw("GROUP_CONCAT(m.spmachine_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_special_machine AS m", "m.spmachine_id", "sm.spmachine_id")
	    	->where("sm.stl_id", $id)
	    	->first();

		/*
		* LOAD BOM ITEM DATA
		*---------------------------------------------
		*/
		$boms = DB::table("mr_order_bom_costing_booking AS b")
			->select(
				"b.*",
				"c.mcat_name",
				"i.item_name",
				"i.item_code",
				"mc.clr_code",
				"s.sup_name",
				"a.art_name",
				"com.comp_name",
				"con.construction_name" 
			)
			->leftJoin("mr_material_category AS c", function($join) {
				$join->on("c.mcat_id", "=", "b.mr_material_category_mcat_id");
			})
			->leftJoin("mr_cat_item AS i", function($join) {
				$join->on("i.mcat_id", "=", "b.mr_material_category_mcat_id");
				$join->on("i.id", "=", "b.mr_cat_item_id");
			})
			->leftJoin("mr_material_color AS mc", "mc.clr_id", "b.clr_id")
			->leftJoin("mr_supplier AS s", "s.sup_id", "b.mr_supplier_sup_id")
			->leftJoin("mr_article AS a", "a.id", "b.mr_article_id")
			->leftJoin("mr_composition AS com", "com.id", "b.mr_composition_id")
			->leftJoin("mr_construction AS con", "con.id", "b.mr_construction_id")
			->where("b.order_id", $order_id)
			->orderBy("b.mr_material_category_mcat_id")
			->get();
		
 
	    $bomItemData = ""; 
	    $previousCategory = null;
	    $previousCategoryName = null;
	    $loop = 0;
	    $subtotalName = "no_category";
	    #------------------------------------
		foreach ($boms as $bom) 
		{	  
			$total_price = number_format(($bom->consumption*$bom->precost_unit_price), 2); 
			// show subtotal  
			if ($loop == 0)
			{
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
			}
			else if (($previousCategory != $bom->mr_material_category_mcat_id))
			{ 
				if ($previousCategory==1)
				{ 
					$subtotalName = "total_fabric";
				}
				else if ($previousCategory==2)
				{
					$subtotalName = "total_sewing";
				}
				else
				{
					$subtotalName = "total_finishing";
				}

				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\"/></th><th></th><th></th></tr>";
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
			} 
			// ---------------------------------

			$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
			$total     = number_format(($bom->consumption+$extra_qty), 2);

			$bomItemData .= "<tr>
				<td>
					<input type=\"hidden\" name=\"mr_style_stl_id\" value=\"$id\"/>
					<input type=\"hidden\" name=\"id[]\" value=\"$bom->id\"/>
					$bom->mcat_name
				</td>
				<td>$bom->item_name</td>
				<td>$bom->item_code</td>
				<td>$bom->item_description</td>
				<td><span class='label' style=\"color:#87B87F;border:1px solid;background:$bom->clr_code\">$bom->clr_code</span></td>
				<td>$bom->size</td>
				<td>$bom->art_name</td>
				<td>$bom->comp_name</td>
				<td>$bom->construction_name</td>
				<td>$bom->sup_name</td>
				<td class='consumption'>$bom->consumption</td>
				<td class='extra'>$bom->extra_percent</td>  
				<td>$bom->uom</td>
				<td>
					<div class=\"radio\" style=\"margin:0\">
					  <label style=\"font-size:9px;min-height:0\">
					    <input type=\"radio\" name=\"bom_term[$loop]\" value=\"FOB\" class=\"bom_term\" style=\"margin-top:0\" ".($bom->bom_term=='FOB'?'checked':null)." disabled> FOB
					  </label>
					</div> 
					<div class=\"radio\" style=\"margin:0\">
					  <label style=\"font-size:9px;min-height:0\">
					    <input type=\"radio\" name=\"bom_term[$loop]\" value=\"C&F\" class=\"bom_term\" style=\"margin-top:0\" ".($bom->bom_term=='C&F'?'checked':null)." disabled> C&F
					  </label>
					</div> 
				</td>
				<td><input name=\"precost_fob[]\" type=\"text\" class=\"fob form-control input-sm\" placeholder=\"FOB\" value=\"$bom->precost_fob\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)." readonly/></td>
				<td><input name=\"precost_lc[]\" type=\"text\" class=\"lc form-control input-sm\" placeholder=\"L/C\" value=\"$bom->precost_lc\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)." readonly/></td>
				<td><input name=\"precost_freight[]\" type=\"text\" class=\"freight form-control input-sm\" placeholder=\"Freight\" value=\"$bom->precost_freight\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)." readonly/></td>
				<td><input name=\"precost_unit_price[]\" type=\"text\" class=\"form-control input-sm unit_price\" placeholder=\"Unit Price\" value=\"$bom->precost_unit_price\" data-validation=\"required\" autocomplete=\"off\" readonly/></td>
				<td><input type=\"text\" class=\"form-control input-sm total_price total_category_price\" data-cat-id=\"$bom->mr_material_category_mcat_id\" placeholder=\"Total Price\" value=\"$total_price\" data-validation=\"required\" readonly/></td>
				<td><input name=\"precost_req_qty[]\" type=\"text\" class=\"form-control input-sm\" placeholder=\"Req. Qty\" value=\"$bom->precost_req_qty\" data-validation=\"required\" autocomplete=\"off\" readonly/></td>
				<td><input name=\"precost_value[]\" type=\"text\" class=\"form-control input-sm\" placeholder=\"Precost Value\" value=\"$bom->precost_value\" data-validation=\"required\" autocomplete=\"off\" readonly/></td>
				<td><input name=\"total_quantity[]\" type=\"text\" class=\"form-control input-sm\" placeholder=\"Precost Value\" value=\"".($bom->precost_req_qty*$order->order_qty)."\" data-validation=\"required\" autocomplete=\"off\" readonly/></td>
				<td><input name=\"booking_qty[]\" type=\"text\" class=\"form-control input-sm\" placeholder=\"Booking Quantity\" value=\"".(($bom->booking_qty>0)?$bom->booking_qty: 0) ."\" data-validation=\"required number\" autocomplete=\"off\"/></td>
				<td><input name=\"del_date[]\" type=\"text\" class=\"form-control input-sm datepicker\" placeholder=\"Del. Date\" value=\"$bom->delivery_date\" autocomplete=\"off\" style=\"width:65px;\" /></td>
			</tr>";  

			// show subtotal  
			if ($loop+1 == sizeof($boms))
			{ 
				if ($previousCategory==1)
				{
					$subtotalName = "total_fabric";
				}
				else if ($previousCategory==2)
				{
					$subtotalName = "total_sewing";
				}
				else
				{
					$subtotalName = "total_finishing";
				}
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\"/></th><th></th><th></th></tr>";
			} 
			// ---------------------------------

			$loop++;
		}  
		/*
		* LOAD STYLE OPERATION & COST
		*---------------------------------------------
		*/
		$special_operation = DB::table("mr_order_operation_n_cost AS oc")
			->select(
				"oc.*",
				"o.opr_name" 
			)
			->leftJoin("mr_operation AS o", "o.opr_id", "=", "oc.mr_operation_opr_id")
			->where("oc.mr_order_entry_order_id", $request->segment(3))
			->where("oc.opr_type", 2)
			->get();
		

		foreach ($special_operation as $spo) 
		{ 
			$bomItemData .= "
			<tr>
				<td colspan='10' class='text-center'>$spo->opr_name</td>
				<td>1</td>
				<td>0</td>
				<td>".
					Form::select('uom[]', [
						"Millimeter" => "Millimeter",
						"Centimeter" => "Centimeter",
						"Meter" => "Meter",
						"Inch" => "Inch",
						"Feet" => "Feet",
						"Yard" => "Yard",
						"Piece" => "Piece"
					], $spo->uom, [
						"class" => "no-select",
						"data-validation" => "required"
					]).
				"</td>
				<td colspan='4'></td>
				<td> 
					<input type=\"hidden\" name=\"style_op_id[]\" value=\"$spo->order_op_id\"/>
					<input type=\"text\" name=\"unit_price[]\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$spo->unit_price\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Total Price\" value=\"$spo->unit_price\" readonly/>
				</td>
				<td></td>
				<td></td>
			</tr>";
		}
		/*
		* LOAD OTHER COST
		*---------------------------------------------
		*/
		$other_cost = OrderBomOtherCosting::where('mr_order_entry_order_id', $request->segment(3))->first();
		
		$bomItemData .= "
			<input type=\"hidden\" name=\"other_cost_id\" value=\"$other_cost->id\"/>
			<tr>
				<td colspan='10' class='text-center'>Testing Cost</td>
				<td class='consumption'>1</td>
				<td>0</td>
				<td>Piece</td>
				<td colspan='4'></td>
				<td>
					<input name=\"testing_cost\" type=\"text\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$other_cost->testing_cost\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->testing_cost\" readonly/>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan='10' class='text-center'>CM</td>
				<td class='consumption'>1</td>
				<td>0</td>
				<td>Piece</td>
				<td colspan='4'></td>
				<td>
					<input name=\"cm\" type=\"text\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$other_cost->cm\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->cm\" readonly/>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan='10' class='text-right'>Commertial Commision</td>
				<td><input name=\"comercial_comision_percent\" type=\"text\" class=\"form-control\" placeholder=\"Commertial Commision\" value=\"$other_cost->comercial_comision_percent\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>
				<td>
					<input name=\"commercial_commision\" type=\"text\" class=\"form-control input-sm sp_price\" placeholder=\"Price Unit\" value=\"$other_cost->commercial_commision\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Commertial Commision\" value=\"$other_cost->commercial_commision\" readonly/>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th colspan='18' class='text-center'>Net FOB </th>
				<th>
					<input name=\"net_fob\" type=\"text\" class=\"form-control input-sm net_fob\" placeholder=\"Net FOB\" value=\"0.00\" readonly/>
				</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td colspan='10' class='text-right'>Buyer Commision</td>
				<td><input name=\"buyer_comission_percent\" type=\"text\" class=\"form-control\" placeholder=\"Buyer Commision\" value=\"$other_cost->buyer_comission_percent\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>
				<td>
					<input type=\"text\" name=\"buyer_commision\" class=\"form-control input-sm buyer_price sp_price\" placeholder=\"Unit Price\" value=\"$other_cost->buyer_commision\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm buyer_total_price sp_total_price\" placeholder=\"Buyer Commision \" value=\"$other_cost->buyer_commision\" readonly/>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th colspan='18' class='text-center'>Total FOB </th> 
				<th>
					<input name=\"final_fob\" type=\"text\" class=\"form-control input-sm total_fob\" placeholder=\"Commision FOB\" value=\"0\" readonly/>
				</th>
				<th></th>
				<th></th>
			</tr>";

		/*
		* LOAD STYLE OPERATION & COST
		*---------------------------------------------
		*/ 

		$isBooking= OrderBOM::where('order_id', $order_id)
								->where('booking_qty', '!=', null)
								->Where('delivery_date', '!=', null)
								->exists();

    	return view("merch.order_booking.order_booking_form", compact(
    		"order",
    		"samples",
    		"operations",
    		"machines",
    		"modalItem",
    		"bomItemData",
    		"isBooking"
    	));
    }
    public function store(Request $request){
    	for($i=0; $i<sizeof($request->id); $i++){
    		OrderBOM::where('id', $request->id[$i])
    					->update([
    						'booking_qty' 	=> $request->booking_qty[$i],
    						'delivery_date' => $request->del_date[$i]
    					]);
    		//------------store log history-------------- 
		    	$this->logFileWrite("Order Booking updated", $request->id[$i]);
		    	//---------------------------------------
    	}
    	return redirect('merch/order_booking')->with('success', 'Booking Updated Successfully!');
    }

            //Write Every Events in Log File
    public function logFileWrite($message, $event_id)
    {
        $log_message = date("Y-m-d H:i:s")." ".auth()->user()->associate_id." \"$message\" ".$event_id.PHP_EOL;
        $log_file = fopen('assets/log.txt', 'a');
        fwrite($log_file, $log_message);
        fclose($log_file);
    }
}

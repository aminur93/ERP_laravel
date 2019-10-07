<?php

namespace App\Http\Controllers\Merch\OrderCosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit; 
use App\Models\Merch\Buyer; 
use App\Models\Merch\Brand;
use App\Models\Merch\Style; 
use App\Models\Merch\Season;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\OrderBOM;
use App\Models\Merch\BomOtherCosting;
use App\Models\Merch\OrderBomOtherCosting;
use App\Models\Merch\OrderOperationNCost;
use DB,Validator, ACL, DataTables, Form;

class OrderCostingController extends Controller
{
    //Show BOM List For Costing
	public function showList(){

		$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
		$buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
		$brandList= Brand::pluck('br_name','br_id');
		$styleList= Style::pluck('stl_no', 'stl_id');
		$seasonList= Season::pluck('se_name', 'se_id');
		return view("merch.order_costing.order_costing_list", compact('buyerList', 'seasonList', 'unitList', 'brandList', 'styleList'));
	}
    //get List Data  
	public function getListData()
	{
		$b_permissions = explode(',', auth()->user()->buyer_permissions);
		DB::statement(DB::raw('set @rownum=0'));
		$data= DB::table('mr_order_bom_costing_booking AS bom')
		->groupBy('bom.order_id')
		->leftJoin('mr_order_entry AS OE', 'OE.order_id', 'bom.order_id')
		->select([
			DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'),
			'bom.id AS bom_id',
			'bom.bom_term',
			"OE.order_id",
			"OE.order_code",
			"u.hr_unit_name",
			"b.b_name",
			"br.br_name",
			"s.se_name",
			"stl.stl_no",
			"OE.order_ref_no",
			"OE.order_qty",
			"OE.order_delivery_date",
			"OE.order_status"
		])
		->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
		->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
		->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
		->leftJoin('mr_season AS s', 's.se_id', 'OE.mr_season_se_id')
		->leftJoin('mr_style AS stl', 'stl.stl_id', "OE.mr_style_stl_id")
		->orderBy('bom_id', 'DESC')
		->whereIn('b.b_id', $b_permissions)
		->get();


		return DataTables::of($data)->addIndexColumn()
		->addColumn('action', function ($data) {
			if(empty($data->bom_term)){

				$action_buttons= "<div class=\"btn-group\">  
				<a href=".url('merch/order_costing/'.$data->order_id.'/create')." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Add Costing\">
				<i class=\"ace-icon fa fa-plus bigger-120\"></i>
				</a>";
				$action_buttons.= "</div>";
				return $action_buttons;
			}
			else{
				$action_buttons= "<div class=\"btn-group\">  
				<a href=".url('merch/order_costing/'.$data->order_id.'/edit')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit Costing\">
				<i class=\"ace-icon fa fa-pencil bigger-120\"></i>
				</a>";
				$action_buttons.= "</div>";
				return $action_buttons;
			}
		})
		->editColumn('order_status', function($data){
			if($data->order_status == "Costed")
				return "Approved";
			else return $data->order_status;
		})
		->rawColumns(['action'])
		->toJson();
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
			"OE.unit_id",
			"u.hr_unit_name",
			"b.b_name",
			"br.br_name",
			"s.se_name",
			"stl.stl_no",
			"OE.mr_style_stl_id",
			"OE.order_ref_no",
			"OE.order_qty",
			"OE.order_delivery_date",
    		"stl.stl_img_link"
		])
		->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
		->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
		->whereIn('b.b_id', auth()->user()->buyer_permissions())
		->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
		->leftJoin('mr_season AS s', 's.se_id', 'OE.mr_season_se_id')
		->leftJoin('mr_style AS stl', 'stl.stl_id', "OE.mr_style_stl_id")
		->first();
		
		$id= $order->mr_style_stl_id;

		// Other Costs of style for showing
		$style_other_costing= BomOtherCosting::where('mr_style_stl_id', $id)
		->first();

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
			"b.id",
			"b.mr_style_stl_id",
			"b.mr_material_category_mcat_id",
			"c.mcat_name",
			"b.mr_cat_item_id",
			"i.item_name",
			"i.item_code",
			"b.item_description",
			"mc.clr_code",
			"b.size",
			"s.sup_name",
			"a.art_name",
			"com.comp_name",
			"con.construction_name",
			"b.consumption",
			"b.extra_percent",
			"b.uom",  
			"b.precost_req_qty", 
			"b.precost_unit_price",
			"OE.order_qty"
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
		->leftJoin('mr_order_entry AS OE', 'OE.order_id', 'b.order_id')
		->orderBy("b.mr_material_category_mcat_id")
		->get();
		$bomItemData = ""; 
		$previousCategory = null;
		$previousCategoryName = null;
		$loop = 0;
		$sub_stl_cost=0;
		$subtotalName = "no_category";
		//dd($boms);exit;
		foreach ($boms as $bom) 
		{
			#---- Style Total Cost for showing ----------------#
			if($bom->mr_style_stl_id!=null){

				$stl_total= DB::table('mr_stl_bom_n_costing')
				->where('mr_style_stl_id', $bom->mr_style_stl_id)
				->where('mr_material_category_mcat_id', $bom->mr_material_category_mcat_id)
				->where('mr_cat_item_id', $bom->mr_cat_item_id)
				->select([
					'consumption',
					'precost_unit_price'
				])
				->first();
				
				$stl_extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);

				$stl_consumptionEx = $bom->consumption + $stl_extra_qty;

				$stl_cost = number_format(( $stl_consumptionEx*$stl_total->precost_unit_price), 2);
				$stl_unit = number_format(($stl_total->precost_unit_price), 2);
			}
			else{
				$stl_cost = 0;
				$stl_unit = 0;
			}

			//--- Style Total Cost for showing
			
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

				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"$sub_stl_cost\" step=\"0.01\"/></th>
				<th><input name=\"stl_$subtotalName\" type=\"text\" class=\"form-control input-sm _style_subtotal\" style-data-subtotal=\"$previousCategory\" placeholder=\"Style Sub Total\" readonly value=\"$sub_stl_cost\" style='background: #feffb6 !important'></th>
				<th></th>
				</tr>";
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
				$sub_stl_cost=0;
			} 
			// ---------------------------------

			$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
			$total     = number_format(($bom->consumption+$extra_qty), 2);
			$precost_req_pre = ($bom->consumption * $bom->extra_percent)/100;
			$precost_req_qty = ($bom->consumption + $precost_req_pre) * $order->order_qty;

			$total_value = $bom->precost_unit_price * $precost_req_qty;
			$bomItemData .= "<tr>
			<td>
			<input type=\"hidden\" name=\"mr_style_stl_id\" value=\"$id\"/>
			<input type=\"hidden\" name=\"id[]\" value=\"$bom->id\"/>
			$bom->mcat_name
			</td>
			<td>$bom->item_name</td>
			<td>$bom->item_code</td>
			<td>$bom->item_description</td>
			<td><span class='label text-warning' style=\"color:#87B87F;border:1px solid;background:$bom->clr_code\">$bom->clr_code</span></td>
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
			<input type=\"radio\" name=\"bom_term[$loop]\" value=\"FOB\" class=\"bom_term\" style=\"margin-top:0\"> FOB
			</label>
			</div> 
			<div class=\"radio\" style=\"margin:0\">
			<label style=\"font-size:9px;min-height:0\">
			<input type=\"radio\" name=\"bom_term[$loop]\" value=\"C&F\" class=\"bom_term\" style=\"margin-top:0\" checked> C&F
			</label>
			</div> 
			</td>
			<td><input name=\"precost_fob[]\" type=\"text\" class=\"fob form-control input-sm\" placeholder=\"FOB\" readonly value=\"0\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input name=\"precost_lc[]\" type=\"text\" class=\"lc form-control input-sm\" placeholder=\"L/C\" readonly value=\"0\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input name=\"precost_freight[]\" type=\"text\" class=\"freight form-control input-sm\" placeholder=\"Freight\" readonly value=\"0\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input name=\"precost_unit_price[]\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm unit_price\" placeholder=\"Unit Price\" value=\"$stl_unit\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input type=\"text\" class=\"form-control input-sm total_price total_category_price\" data-cat-id=\"$bom->mr_material_category_mcat_id\" placeholder=\"Total Price\" value=\"$stl_cost\" step=\"0.01\" data-validation=\"required\" readonly/></td>
			<td><input type=\"text\" class=\"form-control input-sm style_cost_in\" name=\"style_cost[]\" placeholder=\"Style Total Price\" value=\"".$stl_cost."\" step=\"0.01\" readonly style='background: #feffb6 !important'></td>
			<td><input name=\"precost_req_qty[]\" readonly type=\"text\" class=\"form-control input-sm required_qty\" placeholder=\"Req. Qty\" value=\"$precost_req_qty\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/ ></td>
			<td><input name=\"precost_value[]\" readonly type=\"text\" class=\"form-control input-sm total_val\" placeholder=\"Precost Value\" value=\"$total_value\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			</tr>";  

			$sub_stl_cost=$sub_stl_cost+$stl_cost;
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
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"$sub_stl_cost\" step=\"0.01\"/></th>
				<th><input name=\"stl_$subtotalName\" type=\"text\" class=\"form-control input-sm _style_subtotal\" style-data-subtotal=\"$previousCategory\" placeholder=\"Style Sub Total\" readonly value=\"$sub_stl_cost\" style='background: #feffb6 !important' ></th>
				<th></th>
				</tr>";
				$sub_stl_cost=0;
			} 
			// ---------------------------------

			$loop++;

		} 
		//exit;
		/*
		* LOAD STYLE OPERATION & COST
		*---------------------------------------------
		*/
		$special_operation = DB::table("mr_style_operation_n_cost AS oc")
		->select(
			"oc.*",
			"o.opr_name" 
		)
		->leftJoin("mr_operation AS o", "o.opr_id", "=", "oc.mr_operation_opr_id")
		->where("oc.mr_style_stl_id", $id)
		->where("oc.opr_type", 2)
		->get();
		$totalFob = 0;  
		foreach ($special_operation as $spo) 
		{
			$totalFob += $spo->unit_price;
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
			<input type=\"hidden\" name=\"style_op_id[]\" value=\"$spo->style_op_id\"/>
			<input type=\"number\" min='0' name=\"unit_price[]\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$spo->unit_price\" step=\"0.01\"/>
			</td>
			<td>
			<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Total Price\" value=\"$spo->unit_price\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Unit Price\" value=\"$spo->unit_price\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
			</tr>";
		}

		$style_buyer_commision = $style_other_costing->buyer_fob - $style_other_costing->net_fob;
		$style_agent_commision = $style_other_costing->agent_fob - $style_other_costing->buyer_fob;
		$bomItemData .= "
		<tr>
		<td colspan='10' class='text-center'>Testing Cost</td>
		<td class='consumption'>1</td>
		<td>0</td>
		<td>Piece</td>
		<td colspan='4'></td>
		<td>
		<input name=\"testing_cost\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$style_other_costing->testing_cost\"/>
		</td>
		<td>
		<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$style_other_costing->testing_cost\" step=\"0.01\" readonly/>
		</td>
		<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Testing Cost\" value=\"$style_other_costing->testing_cost\" readonly style='background: #feffb6 !important' ></td>
		<td></td>
		</tr>
		<tr>
		<td colspan='10' class='text-center'>CM</td>
		<td class='consumption'>1</td>
		<td>0</td>
		<td>Piece</td>
		<td colspan='4'></td>
		<td>
		<input name=\"cm\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$style_other_costing->cm\"/>
		</td>
		<td>
		<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$style_other_costing->cm\" step=\"0.01\" readonly/>
		</td>
		<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"CM\" value=\"$style_other_costing->cm\" readonly style='background: #feffb6 !important' ></td>
		<td></td>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Commercial cost</td>
			
			<td colspan='7' class='text-left'></td>
			<td>
				<input name=\"commercial_cost\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Price Unit\" value=\"$style_other_costing->commercial_cost\"/>
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Commercial cost\" value=\"$style_other_costing->commercial_cost\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Commercial cost\" value=\"$style_other_costing->commercial_cost\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Net FOB </th>
			<th>
				<input name=\"net_fob\" type=\"text\" class=\"form-control input-sm net_fob\" placeholder=\"Net FOB\" value=\"$style_other_costing->net_fob\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Net FOB\" value=\"$style_other_costing->net_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Buyer Commision</td>
			<td><input name=\"buyer_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control buyer_comission_percent\" placeholder=\"Buyer Commision\" value=\"$style_other_costing->buyer_comission_percent\" style=\"width:56px\"></td>
			<td colspan='6' class='text-left'>%</td>
			<td>
				<input type=\"text\" name=\"buyer_commision\" class=\"form-control input-sm buyer_price sp_price\" placeholder=\"Unit Price\" value=\"$style_buyer_commision\" step=\"0.01\" readonly>
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm buyer_total_price sp_total_price\" placeholder=\"Buyer Commision \" value=\"$style_buyer_commision\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer Commision\" value=\"$style_buyer_commision\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Buyer FOB </th>
			<th>
				<input name=\"buyer_fob\" type=\"text\" class=\"form-control input-sm buyer_fob\" placeholder=\"Buyer FOB\" value=\"0\" step=\"0.01\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer FOB\" value=\"$style_other_costing->buyer_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Agent Commision</td>
			<td><input name=\"agent_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control agent_comission_percent\" placeholder=\"Agent Commision\" value=\"$style_other_costing->agent_comission_percent\" style=\"width:56px\"></td>
			<td colspan='6' class='text-left'>%</td>
			<td>
				<input type=\"text\" name=\"agent_commision\" class=\"form-control input-sm agent_price sp_price\" placeholder=\"Unit Price\" value=\"$style_agent_commision\" step=\"0.01\" readonly>
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm agent_total_price sp_total_price\" placeholder=\"Agent Commision \" value=\"$style_agent_commision\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer Commision\" value=\"$style_agent_commision\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Agent FOB </th>
			<th>
				<input name=\"agent_fob\" type=\"text\" class=\"form-control input-sm agent_fob\" placeholder=\"Agemt FOB\" value=\"0\" step=\"0.01\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Agent FOB\" value=\"$style_other_costing->agent_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
		<th colspan='18' class='text-center'>Total FOB </th> 
		<th>
		<input name=\"final_fob\" type=\"text\" class=\"form-control input-sm total_fob\" placeholder=\"Commision FOB\" value=\"0\" readonly/>
		</th>
		<th><input type=\"text\" class=\"form-control input-sm  style_final_fob\" placeholder=\"Final FOB\" value=\"$style_other_costing->agent_fob\" readonly style='background: #feffb6 !important'></th>
		<th></th>
		</tr>";


		/*
		* Approval Button
		*/
		$buttons = $this->approvalButtons($order_id,$order->unit_id);
	
		/*


		* LOAD STYLE OPERATION & COST
		*---------------------------------------------
		*/ 
		return view("merch.order_costing.order_costing_form", compact(
			"order",
			"samples",
			"operations",
			"machines",
			"modalItem",
			"bomItemData",
			"buttons"
		));
	}

	//Order BOM Store
	public function store(Request $request)
	{ 
 		$validator = Validator::make($request->all(), [ 
			"bom_term.*"    => "required|max:11",
			"precost_fob.*" => "required|max:11",
			"precost_lc.*"  => "max:11",
			"precost_freight.*"     => "required|max:11",
			"precost_unit_price.*"  => "required|max:11",
			"precost_total_price.*" => "required|max:11",
			"precost_req_qty.*"     => "required|max:11", 
			"precost_value.*"       => "required|max:11",  
   	    	// mr_style_operation_n_cost - update
			"style_op_id.*"         => "required|max:11",  
			"uom.*"                 => "required|max:11",  
			"unit_price.*"          => "required|max:11",  
   	    	// mr_stl_bom_other_costing - insert
			"total_fabric"          => "max:11",  
			"total_sewing"          => "max:11",  
			"testing_cost"          => "max:11",  
			"cm"                    => "required|max:11",   
			"net_fob"                => "required|max:11", 
			"buyer_comission_percent" => "required|max:11",  
			"buyer_commision"        => "required|max:11",
			"final_fob"              => "required|max:11" 
		]);

		if ($validator->fails())
		{  
			return back()
			->withErrors($validator)
			->withInput()
			->with('error', "Incorrect Input!!"); 
		}
		else
		{
			// Store Style Bom and Costing 
			if (is_array($request->id) && sizeof($request->id) > 0)
			{
   	    		// mr_stl_bom_n_costing - update
				for ($i=0; $i<sizeof($request->id); $i++)
				{
					$update = array( 
						"bom_term"    => $request->bom_term[$i],
						"precost_fob" => $request->precost_fob[$i],
						"precost_lc"  => $request->precost_lc[$i], 
						"precost_freight"     => $request->precost_freight[$i], 
						"precost_unit_price"  => $request->precost_unit_price[$i],  
						"precost_req_qty"     => $request->precost_req_qty[$i], 
						"precost_value"       => $request->precost_value[$i], 
					);
					OrderBOM::where("id", $request->id[$i])->update($update);

			    	//------------store log history-------------- 
					$this->logFileWrite("Order BOM and Costing created", $request->id[$i]);
			    	//---------------------------------------
				}   

	   	    	// mr_style_operation_n_cost - update
				if (is_array($request->style_op_id) && sizeof($request->style_op_id) > 0)
				{

					for ($i=0; $i<sizeof($request->style_op_id); $i++)
					{
						$insert = array( 
							"mr_style_stl_id" => $request->mr_style_stl_id,
							"mr_operation_opr_id" => $request->style_op_id[$i],
							"opr_type" => 2,
							"uom"         => $request->uom[$i], 
							"unit_price"  => $request->unit_price[$i], 
							"mr_order_entry_order_id"  => $request->segment(3)
						);
				    	//---------------------------------------
						DB::table("mr_order_operation_n_cost")
						->where("style_op_id", $request->style_op_id[$i])
						->insert($insert);

				    	//------------store log history-------------- 
						$this->logFileWrite("Order Operation updated", $request->style_op_id[$i]);
				    	//---------------------------------------
					}
				} 

	   	    	// Order Bom Other Costing - insert 
				$id = OrderBomOtherCosting::insertGetId([  
					"mr_style_stl_id"  => $request->mr_style_stl_id,
					"testing_cost" => $request->testing_cost,
					"cm"           => $request->cm,
					"commercial_cost" => $request->commercial_cost,
					"net_fob" => $request->net_fob,
					"buyer_comission_percent" => $request->buyer_comission_percent,
					"buyer_fob" => $request->buyer_fob,
					"agent_comission_percent"   => $request->agent_comission_percent,
					"agent_fob"         => $request->agent_fob,
					"mr_order_entry_order_id"      => $request->segment(3) 
				]); 
		    	//------------store log history-------------- 
				$this->logFileWrite("Order Bom & Other Costing created", $id);
		    	//---------------------------------------

		    	/*  
		    	*----------------------------------------------------
		    	* request_for_approve
		    	*----------------------------------------------------
		    	*/
		    	if ($request->has("request_for_approve") && !empty($request->submit_to))
		    	{
		    		DB::table("mr_order_costing_approval")
			    		->insert([
			    			"title" => "precost",
			    			"submit_by" => auth()->user()->associate_id,
			    			"submit_to" => $request->submit_to,
			    			"comments"  => $request->comments,
			    			"status"    => 1,
			    			"created_on"  => date("Y-m-d H:i:s"),
			    			"mr_order_bom_n_costing_id"  => $request->segment(3),
			    			"level"     => $request->level,
			    		]); 
		    		OrderEntry::where('order_id', $request->segment(3))
					    		->update([
					    			'order_status'=> "Approval Pending"
					    		]);

		    		return redirect("merch/order_costing")
		    		->with('success', 'Request for approval successful.');
		    	}
		    	/*  
		    	*----------------------------------------------------
		    	*/
		    	return redirect("merch/order_costing")
		    	->with('success', 'Save successful.');
		    }
		    else
		    {
		    	return back()
		    	->withInput()
		    	->with('error', "Incorrect Input!"); 
		    }
		  } 
		}

		public function editForm(Request $request)
		{
    		//take order_id from request

			$order_id = $request->id; 
    		//order info
			$order= DB::table('mr_order_entry AS OE')
						->where('OE.order_id', $order_id)
						->select([
							"OE.order_id",
							"OE.order_code",
							"OE.unit_id",
							"u.hr_unit_name",
							"b.b_name",
							"br.br_name",
							"s.se_name",
							"stl.stl_no",
							"OE.mr_style_stl_id",
							"OE.order_ref_no",
							"OE.order_qty",
							"OE.order_delivery_date",
			    			"stl.stl_img_link"
						])
						->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'OE.unit_id')
						->leftJoin('mr_buyer AS b', 'b.b_id', 'OE.mr_buyer_b_id')
						->whereIn('b.b_id', auth()->user()->buyer_permissions())
						->leftJoin('mr_brand AS br', 'br.br_id', 'OE.mr_brand_br_id')
						->leftJoin('mr_season AS s', 's.se_id', 'OE.mr_season_se_id')
						->leftJoin('mr_style AS stl', 'stl.stl_id', "OE.mr_style_stl_id")
						->first(); 

			//id= Style Id 
			$id= $order->mr_style_stl_id;

			// Other Costs of style for showing
			$style_other_costing= BomOtherCosting::where('mr_style_stl_id', $id)->first();

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
			"con.construction_name",
			"OE.order_qty"
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
		->leftJoin('mr_order_entry AS OE', 'OE.order_id', 'b.order_id')
		->orderBy("b.mr_material_category_mcat_id")
		->get();
		
		// echo "<pre>"; print_r($boms);exit;
		$bomItemData = ""; 
		$previousCategory = null;
		$previousCategoryName = null;
		$loop = 0;
		$sub_stl_cost=0;
		$subtotalName = "no_category";
	    #------------------------------------
		foreach ($boms as $bom) 
		{
			#---- Style Total Cost for showing ----------------#
			if($bom->mr_style_stl_id!=null){
				$stl_total= DB::table('mr_stl_bom_n_costing')
				->where('mr_style_stl_id', $bom->mr_style_stl_id)
				->where('mr_material_category_mcat_id', $bom->mr_material_category_mcat_id)
				->where('mr_cat_item_id', $bom->mr_cat_item_id)
				->select([
					'consumption',
					'precost_unit_price'
				])
				->first();

				if($stl_total){
				  	$stl_extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);

					$stl_consumptionEx = $bom->consumption + $stl_extra_qty;

					$stl_cost = number_format(( $stl_consumptionEx*$stl_total->precost_unit_price), 2);
				}
				else{
					$stl_cost=0;

				}
				

			}
			else{
				$stl_cost=0;
			}
			//--- Style Total Cost for showing

			//$total_price = number_format(($bom->consumption*$bom->precost_unit_price), 2); 
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

				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\" step=\"0.01\"/></th>
				<th><input name=\"stl_$subtotalName\" type=\"text\" class=\"form-control input-sm _style_subtotal\" style-data-subtotal=\"$previousCategory\" placeholder=\"Style Sub Total\" readonly value=\"$sub_stl_cost\" style='background: #feffb6 !important'></th>
				<th></th>
				</tr>";
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
				$sub_stl_cost=0;
			} 
			// ---------------------------------

			$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
			$consumptionEx = $bom->consumption + $extra_qty;
			$total_price = number_format(($consumptionEx*$bom->precost_unit_price), 2);
			$total     = number_format(($bom->consumption+$extra_qty), 2);
			$precost_req_pre = ($bom->consumption * $bom->extra_percent)/100;
			$precost_req_qty = ($bom->consumption + $precost_req_pre) * $order->order_qty;
			$total_value = $bom->precost_unit_price * $precost_req_qty;
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
			<input type=\"radio\" name=\"bom_term[$loop]\" value=\"FOB\" class=\"bom_term\" style=\"margin-top:0\" ".($bom->bom_term=='FOB'?'checked':null)."> FOB
			</label>
			</div> 
			<div class=\"radio\" style=\"margin:0\">
			<label style=\"font-size:9px;min-height:0\">
			<input type=\"radio\" name=\"bom_term[$loop]\" value=\"C&F\" class=\"bom_term\" style=\"margin-top:0\" ".($bom->bom_term=='C&F'?'checked':null)."> C&F
			</label>
			</div> 
			</td>
			<td><input name=\"precost_fob[]\" type=\"text\" class=\"fob form-control input-sm\" placeholder=\"FOB\" value=\"$bom->precost_fob\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
			<td><input name=\"precost_lc[]\" type=\"text\" class=\"lc form-control input-sm\" placeholder=\"L/C\" value=\"$bom->precost_lc\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
			<td><input name=\"precost_freight[]\" type=\"text\" class=\"freight form-control input-sm\" placeholder=\"Freight\" value=\"$bom->precost_freight\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
			<td><input name=\"precost_unit_price[]\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm unit_price\" placeholder=\"Unit Price\" value=\"$bom->precost_unit_price\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input type=\"text\" class=\"form-control input-sm total_price total_category_price\" data-cat-id=\"$bom->mr_material_category_mcat_id\" placeholder=\"Total Price\" value=\"$total_price\" step=\"0.01\" data-validation=\"required\" readonly/></td>
			<td><input type=\"text\" class=\"form-control stl_total_price input-sm\" name=\"style_cost[]\" placeholder=\"Style Total Price\" value=\"".$stl_cost."\" step=\"0.01\" readonly style='background: #feffb6 !important'></td>

			<td><input name=\"precost_req_qty[]\" readonly type=\"text\" class=\"form-control input-sm required_qty\" placeholder=\"Req. Qty\" value=\"".($precost_req_qty)."\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			<td><input name=\"precost_value[]\" readonly type=\"text\" class=\"form-control input-sm total_val\" placeholder=\"Precost Value\" value=\"$total_value\" step=\"0.01\" data-validation=\"required\" autocomplete=\"off\"/></td>
			</tr>";  

			$sub_stl_cost=$sub_stl_cost+$stl_cost;
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
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\" step=\"0.01\"/></th>
				<th><input name=\"stl_$subtotalName\" type=\"text\" class=\"form-control input-sm _style_subtotal\" style-data-subtotal=\"$previousCategory\" placeholder=\"Style Sub Total\" readonly value=\"$sub_stl_cost\" style='background: #feffb6 !important'></th>
				<th></th>
				</tr>";
				$sub_stl_cost=0;
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
			<input type=\"number\" min='0' step=\"0.01\" name=\"unit_price[]\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$spo->unit_price\"/>
			</td>
			<td>
			<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Total Price\" value=\"$spo->unit_price\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Unit Price\" value=\"$spo->unit_price\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
			</tr>";
		}
		/*
		* LOAD OTHER COST
		*---------------------------------------------
		*/
		$other_cost = OrderBomOtherCosting::where('mr_order_entry_order_id', $request->segment(3))->first(); //dd($other_cost);
		if($other_cost!=null){

			$buyer_commision = floatval($other_cost->buyer_fob) - floatval($other_cost->net_fob);
			$agent_commision = floatval($other_cost->agent_fob) - floatval($other_cost->buyer_fob);
			$style_buyer_commision = $style_other_costing->buyer_fob - $style_other_costing->net_fob;
			$style_agent_commision = $style_other_costing->agent_fob - $style_other_costing->buyer_fob;
	    }
	    else{
	    	$buyer_commision = 0;
	    	$agent_commision = 0;
	    	$style_buyer_commision = 0;
	    	$style_agent_commision = 0;
	    }
		
		$bomItemData .= "
		<input type=\"hidden\" name=\"other_cost_id\" value=\"$other_cost->id\"/>
		<tr>
		<td colspan='10' class='text-center'>Testing Cost</td>
		<td class='consumption'>1</td>
		<td>0</td>
		<td>Piece</td>
		<td colspan='4'></td>
		<td>
		<input name=\"testing_cost\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$other_cost->testing_cost\"/>
		</td>
		<td>
		<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->testing_cost\" step=\"0.01\" readonly/>
		</td>
		<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Testing Cost\" value=\"$style_other_costing->testing_cost\" step=\"0.01\" readonly style='background: #feffb6 !important'></td>
		<td></td>
		</tr>
		<tr>
		<td colspan='10' class='text-center'>CM</td>
		<td class='consumption'>1</td>
		<td>0</td>
		<td>Piece</td>
		<td colspan='4'></td>
		<td>
		<input name=\"cm\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$other_cost->cm\"/>
		</td>
		<td>
		<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->cm\" step=\"0.01\" readonly/>
		</td>
		<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"CM\" value=\"$style_other_costing->cm\" readonly style='background: #feffb6 !important' ></td>
		<td></td>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Commercial cost</td>
			
			<td colspan='7' class='text-left'></td>
			<td>
				<input name=\"commercial_cost\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Price Unit\" value=\"$other_cost->commercial_cost\"/>
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Commercial cost\" value=\"$other_cost->commercial_cost\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Commercial cost\" value=\"$style_other_costing->commercial_cost\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Net FOB </th>
			<th>
				<input name=\"net_fob\" type=\"text\" class=\"form-control input-sm net_fob\" placeholder=\"Net FOB\" value=\"$other_cost->net_fob\" step=\"0.01\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Net FOB\" value=\"$style_other_costing->net_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Buyer Commision</td>
			<td><input name=\"buyer_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control buyer_comission_percent\" placeholder=\"Buyer Commision\" value=\"$other_cost->buyer_comission_percent\" style=\"width:56px\"></td>
			<td colspan='6' class='text-left'>%</td>
			
			<td>
				<input type=\"text\" name=\"buyer_commision\" class=\"form-control input-sm buyer_price sp_price\" placeholder=\"Unit Price\" value=\"$buyer_commision\" step=\"0.01\" readonly/>
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm buyer_total_price sp_total_price\" placeholder=\"Buyer Commision \" value=\"$buyer_commision\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer Commision\" value=\"$style_buyer_commision\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Buyer FOB </th>
			<th>
				<input name=\"buyer_fob\" type=\"text\" class=\"form-control input-sm buyer_fob\" placeholder=\"Buyer FOB\" value=\"$other_cost->buyer_fob\" step=\"0.01\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer FOB\" value=\"$style_other_costing->buyer_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
			<td colspan='10' class='text-right'>Agent Commision</td>
			<td><input name=\"agent_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control agent_comission_percent\" placeholder=\"Agent Commision\" value=\"$other_cost->agent_comission_percent\" style=\"width:56px\"></td>
			<td colspan='6' class='text-left'>%</td>
			<td>
				<input type=\"text\" name=\"agent_commision\" class=\"form-control input-sm agent_price sp_price\" placeholder=\"Unit Price\" value=\"$agent_commision\" step=\"0.01\" readonly />
			</td>
			<td>
				<input type=\"text\" class=\"form-control input-sm agent_total_price sp_total_price\" placeholder=\"Agent Commision \" value=\"$agent_commision\" step=\"0.01\" readonly/>
			</td>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Buyer Commision\" value=\"$style_agent_commision\" readonly style='background: #feffb6 !important' ></td>
			<td></td>
		</tr>
		<tr>
			<th colspan='18' class='text-center'>Agent FOB </th>
			<th>
				<input name=\"agent_fob\" type=\"text\" class=\"form-control input-sm agent_fob\" placeholder=\"Agent FOB\" value=\"$other_cost->agent_fob\" step=\"0.01\" readonly/>
			</th>
			<td><input type=\"text\" class=\"form-control input-sm _style_subtotal\" placeholder=\"Style Agent FOB\" value=\"$style_other_costing->agent_fob\" readonly style='background: #feffb6 !important' ></td>
			<th></th>
		</tr>
		<tr>
		<th colspan='18' class='text-center'>Total FOB </th> 
		<th>
		<input name=\"final_fob\" type=\"text\" class=\"form-control input-sm total_fob\" placeholder=\"Commision FOB\" value=\"$other_cost->agent_fob\" readonly/>
		</th>
		<th><input type=\"text\" class=\"form-control input-sm  style_final_fob\" placeholder=\"Final FOB\" value=\"$style_other_costing->agent_fob\" readonly style='background: #feffb6 !important'></th>
		<th></th>
		</tr>";

		/*
		* Approval Button
		*/
		$buttons = $this->approvalButtons($order_id,$order->unit_id);
		/*

		/*
		* LOAD STYLE OPERATION & COST
		*---------------------------------------------
		*/ 
		$check_booking= OrderBOM::where('order_id', $order_id)
															->where('booking_qty', '!=', null)
															->exists();

			return view("merch.order_costing.order_costing_edit", compact(
			"order",
			"samples",
			"operations",
			"machines",
			"modalItem",
			"bomItemData",
			"buttons",
			"check_booking"
			));
	}

	public function update(Request $request)
	{  


		$validator = Validator::make($request->all(), [ 
   	    	// mr_stl_bom_n_costing - update
		"id.*"          => "required|max:11",
		"bom_term.*"    => "required|max:11",
		"precost_fob.*" => "required|max:11",
		"precost_lc.*"  => "max:11",
		"precost_freight.*"     => "required|max:11",
		"precost_unit_price.*"  => "required|max:11",
		"precost_total_price.*" => "required|max:11",
		"precost_req_qty.*"     => "required|max:11", 
		"precost_value.*"       => "required|max:11",  
   	    	// mr_style_operation_n_cost - update
		"style_op_id.*"         => "required|max:11",  
		"uom.*"                 => "required|max:11",  
		"unit_price.*"          => "required|max:11",  
   	    	// mr_stl_bom_other_costing - insert
		"other_cost_id"         => "required|max:11",  
		"mr_style_stl_id"       => "required|max:11",  
		"total_fabric"          => "max:11",  
		"total_sewing"          => "max:11",  
		"testing_cost"          => "max:11",  
		"cm"                    => "required|max:11",  
		//"comercial_comision_percent" => "required|max:11",  
		//"commercial_commision"   => "required|max:11",   
		"net_fob"                => "required|max:11", 
		"buyer_comission_percent" => "required|max:11",  
		"buyer_commision"        => "required|max:11",
		"final_fob"              => "required|max:11" 
		]);

		if ($validator->fails())
		{  
			return back()
			->withErrors($validator)
			->withInput()
			->with('error', "Incorrect Input!!"); 
		}
		else
		{
			// Store Style Bom and Costing 
			if (is_array($request->id) && sizeof($request->id) > 0)
			{
   	    		// mr_stl_bom_n_costing - update
				for ($i=0; $i<sizeof($request->id); $i++)
				{
					$update = array( 
					"bom_term"    => $request->bom_term[$i],
					"precost_fob" => $request->precost_fob[$i],
					"precost_lc"  => $request->precost_lc[$i], 
					"precost_freight"     => $request->precost_freight[$i], 
					"precost_unit_price"  => $request->precost_unit_price[$i],  
					"precost_req_qty"     => $request->precost_req_qty[$i], 
					"precost_value"       => $request->precost_value[$i], 
					);
					OrderBOM::where("id", $request->id[$i])->update($update);

			    	//------------store log history-------------- 
					$this->logFileWrite("Order BOM and Costing updated", $request->id[$i]);
			    	//---------------------------------------
				}   

	   	    	// mr_style_operation_n_cost - update
				if (is_array($request->style_op_id) && sizeof($request->style_op_id) > 0)
				{
					for ($i=0; $i<sizeof($request->style_op_id); $i++)
					{
						$update = array( 
						"mr_operation_opr_id" => $request->style_op_id[$i],
						"uom"         => $request->uom[$i], 
						"unit_price"  => $request->unit_price[$i], 
						);

				    	//---------------------------------------
						DB::table("mr_order_operation_n_cost")
						->where("order_op_id", $request->style_op_id[$i])
						->update($update);

				    	//------------store log history-------------- 
						$this->logFileWrite("Order Style Operation updated", $request->style_op_id[$i]);
				    	//---------------------------------------
					}
				} 

	   	    	// mr_stl_bom_other_costing - insert 
				OrderBomOtherCosting::where("id", $request->other_cost_id)
				->update([  
				"mr_style_stl_id"  => $request->mr_style_stl_id,
				"testing_cost" => $request->testing_cost,
				"cm"           => $request->cm,
				"commercial_cost" => $request->commercial_cost,
				"net_fob" => $request->net_fob,
				"buyer_comission_percent" => $request->buyer_comission_percent,
				"buyer_fob" => $request->buyer_fob,
				"agent_comission_percent"   => $request->agent_comission_percent,
				"agent_fob"         => $request->agent_fob
				]); 
		    	//------------store log history-------------- 
				$this->logFileWrite("Order Style Bom & Other Costing updated", $request->other_cost_id);
		    	//---------------------------------------


				/*  
				*----------------------------------------------------
				* request_for_approve
				*----------------------------------------------------
		    	*/
				if ($request->has("request_for_approve") && !empty($request->submit_to))
				{
					DB::table("mr_order_costing_approval")
					->insert([
					"title" => "precost",
					"submit_by" => auth()->user()->associate_id,
					"submit_to" => $request->submit_to,
					"comments"  => $request->comments,
					"status"    => 1,
					"created_on"  => date("Y-m-d H:i:s"),
					"mr_order_bom_n_costing_id"  => $request->segment(3),
					"level"     => $request->level,
					]); 
					OrderEntry::where('order_id', $request->segment(3))
					->update([
					'order_status'=> "Approval Pending"
					]);

					return redirect("merch/order_costing")
					->with('success', 'Request for approval successful.');
				}
				/*  
				*----------------------------------------------------
		    	*/


				/*----------------------------------------------------
				* confirm_approval_request
				*----------------------------------------------------
		    	*/
				if ($request->has("confirm_approval_request") && !empty($request->approve_id) && !empty($request->level))
				{ 

		    		// get approval access level
					$approvalLevel = DB::table("mr_approval_hirarchy")
					->where("mr_approval_type", "Order Costing")
					->first();

		    		// update approval status = 2 [request approved]
					$approvalData = DB::table("mr_order_costing_approval")
					->where("id", $request->approve_id)
					->update([
					"comments" => $request->comments,
					"status" => 2 
					]); 

					if ($request->level == 1)
					{  
		    			// insert new approval record
						DB::table("mr_order_costing_approval")
						->insert([
						"title" => "precost",
						"submit_by" => auth()->user()->associate_id,
						"submit_to" => $approvalLevel->level_2,
						"comments"  => null,
						"status"    => 1,
						"created_on"  => date("Y-m-d H:i:s"),
						"mr_order_bom_n_costing_id"  => $request->segment(3),
						"level"     => 2,
						]); 
					} 
					else if ($request->level == 2)
					{ 
		    			// insert new approval record
						DB::table("mr_order_costing_approval")
						->insert([
						"title" => "precost",
						"submit_by" => auth()->user()->associate_id,
						"submit_to" => $approvalLevel->level_3,
						"comments"  => null,
						"status"    => 1,
						"created_on"  => date("Y-m-d H:i:s"),
						"mr_order_bom_n_costing_id"  => $request->segment(3),
						"level"     => 3,
						]); 
					}
					else if ($request->level == 3)
					{ 
		    			// update mr style table status = 2
						DB::table("mr_order_entry")
						->where("order_id",  $request->segment(3))
						->update([
						"order_status" => "Costed" 
						]); 
					}

					return redirect("merch/order_costing")
					->with('success', 'Approved successful.');

				}
				/*  
				*----------------------------------------------------
		    	*/

				return redirect("merch/order_costing")
				->with('success', 'Update successful.');
			}
			else
			{
				return back()
				->withInput()
				->with('error', "Incorrect Input!"); 
			}

		} 
	}

	public function approvalButtons($id = null,$unit=null)
	{ 
		$buttons = ""; 

		$AppovalStatus = DB::select("
		SELECT    
		CASE 
		WHEN l.`status` = 2 THEN CONCAT(b.as_name, ' (Approved)')
		WHEN l.`status` = 1 THEN CONCAT(b.as_name, ' (Approval pending)')
		WHEN l.`status` = 0 THEN CONCAT(b.as_name, ' (Decline)')
		END AS name,
		l.status,
		l.comments
		FROM mr_order_costing_approval AS l
		LEFT JOIN hr_as_basic_info AS b
		ON b.associate_id = l.submit_to
		WHERE l.mr_order_bom_n_costing_id = $id
		GROUP BY submit_to
		ORDER BY l.id ASC
		");

		$buttons .= "<table class=\"table table-bordered bg-info\"><tr>";
		foreach ($AppovalStatus as $s) 
		{
			$buttons .= "<td width=\"33.33%\" class='".($s->status==2?'bg-info':'bg-danger')."'><h5 class='text-center'>$s->name</h5><p class='text-center'>$s->comments</p></td>";
		}
		$buttons .= "</tr></table>";


		/* 
		* check style costing status == 0 
		* --------------------------------
    	*/
		$checkStyle = DB::table("mr_order_entry")
		->where("order_id", $id)
		->where("order_status", "Active")
		->OrWhere("order_status", "Approval Pending")
		->exists();



		if ($checkStyle)
		{
    		// get hierarchy level
			$levelHierarchy = DB::table("mr_approval_hirarchy")
			->where("mr_approval_type", "Order Costing")
			->where("unit", $unit)

			->first();



			/*
			* CHECK APPROVAL STATUS
			* --------------------------------------
			*/ 
			$checkOrderCost = DB::table("mr_order_costing_approval")
			->where("mr_order_bom_n_costing_id", $id)
			->where("status", 1);

			

			if ($checkOrderCost->exists())
			{
				$checkOrderCostData = $checkOrderCost->first();

				$approve_id = $checkOrderCostData->id;
				$level     = $checkOrderCostData->level;
				$submit_by = $checkOrderCostData->submit_by;
				$submit_to = $checkOrderCostData->submit_to;
				$comments  = $checkOrderCostData->comments;
				$associate_id = auth()->user()->associate_id;

				if ($submit_to == $associate_id)
				{
					// approve button 
					$buttons .= "
					<div class=\"col-sm-9\">
					<textarea name=\"comments\" class=\"form-control\" placeholder=\"Comments\"></textarea>
					<input type=\"hidden\" name=\"approve_id\" value=\"$approve_id\"/>
					<input type=\"hidden\" name=\"level\" value=\"$level\"/>
					</div>
					<div class=\"col-sm-3\"> 
					<button name=\"confirm_approval_request\" type=\"submit\" class=\"btn btn-success btn-sm\">Approved</button>
					</div>
					";

				}  
				else if ($submit_by == $associate_id)
				{
					// submit button 
					$buttons .= "<div class=\"col-sm-12\"><button type=\"button\" disabled class=\"btn btn-warning btn-sm\">Submit (Approval pending)</button></div>";
				}
			}
			else
			{
				// show only submit button
				// create submitted to
				$checkAppReq = DB::table("mr_order_costing_approval")
				->where("mr_order_bom_n_costing_id", $id)
				->exists();


				if (!$checkAppReq)
				{
					$new_submit_to = $levelHierarchy->level_1; 
					$buttons .= "
					<div class=\"col-sm-9\">
					<input type=\"hidden\" name=\"level\" value=\"1\"/>
					<input type=\"hidden\" name=\"submit_to\" value=\"$new_submit_to\"/>
					</div>
					<div class=\"col-sm-3\">
					<button type=\"submit\" class=\"btn btn-info btn-sm\">Save</button>
					<button type=\"submit\" name=\"request_for_approve\" class=\"btn btn-success btn-sm\">Request for Approval</button>
					</div>
					";
				}

			} 
		} 


		return $buttons;
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
<?php

namespace App\Http\Controllers\Merch\OrderBOM;

use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\BomCostingHistory;
use App\Models\Merch\Brand;
use App\Models\Merch\Buyer;
use App\Models\Merch\OrdBomGmtColor;
use App\Models\Merch\OrdBomItemColorMeasurement;
use App\Models\Merch\OrdBomPlacement;
use App\Models\Merch\OrderBOM;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\Season;
use App\Models\Merch\Style;
use DB, Validator, Response, Form, Exception, DataTables;
use Illuminate\Http\Request;

class OrderBomController extends Controller
{
    //Order List For BOM
	public function showList(){

		$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
		$buyerList= Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name', 'b_id');
		$brandList= Brand::pluck('br_name','br_id');
		$styleList= Style::pluck('stl_no', 'stl_id');
		$seasonList= Season::pluck('se_name', 'se_id');
		return view("merch.order_bom.order_bom_list", compact('buyerList', 'seasonList', 'unitList', 'brandList', 'styleList'));
	}
    // Order List Data for Order BOM
	public function getListData(){
		DB::statement(DB::raw('set @rownum=0'));
		$data= DB::table('mr_order_entry AS OE')
		->select([
			DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'),
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
		return DataTables::of($data)->addIndexColumn()
		->addColumn('action', function ($data) {
			$isBom= OrderBOM::where('order_id', $data->order_id)->exists();
			if($isBom){
				$action_buttons= "<div class=\"btn-group\">
				<a href=".url('merch/order_bom/'.$data->order_id.'/create')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit BOM\">
				<i class=\"ace-icon fa fa-pencil bigger-120\"></i>
				</a>";
				$action_buttons.= "</div>";
				return $action_buttons;
			}
			else{
				$action_buttons= "<div class=\"btn-group\">
				<a href=".url('merch/order_bom/'.$data->order_id.'/create')." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Add BOM\">
				<i class=\"ace-icon fa fa-plus bigger-120\"></i>
				</a>";
				$action_buttons.= "</div>";
				return $action_buttons;
			}
		})
		->rawColumns(['action'])
		->toJson();
	}

	public function categoryWiseItem($data, $catId, $type)
	{

		// row count
		$catRow = array_column($data, 'mr_material_category_mcat_id');
		$vals = array_count_values($catRow);
		//
		$items = "";
		$flug = 0;
		$i = 1;

		
		foreach ($data as $bom) {
			//Dependancy(Color/Size) Checkbox status 
			$color_status= "";
			$color_hidden= "";
			$size_status= "";
			$size_hidden= "";

		 	if($bom->mr_material_category_mcat_id == $catId){

		 		$i++;
		 		$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
				$total     = number_format(($bom->consumption+$extra_qty), 2);
				
					$itemName = "<input type=\"hidden\" name=\"mr_material_category_mcat_id[]\" value=\"$bom->mr_material_category_mcat_id\">
					<input type=\"hidden\" name=\"order_primary_key_id[]\" value=\"$bom->id\">$bom->item_name
					<input type=\"hidden\" name=\"mr_cat_item_id[]\" value=\"$bom->mr_cat_item_id\">";
					
					if($bom->depends_on== 1){
						$color_status= "checked";
						$size_hidden= 'name="size_depends[]"';
					}
					else if($bom->depends_on== 2){
						$size_status= "checked";
						$color_hidden= 'name="color_depends[]"';
					}
					else if($bom->depends_on== 3){
						$color_status= "checked";
						$size_status= "checked";
					}
					else{
						$color_hidden= 'name="color_depends[]"';
						$size_hidden= 'name="size_depends[]"';
					}

					//get itemCode
					$itemCode = "<label>						            <input name=\"color_depends[]\" type=\"checkbox\" value=\"1\" data-validation-optional=\"true\" class=\"ace color_depends\" data-validation=\"checkbox_group\" data-validation-qty=\"min1\" $color_status>
						            <span class=\"lbl\">Color</span>
						            <input $color_hidden type=\"hidden\" value=\"0\" class=\"ace color_depends\">
						        </label>
						        <label>
						            <input name=\"size_depends[]\" type=\"checkbox\" value=\"2\" class=\"ace size_depends\" $size_status>
						            <span class=\"lbl\">Size</span>
						            <input $size_hidden type=\"hidden\" value=\"0\" class=\"ace size_depends\">
						        </label>";

					// get description
			 		$description = "<input type=\"text\" name=\"item_description[]\" class=\"form-control input-sm\" placeholder=\"Description\" value=\"$bom->item_description\"/>";

			 		// get supplier list by category id
					$supplier = $this->supplier($bom->mr_material_category_mcat_id, "mr_supplier_sup_id[]", $bom->mr_supplier_sup_id, [
						"class" => "form-control input-sm no-select supplier",
						"placeholder"     => "Select",
						"data-validation" => "required"
					]);

					// get UoM list
					$uom = $this->uom("uom[]", $bom->uom, [
						"class" => "form-control input-sm no-select",
						"placeholder"     => "Select",
						"data-validation" => "required"
					]);

					// get Article list
					$article = $this->article($bom->mr_supplier_sup_id, "mr_article_id[]", $bom->mr_article_id, [
						"class" => "form-control input-sm no-select bom_article",
						"placeholder"     => "Select",
						"data-validation" => "required"
					]);

					// get composition list
					$composition= DB::table('mr_composition')
									->where('id', $bom->mr_composition_id)
									->pluck('comp_name')
									->first();
					if($composition == null) $composition="N/A";

					// get construction list
					$construction= DB::table('mr_construction')
										->where('id', $bom->mr_construction_id)
										->pluck('construction_name')
										->first();
					if($construction == null) $construction="N/A";

					$consumption = "<input type=\"text\" name=\"consumption[]\" class=\"form-control input-sm calc consumption\" data-validation=\"required\" placeholder=\"Select\" value=\"$bom->consumption\"/>";
					$extra_percent = "<input type=\"text\" name=\"extra_percent[]\" class=\"form-control input-sm calc extra\"  placeholder=\"Extra\" data-validation=\"required\" value=\"$bom->extra_percent\"/>";
					$extra_qty = "<input type=\"text\" class=\"form-control input-sm qty\"  placeholder=\"Extra Qty\" data-validation=\"required\"  value=\"$extra_qty\"/>";
					$total = "<input type=\"text\" class=\"form-control input-sm calc total\"  placeholder=\"Total\" data-validation=\"required\"  value=\"$total\"/>";

				if($type == 'edit'){
					$details = "<a rel='tooltip' data-tooltip-location='right' data-tooltip='$bom->item_name Item Details' class='btn btn-info btn-xs' onclick='itemDetails($bom->mr_material_category_mcat_id, $bom->mr_cat_item_id)' id=\"$bom->item_name\"> <i class='fa fa-list'></i></a> &nbsp; ";
				}else{
					$details = '';
				}
				if($flug == 0){
					$flug = 1;
					$item = "<tr id=\"$bom->mr_cat_item_id\">
									<td rowspan='".$vals[$catId]."' class='vertical-align-center'>$bom->mcat_name</td>
									<td class='vertical-align-center'>$itemName </td>
									<td>$itemCode</td>
									<td>$description</td>
									<td><div class='input-group'>$supplier<span class='input-group-btn'><button type='button' data-toggle='modal' data-target='.newSupplierModal' class='btn btn-xs btn-primary'>+</button></span></div></td>
									<td id='article'>$article</td>
									<td>$composition</td>
									<td>$construction</td>
									<td>$uom</td>
									<td>$consumption</td>
									<td>$extra_percent</td>
									<td>$extra_qty</td>
									<td>$total</td>
									</tr>";
				}else{
					$item = "<tr id=\"$bom->mr_cat_item_id\">
									<td class='vertical-align-center'>$itemName </td>
									<td>$itemCode</td>
									<td>$description</td>
									<td><div class='input-group'>$supplier<span class='input-group-btn'><button type='button' data-toggle='modal' data-target='.newSupplierModal' class='btn btn-xs btn-primary'>+</button></span></div></td>
									<td>$article</td>
									<td>$composition</td>
									<td>$construction</td>
									<td>$uom</td>
									<td>$consumption</td>
									<td>$extra_percent</td>
									<td>$extra_qty</td>
									<td>$total</td>
									</tr>";
				}
		 		$items .= $item;
		 	}
		}

		return $items;
	}

  	//Order BOM form
	public function showForm(Request $request){

		$order= DB::table('mr_order_entry AS OE')
					->where('OE.order_id', $request->id)
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
		//roder id
		$order_id= $request->id;
		$isBom= OrderBOM::where('order_id', $order_id)->exists();
		//style id
		$stl_id= $order->mr_style_stl_id;
		//check whether BOM exists or not
		$stl_exists= DB::table('mr_order_bom_costing_booking')
						->where('mr_style_stl_id', $stl_id)
						->where('order_id', $order_id)
						->exists();

		// If BOM exists then show edit option
		if($isBom){

			//show category select is Modal
			$modalCats = DB::table("mr_material_category AS c")->get();
			$modalItem = "";
			foreach ($modalCats as $cat){
				$modalItem .= "<div class=\"col-sm-4\">
				<h3>$cat->mcat_name</h3>";
				$subItem = DB::table("mr_cat_item AS i")
				->select(
					"i.mcat_id",
					"i.item_name",
					"i.id",
					DB::raw("
						CASE
						WHEN b.mr_cat_item_id THEN 'checked'
						ELSE ''
						END AS isChecked
						")
				)
				->leftJoin("mr_order_bom_costing_booking AS b", function($join) use($order_id) {
					$join->on("b.mr_cat_item_id", "=", "i.id");
					$join->where("b.order_id", $order_id);
				})
				->where("i.mcat_id", $cat->mcat_id)
				->get();
				$name = strtolower(str_replace(" ", "_", $cat->mcat_name));
				$sl = 1;
				$modalItem .= "<ul class=\"list-unstyled\">";
				foreach ($subItem as $sub)
				{
					// load selected category in modal
					$modalItem .= "<li>
					<input type=\"hidden\" value=\"$cat->mcat_id\"/>
					<input type=\"checkbox\" id=\"".$name."_$sl\" name=\"".$name."[]\" value=\"$sub->id\" $sub->isChecked/>
					<label for=\"".$name."_$sl\">".($sl++).". $sub->item_name</label>
					</li>";
				}
				$modalItem .= "</ul>";
				$modalItem .= "</div>";
			}
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
							"b.clr_id",
							"b.size",
							"b.mr_supplier_sup_id",
							"b.mr_article_id",
							"b.mr_composition_id",
							"b.mr_construction_id",
							"b.consumption",
							"b.extra_percent",
							"b.depends_on",
							"b.uom" ,
							"sup.sup_name",
							"clr.clr_code",
							"art.art_name",
							"comp.comp_name",
							"cons.construction_name"
						)
						->leftJoin("mr_material_category AS c", function($join) {
							$join->on("c.mcat_id", "=", "b.mr_material_category_mcat_id");
						})
						->leftJoin("mr_cat_item AS i", function($join) {
							$join->on("i.mcat_id", "=", "b.mr_material_category_mcat_id");
							$join->on("i.id", "=", "b.mr_cat_item_id");
						})
						->leftJoin('mr_material_color AS clr', 'clr.clr_id', 'b.clr_id')
						->leftJoin('mr_supplier AS sup', 'sup.sup_id', 'b.mr_supplier_sup_id')
						->leftJoin('mr_article AS art', 'art.id', 'b.mr_article_id')
						->leftJoin('mr_composition AS comp', 'comp.id', 'b.mr_composition_id')
						->leftJoin('mr_construction AS cons', 'cons.id', 'b.mr_construction_id')
						->where("b.order_id", $order_id)
						->get()
						->toArray();

			$bomItemData = "";

			$bomItemData .= "<tbody id='fabric'>".$this->categoryWiseItem($boms, 1, 'edit')."</tbody>";

			$bomItemData .= "<tbody id='sewing-accessories'>".$this->categoryWiseItem($boms, 2, 'edit')."</tbody>";
			$bomItemData .= "<tbody id='finishing-accessories'>".$this->categoryWiseItem($boms, 3, 'edit')."</tbody>";

		}
		else{
			//---------- BOM ITEM MODAL----------------
			$modalCats = DB::table("mr_material_category AS c")->get();
			$modalItem = "";
			foreach ($modalCats as $cat){
				$modalItem .= "<div class=\"col-sm-4\">
				<h3>$cat->mcat_name</h3>";
				$subItem = DB::table("mr_cat_item AS i")
				->select(
					"i.mcat_id",
					"i.item_name",
					"i.id",
					DB::raw("
						CASE
						WHEN b.mr_cat_item_id THEN 'checked'
						ELSE ''
						END AS isChecked
						")
				)
				->leftJoin("mr_stl_bom_n_costing AS b", function($join) use($stl_id) {
					$join->on("b.mr_cat_item_id", "=", "i.id");
					$join->where("b.mr_style_stl_id", $stl_id);
				})
				->where("i.mcat_id", $cat->mcat_id)
				->get();
				$name = strtolower(str_replace(" ", "_", $cat->mcat_name));

				$sl = 1;
				$modalItem .= "<ul class=\"list-unstyled\">";
				foreach ($subItem as $sub)
				{
						// load selected category in modal
					$modalItem .= "<li>
					<input type=\"hidden\" value=\"$cat->mcat_id\"/>
					<input type=\"checkbox\" id=\"".$name."_$sl\" name=\"".$name."[]\" value=\"$sub->id\" $sub->isChecked/>
					<label for=\"".$name."_$sl\">".($sl++).". $sub->item_name</label>
					</li>";
				}
				$modalItem .= "</ul>";
				$modalItem .= "</div>";
			}

		    //---------- END BOM ITEM MODAL----------------

			/*
			* LOAD BOM ITEM DATA
			*---------------------------------------------
			*/

			$boms = DB::table("mr_stl_bom_n_costing AS b")
						->select(
							"b.id",
							"b.mr_style_stl_id",
							"b.mr_material_category_mcat_id",
							"c.mcat_name",
							"b.mr_cat_item_id",
							"i.item_name",
							"i.item_code",
							"i.dependent_on AS depends_on",
							"b.item_description",
							"b.clr_id",
							"b.size",
							"b.mr_supplier_sup_id",
							"b.mr_article_id",
							"b.mr_composition_id",
							"b.mr_construction_id",
							"b.consumption",
							"b.extra_percent",
							"b.uom" ,
							"sup.sup_name",
							"clr.clr_code",
							"art.art_name",
							"comp.comp_name",
							"cons.construction_name"
						)
						->leftJoin("mr_material_category AS c", function($join) {
							$join->on("c.mcat_id", "=", "b.mr_material_category_mcat_id");
						})
						->leftJoin("mr_cat_item AS i", function($join) {
							$join->on("i.mcat_id", "=", "b.mr_material_category_mcat_id");
							$join->on("i.id", "=", "b.mr_cat_item_id");
						})
						->leftJoin('mr_material_color AS clr', 'clr.clr_id', 'b.clr_id')
						->leftJoin('mr_supplier AS sup', 'sup.sup_id', 'b.mr_supplier_sup_id')
						->leftJoin('mr_article AS art', 'art.id', 'b.mr_article_id')
						->leftJoin('mr_composition AS comp', 'comp.id', 'b.mr_composition_id')
						->leftJoin('mr_construction AS cons', 'cons.id', 'b.mr_construction_id')

						->where("b.mr_style_stl_id", $stl_id)
						->get()
						->toArray();
			
			$bomItemData = "";
			$bomItemData .= "<tbody id='fabric'>".$this->categoryWiseItem($boms, 1, 'create')."</tbody>";
			$bomItemData .= "<tbody id='sewing-accessories'>".$this->categoryWiseItem($boms, 2, 'create')."</tbody>";
			$bomItemData .= "<tbody id='finishing-accessories'>".$this->categoryWiseItem($boms, 3, 'create')."</tbody>";
		}

		/*
		* END BOM ITEM DATA
		*---------------------------------------------
		*/
        //sampleTypes
		$samples = DB::table("mr_stl_sample AS ss")
						->select(DB::raw("GROUP_CONCAT(st.sample_name SEPARATOR ', ') AS name"))
						->leftJoin("mr_sample_type AS st", "st.sample_id", "ss.sample_id")
						->where("ss.stl_id", $stl_id)
						->first();
        //operations
		$operations = DB::table("mr_style_operation_n_cost AS oc")
						->select("o.opr_name")
						->select(DB::raw("GROUP_CONCAT(o.opr_name SEPARATOR ', ') AS name"))
						->leftJoin("mr_operation AS o", "o.opr_id", "oc.mr_operation_opr_id")
						->where("oc.mr_style_stl_id", $stl_id)
						->first();


        //machines
		$machines = DB::table("mr_style_sp_machine AS sm")
						->select(DB::raw("GROUP_CONCAT(m.spmachine_name SEPARATOR ', ') AS name"))
						->leftJoin("mr_special_machine AS m", "m.spmachine_id", "sm.spmachine_id")
						->where("sm.stl_id", $stl_id)
						->first();

		$check_costing= DB::table('mr_order_bom_costing_booking')
							->where('order_id', $order_id)
							->where('bom_term', '!=', null)
							->exists();

   		$countryList = DB::table('mr_country')->pluck('cnt_name','cnt_id');
	 	$items = DB::table("mr_material_category")
					->get();
	 	$itemList = "";

		//Loop  for Selected category list
		foreach ($items as $cat)
		{
			$itemList .= "<div class=\"col-sm-4\">";


			$name = strtolower(str_replace(" ", "_", $cat->mcat_name));

			$sl = 1;
			$itemList .= "<ul class=\"list-unstyled\" style=\"padding-top: 15px;\">";

			$itemList .= "<li>
						 <label>
						 <input name=\"selected_item[]\" type=\"checkbox\" value=\" $cat->mcat_id \" class=\"ace checkbox-input\"><span class=\"lbl\" style=\"font-size: 14px;\">$cat->mcat_name</span>
						 </label>
					</li>";
			$itemList .= "</ul>";
			$itemList .= "</div>";
		}

		return view("merch.order_bom.order_bom_form", compact(
			"order",
			"samples",
			"operations",
			"machines",
			"modalItem",
			"bomItemData",
			"isBom",
			'check_costing',
			'countryList',
			'itemList'
		));
	}

    //Get Item Data
	public function getItemData(Request $request){

		$item_id     = $request->item_id;
		$category_id = $request->category_id;
		$bomItem     = "";
    	#-------------------------------------
		if (!empty($item_id) && !empty($item_id))
		{
			// get category & item
			$item = $this->item($item_id, $category_id);

			// get color list with name
			$color = $this->color("clr_id[]", "", [
				"class" => "form-control input-sm no-select color",
				"placeholder"     => "Select",
				"data-validation" => "required"
			]);

			// get supplier list by category id
			$supplier = $this->supplier($category_id, "mr_supplier_sup_id[]", "", [
				"class" => "form-control input-sm no-select supplier",
				"placeholder"     => "Select",
				"data-validation" => "required"
			]);

			// get UoM list
			$uom = $this->uom("uom[]", "", [
				"class" => "form-control input-sm no-select",
				"placeholder"     => "Select",
				"data-validation" => "required"
			]);

			$bomItem .= "<tr id=\"$item->id\">
			<td class='vertical-align-center'>$item->mcat_name
				<input type=\"hidden\" name=\"mr_material_category_mcat_id[]\" value=\"$item->mcat_id\">
				<input type=\"hidden\" name=\"order_primary_key_id[]\" value=\"0\">
			</td>
			<td class='vertical-align-center'>$item->item_name
				<input type=\"hidden\" name=\"mr_cat_item_id[]\" value=\"$item->id\">
			</td>
			<td>

				<label>
		            <input name=\"color_depends[]\" type=\"checkbox\" value=\"1\" data-validation-optional=\"true\" class=\"ace color_depends\" data-validation=\"checkbox_group\" data-validation-qty=\"min1\">
		            <span class=\"lbl\">Color</span>
					<input name=\"color_depends[]\" type=\"hidden\" value=\"0\" class=\"ace color_depends\">
		        </label>
		        <label>
		            <input name=\"size_depends[]\" type=\"checkbox\" value=\"2\" class=\"ace size_depends\">
		            <span class=\"lbl\">Size</span>
		        	<input name=\"size_depends[]\" type=\"hidden\" value=\"0\" class=\"ace size_depends\">
		        </label>

		    </td>
			<td><input type=\"text\" name=\"item_description[]\" class=\"form-control input-sm\" placeholder=\"Description\"/></td>
			<td><div class='input-group'>$supplier<span class='input-group-btn'><button type='button' data-toggle='modal' data-target='.newSupplierModal' class='btn btn-xs btn-primary'>+</button></span></div></td>
			<td id='article'><select class='form-control input-sm no-select bom_article' data-validation=\"required\" data-validation-optional=\"true\"><option value=\"\">Select</option></td>
			<td></td>
			<td></td>
			<td>$uom</td>
			<td><input type=\"text\" name=\"consumption[]\" class=\"form-control input-sm calc consumption\" data-validation=\"required\" placeholder=\"Select\" value=\"0\"/></td>
			<td><input type=\"text\" name=\"extra_percent[]\" class=\"form-control input-sm calc extra\"  placeholder=\"Extra\" data-validation=\"required\"  value=\"0\"/></td>
			<td><input type=\"text\" class=\"form-control input-sm qty\"  placeholder=\"Extra Qty\" data-validation=\"required\"  value=\"0\"/></td>
			<td><input type=\"text\" class=\"form-control input-sm calc total\"  placeholder=\"Total\" data-validation=\"required\"  value=\"0.00\"/></td>
			</tr>";
		}
		$result['category_id'] = $category_id;
		$result['value'] = $bomItem;
		return $result;
	}

	// get category & item
	public function item($item_id = "", $category_id = ""){

		return DB::table("mr_cat_item AS i")
		->select(
			"i.id",
			"c.mcat_id",
			"c.mcat_name",
			"i.item_name",
			"i.item_code"
		)
		->leftJoin("mr_material_category AS c", "c.mcat_id", "i.mcat_id")
		->where("i.id", $item_id)
		->where("i.mcat_id", $category_id)
		->first();
	}

	// get color list with name
	public function color($name = "", $selected = "", $option = []){

		$colors = DB::table("mr_material_color")
		->pluck("clr_code", "clr_id");
		$selectedColor = DB::table("mr_material_color")
		->where("clr_id", $selected)
		->value("clr_code");

		$option["style"] = "background:$selectedColor";

		return Form::select($name, $colors, $selected, $option);
	}

	// get supplier list by item id
	public function supplier($mcat_id = "", $name = "", $selected = "", $option = []){

		$suppliers = DB::table("mr_supplier_item_type AS si")
		->leftJoin("mr_supplier AS s", "s.sup_id", "=", "si.mr_supplier_sup_id")
		->where("si.mcat_id", $mcat_id)
		->pluck("s.sup_name", "s.sup_id");

		return Form::select($name, $suppliers, $selected, $option);
	}

	// get article list by supplier id
	public function article($supplier_id="", $name="", $selected="", $option = []){

		if (request()->has("supplier_id"))
		{
			$supplier_id = request()->get("supplier_id");
			$name        = request()->get("name");
			$selected    = request()->get("selected");
			$option      = request()->get("option");
		}


		$articles = DB::table("mr_article")
						// ->where("mr_supplier_sup_id", $supplier_id)
						->pluck("art_name", "id");
		
		$html = "<div class='input-group'>";
		$html .=  Form::select($name, $articles, $selected, $option);
		$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newArticleModal' class='btn btn-xs btn-primary'>+</button></span></div>";
		return $html;
	}

	// get composition list by supplier id
	public function composition($supplier_id="", $name="", $selected="", $option = []){

		if (request()->has("supplier_id"))
		{
			$supplier_id = request()->get("supplier_id");
			$name        = request()->get("name");
			$selected    = request()->get("selected");
			$option      = request()->get("option");
		}

		$compositions = DB::table("mr_composition")
		->where("mr_supplier_sup_id", $supplier_id)
		->pluck("comp_name", "id");

		$html = "<div class='input-group'>";
		$html .=  Form::select($name, $compositions, $selected, $option);
		$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newCompositionModal' class='btn btn-xs btn-primary'>+</button></span></div>";
		return $html;
	}

	// get construction list by supplier id
	public function construction($supplier_id="", $name="", $selected="", $option = []){

		if (request()->has("supplier_id"))
		{
			$supplier_id = request()->get("supplier_id");
			$name        = request()->get("name");
			$selected    = request()->get("selected");
			$option      = request()->get("option");
		}

		$constructions = DB::table("mr_construction")
		->where("mr_supplier_sup_id", $supplier_id)
		->pluck("construction_name", "id");

		$html = "<div class='input-group'>";
		$html .=  Form::select($name, $constructions, $selected, $option);
		$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newConstructionModal' class='btn btn-xs btn-primary'>+</button></span></div>";
		return $html;
	}

	// get UoM list
	public function uom($name = "", $selected = "", $option = []){

		$list = [
			"Millimeter" => "Millimeter",
			"Centimeter" => "Centimeter",
			"Meter" => "Meter",
			"Inch" => "Inch",
			"Feet" => "Feet",
			"Yard" => "Yard",
			"Piece" => "Piece"
		];
		return Form::select($name, $list, $selected, $option);
	}

    // create new article by supplier id
	public function createArticle(Request $request){

		$data = array();
		if (!empty($request->supplier_id) && $request->article_name)
		{
			try
			{
				$id = DB::table("mr_article")->insertGetId([
					"art_name" => $request->article_name,
					"mr_supplier_sup_id" => $request->supplier_id,
				]);

				$articles = DB::table("mr_article")
				->where("mr_supplier_sup_id", $request->supplier_id)
				->pluck("art_name", "id");

				$html = "<div class='input-group'>";
				$html .=  Form::select($request->name, $articles, $id, $request->option);
				$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newArticleModal' class='btn btn-xs btn-primary'>+</button></span></div>";

				$data["status"] = true;
				$data["message"] = "Saved successful";
				$data["result"] = $html;
			}
			catch(\Exception $e)
			{
				$data["status"] = false;
				$data["message"] = "Article already exists!";
			}
		}
		else
		{
			$data['status'] = false;
			$data['message'] = "Please fill up all required fields!";
		}

		return Response::json($data);
	}

    // create new composition by supplier id
	public function createComposition(Request $request){

		$data = array();

		if (!empty($request->supplier_id) && $request->composition_name)
		{
			try
			{
				$id = DB::table("mr_composition")->insertGetId([
					"comp_name" => $request->composition_name,
					"mr_supplier_sup_id" => $request->supplier_id,
				]);

				$compositions = DB::table("mr_composition")
				->where("mr_supplier_sup_id", $request->supplier_id)
				->pluck("comp_name", "id");

				$html = "<div class='input-group'>";
				$html .=  Form::select($request->name, $compositions, $id, $request->option);
				$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newCompositionModal' class='btn btn-xs btn-primary'>+</button></span></div>";

				$data["status"] = true;
				$data["message"] = "Saved successful";
				$data["result"] = $html;
			}
			catch(\Exception $e)
			{
				$data["status"] = false;
				$data["message"] = "Composition already exists!";
			}
		}
		else
		{
			$data['status'] = false;
			$data['message'] = "Please fill up all required fields!";
		}

		return Response::json($data);
	}

    // create new construction by supplier id
	public function createConstruction(Request $request){

		$data = array();

		if (!empty($request->supplier_id) && $request->construction_name)
		{
			try
			{
				$id = DB::table("mr_construction")->insertGetId([
					"construction_name" => $request->construction_name,
					"mr_supplier_sup_id" => $request->supplier_id,
				]);

				$construction = DB::table("mr_construction")
				->where("mr_supplier_sup_id", $request->supplier_id)
				->pluck("construction_name", "id");

				$html = "<div class='input-group'>";
				$html .=  Form::select($request->name, $construction, $id, $request->option);
				$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newCompositionModal' class='btn btn-xs btn-primary'>+</button></span></div>";

				$data["status"] = true;
				$data["message"] = "Saved successful";
				$data["result"] = $html;
			}
			catch(\Exception $e)
			{
				$data["status"] = false;
				$data["message"] = "Construction already exists!";
			}
		}
		else
		{
			$data['status'] = false;
			$data['message'] = "Please fill up all required fields!";
		}

		return Response::json($data);
	}

  /**
   * Edit the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  	public function previewOrder($orderId){
  		$order= DB::table('mr_order_entry AS OE')
			  	->where('OE.order_id', $orderId)
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

  		$orderItems = OrderBOM::getOrderBomOrderIdWiseSelectItemIdName($orderId);
  		$orderDetails = OrdBomPlacement::getOrderItemDetailsOrderIdWise($orderId);
		//echo "<pre>"; print_r($orderDetails); exit;
  		return view("merch.order_bom.order_bom_preview", compact('order', 'orderItems', 'orderDetails'));
  	}

  	//store and update Order BOMS
  	public function storeData(Request $request){
  		
	  	$validator = Validator::make($request->all(), [
	  		"mr_style_stl_id"    => "required|max:11",
	  		"mr_material_category_mcat_id" => "required|max:11",
	  		"mr_cat_item_id.*"   => "required|max:11",
	  		"mr_supplier_sup_id.*" => "required|max:11",
	  		"uom.*"                => "required",
	  		"consumption.*"        => "required|max:128",
	  		"extra_percent.*"      => "required|max:11",
	  	]);

	  	if ($validator->fails()){
	  		return back()
	  		->withErrors($validator)
	  		->withInput()
	  		->with('error', "Incorrect Input!! 1");
	  	}
	  	else{
	    	//get order ID
	  		$order_id= request()->segment(3);
			//check bom available or not for this order
	  		$bom_exists= OrderBOM::where('order_id', $order_id)->exists();

	  		if($bom_exists){
				//Delete BOM which are deselected while Editing
				$isSelected= OrderBOM::where('order_id', $order_id)
									//->where('mr_style_stl_id', null)
									->pluck('id');
				
				if((isset($request->order_primary_key_id))== false){
					$request->order_primary_key_id = [ 0 => '0' ];
				}

				//delete de-selected options
				for($i=0; $i<sizeof($isSelected); $i++){
					if(!(in_array($isSelected[$i], $request->order_primary_key_id))){

						$getOrdBom = OrderBOM::findOrFail($isSelected[$i]);
						$getPlacement = OrdBomPlacement::where('order_id', $getOrdBom->order_id)->where('item_id', $getOrdBom->mr_cat_item_id)->get();
						
						$totalPlacement = count($getPlacement);

						
			      		for($dp=0; $dp < $totalPlacement; $dp++) {
			          		$getOrdBomPlacement = OrdBomPlacement::findOrFail($getPlacement[$dp]->id);

			              	foreach($getOrdBomPlacement->gmt_color as $gColor) {
			                  	$getGmtColor = OrdBomGmtColor::findOrFail($gColor->id);
			                  	//delete item color measuremt
			                  	OrdBomItemColorMeasurement::deleteOrdBomItemColorMeasurementGmtColorIdWise($getGmtColor->id);
			                  	//delete gmt color
			                  	$getGmtColor->delete();
			              	}

			              	$getOrdBomPlacement->delete();
			      		}
						OrderBOM::where('id', $isSelected[$i])->delete();
					}
				}

	  			for($i=0; $i<sizeof($request->mr_material_category_mcat_id); $i++){

	  				$depends_on= $request->color_depends[$i]+ $request->size_depends[$i];

  					//get construction and compostion of the article id
					$comp= DB::table('mr_composition')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();
					$cons= DB::table('mr_construction')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();


  					if($request->order_primary_key_id[$i] !=0 ){

						OrderBOM::where('id', $request->order_primary_key_id[$i])
								->update([
									"mr_material_category_mcat_id" => $request->mr_material_category_mcat_id[$i],
									"mr_cat_item_id"     => $request->mr_cat_item_id[$i],
									"item_description"   => $request->item_description[$i],
									"clr_id"             => $request->clr_id[$i],
									"size"               => $request->size[$i],
									"mr_supplier_sup_id" => $request->mr_supplier_sup_id[$i],
									"mr_article_id"      => $request->mr_article_id[$i],
									"mr_composition_id"  => $comp,
									"mr_construction_id" => $cons,
									"uom"            => $request->uom[$i],
									"consumption"    => $request->consumption[$i],
									"extra_percent"  => $request->extra_percent[$i],
									"order_id"  => $order_id,
									"depends_on"  => $depends_on
								]);
					}
	  				else{


  						$insert = array();
  						$insert = array(
  							"mr_material_category_mcat_id" => $request->mr_material_category_mcat_id[$i],
  							"mr_cat_item_id"     => $request->mr_cat_item_id[$i],
  							"item_description"   => $request->item_description[$i],
  							"clr_id"             => $request->clr_id[$i],
  							"size"               => $request->size[$i],
  							"mr_supplier_sup_id" => $request->mr_supplier_sup_id[$i],
  							"mr_article_id"      => $request->mr_article_id[$i],
  							"mr_composition_id"  => $comp,
  							"mr_construction_id" => $cons,
  							"uom"            => $request->uom[$i],
  							"consumption"    => $request->consumption[$i],
  							"extra_percent"  => $request->extra_percent[$i],
  							"order_id"  => $order_id,
  							"depends_on"  => $depends_on
  						);
  						$x= OrderBOM::insertGetId($insert);
	  					
	  				}
	  			}
	  			return back()->with('success', 'Updated successful.');
	  		}
	  		else{
				/*
				* Order BOMs insert
				*/
				if (is_array($request->mr_material_category_mcat_id) && sizeof($request->mr_material_category_mcat_id) > 0){
					$insert = array();
					for ($i=0; $i<sizeof($request->mr_material_category_mcat_id); $i++)
					{

						$depends_on= $request->color_depends[$i]+ $request->size_depends[$i];


						//get construction and compostion of the article id
						$cons= DB::table('mr_construction')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();
						$comp= DB::table('mr_composition')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();


						$insert = array(
							"mr_material_category_mcat_id" => $request->mr_material_category_mcat_id[$i],
							"mr_cat_item_id"     => $request->mr_cat_item_id[$i],
							"item_description"   => $request->item_description[$i],
							"clr_id"             => $request->clr_id[$i],
							"size"               => $request->size[$i],
							"mr_supplier_sup_id" => $request->mr_supplier_sup_id[$i],
							"mr_article_id"      => $request->mr_article_id[$i],
							"mr_composition_id"  => $comp,
							"mr_construction_id" => $cons,
							"uom"            => $request->uom[$i],
							"consumption"    => $request->consumption[$i],
							"extra_percent"  => $request->extra_percent[$i],
							"order_id"  => $order_id,
							"depends_on"  => $depends_on
						);
						OrderBOM::insert($insert);
					}
				}
				return back()->with('success', 'Save successful!');
			}
		}
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}

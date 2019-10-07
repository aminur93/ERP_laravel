<?php

namespace App\Http\Controllers\Merch\StyleCosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Buyer;
use App\Models\Merch\Season;
use App\Models\Merch\BomCosting;
use App\Models\Merch\BomOtherCosting;
use App\Models\Merch\Style;
use App\Models\Merch\Approval;
use DB, Validator, DataTables, Form, Session;

class StyleCostingController extends Controller
{
    /**
     * Display a listing of the style bom resource.
     * @method showList()
     * @param No parameter
     * @return Style BOM List
    */

    public function showList()
    {
        $buyerList  = Buyer::whereIn('b_id', auth()->user()->buyer_permissions())
                        ->pluck('b_name', 'b_id');
        $seasonList = Season::pluck('se_name','se_id');
    	return view("merch.style_costing.style_costing_list", compact(
            'buyerList',
            'seasonList'
        ));
    }

    public function getListData(Request $request)
    {
            // dd($request->all());exit;
    	$data = DB::table("mr_stl_bom_n_costing AS sb")
    		->select(
    			"s.stl_id",
    			"sb.mr_style_stl_id",
    			"sb.bom_term",
    			"s.stl_type",
    			"s.stl_no",
    			"b.b_name",
    			"t.prd_type_name",
    			"g.gmt_name",
    			"s.stl_product_name",
    			"s.stl_description",
    			"se.se_name",
    			"s.stl_smv",
    			"s.stl_img_link",
    			"s.stl_status"
    		)
			->leftJoin("mr_style AS s", "s.stl_id", "=",  "sb.mr_style_stl_id")
			->leftJoin("mr_buyer AS b", "b.b_id", "=", "s.mr_buyer_b_id")
			->whereIn('b.b_id', auth()->user()->buyer_permissions())
			->leftJoin("mr_product_type AS t", "t.prd_type_id", "=", "s.prd_type_id")
			->leftJoin("mr_garment_type AS g", "g.gmt_id", "=", "s.gmt_id")
			->leftJoin("mr_season AS se", "se.se_id", "=", "s.mr_season_se_id")
			->groupBy("s.stl_id")
			->orderBy('s.stl_id', 'desc')
			->get();


		//dd($data);exit;
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('stl_type', function ($data) {
                if ($data->stl_type == "Bulk")
                {
                    return "<span class='text-primary'>$data->stl_type</span>";
                }
                else
                {
                    return "<span class='text-warning'>$data->stl_type</span>";
                }
            })
            ->editColumn('stl_status', function ($data) {
                if ($data->stl_status == "0")
                {
                    return "<button class=\"btn btn-xs btn-primary btn-round\">Created</button>";
                }
                else if($data->stl_status == "1")
                {
                  $approvalLevel = DB::table('mr_stl_costing_approval')
                                  ->leftJoin('users','mr_stl_costing_approval.submit_to','users.associate_id')
                                  ->where('mr_style_stl_id',$data->mr_style_stl_id)
                                  ->where('status',1)
                                  ->first();

                    if(!empty($approvalLevel)){
                    	return "<button class=\"btn btn-xs btn-danger btn-round\" rel='tooltip' data-tooltip=\"In Level-$approvalLevel->level To $approvalLevel->name\" data-tooltip-location='top' >
                            Pending</button>";
                        }else{
                        	return "<button class=\"btn btn-xs btn-danger btn-round\" rel='tooltip' data-tooltip=\"In Level-Unknown To Unknown\" data-tooltip-location='top' >
                            Pending</button>";
                        }
                }else if($data->stl_status == "2")
                {
                    return "<button class=\"btn btn-xs btn-success btn-round\">Approved</button>";
                }
            })
            ->editColumn('action', function ($data) {
                $return = "<div class=\"btn-group\">";
            	if (empty($data->bom_term))
            	{
            		$return .= "<a href=".url('merch/style_costing/'.$data->stl_id.'/create')." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Pre-Costing\">Pre-Costing$data->bom_term</a>";
            	}
            	else
            	{
                    $return .= "<a href=".url('merch/style_costing/'.$data->stl_id.'/edit')." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit\">
                     		<i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                        </a>";
            	}
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'stl_type',
                'stl_status',
                'action'
            ])
            ->make(true);
    }


    /**
     * Create the specified resource.
     *
     * @param  int  $id - style bom id
     * @return \Illuminate\Http\Response
     */

    public function showForm(Request $request)
    {
    	// check if exist data in mr_approval_type table
		$styleData = Style::where(['stl_id' => $request->id])->first();
    	$levelHierarchy = Approval::where(["mr_approval_type" => "Style Costing", "unit" => $styleData->unit_id])->first();
    	// if data not found
    	if(!isset($levelHierarchy->id)) {
    		return back()
	            ->with('lavelhierarchy', "Level Hierarchy data not found.");
    	}
    	$id = $request->id;
    	$style = DB::table("mr_style AS s")
    		->select(
    			"s.stl_id",
    			"s.stl_type",
    			"s.stl_no",
    			"b.b_name",
    			"t.prd_type_name",
    			"g.gmt_name",
    			"s.stl_product_name",
    			"s.stl_description",
    			"se.se_name",
    			"s.stl_smv",
    			"s.stl_img_link"
    		)
			->leftJoin("mr_buyer AS b", "b.b_id", "=", "s.mr_buyer_b_id")
			->whereIn('b.b_id', auth()->user()->buyer_permissions())
			->leftJoin("mr_product_type AS t", "t.prd_type_id", "=", "s.prd_type_id")
			->leftJoin("mr_garment_type AS g", "g.gmt_id", "=", "s.gmt_id")
			->leftJoin("mr_season AS se", "se.se_id", "=", "s.mr_season_se_id")
			->where("s.stl_id", $id)
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
		$boms = DB::table("mr_stl_bom_n_costing AS b")
			->select(
			    "b.precost_fob",
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
                "msoc.testing_cost"
			)
			->leftJoin("mr_material_category AS c", function($join) {
				$join->on("c.mcat_id", "=", "b.mr_material_category_mcat_id");
			})
			->leftJoin("mr_cat_item AS i", function($join) {
				$join->on("i.mcat_id", "=", "b.mr_material_category_mcat_id");
				$join->on("i.id", "=", "b.mr_cat_item_id");
			})
            ->leftJoin("mr_stl_bom_other_costing AS msoc","msoc.mr_style_stl_id","b.mr_style_stl_id")
			->leftJoin("mr_material_color AS mc", "mc.clr_id", "b.clr_id")
			->leftJoin("mr_supplier AS s", "s.sup_id", "b.mr_supplier_sup_id")
			->leftJoin("mr_article AS a", "a.id", "b.mr_article_id")
			->leftJoin("mr_composition AS com", "com.id", "b.mr_composition_id")
			->leftJoin("mr_construction AS con", "con.id", "b.mr_construction_id")
			->where("b.mr_style_stl_id", $id)
			->orderBy("b.mr_material_category_mcat_id")
			->get();
		
	    $bomItemData = "";
	    $previousCategory = null;
	    $previousCategoryName = null;
	    $loop = 0;
	    $subtotalName = "no_category";
		foreach ($boms as $bom) {
			// show subtotal
			if ($loop == 0) {
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
			} else if (($previousCategory != $bom->mr_material_category_mcat_id)) {
				if ($previousCategory==1) {
					$subtotalName = "total_fabric";
				} else if ($previousCategory==2) {
					$subtotalName = "total_sewing";
				} else {
					$subtotalName = "total_finishing";
				}
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\" step=\"0.01\" /></th></tr>";
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
			}
			// ---------------------------------

			$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
			$total     = number_format(($bom->consumption+$extra_qty), 2);

			$bomItemData .= "<tr>
				<td>
					<input type=\"hidden\" name=\"mr_style_stl_id\" value=\"$request->id\"/>
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
				<td><input name=\"precost_fob[]\" type=\"number\" min='0' class=\"fob form-control input-sm\" placeholder=\"0\" readonly value=\"$bom->precost_fob\" autocomplete=\"off\" step=\"0.01\" /></td>
				<td><input name=\"precost_lc[]\" type=\"number\" min='0' class=\"lc form-control input-sm\" placeholder=\"L/C\" readonly step=\"0.01\" value=\"0\" data-validation=\"required\" autocomplete=\"off\"/></td>
				<td><input name=\"precost_freight[]\" type=\"number\" min='0' step=\"0.01\" class=\"freight form-control input-sm\" placeholder=\"Freight\" readonly value=\"0\" data-validation=\"required\" autocomplete=\"off\"/></td>
				<td><input name=\"precost_unit_price[]\" type=\"number\" min='0' class=\"form-control input-sm unit_price\" step=\"0.01\" placeholder=\"Unit Price\" value=\"0\" data-validation=\"required\" autocomplete=\"off\"/></td>
				<td><input type=\"text\" step=\"0.01\" class=\"form-control input-sm total_price total_category_price\" data-cat-id=\"$bom->mr_material_category_mcat_id\" placeholder=\"Total Price\" value=\"0\" data-validation=\"required\" readonly/></td>

			</tr>";


			// show subtotal
			if ($loop+1 == sizeof($boms)) {
				if ($previousCategory==1) {
					$subtotalName = "total_fabric";
				} else if ($previousCategory==2) {
					$subtotalName = "total_sewing";
				} else {
					$subtotalName = "total_finishing";
				}
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\"/></th></tr>";
			}
			// ---------------------------------

			$loop++;
		}

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
		foreach ($special_operation as $spo) {
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
					<input type=\"number\" min='0' name=\"unit_price[]\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"0\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Total Price\" value=\"0\" readonly/>
				</td>

			</tr>";
		}

		$bomItemData .= "
			<tr>
				<td colspan='10' class='text-center'>Testing Cost</td>
				<td class='consumption'>1</td>
				<td>0</td>
				<td>Piece</td>
				<td colspan='4'></td>
				<td>
					<input name=\"testing_cost\" type=\"number\" min='0' class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"0\" step=\"0.01\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"0\" readonly/>
				</td>

			</tr>
			<tr>
				<td colspan='10' class='text-center'>CM</td>
				<td class='consumption'>1</td>
				<td>0</td>
				<td>Piece</td>
				<td colspan='4'></td>
				<td>
					<input name=\"cm\" type=\"number\" min='0' class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"0\" step=\"0.01\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"0\" readonly/>
				</td>

			</tr>

			<tr>
				<td colspan='10' class='text-right'>Commercial cost</td>

				<td colspan='7' class='text-left'></td>
				<td>
					<input name=\"commercial_cost\" type=\"number\" min='0' class=\"form-control input-sm sp_price\" placeholder=\"Price Unit\" value=\"0\" step=\"0.01\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Commercial cost\" value=\"0\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Net FOB </th>
				<th>
					<input name=\"net_fob\" type=\"text\" class=\"form-control input-sm net_fob\" placeholder=\"Net FOB\" value=\"0\" readonly/>
				</th>

			</tr>
			<tr>
				<td colspan='10' class='text-right'>Buyer Commision</td>
				<td><input name=\"buyer_comission_percent\" type=\"number\" step=\"0.01\" min='0' class=\"form-control buyer_comission_percent\" placeholder=\"Buyer Commision\" value=\"0\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>
				<td>
					<input type=\"text\" name=\"buyer_commision\" class=\"form-control input-sm buyer_price sp_price\" placeholder=\"Unit Price\" value=\"0\" readonly/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm buyer_total_price sp_total_price\" placeholder=\"Buyer Commision \" value=\"0\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Buyer FOB </th>
				<th>
					<input name=\"buyer_fob\" type=\"text\" class=\"form-control input-sm buyer_fob\" placeholder=\"Buyer FOB\" value=\"0\" readonly/>
				</th>

			</tr>
			<tr>
				<td colspan='10' class='text-right'>Agent Commision</td>
				<td><input name=\"agent_comission_percent\" type=\"number\" step=\"0.01\" min='0' class=\"form-control agent_comission_percent\" placeholder=\"Agent Commision\" value=\"0\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>
				<td>
					<input type=\"text\" name=\"agent_commision\" class=\"form-control input-sm agent_price sp_price\" placeholder=\"Unit Price\" value=\"0\" readonly/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm agent_total_price sp_total_price\" placeholder=\"Agent Commision \" value=\"0\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Agent FOB </th>
				<th>
					<input name=\"agent_fob\" type=\"text\" class=\"form-control input-sm agent_fob\" placeholder=\"Agemt FOB\" value=\"0\" readonly/>
				</th>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Total FOB </th>
				<th>
					<input name=\"final_fob\" type=\"text\" class=\"form-control input-sm total_fob\" placeholder=\"Final FOB\" value=\"0\" readonly/>
				</th>

			</tr>";

		/*
		* APPROVAL LEVEL
		*----------------------------------------------------------------
		*----------------------------------------------------------------
		*/
		$buttons = $this->approvalButtons($id);


    	return view("merch.style_costing.style_costing_form", compact(
    		"style",
    		"samples",
    		"operations",
    		"machines",
    		"modalItem",
    		"bomItemData",
    		"buttons"
    	));
    }

	/*
	* BOM & COSTING APPROVAL BUTTON
	*----------------------------------------------------------------
	*/
    public function approvalButtons($id = null)
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
			FROM mr_stl_costing_approval AS l
			LEFT JOIN hr_as_basic_info AS b
				ON b.associate_id = l.submit_to
			WHERE l.mr_style_stl_id = $id
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
    	$checkStyle = DB::table("mr_style")
    		->where("stl_id", $id)
    		->where("stl_status", null)
    		->orWhere("stl_status", "0")
    		->orWhere("stl_status", "1")
    		->exists();


    	if ($checkStyle)
    	{
    		// get hierarchy level
			$levelHierarchy = DB::table("mr_approval_hirarchy")
				->where("mr_approval_type", "Style Costing")
				->first();


			/*
			* CHECK APPROVAL STATUS
			* --------------------------------------
			*/
			$checkStyleCost = DB::table("mr_stl_costing_approval")
				->where("mr_style_stl_id", $id)
				->where("status", "1");

			if ($checkStyleCost->exists())
			{
				$checkStyleCostData = $checkStyleCost->first();

				$approve_id = $checkStyleCostData->id;
				$level     = $checkStyleCostData->level;
				$submit_by = $checkStyleCostData->submit_by;
				$submit_to = $checkStyleCostData->submit_to;
				$comments  = $checkStyleCostData->comments;
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
				$checkAppReq = DB::table("mr_stl_costing_approval")
					->where("mr_style_stl_id", $id)
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


    public function store(Request $request)
    {
    	// check if exist data in mr_approval_type table
    	$mr_style_data 	= Style::where(['stl_id' => $request->mr_style_stl_id])->first();
    	$levelHierarchy = Approval::where(["mr_approval_type" => "Style Costing", "unit" => $mr_style_data->unit_id])->first();
    	// if data not found
    	if(!isset($levelHierarchy->id)) {
    		return redirect('merch/style_costing')
	            ->with('lavelhierarchy', "Level Hierarchy data not found.");
    	}
   	    $validator = Validator::make($request->all(), [
   	    	// mr_stl_bom_n_costing - update
			"id.*"          => "required|max:11",
//			"bom_term.*"    => "required|max:11",
//			"precost_fob.*" => "required|max:11",
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
    	if ($validator->fails()) {
    		return back()
    			->withErrors($validator)
    			->withInput()
	            ->with('error', "Incorrect Input!!");
    	} else {
			// Store Style Bom and Costing
    		if (is_array($request->id) && sizeof($request->id) > 0) {
   	    		// mr_stl_bom_n_costing - update
    			for ($i=0; $i<sizeof($request->id); $i++) {
    				$update = array(
    					"bom_term"    => $request->bom_term[$i],
    					"precost_fob" => $request->precost_fob[$i],
                        "precost_lc"  => $request->precost_lc[$i],
                        "precost_freight"     => $request->precost_freight[$i],
                        "precost_unit_price"  => $request->precost_unit_price[$i],
                        "precost_req_qty"     => $request->precost_req_qty[$i],
                        "precost_value"       => $request->precost_value[$i],
    				);
					BomCosting::where("id", $request->id[$i])->update($update);
			    	//------------store log history--------------
			    	$this->logFileWrite("Style BOM and Costing created", $request->id[$i]);
			    	//---------------------------------------
    			}

	   	    	// mr_style_operation_n_cost - update
	    		if (is_array($request->style_op_id) && sizeof($request->style_op_id) > 0) {
    				for ($i=0; $i<sizeof($request->style_op_id); $i++) {
	    				$update = array(
	    					"style_op_id" => $request->style_op_id[$i],
	                        "uom"         => $request->uom[$i],
	                        "unit_price"  => $request->unit_price[$i]
	    				);
				    	//---------------------------------------
						DB::table("mr_style_operation_n_cost")
							->where("style_op_id", $request->style_op_id[$i])
							->update($update);

				    	//------------store log history--------------
				    	$this->logFileWrite("Style Operation updated", $request->style_op_id[$i]);
				    	//---------------------------------------
    				}
	    		}

	   	    	// mr_stl_bom_other_costing - insert
				$id = BomOtherCosting::insertGetId([
					"cm"           	=> $request->cm,
					"net_fob" 		=> $request->net_fob,
					"agent_fob"     => $request->agent_fob,
					"buyer_fob" 	=> $request->buyer_fob,
					"testing_cost" 	=> $request->testing_cost,
					"mr_style_stl_id"  	=> $request->mr_style_stl_id,
					"commercial_cost" 	=> $request->commercial_cost,
					"buyer_comission_percent" 	=> $request->buyer_comission_percent,
					"agent_comission_percent"   => $request->agent_comission_percent

	    		]);
		    	//------------store log history--------------
		    	$this->logFileWrite("Style Bom & Other Costing created", $id);
		    	//---------------------------------------

		    	/*
		    	*----------------------------------------------------
		    	* request_for_approve
		    	*----------------------------------------------------
		    	*/
		    	if ($request->has("request_for_approve") && !empty($request->submit_to)) {
		    		DB::table("mr_stl_costing_approval")
		    			->insert([
		    				"title" 	=> "precost",
		    				"level"     => $request->level,
		    				"submit_by" => auth()->user()->associate_id,
		    				"submit_to" => $request->submit_to,
		    				"comments"  => $request->comments,
		    				"status"    => 1,
		    				"created_on"  		=> date("Y-m-d H:i:s"),
		    				"mr_style_stl_id" 	=> $request->mr_style_stl_id
		    			]);
		              DB::table("mr_style")
		              ->where("stl_id",  $request->mr_style_stl_id)
		              ->update([
		                "stl_status" => 1
		              ]);
                	return redirect("merch/style_costing")
                    	->with('success', 'Request for approval successful.');
		    	}
		    	/*
		    	*----------------------------------------------------
		    	*/
                return redirect("merch/style_costing")
                    ->with('success', 'Save successful.');
    		} else {
	    		return back()
	    			->withInput()
		            ->with('error', "Incorrect Input!");
    		}
    	}
    }


    /**
     * Update the specified resource.
     *
     * @param  int  $id - style bom id
     * @return \Illuminate\Http\Response
     */

    public function editForm(Request $request)
    {
    	$id = $request->id;
    	$style = DB::table("mr_style AS s")
    		->select(
    			"s.stl_id",
    			"s.stl_type",
    			"s.stl_no",
    			"b.b_name",
    			"t.prd_type_name",
    			"g.gmt_name",
    			"s.stl_product_name",
    			"s.stl_description",
    			"se.se_name",
    			"s.stl_smv",
    			"s.stl_img_link"
    		)
			->leftJoin("mr_buyer AS b", "b.b_id", "=", "s.mr_buyer_b_id")
			->whereIn('b.b_id', auth()->user()->buyer_permissions())
			->leftJoin("mr_product_type AS t", "t.prd_type_id", "=", "s.prd_type_id")
			->leftJoin("mr_garment_type AS g", "g.gmt_id", "=", "s.gmt_id")
			->leftJoin("mr_season AS se", "se.se_id", "=", "s.mr_season_se_id")
			->where("s.stl_id", $id)
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
		$boms = DB::table("mr_stl_bom_n_costing AS b")
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
			->where("b.mr_style_stl_id", $id)
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

				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th><th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\"/></th></tr>";
				$previousCategory = $bom->mr_material_category_mcat_id;
				$previousCategoryName = $bom->mcat_name;
			}
			// ---------------------------------

			$extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
			$consumptionEx = $bom->consumption + $extra_qty;
			$total_price = number_format(($consumptionEx*$bom->precost_unit_price), 2);
			$total     = number_format(($bom->consumption+$extra_qty), 2);

			$bomItemData .= "<tr>
				<td>
					<input type=\"hidden\" name=\"mr_style_stl_id\" value=\"$request->id\"/>
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
				<td><input name=\"precost_fob[]\" type=\"number\" min='0' step=\"0.01\" class=\"fob form-control input-sm\" placeholder=\"0\" value=\"$bom->precost_fob\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
				<td><input name=\"precost_lc[]\" type=\"number\" min='0' step=\"0.01\" class=\"lc form-control input-sm\" placeholder=\"0\" value=\"$bom->precost_lc\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
				<td><input name=\"precost_freight[]\" type=\"number\" min='0' step=\"0.01\" class=\"freight form-control input-sm\" placeholder=\"Freight\" value=\"$bom->precost_freight\" data-validation=\"required\" autocomplete=\"off\" ".($bom->bom_term=='C&F'?'readonly':null)."/></td>
				<td><input name=\"precost_unit_price[]\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm unit_price\" placeholder=\"Unit Price\" value=\"$bom->precost_unit_price\" data-validation=\"required\" autocomplete=\"off\"/></td>
				<td><input type=\"text\" class=\"form-control input-sm total_price total_category_price\" data-cat-id=\"$bom->mr_material_category_mcat_id\" placeholder=\"Total Price\" value=\"$total_price\" data-validation=\"required\" readonly/></td>

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
				$bomItemData .= "<tr><th colspan='18' class='text-center'> Total $previousCategoryName Price</th>
                      <th><input name=\"$subtotalName\" type=\"text\" class=\"fob form-control input-sm subtotal\" data-subtotal=\"$previousCategory\" placeholder=\"Sub Total\" readonly value=\"0\"/></th></tr>";
			}
			// ---------------------------------

			$loop++;
		}
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
					<input type=\"hidden\" name=\"style_op_id[]\" value=\"$spo->style_op_id\"/>
					<input type=\"number\" min='0' step=\"0.01\" name=\"unit_price[]\" class=\"form-control input-sm sp_price\" placeholder=\"Unit Price\" value=\"$spo->unit_price\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Total Price\" value=\"$spo->unit_price\" readonly/>
				</td>

			</tr>";
		}
		/*
		* LOAD OTHER COST
		*---------------------------------------------
		*/
		$other_cost = BomOtherCosting::where('mr_style_stl_id', $id)->first();
		$buyer_commision = floatval($other_cost->buyer_fob) - floatval($other_cost->net_fob);
		$agent_commision = floatval($other_cost->agent_fob) - floatval($other_cost->buyer_fob);
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
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->testing_cost\" readonly/>
				</td>

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
					<input type=\"text\" class=\"form-control input-sm total_price sp_total_price\" placeholder=\"Total Price\" value=\"$other_cost->cm\" readonly/>
				</td>

			</tr>

			<tr>
				<td colspan='10' class='text-right'>Commercial cost</td>

				<td colspan='7' class='text-left'></td>
				<td>
					<input name=\"commercial_cost\" type=\"number\" min='0' step=\"0.01\" class=\"form-control input-sm sp_price\" placeholder=\"Price Unit\" value=\"$other_cost->commercial_cost\"/>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm sp_total_price total_price\" placeholder=\"Commercial cost\" value=\"$other_cost->commercial_cost\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Net FOB </th>
				<th>
					<input name=\"net_fob\" type=\"text\" class=\"form-control input-sm net_fob\" placeholder=\"Net FOB\" value=\"$other_cost->net_fob\" readonly/>
				</th>

			</tr>
			<tr>
				<td colspan='10' class='text-right'>Buyer Commision</td>
				<td><input name=\"buyer_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control buyer_comission_percent\" placeholder=\"Buyer Commision\" value=\"$other_cost->buyer_comission_percent\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>

				<td>
					<input type=\"text\" name=\"buyer_commision\" class=\"form-control input-sm buyer_price sp_price\" placeholder=\"Unit Price\" value=\"$buyer_commision\" readonly>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm buyer_total_price sp_total_price\" placeholder=\"Buyer Commision \" value=\"$buyer_commision\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Buyer FOB </th>
				<th>
					<input name=\"buyer_fob\" type=\"text\" class=\"form-control input-sm buyer_fob\" placeholder=\"Buyer FOB\" value=\"$other_cost->buyer_fob\" readonly/>
				</th>

			</tr>
			<tr>
				<td colspan='10' class='text-right'>Agent Commision</td>
				<td><input name=\"agent_comission_percent\" type=\"number\" min='0' step=\"0.01\" class=\"form-control agent_comission_percent\" placeholder=\"Agent Commision\" value=\"$other_cost->agent_comission_percent\" style=\"width:56px\"></td>
				<td colspan='6' class='text-left'>%</td>
				<td>
					<input type=\"text\" name=\"agent_commision\" class=\"form-control input-sm agent_price sp_price\" placeholder=\"Unit Price\" value=\"$agent_commision\" readonly>
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm agent_total_price sp_total_price\" placeholder=\"Agent Commision \" value=\"$agent_commision\" readonly/>
				</td>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Agent FOB </th>
				<th>
					<input name=\"agent_fob\" type=\"text\" class=\"form-control input-sm agent_fob\" placeholder=\"Agent FOB\" value=\"$other_cost->agent_fob\" readonly/>
				</th>

			</tr>
			<tr>
				<th colspan='18' class='text-center'>Total FOB </th>
				<th>
					<input name=\"final_fob\" type=\"text\" class=\"form-control input-sm total_fob\" placeholder=\"Commision FOB\" value=\"$other_cost->agent_fob\" readonly/>
				</th>

			</tr>";

		/*
		* APPROVAL LEVEL
		*----------------------------------------------------------------
		*/
		$buttons = $this->approvalButtons($id);

    	return view("merch.style_costing.style_costing_edit", compact(
    		"style",
    		"samples",
    		"operations",
    		"machines",
    		"modalItem",
    		"bomItemData",
    		"buttons"
    	));
    }


    public function update(Request $request)
    {
   	    $validator = Validator::make($request->all(), [
   	    	// mr_stl_bom_n_costing - update
			"id.*"          => "required|max:11",
//			"bom_term.*"    => "required|max:11",
//			"precost_fob.*" => "required|max:11",
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
					BomCosting::where("id", $request->id[$i])->update($update);

			    	//------------store log history--------------
			    	$this->logFileWrite("Style BOM and Costing updated", $request->id[$i]);
			    	//---------------------------------------
    			}

	   	    	// mr_style_operation_n_cost - update
	    		if (is_array($request->style_op_id) && sizeof($request->style_op_id) > 0)
	    		{
    				for ($i=0; $i<sizeof($request->style_op_id); $i++)
    				{
	    				$update = array(
	    					"style_op_id" => $request->style_op_id[$i],
	                        "uom"         => $request->uom[$i],
	                        "unit_price"  => $request->unit_price[$i],
	    				);

				    	//---------------------------------------
						DB::table("mr_style_operation_n_cost")
							->where("style_op_id", $request->style_op_id[$i])
							->update($update);

				    	//------------store log history--------------
				    	$this->logFileWrite("Style Operation updated", $request->style_op_id[$i]);
				    	//---------------------------------------
    				}
	    		}

	   	    	// mr_stl_bom_other_costing - insert
				BomOtherCosting::where("id", $request->other_cost_id)
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
		    	$this->logFileWrite("Style Bom & Other Costing updated", $request->other_cost_id);
		    	//---------------------------------------


		    	/*
		    	*----------------------------------------------------
		    	* request_for_approve
		    	*----------------------------------------------------
		    	*/
          // dd($request->all());exit;
		    	if ($request->has("request_for_approve") && !empty($request->submit_to))
		    	{
            // dd($request->all());exit;
		    		DB::table("mr_stl_costing_approval")
		    			->insert([
		    				"title" => "precost",
		    				"mr_style_stl_id" => $request->mr_style_stl_id,
		    				"level"     => $request->level,
		    				"submit_by" => auth()->user()->associate_id,
		    				"submit_to" => $request->submit_to,
		    				"comments"  => $request->comments,
		    				"status"    => 1,
		    				"created_on"  => date("Y-m-d H:i:s"),
		    			]);

              DB::table("mr_style")
              ->where("stl_id",  $request->mr_style_stl_id)
              ->update([
                "stl_status" => 1
              ]);
	            	return redirect("merch/style_costing")
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
		    			->where("mr_approval_type", "Style Costing")
		    			->first();

		    		// update approval status = 2 [request approved]
		    		$approvalData = DB::table("mr_stl_costing_approval")
		    			->where("id", $request->approve_id)
		    			->update([
		    				"comments" => $request->comments,
		    				"status" => 2
		    			]);

	    			if ($request->level == 1)
	    			{
		    			// insert new approval record
						DB::table("mr_stl_costing_approval")
						->insert([
							"title" => "precost",
							"mr_style_stl_id" => $request->mr_style_stl_id,
							"level"     => 2,
							"submit_by" => auth()->user()->associate_id,
							"submit_to" => $approvalLevel->level_2,
							"comments"  => null,
							"status"    => 1,
							"created_on"  => date("Y-m-d H:i:s"),
						]);
	    			}
	    			else if ($request->level == 2)
	    			{
		    			// insert new approval record
						DB::table("mr_stl_costing_approval")
						->insert([
							"title" => "precost",
							"mr_style_stl_id" => $request->mr_style_stl_id,
							"level"     => 3,
							"submit_by" => auth()->user()->associate_id,
							"submit_to" => $approvalLevel->level_3,
							"comments"  => null,
							"status"    => 1,
							"created_on"  => date("Y-m-d H:i:s"),
						]);
	    			}
	    			else if ($request->level == 3)
	    			{
		    			// update mr style table status = 2
						DB::table("mr_style")
						->where("stl_id",  $request->mr_style_stl_id)
						->update([
							"stl_status" => 2
						]);
	    			}

	                return redirect("merch/style_costing")
	                    ->with('success', 'Approved successful.');

		    	}
		    	/*
		    	*----------------------------------------------------
		    	*/

                return redirect("merch/style_costing")
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


    //Write Every Events in Log File
    public function logFileWrite($message, $event_id)
    {
        $log_message = date("Y-m-d H:i:s")." ".auth()->user()->associate_id." \"$message\" ".$event_id.PHP_EOL;
        $log_file = fopen('assets/log.txt', 'a');
        fwrite($log_file, $log_message);
        fclose($log_file);
    }
}

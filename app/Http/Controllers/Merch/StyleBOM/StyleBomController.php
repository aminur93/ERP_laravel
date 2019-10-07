<?php

namespace App\Http\Controllers\Merch\StyleBOM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\BomCosting;
use App\Models\Merch\Buyer;
use App\Models\Merch\Season;
use DB, Validator, Response, Form, Exception, DataTables;

class StyleBomController extends Controller
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
    	return view("merch.style_bom.style_bom_list", compact(
            'buyerList',
            'seasonList'
        ));
    }

    public function getListData()
    {
    	$data = DB::table("mr_style AS s")
    		->select(
    			"s.stl_id",
    			"sb.mr_style_stl_id",
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
			->leftJoin("mr_stl_bom_n_costing AS sb", "sb.mr_style_stl_id", "=", "s.stl_id")
			->leftJoin("mr_buyer AS b", "b.b_id", "=", "s.mr_buyer_b_id")
            ->whereIn('b.b_id', auth()->user()->buyer_permissions())
			->leftJoin("mr_product_type AS t", "t.prd_type_id", "=", "s.prd_type_id")
			->leftJoin("mr_garment_type AS g", "g.gmt_id", "=", "s.gmt_id")
			->leftJoin("mr_season AS se", "se.se_id", "=", "s.mr_season_se_id")
			->groupBy("s.stl_id")
            ->orderBy('s.stl_id', 'desc')
			->get();

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
            ->editColumn('action', function ($data) {
                $return = "<div class=\"btn-group\">";
            	if (empty($data->mr_style_stl_id))
            	{
            		$return .= "<a href=".url('merch/style_bom/'.$data->stl_id.'/create')." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"BOM\">BOM</a>";
            	}
            	else
            	{
                    $return .= "<a href=".url('merch/style_bom/'.$data->stl_id.'/edit')." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit\">
                     		<i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                        </a>
                        <a href=".url('merch/style_bom/'.$data->stl_id.'/delete')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" onClick=\"return window.confirm('Are you sure?')\" title=\"Delete\">
                        <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                    </a>";
            	}
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'stl_type',
                'action'
            ])
            ->toJson();
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $request->id
     * @return \Illuminate\Http\Response
    */
    public function showForm(Request $request)
    {
        $stylebom_id=$request->id;
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
    			"s.stl_img_link",
    			"s.stl_addedby",
    			"s.stl_added_on",
    			"s.stl_updated_by",
    			"s.stl_updated_on",
    			"s.stl_status"
    		)
			->leftJoin("mr_buyer AS b", "b.b_id", "=", "s.mr_buyer_b_id")
            ->whereIn('b.b_id', auth()->user()->buyer_permissions())
			->leftJoin("mr_product_type AS t", "t.prd_type_id", "=", "s.prd_type_id")
			->leftJoin("mr_garment_type AS g", "g.gmt_id", "=", "s.gmt_id")
			->leftJoin("mr_season AS se", "se.se_id", "=", "s.mr_season_se_id")
			->where("s.stl_id", $request->id)
			->first();

        //sampleTypes
	    $samples = DB::table("mr_stl_sample AS ss")
	    	->select(DB::raw("GROUP_CONCAT(st.sample_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_sample_type AS st", "st.sample_id", "ss.sample_id")
	    	->where("ss.stl_id", $request->id)
	    	->first();

        //operations
	    $operations = DB::table("mr_style_operation_n_cost AS oc")
	    	->select("o.opr_name")
	    	->select(DB::raw("GROUP_CONCAT(o.opr_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_operation AS o", "o.opr_id", "oc.mr_operation_opr_id")
	    	->where("oc.mr_style_stl_id", $request->id)
	    	->first();

        //machines
	    $machines = DB::table("mr_style_sp_machine AS sm")
	    	->select(DB::raw("GROUP_CONCAT(m.spmachine_name SEPARATOR ', ') AS name"))
	    	->leftJoin("mr_special_machine AS m", "m.spmachine_id", "sm.spmachine_id")
	    	->where("sm.stl_id", $request->id)
	    	->first();

	    // BOM Items
	    $items = DB::table("mr_material_category")
	    		->get();
	    $bomItem = "";
	    foreach ($items as $cat)
	    {
			$bomItem .= "<div class=\"col-sm-4\">
				<h3>$cat->mcat_name</h3>";
			$subItem = DB::table("mr_cat_item")
				->where("mcat_id", $cat->mcat_id)
				->get();
			$name = strtolower(str_replace(" ", "_", $cat->mcat_name));

			$sl = 1;
			$bomItem .= "<ul class=\"list-unstyled\">";
			foreach ($subItem as $item)
			{
				$bomItem .= "<li>
					<input type=\"hidden\" value=\"$cat->mcat_id\"/>
					<input type=\"checkbox\" id=\"".$name."_$sl\" name=\"".$name."[]\" value=\"$item->id\"/>
					<label for=\"".$name."_$sl\">".($sl++).". $item->item_name</label>
				</li>";
			}
			$bomItem .= "</ul>";
			$bomItem .= "</div>";
	    }

    	return view("merch.style_bom.style_bom_form", compact(
    		"style",
    		"samples",
    		"operations",
    		"machines",
    		"bomItem",
        "stylebom_id"
    	));
    }

    public function getItemData(Request $request)
    {
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
				"placeholder"     => "Select"
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
				<td>
					<input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$item->mcat_name\" readonly/>
					<input type=\"hidden\" name=\"mr_material_category_mcat_id[]\" value=\"$item->mcat_id\">
                    <input type=\"hidden\" name=\"id[]\" value=\"0\">
				</td>
				<td>
					<input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$item->item_name\" readonly/>
					<input type=\"hidden\" name=\"mr_cat_item_id[]\" value=\"$item->id\">
				</td>
				<td><input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$item->item_code\" readonly/></td>
				<td><input type=\"text\" name=\"item_description[]\" class=\"form-control input-sm\"  placeholder=\"Description\"/></td>
				<td>$color</td>
				<td><input type=\"text\" name=\"size[]\" class=\"form-control input-sm\"  placeholder=\"Size/Width\"/></td>
				<td>$supplier</td>
				<td><select><option value=\"\">Select</option></td>
				<td class=\"comp_name\"></td>
				<td class=\"construction_name\"></td>
				<td>$uom</td>
				<td><input type=\"text\" name=\"consumption[]\" class=\"form-control input-sm calc consumption\" data-validation=\"required\" placeholder=\"Select\" value=\"0\"/></td>
				<td><input type=\"text\" name=\"extra_percent[]\" class=\"form-control input-sm calc extra\"  placeholder=\"Extra\" data-validation=\"required\"  value=\"0\"/></td>
				<td><input type=\"text\" class=\"form-control input-sm qty\"  placeholder=\"Extra Qty\" data-validation=\"required\"  value=\"0\"/></td>
				<td><input type=\"text\" class=\"form-control input-sm calc total\"  placeholder=\"Total\" data-validation=\"required\"  value=\"0.00\"/></td>
			</tr>";

    	}

    	echo $bomItem;
    }

	// get category & item
    public function item($item_id = "", $category_id = "")
    {
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
    public function color($name = "", $selected = "", $option = [])
    {
    	$colors = DB::table("mr_material_color")
    		->get();
        $colorData = array();
        foreach ($colors as $color) {
            $colorData[$color->clr_id] =  $color->clr_name.' - '.$color->clr_code;
        }
        //dd($colorDatas);
    	$selectedColor = DB::table("mr_material_color")
    		->where("clr_id", $selected)
    		->value("clr_code");

    	$option["style"] = "background:$selectedColor";

    	return Form::select($name, $colorData, $selected, $option);
    }

	// get supplier list by item id
    public function supplier($mcat_id = "", $name = "", $selected = "", $option = [])
    {
    	$suppliers = DB::table("mr_supplier_item_type AS si")
    		->leftJoin("mr_supplier AS s", "s.sup_id", "=", "si.mr_supplier_sup_id")
    		->where("si.mcat_id", $mcat_id)
    		->pluck("s.sup_name", "s.sup_id");

    	return Form::select($name, $suppliers, $selected, $option);
    }

	// get article list by supplier id
    public function article($supplier_id="", $name="", $selected="", $option = [])
    {
    	if (request()->has("supplier_id"))
    	{
    		$supplier_id = request()->get("supplier_id");
    		$name        = request()->get("name");
    		$selected    = request()->get("selected");
    		$option      = request()->get("option");
    	}

    	$articles = DB::table("mr_article")
    		->where("mr_supplier_sup_id", $supplier_id)
    		->pluck("art_name", "id");

    	$html = "<div class='input-group'>";
    	$html .=  Form::select($name, $articles, $selected, $option);
    	$html .= "<span class='input-group-btn'><button type='button'  data-toggle='modal' data-target='.newArticleModal' class='btn btn-xs btn-primary'>+</button></span></div>";
    	return $html;
    }

	// get composition list by supplier id
    public function composition($supplier_id="", $name="", $selected="", $option = [])
    {
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
    public function construction($supplier_id="", $name="", $selected="", $option = [])
    {
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
    public function uom($name = "", $selected = "", $option = [])
    {
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

    //get Compostion and Construction By Article ID
    public function compositionByArticle(Request $request){
        
        $cons= DB::table('mr_construction')->where('mr_article_id', $request->article_id)->pluck('construction_name')->first();
        if($cons== null)
            $cons="N/A";

        $comp= DB::table('mr_composition')->where('mr_article_id', $request->article_id)->pluck('comp_name')->first();

        if($comp== null)
            $comp="N/A";

        $data["cons"]= $cons;
        $data["comp"]= $comp;

        return $data;
    }

    // store bom data
    public function store(Request $request)
    {
   	    $validator = Validator::make($request->all(), [
            "mr_style_stl_id"    => "required|max:11",
			"mr_material_category_mcat_id.*" => "required|max:11",
			"mr_cat_item_id.*"   => "required|max:11",
			//"item_description.*" => "required|max:128",
			"clr_id.*"           => "max:11",
			//"size.*"             => "required|max:128",
			"mr_supplier_sup_id.*" => "required|max:11",
			"mr_article_id.*"      => "max:11",
			"mr_composition_id.*"  => "max:11",
			"mr_construction_id.*" => "max:11",
			"uom.*"                => "required",
			"consumption.*"        => "required|max:128",
			"extra_percent.*"      => "required|max:11",
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
			// Store Style Operation
    		if (is_array($request->mr_material_category_mcat_id) && sizeof($request->mr_material_category_mcat_id) > 0)
    		{
    			$insert = array();
    			for ($i=0; $i<sizeof($request->mr_material_category_mcat_id); $i++)
    			{
                    $comp= DB::table('mr_composition')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();
                    $cons= DB::table('mr_construction')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();

    				$insert = array(
    					"mr_style_stl_id"    => $request->mr_style_stl_id,
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
    				);
					$id = BomCosting::insertGetId($insert);

			    	//------------store log history--------------
			    	$this->logFileWrite("Style BOM created", $id);
			    	//---------------------------------------
    			}

                // return redirect("merch/style_bom")
                //     ->with('success', 'Save successful.');
                 return redirect('merch/style_costing/'.$request->style_bom_id.'/edit')->with('success', 'Save successful.');


    		}
    		else
    		{
	    		return back()
	    			->withInput()
		            ->with('error', "Incorrect Input!");
    		}

    	}
    }

    // create new article by supplier id
    public function createArticle(Request $request)
    {
    	$data = array();
        $comp_name="";
        $cons_name="";
    	if (!empty($request->supplier_id) && !empty($request->article_name))
    	{
    		try
    		{
				$id = DB::table("mr_article")->insertGetId([
					"art_name" => $request->article_name,
					"mr_supplier_sup_id" => $request->supplier_id,
				]);
                
                //If Request Has Compostion Name then store
                if($request->has('art_composition')){
                    DB::table('mr_composition')->insert([
                        "comp_name" => $request->art_composition,
                        "mr_supplier_sup_id" => $request->supplier_id,
                        "mr_article_id"=> $id
                    ]);
                    $comp_name= $request->art_composition;
                }

                //If Request Has Construction Name then store
                if($request->has('art_construction')){
                    DB::table('mr_construction')->insert([
                        "construction_name" => $request->art_construction,
                        "mr_supplier_sup_id" => $request->supplier_id,
                        "mr_article_id"=> $id
                    ]);
                    $cons_name= $request->art_construction;
                }

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
        $data["comp_name"]= $comp_name;
        $data["cons_name"]= $cons_name;

    	return Response::json($data);
    }

    // create new composition by supplier id
    public function createComposition(Request $request)
    {
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
    public function createConstruction(Request $request)
    {
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
                "s.stl_img_link",
                "s.stl_addedby",
                "s.stl_added_on",
                "s.stl_updated_by",
                "s.stl_updated_on",
                "s.stl_status"
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

        //---------- BOM ITEM MODAL----------------
        $modalCats = DB::table("mr_material_category AS c")->get();
        $modalItem = "";
        foreach ($modalCats as $cat)
        {
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
                ->leftJoin("mr_stl_bom_n_costing AS b", function($join) use($id) {
                    $join->on("b.mr_cat_item_id", "=", "i.id");
                    $join->where("b.mr_style_stl_id", $id);
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
                "b.item_description",
                "b.clr_id",
                "b.size",
                "b.mr_supplier_sup_id",
                "b.mr_article_id",
                "b.mr_composition_id",
                "com.comp_name",
                "b.mr_construction_id",
                "con.construction_name",
                "b.consumption",
                "b.extra_percent",
                "b.uom"
            )
            ->leftJoin("mr_material_category AS c", function($join) {
                $join->on("c.mcat_id", "=", "b.mr_material_category_mcat_id");
            })
            ->leftJoin("mr_cat_item AS i", function($join) {
                $join->on("i.mcat_id", "=", "b.mr_material_category_mcat_id");
                $join->on("i.id", "=", "b.mr_cat_item_id");
            })
            ->leftJoin('mr_construction AS con', 'con.id', 'b.mr_construction_id')
            ->leftJoin('mr_composition AS com', 'com.id', 'b.mr_composition_id')
            ->where("b.mr_style_stl_id", $id)
            ->get();

        $bomItemData = "";
        foreach ($boms as $bom)
        {
            // get color list with name
            $color = $this->color("clr_id[]", $bom->clr_id, [
                "class" => "form-control input-sm no-select color",
                "placeholder"     => "Select"
                //"data-validation" => "required"
            ]);

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
                "placeholder"     => "Select"
            ]);


            // get composition list
            $composition = $this->composition($bom->mr_supplier_sup_id, "mr_composition_id[]", $bom->mr_composition_id, [
                "class" => "form-control input-sm no-select",
                "placeholder"     => "Select"
            ]);

            // get construction list
            $construction = $this->construction($bom->mr_supplier_sup_id, "mr_construction_id[]", $bom->mr_construction_id, [
                "class" => "form-control input-sm no-select",
                "placeholder"     => "Select"
                ]
            );

            $extra_qty = number_format((($bom->consumption/100)*$bom->extra_percent), 2);
            $total     = number_format(($bom->consumption+$extra_qty), 2);
            if($bom->comp_name == null)
                 $comp_name= "N/A";
            else
                $comp_name= $bom->comp_name;

            if($bom->construction_name == null)
                $construction_name= "N/A";
            else
                $construction_name= $bom->construction_name;
            $bomItemData .= "<tr id=\"$bom->mr_cat_item_id\">
                <td>
                    <input type=\"hidden\" name=\"id[]\" value=\"$bom->id\"/>
                    <input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$bom->mcat_name\" readonly/>
                    <input type=\"hidden\" name=\"mr_material_category_mcat_id[]\" value=\"$bom->mr_material_category_mcat_id\">
                </td>
                <td>
                    <input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$bom->item_name\" readonly/>
                    <input type=\"hidden\" name=\"mr_cat_item_id[]\" value=\"$bom->mr_cat_item_id\">
                </td>
                <td><input type=\"text\" class=\"form-control input-sm\"  data-validation=\"required\" value=\"$bom->item_code\" readonly/></td>
                <td><input type=\"text\" name=\"item_description[]\" class=\"form-control input-sm\" placeholder=\"Description\" value=\"$bom->item_description\"/></td>
                <td>$color</td>
                <td><input type=\"text\" name=\"size[]\" class=\"form-control input-sm\"  placeholder=\"Size/Width\" value=\"$bom->size\"/></td>
                <td>$supplier</td>
                <td>$article</td>
                <td class=\"comp_name\">$comp_name</td>
                <td class=\"construction_name\">$construction_name</td>
                <td>$uom</td>
                <td><input type=\"text\" name=\"consumption[]\" class=\"form-control input-sm calc consumption\" data-validation=\"required\" placeholder=\"Select\" value=\"$bom->consumption\"/></td>
                <td><input type=\"text\" name=\"extra_percent[]\" class=\"form-control input-sm calc extra\"  placeholder=\"Extra\" data-validation=\"required\" value=\"$bom->extra_percent\"/></td>
                <td><input type=\"text\" class=\"form-control input-sm qty\"  placeholder=\"Extra Qty\" data-validation=\"required\"  value=\"$extra_qty\"/></td>
                <td><input type=\"text\" class=\"form-control input-sm calc total\"  placeholder=\"Total\" data-validation=\"required\"  value=\"$total\"/></td>
            </tr>";
        }
        /*
        * END BOM ITEM DATA
        *---------------------------------------------
        */
        return view("merch.style_bom.style_bom_edit", compact(
            "style",
            "samples",
            "operations",
            "machines",
            "modalItem",
            "bomItemData"
        ));
    }

    public function update(Request $request)
    {
   	    $validator = Validator::make($request->all(), [
            "mr_style_stl_id"    => "required|max:11",
			"mr_material_category_mcat_id.*" => "required|max:11",
			"mr_cat_item_id.*"   => "required|max:11",
			"item_description.*" => "max:128",
			"clr_id.*"           => "max:11",
			"size.*"             => "max:128",
			"mr_supplier_sup_id.*" => "required|max:11",
			"mr_article_id.*"      => "max:11",
			"mr_composition_id.*"  => "max:11",
			"mr_construction_id.*" => "max:11",
			"uom.*"                => "required",
			"consumption.*"        => "required|max:128",
			"extra_percent.*"      => "required|max:11",
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withErrors($validator)
    			->withInput()
	            ->with('error', "Incorrect Input!!");
    	}
    	else{
    		// delete old data
    		//BomCosting::where("mr_style_stl_id", $request->mr_style_stl_id)->delete();
			// Store Style Operation
			$insert = array();
			for ($i=0; $i<sizeof($request->mr_material_category_mcat_id); $i++)
			{

                $comp= DB::table('mr_composition')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();
                $cons= DB::table('mr_construction')->where('mr_article_id', $request->mr_article_id[$i])->pluck('id')->first();

                if($request->id[$i]==0){
                    $insert = array(
                        "mr_style_stl_id"    => $request->mr_style_stl_id,
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
                        "extra_percent"  => $request->extra_percent[$i]
                    );
                    $up_id = BomCosting::insertGetId($insert);

                    //------------store log history--------------
                    $this->logFileWrite("Style BOM updated", $up_id);
                    //---------------------------------------
                }
                else{
                    BomCosting::where('id', $request->id[$i])
                        ->update([
                            "mr_style_stl_id"    => $request->mr_style_stl_id,
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
                            "extra_percent"  => $request->extra_percent[$i]
                        ]);
                    $this->logFileWrite("Style BOM updated", $request->id[$i]);
                }
    				
			}


            return redirect("merch/style_bom")
                ->with('success', 'Update successful.');
        }
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        DB::table('mr_stl_bom_n_costing')->where('mr_style_stl_id', $request->id)->delete();
        return redirect('merch/style_bom')->with('success', "Delete successful!");
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

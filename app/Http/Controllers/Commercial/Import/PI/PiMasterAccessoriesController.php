<?php

namespace App\Http\Controllers\Commercial\Import\PI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\Commercial\Insurance;
use App\Models\Commercial\PiMasterAccessories;
use App\Models\Commercial\PiMasterAccessoriesItem;
use App\Models\Commercial\PiMasterAccessoriesHistory;
use DB, Validator, DataTables;

class PiMasterAccessoriesController extends Controller
{    

	public function showForm()
    {     
    	$PIEntryList = DB::table("mr_pi_entry")
    		->where("pi_entry_type", 2)
    		->orWhere("pi_entry_type", 3)
    		->pluck("pi_entry_no", "pi_entry_id");
    	$fileList = DB::table("com_exp_lc_entry")
    		->pluck("exp_lc_fileno", "exp_lc_fileno");
    	$insuranceList = Insurance::pluck("insurance_comp_code", "insurance_comp_id");

    	return view("commercial.import.pi.pi_master_accessories", compact(
    		"PIEntryList",
    		"fileList",
    		"insuranceList"
    	));
    } 

    public function getPIEntryByID(Request $request)
    {
    	$data['status'] = false;

    	if (!empty($request->pi_entry_id))
    	{
    		$data['status'] = true;
    		$data['purchase'] = DB::table("mr_pi_entry AS e")
				->where("e.pi_entry_id", $request->pi_entry_id)
				->leftJoin("mr_supplier AS s", "s.sup_id", "=", "e.sup_id")
				->first();

    		$data['autocode'] = (new ShortCodeLib)::generate([
				'table'            => 'com_master_pi_accessories',  
				'column_primary'   => 'master_pi_acss_id',  
				'column_shortcode' => 'master_pi_acss_sup_code',  
				'first_letter'     => $data['purchase']->pi_entry_no,        
				'second_letter'    => $data['purchase']->sup_name       
			]); 

    		$data['orders'] = DB::table("mr_pi_order AS o")
				->select("o.pi_entry_id", "o.pi_order_id", "e.order_code", "s.stl_no", "s.stl_id", "e.order_delivery_date")
				->leftJoin("mr_order_entry AS e", "e.order_id", "=", "o.order_id")
				->leftJoin("mr_style AS s", "s.stl_id", "=", "e.stl_id")
				->where("o.pi_entry_id", $request->pi_entry_id)
				->get();
    	}

    	return response()->json($data);
    }

    public function getItemName(Request $request)
    {
    	$data['name'] = DB::table('mr_material_item')
    			->where("matitem_id", $request->matitem_id)
    			->value("matitem_name");
    	return response()->json($data);
    }

    public function accessoriesOrder(Request $request)
    {
    	if (!empty($request->pi_order_id) && !empty($request->order_code) && !empty($request->style_id))
    	{ 
    		// ------------ item list -----------------
    		$itemList = DB::table("mr_bom_n_costing_booking AS bc")
    			->leftJoin("mr_material_item AS i", "i.matitem_id", "=", "bc.matitem_id")
    			->leftJoin("mr_material_category AS c", function($join) {
    				$join->on("c.mcat_id", "=", "i.mcat_id");
    			})
    			->where("bc.stl_id", $request->style_id)
    			->where(function($condition){ 
					$condition->where("c.mcat_id", 2); 
					$condition->orWhere("c.mcat_id", 3); 
    			})
    			->pluck("i.matitem_code", "i.matitem_id");

    		$items = "<option value=\"\">Select</option>";
            foreach($itemList AS $id => $item)
            {
        		 $items .= "<option value=\"$id\">$item</option>";
            }
    		 
	        $result = "<table class=\"table bg-success\" data-order-id=".$request->pi_order_id.">
		        <thead>
		        	<tr><th colspan=\"15\"><h3> Order No ".$request->order_code."</h3></th></tr>
		        	<tr>
			            <th width=\"100\">Item Code</th>
			            <th>Item</th>
			            <th>Item Type</th>
			            <th>Quantity</th>
			            <th>Quantity Unit</th>
			            <th>Unit Price</th>
			            <th width=\"100\">Currency</th>
			            <th>Price Unit</th>
			            <th>Amount</th>
			            <th>Ship Date</th>
			            <th width=\"80\">#</th>
		            </tr>
		        </thead>
		        <tbody>
			        <tr>
			            <td> 
			                <input type=\"hidden\" name=\"pi_order_id[]\" value=".$request->pi_order_id.">
			                <select name=\"matitem_id[]\" class=\"matitem_id form-control\" data-validation=\"required\">
			                	$items
			                </select> 
			            </td> 
			            <td class=\"has-warning\">
			                <input type=\"text\" class=\"item-name input-sm form-control\" placeholder=\"Enter\" data-validation=\"required\" readonly>
			            </td> 
			            <td>
			                <input type=\"text\" name=\"master_pi_acss_item_type[]\" class=\"input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">
			            </td>
			            <td>
			                <input type=\"text\" name=\"master_pi_acss_item_quantity[]\" class=\"qty input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">
			            </td>
			            <td>
			                <select name=\"master_pi_acss_item_qty_unit[]\" class=\"form-control\" data-validation=\"required\">
                                <option value=\"\">UoM</option>
                                <option value=\"Millimeter\">Millimeter</option>
                                <option value=\"Centimeter\">Centimeter</option>
                                <option value=\"Meter\">Meter</option>
                                <option value=\"Inch\">Inch</option>
                                <option value=\"Feet\">Feet</option>
                                <option value=\"Yard\">Yard</option>
                                <option value=\"Piece\">Piece</option>
			                </select> 
			            </td>  
			            <td>
			                <input type=\"text\" name=\"master_pi_acss_item_unit_price[]\" class=\"price input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">
			            </td>
			            <td>  
			                <select name=\"master_pi_acss_item_currency[]\" class=\"form-control\" data-validation=\"required\">
								<option value=\"USD\" selected=\"selected\">USD</option>
								<option value=\"EUR\">EUR</option>
								<option value=\"GBP\">GBP</option> 
								<option value=\"AUD\">AUD</option>
								<option value=\"BDT\">BDT</option>  
								<option value=\"BRR\">BRR</option> 
								<option value=\"CAD\">CAD</option> 
								<option value=\"CNY\">CNY</option> 
								<option value=\"FRF\">FRF</option>
								<option value=\"DEM\">DEM</option> 
								<option value=\"INR\">INR</option>
								<option value=\"IDR\">IDR</option> 
								<option value=\"ITL\">ITL</option> 
								<option value=\"JPY\">ITL</option> 
								<option value=\"MYR\">MYR</option> 
								<option value=\"NLG\">NLG</option>
								<option value=\"NZD\">NZD</option>
								<option value=\"NOK\">NOK</option>
								<option value=\"PKR\">PKR</option> 
								<option value=\"PHP\">PHP</option> 
								<option value=\"RUR\">RUR</option>
								<option value=\"SAR\">SAR</option>
								<option value=\"SGD\">SGD</option> 
								<option value=\"SEK\">SEK</option>
								<option value=\"CHF\">CHF</option>
								<option value=\"TWD\">TWD</option>
								<option value=\"TRL\">TRL</option>
								<option value=\"XAU\">XAU</option>
								<option value=\"XAG\">XAG</option>
								<option value=\"XPT\">XPT</option>
								<option value=\"XPD\">XPD</option>
			                </select> 
			            </td> 
			            <td>  
			                <select name=\"master_pi_acss_item_price_unit[]\" class=\"form-control\" data-validation=\"required\"> 
                                <option value=\"\">UoM</option>
                                <option value=\"Millimeter\">Millimeter</option>
                                <option value=\"Centimeter\">Centimeter</option>
                                <option value=\"Meter\">Meter</option>
                                <option value=\"Inch\">Inch</option>
                                <option value=\"Feet\">Feet</option>
                                <option value=\"Yard\">Yard</option>
                                <option value=\"Piece\">Piece</option>
			                </select> 
			            </td>     
			            <td class=\"has-warning\">
			                <input type=\"text\" class=\"amount input-sm form-control\" placeholder=\"Enter\" data-validation=\"required\" readonly>
			            </td>
			            <td>
			                <input type=\"date\" name=\"master_pi_acss_item_ship_date[]\" style=\"width:140px\" class=\"input-sm form-control\" placeholder=\"Enter\" data-validation=\"date\">
			            </td> 
			            <td>
			                <div class=\"btn-group\">
			                    <button type=\"button\" class=\"AddBtn btn btn-sm btn-success\">+</button>
			                    <button type=\"button\" class=\"RemoveBtn btn btn-sm btn-danger\">-</button>
			                </div>
			            </td>
			        </tr>
		        </tbody>
		    </table>";
 
	    	$data['status'] = true;
	    	$data['result'] = $result;
	    }
	    else
	    {
	    	$data['status'] = false;
	    }

		return response()->json($data);
    }

    public function saveData(Request $request)
    {
    	$validator = Validator::make($request->all(), [
			"pi_entry_id"                  => "required|max:11",
			"exp_lc_fileno"                => "required|max:11",
			"sup_id"                       => "required|max:11",
			"master_pi_acss_sup_code"      => "required|max:45",
			"master_pi_acss_insurance_no"  => "required|max:45",
			"master_pi_acss_insurance_date"    => "required|date",
			"insurance_comp_id"                => "required|max:11",
			"pi_order_id.*"                    => "required|max:11",
			"matitem_id.*"                     => "required|max:11",
			"master_pi_acss_item_type.*"       => "required|max:45",
			"master_pi_acss_item_quantity.*"   => "required|max:45",
			"master_pi_acss_item_qty_unit.*"   => "required|max:45",
			"master_pi_acss_item_unit_price.*" => "required|max:45",
			"master_pi_acss_item_currency.*"   => "required|max:45",
			"master_pi_acss_item_price_unit.*" => "required|max:45",
			"master_pi_acss_item_ship_date.*"  => "required|date"
    	]);  

    	if ($validator->fails())
    	{
    		return back()
    			->withInputs()
    			->withErrors($validator);
    	}
    	else
    	{
    		$store = new PiMasterAccessories;
			$store->pi_entry_id       = $request->pi_entry_id;
			$store->exp_lc_fileno     = $request->exp_lc_fileno;
			$store->sup_id            = $request->sup_id;
			$store->master_pi_acss_sup_code       = $request->master_pi_acss_sup_code;
			$store->master_pi_acss_insurance_no   = $request->master_pi_acss_insurance_no;
			$store->master_pi_acss_insurance_date = $request->master_pi_acss_insurance_date;
			$store->insurance_comp_id = $request->insurance_comp_id;
			$store->unit_id           = auth()->user()->unit_id();
 
			if ($store->save())
			{
				// store items
				if (!empty($request->pi_order_id) && sizeof($request->pi_order_id)>0)
				{ 
					for($i=0; $i<sizeof($request->pi_order_id); $i++)
					{  
						$item = array(
							"master_pi_acss_id" => $store->id,
							"pi_order_id" => $request->pi_order_id[$i], 
							"matitem_id"  => $request->matitem_id[$i], 
							"master_pi_acss_item_type"    => $request->master_pi_acss_item_type[$i], 
							"master_pi_acss_item_quantity" => $request->master_pi_acss_item_quantity[$i], 
							"master_pi_acss_item_qty_unit" => $request->master_pi_acss_item_qty_unit[$i], 
							"master_pi_acss_item_unit_price" => $request->master_pi_acss_item_unit_price[$i], 
							"master_pi_acss_item_currency" => $request->master_pi_acss_item_currency[$i], 
							"master_pi_acss_item_price_unit" => $request->master_pi_acss_item_price_unit[$i], 
							"master_pi_acss_item_ship_date" => date("Y-m-d", strtotime($request->master_pi_acss_item_ship_date[$i])), 
						); 
						PiMasterAccessoriesItem::insert($item);
					} 
				}

				// store history
				PiMasterAccessoriesHistory::insert([
					"master_pi_acss_id"                  => $store->id,
					"master_pi_acss_history_description" => "Create",
					"master_pi_acss_history_userid"      => auth()->user()->associate_id,
				]);

				return back()->with("success", "Save Successful.");
			}
			else
			{
				return back()->with("error", "Please try again...");
			} 
    	}   	
    }

    public function showList()
    {
    	$pi_type = DB::table("mr_material_category")->orderBy("mcat_name", "ASC")->pluck("mcat_name");
    	$suppliers = DB::table("mr_supplier")->pluck("sup_name");
    	return view("commercial.import.pi.pi_master_accessories_list", compact(
    		"pi_type",
    		"suppliers"
    	));
    }

    public function getData()
    {
    	DB::statement(DB::raw("SET @s:=0"));
        $data = DB::table('com_master_pi_accessories AS f')
            ->select(
            	DB::raw("@s:=@s+1 AS serial"),
                'f.master_pi_acss_id',
                'e.pi_entry_no',
                'l.exp_lc_fileno',
                's.sup_name',
                'e.pi_entry_date',
                'e.pi_entry_category',
                'e.pi_entry_last_date',
                'e.pi_entry_shipmode',
                'c.mcat_name',
                'f.master_pi_acss_sup_code',
                'f.master_pi_acss_insurance_no',
                'f.master_pi_acss_insurance_date',
                'i.insurance_comp_code' 
            )
            ->leftJoin("mr_pi_entry AS e", "e.pi_entry_id", "=", "f.pi_entry_id")
            ->leftJoin("mr_material_category AS c", "c.mcat_id", "=", "e.pi_entry_type")
            ->leftJoin("com_exp_lc_entry AS l", "l.exp_lc_fileno", "=", "f.exp_lc_fileno")
            ->leftJoin("mr_supplier AS s", "s.sup_id", "=", "f.sup_id")
            ->leftJoin("com_insurance_company AS i", "i.insurance_comp_id", "=", "f.insurance_comp_id")
            ->get(); 
  
        return DataTables::of($data)  
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">   
                    <a href=".url('comm/import/pi/pi_master_accessories_edit/'.$data->master_pi_acss_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a> 
                    <a href=".url('comm/import/pi/pi_master_accessories_delete/'.$data->master_pi_acss_id)." onClick=\"return confirm('Are you sure?')\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\">
                        <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['emp_adv_info_stat','action'])
            ->toJson();  
    }

    public function showEdit(Request $request)
    { 
    	$PIEntryList = DB::table("mr_pi_entry")
    		->where("pi_entry_type", 2)
    		->orWhere("pi_entry_type", 3)
    		->pluck("pi_entry_no", "pi_entry_id");
    	$fileList      = DB::table("com_exp_lc_entry")
    		->pluck("exp_lc_fileno", "exp_lc_fileno");
    	$insuranceList = Insurance::pluck("insurance_comp_code", "insurance_comp_id");
    	$accessories = DB::table('com_master_pi_accessories AS a')
            ->select(
                'a.master_pi_acss_id',
                'e.pi_entry_id',
                'e.pi_entry_no',
                'a.exp_lc_fileno',
                's.sup_id',
                's.sup_name',
                'e.pi_entry_date',
                'e.pi_entry_category',
                'e.pi_entry_last_date',
                'e.pi_entry_shipmode',
                'c.mcat_name AS pi_entry_type',
                'a.master_pi_acss_sup_code',
                'a.master_pi_acss_insurance_no',
                'a.master_pi_acss_insurance_date',
                'i.insurance_comp_id' 
            )
            ->leftJoin("mr_pi_entry AS e", "e.pi_entry_id", "=", "a.pi_entry_id")
            ->leftJoin("mr_material_category AS c", "c.mcat_id", "=", "e.pi_entry_type")
            ->leftJoin("mr_supplier AS s", "s.sup_id", "=", "a.sup_id")
            ->leftJoin("com_insurance_company AS i", "i.insurance_comp_id", "=", "a.insurance_comp_id")
            ->where("a.master_pi_acss_id", $request->acc_id)
            ->first(); 

        $master_pi_acss_id = $accessories->master_pi_acss_id; 
        $orders = DB::table("mr_pi_order AS o")
			->select(
				"o.pi_order_id",  
				"a.master_pi_acss_id", 
				"a.master_pi_acss_item_currency", 
				"e.order_code", 
				"s.stl_no", 
				"s.stl_id", 
				"e.order_delivery_date",
				DB::raw("
				CASE 
					WHEN a.master_pi_acss_id!='' THEN 'true'
				END AS isChecked
				")
			)
			->leftJoin("com_master_pi_accessories_item AS a", function($join) use($master_pi_acss_id) {
				$join->on("a.pi_order_id", "=", "o.pi_order_id");
				$join->where("a.master_pi_acss_id", "=", "$master_pi_acss_id");
			})
			->leftJoin("mr_order_entry AS e", "e.order_id", "=", "o.order_id")
			->leftJoin("mr_style AS s", "s.stl_id", "=", "e.stl_id")
			->where("o.pi_entry_id", $accessories->pi_entry_id)
			->groupBy("e.order_id")
			->get();
			
		$colorList = DB::table("mr_material_color")->pluck("clr_name", "clr_id");	
 
    	return view("commercial.import.pi.pi_master_accessories_edit", compact(
    		"accessories",
    		"PIEntryList",
    		"fileList",
    		"insuranceList",
    		"currency_symbols",
    		"orders",
    		"itemList",
    		"colorList" 
    	));
    }
 
    public function updateData(Request $request)
    {
    	$validator = Validator::make($request->all(), [
			"master_pi_acss_id"               => "required|max:11",
			"pi_entry_id"                     => "required|max:11",
			"exp_lc_fileno"                   => "required|max:11",
			"sup_id"                          => "required|max:11",
			"master_pi_acss_sup_code"         => "required|max:45",
			"master_pi_acss_insurance_no"     => "required|max:45",
			"master_pi_acss_insurance_date"   => "required|date",
			"insurance_comp_id"               => "required|max:11",
			"pi_order_id.*"                   => "required|max:11",
			"matitem_id.*"                     => "required|max:11",
			"master_pi_acss_item_type.*"       => "required|max:45",
			"master_pi_acss_item_quantity.*"   => "required|max:45",
			"master_pi_acss_item_qty_unit.*"   => "required|max:45",
			"master_pi_acss_item_unit_price.*" => "required|max:45",
			"master_pi_acss_item_currency.*"   => "required|max:45",
			"master_pi_acss_item_price_unit.*" => "required|max:45",
			"master_pi_acss_item_ship_date.*"  => "required|date"
    	]);


		if ($validator->fails())
    	{
    		return back()
    			->withInputs()
    			->withErrors($validator);
    	}
    	else
    	{
    		$update = PiMasterAccessories::where("master_pi_acss_id", $request->master_pi_acss_id)->update([
				"pi_entry_id"        => $request->pi_entry_id,
				"exp_lc_fileno"     => $request->exp_lc_fileno,
				"sup_id"             => $request->sup_id,
				"master_pi_acss_sup_code" => $request->master_pi_acss_sup_code,
				"master_pi_acss_insurance_no"   => $request->master_pi_acss_insurance_no,
				"master_pi_acss_insurance_date" => $request->master_pi_acss_insurance_date,
				"insurance_comp_id" => $request->insurance_comp_id,
				"unit_id"           => auth()->user()->unit_id() 
    		]);


    		// delete all items
    		PiMasterAccessoriesItem::where("master_pi_acss_id", $request->master_pi_acss_id)->delete();

    		// store items
			if (!empty($request->pi_order_id) && sizeof($request->pi_order_id)>0)
			{ 
				for($i=0; $i<sizeof($request->pi_order_id); $i++)
				{ 
					$item = array(
						"master_pi_acss_id" => $request->master_pi_acss_id,
						"pi_order_id" => $request->pi_order_id[$i], 
						"matitem_id"  => $request->matitem_id[$i], 
						"master_pi_acss_item_type" => $request->master_pi_acss_item_type[$i], 
						"master_pi_acss_item_quantity" => $request->master_pi_acss_item_quantity[$i], 
						"master_pi_acss_item_qty_unit" => $request->master_pi_acss_item_qty_unit[$i], 
						"master_pi_acss_item_unit_price" => $request->master_pi_acss_item_unit_price[$i], 
						"master_pi_acss_item_currency" => $request->master_pi_acss_item_currency[$i], 
						"master_pi_acss_item_price_unit" => $request->master_pi_acss_item_price_unit[$i], 
						"master_pi_acss_item_ship_date" => date("Y-m-d", strtotime($request->master_pi_acss_item_ship_date[$i])), 
					); 
					PiMasterAccessoriesItem::insert($item);
				} 
			}

			// store history
			PiMasterAccessoriesHistory::insert([
				"master_pi_acss_id"                  => $request->master_pi_acss_id,
				"master_pi_acss_history_description" => "Update",
				"master_pi_acss_history_userid"      => auth()->user()->associate_id
			]); 
 
			return back()->with("success", "Update Successful.");
    	}  
    }
 
    public function destroy(Request $req)
    {
    	if (!empty($req->acc_id))
    	{ 
    		PiMasterAccessories::where("master_pi_acss_id", $req->acc_id)->delete();
    		PiMasterAccessoriesItem::where("master_pi_acss_id", $req->acc_id)->delete();
 
			// store history
			PiMasterAccessoriesHistory::insert([
				"master_pi_acss_id"                  => $req->acc_id,
				"master_pi_acss_history_description" => "Delete",
				"master_pi_acss_history_userid"      => auth()->user()->associate_id
			]); 

    		return back()
    			->with("success", "Delete Successful!");
    	}
    	else
    	{
    		return back()
    			->with("error", "Please try again...");
    	}
    }

}

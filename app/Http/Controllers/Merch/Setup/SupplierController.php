<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Country;
use App\Models\Merch\Supplier;
use App\Models\Merch\SupplierContact;
use App\Models\Merch\McatItem;
use App\Models\Merch\SupplierItemType;
use Validator, DB, ACL;
use Auth;

class SupplierController extends Controller
{
    public function showForm()
    {
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#

        $unit_id = DB::table('users')
            ->select('hr_as_basic_info.as_unit_id')
            ->join('hr_as_basic_info','users.associate_id','=','hr_as_basic_info.associate_id')
            ->where('id',Auth::id())
            ->get();
        //dd($unit_id);exit;

        $supplierList= DB::table('mr_supplier AS s')
                            ->select(
                                's.*',
                                'c.cnt_name')
                            ->leftJoin('mr_country AS c', 's.cnt_id', 'c.cnt_id')
                            ->orderBy('sup_name', 'ASC')
                            ->get();
        foreach($supplierList as $supplier){
            $cp= DB::table('mr_sup_contact_person_info AS scp')
                    ->where('scp.sup_id', $supplier->sup_id)
                    ->get();

            $contact= "";
            $i=1;
            foreach($cp AS $person){
                $contact.= $i. ". ". $person->scp_details. "<br>";
                $i++;
            }
            $supplier->contact_person= $contact;
        }
    	$countryList= Country::pluck('cnt_name', 'cnt_id');
        // $itemList= McatItem::orderBy('mcat_id', 'DESC')
        //            ->get();

        // BOM Items
        $items = DB::table("mr_material_category")
                ->get();
        $itemList = "";
        //Loop  for category list
        foreach ($items as $cat)
        {
            // $itemList .= "<div class=\"col-sm-4\">
            //     <h4>$cat->mcat_name</h4>";
            $itemList .= "<div class=\"col-sm-4\">";

            //Query  for category item list
            // $subItem = DB::table("mr_cat_item")
            //     ->where("mcat_id", $cat->mcat_id)
            //     ->get();

            $name = strtolower(str_replace(" ", "_", $cat->mcat_name));

            $sl = 1;
            $itemList .= "<ul class=\"list-unstyled\" style=\"padding-top: 15px;\">";

            $itemList .= "<li>
                <label>
                                <input name=\"selected_item[]\" type=\"checkbox\" value=\" $cat->mcat_id \" class=\"ace checkbox-input\">
                               <span class=\"lbl\" style=\"font-size: 14px;\">$cat->mcat_name</span>
                          </label>

                 </li>";

            $itemList .= "</ul>";
            $itemList .= "</div>";
        }


    	return view('merch/setup/supplier', compact('countryList', 'supplierList','itemList','unit_id'));
    }

    public function saveData(Request $request){

        ACL::check(["permission" => "mr_setup"]);
        //dd($request->all());
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(),[
            'sup_name' => 'required|max:50',
            'cnt_id' => 'required|max:11',
            'sup_address' => 'required|max:128',
            'sup_type' => 'required|max:11'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $id= Supplier::orderBy('sup_id', 'DESC')->pluck('sup_id')->first();


            $data= new Supplier();
            $data->cnt_id = $request->cnt_id ;
            $data->unit_id = $request->unit_id;
            $data->sup_name = $request->sup_name ;
            $data->sup_address = $request->sup_address ;
            $data->sup_type = $request->sup_type ;


            if($data->save()){
                $last_id = $data->id;
                $id= Supplier::orderBy('sup_id', 'DESC')->pluck('sup_id')->first();
                for($i=0; $i<sizeof($request->scp_details); $i++){
                    SupplierContact::insert([
                        'sup_id' => $id,
                        'scp_details' => $request->scp_details[$i],
                    ]);
                }

                if(!empty($request->items)){
                for($i=0; $i<sizeof($request->items); $i++){
                    SupplierItemType::insert([
                        'mr_supplier_sup_id' => $last_id,
                        'mcat_id' => $request->item_id[$i],
                    ]);
                }
              }
                return back()
                ->with('success', "Saved Successfully!!");
            }
            else{
                return back()
                ->withInput()
                ->with('error', 'Error saving data!!');
            }
        }
    }
    public function ajaxSaveSupplier(Request $request){

        ACL::check(["permission" => "mr_setup"]);
        //dd($request->all());
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(),[
            'sup_name' => 'required|max:50',
            'cnt_id' => 'required|max:11',
            'sup_address' => 'required|max:128',
            'sup_type' => 'required|max:11'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $id= Supplier::orderBy('sup_id', 'DESC')->pluck('sup_id')->first();

            $data= new Supplier();
            $data->cnt_id = $request->cnt_id ;
            $data->sup_name = $request->sup_name ;
            $data->sup_address = $request->sup_address ;
            $data->sup_type = $request->sup_type ;


            if($data->save()){
                $last_id = $data->id;
                $id= Supplier::orderBy('sup_id', 'DESC')->pluck('sup_id')->first();
                for($i=0; $i<sizeof($request->scp_details); $i++){
                    SupplierContact::insert([
                        'sup_id' => $id,
                        'scp_details' => $request->scp_details[$i],
                    ]);
                }

                if(!empty($request->items)){
                for($i=0; $i<sizeof($request->items); $i++){
                    SupplierItemType::insert([
                        'mr_supplier_sup_id' => $last_id,
                        'mcat_id' => $request->item_id[$i],
                    ]);
                }
              }
                echo $data;exit;
            }
            else{
                echo $data = [];exit;
            }
        }
    }
    public function SupplierDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        Supplier::where('sup_id', $id)->delete();
        SupplierContact::where('sup_id', $id)->delete();
        return back()
        ->with('success', "Supplier Deleted Successfully!!");
    }
    public function SupplierEdit($id){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        $countryList= Country::pluck('cnt_name', 'cnt_id');
        $supplier= Supplier::where('sup_id', $id)->first();
        $sup_contact= SupplierContact::where('sup_id', $id)->get();
        $sup_category = DB::table("mr_supplier_item_type")
                     ->join('mr_material_category','mr_supplier_item_type.mcat_id','=','mr_material_category.mcat_id')
                     ->where('mr_supplier_sup_id',$id)
                     ->get();
        //dd($items);exit;

        $unit_id = DB::table('users')
            ->select('hr_as_basic_info.as_unit_id')
            ->join('hr_as_basic_info','users.associate_id','=','hr_as_basic_info.associate_id')
            ->where('id',Auth::id())
            ->get();

        $buttons = $this->approvalButtons($id);
        //dd($buttons);exit;


        // BOM Items
        $items = DB::table("mr_material_category")
                ->get();

        $supplier_name = DB::table("mr_supplier_item_type")
            ->get();

        $check = [];
        foreach ($supplier_name as $sn)
        {
            $check[$sn->mr_supplier_sup_id][] = $sn->mcat_id;
        }

        //dd($check);exit;

        // BOM Items
        $items = DB::table("mr_material_category")
            ->get();

        $itemList = "";
        //Loop  for category list
        foreach ($items as $cat)
        {

            //dd($items);exit;
          
            $itemList .= "<div class=\"col-sm-4\">";


            //$mcatList = array_column($check[$id], 'mcat_id');
            // $itemList .= "<div class=\"col-sm-4\">
            //     <h4>$cat->mcat_name</h4>";
            $itemList .= "<div class=\"col-sm-4\">";

            //Query  for category item list
            // $subItem = DB::table("mr_cat_item")
            //     ->where("mcat_id", $cat->mcat_id)
            //     ->get();

            $name = strtolower(str_replace(" ", "_", $cat->mcat_name));

            $sl = 1;
            $itemList .= "<ul class=\"list-unstyled\" style=\"padding-top: 15px;\">";

        
            // check mcat_id exist
            if(isset($check[$id])) {
                $checked = in_array($cat->mcat_id, $check[$id]) !== false? 'checked':'';
            } else {
                $checked = '';
            }
            $itemList .= "<li>
                <label>
                    <input name=\"selected_item[]\" type=\"checkbox\" value=\" $cat->mcat_id \" $checked class=\"ace checkbox-input\">
                               <span class=\"lbl\" style=\"font-size: 14px;\">$cat->mcat_name</span>
                          </label>

                 </li>";

            $itemList .= "</ul>";
            $itemList .= "</div>";
        }


        return view('merch/setup/supplier_edit', compact('sup_category','unit_id','supplier', 'sup_contact', 'countryList','buttons','itemList'));
    }

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
			FROM mr_supplier_approval AS l
			LEFT JOIN hr_as_basic_info AS b
				ON b.associate_id = l.submit_to
			WHERE l.sup_id = $id
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
    	$checkStyle = DB::table("mr_supplier")
    		->where("sup_id", $id)
    		->where("status", null)
    		->orWhere("status", "0")
    		->orWhere("status", "1")
    		->exists();


    	if ($checkStyle)
    	{
    		// get hierarchy level
			$levelHierarchy = DB::table("mr_approval_hirarchy")
				->where("mr_approval_type", "Supplier Approval")
				->first();


			/*
			* CHECK APPROVAL STATUS
			* --------------------------------------
			*/
			$checkStyleCost = DB::table("mr_supplier_approval")
				->where("sup_id", $id)
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
				$checkAppReq = DB::table("mr_supplier_approval")
					->where("sup_id", $id)
					->exists();


//				if (!$checkAppReq)
//				{
//					$new_submit_to = $levelHierarchy->level_1;
//					$buttons .= "
//						<div class=\"col-sm-4\">
//							<input type=\"hidden\" name=\"level\" value=\"1\"/>
//							<input type=\"hidden\" name=\"submit_to\" value=\"$new_submit_to\"/>
//						</div>
//						<div class=\"col-sm-8\">
//              <button type=\"submit\" class=\"btn btn-info btn-sm\">Save</button>
//							<button type=\"submit\" name=\"request_for_approve\" class=\"btn btn-success btn-sm\">Request for Approval</button>
//						</div>
//					";
//				}

			}
    	}

		return $buttons;
    }

    public function SupplierUpdate(Request $request){
        //dd($request->all());exit;
         ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(),[
            'sup_name' => 'required|max:50',
            'cnt_id' => 'required|max:11',
            'sup_address' => 'required|max:128',
            'sup_type' => 'required|max:11'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{


            Supplier::where('sup_id', $request->sup_id)
                ->update([
                    'cnt_id' => $request->cnt_id,
                    'unit_id' => $request->unit_id,
                    'sup_name' => $request->sup_name,
                    'sup_address' => $request->sup_address,
                    'sup_type' => $request->sup_type
                ]);

                //SupplierContact::where('sup_id', $request->sup_id)->delete();

                for($i=0; $i<sizeof($request->scp_details); $i++){
                    SupplierContact::where('sup_id',$request->sup_id)
                    ->update([
                        'sup_id' => $request->sup_id,
                        'scp_details' => $request->scp_details[$i],
                    ]);
                }

                $item_count = SupplierItemType::get()->count();
                if ($item_count>0){
                    SupplierItemType::where('mr_supplier_sup_id', $request->sup_id)
                        ->delete();
                    for($j=0; $j<sizeof($request->items); $j++){
                        SupplierItemType::insert([
                            'mr_supplier_sup_id' => $request->sup_id,
                            'mcat_id' => $request->item_id[$j]
                        ]);
                    }
                }else{
                    for($j=0; $j<sizeof($request->items); $j++){
                        SupplierItemType::insert([
                            'mr_supplier_sup_id' => $request->sup_id,
                            'mcat_id' => $request->item_id[$j]
                        ]);
                    }
                }


                if ($request->has("request_for_approve") && !empty($request->submit_to))
                {
                  DB::table("mr_supplier_approval")
                    ->insert([
                      "title" => "precost",
                      "sup_id" => $request->sup_id,
                      "level"     => $request->level,
                      "submit_by" => auth()->user()->associate_id,
                      "submit_to" => $request->submit_to,
                      "comments"  => $request->comments,
                      "status"    => 1,
                      "created_on"  => date("Y-m-d H:i:s"),
                    ]);

                      return redirect("merch/setup/supplier")
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
                    ->where("mr_approval_type", "Supplier Approval")
                    ->first();

                  // update approval status = 2 [request approved]
                  $approvalData = DB::table("mr_supplier_approval")
                    ->where("id", $request->approve_id)
                    ->update([
                      "comments" => $request->comments,
                      "status" => 2
                    ]);

                  if ($request->level == 1)
                  {
                    // insert new approval record
                  DB::table("mr_supplier_approval")
                  ->insert([
                    "title" => "precost",
                    "sup_id" => $request->sup_id,
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
                  DB::table("mr_supplier_approval")
                  ->insert([
                    "title" => "precost",
                    "sup_id" => $request->sup_id,
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
                  DB::table("mr_supplier")
                  ->where("sup_id",  $request->sup_id)
                  ->update([
                    "status" => 2
                  ]);
                  }

                        return redirect("merch/setup/supplier")
                            ->with('success', 'Approved successful.');

                }
            return redirect('merch/setup/supplier')
            ->with('success', "Updated Successfully!!");
        }
    }
}

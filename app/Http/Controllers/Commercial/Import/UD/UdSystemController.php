<?php

namespace App\Http\Controllers\Commercial\Import\UD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\UdMaster;
use App\Models\Commercial\UdAmend;
use App\Models\Commercial\CmUdAmount;
use App\Models\Commercial\UdMasterHistory;
use App\Models\Commercial\UdLibraryFabric;
use App\Models\Commercial\UdLibraryAccessories;
use App\Models\Commercial\CmFile;

use DB, Validator, DataTables;

class UdSystemController extends Controller
{
	/*
	*----------------------------------------------------------
	* UD MASTER LIST
	*----------------------------------------------------------
	*/

    public function udMasterList()
    {
    	$fileList = DB::table("cm_exp_lc_entry")
    		->pluck("cm_file_id", "cm_file_id");

    	return view("commercial/import/ud/list", compact(
    		"fileList",
    		"fileList"
    	));
    }

    public function getUdMasterListData()
    {

      $data = DB::table('cm_ud_master')
                 ->join('cm_file','cm_ud_master.cm_file_id','=','cm_file.id')
                 ->select( 'cm_ud_master.id as id',
                          'cm_file.file_no as file_no',
                          'cm_ud_master.ud_no as ud_no',
                          'cm_ud_master.ud_date as ud_date',
                          'cm_ud_master.remarks as remarks',
                          'cm_ud_master.bgmea_remarks as bgmea_remarks')
                ->orderBy('cm_ud_master.id', 'desc')
                ->get();
                //dd($data);exit;
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">
                    <a href=".url('comm/import/ud_master/edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                </div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

	/*
	*----------------------------------------------------------
	* SHOW ALL FROM
	*----------------------------------------------------------
	*/
    public function showForm()
    {
    	$fileList = CmFile::pluck('file_no','id');
    	return view("commercial/import/ud/new", compact(
    		"fileList"
    	));
    }
    /*
  	*----------------------------------------------------------
  	* Save FROM
  	*----------------------------------------------------------
  	*/
      public function saveUDmasterInfo(Request $request)
      {

        $validator = Validator::make($request->all(), [
            "cm_exp_lc_entry_cm_file_id"    => "required",
            "ud_master_ud_no"               => "required",
            "ud_master_ud_date"             => "required|date",
            "ud_master_quantity"            => "required",
            "ud_master_remarks"             => "max:60",
            "ud_master_bgmea_ref"           => "max:30"
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
          $udMaster = new UdMaster;
          $udMaster->cm_file_id = $request->cm_exp_lc_entry_cm_file_id;
          $udMaster->ud_no     = $request->ud_master_ud_no;
          $udMaster->ud_date   = $request->ud_master_ud_date;
          $udMaster->remarks   = $request->ud_master_remarks;
          $udMaster->bgmea_remarks = $request->ud_master_bgmea_ref;
          $udMaster->save();
          $this->logFileWrite("Ud Master Created", $udMaster->id);
  			// Amendment
  			$udAmend = new UdAmend;

  			$udAmend->cm_ud_master_id = $udMaster->id;
  			$udAmend->amend_no = "0";
  			$udAmend->amend_date = null;
  			$udAmend->bgmea_ref = null;
  			$udAmend->amend_qty = "0";
  			$udAmend->total_qty = $request->ud_master_quantity;
  			$udAmend->save();
        $this->logFileWrite("Ud Amend Added", $udAmend->id);
      		return back()->with("success", "Save Successful.");
        }

      }

	/*
	*----------------------------------------------------------
	* UD MASTER SHOW ALL EDIT FORM
	*----------------------------------------------------------
	*/
    public function editForm(Request $request)
    {
    	$udMaster = collect(\DB::select("
    		SELECT m.*, a.total_qty
    		FROM cm_ud_master AS m
			LEFT JOIN cm_ud_amend AS a
			ON a.cm_ud_master_id = m.id AND
			 a.id IN (SELECT a1.id
				FROM cm_ud_amend a1
				LEFT JOIN cm_ud_amend a2
				ON (a1.cm_ud_master_id = a2.cm_ud_master_id AND a1.id < a2.id)
				WHERE a2.id IS NULL)
			WHERE m.id = '$request->id'
    	"))->first();

    	$udMasterAmend = UdAmend::where("cm_ud_master_id", $request->id)
    		->get();

    	// $fileList = DB::table("cm_exp_lc_entry")
        $fileList = DB::table("cm_file")
    		->pluck("file_no", "id" );
      //dd($fileList);exit;
    	return view("commercial/import/ud/edit", compact(
    		"udMaster",
    		"udMasterAmend",
    		"fileList"
    	));
    }


	/*
	*----------------------------------------------------------
	* MASTER INFORMATION
	*----------------------------------------------------------
	*/
    public function saveMasterInformation(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"com_exp_lc_entry_exp_lc_fileno" => "required|max:45",
    		"ud_master_ud_no"                => "required|max:45",
    		"ud_master_ud_date"              => "required|date",
    		"ud_master_quantity"             => "required|max:45",
    		"ud_master_remarks"              => "required|max:45",
    		"ud_master_bgmea_ref"            => "required|max:45"
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udMaster = new UdMaster;
			$udMaster->com_exp_lc_entry_exp_lc_fileno = $request->com_exp_lc_entry_exp_lc_fileno;
			$udMaster->ud_master_ud_no     = $request->ud_master_ud_no;
			$udMaster->ud_master_ud_date   = $request->ud_master_ud_date;
			$udMaster->ud_master_remarks   = $request->ud_master_remarks;
			$udMaster->ud_master_bgmea_ref = $request->ud_master_bgmea_ref;
			$udMaster->unit_id = auth()->user()->unit_id();
			$udMaster->save();

			// Amendment
			$UdMasterAmend = new UdMasterAmend;
			$UdMasterAmend->com_ud_master_id = $udMaster->id;
			$UdMasterAmend->ud_master_amend_no = "0";
			$UdMasterAmend->com_exp_lc_entry_exp_lc_fileno = $udMaster->com_exp_lc_entry_exp_lc_fileno;
			$UdMasterAmend->ud_master_amend_date = null;
			$UdMasterAmend->ud_master_amend_bgmea_ref = null;
			$UdMasterAmend->ud_master_amend_qty = $request->ud_master_quantity;
			$UdMasterAmend->ud_master_amend_total_qty = $request->ud_master_quantity;
			$UdMasterAmend->save();

			// History
			$UdMasterHistory = new UdMasterHistory;
			$UdMasterHistory->com_ud_master_id = $udMaster->id;
			$UdMasterHistory->ud_master_history_desc = "Create";
			$UdMasterHistory->created_by = auth()->user()->associate_id;
			$UdMasterHistory->created_at = date("Y-m-d H:i:s");
			$UdMasterHistory->save();

    		return back()->with("success", "Saved Successfully.");
    	}
    }

    //Master info update
    public function updateMasterInformation(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"id"                             => "required|max:11",
    		"cm_exp_lc_entry_cm_file_id"     => "required|max:45",
    		"ud_master_ud_no"                => "required|max:45",
    		"ud_master_ud_date"              => "required|date",
    		"ud_master_quantity"             => "required|max:45",
    		"ud_master_remarks"              => "required|max:45",
    		"ud_master_bgmea_ref"            => "required|max:45",
    		"ud_master_amend_no.*"           => "required|max:45",
    		"ud_master_amend_date.*"         => "required|max:45",
    		"ud_master_amend_bgmea_ref.*"    => "required|max:45",
    		"ud_master_amend_qty.*"          => "required|max:45",
    		"ud_master_amend_total_qty.*"    => "required|max:45"
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udMaster = UdMaster::find($request->id);
  			$udMaster->cm_file_id    = $request->cm_exp_lc_entry_cm_file_id;
  			$udMaster->ud_no         = $request->ud_master_ud_no;
  			$udMaster->ud_date       = $request->ud_master_ud_date;
  			$udMaster->remarks       = $request->ud_master_remarks;
  			$udMaster->bgmea_remarks = $request->ud_master_bgmea_ref;
  			$udMaster->save();

			// Amendment

			for($i=0; $i<sizeof($request->ud_master_amend_no); $i++)
			{
        $udMasterAmendexists =UdAmend::where('amend_no','=',$request->ud_master_amend_no[$i])->where('cm_ud_master_id','=',$request->id)->first();
        if(empty($udMasterAmendexists)){
          if($request->ud_master_amend_no[$i] ==1){
            UdAmend::where("amend_no", 0)->delete();
          }
    				$udMasterAmend = new UdAmend;
    				$udMasterAmend->cm_ud_master_id = $request->id;
    				$udMasterAmend->amend_no        = $request->ud_master_amend_no[$i];
    				$udMasterAmend->amend_date      = $request->ud_master_amend_date[$i];
    				$udMasterAmend->bgmea_ref       = $request->ud_master_amend_bgmea_ref[$i];
    				$udMasterAmend->amend_qty       = $request->ud_master_amend_qty[$i];
    				$udMasterAmend->total_qty       = $request->ud_master_amend_total_qty[$i] + $request->ud_master_amend_qty[$i] ;

        if($udMasterAmend->save()){
          UdAmend::where("amend_no", 0)->delete();
        }

        }
			}

       $this->logFileWrite("Ud Master Information Updated", $udMaster->id);

    		return back()->with("success", "Updated Successfully.");
    	}
    }

	/*
	*----------------------------------------------------------
	* LIBRARY
	*----------------------------------------------------------
	*/
	# Fabric
    public function saveLibraryFabric(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"ud_library_fab_pock_code"       => "required|max:45",
    		"ud_library_fab_pock_fab_comp"   => "required|max:45",
    		"ud_library_fab_pock_fab_desc"   => "max:145",
    		"ud_library_fab_pock_fab_cons"   => "required|max:45",
    		"ud_library_fab_pock_width"      => "required|max:45"
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udLibraryFabric = new UdLibraryFabric;
			$udLibraryFabric->ud_library_fab_pock_code = $request->ud_library_fab_pock_code;
			$udLibraryFabric->ud_library_fab_pock_fab_comp = $request->ud_library_fab_pock_fab_comp;
			$udLibraryFabric->ud_library_fab_pock_fab_desc = $request->ud_library_fab_pock_fab_desc;
			$udLibraryFabric->ud_library_fab_pock_fab_cons = $request->ud_library_fab_pock_fab_cons;
			$udLibraryFabric->ud_library_fab_pock_width    = $request->ud_library_fab_pock_width;
			$udLibraryFabric->created_by = auth()->user()->id;
			$udLibraryFabric->created_at = date("Y-m-d H:i:s");
			$udLibraryFabric->save();

    		return back()->with("success", "Save Successful.");
    	}
    }

    public function editLibraryFabric(Request $request)
    {
    	$fabric = UdLibraryFabric::where("id", $request->id)->first();
    	return view("commercial.import.ud.library_fabric_edit", compact(
    		"fabric"
    	));
    }

    public function updateLibraryFabric(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"ud_library_fab_pock_code"       => "required|max:45",
    		"ud_library_fab_pock_code"       => "required|max:45",
    		"ud_library_fab_pock_fab_comp"   => "required|max:45",
    		"ud_library_fab_pock_fab_desc"   => "max:145",
    		"ud_library_fab_pock_fab_cons"   => "required|max:45",
    		"ud_library_fab_pock_width"      => "required|max:45"
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udLibraryFabric = UdLibraryFabric::where("id", $request->id)->first();
			$udLibraryFabric->ud_library_fab_pock_code = $request->ud_library_fab_pock_code;
			$udLibraryFabric->ud_library_fab_pock_fab_comp = $request->ud_library_fab_pock_fab_comp;
			$udLibraryFabric->ud_library_fab_pock_fab_desc = $request->ud_library_fab_pock_fab_desc;
			$udLibraryFabric->ud_library_fab_pock_fab_cons = $request->ud_library_fab_pock_fab_cons;
			$udLibraryFabric->ud_library_fab_pock_width    = $request->ud_library_fab_pock_width;
			$udLibraryFabric->updated_by = auth()->user()->id;
			$udLibraryFabric->updated_at = date("Y-m-d H:i:s");
			$udLibraryFabric->save();

    		return back()->with("success", "Update Successful.");
    	}
    }

    public function deleteLibraryFabric(Request $request)
    {
    	UdLibraryFabric::where("id", $request->id)->delete();
		return back()->with("success", "Delete Successful.");
    }

    public function getLibraryFabricByCode(Request $request)
    {
    	return UdLibraryFabric::where("id", $request->get("id"))
    		->first();
    }

	# Accessories
    public function saveLibraryAccessories(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"ud_library_acss_item_code"      => "required|max:45",
    		"ud_library_fab_pock_fab_desc"   => "max:145",
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udLibraryAccessories = new UdLibraryAccessories;
			$udLibraryAccessories->ud_library_acss_item_code = $request->ud_library_acss_item_code;
			$udLibraryAccessories->ud_library_acss_item_desc = $request->ud_library_acss_item_desc;
			$udLibraryAccessories->created_by = auth()->user()->id;
			$udLibraryAccessories->created_at = date("Y-m-d H:i:s");
			$udLibraryAccessories->save();

    		return back()->with("success", "Save Successful.");
    	}
    }

    public function editLibraryAccessories(Request $request)
    {
    	$accessories = UdLibraryAccessories::where("id", $request->id)->first();
    	return view("commercial.import.ud.library_accessories_edit", compact(
    		"accessories"
    	));
    }

    public function updateLibraryAccessories(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		"id"                             => "required|max:11",
    		"ud_library_acss_item_code"      => "required|max:45",
    		"ud_library_fab_pock_fab_desc"   => "max:145",
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator);
    	}
    	else
    	{
    		$udLibraryAccessories = UdLibraryAccessories::where("id", $request->id)->first();
			$udLibraryAccessories->ud_library_acss_item_code = $request->ud_library_acss_item_code;
			$udLibraryAccessories->ud_library_acss_item_desc = $request->ud_library_acss_item_desc;
			$udLibraryAccessories->updated_by = auth()->user()->id;
			$udLibraryAccessories->updated_at = date("Y-m-d H:i:s");
			$udLibraryAccessories->save();

    		return back()->with("success", "Update Successful.");
    	}
    }

    public function deleteLibraryAccessories(Request $request)
    {
    	UdLibraryAccessories::where("id", $request->id)->delete();
		return back()->with("success", "Delete Successful.");
    }

    //get info by file for ud_amount section
    public function ajaxGetInfobyFile($fileId)
    {
    	$salesContractId = DB::table('cm_exp_lc_entry')
                             //->join('cm_sales_contract','cm_exp_lc_entry.cm_sales_contract_id','cm_sales_contract.id')
                             // ->leftJoin('cm_ud_amount','cm_sales_contract.id','cm_ud_amount.cm_sales_contract_id')
                             ->where('cm_file_id','=',$fileId)
                             // ->get();
                             ->pluck('cm_sales_contract_id');

      $salesContractInfo = DB::table('cm_sales_contract')
                              ->whereIn('cm_sales_contract.id',$salesContractId)
                              ->select('cm_sales_contract.lc_contract_no as lc_contract_no','cm_sales_contract.elc_date as elc_date','cm_sales_contract.id as id')
                              ->get();
        $ud_amount = DB::table('cm_ud_amount')
                        ->whereIn('cm_sales_contract_id',$salesContractId)
                        ->select('utilize_amount','cm_sales_contract_id','id')
                        ->get();
                         //dd($salesContractId);exit;
        $result = array();
        $i = 0;

                // $c =count($salesContractInfo);
           foreach ($salesContractInfo as $salesContract) {
               //  if(count($ud_amount)>0){
               // foreach ($ud_amount as $k=>$ud) {
                 // if($result[0] != $result[$i]['ud_amount_id']){
                 //
                 // }
                 $result[$i]['lc_contract_no'] = $salesContract->lc_contract_no;
                 $result[$i]['elc_date'] = $salesContract->elc_date;
                 $result[$i]['id'] = $salesContract->id;
                 $result[$i]['ud_amount_id'] = '';
                 $result[$i]['utilize_amount'] = '';

             //  }
             // }else{
             //   $result[$i]['lc_contract_no'] = $salesContract->lc_contract_no;
             //   $result[$i]['elc_date'] = $salesContract->elc_date;
             //   $result[$i]['id'] = $salesContract->id;
             //   $result[$i]['ud_amount_id'] = '';
             //   $result[$i]['utilize_amount'] = '';
             // }
           $i++;
         }
       //dd($result);exit;
      echo json_encode($result);exit;
    }


    public function ajaxGetInfobyContractId($salesContractId)
    {

        $ud_amount = DB::table('cm_ud_amount')
                        ->where('cm_sales_contract_id',$salesContractId)
                        ->select('utilize_amount','cm_sales_contract_id','id')
                        ->get();
                         //dd($salesContractId);exit;

      echo json_encode($ud_amount);exit;
    }

   //save Ud amount
   public function saveUDAmount(Request $request){

     // $result = array_merge($request->cm_sales_contract_id,$request->utilize_amount);
     // dd($request->all());exit;

       foreach ($request->utilize_amount as $utilize_amount) {
         foreach ($request->cm_sales_contract_id as $sales_contract_id) {
           foreach ($request->ud_amount_id as $ud_amount_id) {

           if($ud_amount_id != null){
             $udAmount =CmUdAmount::where('id',$request->ud_amount_id)->first();
              $udAmount->cm_sales_contract_id  = $sales_contract_id;
              $udAmount->cm_file_id            = $request->cm_exp_lc_entry_cm_file_id;
        }else {
          $udAmount = new CmUdAmount;
           $udAmount->cm_sales_contract_id  = $sales_contract_id;
           $udAmount->cm_file_id            = $request->cm_exp_lc_entry_cm_file_id;
        }
         }
       }
       $udAmount->utilize_amount        = $utilize_amount;
       $udAmount->save();
       $this->logFileWrite("Ud Amount Added", $udAmount->id);

     }



    return back()->with("success", "Added Successfully.");
   }

}

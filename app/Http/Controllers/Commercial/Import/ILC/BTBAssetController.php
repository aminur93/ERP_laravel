<?php

namespace App\Http\Controllers\Commercial\Import\ILC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Supplier;
use App\Models\Commercial\CmFile;
use App\Models\Commercial\BtbAsset;
use App\Models\Commercial\BtbAssetAmend;
use DB, ACL, DataTables, Auth, Validator;

class BTBAssetController extends Controller
{
	//Show BTB Asset/ Others Entry Form
    public function showForm(){

    	$fileList= DB::table('cm_file')->where('file_type', 2)->where('status', 1)->pluck('file_no', "id");
        $paymentTypeList= DB::table('cm_payment_type')->pluck('type_name', 'id');
        $supplierList= Supplier::pluck('sup_name', 'sup_id');
        $termList= DB::table('cm_inco_term')->pluck('name', 'id');
    	$periodList= DB::table('cm_period')->pluck('period_name', 'id');
        $dateList= DB::table('cm_from_date')->pluck('from_date', 'id');
        $lcTypeList= DB::table('cm_lc_type')->pluck('lc_type_name', 'id');

    	return view('commercial/import/ilc/btb_asset', compact('fileList', 'paymentTypeList', 'supplierList', 'termList', 'periodList', 'dateList', 'lcTypeList'));
    }

    //BTB Asset/Others Store
    public function saveForm(Request $request){

    	//Validation Rules
    	$validator= Validator::make($request->all(), [
						"cm_file_id" => "required| max:11",
						"mr_supplier_sup_id" => "required| max:11",
						"cm_payment_type_id" => "required| max:11",
						"lc_no" => "required| max:45",
						"lc_status" => "required",
						"lc_date" => "required",
						"cm_inco_term_id" => "required",
						"b2b_amend_total_amount" => "required",
						"lc_currency" => "required",
						"amend_remark" => "required| max:45",
						"marine_ins_no" => "required| max:45",
						"marine_ins_cover_date" => "required",
						"lca_no" => "required| max:45",
						"last_ship_date" => "required",
						"expiry_date" => "required",
						"cm_period_id" => "required| max:11",
						"cm_from_date_id" => "required| max:11",
						"cm_lc_type_id" => "required| max:11",
						"interest" => "required",
					]);

    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{

    		try{
    			//Store BTB Asset
	    		$btb= new BtbAsset();
	    		$btb->cm_file_id          = $request->cm_file_id;
	    		$btb->mr_supplier_sup_id  = $request->mr_supplier_sup_id;
	    		$btb->cm_payment_type_id  = $request->cm_payment_type_id;
	    		$btb->lc_no               = $request->lc_no;
	            $btb->lc_status           = $request->lc_status;
	    		$btb->lc_date             = $request->lc_date;
	    		$btb->cm_inco_term_id     = $request->cm_inco_term_id;
	    		$btb->lc_currency         = $request->lc_currency;
	    		$btb->cm_period_id        = $request->cm_period_id;
	    		$btb->cm_from_date_id     = $request->cm_from_date_id;
	    		$btb->interest            = $request->interest;
	    		$btb->cm_lc_type_id       = $request->cm_lc_type_id;
	    		$btb->lc_active_status    = 1;
	    		$btb->save();
	    		//get last id
	    		$btb_id= $btb->id;
	    		//Keep Log
            	$this->logFileWrite("BTB Asset/Others Created", $btb_id);

	    		//Store Amendment
	    		$amendment= new BtbAssetAmend();
	    		$amendment->amend_no  = 0;
	    		$amendment->amend_date  = date("Y-m-d");
	    		$amendment->amend_reason  = "New";
	    		$amendment->last_ship_date  = $request->last_ship_date;
	    		$amendment->expiry_date  = $request->expiry_date;
	    		$amendment->lca_no  = $request->lca_no;
	    		$amendment->amend_remark  = $request->amend_remark;
	    		$amendment->amend_total_lc_amount  = $request->b2b_amend_total_amount;
	            $amendment->marine_ins_no  = $request->marine_ins_no;
	            $amendment->marine_ins_cover_date  = $request->marine_ins_cover_date;
	            $amendment->cm_btb_asset_id  = $btb_id;
	    		$amendment->save();
	            //Keep Log
	            $this->logFileWrite("BTB Amendment Created", $amendment->id);
    		}
    		catch (\Exception $e) {
	            DB::rollback();
	            $bug = $e->getMessage();
	            return redirect()->back()->with('error',$bug);
	        }

	        return back()
    			->with('success', "BTB asset/others saved Successfully!");
    	}
    }
    //get file (Cancel/Close) Information
    public function getFileInfo(Request $request){

        $lc_sum=0;
        $last_cancel_date= null;
        $is_file_closed= null;
        $file_close_date= null;

        //chech whether file is closed or not
        $is_not_closed= CmFile::isClosed($request->file_no);
        
        //if file is not closed check for cancelled date and amount      
        if($is_not_closed){
        	//get cancelled btbs
        	$cancelled_btb= DB::table('cm_btb_asset AS btb')
		                    ->where('btb.cm_file_id', $request->file_no)
		                    ->where('btb.lc_active_status', 0)
		                    ->orderBy('amm.id', 'DESC')
		                    ->leftJoin('cm_btb_asset_amend AS amm', 'btb.id', 'amm.cm_btb_asset_id');
		    //get cancelled btb amount
		    $cancelled_btb_sum= $cancelled_btb->pluck(DB::raw("SUM(amend_total_lc_amount)"))->first();
		    //last Cancelled date
		    $cancelled_btb_date= $cancelled_btb->pluck('cancel_date')->first();
        }

        //supplier List
        $suppliers= Supplier::pluck('sup_name', 'sup_id');

        $supplierList= '<option value="">Select Supplier</option>';

        foreach ($suppliers as $key => $value) {
            $supplierList.='<option value="'.$key.'">'.$value.'</option>';
        }
        $data[0]= $cancelled_btb_sum;
        $data[1]= $cancelled_btb_date; //closed date
        $data[2]= $is_not_closed;
        $data[3]= $cancelled_btb_date; //cancelled date
        $data[4]= $supplierList;
        return $data;
    }


    //BTB Asset/Other List
    public function showList(){

    	$supplierList = Supplier::pluck('sup_name');
        $typeList= DB::table('cm_period')->pluck('period_name');

    	return view('commercial/import/ilc/btb_asset_list', compact('supplierList','typeList'));
    }

    //Asset/Others List data
    public function assetListData(){

        //get list data from cm_btb table
        $data= DB::table('cm_btb_asset AS b')
                ->select([
                    "b.id",
                    "b.cm_file_id",
                    "b.mr_supplier_sup_id",
                    "b.lc_no",
                    "b.lc_status",
                    "b.lc_date",
                    "b.cm_lc_type_id",
                    "b.lc_active_status",
                    "f.file_no",
                    "s.sup_name",
                    "l.lc_type_name",
                ])
                ->leftJoin('cm_file AS f', 'f.id', 'b.cm_file_id')
                ->leftJoin('mr_supplier AS s', 's.sup_id', 'b.mr_supplier_sup_id')
                ->leftJoin('cm_lc_type AS l', 'l.id', 'b.cm_lc_type_id')
                ->get();

        return DataTables::of($data)->addIndexColumn()
                ->editColumn('lc_active_status', function($data){
                    if($data->lc_active_status == 1)
                        return "Active";
                    else
                        return "Cancel";
                })
                ->addColumn('action', function($data){
                     $action_buttons= "<div class=\"btn-group\">  
                            <a href=".url('commercial/import/ilc/btb_asset/'.$data->id.'/edit')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
                                <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                            </a> 
                            <a href=".url('commercial/import/ilc/btb_asset/'.$data->id.'/delete')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" style=\"height:25px; width:26px;\">
                                <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                            </a> ";
                        $action_buttons.= "</div>";

                        return $action_buttons;
                })
                ->toJson();
    }

    //BTB asset/others Edit Form
    public function editForm($btb_asset_id){
    	$fileList= DB::table('cm_file')->where('file_type', 2)->where('status', 1)->pluck('file_no', "id");
        $paymentTypeList= DB::table('cm_payment_type')->pluck('type_name', 'id');
        $supplierList= Supplier::pluck('sup_name', 'sup_id');
        $termList= DB::table('cm_inco_term')->pluck('name', 'id');
    	$periodList= DB::table('cm_period')->pluck('period_name', 'id');
        $dateList= DB::table('cm_from_date')->pluck('from_date', 'id');
        $lcTypeList= DB::table('cm_lc_type')->pluck('lc_type_name', 'id');

        $btb= BtbAsset::where('id', $btb_asset_id)->first();
        $amendments= BtbAssetAmend::where('cm_btb_asset_id', $btb_asset_id)->get();
        // getting lca amount after last ammendment
        $last_amend= BtbAssetAmend::where('cm_btb_asset_id', $btb_asset_id)
                        ->orderBy('id', "DESC")
                        ->first();

    	return view('commercial/import/ilc/btb_asset_edit', compact('fileList', 'paymentTypeList', 'supplierList', 'termList', 'periodList', 'dateList', 'lcTypeList', 'btb', 'amendments', 'last_amend'));
    }

    //Delete BTB Asset/Other
    public function deleteForm($btb_asset_id){
    	BtbAsset::where('id',$btb_asset_id)->delete();
    	BtbAssetAmend::where('cm_btb_asset_id',$btb_asset_id)->delete();
    	return redirect()->back()->with('success', "BTB Asset/Other deleted successfully!");
    }

    //Update BTB asset/Others
    public function assetUpdate(Request $request){
    	$validator= Validator::make($request->all(), [
						"cm_file_id" => "required| max:11",
						"mr_supplier_sup_id" => "required| max:11",
						"cm_payment_type_id" => "required| max:11",
						"lc_no" => "required| max:45",
						"lc_status" => "required",
						"lc_date" => "required",
						"cm_inco_term_id" => "required",
						"b2b_amend_total_amount" => "required",
						"lc_currency" => "required",
						"amend_remark" => "required| max:45",
						"marine_ins_no" => "required| max:45",
						"marine_ins_cover_date" => "required",
						"lca_no" => "required| max:45",
						"last_ship_date" => "required",
						"expiry_date" => "required",
						"cm_period_id" => "required| max:11",
						"cm_from_date_id" => "required| max:11",
						"cm_lc_type_id" => "required| max:11",
						"interest" => "required",
					]);

    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{
    		BtbAsset::where('id', $request->btb_id)
    					->update([
                            "cm_file_id"        => $request->cm_file_id,
                            "mr_supplier_sup_id"=> $request->mr_supplier_sup_id,
                            "cm_payment_type_id"=> $request->cm_payment_type_id, 
                            "lc_no"             => $request->lc_no,
                            "lc_status"         => $request->lc_status,
                            "lc_date"           => $request->lc_date,
                            "cm_inco_term_id"   => $request->cm_inco_term_id,
                            "lc_currency"       => $request->lc_currency,
                            "cm_period_id"      => $request->cm_period_id, 
                            "cm_from_date_id"   => $request->cm_from_date_id, 
                            "cm_lc_type_id"     => $request->cm_lc_type_id,
                            "interest"          => $request->interest,
                            "lc_active_status"          => $request->btb_status
                        ]);
    		if($request->btb_status== 0){
                BtbAsset::where('id', $request->btb_id)
                        ->update([
                            "cancel_date"          => $request->btb_cancel_date
                        ]);
            }

            //Keep Log
            $this->logFileWrite("BTB asset/othes updated", $request->btb_id);

            //Save amendment
            if($request->has('am_amend_id')){

                $validator= Validator::make($request->all(),[
                            "am_amend_id"       => "required",
                            "am_amend_date"     => "required",
                            "am_reason"         => "required",
                            "am_amend_value"    => "required",
                            "am_ship_date"      => "required",
                            "am_expiry_date"    => "required",
                            "am_lca_no"         => "required",
                            "am_remark"         => "required",
                            "am_total_amount"   => "required",
                            "marine_ins_no"     => "required",
                            "marine_ins_cover_date" => "required"
                ]);
                if(!($validator->fails())){
                    
                    $amendment= new BtbAssetAmend();
                    $amendment->amend_no  = $request->am_amend_id;
                    $amendment->amend_date  = $request->am_amend_date;
                    $amendment->amend_reason  = $request->am_reason;
                    $amendment->amend_value  = $request->am_amend_value;
                    $amendment->last_ship_date  = $request->am_ship_date;
                    $amendment->expiry_date  = $request->am_expiry_date;
                    $amendment->lca_no  = $request->am_lca_no;
                    $amendment->amend_remark  = $request->am_remark;
                    $amendment->amend_total_lc_amount  = $request->am_total_amount;
                    $amendment->marine_ins_no  = $request->marine_ins_no;
                    $amendment->marine_ins_cover_date  = $request->marine_ins_cover_date;
                    $amendment->cm_btb_asset_id  = $request->btb_id;
                    $amendment->save();
                    //Keep Log
                    $this->logFileWrite("BTB Amendment Created", $amendment->id);
                }
            }
             return back()
                    ->with('success', "BTB updated Successfully!!");
    	}
    }
}

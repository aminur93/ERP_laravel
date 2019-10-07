<?php

namespace App\Http\Controllers\Hr\Assets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Asset;
use Auth, DB, Validator, DataTables, ACL;

class AssetController extends Controller
{
	# assign list
	public function showList()
	{ 
        ACL::check(["permission" => "hr_asset_assign_list"]);
        #-----------------------------------------------------------# 

    	return view("hr.assets.asset_assign_list");
	}

    # get asset data
    public function getData()
    { 
        ACL::check(["permission" => "hr_asset_assign_list"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_asset_assign AS aa')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'aa.*',
                'fa.fin_asset_serial',
                'fap.fin_asset_product_name',
                'fac.fin_asset_cat_name' 
            )
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', '=', 'aa.hr_associate_id')
            ->leftJoin('fin_asset AS fa', 'fa.fin_asset_id', '=', 'aa.hr_fin_asset_id')
            ->leftJoin('fin_asset_product AS fap', 'fap.fin_asset_product_id', '=', 'fa.fin_asset_product_id')
            ->leftJoin('fin_asset_category AS fac', 'fac.fin_asset_cat_id', '=', 'fap.fin_asset_product_cat_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->get();

        return Datatables::of($data)  
            ->addColumn('associate_id', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_associate_id)." target=\"_blank\">$data->hr_associate_id</a>";
            }) 
            ->addColumn('action', function ($data) {
                if ($data->hr_asset_status == 0)
                {
                    return "<div class=\"btn-group\">
                    	<button disabled type='button' class='btn btn-success btn-xs disabled'>Assigned</button></div>
                    	<a href=".url('hr/assets/assign_edit/'.$data->hr_asset_assign_id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Return Now\">
	                        <i class=\"ace-icon fa fa-history bigger-120\"></i>
	                    </a>
	                    </div>";
                }
                else
                {
                    return "<div class=\"btn-group\"><button disabled type='button' class='btn btn-danger btn-xs disabled'>Returned</button></div>";
                }
            })  
            ->rawColumns(['serial_no', 'associate_id', 'action'])
            ->toJson();
    }


	# show assign form
    public function showForm()
    {
        ACL::check(["permission" => "hr_asset_assign"]);
        #-----------------------------------------------------------# 

    	$categoryList = DB::table('fin_asset_category')
    		->pluck('fin_asset_cat_name' ,'fin_asset_cat_id'); 
    	return view("hr.assets.asset_assign", compact('categoryList'));
    }

    # save data
    public function saveData(Request $request)
    { 
        ACL::check(["permission" => "hr_asset_assign"]);
        #-----------------------------------------------------------# 

    	$validator = Validator::make($request->all(),[
            'fin_asset_cat_id'     =>'required|max:11',
            'fin_asset_product_id' =>'required|max:11',
    		'hr_fin_asset_id'      =>'required|max:11',
            'hr_associate_id'      =>'required|max:10|min:10',
            'hr_asset_assign_date' =>'required|date',
    	]);


    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput();
    	}
    	else
        { 
    		$data = new Asset;
            $data->hr_associate_id = $request->hr_associate_id;
            $data->hr_fin_asset_id = $request->hr_fin_asset_id;
    		$data->hr_asset_assign_date = $request->hr_asset_assign_date;
            $data->hr_asset_return_date = null;
            $data->hr_asset_created_by  = (!empty(Auth::id())?(Auth::id()):null);
    		$data->hr_asset_created_at	= date('Y-m-d H:i:s'); 
    		$data->hr_asset_status = 0; 

    		if ($data->save())
            {
                return back()
                    ->with('success', 'Save Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
    	}
    }

    # Return Product List by Category ID
    public function getProductByCategoryID(Request $request)
    {
        $list = "<option value=\"\">Select Product Name </option>";

        if (!empty($request->category_id))
        { 
            $products  = DB::table('fin_asset_product')
        		->where('fin_asset_product_cat_id', $request->category_id)
                ->pluck('fin_asset_product_name', 'fin_asset_product_id'); 

            foreach ($products as $key => $product) 
            {
                $list .= "<option value=\"$key\">$product</option>";
            }
        }
        return $list;
    }

    # Return Asset List by Product ID
    public function getAssetByProductID(Request $request)
    {
        $list = "<option value=\"\">Select Asset Serial </option>";

        if (!empty($request->product_id))
        { 
            $assets  = DB::table('fin_asset')
        		->where('fin_asset_product_id', $request->product_id)
                ->pluck('fin_asset_serial', 'fin_asset_id'); 

            foreach ($assets as $key => $asset) 
            {
                $list .= "<option value=\"$key\">$asset</option>";
            }
        }
        return $list;
    }



    # edit assign form
    public function editForm(Request $request)
    {
        ACL::check(["permission" => "hr_asset_assign_list"]);
        #-----------------------------------------------------------# 

        $asset = DB::table('hr_asset_assign AS aa')
            ->select(
                'aa.*',
                'fa.fin_asset_serial',
                'fap.fin_asset_product_name',
                'fac.fin_asset_cat_name' 
            )
            ->leftJoin('fin_asset AS fa', 'fa.fin_asset_id', '=', 'aa.hr_fin_asset_id')
            ->leftJoin('fin_asset_product AS fap', 'fap.fin_asset_product_id', '=', 'fa.fin_asset_product_id')
            ->leftJoin('fin_asset_category AS fac', 'fac.fin_asset_cat_id', '=', 'fap.fin_asset_product_cat_id')
            ->where('aa.hr_asset_assign_id', '=', $request->id)
            ->first(); 

        return view("hr.assets.asset_assign_edit", compact('asset'));
    }

    # Assign Status
    public function updateData(Request $request)
    {
        ACL::check(["permission" => "hr_asset_assign_list"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(),[
            'hr_asset_assign_id'   =>'required|max:11',
            'fin_asset_cat_id'     =>'required',
            'fin_asset_product_id' =>'required',
            'hr_fin_asset_id'      =>'required',
            'hr_associate_id'      =>'required|max:10|min:10',
            'hr_asset_assign_date' =>'required|date',
            'hr_asset_return_date' =>'required|date',
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        { 
            $update = Asset::where('hr_asset_assign_id', $request->hr_asset_assign_id)
                ->update([
                    'hr_asset_return_date' => $request->hr_asset_return_date,
                    'hr_asset_status' => 1
                ]); 

            if ($update)
            {
                return back()
                    ->withInput()
                    ->with('success', 'Asset Return Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
        }
    }


}

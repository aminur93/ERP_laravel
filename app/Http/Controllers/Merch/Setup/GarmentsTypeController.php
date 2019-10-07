<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\GarmentsType;
use App\Models\Merch\ProductType;
use ACL, Validator;

class GarmentsTypeController extends Controller
{
	// Show Style Type Form
    public function showForm()
    {
    	$productList = ProductType::pluck("prd_type_name", "prd_type_id");
    	$garments = GarmentsType::leftJoin("mr_product_type", "mr_product_type.prd_type_id", "=", "mr_garment_type.prd_id")
    			->orderBy("gmt_name", "ASC")->get();
    	return view("merch.setup.garments_type", compact("garments", "productList"));
    }

    // Save Data
    public function store(Request $request)
    {
	    ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
            'prd_type_id'   =>'required|max:11',
            'gmt_name' =>'required|max:50',
            'gmt_remarks' =>'max:128',
    	]);

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fields!');
        } 
        else
        {   
            $store = new GarmentsType; 
            $store->prd_id   = $request->prd_type_id; 
            $store->gmt_name = $request->gmt_name; 
            $store->gmt_remarks = $request->gmt_remarks; 
            
            if ($store->save())
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

    // Show Edit From 
    public function edit(Request $request)
    {
	    ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
    	$productList = ProductType::pluck("prd_type_name", "prd_type_id");
    	$garment = GarmentsType::where("gmt_id", $request->id)->first();
    	return view("merch.setup.garments_type_edit", compact("garment", "productList"));
    }

    // Update Data
    public function update(Request $request)
    {
	    ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
            'gmt_id'   =>'required|max:11',
            'prd_type_id'   =>'required|max:11',
            'gmt_name' =>'required|max:50',
            'gmt_remarks' =>'max:128',
    	]);

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fields!');
        } 
        else
        {   
            $update = GarmentsType::where('gmt_id', $request->gmt_id)
            ->update([
            	'prd_id'   => $request->prd_type_id,
            	'gmt_name' => $request->gmt_name,
            	'gmt_remarks' => $request->gmt_remarks,
            ]);
            
            if ($update)
            { 
                return redirect("merch/setup/garments_type")
                    ->with('success', 'Update Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            } 
        }  
    }
    

    // Delete 
    public function destroy(Request $request)
    {
        GarmentsType::where('gmt_id',  $request->id)->delete();
        return back()->with('success', "Delete Successful.");
    }
}

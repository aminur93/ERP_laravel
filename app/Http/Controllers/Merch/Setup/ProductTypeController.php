<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\ProductType;
use ACL, Validator;

class ProductTypeController extends Controller
{
	// Show product Type Form
    public function showForm()
    {
    	$products = ProductType::orderBy("prd_type_name", "ASC")->get();
    	return view("merch.setup.product_type", compact("products"));
    }

    // Save Data
    public function store(Request $request)
    {  
	    ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
            'prd_type_name' =>'required|max:50|unique:mr_product_type',
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
            $store = new ProductType; 
            $store->prd_type_name = $request->prd_type_name; 
            
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
    	$product = ProductType::where("prd_type_id", $request->id)->first();
    	return view("merch.setup.product_type_edit", compact("product"));
    }

    // Save Data
    public function update(Request $request)
    {
	    ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
            'prd_type_id'   =>'required|max:11',
            'prd_type_name' =>'required|max:50',
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
            $update = ProductType::where('prd_type_id', $request->prd_type_id)
            ->update([
            	'prd_type_name' => $request->prd_type_name
            ]);
            
            if ($update)
            { 
                return redirect("merch/setup/product_type")
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
        ProductType::where('prd_type_id',  $request->id)->delete();
        return back()->with('success', "Delete Successful.");
    }

}

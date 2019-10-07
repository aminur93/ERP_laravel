<?php
namespace App\Http\Controllers\Merch\Setup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\MaterialColor;
use App\Models\Merch\MaterialColorAttach;
use App\Models\Merch\MainCategory;
use App\Models\Merch\SubCategory;
use App\Models\Merch\MaterialSize;
use App\Models\Merch\McatItem;

use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use Validator, DB, ACL;

class MaterialController extends Controller
{
    public function itemForm(){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        $categoryList= MainCategory::get();
        $cat_list= MainCategory::pluck('mcat_name','mcat_id');
        $itemList= DB::table('mr_cat_item AS mi')
                    ->select([
                        'mi.*',
                        'mc.*'
                    ])
                    ->leftJoin('mr_material_category AS mc', 'mc.mcat_id', 'mi.mcat_id')
                    ->get();
        return view('merch/setup/item', compact('categoryList', 'SubCategoryList','cat_list','itemList'));
    }

    public function itemStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#

        

       $validator= Validator::make($request->all(),[
            'mcat_name' => 'required',
            'item_name*' => 'required',
            'depends*' => 'required|max:45'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            foreach ($request->item_name as $key => $value) {

                $existing= McatItem::where('mcat_id',$request->mcat_name)->orderBy('id','DESC')->value('id');
                $item_code= "0".$request->mcat_name.((($existing!=null)? $existing:0)+1);

                McatItem::insert([
                    'mcat_id'      => $request->mcat_name,
                    'item_name'    => $value,
                    'item_code'    => $item_code,
                    'dependent_on'    => $request->depends[$key]
                ]);
            }
        return back()
               ->with('success', " Saved Successfully!!");
              // return view('my_view')->withErrors(['Duplicate Record.']);
      }

    }
    public function mainCategoryStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#

    	for($i=0; $i<sizeof($request->msubcat_name); $i++){
    		$data= new SubCategory();
    		$data->mcat_id= $request->mcat_id;
    		$data->msubcat_name= $request->msubcat_name[$i];
    		$data->save();
    	}
    	return back()
    	->with('success', "Material Cetegory Saved Successfully!!");

    }

    public function itemEdit($id){
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------------------#
    	$maincategory= MainCategory::where('mcat_id', $id)->first();
    	$item= McatItem::where('id', $id)->first();
        $cat_list= MainCategory::pluck('mcat_name','mcat_id'); 
        $mitem= DB::table('mr_cat_item as m')
                    ->Select(
                        'm.*',              
                        'mc.mcat_name',
                        'mc.mcat_id'
                    )                 
                  ->leftJoin('mr_material_category AS mc', 'mc.mcat_id', '=', 'm.mcat_id')
                  ->where('m.id', $id)
                  ->first();

    	return view('merch/setup/item_edit', compact('maincategory', 'item','cat_list','mitem'));
    }

    public function itemUpdate(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(),[
            'mcat_name' => 'required',
            'item_name' => 'required|max:45',
            'item_code' => 'required|max:45',
            'depends' => 'required'
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        McatItem::where('id', $request->mcat_id)->update([
                'item_name'    => $request->item_name,
                'item_code'    => $request->item_code,
                'dependent_on'    => $request->depends
           ]);

       return redirect('merch/setup/item')
                ->with('success', "Item updated Successfully!!!");
      } 
    }
    /// Product Size  Delete

    public function itemDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
        McatItem::where('id', $id)->delete();
    
        return back()
        ->with('success', "Item  Deleted Successfully!!");
    }

    // Sub catagory list by Category..
    public function getSubCatByMainCat(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
    	if($request->mcat_id){
    		$subList= SubCategory::where('mcat_id', $request->mcat_id)
    					->pluck('msubcat_name', 'msubcat_id');
    		$data= "<option value=\"\">Select Sub Category</option>";
    		foreach ($subList as $key => $subcatname) {
    			$data.= "<option value=\"$key\">$subcatname</option>";
    		}
    		if(!empty($data)){
    			return $data;
    		}
    	}
    	return "<option value=\"\">No SubCategory Available!</option>";
    }

    // Color CRUD........ 


    public function color(){

    ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------#

          $color= DB::table('mr_material_color')
                    ->orderBy('clr_id', 'desc')->get();
          foreach($color AS $clr){
            $files= DB::table('mr_mat_color_attach')
                    ->where('clr_id', $clr->clr_id)
                    ->get();
            $clr->attached_files=  $files;
          }
          return view('merch/setup/color', compact('color'));
    }
/// Color Store   
    public function colorStore(Request $request){
    	ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------------#
    	  
    	  $validator= Validator::make($request->all(),[
        	'march_color'        =>'required|max:50'
        ]);
        if($validator->fails()){
        	return back()
        	->withInput()
        	->with('error', "Incorrect Input!!");
        }
        else{
  
        	$data= new MaterialColor();
        	$data->clr_name = $request->march_color;
        	$data->clr_code = $request->march_color_code;
        	
        	$data->save();

        	/*$id= MainCategry::orderBy('mcat_id', 'DESC')
        			->pluck('mcat_id')
        			->first();*/

           $last_id = $data->id;
if(!empty($request->march_file)){ 

        if(sizeof($request->march_file)>0){
          for($i=0; $i<sizeof($request->march_file); $i++){
           ///File upload///
              $march_file = null;
               if($request->hasFile('march_file.'. $i)){
               	
                $file = $request->file('march_file.'. $i);

                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/materialcolor/';
                $file->move( public_path($dir) , $filename );
                $march_file = $dir.$filename;
         		
                
          ///File Url Store //////////

        		  MaterialColorAttach::insert([
                        'clr_id'               => $last_id,
                        'col_attach_url'       => $march_file
                    ]);
        	    }
            }  

          }	
        }   
        	return back()
        	->with('success', "Material Color Saved Successfully!!");
        }
    }

    /// Color Delete

    public function colorDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------# 

        MaterialColor::where('clr_id', $id)->delete();
        MaterialColorAttach::where('clr_id', $id)->delete();
        return back()
        ->with('success', "Color Deleted Successfully!!");
    }
    
   /// Color Update
    public function colorEdit($id){
   
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------# 
          $color=MaterialColor::where('clr_id', $id)->first();
          $filesearch=MaterialColorAttach::where('clr_id', $id)->first();
          $colorfile=MaterialColorAttach::where('clr_id', $id)->get();
          return view('merch/setup/color_edit',compact('color','colorfile','filesearch'));

  }

    public function colorUpdate(Request $request){ 
    	//dd($request->all());
       ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

       $validator= Validator::make($request->all(),[
          	'march_color'        =>'required|max:50'            
           

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        $color = MaterialColor::where('clr_id', $request->color_id)->update([
               'clr_name'        => $request->march_color,
               'clr_code'        => $request->march_color_code
               
        ]);

  	//
        //if($request->march_file[0] != null)
        //{
  		  //dd($request->all()); 
       		$colorfile=MaterialColorAttach::where('clr_id', $request->color_id)->delete();

       			//File upload///
             $dir  = '/assets/files/materialcolor/';
        if ($request->march_file != "" ){
             for($i=0; $i<sizeof($request->march_file); $i++){
                 
                  //dd($request->all()); 
                  $march_file = null;
                  if(!empty($request->march_file[$i])){

                    $path=$request->march_file[$i];
                       if (substr($path, 0, 14) == '/assets/files/'){  
                               $march_file=$path;
                             } 
                       else{
                        $filename1 = uniqid() . '.' . $path->getClientOriginalExtension();
                       
                        $path->move( public_path($dir) , $filename1 );
                        $march_file = $dir.$filename1;} 

                  }   

        	///File Url Store //////////

        		MaterialColorAttach::insert([
                        'clr_id'               => $request->color_id,
                        'col_attach_url'       => $march_file
                    ]);
           }
       } 	
        return back()
        ->with('success', "Material Color Successfully Updated!!");
     } 

    //return redirect('merch/setup/infoBrand');
  }

}
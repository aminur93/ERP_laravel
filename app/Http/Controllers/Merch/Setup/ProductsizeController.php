<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\ProductSize;
use App\Models\Merch\ProductSizeGroup;
use App\Models\Merch\Buyer;
use App\Models\Merch\Brand;
use Validator, DB, ACL;
class ProductsizeController extends Controller
{

    // Product Size type form
    public function productSize(){
        ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------------#
        $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');
       $product= ProductSize::get();
       $sizegroup= ProductSizeGroup::pluck('size_grp_name', 'id');
       //$buyer=Buyer::pluck('b_name', 'b_id');
       //$brand=Brand::pluck('br_name', 'br_id');

       $b_permissions = explode(',', auth()->user()->buyer_permissions);
       $buyer        = DB::table('mr_buyer')
                            ->whereIn('b_id', $b_permissions)
                            ->pluck('b_name', 'b_id')
                            ->toArray();

       //for product size list
       $Prodsizegroup= ProductSizeGroup::whereIn('b_id', $b_permissions)->get();


       $sizeModalData=array();

       $sizeItems= DB::table('mr_prdz_size_pallete')
                        ->select([
                            DB::raw("DISTINCT(sl)"),
                            "size"
                        ])
                        ->get();
        $sizeTypes= DB::table('mr_prdz_size_pallete')->get();
        //dd($sizeTypes);exit;
        foreach ($sizeTypes as $size1) {
            $dataGroup[$size1->size_type][] = $size1;
        }
//        dd($dataGroup);
        $sizeModalData[] = view('merch.setup.psize', compact('dataGroup'))->render();

//        $sizeGroupData = '<div class="row">';
//        foreach ($dataGroup as $key=>$dgroup) {
//            $sizeGroupData .= "<fieldset class='group col-sm-12'>
//                                    <legend>".$key."</legend>
//                                        <ul class='checkbox'>" ;
//                foreach($dgroup as $key1=>$dgroupSize) {
//                    $sizeGroupData .= "
//                      <li class='col-sm-1'>
//                        <input type='checkbox' class='group-input-size' name='selected_size[]' id='size_".$dgroupSize->id."' value='".$dgroupSize->id."' />
//                        <label for='size_".$dgroupSize->id."'>".$dgroupSize->size."</label>
//                      </li>";
//                }
//               $sizeGroupData .=  "</ul></fieldset>";
//        }
//        $sizeGroupData .= '</div>';
//        $sizeModalData[]=$sizeGroupData;


        // foreach ($sizeItems as $size) {
        //     $sizeGroupData= '<div class="col-sm-3"><div class="checkbox">';
        //     foreach($sizeTypes AS $type){
        //         if($type->size == $size->size){
        //            $sizeGroupData.= "<label class='col-sm-4' style='padding:0px;'>
        //                 <input name='selected_size[]' id='selected_size_".$type->id."' type='checkbox' class='ace' value='".$type->id."'>
        //                 <span class='lbl'>".$type->size."</span>
        //             </label>";
        //         }
        //     }
        //     $sizeGroupData .= "</div></div>";
        //     $sizeModalData[]=$sizeGroupData;
        // }

       return view('merch/setup/product_size', compact('product','sizegroup','buyer','Prodsizegroup', 'sizeModalData','productType'));

    }

      # Return Brand List by Buyer ID
    public function brandGenerate(Request $request)
    {
        $list = "<option value=\"\">Select Brand</option>";
        if (!empty($request->b_id))
        {

            $brandList  = Brand::where('b_id', $request->b_id)
                          ->pluck('br_name','br_id');

            foreach ($brandList as $key => $value)
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }


    // Save Size Group Ajax
    public function sizegroupSave(Request $request)
    {
      if (empty($request->sizegroup))
      {
          $data['status'] = false;
          $data["error"] = "Invalid Group!";
          return $data;
      }

      $req_upper=strtoupper($request->sizegroup);
      $newgroup=trim($req_upper);

          $store= new ProductSize();
          $store->prdsz_group  = $newgroup;
          $store->save();

        if ($store)
        {
          $data['status'] = true;
          $data['result'] = (object)array(
                            'id'=> $store->id,
                            'text'=> $request->sizegroup,
                          );
          $data["success"] = "Inserted Successfully!";
        }
        else
        {
          $data['status'] = false;
          $data["error"] = "Please try again.";
        }

        return $data;
    }

/// Product Size  Store
    public function productsizestore(Request $request){

       // dd($request->all());
        ACL::check(["permission" => "mr_setup"]);
        #----------------------------------------------#
          // return $request->all();
        $validator= Validator::make($request->all(),[
             'buyer'               =>'required|max:11',
             'brand'               =>'required|max:11',
             'product_type'        =>'required|max:45',
             'gender'              =>'required|max:45'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
          $szgroup_upper_=strtoupper($request->product_size_group);
          $newgroup=trim($szgroup_upper_);

            // $data= new ProductSize();
            // $data->prdsz_size = $request->product_size;
            // $data->prdsz_group  = $newgroup;
            // $data->save();

            $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');

            $data= new ProductSizeGroup();
            $data->b_id                   = $request->buyer;
            $data->br_id                  = $request->brand;
            $data->size_grp_product_type  = $productType[$request->product_type];
            $data->size_grp_gender        = $request->gender;
            $data->size_grp_name          = $request->sg_name;
            $data->save();

            $last_id = $data->id;

            for($i=0; $i<sizeof($request->seleted_sizes); $i++)
            {
                productsize::insert([
                    'mr_product_size_group_id'  => $last_id,
                    'mr_product_pallete_name'   => $request->seleted_sizes[$i]
                ]);
            }


            return back()
            ->with('success', "Product Size Saved Successfully!!");
         }
    }

/// Product Size  Delete

    public function productSizeDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
       ProductSizeGroup::where('id', $id)->delete();
       productsize::where('mr_product_size_group_id', $id)->delete();

        return back()
        ->with('success', "Product Size  Deleted Successfully!!");
    }

/// Product Size Update
    public function productSizeEdit($id){

        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------#
        $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');

        $product= ProductSize::get();
        $sizegroup= ProductSizeGroup::pluck('size_grp_name', 'id');
        //$buyer=Buyer::pluck('b_name','b_id');
        $b_permissions = explode(',', auth()->user()->buyer_permissions);
        $buyer        = DB::table('mr_buyer')
                            ->whereIn('b_id', $b_permissions)
                            ->pluck('b_name', 'b_id')
                            ->toArray();
        //$brand=Brand::pluck('br_name','br_id');
        $Prodsizegroup= ProductSizeGroup::get(); //for list
         //existing
        $Prodsizegroup_up= ProductSizeGroup::where('id', $id)->first(); //for list
        //dd($Prodsizegroup);exit;
        $brand=Brand::where('br_id','=',$Prodsizegroup_up->br_id)->first(['br_name','br_id']);

        $sizeGroup= ProductSize::where('mr_product_size_group_id', $id)->get();
        //dd($sizeGroup);exit;
        $sizeGroups= ProductSize::where('mr_product_size_group_id', $id)->get()->toArray();

        $s_id = array_column($sizeGroups, 'mr_product_pallete_name');
        //dd($s_id);exit;

        $checkedSize= ProductSize::where('mr_product_size_group_id', $id)->pluck('mr_product_pallete_name')->toArray();

        $sizeModalData=array();
        $sizeItems= DB::table('mr_prdz_size_pallete')
                        ->select([
                            DB::raw("DISTINCT(sl)"),
                            "size"
                        ])
                        ->get();
        $sizeTypes= DB::table('mr_prdz_size_pallete')->get();

        foreach ($sizeTypes as $size1) {
            $dataGroup[$size1->size_type][] = $size1;
        }
        dd($dataGroup);exit;
        $sizeModalData[] = view('merch.setup.psize_edit', compact('dataGroup','s_id'))->render();

        //dd($sizeModalData);exit;
//        $sizeGroupData = '<div class="row">';
//        foreach ($dataGroup as $key=>$dgroup) {
//            $sizeGroupData .= "<fieldset class='group col-sm-12'>
//                                    <legend>".$key."</legend>
//                                        <ul class='checkbox'>" ;
//                foreach($dgroup as $key1=>$dgroupSize) {
//                    if(in_array($dgroupSize->size, $checkedSize)){
//                        $checked="checked";
//                    } else {
//                        $checked="";
//                    }
//                    $sizeGroupData .= "
//                      <li class='col-sm-1'>
//                        <input type='checkbox' class='group-input-size' name='selected_size[]' id='size_".$dgroupSize->id."' value='".$dgroupSize->id."' $checked />
//                        <label for='size_".$dgroupSize->id."'>".$dgroupSize->size."</label>
//                      </li>";
//                }
//               $sizeGroupData .=  "</ul></fieldset>";
//        }
//        $sizeGroupData .= '</div>';
//        $sizeModalData[]=$sizeGroupData;

         return view('merch/setup/product_size_edit', compact('product', 'productType','sizeModalData', 'sizeGroups', 'sizegroup','buyer','brand','Prodsizegroup', 'Prodsizegroup_up'));

  }

  public function productSizeUpdate(Request $request){



       ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#

         $validator= Validator::make($request->all(),[
             'buyer'               =>'required|max:11',
             'brand'               =>'required|max:11',
             'product_type'        =>'required|max:45',
             'gender'              =>'required|max:45'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
          $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');

        $Productsizegrp = ProductSizeGroup::where('id', $request->prod_id)->update([
               'b_id'                   => $request->buyer,
               'br_id'                  => $request->brand,
               'size_grp_product_type'  => $productType[$request->product_type],
               'size_grp_gender'        => $request->gender,
               'size_grp_name'          => $request->sg_name

           ]);

     // dd($request->seleted_sizes);
          productsize::where('mr_product_size_group_id', $request->prod_id)->delete();
          if(sizeof($request->seleted_sizes)>0){

            for($i=0; $i<sizeof($request->seleted_sizes); $i++)
            {
                productsize::insert([
                    'mr_product_size_group_id'  => $request->prod_id,
                    'mr_product_pallete_name'   => $request->seleted_sizes[$i]
                ]);
            }
          }

        return redirect("merch/setup/productsize")
                ->with('success', "Product Size Successfully updated!!!");



     }

  }

}

<?php

namespace App\Http\Controllers\Merch\Setup;

use App\Models\Merch\ProductSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Buyer;
use App\Models\Merch\Brand;
use App\Models\Merch\BuyerContact;
use App\Models\Merch\BrandContact;
use App\Models\Merch\Country;
Use Validator,DB, ACL;

class BuyerController extends Controller
{

    public function showForm()
    {
        ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------------#
       $brand=Brand::pluck('br_name', 'br_id');
       $buyers= DB::table('mr_buyer')->orderBy('b_id','desc')->get();
       $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');

      foreach($buyers AS $buyer){
        $contact= DB::table('mr_buyer_contact AS bc')
                  ->where('bc.b_id', $buyer->b_id)
                  // ->orderBy('bc.b_id','desc')
                  ->get();
        $i=1;
        $buyer_contacts="";
        foreach($contact AS $contacts){
          $buyer_contacts.= $i.". ".$contacts->bcontact_person."<br>";
          $i= $i+1;
        }
        $buyer->buyer_contacts= $buyer_contacts;
      }
      $country=Country::pluck('cnt_name','cnt_name');

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
        $sizeModalData[] = view('merch.setup.bsize', compact('dataGroup'))->render();

//       $sizeGroupData = '<div class="row">';
//       foreach ($dataGroup as $key=>$dgroup) {
//           $sizeGroupData .= "<fieldset class='group col-sm-12'>
//                                   <legend>".$key."</legend>
//                                       <ul class='checkbox'>" ;
//               foreach($dgroup as $key1=>$dgroupSize) {
//                   $sizeGroupData .= "
//                     <li class='col-sm-1'>
//                       <input type='checkbox' class='group-input-size' name='selected_size[]' id='size_".$dgroupSize->id."' value='.$dgroupSize->id.' />
//                       <label for='size_".$dgroupSize->id."'>".$dgroupSize->size."</label>
//                     </li>";
//               }
//              $sizeGroupData .=  "</ul></fieldset>";
//       }
//       $sizeGroupData .= '</div>';
//       $sizeModalData[]=$sizeGroupData;
       // dd($buyers);exit;
      return view('merch/setup/buyer_info', compact('buyers','country','sizeModalData','brand','productType'));
  	}

    public function buyerInfoStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------#


        $validator= Validator::make($request->all(),[
            'march_buyer_name' => 'required|max:50',
            'march_buyer_short_name' => 'required|max:50',
            'country'             => 'required|max:128',
            'march_buyer_address' => 'required|max:128',
            'march_buyer_contact' => 'required|max:128'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else {
            $newBuyer= new Buyer();
  	        $newBuyer->b_name = $request->march_buyer_name;
  	        $newBuyer->b_shortname = $request->march_buyer_short_name;
            $newBuyer->b_country = $request->country;
   	        $newBuyer->b_address = $request->march_buyer_address;
  	        $newBuyer->save();
            $last_id = $newBuyer->id;

            // update buyer permission in database user table
            $updateBuyerPermission = auth()->user()->buyer_permissions.",".$last_id;
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update(['buyer_permissions' => $updateBuyerPermission]);

            for($i=0; $i<sizeof($request->march_buyer_contact); $i++)
            {
                    BuyerContact::insert([
                        'b_id'                  => $last_id,
                        'bcontact_person'       => $request->march_buyer_contact[$i]
                    ]);
            }


            if(!empty($request->brand_name) && is_array($request->brand_name)){
                for($i=0; $i<sizeof($request->brand_name); $i++)
                {
                        Brand::insert([
                            'b_id'                  => $last_id,
                            'br_name'       => $request->brand_name[$i]
                        ]);
                }
            }else{

            }

            //add sample type

            if(!empty($last_id)){
              foreach ($request->sample_name as $sampleName) {
                if(!empty($sampleName)){
                  try {
                    DB::table("mr_sample_type")->insert([
                     "sample_name" => $sampleName,
                     "b_id" => $last_id,
                   ]);

                  } catch (\Exception $e) {
                    return back()
                    ->withInput()
                    ->with('error', "Sample Type Already Exists! Please Try Again Using New Sample Name.");
                  }
             }
              }

            }


            //add product size group
            if(!empty($last_id)&& !empty($request->product_type) && !empty($request->gender) && !empty($request->sg_name) ){
              $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');

              $mr_product_size_group_id = DB::table("mr_product_size_group")->insertGetId([
               "size_grp_product_type" => $productType[$request->product_type],
               "size_grp_gender" => $request->gender,
               "size_grp_name" => $request->sg_name,
               "b_id" => $last_id,
             ]);
             if(!empty($mr_product_size_group_id)){
              foreach ($request->seleted_sizes as $size) {
                DB::table("mr_product_size")->insert([
                 "mr_product_size_group_id" => $mr_product_size_group_id,
                 "mr_product_pallete_name" => $size,
               ]);
              }
            }

            }


            //add season info
            if(!empty($last_id) && !empty($request->se_name) && !empty($request->se_mm_start) &&  !empty($request->se_mm_end) ){
              $brandid = DB::table("mr_season")->insert([
               "se_name" => $request->se_name,
               "se_start" => date('Y-m-d', strtotime($request->se_mm_start)),
               "se_end" => date('Y-m-d', strtotime($request->se_mm_end)),
               "b_id" => $last_id,
             ]);


            }

      	    $preUrl = redirect()->back()->getTargetUrl();
            if(strpos($preUrl, '?pre=')) {
                $exPreUrl = explode('=', $preUrl);
                $preUrlPath = $exPreUrl[1];
                return redirect($preUrlPath.'?bNewId='.$last_id.'#buyerSection')
                    ->with('success', 'New buyer add success!!');
            } else {
                return back()
                    ->with('success', "Buyer Information saved successfully!");
            }
      }
    }

    public function buyerUpdate($id){

        ACL::check(["permission" => "mr_setup"]);
        #--------------------------------------------#
        $brand=Brand::pluck('br_name', 'br_id');
        $buyer=Buyer::where('b_id', $id)->first();
        $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');


        $sampleTypes = DB::table('mr_sample_type')->where('b_id', $id)->get();


        $productSizeGroups = DB::table('mr_product_size_group')
                               ->leftJoin('mr_product_size','mr_product_size_group.id','=','mr_product_size.mr_product_size_group_id')
                               ->where('b_id', $id)

                               ->get();
                               //dd($productSizeGroups);exit;
                               
                               


        $s_id = array_column($productSizeGroups, 'mr_product_pallete_name');
        //dd($s_id);exit;
        //Buyer List
        $buyerBrands =  Brand::where('b_id', $id)
                            ->select('br_name', 'br_id')
                            ->orderBy('br_id', "ASC")
                            ->get();
        //Maximun Buyer ID, for update
        $brandMax =  Brand::where('b_id', $id)
                            ->value(DB::raw("max(br_id)"));

        $seasons = DB::table('mr_season')->where('b_id', $id)->get();
        // dd($productSizeGroups);exit;

        $buyer_contact=BuyerContact::where('b_id', $id)->get();
        $country=Country::pluck('cnt_name','cnt_name');

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

        $sizeModalData[] = view('merch.setup.bsize_edit', compact('dataGroup','s_id'))->render();

//       $sizeGroupData = '<div class="row">';
//       foreach ($dataGroup as $key=>$dgroup) {
//           $sizeGroupData .= "<fieldset class='group col-sm-12'>
//                                   <legend>".$key."</legend>
//                                       <ul class='checkbox'>" ;
//               foreach($dgroup as $key1=>$dgroupSize) {
//                   $sizeGroupData .= "
//                     <li class='col-sm-1'>
//                       <input type='checkbox' class='group-input-size' name='selected_size[]' id='size_".$dgroupSize->id."' value='.$dgroupSize->id.' />
//                       <label for='size_".$dgroupSize->id."'>".$dgroupSize->size."</label>
//                     </li>";
//               }
//              $sizeGroupData .=  "</ul></fieldset>";
//       }
//       $sizeGroupData .= '</div>';
//       $sizeModalData[]=$sizeGroupData;


      return view('merch/setup/buyer_info_edit',compact('buyer','buyer_contact','country','sizeModalData','brand','sampleTypes','productSizeGroups','buyerBrands', 'brandMax', 'seasons','productType'));

  }

    public function buyerUpdateAction(Request $request){


       ACL::check(["permission" => "mr_setup"]);
      #---------------------------------------------#
       $validator= Validator::make($request->all(),[
            'march_buyer_name' => 'required|max:50',
            'march_buyer_short_name' => 'required|max:50',
            'country'             => 'required|max:128',
            'march_buyer_address' => 'required|max:128',
            'march_buyer_contact' => 'required|max:128'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        //update Buyer Information
        $buyer_record = Buyer::where('b_id', $request->buyer_id)->update([
               'b_name' => $request->march_buyer_name,
               'b_shortname' => $request->march_buyer_short_name,
               'b_country' => $request->country,
               'b_address' => $request->march_buyer_address
        ]);
         //dd($request->brand_name);exit;
        //If request has Brand Name then Update brand Information
        if($request->has('brand_name') && is_array($request->brand_name)){

        	//Get Existing Brands
            $brands= Brand::where('b_id', $request->buyer_id)->pluck('br_id');

            //If any existing brand is removed while updating then delete it from database
            for($i=0; $i<sizeof($brands); $i++){
                $chk= false;
                foreach($request->brand_name as $key => $value){
                    if($brands[$i] == $key){
                        $chk=true;
                         break;
                    }
                }
                if($chk== false){
                    Brand::where('br_id', $brands[$i])->delete();
                }
            }

            //Now Insert Or update Brand Name
            foreach ($request->brand_name as $key => $value) {
                $br_exists= Brand::where('br_id', $key)->exists();

                if($br_exists){
                     Brand::where('br_id', $key)
                            ->update([
                                'b_id' => $request->buyer_id,
                                'br_name' => $value,
                            ]);
                }
                else{
                     Brand::insert([
                        'b_id' => $request->buyer_id,
                        'br_name' => $value,
                     ]);
                }

            }
        }else{
          $brands= Brand::where('b_id', $request->buyer_id)->get();
          foreach ($brands as $brand) {
            Brand::where('br_id', $brand->br_id)->delete();
          }
        }




       $buyer_contact=BuyerContact::where('b_id', $request->buyer_id)->delete();

                for($i=0; $i<sizeof($request->march_buyer_contact); $i++){
                    BuyerContact::insert([
                        'b_id' => $request->buyer_id,
                        'bcontact_person' => $request->march_buyer_contact[$i],
                    ]);
                }

                if(!empty($request->buyer_id)){
                  foreach ($request->sample_name as $sampleName) {
                    if(!empty($sampleName)){
                      try {
                        DB::table("mr_sample_type")->insert([
                         "sample_name" => $sampleName,
                         "b_id" => $request->buyer_id,
                       ]);

                      } catch (\Exception $e) {
                        return back()
                        ->withInput()
                        ->with('error', "Sample Type Already Exists! Please Try Again Using New Sample Name.");
                      }

                 }
                  }

                }


                //Update product size group
                if(!empty($request->buyer_id) && !empty($request->product_type) && !empty($request->gender) && !empty($request->sg_name) ){
                    $productType = DB::table('mr_product_type')->pluck('prd_type_name','prd_type_id');
                    $mr_product_size_group_id = DB::table("mr_product_size_group")->insertGetId([
	                   "size_grp_product_type" => $productType[$request->product_type],
	                   "size_grp_gender" => $request->gender,
	                   "size_grp_name" => $request->sg_name,
	                   "b_id" => $request->buyer_id,
	                 ]);

	                 if(!empty($mr_product_size_group_id)){
	                  foreach ($request->seleted_sizes as $size) {
	                    DB::table("mr_product_size")->insert([
	                     "mr_product_size_group_id" => $mr_product_size_group_id,
	                     "mr_product_pallete_name" => $size,
	                   ]);
	                  }
	                }

                }

                //add brand and brand info
                if(!empty($request->buyer_id) && !empty($request->march_brand_name2) && !empty($request->march_brand_short_name2) && !empty($request->br_country)){
                  $brandid = DB::table("mr_brand")->insertGetId([
                   "br_name" => $request->march_brand_name2,
                   "br_shortname" => $request->march_brand_short_name2,
                   "br_country" => $request->br_country,
                   "b_id" => $request->buyer_id,
                 ]);
                 if(!empty($brandid)){
                  foreach ($request->march_brand_contact as $brcontract) {
                    DB::table("mr_brand_contact")->insert([
                     "brcontact_person" => $brcontract,
                     "br_id" => $brandid,
                   ]);
                  }
                }

                }
                //add season info
                if(!empty($request->buyer_id) && !empty($request->se_name) && !empty($request->se_mm_start) &&  !empty($request->se_mm_end) ){
                  $brandid = DB::table("mr_season")->insert([
                   "se_name" => $request->se_name,
                   "se_start" => date('Y-m-d', strtotime($request->se_mm_start)),
                   "se_end" => date('Y-m-d', strtotime($request->se_mm_end)),
                   "b_id" => $request->buyer_id,
                 ]);

              }

        return redirect('merch/setup/buyer_info')
          ->with('success', "Buyer Info Updated successfully!!");
     }
  }

    public function buyerDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------------#
        Buyer::where('b_id', $id)->delete();
        BuyerContact::where('b_id', $id)->delete();
        return back()
        ->with('success', "Buyer Deleted Successfully!!");
    }


///Brand

    public function brand(){
      ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------------#
              $b_permissions = explode(',', auth()->user()->buyer_permissions);
              $buyers        = DB::table('mr_buyer as b')
                            ->whereIn('b.b_id', $b_permissions)
                            ->pluck('b.b_name', 'b.b_id')
                            ->toArray();

              $brands= DB::table('mr_brand as br')
                    ->Select(
                        'br.br_id',
                        'br.br_name',
                        'br.b_id',
                        'br.br_shortname',
                        'br.br_country',
                        'b.b_id',
                        'b.b_name'
                    )
                  ->leftJoin('mr_buyer AS b', 'b.b_id', '=', 'br.b_id')
                  ->whereIn('b.b_id', $b_permissions)
                  ->get();

            foreach($brands AS $brand){
              $contacts= DB::table('mr_brand_contact AS bc')
                              ->where('bc.br_id', $brand->br_id)
                              ->get();
              $contact_person= "";
              $i=1;
              foreach($contacts AS $cp){
                $contact_person.= '<b style="font-size: 14px">'.$i.'</b>'.". ". $cp->brcontact_person."<br>";
                $i= $i+1;
              }
              $brand->contact_person= $contact_person;
            }

            $country=Country::pluck('cnt_name','cnt_name');

      return view('merch/setup/brand', compact('buyers','brands','country'));

      }
     public function brandStore(Request $request){
     ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------------#

       $validator= Validator::make($request->all(),[
            'march_buyer_name2' => 'required|max:11',
            'march_brand_name2' => 'required|max:50',
            'march_brand_short_name2' => 'required|max:50',
            'march_brand_contact' => 'required|max:128',
            'country'             => 'required|max:128'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
       $newBrand= new Brand();
  	   $newBrand->b_id = $request->march_buyer_name2;
  	   $newBrand->br_name = $request->march_brand_name2;
   	   $newBrand->br_shortname = $request->march_brand_short_name2;
       $newBrand->br_country = $request->country;

  	   $newBrand->save();
       $last_id = $newBrand->id;

          for($i=0; $i<sizeof($request->march_brand_contact); $i++)
          {
                    BrandContact::insert([
                        'br_id'                => $last_id,
                        'brcontact_person'     => $request->march_brand_contact[$i]
                    ]);
          }
  	    //return
  	     //return redirect('merch/setup/brand');
          return back()
                ->with('success', "Brand Saved Successfully !!!");
       }

    }

    public function brandUpdate($id){

              ACL::check(["permission" => "mr_setup"]);
    #-----------------------------------------------#


      $brand=Brand::where('br_id', $id)->first();
      // $buyer_name=Buyer::pluck('b_name', 'b_id');
      $b_permissions = explode(',', auth()->user()->buyer_permissions);
      $buyer_name    = DB::table('mr_buyer as b')
                            ->whereIn('b.b_id', $b_permissions)
                            ->pluck('b.b_name', 'b.b_id')
                            ->toArray();
      $brand_contact=BrandContact::where('br_id', $id)->get();
      $country=Country::pluck('cnt_name','cnt_name');

      return view('merch/setup/brandUpdate',compact('brand','buyer_name','brand_contact','country'));

  }

    public function brandUpdateAction(Request $request){

       ACL::check(["permission" => "mr_setup"]);
        #--------------------------------------------#
       $validator= Validator::make($request->all(),[
            'march_buyer_name2' => 'required|max:11',
            'march_brand_name2' => 'required|max:50',
            'march_brand_short_name2' => 'required|max:50',
            'march_brand_contact' => 'required|max:128',
            'country'             => 'required|max:128'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

          $brand_record = Brand::where('br_id', $request->brand_id)->update([
                 'b_id'         => $request->march_buyer_name2,
                 'br_name'      => $request->march_brand_name2,
                 'br_shortname' => $request->march_brand_short_name2,
                 'br_country'   => $request->country
          ]);

          $brand_contact=BrandContact::where('br_id', $request->brand_id)->delete();

                  for($i=0; $i<sizeof($request->march_brand_contact); $i++){
                      BrandContact::insert([
                          'br_id' => $request->brand_id,
                          'brcontact_person' => $request->march_brand_contact[$i],
                      ]);
                  }


            if ($brand_record || $brand_contact)
            {
              /*return redirect('merch/setup/infoBrand')
                ->with('success', "Brand Information Update successful.");*/
              return redirect('merch/setup/brand')
                ->with('success', "Brand Info updated successfully!!");

            }
            else
            {
              return back()
                ->with('error', "Please try again.");
            }

        }
    //return redirect('merch/setup/infoBrand');
  }

  public function brandDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------#
        Brand::where('br_id', $id)->delete();
        BrandContact::where('br_id', $id)->delete();
        return back()
        ->with('success', "Brand Deleted Successfully!!");
    }

    public function styletype(){
    	return view('merch/setup/styletype');
    }

    public function getBuyerProfile($buyer_id=null){
        ACL::check(["permission" => "mr_setup"]);
       $buyerInfo = DB::table('mr_buyer')
                      ->join('mr_buyer_contact','mr_buyer.b_id','=','mr_buyer_contact.b_id')
                      ->where('mr_buyer.b_id',$buyer_id)
                      ->first();
                      //dd($buyerInfo);exit;
        $sampleType = DB::table('mr_sample_type')
                        ->where('b_id',$buyer_id)
                        ->get();
                        //dd($sampleType);exit;
        $prodsizegroup = DB::table("mr_product_size_group")
                              ->join('mr_product_size','mr_product_size_group.id','=','mr_product_size.mr_product_size_group_id')
                              ->where('mr_product_size_group.b_id',$buyer_id)
                              ->get();
                              //dd($prodsizegroup);exit;
        $brands = DB::table('mr_brand')
                     ->join('mr_brand_contact','mr_brand.br_id','=','mr_brand_contact.br_id')
                     ->where('mr_brand.b_id',$buyer_id)
                     ->get();
        $seasons = DB::table('mr_season')
                      ->where('b_id',$buyer_id)
                      ->get();
                     //dd($brands);exit;
         $orders = DB::table('mr_order_entry')
                     ->leftJoin('mr_brand','mr_order_entry.mr_brand_br_id','=','mr_brand.br_id')
                     ->leftJoin('mr_season','mr_order_entry.mr_season_se_id','=','mr_season.se_id')
                     ->where('mr_buyer_b_id', $buyer_id)
                     ->get();
         $styles = DB::table('mr_style')
                     ->where('mr_buyer_b_id', $buyer_id)
                     ->get();
       return view('merch/setup/buyerProfile',compact('buyerInfo','sampleType','prodsizegroup','brands','seasons','orders','styles'));
    }
}

<?php

namespace App\Http\Controllers\Merch\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Merch\Brand;
use App\Models\Merch\Style;
use App\Models\Merch\Season;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\PurchaseOrder;
use App\Models\Merch\Reservation;
use App\Models\Merch\PoInseamSize;
use App\Models\Merch\PoSubStyle;
use App\Models\Merch\Country;
use App\Models\Merch\OrderBOM;
use App\Models\Merch\OrderBomOtherCosting;
use App\Models\Merch\OrderOperationNCost;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use DB, ACL, Validator,DataTables;


class ReportController extends Controller
{
	//get report view
   public function getReport(Request $request){

     $start = !empty($request->range_from)?$request->range_from:'';
     $end  =  !empty($request->range_to)?$request->range_to:'';

     $unit = !empty($request->unit_id)?$request->unit_id:'';
     $buyer  =  !empty($request->buyer_id)?$request->buyer_id:'';

		 $unitList =DB::table('hr_unit')->pluck('hr_unit_name','hr_unit_id');
		 $buyerList = DB::table('mr_buyer')->pluck('b_name','b_id');
		 $start = !empty($request->range_from)?$request->range_from:'';
		 $end  =  !empty($request->range_to)?$request->range_to:'';

		 if($request->type == 'style'){

			 $style = DB::table('mr_style')
			            ->leftJoin('mr_stl_bom_other_costing','mr_style.stl_id','=','mr_stl_bom_other_costing.mr_style_stl_id')
			            ->leftJoin('mr_buyer','mr_style.mr_buyer_b_id','=','mr_buyer.b_id')
                  ->when(!empty($request->range_from), function ($query) use($request){
                         return $query->whereBetween('stl_added_on', array(date($request->range_from), date($request->range_to)));
                    })
                  ->groupBy('mr_style.stl_id')
									->get();

								return view("merch.report.merch_report",compact("style","unitList","buyerList","start","end"));
		 }elseif ($request->type == 'order') {

			 			 $orders = DB::table('mr_order_entry')
                     ->when(!empty($request->range_from), function ($query) use($request){
                            return $query->whereBetween('mr_order_entry.created_at', array(date($request->range_from), date($request->range_to)));
                            })
                    ->when(!empty($request->unit_id), function ($query) use($request){
                           return $query->where('mr_order_entry.unit_id',$request->unit_id);
                           })
                     ->when(!empty($request->buyer_id), function ($query) use($request){
                            return $query->where('mr_order_entry.mr_buyer_b_id',$request->buyer_id);
                            })
    									 ->paginate(1);

              $orders['data'] = $this->formateOrder($orders->toArray(),$buyerList,$unitList);

								return view("merch.report.merch_report",compact("orders","unitList","buyerList","start","end","unit","buyer"));

		 }elseif($request->type == 'bp'){
      if(!empty($request->range_from)){
  		 	$res_month_year = explode('-', $request->range_from);
  		 	$f_month = $res_month_year[1];
  		 	$f_year = $res_month_year[0];
      }
      if(!empty($request->range_to)){
		 	$res_month_tyear = explode('-', $request->range_to);
		 	$t_month = $res_month_year[1];
		 	$t_year = $res_month_year[0];
    }

		 	 if(!empty($f_month) && !empty($f_year) && !empty($t_month) && !empty($t_year)){

		 	 	 $reservation = DB::table('mr_capacity_reservation')
			            ->leftJoin('hr_unit','mr_capacity_reservation.hr_unit_id','=','hr_unit.hr_unit_id')

			            ->leftJoin('mr_buyer','mr_capacity_reservation.b_id','=','mr_buyer.b_id')
			            ->leftJoin('mr_product_type','mr_capacity_reservation.prd_type_id','=','mr_product_type.prd_type_id')
			            ->whereBetween('mr_capacity_reservation.res_month', array(date($f_month), date($t_month)))
			            ->orwhereBetween('mr_capacity_reservation.res_year', array(date($f_year), date($t_year)))
					        ->get();


				$reservation = $this->formateRes($reservation->toArray());

				$data_store_unique = [];
				foreach($reservation as $k=>$each_res) {
					if(is_array($each_res) || is_object($each_res)) {
						foreach($each_res as $k2=>$e_res) {
							$data_store_unique[$k][] = $e_res->res_month.'-'.$e_res->res_year;

						}

						$data_store_unique[$k] = array_count_values($data_store_unique[$k]);

					}
				}

			 	 // dd($reservation);exit;
				return view("merch.report.merch_report",compact("data_store_unique","reservation","unitList","buyerList","start","end","unit","buyer"));

      }else{
        $reservation = DB::table('mr_capacity_reservation')
                 ->leftJoin('hr_unit','mr_capacity_reservation.hr_unit_id','=','hr_unit.hr_unit_id')

                 ->leftJoin('mr_buyer','mr_capacity_reservation.b_id','=','mr_buyer.b_id')
                 ->leftJoin('mr_product_type','mr_capacity_reservation.prd_type_id','=','mr_product_type.prd_type_id')
                ->get();


       $reservation = $this->formateRes($reservation->toArray());

       $data_store_unique = [];
       foreach($reservation as $k=>$each_res) {
         if(is_array($each_res) || is_object($each_res)) {
           foreach($each_res as $k2=>$e_res) {
             $data_store_unique[$k][] = $e_res->res_month.'-'.$e_res->res_year;

           }

           $data_store_unique[$k] = array_count_values($data_store_unique[$k]);

         }
       }

        // dd($reservation);exit;
       return view("merch.report.merch_report",compact("data_store_unique","reservation","unitList","buyerList","start","end","unit","buyer"));

      }

		 }else{

		   return view("merch.report.merch_report",compact("unitList","buyerList"));
	  }

	 }

	 private function formateRes($reservation)
	 {
	 	$result = [];

	 	 $gtotal = 0;
         $shtotal = 0;

	 	$bid = array_unique(array_column($reservation,'b_id'),SORT_REGULAR);

	 	foreach ($bid as $b) {

	 		$buyers =DB::table('mr_capacity_reservation')

			            // ->leftJoin('mr_buyer','mr_capacity_reservation.b_id','=','mr_buyer.b_id')
			            // ->leftJoin('mr_product_type','mr_capacity_reservation.prd_type_id','=','mr_product_type.prd_type_id')
			            ->where('mr_capacity_reservation.b_id',$b)
			            // ->groupBy('mr_capacity_reservation.b_id')
			            ->get();
			            // dd($buyers);exit;
			            // $result[] = $buyers;

			foreach ($buyers as $bu) {
				//dd($result);exit;

			       $buinfo =DB::table('mr_capacity_reservation')

			            ->leftJoin('mr_buyer','mr_capacity_reservation.b_id','=','mr_buyer.b_id')
			            ->leftJoin('mr_product_type','mr_capacity_reservation.prd_type_id','=','mr_product_type.prd_type_id')
			            ->where('mr_capacity_reservation.res_id',$bu->res_id)
			            ->first();

			    $gtotal += $buinfo->res_quantity;
			    $shtotal += $buinfo->res_sah;


			    $result[$bu->b_id][] = $buinfo;
			    // $result['gtotal'] = $gtotal;
			    // $result['shtotal'] = $shtotal;

			}
	 	}

	 	 //dd($result);exit;
	 	return $result;
	 }

   //order report data fromating
   private function formateOrder($orders,$buyerList,$unitList){

           $result = [];
            $unitId = array_unique(array_column($orders['data'],'unit_id'),SORT_REGULAR);

           foreach ($unitId as $unit) {
                 $buyers = DB::table('mr_order_entry')->where('unit_id','=',$unit)->select('mr_buyer_b_id','order_id')->get();

                 foreach ($buyers as $k=>$buyer) {
                    $border = DB::table('mr_order_entry')
                                  ->leftJoin('mr_style','mr_order_entry.mr_style_stl_id','=','mr_style.stl_id')
                                  ->leftJoin('mr_stl_bom_other_costing','mr_style.stl_id','=','mr_stl_bom_other_costing.mr_style_stl_id')
                                  ->leftJoin('mr_capacity_reservation','mr_order_entry.res_id','=','mr_capacity_reservation.res_id')
                                   ->where('mr_order_entry.mr_buyer_b_id','=',$buyer->mr_buyer_b_id)
                                   ->where('mr_order_entry.order_id','=',$buyer->order_id)
                                   ->groupBy('mr_style.stl_id')
                                   ->first();
                   $result[$unitList[$unit]][$buyerList[$buyer->mr_buyer_b_id]][] = $border;

                 }
           }
     return $result;
   }
}

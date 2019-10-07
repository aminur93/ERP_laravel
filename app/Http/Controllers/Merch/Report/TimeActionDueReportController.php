<?php

namespace App\Http\Controllers\Merch\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Merch\TnaLibrary;
use App\Models\Merch\TnaTemplate;
use App\Models\Merch\TnaTemplatetoLibrary;
Use DB, ACL, Validator, DataTables,DateTime;
use Response;

class TimeActionDueReportController extends Controller
{
	public function tnaDueViewReport(){
		//for order selection dropdown
		$orders = DB::table('mr_order_tna as tna_orders')
					->join('mr_order_entry as orders', 'orders.order_id', '=', 'tna_orders.order_id')
					->select('orders.order_code', 'orders.order_id' )
					->get();
	    // dd($orders);
		//for tna action selection dropdown
	    $tna_actions = DB::table('mr_tna_library')->select('id', 'tna_lib_action', 'tna_lib_code')->get();

	    // dd('Orders:', $orders, 'Actions:', $tna_actions);

		return view('merch.report.tna_due_report', compact('orders', 'tna_actions'));
	}

	//ajax function call
	public function tnaDueReportResult(Request $request){
		// dd($request->all());
		$odr_id 	= $request->order_id;
		$tna_act_id = $request->tna_action_id;
		$from_date 	= $request->from_date;
		$to_date 	= $request->to_date;
		
		//order list with its tna actions..
		$data_library1 = DB::table('mr_order_tna as odr_tna')
							->join('mr_order_entry as odr', 'odr.order_id', '=', 'odr_tna.order_id' )
							// ->join('mr_order_tna_action as od_tna_act', 'od_tna_act.mr_order_entry_order_id', '=', 'odr_tna.id' )
							->select([
								'odr.order_id',
								'odr.mr_buyer_b_id',
							    'odr.order_code',
								'odr.order_ref_no',
							    'odr.order_delivery_date',
							    'odr.order_qty',
							    'odr_tna.id as order_tna_id',
							    'odr_tna.mr_tna_template_id',
							    'odr_tna.lead_days',
							    'odr_tna.tolerance_days',
							    // 'od_tna_act.mr_tna_library_id',
							    // 'od_tna_act.actual_date'
							])
							->distinct()
							->get();
		
		foreach ($data_library1 as $lib1) {
			$order_tna_actions = DB::table('mr_order_tna_action as o_tna_act')
										->join('mr_tna_library as tna_lib', 'tna_lib.id', '=', 'o_tna_act.mr_tna_library_id')
										->select([
												'o_tna_act.actual_date',
												'o_tna_act.remarks', 
												'tna_lib.id as action_id',
												'tna_lib.tna_lib_action'
											])
										->where('mr_order_entry_order_id', '=', $lib1->order_tna_id )
										->get();
			$lib1->order_tna_actions_list = $order_tna_actions; 
		}
		// dd($data_library1);
		//getting the tna template logic and offset days of each tna template of $data_library1



		foreach($data_library1 as $lib_1){

				$logic_offset = DB::table('mr_tna_template_to_library')
									->select([
										'tna_temp_logic',
										'offset_day',
										'mr_tna_library_id as action_id'
									])
		    						->where('mr_tna_template_id', '=', $lib_1->mr_tna_template_id)
		    						->get();
				$lib_1->tna_temp_to_library = $logic_offset;

				$buyer_name = DB::table('mr_buyer')->where('b_id', '=', $lib_1->mr_buyer_b_id)
												   ->value('b_name');
				$lib_1->buyer = $buyer_name;				
		}
		//generating Calender/Gerenated date for each tna template of $data_library1						
	    foreach ($data_library1 as $lib1) {
	    		$delv_date  = $lib1->order_delivery_date;              
		        $date 		= date_create($delv_date);
		        $GDD 		= date_format($date,"Y-m-d");

		        $lead_tole  = $lib1->lead_days+$lib1->tolerance_days ; 
		        $yy 		= date('Y-m-d', strtotime('-'.$lead_tole.' day', strtotime($GDD)));
	    		
	    		$size_of_tna_actions = sizeof($lib1->tna_temp_to_library);
	    		// dd($size_of_tna_actions);
	    		for($i=$size_of_tna_actions-1; $i>=0; $i--){
	    	
	    			if($lib1->tna_temp_to_library[$i]->tna_temp_logic == "OK to Begin"){
	    							$yy 	 = date('Y-m-d', strtotime('-'.$lead_tole.' day', strtotime($GDD)));     
                                    $offset  = $lib1->tna_temp_to_library[$i]->offset_day;
                                    $sg_date = date('Y-m-d', strtotime('-'.$offset.' day', strtotime($yy)));
                                  }

                    if($lib1->tna_temp_to_library[$i]->tna_temp_logic == "DCD or FOB"){         
                                    $offset  = $lib1->tna_temp_to_library[$i]->offset_day;
                                    $sg_date = date('Y-m-d', strtotime('-'.$offset.' day', strtotime($GDD)));
                                  }

                    #--adding the generated date into the 'tna_temp_to_library'
                    $lib1->tna_temp_to_library[$i]->calender_date = $sg_date;
                    $GDD = $sg_date;
	    		}
	    }
	    

		// dd($data_library1->all());

	    // getting the search result
	    $result[][]="";
	    

	    #if all field are entered
		if(!is_null($odr_id) && !is_null($tna_act_id) && !is_null($from_date) && !is_null($to_date) ){
			foreach ($data_library1 as $lib1) {
	    		$delivery_date = new DateTime($lib1->order_delivery_date);
	    		$from_date_    = new DateTime($from_date);
	    		$to_date_    = new DateTime($to_date);
		    	// dd('From Controller Order Dlvry date:',$delivery_date , 'From Input:', $from_date, $to_date);
		    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
					if($odr_id == $lib1->order_id){

						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty; 
						$result['order_qty'][]  	  = $lib1->order_qty; 
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
							if($tna_list->action_id == $tna_act_id){
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
							}
						}
						//for calender/generated date..
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
							if($tna_ttl->action_id == $tna_act_id){
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
							}
						}
					}
				}
			}
		}
		#if order and action are selected
		else if(!is_null($odr_id) && !is_null($tna_act_id) && is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					if($odr_id == $lib1->order_id){
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
							if($tna_list->action_id == $tna_act_id){
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
							}
						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
							if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
							}
						}
					}
				}
		}
		#if order, action and from_date are selected
		else if(!is_null($odr_id) && !is_null($tna_act_id) && !is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					$delivery_date = new DateTime($lib1->order_delivery_date);
	    			$from_date_    = new DateTime($from_date);
					
					if($delivery_date >= $from_date_ ){
						if($odr_id == $lib1->order_id){
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
								if($tna_list->action_id == $tna_act_id){
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
								}
						    }
						    foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
								}
							}
					    }
					}
					
				}
		}
		#if order, action and to_date are selected
		else if(!is_null($odr_id) && !is_null($tna_act_id) && is_null($from_date) && !is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					$delivery_date = new DateTime($lib1->order_delivery_date);
		    		//taking present day..
		    		$today      = new DateTime('today'); 
		    		$from_date_ = $today->format('Y-m-d');
		    		// dd($from_date_);
		    		$to_date_   = new DateTime($to_date);
					
					if($delivery_date >= $from_date_ && $delivery_date <= $to_date_ ){
						if($odr_id == $lib1->order_id){
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
								if($tna_list->action_id == $tna_act_id){
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								    if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
								}
						    }
						    foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
								}
							}
					    }
					}
					
				}
		}
		#if only odrder is selected
		else if(!is_null($odr_id) && is_null($tna_act_id) && is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					if($odr_id == $lib1->order_id){
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
						}
					}
				}
		}
		#if odrder and from_date are selected
		else if(!is_null($odr_id) && is_null($tna_act_id) && !is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					$delivery_date = new DateTime($lib1->order_delivery_date);
	    			$from_date_    = new DateTime($from_date);
	    			if($delivery_date >= $from_date_ ){
	    				if($odr_id == $lib1->order_id){
							$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
							}
						}
	    			}
						
				}
		}
		#if odrder and to_date are selected
		else if(!is_null($odr_id) && is_null($tna_act_id) && is_null($from_date) && !is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					$delivery_date = new DateTime($lib1->order_delivery_date);
		    		$today      = new DateTime('today'); 
		    		$from_date_ = $today->format('Y-m-d');
		    		// dd($from_date_);
		    		$to_date_   = new DateTime($to_date);

			    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
	    				if($odr_id == $lib1->order_id){
							$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
							}
						}
	    			}
						
				}
		}
		#if odrder, from_date and to_date are selected
		else if(!is_null($odr_id) && is_null($tna_act_id) && !is_null($from_date) && !is_null($to_date)){
				foreach ($data_library1 as $lib1) {
					$delivery_date = new DateTime($lib1->order_delivery_date);
		    		$from_date_    = new DateTime($from_date);
		    		$to_date_    = new DateTime($to_date);
			    	// dd('From Controller Order Dlvry date:',$delivery_date , 'From Input:', $from_date, $to_date);
			    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
			    		if($odr_id == $lib1->order_id){
							$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								    if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
							}
						}
			    	}
						
				}
		}
		#if only action is selected
		else if(is_null($odr_id) && !is_null($tna_act_id) && is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
							if($tna_list->action_id == $tna_act_id){
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
							}
						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
							if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
							}
						}
				}
		}
		#if action and from_date are selected
		else if(is_null($odr_id) && !is_null($tna_act_id) && !is_null($from_date) && is_null($to_date)){
				foreach ($data_library1 as $lib1) {
						$delivery_date = new DateTime($lib1->order_delivery_date);
		    			$from_date_    = new DateTime($from_date);
		    			if($delivery_date >= $from_date_ ){
		    				$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
								if($tna_list->action_id == $tna_act_id){
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
								}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
								}
								
							}
		    			}
							
				}
		}
		#if action and to_date are selected
		else if(is_null($odr_id) && !is_null($tna_act_id) && is_null($from_date) && !is_null($to_date)){
				foreach ($data_library1 as $lib1) {
						$delivery_date = new DateTime($lib1->order_delivery_date);
			    		$today         = new DateTime('today'); 
			    		$from_date_    = $today->format('Y-m-d');
			    		// dd($from_date_);
			    		$to_date_      = new DateTime($to_date);

				    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
		    				$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
								if($tna_list->action_id == $tna_act_id){
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
								}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								if($tna_ttl->action_id == $tna_act_id){
									$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
								}
								
							}
		    			}
							
				}
		}
		#if action, from_date and to_date are selected
		else if(is_null($odr_id) && !is_null($tna_act_id) && !is_null($from_date) && !is_null($to_date)){
				foreach ($data_library1 as $lib1) {
						$delivery_date = new DateTime($lib1->order_delivery_date);
			    		$from_date_    = new DateTime($from_date);
			    		$to_date_    = new DateTime($to_date);
				    	// dd('From Controller Order Dlvry date:',$delivery_date , 'From Input:', $from_date, $to_date);
				    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
				    		$result['buyer'][] 			  = $lib1->buyer;	
							$result['order'][] 			  = $lib1->order_code;
							$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
							// $result['actions'][] = "";
							foreach ($lib1->order_tna_actions_list as $tna_list) {
								if($tna_list->action_id == $tna_act_id){
									$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
									if(is_null($tna_list->actual_date) ){
										$result['actual_date'][$lib1->order_code][] 		= "";	
									}
									else{
										$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
									}
								}
							}
							foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								if($tna_ttl->action_id == $tna_act_id){
								  	$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;	
								}
								
							}
				    	}

				}
		}
		#if only dates are selected
		else if(is_null($odr_id) && is_null($tna_act_id) && !is_null($from_date) && !is_null($to_date) ){
			// dd('ok');
			
			foreach ($data_library1 as $lib1) {

	    		$delivery_date = new DateTime($lib1->order_delivery_date);
	    		$from_date_    = new DateTime($from_date);
	    		$to_date_      = new DateTime($to_date);


		    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
					// dd('ok--');
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
						}
				}
			}
		}
		#if only from_date selected
		else if(is_null($odr_id) && is_null($tna_act_id) && !is_null($from_date) && is_null($to_date) ){
			// dd('ok');
			
			foreach ($data_library1 as $lib1) {

	    		$delivery_date = new DateTime($lib1->order_delivery_date);
	    		$from_date_    = new DateTime($from_date);
	    		$to_date_      = new DateTime($to_date);

		    	if($delivery_date >= $from_date_){
					// dd('ok--');
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}

						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
						}
				}
			}
		}
		#if only to_date selected
		else if(is_null($odr_id) && is_null($tna_act_id) && is_null($from_date) && !is_null($to_date) ){
			// dd('ok');	
			foreach ($data_library1 as $lib1) {

	    		$delivery_date = new DateTime($lib1->order_delivery_date);
	    		$today      = new DateTime('today'); 
	    		$from_date_ = $today->format('Y-m-d');
	    		// dd($from_date_);
	    		$to_date_   = new DateTime($to_date);

		    	if($delivery_date >= $from_date_ && $delivery_date <= $to_date_){
					// dd('ok--');
						$result['buyer'][] 			  = $lib1->buyer;	
						$result['order'][] 			  = $lib1->order_code;
						$result['order_reference'][]  = $lib1->order_ref_no; 
						$result['order_qty'][]  	  = $lib1->order_qty;
						// $result['actions'][] = "";
						foreach ($lib1->order_tna_actions_list as $tna_list) {
								$result['action'][$lib1->order_code][] 	= $tna_list->tna_lib_action;
								if(is_null($tna_list->actual_date) ){
									$result['actual_date'][$lib1->order_code][] 		= "";	
								}
								else{
									$result['actual_date'][$lib1->order_code][] 		= $tna_list->actual_date;
								}
						}
						foreach ($lib1->tna_temp_to_library as $tna_ttl) {
								$result['calender_date'][$lib1->order_code][] 		= $tna_ttl->calender_date;
						}
				}
			}
		}

		// dd($result);
		return Response::json($result);

	}


}
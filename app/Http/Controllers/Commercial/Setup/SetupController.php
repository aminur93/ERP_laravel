<?php
namespace App\Http\Controllers\Commercial\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\PiType;
use App\Models\Commercial\CommBank;
use App\Models\Commercial\BankAccNo;
use App\Models\Commercial\MachineType;
use App\Models\Commercial\MachineManufacturer;
use App\Models\Commercial\LcType;
use App\Models\Commercial\Item;
use App\Models\Commercial\Country;
use App\Models\Commercial\Port;
use App\Models\Commercial\PortDetail;
use App\Models\Commercial\LcPeriod;
use App\Models\Commercial\Vessel;
use App\Models\Commercial\VesselVoyage;
use App\Models\Commercial\Agent;
use App\Models\Commercial\CashIncentive;
use App\Models\Commercial\PaymentType;
use App\Models\Commercial\CategoryNo;
use App\Models\Commercial\Section;
use App\Models\Commercial\Hub;
use App\Models\Commercial\Passbook;
use App\Models\Commercial\Insurance;
use App\Models\Commercial\Period;
use App\Models\Commercial\FromDate;
use App\Models\Commercial\Incoterm;


use Validator, DB, ACL;


class SetupController extends Controller
{
	public function showForm(){
		//need to send table data
		//Getting PI type data
		 $pitype=PiType::get();

	    //Getting Bank Data
	    $bank= CommBank::get(); 
        foreach($bank AS $bnk){
        $mbank= DB::table('cm_bank_acc_no')
                ->where('cm_bank_id', $bnk->id)
                ->get();
        $bnk->accno= $mbank;
      }
      // dd($bank);

      //Getting Machine data
       $machine= MachineType::get();
        foreach($machine AS $mcn){
        $mfactr= DB::table('cm_machine_manufacturer')
                ->where('machine_id', $mcn->id)
                ->get();
        $mcn->manufacturer= $mfactr;
      }
     //dd($machine); 
     //Getting lc type & period
      $lctype=LcType::get();
      $lcperiod=LcPeriod::get();
      //Getting item 
      $item=Item::get();
      //Getting all countries
      $country=Country::get();
      // dd($country->all());
      //Getting Port data
       $ports= Port::get();
        foreach($ports AS $port){
       		$tmp_cntry = DB::table('mr_country')
       			->where('cnt_id','=',$port->cnt_id)
       			->value('cnt_name');
       			//dd($tmp_cntry);
       	    $port->country_name = $tmp_cntry;

        }
        // dd($ports->all());        
  	    //Getting Vessel data
  	    $vessel = Vessel::get();
        foreach($vessel AS $vsl){
           $tmp_vsl= DB::table('cm_voyage_vessel')
                ->where('cm_vessel_id', $vsl->id)
                ->get();
           $vsl->voyages = $tmp_vsl;
      	}     
      //Getting Agent data
      	$agent = Agent::get();
      	//
      	$cash_incen = CashIncentive::get();
        foreach ($cash_incen as $incen) {
            $tmp_cntry = DB::table('mr_country')->where('cnt_id', '=', $incen->cnt_id)->value('cnt_name');
            $incen->country_name = $tmp_cntry;
        }
        // dd($cash_incen->all() );
      	//Payment Type
      	$pay_type = PaymentType::get();
      	//Category all
      	$category_no = CategoryNo::get();
      	//Section All
      	$section = Section::get();
      	//Hub all
      	$hub = Hub::get();
        //Passbook all
        $passbook = Passbook::get();
        //Insurance all
        $insurance = Insurance::get();

        $period = Period::get();

        $from_date_data = FromDate::get();

        $inco_term_data = Incoterm::get();

		return view('commercial.setup.setup', 
			compact('pitype','bank', 'machine', 'lctype','lcperiod' ,'item','country', 'ports', 'vessel', 'agent','cash_incen', 'pay_type', 'category_no', 'section', 'hub', 'passbook', 'insurance','period','from_date_data','inco_term_data') );
	}
	///Showing Form End-----------------------------------------------------------------------//

	//PI type
    public function  piStore(Request $request){
    		#---Store
    	 $validator= Validator::make($request->all(),[
             'pi_name'   =>  'required|max:59'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new PiType();
            $data->pi_type_name = $request->pi_name;
            $data->save();

            return back()
            ->with('success', "PiType Saved Successfully!!");
        }
    }
    public function  piEdit($id){
    	#---edit
     		$pitype=PiType::where('id', $id)->first();
     	return view('commercial.setup.pi_edit_1', compact('pitype'));
    }
    public function  piUpdate(Request $request){
    	#---update
    	$validator= Validator::make($request->all(),[
             'pi_name'   =>  'required|max:59'
          ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
         else{
         	$pitype = PiType::where('id', $request->pi_id)
            								->update(['pi_type_name' => $request->pi_name]);
         
         return redirect('commercial/setup/setup')
          			   ->with('success', "PiType Updated successfully!!");
         }

    }
    public function  piDelete($id){
    	#---delete
    	 PiType::where('id', $id)->delete();

        return back()
        ->with('success', "PiType  Deleted Successfully!!");
    }

	//PI Type end---------------------------------------------------------------------------//

	//Bank------//
    public function bankStore(Request $request){
    	#---------------------------------------------------#
          
          $validator= Validator::make($request->all(),[
             'bank_name'       =>'required|max:43',
             'bank_short_code' =>'required|max:59',
             'bank_swift_code' =>'required|max:59',
             'acc_no'          =>'required|max:43',
             'bank_address1'   =>'required|max:255',
             'bank_address2'   =>'required|max:255'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{


            $data= new CommBank();
            $data->bank_name       = $request->bank_name;
            $data->short_code      = $request->bank_short_code;
            $data->swift_code 	   = $request->bank_swift_code; 
            $data->address_1       = $request->bank_address1;
            $data->address_2       = $request->bank_address2;

            $data->save();
            $last_id = $data->id;
          
             for($i=0; $i<sizeof($request->acc_no); $i++)
            { 
                    BankAccNo::insert([
                        'cm_bank_id'   => $last_id,
                        'account_no'    => $request->acc_no[$i]
                    ]);
            }

            return back()
            ->with('success', "Bank Saved Successfully!!");
         }
    }

    public function bankEdit($id){

  			#--------------------------------------------# 

     $bank=CommBank::where('id', $id)->first();
     $bankacc=BankAccNo::where('cm_bank_id', $id)->get();
     $bankacc2=BankAccNo::where('cm_bank_id', $id)->first();
     
      return view('commercial.setup.bank_edit_1', compact('bank','bankacc','bankacc2'));
    }

    public function bankUpdate(Request $request){
       		#------------------------------------------#
    	   $validator= Validator::make($request->all(),[
             'bank_name'       =>'required|max:43',
             'bank_short_code' =>'required|max:59',
             'bank_swift_code' =>'required|max:59',
             'acc_no'          =>'required|max:59',
             'bank_address1'   =>'required|max:255',
             'bank_address2'   =>'required|max:255'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
         else{

         	  $bank= CommBank::where('id', $request->bnk_id)->update([ 
               'bank_name'	=> $request->bank_name,
               'short_code' => $request->bank_short_code,
               'swift_code' => $request->bank_swift_code, 
               'address_1'  => $request->bank_address1,
               'address_2'  => $request->bank_address2
        ]);

        //deleting previous acc no 	  	
        $bankacc=BankAccNo::where('cm_bank_id', $request->bnk_id)->delete();

        for($i=0; $i<sizeof($request->acc_no); $i++)
            {
                    BankAccNo::insert([
                        'cm_bank_id' => $request->bnk_id,
                        'account_no'  => $request->acc_no[$i]
                    ]);
            }


        return redirect('commercial/setup/setup')
          ->with('success', "Bank Updated successfully!!");

         }

    }


    public function bankDelete($id){
    	 #-----------------------------------------------# 

        CommBank::where('id', $id)->delete();
    
        BankAccNo::where('cm_bank_id', $id)->delete();

        return back()
        ->with('success', "Bank  Deleted Successfully!!");
    }

	//Bank End---------------------------------------------------------------------------------------//


	//Machine Start

	 //Store
     public function machineStore(Request $request){
     	#---------------------------------------------------#
          //dd($request->all());
          $validator= Validator::make($request->all(),[
             'Machine_name'      =>'required|max:127',
             'Manufacturer_name' =>'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new MachineType();
            $data->type_name= $request->Machine_name;
            $data->save();
            $last_id = $data->id;
             for($i=0; $i<sizeof($request->Manufacturer_name); $i++)
            {
                    MachineManufacturer::insert([
                        'machine_id' => $last_id,
                        'manufacturer_name'       => $request->Manufacturer_name[$i]
                    ]);
            }

            return back()
            ->with('success', "Machine Type Saved Successfully!!");
         }

    }
     //Edit
     public function machineEdit($id){
     	#--------------------------------------------# 

     		$machine=MachineType::where('id', $id)->first();
     		$manunfcr=MachineManufacturer::where('machine_id', $id)->get();
     		$manunfcr2=MachineManufacturer::where('machine_id', $id)->first();
     
      return view('commercial.setup.machine_edit_1', compact('machine','manunfcr','manunfcr2'));

    }
     //Update
     public function machineUpdate(Request $request){
     	#---------------------------------------------------#
          //dd($request->all());
          $validator= Validator::make($request->all(),[
             'Machine_name'      =>'required|max:127',
             'Manufacturer_name' =>'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{


            $machinetype= MachineType::where('id', $request->machine_id)
            								->update(['type_name' => $request->Machine_name]);

            $manufacturer=MachineManufacturer::where('machine_id', $request->machine_id)->delete();

           
           for($i=0; $i<sizeof($request->Manufacturer_name); $i++)
            {
                    MachineManufacturer::insert([
                        'machine_id' 		  => $request->machine_id,
                        'manufacturer_name'   => $request->Manufacturer_name[$i]
                    ]);
            }


        return redirect('commercial/setup/setup')
          ->with('success', "Machine Type Updated successfully!!");
         }

    }


     //Delete
     public function machineDelete($id){
        #-----------------------------------------------# 

        MachineType::where('id', $id)->delete();
        MachineManufacturer::where('machine_id', $id)->delete();

        return back()
        ->with('success', "Machine  Deleted Successfully!!");
    }


	//Machine End--------------------------------------------------------------------------------------------//

	//--L/C Type start
    public function  lcStore(Request $request){
    		#---Store
    	 $validator= Validator::make($request->all(),[
             'lc_type'   =>  'required|max:59'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new LcType();
            $data->lc_type_name = $request->lc_type;
            $data->save();

            return back()
            ->with('success', "L/C Type Saved Successfully!!");
        }
    }
    public function  lcEdit($id){
    	#---edit
     		$lctype=LcType::where('id', $id)->first();
     	return view('commercial.setup.lc_edit_1', compact('lctype'));
    }
    public function  lcUpdate(Request $request){
    	#---update
    	$validator= Validator::make($request->all(),[
             'lc_type'   =>  'required|max:59'
          ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
         else{
         	$lctype= LcType::where('id', $request->lctype_id)
            								->update(['lc_type_name' => $request->lc_type]);
         
         return redirect('commercial/setup/setup')
          			   ->with('success', "L/C Type Updated successfully!!");
         }

    }
    public function  lcDelete($id){
    	#---delete
    	 LcType::where('id', $id)->delete();

        return back()
        ->with('success', "L/C Type  Deleted Successfully!!");
    }

    //--L/C Type end------------------------------------------------------------------------------------------//

   //----L/C Period Start
    public function lcPeriodStore(Request $request){

    	// if(LcType::find($request->lc_type)){
    	// 	return back()->with('error', 'L/C Period already been assigned');
    	// }

    	#store--    	
        $validator= Validator::make($request->all(),[
             'lc_period'      => 'required|max:11'
             // 'lc_type'		  => 'required|max:59'	
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data = new LcPeriod();
        	// $data->lc_type_name = $request->lc_type;
        	$data->lc_period_days = $request->lc_period;
        	$data->save();
 			
 			return back()
            ->with('success', "L/C Period Saved Successfully!!");
        }

    }
    public function lcPeriodEdit($id){
    	#---edit
        $lcperiod=LcPeriod::where('id', $id)->first();
     	return view('commercial.setup.lc_period_edit_1', compact('lcperiod'));
    }
    public function lcPeriodUpdate(Request $request){
    	#----update
    	$validator= Validator::make($request->all(),[
             'lc_period_update'   =>  'required|max:11'
          ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
         else{
         	$lcperiod = LcPeriod::where('id', $request->lc_period_id)
            								->update(['lc_period_days' => $request->lc_period_update]);
         
         return redirect('commercial/setup/setup')
          			   ->with('success', "L/C Period Updated successfully!!");
         }	
    	
    }
    public function lcPeriodDelete($id){
    	#---delete
    	LcPeriod::where('id', $id )->delete();
    	return back()
        ->with('success', "L/C Period  Deleted Successfully!!");
    	
    }
   //----L/C Period End--------------------------------------------------------------------------------------//

    //--Item start
    public function  itemStore(Request $request){
    		#---Store
    	 $validator= Validator::make($request->all(),[
             'item_name'   =>  'required|max:59'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new Item();
            $data->cm_item_name= $request->item_name;
            $data->save();

            return back()
            ->with('success', "Item Saved Successfully!!");
        }
    }
    public function  itemEdit($id){
    	#---edit
     		$item=Item::where('id', $id)->first();
     	return view('commercial.setup.item_edit_1', compact('item'));
    }
    public function  itemUpdate(Request $request){
    	#---update
    	$validator= Validator::make($request->all(),[
             'item_name'   =>  'required|max:59'
          ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
         else{
         	$item= Item::where('id', $request->item_id)
            								->update(['cm_item_name' => $request->item_name]);
         
         return redirect('commercial/setup/setup')
          			   ->with('success', "Item Updated successfully!!");
         }

    }
    public function  itemDelete($id){
    	#---delete
    	 Item::where('id', $id)->delete();

        return back()
        ->with('success', "Item  Deleted Successfully!!");
    }

    //--Item end------------------------------------------------------------------------------------------//

    //--Port Strat------------------------------------------------------------------------------------------//
    
    public function portStore(Request $request){
    	#---Store
    	// dd($request->all());
    	$validator= Validator::make($request->all(),[
             'port_name'   =>  'required|max:45',
             'port_address' => 'required|max:45'
          ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

               // dd($request->all()); 

        	//dd($country_id->cnt_id, sizeof($request->port_name), $request->all() );

            // only cm_port table
                for($i=0; $i<sizeof($request->port_name); $i++){
                        Port::insert([
                            'port_name'   => $request->port_name[$i],
                            'address'     => $request->port_address[$i],
                            'cnt_id'      => $request->country_id
                        ]); 
                 }
            // only cm_port table

        	// $data_for_port = new Port();
        	// $data_for_port->cnt_id = $c_id;
        	// $data_for_port->save();

        	// $recent_port_id = $data_for_port->id; 
        	// //dd($recent_port_id);


        	// for($i=0; $i<sizeof($request->port_name); $i++){
        	// 			PortDetail::insert([
        	// 				'port_id' 	=> $recent_port_id,
        	// 				'port_name' => $request->port_name[$i],
        	// 				'port_address' => $request->port_address[$i]
        	// 			]);	
        	// }
        	// $data_for_port_detail->port_id = $recent_port_id;
        	// $data_for_port_detail->port_name = $request->port_name;
        	// $data_for_port_detail->port_address = $request->port_address;

        	return back()
        	->with('success', "Port Saved Successfully!!");
        }	

    }
    public function portEdit($id){
    	#--edit--
        $country = Country::get();
    	$port = Port::where('id', $id)->first();
    	// dd($port);
     	$country_name = DB::table('mr_country')->where('cnt_id','=',$port->cnt_id)->value('cnt_name');
     	
        // dd('Port to edit:', $port, 'Country:',$country_name, 'Country List:', $country);

      return view('commercial/setup/port_edit_1', compact('port', 'country_name', 'country') );

    	
    }
    public function portUpdate(Request $request){
    	#---Update---
    	//dd($request->all()); 

    	$validator= Validator::make($request->all(),[
             'port_name'   =>  'required|max:45',
             'port_address' => 'required|max:45'
          ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
            // dd($request->all() );

			//Updating port
            Port::where('id', $request->port_id )->update([
        					'port_name' => $request->port_name ,
        					'address'   => $request->port_address ,
        					'cnt_id'    => $request->country_id
        				]);	

       		return redirect('commercial/setup/setup')
          			   ->with('success', "Port Updated successfully!!");
         	}
    }

    public function portDelete($id){
    	#--delete--
    	Port::where('id', $id)->delete();
    	return back()->
    				with('success', 'Port deleted successfully');
    	
    }



    //--Port End------------------------------------------------------------------------------------------//



    //Vessell start

    public function vesselStore(Request $request){

        #----Store--

        //dd($request->all());
          $validator= Validator::make($request->all(),[
             'vessel_name'      =>	'required|max:60',
             'voyage_no' 		=>	'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new Vessel();
            $data->vessel_name= $request->vessel_name;
            $data->save();
            $last_id = $data->id;
            for($i=0; $i<sizeof($request->voyage_no); $i++)
            {
                    VesselVoyage::insert([
                        'cm_vessel_id' 		=> 	$last_id,
                        'voyage_name'       => 	$request->voyage_no[$i]
                    ]);
            }

            return back()
            ->with('success', "Vessel Saved Successfully!!");
         }
    }

    public function vesselEdit($id){
    	#--------------------------------------------# 
     		$vessel=Vessel::where('id', $id)->first();
     		$voyage=VesselVoyage::where('cm_vessel_id', $id)->get();
     		$voyage2=VesselVoyage::where('cm_vessel_id', $id)->first();
     
      return view('commercial.setup.vessel_edit_1', compact('vessel','voyage','voyage2'));
    	
    }

    public function vesselUpdate(Request $request){
    	#---Update Vessel
    	 $validator= Validator::make($request->all(),[
             'vessel_name'      =>	'required|max:60',
             'voyage_no' 		=>	'required|max:45'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$update_vessel	= Vessel::where('id', $request->vsl_id)
            								->update(['vessel_name' => $request->vessel_name]);

            $delete_voyage = VesselVoyage::where('cm_vessel_id', $request->vsl_id)->delete();

           
           for($i=0; $i<sizeof($request->voyage_no); $i++){

                    VesselVoyage::insert([
                        'cm_vessel_id'  => $request->vsl_id,
                        'voyage_name'   => $request->voyage_no[$i]
                    ]);
            }

            return redirect('commercial/setup/setup')
          			   ->with('success', "Vessel Updated successfully!!");
         	}

       }

    	

    public function vesselDelete($id){
    	#delete---
    	$delete_vessel=Vessel::where('id',$id)->delete();
    	$delete_vessel=VesselVoyage::where('cm_vessel_id',$id)->delete();
    	
    	return back()
            ->with('success', "Vessel Deleted Successfully!!");
    	
    }


    #-----------------------vessel end---------------------------------------------------------//

    public function agentStore(Request $request){
    		#--store---
    	//dd($request->agent_type);
    	$validator= Validator::make($request->all(),[
             'agent_name'      	=>	'required|max:45',
             'agent_type' 		=>	'required|max:30',
             'contact_person'	=>	'required|max:45',
             'agent_address'	=>	'required|max:145'
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	 $agent = new Agent();
        	 // if($request->agent_type == 'C&F/Export'){
        	 // 	$agent->agent_type  =  'Not Specified';
        	 // }
        	 // else{
        	 // 	$agent->agent_type  =  $request->agent_type;	
        	 // }

			 $agent->agent_type  		=  $request->agent_type;
        	 $agent->agent_name			=  $request->agent_name;
        	 $agent->contact_person		=  $request->contact_person;
        	 $agent->address 			=  $request->agent_address;

        	 $agent->save();

        	 return back()->with('success', 'Agent saved successfully');

        }

    }
    public function agentEdit($id){
    	#--Edit
    	$agent = Agent::where('id', $id)->first();
    	//dd($agent);
    	return view('commercial.setup.agent_edit_1', compact('agent'));
    	
    }
    public function agentUpdate(Request $request){
    	#----Update
    	$validator= Validator::make($request->all(),[
             'agent_name'      	=>	'required|max:45',
             'agent_type' 		=>	'required|max:30',
             'contact_person'	=>	'required|max:45',
             'agent_address'	=>	'required|max:145'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	// if($request->agent_type == 'C&F/Export'){
        	//  	Agent::where('id', $request->agent_id)->update([
        	//  				'agent_type'  =>  'Not Specified'
        	//  	]);
        	//  }
        	//  else{
        	//  	Agent::where('id', $request->agent_id)->update([
        	//  				'agent_type'  =>  $request->agent_type
        	//  	]);	
        	//  }
	
        	$update_agent = Agent::where('id', $request->agent_id)->update([

        					 'agent_type'  			=>  $request->agent_type,
        		        	 'agent_name'			=>  $request->agent_name,
        	 				 'contact_person'		=>  $request->contact_person,
        	 				 'address' 				=>  $request->agent_address

        					]);

        	return redirect('commercial/setup/setup')
          			   ->with('success', "Agent Updated successfully!!");
        }
    	
    }
    public function agentDelete($id){
    	#---Delete
    	$delete_agent = Agent::where('id', $id)->delete();
    	return back()
    	->with('success' , 'Agent Deleted');
    	
    }


#---------------------------Agent End-----------------------------------------------------#

#--incentive
	public function incentiveStore(Request $request){
        // dd('Incentive Store', $request->all());
		#--store
		   $validator= Validator::make($request->all(),[
             'country'      	=>	'required',
             'incentive' 		=>	'required|max:20',
             'type'				=>	'required|max:45'
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
        	// #--finding the country id
        	// $country_id = Country::select('cnt_id')->where('cnt_name',$request->country)->first();
        	// $c_id = $country_id->cnt_id;

        	$cash = new CashIncentive();
        	// $cash->country  		=	$request->country;
        	$cash->cnt_id 			=	$request->country;
        	$cash->incentive 		=	$request->incentive;
        	$cash->type 			=	$request->type;
        	$cash->save();

        	return back()->with('success', 'Cash Incentive Status saved');
         }

	}

	public function incentiveEdit($id){
		#--edit
		$cash = CashIncentive::where('id', $id)->get();
        // dd($cash->cnt_id);
        foreach ($cash as $incen) {
            $tmp_cntry = DB::table('mr_country')->where('cnt_id', '=', $incen->cnt_id )->value('cnt_name');

            $incen->country_name = $tmp_cntry;
        }
         $country=Country::get();
        // dd($cash);
		
        return view('commercial.setup.incentive_edit_1', compact('cash', 'country'));
	}

	public function incentiveUpdate(Request $request){
		#--update
        // dd($request->all());
	    $validator= Validator::make($request->all(),[
             'country'      	=>	'required|max:30',
             'incentive' 		=>	'required|max:20',
             'type'				=>	'required|max:45'
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
        	// $country_id = Country::select('cnt_id')->where('cnt_name',$request->country)->first();
        	// $c_id = $country_id->cnt_id;

        	$cash_incen_update = CashIncentive::where('id', $request->cash_id)->update([
        				// 'country' 	=> $request->country,
        				'cnt_id'	=> $request->country,
        				'incentive' => $request->incentive,
        				'type' 		=> $request->type
        	]);

        	return redirect('commercial/setup/setup')
          			   ->with('success', "Cash Incentive Updated successfully!!");

         }
		
	}

	public function incentiveDelete($id){
		#delete
		$cash_inc_delete = CashIncentive::Where('id', $id)->delete();
		return back()->with('success', 'Cash Incentive deleted');
		
	}  
#---------------------------Incentive End-----------------------------------------------------#

#--Payment Type
	public function paymenttypeStore(Request $request){
	     #---Store
		//dd($request->all());
    	 $validator= Validator::make($request->all(),[
             'payment_type'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new PaymentType();
            $data->type_name = $request->payment_type;
            $data->save();

            return back()
            ->with('success', "Payment Type Saved Successfully!!");
        }		
	}
	public function paymenttypeEdit($id){
		$pay_type = PaymentType::where('id',$id)->first();
		return view('commercial.setup.paymenttype_edit_1', compact('pay_type'));	
	}
	public function paymenttypeUpdate(Request $request){
		$validator= Validator::make($request->all(),[
             'payment_type'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
        	$pay_type_update = PaymentType::where('id', $request->pay_type_id)->update([
        			'type_name' => $request->payment_type
        	]);
        	return redirect('commercial/setup/setup')
          			   ->with('success', "Payment Type Updated successfully!!");
        }
		
	}
	public function paymenttypeDelete($id){
		$delete_pay = PaymentType::where('id', $id)->delete();
		return back()->with('success', 'Payment Type deleted');
	}
#----------------------------Payment Type End-----------------------------------------------------#

#--Categroy No
	public function categoryNoStore(Request $request){
		$validator= Validator::make($request->all(),[
             'category_name'   =>  'required|max:45',
             'category_code'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{

        	$data = new CategoryNo();
        	$data->cat_no_name = $request->category_name;
        	$data->cat_no_code = $request->category_code;
        	$data->save();

        	return back()->with('success', 'Category saved');
        }
	}
	public function categoryNoEdit($id){
		$cat = CategoryNo::where('id', $id)->first();
		return view('commercial.setup.category_no_edit_1', compact('cat'));
	}
	public function categoryNoUpdate(Request $request){
		 $validator= Validator::make($request->all(),[
             'category_name'   =>  'required|max:45',
             'category_code'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{

        	$update_cat = CategoryNo::where('id', $request->category_id)->update([
        			'cat_no_name' => $request->category_name,
        			'cat_no_code' => $request->category_code
        	]);
        	return redirect('commercial/setup/setup')
          			   ->with('success', "Category Updated successfully!!");
        }
		
	}
	public function categoryNoDelete($id){
		$delete_cat = CategoryNo::where('id', $id)->delete();
		return back()->with('success', 'Category Deleted');
	}
#----------------------Categroy No end------------------------------------------------------#

#--Section
	public function sectionStore(Request $request){
	     #---Store
		//dd($request->all());
    	 $validator= Validator::make($request->all(),[
             'section'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new Section();
            $data->section_name = $request->section;
            $data->save();

            return back()
            ->with('success', "Section Saved Successfully!!");
        }		
	}
	public function sectionEdit($id){
		$section = Section::where('id',$id)->first();
		return view('commercial.setup.section_edit_1', compact('section'));	
	}
	public function sectionUpdate(Request $request){
		$validator = Validator::make($request->all(),[
             'section'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
        	$update_sec = Section::where('id', $request->section_id)->update([
        			'section_name' => $request->section
        	]);
        	return redirect('commercial/setup/setup')
          			   ->with('success', "Section Updated successfully!!");
        }
		
	}
	public function sectionDelete($id){
		$delete_sec = Section::where('id', $id)->delete();
		return back()->with('success', 'Section deleted');
	}

#----------------------Section End------------------------------------------------------#

#--Hub
	public function hubStore(Request $request){
	     #---Store
		//dd($request->all());
    	 $validator= Validator::make($request->all(),[
             'hub'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

        	$data= new Hub();
            $data->hub_name = $request->hub;
            $data->save();

            return back()
            ->with('success', "Hub Saved Successfully!!");
        }		
	}
	public function hubEdit($id){
		$hub = Hub::where('id',$id)->first();
		return view('commercial.setup.hub_edit_1', compact('hub'));	
	}
	public function hubUpdate(Request $request){
		$validator = Validator::make($request->all(),[
             'hub'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
        	$update_hub = Hub::where('id', $request->hub_id)->update([
        			'hub_name' => $request->hub
        	]);
        	return redirect('commercial/setup/setup')
          			   ->with('success', "Hub Updated successfully!!");
        }
		
	}
	public function hubDelete($id){
		$delete_hub = Hub::where('id', $id)->delete();
		return back()->with('success', 'Hub deleted');
	}
#----------------------Hub End------------------------------------------------------#

	#-----Passbook
	public function passbookStore(Request $request){
     #---Store
        //dd($request->all());
         $validator= Validator::make($request->all(),[
             'volume_no'   =>  'required|max:45',
             'page_no'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
            $data = new Passbook();
            $data->volume_no = $request->volume_no;
            $data->page_no = $request->page_no;
            $data->save();

            return back()->with('success', 'Passbook Saved');
        }

	}
	public function passbookEdit($id){
        $passbook = Passbook::where('id', $id)->first();
        return view('commercial.setup.passbook_edit_1', compact('passbook') );
	}
	public function passbookUpdate(Request $request){

          $validator= Validator::make($request->all(),[
             'volume_no'   =>  'required|max:45',
             'page_no'   =>  'required|max:45'
            ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
            $pass_update = Passbook::where('id', $request->passbook_id)->update([
                    'volume_no'  => $request->volume_no,
                    'page_no'  => $request->page_no
                 ]);

            return redirect('commercial/setup/setup')->with('success', 'Passbook Updated');
        }
	}
	public function passbookDelete($id){
        $pass_delete = Passbook::where('id', $id)->delete();
        return back()->with('success' , 'Passbook Deleted');
	}
#-----------------------------Passbook End------------------------------------------#

#------Insurance
    public function insuranceStore(Request $request){
        #---Store
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:45',
            'code'         => 'required|max:45'
        ]);
        if($validator->fails()){
            return back()->withInput()->with('error', "Incorrect Input!!");
        }
        else{
            $data = new Insurance();
            $data->company_name = $request->company_name;
            $data->code         = $request->code;
            $data->save();
            return back()->with('success' , 'Insurance Saved');
        }
    }
    public function insuranceEdit($id){
        $insurance = Insurance::where('id', $id)->first();
        return view('commercial.setup.insurance_edit_1',compact('insurance'));
    }
    public function insuranceUpdate(Request $request){
        $validator = Validator::make($request->all(), [
                'company_name' => 'required|max:45',
                'code'         => 'required|max:45'
            ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
            $update_ins = Insurance::where('id', $request->insurance_id)->update([
                    'company_name' => $request->company_name,
                    'code'         => $request->code
                ]);
            return redirect('commercial/setup/setup')->with('success', 'Insurance Updated');
        }
        
    }
    public function insuranceDelete($id){
        $delete_ins = Insurance::where('id', $id)->delete();
        return back()->with('success', 'Insurance Deleted');
    }
#------------------------------------Insurance End---------------------------------------#

#--Period
    public function periodStore(Request $request){
         #---Store
        //dd($request->all());
         $validator= Validator::make($request->all(),[
             'period'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new Period();
            $data->period_name = $request->period;
            $data->save();

            return back()
            ->with('success', "Period Saved Successfully!!");
        }       
    }
    public function periodEdit($id){
        $period = Period::where('id',$id)->first();
        return view('commercial.setup.period_edit_1', compact('period')); 
    }
    public function periodUpdate(Request $request){
        $validator = Validator::make($request->all(),[
             'period'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
            $update_period = Period::where('id', $request->period_id)->update([
                    'period_name' => $request->period
            ]);
            return redirect('commercial/setup/setup')
                       ->with('success', "Period Updated successfully!!");
        }
        
    }
    public function periodDelete($id){
        $delete_period = Period::where('id', $id)->delete();
        return back()->with('success', 'Period deleted');
    }
#----------------------Period End------------------------------------------------------#

    #--From_date
    public function from_dateStore(Request $request){
         #---Store
        //dd($request->all());
         $validator= Validator::make($request->all(),[
             'from_date'   =>  'required'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new FromDate();
            $data->from_date = $request->from_date;
            $data->save();

            return back()
            ->with('success', "From Date Saved Successfully!!");
        }       
    }
    public function from_dateEdit($id){
        $from_date_data = FromDate::where('id',$id)->first();
        return view('commercial.setup.from_date_edit_1', compact('from_date_data')); 
    }
    public function from_dateUpdate(Request $request){
        $validator = Validator::make($request->all(),[
             'from_date'   =>  'required'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
            $update_from_date = FromDate::where('id', $request->from_date_id)->update([
                    'from_date' => $request->from_date
            ]);
            return redirect('commercial/setup/setup')
                       ->with('success', "From Date Updated successfully!!");
        }
        
    }
    public function from_dateDelete($id){
        $delete_from_date = FromDate::where('id', $id)->delete();
        return back()->with('success', 'From Date deleted');
    }
#----------------------From Date End------------------------------------------------------#

#--inco_term
    public function inco_termStore(Request $request){
         #---Store
        //dd($request->all());
         $validator= Validator::make($request->all(),[
             'inco_term'   =>  'required|max:45'
          ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new Incoterm();
            $data->name = $request->inco_term;
            $data->save();

            return back()
            ->with('success', "Inco Term Saved Successfully!!");
        }       
    }
    public function inco_termEdit($id){
        $inco_term_data = Incoterm::where('id',$id)->first();
        return view('commercial.setup.inco_term_edit_1', compact('inco_term_data')); 
    }
    public function inco_termUpdate(Request $request){
        $validator = Validator::make($request->all(),[
             'inco_term'   =>  'required|max:45'
            ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
            $update_inco_term = Incoterm::where('id', $request->inco_term_id)->update([
                    'name' => $request->inco_term
            ]);
            return redirect('commercial/setup/setup')
                       ->with('success', "Inco Term Updated successfully!!");
        }
        
    }
    public function inco_termDelete($id){
        $delete_inco_term = Incoterm::where('id', $id)->delete();
        return back()->with('success', 'Inco Term deleted');
    }
#----------------------Period End------------------------------------------------------#


}
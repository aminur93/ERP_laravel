<?php

namespace App\Http\Controllers\Merch\TimeAction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Merch\TnaLibrary;
use App\Models\Merch\TnaTemplate;
use App\Models\Merch\TnaTemplatetoLibrary;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\OrderTNA;
use App\Models\Merch\OrderTNAction;
Use DB, ACL, Validator, DataTables,DateTime;

class TnaOrderController extends Controller
{

  # TNA Order List
    public function tnaOrderList()
    {
    #-----------------------------------------------------------# 
     $library=TnaLibrary::get();
     $tnatype=TnaTemplate::pluck('tna_temp_name','id');
     $order_en=OrderEntry::pluck('order_code','order_id');
     return view('merch.time_action.tna_order_list',compact('library','tnatype','order_en')); 
    }

    # get List data
    public function tnaOrderListData()
    { 
        DB::statement(DB::raw('set @serial_no=0')); 
        $data = DB::table('mr_order_tna AS t') 
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                "t.*",                
                "e.order_code" ,
                "tm.tna_temp_name"
            )
            ->leftJoin('mr_order_entry AS e', 'e.order_id', '=', 't.order_id')
            ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 't.mr_tna_template_id')        
            ->get();
       
        return DataTables::of($data)
        
            ->editColumn('action', function ($data) {

                $return = "<div class=\"btn-group\">";
             
                    $return .= "<a href=".url('merch/time_action/tna_order_edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit Bulk\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>";

                $return .= "<a href=".url('merch/time_action/tna_order_delete/'.$data->id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" onClick=\"return window.confirm('Are you sure?')\" title=\"Delete\">
                        <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                    </a>";

                $return .= "</div>";

                return $return;
            })  
            ->rawColumns([
                'serial_no',
                'action'
            ])
            ->toJson();
    }


   
 # TNA Order show Form
    public function orderForm()
    {
    #-----------------------------------------------------------# 
     $library=TnaLibrary::get();
     $tnatype=TnaTemplate::pluck('tna_temp_name','id');
     $order_en=OrderEntry::pluck('order_code','order_id');
     return view('merch.time_action.tna_order',compact('library','tnatype','order_en'));
 
    }
 # TEMPLATE List   
    public function templatesList(Request $request){

     #-----------------------------------------------------------# 
      $order_en=OrderEntry::where('order_id', $request->order_id)
                  ->first(['mr_buyer_b_id']);
      $tnatype=TnaTemplate::where('mr_buyer_b_id', $order_en->mr_buyer_b_id)->pluck('tna_temp_name','id'); 
      $list=""; 

        foreach ($tnatype as $key => $value) {
                     
                   
           $list.="<option value=\"$key\">$value</option>"; 
        }        
      return $list;   
       
  }
  # TNA Generator 1   
    public function tnaGenerate1(Request $request){
     
     #-----------------------------------------------------------# 
          
        date_default_timezone_set('Asia/Dhaka');

      //$now = time(); 
        $now = date("d-m-Y");
        $order_en=OrderEntry::where('order_id', $request->order_id)
                  ->first(['order_delivery_date']);
             

        $library=DB::table('mr_tna_template_to_library AS l')
                    ->select([
                              'l.*',
                              'tm.tna_temp_name',
                              'tl.tna_lib_action',
                              'tl.id as tlid'
                            
                          ])
                    ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 'l.mr_tna_template_id')
                    ->leftJoin('mr_tna_library AS tl', 'tl.id', '=', 'l.mr_tna_library_id')
                    ->where('mr_tna_template_id', $request->tna_type)
                    ->get();  
                  
                    $i= 0; // SL value

                    // SyS Gen. Date
                    $delv_date=$order_en->order_delivery_date;              
                    $date=date_create($delv_date);
                    $GDD=date_format($date,"Y/m/d");

                    $lead_tole= $request->lead_days+$request->tolerance_days ; 
                    $yy=date('Y-m-d', strtotime('-'.$lead_tole.' day', strtotime($GDD)));
              

                 // List return
                  $list= "<h5 class=\"page-header\">Time & Action</h5>
                          
                                <table class=\"table responsive \" style=\"width:100%;border:1px solid #ccc;font-size:12px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                                          <thead>
                                            <tr>
                                              <th style=\"text-align:center\">SL</th>
                                              <th style=\"text-align:center\">Activity</th>
                                              <th style=\"text-align:center\">Sys. Gen. Date </th>
                                              
                                            </tr> 
                                          </thead>
                                <tbody>";
                            $offset=0;
                            foreach($library AS $lib){
                                 $i= $i+1;  


                                // Offset day 

                                      $libray2=DB::table('mr_tna_template_to_library AS l')
                                        ->select([
                                                  'l.id',
                                                  'l.offset_day'
                                                
                                              ])
                                      
                                      ->where('l.mr_tna_template_id', $request->tna_type)
                                      ->where('l.id','>', $lib->id)
                                      ->get();                                 

                                      $offset2=$lib->offset_day;

                                       foreach($libray2 AS $lib2){
                                         $offset2+=$lib2->offset_day;
                                       }
                                ///


                                 if($lib->tna_temp_logic=="OK to Begin"){     
                                                           
                                      $offset=$lib->offset_day;
                                      $sg_date=date('d/m/Y', strtotime('-'.$offset2.' day', strtotime($yy)));                                     
                                                        
                                  }

                                  if($lib->tna_temp_logic=="DCD or FOB"){
                              
                                    $offset=$lib->offset_day;
                                      $sg_date=date('d-m-Y', strtotime('-'.$offset2.' day', strtotime($GDD))); 
                                    }

                                  $list.="<tr style=\"text-align:center\">
                                                <td>$i
                                                <input type='hidden' value='$lib->tlid' name='lib_id[]'>
                                                </td>
                                                <td>$lib->tna_lib_action </td>
                                                <td>$sg_date
                                                <input type='hidden' name='actualdate[]' value=''> <input type='hidden' name='remark[]' value=''></td>
                                            </tr>"; 

                            }              
                                    
                    return $list;   
       
  }
 
 # TNA Generator   
    public function tnaGenerate(Request $request){
     // dd($request->all());
     #-----------------------------------------------------------# 
          
        date_default_timezone_set('Asia/Dhaka');

      //$now = time(); 
        $now = date("d-m-Y");
        $order_en=OrderEntry::where('order_id', $request->order_id)
                  ->first(['order_delivery_date']);
             

        $library=DB::table('mr_tna_template_to_library AS l')
                    ->select([
                              'l.*',
                              'tm.tna_temp_name',
                              'tl.tna_lib_action',
                              'tl.id as tlid'
                            
                          ])
                    ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 'l.mr_tna_template_id')
                    ->leftJoin('mr_tna_library AS tl', 'tl.id', '=', 'l.mr_tna_library_id')
                    ->where('mr_tna_template_id', $request->tna_type)
                    ->get();  
                  
                    $i= 0; // SL value

                    // SyS Gen. Date
                    $delv_date=$order_en->order_delivery_date;              
                    $date=date_create($delv_date);
                    $GDD=date_format($date,"Y/m/d");

                    $lead_tole= $request->lead_days+$request->tolerance_days ; 
                    $yy=date('Y-m-d', strtotime('-'.$lead_tole.' day', strtotime($GDD)));
              

                 // List return
                  $list= "<h5 class=\"page-header\">Time & Action</h5>
                          
                                <table class=\"table responsive \" style=\"width:100%;border:1px solid #ccc;font-size:12px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                                          <thead>
                                            <tr>
                                              <th style=\"text-align:center\">SL</th>
                                              <th style=\"text-align:center\">Activity</th>
                                              <th style=\"text-align:center\">Sys. Gen. Date </th>
                                              <th style=\"text-align:center\">Actual Date </th>
                                             
                                              <th style=\"text-align:center\">Remark</th>
                                            </tr> 
                                          </thead>
                                <tbody>";
                            $offset=0;
                            foreach($library AS $lib){
                                 $i= $i+1;  


                                // Offset day 

                                      $libray2=DB::table('mr_tna_template_to_library AS l')
                                        ->select([
                                                  'l.id',
                                                  'l.offset_day'
                                                
                                              ])
                                      
                                      ->where('l.mr_tna_template_id', $request->tna_type)
                                      ->where('l.id','>', $lib->id)
                                      ->get();                                 

                                      $offset2=$lib->offset_day;

                                       foreach($libray2 AS $lib2){
                                         $offset2+=$lib2->offset_day;
                                       }
                                ///


                                 if($lib->tna_temp_logic=="OK to Begin"){     
                                                           
                                      $offset=$lib->offset_day;
                                      $sg_date=date('d/m/Y', strtotime('-'.$offset2.' day', strtotime($yy)));                                     
                                                        
                                  }

                                  if($lib->tna_temp_logic=="DCD or FOB"){
                              
                                    $offset=$lib->offset_day;
                                      $sg_date=date('d-m-Y', strtotime('-'.$offset2.' day', strtotime($GDD))); 
                                   
                                      
                                      /* Day interval calculation between Order Delivery Date and System Generate date

                                          $start = new DateTime($now);
                                          $end = new DateTime($sg_date);
                                          $interval = $end->diff($start);

                                          // %a will output the total number of days.
                                           $notif=$interval->format('%a');  
                                      */
                                           
                                  }


                                     /* <td>$i - $lib->tna_temp_logic-$offset2-
                                                <input type='hidden' value='$lib->tlid' name='lib_id[]'>
                                                </td>*/

                                    $list.="<tr style=\"text-align:center\">
                                                <td>$i
                                                <input type='hidden' value='$lib->tlid' name='lib_id[]'>
                                                </td>
                                                <td>$lib->tna_lib_action </td>
                                                <td>$sg_date</td>
                                                <td width='30%'><input type='date'name='actualdate[]' value='' ></td>
                                                <td width='20%'> <input type='text' name='remark[]' value=''></td>
                                            </tr>"; 

                            }              
                                    
                    return $list;   
       
  }


 # TNA Generator Store
    public function tnaGenerateStore(Request $request){
        #-----------------------------------------------------------# 
        //dd($request->all());
         $validator= Validator::make($request->all(),[
            'mbm_order'        => 'required',
            'confirm_date'     => 'required',
            'lead_days'        => 'required',
            'tolerance_days'   => 'required',
            'tna_templatetype' => 'required',
            'ok_to_begin'      => 'required'
    
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $data= new OrderTNA();
            $data->order_id           = $request->mbm_order ;
            $data->confirm_date       = $request->confirm_date ;
            $data->lead_days          = $request->lead_days ;
            $data->tolerance_days     = $request->tolerance_days ;
            $data->mr_tna_template_id = $request->tna_templatetype ;
            $data->begin_date         = $request->ok_to_begin ;
            $data->revise_begin_date  = $request->rev_ok_to_begin ;
        

                if($data->save()){
                    $last_id = $data->id;

                    for($i=0; $i<sizeof($request->lib_id); $i++)
                    {
                        OrderTNAction::insert([
                            'mr_order_entry_order_id'  => $last_id,
                            'mr_tna_template_id'       => $request->tna_templatetype,
                            'mr_tna_library_id'        => $request->lib_id[$i],
                            'actual_date'              => $request->actualdate[$i],
                            'remarks'                  => $request->remark[$i],
                        ]);
                    }

                  // Log File 
                  $this->logFileWrite("TNA Order Stored", $last_id);

                  return back()
                      ->with('success', "Saved Successfully!!");
                }

                else{
                    return back()
                    ->withInput()
                    ->with('error', 'Error saving data!!');
                }
        }
 }  
 # TNA Order Edit Form
    public function tnaOrderEdit($id)
    {
        #-----------------------------------------------------------# 
         $library=TnaLibrary::get();




         $tna = DB::table('mr_order_tna AS t') 
                ->select(
                    DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                    "t.*",                
                    "e.order_code" ,
                    "tm.tna_temp_name",
                    "tm.id as tm_id"
                )
                ->leftJoin('mr_order_entry AS e', 'e.order_id', '=', 't.order_id')
                ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 't.mr_tna_template_id')   
                ->where('t.id', $id)     
                ->first();

         $order_en=OrderEntry::pluck('order_code','order_id');

      $order_en2=OrderEntry::where('order_id',$tna->order_id)
                  ->first(['mr_buyer_b_id']);
      $tnatype=TnaTemplate::where('mr_buyer_b_id', $order_en2->mr_buyer_b_id)->pluck('tna_temp_name','id'); 
 



        //$tnaction = OrderTNAction::where('mr_order_entry_order_id', $id)->get(); 
        //dd($tna->tm_id);
        $tnaction = DB::table('mr_order_tna_action AS t') 
                        ->select(                  
                            "t.*",
                            "t.id as tid",  
                            "ot.*",              
                            "e.order_code" ,
                            "tm.id AS tmid",
                            "tm.tna_temp_name",
                            "tl.id as tlid",
                            "tl.tna_lib_action",
                            "tl.tna_lib_offset",
                            "ttl.tna_temp_logic",
                            "ttl.id AS lib_id",
                            "ttl.offset_day"
                        )
                        ->leftJoin('mr_order_tna AS ot', 'ot.id', '=', 't.mr_order_entry_order_id')
                        ->leftJoin('mr_order_entry AS e', 'e.order_id', '=', 'ot.order_id')
                        ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 'ot.mr_tna_template_id')
                        ->leftJoin('mr_tna_library AS tl', 'tl.id', '=', 't.mr_tna_library_id')
                        ->leftJoin('mr_tna_template_to_library AS ttl', 'ttl.mr_tna_library_id', '=', 'tl.id')  
                        ->where('mr_order_entry_order_id', $id)
                        ->where('ttl.mr_tna_template_id', $tna->tm_id)
                        ->get();        
    //dd($tnaction );

         return view('merch.time_action.tna_order_edit',compact('library','tnatype','order_en','tna','tnaction'));
     
    }
 # TNA Update
    public function tnaOrderUpdate(Request $request){
        #-----------------------------------------------------------# 
        //dd($request->all());
         $validator= Validator::make($request->all(),[
            'mbm_order'        => 'required',
            'confirm_date'     => 'required',
            'lead_days'        => 'required',
            'tolerance_days'   => 'required',
            'tna_templatetype' => 'required',
            'ok_to_begin'      => 'required'
    
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

            OrderTNA::where('id', $request->tna_id)->update([
               'order_id'           => $request->mbm_order,
               'confirm_date'       => $request->confirm_date,
               'lead_days'          => $request->lead_days,
               'tolerance_days'     => $request->tolerance_days,
               'mr_tna_template_id' => $request->tna_templatetype,
               'begin_date'         => $request->ok_to_begin,
               'revise_begin_date'  => $request->rev_ok_to_begin,
            ]);

            //dd(sizeof($request->lib_id))

            if(sizeof($request->lib_id)>0)  {

                OrderTNAction::where('mr_order_entry_order_id', $request->tna_id)->delete();
                for($i=0; $i<sizeof($request->lib_id); $i++)
                {
                    OrderTNAction::insert([
                        'mr_order_entry_order_id'  => $request->tna_id,
                        'mr_tna_template_id'       => $request->tna_templatetype,
                        'mr_tna_library_id'        => $request->lib_id[$i],
                        'actual_date'              => $request->actualdate[$i],
                        'remarks'                  => $request->remark[$i]
                    ]);
                }

            }  
            // Log File 
                  $this->logFileWrite("TNA Order Updated", $request->tna_id);

               return back()
                      ->with('success', "Updated Successfully!!");


      }
    }  

 # TNA Order delete
    public function tnaOrderDelete($id)
    { 
      //dd($id);
        OrderTNA::where('id', $id)->delete();
        OrderTNAction::where('mr_order_entry_order_id', $id)->delete();
        // Log File 
          $this->logFileWrite("TNA Order Deleted", $id);

          return back()
          ->with('success', "Deleted successfully!!");
    }

# Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

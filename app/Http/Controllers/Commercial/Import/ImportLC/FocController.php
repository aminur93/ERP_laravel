<?php
namespace App\Http\Controllers\Commercial\Import\ImportLC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\Commercial\CmFile;
use App\Models\Merch\Supplier;
use App\Models\Commercial\ExpLcEntry;
use App\Models\Commercial\Port;
use App\Models\Commercial\Item;
use App\Models\Commercial\FocLc;
use App\Models\Commercial\MrBuyer;
use App\Models\Commercial\GetData;
use App\Models\Commercial\CmFocOrder;
use App\Models\Commercial\cmExpLcEntry;
use App\Models\Commercial\CmFocLc;
use App\Models\Commercial\cmSalesContractOrder;
use Validator, DB, ACL, Auth, DataTables, Response;

class FocController extends Controller
{
///FOC  Info Entry 	
    public function showForm()
    {
      //return CmFile::select('id')->get();
      $file_no  = CmFile::select('id', 'file_no')->get();
      // dd($file_no);
      $item     = Item::pluck( 'cm_item_name', 'id');
      $supplier = Supplier::pluck( 'sup_name', 'sup_id');
      $port     = Port::pluck('port_name', 'id' );
      $buyer    = MrBuyer::select('b_id', 'b_name')->get();
      
      $elc      = CmFocOrder::pluck('id');
      //return $orders;
       //$pi_type = (object)array();
    //    $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
    //    $supplier = Supplier::pluck('sup_name','sup_id');
    //    $port = Port::pluck('port_name','port_id');
    //    $item = Item::pluck('com_item_code','com_item_id');
    //    $elc = ExpLcEntry::pluck('exp_lc_explcno','exp_lc_id'); 
    // return view('commercial.import.importlc.foc.foc_entry', compact('file_no','item','supplier','manuf','section','unit','port','elc'));
    return view('commercial.import.importlc.foc.foc_entry', compact('file_no','item','supplier','port','buyer'));
    }

///FOC Store
    public function focStore(Request $request)
    {
            
        #-----------------------------------------------#
          
          $validator= Validator::make($request->all(),[
             'file_no'            =>'required',
             'item'               =>'required',
             'invoiceno'          =>'required|max:45',
             'tr_doc1'            =>'required|max:45',
             'tr_doc2'            =>'required|max:45',
             'tr_doc_date'        =>'required|max:45',
             'supplier'           =>'required',
             'value'              =>'required|max:45',
             'currency'           =>'required|max:45',
             'quantity'           =>'required|max:45',
             'uom'                =>'required|max:45',
             'package'            =>'required|max:45',
             'doc_type'           =>'required|max:45',
             'docdate'            =>'required|max:45',
             'doc_dispatch_date'  =>'required|max:45',
             'port_loading'       =>'required',
             'birth_date'         =>'required|max:45',
             'buyer'              =>'required',
             'noting_date'        =>'required|max:45',
             'examine_date'       =>'required|max:45',
             'assessment_date'    =>'required|max:45',
             'delivery_date'      =>'required|max:45',
             'arriving_date'      =>'required|max:45',
             'mode'               =>'required|max:45',
             'weight'            =>'required|max:45',
             'checker'         =>'required|max:45'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
          // return CmFocLc::orderBy('id', 'desc')->pluck('id')->first();
            // dd($request->all());

            $data= new CmFocLc;
            $data->cm_file_id             = $request->file_no;
            $data->foc_mode               = $request->mode;
            $data->cm_item_id             = $request->item;
            $data->foc_invoice_no         = $request->invoiceno;
            $data->trans_doc_no1          = $request->tr_doc1;
            $data->trans_doc_no2          = $request->tr_doc2;
            $data->trans_doc_date         = $request->tr_doc_date;
            $data->mr_supplier_sup_id     = $request->supplier;
            $data->foc_value              = $request->value;
            $data->foc_currency           = $request->currency;
            $data->foc_qty                = $request->quantity;
            $data->foc_uom                = $request->uom;
            $data->foc_weight             = $request->weight;
            $data->foc_package            = $request->package;
            $data->foc_doc_type           = $request->doc_type;
            $data->foc_doc_date           = $request->docdate;
            $data->foc_doc_dispatch_date  = $request->doc_dispatch_date;
            $data->cm_port_id             = $request->port_loading;
            $data->berth_date             = $request->birth_date;
            $data->mr_buyer_b_id          = $request->buyer;
            $data->noting_date            = $request->noting_date;
            $data->examine_date           = $request->examine_date;
            $data->assesment_date         = $request->assessment_date;
            $data->delivery_date          = $request->delivery_date;
            $data->fac_arrive_date        = $request->arriving_date;
            $data->save();

            $LastId = CmFocLc::latest('id')->pluck('id')->first();
            $request = $request->all();
            $orderData = $request['checker'];

            foreach($orderData as $data){
              $cmFocData= new CmFocOrder;
              $cmFocData->cm_foc_lc_id = $LastId;
              $cmFocData->mr_order_entry_order_id = $data;
              $cmFocData->save();
            }
            
            // $data->unit_id                = auth()->user()->unit_id();
          //   $last_id = $data->id;

          //  for($i=0; $i<sizeof($request->elc); $i++)
          //       {
                   
          //       FocLcElc::insert([
          //        'foc_lc_id'       => $last_id,
          //        'exp_lc_fileno'   => $request->elc[$i]

          //           ]);
          //        }
            return back()
            ->with('success', "FOC Information Successfully added!!");
           } 

        }

 
  
///----FOC List----------/
    public function focList(){
      $datas = CmFocLc::all();

      foreach ($datas as $data) {
          $file  = CmFile::where('id',$data->cm_file_id)->value('file_no');
          $item  = Item::where('id',$data->cm_item_id)->value('cm_item_name');
          $supp  = Supplier::where('sup_id',$data->mr_supplier_sup_id)->value('sup_name');
          $port  = Port::where('id',$data->cm_port_id)->value('port_name');
          $buyer = MrBuyer::where('b_id',$data->mr_buyer_b_id)->value('b_name');

          $data->file_no        = $file;
          $data->item_name      = $item;
          $data->supplier_name  = $supp;
          $data->port_name      = $port;
          $data->buyer_name     = $buyer;
      }
      // return $datas;
      //return json_decode($datas);
      // return $datas->pluck('id');
      // return $data;
    #----------------------------#

     //$pi_type = (object)array();
      
      //  $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
      //  $supplier = Supplier::pluck('sup_name','sup_id');
      //  $port = Port::pluck('port_name','port_id');
      //  $item = Item::pluck('com_item_code','com_item_id');
      //  $elc  = ExpLcEntry::pluck('exp_lc_explcno','exp_lc_id');
 
    return view('commercial.import.importlc.foc.foc_entry_list',compact("datas"));
  }  

   public function focListData(){
     
        #-------------------------------# 
         $data=  DB::table('com_foc_lc AS fl')
                    ->select([
                      'fl.*',
                      'ci.com_item_code',
                      'ms.sup_name',
                    ])  
                 
                    ->leftJoin("com_item AS ci", 'ci.com_item_id', 'fl.item_id')
                    ->leftJoin("mr_supplier AS ms", 'ms.sup_id', 'fl.sup_id')                 
                  
                    ->get();  
          
       

              return DataTables::of($data)

      /// focvalue Column
        ->editColumn('focvalue', function ($data) {
            return "$data->foc_lc_value $data->foc_lc_currency"; 

          }) 
     /// focquantity Column
        ->editColumn('focquantity', function ($data) {
            return "$data->foc_lc_qty $data->foc_lc_uom"; 

          }) 
    /// ELC Column for multiple data
        ->editColumn('focelc', function ($data) {
           foreach($data AS $focelc){
           $elcno= DB::table('com_foc_lc_elcno AS fle')
                  ->leftJoin("com_exp_lc_entry AS el", 'el.exp_lc_id', 'fle.exp_lc_fileno')

                  ->where('fle.foc_lc_id', $data->foc_lc_id)
                  ->get();

                  $i=1;
                  $com_foc_elc="";
                  foreach($elcno AS $e){
                    $com_foc_elc.= $i.". ".$e->exp_lc_explcno."<br>";
                    $i= $i+1;
                }
      
              } 

           return $com_foc_elc;
          })    
        /// Query for Action 
            ->editColumn('action', function ($data) {
                $btn = "  
                    <a href=".url('comm/import/importlc/focedit/'.$data->foc_lc_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-pencil\"></i>
                        </a> 
                    </div>
                
                    <a href=".url('comm/import/importlc/focdelete/'.$data->foc_lc_id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"delete\" onclick=\"return confirm('Are you sure you want to delete?');\">
                        <i class=\"fa fa-trash\"></i>
                        </a>  ";
              

                return $btn;
              })  
            ->rawColumns(['action','focvalue','focquantity','focelc'])
            ->toJson();
            
    }

    
/// FOC Info Update
    public function focEdit($id){
          $datas = CmFocLc::where('id', $id)->get();
          //Assigning the names with respect to their ids.....
          // dd($datas);
          foreach ($datas as $data) {
              $file  = CmFile::where('id',$data->cm_file_id)->value('file_no');
              $item  = Item::where('id',$data->cm_item_id)->value('cm_item_name');
              $supp  = Supplier::where('sup_id',$data->mr_supplier_sup_id)->value('sup_name');
              $port  = Port::where('id',$data->cm_port_id)->value('port_name');
              $buyer = MrBuyer::where('b_id',$data->mr_buyer_b_id)->value('b_name');

              $data->file_no        = $file;
              $data->item_name      = $item;
              $data->supplier_name  = $supp;
              $data->port_name      = $port;
              $data->buyer_name     = $buyer;
          }
      //------
          $file_no  = CmFile::select('id', 'file_no')->get();
          // dd($file_no);
          $item     = Item::pluck( 'cm_item_name', 'id');
          $supplier = Supplier::pluck( 'sup_name', 'sup_id');
          $port     = Port::pluck('port_name', 'id' );
          $buyer    = MrBuyer::select('b_id', 'b_name')->get();
          
          $elc      = CmFocOrder::pluck('id');
      //------
          $selected_orders = CmFocOrder::where('cm_foc_lc_id',$id)->get();
          foreach ($selected_orders as $orders) {
            $order_code = DB::table('mr_order_entry')->where('order_id', '=', $orders->mr_order_entry_order_id)
                                                     ->value('order_code');  
            $orders->order_code = $order_code;
          }
          // dd($selected_orders);
      
      $mrlscorderid = CmFocOrder::where('cm_foc_lc_id', $id)
                                                ->select('mr_order_entry_order_id as order_id')
                                                ->get();

      foreach ($mrlscorderid as $order_list) {
            $order_code = DB::table('mr_order_entry')->where('order_id', '=', $order_list->order_id)
                                                     ->value('order_code');
            $order_list->order_code = $order_code;   
      }
      // dd('FOC:', $datas,'Order List:', $mrlscorderid );
      // return $mrlscorderid;
      // return $elc;
      return view('commercial.import.importlc.foc.foc_entry_update',compact('file_no','item','supplier','port','buyer',"datas",'mrlscorderid'));
      // return view('commercial.import.importlc.foc.foc_entry', compact('file_no','item','supplier','port','buyer'));
     #------------------------------------------------------# 
  //  $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
  //      $supplier = Supplier::pluck('sup_name','sup_id');
  //      $port = Port::pluck('port_name','port_id');
  //      $item = Item::pluck('com_item_code','com_item_id');
  //      $elc = ExpLcEntry::pluck('exp_lc_explcno','exp_lc_id'); 
  

  //       $data=  DB::table('com_foc_lc AS cfl')
  //                   ->select([
  //                     'cfl.*'])  
                 
  //                   ->where('foc_lc_id', $id)
  //                   ->first();  
  //       $dataElc=FocLcElc::where('foc_lc_id', $id)->get(); 
  //       $dataElc2=FocLcElc::where('foc_lc_id', $id)->first(); 
  //           return view('commercial.import.importlc.foc.foc_entry_edit', compact('file_no','item','supplier','manuf','section','unit','port','elc','data','dataElc','dataElc2'));
  }

  public function focUpdate(Request $request, $id){ 
     
      #------------------------------------------------# 
        // dd($request->all());

        $validator= Validator::make($request->all(),[
          'file_no'            =>'required',
          'item'               =>'required',
          'invoiceno'          =>'required|max:45',
          'tr_doc1'            =>'required|max:45',
          'tr_doc2'            =>'required|max:45',
          'tr_doc_date'        =>'required|max:45',
          'supplier'           =>'required',
          'value'              =>'required|max:45',
          'currency'           =>'required|max:45',
          'quantity'           =>'required|max:45',
          'uom'                =>'required|max:45',
          'package'            =>'required|max:45',
          'doc_type'           =>'required|max:45',
          'docdate'            =>'required|max:45',
          'doc_dispatch_date'  =>'required|max:45',
          'port_loading'       =>'required',
          'birth_date'         =>'required|max:45',
          'buyer'              =>'required',
          'noting_date'        =>'required|max:45',
          'examine_date'       =>'required|max:45',
          'assessment_date'    =>'required|max:45',
          'delivery_date'      =>'required|max:45',
          'arriving_date'      =>'required|max:45',
          'mode'               =>'required|max:45',
          'weight'            =>'required|max:45',
          'checker'         =>'required'
        ]);
       
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            // dd($request->all());
    //        $focupdate = FocLc::where('foc_lc_id', $request->foc_id)->update([
    //       'exp_lc_fileno'          => $request->file_no,
    //       'foc_lc_mode'            => $request->mode,
    //       'item_id'                => $request->item,
    //       'foc_lc_inv_no'          => $request->invoiceno,
    //       'foc_lc_transp_doc1'     => $request->tr_doc1,
    //       'foc_lc_transp_doc2'     => $request->tr_doc2,
    //       'foc_lc_transp_date'     => $request->tr_doc_date,
    //       'sup_id'                 => $request->supplier,
    //       'foc_lc_value'           => $request->value,
    //       'foc_lc_currency'        => $request->currency,
    //       'foc_lc_qty'             => $request->quantity,
    //       'foc_lc_uom'             => $request->uom,
    //       'foc_lc_weight'          => $request->weight,
    //       'foc_lc_package'         => $request->package,
    //       'foc_lc_doctype'         =>$request->doc_type,
    //       'foc_lc_doc_date'        => $request->docdate,
    //       'foc_lc_dispatch_date'   => $request->doc_dispatch_date,
    //       'port_id'                => $request->port_loading,
    //       'foc_lc_berth_date'      => $request->birth_date,
    //       'foc_lc_noting_date'     => $request->noting_date,
    //       'foc_lc_examine_date'    => $request->examine_date,
    //       'foc_lc_assesment_date'  => $request->assessment_date,
    //       'foc_lc_delivery_date'   => $request->delivery_date,
    //       'foc_lc_arriving_date'   => $request->arriving_date

    //        ]);

    //   FocLcElc::where('foc_lc_id', $request->foc_id)->delete();
    //  if(!empty($request->elc)){
    //    for($i=0; $i<sizeof($request->elc); $i++)
    //             {
                   
    //             FocLcElc::insert([
    //              'foc_lc_id'       => $request->foc_id,
    //              'exp_lc_fileno'   => $request->elc[$i]

    //                 ]);
    //              }
    //         }
    
    
    $data=CmFocLc::find($id);
    $data->cm_file_id             = $request->file_no;
    $data->foc_mode               = $request->mode;
    $data->cm_item_id             = $request->item;
    $data->foc_invoice_no         = $request->invoiceno;
    $data->trans_doc_no1          = $request->tr_doc1;
    $data->trans_doc_no2          = $request->tr_doc2;
    $data->trans_doc_date         = $request->tr_doc_date;
    $data->mr_supplier_sup_id     = $request->supplier;
    $data->foc_value              = $request->value;
    $data->foc_currency           = $request->currency;
    $data->foc_qty                = $request->quantity;
    $data->foc_uom                = $request->uom;
    $data->foc_weight             = $request->weight;
    $data->foc_package            = $request->package;
    $data->foc_doc_type           = $request->doc_type;
    $data->foc_doc_date           = $request->docdate;
    $data->foc_doc_dispatch_date  = $request->doc_dispatch_date;
    $data->cm_port_id             = $request->port_loading;
    $data->berth_date             = $request->birth_date;
    $data->mr_buyer_b_id          = $request->buyer;
    $data->noting_date            = $request->noting_date;
    $data->examine_date           = $request->examine_date;
    $data->assesment_date         = $request->assessment_date;
    $data->delivery_date          = $request->delivery_date;
    $data->fac_arrive_date        = $request->arriving_date;
    $data->save();

    
    // $LastId = CmFocLc::latest('id')->pluck('id')->first();
    $request = $request->all();
    $orderData = $request['checker'];
    $ids=CmFocOrder::where('cm_foc_lc_id',$id)->delete();

    foreach($orderData as $data){
      $cmFocData= new CmFocOrder;
      $cmFocData->cm_foc_lc_id = $id;
      $cmFocData->mr_order_entry_order_id = $data;
      $cmFocData->save();
    }
    // return 'ok';
    // $ids=CmFocOrder::where('cm_foc_lc_id',$id)->pluck('id');
    
    // return $ids;
    // return count($ids);
    // foreach($ids as $id){
    //   $data=CmFocOrder::find($id);
    //   $data->cm_foc_lc_id = $id;
    // }
    // foreach($orderData as $data){
    //   // $cmFocData->cm_foc_lc_id = $id;
    //   // $cmFocData->mr_order_entry_order_id = $data;
    //   // $cmFocData->save();
    //   foreach($ids as $id){
        
    //   }
    // }

        
        
        return back()
                ->with('success', "FOC  Information Successfully updated!!!");
      } 

  } 
/// FOC Info Delete

    public function focDelete($id){
        // dd($id);exit;

        
        #----------------------------------# 
        CmFocLc::where('id', $id)->delete();
        CmFocOrder::where('cm_foc_lc_id', $id)->delete();
    
        return back()
        ->with('success', " Deleted Successfully!!");
    }

    public function getData($id)
    {
      $results[][]="";
      // $results = GetData::where('mr_buyer_b_id',$id)->where('order_status','Active')->pluck('order_code','order_id');
      $orders = GetData::where('mr_buyer_b_id',$id)->where('order_status','Active')
                                                    ->select('order_code','order_id')
                                                    ->get();
      // dd($orders);exit;
      for($i=0; $i<sizeof($orders); $i++ ){
        $results['order_id'][$i]   = $orders[$i]->order_id;
        $results['order_code'][$i] = $orders[$i]->order_code;
      }
      // dd($results);  
      return Response::json($results);
      // return json_encode($results);
    }

    public function getFileorder($id)
    {
      $contract_id = cmExpLcEntry::where('cm_file_id',$id)->pluck('cm_sales_contract_id');
      
      $mrorderentryorder = cmSalesContractOrder::where('cm_sales_contract_id',$contract_id)->pluck('mr_order_entry_order_id');

      $buyer = DB::table('mr_order_entry as order')->select('byr.b_id','byr.b_name')
                                                   ->where('order.order_id','=', $mrorderentryorder)
                                                   ->join('mr_buyer as byr','byr.b_id', '=', 'order.mr_buyer_b_id')
                                                   ->get();
      // dd($buyer);

      return $buyer;
      // return json_encode($results);
    }
    
}

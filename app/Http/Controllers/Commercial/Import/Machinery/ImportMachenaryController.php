<?php
namespace App\Http\Controllers\Commercial\Import\Machinery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\Merch\Supplier;
use App\Models\Commercial\Port;
use App\Models\Commercial\Item;
use App\Models\Commercial\CommBank;
use App\Models\Commercial\ImportData;
use App\Models\Commercial\Vessel;
use App\Models\Commercial\VesselVoyage;
use App\Models\Commercial\ImportInvoice;
use App\Models\Commercial\fabPocket;
use App\Models\Commercial\MachineryImportData;
use App\Models\Commercial\MachineryImportDataHistory;
use App\Models\Commercial\MachineryImportDataInvoice;
use App\Models\Commercial\MachineryPI;
use App\Models\Hr\Unit;
use App\Models\Merch\Country;

use Validator, DB, ACL, Auth, DataTables;

class ImportMachenaryController extends Controller
{

///----Imort Data List----------/
    public function importMachineryDataLlist(){
        
    #----------------------------#

     //$pi_type = (object)array();


      $bank  = CommBank::pluck('bank_name','bank_id');
      $supplier = Supplier::pluck('sup_name','sup_id');
      $unit = Unit::pluck('hr_unit_name','hr_unit_id');


    return view('commercial.import.machinery.import_machinery_list', compact('supplier','unit','bank'));
  }  

   public function importMachineryListData(Request $request){
    
        $id = $request->id;
        #-------------------------------# 
         $data=  DB::table('com_machinery_pi AS pi')
                    ->select([
                      'pi.*',
                      'sup.sup_id',
                      'sup.sup_name',
                      'cmi.machinery_master_info_lc_no',
                      'hu.hr_unit_id',
                      'hu.hr_unit_name'  
                    ]) 

                    
                    ->leftJoin("com_machinery_master_info AS cmi", 'cmi.machinery_pi_id', 'pi.machinery_pi_id')
                    ->leftJoin("mr_supplier AS sup", 'sup.sup_id', 'pi.sup_id')
                    ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'pi.hr_unit_id')
                    ->where(function($condition) use ($id){
                      if (!empty($id)) 
                      {
                        $condition->where('pi.bank_id', $id);
                      }
                    })
                    ->whereNotNull('machinery_pi_fileno')
                    ->whereNotNull('machinery_pi_item')
                    ->whereNotNull('machinery_master_info_lc_no')
                    ->whereNotNull('hr_unit_name')
                    ->whereNotNull('sup_name')
                    ->get();  
          
       

              return DataTables::of($data)

     
        /// Query for Action 

        ->editColumn('action', function ($data) {

    //dd($data);

        $impdata = DB::table('com_import_data_entry_machinery')

                    ->where('machinery_pi_fileno', $data->machinery_pi_fileno)
                    ->where('imp_data_machinery_item', $data->machinery_pi_item)
                    ->where('hr_unit_id',$data->hr_unit_id)
                    ->where('imp_data_machinery_master_lc_no', $data->machinery_master_info_lc_no)
                    ->where('sup_id', $data->sup_id)
                    ->get(); 
  $idval=1;

    if($impdata){
            
            $btn = "<a href=".url('comm/import/machinery/machinarydataedit/'.$data->machinery_pi_fileno.'/'.$data->machinery_pi_item.'/'.$data->hr_unit_id.'/'.$data->machinery_master_info_lc_no.'/'.$data->sup_id.'/'.$data->machinery_pi_id.'/'.$idval)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-plus\"></i>
                        </a>  
                    </div>
                
                   ";}


    else{
            $btn = "<a href=".url('comm/import/machinery/importdata/'.$data->machinery_pi_fileno.'/'.$data->machinery_pi_item.'/'.$data->hr_unit_id.'/'.$data->machinery_master_info_lc_no.'/'.$data->sup_id.'/'.$data->machinery_pi_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-plus\"></i>
                        </a>  
                    </div>
                
                   ";}
      
                return $btn;

              })  
            ->rawColumns(['action'])
            ->toJson();
            
    }
///import Data Info Entry 	
    public function MachinaryDataEntry($file,$itemno,$unit,$ilc,$suppl,$pi_id)
    {
      //$pi_type = (object)array();
       $port = Port::pluck('port_name','port_id');
       $bank  = CommBank::pluck('bank_name','bank_id'); 
       $country= Country::pluck('cnt_name','cnt_id');
       $vessel= Vessel::pluck('vess_name','vess_id');
       $voyage= VesselVoyage::pluck('voyage_no','voyage_id');
      
       $item=$itemno;
       $fileno=$file;
       $unitno=$unit;
       $ilcno=$ilc;
       $supplid=$suppl;
       $pid=$pi_id;
  
     $sppplier = Supplier::where('sup_id',$supplid)
                ->first();
     $unit = Unit::where('hr_unit_id',$unitno)
                ->first();
     $pino = MachineryPI::where('machinery_pi_fileno',$fileno)
                ->get();

  return view('commercial.import.machinery.import_machinery_entry', compact('port','vessel','bank','country','impdata','item','fileno','unit','ilcno','sppplier','pino','pid','supplid'));
    }

# Return Voyage List by Mother Vessel
    public function vesselVoyage(Request $request)
    {
      $list = "<option value=\"\">Select </option>";
        if (!empty($request->vess_id))
        {
          $voyageList  = VesselVoyage::where('vess_id', $request->vess_id)
                    ->pluck('voyage_no','voyage_id'); 

            foreach ($voyageList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    } 
# Return Pi Date List by PI No.
    public function piDate(Request $request)
    {
     // dd($request->pi_no);
                   
          $pi_no = DB::table('com_machinery_pi AS mpi')
                ->select([
                      'mpi.machinery_pi_pi_date',
                      'mpi.machinery_pi_item'
                    ]) 

                ->where('mpi.machinery_pi_pi_no',$request->p_no)
                ->first();

        return response()->json(['pidate'   => $pi_no->machinery_pi_pi_date,
                                 'item'     => $pi_no->machinery_pi_item,
                             ]);
    } 




/// Import Machinery Data Store

  public function machineryDataStore(Request $request){ 

     
      #------------------------------------------------# 

        $validator= Validator::make($request->all(),[
                'importcode'            =>'required|max:45'
        ]);
       
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{


        $impdata = DB::table('com_import_data_entry_machinery')

                    ->where('machinery_pi_fileno', $request->file_no)
                    ->where('imp_data_machinery_item', $request->item)
                    ->where('hr_unit_id', $request->unit)
                    ->where('imp_data_machinery_master_lc_no', $request->ilcno)
                    ->where('sup_id', $request->supplier)
                    ->first(); 


    if(empty($impdata)){

// Store Import Data Import Table    
          $newimp= new MachineryImportData();

          $newimp->imp_data_machinery_import_code    = $request->importcode;
          $newimp->bank_id                           = $request->bank;
          $newimp->imp_data_machinery_tarnsp_doc1    = $request->tr_doc1;
          $newimp->imp_data_entry_transp_doc_date    = $request->tr_doc_date;
          $newimp->import_data_machinery_transp_doc2 = $request->tr_doc2;
          $newimp->imp_data_entry_shipmode           = $request->ship;
          $newimp->imp_data_machinery_weight         = $request->weight;
          $import_data_machinery_cub_measure         = $request->Cubic_measurement;
          $newimp->cnt_id                            = $request->country;
          $newimp->imp_data_machinery_carrier        = $request->carrier;
          $newimp->import_data_machinery_ship_comp   = $request->ship_com;
          $newimp->imp_data_machinery_container1     = $request->container1;
          $newimp->imp_data_machinery_containe2      = $request->container2;
          $newimp->imp_data_machinery_containe3      = $request->container3;
          $newimp->imp_data_machinery_package        = $request->package;
          $newimp->imp_data_machinery_value          = $request->value;
       
          $newimp->imp_data_machinery_currency       = $request->currency;
          $newimp->port_id                           = $request->port_loading;
          $newimp->import_data_machinery_doc_type    = $request->doc_type;
          $newimp->imp_data_machinery_doc_recv_date  = $request->docdate;

          $newimp->import_data_machinery_quantity    = $request->quantity;
        
          $newimp->imp_data_machinery_container_size = $request->container_size;
          $newimp->vess_id                           = $request->mother_vessel;
          $newimp->voyage_id                         = $request->voyage_no;
          $newimp->machinery_pi_fileno               = $request->file_no;
          $newimp->imp_data_machinery_item           = $request->item;
          $newimp->hr_unit_id                        = $request->unit;
          $newimp->imp_data_machinery_master_lc_no   = $request->ilcno;
          $newimp->sup_id                            = $request->supplier;
          $newimp->pi_order_id                       = $request->pi_id;
          $newimp->unit_id                           = auth()->user()->unit_id();
          $newimp->save();

         $last_id = $newimp->id;

    // Store History Data Import History Table    
         $newimphis= new MachineryImportDataHistory();

          $newimphis->imp_data_machinery_id          = $last_id;
          $newimphis->imp_data_machn_history_desc    = $last_id;
          $newimphis->created_by                     = auth()->user()->unit_id();
          $newimphis->save();

    // Store Invoice Data Import Invoice Table    
     
       for($i=0; $i<sizeof($request->rowno); $i++)
          { $newinv= new MachineryImportDataInvoice();
             $newinv->imp_data_machinery_id           = $last_id;
             $newinv->imp_data_machinery_inv_no       = $request->invoiceno[$i];
             $newinv->imp_data_machinery_inv_date     = $request->invoicedate[$i];
             $newinv->imp_data_machinery_inv_pi       = $request->pi_no[$i];
             $newinv->machinery_pi_item               = $request->itemlist[$i];
             $newinv->imp_data_machinery_inv_value    = $request->inv_value[$i];
             $newinv->machinery_pi_id                 = $request->pi_id;

            $newinv->save();
            
            #*---------------------------------------
        }

         return back()
            ->with('success', "Import Data Information Successfully Added!!!");
         } 

   else   {      return back()
            ->with('error', "Import Data Information Already Exists!!!");
          }    

     } 

  } 


///import Data Info Edit   
    public function MachinaryDataEdit($file,$itemno,$unit,$ilc,$suppl,$pi_id,$id)
    {
      //$pi_type = (object)array();
       $port = Port::pluck('port_name','port_id');
       $bank  = CommBank::pluck('bank_name','bank_id'); 
       $country= Country::pluck('cnt_name','cnt_id');
       $vessel= Vessel::pluck('vess_name','vess_id');
       $voyage= VesselVoyage::pluck('voyage_no','voyage_id');
      
       $item=$itemno;
       $fileno=$file;
       $unitno=$unit;
       $ilcno=$ilc;
       $supplid=$suppl;
       $pid=$pi_id;

      
     $machine=MachineryImportData::where('imp_data_machinery_id', $id)->first();
     $machine_invoice=MachineryImportDataInvoice::where('imp_data_machinery_id', $id)->get(); 
  
     $sppplier = Supplier::where('sup_id',$supplid)
                ->first();
     $unit = Unit::where('hr_unit_id',$unitno)
                ->first();
     $pino = MachineryPI::where('machinery_pi_fileno',$fileno)
                ->get();

  return view('commercial.import.machinery.import_machinery_entry_edit', compact('port','vessel','bank','country','impdata','item','fileno','unit','ilcno','sppplier','pino','pid','supplid','machine','machine_invoice'));
    }
/// Import Machinery Data Store

  public function machineryDataUpdate(Request $request){ 

          
      #------------------------------------------------# 

        $validator= Validator::make($request->all(),[
                'importcode'            =>'required|max:45'
        ]);
       
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

      MachineryImportData::where('imp_data_machinery_id', $request->m_import_id)->update([
          'imp_data_machinery_import_code'    => $request->importcode,
          'bank_id'                           => $request->bank,
          'imp_data_machinery_tarnsp_doc1'    => $request->tr_doc1,
          'imp_data_entry_transp_doc_date'    => $request->tr_doc_date,
          'import_data_machinery_transp_doc2' => $request->tr_doc2,
          'imp_data_entry_shipmode'           => $request->ship,
          'imp_data_machinery_weight'         => $request->weight,
          'import_data_machinery_cub_measure' => $request->Cubic_measurement,
          'cnt_id'                            => $request->country,
          'imp_data_machinery_carrier'        => $request->carrier,
          'import_data_machinery_ship_comp'   => $request->ship_com,
          'imp_data_machinery_container1'     => $request->container1,
          'imp_data_machinery_containe2'      => $request->container2,
          'imp_data_machinery_containe3'      => $request->container3,
          'imp_data_machinery_package'        => $request->package,
          'imp_data_machinery_value'          => $request->value,
          'imp_data_machinery_currency'       => $request->currency,
          'port_id'                           => $request->port_loading,
          'import_data_machinery_doc_type'    => $request->doc_type,
          'imp_data_machinery_doc_recv_date'  => $request->docdate,
          'import_data_machinery_quantity'    => $request->quantity,
          'imp_data_machinery_container_size' => $request->container_size,
          'vess_id'                           => $request->mother_vessel,
          'voyage_id'                         => $request->voyage_no,
          'machinery_pi_fileno'               => $request->file_no,
          'imp_data_machinery_item'           => $request->item,
          'hr_unit_id'                        => $request->unit,
          'imp_data_machinery_master_lc_no'   => $request->ilcno,
          'sup_id'                            => $request->supplier,
          'pi_order_id'                       => $request->pi_id
        ]);

// Delete Invoice Data Import Invoice Table       

       MachineryImportDataInvoice::where('imp_data_machinery_id', $request->m_import_id)->delete();

    // Store Invoice Data Import Invoice Table    
     
       for($i=0; $i<sizeof($request->rowno); $i++)
          { $newinv= new MachineryImportDataInvoice();
             $newinv->imp_data_machinery_id           = 1;
             $newinv->imp_data_machinery_inv_no       = $request->invoiceno[$i];
             $newinv->imp_data_machinery_inv_date     = $request->invoicedate[$i];
             $newinv->imp_data_machinery_inv_pi       = $request->pi_no[$i];
             $newinv->machinery_pi_item               = $request->itemlist[$i];
             $newinv->imp_data_machinery_inv_value    = $request->inv_value[$i];
             $newinv->machinery_pi_id                 = $request->pi_id;

            $newinv->save();
            
            #*---------------------------------------
        }

         return back()
            ->with('success', "Import Data Information Successfully Updated!!!");
    


     } 

  } 


/// Import  Auto Code Generator
    public function autocode(Request $request)
    {
      $data = (new ShortCodeLib)::generate([
        'table'            => 'com_import_data_entry_machinery',  
        'column_primary'   => 'imp_data_machinery_id',  
        'column_shortcode' => 'imp_data_machinery_import_code',  
        'first_letter'     => $request->s_id,        
        'second_letter'    => $request->pi_no,                
        ]);

      return $data;
    } 

    
}
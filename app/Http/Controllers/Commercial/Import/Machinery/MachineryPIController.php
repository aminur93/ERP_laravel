<?php
namespace App\Http\Controllers\Commercial\Import\Machinery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\hr\Unit;
use App\Models\Merch\Supplier;
use App\Models\Commercial\MachineType;
use App\Models\Commercial\MachineManufacturer;
use App\Models\Commercial\MachineryPI;
use App\Models\Commercial\MachineryPIOrder;
use App\Models\Commercial\MachineryPIHistory;
use App\Models\Commercial\InsuranceCompany;
use Validator, DB, ACL, Auth, DataTables;

class MachineryPIController extends Controller
{
///Machinary PI Entry 	
    public function showForm()
    {
       //$pi_type = (object)array();
       $unit = Unit::pluck('hr_unit_name','hr_unit_id');
       $supplier = Supplier::pluck('sup_name','sup_id');
       $mcn_type = MachineType::pluck('machine_type_name','machine_type_id');
       $manuf= MachineManufacturer::pluck('manf_name','manf_id');
       $insurance= InsuranceCompany::pluck('insurance_comp_name','insurance_comp_code');

    return view('commercial.import.machinery.machinery_pi_entry', compact('unit','supplier','mcn_type','manuf','insurance'));
    }

///Machinary PI Entry  Store
    public function machineryPiStore(Request $request)
    {
        #-----------------------------------------------#
          
          $validator= Validator::make($request->all(),[
             'pi_fileno'            =>'required|max:45',
             'unit_id'              =>'required',
             'pi_item'              =>'required|max:45',
             'pi_pi_no'             =>'required|max:45',
             'pi_pi_date'           =>'required',
             'com_sup_id'           =>'required',
             'pi_sup_code'          =>'required|max:45',
             'pi_active'            =>'required|max:45',
             'pi_lc_status'         =>'required|max:45',
             'pi_description'       =>'required|max:45',
             'pi_model_no'          =>'required|max:45',
             'machine_type'         =>'required|max:11',
             'manf_id'              =>'required|max:11',
             'marine_insurance_no'  =>'max:11',
             'insurance_comp'       =>'max:11',
             'pi_quantity'          =>'required|max:45',
             'pi_unit_price'        =>'required|max:45',
             'pi_pi_amount'         =>'required|max:45',
             'currency'             =>'required|max:45',
             'pi_pi_lastdate'       =>'required',
             'pi_remarks'           =>'max:45'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
  
            $data= new MachineryPI();
            $data->machinery_pi_fileno     = $request->pi_fileno;
            $data->hr_unit_id              = $request->unit_id;
            $data->machinery_pi_item    = $request->pi_item;
            $data->machinery_pi_pi_no   = $request->pi_pi_no;
            $data->machinery_pi_pi_date           = $request->pi_pi_date;
            $data->sup_id       = $request->com_sup_id;
            $data->machinery_pi_sup_code     = $request->pi_sup_code;
            $data->machinery_pi_active_status   = $request->pi_active;
            $data->machinery_pi_lc_status = $request->pi_lc_status;
            $data->machinery_pi_description = $request->pi_description;
            $data->machinery_pi_model_no = $request->pi_model_no;
            $data->machine_type_id = $request->machine_type;
            $data->manf_id = $request->manf_id;
            $data->machinery_pi_marine_insurance_no = $request->marine_insurance_no;
            $data->machinery_pi_marine_insurance_date = $request->insurance_date;
            $data->insurance_comp_id = $request->insurance_comp;
            $data->machinery_pi_quantity = $request->pi_quantity;
            $data->machinery_pi_unit_price = $request->pi_unit_price;
            $data->machinery_pi_pi_amount = $request->pi_pi_amount;
            $data->machinery_pi_amount_unit = $request->currency;
            $data->machinery_pi_pi_lastdate = $request->pi_pi_lastdate;
            $data->machinery_pi_remarks = $request->pi_remarks;
            $data->unit_id =auth()->user()->unit_id();

            $data->save();

            $last_id = $data->id;

           
            for($i=0; $i<sizeof($request->order_id); $i++)
                {
                   
                MachineryPIOrder::insert([
                 'machinery_pi_id'  => $last_id,
                 'order_id'         => $request->order_id[$i]

                    ]);
                 }

           MachineryPIHistory::insert([
             'machinery_pi_id'              => $last_id,
             'machinery_pi_history_userid'  => auth()->user()->associate_id

            ]);    
           

            return back()
            ->with('success', "Machinery PI Successfully added!!");
           } 

        }
/// Supllier Auto Code Generator
    public function autocode(Request $request)
    {
      $data = (new ShortCodeLib)::generate([
        'table'            => 'com_machinery_pi',  
        'column_primary'   => 'machinery_pi_id',  
        'column_shortcode' => 'machinery_pi_sup_code',  
        'first_letter'     => $request->s_id,        
        'second_letter'    => $request->pi_no,                
        ]);

      return $data;
    }

///----Machinery Pi List----------/
    public function machineryPiList(){
        
    #----------------------------#

     //$pi_type = (object)array();
       $unit = Unit::pluck('hr_unit_name','hr_unit_id');
       $supplier = Supplier::pluck('sup_name','sup_id');
       $mcn_type = MachineType::pluck('machine_type_name','machine_type_id');
       $manuf= MachineManufacturer::pluck('manf_name','manf_id');
       $insurance= InsuranceCompany::pluck('insurance_comp_name','insurance_comp_code');

      return view('commercial.import.machinery.machinery_pi_list', compact('unit','supplier','mcn_type','manuf','insurance'));
  }  

   public function machineryPiListData(){
     
        #-------------------------------# 
         $data=  DB::table('com_machinery_pi AS mp')
                    ->select([
                      'mp.*',
                      'hu.hr_unit_name',
                      'ms.sup_name',
                      'mt.machine_type_name',
                      'mf.manf_name'
                    ])  

                    ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'mp.hr_unit_id')                
                    ->leftJoin("mr_supplier AS ms", 'ms.sup_id', 'mp.sup_id') 
                    ->leftJoin("com_machine_type AS mt", 'mt.machine_type_id', 'mp.machine_type_id') 
                    ->leftJoin("com_machine_manufacturer AS mf", 'mf.manf_id', 'mp.manf_id')
                    ->get();  
          
       

              return DataTables::of($data)


        /// Query for Action 
            ->editColumn('action', function ($data) {

            
                  $btn = "  
                    <a href=".url('comm/import/machinery/machinerypiedit/'.$data->machinery_pi_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-pencil\"></i>
                        </a> 
                    </div>
                
                    <a href=".url('comm/import/machinery/machinerypidelete/'.$data->machinery_pi_id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"delete\" onclick=\"return confirm('Are you sure you want to delete?');\">
                        <i class=\"fa fa-trash\"></i>
                        </a>  ";
              

                return $btn;
              })  
            ->rawColumns(['action'])
            ->toJson();
            
    }

}

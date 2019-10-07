<?php
namespace App\Http\Controllers\Commercial\Import\Machinery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\hr\Unit;
use App\Models\Merch\Supplier;
use App\Models\Commercial\MachineManufacturer;
use App\Models\Commercial\MachineryPI;
use App\Models\Commercial\Section; 
use App\Models\Commercial\MachineryMaster; 
use Validator, DB, ACL, Auth, DataTables;

class MachineryMasterInfoController extends Controller
{
///Machinary Master Info Entry 	
    public function showForm()
    {
       //$pi_type = (object)array();
       $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
       $supplier = Supplier::pluck('sup_name','sup_id');
       $manuf= MachineManufacturer::pluck('manf_name','manf_id');
       $section = Section::pluck('section_name','section_id');
       $unit = Unit::pluck('hr_unit_name','hr_unit_id');

    return view('commercial.import.machinery.machinery_master', compact('file_no','supplier','manuf','section','unit'));
    }

///Machinary Master Information Store
    public function machineryMasterStore(Request $request)
    {
        #-----------------------------------------------#
          
          $validator= Validator::make($request->all(),[
             'file_no'            =>'required|max:45',
             'lcno'              =>'required|max:45',
             'lcdate'             =>'required|max:45',
             'section'           =>'required'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
  
            $data= new MachineryMaster();
            $data->machinery_pi_id                = $request->file_no;
            $data->machinery_master_info_lc_no    = $request->lcno;
            $data->machinery_master_info_lc_date  = $request->lcdate;
            $data->section_id   = $request->section;
            $data->unit_id      = auth()->user()->unit_id();
            $data->save();


            $last_id = $data->id;

            return back()
            ->with('success', "Machinery Master Information Successfully added!!");
           } 

        }
///-Ajax call for value set input field based on File No.dropdown

   public function supplierInfo(Request $request){
    $file=$request->fileno;
      $data=  DB::table('com_machinery_pi AS mp')
                    ->select([
                      'mp.*',
                      'ms.sup_name',
                
                    ])  
                    ->leftJoin("mr_supplier AS ms", 'ms.sup_id', 'mp.sup_id') 
                    ->where('mp.machinery_pi_fileno', $file)
                    ->first();  

                return($data->sup_name);
                        
             
    }
   public function unitInfo(Request $request){
    $file=$request->fileno;
   
      $data=  DB::table('com_machinery_pi AS mp')
                    ->select([
                      'mp.*',
                      'hu.hr_unit_name'
                  ])

                    ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'mp.hr_unit_id')
                    ->where('mp.machinery_pi_fileno', $file)
                    ->first();  


                    return($data->hr_unit_name);
                        
             
    }
   public function manfInfo(Request $request){
    $file=$request->fileno;
      $data=  DB::table('com_machinery_pi AS mp')
                         ->select([
                      'mp.*',
                      'mf.manf_name'
                
                    ])

                    ->leftJoin("com_machine_manufacturer AS mf", 'mf.manf_id', 'mp.manf_id')
                    ->where('mp.machinery_pi_fileno', $file)
                    ->first(); 
                return($data->manf_name);
                        
             
    }
///----Machinery Master List----------/
    public function machineryMasterList(){
        
    #----------------------------#

     //$pi_type = (object)array();
      

       $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
       $supplier = Supplier::pluck('sup_name','sup_id');
       $manuf= MachineManufacturer::pluck('manf_name','manf_id');
       $section = Section::pluck('section_name','section_id');
       $unit = Unit::pluck('hr_unit_name','hr_unit_id');

      return view('commercial.import.machinery.machinery_master_list', compact('file_no','unit','supplier','manuf','section'));
  }  

   public function machineryMasterListData(){
     
        #-------------------------------# 
         $data=  DB::table('com_machinery_master_info AS mpi')
                    ->select([
                      'mpi.*',
                      'mp.*',
                      'hu.hr_unit_name',
                      'ms.sup_name',
                      'se.section_name',
                      'mf.manf_name'
                    ])  
                    ->leftJoin("com_machinery_pi AS mp", 'mp.machinery_pi_id', 'mpi.machinery_pi_id')
                    ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'mp.hr_unit_id')                
                    ->leftJoin("mr_supplier AS ms", 'ms.sup_id', 'mp.sup_id') 
                    ->leftJoin("com_section AS se", 'se.section_id', 'mpi.section_id') 

                    ->leftJoin("com_machine_manufacturer AS mf", 'mf.manf_id', 'mp.manf_id')
                    ->get();  
          
       

              return DataTables::of($data)


        /// Query for Action 
            ->editColumn('action', function ($data) {
                $btn = "  
                    <a href=".url('comm/import/machinery/machinerymaster_infoedit/'.$data->machinery_master_info_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-pencil\"></i>
                        </a> 
                    </div>
                
                    <a href=".url('comm/import/machinery/machinerymaster_info_delete/'.$data->machinery_master_info_id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"delete\" onclick=\"return confirm('Are you sure you want to delete?');\">
                        <i class=\"fa fa-trash\"></i>
                        </a>  ";
              

                return $btn;
              })  
            ->rawColumns(['action'])
            ->toJson();
            
    }
/// Time action  Delete

    public function timeactionDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #----------------------------------# 

        ProductSize::where('prdsz_id', $id)->delete();
    
        return back()
        ->with('success', " Deleted Successfully!!");
    }
    
/// Machinery Master Info Update
    public function machineryMasterInfoEdit($id){

     #------------------------------------------------------# 

       $file_no = MachineryPI::pluck('machinery_pi_fileno','machinery_pi_fileno');
       $supplier = Supplier::pluck('sup_name','sup_id');
       $manuf= MachineManufacturer::pluck('manf_name','manf_id');
       $section = Section::pluck('section_name','section_id');
       $unit = Unit::pluck('hr_unit_name','hr_unit_id');


        $data=  DB::table('com_machinery_master_info AS mpi')
                    ->select([
                      'mpi.*',
                      'mp.*',
                      'hu.hr_unit_name',
                      'ms.sup_name',
                      'se.section_name',
                      'mf.manf_name'
                    ])  
                    ->leftJoin("com_machinery_pi AS mp", 'mp.machinery_pi_id', 'mpi.machinery_pi_id')
                    ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'mp.hr_unit_id')                
                    ->leftJoin("mr_supplier AS ms", 'ms.sup_id', 'mp.sup_id') 
                    ->leftJoin("com_section AS se", 'se.section_id', 'mpi.section_id') 

                    ->leftJoin("com_machine_manufacturer AS mf", 'mf.manf_id', 'mp.manf_id')
                    ->where('machinery_master_info_id', $id)
                    ->first();  
          

        return view('commercial.import.machinery.machinery_master_update', compact('data','file_no','supplier','manuf','section','unit'));
  }

  public function machineryMasterInfoUpdate(Request $request){ 

     
      #------------------------------------------------# 

        $validator= Validator::make($request->all(),[
             'file_no'            =>'required|max:45',
             'lcno'              =>'required|max:45',
             'lcdate'             =>'required|max:45',
             'section'           =>'required'
        ]);
       
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        $color = MachineryMaster::where('machinery_master_info_id', $request->master_id)->update([
               'machinery_pi_id'                 => $request->file_no,
               'machinery_master_info_lc_no'     => $request->lcno,
               'machinery_master_info_lc_date'   => $request->lcdate,
               'section_id'                      => $request->section

           ]);

        return back()
                ->with('success', "Machinery Master Information Successfully updated!!!");
      } 

  } 
/// Machinery Master Info Delete

    public function machineryMasterInfoDelete($id){
        
        #----------------------------------# 

        MachineryMaster::where('machinery_master_info_id', $id)->delete();
    
        return back()
        ->with('success', " Deleted Successfully!!");
    }
    
}

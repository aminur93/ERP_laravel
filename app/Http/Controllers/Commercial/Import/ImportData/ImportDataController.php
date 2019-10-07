<?php
namespace App\Http\Controllers\Commercial\Import\ImportData;

//use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\CmFile;
use App\Models\Commercial\CmPiBom;
use App\Models\Commercial\CmPiMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
use App\Models\Merch\Supplier;
use App\Models\Commercial\Port;
use App\Models\Commercial\Item;
use App\Models\Commercial\CommBank;
use App\Models\Commercial\ImportDataEntry;
use App\Models\Commercial\Vessel;
use App\Models\Commercial\VesselVoyage;
use App\Models\Commercial\ImportInvoice;
use App\Models\Commercial\fabPocket;
use App\Models\Commercial\ImportInvFabric;
use App\Models\Commercial\ImportDataHistory;
use App\Models\Hr\Unit;
use App\Models\Merch\Country;

use Validator, DB, ACL, Auth, DataTables;

class ImportDataController extends Controller
{

///----Imort Data List----------/
    public function importDataLlist(){

        #----------------------------#

        //$pi_type = (object)array();


        $bank  = CommBank::pluck('bank_name','bank_id');
        $supplier = Supplier::pluck('sup_name','sup_id');
        $unit = Unit::pluck('hr_unit_name','hr_unit_id');


        return view('commercial.import.importdata.import_data_list', compact('supplier','unit','bank'));
    }

    public function importLlistData(Request $request){

        $id = $request->id;
        #-------------------------------#
        $data=  DB::table('com_exp_lc_entry AS el')
            ->select([
                'el.bank_id',
                'el.exp_lc_fileno',
                'b2b.b2b_item',
                'b2b.b2b_lc_no',
                'b2b.b2b_lc_sup_code',
                'b2b.sup_id',
                'fb.pi_entry_id',
                'fb.master_pi_fab_sup_code',
                'acs.pi_entry_id',
                'acs.master_pi_acss_sup_code',
                'sup.sup_id',
                'sup.sup_name',
                'po.pi_entry_id',
                'po.order_id',
                'oe.res_id',
                'cr.hr_unit_id',
                'hu.hr_unit_id',
                'hu.hr_unit_name'
            ])

            ->leftJoin("com_b2b_entry AS b2b", 'b2b.exp_lc_fileno', 'el.exp_lc_fileno')

            ->leftJoin("com_master_pi_fabric AS fb", 'fb.exp_lc_fileno', 'b2b.exp_lc_fileno')

            ->leftJoin("com_master_pi_accessories AS acs", 'acs.exp_lc_fileno', 'b2b.exp_lc_fileno')

            ->leftJoin("mr_supplier AS sup", 'sup.sup_id', 'b2b.sup_id')

            ->leftJoin("mr_pi_order AS po", 'po.pi_entry_id', 'acs.pi_entry_id')

            ->leftJoin("mr_order_entry AS oe", 'oe.order_id', 'po.order_id')

            ->leftJoin("mr_capacity_reservation AS cr", 'cr.res_id', 'oe.res_id')

            ->leftJoin("hr_unit AS hu", 'hu.hr_unit_id', 'cr.hr_unit_id')
            ->where(function($condition) use ($id){
                if (!empty($id))
                {
                    $condition->where('el.bank_id', $id);
                }
            })
            ->whereNotNull('el.exp_lc_fileno')
            ->whereNotNull('b2b_item')
            ->whereNotNull('hr_unit_name')
            ->whereNotNull('b2b_lc_no')
            ->whereNotNull('sup_name')
            ->get();



        return DataTables::of($data)

            /// item Column
            ->editColumn('item', function ($data) {
                if ($data->b2b_item==null ){ $item="";}
                if ($data->b2b_item==1 ){ $item="Fabric";}
                if ($data->b2b_item==2 ){ $item="Accessories";}
                if ($data->b2b_item==3 ){ $item="Fabric+Accessories";}

                return $item;
            })

            /// Query for Action

            ->editColumn('action', function ($data) {
                $btn = "<a href=".url('comm/import/importdata/importdata/'.$data->exp_lc_fileno.'/'.$data->b2b_item.'/'.$data->hr_unit_id.'/'.$data->b2b_lc_no.'/'.$data->sup_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"fa fa-plus\"></i>
                        </a>
                    </div>

                   ";

                return $btn;

            })
            ->rawColumns(['action','item'])
            ->toJson();

    }
    ///import Data Info Entry

    public function importDataEntry(Request $request)
    {
        //$pi_type = (object)array();
        $newimp = ImportDataEntry::all();

        $port = Port::pluck('port_name','cnt_id'); //change port_id to cnt_id

        $bank  = CommBank::pluck('bank_name','id'); //change bank_id to short_code

        $country= Country::pluck('cnt_name','cnt_id');

        $vessel= Vessel::pluck('vessel_name','id'); //vessel table is not nay vaessel_id

        $voyage= VesselVoyage::pluck('voyage_name','cm_vessel_id'); //chnage voyage_id to cm_vessel_id

        $colorcode  = DB::table('mr_material_color')->pluck('clr_code','clr_id');

        $colorname  = DB::table('mr_material_color')->pluck('clr_name','clr_id');


        $cm_pi = CmPiMaster::all();

        $cm_file = DB::table('cm_pi_master')
            ->join('cm_file','cm_pi_master.cm_file_id','=','cm_file.id')
            ->pluck('cm_file.file_no','cm_file.id');

        $cm_supplier = DB::table('cm_pi_master')
            ->join('mr_supplier','cm_pi_master.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->pluck('mr_supplier.sup_name','mr_supplier.sup_id');

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();


        return view('commercial.import.importdata.import_data_entry', compact('port','vessel','bank','country',
            'impdata','cm_supplier','cm_pi','cm_file',
            'cm_bom','voyage','colorcode','colorname','mr_category','newimp','mr_color','mr_art','mr_comp','mr_const'));
    }

# Return Voyage List by Mother Vessel
    public function vesselVoyage(Request $request)
    {

        $select = $request->get('select');

        $value = $request->get('value');

        $dependent = $request->get('dependent');

        $data = DB::table('cm_voyage_vessel')->where($select, $value)->groupBy($dependent)->get();

        $output = '<option value="">Select '.ucfirst($dependent).'</option>';

        foreach ($data as $row) {
            $output .='<option value="'.$row->cm_vessel_id.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
# Return Pi Date List by PI No.
    public function piDate(Request $request)
    {
        // dd($request->pi_no);

        $pi_no = DB::table('cm_pi_master AS mpi')
            ->select([
                'mpi.pi_date'
            ])

            ->where('mpi.id',$request->pi_no)
            ->first();
        echo $pi_no->pi_date;exit;
    }
/// Import Data Store
    public function importDataStore(Request $request){
//      echo "<pre>"; print_r($request->all());exit;
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

            if(empty($impdata)){

                // Store Import Data Import Table
                $newimp= new ImportDataEntry();

                $newimp->imp_code = $request->importcode;
                $newimp->cm_file_id = $request->file_no;
                $newimp->mr_supplier_sup_id = $request->supplier;
                $newimp->cm_btb_id = $request->ilcno;
                $newimp->hr_unit = $request->unit;
                $newimp->cm_bank_id = $request->bank;
                $newimp->imp_lc_type = $request->impdatatype;
                $newimp->transp_doc_no1 = $request->tr_doc1;
                $newimp->transp_doc_date = $request->tr_doc_date;
                $newimp->transp_doc_no2  = $request->tr_doc2;
                $newimp->ship_mode  = $request->ship;
                $newimp->weight   = $request->weight;
                $newimp->imp_lc_type  = $request->impdatatype;
                $newimp->cnt_id  = $request->country;
                $newimp->carrier = $request->carrier;
                // $newimp->freight = $request->freight;
                $newimp->ship_company = $request->ship_com;
                $newimp->container_1   = $request->container1;
                $newimp->container_2  = $request->container2;
                $newimp->container_3   = $request->container3;
                $newimp->package     = $request->package;
                $newimp->doc_type    = $request->doc_type;
                $newimp->doc_recv_date = $request->docdate;
                $newimp->qty           = $request->quantity;
                $newimp->value         = $request->value;
                $newimp->value_currency = $request->currency;
                $newimp->cm_port_id     = $request->port_loading;
                $newimp->container_size = $request->container_size;
                $newimp->cm_vessel_id   = $request->mother_vessel;
                $newimp->cm_voyage_vessel_id = $request->voyage_no;
                $newimp->cubic_measurement = $request->cubic_measurement;
                $newimp->save();

                $last_id = $newimp->id;

                // Store Invoice Data Import Invoice Table
                for($i=0; $i<sizeof($request->rowno); $i++)
                {
                    $newIn = DB::table('cm_imp_invoice')->insertGetId([
                        'cm_imp_data_entry_id' => $last_id,
                        'invoice_no' => $request->invoiceno[$i],
                        'invoice_date' => $request->invoicedate[$i]
                    ]);

                    $last_inv_id = $newIn;

                    $rowno = $request->rowno[$i];

//                    if (sizeof($rowid)>0) {


                    DB::table('cm_invoice_pi_bom')->insert([
                        'cm_imp_invoice_id' => $last_inv_id,
                        'cm_pi_master_id' => $request->cm_pi_master_id[$i],
                        'cm_pi_bom_id' => $request->id[$i],
                        'shipped_qty' => $request->shipped_qty[$i]
                    ]);


//                    }
                }

                return back()->with('success', "Import Data Information Successfully Added!!!");
            }

            else   {
                return back()->with('error', "Import Data Information Already Exists!!!");
            }

        }

    }
/// Import  Auto Code Generator
    public function autocode(Request $request)
    {
        $length=8;
        $randstr = "";
        srand((double)microtime() * 1000000);
        //our array add all letters and numbers if you wish
        $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        for ($rand = 1; $rand <= $length; $rand++) {
            $random = rand(0, count($chars) - 1);
            $randstr .= $chars[$random];
        }
        echo $randstr.'/'.date('y');exit;
    }
    //pi select wise table
    public function piTable(Request $id)
    {
        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $pi = DB::table('cm_pi_bom')->where('cm_pi_master_id',$id->pi_master_id)->get();

        return view('commercial.import.importdata.mcat',
        compact('pi','mr_category','mr_color','mr_art','mr_comp','mr_const'));
    }

    public function editTable(Request $id)
    {
        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $pi = DB::table('cm_pi_bom')
                ->join('mr_material_category','cm_pi_bom.mr_material_category_mcat_id','=','mr_material_category.mcat_id')
                ->join('cm_invoice_pi_bom','cm_pi_bom.id','=','cm_invoice_pi_bom.cm_pi_bom_id')
                 ->where('cm_pi_bom.cm_pi_master_id',$id->pi_master_id_again)
                 ->get();

        return view('commercial.import.importdata.mcat_edit',
        compact('pi','mr_category','mr_color','mr_art','mr_comp','mr_const'));
    }

    public function fileUnit(Request $request)
    {
        $file_no = DB::table('cm_pi_master')
            ->select('hu.hr_unit_name','cf.hr_unit')
            ->leftJoin('cm_file as cf','cf.id','=','cm_pi_master.cm_file_id')
            ->leftJoin('hr_unit as hu','hu.hr_unit_id','=','cf.hr_unit')
            ->where('cf.id',$request->file_no)
            ->first();
//        dd($file_no);exit;

        echo $file_no->hr_unit;exit;
    }

    public function supplierIlcNo(Request $request)
    {
        $supplier_no = DB::table('cm_pi_master')
            ->join('cm_btb','cm_pi_master.mr_supplier_sup_id','=','cm_btb.mr_supplier_sup_id')
            ->select('cm_btb.lc_no as lc_no')
            ->where('cm_btb.mr_supplier_sup_id',$request->supplier_no)
            ->first();

        echo $supplier_no->lc_no;exit;
    }

    public function view()
    {
       return view('commercial.import.importdata.import_data_list');
    }

    public function getData()
    {
        $imports = DB::table('cm_imp_data_entry as cmpde')
                            ->select(
                                "cmpde.id",
                                "cb.bank_name",
                                "cmpde.imp_lc_type",
                                "cmpde.transp_doc_no1",
                                "cmpde.transp_doc_date",
                                "cmpde.value",
                                "cmpde.qty",
                                "cf.file_no",
                                "hu.hr_unit_name",
                                "cmpde.cm_btb_id",
                                "ms.sup_name"
                            )
            ->leftJoin("cm_bank AS cb", "cb.id", "=",  "cmpde.cm_bank_id")
            ->leftJoin("cm_file As cf", "cf.id","=","cmpde.cm_file_id")
            ->leftJoin("hr_unit As hu", "hu.hr_unit_id","=", "cmpde.hr_unit")
            ->leftJoin("mr_supplier As ms","ms.sup_id","=","cmpde.mr_supplier_sup_id")
            ->where('imp_lc_type','Foreign')
            ->groupBy('cmpde.id')
            ->get();
        //dd($imports);exit;


        return DataTables::of($imports)
            ->addIndexColumn()

            ->editColumn('action', function ($imports) {
                $return = "<div class=\"btn-group\">";
                if (!empty($imports->imp_lc_type))
                {
                    $return .= "<a href=".url('comm/import/importdata/importdataedit/'.$imports->id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\">
                                 <i class=\"ace-icon fa fa-pencil \"></i>
                                  </a>

                                  <a href=".url('comm/import/importdata/importDelete/'.$imports->id.'/delete')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\">
                                        <i class=\"ace-icon fa fa-remove \"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action'
            ])

            ->make(true);
    }

    public function edit(Request $request, $id)
    {

        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            echo "<pre>";print_r($data);exit;

            $this->validate($request,[
                'importcode'            =>'required|max:45'
            ]);

            $import = ImportDataEntry::findOrFail($id);

            $import->imp_code = $data['importcode'];
            $import->cm_file_id = $data['file_no'];
            $import->mr_supplier_sup_id = $data['supplier'];
            $import->cm_btb_id = $data['ilcno'];
            $import->hr_unit = $data['unit'];
            $import->cm_bank_id = $data['bank'];
            $import->imp_lc_type = $data['impdatatype'];
            $import->transp_doc_no1 = $data['tr_doc1'];
            $import->transp_doc_date = $data['tr_doc_date'];
            $import->transp_doc_no2  = $data['tr_doc2'];
            $import->ship_mode  = $data['ship'];
            $import->weight   = $data['weight'];
            $import->imp_lc_type  = $request->impdatatype;
            $import->cnt_id  = $data['country'];
            $import->carrier = $data['carrier'];
            // $import->freight = $data['freight'];
            $import->ship_company = $data['ship_com'];
            $import->container_1   = $data['container1'];
            $import->container_2  = $data['container2'];
            $import->container_3   = $data['container3'];
            $import->package     = $data['package'];
            $import->doc_type    = $data['doc_type'];
            $import->doc_recv_date = $data['docdate'];
            $import->qty           = $data['quantity'];
            $import->value         = $data['value'];
            $import->value_currency = $data['currency'];
            $import->cm_port_id     = $data['port_loading'];
            $import->container_size = $data['container_size'];
            $import->cm_vessel_id   = $data['mother_vessel'];
            $import->cm_voyage_vessel_id = $data['voyage_no'];
            $import->update();

            $last_id = $import->id;

            $cmInvoice = DB::table('cm_imp_invoice')->where('cm_imp_data_entry_id',$id)->get();


            for ($i = 0; $i < sizeof($cmInvoice); $i++)
            {

                 DB::table('cm_imp_invoice')->where('id',$cmInvoice[$i]->id)
                    ->update([
                        'cm_imp_data_entry_id' => $last_id,
                        'invoice_no' => $request->invoiceno[$i],
                        'invoice_date' => $request->invoicedate[$i]
                ]);



                DB::table('cm_invoice_pi_bom')->where('id',$cmInvoice[$i]->id)
                    ->update([
                        'cm_imp_invoice_id' => $cmInvoice[$i]->id,
                        'cm_pi_master_id' => $request->cm_pi_master_id[$i],
                        'cm_pi_bom_id' => $request->id[$i],
                        'shipped_qty' => $request->shipped_qty[$i]

                ]);

            }
            return back()->with('success', "Import Data Information Successfully Updated!!!");

        }

        $import = ImportDataEntry::findOrFail($id);

        $port = Port::all(); //change port_id to cnt_id

        $bank = CommBank::all(); //change bank_id to short_code

        $country= Country::all();

        $vessel= Vessel::all(); //vessel table is not nay vaessel_id

        $voyage= VesselVoyage::all(); //chnage voyage_id to cm_vessel_id

        $colorcode  = DB::table('mr_material_color')->pluck('clr_code','clr_id');

        $colorname  = DB::table('mr_material_color')->pluck('clr_name','clr_id');


        $cm_pi = CmPiMaster::all();

        $cm_file = DB::table('cm_pi_master')
            ->join('cm_file','cm_pi_master.cm_file_id','=','cm_file.id')
            ->select('cm_file.file_no','cm_file.id')
            ->get();

        $cm_supplier = DB::table('cm_pi_master')
            ->join('mr_supplier','cm_pi_master.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->select('mr_supplier.sup_name','mr_supplier.sup_id')
            ->get();

        $cm_invoice = DB::table('cm_imp_data_entry')
            ->join('cm_imp_invoice','cm_imp_data_entry.id','=','cm_imp_invoice.cm_imp_data_entry_id')
            ->select('cm_imp_invoice.invoice_no as invoice_no','cm_imp_invoice.invoice_date as invoice_date')
            ->where('cm_imp_invoice.cm_imp_data_entry_id',$id)
            ->get();

        $cm_pi_invoice = DB::table('cm_imp_data_entry')
            ->join('cm_imp_invoice','cm_imp_data_entry.id','=','cm_imp_invoice.cm_imp_data_entry_id')
            ->join('cm_invoice_pi_bom','cm_imp_invoice.id','=','cm_invoice_pi_bom.cm_imp_invoice_id')
            ->join('cm_pi_master','cm_invoice_pi_bom.cm_pi_master_id','=','cm_pi_master.id')
            ->select('cm_pi_master.pi_no','cm_pi_master.pi_date')
            ->where('cm_imp_invoice.cm_imp_data_entry_id',$id)
            ->get();
//        dd($cm_pi_invoice);exit;

        $cm_pi_master = DB::table('cm_imp_data_entry')
            ->join('cm_imp_invoice','cm_imp_data_entry.id','=','cm_imp_invoice.cm_imp_data_entry_id')
            ->join('cm_invoice_pi_bom','cm_imp_invoice.id','=','cm_invoice_pi_bom.cm_imp_invoice_id')
            ->join('cm_pi_master','cm_invoice_pi_bom.cm_pi_master_id','=','cm_pi_master.pi_no')
            ->join('cm_pi_bom','cm_pi_master.id','=','cm_pi_bom.cm_pi_master_id')
            ->where('cm_imp_invoice.cm_imp_data_entry_id',$id)
            ->get();
//        dd($cm_pi_master);exit;

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();


        return view('commercial.import.importdata.edit_import', compact('import','port','vessel','bank','country',
            'impdata','cm_supplier','cm_pi','cm_file','cm_bom','voyage','colorcode','colorname','mr_category',
            'cm_invoice','cm_pi_invoice','cm_pi_master','mr_color','mr_art','mr_comp','mr_const'));
    }

    public function destroy($id)
    {
        $import = ImportDataEntry::findOrFail($id);



        $ci = DB::table('cm_imp_invoice')->where('cm_imp_data_entry_id',$import->id)->get();


        foreach ($ci as $c)
        {

          $cis = DB::table('cm_invoice_pi_bom')->where('cm_imp_invoice_id',$c->id)->get();

          foreach ($cis as $cs)
          {
              $cs = DB::table('cm_invoice_pi_bom')->where('cm_imp_invoice_id',$cs->id)->delete();
          }
            $c = DB::table('cm_imp_invoice')->where('cm_imp_data_entry_id',$import->id)->delete();
        }

        $import->delete();

        return back()->with('success', "Import Data Information Successfully Deleted!!!");
    }

}

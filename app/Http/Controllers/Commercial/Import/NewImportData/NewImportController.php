<?php

namespace App\Http\Controllers\Commercial\Import\NewImportData;

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

class NewImportController extends Controller
{
    public function index()
    {
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

        return view('commercial.import.NewImportData.new_import_data_entry',
            compact('port','vessel','bank','country',
                'impdata','cm_supplier','cm_pi','cm_file',
                'cm_bom','voyage','colorcode','colorname','mr_category','newimp','mr_color','mr_art','mr_comp','mr_const'));
    }

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

    public function fileUnit(Request $request)
    {
        $file_no = DB::table('cm_pi_master')
            ->select('hu.hr_unit_name','cf.hr_unit')
            ->leftJoin('cm_file as cf','cf.id','=','cm_pi_master.cm_file_id')
            ->leftJoin('hr_unit as hu','hu.hr_unit_id','=','cf.hr_unit')
            ->where('cf.id',$request->file_no)
            ->first();
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

    public function piNo($invoiceId)
    {

        $cm_pi = DB::table('cm_pi_master')->get();

        return view('commercial.import.NewImportData.pi_no',compact('cm_pi','invoiceId'));
    }

    public function piBom(Request $request, $piId)
    {
        //return $piId;

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $pi = DB::table('cm_pi_bom')->where('cm_pi_master_id',$request->pi_master_id)->get();

        return view('commercial.import.NewImportData.pi_bom',
            compact('pi','mr_category','mr_color','mr_art','mr_comp','mr_const','piId'));
    }

    public function piDate(Request $request)
    {
        $pi_no = DB::table('cm_pi_master AS mpi')
            ->select([
                'mpi.pi_date'
            ])

            ->where('mpi.id',$request->pi_no)
            ->first();
        echo $pi_no->pi_date;exit;
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);exit;

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
            $newimp->freight = $request->freight;
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


                DB::table('cm_invoice_pi_bom')->insert([
                    'cm_imp_invoice_id' => $last_inv_id,
                    'cm_pi_master_id' => $request->cm_pi_master_id[$i],
                    'cm_pi_bom_id' => $request->id[$i],
                    'shipped_qty' => $request->shipped_qty[$i]
                ]);


            }

            return back()->with('success', "Import Data Information Successfully Added!!!");

        }
    }
}

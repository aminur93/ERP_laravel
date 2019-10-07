<?php

namespace App\Http\Controllers\Commercial\Import\AssetData;

use App\Models\Commercial\CmImpDataEntryAsset;
use App\Models\Commercial\CmPiMaster;
use App\Models\Commercial\CommBank;
use App\Models\Commercial\Country;
use App\Models\Commercial\Port;
use App\Models\Commercial\Vessel;
use App\Models\Commercial\VesselVoyage;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class AssetController extends Controller
{
    public function index()
    {
        //$pi_type = (object)array();
        $port = Port::pluck('port_name','cnt_id'); //change port_id to cnt_id

        $bank  = CommBank::pluck('bank_name','id'); //change bank_id to short_code

        $country= Country::pluck('cnt_name','cnt_id');

        $vessel= Vessel::pluck('vessel_name','id'); //vessel table is not nay vaessel_id

        $voyage= VesselVoyage::pluck('voyage_name','cm_vessel_id'); //chnage voyage_id to cm_vessel_id

        $colorcode  = DB::table('mr_material_color')->pluck('clr_code','clr_id');

        $colorname  = DB::table('mr_material_color')->pluck('clr_name','clr_id');


        // $cm_pi = DB::table('cm_pi_asset')->get();
        $cm_pi = CmPiMaster::all();

        $cm_file = DB::table('cm_pi_asset')
            ->join('cm_file','cm_pi_asset.cm_file_id','=','cm_file.id')
            ->pluck('cm_file.file_no','cm_file.id');

//        dd($cm_file);exit;

        $cm_supplier = DB::table('cm_pi_asset')
            ->join('mr_supplier','cm_pi_asset.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->pluck('mr_supplier.sup_name','mr_supplier.sup_id');

//        dd($cm_supplier);exit;

        $mr_category = DB::table('mr_material_category')->get();

        $cm_machine = DB::table('cm_machine_type')->get();

        $cm_section = DB::table('cm_section')->get();

        return view('Commercial.import.assetdata.asset_data_entry',
            compact('port','bank','country','vessel','voyage','colorcode','colorname',
                'cm_pi','cm_file','cm_supplier','mr_category','cm_machine','cm_section'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();

//            echo "<pre>"; print_r($data);exit;

            $asset = new CmImpDataEntryAsset();

            $asset->imp_code = $data['importcode'];
            $asset->cm_file_id = $data['file_no'];
            $asset->mr_supplier_sup_id = $data['supplier'];
            $asset->cm_btb_id = $data['ilcno'];
            $asset->hr_unit = $data['unit'];
            $asset->cm_bank_id = $data['bank'];
            $asset->imp_lc_type = $data['impdatatype'];
            $asset->transp_doc_no1 = $data['tr_doc1'];
            $asset->transp_doc_date = $data['tr_doc_date'];
            $asset->transp_doc_no2  = $data['tr_doc2'];
            $asset->ship_mode  = $data['ship'];
            $asset->weight   = $data['weight'];
            $asset->imp_lc_type  = $request->impdatatype;
            $asset->cnt_id  = $data['country'];
            $asset->carrier = $data['carrier'];
            //$asset->freight = $data['freight'];
            $asset->ship_company = $data['ship_com'];
            $asset->container_1   = $data['container1'];
            $asset->container_2  = $data['container2'];
            $asset->container_3   = $data['container3'];
            $asset->package     = $data['package'];
            $asset->doc_type    = $data['doc_type'];
            $asset->doc_recv_date = $data['docdate'];
            $asset->qty           = $data['quantity'];
            $asset->value         = $data['value'];
            $asset->value_currency = $data['currency'];
            $asset->cm_port_id     = $data['port_loading'];
            $asset->container_size = $data['container_size'];
            $asset->cm_vessel_id   = $data['mother_vessel'];
            $asset->cm_voyage_vessel_id = $data['voyage_no'];
            $asset->save();

            $last_id = $asset->id;

            // Store Invoice Data Asset Invoice Table
            for ($i = 0; $i < sizeof($request->rowno); $i++) {
                $newIn = DB::table('cm_imp_invoice_asset')->insertGetId([
                    'cm_imp_data_entry_asset_id' => $last_id,
                    'invoice_no' => $request->invoiceno[$i],
                    'invoice_date' => $request->invoicedate[$i]
                ]);


                $last_inv_id = $newIn;
                #*---------------------------------------

                //Store Invoice pi asset data into table
                DB::table('cm_invoice_pi_asset')->insert([
                    'cm_imp_invoice_asset_id' => $last_inv_id,
                    'cm_pi_asset_id' => $request->cm_pi_asset_id[$i],
                    'cm_pi_asset_description_id' => $request->cm_pi_asset_description_id[$i],
                    'shipped_qty' => $request->shipped_qty[$i]

                ]);
            }
            return back()->with('success', "Asset Data Information Successfully Added!!!");
        }
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
        $file_no = DB::table('cm_pi_asset')
            ->join('hr_unit','cm_pi_asset.hr_unit','=','hr_unit.hr_unit_id')
            ->select('cm_pi_asset.hr_unit')
            ->where('cm_pi_asset.cm_file_id',$request->file_no)
            ->first();
//        dd($file_no);exit;

        echo $file_no->hr_unit;exit;
    }

    public function supplierIlcNo(Request $request)
    {
        $supplier_no = DB::table('cm_pi_asset')
            ->join('cm_btb_asset','cm_pi_asset.mr_supplier_sup_id','=','cm_btb_asset.mr_supplier_sup_id')
            ->select('cm_btb_asset.lc_no as lc_no')
            ->where('cm_btb_asset.mr_supplier_sup_id',$request->supplier_no)
            ->first();

        echo $supplier_no->lc_no;exit;
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

    //pi select wise table
    public function piTable($id)
    {
        $cm_machine = DB::table('cm_machine_type')->get();

        $cm_section = DB::table('cm_section')->get();

        $pi = DB::table('cm_pi_asset_description')->where('cm_pi_asset_id',$id)->get();
        return view('commercial.import.assetdata.amcat',
            compact('pi','cm_machine','cm_section'));
    }

    public function editTable($id)
    {
        $pi = DB::table('cm_pi_asset_description')->where('cm_pi_asset_id',$id)->get();
        echo $pi;exit;
    }

    public function piDate(Request $request)
    {
        // dd($request->pi_no);

        $pi_no = DB::table('cm_pi_master AS mpi')
            ->select([
                'mpi.pi_date'
            ])

            ->where('mpi.pi_no',$request->pi_no)
            ->first();
        echo $pi_no->pi_date;exit;
    }

    public function view()
    {
        return view('Commercial.import.assetdata.asset_data_list');
    }

    public function getData()
    {
        $assets = DB::table('cm_imp_data_entry_asset as cmpde')
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

        return DataTables::of($assets)
            ->addIndexColumn()

            ->editColumn('action', function ($assets) {
                $return = "<div class=\"btn-group\">";
                if (!empty($assets->imp_lc_type))
                {
                    $return .= "<a href=".url('comm/import/asset/assetedit/'.$assets->id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\">
                                 <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                                  </a>

                                  <a href=".url('comm/import/asset/assetDelete/'.$assets->id.'/delete')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\">
                                        <i class=\"ace-icon fa fa-remove bigger-120\"></i>
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

            $asset = new CmImpDataEntryAsset();

            $asset->imp_code = $data['importcode'];
            $asset->cm_file_id = $data['file_no'];
            $asset->mr_supplier_sup_id = $data['supplier'];
            $asset->cm_btb_id = $data['ilcno'];
            $asset->hr_unit = $data['unit'];
            $asset->cm_bank_id = $data['bank'];
            $asset->imp_lc_type = $data['impdatatype'];
            $asset->transp_doc_no1 = $data['tr_doc1'];
            $asset->transp_doc_date = $data['tr_doc_date'];
            $asset->transp_doc_no2  = $data['tr_doc2'];
            $asset->ship_mode  = $data['ship'];
            $asset->weight   = $data['weight'];
            $asset->imp_lc_type  = $request->impdatatype;
            $asset->cnt_id  = $data['country'];
            $asset->carrier = $data['carrier'];
            //$asset->freight = $data['freight'];
            $asset->ship_company = $data['ship_com'];
            $asset->container_1   = $data['container1'];
            $asset->container_2  = $data['container2'];
            $asset->container_3   = $data['container3'];
            $asset->package     = $data['package'];
            $asset->doc_type    = $data['doc_type'];
            $asset->doc_recv_date = $data['docdate'];
            $asset->qty           = $data['quantity'];
            $asset->value         = $data['value'];
            $asset->value_currency = $data['currency'];
            $asset->cm_port_id     = $data['port_loading'];
            $asset->container_size = $data['container_size'];
            $asset->cm_vessel_id   = $data['mother_vessel'];
            $asset->cm_voyage_vessel_id = $data['voyage_no'];
            $asset->update();

            $last_id = $asset->id;

            $cmInvoice = DB::table('cm_imp_invoice_asset')->where('cm_imp_data_entry_asset_id',$id)->get();


            for ($i = 0; $i < sizeof($cmInvoice); $i++)
            {

                DB::table('cm_imp_invoice_asset')->where('id',$cmInvoice[$i]->id)
                    ->update([
                        'cm_imp_data_entry_asset_id' => $last_id,
                        'invoice_no' => $request->invoiceno[$i],
                        'invoice_date' => $request->invoicedate[$i]
                    ]);



                DB::table('cm_invoice_pi_asset')->where('id',$cmInvoice[$i]->id)
                    ->update([
                         'cm_imp_invoice_asset_id' => $cmInvoice[$i]->id,
                        'cm_pi_asset_id' => $request->cm_pi_asset_id[$i],
                        'cm_pi_asset_description_id' => $request->cm_pi_asset_description_id[$i],
                        'shipped_qty' => $request->shipped_qty[$i]

                    ]);

            }
            return back()->with('success', "Asset Data Information Successfully Updated!!!");
        }

        $asset = CmImpDataEntryAsset::findOrFail($id);

        $port = Port::all(); //change port_id to cnt_id

        $bank  = CommBank::all(); //change bank_id to short_code

        $country= Country::all();

        $vessel= Vessel::all(); //vessel table is not nay vaessel_id

        $voyage= VesselVoyage::all(); //chnage voyage_id to cm_vessel_id

        $colorcode  = DB::table('mr_material_color')->pluck('clr_code','clr_id');

        $colorname  = DB::table('mr_material_color')->pluck('clr_name','clr_id');


        $cm_pi = CmPiMaster::all();

        $cm_file = DB::table('cm_pi_asset')
            ->join('cm_file','cm_pi_asset.cm_file_id','=','cm_file.id')
            ->select('cm_file.file_no','cm_file.id')
            ->get();

//        dd($cm_file);exit;

        $cm_supplier = DB::table('cm_pi_asset')
            ->join('mr_supplier','cm_pi_asset.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->select('mr_supplier.sup_name','mr_supplier.sup_id')
            ->get();

//        dd($cm_supplier);exit;

        $cm_invoice = DB::table('cm_imp_data_entry_asset')
            ->join('cm_imp_invoice_asset','cm_imp_data_entry_asset.id','=','cm_imp_invoice_asset.cm_imp_data_entry_asset_id')
            ->select('cm_imp_invoice_asset.invoice_no as invoice_no','cm_imp_invoice_asset.invoice_date as invoice_date')
            ->where('cm_imp_invoice_asset.cm_imp_data_entry_asset_id',$id)
            ->get();

        $cm_pi_invoice = DB::table('cm_imp_data_entry_asset')
            ->leftJoin('cm_imp_invoice_asset','cm_imp_data_entry_asset.id','=','cm_imp_invoice_asset.cm_imp_data_entry_asset_id')
            ->leftJoin('cm_invoice_pi_asset','cm_imp_invoice_asset.id','=','cm_invoice_pi_asset.cm_imp_invoice_asset_id')
            ->leftJoin('cm_pi_asset','cm_invoice_pi_asset.cm_pi_asset_id','=','cm_pi_asset.pi_no')
            ->select('cm_pi_asset.pi_no','cm_pi_asset.pi_date')
            ->where('cm_imp_invoice_asset.cm_imp_data_entry_asset_id',$id)
            ->get();
//        dd($cm_pi_invoice);exit;

        $cm_pi_asset = DB::table('cm_imp_data_entry_asset')
            ->join('cm_imp_invoice_asset','cm_imp_data_entry_asset.id','=','cm_imp_invoice_asset.cm_imp_data_entry_asset_id')
            ->join('cm_invoice_pi_asset','cm_imp_invoice_asset.id','=','cm_invoice_pi_asset.cm_imp_invoice_asset_id')
            ->join('cm_pi_asset','cm_invoice_pi_asset.cm_pi_asset_id','=','cm_pi_asset.pi_no')
            ->join('cm_pi_asset_description','cm_pi_asset.id','=','cm_pi_asset_description.cm_pi_asset_id')
            ->where('cm_imp_invoice_asset.cm_imp_data_entry_asset_id',$id)
            ->get();
//        dd($cm_pi_master);exit;

        $mr_category = DB::table('mr_material_category')->get();

        $cm_machine = DB::table('cm_machine_type')->get();

        $cm_section = DB::table('cm_section')->get();

        return view('Commercial.import.assetdata.edit_asset',
            compact('asset','port','bank','country','vessel','voyage','colorcode','colorname','cm_pi',
                'cm_file','cm_supplier','mr_category','cm_invoice','cm_pi_invoice','cm_pi_asset','cm_machine','cm_section'));
    }

    public function destroy($id)
    {
        $asset = CmImpDataEntryAsset::findOrFail($id);



        $ci = DB::table('cm_imp_invoice_asset')->where('cm_imp_data_entry_asset_id',$asset->id)->get();


        foreach ($ci as $c)
        {

            $cis = DB::table('cm_invoice_pi_asset')->where('cm_imp_invoice_asset_id',$c->id)->get();

            foreach ($cis as $cs)
            {
                $cs = DB::table('cm_invoice_pi_asset')->where('cm_imp_invoice_asset_id',$cs->id)->delete();
            }
            $c = DB::table('cm_imp_invoice_asset')->where('cm_imp_data_entry_asset_id',$asset->id)->delete();
        }

        $asset->delete();

        return back()->with('success', "Asset Data Information Successfully Deleted!!!");
    }
}

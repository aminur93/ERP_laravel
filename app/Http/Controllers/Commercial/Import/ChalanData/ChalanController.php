<?php

namespace App\Http\Controllers\Commercial\Import\ChalanData;

use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\CmPiBom;
use App\Models\Commercial\CmPiMaster;
use App\Models\Commercial\CommBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Yajra\DataTables\DataTables;

class ChalanController extends Controller
{
    public function index()
    {
        $bank = CommBank::pluck('bank_name','id');

        $uoms = CmPiBom::all();

        $cm_pi = CmPiMaster::all();

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $cm_file = DB::table('cm_pi_master')
            ->join('cm_file','cm_pi_master.cm_file_id','=','cm_file.id')
            ->pluck('cm_file.file_no','cm_file.id');

        $cm_supplier = DB::table('cm_pi_master')
            ->join('mr_supplier','cm_pi_master.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->pluck('mr_supplier.sup_name','mr_supplier.sup_id');

        return view('commercial.import.local_chalan.chalan_data_entry',
            compact('bank','cm_file','cm_supplier','uoms','cm_pi','mr_category','mr_color','mr_art','mr_comp','mr_const'));
    }

    public function fileUnit(Request $request)
    {
        $file_no = DB::table('cm_pi_master')
            ->join('cm_file','cm_pi_master.cm_file_id','=','cm_file.id')
            ->select('cm_file.hr_unit','cm_file.id')
            ->where('cm_file.id',$request->file_no)
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

    //pi select wise table
    public function piTable(Request $id)
    {
        // dd('PI No: ', $id);exit;

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $pi = DB::table('cm_pi_bom')
            ->join('mr_material_category','cm_pi_bom.mr_material_category_mcat_id','=','mr_material_category.mcat_id')
            ->where('cm_pi_master_id',$id->pi_master_id)
            ->get();
        return view('commercial.import.local_chalan.cmcat',
            compact('pi','mr_category','mr_color','mr_art','mr_comp','mr_const'));
        //echo $pi;exit;
    }

    public function editTable(Request $id)
    {
        // dd('PI No: ', $id);exit;

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $pi = DB::table('cm_pi_bom')
            ->join('mr_material_category','cm_pi_bom.mr_material_category_mcat_id','=','mr_material_category.mcat_id')
            ->join('cm_invoice_pi_bom','cm_pi_bom.id','=','cm_invoice_pi_bom.cm_pi_bom_id')
            ->where('cm_pi_bom.cm_pi_master_id',$id->pi_master_id_again)
            //->groupBy('cm_pi_bom.cm_pi_master_id')
            ->get();
            //dd($pi);exit;
        return view('commercial.import.local_chalan.cmcat_edit',
            compact('pi','mr_category','mr_color','mr_art','mr_comp','mr_const'));
        //echo $pi;exit;
    }

    // public function editTable(Request $id)
    // {
    //     // dd('PI Master Table ID:', $id->pi_master_id_again );exit;
    //     $pi = CmPiBom::where('cm_pi_master_id',$id->pi_master_id_again)->get();

    //     // dd('PI Bom Data:', $pi);exit;
    //     echo $pi;exit;
    // }

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

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

           // echo "<pre>";print_r($data);die;

            $chalan = new ImportDataEntry();

            $chalan->cm_bank_id = $data['bank'];
            $chalan->cm_file_id = $data['file_no'];
            $chalan->mr_supplier_sup_id = $data['supplier'];
            $chalan->imp_lc_type = $data['impdatatype'];
            $chalan->transp_doc_no1 = $data['tr_doc1'];
            $chalan->transp_doc_date = $data['tr_doc_date'];
            $chalan->value = $data['value'];
            $chalan->carrier = $data['carrier'];
            $chalan->doc_type = $data['doc_type'];
            $chalan->hr_unit = $data['unit'];
            $chalan->package = $data['package'];
            $chalan->doc_recv_date = $data['doc_date'];
            $chalan->qty = $data['quantity'];
            $chalan->cm_btb_id = $data['ilcno'];
//            $chalan->uom = '';

            $chalan->save();

            $last_id = $chalan->id;

            // Store Invoice Data Import Invoice Table
            for ($i = 0; $i < sizeof($request->rowno); $i++) {
                $newIn = DB::table('cm_imp_invoice')->insertGetId([
                    'cm_imp_data_entry_id' => $last_id,
                    'invoice_no' => $request->invoiceno[$i],
                    'invoice_date' => $request->invoicedate[$i]
                ]);


                $last_inv_id = $newIn;
                #*---------------------------------------

                //dd($request->all());
                foreach ($request->shipped_qty as $shippedqty) {
                  DB::table('cm_invoice_pi_bom')->insert([
                      'cm_imp_invoice_id' => $last_inv_id,
                      'cm_pi_master_id' => $request->cm_pi_master_id[$i],
                      'cm_pi_bom_id' => $request->id[$i],
                      'shipped_qty' => $shippedqty

                  ]);
                }

            }

            return back()->with('success', "Chalan Data Information Successfully Added!!!");
        }
    }

    public function view()
    {
        return view('commercial.import.local_chalan.local_chalan_list');
    }

    public function getData()
    {
        $chalans = DB::table('cm_imp_data_entry as cmpde')
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
            ->where('cmpde.imp_lc_type','Local')
            ->groupBy('cmpde.id')
            ->get();
            //dd($chalans);exit;

        return DataTables::of($chalans)
            ->addIndexColumn()

            ->editColumn('action', function ($chalans) {
                $return = "<div class=\"btn-group\">";
                if (!empty($chalans->imp_lc_type))
                {
                    $return .= "<a href=".url('comm/import/chalan/chalanedit/'.$chalans->id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\">
                                 <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                                  </a>

                                  <a href=".url('comm/import/chalan/chalanDelete/'.$chalans->id)." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\">
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
//            echo "<pre>";print_r($data);

            $chalan = ImportDataEntry::findOrFail($id);

            $chalan->cm_bank_id = $data['bank'];
            $chalan->cm_file_id = $data['file_no'];
            $chalan->mr_supplier_sup_id = $data['supplier'];
            $chalan->imp_lc_type = $data['impdatatype'];
            $chalan->transp_doc_no1 = $data['tr_doc1'];
            $chalan->transp_doc_date = $data['tr_doc_date'];
            $chalan->value = $data['value'];
            $chalan->carrier = $data['carrier'];
            $chalan->doc_type = $data['doc_type'];
            $chalan->hr_unit = $data['unit'];
            $chalan->package = $data['package'];
            $chalan->doc_recv_date = $data['doc_date'];
            $chalan->qty = $data['quantity'];
            $chalan->cm_btb_id = $data['ilcno'];
//            $chalan->uom = '';

            $chalan->update();

            $last_id = $chalan->id;

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

            return back()->with('success', "Chalan Data Information Successfully Updated!!!");
        }

        $chalans = ImportDataEntry::findOrFail($id);

        $bank = CommBank::all();

        $uoms = CmPiBom::all();

        $cm_pi = CmPiMaster::all();

        $mr_category = DB::table('mr_material_category')->get();

        $mr_color = DB::table('mr_material_color')->get();

        $mr_art = DB::table('mr_article')->get();

        $mr_comp = DB::table('mr_composition')->get();

        $mr_const = DB::table('mr_construction')->get();

        $cm_file = DB::table('cm_pi_master')
            ->join('cm_file','cm_pi_master.cm_file_id','=','cm_file.id')
            ->select('cm_file.file_no','cm_file.id')
            ->get();

        $cm_supplier = DB::table('cm_pi_master')
            ->join('mr_supplier','cm_pi_master.mr_supplier_sup_id','=','mr_supplier.sup_id')
            ->select('mr_supplier.sup_name','mr_supplier.sup_id')->get();

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
            ->groupBy('cm_imp_invoice.id')
            ->get();
       // dd($cm_pi_invoice);exit;

        $cm_pi_master = DB::table('cm_imp_data_entry')
            ->join('cm_imp_invoice','cm_imp_data_entry.id','=','cm_imp_invoice.cm_imp_data_entry_id')
            ->join('cm_invoice_pi_bom','cm_imp_invoice.id','=','cm_invoice_pi_bom.cm_imp_invoice_id')
            ->join('cm_pi_master','cm_invoice_pi_bom.cm_pi_master_id','=','cm_pi_master.pi_no')
            ->join('cm_pi_bom','cm_pi_master.id','=','cm_pi_bom.cm_pi_master_id')
            ->where('cm_imp_invoice.cm_imp_data_entry_id',$id)
            ->get();
//        dd($cm_pi_master);exit;


        return view('commercial.import.local_chalan.edit_chalan',
            compact('chalans','bank','cm_file','cm_supplier',
                'uoms','cm_pi','mr_category','cm_invoice','cm_pi_invoice','cm_pi_master','mr_color','mr_art','mr_comp','mr_const'));
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

        return back()->with('success', "Chalan Data Information Successfully Deleted!!!");
    }
}

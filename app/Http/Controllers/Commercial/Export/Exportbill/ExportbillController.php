<?php

namespace App\Http\Controllers\Commercial\Export\Exportbill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commercial\Export\CmExpDataEntry;
use App\Models\Commercial\Export\CmExpUpdate2;
use App\Models\Commercial\Export\CmExportBillAir;

class ExportbillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = CmExpDataEntry::pluck('cm_file_id');
        $invoicevalues = CmExpDataEntry::pluck('inv_value');
        $invoiceno = CmExpDataEntry::pluck('inv_no');
        return view('commercial\export\exportbill\exportbillair',compact('files','invoicevalues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoiceno = $request->invoice_no;
        $id = CmExpDataEntry::where('inv_no',$invoiceno)->pluck('id');
        $obj = new  CmExportBillAir;
        $obj->cm_exp_data_entry_1_id = $id[0];
        $obj->inv_no = $invoiceno;
        $obj->job_start_date = $request->job_start_date;
        $obj->job_end_date = $request->job_end_date;
        $obj->a1 = $request->a1;
        $obj->a2 = $request->a2;
        $obj->a3 = $request->a3;
        $obj->a5 = $request->a5;
        $obj->a6 = $request->a6;
        $obj->b1 = $request->b1;
        $obj->b2 = $request->b2;
        $obj->b3 = $request->b3;
        $obj->b4 = $request->b4;
        $obj->c1 = $request->c1;
        $obj->c2 = $request->c2;
        $obj->c3 = $request->c3;
        $obj->c4 = $request->c4;
        $obj->d1 = $request->d1;
        $obj->d2 = $request->d2;
        $obj->d3 = $request->d3;
        $obj->d4 = $request->d4;
        $obj->e1 = $request->e1;
        $obj->e2 = $request->e2;
        $obj->save();
        return back()
        ->with('success', " Insert Successfully!!");
        // created_at
        // updated_at
        
        return $id[0];

        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoiceNo($id)
    {
        $invoiceno = CmExpDataEntry::where('cm_file_id',$id)->pluck('inv_no');
        return $invoiceno;
    }

    public function invoiceData($id)
    {
        $invoiceno = CmExpDataEntry::where('inv_no',$id)->pluck('inv_value');
        return $invoiceno;
    }

    public function invoiceDataMore($id)
    {
        $invoiceno = CmExpUpdate2::where('invoice_no',$id)->get();
        return $invoiceno;
    }
}

<?php

namespace App\Models\Commercial\Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportDataEntry extends Model
{
	//public $with = ['file'];
	protected $table = "cm_imp_data_entry";

    public $timestamps = false;  

    public static function getSupplierFileWise()
    {
    	return ImportDataEntry::select('id', 'cm_file_id', 'mr_supplier_sup_id')
    	->get();
    }
    public static function getIdWise($id)
    {
        return ImportDataEntry::where('id', $id)
        ->first();
    }
    public static function getValuePackageWise()
    {
        return ImportDataEntry::select('id', 'value', 'package')
        ->get();
    }
    public static function getFileWise()
    {
    	return ImportDataEntry::select('id', 'cm_file_id')
    	->get();
    }
    public static function getValueFileIdWise($fId)
    {
        $query = ImportDataEntry::select('id', 'value');
        if($fId != 0){
            $query->where('cm_file_id', $fId);
        }
        return $query->get();
    }
    public static function getPackageValueWise($vId)
    {
        $query = ImportDataEntry::select('id', 'package');
        if($vId != 0){
            $query->where('value', $vId);
        }
        return $query->get();
    }
    public static function getSuppliersWise()
    {
    	return ImportDataEntry::select('id', 'mr_supplier_sup_id')
    	->get();
    }
    public static function getTransportDocNoWise()
    {
    	return ImportDataEntry::select('id', 'transp_doc_no1')
    	->get();
    }

    public function supplier()
    {
    	return $this->belongsTo('App\Models\Merch\Supplier', 'mr_supplier_sup_id', 'sup_id');
    }

    public function file()
    {
    	return $this->belongsTo('App\Models\Commercial\CMFile', 'cm_file_id', 'id');
    }

    public static function getResultSearchWise($input)
    {
        //return $input['value'];
        $query = ImportDataEntry::
        join('cm_btb','cm_imp_data_entry.cm_file_id','=','cm_btb.cm_file_id')
        ->select('cm_imp_data_entry.id as cm_imp_data_entry_id','cm_imp_data_entry.cm_file_id as cm_file_id','cm_btb.lc_no as lc_no','cm_imp_data_entry.mr_supplier_sup_id as mr_supplier_sup_id', 'cm_imp_data_entry.value as value', 'cm_imp_data_entry.transp_doc_no1 as transp_doc_no1', 'cm_btb.id as cm_btb_id');
        if($input['cm_file_id'] != null){
            $query->where('cm_imp_data_entry.cm_file_id', $input['cm_file_id']);
        }
        if($input['lc_no'] != null){
            $query->where('cm_btb.lc_no',$input['lc_no']);
        }
        if($input['mr_supplier_sup_id'] != null){
            $query->where('cm_imp_data_entry.mr_supplier_sup_id', $input['mr_supplier_sup_id']);
        }
        if($input['value'] != null){
            $query->where('cm_imp_data_entry.value', $input['value']);
        }
        if($input['transp_doc_no1'] != null){
            $query->where('cm_imp_data_entry.transp_doc_no1', $input['transp_doc_no1']);
        }
        return $query->get();
    }

    public static function getConsignmentHighSeasSearchWise($input)
    {
        //return $input['value'];
        $query = ImportDataEntry::orderBy('id','asc');
        if($input['cm_file_id'] != null){
            $query->where('cm_file_id', $input['cm_file_id']);
        }
        if($input['package'] != null){
            $query->where('package', $input['package']);
        }
        if($input['value'] != null){
            $query->where('value', $input['value']);
        }
        if($input['transp_doc_no1'] != null){
            $query->where('transp_doc_no1', $input['transp_doc_no1']);
        }
        return $query->get();
    }
}

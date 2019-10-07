<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Model;

class BTBEntry extends Model
{
    protected $table= "cm_btb";
    public $timestamps= false;

    public static function getCLNoWise()
    {
    	return BTBEntry::select('id', 'lc_no')->get();
    }

    public static function getCLNoFileIdWise($fId)
    {
    	$query = BTBEntry::select('id', 'lc_no');
        if($fId != 0){
            $query->where('cm_file_id', $fId);
        }
        return $query->get();
    }
    
    public static function getCLNoSupplierWise($lcNo)
    {
    	$query = BTBEntry::select('id', 'mr_supplier_sup_id');
        if($lcNo != 0){
            $query->where('lc_no', $lcNo);
        }
        return $query->get();
    }

    public function supplier()
    {
    	return $this->belongsTo('App\Models\Merch\Supplier', 'mr_supplier_sup_id', 'sup_id');
    }
}

<?php

namespace App\Models\Commercial;

use App\Models\Commercial\Passbook;
use Illuminate\Database\Eloquent\Model;
use DB;
class Passbook extends Model
{
	protected $table = "cm_passbook_volume";

    public $timestamps = false; 

    public static function checkExistsDB($data)
    {
     	return Passbook::where('cm_imp_data_entry_id', $data['cm_imp_data_entry_id'])
     	->where('cm_btb_id', $data['cm_btb_id'])
     	->first();
    }

    public static function updatePassbookInfo($id, $data)
    {
        return Passbook::where('id', $id)
        ->update([
            'page_no' => $data['page_no'],
            'volume_no' => $data['volume_no']
        ]);
    }

    public static function getListOfPassbookVolume()
    {
        DB::statement(DB::raw('set @rownum=0'));
        return Passbook::
        select(DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'), 'cm_passbook_volume.id as id', 'f.file_no', 'b.lc_no', 's.sup_name', 'e.value', 'page_no', 'volume_no')
        ->leftJoin('cm_imp_data_entry as e','cm_passbook_volume.cm_imp_data_entry_id','=','e.id')
        ->leftJoin('cm_file as f','e.cm_file_id','=','f.id')
        ->leftJoin('mr_supplier AS s', 'e.mr_supplier_sup_id','=','s.sup_id')
        ->leftJoin('cm_btb as b','cm_passbook_volume.cm_btb_id','=','b.id')
        ->get();
        
    }
}
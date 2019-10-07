<?php

namespace App\Models\Commercial;

use App\Models\Commercial\CmPIAsset;
use Illuminate\Database\Eloquent\Model;
use DB;
class CmPIAsset extends Model
{
    //public $with = ['file'];
    protected $table = 'cm_pi_asset';
  	protected $fillable = ['cm_file_id', 'hr_unit', 'cm_item_id', 'pi_no', 'pi_date', 'pi_last_ship_date', 'mr_supplier_sup_id', 'active_pi', 'pi_status', 'remarks', 'btb_lc_no', 'advance_payment_mode', 'updated_at'];

  	public static function getListOfCmPiAsset()
  	{
  		DB::statement(DB::raw('set @rownum=0'));
  		return CmPIAsset::
  		select(DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'), 'cm_pi_asset.id as id', 'f.file_no', 'u.hr_unit_name', 'i.cm_item_name', 'cm_pi_asset.pi_no', 'cm_pi_asset.pi_date', 's.sup_name', 'cm_pi_asset.active_pi', 'cm_pi_asset.pi_status', 'cm_pi_asset.pi_last_ship_date')
  		->leftJoin('cm_file as f','cm_pi_asset.cm_file_id','=','f.id')
      ->leftJoin('hr_unit as u','cm_pi_asset.hr_unit','=','u.hr_unit_id')
      ->leftJoin('cm_item as i','cm_pi_asset.cm_item_id','=','i.id')
      ->leftJoin('mr_supplier as s','cm_pi_asset.mr_supplier_sup_id','=','s.sup_id')
      ->orderBy('cm_pi_asset.id', 'desc')
      ->get();
  	}

    public function file()
    {
      return $this->belongsTo('App\Models\Commercial\CmFile', 'cm_file_id', 'id');
    }

    public function unit()
    {
      return $this->belongsTo('App\Models\Hr\Unit', 'hr_unit', 'hr_unit_id');
    }

    public function item()
    {
      return $this->belongsTo('App\Models\Commercial\Item', 'cm_item_id', 'id');
    }

    public function supplier()
    {
      return $this->belongsTo('App\Models\Merch\Supplier', 'mr_supplier_sup_id', 'sup_id');
    }


}

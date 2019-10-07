<?php

namespace App\Models\Commercial;

use App\Models\Commercial\CmPIAssetDescription;
use Illuminate\Database\Eloquent\Model;
use DB;
class CmPIAssetDescription extends Model
{
    //public $with = ['machine_type'];
    protected $table = 'cm_pi_asset_description';
    protected $fillable = ['cm_pi_asset_id', 'cm_machine_type_id', 'model_no', 'description', 'cm_section_id', 'qty', 'uom', 'unit_price', 'currency'];

    public static function getPiAssetIdWiseDescription($piAssetId)
    {
    	return CmPIAssetDescription::where('cm_pi_asset_id', $piAssetId)->get();
    }

    public function machine_type()
    {
    	return $this->belongsTo('App\Models\Commercial\MachineType', 'cm_machine_type_id', 'id');
    }

    public static function updatePiAssetDescription($id, $data)
    {
        return DB::table('cm_pi_asset_description')
        ->where('id', $id)
        ->update([
            'cm_machine_type_id' => $data['cm_machine_type_id'],
            'model_no'           => $data['model_no'],
            'description'        => $data['description'],
            'cm_section_id'      => $data['cm_section_id'],
            'qty'                => $data['qty'],
            'uom'                => $data['uom'],
            'unit_price'         => $data['unit_price'],
            'currency'           => $data['currency']
        ]);
    }
}

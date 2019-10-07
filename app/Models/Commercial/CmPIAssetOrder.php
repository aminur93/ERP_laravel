<?php

namespace App\Models\Commercial;

use App\Models\Commercial\CmPIAssetOrder;
use Illuminate\Database\Eloquent\Model;

class CmPIAssetOrder extends Model
{
    //public $with = ['order'];
    protected $table = 'cm_pi_asset_order';
    protected $fillable = ['cm_pi_asset_id', 'mr_order_entry_order_id'];

    public static function getPiAssetIdWiseOrder($piAssetId)
    {
    	return CmPIAssetOrder::where('cm_pi_asset_id', $piAssetId)->pluck('mr_order_entry_order_id')->toArray();
    }

    public static function getPiAssetIdWiseOrderId($piAssetId)
    {
        return CmPIAssetOrder::select('id')->where('cm_pi_asset_id', $piAssetId)->get();
    }

    public function order()
    {
    	return $this->belongsTo('App\Models\Merch\OrderEntry', 'mr_order_entry_order_id', 'order_id');
    }
}

<?php

namespace App\Models\Merch;

use App\Models\Merch\OrdBomItemColorMeasurement;
use Illuminate\Database\Eloquent\Model;

class OrdBomItemColorMeasurement extends Model
{
  protected $table = 'mr_ord_bom_item_color_measurement';
  protected $fillable = ['mr_ord_bom_gmt_color_id', 'color_name', 'measurement', 'size', 'type', 'qty'];

  public static function checkExsisOrdBomItemColorMeasurement($data)
  {
  	return OrdBomItemColorMeasurement::where('mr_ord_bom_gmt_color_id', $data['mr_ord_bom_gmt_color_id'])
  	->where('color_name', $data['color_name'])
  	->where('measurement', $data['measurement'])
  	->where('size', $data['size'])
  	->where('type', $data['type'])
  	->where('qty', $data['qty'])
  	->first();
  }

  public static function deleteOrdBomItemColorMeasurementGmtColorIdWise($gmtColorId)
  {
    return OrdBomItemColorMeasurement::where('mr_ord_bom_gmt_color_id', $gmtColorId)
    ->delete();
  }
}

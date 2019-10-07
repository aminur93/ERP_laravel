<?php

namespace App\Models\Merch;

use App\Models\Merch\OrdBomGmtColor;
use Illuminate\Database\Eloquent\Model;

class OrdBomGmtColor extends Model
{
	public $with = ['item_color_measurement'];
  protected $table = 'mr_ord_bom_gmt_color';
  protected $fillable = ['mr_ord_bom_placement_id', 'gmt_color'];

  public function item_color_measurement()
  {
    return $this->hasOne('App\Models\Merch\OrdBomItemColorMeasurement', 'mr_ord_bom_gmt_color_id', 'id');
  }

  public static function checkExsisOrdBomGmtColor($data)
  {
  	return OrdBomGmtColor::where('mr_ord_bom_placement_id', $data['mr_ord_bom_placement_id'])
  	->where('gmt_color', $data['gmt_color'])
  	->first();
  }
}

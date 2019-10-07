<?php

namespace App\Models\Merch;

use App\Models\Merch\OrdBomPlacement;
use Illuminate\Database\Eloquent\Model;

class OrdBomPlacement extends Model
{
  public $with = ['item_placement', 'gmt_color'];
  protected $table = 'mr_ord_bom_placement';
  protected $fillable = ['order_id', 'item_id', 'placement_id', 'description'];

  public function item_placement()
  {
    return $this->belongsTo('App\Models\Merch\ItemPlacement', 'placement_id', 'id');
  }
  public function item()
  {
    return $this->belongsTo('App\Models\Merch\McatItem', 'item_id', 'id');
  }

  public function gmt_color()
  {
    return $this->hasMany('App\Models\Merch\OrdBomGmtColor', 'mr_ord_bom_placement_id', 'id');
  }
  public static function checkExsisOrdBomPlacement($data)
  {
  	return OrdBomPlacement::where('order_id', $data['order_id'])
  	->where('item_id', $data['item_id'])
  	->where('placement_id', $data['placement_id'])
  	->where('description', $data['description'])
  	->first();
  }

  public static function getOrderIdItemIdWise($data)
  {
    return OrdBomPlacement::where('order_id', $data['order_id'])
    ->where('item_id', $data['item_id'])
    ->get();
  }

  public static function getOrderItemDetailsOrderIdWise($orderId)
  {
    return OrdBomPlacement::where('order_id', $orderId)
    ->get();
  }
}

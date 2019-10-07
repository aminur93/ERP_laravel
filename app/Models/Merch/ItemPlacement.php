<?php

namespace App\Models\Merch;

use App\Models\Merch\ItemPlacement;
use Illuminate\Database\Eloquent\Model;

class ItemPlacement extends Model
{
  protected $table = 'mr_item_placement';
  protected $fillable = ['placement'];

  public static function checkExsisPlacement($value)
  {

  	return ItemPlacement::where('placement', $value)
  	->first();
  }

  public static function searchItemPlacement($value)
  {
  	return ItemPlacement::select('placement')
    	 ->where('placement', 'LIKE', '%'. $value .'%')
    	->get();
  }
}

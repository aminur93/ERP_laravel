<?php

namespace App\Models\Merch;

use Illuminate\Database\Eloquent\Model;

class McatItem extends Model
{		
	public $with = ['item_placement'];
    protected $table= 'mr_cat_item';
    public $timestamps= false;
    public function item_placement()
	  {
	    return $this->belongsTo('App\Models\Merch\ItemPlacement', 'item_id', 'id');
	  }
}

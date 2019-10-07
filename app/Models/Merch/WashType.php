<?php

namespace App\Models\Merch;

use Illuminate\Database\Eloquent\Model;

class WashType extends Model
{
    protected $table= 'mr_wash_type';
    public $timestamps= false;

    public function category()
    {
    	return $this->belongsTo('App\Models\Merch\WashCategory', 'mr_wash_category_id', 'id');
    }
}
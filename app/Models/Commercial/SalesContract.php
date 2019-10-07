<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Model;

class SalesContract extends Model
{
    protected $table= 'cm_sales_contract';
    public $timestamps= false;

    public function mr_buyer()
    {
    	return $this->hasOne('App\Models\commercial\MrBuyer', 'b_id', 'mr_buyer_b_id');
    }

    public function cm_bank()
    {
    	return $this->hasOne('App\Models\commercial\Bank', 'id', 'lc_open_bank_id');
    }
}

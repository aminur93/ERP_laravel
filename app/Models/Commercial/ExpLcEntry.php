<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Model;

class ExpLcEntry extends Model
{
   	protected $table= 'cm_exp_lc_entry';
    
    public $timestamps= false;

    public function cm_sales_contract()
    {
    	return $this->hasOne('App\Models\commercial\SalesContract', 'id', 'cm_sales_contract_id');
    }

}
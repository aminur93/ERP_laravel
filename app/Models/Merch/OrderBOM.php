<?php

namespace App\Models\Merch;

use App\Models\Merch\OrderBOM;
use Illuminate\Database\Eloquent\Model;

class OrderBOM extends Model
{
	public $with = ['category', 'item'];
    protected $table= 'mr_order_bom_costing_booking';
    public $timestamps= false;

    public static function getOrderBomOrderIdWiseSelectItemIdName($orderId)
    {
    	return OrderBOM::where('order_id', $orderId)
    	->get();
    }

    public function category()
	{
	    return $this->belongsTo('App\Models\Merch\MainCategory', 'mr_material_category_mcat_id', 'mcat_id');
	}

	public function item()
	{
	    return $this->belongsTo('App\Models\Merch\McatItem', 'mr_cat_item_id', 'id');
	}

	public function supplier()
	{
	    return $this->belongsTo('App\Models\Merch\Supplier', 'mr_supplier_sup_id', 'sup_id');
	}

	public function article()
	{
	    return $this->belongsTo('App\Models\Merch\Article', 'mr_article_id', 'id');
	}

	public function composition()
	{
	    return $this->belongsTo('App\Models\Merch\Composition', 'mr_composition_id', 'id');
	}


	public function construction()
	{
	    return $this->belongsTo('App\Models\Merch\Construction', 'mr_construction_id', 'id');
	}

	  // public function order_bom_placement()
	  // {
	  // 	return $this->hasMany('App\Models\Merch\OrdBomPlacement', ['order_id', 'mr_cat_item_id'], ['order_id', 'item_id']);
	  // }

}

<?php

namespace App\Models\Merch;

use App\Models\Merch\ProductSize;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table= 'mr_product_size';
    public $timestamps= false;

    public static function getPalleteNameSizeGroupIdWise($sizeGroupId, $value)
    {
    	return ProductSize::select('mr_product_pallete_name')->where('mr_product_size_group_id', $sizeGroupId)
    	 ->where('mr_product_pallete_name', 'LIKE', '%'. $value .'%')
    	->get();
    }
}

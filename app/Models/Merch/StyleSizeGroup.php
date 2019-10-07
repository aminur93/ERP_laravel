<?php

namespace App\Models\Merch;

use App\Models\Merch\StyleSizeGroup;
use Illuminate\Database\Eloquent\Model;

class StyleSizeGroup extends Model
{
    protected $table= 'mr_stl_size_group';
    public $timestamps= false;

    public static function getSizeGroupIdStyleIdWise($styleId)
    {
    	return StyleSizeGroup::select('mr_product_size_group_id')->where('mr_style_stl_id', $styleId)
    	->get();
    }
}

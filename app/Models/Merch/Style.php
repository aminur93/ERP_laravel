<?php

namespace App\Models\Merch;

use App\Models\Merch\Style;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table= 'mr_style';
    public $timestamps= false;

    public static function checkStyleNoTextWise($stl_no)
    {
    	return Style::select('stl_no')->where('stl_no', $stl_no)->first();
    }
}

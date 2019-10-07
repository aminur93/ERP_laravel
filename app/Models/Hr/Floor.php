<?php

namespace App\Models\Hr;

use App\Models\Hr\Floor;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table= 'hr_floor';
    public $timestamps= false;

    public static function getFloorList()
    {
    	return Floor::pluck('hr_floor_name', 'hr_floor_id');
    }

    public static function getFloorNameBangla($id)
    {
    	return Floor::where('hr_floor_id',$id)->first(['hr_floor_name_bn']);
    }
}

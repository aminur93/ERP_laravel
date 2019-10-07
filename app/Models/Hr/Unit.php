<?php

namespace App\Models\Hr;

use App\Models\Hr\Unit;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table= 'hr_unit';
    public $timestamps= false;

    public static function unitList()
    {
      $unitList = Unit::pluck('hr_unit_name', 'hr_unit_id'); 
      return $unitList;
    }

    public static function unitName($id)
    {
      $unitName= Unit::where('hr_unit_id',$id)->first(['hr_unit_name']); 
      return $unitName;
    }

    public static function getUnitNameBangla($id)
    {
      $unitName= Unit::where('hr_unit_id',$id)->first(['hr_unit_name_bn']); 
      return $unitName;
    }
}

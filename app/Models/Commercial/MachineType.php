<?php

namespace App\Models\Commercial;

use App\Models\Commercial\MachineType;
use Illuminate\Database\Eloquent\Model;

class MachineType extends Model
{
    protected $table= 'cm_machine_type';
    public $timestamps= false;

    public static function getMachineTypeSearchWise($value)
    {
    	return MachineType::
        where('type_name', 'LIKE', '%'. $value .'%')
    	->get();
    }

    public static function getExistsMachineType($type)
    {
    	return MachineType::where('type_name', $type)->first();
    }
}

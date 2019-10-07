<?php

namespace App\Models\Hr;

use App\Models\Hr\Subsection;
use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
	protected $table = "hr_subsection";

    public $timestamps = false; 

    public static function getSubSectionList()
    {
    	return Subsection::pluck('hr_subsec_name', 'hr_subsec_id');
    }
}

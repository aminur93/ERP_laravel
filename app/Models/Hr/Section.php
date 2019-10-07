<?php

namespace App\Models\Hr;

use App\Models\Hr\Section;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	protected $table = "hr_section";

    public $timestamps = false;

    public static function getSectionList()
     {
     	return Section::pluck('hr_section_name', 'hr_section_id');
     } 
}

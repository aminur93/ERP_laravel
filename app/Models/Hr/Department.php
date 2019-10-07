<?php

namespace App\Models\Hr;

use App\Models\Hr\Department;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "hr_department";

    public $timestamps = false; 
    
    public static function getDeptList()
    {
    	return Department::pluck('hr_department_name', 'hr_department_id');
    }
}

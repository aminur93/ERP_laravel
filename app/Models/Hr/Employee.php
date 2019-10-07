<?php

namespace App\Models\Hr;

use App\Models\Hr\Employee;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

	//public $with = ['designation'];
    protected $table = "hr_as_basic_info";

    public $timestamps = false;

    public static function getEmployeeAssociateIdWise($as_id)
    {
    	return Employee::where('associate_id', $as_id)->first();
    }

    public static function getSelectIdNameEmployee()
    {
        return Employee::select('as_id', 'as_name', 'associate_id')->get();
    }

    public function designation()
    {
    	return $this->belongsTo('App\Models\Hr\Designation', 'as_designation_id', 'hr_designation_id');
    }

    public static function getEmployeeFilterWise($data)
    {
        $query = Employee::select('associate_id', 'as_unit_id', 'as_location');

        if($data['unit']){
            $query->where('as_unit_id', $data['unit']);
            $query->orWhere('as_location', $data['unit']);
        }

        if($data['floor']){
            $query->where('as_floor_id', $data['floor']);
        }

        if($data['area']){
            $query->where('as_area_id', $data['area']);
        }

        if($data['department']){
            $query->where('as_department_id', $data['department']);
        }

        if($data['section']){
            $query->where('as_section_id', $data['section']);
        }

        if($data['sub_section']){
            $query->where('as_subsection_id', $data['sub_section']);
        }

        if($data['employee_status']){
            $query->where('as_status', $data['employee_status']);
        }

        return $query->get();
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Hr\Unit', 'as_unit_id', 'hr_unit_id');
    }

    public function floor()
    {
        return $this->belongsTo('App\Models\Hr\Floor', 'as_floor_id', 'hr_floor_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Hr\Unit', 'as_location', 'hr_unit_id');
    }
    
}

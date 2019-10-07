<?php

namespace App\Models\Hr;

use App\Models\Hr\HrMonthlySalary;
use Illuminate\Database\Eloquent\Model;

class HrMonthlySalary extends Model
{
	public $with = ['employee', 'employee_bengali', 'add_deduct', 'benefits'];
    protected $table = "hr_monthly_salary";

    public $timestamps = false;

    public static function getSalaryListWithEIdFormTo($data)
    {
    	return HrMonthlySalary::
    	where('as_id', $data['as_id'])
    	->where('year', '>=', $data['formYear'])
    	->where('year', '<=', $data['toYear'])
    	->where('month', '>=', $data['formMonth'])
    	->where('month', '<=', $data['toMonth'])
    	->orderBy('as_id', 'desc')
    	->get();
    }

    public static function getSalaryListFilterWise($as_id, $month, $year, $min, $max)
    {
        $query = HrMonthlySalary::where('as_id', $as_id);

        if($month != ''){
            $query->where('month', $month);
        }

        if($year != ''){
            $query->where('year', $year);
        }

        if($min != ''){
            $query->where('gross', '>=', $min);
        }

        if($max != ''){
            $query->where('gross', '<=', $max);
        }

        return $query->first();

    }

    public function salary_add_deduct()
    {
    	return $this->belongsTo('App\Models\Hr\Employee', 'as_id', 'associate_id');
    }
    public function employee()
    {
    	return $this->belongsTo('App\Models\Hr\Employee', 'as_id', 'associate_id');
    }

    public function employee_bengali()
    {
    	return $this->belongsTo('App\Models\Hr\EmployeeBengali', 'as_id', 'hr_bn_associate_id');
    }

    public function add_deduct()
    {
    	return $this->belongsTo('App\Models\Hr\SalaryAddDeduct', 'salary_add_deduct_id', 'id');
    }

    public function benefits()
    {
    	return $this->belongsTo('App\Models\Hr\Benefits', 'as_id', 'ben_as_id');
    }
}

<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class YearlyHolyDay extends Model
{
    protected $table= "hr_yearly_holiday_planner";
    public $timestamps= false;
    protected $guarded = [];
}

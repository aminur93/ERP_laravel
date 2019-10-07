<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class AttendanceBonus extends Model
{
    protected $table= "hr_attendance_bonus";
    public $timestamps = false;
    protected $guarded = [];
}

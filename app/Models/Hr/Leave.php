<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table= "hr_leave";
    public $timestamps = false;
    protected $guarded = [];
}

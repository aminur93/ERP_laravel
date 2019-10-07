<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class WithoutPay extends Model
{
    protected $table= "hr_without_pay";
    
    public    $timestamps = false; 
}

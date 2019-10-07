<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginActivities extends Model
{
	protected $table = "users_login_activities";

    public $timestamps = false; 
}

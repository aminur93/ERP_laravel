<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Hr\Employee;
use Hash, Auth;

class User extends Authenticatable
{ 
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'associate_id', 'email', 'password','unit_id', 'unit_permissions', 'buyer_permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
     
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
     
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    } 
     
    public function isSuperAdmin()
    { 
        return $this->associate_id == 9999999999;
    } 

    public function unit_id()
    {
        return Employee::where('associate_id', $this->associate_id)
            ->value('as_unit_id');
    }

    public function unit_permissions()
    {
        $units = explode(",", $this->unit_permissions);
        return (!empty($units[0])?$units:[]);
    }

    public function buyer_permissions()
    {
        $buyers = explode(",", $this->buyer_permissions);
        return (!empty($buyers[0])?$buyers:[]);
    }
 
}

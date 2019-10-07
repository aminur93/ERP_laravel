<?php

namespace App\Models\Merch;

use Illuminate\Database\Eloquent\Model;

class SeasonInput extends Model
{
	protected $table= 'mr_season';
    protected $fillable = ['se_name'];

}

<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    public function CV(){
    	return view('hr/recruitment/cv');
    }
}

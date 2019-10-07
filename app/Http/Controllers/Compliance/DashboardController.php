<?php

namespace App\Http\Controllers\Compliance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
    	return view('compliance.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Csr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
    	return view('csr.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Account_Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
    	return view('account_finance.dashboard');
    }
}

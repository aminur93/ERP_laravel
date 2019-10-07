<?php

namespace App\Http\Controllers\Merch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\OrderTNA;
use App\Models\Merch\OrderTNAction;
use DB, ACL;


class DashboardController extends Controller
{

    
    /* public function __construct() {

       $variable2 = "I am Data 2";


       View::share ( 'variable1', $this->variable1 );
       View::share ( 'variable2', $variable2 );
       View::share ( 'variable3', 'I am Data 3' );
       View::share ( 'variable4', ['name'=>'Franky','address'=>'Mars'] );
    }*/  

    public function index()
    {
    	
    	//return view('merch.dashboard',compact('diff'));
    	return view('merch.dashboard');

    	/*in dashboard view
    	@extends('merch.index', ['tna_notif' => $diff])*/
    }
}

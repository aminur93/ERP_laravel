<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class JobCardController extends Controller
{ 
    public function jobCard(Request $request)
    { 
    	if ($request->get('pdf') == true) {
			$pdf = PDF::loadView('hr/reports/job_card_pdf', []);
			return $pdf->download('Job_Card_Report_'.date('d_F_Y').'.pdf');
		}

        return view("hr/reports/job_card");
    } 
}

<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, PDF;

class LeaveLogController extends Controller
{
    public function showForm(Request $request)
    {  
    	$info = DB::table("hr_as_basic_info AS b")
            ->select(
              "b.as_id AS id",
              "b.associate_id AS associate",
              "b.as_name AS name",
              "b.as_doj AS doj",
              "u.hr_unit_id AS unit_id",
              "u.hr_unit_name AS unit",
              "s.hr_section_name AS section",
              "d.hr_designation_name AS designation"
            )
            ->leftJoin("hr_unit AS u", "u.hr_unit_id", "=", "b.as_unit_id")
            ->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
            ->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
            ->where("b.associate_id", "=", $request->associate)
            ->first();

        if (!empty($info->id))
        {
            $earned_due = $this->earned($info->id, $info->associate, $info->doj, $request->year);
        }
        else
        {
            $earned_due = 0;
        }

    	$leaves = $this->leaves($request->associate, $request->year);



        // Generate PDF
        if ($request->get('pdf') == true) {     
            $pdf = PDF::loadView('hr/reports/leave_log_pdf', [
                'info'       => $info,
                'leaves'     => $leaves,
                'earned_due' => $earned_due
            ]);
            return $pdf->download('Leave_Log_Report_'.date('d_F_Y').'.pdf'); 
        } 

        return view("hr/reports/leave_log", compact(
        	"info",
        	"leaves",
        	"earned_due"
        ));
    } 


    public function leaves($associate = null, $year = null)
    {
    	$leaves = array();
    	for ($i=1; $i<=12; $i++)
    	{
	    	$due     = 0;
	    	$enjoyed = 0;
	    	$balance = 0; 
	    	$month   = ($i<10?"0$i":$i);
    		$month_year = $year."-".$month;
	    	#-----------------------------
	    	$leaves[$month] = DB::table("hr_leave") 
                ->select(
                    DB::raw("  
                        CASE 
                        	WHEN $month=1 THEN 'January'
                        	WHEN $month=2 THEN 'February' 
                        	WHEN $month=3 THEN 'March'
                        	WHEN $month=4 THEN 'April'
                        	WHEN $month=5 THEN 'May'
                        	WHEN $month=6 THEN 'June'
                        	WHEN $month=7 THEN 'July'
                        	WHEN $month=8 THEN 'August'
                        	WHEN $month=9 THEN 'September'
                        	WHEN $month=10 THEN 'October'
                        	WHEN $month=11 THEN 'November'
                        	WHEN $month=12 THEN 'December'
                        END AS month_name,
                        EXTRACT(YEAR_MONTH FROM leave_from) AS month_year, 
                        SUM(CASE WHEN leave_type = 'Casual' THEN DATEDIFF(leave_to, leave_from)+1 END) AS casual,
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS earned,
                        SUM(CASE WHEN leave_type = 'Sick' THEN DATEDIFF(leave_to, leave_from)+1 END) AS medical,
                        SUM(CASE WHEN leave_type = 'Maternity' THEN DATEDIFF(leave_to, leave_from)+1 END) AS maternity,
                        SUM(DATEDIFF(leave_to, leave_from)+1) AS total
                    ")
                )
	    		->where("leave_ass_id", $associate) 
                ->where("leave_status", "1") 
                ->where(function ($q) use($month, $year) {
                    $q->where(DB::raw("YEAR(leave_from)"), '=', $year);
                    $q->where(DB::raw("MONTH(leave_from)"), '=', $month); 
                }) 
                ->first(); 
 	
	    	#----------------------------- 
    	} 
    	return $leaves;
    }

    public function earned($id=null, $associate=null, $doj=null, $year=null)
    {
    	$date_of_join_year = date("Y", strtotime($doj));
    	$start_year = $date_of_join_year;
    	$end_year   = $year;
		$attend     = array(); 
		$leave      = array(); 
		$total_earned  = 0;
		$total_enjoyed = 0;
		$total_due     = 0;
    	#---------------------------------
		for ($i = $start_year; $i<$end_year; $i++)
		{
			# -----------------------------------
			// total due earned due 
			$attend[$i] = DB::table("hr_attendance")
				->select(DB::raw("
					DATE(in_time) AS date 
				"))
				->distinct("date")
				->where("as_id", $id)
				->where(DB::raw("YEAR(in_time)"), $i)
				->groupBy("att_id")
				->get();
			//make total earned
			$total_earned += number_format((sizeof($attend[$i])>0?(sizeof($attend[$i])/18):0), 2); 

			# -----------------------------------
	    	$leave[$i] = DB::table("hr_leave") 
                ->select(
                    DB::raw("   
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS enjoyed 
                    ")
                )
	    		->where("leave_ass_id", $associate) 
                ->where("leave_status", "1") 
                ->where(DB::raw("YEAR(leave_from)"), '=', $i)  
                ->value("enjoyed"); 

			$total_enjoyed += number_format((!empty($leave[$i])?$leave[$i]:0), 2);  
			# ----------------------------------- 
		}
    	$total_due = $total_earned-$total_enjoyed; 
    	return $total_due;
    }
    //Check if Applicant has enough Due Leaves
    public function checkDueLeave(Request $request){

        $associate_id= $request->associate_id;

        if($request->leave_type== "Earned"){
            $leaves = DB::table("hr_leave") 
                ->select(
                    DB::raw("
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS earned
                    ")
                )
                ->where("leave_ass_id", $associate_id) 
                ->where("leave_status", "1") 
                ->where(function ($q){
                    $q->where(DB::raw("YEAR(leave_from)"), '=', date("Y"));
                }) 
                ->first();
                $as_info = DB::table('hr_as_basic_info')
                                ->where('associate_id', $associate_id)
                                ->select([
                                    'as_id',
                                    'as_doj'
                                ])
                                ->first();
                $earned= $this->earned($as_info->as_id, $associate_id, $as_info->as_doj, date('Y'));
                if($leaves->earned<$earned)
                    return "true";
        }
        if($request->leave_type== "Casual"){
            $leaves = DB::table("hr_leave") 
                ->select(
                    DB::raw("
                        SUM(CASE WHEN leave_type = 'Casual' THEN DATEDIFF(leave_to, leave_from)+1 END) AS casual
                    ")
                )
                ->where("leave_ass_id", $associate_id) 
                ->where("leave_status", "1") 
                ->where(function ($q){
                    $q->where(DB::raw("YEAR(leave_from)"), '=', date("Y"));
                }) 
                ->first();
                if($leaves->casual < 14)
                    return "true";
        }
        if($request->leave_type== "Sick"){
            $leaves = DB::table("hr_leave") 
                ->select(
                    DB::raw("
                        SUM(CASE WHEN leave_type = 'Sick' THEN DATEDIFF(leave_to, leave_from)+1 END) AS sick
                    ")
                )
                ->where("leave_ass_id", $associate_id) 
                ->where("leave_status", "1") 
                ->where(function ($q){
                    $q->where(DB::raw("YEAR(leave_from)"), '=', date("Y"));
                }) 
                ->first();
            if($leaves->sick < 10)
                    return "true";
        }
        if($request->leave_type== "Maternity"){
            $leaves = DB::table("hr_leave") 
                ->select(
                    DB::raw("
                        SUM(CASE WHEN leave_type = 'Maternity' THEN DATEDIFF(leave_to, leave_from)+1 END) AS maternity
                    ")
                )
                ->where("leave_ass_id", $associate_id) 
                ->where("leave_status", "1") 
                ->where(function ($q){
                    $q->where(DB::raw("YEAR(leave_from)"), '=', date("Y"));
                }) 
                ->first();
            $gender= DB::table('hr_as_basic_info')
                        ->where('associate_id', $associate_id)
                        ->pluck('as_gender')
                        ->first();
            if($leaves->maternity < 120 && $gender== "Female")
                    return "true";
        }
        return "false";
    }

}

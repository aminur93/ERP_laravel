<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Department;
use DB, DateTime, PDF;
class MonthlyIncrementController extends Controller
{
    public function increment(Request $request){
		// dd($request->all());
		$info ='';
		$departments ='';
		
    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
    	$deptList= Department::pluck('hr_department_name', 'hr_department_id');
        $effmonth = date("m", strtotime($request->month));
    	if(!empty($request->unit_id)){
    		if(!empty($request->department_id)){
                
    			$info= DB::table('hr_increment AS inc')
                            ->where('inc.status', 0)
                            ->where('increment_type', 2)
                            ->whereMonth('effective_date', $effmonth)
                            ->leftJoin('hr_as_basic_info AS b', 'inc.associate_id', 'b.associate_id')
    						->where('b.as_unit_id', $request->unit_id)
    						->where('b.as_department_id', $request->department_id)
    						->select([
    							'b.as_id',
    							'b.associate_id',
    							'b.as_name',
    							'b.as_doj',
    							'b.as_department_id',
    							'dep.hr_department_name',
    							'd.hr_designation_name',
    							's.hr_section_name',
    							'l.hr_line_name',
                                'inc.current_salary',
                                'inc.increment_amount',
                                'inc.amount_type',
                                'inc.effective_date'

    						])
    						->leftJoin('hr_department AS dep', 'dep.hr_department_id', 'b.as_department_id')
    						->leftJoin('hr_designation AS d', 'b.as_designation_id', 'd.hr_designation_id')
    						->leftJoin('hr_section AS s', 'b.as_section_id', 'hr_section_id')
    						->leftJoin('hr_line AS l', 'l.hr_line_id', 'b.as_line_id')
                            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
    						->get();
                // dd($info);

    		}
    		else{
                // dd($effmonth);
    			$info= DB::table('hr_increment AS inc')
                            ->where('inc.status', 0)
                            ->where('increment_type', 2)
                            ->whereMonth('effective_date', $effmonth)
                            ->leftJoin('hr_as_basic_info AS b', 'inc.associate_id', 'b.associate_id')
    						->where('as_unit_id', $request->unit_id)
    						->select([
    							'b.as_id',
    							'b.associate_id',
    							'b.as_name',
    							'b.as_doj',
    							'b.as_department_id',
    							'dep.hr_department_name',
    							'd.hr_designation_name',
    							's.hr_section_name',
    							'l.hr_line_name',
                                'inc.current_salary',
                                'inc.increment_amount',
                                'inc.amount_type',
                                'inc.effective_date'

    						])
    						->leftJoin('hr_department AS dep', 'dep.hr_department_id', 'b.as_department_id')
    						->leftJoin('hr_designation AS d', 'b.as_designation_id', 'd.hr_designation_id')
    						->leftJoin('hr_section AS s', 'b.as_section_id', 'hr_section_id')
    						->leftJoin('hr_line AS l', 'l.hr_line_id', 'b.as_line_id')
                            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
    						->get();
    		}
            // dd($info);
    		foreach($info AS $associate){
    			// dd($associate->associate_id);
    			$education= DB::table('hr_education AS e')
    					->where('e.education_as_id', $associate->associate_id)
    					->orderBy('e.education_level_id',"DESC")
    					->leftJoin('hr_education_degree_title AS t', 't.id', 'e.education_degree_id_1')
    					->orderBy('e.education_degree_id_1', "DESC")
    					->pluck('t.education_degree_title')
    					->first();
    			$associate->edu= $education;
    			// dd($education);
    					$month = date("m", strtotime($request->month));
    					$year = date("Y", strtotime($request->month));
    					$checktoday= date("d");
    					$dateForcheck= $checktoday."-".$month."-".$year;
    					$MetmonthChek= date('d-m-Y', strtotime($dateForcheck));
    			// dd($month);
    				//calculating without pay days
    			$without_pay=DB::table('hr_without_pay')
    							->where('hr_wop_as_id', $associate->associate_id)
    							->select([
    								'hr_wop_start_date',
    								'hr_wop_end_date'
    							])
    							->whereMonth('hr_wop_start_date', $month)
    							->get();

    			$wp=0;
    			if(!empty($without_pay)){
    				
    				foreach($without_pay AS $ewp){
    					$from= date('d-m-Y', strtotime($ewp->hr_wop_start_date));
    					$to= date('d-m-Y', strtotime($ewp->hr_wop_end_date));
						$datetime1 = new DateTime($to);
						$datetime2 = new DateTime($from);
						$interval = $datetime1->diff($datetime2);
						$days = $interval->format('%a');
						$days++;
						$wp+=$days;
    				}

    			}
    			$associate->without_pay=$wp;
    			//calculating with pay (Leaves) day
    			$awp=0; //absent with pay (leave)
    			$leaves=DB::table('hr_leave')
    							->where('leave_ass_id', $associate->associate_id)
    							->select([
    								'leave_from',
    								'leave_to'
    							])
    							->whereMonth('leave_from', $month)
    							->get();
    			if(!empty($leaves)){
    				
    				foreach($leaves AS $leave){
    					$from= date('d-m-Y', strtotime($leave->leave_from));
    					$to= date('d-m-Y', strtotime($leave->leave_to));
						$datetime1 = new DateTime($to);
						$datetime2 = new DateTime($from);
						$interval = $datetime1->diff($datetime2);
						$days = $interval->format('%a');
						$days++;
						$awp+=$days;
    				}

    			}
    			$associate->with_pay=$awp;

    			//last increment
    			$last_inc_date=null;
    			$lat_inc_amount=null;
    			$total_pay= 0;
    			$inc_amount=null;
    			// $last_increment=DB::table('hr_increment')
    			// 				->where('associate_id', $associate->associate_id)
    			// 				->where('status', 0)
    			// 				->where('increment_type', 2)
    			// 				->select([
    			// 					'current_salary',
    			// 					'increment_amount',
    			// 					'amount_type',
    			// 					'effective_date'
    			// 				])
    			// 				->orderBy('id','DESC')
    			// 				->first();

    			$last_increment=DB::table('hr_increment')
    							->where('associate_id', $associate->associate_id)
    							->where('status', 1)
    							->where('increment_type', 2)
    							->select([
    								'current_salary',
    								'increment_amount',
    								'amount_type',
    								'effective_date'
    							])
    							->orderBy('id','DESC')
    							->first();
    			$benefit_for_total_pay=DB::table('hr_benefits')
    							->where('ben_as_id', $associate->associate_id)
    							->where('ben_status', 1)
    							->orderBy('ben_id','DESC')
    							->first();

    			if(!empty($last_increment)){
    				$last_inc_date= date("d-m-Y", strtotime($last_increment->effective_date));
    				if($last_increment->amount_type ==1){
    					$lat_inc_amount= $last_increment->increment_amount;
    				}
    				else{
    					$lat_inc_amount= $last_increment->current_salary-(($last_increment->current_salary*100)/($last_increment->increment_amount+100));
    				}
    			}
    			// if(!empty($next_increment)){
    			// 	if($next_increment->amount_type ==1){
    			// 		$inc_amount= $next_increment->increment_amount;
    			// 	}
    			// 	else{
    			// 		$inc_amount= ($next_increment->current_salary/100)*$next_increment->increment_amount;
    			// 	}
    			// }
    			// if(!empty($benefit_for_total_pay)){
    			// 	$total_pay=$benefit_for_total_pay->ben_current_salary;
    			// }

                if($associate->amount_type ==1){
                        $inc_amount= $associate->increment_amount;
                    }
                    else{
                        $inc_amount= ($associate->current_salary/100)*$associate->increment_amount;
                    }

    			$associate->last_inc_date = $last_inc_date;
    			$associate->lat_inc_amount = $lat_inc_amount;
    			$associate->total_pay = $total_pay;
    			$associate->inc_amount = $inc_amount;



    			$meternityCheck= DB::table('hr_leave')
    							->where('leave_ass_id', $associate->associate_id)
    							->where('leave_type', "Maternity")
    							->where('leave_from', "<=", $MetmonthChek)
    							->where('leave_to', ">=", $MetmonthChek)
    							->exists();
    			if($meternityCheck){
    				$associate->status = "M";
    			}
    			else{
    				$associate->status = "A";
    			}
    		}

    	}
    	$unit= Unit::where('hr_unit_id', $request->unit_id)
    				->pluck('hr_unit_name')
    				->first();
    		// dd($unit);
        if(!empty($info)){
            $departments= $info->unique('hr_department_name');
           }

    	$month= $request->month;

        // Generate PDF
        if ($request->get('pdf') == true) {     
            $pdf = PDF::loadView('hr/reports/monthly_increment_pdf', [
                'deptList' => $deptList,
                'info'     => $info,
                'departments' => $departments,
                'unit'     => $unit,
                'month'    => $month
            ]);
            return $pdf->download('Monthly_Increment_Report_'.date('d_F_Y').'.pdf'); 
        } 

    	return view('hr/reports/monthly_increment',compact('unitList','deptList', 'info', 'departments', 'unit','month'));
    }
}

<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Section;
use App\Models\Hr\Employee;
use DB, PDF;

class IncrementReportController extends Controller
{
    public function incrementReport(Request $request){
        $info ='';
        $oVal ='';
        $ret = '';
        if(!empty($request->unit_id) || !empty($request->associate_id)){

        $associate_id= $request->associate_id;
        $unit_id= $request->unit_id;
        $floor_id= $request->floor_id;
        $line_id= $request->line_id;

    	$info = DB::table('hr_as_basic_info AS b')
            ->where(function($q) use($unit_id, $floor_id, $line_id, $associate_id){
                if (!empty($unit_id))
                {
                    $q->where('b.as_unit_id', $unit_id);
                }
                if (!empty($floor_id))
                {
                    $q->where('b.as_floor_id', $floor_id);
                }
                if (!empty($line_id))
                {
                    $q->where('b.as_line_id', $line_id);
                }
                if (!empty($associate_id))
                {
                    $q->where('b.associate_id', $associate_id);
                }
            })
            ->select(
                'b.as_doj',
                'b.associate_id',
                'b.as_name',
                'b.as_unit_id',
                'b.as_floor_id',
                'b.as_line_id',
                'b.as_section_id',
                'u.hr_unit_name',
                'f.hr_floor_name',
                'l.hr_line_name',
                'dp.hr_department_name',
                'dg.hr_designation_name',
                'se.hr_section_name',
                'be.*'
            )
            ->leftJoin('hr_section AS se', 'se.hr_section_id', '=', 'b.as_section_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'b.as_floor_id')
            ->leftJoin('hr_line AS l', 'l.hr_line_id', '=', 'b.as_line_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin('hr_benefits AS be',function ($leftJoin) {
                $leftJoin->on('be.ben_as_id', '=' , 'b.associate_id') ;
                $leftJoin->where('be.ben_status', '=', '1') ;
            })
            ->first();

            $increments= DB::table('hr_increment AS inc')
            			->where('inc.associate_id', $request->associate_id)
                        ->where('inc.status', 1)
            			->select([
            				'inc.associate_id',
                            'inc.current_salary',
            				'in_t.increment_type',
                            'inc.increment_amount',
                            'inc.amount_type',
            				'inc.effective_date'
            			])
                        ->leftJoin('hr_increment_type AS in_t', 'in_t.id', 'inc.increment_type')
            			->orderBy('inc.id','DESC')
            			->get();
            $promotions= DB::table('hr_promotion AS p')
            			->where('p.associate_id', $request->associate_id)
            			->select([
            				'p.associate_id',
            				'p.effective_date',
            				'p.current_designation_id',
            				'd.hr_designation_name'
            			])
            			->leftJoin('hr_designation AS d', 'p.current_designation_id', 'd.hr_designation_id')
            			->orderBy('id','DESC')
            			->get();
            $structure= DB::table('hr_salary_structure')
            				->where('status',1)
            				->orderBy('id', 'DESC')
            				->first();

            $incCount= count($increments);
            $promCount= count($promotions);
            $oVal = (object)[];

            if($incCount> $promCount){
            	for($i=0; $i<$incCount; $i++){
                    if($increments[$i]->amount_type == 1){
                        $increment_amount= $increments[$i]->increment_amount;
                        $current_salary= $increments[$i]->current_salary+$increment_amount;
                        
                    }
                    else{
                        $increment_amount= ($increments[$i]->current_salary*$increments[$i]->amount_type)/100;
                        $current_salary= $increments[$i]->current_salary+$increment_amount;
                        $increment_amount= $increment_amount."( ".$increments[$i]->increment_amount."%)";
                    }
                    
            		$oVal->sl[]=$i+1;
            		$oVal->gross[]= $current_salary;
            		$oVal->medical[]= $structure->medical; 
            		$oVal->conv[]= $structure->transport; 
            		$oVal->food[]= $structure->food; 
            		$basic=($current_salary-($structure->medical+$structure->transport+$structure->food))/$structure->basic;
            		$oVal->basic[]= number_format($basic, 3, '.', '');
            		$houseRent = ($current_salary-($structure->medical+$structure->transport+$structure->food))-$basic;
                    $oVal->increment_amount[]= $increment_amount;
                    $oVal->reason[]= $increments[$i]->increment_type; 
            		$oVal->house[]= number_format($houseRent, 3, '.', '');
            		$oVal->incEfDate[]= date('d-m-Y',strtotime($increments[$i]->effective_date)); 
            		if($i<$promCount){
            			$oVal->pomEfDate[]= date('d-m-Y',strtotime($promotions[$i]->effective_date));
            			$oVal->designation[]= $promotions[$i]->hr_designation_name;
            		}
            		else{
            			$oVal->pomEfDate[]= null;
            			$oVal->designation[]= null;
            		}

            	}
            }
            else{
            	for($i=0; $i<$promCount; $i++){
            		$oVal->sl[]=$i+1;
            		$oVal->pomEfDate[]= date('d-m-Y',strtotime($promotions[$i]->effective_date));
            		$oVal->designation[]= $promotions[$i]->hr_designation_name;
            		if($i<$incCount){
                        if($increments[$i]->amount_type == 1){
                            $increment_amount= $increments[$i]->increment_amount;
                            $current_salary= $increments[$i]->current_salary+$increment_amount;
                            
                        }
                        else{
                            $increment_amount= ($increments[$i]->current_salary*$increments[$i]->amount_type)/100;
                            $current_salary= $increments[$i]->current_salary+$increment_amount;
                            $increment_amount= $increment_amount."( ".$increments[$i]->increment_amount."%)";
                        }
            			$oVal->gross[]= $current_salary;
	            		$oVal->medical[]= $structure->medical; 
	            		$oVal->conv[]= $structure->transport; 
	            		$oVal->food[]= $structure->food; 
	            		$basic=($current_salary-($structure->medical+$structure->transport+$structure->food))/$structure->basic;
                        $oVal->increment_amount[]= $increment_amount;
                        $oVal->reason[]= $increments[$i]->increment_type;
	            		$oVal->basic[]= number_format($basic, 3, '.', '');
	            		$houseRent = ($current_salary-($structure->medical+$structure->transport+$structure->food))-$basic; 
	            		$oVal->house[]= number_format($houseRent, 3, '.', ''); 
	            		$oVal->incEfDate[]= date('d-m-Y',strtotime($increments[$i]->effective_date)); 
            		}
            		else{
            			$oVal->gross[]= null;
	            		$oVal->medical[]= null; 
	            		$oVal->conv[]= null; 
	            		$oVal->food[]= null; 
	            		$oVal->basic[]= null;
	            		$oVal->house[]= null; 
	            		$oVal->incEfDate[]= null; 
            		}
            	}
            }
            if($incCount> $promCount){
            $ret=$incCount;
            }
            else{
            	$ret=$promCount;
            }
    	}

        $lineList= DB::table('hr_line')
                        ->where('hr_line_unit_id', $request->unit_id)
                        ->pluck('hr_line_name','hr_line_id');

        $floorList= DB::table('hr_floor')
                        ->where('hr_floor_unit_id', $request->unit_id)
                        ->pluck('hr_floor_name', 'hr_floor_id');

        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
        $sectionList= Section::pluck('hr_section_name', 'hr_section_id');

        if ($request->get('pdf') == true) 
        { 
            $pdf = PDF::loadView('hr/reports/increment_report_pdf', [
                'info' => $info,
                'oVal' => $oVal,
                'ret' => $ret 
            ]);
            return $pdf->download('Increment_Report_'.date('d_F_Y').'.pdf');
        }

        return view('hr/reports/increment_report', compact('info', 'oVal','ret','unitList','sectionList', 'lineList', 'floorList'));
    }


    public function searchAssociate(Request $request){
        $data = [];
        $unit_id   = null;
        $floor_id   = null;
        $line_id   = null;

        if($request->has('keyword'))
        {
            $search = $request->keyword;
            if($request->has('unit_id')){
                $unit_id = $request->unit_id;
            }
            if($request->has('floor_id')){
                $floor_id =$request->floor_id;
            }
            if($request->has('line_id')){
                $line_id =$request->line_id;
            }
            $data = Employee::select("associate_id", DB::raw('CONCAT_WS(" - ", associate_id, as_name) AS associate_name'))
                ->where(function($query) use($search){
                    $query->where("associate_id", "LIKE" , "%{$search}%");
                    $query->orWhere('as_name', "LIKE" , "%{$search}%");
                }) 
                ->where(function($query) use($unit_id, $floor_id, $line_id){
                    if($unit_id != null){
                        $query->where("as_unit_id", $unit_id);
                    }
                    if($floor_id != null){
                        $query->where("as_floor_id", $floor_id);
                    }
                    if($floor_id != null){
                        $query->where("as_line_id", $line_id);
                    }
                }) 
                ->get();
        }
        return response()->json($data);

    }
}

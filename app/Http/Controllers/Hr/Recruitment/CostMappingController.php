<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Models\Hr\Benefits;
use App\Models\Hr\MapCostUnit;
use App\Models\Hr\MapCostFloor;
use App\Models\Hr\MapCostLine;
use App\Models\Hr\MapCostArea;
use App\Models\Hr\MapCostDepartment;
use App\Models\Hr\MapCostSection;
use App\Models\Hr\MapCostSubSection;
use App\Models\Hr\Employee;
use DB, ACL, Validator,Auth,DataTables;
class CostMappingController extends Controller
{
    public function showForm(){
    	$unitList= Unit::select('hr_unit_name', 'hr_unit_id')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->get();
    	$floorList= Floor::select('hr_floor_id','hr_floor_unit_id', 'hr_floor_name')->get();
    	$lineList= Line::select('hr_line_id','hr_line_floor_id', 'hr_line_name')->get();
        $areaList= Area::select('hr_area_name','hr_area_id')->get();
        $deptList= Department::select('hr_department_name','hr_department_id', 'hr_department_area_id')->get();
        $sectionList= Section::select('hr_section_name','hr_section_id', 'hr_section_department_id')->get();
        $subSecList= Subsection::select('hr_subsec_name','hr_subsec_id', 'hr_subsec_section_id')->get();

    	return view('hr/recruitment/cost_mapping', compact('unitList', 'floorList', 'lineList','areaList','deptList','sectionList','subSecList'));
    }
    public function getAssGross(Request $request){
    	// dd($request->associate_id);
    	$data= (int)Benefits::where('ben_as_id', $request->associate_id)->orderBy('ben_id', "DESC")->pluck('ben_current_salary')->first();
    	return $data;
    }
    // unit mapping store
    public function unitMapStore(Request $request)
    {
        $user = Auth::user()->associate_id;
        //Store data for unit mapping
        if($request->has('selected_unit')){
            for($i=0; $i<sizeof($request->selected_unit); $i++){
                $u_id= $request->selected_unit[$i];
                $unit_amount= $request->unit_percent[$u_id];
                MapCostUnit::insert([
                    'associate_id'=>$request->associate_id,
                    'unit_id'=>$u_id,
                    'unit_percent'=>$unit_amount,
                    'created_by'=>$user
                ]);
                $last_unit_id= DB::getPdo()->lastInsertId();
                for($j=0; $j<sizeof($request->selected_floor); $j++){
                    $f_id= $request->selected_floor[$j];
                    if(isset($request->floor_percent[$u_id][$f_id])){
                        $floor_amount= $request->floor_percent[$u_id][$f_id];
                        MapCostFloor::insert([
                            'associate_id'=>$request->associate_id,
                            'unit_id' => $last_unit_id,
                            'floor_id' => $f_id,
                            'floor_percent' => $floor_amount,
                            'created_by' => $user
                        ]);
                        $last_floor_id= DB::getPdo()->lastInsertId();
                        for($k=0; $k<sizeof($request->selected_line); $k++){
                            $l_id= $request->selected_line[$k];
                            if(isset($request->line_percent[$u_id][$f_id][$l_id])){
                                $line_amount= $request->line_percent[$u_id][$f_id][$l_id];
                                MapCostLine::insert([
                                    'associate_id' => $request->associate_id,
                                    'floor_id' => $last_floor_id,
                                    'line_id' => $l_id,
                                    'line_percent' => $line_amount,
                                    'created_by' => $user
                                ]);
                            }
                        }
                    }
                }
            }
            return back()
            ->with("success", "Unit Mapping Stored Successfully!!");
        }
        else{
            return back()
                ->with("error", "Invalid input!!");
        }

    }
    //area mapping store
    public function areaMapStore(Request $request)
    {

        $user= Auth::user()->associate_id;
        if($request->has('selected_area')){
            for($i=0; $i<sizeof($request->selected_area); $i++){
                $a_id= $request->selected_area[$i];
                $a_amount= $request->area_percent[$a_id];
                MapCostArea::insert([
                    'associate_id' => $request->associate_id_area,
                    'area_id' => $a_id,
                    'area_percent' => $a_amount,
                    'created_by' => $user
                ]);
                $last_area_id= DB::getPdo()->lastInsertId();
                for($j=0; $j<sizeof($request->selected_dept); $j++){
                    $dept_id= $request->selected_dept[$j];
                    if(isset($request->dept_percent[$a_id][$dept_id])){
                        $dept_amount= $request->dept_percent[$a_id][$dept_id];
                        MapCostDepartment::insert([
                            'associate_id' => $request->associate_id_area,
                            'area_id' => $last_area_id,
                            'department_id' => $dept_id,
                            'department_percent' => $dept_amount,
                            'created_by' => $user
                        ]);
                        $last_dept_id= DB::getPdo()->lastInsertId();
                        for($k=0; $k<sizeof($request->selected_section); $k++){
                            $sec_id= $request->selected_section[$k];
                            if(isset($request->section_percent[$a_id][$dept_id][$sec_id])){
                                $sec_amount= $request->section_percent[$a_id][$dept_id][$sec_id];
                                MapCostSection::insert([
                                    'associate_id' => $request->associate_id_area,
                                    'department_id'=> $last_dept_id,
                                    'section_id'=> $sec_id, 
                                    'section_percent'=> $sec_amount,
                                    'created_by'=> $user
                                ]);
                                $last_sec_id= DB::getPdo()->lastInsertId();
                                for($m=0; $m<sizeof($request->selected_subSection); $m++){
                                    $sub_sec_id= $request->selected_subSection[$m];
                                    if(isset($request->subSection_percent[$a_id][$dept_id][$sec_id][$sub_sec_id])){
                                        $sub_sec_amount= $request->subSection_percent[$a_id][$dept_id][$sec_id][$sub_sec_id];
                                        MapCostSubSection::insert([
                                            'associate_id' => $request->associate_id_area,
                                            'section_id'=> $last_sec_id,
                                            'sub_section_id'=>$sub_sec_id,
                                            'sub_section_percent'=>$sub_sec_amount,
                                            'created_by'=>$user
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return back()
                ->with("success", "Area Mapping Stored Successfully!!");
        }
        else{
            return back()
                ->with("error", "Invalid input!!");
        }

    }
    public function mapList(){
        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name');
        $areaList= Area::pluck('hr_area_name');
        return view('hr/recruitment/cost_mapping_list', compact('unitList', 'areaList'));
    }
    public function mapData(){

        $first = DB::table('hr_cost_mapping_unit')
            ->select("associate_id");
        $data = DB::table('hr_cost_mapping_area')
            ->union($first)
            ->select("associate_id")
            ->get();
            $iter=1;
        foreach($data AS $associate){
            $associate->sl= $iter;
            $associate->as_name = DB::table('hr_as_basic_info')
                                    ->where('associate_id', $associate->associate_id)
                                    ->pluck('as_name')
                                    ->first();

            $as_areas= DB::table('hr_cost_mapping_area AS cma')
                        ->where('cma.associate_id', $associate->associate_id)
                        ->leftJoin('hr_area AS ar', 'cma.area_id', 'ar.hr_area_id')
                        ->pluck('ar.hr_area_name');
       
            $areas= "";
            for($i=0; $i<sizeof($as_areas); $i++){
                $areas.=$as_areas[$i];
                if($i<sizeof($as_areas)-1) $areas.=", ";
            }
            $associate->areas= $areas;

            $as_units= DB::table('hr_cost_mapping_unit AS cmu')
                            ->where('cmu.associate_id', $associate->associate_id)
                            ->leftJoin('hr_unit AS u', 'cmu.unit_id', 'u.hr_unit_id')
                            ->pluck('u.hr_unit_name');
            $units= "";
            for($i=0; $i<sizeof($as_units); $i++){
                $units.=$as_units[$i];
                if($i<sizeof($as_units)-1) $units.=", ";
            }
            $associate->units= $units;
            $iter++;
        }

        return DataTables::of($data)
                ->addColumn('action', function($data){
                    return "<div class=\"btn-group\">  
                        <a href=".url('hr/operation/cost_mapping_edit/'.$data->associate_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                            <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                        </a>
                    </div>";
                    })  
                    ->rawColumns(['action'])
                    ->toJson();
    }
    public function editMap(Request $request){
        $unitList= Unit::select('hr_unit_name', 'hr_unit_id')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->get();
        $floorList= Floor::select('hr_floor_id','hr_floor_unit_id', 'hr_floor_name')->get();
        $lineList= Line::select('hr_line_id','hr_line_floor_id', 'hr_line_name')->get();
        $areaList= Area::select('hr_area_name','hr_area_id')->get();
        $deptList= Department::select('hr_department_name','hr_department_id', 'hr_department_area_id')->get();
        $sectionList= Section::select('hr_section_name','hr_section_id', 'hr_section_department_id')->get();
        $subSecList= Subsection::select('hr_subsec_name','hr_subsec_id', 'hr_subsec_section_id')->get();
        
        $associates_unit= MapCostUnit::where('associate_id', $request->id)->get();
        $associates_floor= MapCostFloor::where('associate_id', $request->id)->get();
        $associates_line= MapCostLine::where('associate_id', $request->id)->get();
        $associates_area= MapCostArea::where('associate_id', $request->id)->get();
        $associates_department= MapCostDepartment::where('associate_id', $request->id)->get();
        $associates_section= MapCostSection::where('associate_id', $request->id)->get();
        $associates_sub_section= MapCostSubSection::where('associate_id', $request->id)->get();
        // Prepare unitList with selected units and percents of the given user
        foreach ($unitList AS $unit) {
            $chk=false;
            $val=0;
            foreach($associates_unit AS $as_unit){
                if($unit->hr_unit_id == $as_unit->unit_id && $as_unit->associate_id == $request->id){
                   $chk=true;
                   $val= $as_unit->unit_percent;
                   break;
                }
            }
            $unit->check=$chk;
            $unit->unit_percent=$val;
        }
        // Prepare FloorList with selected floors and percents of the given user
        foreach ($floorList AS $floor) {
            $chk=false;
            $val=0;
            foreach($associates_floor AS $as_floor){
                if($floor->hr_floor_id == $as_floor->floor_id  && $as_floor->associate_id == $request->id){
                   $chk=true;
                   $val= $as_floor->floor_percent;
                   break;
                }
            }
            $floor->check=$chk;
            $floor->floor_percent=$val;
        }
        // Prepare LineList with selected Lines and percents of the given user
        foreach ($lineList AS $line) {
            $chk=false;
            $val=0;
            foreach($associates_line AS $as_line){
                if($line->hr_line_id == $as_line->line_id  && $as_line->associate_id == $request->id){
                   $chk=true;
                   $val= $as_line->line_percent;
                   break;
                }
            }
            $line->check=$chk;
            $line->line_percent=$val;
        }
        // Prepare AreaList with selected Areas and percents of the given user
        foreach ($areaList AS $area) {
            $chk=false;
            $val=0;
            foreach($associates_area AS $as_area){
                if($area->hr_area_id == $as_area->area_id  && $as_area->associate_id == $request->id){
                   $chk=true;
                   $val= $as_area->area_percent;
                   break;
                }
            }
            $area->check=$chk;
            $area->area_percent=$val;
        }
        // Prepare departmentList with selected Departments and percents of the given user
        foreach ($deptList AS $department) {
            $chk=false;
            $val=0;
            foreach($associates_department AS $as_department){
                if($department->hr_department_id == $as_department->department_id  && $as_department->associate_id == $request->id){
                   $chk=true;
                   $val= $as_department->department_percent;
                   break;
                }
            }
            $department->check=$chk;
            $department->department_percent=$val;
        }
        // Prepare sectionList with selected sections and percents of the given user
        foreach ($sectionList AS $section) {
            $chk=false;
            $val=0;
            foreach($associates_section AS $as_section){
                if($section->hr_section_id == $as_section->section_id  && $as_section->associate_id == $request->id){
                   $chk=true;
                   $val= $as_section->section_percent;
                   break;
                }
            }
            $section->check=$chk;
            $section->section_percent=$val;
        }
        // Prepare sectionList with selected sections and percents of the given user
        foreach ($subSecList AS $sub_section) {
            $chk=false;
            $val=0;
            foreach($associates_sub_section AS $as_sub_section){
                if($sub_section->hr_subsec_id == $as_sub_section->sub_section_id  && $as_sub_section->associate_id == $request->id){
                   $chk=true;
                   $val= $as_sub_section->sub_section_percent;
                   break;
                }
            }
            $sub_section->check=$chk;
            $sub_section->sub_section_percent=$val;
        }
        // dd($subSecList);
        // dd($lineList);
        // dd($associates_unit);
        $ret_associate_id= $request->id;
        $salary_info= DB::table('hr_benefits')->where('ben_as_id', $request->id)->where('ben_status', 1)->select('ben_as_id AS associate_id', 'ben_current_salary AS gross_salary')->first();

        return view('hr/recruitment/cost_mapping_edit', compact('unitList', 'floorList', 'lineList','areaList','deptList','sectionList','subSecList', 'salary_info', 'ret_associate_id'));
    }
    public function unitMapUpdate(Request $request){
        // dd($request->all());
        $user = Auth::user()->associate_id;
        //Store data for unit mapping
        if($request->has('selected_unit')){

            //delete rows if(the rows) skipped while updating
            $existing_units= MapCostUnit::where('associate_id', $request->associate_id)
                                        ->pluck('unit_id');
            if(!empty($existing_units)){
                for($i=0; $i<sizeof($existing_units); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_unit); $j++){
                        if($existing_units[$i]== $request->selected_unit[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostUnit::where('associate_id', $request->associate_id)
                                ->where('unit_id', $existing_units[$i])
                                ->delete();
                    }
                }
            }

            $existing_floors= MapCostFloor::where('associate_id', $request->associate_id)
                                        ->pluck('floor_id');
            if(!empty($existing_floors)){
                for($i=0; $i<sizeof($existing_floors); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_floor); $j++){
                        if($existing_floors[$i]== $request->selected_floor[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostFloor::where('associate_id', $request->associate_id)
                                ->where('floor_id', $existing_floors[$i])
                                ->delete();
                    }
                }
            }

            $existing_lines= MapCostLine::where('associate_id', $request->associate_id)
                                        ->pluck('line_id');
            if(!empty($existing_lines)){
                for($i=0; $i<sizeof($existing_lines); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_line); $j++){
                        if($existing_lines[$i]== $request->selected_line[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostLine::where('associate_id', $request->associate_id)
                                ->where('line_id', $existing_lines[$i])
                                ->delete();
                    }
                }
            }
            //end deletation
            for($i=0; $i<sizeof($request->selected_unit); $i++){
                $u_id= $request->selected_unit[$i];
                $unit_amount= $request->unit_percent[$u_id];
                $unit_exists= MapCostUnit::where('unit_id', $u_id)
                                        ->where('associate_id', $request->associate_id)
                                        ->exists();
                if($unit_exists){
                    MapCostUnit::where('unit_id', $u_id)
                                ->where('associate_id', $request->associate_id)
                                ->update([
                                    'associate_id'=>$request->associate_id,
                                    'unit_id'=>$u_id,
                                    'unit_percent'=>$unit_amount,
                                    'updated_by'=>$user
                                ]);
                    $last_unit_id= MapCostUnit::where('unit_id', $u_id)
                                ->where('associate_id', $request->associate_id)
                                ->pluck('id')
                                ->first();
                }
                else{
                    MapCostUnit::insert([
                        'associate_id'=>$request->associate_id,
                        'unit_id'=>$u_id,
                        'unit_percent'=>$unit_amount,
                        'created_by'=>$user
                    ]);
                    $last_unit_id= DB::getPdo()->lastInsertId();
                }
                
                for($j=0; $j<sizeof($request->selected_floor); $j++){

                    $f_id= $request->selected_floor[$j];

                    if(isset($request->floor_percent[$u_id][$f_id])){

                        $floor_amount= $request->floor_percent[$u_id][$f_id];

                        $floor_exists= MapCostFloor::where('associate_id', $request->associate_id)
                                                    ->where('unit_id', $last_unit_id)
                                                    ->where('floor_id', $f_id)
                                                    ->exists();
                        if($floor_exists){
                            MapCostFloor::where('associate_id', $request->associate_id)
                                        ->where('unit_id', $last_unit_id)
                                        ->where('floor_id', $f_id)
                                        ->update([
                                            'associate_id'=>$request->associate_id,
                                            'unit_id' => $last_unit_id,
                                            'floor_id' => $f_id,
                                            'floor_percent' => $floor_amount,
                                            'updated_by' => $user
                                        ]);
                        $last_floor_id= MapCostFloor::where('associate_id', $request->associate_id)
                                                    ->where('unit_id', $last_unit_id)
                                                    ->where('floor_id', $f_id)
                                                    ->pluck('id')
                                                    ->first();
                        }
                        else{
                            MapCostFloor::insert([
                                'associate_id'=>$request->associate_id,
                                'unit_id' => $last_unit_id,
                                'floor_id' => $f_id,
                                'floor_percent' => $floor_amount,
                                'created_by' => $user
                            ]);
                            $last_floor_id= DB::getPdo()->lastInsertId();
                        }

                        
                        for($k=0; $k<sizeof($request->selected_line); $k++){

                            $l_id= $request->selected_line[$k];

                            if(isset($request->line_percent[$u_id][$f_id][$l_id])){

                                $line_amount= $request->line_percent[$u_id][$f_id][$l_id];

                                $line_exists= MapCostLine::where('associate_id', $request->associate_id)
                                                    ->where('floor_id', $last_floor_id)
                                                    ->where('line_id', $l_id)
                                                    ->exists();
                                if($line_exists){
                                    MapCostLine::where('associate_id', $request->associate_id)
                                                ->where('floor_id', $last_floor_id)
                                                ->where('line_id', $l_id)
                                                ->update([
                                                'associate_id' => $request->associate_id,
                                                'floor_id' => $last_floor_id,
                                                'line_id' => $l_id,
                                                'line_percent' => $line_amount,
                                                'updated_by' => $user
                                            ]);
                                }
                                else{
                                    MapCostLine::insert([
                                        'associate_id' => $request->associate_id,
                                        'floor_id' => $last_floor_id,
                                        'line_id' => $l_id,
                                        'line_percent' => $line_amount,
                                        'created_by' => $user
                                    ]);
                                }
                                
                            }
                        }
                    }
                }
            }
            return back()
            ->with("success", "Unit Mapping Updated Successfully!!");
        }
        else{
            return back()
                ->with("error", "Invalid input!!");
        }
    }
    public function areaMapUpdate(Request $request){
        // dd($request->all());
        $user= Auth::user()->associate_id;
        if($request->has('selected_area')){
            $req_ass= $request->associate_id_area;
            //delete rows if(the rows) skipped while updating
            $existing_areas= MapCostArea::where('associate_id', $req_ass)
                                        ->pluck('area_id');
            if(!empty($existing_areas)){
                for($i=0; $i<sizeof($existing_areas); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_area); $j++){
                        if($existing_areas[$i]== $request->selected_area[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostArea::where('associate_id', $req_ass)
                                ->where('area_id', $existing_areas[$i])
                                ->delete();
                    }
                }
            }

            $existing_depts= MapCostDepartment::where('associate_id', $req_ass)
                                        ->pluck('department_id');
            if(!empty($existing_depts)){
                for($i=0; $i<sizeof($existing_depts); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_dept); $j++){
                        if($existing_depts[$i]== $request->selected_dept[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostDepartment::where('associate_id', $req_ass)
                                ->where('department_id', $existing_depts[$i])
                                ->delete();
                    }
                }
            }

            $existing_sections= MapCostSection::where('associate_id', $req_ass)
                                        ->pluck('section_id');
            if(!empty($existing_sections)){
                for($i=0; $i<sizeof($existing_sections); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_section); $j++){
                        if($existing_sections[$i]== $request->selected_section[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostSection::where('associate_id', $req_ass)
                                ->where('section_id', $existing_sections[$i])
                                ->delete();
                    }
                }
            }

            $existing_subSections= MapCostSubSection::where('associate_id', $req_ass)
                                        ->pluck('sub_section_id');
            if(!empty($existing_subSections)){
                for($i=0; $i<sizeof($existing_subSections); $i++){
                    $chk=false;
                    for($j=0; $j<sizeof($request->selected_subSection); $j++){
                        if($existing_subSections[$i]== $request->selected_subSection[$j]){
                            $chk=true;
                        }
                    }
                    if(!$chk){
                        MapCostSubSection::where('associate_id', $req_ass)
                                ->where('sub_section_id', $existing_subSections[$i])
                                ->delete();
                    }
                }
            }
            //end deletaion

            for($i=0; $i<sizeof($request->selected_area); $i++){
                $a_id= $request->selected_area[$i];

                $a_amount= $request->area_percent[$a_id];
                $area_exists= MapCostArea::where('associate_id', $req_ass)
                                ->where('area_id', $a_id)
                                ->exists();
                if($area_exists){
                    MapCostArea::where('associate_id', $req_ass)
                                ->where('area_id', $a_id)
                                ->update([
                                'associate_id' => $request->associate_id_area,
                                'area_id' => $a_id,
                                'area_percent' => $a_amount,
                                'updated_by' => $user
                            ]);
                    $last_area_id= MapCostArea::where('associate_id', $req_ass)
                                ->where('area_id', $a_id)
                                ->pluck('id')
                                ->first();
                }
                else{
                    MapCostArea::insert([
                        'associate_id' => $request->associate_id_area,
                        'area_id' => $a_id,
                        'area_percent' => $a_amount,
                        'created_by' => $user
                    ]);
                    $last_area_id= DB::getPdo()->lastInsertId();
                }
                for($j=0; $j<sizeof($request->selected_dept); $j++){

                    $dept_id= $request->selected_dept[$j];

                    if(isset($request->dept_percent[$a_id][$dept_id])){
                        

                        $dept_amount= $request->dept_percent[$a_id][$dept_id];

                        $dept_exists= MapCostDepartment::where('associate_id', $req_ass)
                                        ->where('area_id', $last_area_id)
                                        ->where('department_id', $dept_id)
                                        ->exists();

                        if($dept_exists){
                            MapCostDepartment::where('associate_id', $req_ass)
                                        ->where('area_id', $last_area_id)
                                        ->where('department_id', $dept_id)
                                        ->update([
                                            'associate_id' => $request->associate_id_area,
                                            'area_id' => $last_area_id,
                                            'department_id' => $dept_id,
                                            'department_percent' => $dept_amount,
                                            'updated_by' => $user
                                        ]);
                        $last_dept_id= MapCostDepartment::where('associate_id', $req_ass)
                                        ->where('area_id', $last_area_id)
                                        ->where('department_id', $dept_id)
                                        ->pluck('id')
                                        ->first();
                        }
                        else{
                            MapCostDepartment::insert([
                                'associate_id' => $request->associate_id_area,
                                'area_id' => $last_area_id,
                                'department_id' => $dept_id,
                                'department_percent' => $dept_amount,
                                'created_by' => $user
                            ]);
                            $last_dept_id= DB::getPdo()->lastInsertId();
                        }
                        
                        for($k=0; $k<sizeof($request->selected_section); $k++){
                            $sec_id= $request->selected_section[$k];
                            if(isset($request->section_percent[$a_id][$dept_id][$sec_id])){

                                $sec_amount= $request->section_percent[$a_id][$dept_id][$sec_id];

                                $section_exists= MapCostSection::where('associate_id', $req_ass)
                                        ->where('section_id', $sec_id)
                                        ->where('department_id', $last_dept_id)
                                        ->exists();
                                if($section_exists){
                                    MapCostSection::where('associate_id', $req_ass)
                                            ->where('section_id', $sec_id)
                                            ->where('department_id', $last_dept_id)
                                            ->update([
                                                'associate_id' => $request->associate_id_area,
                                                'department_id'=> $last_dept_id,
                                                'section_id'=> $sec_id, 
                                                'section_percent'=> $sec_amount,
                                                'updated_by'=> $user
                                            ]);
                                    $last_sec_id= MapCostSection::where('associate_id', $req_ass)
                                        ->where('section_id', $sec_id)
                                        ->where('department_id', $last_dept_id)
                                        ->pluck('id')
                                        ->first();
                                }
                                else{
                                    MapCostSection::insert([
                                        'associate_id' => $request->associate_id_area,
                                        'department_id'=> $last_dept_id,
                                        'section_id'=> $sec_id, 
                                        'section_percent'=> $sec_amount,
                                        'created_by'=> $user
                                    ]);
                                    $last_sec_id= DB::getPdo()->lastInsertId();
                                }
                               
                                for($m=0; $m<sizeof($request->selected_subSection); $m++){
                                    $sub_sec_id= $request->selected_subSection[$m];
                                    if(isset($request->subSection_percent[$a_id][$dept_id][$sec_id][$sub_sec_id])){

                                        $sub_sec_amount= $request->subSection_percent[$a_id][$dept_id][$sec_id][$sub_sec_id];

                                        $subSec_exists= MapCostSubSection::where('associate_id', $req_ass)
                                                    ->where('section_id', $last_sec_id)
                                                    ->where('sub_section_id', $sub_sec_id)
                                                    ->exists();

                                        if($subSec_exists){
                                            MapCostSubSection::where('associate_id', $req_ass)
                                                    ->where('section_id', $last_sec_id)
                                                    ->where('sub_section_id', $sub_sec_id)
                                                    ->update([
                                                        'associate_id' => $request->associate_id_area,
                                                        'section_id'=> $last_sec_id,
                                                        'sub_section_id'=>$sub_sec_id,
                                                        'sub_section_percent'=>$sub_sec_amount,
                                                        'updated_by'=>$user
                                                    ]);
                                        }
                                        else{
                                            MapCostSubSection::insert([
                                                'associate_id' => $request->associate_id_area,
                                                'section_id'=> $last_sec_id,
                                                'sub_section_id'=>$sub_sec_id,
                                                'sub_section_percent'=>$sub_sec_amount,
                                                'created_by'=>$user
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return back()
                ->with("success", "Area Mapping Updated Successfully!!");
        }
        else{
            return back()
                ->with("error", "Invalid input!!");
        }
    }

        #Default unit cost mapping
    public function defaultCostMapUnit($ass_id, $emp_type_id){

        $user= Auth::user()->associate_id;
        if($emp_type_id==1){
            // if associate type is management then distribute his/her cost to all floors and lines of that unit
            $ass_info= Employee::where('associate_id', $ass_id)
                        ->select(
                            'as_unit_id'
                        )
                        ->first();

            $floor_list= Floor::where('hr_floor_unit_id', $ass_info->as_unit_id)
                                ->where('hr_floor_status',1)
                                ->pluck('hr_floor_id');
            

            MapCostUnit::insert([
                'associate_id' => $ass_id,
                'unit_id' => $ass_info->as_unit_id,
                'unit_percent' => 100,
                'created_by' => $user,
            ]);
            $last_unit_id= DB::getPdo()->lastInsertId();
            $floor_num= sizeof($floor_list);
            if($floor_num){
                $floor_percent= round((100/$floor_num),3);
                for($i=0; $i<$floor_num; $i++){
                    MapCostFloor::insert([
                        'associate_id' => $ass_id,
                        'unit_id' => $last_unit_id,
                        'floor_id' => $floor_list[$i],
                        'floor_percent' => $floor_percent,
                        'created_by' => $user,
                    ]);
                    $last_floor_id= DB::getPdo()->lastInsertId();

                    $line_list= Line::where('hr_line_unit_id', $ass_info->as_unit_id)
                                ->where('hr_line_floor_id', $floor_list[$i])
                                ->where('hr_line_status',1)
                                ->pluck('hr_line_id');

                    $line_num= sizeof($line_list);
                    if($line_num){
                        $line_percent= round(($floor_percent/$line_num), 3);
                        for($j=0; $j<$line_num; $j++){
                            MapCostLine::insert([
                                'associate_id' => $ass_id,
                                'floor_id' => $last_floor_id,
                                'line_id' => $line_list[$j],
                                'line_percent' => $line_percent,
                                'created_by' => $user,
                            ]);
                        }
                    }
                }
            }
        }
        else{
            // if associate type is worker or stuff then assign his/her cost to the specific unit, floor and line they are assigned for

            $ass_info= Employee::where('associate_id', $ass_id)
                        ->select(
                            'as_unit_id',
                            'as_floor_id',
                            'as_line_id'
                        )
                        ->first();
            MapCostUnit::insert([
                'associate_id' => $ass_id,
                'unit_id' => $ass_info->as_unit_id,
                'unit_percent' => 100,
                'created_by' => $user,
            ]);
            $last_unit_id= DB::getPdo()->lastInsertId();
            if($ass_info->as_floor_id){
            MapCostFloor::insert([
                'associate_id' => $ass_id,
                'unit_id' => $last_unit_id,
                'floor_id' => $ass_info->as_floor_id,
                'floor_percent' => 100,
                'created_by' => $user,
            ]);
            $last_floor_id= DB::getPdo()->lastInsertId();
            if($ass_info->as_line_id){
            MapCostLine::insert([
                'associate_id' => $ass_id,
                'floor_id' => $last_floor_id,
                'line_id' => $ass_info->as_line_id,
                'line_percent' => 100,
                'created_by' => $user,
            ]);
            }
        }
        }
    }
        #Default Area Cost Mapping
    public function defaultCostMapArea($ass_id, $emp_type_id){

        $user= Auth::user()->associate_id;
        if($emp_type_id==1){
            // if associate type is management then distribute his/her cost to all Departmnets, Sections and Sub-Sections of that Area

            $ass_info= Employee::where('associate_id', $ass_id)
                        ->select(
                            'as_area_id'
                        )
                        ->first();
            MapCostArea::insert([
                'associate_id' => $ass_id,
                'area_id' => $ass_info->as_area_id,
                'area_percent' => 100,
                'created_by' => $user
            ]);
            $last_area_id= DB::getPdo()->lastInsertId();

            $department_list= Department::where('hr_department_area_id', $ass_info->as_area_id)
                                        ->where('hr_department_status', 1)
                                        ->pluck('hr_department_id');
            $department_num= sizeof($department_list);

            if($department_num){
                $department_percent= round((100/$department_num),3);
                for($i=0; $i<$department_num; $i++){
                    MapCostDepartment::insert([
                        'associate_id' => $ass_id,
                        'area_id' => $last_area_id,
                        'department_id' => $department_list[$i],
                        'department_percent' => $department_percent,
                        'created_by' => $user
                    ]);
                    $last_dept_id= DB::getPdo()->lastInsertId();

                    $section_list= Section::where('hr_section_area_id', $ass_info->as_area_id)
                                        ->where('hr_section_department_id', $department_list[$i])
                                        ->where('hr_section_status',1)
                                        ->pluck('hr_section_id');

                    $section_num= sizeof($section_list);
                    if($section_num){
                        $section_percent= round(($department_percent/$section_num),3);
                        for($j=0; $j<$section_num; $j++){
                            MapCostSection::insert([
                                'associate_id' => $ass_id,
                                'department_id' => $last_dept_id,
                                'section_id' => $section_list[$j],
                                'section_percent' => $section_percent,
                                'created_by' => $user
                            ]);
                            $last_sec_id= DB::getPdo()->lastInsertId();

                            $subSection_list = Subsection::where('hr_subsec_area_id', $ass_info->as_area_id)
                                                ->where('hr_subsec_department_id', $department_list[$i])
                                                ->where('hr_subsec_section_id', $section_list[$j])
                                                ->where('hr_subsec_status', 1)
                                                ->pluck('hr_subsec_id');

                            $subSection_num= sizeof($subSection_list);

                            if($subSection_num){
                                $subSection_percent= round(($section_percent/$subSection_num),3);
                                for($k=0; $k<$subSection_num; $k++){
                                    MapCostSubSection::insert([
                                        'associate_id' => $ass_id,
                                        'section_id' => $last_sec_id,
                                        'sub_section_id' => $subSection_list[$k],
                                        'sub_section_percent' => $subSection_percent,
                                        'created_by' => $user
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

        }
        else{
            //If associate type is worker of stuff then assign hir/her cost to the Area, Department, Section and Sub-Section they are assigned for 
            $ass_info= Employee::where('associate_id', $ass_id)
                        ->select(
                            'as_area_id',
                            'as_department_id',
                            'as_section_id',
                            'as_subsection_id'
                        )
                        ->first();

            MapCostArea::insert([
                'associate_id' => $ass_id,
                'area_id' => $ass_info->as_area_id,
                'area_percent' => 100,
                'created_by' => $user
            ]);
            $last_area_id= DB::getPdo()->lastInsertId();
            MapCostDepartment::insert([
                'associate_id' => $ass_id,
                'area_id' => $last_area_id,
                'department_id' => $ass_info->as_department_id,
                'department_percent' => 100,
                'created_by' => $user
            ]);
            $last_dept_id= DB::getPdo()->lastInsertId();
            MapCostSection::insert([
                'associate_id' => $ass_id,
                'department_id' => $last_dept_id,
                'section_id' => $ass_info->as_section_id,
                'section_percent' => 100,
                'created_by' => $user
            ]);
            $last_sec_id= DB::getPdo()->lastInsertId();
            MapCostSubSection::insert([
                'associate_id' => $ass_id,
                'section_id' => $last_sec_id,
                'sub_section_id' => $ass_info->as_subsection_id,
                'sub_section_percent' => 100,
                'created_by' => $user
            ]);
        }
    } 
}

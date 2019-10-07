<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Benefits;
use App\Models\Hr\Designation;
use App\Models\Hr\SalaryStructure;
use App\Models\Hr\Unit;
use App\Models\Hr\EmpType;
use App\Models\Hr\Employee;
use App\Models\Hr\Increment;
use App\Models\Hr\Promotion;
use App\Models\Hr\FixedSalary;
use App\Models\Hr\IncrementType;
use App\Models\Hr\OtherBenefits;
use App\Models\Hr\OtherBenefitAssign;
use Validator,DB, DataTables, ACL,Auth;

class BenefitController extends Controller
{
    public function benefits()
    {
        ACL::check(["permission" => "hr_recruitment_op_benefit"]);
        #-----------------------------------------------------------# 
        $structure= DB::table('hr_salary_structure')->where('status', 1)->select(['hr_salary_structure.*'])->first();


        return view('hr/recruitment/benefits', compact('structure'));
    }

    public function benefitStore(Request $request)
    {
        ACL::check(["permission" => "hr_recruitment_op_benefit"]);
        #-----------------------------------------------------------# 
        $user= Auth::user()->associate_id;
        $validator= Validator::make($request->all(), [
            'ben_as_id'           => 'unique:hr_benefits|max:10|min:10|alpha_num',
            'ben_joining_salary'  => 'required',
            'ben_cash_amount'     => 'required',
            'ben_bank_amount'     => 'required',
            'ben_basic'           => 'required',
            'ben_house_rent'      => 'required',
            'ben_medical'         => 'required',
            'ben_transport'       => 'required',
            'ben_food'            => 'required'
        ]);

        if($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fileds!.');
        }
        else
        {
            $benefits= new Benefits();
            $benefits->ben_as_id               = $request->ben_as_id ;
            $benefits->ben_joining_salary      = $request->ben_joining_salary ;
            $benefits->ben_current_salary      = $request->ben_joining_salary ;
            $benefits->ben_cash_amount         = $request->ben_cash_amount ;
            $benefits->ben_bank_amount         = $request->ben_bank_amount ;
            $benefits->ben_basic               = $request->ben_basic ;
            $benefits->ben_house_rent          = $request->ben_house_rent ;
            $benefits->ben_medical             = $request->ben_medical ;
            $benefits->ben_transport           = $request->ben_transport ;
            $benefits->ben_food                = $request->ben_food;
            $benefits->ben_status              = 1 ;
            $benefits->ben_updated_by          = $user;
            $benefits->ben_updated_at          = date('Y-m-d H:i:s');

            if ($benefits->save())
                {

                    if($request->fixed_check){
                        $fixSalary= new FixedSalary();
                        $fixSalary->as_id           = $request->ben_as_id ;
                        $fixSalary->fixed_amount    = $request->full_salary;
                        $fixSalary->created_by      = $user;
                        $fixSalary->created_at      = date('Y-m-d H:i:s');
                        $fixSalary->save();

                    }
                    return back()
                        ->withInput()
                        ->with('success', 'Save Successful.');

                }   
                else
                {
                    return back()                    
                        ->withInput()->with('error', 'Please try again.');
                }
            }
    }

    
    public function benefitList()
    {
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------# 
        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');

        return view('hr/payroll/benefit_list', compact('unitList'));
    }

    public function benefitListData()
    {
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------# 
        $data = DB::table('hr_benefits AS b')
                ->where('b.ben_status',1)
                ->select(
                    'b.ben_id',
                    'b.ben_as_id',
                    'b.ben_joining_salary',
                    'b.ben_current_salary',
                    'b.ben_basic',
                    'a.as_name',
                    'a.as_unit_id',
                    'u.hr_unit_name AS unit_name'
                )
                ->leftJoin('hr_as_basic_info as a', 'a.associate_id', '=', 'b.ben_as_id')
                ->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'a.as_unit_id')
                ->whereIn('a.as_unit_id', auth()->user()->unit_permissions())
                ->orderBy('b.ben_id', 'desc')
                ->get();

            return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/payroll/benefit/'.$data->ben_as_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>  
                    <a href=".url('hr/payroll/benefit_edit/'.$data->ben_as_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['action'])
            ->toJson();
    }


    public function benefitEdit($id)
    {
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------# 

        $benefits= DB::table('hr_benefits AS b')
            ->where('b.ben_as_id','=', $id)
            ->where('b.ben_status','=','1')
            ->select(
                'b.*'
            )
            ->first();
        $fixedSalary= DB::table('hr_fixed_emp_salary AS f')
            ->where('f.as_id','=', $id)
            
            ->select(
                'f.fixed_amount'
            )
            ->first();    
            $structure= DB::table('hr_salary_structure')
                            ->where('status', 1)
                            ->select([
                                'hr_salary_structure.*'
                            ])
                            ->first();
            // dd($structure);
            if(!empty($structure)){
                $benefits->ben_medical= $structure->medical;
                $benefits->ben_food= $structure->food;
                $benefits->ben_transport= $structure->transport;

                $basic=($benefits->ben_current_salary-($structure->medical+$structure->transport+$structure->food))/$structure->basic;
                $benefits->ben_basic= number_format($basic, 3, '.', '');

                $current = ($benefits->ben_current_salary-($structure->medical+$structure->transport+$structure->food))-$basic;
                $benefits->ben_house_rent =number_format($current, 3, '.', '');
            }
        //Extra benefit item list
        $other_bnf_items= OtherBenefits::get();
        //associates existing Extra benefits
        $other_bnf_list= OtherBenefitAssign::where('associate_id', $id)->orderBy('item_id', "ASC")->pluck('item_id');

        //this code will add an extra column CHK to check whether one item is 
        //selected for that user or not, if seleted then we will show the checkbox as 
        //checked
        foreach ($other_bnf_items as $obi) {
            $chk=false;
            for($i=0; $i<sizeof($other_bnf_list); $i++) {
                if($obi->id == $other_bnf_list[$i]){
                    $chk=true;
                    break;
                }
            }
            if($chk){
                $obi->chk=1;
            }
            else{
                $obi->chk=0;
            }
        }
        //end chk code
        return view('hr/payroll/benefit_edit',compact('benefits', 'structure', 'other_bnf_items','fixedSalary'));
    }


    public function benefitUpdate(Request $request)
    {
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------# 
        $user= Auth::user()->associate_id;
        $validator= Validator::make($request->all(), [
            'ben_id'                  => 'required|max:11',
            'ben_as_id'               => 'required|max:10|min:10|alpha_num',
            'ben_current_salary'      => 'required',
            'ben_cash_amount'         => 'required',
            'ben_bank_amount'         => 'required',
            'ben_basic'               => 'required',
            'ben_house_rent'          => 'required',
            'ben_medical'             => 'required',
            'ben_transport'           => 'required',
            'ben_food'                => 'required'
        ]);
 
        if($validator->fails()) 
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fileds!.');
        }
        else
        { 
            DB::table('hr_benefits')
            ->where('ben_as_id', $request->ben_as_id)
            ->update([
                'ben_as_id'               => $request->ben_as_id ,
                'ben_current_salary'      => $request->ben_current_salary,
                'ben_cash_amount'         => $request->ben_cash_amount,
                'ben_bank_amount'         => $request->ben_bank_amount,
                'ben_basic'               => $request->ben_basic,
                'ben_house_rent'          => $request->ben_house_rent,
                'ben_medical'             => $request->ben_medical,
                'ben_transport'           => $request->ben_transport,
                'ben_food'                => $request->ben_food,
                'ben_status'              => 1 ,
                'ben_updated_by'        => $user,
                'ben_updated_at'        => date('Y-m-d H:i:s')
            ]);

            // Full Salary Amount Update if Fixed checked 
            if($request->fixed_check){


                    $check=FixedSalary::where('as_id',$request->ben_as_id)->exists();

                    // If already exists then update 
                    if($check){
                            DB::table('hr_fixed_emp_salary')
                               ->where('as_id', $request->ben_as_id)
                               ->update([

                                'fixed_amount'      => $request->full_salary,
                                'updated_by'        => $user,
                                'updated_at'        => NOW()
                            ]);

                            }
                    // If already Not exists then insert      
                    else{ 

                            $fixSalary= new FixedSalary();
                            $fixSalary->as_id           = $request->ben_as_id ;
                            $fixSalary->fixed_amount    = $request->full_salary;
                            $fixSalary->created_by      = $user;
                            $fixSalary->created_at      = date('Y-m-d H:i:s');
                            $fixSalary->save();   
                    } 

            }

            return back()
                ->with('success', 'Benefit Updated Successfully!');
        }
    }
    // Other Benefit Sote
    public function otherBenefitStore(Request $request){
        $user= Auth::user()->associate_id;

        //delete if other benefits exists
        OtherBenefitAssign::where('associate_id', $request->other_associate_id)->delete();

        if($request->has('item_id')){
            for($i=0; $i<sizeof($request->item_id); $i++){
                $data= new OtherBenefitAssign();
                $data->item_id = $request->item_id[$i];
                $data->item_description = $request->item_description[$i];
                $data->item_amount = $request->item_amount[$i];
                $data->associate_id = $request->other_associate_id;
                $data->updated_by = $user;
                $data->save();
            }
            return back()
                    ->with('success', 'Other Benefit saved Successfully!!');
        }
        else{
            return back()
            ->withInput()
            ->with('error', "save unsuccessfull!!!");
        }
        
    }

    public function getBenefitByID(Request $request)
    {
        $result['benefit']= DB::table('hr_benefits')
                    ->where('ben_as_id', $request->id)
                    ->select('hr_benefits.*')
                    ->orderBy('ben_id', 'DESC')
                    ->first();
   
        if($result['benefit']){
            $result['flag']= true;
        }
        else{
            $result['flag']= false;
        }

        return $result;
    }

    public function showIncrementForm()
    {
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------#  
        $unitList = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $typeList= IncrementType::pluck('increment_type', 'id');

        $incrementList= DB::table('hr_increment AS inc')
                            ->where('status', 0)
                            ->select([
                                'inc.id',
                                'inc.associate_id',
                                'b.as_name',
                                'inc.increment_type',
                                'inc.increment_amount',
                                'inc.amount_type',
                                'inc.effective_date',
                            ])
                            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', 'inc.associate_id')
                            ->get();

        return view('hr/payroll/increment', compact('unitList','employeeTypes', 'typeList', 'incrementList'));
    }

    public function storeIncrement(Request $request)
    {
        $created_by= Auth::user()->associate_id;

        if(empty($request->associate_id) || !is_array($request->associate_id)) 
        {
            return back() 
                ->withInput()
                ->with('error', 'Please select at least one associate.');
        }   
        for($i=0; $i<sizeof($request->associate_id); $i++)
        {
            $salary= DB::table('hr_benefits')
                            ->where('ben_as_id', $request->associate_id[$i])
                            ->pluck('ben_current_salary')
                            ->first();

            $doj= DB::table('hr_as_basic_info')
                    ->where('associate_id',$request->associate_id[$i] )
                    ->pluck('as_doj')
                    ->first();
            $eligible_at = date("Y-m-d", strtotime("$doj + 1 year")); 

            $increment= new Increment();
            $increment->associate_id = $request->associate_id[$i] ;
            $increment->current_salary = $salary;
            $increment->increment_type = $request->increment_type;
            $increment->increment_amount = $request->increment_amount ;
            $increment->amount_type = $request->amount_type ;
            $increment->eligible_date = $eligible_at ;
            $increment->effective_date = $request->effective_date ;
            $increment->status = 0 ;
            $increment->created_by = $created_by;
            $increment->created_at = date('Y-m-d H:i:s') ;
            $increment->save();
        }
        return back()
            ->with('success', "Increment Saved Successfully!");
    }

    //Edit Increment
    public function editIncrement($id){

        $unitList = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $typeList= IncrementType::pluck('increment_type', 'id');
        $increment= DB::table('hr_increment AS inc')
                        ->where('id', $id)
                        ->select([
                            'inc.*',
                            'b.as_emp_type_id',
                            'b.as_unit_id'
                        ])
                        ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', 'inc.associate_id')
                        ->first();
        return view('hr/payroll/increment_edit', compact('unitList', 'employeeTypes', 'typeList', 'increment'));
    }

    //Update Increment
    public function updateIncrement(Request $request){
        
        Increment::where('id', $request->increment_id)
                    ->update([
                          "increment_type" => $request->increment_type,
                          "effective_date" => $request->effective_date,
                          "increment_amount" => $request->increment_amount,
                          "amount_type" => $request->amount_type
                    ]);
        return back()
            ->with('success', "Increment updated Successfully!");
    }

    //Increment corn job 
    public function incrementJobs(){
        
        $today= date('Y-m-d');
        $todays_increment= DB::table('hr_increment')
                ->where('effective_date', '<=', $today)
                ->where('status', 0)
                ->limit(10)
                ->get();

        $salary_structure= DB::table('hr_salary_structure AS s')
                                ->where('status', 1)
                                ->select('s.*')
                                ->orderBy('id', 'DESC')
                                ->first();

        if(!empty($todays_increment) && !empty($salary_structure)){

            foreach ($todays_increment as $key => $increment) {

                if($increment->amount_type ==1)
                {
                    $ben_current_salary= $increment->current_salary+ $increment->increment_amount;
                }
                else{
                    $ben_current_salary= $increment->current_salary+ (($increment->current_salary/100)*$increment->increment_amount);
                }

                $ben_basic= (($ben_current_salary/100)*$salary_structure->basic);
                $ben_house_rent= (($ben_current_salary/100)*$salary_structure->house_rent);
                $ben_medical= (($ben_current_salary/100)*$salary_structure->medical);
                $ben_transport= (($ben_current_salary/100)*$salary_structure->transport);
                $ben_food= (($ben_current_salary/100)*$salary_structure->food);

                $bank= DB::table('hr_benefits')->where('ben_as_id', $increment->associate_id)
                            ->where('ben_status', 1)
                            ->first();

                //paid in bank
                if(!empty($bank)){
                    if($bank->ben_bank_amount>= $ben_current_salary ){
                        $bank_paid= $ben_current_salary;
                        $cash_paid= 0;
                    }
                    else{
                        $bank_paid= $bank->ben_bank_amount;
                        $cash_paid= $ben_current_salary-$bank->ben_bank_amount;
                    }
                }
                else{
                    $bank_paid= $ben_current_salary;
                        $cash_paid= 0;
                }


                Benefits::where('ben_as_id', $increment->associate_id)
                    ->update([
                        'ben_cash_amount' => $cash_paid,
                        'ben_bank_amount' => $bank_paid,
                        'ben_current_salary' => $ben_current_salary,
                        'ben_basic' => $ben_basic,
                        'ben_house_rent' => $ben_house_rent,
                        'ben_medical' => $ben_medical,
                        'ben_transport' => $ben_transport,
                        'ben_food' => $ben_food
                        ]);

                Increment::where('associate_id', $increment->associate_id)
                            ->where('status', 0)
                            ->update([
                                'status' => 1
                            ]);
            }
        }
    }

    # Associate Unit by Floor List
    public function getAssociates(Request $request)
    { 
        $date = date("Y-m-d", strtotime("$request->date"));    
        // employee type wise data
        $employees = [];
        if (!empty($request->emp_type) && !empty($request->unit) && !empty($request->date))
        {
            $employees = DB::table('hr_benefits AS b')
                            ->whereDate('a.as_doj', "<=", $date)
                            ->where('a.as_emp_type_id', $request->emp_type)
                            ->where('a.as_unit_id', $request->unit)
                            ->leftJoin('hr_as_basic_info AS a', 'b.ben_as_id', 'a.associate_id')
                            ->get();
        }
        else if (!empty($request->unit) && !empty($request->date))
        {
            $employees = DB::table('hr_benefits AS b')
                            ->whereDate('a.as_doj', "<=", $date)
                            ->where('a.as_unit_id', $request->unit)
                            ->leftJoin('hr_as_basic_info AS a', 'b.ben_as_id', 'a.associate_id')
                            ->get();
        }
        else if (!empty($request->date))
        {
            $employees = DB::table('hr_benefits AS b')
                            ->whereDate('a.as_doj', "<=", $date)
                            ->leftJoin('hr_as_basic_info AS a', 'b.ben_as_id', 'a.associate_id')
                            ->get();
        }

        // show user id  
        $data['filter'] = "<input type=\"text\" id=\"AssociateSearch\" placeholder=\"Search an Associate\" autocomplete=\"off\" class=\"form-control\"/>";

        $data['result'] = "";
        foreach($employees as $employee)
        {
            $data['result'].= "<tr><div class=\"checkbox\" style=\"width:120px;display:inline-block\">
                <td colspan=\"2\"><input name=\"associate_id[]\" type=\"checkbox\" class=\"ace\" value=\"$employee->associate_id\"><span class=\"lbl\"> $employee->associate_id</span></td>
                <td>$employee->as_name </td>
            </div> </tr>";
        }
        return $data;  
    }

    public function promotion()
    { 
        ACL::check(["permission" => "hr_payroll_benefit_list"]);
        #-----------------------------------------------------------# 
        $designationList = Designation::where('hr_designation_status', 1)->pluck("hr_designation_name", "hr_designation_id");
        $promotionList= DB::table('hr_promotion AS p')
                            ->select(
                                'p.id',
                                'p.associate_id',
                                'b.as_name',
                                'pd.hr_designation_name AS previous_desg',
                                'cd.hr_designation_name AS current_desg'
                            )
                            ->where('p.status', 0)
                            ->leftJoin('hr_as_basic_info AS b', 'p.associate_id', 'b.associate_id')
                            ->leftJoin('hr_designation AS pd', 'p.previous_designation_id', 'pd.hr_designation_id')
                            ->leftJoin('hr_designation AS cd', 'p.current_designation_id', 'cd.hr_designation_id')
                            ->get();
        return view('hr/payroll/promotion', compact('designationList', 'promotionList'));
    }

    public function storePromotion(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'associate_id'           => 'required|min:10|max:10',
            'previous_designation_id' => 'required|max:11',
            'previous_designation'   => 'required|max:64',
            'current_designation_id' => 'required|max:11',
            'eligible_date'          => 'required|date',
            'effective_date'         => 'required|date',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fileds!.');
        }
        else
        {
            $store = new Promotion;
            $store->associate_id = $request->associate_id;
            $store->previous_designation_id = $request->previous_designation_id;
            $store->current_designation_id  = $request->current_designation_id;
            $store->eligible_date           = $request->eligible_date;
            $store->effective_date          = $request->effective_date;

            if ( $store->save())
            { 
                return back()
                    ->with('success', 'Associate Promoted Successfully!');
            }
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            } 
        } 
    }
    //Promotion Edit
    public function promotionEdit($id){
        $designationList = Designation::where('hr_designation_status', 1)->pluck("hr_designation_name", "hr_designation_id");
        $promotion= DB::table('hr_promotion AS p')
                        ->select(
                            'p.*',
                            'd.hr_designation_name AS prev_desg'
                        )
                        ->where('id', $id)
                        ->leftJoin('hr_designation AS d', 'p.previous_designation_id', 'd.hr_designation_id')
                        ->first();
        return view('hr/payroll/promotion_edit', compact('promotion', 'designationList'));
    }
    public function updatePromotion(Request $request){
        $validator = Validator::make($request->all(), [
            'promotion_id'           => 'required|max:11',
            'associate_id'           => 'required|min:10|max:10',
            'previous_designation_id' => 'required|max:11',
            'current_designation_id' => 'required|max:11',
            'eligible_date'          => 'required|date',
            'effective_date'         => 'required|date',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fileds!.');
        }
        else
        {
            Promotion::where('id', $request->promotion_id)
                    ->update([
                        'associate_id'           => $request->associate_id,
                        'previous_designation_id' => $request->previous_designation_id,
                        'current_designation_id' => $request->current_designation_id,
                        'eligible_date'          => $request->eligible_date,
                        'effective_date'         => $request->effective_date,
                    ]);
            
                return back()
                    ->with('success', 'Promotion updated Successfully!');
        }
    }
    //corn jobs
    public function promotionJobs()
    {
        $records = Promotion::where("status", 0)
            ->whereDate("effective_date", "<=", date("Y-m-d"));

        if ($records->exists())
        {
            $items = $records->limit(10)->get();
            foreach ($items as $item) 
            {
                Employee::where("associate_id", $item->associate_id)
                ->update([
                    'as_designation_id' => $item->current_designation_id
                ]);

                Promotion::where("id", $item->id)
                ->update([
                    'status' => 1
                ]);  
            }
        } 
    }

    # Search Associate ID returns NAME & ID
    public function searchPromotedAssociate(Request $request)
    { 
        $data = [];
        if($request->has('keyword'))
        {
            $search = $request->keyword;
            $data = DB::table("hr_benefits AS ben")
                ->select("b.associate_id", DB::raw('CONCAT_WS(" - ", b.associate_id, b.as_name) AS associate_name'))
                ->leftJoin("hr_as_basic_info AS b", "b.associate_id", "=", "ben.ben_as_id")
                ->where("b.associate_id", "LIKE" , "%{$request->keyword}%" )
                ->orWhere('b.as_name', "LIKE" , "%{$request->keyword}%" )
                ->get();
        }
        return response()->json($data);
    }

    # Search Associate Promotion Info
    public function promotedAssociateInfo(Request $request)
    {  
        if($request->has('associate_id'))
        { 
           
            $query = DB::table("hr_benefits AS ben")
                ->select("b.associate_id", "b.as_doj", "b.as_designation_id", "d.hr_designation_name") 
                ->leftJoin("hr_as_basic_info AS b", "b.associate_id", "=", "ben.ben_as_id")
                ->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
                ->where("b.associate_id",  $request->associate_id); 

            if ($query->exists())
            {
                $date = $query->first()->as_doj;
                $data['eligible_date'] = date("Y-m-d", strtotime("$date + 1 year"));
                $data['previous_designation'] = $query->first()->hr_designation_name;
                $data['previous_designation_id'] = $query->first()->as_designation_id;

                //update designations
                $position = Designation::where("hr_designation_id", "=", $query->first()->as_designation_id)->value('hr_designation_position');
                $designations = Designation::where('hr_designation_position', ">", $position)
                ->where('hr_designation_status', 1)
                ->orderBy('hr_designation_position', 'ASC')
                ->get();

                $data['designation'] = "<option value=''>Select Promoted Designation</option>";
                foreach ($designations as $value) 
                {
                    $data['designation'] .= "<option value='$value->hr_designation_id'>$value->hr_designation_name</option>";
                }

                $data['status'] = true;
            }
            else
            {
                $data['status'] = false;
                $data['error'] = "Requested Associate's ID $request->associate_id don't have available data!";
            }
        }
        else
        {
            $data['status'] = false;
            $data['error'] = "No Associate Found!";
        }
        return response()->json($data);
    }

    # show associate benefit
    public function showAssociateBenefit(Request $request)
    {  
        $info = DB::table("hr_as_basic_info AS b")
            ->select("b.associate_id", "b.as_name", "b.as_name", "d.hr_designation_name", "dpt.hr_department_name", "u.hr_unit_name")
            ->where('b.associate_id', $request->associate_id)
            ->leftJoin("hr_designation AS d", "d.hr_designation_id", "b.as_designation_id")
            ->leftJoin("hr_department AS dpt", "dpt.hr_department_id", "b.as_department_id")
            ->leftJoin("hr_unit AS u", "u.hr_unit_id", "b.as_unit_id")
            ->first();

        $benefit = Benefits::where('ben_as_id', $request->associate_id)
            ->first();

        $promotions = DB::table("hr_promotion AS p")
            ->select(
                "d1.hr_designation_name AS previous_designation",
                "d2.hr_designation_name AS current_designation",
                "p.eligible_date",
                "p.effective_date"
            )
            ->leftJoin("hr_designation AS d1", "d1.hr_designation_id", "=", "p.previous_designation_id")
            ->leftJoin("hr_designation AS d2", "d2.hr_designation_id", "=", "p.current_designation_id")
            ->where('p.associate_id', $request->associate_id)
            ->orderBy('p.effective_date', "DESC")
            ->get();
        $increments = Increment::where('associate_id', $request->associate_id)->orderBy('effective_date', 'DESC')->get();

        return view('hr/payroll/benefit', compact('info', 'benefit', 'promotions', 'increments'));
    }

}

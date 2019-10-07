<?php

namespace App\Http\Controllers\Hr\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use ACL,Validator,FastExcel,DB;
class SalaryController extends Controller
{
    public function view()
    {
    	 ACL::check(["permission" => "hr_payroll_salary"]);
        #-----------------------------------------------------------#
    	$unitList = Unit::where('hr_unit_status',1)->pluck('hr_unit_short_name','hr_unit_id');
    	$floorList= Floor::where('hr_floor_status',1)->pluck('hr_floor_name','hr_floor_id');
    	return view('hr/payroll/salary', compact('unitList', 'floorList'));
    }
    //Salary Add/Deduct Bulk upload
    public function uploadFile()
    {
    	return view('hr/payroll/add_deduct');
    }

    //Salary Add/Deduct Bulk upload file store
    public function storeFile(Request $request){

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($validator->fails()) 
        {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        else{

            $filename='';
            $filedir  = "./assets/excel/salary_add_deduct_bulk/";
            
            $filename = date("d_m_Y")."_".auth()->user()->associate_id."bulk_salary_add_deduct".uniqid().".".pathinfo($request->file("file")->getClientOriginalName(), PATHINFO_EXTENSION);
            
            $request->file('file')->move($filedir, $filename);

            if (file_exists($filedir."/".$filename))
            {  
                FastExcel::import(($filedir."/".$filename), function ($line) { 
                    $associate      = !empty($line["associate_id"])?$line["associate_id"]:null;
                    $month          = !empty($line["month"])?$line["month"]:null;
                    $year           = !empty($line["year"])?$line["year"]:null;
                    $advp_deduct    = !empty($line["advp_deduct"])?$line["advp_deduct"]:null;
                    $cg_deduct      = !empty($line["cg_deduct"])?$line["cg_deduct"]:null;
                    $food_deduct    = !empty($line["food_deduct"])?$line["food_deduct"]:null;
                    $others_deduct  = !empty($line["others_deduct"])?$line["others_deduct"]:null;
                    $salary_add     = !empty($line["salary_add"])?$line["salary_add"]:null;

                    if($associate != null && $month!=null && $year!=null){
                        $exists= DB::table('hr_salary_add_deduct')
                                    ->where('associate_id', $associate)
                                    ->where('month', $month)
                                    ->where('year', $year)
                                    ->exists();

                        if($exists== true){
                            DB::table("hr_salary_add_deduct")
                                ->where('associate_id', $associate)
                                ->update([
                                    "associate_id"  => $associate,
                                    "month"         => $month,
                                    "year"          => $year,
                                    "advp_deduct"   => $advp_deduct,
                                    "cg_deduct"     => $cg_deduct,
                                    "food_deduct"   => $food_deduct,
                                    "others_deduct" => $others_deduct,
                                    "salary_add"    => $salary_add
                                ]);
                        }
                        else{
                            DB::table("hr_salary_add_deduct")
                                ->insert([
                                    "associate_id"  => $associate,
                                    "month"         => $month,
                                    "year"          => $year,
                                    "advp_deduct"   => $advp_deduct,
                                    "cg_deduct"     => $cg_deduct,
                                    "food_deduct"   => $food_deduct,
                                    "others_deduct" => $others_deduct,
                                    "salary_add"    => $salary_add
                                ]);
                        }
                    }
                });
                return back()
                        ->with("success", "Salary Add/Deduction Bulk Uploaded Successfully!");
            }
            else
            {
                return back()->with('error', 'File not Found!');
            }
        }
    }

}

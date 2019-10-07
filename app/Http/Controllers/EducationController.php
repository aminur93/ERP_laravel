<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hr\EducationResult;
use App\Models\Hr\EducationDegree;
use App\Models\Hr\EducationLevel;
use App\Models\Hr\Education;
use DB, DataTables,Validator;
class EducationController extends Controller
{
    public function levelWiseDegree(Request $request){
    	if ($request->id)
		{
			$degrees = DB::table('hr_education_degree_title')->where('education_level_id', $request->id)
				->pluck('education_degree_title', 'id');

			$list = "";
			foreach ( $degrees as $key =>  $degree)
			{
				$list .= "<option value=\"$key\">$degree</option>";
			}
			if (!empty($list))
			{
				return $list; 
			}
		} 

		return "<option value=\"\">No Degree Available!</option>";
    }

}

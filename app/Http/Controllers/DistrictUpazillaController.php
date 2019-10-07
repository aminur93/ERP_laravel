<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upazilla;
use App\Models\District;

class DistrictUpazillaController extends Controller
{
	# District List
	public function districtList()
	{
		return District::pluck('dis_name', 'dis_id');
	}


	# Upazilla List
	public function upazillaList()
	{
		return Upazilla::pluck('upa_name', 'upa_id');
	}


	# District wise Upazilla
	public function districtWiseUpazilla(Request $request)
	{ 
		if ($request->district_id)
		{
			$upazillas = Upazilla::where('upa_dis_id', $request->district_id)
				->pluck('upa_name', 'upa_id');

			$list = "";
			foreach ( $upazillas as $key =>  $upazilla)
			{
				$list .= "<option value=\"$key\">$upazilla</option>";
			}
			if (!empty($list))
			{
				return $list; 
			}
		} 

		return "<option value=\"\">No Upazilla Available!</option>";
	}

}

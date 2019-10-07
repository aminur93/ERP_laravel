<?php
namespace App\Http\Controllers\Hr\Recruitment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hr\Worker;  
use DB, Validator, Input, FastExcel;
// Package: Laravel FastExcel

class WorkerExcelController extends Controller
{
	protected $filename;
	protected $filedir  = "./assets/excel/recruitment/";
 
	public function export()
	{  
		// Export all worker
		FastExcel::data(Worker::all())->export($this->filedir."/".$this->filename);
	}

	public function import(Request $request)
	{ 
		$validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,xls',
		]);

		if ($validator->fails()) 
		{
            return back()
                ->withErrors($validator)
                ->withInput();
		}
		else 
		{
            //-----------FILE UPLOAD---------------------     
            if($request->hasFile('excel_file'))
            { 
				$this->filename = date("d_m_Y")."_".auth()->user()->associate_id."_".uniqid().".".pathinfo($request->file("excel_file")->getClientOriginalName(), PATHINFO_EXTENSION);
            	$request->file('excel_file')->move($this->filedir, $this->filename);
            }

			if (file_exists($this->filedir."/".$this->filename))
			{  
			    $xcel = FastExcel::import(($this->filedir."/".$this->filename), function ($line) {   
				    return Worker::insert(array(
						"worker_name"     => (!empty($line["worker_name"])?$line["worker_name"]:null),
						"worker_doj"      => $this->getDate(!empty($line["worker_doj"])?$line["worker_doj"]:null),
						"worker_emp_type_id"    => $this->getEmployeeTypeId(!empty($line["worker_emp_type_id"])?$line["worker_emp_type_id"]:null),
						"worker_designation_id" => $this->getDesignationId(!empty($line["worker_designation_id"])?$line["worker_designation_id"]:null),
						"worker_unit_id"  => $this->getUnitId(!empty($line["worker_unit_id"])?$line["worker_unit_id"]:null),
						"worker_area_id"  => $this->getAreaId(!empty($line["worker_area_id"])?$line["worker_area_id"]:null),
						"worker_department_id"  => $this->getDepartmentId(!empty($line["worker_department_id"])?$line["worker_department_id"]:null),
						"worker_section_id"     => $this->getSectionId(!empty($line["worker_section_id"])?$line["worker_section_id"]:null),
						"worker_subsection_id"  => $this->getSubSectionId(!empty($line["worker_subsection_id"])?$line["worker_subsection_id"]:null),
						"worker_dob"      => $this->getDate(!empty($line["worker_dob"])?$line["worker_dob"]:null),
						"worker_ot"       => $this->getOtTypeId(!empty($line["worker_ot"])?$line["worker_ot"]:null),
						"worker_gender"   => (!empty($line["worker_gender"])?$line["worker_gender"]:null),
						"worker_contact"  => (!empty($line["worker_contact"])?$line["worker_contact"]:null),
						"as_rfid"  => (!empty($line["as_rfid"])?$line["as_rfid"]:null),
						"as_oracle_code"  => (!empty($line["as_oracle_code"])?$line["as_oracle_code"]:null),
						"worker_nid"      => (!empty($line["worker_nid"])?$line["worker_nid"]:null),
						"worker_created_by" => auth()->user()->associate_id,
						"worker_created_at" => date("Y-m-d H:i:s"),	
			    	));
				});

			    if (isset($xcel[0]) && $xcel[0]==true)
			    {
	            	return back()->with('success', 'Excel upload successful.');
			    }
			    else
			    {
	            	return back()->with('success', 'Invalid File!');
			    } 
			}
			else
			{
	            return back()->with('error', 'File not Found!');
			}


		}

	}

	/*  
	 * --------------------------------------------
	 * FETCH ID FROM DB BY EXCEL INPUT/DROPDOWN DATA
	 * --------------------------------------------
	*/

	// get date object and return only date
	public function getDate($dateObj = null)
	{
		$date = (array)$dateObj;
		return ((!empty($date) && isset($date['date']))?date("Y-m-d", strtotime($date['date'])):null);
	}

	// get employee type name & return employee type id
	public function getEmployeeTypeId($name = null)
	{ 
		return DB::table("hr_emp_type")
			->where("hr_emp_type_name", $name)
			->value("emp_type_id"); 
	}

	// get designation name & return designation id
	public function getDesignationId($name = null)
	{ 
		return DB::table("hr_designation")
			->where("hr_designation_name", $name)
			->value("hr_designation_id"); 
	}

	// get unit name & return unit id
	public function getUnitId($name = null)
	{ 
		return DB::table("hr_unit")
			->where("hr_unit_name", $name)
			->value("hr_unit_id"); 
	}

	// get area name & return area id
	public function getAreaId($name = null)
	{ 
		return DB::table("hr_area")
			->where("hr_area_name", $name)
			->value("hr_area_id"); 
	}

	// get department name & return department id
	public function getDepartmentId($name = null)
	{ 
		return DB::table("hr_department")
			->where("hr_department_name", $name)
			->value("hr_department_id"); 
	}

	// get section name & return section id
	public function getSectionId($name = null)
	{ 
		return DB::table("hr_section")
			->where("hr_section_name", $name)
			->value("hr_section_id"); 
	}

	// get sub section name & return sub section id
	public function getSubSectionId($name = null)
	{ 
		return DB::table("hr_subsection")
			->where("hr_subsec_name", $name)
			->value("hr_subsec_id"); 
	}

	// get ot type name & return ot type id
	public function getOtTypeId($type = null)
	{ 
		return strtolower($type)=='ot'?'1':'0';
	}

}

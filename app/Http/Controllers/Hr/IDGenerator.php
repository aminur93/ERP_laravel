<?php

namespace App\Http\Controllers\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator;

/*
*------------------------------------------------------------------------------
* @class: ID GENERATOR 
* @parameter - date, department_id
* @return sequential id 
* @description - ID length 10 characters
*    - 1st & 2nd character - represent the last 2 digit of the year
*    - 3rd character       - represent a character instead of the month
*    - 4th - 9th character - department wise sequential integer number  
*    - 10th character      - represent the department code
*------------------------------------------------------------------------------
*/

class IDGenerator extends Controller
{
    protected $date;
    protected $department;
    protected $code;
    protected $temp   = "";
    protected $id     = "";
    protected $min    = 0;
    protected $max    = 0;
    protected $digits = 6;  
    protected $error  = "";

    /*
    * @function  - generator
    * @parameter - departnemt & date
    * @return    - 10 characters id 
    */
    public function generator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required|max:11',
            'date'       => 'required|date' 
        ]);

        if ($validator->fails())
        { 
            $messages = $validator->messages();
            foreach ($messages->all() as $message)
            {
                $this->error .= "$message ";
            }

            $data['error'] = $this->error;
        }
        else
        {
            # assign variable's value
            $this->department = $request->department;
            $this->date       = $request->date;

            //process
            $this->process();

            $data['id']   = $this->id;
            $data['temp']   = $this->temp;
            
        }  
        return $data;
    }

    /*
    * @function  - generator2
    * @parameter - array(departnemt, date)
    * @return    - 10 characters id 
    */
    public function generator2($input = array())
    { 
        if (!empty($input['department']) && !empty($input['date']))
        {
            # assign variable's value
            $this->department = $input['department'];
            $this->date       = $input['date'];

            //process
            $this->process();

            $data['id']   = $this->id;
            $data['temp']   = $this->temp;
        }
        else
        {
            $data['error'] = "Unable to start the migration: Invalid department or date of joining!";
        }
 
        return $data;
    }

    protected function process()
    {
       /*
        * first 3 character - year & month
        *------------------------------------------
        */

        # call year extractor 
        $this->yearExtractor();
        # call month extractor 
        $this->monthExtractor();
        /* 
        * get depratment code & id max/min range
        */
        $this->departmentCode();

        /*
        * sequential 6 digit
        *------------------------------------------
        */
        # check expired user list 
        if ($this->checkExpiredList())
        {
            $this->id .= $this->temp;
        } 
        else 
        { 
            # check exists user list 
            if ($this->checkExistsList())
            {
                $this->id .= $this->temp;
            } 
            else
            {
                # minimum range as id
                $this->temp = $this->min;
                $this->id .= $this->temp;
            }
        } 

        /*
        * append last character
        *------------------------------------------
        */
        $this->id .= $this->code;
    }

    /*
    * @function  - checkExpiredList
    * @defination - filter by depratment, status & date 
    * @return    - minimum temp_id
    */ 
    protected function checkExpiredList()
    {
        $data = DB::table('hr_associate_status_tracker AS t')
            ->select([
                'b.temp_id',
                't.*',
            ])
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', '=',  't.status_as_id')
            ->where('b.as_department_id', $this->department)
            ->whereIn('b.as_status', [2,3])
            ->where('t.status_date', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 90 DAY)'))
            ->orderBy('b.temp_id','asc');

        if ($data->exists())
        {
            $this->temp = $data->first()->temp_id;
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
    * @function   - checkExistsList
    * @defination - filter by department and temp_id range 
    * @return     - temp_id + 1
    */ 
    protected function checkExistsList()
    {
        $data = DB::table('hr_as_basic_info') 
            ->where('as_department_id', $this->department)
            ->whereBetween('temp_id', [$this->min, $this->max-1])
            ->orderBy('temp_id', 'desc');

        if ($data->exists())
        {
            $this->temp = sprintf("%0".$this->digits."d", ($data->first()->temp_id) + 1);
            return true;
        }
        else
        {
            return false;
        }
    }
    	
    /*
    * @function  - Year Extractor
    * @return    - Last 2 digit of the year
    */ 
    protected function yearExtractor()
    {
        $year  = (!empty($this->date)?date('Y',strtotime($this->date)):null);

        if (!empty($year))
        {
            $this->id .= (!empty($year[2])?$year[2]:0).(!empty($year[3])?$year[3]:0);
        } 
    }

    /*
    * @function  - Month Extractor
    * @return    - Alias of the month
    */ 
    protected function monthExtractor()
    {
        $month  = (!empty($this->date)?date('m',strtotime($this->date)):null);

        $monthAlias = [
            "01" => "A",
            "02" => "B",
            "03" => "C",
            "04" => "D",
            "05" => "E",
            "06" => "F",
            "07" => "G",
            "08" => "H",
            "09" => "J",
            "10" => "K",
            "11" => "L",
            "12" => "M" 
        ];

        if (!empty($month))
        {
            $this->id .= $monthAlias[$month];
        } 
    } 

    /*
    * @function  - departmentCode
    * @return    - Department Code
    */ 
    protected function departmentCode()
    {
        if (!empty($this->department))
        {
            $data = DB::table('hr_department')
                ->where('hr_department_id', $this->department);

            if ($data->exists())
            {
                $this->min  = $data->first()->hr_department_min_range;
                $this->max  = $data->first()->hr_department_max_range;
                $this->code = $data->first()->hr_department_code;
            }
            else
            {
                $this->error .= "<span>No department found!</span> ";
            }
        }
    }

}

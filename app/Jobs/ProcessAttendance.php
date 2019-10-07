<?php

namespace App\Jobs;

use App\Models\Hr\AttandancedataTemp;
use App\Models\Hr\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class ProcessAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $file;

    public $unit;

    public function __construct($file, $unit)
    {
        $this->file = $file;     
        $this->unit = $unit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$data = file_get_contents($this->file);
        $dataEx = explode(PHP_EOL, $this->file);
        for ($i=0; $i < count($dataEx); $i++) { 
            $lineData = $dataEx[$i];
            if (!empty($lineData))
            {

                #----Original Code
                $sl = substr($lineData, 0, 2);
                $date   = substr($lineData, 2, 8);
                $rfid = substr($lineData, 16, 10);
                $time   = substr($lineData, 10, 6);
                $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null); 


                //get as_id to store in temp table
                $as_info= Employee::where('as_rfid_code', $rfid)
                                ->select([
                                    'as_id',
                                    'as_shift_id'
                                    ])
                                ->first();
                $as_id= $as_info->as_id;

                if($as_id){

                    $month= date('m', strtotime($checktime));
                    $year= date('Y', strtotime($checktime));

                    
                    $shift_code="";

                    $shift_roast= DB::table("hr_shift_roaster AS sr")
                    ->where('sr.shift_roaster_month', $month)
                    ->where('sr.shift_roaster_year', $year)
                    ->orderBy('shift_roaster_id', "DESC")
                    ->where("sr.shift_roaster_user_id", $as_id)
                    ->first();

                    if($shift_roast){

                        $day = date('j', strtotime($checktime));
                        if($day==1) $shift_code= $shift_roast->day_1;
                        if($day==2) $shift_code= $shift_roast->day_2;
                        if($day==3) $shift_code= $shift_roast->day_3;
                        if($day==4) $shift_code= $shift_roast->day_4;
                        if($day==5) $shift_code= $shift_roast->day_5;
                        if($day==6) $shift_code= $shift_roast->day_6;
                        if($day==7) $shift_code= $shift_roast->day_7;
                        if($day==8) $shift_code= $shift_roast->day_8;
                        if($day==9) $shift_code= $shift_roast->day_9;
                        if($day==10) $shift_code= $shift_roast->day_10;
                        if($day==11) $shift_code= $shift_roast->day_11;
                        if($day==12) $shift_code= $shift_roast->day_12;
                        if($day==13) $shift_code= $shift_roast->day_13;
                        if($day==14) $shift_code= $shift_roast->day_14;
                        if($day==15) $shift_code= $shift_roast->day_15;
                        if($day==16) $shift_code= $shift_roast->day_16;
                        if($day==17) $shift_code= $shift_roast->day_17;
                        if($day==18) $shift_code= $shift_roast->day_18;
                        if($day==19) $shift_code= $shift_roast->day_19;
                        if($day==20) $shift_code= $shift_roast->day_20;
                        if($day==21) $shift_code= $shift_roast->day_21;
                        if($day==22) $shift_code= $shift_roast->day_22;
                        if($day==23) $shift_code= $shift_roast->day_23;
                        if($day==24) $shift_code= $shift_roast->day_24;
                        if($day==25) $shift_code= $shift_roast->day_25;
                        if($day==26) $shift_code= $shift_roast->day_26;
                        if($day==27) $shift_code= $shift_roast->day_27;
                        if($day==28) $shift_code= $shift_roast->day_28;
                        if($day==29) $shift_code= $shift_roast->day_29;
                        if($day==30) $shift_code= $shift_roast->day_30;
                        if($day==31) $shift_code= $shift_roast->day_31;
                    }
                    else{
                        $shift_code= DB::table('hr_shift')
                                        ->where('as_id', $as_info->as_shift_id)
                                        ->pluck('hr_shift_code')
                                        ->first();
                    }
                    
                    if(!empty($shift_code)){
                        AttandancedataTemp::insert([                       
                            'checktime'   => $checktime,
                            'rf_id'       => $rfid,
                            'Userid'         => $as_id,
                            'hr_shift_code' => $shift_code
                        ]); 
                    }
                }
            }
        }
    }
}

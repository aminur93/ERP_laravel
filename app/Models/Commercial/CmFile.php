<?php

namespace App\Models\Commercial;

use App\Models\Commercial\CmFile;
use Illuminate\Database\Eloquent\Model;

class CmFile extends Model
{

    protected $table= 'cm_file';
    public $timestamps= false;

    // public function cmAsset()
    // {
    // 	return $this->belongsTo('App\Models\Commercial\CmPIAsset','id','id');
    // }

    public static function getExistsCmFile($fileNo)
    {
    	return CmFile::where('file_no', $fileNo)->first();
    }

    //get file close status
    public static function isClosed($fileNo){
        
        $status= CmFile::where('id', $fileNo)->pluck('status')->first();
        //statud=1,file open/active
        //statud=0,file closed
        if($status == 1) return true;
        return false;
    }
}

<?php

namespace App\Http\Controllers\Merch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Schema;

/*
*----------------------------------------------------------------
*                        HOW TO USE 
*----------------------------------------------------------------
* === load library ====
*
*   use App\Http\Controllers\Merch\ShortCodeLib as ShortCodeLib;
*---------------------------------
* === call library ===
* 
*	$data = (new ShortCodeLib)::generate([
*		'table'            => 'mr_style',  
*		'column_primary'   => 'stl_id',  
*		'column_shortcode' => 'stl_code',  
*		'first_letter'     => 'F',        
*		'second_letter'    => 'S'        
*	]);
*----------------------------------------------------------------
*/

class ShortCodeLib extends Controller
{
    public static function generate($input = array())
    {
    	if (!empty($input['table']) 
    		&& !empty($input['column_primary'])  
    		&& !empty($input['column_shortcode'])  
    		&& !empty($input['first_letter'])  
    		&& !empty($input['second_letter'])  
    	)
    	{
	    	$table            = $input['table'];
	    	$column_primary   = $input['column_primary'];
	    	$column_shortcode = $input['column_shortcode']; 
	    	$firstLetter  = (string)substr($input['first_letter'], 0, 1);
	    	$secondLetter = (string)substr($input['second_letter'], 0, 1);
	    	$serial       = "00001";

	    	// check if table is not exists
			if (!Schema::hasTable($table)) 
			{
				return "Invalid table $table!";
			}
			//check whether table has primary column
			if(!Schema::hasColumn($table, $column_primary))
			{
				return "Invalid column $column_primary!";
			}
			//check whether table has serial column
			if(!Schema::hasColumn($table, $column_shortcode))
			{
				return "Invalid column $column_shortcode!";
			}

	    	$record = DB::table($table)
	    		->select($column_shortcode)
	    		->orderBy($column_primary, "DESC")
	    		->limit(1);

	    	if ($record->exists())
	    	{
	    		$code = $record->first()->$column_shortcode;
	    		$code = substr($code, 2,6);
	            $serial = sprintf("%05d", (int)$code + 1); 
	    	}

	    	return strtoupper($firstLetter.$secondLetter.$serial); 
    	}
    	else
    	{
    		return "Invalid input!";
    	}  
    }
}

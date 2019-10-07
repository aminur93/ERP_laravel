<?php

namespace App\Http\Controllers\Commercial\Xinnah\Import;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessLogFile;
use App\Models\Commercial\BTBEntry;
use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\Passbook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PassBookVolumeNumberController extends Controller
{
  public function index()
  {
  	$data['getFiles'] = ImportDataEntry::getFileWise();
  	$data['getSuppliers'] = ImportDataEntry::getSuppliersWise();
  	$data['getTransDocNo'] = ImportDataEntry::getTransportDocNoWise();
  	$data['getLcNo'] = BTBEntry::getCLNoWise();
   	return view('commercial.xinnah.import.pass_book_volume_no.index', $data);
  }

  public function importDataEntrySearch(Request $request)
  {
  	$input = $request->all();
    //return $input;
  	try {
  		$getResult = ImportDataEntry::getResultSearchWise($input);

  		return view('commercial.xinnah.import.pass_book_volume_no.search_result' , compact('getResult'));
  	} catch (\Exception $e) {
    	return 'error';
  	}
  	
    
  }
  public function fileWiseLcNo($fileId)
  {
  	$getLcNo = BTBEntry::getCLNoFileIdWise($fileId);
  	return view('commercial.xinnah.import.pass_book_volume_no.fileid_wise_lcno', compact('getLcNo'));
  }
  public function lcnoWiseSupplier($lcNo)
  {
  	$getSuppliers = BTBEntry::getCLNoSupplierWise($lcNo);
  	return view('commercial.xinnah.import.pass_book_volume_no.lcno_wise_supplier', compact('getSuppliers'));
  }
  public function checkDataLoad(Request $request)
  {
    $data = $request->all();
    $getPassbook = Passbook::checkExistsDB($data);
    try {
      return view('commercial.xinnah.import.pass_book_volume_no.passbook_entry', compact('data','getPassbook'));
    } catch (\Exception $e) {
      return 'error';
    }
    
  }
  public function saveData(Request $request)
  {
  	$input = $request->except(['_token']);
  	$getPassbookVolume = Passbook::checkExistsDB($input);

  	try {
  		if(count($getPassbookVolume) > 0){
        $passbookId = $getPassbookVolume->id;
        $getPassbook = Passbook::updatePassbookInfo($passbookId, $input);
        $msg = 'Successfull update passbook volume number info';
      }else{
        $passbookId = Passbook::insertGetId($input);
        $msg = 'Successfull create passbook volume number';
      }

      $this->logFileWrite($msg, $passbookId);

      return redirect()->back()->with('success', $msg);
  	} catch (\Exception $e) {
  		//$bug1 = $e->errorInfo[2];
  		return redirect()->back()->with('error', 'Oops something went wrong, please try again.');
  	}
  }
  public function listOfPassbookVolume()
  {
    return view('commercial.xinnah.import.pass_book_volume_no.list_of_passbook_volume');
  }

  public function listOfPassbookVolumeData()
  {
    $data = Passbook::getListOfPassbookVolume();
    return DataTables::of($data)->addIndexColumn()
    ->addColumn('action', function($data){
     $action_buttons= "<div class=\"btn-group\">  
            <a onclick=\"editData($data->id, $data->page_no, $data->volume_no)\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
                <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
            </a> 
            <a onclick=\"deleteData($data->id)\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" style=\"height:25px; width:26px;\">
                <i class=\"ace-icon fa fa-trash bigger-120\"></i>
            </a> ";
        $action_buttons.= "</div>";

        return $action_buttons;
    })
    ->make(true);
  }

  public function actionWise(Request $request)
  {
    $input = $request->all();
    $getPassbook = Passbook::findOrFail($input['id']);
    
    try {
      if($input['action_type'] == 'edit'){
        Passbook::updatePassbookInfo($getPassbook->id, $input);
        $msg = 'Successfull passbook volume updated info';
      }elseif($input['action_type'] == 'delete'){
        $getPassbook->delete();
        $msg = 'Successfull passbook volume deleted data';
      }
      
      $this->logFileWrite($msg, $getPassbook->id);

      return redirect()->back()->with('success', $msg);
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Oops something went wrong, please try again.');
    }
  }
}

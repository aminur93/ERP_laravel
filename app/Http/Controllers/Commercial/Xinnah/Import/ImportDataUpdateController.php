<?php

namespace App\Http\Controllers\Commercial\Xinnah\Import;

use App\Http\Controllers\Controller;
use App\Models\Commercial\Agent;
use App\Models\Commercial\Bank\ImportDataEntry;
use App\Models\Commercial\ConsignmentSeaPort;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ImportDataUpdateController extends Controller
{
  public function index($type)
  {
    if($type == 'seas' || $type == 'port'){
      $data['type'] = $type;
      $data['getFiles'] = ImportDataEntry::getFileWise();
      $data['getValuePackage'] = ImportDataEntry::getValuePackageWise();
      $data['getTransDocNo'] = ImportDataEntry::getTransportDocNoWise();
      $data['getAgent'] = Agent::get();
      return view('commercial.xinnah.import.data_update.index', $data);
    }
  	return redirect()->back()->with('error', 'This url not found, please try again');

   	
  }

  public function fileWiseValue($fId)
  {
  	$getValues = ImportDataEntry::getValueFileIdWise($fId);
  	return view('commercial.xinnah.import.data_update.fileid_wise_value', compact('getValues'));
  }

  public function valueWisePackage($vId)
  {
  	$getPackages = ImportDataEntry::getPackageValueWise($vId);
  	return view('commercial.xinnah.import.data_update.value_wise_package', compact('getPackages'));
  }

  public function ConsignmentSeasPortSearch(Request $request)
  {
  	$input = $request->all();
  	try {
  		$getResult = ImportDataEntry::getConsignmentHighSeasSearchWise($input);

  		return view('commercial.xinnah.import.data_update.search_result' , compact('getResult'));
  	} catch (\Exception $e) {
    	return 'error';
  	}
  }
  public function checkDataLoad(Request $request)
  {
    $data = $request->all();
    $consignmentSeaPort = ConsignmentSeaPort::checkExistsDB($data);
    $getDataEntry = ImportDataEntry::getIdWise($data['cm_imp_data_entry_id']);
    $getAgent = Agent::get();
    try {
      if($data['page_type'] == 'seas'){
        $url = 'commercial.xinnah.import.data_update.consignment_sea_entry';
      }elseif($data['page_type'] == 'port'){
        if(count($consignmentSeaPort) > 0){
          $url = 'commercial.xinnah.import.data_update.consignment_port_entry';
        }else{
          return '<h4 class="text-center">No Sea Data Found! <br> Please entry sea data</h4>';
        }
      }else{
        $url = 'commercial.xinnah.import.data_update.404';
      }
      return view($url, compact('data','consignmentSeaPort', 'getAgent', 'getDataEntry'));
    } catch (\Exception $e) {
      return 'error';
    }
  }

  public function saveData(Request $request)
  {
    $input = $request->except(['_token']);
    $consignmentSeaPort = ConsignmentSeaPort::checkExistsDB($input);
    //return $input;
    
    try {
      if(count($consignmentSeaPort) > 0){
        $consignmentSeaPortId = $consignmentSeaPort->id;
        if($input['page_type'] == 'seas'){

          $getData = ConsignmentSeaPort::updateConsignmentSeaInfo($consignmentSeaPortId, $input);
          $msg = 'Successfull consignment sea updated info';
        }elseif($input['page_type'] == 'port'){
          $getData = ConsignmentSeaPort::updateConsignmentPortInfo($consignmentSeaPortId, $input);
          $msg = 'Successfull consignment port updated info';
        }
        
      }else{
        $input = $request->except(['_token', 'page_type']);
        $consignmentSeaPortId = onsignmentSeaPort::insertGetId($input);
        $msg = 'Successfull consignment sea create';
      }
      $this->logFileWrite($msg, $consignmentSeaPortId);
      return redirect()->back()->with('success', $msg);
    } catch (\Exception $e) {
      //$bug1 = $e->errorInfo[2];
      return redirect()->back()->with('error', 'Oops something went wrong, please try again.');
    }
  }
  public function list($type)
  {
    if($type == 'seas'){
      
      return view('commercial.xinnah.import.data_update.list_of_sea');
    }elseif($type == 'port'){
      return view('commercial.xinnah.import.data_update.list_of_port');
    }
    return redirect()->back()->with('error', 'This url not found, please try again');
  }
  public function listOfSeaData()
  {
    $data = ConsignmentSeaPort::getListOfSeas();
    return DataTables::of($data)->addIndexColumn()
    ->addColumn('action', function($data){
     $action_buttons= "<div class=\"btn-group\">  
            <a href=".url('comm/import/importdata/consignment/seas/'.$data->id.'/edit')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
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

  public function listOfPortData()
  {
    $data = ConsignmentSeaPort::getListOfPort();
    return DataTables::of($data)->addIndexColumn()
    ->addColumn('action', function($data){
     $action_buttons= "<div class=\"btn-group\">  
            <a href=".url('comm/import/importdata/consignment/port/'.$data->id.'/edit')." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Edit\" style=\"height:25px; width:26px;\">
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

  public function edit($type, $id)
  {
    $consignmentSeaPort = ConsignmentSeaPort::findOrFail($id);
    $data['cm_imp_data_entry_id'] = $consignmentSeaPort->cm_imp_data_entry_id;
    $data['page_type'] = $type;
    $getDataEntry = ImportDataEntry::getIdWise($data['cm_imp_data_entry_id']);
    $getAgent = Agent::get();
    if($type == 'seas'){
      return view('commercial.xinnah.import.data_update.edit_of_sea', compact('consignmentSeaPort', 'data', 'getAgent', 'getDataEntry'));
    }elseif($type == 'port'){
      return view('commercial.xinnah.import.data_update.edit_of_port', compact('consignmentSeaPort', 'data', 'getAgent', 'getDataEntry'));
    }
  }

  public function actionWiseDelete(Request $request)
  {
    $input = $request->all();
    try {
      $getData = ConsignmentSeaPort::findOrFail($input['id']);
      $getData->delete();
      $msg = 'Successfull consignment sea port deleted data';
      $this->logFileWrite($msg, $input['id']);
      return redirect()->back()->with('success', $msg);
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Something wrong, please try again');
    }
  }
}

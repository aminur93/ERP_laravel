<?php

namespace App\Models\Commercial;

use App\Models\Commercial\ConsignmentSeaPort;
use Illuminate\Database\Eloquent\Model;
use DB;
class ConsignmentSeaPort extends Model
{
  protected $table= 'cm_imp_data_update_sea_port';
  public $timestamps= false;

  public static function checkExistsDB($data)
  {
  	return ConsignmentSeaPort::where('cm_imp_data_entry_id', $data['cm_imp_data_entry_id'])
     	->first();
  }

  public static function updateConsignmentSeaInfo($id, $data)
  {
  	return ConsignmentSeaPort::where('id', $id)
  	->update([
  		'feeder_vessel' => $data['feeder_vessel'],
  		'eta_ctg' => $data['eta_ctg'],
  		'bank_sub_date' => $data['bank_sub_date'],
  		'cm_agent_id' => $data['cm_agent_id'],
  		'document_dispatch_date' => $data['document_dispatch_date'],
  		'original_sg' => $data['original_sg'],
  		'vessel_outer' => $data['vessel_outer'],
  		'vessel_berth' => $data['vessel_berth'],
  		'document_date' => $data['document_date'],
  		'sg_no' => $data['sg_no'],
  		'sg_date' => $data['sg_date'],
  		'priority' => $data['priority'],
  	]);
  }
  public static function updateConsignmentPortInfo($id, $data)
  {
  	return ConsignmentSeaPort::where('id', $id)
  	->update([
  		'port_noting_date' => $data['port_noting_date'],
  		'port_assess_date' => $data['port_assess_date'],
  		'port_bank_sub_date' => $data['port_bank_sub_date'],
  		'port_examine_date' => $data['port_examine_date'],
  		'port_deliv_date' => $data['port_deliv_date'],
  		'port_unstaff' => $data['port_unstaff'],
  		'cm_agent_id2_port' => $data['cm_agent_id2_port'],
  		'port_original_sg' => $data['port_original_sg'],
  		'port_priority' => $data['port_priority'],
  	]);
  }

  public static function getListOfSeas()
  {
    DB::statement(DB::raw('set @rownum=0'));
    return ConsignmentSeaPort::
        select(DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'), 'cm_imp_data_update_sea_port.id as id', 'f.file_no', 'e.value', 'e.package', 'e.transp_doc_no1', 'a.agent_name', 'cm_imp_data_update_sea_port.bank_sub_date')
        ->leftJoin('cm_imp_data_entry as e','cm_imp_data_update_sea_port.cm_imp_data_entry_id','=','e.id')
        ->leftJoin('cm_file as f','e.cm_file_id','=','f.id')
        ->leftJoin('cm_agent as a','cm_imp_data_update_sea_port.cm_agent_id','=','a.id')
        ->get();
  }

  public static function getListOfPort()
  {
    DB::statement(DB::raw('set @rownum=0'));
    return ConsignmentSeaPort::
        select(DB::raw('@rownum := @rownum + 1 AS DT_Row_Index'), 'cm_imp_data_update_sea_port.id as id', 'f.file_no', 'e.value', 'e.package', 'e.transp_doc_no1', 'a.agent_name', 'cm_imp_data_update_sea_port.port_bank_sub_date')
        ->leftJoin('cm_imp_data_entry as e','cm_imp_data_update_sea_port.cm_imp_data_entry_id','=','e.id')
        ->leftJoin('cm_file as f','e.cm_file_id','=','f.id')
        ->leftJoin('cm_agent as a','cm_imp_data_update_sea_port.cm_agent_id2','=','a.id')
        ->get();
  }
}

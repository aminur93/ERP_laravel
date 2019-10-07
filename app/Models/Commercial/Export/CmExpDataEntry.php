<?php

namespace App\Models\Commercial\Export;

use Illuminate\Database\Eloquent\Model;

class CmExpDataEntry extends Model
{
	// public $with = ['cm_freight_charge_child'];
    protected $table = "cm_exp_data_entry_1";

    public $timestamps = false; 

    public function cm_exp_entry1_po()
    {
    	return $this->hasMany('App\Models\commercial\export\CmExpDataEntry1Po', 'cm_exp_data_entry_1_id', 'id');
    }

    public function cm_file()
    {
    	return $this->hasOne('App\Models\commercial\CmFile', 'id', 'cm_file_id');
    }

    public function cm_exp_lc_entry()
    {
    	return $this->hasOne('App\Models\commercial\ExpLcEntry', 'cm_file_id', 'cm_file_id');
    }

    public function cm_exp_update2()
    {
    	return $this->hasOne('App\Models\commercial\export\CmExpUpdate2', 'invoice_no', 'inv_no');
    }

    public function cm_exp_reimburse()
    {
    	return $this->hasOne('App\Models\commercial\Bank\BankExpReimbursement', 'cm_exp_data_entry_1_id', 'id');
    }

    public function cm_port()
    {
    	return $this->hasOne('App\Models\commercial\Port', 'id', 'cm_port_id');
    }

    public function cm_freight_charge_child()
    {
        return $this->hasOne('App\Models\commercial\CmFreightChargeChild', 'cm_exp_data_entry_1_id', 'id' );
    }

    public function cm_cash_incentive_child()
    {
        return $this->hasOne('App\Models\commercial\export\CmCashIncentiveChild', 'cm_exp_data_entry_1_id', 'id' );
    }
}

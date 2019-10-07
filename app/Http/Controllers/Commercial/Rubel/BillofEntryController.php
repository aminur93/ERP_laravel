<?php

namespace App\Http\Controllers\Commercial\rubel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator, DataTables, Redirect;

class BillofEntryController extends Controller
{

	/**
	 * rubel index function
	 * @return view
	 */
	public function index()
	{
		$data['btbFileList'] = DB::table('cm_file')
						->select('id','file_no')
						->pluck("file_no", "id")
						->toArray();
		$data['supplierList'] = DB::table('mr_supplier')
						->select('sup_id','sup_name')
						->pluck("sup_name", "sup_id")
						->toArray();
		$data['lcNoList'] = DB::table('cm_btb')
						->select('id','lc_no')
						->pluck("lc_no", "lc_no")
						->toArray();
		$data['lcDocNoList'] = DB::table('cm_imp_data_entry')
						->select('id','transp_doc_no1')
						->pluck("transp_doc_no1", "id")
						->toArray();
		return view('commercial.import.rubel.bill_of_entry', $data);
	}

	public function billofentryFetchlcsup()
	{
		$file_id = request()->input('file_id');
		if(request()->input('file_id') != '') {
			$fetch_lcList  = DB::table('cm_btb')
								->where(['cm_file_id' => $file_id])
								->pluck("lc_no", "lc_no")
								->toArray();
			$btb_supplierList = DB::table('cm_btb')
								->select('m.sup_id','m.sup_name')
								->where(['cm_file_id' => $file_id])
								->leftjoin('mr_supplier AS m', 'mr_supplier_sup_id', 'm.sup_id')
								->pluck('m.sup_name','m.sup_id')
								->toArray();
		} else {
			// if file id not found than show all lc and supplier list
			$fetch_lcList = DB::table('cm_btb')
								->select('id','lc_no')
								->pluck("lc_no", "lc_no")
								->toArray();
			$btb_supplierList = DB::table('mr_supplier')
								->select('sup_id','sup_name')
								->pluck("sup_name", "sup_id")
								->toArray();
		}
		$lcOptions = '';
		$supplierOptions = '';
		// generate lc list
		if(count($fetch_lcList) > 0) {
			$lcOptions .= '<option value="">Select L/C No</option>';
			foreach($fetch_lcList as $k1 => $lc) {
				$lcOptions .= '<option value="'.$lc.'">'.$lc.'</option>';
			}
		} else  {
			$lcOptions = '<option value="">Not Found</option>';
		}
		// generate supplier list
		if(count($btb_supplierList) > 0) {
			$supplierOptions .= '<option value="">Select Supplier</option>';
			foreach($btb_supplierList as $k2 => $supplier) {
				$supplierOptions .= '<option value="'.$k2.'">'.$supplier.'</option>';
			}
		} else  {
			$supplierOptions = '<option value="">Not Found</option>';
		}
		return $result = ['lc' => $lcOptions, 'supplier' => $supplierOptions];
	}

	public function billofentryFetchsup()
	{
		$lc_id = request()->input('lc_id');
		if(request()->input('lc_id') != '') {
			$btb_supplierList = DB::table('cm_btb')
								->select('m.sup_id','m.sup_name')
								->where(['lc_no' => $lc_id])
								->leftjoin('mr_supplier AS m', 'mr_supplier_sup_id', 'm.sup_id')
								->pluck('m.sup_name','m.sup_id')
								->toArray();
		} else {
			$btb_supplierList = DB::table('mr_supplier')
								->select('sup_id','sup_name')
								->pluck("sup_name", "sup_id")
								->toArray();
		}
		$supplierOptions = '';
		if(count($btb_supplierList) > 0) {
			$supplierOptions .= '<option value="">Select Supplier</option>';
			foreach($btb_supplierList as $k => $supplier) {
				$supplierOptions .= '<option value="'.$k.'">'.$supplier.'</option>';
			}
		} else  {
			$supplierOptions = '<option value="">Not Found</option>';
		}
		return $result = ['supplier' => $supplierOptions];
	}

	public function billofentry_fetchBtbData_select()
	{
		return [
			'cm_btb.id AS btb_id',
        	'cm_imp_data_entry.id AS cm_data_entry_id',
        	'cm_file.file_no AS cm_file_no',
        	'cm_imp_data_entry.cm_file_id',
        	'mr_supplier.sup_name',
        	'cm_btb.lc_no',
        	'cm_imp_data_entry.mr_supplier_sup_id',
        	'cm_imp_data_entry.value',
        	'cm_imp_data_entry.transp_doc_no1'
		];
	}

	public function billofentry_fetchBtbData()
	{
		$query = DB::table('cm_btb')
			        ->leftjoin('cm_imp_data_entry','cm_imp_data_entry.cm_file_id','cm_btb.cm_file_id')
			        ->leftjoin('cm_file','cm_btb.cm_file_id','cm_file.id')
			        ->leftjoin('mr_supplier','cm_btb.mr_supplier_sup_id','mr_supplier.sup_id')
			        ->select($this->billofentry_fetchBtbData_select())
			        ->groupBy('cm_btb.id');
        if(request()->input('file_no') != NULL){
            $query->where('cm_btb.cm_file_id', request()->input('file_no'));
        }
        if(request()->input('lc_no') != NULL){
            $query->where('cm_btb.lc_no',request()->input('lc_no'));
        }
        if(request()->input('supplier') != NULL){
            $query->where('cm_btb.mr_supplier_sup_id', request()->input('supplier'));
        }
        if(request()->input('value') != NULL){
            $query->where('cm_imp_data_entry.value', request()->input('value'));
        }
        if(request()->input('doc_no') != NULL){
            $query->where('cm_imp_data_entry.transp_doc_no1', request()->input('doc_no'));
        }
        $data['dataList'] = $query->get();
        return $result = ['result' => view('commercial.import.rubel.ajax_bill_of_entry_table', $data)->render()];
	}

	public function saveBillOfEntry()
	{
		$inputs = request()->except('_token','id');
		if(request()->input('id') != null) {
			$bill_of_entry_id = request()->input('id');
			// update
			$updateArray = [
				'entry_no' 				=> request()->input('entry_no'),
				'bond_no' 				=> request()->input('bond_no'),
				'entry_date' 			=> request()->input('entry_date'),
				'bond_date' 			=> request()->input('bond_date'),
				'assesment_value' 		=> request()->input('assesment_value'),
				'entry_recv_date' 		=> request()->input('entry_recv_date'),
				'contro_bank_sub_date' 	=> request()->input('contro_bank_sub_date'),
			];
			$update = DB::table('cm_bill_of_entry')
			->where('id',$bill_of_entry_id)
			->update($updateArray);
			// update log file
			$this->logFileWrite('Update bill entry data (cm_bill_of_entry)', $bill_of_entry_id);
			if($update) {
				return redirect('commercial/import/billofentry_list')
						->with('success','Data update success');
			} else {
				return Redirect::back()->withErrors('Data update error');
			}
		} else {
			// insert
			$save = DB::table('cm_bill_of_entry')
						->insertGetId($inputs);
			// update log file
			$this->logFileWrite('Insert bill entry data (cm_bill_of_entry)', $save);
			if($save) {
				return redirect('commercial/import/billofentry_list')
						->with('success','Data insert success');
			} else {
				return Redirect::back()->withErrors('Data insert error');
			}
		}
	}

	public function billofentryList()
	{
		return view('commercial.import.rubel.bill_of_entry_list');
	}

	public function billofentryListData_select()
	{
		return [
			'd_entry.id AS imp_data_id',
			'b_entry.id AS b_id',
			'b_entry.entry_no',
			'b_entry.bond_no',
			'b_entry.entry_recv_date',
			'b_entry.contro_bank_sub_date',
			'b_entry.entry_date',
			'b_entry.copy_rcv_date',
			'b_entry.duty_amount_tk',
			'b_entry.assesment_value'
		];
	}

	public function billofentryListData()
	{
    	$data= DB::table('cm_bill_of_entry AS b_entry')
    			->select($this->billofentryListData_select())
    			->leftJoin('cm_imp_data_entry AS d_entry', 'd_entry.id', 'b_entry.cm_imp_data_entry_id')
    			->get();
    	return DataTables::of($data)->addIndexColumn()->toJson();
    }

    public function billofentry_fetchBillEntryForm()
    {
		$cm_data_entry_id = request()->input('cm_data_entry_id');
		if($cm_data_entry_id) {
			$data['cm_bill_of_entry'] = DB::table('cm_bill_of_entry')
					->where('cm_imp_data_entry_id',$cm_data_entry_id)
					->first();
			$data['cm_imp_data_entry_id'] = $cm_data_entry_id;
			return view('commercial.import.rubel.ajax_bill_of_entry_form', $data)
					->render();
		}
    }

    public function billofentryListData_delete($id)
    {
    	return $id;
    }

    //Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}

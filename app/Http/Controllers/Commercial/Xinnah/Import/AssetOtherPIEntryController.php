<?php

namespace App\Http\Controllers\Commercial\Xinnah\Import;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CmFile;
use App\Models\Commercial\CmPIAsset;
use App\Models\Commercial\CmPIAssetDescription;
use App\Models\Commercial\CmPIAssetOrder;
use App\Models\Commercial\Item;
use App\Models\Commercial\MachineType;
use App\Models\Commercial\Section;
use App\Models\Hr\Unit;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\Supplier;
use Illuminate\Http\Request;
use Validator, DB;
use Yajra\DataTables\DataTables;

class AssetOtherPIEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('commercial.xinnah.import.asset.list');
    }

    public function loadData()
    {
        $data = CmPIAsset::getListOfCmPiAsset();
        return DataTables::of($data)->addIndexColumn()
        ->addColumn('action', function($data){
         $action_buttons= "<div class=\"btn-group\"> 
                <a href=".url('comm/import/asset/others-pi-entry/'.$data->id.'/edit')." class=\"btn btn-xs btn-success\" rel='tooltip' data-tooltip=\"This pi entry edit\" data-tooltip-location=\"top\" style=\"height:25px; width:26px;\">
                    <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                </a>
                <a onclick=\"deleteData($data->id)\" class=\"btn btn-xs btn-danger\" rel='tooltip' data-tooltip=\"Delete this pi entry\" data-tooltip-location=\"left\" style=\"height:25px; width:26px;\">
                    <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                </a> ";
            $action_buttons.= "</div>";

            return $action_buttons;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['getSuppliers'] = Supplier::all();
        $data['getUnit'] = Unit::all();
        $data['getItem'] = Item::all();
        $data['getOrder'] = OrderEntry::orderBy('order_id')->select('order_code', 'order_id')->get();
        $data['getSection'] = Section::all();
        return view('commercial.xinnah.import.asset.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'file_no'            => 'required|unique:cm_file',
            'hr_unit'            => 'required',
            'cm_item_id'         => 'required',
            'pi_no'              => 'required',
            'mr_supplier_sup_id' => 'required',
            'cm_machine_type_id' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        DB::beginTransaction();
        try {
            // create cm_file 
            $cmFile['file_no'] = $input['file_no'];
            $cmFile['hr_unit'] = $input['hr_unit'];
            $cmFile['file_type'] = 2;
            $cmFile['status'] = 1;
            $input['cm_file_id'] = CmFile::insertGetId($cmFile);

            // create cm_pi_asset
            $input['cm_pi_asset_id'] = CmPIAsset::create($input)->id;

            // create cm_pi_asset_order
            $totalOrder = count($input['mr_order_entry_order_id']);
            for ($o=0; $o < $totalOrder; $o++) { 
                $setPiAssetOrder = [
                    'cm_pi_asset_id'          => $input['cm_pi_asset_id'],
                    'mr_order_entry_order_id' => $input['mr_order_entry_order_id'][$o]
                ];
                CmPIAssetOrder::insert($setPiAssetOrder);
            }

            //create cm_pi_asset_description
            $totalPiDetails = count($input['cm_machine_type_id']);
            for ($d=0; $d < $totalPiDetails; $d++) { 
                // check machine type 
                $getMachineType = MachineType::getExistsMachineType($input['cm_machine_type_id'][$d]);
                if(!empty($getMachineType)){
                    $machineTypeId = $getMachineType->id;
                }else{
                    $setMachineType = [
                        'type_name' => $input['cm_machine_type_id'][$d],
                        'manufacturer' => $input['manufacturer'][$d]
                    ];
                    // create machine type
                    $machineTypeId = MachineType::insertGetId($setMachineType);
                }
                $setPiDetails = [
                    'cm_pi_asset_id'     => $input['cm_pi_asset_id'],
                    'cm_machine_type_id' => $machineTypeId,
                    'model_no'           => $input['model_no'][$d],
                    'description'        => $input['description'][$d],
                    'cm_section_id'      => $input['cm_section_id'][$d],
                    'qty'                => $input['qty'][$d],
                    'uom'                => $input['uom'][$d],
                    'unit_price'         => $input['unit_price'][$d],
                    'currency'           => $input['currency'][$d]
                ];
                CmPIAssetDescription::insert($setPiDetails);
            }

            $msg = 'Successfully crated others pi entry';
            $this->logFileWrite($msg, $input['cm_pi_asset_id']);
            DB::commit(); 
            return redirect()->back()->with('success', $msg);
            
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['getSuppliers'] = Supplier::all();
        $data['getUnit'] = Unit::all();
        $data['getItem'] = Item::all();
        $data['getOrder'] = OrderEntry::orderBy('order_id')->pluck('order_code', 'order_id');
        $data['getSection'] = Section::all();
        $data['getPiAsset'] = CmPIAsset::findOrFail($id);
        $data['getPiAssetOrder'] = CmPIAssetOrder::getPiAssetIdWiseOrder($id);
        $data['getPiAssetDescription'] = CmPIAssetDescription::where('cm_pi_asset_id', $id)->get();
        //return $data['getPiAssetDescription'];
        return view('commercial.xinnah.import.asset.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'file_no'            => 'required',
            'hr_unit'            => 'required',
            'cm_item_id'         => 'required',
            'pi_no'              => 'required',
            'mr_supplier_sup_id' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $getPiAsset = CmPIAsset::findOrFail($id);
        DB::beginTransaction();
        try {
            
            // check, create, update, delete cm_pi_asset_order table
            $getPiAssetOrder = CmPIAssetOrder::getPiAssetIdWiseOrder($id);
            $deletePiOrder = array_diff($getPiAssetOrder, $input['mr_order_entry_order_id']);
            foreach ($deletePiOrder as $key => $value) {
                CmPIAssetOrder::where('cm_pi_asset_id', $id)->where('mr_order_entry_order_id', $value)->delete();
            }
            
            $newPiOrder = array_diff($input['mr_order_entry_order_id'], $getPiAssetOrder);
            foreach ($newPiOrder as $key => $value) {
                $setPiAssetOrder = [
                    'cm_pi_asset_id'          => $id,
                    'mr_order_entry_order_id' => $value
                ];
                CmPIAssetOrder::insert($setPiAssetOrder);
            }
            
            // check , create, update, delete cm_pi_asset_description table

            $getPiAssetDescription = CmPIAssetDescription::where('cm_pi_asset_id', $id)->pluck('id')->toArray();
            if(count($getPiAssetDescription) > 0){
                if(isset($input['ex_pi_asset_description_id'])){
                    $deletePiAssetDescription = array_diff($getPiAssetDescription, $input['ex_pi_asset_description_id']);
                }else{
                    $deletePiAssetDescription = $getPiAssetDescription;
                }
                foreach ($deletePiAssetDescription as $key => $value) {
                    $piAssetDescription = CmPIAssetDescription::findOrFail($value);
                    $piAssetDescription->delete();
                }

                //update cm_pi_asset_description
                $totalExPiDetails = count($input['ex_pi_asset_description_id']);
                for ($epd=0; $epd < $totalExPiDetails; $epd++) { 
                    // check machine type 
                    $getMachineType = MachineType::getExistsMachineType($input['ex_cm_machine_type_id'][$epd]);
                    if(!empty($getMachineType)){
                        $machineTypeId = $getMachineType->id;
                    }else{
                        $setMachineType = [
                            'type_name' => $input['ex_cm_machine_type_id'][$epd],
                            'manufacturer' => $input['ex_manufacturer'][$epd]
                        ];
                        // create machine type
                        $machineTypeId = MachineType::insertGetId($setMachineType);
                    }
                    $setPiDetails = [
                        'cm_machine_type_id' => $machineTypeId,
                        'model_no'           => $input['ex_model_no'][$epd],
                        'description'        => $input['ex_description'][$epd],
                        'cm_section_id'      => $input['ex_cm_section_id'][$epd],
                        'qty'                => $input['ex_qty'][$epd],
                        'uom'                => $input['ex_uom'][$epd],
                        'unit_price'         => $input['ex_unit_price'][$epd],
                        'currency'           => $input['ex_currency'][$epd]
                    ];
                    CmPIAssetDescription::updatePiAssetDescription($input['ex_pi_asset_description_id'][$epd], $setPiDetails);
                }
            }
            
            if(isset($input['cm_machine_type_id'])){
                //create cm_pi_asset_description
                $totalPiDetails = count($input['cm_machine_type_id']);
                for ($d=0; $d < $totalPiDetails; $d++) { 
                    // check machine type 
                    $getMachineType = MachineType::getExistsMachineType($input['cm_machine_type_id'][$d]);
                    if(!empty($getMachineType)){
                        $machineTypeId = $getMachineType->id;
                    }else{
                        $setMachineType = [
                            'type_name' => $input['cm_machine_type_id'][$d],
                            'manufacturer' => $input['manufacturer'][$d]
                        ];
                        // create machine type
                        $machineTypeId = MachineType::insertGetId($setMachineType);
                    }
                    $setPiDetails = [
                        'cm_pi_asset_id'     => $id,
                        'cm_machine_type_id' => $machineTypeId,
                        'model_no'           => $input['model_no'][$d],
                        'description'        => $input['description'][$d],
                        'cm_section_id'      => $input['cm_section_id'][$d],
                        'qty'                => $input['qty'][$d],
                        'uom'                => $input['uom'][$d],
                        'unit_price'         => $input['unit_price'][$d],
                        'currency'           => $input['currency'][$d]
                    ];
                    CmPIAssetDescription::insert($setPiDetails);
                }
            }

            // check file no 
            $getFileNo = CmFile::getExistsCmFile($input['file_no']);
            if(!empty($getFileNo)){
                $input['cm_file_id'] = $getFileNo->id;
            }else{
                $cmFile['file_no'] = $input['file_no'];
                $cmFile['hr_unit'] = $input['hr_unit'];
                $cmFile['file_type'] = 2;
                $cmFile['status'] = 1;
                $input['cm_file_id'] = CmFile::insertGetId($cmFile);
            }
            // update info in cm_pi_asset
            $getPiAsset->update($input);
            
            $msg = 'Successfully updated others pi entry';
            $this->logFileWrite($msg, $id);
            DB::commit(); 
            return redirect()->back()->with('success', $msg);
            
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getMachineType(Request $request)
    {
        $input = $request->all();
        $getMachineType = MachineType::getMachineTypeSearchWise($input['name_startsWith']);

        $data = array();

        if(count($getMachineType) > 0){
            foreach ($getMachineType as $type) {
                $data[] = $type->type_name.'|'.$type->manufacturer.'|'.$type->id;
            }
        }
        return $data;

    }

    public function deleteOthersPi(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $getPiAsset = CmPIAsset::findOrFail($input['id']);

            // check, delete cm_pi_asset_order
            $checkPiAssetOrder = CmPIAssetOrder::getPiAssetIdWiseOrderId($input['id']);
            foreach ($checkPiAssetOrder as $order) {
                $getPiAssetOrder = CmPIAssetOrder::findOrFail($order->id);
                //$getPiAssetOrder->delete();
            }

            //check, delete cm_pi_asset_description
            $checkPiAssetDescription = CmPIAssetDescription::getPiAssetIdWiseDescription($input['id']);
            foreach ($checkPiAssetDescription as $description) {
                $getPiAssetDescription = CmPIAssetDescription::findOrFail($description->id);
                $getPiAssetDescription->delete();
            }

            //delete cm_pi_asset
            $getPiAsset->delete();
            
            $msg = 'Successfully delete others pi entry';
            $this->logFileWrite($msg, $input['id']);
            DB::commit(); 
            return redirect()->back()->with('success', $msg); 
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
        
    }
}

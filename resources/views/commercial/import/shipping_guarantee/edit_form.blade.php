<div class="col-sm-offset-1 col-sm-10">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="entry_save_content">
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/importdata/shipping-guarantee-date-update-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- 1st ROW -->
                <div class="row">
                    <div class="col-sm-12">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" >  Shipping Guarantee Receive Date:<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="value" name="ship_gurant_rcv_date" placeholder="Enter" value="{{!empty($data->ship_gurant_rcv_date)?$data->ship_gurant_rcv_date:''}}" class="form-control col-xs-12" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" > Original BL Sent to C&F Date:<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="value" name="original_bl_to_cnf_date" placeholder="Enter" value="{{!empty($data->original_bl_to_cnf_date)?$data->original_bl_to_cnf_date:''}}" class="form-control col-xs-12" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" > SG Submit to Bank Date:<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="value" name="sg_sub_bank_date" placeholder="Enter" value="{{!empty($data->sg_sub_bank_date)?$data->sg_sub_bank_date:''}}" class="form-control col-xs-12" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" > Original Doc Received Date:<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="value" name="original_doc_rcv_date" placeholder="Enter" value="{{!empty($data->original_doc_rcv_date)?$data->original_doc_rcv_date:''}}" class="form-control col-xs-12" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" > S.G Received From C&F:<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="value" name="sg_rcv_from_cnf" placeholder="Enter" value="{{!empty($data->sg_rcv_from_cnf)?$data->sg_rcv_from_cnf:''}}" class="form-control col-xs-12" required />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="cmImpDataEntryId" name="cm_imp_data_entry_id" value="{{$cmImpDataEntryId}}">
                        <input type="hidden" id="cmShipGuaranteeUpdateId" name="cm_ship_guarantee_update_id" value="{{!empty($data->id)?$data->id:''}}">
                        <input type="hidden" id="cmBtbId" name="cm_btb_id" value="{{$cmbtbId}}">
                        <input type="hidden" id="cmFileId" name="cm_file_id" value="{{$cmFileId}}">
                        <input type="hidden" id="cmImpDateUpdateSeaPortId" name="cm_imp_date_update_sea_port_id" value="{{$cmImpDateUpdateSeaPortId}}">
                        <div class="col-sm-12">
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
      </div>
    </div>
</div>

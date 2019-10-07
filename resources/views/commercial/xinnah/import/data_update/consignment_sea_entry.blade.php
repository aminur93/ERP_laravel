<div class="col-sm-offset-1 col-sm-10">
    <div class="panel">
      <div class="panel-body">
        <div class="entry_save_content">
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/import-data-update/consignment-sea-port-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="cm_imp_data_entry_id" value={{$data['cm_imp_data_entry_id']}}>
                <input type="text" name="page_type" value="{{$data['page_type']}}">
                <!-- 1st ROW -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" >  Value<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="value" readonly value="{{$getDataEntry['value']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="transp-doc-no2" > Transport Doc No-2<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="transp-doc-no2" readonly value="{{$getDataEntry['transp_doc_no2']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="shipment-date" > Shipment Date<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="shipment-date" readonly value="{{$getDataEntry['transp_doc_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="container-size-1" > Container # & Size-1<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="container-size-1" readonly value="{{$getDataEntry['container_1']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="transp-doc-no1" > Transport Doc No-1<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="transp-doc-no1" readonly value="{{$getDataEntry['transp_doc_no1']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="container-size-2" > Container # & Size-2<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="container-size-2" readonly value="{{$getDataEntry['container_2']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="port-of-loading" > Port of Loading<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="port-of-loading" readonly value="{{$getDataEntry['cm_port_id']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="mother-vessel" > Mother Vessel<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="mother-vessel" readonly value="{{$getDataEntry['container_3']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="goods-shipped-by" > Goods Shipped By<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="goods-shipped-by" readonly value="{{$getDataEntry['ship_company']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="container-size" > Container Size<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="container-size" readonly value="{{$getDataEntry['container_size']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-4 no-padding">
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="weight" > Weight<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="weight" readonly value="{{$getDataEntry['weight']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="cubic-measurement" > Cubic Measurement<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="cubic-measurement"  readonly value="{{$getDataEntry['cubic_measurement']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="qty" > Qty<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="qty" readonly value="{{$getDataEntry['qty']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="feeder-vessel" > Feeder Vessel<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="feeder-vessel" name="feeder_vessel" value="{{$consignmentSeaPort['feeder_vessel']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="ETA Ctg" > eta-ctg<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="ETA Ctg" name="eta_ctg" value="{{$consignmentSeaPort['eta_ctg']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="bank-submission-date" > Bank Submission Date<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="date" id="bank-submission-date" name="bank_sub_date" value="{{$consignmentSeaPort['bank_sub_date']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="cf-agent-name" > C&F Agent Name<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <select name="cm_agent_id" id="cf-agent-name" class="col-xs-12 form-control">
                                                        <option value=""> - select - </option>
                                                        @foreach($getAgent as $agent)
                                                        @if($agent->id == $consignmentSeaPort['cm_agent_id'])
                                                        <option value="{{$agent->id}}" selected>{{$agent->agent_name}}</option>
                                                        @else
                                                        <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-sm-4 no-padding-right">
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="document-dispatch" > Document Dispatch Date<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="date" id="document-dispatch" name="document_dispatch_date" value="{{$consignmentSeaPort['document_dispatch_date']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="original-sg" > Original/S.G<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    
                                                    {{ Form::select('original_sg', ['Original'=>'Original','S.G'=>'S.G'], $consignmentSeaPort['original_sg'], ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'id' => 'original-sg']) }}
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="vessel-at-outer" > Vessel at Outer<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="vessel-at-outer" name="vessel_outer" value="{{$consignmentSeaPort['vessel_outer']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="vessel-berth" > Vessel Berth<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="vessel-berth" name="vessel_berth" value="{{$consignmentSeaPort['vessel_berth']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="doc-type" > Doc Type<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="doc-type" readonly value="{{$getDataEntry['doc_type']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="document-date" > Document Date<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="date" id="document-date" name="document_date" value="{{$consignmentSeaPort['document_date']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-sm-4 no-padding-right">
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="sg-no" > S.G No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="sg-no" name="sg_no" value="{{$consignmentSeaPort['sg_no']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="sg-date" > S.G Date<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="date" id="sg-date" name="sg_date" value="{{$consignmentSeaPort['sg_date']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="priority" > Priority <span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    
                                                    {{ Form::select('priority', ['High'=>'High','Medium'=>'Medium','Low'=>'Low'], $consignmentSeaPort['priority'], ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'id' => 'priority']) }}
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
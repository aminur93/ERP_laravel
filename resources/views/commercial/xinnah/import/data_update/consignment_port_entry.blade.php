<div class="col-sm-offset-1 col-sm-10">
    <div class="panel">
      <div class="panel-body">
        <div class="entry_save_content">
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/import-data-update/consignment-sea-port-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="cm_imp_data_entry_id" value={{$data['cm_imp_data_entry_id']}}>
                <input type="hidden" name="page_type" value="{{$data['page_type']}}">
                <!-- 1st ROW -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="feeder-vessel" > Feeder Vessel<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="feeder-vessel" readonly value="{{$consignmentSeaPort['feeder_vessel']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="noting" > Noting<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="noting" name="port_noting_date" value="{{$consignmentSeaPort['port_noting_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="ETA Ctg" > eta-ctg<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="ETA Ctg" value="{{$consignmentSeaPort['eta_ctg']}}" readonly class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="port_assess_date" > Assessment<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="port_assess_date" name="port_assess_date"  value="{{$consignmentSeaPort['port_assess_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="bank-submission-date" > Bank Submission Date<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="bank-submission-date" name="port_bank_sub_date" value="{{$consignmentSeaPort['port_bank_sub_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="port_examine_date" > Examine<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="port_examine_date" name="port_examine_date" value="{{$consignmentSeaPort['port_examine_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="document-dispatch" > Document Dispatch Date<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="document-dispatch" readonly value="{{$consignmentSeaPort['document_dispatch_date']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="Delivery" > Delivery<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="Delivery" name="port_deliv_date" value="{{$consignmentSeaPort['port_deliv_date']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="vessel-berth" > Vessel Berth<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="vessel-berth" readonly value="{{$consignmentSeaPort['vessel_berth']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="factory-arrival" > Factory Arrival<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" id="factory-arrival" readonly value="" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="Unstaff" > Unstaff<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="Unstaff" name="port_unstaff" value="{{$consignmentSeaPort['port_unstaff']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="cf-agent-name" > C&F Agent Name<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <select name="cm_agent_id2_port" id="cf-agent-name" class="col-xs-12 form-control">
                                        <option value=""> - select - </option>
                                        @foreach($getAgent as $agent)
                                        @if($agent->id == $consignmentSeaPort['cm_agent_id2_port'])
                                        <option value="{{$agent->id}}" selected>{{$agent->agent_name}}</option>
                                        @else
                                        <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-6 no-padding">
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
                                                    <input type="date" id="document-date" readonly value="{{$consignmentSeaPort['document_date']}}" placeholder="Enter" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="original-sg" > Original/S.G<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    
                                                    {{ Form::select('port_original_sg', ['Original'=>'Original','S.G'=>'S.G'], $consignmentSeaPort['port_original_sg'], ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'id' => 'original-sg']) }}
                                                </div>
                                            </div> 
                                        </div>

                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="sg-no" > S.G No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="sg-no" readonly value="{{$consignmentSeaPort['sg_no']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="sg-date" > S.G Date<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="date" id="sg-date" readonly value="{{$consignmentSeaPort['sg_date']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="port-of-loading" > Port of Loading<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" id="port-of-loading" readonly value="{{$getDataEntry['cm_port_id']}}" class="form-control col-xs-12" required />
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 no-padding-right">
                                        <div class="col-sm-12 no-padding">
                                            <div class="form-group">
                                                <label class="col-sm-5 no-padding control-label " for="port_priority" > Priority <span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-7">
                                                    
                                                    {{ Form::select('port_priority', ['High'=>'High','Medium'=>'Medium','Low'=>'Low'], $consignmentSeaPort['port_priority'], ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'id' => 'port_priority']) }}
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
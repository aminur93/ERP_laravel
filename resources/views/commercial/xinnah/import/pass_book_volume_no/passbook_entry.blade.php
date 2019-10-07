<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="entry_save_content">
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/pass-book-and-volume-save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- 1st ROW -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" >  Pass Book Page No.<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="value" name="page_no" placeholder="Pass Book Page No." value="{{$getPassbook['page_no']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-5 no-padding control-label " for="value" > Pass Book Volume No.<span style="color: white">&#42;</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" id="value" name="volume_no" placeholder="Pass Book Volume No." value="{{$getPassbook['volume_no']}}" class="form-control col-xs-12" required />
                                </div>
                            </div> 
                        </div> 
                        <input type="hidden" id="cmImpDataEntryId" name="cm_imp_data_entry_id" value="{{$data['cm_imp_data_entry_id']}}">
                        <input type="hidden" id="cmBtbId" name="cm_btb_id" value="{{$data['cm_btb_id']}}">
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
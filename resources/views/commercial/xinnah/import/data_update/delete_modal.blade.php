 <!-- Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel">Consignment Sea Port</h2>
            </div>
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/import-data-update/consignment-sea-port-action-delete') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" value="" id="rowId" value="" name="id">
                    
                    <div id="delete_section">
                        <div class="delete_msg">
                            <h4 class="text-center">Do You Sure Want To Delete This Data ?</h4>
                        </div>
                          
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                              <button type="submit" class="btn btn-danger btn-sm"><i class="ace-icon fa fa-check bigger-110" ></i> Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9"> 
                        <button class="btn btn-info" type="button" id="modal_data" data-dismiss="modal">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->
<div class="row">
  <div class="entry_result_section">
      <div class="panel panel-success">
        <div class="panel-body">
          <div class="table_result">
              <div class="col-sm-12">
                  <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th>File No.</th>
                                <th>L/C No.</th>
                                <th>S.G No.</th>
                                <th>Mode</th>
                                <th>Supplier</th>
                                <th>Value</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if(count($result)==0){ ?>
                             <tr >
                               <td  colspan="7" ><h4 class="text-center">No data found</h4></td>
                             </tr>
                          <?php }else{ ?>
                        	@foreach($result as $data)
                            <tr>
                              <th>{{$data->file_no}}</th>
                              <th>{{$data->lc_no}}</th>
                              <th>{{$data->sg_no}}</th>
                              <th>{{$data->mode}}</th>
                              <th>{{$data->sup_name}}</th>
                              <th>{{$data->value}}</th>
                              <th>
                                <a id="actionBtn" class="btn btn-info btn-sm" onclick="chooseFileData({{ isset($data->cm_imp_data_entry_id)?$data->cm_imp_data_entry_id:0}}, {{isset($data->cm_btb_id)?$data->cm_btb_id:0}},{{isset($data->cm_imp_data_update_sea_port_id)?$data->cm_imp_data_update_sea_port_id:0}},{{ isset($data->cm_file_id)?$data->cm_file_id:0}})">Edit/Enter</a>
                              </th>
                            </tr>
                          @endforeach
                        <?php } ?>
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>

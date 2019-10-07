<div class="row">
  <div class="entry_result_section">
      <div class="panel panel-success">
        <div class="panel-body">
          <div class="table_result">
              <div class="col-sm-offset-2 col-sm-8">
                  <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th>File No.</th>
                                <th>L/C No.</th>
                                <th>Supplier</th>
                                <th>Value</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(count($getResult) == 0)
                          <tr>
                            <td colspan='5'> <b><h5 class="text-center"> No data found !</h5></b></td>  
                          </tr>
                          @endif
                        	@foreach($getResult as $data)
                            <tr>
                              <td>{{$data->file->file_no}}</td>
                              <td>{{$data->lc_no}}</td>
                              <td>{{$data->supplier->sup_name}}</td>
                              <td>{{$data->value}}</td>
                              <td>
                                <a id="actionBtn" class="btn btn-info btn-sm" onclick="chooseFileData({{$data->cm_imp_data_entry_id}}, {{$data->cm_btb_id}})">Select</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                  </div>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>
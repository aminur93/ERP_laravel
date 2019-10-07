<div class="row">
  <div class="entry_result_section">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table_result">
              <div class="col-sm-offset-2 col-sm-8">
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>File No.</th>
                                <th>Value</th>
                                <th>Package</th>
                                <th>Transport Doc</th>
                                <th>Action</th>
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
                              <td>{{$data->value}}</td>
                              <td>{{$data->package}}</td>
                              <td>{{$data->transp_doc_no1}}</td>
                              <td>
                                <a id="actionBtn" class="btn btn-info btn-sm" onclick="chooseFileData({{$data->id}})">Select</a>
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
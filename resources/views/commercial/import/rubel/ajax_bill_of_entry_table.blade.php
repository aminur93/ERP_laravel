<table class="table table-bordered">
    <thead>
    	<tr>
    		<th>File No</th>
    		<th>L/C No</th>
    		<th>Supplier</th>
    		<th>Value</th>
    		<th>Select</th>
    	</tr>
    </thead>
    <tbody>
        @if(count($dataList) > 0)
            @foreach($dataList as $k => $data)
            	<tr id="{{ $k }}">
            		<td>
            			<input type="text" id="cm_file_id{{ $k }}" name="cm_file_id" placeholder="" value="{{ $data->cm_file_no }}" class="col-xs-12 form-control" readonly="readonly" />
            		</td>
            		<td>
            			<input type="text" id="lc_no{{ $k }}" name="lc_no" placeholder="" value="{{ $data->lc_no }}" class="col-xs-12 form-control" readonly="readonly" />
            		</td>
            		<td>
            			<input type="text" id="mr_supplier_sup_id{{ $k }}" name="mr_supplier_sup_id" placeholder="" value="{{ $data->sup_name }}" class="col-xs-12 form-control" readonly="readonly" />
            		</td>
            		<td>
            			<input type="text" id="value{{ $k }}" name="value" placeholder="" value="{{ $data->value }}" class="col-xs-12 form-control" readonly="readonly" />
            		</td>
            		<td>
            			<button type="button" onclick="showBillEntry('{{ $data->cm_data_entry_id }}')" class="btn btn-info btn-sm">Select</button>
            		</td>
            	</tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">No Data Found</td>
            </tr>
        @endif
    </tbody>
</table>
<script type="text/javascript">
    function showBillEntry(cm_data_entry_id) {
        $.ajax({
            url: '{{ url('commercial/import/billofentry_fetchbillentryform') }}',
            type: 'POST',
            datatype: 'json',
            data: {'cm_data_entry_id': cm_data_entry_id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (res) {
                $('#billEntryForm').html(res);
            }
        })
    }
</script>

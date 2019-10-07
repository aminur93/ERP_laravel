<!-- MASTER INFORMATION -->
<div class="tab-pane fade in active row">

    <div class="row">
	    <div class="col-sm-6"> 
		    {{ Form::open(["url"=>"comm/import/ud_master/library_fabric", "class"=>"form-horizontal"]) }}
		    	<h4 class="page-header">Fabric & Pocketing Library</h4>
			    <!-- Code -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_code" > Code<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-5">
			            <input type="text" name="ud_library_fab_pock_code" id="ud_library_fab_pock_code" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
			        </div>
			    </div> 

			    <!-- Fabric Comp. -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_comp" > Fabric Comp.<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-5">
			            <input type="text" name="ud_library_fab_pock_fab_comp" id="ud_library_fab_pock_fab_comp" placeholder="Fabric Comp." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
			        </div>
			    </div> 

			    <!-- Fabric Desc. -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_desc" > Fabric Desc.</label>
			        <div class="col-sm-5">
			            <textarea type="text" name="ud_library_fab_pock_fab_desc" id="ud_library_fab_pock_fab_desc" placeholder="Fabric Desc." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
			            data-validation-optional="true" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"></textarea>
			        </div>
			    </div>

			    <!-- Fabric Cons. -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_cons" > Fabric Cons.<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-5">
			            <input type="text" name="ud_library_fab_pock_fab_cons" id="ud_library_fab_pock_fab_cons" placeholder="Fabric Cons." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
			        </div>
			    </div> 

			    <!-- Width. -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_width" > Width<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-5">
			            <input type="text" name="ud_library_fab_pock_width" id="ud_library_fab_pock_width" placeholder="Width" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
			        </div>
			    </div> 
			 
			    <!-- SUBMIT -->
			    <div class="form-group">
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="clearfix form-actions" style="margin:12px">
			            <div class="col-sm-offset-3 col-sm-9"> 
			                <button class="btn" type="reset">
			                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
			                </button>
			                &nbsp; &nbsp; &nbsp;
			                <button class="btn btn-info" type="submit">
			                    <i class="ace-icon fa fa-check bigger-110"></i> Save
			                </button>
			            </div>
			        </div> 
			    </div>
		    {{ Form::close() }}
	    </div>

	    <div class="col-sm-6"> 
		    {{ Form::open(["url"=>"comm/import/ud_master/library_accessories", "class"=>"form-horizontal"]) }}
		    	<h4 class="page-header">Accessories Library</h4>
			    <!--Item Code -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_acss_item_code" > Item Code<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-5">
			            <input type="text" name="ud_library_acss_item_code" id="ud_library_acss_item_code" placeholder="Item Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
			        </div>
			    </div>
		 

			    <!-- Item Description -->
			    <div class="form-group">
			        <label class="col-sm-3 control-label no-padding-right" for="ud_library_acss_item_desc" > Item Description</label>
			        <div class="col-sm-5">
			            <textarea type="text" name="ud_library_acss_item_desc" id="ud_library_acss_item_desc" placeholder="Item Description" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
			            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"></textarea>
			        </div>
			    </div>
			 
			    <!-- SUBMIT -->
			    <div class="form-group">
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="space-4"></div>
			        <div class="clearfix form-actions" style="margin:12px">
			            <div class="col-sm-offset-3 col-sm-9"> 
			                <button class="btn" type="reset">
			                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
			                </button>
			                &nbsp; &nbsp; &nbsp;
			                <button class="btn btn-info" type="submit">
			                    <i class="ace-icon fa fa-check bigger-110"></i> Save
			                </button>
			            </div>
			        </div> 
			    </div>
		    {{ Form::close() }} 
	    </div> 
    </div> 

    <div class="row">
    	<!-- Fabrics -->
	    <div class="col-sm-6">
		    <table class="table table-striped datatable2">
		    	<thead>
		    		<tr>
			    		<th>ID</th>
			    		<th>Code</th>
			    		<th>Fabric Comp.</th>
			    		<th>Fabric Desc.</th>
			    		<th>Fabric Cons.</th>
			    		<th>Fabric Width.</th>
			    		<th>Action</th>
			    	</tr>
		    	</thead>
		    	<tbody>
		    		@foreach($fabrics as $fabric)
		    		<tr>
			    		<td>{{ $loop->index+1 }}</td>
			    		<td>{{ $fabric->ud_library_fab_pock_code }}</td>
			    		<td>{{ $fabric->ud_library_fab_pock_fab_comp }}</td>
			    		<td>{{ $fabric->ud_library_fab_pock_fab_desc }}</td>
			    		<td>{{ $fabric->ud_library_fab_pock_fab_cons }}</td>
			    		<td>{{ $fabric->ud_library_fab_pock_width }}</td>
			    		<td>
			    			<div class="btn-group">
			    			<a class="btn btn-xs btn-info" href="{{ url('comm/import/ud_master/library_fabric_edit/'.$fabric->id) }}">Edit</a>
			    			<a class="btn btn-xs btn-danger" href="{{ url('comm/import/ud_master/library_fabric_delete/'.$fabric->id) }}" onclick="return confirm('Are you sure?')">Delete</a>
			    			</div>
			    		</td>
			    	</tr>
		    		@endforeach
		    	</tbody>
		    </table>
	    </div>

	    <!-- Accessories -->
	    <div class="col-sm-6">
		    <table class="table table-striped datatable2">
		    	<thead>
		    		<tr>
			    		<th>ID</th>
			    		<th>Item Code</th>
			    		<th>Item Description</th>
			    		<th>Action</th>
			    	</tr>
		    	</thead>
		    	<tbody>
		    		@foreach($accessories as $acc)
		    		<tr>
			    		<td>{{ $loop->index+1 }}</td>
			    		<td>{{ $acc->ud_library_acss_item_code }}</td>
			    		<td>{{ $acc->ud_library_acss_item_desc }}</td>
			    		<td>
			    			<div class="btn-group">
			    			<a class="btn btn-xs btn-info" href="{{ url('comm/import/ud_master/library_accessories_edit/'.$acc->id) }}">Edit</a>
			    			<a class="btn btn-xs btn-danger" href="{{ url('comm/import/ud_master/library_accessories_delete/'.$acc->id) }}" onclick="return confirm('Are you sure?')">Delete</a>
			    			</div>
			    		</td>
			    	</tr>
		    		@endforeach
		    	</tbody>
		    </table>
	    </div>
    </div>
</div>
 

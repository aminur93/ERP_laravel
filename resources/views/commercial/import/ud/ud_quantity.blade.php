<!-- UD Quantity -->
<div class="tab-pane fade in active">
    {{ Form::open(["url"=>"comm/import/ud_system/master_information", "class"=>"form-horizontal"]) }}

    <div class="row">
    	<!-- Fabric & Pocketing Library Display -->
		<div class="col-sm-4">
			<h4>Fabric & Pocketing Library Display</h4>
			<div style="border: 1px solid #858585;padding: 20px;">
				<!-- Code -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > Code No<span style="color: red">&#42;</span> </label>
			        <div class="col-sm-8">
			            {{ Form::select("fab_pock_code", $codesFabList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
			        </div>
			    </div> 

			    <!-- Fabric Comp. -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Fabric Comp.</label>
			        <div class="col-sm-8">
			            <input type="text" id="fab_pock_comp" placeholder="Fabric Comp." class="form-control" readonly/>
			        </div>
			    </div> 

			    <!-- Fabric Desc. -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_desc" > Fabric Desc.</label>
			        <div class="col-sm-8">
			            <input type="text" id="fab_pock_desc" placeholder="Fabric Desc." class="form-control" readonly/>
			        </div>
			    </div> 

			    <!-- Fabric Cons. -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_cons" > Fabric Cons.</label>
			        <div class="col-sm-8">
			            <input type="text" id="fab_pock_cons" placeholder="Fabric Cons." class="form-control" readonly/>
			        </div>
			    </div> 

			    <!-- Width. -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_width" > Width</label>
			        <div class="col-sm-8">
			            <input type="text" id="fab_pock_width" placeholder="Width" class="form-control" readonly/>
			        </div>
			    </div> 
			</div> 
		</div> 

		<!-- Accessories Library Display -->
		<div class="col-sm-4">
			<h4>Accessories Library Display</h4>
			<div style="border: 1px solid #858585;padding: 20px;">
				<!-- Label -->
			    <div class="form-group" style="margin-bottom:5px">
			        <label class="col-sm-4 control-label"> Code</label>
			        <div class="col-sm-8"><label class="control-label no-padding-right"> Item Description</label></div>
			    </div> 

			    <!-- Input -->
			    @forelse($accessories as $acc)
			    <div class="form-group" style="margin-bottom:5px"> 
			        <div class="col-sm-4">
			            <input type="text" placeholder="Code" value="{{ $acc->ud_library_acss_item_code }}" class="form-control" readonly/>
			        </div>
			        <div class="col-sm-8">
			            <input type="text" placeholder="Item Description" value="{{ $acc->ud_library_acss_item_desc }}" class="form-control" readonly/>
			        </div>
			    </div>  
			    @empty
				    <div class="form-group text-center" style="margin-bottom:5px"> 
				        <label> No item code available!</label>
				    </div>  
			    @endforelse
			</div> 
		</div> 
	</div> 

 

    <div class="row">
    	<!-- UD Fabric & Pocketing Entry -->
		<div class="col-sm-7">
			<h4 style="margin-top:20px">UD Fabric & Pocketing Entry</h4>
			<div style="border: 1px solid #858585;padding: 20px;">
				<div class="row">
					<div class="col-sm-6">
						<!-- File No-->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > File No<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div>
					    </div> 

						<!-- PO No-->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > PO No<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div> 
					    </div> 

						<!-- Use from Stock-->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > Use from Stock<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" data-validation="required" value="option1"> Yes
								</label>
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" data-validation="required" value="option2"> No
								</label> 
					        </div> 
					    </div> 

						<!-- Item-->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > Item<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div> 
					    </div> 

					    <!-- Quantity -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Quantity<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Quantity" class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- Code -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Code<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Code" class="form-control"  data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- Garment Qty -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Garment Qty<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-3">
					            <input type="text" id="fab_pock_comp" placeholder="Enter" class="form-control"  data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					        <div class="col-sm-5">
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" data-validation="required" value="option1"> Pcs
								</label>
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" data-validation="required" value="option2"> Doz
								</label> 
					        </div> 
					    </div>  
				    </div>


					<div class="col-sm-6">
						<!-- Amendment No-->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > Amendment No<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div>
					    </div>  

					    <!-- Seq No. -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Seq No.<span style="color: red">&#42;</span></label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Seq No." class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- Order No. -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Order No.<span style="color: red">&#42;</span></label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Order No." class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- Stock -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Stock<span style="color: red">&#42;</span></label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Stock" class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- Stock From File No -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > Stock From File No<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div>
					    </div>  

					    <!-- Consumption -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Consumption<span style="color: red">&#42;</span></label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Consumption" class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 

					    <!-- UoM -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_code" > UoM<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-8">
					            {{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
					        </div>
					    </div>  


					    <!-- Goods Delivery Date -->
					    <div class="form-group">
					        <label class="col-sm-4 control-label no-padding-right" for="fab_pock_comp" > Goods Delivery Date<span style="color: red">&#42;</span></label>
					        <div class="col-sm-8">
					            <input type="text" id="fab_pock_comp" placeholder="Goods Delivery Date" class="form-control datepicker" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
					        </div>
					    </div> 
				    </div>
			    </div>
		    </div>
	    </div>




		<div class="col-sm-5">
			<h4 style="margin-top:20px">UD Accessories Entry</h4>
			<div style="border: 1px solid #858585;padding: 20px;">
 				<table class="table">
 					<thead>
 						<tr>
 							<th>File No.</th>
 							<th>Code</th>
 							<th>Quantity</th>
 							<th>UoM</th>
 							<th>Type</th>
 							<th width="55"><i class="fa fa-cogs"></i></th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr>
 							<td>
 								{{ Form::select("fab_pock_code", $fileList, null, ['class'=>'form-control no-select', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
 							</td>
 							<td>
								{{ Form::select("fab_pock_code", $codesAccList, null, ['class'=>'form-control no-select', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
 							</td>
 							<td>
 								<input type="text" id="fab_pock_comp" style="width:50px" placeholder="Quantity" class="form-control" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
 							</td>
 							<td>
				                <select name="master_pi_acss_item_qty_unit[]" class="form-control no-select" data-validation="required">
				                    <option value="">UoM</option>
				                    <option value="Millimeter">Millimeter</option>
				                    <option value="Centimeter">Centimeter</option>
				                    <option value="Meter">Meter</option>
				                    <option value="Inch">Inch</option>
				                    <option value="Feet">Feet</option>
				                    <option value="Yard">Yard</option>
				                    <option value="Piece">Piece</option>
				                </select> 
 							</td>
 							<td>
								{{ Form::select("fab_pock_code", ["Foreign", "Local"], null, ['class'=>'form-control no-select', 'id'=>'fab_pock_code', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
 							</td>
 							<td>
 								<div class="btn-group">
	 								<button type="button" class="Add btn btn-xs btn-info">+</button>
	 								<button type="button" class="Remove btn btn-xs btn-danger">-</button>
 								</div>
 							</td>
 						</tr>
 					</tbody>
 				</table>
			 
		    </div>
	    </div>
    </div>

    <!-- Submit  -->
    <div class="row">
    	<div class="col-sm-12">
		    <!-- SUBMIT -->
		    <div class="form-group">
		        <div class="space-4"></div>
		        <div class="space-4"></div>
		        <div class="space-4"></div>
		        <div class="space-4"></div>
		        <div class="space-4"></div>
		        <div class="clearfix form-actions">
		            <div class="col-sm-offset-8 col-sm-4"> 
		                <button class="btn btn-info" type="submit">
		                    <i class="ace-icon fa fa-check bigger-110"></i> Save
		                </button>
		                &nbsp; &nbsp; &nbsp;
		                <button class="btn" type="reset">
		                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
		                </button>
		            </div>
		        </div> 
		    </div>
    	</div>
    </div>

    {{ Form::close() }}
</div>
 

<script type="text/javascript">
$(document).ready(function(){
	$("#fab_pock_code").on("change", function(){
		var id = $(this).val();
		$.ajax({
			url: "{{ url('comm/import/ud_master/get_library_fabric_by_code') }}",
			data: {id},
			success:function(res)
			{
				if (res.id)
				{
					$("#fab_pock_comp").val(res.ud_library_fab_pock_fab_comp);
					$("#fab_pock_desc").val(res.ud_library_fab_pock_fab_desc);
					$("#fab_pock_cons").val(res.ud_library_fab_pock_fab_cons);
					$("#fab_pock_width").val(res.ud_library_fab_pock_width);
				} 
				else
				{
					$("#fab_pock_comp").val("");
					$("#fab_pock_desc").val("");
					$("#fab_pock_cons").val("");
					$("#fab_pock_width").val("");
				}
			},
			error:function(xhr)
			{
				alert('failed');
			}
		})
	});

	// Add Or Remove
	$("body").on("click", ".Add", function(){
		let data = $(this).parent().parent().parent().html();
		$(this).parent().parent().parent().parent().append("<tr>"+data+"</tr>");
	});
	$("body").on("click", ".Remove", function(){
		$(this).parent().parent().parent().remove();
	});
});
</script>

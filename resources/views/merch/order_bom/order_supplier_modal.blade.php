<div class="modal fade newSupplierModal" tabindex="-1" role="dialog" aria-labelledby="newSupplierLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary">
				<h2 class="modal-title text-center" id="myModalLabel"> Add Supplier</h2>
		</div>
		<div class="modal-body row">
			<div class="col-md-12">
			<form class="form-horizontal" id="supForm" role="form" method="POST" action="" enctype="multipart/form-data">
			{{ csrf_field() }}
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="sup_name" > Supplier Name<span style="color: red">&#42;</span> </label>
							<div class="col-sm-9">
									<input type="text" name="sup_name" id="sup_name" placeholder="Supplier Name"  class="col-xs-9" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" required/>
							</div>
					</div>
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="cnt_id" >Country<span style="color: red">&#42;</span> </label>
							<div class="col-sm-9">
									{{ Form::select('cnt_id', $countryList, null, ['placeholder'=>'Select Country', 'id'=>'cnt_id','class'=> 'col-xs-9 filter', 'style'=>'width: 312px;','data-validation' => 'required']) }}
							</div>
					</div>
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="sup_address"> Address <span style="color: red">&#42;</span> </label>
							<div class="col-sm-9">
									<textarea name="sup_address" id="sup_address" class="col-xs-9" placeholder="Address"  data-validation="required length" data-validation-length="0-128"></textarea>
							</div>
					</div>
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="sup_type"> Supplier Type <span style="color: red">&#42;</span> </label>
							<div class="col-sm-9">
									<div class="radio">
											<label>
													<input type="radio" id="sup_type" name="sup_type"  class="ace" value="Local"  data-validation="required"/>
													<span class="lbl"> Local</span>
											</label>
											<label>
													<input type="radio" id="sup_type" name="sup_type" class="ace" value="Foreign"/>
													<span class="lbl">Foreign</span>
											</label>
									</div>
							</div>
					</div>
					<div class="addRemove">
							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="scp_details"> Contact Person <span style="color: red">&#42;</span> (<span style="font-size: 9px">Name, Cell No, Email</span>) </label>
									<div class="col-sm-9">
											<textarea name="scp_details[]" id="scp_details" class="col-xs-9" placeholder="Contact Person"  data-validation="required length" data-validation-length="0-128"></textarea>
											<div class="form-group col-xs-3">
													<button type="button" class="btn btn-sm btn-success AddBtn">+</button>
													<button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
											</div>
									</div>
							</div>
					</div>
					<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="scp_details"> Item</label>
									<div class="col-sm-9">
											<div class="form-group col-xs-3">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#select_item">Select  Item</button>
											</div>
									</div>
							</div>
							<div class="form-group">
										<div id="Item_description" class="form-group col-xs-8 pull-right" style="margin-left: 107px;margin-right: 46px;">
										</div>
							 </div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary btn-sm supplier_save">Submit</button>
		</div>
			<!-- </form> -->
		</div>
	</div>
</div>
<script type="text/javascript">

    $(document).ready(function(){

        $('#dataTables').DataTable();
        var data = $('.AddBtn').parent().parent().parent().parent().html();
        $('body').on('click', '.AddBtn', function(){
            $('.addRemove').append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });


        // Modal Check Box
                $('#select_item').on('hidden.bs.modal', function (e) {
            var data= '';
						data += '<table class="table" style="margin-top: 30px;">';
						data += '<thead>';
						data += '<tr>';
						data += '<td colspan="3" class="text-center">Item Name</td>';
						data += '</tr>';
						data += '</thead>';
						data += '<tbody>';
            $('.checkbox-input').each(function(i, v){
                if ($(this).is(":checked"))
                {
                    var id= $(this).val();
                    console.log(id);
                    var item_name= $(this).next().text();

							      data += '<tr>';
							      data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+item_name+'</strong></td>';
							      data+= '<input type="hidden" name="item_id[]" value="'+id+'"><input type="hidden" name="items[]" id="items[]" placeholder="Food" value="'+item_name+'" class="col-xs-12" readonly/>';
							      data += '</tr>';

                    //var item_code= $(this).parent().next().text();
                }
            });
						data += '</tbody>';
						data += '</table>';
            // console.log(data);
            $("#Item_description").html(data);
        });

    });
</script>

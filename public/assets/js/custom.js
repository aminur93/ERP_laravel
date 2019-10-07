$(document).ready(function()
{
	//date time picker
	$('.datetimepicker').datetimepicker({
		showClose: true,
		showTodayButton: true,
		dayViewHeaderFormat: "YYYY MMMM", 
		format: "YYYY-MM-DD HH:mm"
	});
	$('.datepicker').datetimepicker({
		showClose: true,
		showTodayButton: true,
		dayViewHeaderFormat: "YYYY MMMM", 
		format: "YYYY-MM-DD",
        minDate:false
	});
    $('.timepicker').datetimepicker({
        showClose: true,
        showTodayButton: true,
        format: "HH:mm" 
    }); 
    $(".date_of_birth").datepicker({
        autoclose: true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: '-18Y',
    });
    $('.yearpicker').datetimepicker({
        showClose: true,
        format: "YYYY"
    }); 

    $('.currentYearPicker').datetimepicker({
        minDate: moment(), // Current day
        viewMode: 'years',
        dayViewHeaderFormat: 'YYYY',
        format: "YYYY"
    });
    $('.currentMonthPicker').datetimepicker({
        viewMode: 'months',
        format: "MMMM"
    });

    $('.monthpicker').datetimepicker({
        showClose: true,
        format: "MMMM"
    });  
	$('.monthYearpicker').datetimepicker({
		showClose: true,
        format: "MMMM-YYYY"
	});  
      



	//select 
	$('select:not(.no-select)').select2({
		allowClear:false
	});
 
	// Form Validation
	$.validate({
	  modules : 'validator.ext'
	}); 

    // Load TinyMCE
    tinymce.init({
        selector:'.tinyMceLetter',
        toolbar: [
            '',
        ],
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        theme: 'modern',
        height : "1000",
        menubar: false,
        branding: false,
        readonly: 1,
        setup : function(ed){
            ed.on('init', function() 
            {
                $(ed.getElement()).parent().find('.tinyMceLoader').remove();
                ed.getBody().style.fontSize = '11px';
            });
            ed.on("LoadContent", function(){
                $(ed.getElement()).parent().prepend("<p class='text-center tinyMceLoader'><i class='fa fa-spinner fa-pulse fa-5x'></i></p>")
                $(ed.getElement()).removeClass('hide');
            });
        } 
    });
    
	// tiny mce
	tinymce.init({
		selector:'.tinyMce',
		toolbar: [
			'styleselect | undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
		],
		plugins: [
			'advlist autolink lists link image charmap print preview anchor textcolor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code help wordcount'
		],
		theme: 'modern',
		height : "100",
		menubar: false,
		branding: false,
        setup : function(ed){
            ed.on('init', function() 
            {
                $(ed.getElement()).parent().find('.tinyMceLoader').remove();
                ed.getBody().style.fontSize = '11px';
            });
            ed.on("LoadContent", function(){
                $(ed.getElement()).parent().prepend("<p class='text-center tinyMceLoader'><i class='fa fa-spinner fa-pulse fa-5x'></i></p>")
                $(ed.getElement()).removeClass('hide');
            });
        } 
	}); 
	
	// dataTables 
    $('.datatable').DataTable({ 
        responsive: true, 
        dom: "<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
         buttons: [  
            {
            	extend: 'copy', 
            	className: 'btn-sm btn-info',
                exportOptions: {
                    columns: ':visible'
                },
                title: "",
                messageTop: $('#headerTxt').html()

            }, 
            {
            	extend: 'csv', 
            	className: 'btn-sm btn-success',
                exportOptions: {
                    columns: ':visible'
                },
                title: "",
                messageTop: $('#headerTxt').html()
            }, 
            {
            	extend: 'excel', 
            	className: 'btn-sm btn-warning',
                exportOptions: {
                    columns: ':visible'
                },
                title: "",
                messageTop: $('#headerTxt').html()
            }, 
            {
            	extend: 'pdf', 
            	className: 'btn-sm btn-primary', 
                exportOptions: {
                    columns: ':visible'
                },
                title: "",
                messageTop: $('#headerTxt').html()
            }, 
            {
            	extend: 'print', 
            	className: 'btn-sm btn-default',
                exportOptions: {
                    columns: ':visible' 
                },
                title: "", 
                messageTop: $('#headerTxt').html()
            }, 
        ], 
    });

    $('.datatable2').DataTable(); 


    // tooltip
	$('.tooltip').tooltip();

    //data-table padding remove
    $("#dataTables").parent().attr("style", "padding-left:0px; padding-right:0px");
});


<!DOCTYPE html>
<html>
<head>
	<title>Joining Letter</title>
</head>
<body>
	<div id="letter">{!! $data !!} ?></div>
<script type="text/javascript">
	var printContents = document.getElementById("letter").innerHTML;
	w=window.open();
	w.document.write(printContents);
	w.print();
	w.close();
	document.location.href = "{{ url('hr/recruitment/job_portal/joining_letter') }}"; 
</script>
</body>
{{ URL::previous() }}
</html>

<?php
$dirname ='/assets/files/';
if (substr($dirname, 0, 14) === '/assets/files/'){   
    echo "file type ";} 
    else  echo "Nai ";


   ?>
<form action="" method="post">
	 <input type="text" class="setcolorfile" name="f2[0]" value="/assets/files/materialcolor/5b77f590c8704.jpeg">
   <input type="file" name="march_file1[0]"  class="selectItem">      
          

        <input type="file" class="selectItem" name="march_file1[1]">
           <input type="text" class="setcolorfile" name="f2[1]">
        
    </form>

<?php

  	for($i=0; $i<sizeof($_POST['march_file']); $i++){
  		
  	}
?>
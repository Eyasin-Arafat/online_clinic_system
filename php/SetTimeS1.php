<?php
	include '../db/db_connect.php';
	$date=$_GET['tk'];
	$query="SELECT `slot1` FROM `slot1` WHERE `date` ='$date';";
	$results=getdata($query);
	print_r($results);
?>

<?php 
	foreach ($results as $value) {?>
		 <option value="<?php echo $value['slot1']; ?>"><?php echo $value['slot1']; ?> </option>

<?php } ?>
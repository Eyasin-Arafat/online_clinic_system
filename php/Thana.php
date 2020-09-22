<?php
	include '../db/db_connect.php';
	$did=$_GET['tk'];
	$query1="SELECT id,thana FROM thana WHERE district_id='$did'";
	$results1=getdata($query1);
	print_r($results1);
?>

<?php 
	foreach ($results1 as $value) {?>
		 <option value="<?php echo $value['thana']; ?>"><?php echo $value['thana']; ?> </option>

<?php } ?>
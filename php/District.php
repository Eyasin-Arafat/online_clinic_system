<?php
	include '../db/db_connect.php';
	$id=$_GET['sk'];
	//echo $id;
	$query="SELECT id,district FROM district WHERE divission_id='$id'";
	$results=getdata($query);
	print_r($results);
	
?>
<?php 
	foreach ($results as $value) {?>
		 <option value="<?php echo $value['district']; ?>"><?php echo $value['district']; ?> </option>

<?php } ?>
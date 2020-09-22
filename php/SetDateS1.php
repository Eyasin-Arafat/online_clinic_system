<?php
	include '../db/db_connect.php';
	$cname=$_GET['sk'];
	$query="SELECT `date` FROM `slot1` WHERE cname='$cname';";
	$results=getdata($query);
	print_r($results);
	
?>
<?php 
	foreach ($results as $value) {?>
		 <option value="<?php echo $value['date']; ?>"><?php echo $value['date']; ?> </option>

<?php } ?>
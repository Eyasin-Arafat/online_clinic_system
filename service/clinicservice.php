<?php
function clinicsdata($cid)
{
	$cquery="SELECT * FROM clinics WHERE cid='$cid'";
	$cresults=getdata($cquery);
	return $cresults;

}
//data retrieve fron clinics table ends

//insert into clinic schedule table
function setschedule()
{
	global $time;
	global $cid;
	global $date;
	$results=clinicsdata($cid);
	foreach ($results as $cresult) 
	{
		$cname=$cresult['cname'];
		$phonenumber=$cresult['phonenumber'];
		$divission=$cresult['divission'];
		$district=$cresult['district'];
		$thana=$cresult['thana'];
	}
	$s1query="INSERT INTO slot1 VALUES (NULL,'$cid','$cname','$time','$divission','$district','$thana','$date')";
	execute($s1query);
}
//insert into clinic schedule table
//delete clinic schedule
if (isset($_GET['sdeleteid'])) {
	$sid=$_GET['sdeleteid'];
	scheduledelete($sid);
	header ('Location:../views/ClinicSchedule.php');

}
<?php 
	include '../db/db_connect.php';
	include '../service/clinicservice.php';
	$time="";
	$has_err=false;
	$cid="";

	if (isset($_POST['schedule'])) {
		
		$time=$_POST['time'];
		$cid=$_POST['cid'];
		$date=$_POST['date'];
		if(!$has_err)
		{
			setschedule();
			header ('Location:../views/ClinicSchedule.php');
		}

	}
//data retrieve fron clinics table starts
/*function clinicsdata($cid)
{
	$cquery="SELECT * FROM clinics WHERE cid='$cid'";
	$cresults=getdata($cquery);
	return $cresults;

}*/
//data retrieve fron clinics table ends

//insert into clinic schedule table
/*function setschedule()
{
	global $time;
	global $cid;
	global $date;
	//$results=clinicsdata($cid);
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
}*/
//insert into clinic schedule table

//data retrieve from slot 1
function slot1($cid)
{
	$csquery="SELECT * FROM slot1 WHERE cid='$cid'";
	$csresult=getdata($csquery);
	return $csresult;
}
//data retrieve from slot 1
//delete clinic schedule
if (isset($_GET['sdeleteid'])) {
	$sid=$_GET['sdeleteid'];
	scheduledelete($sid);
	header ('Location:../views/ClinicSchedule.php');

}
function scheduledelete($id)
{
	$sdelete="DELETE FROM `slot1` WHERE id='$id'";
	execute($sdelete);
}
//delete clinic schedule
//data retrieve from patient records table starts///
function patientrecords($cid)
{
	$records="SELECT * FROM `patientrecords` WHERE cid='$cid'";
	$results=getdata($records);
	return $results;
}
//data retrieve from patient records table ends///
?>
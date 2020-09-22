<?php

	
	
//insert into database query
function insertpatient()
{
	global $uid;
	global $uname;
	global $pass_hash;
	global $gender;
	global $email;
	global $number;
	global $dob;
	global $divission;
	global $district;
	global $thana;
	global $bloodgroup;
	$status=3;

	//insert into patients table
	$pquery="INSERT INTO patients VALUES (NULL,'$uid','$uname','$gender','$email','$number','$dob','$bloodgroup','$divission','$district','$thana')";
	//insert into users table
	$uquery="INSERT INTO users VALUES (NULL,'$uid','$pass_hash','$status')";

	execute($pquery); 
	execute($uquery); 
}
//Update
//insert into database query
function updatepatient()
{
	global $uid;
	global $uname;
	global $pass;
	global $number;
	global $divission;
	global $district;
	global $thana;

	//update into patients table
	$pquery="UPDATE `patients` SET `username`='$uname',`phonenumber`='$number',`divission`='$divission',`district`='$district',`thana`='$thana' WHERE `userid`='$uid'";
	//update into users table
	$uquery="UPDATE users SET password='$pass' WHERE userid='$uid'";

	execute($pquery); 
	execute($uquery); 
}
//update ends


function patientsdata($uid)
{
	//data retrieve fron patient table
	$pquery="SELECT * FROM patients WHERE userid='$uid'";
	$presults=getdata($pquery);
	return $presults;
}
function patientuser($uid)
{
	//data retrieve fron users table
	$uquery="SELECT password FROM users WHERE userid='$uid'";
	$uresults=getdata($uquery);
	return $uresults;
}
function divission()
{
	$query="SELECT * from divission";
	$results=getdata($query);
	return $results;
}
function schedule()
{
	$query="SELECT * FROM `doctorsetschedule`";
	$results=getdata($query);
	return $results;
}
///req to doctor
if (isset($_GET['reqid'])) 
{
	$reqid=$_GET['reqid'];
	patientrequest($reqid);
	header('location:../views/PatientHomePage.php');
}
function patientrequest($reqid)
{
	$pid=$_GET['pid'];
	$patients=patient($pid);
	foreach ($patients as $value) 
	{
		$pname=$value['username'];
	}
	$result=doctorsetschedule($reqid);
	foreach ($result as $value) {
		$did=$value['did'];
		$dname=$value['dname'];
		$cid=$value['cid'];
		$cname=$value['cname'];
		$time=$value['time'];
		$date=$value['date'];
		$divission=$value['divission'];
		$district=$value['district'];
		$thana=$value['thana'];
	}
	$query="INSERT INTO `patientrequest`VALUES (NULL,'$pid','$pname','$did','$dname','$cid','$cname','$time','$date','$divission','$district','$thana')";
	execute($query);
}
function doctorsetschedule($id)
{
	$query="SELECT * FROM doctorsetschedule WHERE id='$id'";
	$results=getdata($query);
	return $results;
}
function patient($pid)
{
	$query="SELECT * FROM patients WHERE userid='$pid'";
	$results=getdata($query);
	return $results;
}
//notification table retrieve
function notification($pid)
{
	$notification="SELECT * FROM `notification` WHERE pid='$pid'";
	$results=getdata($notification);
	return $results;
}
//data retrieve from patient records table starts///
function patientrecords($pid)
{
	$records="SELECT * FROM `patientrecords` WHERE pid='$pid'";
	$results=getdata($records);
	return $results;
}
//data retrieve from patient records table ends///

function patientschedule($pid)
{
	$query="SELECT * FROM patientrequest WHERE pid='$pid'";
	$results=getdata($query);
	return $results;
}
if (isset($_GET['delid'])) 
{
	$id=$_GET['delid'];
	
	deleterequest($id);
	header('location:../views/PatientRequestedAppointment.php');
	//echo "<script> alert('Successfully Deleted');window.location='../view/PatientRequestedAppointment.php' </script>";
}
function deleterequest($id)
{
	$query="DELETE FROM `patientrequest` WHERE id='$id'";
	execute($query);
}
?>
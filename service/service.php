
<?php
function inserttempdoctor()
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
	global $specialty;
	global $degree;
	global $bmdcregno;
	global $description;
	$status=2;

	//insert into tempdoctorrequests table
	$dquery="INSERT INTO tempdoctorrequests VALUES (NULL,'$uid','$uname','$gender','$email','$number','$dob','$divission','$district','$thana','$specialty','$degree','$bmdcregno','$description')";
	//insert into tempusers table
	$uquery="INSERT INTO tempusers VALUES (NULL,'$uid','$pass_hash','$status')";

	execute($dquery); 
	execute($uquery); 
}

function doctorsdata($uid)
{
	//data retrieve fron patient table
	$dquery="SELECT * FROM doctors WHERE userid='$uid'";
	$dresults=getdata($dquery);
	return $dresults;
}
function doctoruser($uid)
{
	//data retrieve fron users table
	$uquery="SELECT password FROM users WHERE userid='$uid'";
	$uresults=getdata($uquery);
	return $uresults;
}

if(isset($_POST['update']))
{
	//patient update own profile
	$uid=($_GET['uid']);
	$uname=$_POST['uname'];
	$pass=$_POST['pass'];
	$pass=password_hash($pass, PASSWORD_DEFAULT);
	$number=$_POST['number'];
	$divission=$_POST['divission'];
	$district=$_POST['district'];
	$thana=$_POST['thana'];
	$specialty=$_POST['specialty'];
	$degree=$_POST['degree'];
	$description=$_POST['description'];
	updatedoctor();
	echo "<script> alert('Successfully Updated');window.location='../views/Login.php' </script>";
}

//Update
//update into database query
function updatedoctor()
{
	global $uid;
	global $uname;
	global $pass;
	global $number;
	global $divission;
	global $district;
	global $thana;
	global $specialty;
	global $degree;
	global $description;

	//update into patients table
	$dquery="UPDATE `doctors` SET `username`='$uname',`phonenumber`='$number',`divission`='$divission',`district`='$district',`thana`='$thana',`specialty`='$specialty',`degree`='$degree',`description`='$description' WHERE `userid`='$uid'";
	//update into users table
	$uquery="UPDATE users SET password='$pass' WHERE userid='$uid'";

	execute($dquery); 
	execute($uquery); 
}
//update ends
function divission()
{
	$query="SELECT * from divission";
	$results=getdata($query);
	return $results;
}
//data from clinic table
function clinics()
{
	$query="SELECT * from clinics";
	$results=getdata($query);
	return $results;
}
//insert into doctorsetschedule///
$err_mgss="";
$time="";
$date="";
$cid="";
$has=false;
if(isset($_POST['slot1']))
{
	if (empty($_POST['cname'])) {
		$err_mgss="Fill clinic";
		$has=true;
	}
	else
	{
		$cname=$_POST['cname'];
	}
	if (empty($_POST['time'])) {
		$err_mgss="Fill time";
		$has=true;
	}
	else
	{
		$time=$_POST['time'];
	}
	if (empty($_POST['date'])) {
		$err_mgss="Fill date";
		$has=true;
	}
	else
	{
		$date=$_POST['date'];
	}

	if(!$has)
	{
		$did=$_POST['uid'];
		$name=doc($did);
		foreach ($name as $value) {
			$dname=$value['username'];
		}

		$clinics=slot1($cname);
		foreach ($clinics as $value) {
			$cid=$value['cid'];
			$divission=$value['divission'];
			$district=$value['district'];
			$thana=$value['thana'];
		}
		$query="INSERT INTO `doctorsetschedule` VALUES (NULL,'$did','$dname','$cid','$cname','$time','$date','$divission','$district','$thana')";
		execute($query);
		}
	
	}
//insert into doctorsetschedule///
///clinic data from slot1//
function slot1($cname)
{
	global $cname;
	$query="SELECT * FROM `slot1` WHERE cname='$cname'";
	$results=getdata($query);
	return $results;
}
///clinic data from slot1 ends//
function doc($did)
{
	$query="SELECT username FROM doctors WHERE userid='$did'";
	$results=getdata($query);
	return $results;
}
function schedule($did)
{
	$query="SELECT * FROM doctorsetschedule WHERE did='$did'";
	$results=getdata($query);
	return $results;
}
if (isset($_GET['schedule'])) 
{
	$id=$_GET['schedule'];
	$query="DELETE FROM `doctorsetschedule` WHERE id='$id'";
	execute($query);
	header('location:../views/DoctorSetSchedule.php');
}
function patientschedule($did)
{
	$query="SELECT * FROM patientrequest WHERE did='$did'";
	$results=getdata($query);
	return $results;
}
function patientsetschedule($prid)
{
	$query="SELECT * FROM patientrequest WHERE id='$prid'";
	$results=getdata($query);
	return $results;
}
///doctor accept request////
if (isset($_GET['prid'])) {
	$prid=$_GET['prid'];
	$watings=patientsetschedule($prid);
	foreach ($watings as $value) {
		
		$pid=$value['pid'];
		$pname=$value['pname'];
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
	$query="INSERT INTO `patientwaiting` VALUES (NULL,'$pid','$pname','$did','$dname','$cid','$cname','$time','$date','$divission','$district','$thana')";
	execute($query);
	deleterequest($prid);
	header('location:../views/DoctorPatientWaiting.php');
	$notification="INSERT INTO `notification` VALUES (NULL,'$pid','$did','$dname','$cname','$time','$date','You are appointed')";
	execute($notification);
}
///doctor accept request ends////

function deleterequest($prid)
{
	$query="DELETE FROM `patientrequest` WHERE id='$prid'";
	execute($query);
}

//patient request reject//
if (isset($_GET['delid'])) {
	$delid=$_GET['delid'];
	$reject=patientsetschedule($delid);
	foreach ($reject as $value) 
	{
	$pid=$value['pid'];
	$pname=$value['pname'];
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
	deleterequest($delid);
	header('location:../views/DoctorPatientRequest.php');
	$notification="INSERT INTO `notification` VALUES (NULL,'$pid','$did','$dname','$cname','$time','$date','You are Rejected')";
	execute($notification);
}
//patient request reject ends//

function patientlist($did)
{
	$query="SELECT * FROM `patientwaiting` WHERE did='$did'";
	$results=getdata($query);
	return $results;
}
if (isset($_GET['wpid'])) {
	$wpid=$_GET['wpid'];
	deletewating($wpid);
	header('location:../views/DoctorPatientWaiting.php');

}
function deletewating($wpid)
{
	$query="DELETE FROM `patientwaiting` WHERE id='$wpid'";
	execute($query);
}
function testclinics()
{
	$test="SELECT * FROM testclinic";
	$results=getdata($test);
	return $results;
}
function diseases()
{
	$diseases="SELECT * FROM diseases";
	$results=getdata($diseases);
	return $results;
}
///prescrive insert here///
if (isset($_POST['prescrive'])) {
	$did=$_POST['did'];
	$pid=$_POST['pid'];
	$pname=$_POST['pname'];
	$pno=$_POST['pno'];
	///data from patientwaiting table//
	$wait=waitingpatient($pno);
	foreach ($wait as $value) {
		$dname=$value['dname'];
		$cid=$value['cid'];
		$cname=$value['cname'];
		$time=$value['time'];
		$date=$value['date'];
	}
	///data from patientwaiting table//
	$symtom=$_POST['symtom'];
	$diseases=$_POST['diseases'];
	$test=$_POST['test'];
	$tcname=$_POST['tcname'];
	$report=$_POST['report'];
	$medicines=$_POST['medicines'];
	$records="INSERT INTO `patientrecords` VALUES (NULL,'$did','$dname','$pid','$pname','$cid','$cname','$time','$date','$symtom','$diseases','$test','$tcname','$report','$medicines')";
	execute($records);
	deletewating($pno);
	header('location:../views/DoctorPatientRecords.php');
}
function waitingpatient($pno)
{
	$no="SELECT * FROM `patientwaiting` WHERE id='$pno'";
	$results=getdata($no);
	return $results;
}
///prescrive insert edns///
//data retrieve from patient records table starts///
function patientrecords($did)
{
	$records="SELECT * FROM `patientrecords` WHERE did='$did'";
	$results=getdata($records);
	return $results;
}
//data retrieve from patient records table ends///
///update into patientrecords table starts//
if (isset($_POST['edit'])) 
{
	$pno=$_POST['pno'];
	$symptom=$_POST['symtom'];
	$diseases=$_POST['diseases'];
	$test=$_POST['test'];
	$tcname=$_POST['tcname'];
	$report=$_POST['report'];
	$medicines=$_POST['medicines'];
	$update="UPDATE `patientrecords` SET `symptom`='$symptom',`diseases`='$diseases',`test`='$test',`testclinic`='$tcname',`report`='$report',`medicines`='$medicines' WHERE id='$pno'";
	execute($update);
	header('location:../views/DoctorPatientRecords.php');
}
///update into patientrecords table ends//
?>
<?php


function insertclinic()
{
	global $cid;
	global $cname;
	global $pass;
	global $number;
	global $divission;
	global $district;
	global $thana;
	$status=4;

	//insert into clinics table
	$cquery="INSERT INTO clinics VALUES (NULL,'$cid','$cname','$number','$divission','$district','$thana')";
	//insert into users table
	$uquery="INSERT INTO users VALUES (NULL,'$cid','$pass','$status')";

	execute($cquery); 
	execute($uquery); 
}
//data retrieve fron clinics table starts
function clinicsdata()
{
	$cquery="SELECT * FROM clinics";
	$cresults=getdata($cquery);
	return $cresults;
}
//data retrieve fron clinics table ends

//delete patient starts
if(isset($_GET['cid']))
{
	$cid=$_GET['cid'];

	deleteclinic($cid);
	header("location:../views/AdminClinicList.php");
}
function deleteclinic($cid)
{
	$cdelete="DELETE FROM `clinics` WHERE cid='$cid'";
	$udelete="DELETE FROM `users` WHERE userid='$cid'";
	execute($cdelete);
	execute($udelete);
}
//delete patient ends

//data retrieve from tempdoctor table starts
function tempdoctorsdata()
{
	$tdquery="SELECT * FROM tempdoctorrequests";
	$tdresults=getdata($tdquery);
	return $tdresults;
}
//data retrieve fron tempdoctor table ends

//data retrieve from doctor table starts
function doctorsdata()
{
	$dquery="SELECT * FROM doctors";
	$dresults=getdata($dquery);
	return $dresults;
}
//data retrieve fron doctor table ends

//data retrieve from patients table starts
function patientsdata()
{
	$pquery="SELECT * FROM patients";
	$presults=getdata($pquery);
	return $presults;
}
//data retrieve fron patients table ends

//delete tempdoctors starts
if(isset($_GET['tdeleteid']))
{
	$deleteid=$_GET['tdeleteid'];
	deletetempdoctor($deleteid);
	header("location:../views/AdminDoctorRequest.php");
}
function deletetempdoctor($deleteid)
{
	$tddelete="DELETE FROM `tempdoctorrequests` WHERE userid='$deleteid'";
	$tudelete="DELETE FROM `tempusers` WHERE userid='$deleteid'";
	execute($tddelete);
	execute($tudelete);
}
//delete tempdoctors ends

//delete patients starts
if(isset($_GET['pdeleteid']))
{
	$pdeleteid=$_GET['pdeleteid'];
	deletepatient($pdeleteid);
	header("location:../views/AdminPatientList.php");
}
function deletepatient($id)
{
	$pddelete="DELETE FROM `patients` WHERE userid='$id'";
	$udelete="DELETE FROM `users` WHERE userid='$id'";
	execute($pddelete);
	execute($udelete);
}
//delete patients ends

//delete doctors starts
if(isset($_GET['ddeleteid']))
{
	$ddeleteid=$_GET['ddeleteid'];
	deletedoctor($ddeleteid);
	header("location:../views/AdminDoctorList.php");
}
function deletedoctor($id)
{
	$ddelete="DELETE FROM `doctors` WHERE userid='$id'";
	$udelete="DELETE FROM `users` WHERE userid='$id'";
	execute($ddelete);
	execute($udelete);
}
//delete doctors ends

//accept tempdoctors starts
if(isset($_GET['acceptid']))
{
	$acceptid=$_GET['acceptid'];
	accepttempdoctor($acceptid);
	deletetempdoctor($acceptid);
	header("location:../views/AdminDoctorList.php");
}

function accepttempdoctor($id)
{
	$dresutls=retrievetempdoctor($id);
	$uresults=retrievetempusers($id);
	foreach ($dresutls as $dresutl) {
		$userid=$dresutl['userid'];
		$username=$dresutl['username'];
		$gender=$dresutl['gender'];
		$email=$dresutl['email'];
		$phonenumber=$dresutl['phonenumber'];
		$dob=$dresutl['dob'];
		$divission=$dresutl['divission'];
		$district=$dresutl['district'];
		$thana=$dresutl['thana'];
		$specialty=$dresutl['specialty'];
		$degree=$dresutl['degree'];
		$bmdcregno=$dresutl['bmdcregno'];
		$description=$dresutl['description'];
	}
	foreach ($uresults as $uresult) {
		$userid=$uresult['userid'];
		$password=$uresult['password'];
		$status=$uresult['status'];
	}
	//insert into doctors table
	$dquery="INSERT INTO doctors VALUES (NULL,'$userid','$username','$gender','$email','$phonenumber','$dob','$divission','$district','$thana','$specialty','$degree','$bmdcregno','$description')";
	//insert into users table
	$uquery="INSERT INTO users VALUES (NULL,'$userid','$password','$status')";

	execute($dquery); 
	execute($uquery); 

}

function retrievetempdoctor($id)
{
	$tdaccept="SELECT * FROM `tempdoctorrequests` WHERE userid='$id'";
	$tempdoc=getdata($tdaccept);
	return $tempdoc;
}
function retrievetempusers($id)
{
	$tuaccept="SELECT * FROM `tempusers` WHERE userid='$id'";
	$tempusers=getdata($tuaccept);
	return $tempusers;
}
//accept tempdoctors ends
function divission()
{
	$query="SELECT * from divission";
	$results=getdata($query);
	return $results;
}
//data retrieve from patient records table starts///
function patientrecords()
{
	$records="SELECT * FROM `patientrecords`";
	$results=getdata($records);
	return $results;
}
//data retrieve from patient records table ends///
?>

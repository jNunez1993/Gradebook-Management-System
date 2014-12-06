<?php
	include('connection.php');
	session_start();
	function connect(){
	$conn=oci_connect("jnunez","Gato8115851","oracle.cise.ufl.edu:1521/orcl");
	return $conn;
	}

	function check_professor($username,$password){
	$flag=False;
	$conn= connect();
	$query= "SELECT CASE WHEN MAX(GATORLINK) IS NULL THEN 'NO' ELSE 'YES' END CORRECT_USER  FROM professor WHERE GATORLINK = '$username' and PASSWORD='$password'";
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
	oci_fetch($stid);
	if(oci_result($stid,'CORRECT_USER')=='YES'){
		$query="select distinct course_name from professor,course where professor.UFID=course.professor_ID and professor.gatorLink='$username'";
		$stid=oci_parse($conn,$query);
		$r=oci_execute($stid);
		$flag=True;
		}
	oci_close($conn);
	return $flag;
	}
	
	function check_student($username,$password){
	$flag=False;
	$conn= connect();
	$query= "SELECT CASE WHEN MAX(GATORLINK) IS NULL THEN 'NO' ELSE 'YES' END CORRECT_USER  FROM student WHERE GATORLINK = '$username' and PASSWORD='$password'";
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
	oci_fetch($stid);
	if(oci_result($stid,'CORRECT_USER')=='YES'){
		$query="select course_name from student,course where student.UFID=course.student_ID and student.gatorLink='$username'";
		$stid=oci_parse($conn,$query);
		$r=oci_execute($stid);
		$flag=True;
		}
	oci_close($conn);
	return $flag;
	}
	function final_Grade($exam, $assignment)
	{
		$exam = $exam * 0.8;
		$assignment = $assignment * 0.2;
	    return $exam + $assignment;
	}
?>
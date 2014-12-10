<?php 
	include('functions.php');

if(isset($_POST['submit'])) {	
	$conn = connect();
	$course = $_SESSION["Course"];

	$profID = $_SESSION["UFID"];
	$assignmentType = $_POST['assignmentType'];
	$assignmentName = $_POST['assignmentName'];

	$studentUFID = "SELECT distinct student_id 
					FROM grade 
					WHERE grade.course_name = '$course'";

	$sUFID = oci_parse($conn, $studentUFID);
	oci_execute($sUFID);

	while (($row = oci_fetch_row($sUFID)) != false){
		$tempUFID = $row[0];
		$query = "	INSERT INTO grade
					VALUES('$tempUFID', '$profID' ,'$course', '$assignmentName', null, '$assignmentType')"; 

		$stid = oci_parse($conn, $query);
		$execute = oci_execute($stid);
		if (!$execute) {
			$e = oci_error($stid);
			echo htmlentities($e['message']);
		}	
	}

  
	header("Location:/Gradebook-Management-system/profCourse.php?course=" . $course);
}
?>
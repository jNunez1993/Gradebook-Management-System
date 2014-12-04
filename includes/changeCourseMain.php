<?php

include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	

	if ($_POST['type'] == "Grades") {
		$query = "SELECT distinct assignment_name, grade FROM grade,course WHERE grade.student_ID = '$ufid' AND grade.course_ID = '$course' ORDER BY assignment_name ASC "; 
	
//NEEDS TO BE GENERIC

		$stid = oci_parse($conn,$query);
		oci_execute($stid);

		echo '<table class = "table table-hover table-condensed">';
		$counter = 1;
		while (($row = oci_fetch_row($stid)) != false){
			echo 	'<tr>
						<td> ' . $row[0]  . '</td> 
						<td> ' . $row[1]  . '</td>				
					</tr>';
			$counter++;
		}
		echo '</table>';

	} else if ($_POST['type'] == "Assignments") {
		$query = "SELECT distinct assignment_name FROM grade,course WHERE grade.student_ID = '$ufid' AND grade.course_ID = '$course' ORDER BY assignment_name ASC "; 
		
		$stid = oci_parse($conn,$query);
		oci_execute($stid);

		echo '<table class = "table table-hover table-condensed">';
		$counter = 1;
		while (($row = oci_fetch_row($stid)) != false){
			echo 	'<tr>
						<td> ' . $row[0]  . '</td> 
						<td> 
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewAssignment">
							  Launch demo modal
							</button>
						</td>
					</tr>';
			$counter++;
		}
		echo '</table>';
	}else{
		echo("Action works! " . $_POST['type']);
	}
	if ($_POST['type'] == "Resources") {

	}
	if ($_POST['type'] == "Test") {


	}

}
?>
<?php

include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	

	if ($_POST['type'] == "Grades") {
		$query = "SELECT distinct assignment_name, grade 
		FROM grade,course 
		WHERE grade.student_ID = '$ufid' 
		AND grade.course_name = '$course' 
		ORDER BY assignment_name ASC "; 
	
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

	}else{
		echo("Action works! " . $_POST['type']);
	}


}
?>
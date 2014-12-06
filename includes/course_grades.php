<?php
include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	$query = "SELECT ASSIGNMENT_GRADE FROM course WHERE course.student_ID = '$ufid' AND course.course_name = '$course' "; 
	$query2 = "SELECT AVG(ASSIGNMENT_GRADE) FROM course WHERE course.student_ID = '$ufid' AND course.course_name = '$course' "; 
	$stid = oci_parse($conn,$query);
	$stid2 = oci_parse($conn,$query);
	oci_execute($stid);
	oci_execute($stid2);

	echo '<table class = "table table-hover table-condensed">';
	$counter = 1;
	while (($row = oci_fetch_row($stid2)) != false){
		echo 	'<tr>
					<td> Assignment ' . $counter . '</td>
					<td> ' . $row[0] . '</td> 
					<td> ' . $row[0] . '</td>
					<td> ' . $row[0] . '</td>

				</tr>';
		$counter++;
	}
	echo '</table>';

}


?>
<?php
include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	$query = "SELECT ASSIGNMENT_GRADE FROM course WHERE course.student_ID = '$ufid'"; 
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo '<table class = "table table-hover table-condensed">';
	$counter = 1;
	while (($row = oci_fetch_row($stid)) != false){
		echo 	'<tr>
					<td> Assignment ' . $counter . '</td>
					<td> ' . $row[0] . '</td> 
					
				</tr>';
		$counter++;
	}
	echo '</table>';
}


?>
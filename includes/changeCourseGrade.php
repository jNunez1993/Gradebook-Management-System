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
		echo '	
					<th> Assignment Name </th>
					<th> Assignment Grade </th>
					<th> Class Average </th>
			';
		$counter = 1;
		while (($row = oci_fetch_row($stid)) != false) {
			echo 	'<tr>
						<td> ' . $row[0]  . '</td> 
						<td> ' . $row[1]  . '</td>';
			foreach ($row as $item) {
			$query_average = "	SELECT distinct TRUNC(AVG(grade),2) 
								AS average FROM grade 
								where grade.course_name = '$course' 
								AND grade.assignment_name = '$item' ";
			$avgID = oci_parse($conn,$query_average);
			oci_execute($avgID);
			$average = oci_fetch_row($avgID);
			echo '<td>'. $average[0] . '</td>';
			$counter++;
			}
			echo '</tr>';
	}
		echo '</table>';

	}
}
?>
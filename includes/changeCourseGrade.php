<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	

	$query = 
			"SELECT distinct assignment_name,grade
			FROM grade WHERE grade.student_ID = '$ufid' 
			AND grade.course_name = 'ABE2062'";

	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' <table class = "table table-hover table-condensed">';
	echo '	<tr>
				<th>Assignment </th>
				<th>Your Grade </th>
				<th>Class Average </th> 
			</tr>
			';

	while (true == ($row = oci_fetch_row($stid))) {
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '<td>' . $row[1]. '</td>';
		foreach(array_unique($row) as $item){
			$query_average = 	
								"SELECT distinct TRUNC(AVG(grade),1) 
								AS average FROM grade where grade.course_name = 'ABE2062' 
								AND grade.assignment_name = '$item' ";

			$avgID = oci_parse($conn,$query_average);
			oci_execute($avgID);
			$average = oci_fetch_row($avgID);
			echo '<td>' . $average[0] . '</td>';
			echo '</tr>';  
			//oci_result($avgID, 'average')
		}
	}
	echo '</table>';
?>
<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	
<<<<<<< HEAD:includes/changeCourseMain.php
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
=======

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
			';
		$counter = 1;
		while (($row = oci_fetch_row($stid)) != false){
			echo 	'<tr>
						<td> ' . $row[0]  . '</td> 
						<td> ' . $row[1]  . '</td>				
					</tr>';
			$counter++;
>>>>>>> FETCH_HEAD:includes/changeCourseGrade.php
		}
	}
	echo '</table>';
?>
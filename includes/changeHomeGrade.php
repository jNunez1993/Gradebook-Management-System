<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	
	$query = "SELECT distinct course_name FROM course WHERE course.student_ID = '$ufid'"; 
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' <table class = "table table-hover table-condensed">';
	echo '	<tr>
				<th>Course Name </th>
				<th>Average for Exam </th>
				<th>Average for Test </th> 
			</tr>
			';
	while (($row=oci_fetch_row($stid))!=false){
		foreach($row as $item){
<<<<<<< HEAD:includes/changeMainGrade.php
			$query_average = "SELECT AVG(grade) AS average FROM grade where grade.course_name = '$item' AND grade.assignment_type = 'Exam' ";
=======
			$query_average = "	SELECT AVG(grade) 
								AS average FROM grade 
								where grade.course_name = '$item' 
								AND grade.assignment_type = 'Exam' ";
>>>>>>> FETCH_HEAD:includes/changeHomeGrade.php
			$avgID = oci_parse($conn,$query_average);
			oci_execute($avgID);
			$average = oci_fetch_row($avgID);
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '<td>' . $row[1] . '</td>';
			echo '<td>' . $average[0] . '</td>';
			echo '</tr>';  
			//oci_result($avgID, 'average')
		}
	}
	echo '</table>';
?>
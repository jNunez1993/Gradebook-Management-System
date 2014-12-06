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
				<th>My Exam Average </th>
				<th>My Assignment Average </th> 
				<th>Final Grade </th>
			</tr>
			';
	while (($row=oci_fetch_row($stid))!=false){
		foreach($row as $item){
			$exam_average = "	SELECT AVG(grade) 
								AS average FROM grade 
								where grade.course_name = '$item' 
								AND grade.assignment_type = 'Exam' ";
			$exam = oci_parse($conn,$exam_average);
			oci_execute($exam);
			$avgExam = oci_fetch_row($exam);

			$assign_average = "	SELECT TRUNC(AVG(grade)) 
								AS average FROM grade 
								where grade.course_name = '$item' 
								AND grade.assignment_type = 'Assignment' ";
			$assignment = oci_parse($conn,$assign_average);
			oci_execute($assignment);
			$avgAssign = oci_fetch_row($assignment);
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '<td>' . $avgExam[0] . '</td>';
			echo '<td>' . $avgAssign[0] . '</td>';
			echo '<td>' . final_Grade($avgExam[0], $avgAssign[0]) . '</td>';
			echo '</tr>';  
			//oci_result($avgID, 'average')
		}
	}
	echo '</table>';
	echo '<h4>'
?>
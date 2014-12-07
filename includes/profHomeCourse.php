<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	
	$query = "SELECT DISTINCT course.course_name 
	FROM course, professor WHERE course.professor_ID = '$ufid' and course.professor_ID = professor.UFID"; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' 
	<h4 class="list-group-item-heading">Courses</h4>
	<table class = "table table-hover table-stripped">';
		echo '	<th> Course Name </th> 
				<th> View Main Page </th>';

	while (($row=oci_fetch_row($stid))!=false){
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '<td> 
			<a href = "profCourse.php?course='. $row[0] .' " class = "btn btn-primary" id = "' . $row[0] . '">
			View Course Main Page </a> </td>';
			echo '</tr>';  
	}
	echo '</table>';
?>
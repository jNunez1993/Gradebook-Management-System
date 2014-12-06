<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$query = "SELECT distinct course.course_name, professor.fname, professor.lname 
	FROM course, professor WHERE course.student_ID = '$ufid' and course.professor_ID = professor.UFID"; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' <table class = "table table-hover table-condensed">';
		echo '	<th> Course Name </th> 
				<th> Professor Name </th>';
	while (($row=oci_fetch_row($stid))!=false){
		foreach($row as $item){
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '<td>' . $row[1] . ',' . $row[2] . '</td>';

			echo '</tr>';  
		}
	}
	echo '</table>';
?>
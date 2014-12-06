<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$conn= connect();
	
	$query = "SELECT DISTINCT course.course_name, professor.fname, professor.lname 
	FROM course, professor WHERE course.professor_ID = '$ufid' and course.professor_ID = professor.UFID"; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' <table class = "table table-hover table-condensed">';
		echo '	<th> Course Name </th> 
				<th> Professor Name </th>';
	while (($row=oci_fetch_row($stid))!=false){
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '</tr>';  
	}
	echo '</table>';
?>
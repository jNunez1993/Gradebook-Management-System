<?php
include ('functions.php');
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$query = "SELECT distinct course_name 
	FROM course WHERE course.student_ID = '$ufid'"; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo ' <table class = "table table-hover table-condensed">';
	while (($row=oci_fetch_row($stid))!=false){
		foreach($row as $item){
			echo '<tr>';
			echo '<td>' . $row[0] . '</td>';
			echo '</tr>';  
		}
	}
	echo '</table>';
?>
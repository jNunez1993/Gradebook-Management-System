<?php

include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$query = 	"SELECT DISTINCT student.fname,student.lname 
				FROM course,student
				WHERE  course.course_name = '$course' 
				AND course.student_ID = student.UFID"; 

//NEEDS TO BE GENERIC
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo '<table class = "table table-hover table-condensed">';
	
	while (($row = oci_fetch_row($stid)) != false){
		echo 	'<tr>
					<td> ' . $row[0] . ',' .$row[1]  . '</td> 
				</tr>';
	}
	echo '</table>';

}
?>
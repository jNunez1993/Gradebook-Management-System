<?php
include ('functions.php');
$course = $_SESSION['Course'];
$ufid = $_POST['UFID'];
$query = "	SELECT DISTINCT student.fname,student.lname, student.UFID 
			FROM course,student
			WHERE  course.course_name = '$course'
			AND student.UFID = '$ufid' 
			AND course.student_ID = student.UFID 
			";
$stid = oci_parse($conn,$query);
oci_execute($stid);
$row = oci_fetch_row($stid);
if (empty($row[0])) {
	echo '<div class="alert alert-warning" role="alert">No students exist with that UFID in your class</div>';
}else{
	//echo 'Hello There ' . $row[0] . $row[1] . $row[2];
	echo '<table class = "table table-hover table-condensed">';
	echo '	<tr>
				<th> Last Name </th>
				<th> First Name </th>	
				<th> UFID </th>
			</tr>';
	echo 	'<tr>
				<td> ' . $row[1]  . '</td> 
				<td> ' . $row[0]  . '</td> 
				<td> ' . $row[2] . '</td>
			</tr>';
	echo '</table>';
}
?>
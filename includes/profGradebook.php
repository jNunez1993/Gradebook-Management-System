<?php
include ('functions.php');
//to view all students in the class.
	$conn= connect();
	$username = $_SESSION["username"];
	if ($_POST['type'] == "Grades") {
		$course = $_SESSION["Course"];
	}else {
		$course = $_POST['type'];
	}
	$query = "	SELECT student.UFID, student.lname, student.fname 
				FROM student,course,professor  
				WHERE student.UFID = course.student_ID
				AND professor.gatorlink='$username' 
				AND course.course_name='$course' ORDER BY student.lname ASC";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$query1= "SELECT distinct assignment_name 
			FROM  (select assignment_name  from grade 
			where grade.course_name = '$course') 
			ORDER BY assignment_name asc";
	$stid1=oci_parse($conn,$query1);
	oci_execute($stid1); 
	
	echo '<table class= "table table-striped table-bordered table-hover dataTable"
		id="datatable">';
	echo "<thead>";
	echo	"<tr>";
	echo	'<th colspan="1" rowspan="1" style="width: 180px;" tabindex="0">
		Student_ID</th>';
	echo	'<th colspan="1" rowspan="1" style="width: 220px;" tabindex="0">
			Last Name</th>';
	echo	'<th colspan="1" rowspan="1" style="width: 288px;" tabindex="0">First Name</th>';
	$i=0;
	while (($row=oci_fetch_row($stid1))!=false){
		foreach($row as $item){
		echo  '<th>' . $item . '</th>';
		}
	}
	echo	'</tr>';
	echo	'</thead>';
	echo	'<tbody>';

	while (($row=oci_fetch_row($stid))!=false){
		echo "<tr>\n";
		echo '<td>' . $row[0] . '</td>';
		echo '<td>' . $row[1] . '</td>';
		echo '<td>' . $row[2] . '</td>';
		$id=$row[0];
		$query2="select student.lname,grade from grade,student where course_name='$course' and student.UFID=grade.student_ID and student.UFID='$id' order by student.lname,assignment_name";
		$stid2=oci_parse($conn,$query2);
		oci_execute($stid2);
		
		while(($row1=oci_fetch_row($stid2))!=false){
			echo '<td>' . $row1[1] . '</td>';
			}
		}
	echo "	</tbody>";
	echo "	</table>";
	echo "</tr>\n";
	echo "</table>\n";
	
?>

<?php
include ('includes/functions.php');
//to view all students in the class. 
	$conn= connect();
	$username = $_SESSION["username"];
	$course = $_SESSION["Course"];
	$query = "	SELECT student.UFID, student.lname, student.fname 
				FROM student,course,professor  
				WHERE student.UFID = course.student_ID
				AND professor.gatorlink='$username' 
				AND course.course_name='$course' ORDER BY student.lname ASC";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$query1= "SELECT distinct assignment_name 
			FROM  (select assignment_name  from grade 
			where grade.student_ID = '75391612' AND grade.course_name = '$course') 
			ORDER BY assignment_name asc";
	$stid1=oci_parse($conn,$query1);
	oci_execute($stid1); 
	echo "<table border='4' cellspacing='35'>\n";
	echo "<tr>";
	echo "<th> Student_ID </th>";
	echo "<th> last Name </th>";
	echo "<th> First Name </th>";
	while (($row=oci_fetch_row($stid1))!=false){
		foreach($row as $item){
		echo  '<th>' . $item . '</th>';
		}
	}

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
	echo "</tr>\n";
	echo "</table>\n";
	
?>

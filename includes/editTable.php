<?php 
//to view all students in the class.
	$conn= connect();
	$username = $_SESSION["username"];
	$course = $_SESSION["Course"];
	$query ="SELECT * from (
				select a.*, ROWNUM minNum from (
  				SELECT student.UFID, student.lname, student.fname 
				FROM student,course,professor  
				WHERE student.UFID = course.student_ID
				AND professor.gatorlink='$username' 
				AND course.course_name='$course' ORDER BY student.lname ASC
				) a where rownum <= 5 
		 	)where minNum >= 0";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$query1= "SELECT distinct assignment_name 
			FROM  (select assignment_name  from grade 
			where grade.student_ID = '75391612' AND grade.course_name = '$course') 
			ORDER BY assignment_name asc";
	$stid1=oci_parse($conn,$query1);
	oci_execute($stid1); 
	
	echo '<table class= "table table-striped table-bordered table-hover" id = "editTable">';
	echo "<thead>";
	echo	"<tr>";
	echo	'<th colspan="1" rowspan="1" style="width: 180px;" tabindex="0">Student_ID</th>';
	echo	'<th colspan="1" rowspan="1" style="width: 220px;" tabindex="0">Last Name</th>';
	echo	'<th colspan="1" rowspan="1" style="width: 288px;" tabindex="0">First Name</th>';
	while (($row=oci_fetch_row($stid1))!=false){
		foreach($row as $item){
		echo  '<th>' . $item . '</th>';
		}
	}
	echo	'</tr>';
	echo	'</thead>';
	echo	'<tbody>';

	while (($row=oci_fetch_row($stid))!=false){
		echo "<tr id = " . $row[0] .">\n";
		echo '<td class = "studentID">' . $row[0] . '</td>';
		echo '<td class = "lastName">' . $row[1] . '</td>';
		echo '<td class = "firstName">' . $row[2] . '</td>';
		$id=$row[0];
		$query2="	SELECT student.lname, grade, grade.assignment_name 
					FROM grade,student 
					WHERE course_name='$course' AND student.UFID=grade.student_ID 
					AND student.UFID='$id' order by student.lname , assignment_name";
		$stid2=oci_parse($conn,$query2);
		oci_execute($stid2);
		
		while(($row1=oci_fetch_row($stid2))!=false){
			echo '<td class = "'. $row1[2].'"">' . $row1[1] . '</td>';
		}
		echo "</tr>\n";
	}
	echo "	</tbody>";
	echo "</table>\n";
    						?>
			    	
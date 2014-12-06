

<?php
include ('includes/functions.php');
//to view all students in the class. 
	$conn= connect();
	$username = $_SESSION["username"];
	$course = $_SESSION["Course"];
	$count=0;  //added this
	$query = "SELECT student.UFID, student.lname, student.fname FROM student,course,professor  WHERE student.UFID = course.student_ID AND professor.gatorlink='$username' and course.course_name='$course' ORDER BY student.lname ASC";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$query1= "SELECT distinct assignment_name FROM  (select assignment_name  from grade where grade.student_ID = '75391612' AND grade.course_name = '$course') ORDER BY assignment_name asc";
	$stid1=oci_parse($conn,$query1);
	oci_execute($stid1); //need to change line under this one. Replace grade.studentufid by someone in that person's class.
	echo "<table border='4' cellspacing='35'>\n";
	echo "<tr>";
	echo "<th> Student_ID </th>";
	echo "<th> last Name </th>";
	echo "<th> First Name </th>";
	while (($row=oci_fetch_row($stid1))!=false){
		foreach($row as $item){
		echo  '<th>' . $item . '</th>';
		$query2= "SELECT grade FROM student,course,professor, (select * from grade where grade.course_name = 'ABE2062') WHERE student.UFID = course.student_ID AND professor.gatorlink='$username' and course.course_name='$course' and assignment_name='$item' order by student.lname asc";
		$stid2=oci_parse($conn,$query2);
		oci_execute($stid2);
		}
		}
		
		while (($row=oci_fetch_row($stid))!=false){
			echo "<tr>\n";
			$student=$row[1];
			$query3 = "select student.lname,grade  from grade,student where course_name='$course' and student.UFID=grade.student_ID order by student.lname,assignment_name";
			$stid3 = oci_parse($conn, $query3);
			oci_execute($stid);
			$row1=oci_fetch_row($stid3);
				foreach($row as $item){
					echo  '<td>' . $item . '</td>';
				}
				foreach($row1 as $item1){
				echo '<td>' . $item1 . '</td>';
				}
		}
		echo "</tr>\n";
		echo "</table>\n";
	
?>
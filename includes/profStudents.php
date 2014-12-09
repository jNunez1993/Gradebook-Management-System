<?php

include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	$last = "SELECT count(*) FROM grade WHERE grade.course_name = '$course' GROUP BY '$course'";

	$checkLast = oci_parse($conn,$last);
	oci_execute($checkLast);
	$totalAmount = oci_fetch_row($checkLast);



	$query = "SELECT * from (
				select a.*, ROWNUM minNum from (
	  				SELECT DISTINCT student.fname,student.lname, student.UFID 
						FROM course,student
						WHERE  course.course_name = '$course' 
						AND course.student_ID = student.UFID
						ORDER BY student.lname ASC
					) a where rownum <= 15 
			 	)where minNum >= 0";

//NEEDS TO BE GENERIC
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	echo '<table class = "table table-hover table-condensed">';
	echo '	<tr>
				<th> Last Name </th>
				<th> First Name </th>	
				<th> UFID </th>
			</tr>
	';
	$totalRows = 0;
	while (($row = oci_fetch_row($stid)) != false){
		echo 	'<tr>
					<td> ' . $row[1]  . '</td> 
					<td> ' . $row[0]  . '</td> 
					<td> ' . $row[2] . '</td>
				</tr>';
		$totalRows++;

	}
	echo '</table>';
	echo '<ul class="pager">
		    <li><a href="#">Previous</a></li>
		    <li><a href="#">Next</a></li>
		  </ul>';
	echo '<h3> Total number of people : ' . $totalRows . '</h3>';
}
?>
<?php
include ('functions.php');

echo '
	<div class ="list-group">
		<h4 class="list-group-item-heading">Announcements</h4>
		<div id = "Announcements">
			<table class="table table-hover table-striped">
				<tr> <th> Date and Time </th> <th> Course </th> <th> Message </th></tr>';
					$query = "SELECT distinct time, course, message FROM ANNOUNCEMENTS 
								INNER JOIN Course
								ON Course.course_name = announcements.course
								INNER JOIN Student
								ON student.ufid = course.student_id
								ORDER BY time DESC";
		    					$conn=connect();
		    					$stid = oci_parse($conn,$query);
								oci_execute($stid);
								while(($row = oci_fetch_array($stid)) != false) {
									echo '<tr> ';
									echo '<td> ' . $row[0] . '</td>';
									echo '<td> ' . $row[1] . '</td>';
									echo '<td> ' . $row[2] . '</td>';
									echo '</tr>';
								}
echo		'</table>
		</div> 
	</div>';

?>
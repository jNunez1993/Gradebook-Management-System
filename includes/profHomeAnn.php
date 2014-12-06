<?php
include ('functions.php');
$ufid = $_SESSION["UFID"];
echo '
	<div class = "row" id = "add_announce">
		<a type="button" style = "float : right;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addAnnounce"> Add Announcement</a>
	</div>

	<div class ="list-group row">
		<h4 class="list-group-item-heading">Announcements</h4>
		<div id = "Announcements">
			<table class="table table-hover table-striped">
				<tr> <th> Date and Time </th> <th> Course </th> <th> Message </th></tr>';
					$query = "SELECT distinct time, course, message FROM ANNOUNCEMENTS, Course
								WHERE Announcements.course = course.course_name
								AND course.professor_id = '$ufid'
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
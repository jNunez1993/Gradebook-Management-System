<?php
include ('functions.php');
$ufid = $_SESSION["UFID"];
echo '
	<div class ="list-group">
		<h4 class="list-group-item-heading">Grades</h4>
		<div id = "main_gradebook">
			<table class="table table-hover table-striped">
				<tr> <th> Course </th> </tr>';
					$query = "SELECT distinct course_name FROM Course
								WHERE course.professor_id = '$ufid'";
					$conn=connect();
					$stid = oci_parse($conn,$query);
					oci_execute($stid);
					while(($row = oci_fetch_array($stid)) != false) {
						echo '<tr> ';
						echo '<td> ' . $row[0] . '</td>';
						echo '<td> View Gradebook </td>';
						echo '</tr>';
					}
echo		'</table>
		</div> 
	</div>';


?>
<?php
include ('functions.php');

echo '
	<div class ="list-group">
		<h4 class="list-group-item-heading">Announcements</h4>
		<div id = "Announcements">
			<table class="table table-hover table-striped"> ';
					$query = "SELECT time,message,course FROM ANNOUNCEMENTS ORDER BY id DESC";
					//$query = " SELECT * FROM ANNOUNCEMENTS";
					$conn=connect();
					$stid = oci_parse($conn,$query);
					oci_execute($stid);
					while(($row = oci_fetch_array($stid)) != false) { 
						echo '<tr>';
						echo '<td> ' . $row[0] . '</td>';
						echo '<td> ' . $row[1] . '</td>';
						echo '<td> ' . $row[2] . '</td>';
						echo '</tr>';
					}
echo		'</table>
		</div> 
	</div>';

?>
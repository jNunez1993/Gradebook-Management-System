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

echo '    <!--MODAL -->
	<div class="modal fade" id="addAnnounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <form role="form" action="includes/addAnnounce.php" method="post">
	      	<div class="modal-body">
				  <div class="form-group">
				    <label for="announceTitle">Class</label>
				    <input type = "text" class="form-control" name="announceTitle" placeholder="Title">
				  </div>
				  <div class="form-group">
				    <label for="announceMessage">Message</label>
				    <input class="form-control" name="announceMessage" placeholder="Message">
				  </div>
	     	 </div>
	      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	<input class="btn btn-success" type="submit" name="submit" value="Add Announcement"/>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- END OF MODAL -->';

?>
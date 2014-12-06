<?php
	include ('includes/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title> CIS 4301</title>
<!--Bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/my_functions.js"></script>

</head>
<body>
<?php
	$username = $_SESSION["username"];
	$conn=connect();
	if ($_SESSION["viewType"] == "professor") {
		$query="SELECT distinct course_name FROM professor,course WHERE professor.UFID=course.professor_ID AND professor.gatorLink='$username'";
	}
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
?> 
<?php include 'navbar.php' ?>

	<div class ="container-fluid">
    	<div class ="row">
       		<div class = "col-md-3">
	    		<ul class="nav nav-pills nav-stacked" id = "main_side_menu">
	  				<li role="presentation"><a href="#" id = "Home">Home</a></li>
	  				<li role="presentation"><a href="#" id = "Course">Courses</a></li>
	 	 			<li role="presentation"><a href="#" id = "Grade">Grades</a></li>
				</ul>
			</div>
			<div class = "col-md-7">
				<div id = "add_announce">
					<a type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addAnnounce"> Add Announcement</a>
				</div>
				<div id ="main_body">
					<div class ="list-group">
	    				<h4 class="list-group-item-heading">Announcements</h4>
						<div id = "Announcements">
		    				<table class="table table-striped">
		    					<tr> <th> Date and Time </th> <th> Course </th> <th> Message </th></tr>
		    				<?php 
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

		    				?>
		    				</table>

		    			</div>
		    		</div>
	    		</div>

    		</div>

		</div>
    </div>

	<!--MODAL -->
	<div class="modal fade" id="addAnnounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <form role="form">
	      	<div class="modal-body">
				  <div class="form-group">
				    <label for="announceTitle">Title of the Announcment</label>
				    <input type = "text" class="form-control" id="announceTitle" placeholder="Title">
				  </div>
				  <div class="form-group">
				    <label for="announceMessage">Message</label>
				    <input class="form-control" id="announceMessage" placeholder="Message">
				  </div>
	     	 </div>
	      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id = "add_announce" class="btn btn-primary">Add Announcement</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- END OF MODAL -->

</body>

</html>
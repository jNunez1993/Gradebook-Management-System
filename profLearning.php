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

	$query = "SELECT distinct UFID FROM professor WHERE professor.gatorLink = '$username'";
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
	$row=oci_fetch_row($stid);
	$_SESSION["UFID"] = $row[0];

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
	    		<ul class="nav nav-pills nav-stacked" id = "prof_main_side_menu">
	  				<li role="presentation"><a href="#" id = "Home">Home</a></li>
	  				<li role="presentation"><a href="#" id = "Course">Courses</a></li>
	 	 			<li role="presentation"><a href="#" id = "Grades">Grades</a></li>
				</ul>
			</div>
			<div class = "col-md-7">
				<div id ="main_body">
					<script type = "text/javascript"> 
					$( document ).ready(function() {
						$.ajax({ 
							url: 'includes/profHomeAnn.php',
							data: {type: 'Home'},
							type: 'post',
							success: function(output) {
								$('#main_body').html(output);
				            }
						}); 
					});
					</script>
	    		</div>
    		</div>

		</div>
    </div>
	<div class="modal fade" id="addAnnounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <form role="form" action="addAnnounce.php" method="post">
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
	<!-- END OF MODAL -->
</body>

</html>

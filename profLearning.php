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
<script src = "js/edit.js"></script>

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
   
		<div class ="row">
		    	
		</div>


    </div>

   
</body>

</html>

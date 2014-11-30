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

</head>

<body>
<?php include ('navbar.php') ?>

<?php
	$username = $_SESSION["username"];
	$course = $_GET['course'];
	$UFID = "SELECT student_id FROM student,course WHERE student.UFID = course.student_ID AND student.gatorLink = '$username'";

//echo	'Course is ' . $course . 'User is' . $username;
	// $ufid=oci_parse($conn,$UFID);
	// oci_execute($ufid);
?>

<!-- side menu -->
    <div class ="container-fluid">
    	<div class ="row">
       		<div class = "col-md-3">
	    		<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation" class="active"><a href="#">Home</a></li>
	 	 			<li role="presentation">
	 	 				<a href="#">
	 	 					<button > hello </button>
	 	 				</a>
	 	 			</li>
	 	 			<li role="presentation"><a href="#">Assignments</a></li>
	 	 			<li role="presentation"><a href="#">Resources</a></li>
	 	 			<li role="presentation"><a href="#">Chat</a></li>
	 	 			<li role="presentation"><a href="#">Test/Quizzes</a></li>
	 	 			<li role="presentation"><a href="#">Course Video</a></li>
	 	 			<li role="presentation"><a href="#">Help</a></li>

				</ul>
			</div>
			<div>

			</div>
    	</div>
    </div>


</body>
</html>
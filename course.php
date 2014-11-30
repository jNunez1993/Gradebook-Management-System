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
<?php include ('navbar.php') ?>

<?php
	$username = $_SESSION["username"];
	$course = $_GET['course'];
	$UFID = "SELECT student_id FROM student,course WHERE student.UFID = course.student_ID AND student.gatorLink = '$username'";
//USE FOR LATER

//echo	'Course is ' . $course . 'User is' . $username;
	// $ufid=oci_parse($conn,$UFID);
	// oci_execute($ufid);
?>

    <div class ="container-fluid">
    	<div class ="row">

<!-- side menu -->
       		<div class = "col-md-3">
	    		<ul id = "side_menu" class="nav nav-pills nav-stacked">
	  				<li role="presentation" class="active"><a href="#">Home</a></li>
	 	 			<li role="presentation">
	 	 				<a href="#" id = "Grades">
	 	 					Grades
	 	 				</a>
	 	 			</li>
	 	 			<li role="presentation"><a href="#" id = "Assignements">Assignments</a></li>
	 	 			<li role="presentation"><a href="#" id = "Resources">Resources</a></li>
	 	 			<li role="presentation"><a href="#" id = "Chat">Chat</a></li>
	 	 			<li role="presentation"><a href="#" id = "Test">Test/Quizzes</a></li>
	 	 			<li role="presentation"><a href="#" id = "Videos">Course Video</a></li>
	 	 			<li role="presentation"><a href="#" id = "Help">Help</a></li>

				</ul>
			</div>
<!--Main Body-->

			<div id = "main_section">
				<h1> Place Holder for <?php echo $course?> 
				</h1>
				<div id ="main_body">
					
				</div>
			</div>
    	</div>
    </div>


</body>
</html>
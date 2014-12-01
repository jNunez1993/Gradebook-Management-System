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
	$conn= connect();
	$query = "SELECT student_id FROM student,course WHERE student.UFID = course.student_ID AND student.gatorLink = '$username'";
	$stid = oci_parse($conn, $query);
	oci_execute($stid, OCI_DEFAULT);
	$row = oci_fetch_array($stid);
	$_SESSION["UFID"] = $row[0];
	$_SESSION["Course"] = $course;

?>

    <div class ="container-fluid">
    	<div class ="row">

<!-- side menu -->
       		<div class = "col-md-3">
	    		<ul id = "side_menu" class="nav nav-pills nav-stacked">
	  				<li role="presentation" class="active"><a href="gatorLearning.php">Home</a></li>
	 	 			<li role="presentation">
	 	 				<a href="#" id = "Grades">
	 	 					Gradebook
	 	 				</a>
	 	 			</li>
	 	 			<li role="presentation"><a href="#" id = "Assignments">Assignments</a></li>
	 	 			<li role="presentation"><a href="#" id = "Resources">Resources</a></li>
	 	 			<li role="presentation"><a href="#" id = "Chat">Chat</a></li>
	 	 			<li role="presentation"><a href="#" id = "Test">Test/Quizzes</a></li>
	 	 			<li role="presentation"><a href="#" id = "Videos">Course Video</a></li>
	 	 			<li role="presentation"><a href="#" id = "Help">Help</a></li>

				</ul>
			</div>
<!--Main Body-->

			<div class = "col-md-5" id = "main_section">
				<h1> Place Holder for <?php echo $course ?> 
				</h1>
				<div id ="main_body">
					
				</div>
			</div>
    	</div>
    </div>


</body>
</html>
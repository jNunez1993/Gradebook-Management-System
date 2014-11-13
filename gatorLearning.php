<?php
	include ('includes/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title> CIS 4301</title>
<!--Bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script src="js/bootstrap.min.js"></script>

</head>
<body>
<?php
	$username = $_SESSION["username"];
	$conn=connect();
	if ($_SESSION["viewType"] == "professor") {
		$query="SELECT distinct course_name FROM professor,course WHERE professor.UFID=course.professor_ID AND professor.gatorLink='$username'";
	}
	if ($_SESSION["viewType"] == "student") {
		$query="SELECT course_name FROM student,course WHERE student.UFID=course.student_ID AND student.gatorLink='$username'";
	}
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
?>
<?php 
include ('navbar.php');
?>

	<div class ="container-fluid">
		<div class = "row">
			<div class ="col-md-3">
				<div class = "list-group">
					<li href="#" class="list-group-item active"></li>
					<?php
						while (($row=oci_fetch_row($stid))!=false){
					        foreach($row as $item){
							echo  '<a class = "list-group-item" href= "http://localhost/class.php?class=" ' .$item . '>' . $item . '</a>';
							}
					    }
					?>
				</div>

			</div>
			<div class ="col-md-8 col-md-offset-1 well">
			</div>
		</div>
	</div>

</body>
</html>
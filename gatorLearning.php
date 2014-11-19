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

	<nav class="navbar navbar-default navbar-fixed" role="navigation">
	    <div class="container-fluid">
	    	<a class="navbar-brand" href="#">CIS 4301 PROJECT</a>
		    <ul class="nav navbar-nav">
			    <li class="active"><a href="#">Home</a></li>
			    <?php
						while (($row=oci_fetch_row($stid))!=false){
					        foreach($row as $item){
							echo  '<li><a class = "active" href= "http://localhost/class.php?class=" ' .$item . '>' . $item . '</a></li>';
							}
					    }
					?>
				<li><a href="logout.php" >Logout</a></li>
		    </ul>
	    </div>
    </nav>


</body>
</html>
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
<?php
	$username = $_SESSION["username"];
	$conn=connect();
	if ($_SESSION["viewType"] == "professor") {
		$query="SELECT distinct course_name FROM professor,course WHERE professor.UFID=course.professor_ID AND professor.gatorLink='$username'";
	}
	if ($_SESSION["viewType"] == "student") {
		$query="SELECT distinct course_name FROM student,course WHERE student.UFID=course.student_ID AND student.gatorLink='$username'";
	}
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
?>

	<nav class="navbar navbar-default navbar-fixed" role="navigation">
	    <div class="container-fluid">
	    	<a class="navbar-brand" href="#">CIS 4301 PROJECT</a>
		    <ul class="nav navbar-nav">
			    <li class="active"><a href="#">Home</a></li>
			    <!--previous link for courses href= "http://localhost/class.php?class=" -->
			    <?php
						while (($row=oci_fetch_row($stid))!=false){
					        foreach($row as $item){
							
							echo  
							'<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $item . 
								'<span class = "caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
						            <li><a href="course.php?course=' . $item . '">Home</a></li>
						            <li><a href="#">Another action</a></li>
						            <li><a href="#">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="#">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="#">One more separated link</a></li>
					          	</ul>
							</li>';
							}
					    }
				?>
				<li><a href="logout.php" >Logout</a></li>
		    </ul>
	    </div>
    </nav>
    
    <!--SIDE MENU-->
    <div class ="container-fluid">
    	<div class ="row">
       		<div class = "col-md-3">
	    		<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation" class="active"><a href="#">Home</a></li>
	  				<li role="presentation"><a href="#">Courses</a></li>
	 	 			<li role="presentation"><a href="#">Grades</a></li>
	 	 			<li role="presentation"><a href="#">Resources</a></li>
	 	 			<li role="presentation"><a href="#">Chat</a></li>
				</ul>
			</div>
			<div class = "col-md-7">
				<div class ="list-group">
    				<h4 class="list-group-item-heading">Announcements</h4>
					<div id = "annoucements">
	    				<table class="table">
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
								echo '<tr> ' . '</tr>';
								echo '<td> ' . $row[0] . '</td>';
								echo '<td> ' . $row[1] . '</td>';
								echo '<td> ' . $row[2] . '</td>';
							}

	    				?>
	    				</table>
	    			</div>
    			</div>
    		</div>

			</div>
    	</div>
    </div>


</body>
</html>
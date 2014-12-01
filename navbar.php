
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

<?php
	echo '
	<nav class="navbar navbar-default navbar-fixed" role="navigation">
	    <div class="container-fluid">
	    	<a class="navbar-brand" href="#">CIS 4301 PROJECT</a>
		    <ul class="nav navbar-nav">
			    <li class="active"><a href="#">Home</a></li>
			    <!--previous link for courses href= "http://localhost/class.php?class=" -->
			    ';
						while (($row=oci_fetch_row($stid))!=false){
					        foreach($row as $item){
							echo  
							'<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $item . 
								'<span class = "caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="course.php?course=' . $item . '">Home</a></li>						            <li><a href="#">Something different</a></li>
						            <li><a href="#">Something else here</a></li>
						            <li class="divider"></li>
						            <li><a href="#">Separated link</a></li>
						            <li class="divider"></li>
						            <li><a href="#">One more separated link</a></li>
					          	</ul>
							</li>';
							}
					    }
	echo '
				<li><a href="logout.php" >Logout</a></li>
		    </ul>
	    </div>
    </nav>
    ';

?>

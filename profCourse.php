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
<?php include ('navbar.php') ?>

<?php
	$username = $_SESSION["username"];
	$course = $_GET['course'];
	$conn= connect();
	$query = "SELECT UFID FROM professor WHERE professor.gatorLink = '$username'";
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
	    		<ul id = "prof_course_side_menu" class="nav nav-pills nav-stacked">
	  				<li role="presentation"><a href="#" id ="Home" course = "$courses">Home</a></li>
	 	 			<li role="presentation"><a href="#" id = "Grades">Gradebook </a>
	 	 			</li>
	 	 			<li role="presentation"><a href="#" id = "Assignments">Assignments</a></li>
	 	 			<li role="presentation"><a href="#" id = "Students">Students</a></li>


				</ul>
			</div>
<!--Main Body-->

			<div class = "col-md-6" id = "main_section">
				<h1> Place Holder for <?php echo $course ?> </h1>

					<form id = "searchFormStudents" class = "form-inline" role="form" action = "includes/search.php" method = "post"> 
						<input type="text" class="form-control" name = "UFID" placeholder="Search with UFID">
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<form id = "searchFormGrades" class = "form-inline" role="form" action = "includes/search.php" method = "post"> 
						<input type="text" class="form-control" name = "UFID" placeholder="Search with UFID">
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				<div id ="main_course_body">
					
					<h3> Edit Gradebook! </h3>
					<table id = "editTable" class ="table">
				    	<tbody>
				    		<?php include ('includes/editTable.php') ?>
				    	</tbody>
			   		</table>

				</div>
			</div>
    	</div>
    </div>


</body>
</html>
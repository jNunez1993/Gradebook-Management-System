<?php
	include ('includes/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>GatorLearning</title>
<!--Bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</head>

<body>
 <!-- LOGIN PANEL     -->
	<img src=https://rellergold.com/store/avactis-images/FLORIDA-GATORS-LOGO-psd12415_0.png />

	<div class="container">
		<div class="row">
			<div class="col-md-5 well">
			<form name = "form1" method="post" action="login.php">
				<input type="text" name="userName" placeholder="Username"/>
				<input type="password" name="password" placeholder="Password"/>
				<input type="submit" name="SubmitLogin" value ="Login" class="btn btn-primary"/>
			</form>
		</div>
		</div>
	</div>  
	
	<?php 
	$conn=connect();
	$query1= "SELECT COUNT(id) FROM announcements";
	$stid1=oci_parse($conn,$query1);
	oci_execute($stid1);
	$row1=oci_fetch_array($stid1);
	$number1 = $row1[0];
	$conn=connect();
	$query2= "SELECT COUNT(grade) FROM grade";
	$stid2=oci_parse($conn,$query2);
	oci_execute($stid2);
	$row2=oci_fetch_array($stid2);
	$number2 = $row2[0];
	$conn=connect();
	$query3= "SELECT COUNT(ufid) FROM professor";
	$stid3=oci_parse($conn,$query3);
	oci_execute($stid3);
	$row3=oci_fetch_array($stid3);
	$number3 = $row3[0];
	$conn=connect();
	$query4= "SELECT COUNT(ufid) FROM student";
	$stid4=oci_parse($conn,$query4);
	oci_execute($stid4);
	$row4=oci_fetch_array($stid4);
	$number4 = $row4[0];
	$conn=connect();
	$query5= "SELECT COUNT(course_id) FROM course";
	$stid5=oci_parse($conn,$query5);
	oci_execute($stid5);
	$row5=oci_fetch_array($stid5);
	$number5 = $row5[0];
	$number = $number1 + $number2 + $number3 + $number4 + $number5
	?>
	
	<form action="index.php" method="post">
	<button name="tuples" type="submit" >Amount of tuples</button>
	</form>
	
	<?PHP
	if (isset($_POST['tuples'])) {
	echo $number;
	
	}
	?>
<!-- end Login -->
</body>
</html>
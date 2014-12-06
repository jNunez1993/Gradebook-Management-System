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
	$query= "select sum(num_rows) from (select table_name, num_rows from user_tables)";
	$stid=oci_parse($conn,$query);
	oci_execute($stid);
	$row=oci_fetch_array($stid);
	$number = $row[0];
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
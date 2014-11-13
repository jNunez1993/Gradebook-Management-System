<?php
	include 'includes/functions.php';
	$username= $_POST["userName"];
	$password= $_POST["password"];
	$_SESSION["username"]="$username";
	$_SESSION["password"]="$password";
	$flag=False;
	$flag1=False;
	
	if(check_student($username,$password)==True){
	//$flag=true;
		$_SESSION["viewType"] = "student";
		header("location:gatorLearning.php");
	}
	if(check_professor($username,$password)==true){
	//$flag1=true;
		$_SESSION["viewType"] = "professor"; 
		header("location:gatorLearning.php");
	}
	if($flag==false && $flag1==false){
	echo "Invalid information. Please try again";
	}

?>
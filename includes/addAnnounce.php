<?php 
	include('functions.php');

if(isset($_POST['submit'])) {
	if (isset($_POST['profClass']) && isset($_POST['announceMessage'])) {
	
		echo 'Hello';
		$conn = connect();

		$message = $_POST['announceMessage'];
		$class = $_POST['profClass'];
		echo ($message);
		$query = "	INSERT INTO announcements
					VALUES(current_timestamp, '$message' ,'$class', inc.nextval)"; 

		$stid = oci_parse($conn, $query);
		$execute = oci_execute($stid);
		if (!$execute) {
			$e = oci_error($stid);
			echo htmlentities($e['message']);
		}	  
	//header("Location:/Gradebook-Management-System/profLearning.php");

	}else{
		echo 'MISTAKES';
	}
	header("Location:/Gradebook-Management-System/profLearning.php");
}
?>
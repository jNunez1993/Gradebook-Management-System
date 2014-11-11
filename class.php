<?php
session_start();
?>

<!DOCTYPE html>
	<html>
		<head>
			<title>Class webpage</title>
		</head>
		<body>
		<?php
		include 'function.php';
		$username=$_SESSION["username"];
		$password=$_SESSION["password"];
		$conn=connect();
		$query="select course_name from student,course where student.UFID=course.student_ID and student.gatorLink='$username'";
		$stid=oci_parse($conn,$query);
		oci_execute($stid);
		echo "<table border='4' cellspacing='35'>\n";
		while (($row=oci_fetch_row($stid))!=false){
			echo "<tr>\n";
				foreach($row as $item){
					echo  '<td>' .  '<font size="5">' . '<a href=' . "http://localhost/class.php?class=" .$item . '>' . $item . '</a>' .  '</font>' . '</td>';
				}
		}
		echo "</table>\n";
		?>
		</body>
		</html>
			
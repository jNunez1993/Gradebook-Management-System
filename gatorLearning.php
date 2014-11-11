<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> gatorLearning </title>
	</head>
	<body>
	<h1> GatorLearning </h1>
	
<?php
	include 'function.php';
	$username= $_POST["userName"];
	$password= $_POST["password"];
	$_SESSION["username"]="$username";
	$_SESSION["password"]="$password";
	$flag=False;
	$flag1=False;
	
	if(check_student($username,$password)==True){
	$flag=true;
	}
	if(check_professor($username,$password)==true){
	$flag1=true;
	}
	if($flag==false && $flag1==false){
	echo "Invalid information. Please try again";
	}

if($flag==True){
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
}


if($flag1==True){
$conn=connect();
$query="select distinct course_name from professor,course where professor.UFID=course.professor_ID and professor.gatorLink='$username'";
$stid=oci_parse($conn,$query);
	oci_execute($stid);
	echo "<table border='4' cellspacing='35'>\n";
	while (($row=oci_fetch_row($stid))!=false){
		echo "<tr>\n";
        foreach($row as $item){
		echo  '<td>' .  '<font size="5">' . '<a href=' . "http://localhost/profClass.php?class=" .$item . '>' . $item . '</a>' .  '</font>' . '</td>';
		}
    }
	echo "</table>\n";
}

	?>

	</body>
	</html>
<?php
	/*echo '
		<img src="img/a25.jpg" class="img-responsive" alt="Responsive image" />
	';*/
	session_start();
	$course = $_SESSION['Course'];
	echo $course;
	header("Location:/Gradebook-Management-system/profCourse.php?course=" . $course);


?>
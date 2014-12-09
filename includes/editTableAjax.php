<?php
include ('functions.php');

	if (isset($_GET['edit'])) {
		$course = $_SESSION['Course'];
		//$course = "ABE2062";
		$assignName = $_GET['column'];
		$studentUFID = $_GET['id'];
		$newValue = $_GET["newValue"];

		$conn = connect();
		$query = "	UPDATE grade SET grade = '$newValue' 
					WHERE grade.Student_ID = '$studentUFID' 
					AND grade.Assignment_name = '$assignName' 
					AND course_name = '$course'";
		$stid = oci_parse($conn,$query);
		$row = oci_execute($stid);
		echo "Echo: ". $row. "
		";
		//$sql = "UPDATE course SET $column = :value WHERE CourseNo = :id";
		/*$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':value',$newValue);
		$stmt->bindParam(':id',$id);
		$response['success'] = $stmt->execute();
		$response['value'] = $newValue;
*/
		echo json_encode($row);
		//echo ("hello!");
	}
?>
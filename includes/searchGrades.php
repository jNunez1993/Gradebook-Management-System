<?php
include ('functions.php');
$course = $_SESSION['Course'];
$profID = $_SESSION['UFID'];
$ufid = $_POST['UFID'];

$studentQuery ="	SELECT student.UFID, student.lname, student.fname 
			FROM grade,student
			WHERE grade.student_ID = '$ufid'
			AND grade.professor_ID='$profID' 
			AND grade.course_name='$course'
			AND grade.student_ID = student.UFID";

$studentSTID=oci_parse($conn,$studentQuery);
oci_execute($studentSTID); 
$studentInfo = oci_fetch_row($studentSTID);


$assignQuery = "SELECT assignment_name, grade
  				FROM (SELECT * FROM grade WHERE course_name = '$course'  AND student_id = '$ufid')";
$assignSTID=oci_parse($conn,$assignQuery);
oci_execute($assignSTID); 

$query1= "SELECT distinct assignment_name 
			FROM  (select assignment_name  from grade 
			where  grade.course_name = '$course') 
			ORDER BY assignment_name asc";
$stid1=oci_parse($conn,$query1);
oci_execute($stid1); 
if (empty($studentInfo[0])) {
	echo '<div class="alert alert-warning" role="alert">No students exist with that UFID in your class</div>';
}else{
	echo '<table class= "table table-striped table-bordered table-hover" id = "edittable">
	 		<thead>
				<tr>
					<th colspan="1" rowspan="1" style="width: 180px;" tabindex="0">Stduent UFID</th>
					<th colspan="1" rowspan="1" style="width: 220px;" tabindex="0">Last Name</th>
					<th colspan="1" rowspan="1" style="width 288px;" tabindex="0">First Name</th>';
				while (($row=oci_fetch_row($stid1))!=false){
					foreach($row as $item){
					echo  '<th>' . $item . '</th>';
					}
				}
	echo'		</tr>
			</thread>
			<tbody>
			<tr>';
				echo '<td>' . $studentInfo[0] . '</td>';
				echo '<td>' . $studentInfo[1] . '</td>';
				echo '<td>' . $studentInfo[2] . '</td>';
		while (($gradeInfo = oci_fetch_row($assignSTID))!=false){
			echo '<td>' . $gradeInfo[1] . '</td>';
		}
					
	echo'	</tr>
			</tbody>
		</table>';
}
?>
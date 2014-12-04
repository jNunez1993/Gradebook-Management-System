<?php
include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$query = "SELECT distinct assignment_name FROM grade,course WHERE grade.student_ID = '$ufid' AND grade.course_ID = '$course' ORDER BY assignment_name ASC "; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo '<table class = "table table-hover table-condensed">';
	$counter = 1;
	while (($row = oci_fetch_row($stid)) != false){
		echo 	'<tr>
					<td> ' . $row[0]  . '</td> 
					<td class = "float left"> 
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewAssignment">
						 View Assignment
						</button>
					</td>
				</tr>';
		$counter++;
	}
	echo '</table>';

	echo '<div class="modal fade" id="viewAssignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel"></h4>
			      </div>
			      <div class="modal-body">
			        <object type="application/pdf" data="img/hw1.pdf "width="100%" height="500">this is not working as expected</object>
  			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
		</div>';

}
?>
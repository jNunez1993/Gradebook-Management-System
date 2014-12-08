<?php
include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$query = "SELECT distinct assignment_name, assignment_type 
	FROM grade,course 
	WHERE grade.professor_ID = '$ufid' 
	AND grade.course_name = '$course' 
	ORDER BY assignment_name ASC "; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);

	echo '<div class = "row" id = "add_announce">
		<a type="button" style = "float : right;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addAssignment"> Add Assignment</a>
	</div>';
	echo '<table class = "table table-hover table-condensed">';
	echo '<th> Assignment Name </th>
			<th></th>';
	while (($row = oci_fetch_row($stid)) != false){
		echo 	'<tr>
					<td> ' . $row[0]  . '</td> 
					<td> 
						<a class="view_assignment_modal btn btn-primary" style = "float : right;" data-id = "' . $row[1] . '" data-name = "' . $row[0] . '" " data-toggle="modal" data-target="#viewAssignment">
						 View ' . $row[1]. '
						</a>
					</td>
				</tr>';
	}
	echo '</table>';

	echo '<div class="modal fade" id="viewAssignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title assignment_name"></h4>
			      </div>
			      <div class="modal-body assignment_type">
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
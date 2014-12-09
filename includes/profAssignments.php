<?php
include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	$ufid = $_SESSION["UFID"];
	$course = $_SESSION["Course"];
	$conn= connect();
	
	$singleStudent = "SELECT student_id FROM grade WHERE grade.course_name = '$course' AND ROWNUM = 1";
	$check = oci_parse($conn,$singleStudent);
	oci_execute($check);
	$studentRow = oci_fetch_row($check);

	$query = "SELECT distinct assignment_name, assignment_type 
	FROM grade,course 
	WHERE grade.professor_ID = '$ufid' 
	AND grade.course_name = '$course' 
	AND grade.student_id = '$studentRow[0]'
	ORDER BY assignment_name ASC "; 
	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);


	echo '<table class = "table table-hover table-condensed">';
	echo '<th> Assignment Name </th>
			<th>View</th>';
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
  			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
		</div>';

	}
	echo '
	<div class = "row" id = "add_assignment">
		<a type="button" style = "float : right;" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#addAssignment"> Add Assignment</a>
	</div>';
	echo '    <!--MODAL -->
	<div class="modal fade" id="addAssignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <form role="form" action="includes/addAssignment.php" method="post">
	      	<div class="modal-body">
	      		<div class="form-group">
				    <label for="announceMessage">Message</label>
				    <input class="form-control" name="assignmentName" placeholder="Assignment Name">
			    </div>
				  <div class="form-group">
				    	<label for="announceTitle">Class</label>
						<select class="form-control" name = "assignmentType">
						    <option value="Assignment">Assignment</option>
						    <option value="Homework">Homework</option>
						    <option value="Exam">Exam</option>
						</select>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile">File input</label>
				    <input type="file" id="exampleInputFile">
				    <p class="help-block">Still in test mode.</p>
				  </div>
	     	 </div>
	      
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	<input class="btn btn-success" type="submit" name="submit" value="Add Assignment"/>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- END OF MODAL -->';
?>
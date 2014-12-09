$(document).ready(function(){
	$('ul#course_side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );
		var menu_url = "includes/changeCourseHome.php";
		if (menu_item == "Grades") {
			menu_url = 'includes/changeCourseGrade.php';
		}else if (menu_item == "Assignments") {
			menu_url = 'includes/changeCourseAssignments.php';
		}else if (menu_item == "Students") {
			menu_url = 'includes/changeCourseStudents.php';
		}
		$.ajax({ 
			url: menu_url,
			data: {type: menu_item },
			type: 'post',
			success: function(output) {
				$('#main_course_body').html(output);
            }
		});
		return false;
	});

	$(document).on("click", ".view_assignment_modal", function () {
		var assignment_type = $(this).attr('data-id');
		var assignment_name = $(this).attr('data-name');
		$(".modal-content .assignment_type").html( '<object type="application/pdf" data="img/' + assignment_type + '.pdf "width="100%" height="500"></object>' );
		$(".modal-content .assignment_name").html( assignment_name );
	});
//Main page
	$('ul#main_side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );
		console.log(menu_item);
		var menu_url = 'includes/changeHomeAnnouncements.php';
		if (menu_item == "Course") {
			menu_url = 'includes/changeHomeCourse.php';
		}else if (menu_item == "Grades") {
			menu_url = 'includes/changeHomeGrade.php';
		}
		$.ajax({ 
			url: menu_url,
			data: {type: menu_item },
			type: 'post',
			success: function(output) {
				$('#main_body').html(output);
            }
		});
		return false;
	});
/////////////////////////////////////////////////////////////////////////

///////////////////////// PROFESSOR VIEW ////////////////////////////////
	$('ul#prof_main_side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );
		console.log(menu_item);
		var menu_url = 'includes/profHomeAnn.php';
		if (menu_item == "Course") {
			menu_url = 'includes/profHomeCourse.php';
		}else if (menu_item == "Grades") {
			menu_url = 'includes/profHomeGrade.php';
		}
		$.ajax({ 
			url: menu_url,
			data: {type: menu_item },
			type: 'post',
			success: function(output) {
				$('#main_body').html(output);
            }
		});
		return false;
	});

	$(document).on("click", "#prof_course_side_menu li a", function () {	
		var menu_item = $(this).attr('id');
		var course = $(this).attr('course');
		var menu_url = "";
		console.log(menu_item);		
		console.log(course);

		if (menu_item == "Grades") {
			menu_url = 'includes/profGradebook.php';
		}else if (menu_item == "Assignments") {
			menu_url = 'includes/profAssignments.php';
		}else if (menu_item == "Students") {
			menu_url = 'includes/profStudents.php';
		}else{

		}
		if (menu_item == "Home"){
			//menu_url = 'includes/editTable.php';
			//menu_url = 'includes/profMainCourse.php';
			//console.log(course);
			window.location.replace("http://localhost/Gradebook-Management-system/includes/profMainCourse.php");
		}else {
			$.ajax({ 
				url: menu_url,
				data: {type: menu_item },
				type: 'post',
				success: function(output) {
					$('#main_course_body').html(output);
	            }
			});
		}

		return false;
	});
	$(document).on("click", ".view_gradeBook", function () {		
		var menu_item = $(this).attr('id');
		$.ajax({ 
			url: 'includes/profGradebook.php',
			data: {type : menu_item },
			type: 'post',
			success: function(output) {
				$('#main_body').html(output);
            }
		});
	});

});
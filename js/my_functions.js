$(document).ready(function(){
	$('ul#side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );

		var menu_url = 'includes/changeCourseGrade.php';
		if (menu_item == "Assignments") {
			menu_url = 'includes/changeCourseAssignments.php';
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
		console.log(assignment_type);
		var assignment_name = $(this).attr('data-name');
		$(".modal-content .assignment_type").html( '<object type="application/pdf" data="img/' + assignment_type + '.pdf "width="100%" height="500"></object>' );
		$(".modal-content .assignment_name").html( assignment_name );
	});
	//$(document).
//Main page
	$('ul#main_side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );
		console.log(menu_item);
		var menu_url = 'includes/changeHomeAnnouncements.php';
		if (menu_item == "Course") {
			menu_url = 'includes/changeHomeCourse.php';
		}else if (menu_item == "Grade") {
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


});
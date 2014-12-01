$(document).ready(function(){
	$('ul#side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );

		var menu_url = '';
		if (menu_item == "Grades"){
			menu_url = 'includes/course_grades.php';
			console.log("grades");
		}
		if (menu_item == "Assignements"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
		}
		if (menu_item == "Resources"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
		}
		if (menu_item == "Chat"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
		}
		if (menu_item == "Test"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
		}
		if (menu_item == "Videos"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
		}
		if (menu_item == "Help"){
			menu_url = 'includes/changeCourseMain.php';
			console.log("assignements");
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
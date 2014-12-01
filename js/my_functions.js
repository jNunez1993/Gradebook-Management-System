$(document).ready(function(){
	$('ul#side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//$('#main_body').load('course/' + menu_item + '.php' );

		var menu_url = 'includes/changeCourseMain.php';
		if (menu_item == "Grades"){
			menu_url = 'includes/course_grades.php';
			console.log("grades");
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
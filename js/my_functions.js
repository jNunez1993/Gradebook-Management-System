$(document).ready(function(){
	$('ul#side_menu li a').click( function(){
		var menu_item = $(this).attr('href');
		alert(menu_item);
		$('#main_body').load('course/' + menu_item + '.php' );
		return false;
	});

});
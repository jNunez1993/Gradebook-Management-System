$(document).ready(function(){
	$('ul#side_menu li a').click( function(){
		var menu_item = $(this).attr('id');
		//alert(menu_item);
		//$('#main_body').load('course/' + menu_item + '.php' );
		$('#main_body').html('<h1>' + menu_item + '</h1>');

		return false;
	});

});
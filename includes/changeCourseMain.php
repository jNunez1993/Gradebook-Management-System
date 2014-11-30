<?php

include ('functions.php');

if(isset($_POST['type'])){
	//Place header for actual queries stuff
	echo("Action works! " . $_POST['type']);
}


?>
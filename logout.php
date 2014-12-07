<?php
session_start();
unset($_SESSION);
session_destroy();
session_write_close();
header("refresh: 3; index.php");
		echo "Logout succesful. You will be redirected in 3 seconds.";
?>
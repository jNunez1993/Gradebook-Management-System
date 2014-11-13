<?php

define('DB_SERVER', 'oracle.cise.ufl.edu');
define('DB_USERNAME', 'jnunez');
define('DB_PASSWORD', 'Gato8115851');
define('DB_DATABASE', 'oracle.cise.ufl.edu:1521/orcl');
$conn= oci_connect(DB_USERNAME, DB_PASSWORD, DB_DATABASE)
or die(oci_error());
//$database = oci_select_db(DB_DATABASE) or die(oci_error());
?>

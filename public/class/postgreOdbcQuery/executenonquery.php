<?php
	$strArchivoConexion= $_POST['archivoconexion'];
	$strQuery= $_POST['query'];
	
	require_once ($strArchivoConexion);
	
	$connection=getconnection();
	
	pg_Query($connection,$strQuery);
	
	echo 'true';
?>

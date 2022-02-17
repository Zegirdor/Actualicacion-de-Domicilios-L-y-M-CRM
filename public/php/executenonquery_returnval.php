<?php
	$strArchivoConexion= $_POST['archivoconexion'];
	$strQuery= $_POST['query'];
	
	require_once ($strArchivoConexion);
	
	$connection=getconnection();
	
	$res=pg_Exec($connection,$strQuery);
	$row=pg_fetch_array($res);
	
	echo $row[0];
?>
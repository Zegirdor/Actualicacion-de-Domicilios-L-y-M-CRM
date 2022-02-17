<?php
	$strArchivoConexion= $_POST['archivoconexion'];
	$strQuery= $_POST['query'];
	
	require_once ($strArchivoConexion);
	require_once ('returnjsonformat.php');
	
	$connection=getconnection();
	
	$res=pg_Exec($connection,$strQuery);	
	if (pg_num_rows($res)==0)
	{
		return 'false';
		exit;
	}
	
	$row=jsonformat($res);
	
	echo $row;
	return;
?>
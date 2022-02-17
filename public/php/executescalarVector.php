<?php
	$strArchivoConexion= $_POST['archivoconexion'];
	$strQuery= $_POST['query'];
	
	$strQuery=str_replace("#","+",$strQuery);
	
	require_once ($strArchivoConexion);
	require_once ('odbcUtilities.php');
	
	$connection=getconnection();
	
	$res=pg_Exec($connection,$strQuery);	
	if (pg_num_rows($res)==0)
	{
		echo 'false';
		return;
	}
	
	$row=returnExcalarPipe($res);
	
	echo $row;
	return;
?>
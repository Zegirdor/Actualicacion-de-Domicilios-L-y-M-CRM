<?php

	function returnPostgresConection($strHost,$strBd,$strUser,$strPassword)
	{
		$connection = pg_connect("host=$strHost dbname=$strBd user= $strUser password=$strPassword");
		return $connection;
	}
	
	function returnSQLServerConection($strHost,$strBd,$strUser,$strPassword)
	{
		$connectionInfo = array( "Database"=>$strBd, "UID"=>$strUser, "PWD"=>$strPassword);
		$connectionSql = sqlsrv_connect($strHost, $connectionInfo);
		return $connectionSql;
	}

	function executeEscalar($strConexion,$strQuery)
	{
		$res= pg_Exec($strConexion,$strQuery);
		$intTotalRegistros = pg_num_rows($res);
	
		if ($intTotalRegistros==0)
		{
				return 'false';
				exit;
		}

		return $res;
	} 
	
	function returnExcalarPipe($res)
	{
		$intTotalCampos = pg_num_fields($res);
		while($row=pg_fetch_array($res))
		{
			for($j=0; $j<$intTotalCampos; $j++)
			{
				$strCadena=$strCadena.$row[$j].'|';
			}
			$strCadena= substr($strCadena, 0, -1);
		}
		return $strCadena;
	}
?>
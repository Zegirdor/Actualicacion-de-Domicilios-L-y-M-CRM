<?php
	$strArchivo= $_POST['archivo'];
	$strpais = $_POST['pais'];
	$strConsulta= $_POST['consulta'];

	$server = '10.44.15.142';
	$user = 'sysconsultas';
	$pass = '847ba52434884eabb440659d2376ef83';
	$bd = 'atencionacliente';
		
	$connection = pg_connect("host=$server dbname=$bd user= $user password=$pass");
	$res= pg_Exec($connection,$strConsulta);
	
	$intTotalRegistros = pg_num_rows($res);
	
	if ($intTotalRegistros==0)
	{
			echo 'false';
			exit;
	}
	$strCadena='';
	$File=fopen($strArchivo,"a") or
	die("Error al crear archivo");
	ftruncate($File,0);
	
	$intTotalCampos = pg_num_fields($res);
	$strCadena=$strCadena.'[';
	while($row=pg_fetch_array($res))
	{
		$strCadena=$strCadena.'{';
		for($j=0; $j<$intTotalCampos; $j++)
		{
			$strNombreCampo=pg_field_name($res, $j);
			$strCadena=$strCadena.'"'.$strNombreCampo.'":"'.$row[$j].'"';
			$strCadena=$strCadena.',';
		}
		$strCadena= substr($strCadena, 0, -1);
		$strCadena=$strCadena.'},';
	}
	$strCadena= substr($strCadena, 0, -1);
	$strCadena=$strCadena.']';
	fputs($File,$strCadena);
	fclose($File);
	echo 'true';
?>
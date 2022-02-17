<?php
$strArchivo= $_POST['archivo'];
$strTopeArchivo= $_POST['topearchivo'];
$archivo = file("uploads/$strArchivo");

$archivoGenerar=substr($strArchivo,0,-4);

$NumLinea=0;
$CuentaFilas=0;
$ContadorArchivo=1;
$StrTitulos="";


	foreach ($archivo as $linea_num => $linea){
	   if ($NumLinea==0)
		{
			$StrTitulos=$linea;
		}
		else
		{
			fputs($archivonuevo,$linea);
		}
		
		if ($CuentaFilas==0)
		{
			$archivonuevo = fopen("uploads/$archivoGenerar"."_".$ContadorArchivo.".csv","a");
			ftruncate($archivonuevo,0);
			fputs($archivonuevo,$StrTitulos);
			if ($NumLinea!=0)
			{
				fputs($archivonuevo,$linea);
			}
		}
		$CuentaFilas++;
		$NumLinea++;
	   if ($CuentaFilas==$strTopeArchivo)
	   {
			fclose($archivonuevo);
			$ContadorArchivo++;
			$CuentaFilas=0;
	   }
	   
	}
fclose($archivonuevo);
$zip = new ZipArchive();
$filename = $strArchivo.'.zip';
if($zip->open($filename,ZIPARCHIVE::CREATE)===true) 
{
	for ($intNumArchivo=1;$intNumArchivo<=$ContadorArchivo;$intNumArchivo++)
	{
		$zip->addFile("uploads/$archivoGenerar"."_".$intNumArchivo.".csv");
		sleep(2);
	}
	$zip->close();
}


for ($intNumArchivo=1;$intNumArchivo<=$ContadorArchivo;$intNumArchivo++)
{
		unlink("uploads/$archivoGenerar"."_".$intNumArchivo.".csv");
}

unlink("uploads/$strArchivo");

echo 'true';
?>
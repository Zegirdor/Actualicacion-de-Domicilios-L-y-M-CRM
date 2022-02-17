<?php
$strArchivo= $_POST['archivo'];
$archivo = file("uploads/$strArchivo");

$archivoGenerar=substr($strArchivo,0,-4);

$filename = $strArchivo.'.zip';
exec("zip -P 123 /uploads/$strArchivo $filename");

/*
$zip = new ZipArchive();
$filename = $strArchivo.'.zip';
if($zip->open($filename,ZIPARCHIVE::CREATE)===true) 
{
	$zip->addFile("uploads/$strArchivo");	
	sleep(2);
	$zip->setPassword('123456');
	$zip->close();
}

unlink("uploads/$strArchivo");
*/
echo '123';
return;
?>
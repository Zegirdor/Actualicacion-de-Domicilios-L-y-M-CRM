<?php
$strArchivo= $_POST['archivo'];
$archivo = file("uploads/$strArchivo");
$archivonuevo = fopen("combocampos.txt","a");
$NumLinea=0;
$Contador=1;
foreach ($archivo as $linea_num => $linea){
   $cortado = explode(",",$linea);
   if ($NumLinea==0)
   {
	   $strCadena.='[';
	   for ($i = 0; $i <= count($cortado)-1; $i++) 
		{
			$strCadena.='{';
			$strCadena.='"id":"'.$Contador.'",'.'"nom":"'.trim($cortado[$i]).'"';
			$strCadena.='},';
			$Contador++;
		}
		$strCadena= substr($strCadena, 0, -1);
		$strCadena.=']';
	}
   $NumLinea++;
}

$strCadena=str_replace("\n","",$strCadena);
$strCadena=trim($strCadena);
ftruncate($archivonuevo,0);
fputs($archivonuevo,$strCadena);
fclose($archivonuevo);

echo 'true';
?>
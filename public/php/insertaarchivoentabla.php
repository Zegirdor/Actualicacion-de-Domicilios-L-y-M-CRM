<?php
$strArchivo= $_POST['archivo'];
$strCombo= $_POST['combo'];
$archivo = file("uploads/$strArchivo");
$archivonuevo = fopen("cadenas2.txt","a");
$server = '10.44.15.142';
$user = 'sysconsultas';
$pass = '847ba52434884eabb440659d2376ef83';
$bd = 'control';
$NumLinea=0;
foreach ($archivo as $linea_num => $linea){
   $cortado = explode(",",$linea);
   if ($NumLinea==0)
   {
	   $strComando ="Create table tmp_TablaCsvSubir(";
	   for ($i = 0; $i <= count($cortado)-1; $i++) 
		{
			$strComando.=trim($cortado[$i]).' text,';
		}
		$strComando=substr($strComando,0,strlen($strComando)-1);
		
		
	}
   $NumLinea++;
}
$strComando.=");";
$StrQuery="select fn_CreaTablaCsvSubir('".$strComando."','tmp_TablaCsvSubir')";
$connection = pg_connect("host=$server dbname=$bd user= $user password=$pass");
pg_Query($connection,$StrQuery);

$NumLinea=0;
foreach ($archivo as $linea_num => $linea){
   $cortado = explode(",",$linea);
   if ($NumLinea!=0)
   {
	   $strComando ="insert into tmp_TablaCsvSubir values(";
	   for ($i = 0; $i <= count($cortado)-1; $i++) 
		{
			$strComando.="'".trim($cortado[$i])."',";
		}
		$strComando=substr($strComando,0,strlen($strComando)-1);
		$strComando.=");";
	}
	pg_Query($connection,$strComando);
   //fwrite($archivonuevo,$strComando);
   $NumLinea++;
}
//fclose($archivonuevo);
echo 'true';
?>
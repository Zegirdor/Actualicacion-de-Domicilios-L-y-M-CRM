<?php
$strArchivoConexion= $_POST['archivoconexion'];
$strQuery= $_POST['query'];
$strId= $_POST['id'];

include 'CreaObjetosHtml.php';
require_once ($strArchivoConexion);
 
$strConexion=getconnection();

if ($strConexion==false)
{
 echo "Error";
}

$ComboHtml=ReturnHtmlCombo($strConexion,$strQuery,$strId);

echo $ComboHtml;
return;
?>
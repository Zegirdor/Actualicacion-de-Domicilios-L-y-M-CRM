<?php
session_start(); 
$strArchivoConexion= $_POST['archivoconexion'];
$strMenu= $_POST['menu'];
$intIdMenu= $_POST['idmenu'];

include 'CreaObjetosHtml.php';
require_once ($strArchivoConexion);
 
$strConexion=getconnection();

if ($strConexion==false)
{
 echo "Error";
}

$HtmlForm=ReturnHtmlHorizontalMenu($strConexion,$strMenu,$_SESSION["user"],$intIdMenu);

echo $HtmlForm;
return;
?>
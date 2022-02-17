<?php
require_once ("odbcUtilities.php");
require_once ('C:\xampp\htdocs\SistemasControl\Main\php\config.php');
function validaSesion()
{
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location: /SistemasControl/LoginSistemas/');
	}
	return;
}

function validaTipoUsuario($tipousuario)
{
	if($_SESSION['usertype']<$tipousuario)
	{
		header('location: /SistemasControl/LoginSistemas/');
	}
	return;
}

function validaPermisos($strLink)
{
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location: /SistemasControl/LoginSistemas/');
		return;
	}
	else
	{
		$connection=getconnection();
		$res=pg_Exec($connection,"select resultado from fn_ValidaPermisosPagina(".$_SESSION['user'].",'$strLink','men_siscontrol',1)");
		$row=pg_fetch_array($res);
		if($row[0]=='false')
		{
			//header('location: /SistemasControl/LoginSistemas/');
		}
	}
	return;
}
?>
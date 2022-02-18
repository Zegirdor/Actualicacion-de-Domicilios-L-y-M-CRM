<?php
setlocale(LC_TIME, "");
setlocale(LC_ALL, "en_ES.utf8");

// [SGBD]
define('PROVEEDOR_PG', 'PostgreSQL');

////Conexión a servidor 84
define('HOST_84', '10.27.113.84');
define('USER_84', 'sysdatos');
define('PASS_84', 'f7c0853fd9048a496fa6b70eb21f4fb6');
define('BD_NAME_84', 'actualizaciondomicilioslym');

//Conexión a servidor

function conectaServer84(){
	$server = '10.27.113.84';
	$user = 'sysdatos';
	$pass = 'f7c0853fd9048a496fa6b70eb21f4fb6';
	$BD = 'actualizaciondomicilioslym';
	$connec = pg_connect("host=".$server." dbname=".$BD." user=".$user." password=".$pass."") or die ("Error de conexion servidor (".$server.") Base de datos (".$BD.")");
	return $connec;
}

//Conexión SFTP
function conectaFTP84(){
	$connection = ssh2_connect("10.27.113.84", "22");
	ssh2_auth_password($connection, "sysdesarrollo", "pruebaslol");
	$sftp = ssh2_sftp($connection);
	return $sftp;
}

?>
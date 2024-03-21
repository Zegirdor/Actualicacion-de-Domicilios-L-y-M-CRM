<?php
// setlocale(LC_TIME, "");
// setlocale(LC_ALL, "en_ES.utf8");

// [SGBD]
// define('PROVEEDOR_PG', 'PostgreSQL');

////Conexión a servidor 84
// define('HOST_84', '10.27.113.84');
// define('USER_84', 'sysdatos');
// define('PASS_84', 'f7c0853fd9048a496fa6b70eb21f4fb6');
// define('BD_NAME_84', 'actualizaciondomicilioslym');

//Conexión a los servidores

// function conectaServer13(){
// 	$server = '10.40.44.13';
// 	$user = 'reportes';
// 	$pass = 'repcredito';
// 	$BD = 'e_commerce';
// 	$connec = pg_connect("host=".$server." dbname=".$BD." user=".$user." password=".$pass."") or die ("Error de conexion servidor (".$server.") Base de datos (".$BD.")");
// 	return $connec;
// }
/**
 * Catálogo de empleados
 */
function postgreSQLServer128(){
	$server = '10.44.2.128';
	$user = 'reportes';
	$pass = 'ff7b3106de28225ca601288654f6c57a';
	$BD = 'appwebcat';
	$connec = pg_connect("host=$server dbname=$BD user=$user password=$pass");
	if (!$connec) {
		exit("Error de conexion servidor ($server) Base de datos ($BD)");
	}
	return $connec;
}

/**
 * Conexión con 10.27.113.84, sysdatos, actualizaciondomicilioslym
 * Movimientos
 */
// function conectaServer84(){
// 	$server = '10.27.113.84';
// 	$user = 'sysdatos';
// 	$pass = 'f7c0853fd9048a496fa6b70eb21f4fb6';
// 	$BD = 'actualizaciondomicilioslym';
// 	$connec = pg_connect("host=".$server." dbname=".$BD." user=".$user." password=".$pass."") or die ("Error de conexion servidor (".$server.") Base de datos (".$BD.")");
// 	return $connec;
// }

// function conectaServer88(){
// 	$server88 = '10.44.2.88';
// 	$user88 = 'reportes';
// 	$pass88 = 'ff7b3106de28225ca601288654f6c57a';
// 	$BD88 = 'actualizacion_domicilios_lym';
// 	$connec88 = pg_connect("host=".$server88." dbname=".$BD88." user=".$user88." password=".$pass88."") or die ("Error de conexion servidor (".$server88.") Base de datos (".$BD88.")");
// 	return $connec88;
// }

/**
 * Directorio y movimientos
 */
function postgreSQLProductivo(){
	$server = "10.44.1.215";
	$user = "syscredito";
	$pass = "2587fb5cd0e0c6112394cf4b033ce6f7";
	$DB = "actualizacion_domicilios_lym";
	$connection = pg_connect("host=$server dbname=$DB user=$user password=$pass");
	if (!$connection) {
		exit("Error de conexion servidor PostgreSQL ($server) Base de datos ($DB)");
	}
	return $connection;
}

?>
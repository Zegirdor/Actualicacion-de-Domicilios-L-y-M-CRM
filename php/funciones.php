<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include 'config.php';

$option = $_POST['opc'];
switch ($option){

    case 'mostrarFinesGestion':
        Captura::mostrarFinesGestion();
    break;
}



Class Captura{

    public static function mostrarFinesGestion(){

        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = conectaServer84();

        //Realizar consulta
        $sQuery = "SELECT * FROM cat_quiencontesto;";

        $Consulta = pg_query($conn, $sQuery);
        pg_close($conn);

        //Creamos un arreglo para los resultados de la consulta
		$datosCombo = array();
		$arrayCombo= array();

        if($Consulta > 0){

            $response = true;

            $datosCombo['id'] = trim($array=['id']);
            $datosCombo['descripcion'] = trim($array=['descripcion']);

            $arrayCombo = array_map('utf8_encode', $datosCombo);

        }

        $endJSON = array('estado' => $estado, 'response' => $response,'arrayCombo' => $arrayCombo);
        echo json_encode($endJSON);

    }


}


?>
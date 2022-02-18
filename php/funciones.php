<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include('../php/config.php');

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

        $datosCombo = array();
		$arrayCombo= array();

        //Realizar consulta
        $sQuery = "SELECT * FROM cat_fingestion_lym;";

        $Consulta = pg_query($conn, $sQuery);
        pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){

                $response = true;
                $estado = 1;

                $datosCombo['id'] = trim($array['id_fingestion']);
                $datosCombo['descripcion'] = trim($array['descripcion']);

                $arrayCombo[] = array_map('utf8_encode', $datosCombo);

            }


        }

        $endJSON = array('estado' => $estado, 'response' => $response,'arrayCombo' => $arrayCombo);
        echo json_encode($endJSON);

    }


}
?>
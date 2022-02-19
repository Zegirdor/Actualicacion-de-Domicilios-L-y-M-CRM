<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include('../php/config.php');

$option = $_POST['opc'];
switch ($option){

    case 'mostrarFinesGestion':
        Captura::mostrarFinesGestion();
    break;

    case 'llenaCRM':
        InformacionCliente::llenaCRM(trim($_POST['numeroCliente']), trim($_POST['numeroTelefono']));
    break;
}

Class InformacionCliente{

    public static function llenaCRM($numCliente, $numTelefono){

        $response = false;
        $estado = 0;

         //Conexion al servidor
         $conn = conectaServer84();

         //Creamos arreglos para guardar los datos, $datosCliente para tenerlos todos, y $arrayCliente será para aplicarles un encode
         $datosCliente = array();
         $arrayCliente = array();

         //Realizar consulta
         $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = '".$numCliente."'::BIGINT AND telefono_contactado = '".$numTelefono."'::BIGINT;";

         //Guardar nuestro query en una variable y cerramos conexión con el servidor
         $Consulta = pg_query($conn, $sQuery);
         pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){

                $response = true;
                $estado = 1;

                $datosCliente   ['nombreCliente']       = trim($array['nombre_cliente']);
                $datosCliente   ['fechaNacimiento']     = trim($array['fechanacimiento']);
                $datosCliente   ['sexo']                = trim($array['sexo']);
                $datosCliente   ['estadoCivil']         = trim($array['estadocivil']);
                $datosCliente   ['tipotelefono']        = trim($array['tipotelefono']);
                $datosCliente   ['domicilio']           = trim($array['domicilio_act']);
                $datosCliente   ['puntualidad']         = trim($array['puntualidad']);
                $datosCliente   ['situacionEspecial']   = trim($array['situacionespecial']);
                $datosCliente   ['vencido']             = trim($array['vencido']);

                $arrayCliente[] = array_map('utf8_encode', $datosCliente);

            }

        }

        $endJSON = array('estado' => $estado, 'response' => $response,'arrayCliente' => $arrayCliente);
        echo json_encode($endJSON);


    }
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

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
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

//InformacionCliente::llenaCRM('451330171','6461782655');

?>
<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include('../php/config.php');


//Cachar variables de URL

$option = $_POST['opc'];
switch ($option){

    case 'mostrarFinesGestion':
        Captura::mostrarFinesGestion();
    break;

    case 'llenaCRM':
        InformacionCliente::llenaCRM(trim($_POST['numeroCliente']), trim($_POST['numeroTelefono']));
    break;

    case 'finalizarCRM':
        //var_dump($option);
        Captura::finalizarCRM(  trim($_POST['fecha']),
                                trim($_POST['numeroCliente']),          trim($_POST['nombreCliente']),
                                trim($_POST['numeroTelefono']),         trim($_POST['fechaNacimiento']),
                                trim($_POST['sexo']),                   trim($_POST['sestadoCivil']),
                                trim($_POST['tipotelefono']),           trim($_POST['domicilio']),
                                trim($_POST['puntualidad']),
                                trim($_POST['situacionEspecial']),      trim($_POST['vencido']),
                                trim($_POST['sestado']),                 trim($_POST['municipio']),
                                trim($_POST['colonia']),                trim($_POST['calle']),
                                trim($_POST['entreCalles']),            trim($_POST['codigoPostal']),
                                trim($_POST['numInterior']),            trim($_POST['numExterior']),
                                trim($_POST['edificio']),               trim($_POST['complemento']),
                                trim($_POST['telefonoAdicional']),      trim($_POST['tipoTelefonoAdicional']),
                                trim($_POST['quienContesto'])

                            );
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
         $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = '".$numCliente."'::BIGINT";


         //Guardar nuestro query en una variable y cerramos conexión con el servidor
         $Consulta = pg_query($conn, $sQuery);
         pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){

                $response = true;
                $estado = 1;

                //Informacion del cliente
                $datosCliente   ['nombreCliente']       = trim($array['nombre_cliente']);
                $datosCliente   ['fechaNacimiento']     = trim($array['fechanacimiento']);
                $datosCliente   ['sexo']                = trim($array['sexo']);
                $datosCliente   ['sestadoCivil']        = trim($array['estadocivil']);
                $datosCliente   ['tipotelefono']        = trim($array['tipotelefono']);
                $datosCliente   ['domicilio']           = trim($array['domicilio_act']);
                //Informacion del credito
                $datosCliente   ['puntualidad']         = trim($array['puntualidad']);
                $datosCliente   ['situacionEspecial']   = trim($array['situacionespecial']);
                $datosCliente   ['vencido']             = trim($array['vencido']);
                //Captura
                $datosCliente   ['sestado']              = trim($array['estado_new']);
                $datosCliente   ['municipio']           = trim($array['delegacion_o_municipio_new']);
                $datosCliente   ['colonia']             = trim($array['colonia_new']);
                $datosCliente   ['calle']               = trim($array['nom_calle_new']);
                $datosCliente   ['entreCalles']         = trim($array['entre_calles_new']);
                $datosCliente   ['codigoPostal']        = trim($array['codigo_postal_new']);
                $datosCliente   ['numInterior']         = trim($array['numero_interior_new']);
                $datosCliente   ['numExterior']         = trim($array['numero_de_casa_new']);
                $datosCliente   ['edificio']            = trim($array['numero_o_letra_de_edificio_new']);
                $datosCliente   ['complemento']         = trim($array['complemento_new']);
                $datosCliente   ['telefonoAdicional']   = trim($array['telefono_adicional_new']);



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
       $sQuery = "SELECT * FROM cat_fingestion_lym WHERE tipo = 'FG_EJECUTIVO';";

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

    public static function finalizarCRM($fecha, $numeroCliente, $nombreCliente, $numeroTelefono,
                                        $fechaNacimiento, $sexo, $sestadoCivil, $tipotelefono, $domicilio,
                                        $puntualidad, $situacionEspecial, $vencido, $sestado, $municipio,
                                        $colonia, $calle, $entreCalles, $codigoPostal, $numInterior, $numExterior,
                                        $edificio, $complemento, $telefonoAdicional, $tipoTelefonoAdicional, $quienContesto){

        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = conectaServer84();

        $datosCRM = array();
		$arrayCRM= array();

        //Realizar INSERTADO
        $sQuery = "SELECT * FROM fun_CRM(   1,  '".$numeroCliente."'::BIGINT,'".$nombreCliente."'::TEXT,'".$numeroTelefono."'::BIGINT,'".$fechaNacimiento."'::DATE,'". $sexo."'::TEXT,
                                                '".$sestadoCivil."'::TEXT,'".$tipotelefono."'::TEXT,'".$domicilio."'::TEXT,'".$puntualidad."'::TEXT,'".$situacionEspecial."'::TEXT,
                                                '".$vencido."'::BIGINT,'".$sestado."'::TEXT,'".$municipio."'::TEXT,'".$colonia."'::TEXT,'".$calle."'::TEXT,'".$entreCalles."'::TEXT,
                                                '".$codigoPostal."'::TEXT,'".$numInterior."'::TEXT,'".$numExterior."'::TEXT,'".$edificio."'::TEXT,'".$complemento."'::TEXT,'".$telefonoAdicional."'::TEXT,
                                                '".$tipoTelefonoAdicional."'::TEXT,
                                                '".$quienContesto."'::INTEGER);";

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        $Consulta = pg_query($conn, $sQuery);
        pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){
                $response =  1;

                $datosCRM['estado'] = trim($array['estado']);
                $datosCRM['mensaje'] = trim($array['mensaje']);

                $arrayCRM[] = array_map('utf8_encode', $datosCRM);

            }


        }

        $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => $response,'arrayTable' => $arrayCRM);
		echo json_encode($endJSON);

    }




}

//InformacionCliente::llenaCRM('11154853','6461740260');
//Captura::finalizarCRM('451330171','6461782655');

?>
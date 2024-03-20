<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include('../php/config.php');




$option = $_POST['opc'];
switch ($option){

    case 'llenaInfoAgente':
        InfoBarraNavegacion::llenaInfoAgente(trim($_POST['numeroAgente']));
    break;

    case 'llenaCRM':
        InformacionCliente::llenaCRM(trim($_POST['numeroCliente']), trim($_POST['telefonoCliente']));
    break;

    case 'mostrarFinesGestion':
        Captura::mostrarFinesGestion();
    break;

    case 'finalizarCRM':
        Captura::finalizarCRM(
                                trim($_POST['numeroAgente']),           trim($_POST['nombreAgente']),
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
                                trim($_POST['quienContesto']),          trim($_POST['resultadoLlamada']),
                                trim($_POST['horainicio'])
                            );
    break;

    case 'consultaIdFines':
        Captura::consultaIdFines(trim($_POST['descripcion']));
    break;
}

Class InfoBarraNavegacion{

    public static function llenaInfoAgente($numeroAgente){
        
        $response =  false;
        $estado = 0;

        $conn = conectaServer128();

        $datosAgente = array();
        $arrayAgente = array();

         //Realizar consulta
         $sQuery = "SELECT empleado, nombre || ' ' || apellidopaterno || ' ' || apellidomaterno AS nombre FROM catalogoempleados WHERE empleado = '".$numeroAgente."'::INTEGER";

          //Guardar nuestro query en una variable y cerramos conexión con el servidor
          $Consulta = pg_query($conn, $sQuery);
          pg_close($conn);

          if($Consulta > 0){

            $response   = true;
            $estado     = 100;

            while($array = pg_fetch_array($Consulta)){
                $datosAgente   ['numeroAgente']       = trim($array['empleado']);
                $datosAgente   ['nombreAgente']       = trim($array['nombre']);

                $arrayAgente[] = array_map('utf8_encode', $datosAgente);
            }

          }

          $endJSON = array('estado' => $estado, 'response' => $response,'arrayAgente' => $arrayAgente);
          echo json_encode($endJSON);
    }

}

Class InformacionCliente{

    public static function llenaCRM($numCliente, $telefonoCliente){

        $response = false;
        $estado = 0;

         //Conexion al servidor
         $conn = conectaServer88();

         //Creamos arreglos para guardar los datos, $datosCliente para tenerlos todos, y $arrayCliente será para aplicarles un encode
         $datosCliente = array();
         $arrayCliente = array();

         //Realizar consulta
        //  $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = '$numCliente'::BIGINT AND telefono_contactado = '$telefonoCliente'::BIGINT;";
        //  $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = $numCliente::BigInt AND Right(Telefono_Contactado::Text, 10) = Right('$telefonoCliente', 10);"; // Ángel
        $sQuery = "SELECT 	D.nom_cliente, D.fec_nacimiento, D.des_sexo, D.des_estadocivil, 1 AS opc_tipotelefono, 
                            D.des_domicilio, D.opc_puntualidad, D.opc_situacionespecial, D.imp_vencido 
                    FROM mae_directoriolym AS D
                    JOIN mae_generacionlym AS G
                    ON D.num_cliente = G.num_cliente
                    WHERE G.num_cliente = '$numCliente'::TEXT
                    AND RIGHT(G.num_telefono::TEXT, 10) = RIGHT('$telefonoCliente', 10);";
         //Guardar nuestro query en una variable y cerramos conexión con el servidor
        /*
        Ángel: Guardar el resultado de la consulta (que puede ser false en caso de error o el resultado de la consulta) en una variable y cerramos conexión con el servidor.
         He agregado un decorador de silencio (@) a la función para ayudar con el manejo correcto de errores.
         Además he corregido la manera en la que está escrita la consulta para hacerla más fácil de leer.
        */
         $Consulta = @pg_query($conn, $sQuery);
         if(!$Consulta){
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DEL CLIENTE', 'arrayCliente' => array()));
            return;
         }
         pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){

                $response = true;
                $estado = 1;

                //Informacion del cliente
                $datosCliente   ['nombreCliente']       = trim($array['nom_cliente']);
                $datosCliente   ['fechaNacimiento']     = trim($array['fec_nacimiento']);
                $datosCliente   ['sexo']                = trim($array['des_sexo']);
                $datosCliente   ['sestadoCivil']        = trim($array['des_estadocivil']);
                $datosCliente   ['tipotelefono']        = trim($array['opc_tipotelefono']);
                $datosCliente   ['domicilio']           = trim($array['des_domicilio']);
                //Informacion del credito
                $datosCliente   ['puntualidad']         = trim($array['opc_puntualidad']);
                $datosCliente   ['situacionEspecial']   = trim($array['opc_situacionespecial']);
                $datosCliente   ['vencido']             = trim($array['imp_vencido']);
                // //Captura
                // $datosCliente   ['sestado']              = trim($array['estado_new']);
                // $datosCliente   ['municipio']           = trim($array['delegacion_o_municipio_new']);
                // $datosCliente   ['colonia']             = trim($array['colonia_new']);
                // $datosCliente   ['calle']               = trim($array['nom_calle_new']);
                // $datosCliente   ['entreCalles']         = trim($array['entre_calles_new']);
                // $datosCliente   ['codigoPostal']        = trim($array['codigo_postal_new']);
                // $datosCliente   ['numInterior']         = trim($array['numero_interior_new']);
                // $datosCliente   ['numExterior']         = trim($array['numero_de_casa_new']);
                // $datosCliente   ['edificio']            = trim($array['numero_o_letra_de_edificio_new']);
                // $datosCliente   ['complemento']         = trim($array['complemento_new']);
                // $datosCliente   ['telefonoAdicional']   = trim($array['telefono_adicional_new']);
                // $datosCliente   ['tipoTelAdicional']    = trim($array['tipo_tel_adicional_new']);
                // $datosCliente   ['quienContesto']       = trim($array['quien_brinda_informacion_new']);

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
       $sQuery = "SELECT * FROM cat_fingestion_lym WHERE tipo = 'FG_EJECUTIVO' ORDER BY id_fingestion;";

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

    public static function finalizarCRM(    $numeroAgente, $nombreAgente, $numeroCliente, $nombreCliente, $numeroTelefono,
                                            $fechaNacimiento, $sexo, $sestadoCivil, $tipotelefono, $domicilio,
                                            $puntualidad, $situacionEspecial, $vencido, $sestado, $municipio,
                                            $colonia, $calle, $entreCalles, $codigoPostal, $numInterior, $numExterior,
                                            $edificio, $complemento, $telefonoAdicional, $tipoTelefonoAdicional, $quienContesto, $resultadoLlamada, $fec_horainicio){

        
        
    //Establecer la zona horaria nuestra
    date_default_timezone_set('America/Mazatlan');

    //fecha hora fin de la llamada: Obtenemos la fecha, hora, minutos, segundos del dia de hoy
    $fec_horafin = date("Y-m-d H:i:s");

        $response = false;
        $estado = 0;


        //Conexion al servidor
        $conn = conectaServer84();

        $estado  = 0;
	    $mensaje = "No se ejecuto proceso";

        $datosCRM = array();
		$arrayCRM= array();

        //Asignar id al resultado de la llamada
        switch ($resultadoLlamada){

            case    $resultadoLlamada == 1:  // DOMICILIO CAPTURADO
                    $resultadoLlamada = 1;
            break;


            case    $resultadoLlamada == 2:  // DOMICILIO INCOMPLETO
                    $resultadoLlamada = 2;
            break;

            case    $resultadoLlamada == 3:  // NO ACEPTA CAPTURA
                    $resultadoLlamada = 3;
            break;

            case    $resultadoLlamada == 4: // RECADO
                    $resultadoLlamada = 4;
            break;

            case    $resultadoLlamada == 5: // LLAMAR DESPUES
                    $resultadoLlamada = 5;
            break;

            case    $resultadoLlamada == 6: // EQUIVOCADO NO LO CONOCE
                    $resultadoLlamada = 6;
            break;

            case    $resultadoLlamada == 7: // BUZON DE VOZ
                    $resultadoLlamada = 8;
            break;

            case    $resultadoLlamada == 8: // OCUPADO
                    $resultadoLlamada = 9;
            break;

            case    $resultadoLlamada == 9: // FUERA DE SERVICIO
                    $resultadoLlamada = 10;
            break;

            case    $resultadoLlamada == 10: // CELULAR NO DISPONIBLE
                    $resultadoLlamada = 11;
            break;

            case    $resultadoLlamada == 11: // NO VIVE AHI
                    $resultadoLlamada = 13;
            break;

            case    $resultadoLlamada == 12: // CLIENTE FALLECIO
                    $resultadoLlamada = 14;
            break;

            case    $resultadoLlamada == 13: // NO RESPONDE
                    $resultadoLlamada = 15;
            break;
        }


        //Realizar INSERTADO
        $sQuery = "SELECT * FROM fun_CRM(   1,  '".$numeroAgente."'::BIGINT,        '".$nombreAgente."'::TEXT,      '".$numeroCliente."'::BIGINT,
                                                '".$nombreCliente."'::TEXT,         '".$numeroTelefono."'::BIGINT,  '".$fechaNacimiento."'::DATE,
                                                '".$sexo."'::TEXT,                  '".$sestadoCivil."'::TEXT,      '".$tipotelefono."'::TEXT,
                                                '".$domicilio."'::TEXT,             '".$puntualidad."'::TEXT,       '".$situacionEspecial."'::TEXT,
                                                '".$vencido."'::BIGINT,             '".$sestado."'::TEXT,           '".$municipio."'::TEXT,
                                                '".$colonia."'::TEXT,               '".$calle."'::TEXT,             '".$entreCalles."'::TEXT,
                                                '".$codigoPostal."'::TEXT,          '".$numInterior."'::TEXT,       '".$numExterior."'::TEXT,
                                                '".$edificio."'::TEXT,              '".$complemento."'::TEXT,       '".$telefonoAdicional."'::TEXT,
                                                '".$tipoTelefonoAdicional."'::TEXT, '".$quienContesto."'::INTEGER,  '".$resultadoLlamada."'::INTEGER,
                                                '".$fec_horainicio."'::TEXT,        '".$fec_horafin."'::TEXT
                                        );";

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

    public static function consultaIdFines($descripcion){
        
        //Inicializar variables que vamos a necesitar
        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = conectaServer84();

        $estado  = 0;
	    $mensaje = "No se ejecuto proceso";

        $descripcionFines = array();
		$arrayDescripcion= array();

        $sQuery = "SELECT id_fingestion FROM cat_fingestion_lym WHERE descripcion =  '".$descripcion."'";

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        $Consulta = pg_query($conn, $sQuery);
        pg_close($conn);

        if($Consulta > 0){

            while($array = pg_fetch_array($Consulta)){
                $estado     =  100;
                $response   = true;

                $descripcionFines['id']  = trim($array['id_fingestion']);
                $mensaje                 = "CONSULTA PARA OBTENER EL ID DEL FIN DE GESTION REALIZADA CON EXITO";

                $arrayDescripcion[] = array_map('utf8_encode', $descripcionFines);

            }

        }

        $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => $response,'arrayDescripcion' => $arrayDescripcion);
		echo json_encode($endJSON);
    }


}

//InformacionCliente::llenaCRM('11154853','6461740260');
//Captura::finalizarCRM("90110787","JANETH PRUEBA","327620412","ANA MARIA TELLEZ TELLEZ","6671361288","1993-08-25","FEMENINO","SOLTERO(A)","2","6671361288","CHIAPAS,TAPACHULA,CENTRO NTE OTE,3 NORTE,33,,COL CENTRO,R","L","1036","UNA VEZ MAS","","","","","","","","","","","0",4,4,'2022-05-04 17:8:49');
//Captura::consultaIdFines('NO RESPONDE');

/*
"90110787","JANETH PRUEBA","327620412","ANA MARIA TELLEZ TELLEZ","6671361288","1993-08-25","FEMENINO","SOLTERO(A)","2","6671361288","CHIAPAS,TAPACHULA,CENTRO NTE OTE,3 NORTE,33,,COL CENTRO,R","L","1036","UNA VEZ MAS","","","","","","","","","","","0",4,4,'2022-05-04 17:8:49'
*/
?>
<?php

//Incluimos el archivo donde tenemos las conexiones a los servidores
include('../php/config.php');




$option = $_POST['opc'];
switch ($option) {

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
            trim($_POST['numeroAgente']),
            trim($_POST['nombreAgente']),
            trim($_POST['numeroCliente']),
            trim($_POST['nombreCliente']),
            trim($_POST['numeroTelefono']),
            trim($_POST['fechaNacimiento']),
            trim($_POST['sexo']),
            trim($_POST['sestadoCivil']),
            trim($_POST['tipotelefono']),
            trim($_POST['domicilio']),
            trim($_POST['puntualidad']),
            trim($_POST['situacionEspecial']),
            trim($_POST['vencido']),
            trim($_POST['sestado']),
            trim($_POST['municipio']),
            trim($_POST['colonia']),
            trim($_POST['calle']),
            trim($_POST['entreCalles']),
            trim($_POST['codigoPostal']),
            trim($_POST['numInterior']),
            trim($_POST['numExterior']),
            trim($_POST['edificio']),
            trim($_POST['complemento']),
            trim($_POST['telefonoAdicional']),
            trim($_POST['tipoTelefonoAdicional']),
            trim($_POST['quienContesto']),
            trim($_POST['resultadoLlamada']),
            trim($_POST['horainicio'])
        );
        break;

    case 'consultaIdFines':
        Captura::consultaIdFines(trim($_POST['descripcion']));
        break;
}

class InfoBarraNavegacion {

    public static function llenaInfoAgente($numeroAgente) {

        $response =  false;
        $estado = 0;

        $conn = postgreSQLServer128();

        $datosAgente = array();
        $arrayAgente = array();

        //Realizar consulta
        $sQuery = "SELECT empleado, nombre || ' ' || apellidopaterno || ' ' || apellidomaterno AS nombre FROM catalogoempleados WHERE empleado = $numeroAgente::Numeric";

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        $Consulta = pg_query($conn, $sQuery);
        if (!$Consulta) {
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DEL CLIENTE', 'arrayAgente' => array()));
            return;
        }
        pg_close($conn);

        // if ($Consulta > 0) {

        $response   = true;
        $estado     = 100;
        $array = pg_fetch_all($Consulta, PGSQL_ASSOC);
        // while ($array = pg_fetch_array($Consulta)) {
            // $datosAgente['numeroAgente']       = trim($array['empleado']);
            // $datosAgente['nombreAgente']       = trim($array['nombre']);

            // $arrayAgente[] = array_map('utf8_encode', $datosAgente);
        // }
        // }
            // print_r($array);
            // exit(0);
            $array = $array[0];
        // $endJSON = array('estado' => $estado, 'response' => $response, 'arrayAgente' => $arrayAgente);
        $endJSON = array('estado' => $estado, 'response' => $response, 'arrayAgente' => $array);
        echo json_encode($endJSON);
    }
}

class InformacionCliente {

    public static function llenaCRM($numCliente, $telefonoCliente) {

        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = postgreSQLProductivo(); //DONE //DONE

        //Creamos arreglos para guardar los datos, $datosCliente para tenerlos todos, y $arrayCliente será para aplicarles un encode
        $datosCliente = array();
        $arrayCliente = array();

        //Realizar consulta
        //  $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = '$numCliente'::BIGINT AND telefono_contactado = '$telefonoCliente'::BIGINT;";
        //  $sQuery = "SELECT * FROM tmp_generacion_lym WHERE num_cliente = $numCliente::BigInt AND Right(Telefono_Contactado::Text, 10) = Right('$telefonoCliente', 10);"; // Ángel
        $sQuery = "SELECT
                    Nom_Nombre_Cliente nom_cliente,
                    Fec_Fecha_Nacimiento fec_nacimiento,
                    Des_Sexo,
                    Des_Estado_Civil des_estadocivil,
                    Arr_ID_Clave_Categoria_Telefono[Array_Position(Arr_Numeros_De_Telefono, '$telefonoCliente')] opc_tipotelefono,
                    Des_Domicilio_Cliente des_domicilio,
                    Opc_Puntualidad_de_Cliente opc_puntualidad,
                    Clv_Situacion_Especial opc_situacionespecial,
                    Imp_Saldo_Vencido imp_vencido
                    FROM actualizacion_de_domicilios_l_y_m_directorio
                    WHERE 0 = 0
                    And '$telefonoCliente' = Any(Arr_Numeros_De_Telefono)
                    And '$numCliente' = Num_Numero_Cliente;";
        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        /*
        Ángel: Guardar el resultado de la consulta (que puede ser false en caso de error o el resultado de la consulta) en una variable y cerramos conexión con el servidor.
         He agregado un decorador de silencio (@) a la función para ayudar con el manejo correcto de errores.
         Además he corregido la manera en la que está escrita la consulta para hacerla más fácil de leer.
        */
        $Consulta = @pg_query($conn, $sQuery);
        if (!$Consulta) {
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DEL CLIENTE', 'arrayCliente' => array()));
            return;
        }
        pg_close($conn);

        // if ($Consulta > 0) {
            // exit("Debug");
        $array = pg_fetch_array($Consulta);
        if (!$array) {
            echo json_encode(array('estado' => false, 'response' => 'false', 'arrayCliente' => []));
            return;
        }

            // while () {

        $response = true;
        $estado = 1;

        //Informacion del cliente
        $datosCliente['nombreCliente']       = trim($array['nom_cliente']);
        $datosCliente['fechaNacimiento']     = trim($array['fec_nacimiento']);
        $datosCliente['sexo']                = trim($array['des_sexo']);
        $datosCliente['sestadoCivil']        = trim($array['des_estadocivil']);
        $datosCliente['tipotelefono']        = trim($array['opc_tipotelefono']);
        $datosCliente['domicilio']           = trim($array['des_domicilio']);
        //Informacion del credito
        $datosCliente['puntualidad']         = trim($array['opc_puntualidad']);
        $datosCliente['situacionEspecial']   = trim($array['opc_situacionespecial']);
        $datosCliente['vencido']             = trim($array['imp_vencido']);
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
            // }
        // }

        $endJSON = array('estado' => $estado, 'response' => $response, 'arrayCliente' => $arrayCliente);
        echo json_encode($endJSON);
    }
}


class Captura {

    public static function mostrarFinesGestion() {

        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = postgreSQLProductivo(); //DONE //DONE

        // $datosCombo = array();
        // $arrayCombo = array();

        //Realizar consulta
        $sQuery = "Select ID, Fin_de_Gestion Descripcion From Actualizacion_de_Domicilios_L_y_M_Fines_de_Gestion Where Origen iLike 'Ejecutivo';";

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        $Consulta = pg_query($conn, $sQuery);
        if (!$Consulta) {
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DE FIN DE GESTION', 'arrayCombo' => array()));
            return;
        }
        pg_close($conn);

        // if ($Consulta > 0) {
        $array = pg_fetch_all($Consulta, PGSQL_ASSOC);
        if (!$array) {
            echo json_encode(array('estado' => false, 'response' => 'false', 'arrayCombo' => []));
            return;
        }
            // while () {

                $response = true;
                $estado = 1;

                // $datosCombo['id'] = trim($array['id']);
                // $datosCombo['descripcion'] = trim($array['fin_de_gestion']);

                // $arrayCombo[] = array_map('utf8_encode', $array);
                // $arrayCombo = $array;
            // }
        // }

        $endJSON = array('estado' => $estado, 'response' => $response, 'arrayCombo' => $array);
        echo json_encode($endJSON);
    }

    public static function finalizarCRM(
        $numeroAgente,
        $nombreAgente,
        $numeroCliente,
        $nombreCliente,
        $numeroTelefono,
        $fechaNacimiento,
        $sexo,
        $sestadoCivil,
        $tipotelefono,
        $domicilio,
        $puntualidad,
        $situacionEspecial,
        $vencido,
        $sestado,
        $municipio,
        $colonia,
        $calle,
        $entreCalles,
        $codigoPostal,
        $numInterior,
        $numExterior,
        $edificio,
        $complemento,
        $telefonoAdicional,
        $tipoTelefonoAdicional,
        $quienContesto,
        $resultadoLlamada,
        $fec_horainicio
    ) {



        //Establecer la zona horaria nuestra
        date_default_timezone_set('America/Mazatlan');

        //fecha hora fin de la llamada: Obtenemos la fecha, hora, minutos, segundos del dia de hoy
        $fec_horafin = date("Y-m-d H:i:s");

        $response = false;
        $estado = 0;


        //Conexion al servidor
        $conn = postgreSQLProductivo();

        $estado  = 0;
        $mensaje = "No se ejecuto proceso";

        $datosCRM = array();
        $arrayCRM = array();

        //Asignar id al resultado de la llamada
        // switch ($resultadoLlamada) {

        //     case    $resultadoLlamada == 1:  // DOMICILIO CAPTURADO
        //         $resultadoLlamada = 1;
        //         break;


        //     case    $resultadoLlamada == 2:  // DOMICILIO INCOMPLETO
        //         $resultadoLlamada = 2;
        //         break;

        //     case    $resultadoLlamada == 3:  // NO ACEPTA CAPTURA
        //         $resultadoLlamada = 3;
        //         break;

        //     case    $resultadoLlamada == 4: // RECADO
        //         $resultadoLlamada = 4;
        //         break;

        //     case    $resultadoLlamada == 5: // LLAMAR DESPUES
        //         $resultadoLlamada = 5;
        //         break;

        //     case    $resultadoLlamada == 6: // EQUIVOCADO NO LO CONOCE
        //         $resultadoLlamada = 6;
        //         break;

        //     case    $resultadoLlamada == 7: // BUZON DE VOZ
        //         $resultadoLlamada = 8;
        //         break;

        //     case    $resultadoLlamada == 8: // OCUPADO
        //         $resultadoLlamada = 9;
        //         break;

        //     case    $resultadoLlamada == 9: // FUERA DE SERVICIO
        //         $resultadoLlamada = 10;
        //         break;

        //     case    $resultadoLlamada == 10: // CELULAR NO DISPONIBLE
        //         $resultadoLlamada = 11;
        //         break;

        //     case    $resultadoLlamada == 11: // NO VIVE AHI
        //         $resultadoLlamada = 13;
        //         break;

        //     case    $resultadoLlamada == 12: // CLIENTE FALLECIO
        //         $resultadoLlamada = 14;
        //         break;

        //     case    $resultadoLlamada == 13: // NO RESPONDE
        //         $resultadoLlamada = 15;
        //         break;
        // }


        //Realizar INSERTADO.
        /*
        Zegirdor: Que haga una inserción manual en la tabla, o crear una función (meror) donde
        se reciba un Array de parámetros y que se inserten en la tabla dinámicamente, de esa
        manera, si la estructura de la tabla cambia, simplemente hará falta cambiar lo que es
        enviado aquí en el Array, en lugar de tener que modificar la función.
        */
        $consulta = "SELECT
        Actualizacion_de_Domicilios_L_y_M_Insertar_Movimiento(Array[
            '$fec_horainicio',
            '$fec_horafin',
            '$resultadoLlamada', -- Fin de gestión
            '$numeroCliente',
            '$nombreCliente',
            '$numeroTelefono',
            '$sestado',
            '$municipio',
            '$colonia',
            '$numExterior',
            '$numInterior',
            '$entreCalles',
            '$codigoPostal',
            '$edificio',
            '$complemento',
            '$calle',
            '$telefonoAdicional',
            '$tipoTelefonoAdicional',
            '$quienContesto', -- x2 [REMOVIDO UN DATO REDUNDANTE, AHORA ESTE ES EL UNICO. REVISAR CATALOGO DE QUIEN CONTESTÓ]
            '$numeroAgente',
            '$nombreAgente'
        ]) resultado_funcion;";

        /*
DATOS REDUNDANTES QUE VIENEN EN EL DIRECTORIO
    '$fechaNacimiento'::DATE,
'$sexo'::TEXT,                  '$sestadoCivil'::TEXT,      '$tipotelefono'::TEXT,
   '$puntualidad'::TEXT,       '$situacionEspecial'::TEXT,
'$vencido'::BIGINT,
*/

        //Guardar nuestro query en una variable y cerramos conexión con el servidor

        $resultadoConsulta = pg_query($conn, $consulta);
        // pg_close($conn);
        if (!$resultadoConsulta) {
            $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => 'false', 'arrayTable' => array());
            echo json_encode($endJSON); 
            return;   
        }
        // if ($resultadoConsulta > 0) {

            while ($array = pg_fetch_array($resultadoConsulta)) {
                // print_r($array['resultado_funcion'] == "f");
                if ($array['resultado_funcion'] == "f") {
                    exit(pg_last_notice($conn));
                    // print("Error: " . pg_last_error($conn));
                    // exit("\nexit\n");
                    // exit("Notice: " . pg_last_notice($conn));
                    // // exit("Notice: " . pg_last_notice($conn));
                    // $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => 'false', 'arrayTable' => array());
                    // echo json_encode($endJSON); 
                    // return;   
                }
        
                $response =  1;

                $datosCRM['estado'] = 1;
                $datosCRM['mensaje'] = "Mensaje que no sirve para nada pero todo bien";

                $arrayCRM[] = array_map('utf8_encode', $datosCRM);
            }
        // }

        $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => $response, 'arrayTable' => $arrayCRM);
        echo json_encode($endJSON);
    }

    public static function consultaIdFines($descripcion) {

        //Inicializar variables que vamos a necesitar
        $response = false;
        $estado = 0;

        //Conexion al servidor
        $conn = postgreSQLProductivo(); //DONE

        $estado  = 0;
        $mensaje = "No se ejecuto proceso";

        $descripcionFines = array();
        $arrayDescripcion = array();

        $sQuery = "SELECT ID FROM Actualizacion_de_Domicilios_L_y_M_Fines_de_Gestion WHERE Fin_de_Gestion = '$descripcion'";

        //Guardar nuestro query en una variable y cerramos conexión con el servidor
        $Consulta = pg_query($conn, $sQuery);
        if (!$Consulta) {
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DE FIN DE GESTION 2', 'arrayDescripcion' => array()));
            return;
        }
        pg_close($conn);

        
        $array = pg_fetch_all($Consulta, PGSQL_ASSOC);
        if (!$array) {
            echo json_encode(array('estado' => false, 'response' => 'SIN DATOS DE FIN DE GESTION 2', 'arrayDescripcion' => array()));
            return;
        }
            // while () {
        $estado     =  100;
        $response   = true;

                // $descripcionFines['id']  = $array['id'];
                // $mensaje                 = "CONSULTA PARA OBTENER EL ID DEL FIN DE GESTION REALIZADA CON EXITO";

                // $arrayDescripcion[] = array_map('utf8_encode', $descripcionFines);
            // }
        

        $endJSON = array('estado' => $estado, 'mensaje' => $mensaje, 'response' => $response, 'arrayDescripcion' => $array);
        echo json_encode($endJSON);
    }
}

//InformacionCliente::llenaCRM('11154853','6461740260');
//Captura::finalizarCRM("90110787","JANETH PRUEBA","327620412","ANA MARIA TELLEZ TELLEZ","6671361288","1993-08-25","FEMENINO","SOLTERO(A)","2","6671361288","CHIAPAS,TAPACHULA,CENTRO NTE OTE,3 NORTE,33,,COL CENTRO,R","L","1036","UNA VEZ MAS","","","","","","","","","","","0",4,4,'2022-05-04 17:8:49');
//Captura::consultaIdFines('NO RESPONDE');

/*
"90110787","JANETH PRUEBA","327620412","ANA MARIA TELLEZ TELLEZ","6671361288","1993-08-25","FEMENINO","SOLTERO(A)","2","6671361288","CHIAPAS,TAPACHULA,CENTRO NTE OTE,3 NORTE,33,,COL CENTRO,R","L","1036","UNA VEZ MAS","","","","","","","","","","","0",4,4,'2022-05-04 17:8:49'
*/

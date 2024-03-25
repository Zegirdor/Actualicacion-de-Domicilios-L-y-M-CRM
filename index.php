<?php
//La llamada entra al cargar la barra de navegacion. Obtener la fecha y hora inicio
//Establecer la zona horaria nuestra
date_default_timezone_set('America/Mazatlan');

//fecha hora inicio de la llamada: Obtenemos la fecha, hora, minutos, segundos del dia de hoy
$fec_horainicio = date("Y-m-d H:i:s");



?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS -->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <!-- PAQUETERIA JS, CSS, jQuery VERSION 4.1 -->

    <script type="text/javascript" src="./js/recursos/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="./public/js_references/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="./public/js_references/jqxcore.js"></script>
    <script type="text/javascript" src="./public/js_references/jqxwindow.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.css.map">
    <!-- <link rel="stylesheet" href="css/bootstrap.min"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css.map">
    <!-- <link rel="stylesheet" href="css/bootstrap-grid.min"> -->
    <link rel="stylesheet" href="css/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css.map">

    <!-- JS -->
    <script type="text/javascript" src="js/recursos/bootstrap.js"></script>
    <!-- <script type="text/javascript" src="js/recursos/bootstrap.js.min.js"></script> -->


    <!-- SCRIPTS-->
    <script type="text/javascript" src="js/eventos.js"></script>


    <title>CRM Actualiza domicilios L y M</title>
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-light" id="barra_navegacion">
        <div class="container-fluid col-lg-12 col-md-12">

            <img src="css/images/logo_coppel_2.png" class="col-lg-2 col-md-2" alt="img_logo_coppel" id="logo_img">

            <div class="col-lg-4 col-md-4">
                    <h5 class="text-white">Campaña Actualización Clientes L y M</h5>
            </div>

            <div class="col-lg-6 col-md-6 navbar-nav" id="info_agente">

            </div>

        </div>
    </nav>

    <!-- INFORMACIÓN DEL CLIENTE-->
    <section id="Informacion_Cliente">

    </section>

    <br><br>

    <!-- INFORMACIÓN DEL CRÉDITO-->
    <section id="Informacion_Credito">


    </section>



    <!-- CAPTURA -->
    <section id="Captura" class="mt-2">

    <form id="formCaptura" method="post" class= "needs-validation" accept-charset="utf-8" novalidate>

        <div class="row container-fluid mt-3">

            <div class="text-center mt-3 container-fluid" id="Encabezados"><h4 class="text-white">CAPTURA</h4></div><br><br>


        <div class="col-3">

            <div id="E">
                <label for="sestado"><strong> Estado: </strong></label>
                <input type="text" name="sestado" class="form-control sestado inputEstado" placeholder="Escriba el estado" id="sestado"
                onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="40" style="text-transform:uppercase;">

                <div class="invalid-feedback">Por favor ingrese el estado</div>
            </div>
            <br>

            <div id="M">
                <label for="municipio"><strong> Delegación/Municipio: </strong></label>
                <input type="text" name="municipio" class="form-control inputMunicipio" placeholder="Escriba la delegación o municipio" id="municipio"
                onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" style="text-transform:uppercase;" >

                <div class="invalid-feedback">Por favor ingrese el municipio</div>
            </div>
            <br>

            <div id="C">
                <label for="colonia"><strong> Colonia: </strong></label>
                <input type="text" name="colonia" class="form-control inputColonia" placeholder="Escribe la colonia" id="colonia"
                onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" style="text-transform:uppercase;" >
                <div class="invalid-feedback">
                    Por favor introduce la colonia
                </div>
            </div>
        </div>

        <div class="col-3">

            <div id= 'Ca'>
                <label for="calle"><strong> Calle: </strong></label>
                <input type="text" name="calle" class="form-control inputCalle" placeholder="Escriba la calle" id="calle"
                onkeyup="javascript:this.value=this.value.toUpperCase();"  maxlength="50"style="text-transform:uppercase;" >
                <div class="invalid-feedback">
                    Por favor introduce la calle
                </div>
            </div>
            <br>

            <label for=""><strong> Entre calles: </strong></label>
            <input type="text" class="form-control" placeholder="Escriba las entre calles del domicilio" id="entreCalles"
            onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" style="text-transform:uppercase;" >
            <br>

            <label for=""><strong> Código postal: </strong></label>
            <input type="number" class="form-control" maxlength = "5" placeholder="Escribe el código postal" id="codigoPostal"
            onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" >

        </div>

        <div class="col-3">

        <div id="NI">
            <label for="numInterior"><strong> # Interior: </strong></label>
            <input type="text" class="form-control" maxlength = "7" placeholder="Escriba el número interior del domicilio" id="numInterior"
            onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" >
            <div class="invalid-feedback">
                Por favor introduce el número interior
            </div>
        </div>
        <br>

            <label for="numExterior"><strong> # Exterior: </strong></label>
            <input type="text" class="form-control inputExterior" maxlength = "5" placeholder="Escriba el número exterior del domicilio" id="numExterior"
            onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" ><br>

            <label for=""><strong> Edificio: </strong></label>
            <input type="text" class="form-control" maxlength = "10" placeholder="Escriba el edificio" id="edificio"
            onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" >
        </div>

        <div class="col-3">

            <div id="Co">
                <label for="complemento"><strong> Complemento: </strong></label>
                <input type="text" name="complemento" class="form-control inputComplemento" placeholder="Escriba información complementaria" id="complemento"
                onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="500" style="text-transform:uppercase;" >
                <div class="invalid-feedback">
                    Por favor introduce un complemento
                </div>
            </div>
            <br>

            <label for="telefonoAdicional"><strong> Teléfono adicional: </strong></label>
            <input type="number" class="form-control"  maxlength = "10" placeholder="Escriba un teléfono adicional" id="telefonoAdicional"
            onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" ><br>

            <label for="tipoTel"><strong> Tipo de teléfono adicional: </strong></label>
            <select class="form-control" name="" id="tipoTel">
                
                <option selected disabled value="7">Selecciona un tipo de teléfono</option>
                <option value="1">FIJO/CASA</option>
                <option value="2">MOVIL/CELULAR</option>
            </select>
        </div>

        </div>
        <br>

        <div class="container">
            <div class="row col-lg-12">

                <div class="col-lg-4">
                    <label for="quienContesto"><strong> Quién contestó: </strong></label>
                    <select class="form-control" name="" id="quienContesto" required>
                        <option selected disabled value="">Selecciona quién contestó</option>
                        <option id="cliente" value="">CLIENTE</option>
                        <option value="1">CONYUGE O PADRES</option>
                        <option value="2">OTRO FAMILIAR</option>
                        <option value="3">MENOR DE EDAD</option>
                        <option value="4">NO SE IDENTIFICA</option>

                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona quién contestó la llamada
                    </div>
                </div>

                <div class="col-lg-4" >
                    <label for="finesGestion"><strong> Resultado de la llamada: </strong></label>
                    <select class="form-control" name="" id="finesGestion" required>

                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona un fin de gestión
                    </div>
                </div>

                <div class="col-lg-4" >
                    <button class="btn text-white" type="submit" id="Finalizar">Finalizar</button>
                </div>

                <div id="idFinGestion">

                </div>

            </div>

        </div>

        <input type="text" name="horainicio" value="

        <?php
        echo $fec_horainicio;

        global $fec_horainicio;


        ?>

        " id="horainicio" hidden>


    </form>

    <br><br>

    <script>
        //Funciones de validacion en campos
        function maxlengthNumber(obj){
            //(obj.value);

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }

        function maxlengthTelephone(obj){
           // console.log(obj.value);

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }

    </script>


    </section>


    <footer class="mt-5">

    </footer>

</body>
</html>




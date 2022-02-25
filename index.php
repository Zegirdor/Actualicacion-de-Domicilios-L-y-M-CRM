
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">

    <!-- ESTILOS -->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

    <!-- PAQUETERIA JS, CSS, jQuery-->

    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="./public/js_references/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="./public/js_references/jqxcore.js"></script>
    <script type="text/javascript" src="./public/js_references/jqxwindow.js"></script>

    <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js.map"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.min.js.map"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.esm.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.esm.js.map"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.esm.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.esm.min.js.map"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.js.map"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.min.js.map"></script>

    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.rtl.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.rtl.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.rtl.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-utilities.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.rtl.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.rtl.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.rtl.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css.map">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">

    <script type="text/javascript" src="js/bli/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/bli/jquery.blockUI.js"></script>
    <script type="text/javascript" src="js/bli/bootbox.min.js"></script>


    <!-- SCRIPTS-->
    <script type="text/javascript" src="js/eventos.js"></script>



    <title>CRM Actualiza domicilios L y M</title>
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-light" id="barra_navegacion">
        <div class="container-fluid col-lg-12 col-md-12">

            <img src="css/images/logo_coppel_2.png" class="col-lg-2 col-md-2" alt="img_logo_coppel" id="logo_img">

            <div class="col-lg-6 col-md-5">
                    <h5 class="text-white">Campaña Actualización Clientes L y M</h5>
            </div>

            <div class="col-lg-6 col-md-6 navbar-nav">
                <h5 class="text-white texto_barra_navegacion col-lg-1 col-md-3">90110787</h5>
                <h5 class="text-white texto_barra_navegacion col-lg-3 col-md-3">Leslie Janeth Peraza Franco</h5>
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

    <form id="formCaptura" method="post" class= "needs-validation" novalidate>

        <div class="row container-fluid mt-3">

        <div class="text-center mt-3 container-fluid" id="Encabezados"><h4 class="text-white">CAPTURA</h4></div><br><br>


        <div class="col-3">

            <div id="E">
                <label for="sestado"><strong> Estado: </strong></label>
                <input type="text" name="sestado" class="form-control sestado inputEstado" placeholder="Escriba el estado" id="sestado" required>

                <div class="invalid-feedback">Por favor ingrese el estado</div>
            </div>
            <br>

            <div id="M">
                <label for="municipio"><strong> Delegación/Municipio: </strong></label>
                <input type="text" name="municipio" class="form-control inputMunicipio" placeholder="Escriba la delegación o municipio" id="municipio" required>

                <div class="invalid-feedback">Por favor ingrese el municipio</div>
            </div>
            <br>

            <div id="C">
                <label for="colonia"><strong> Colonia: </strong></label>
                <input type="text" name="colonia" class="form-control inputColonia" placeholder="Escribe la colonia" id="colonia" required>
                <div class="invalid-feedback">
                    Por favor introduce la colonia
                </div>
            </div>
        </div>

        <div class="col-3">

            <div id= 'Ca'>
                <label for="calle"><strong> Calle: </strong></label>
                <input type="text" name="calle" class="form-control inputCalle" placeholder="Escriba la calle" id="calle" required>
                <div class="invalid-feedback">
                    Por favor introduce la calle
                </div>
            </div>
            <br>

            <label for=""><strong> Entre calles: </strong></label>
            <input type="text" class="form-control" placeholder="Escriba las entre calles del domicilio" id="entreCalles">
            <br>

            <label for=""><strong> Código postal: </strong></label>
            <input type="number" class="form-control" maxlength = "5" placeholder="Escribe el código postal" oninput="maxlengthNumber(this);" id="codigoPostal">

        </div>

        <div class="col-3">

        <div id="NI">
            <label for="numInterior"><strong> # Interior: </strong></label>
            <input type="text" name="nameNumInterior" class="form-control" placeholder="Escriba el número interior del domicilio" id="numInterior" required>
            <div class="invalid-feedback">
                Por favor introduce el número interior
            </div>
        </div>
        <br>

            <label for="numExterior"><strong> # Exterior: </strong></label>
            <input type="text" name="numExterior" class="form-control inputExterior" placeholder="Escriba el número exterior del domicilio" id="numExterior"><br>

            <label for=""><strong> Edificio: </strong></label>
            <input type="text" class="form-control" placeholder="Escriba el edificio" id="edificio">
        </div>

        <div class="col-3">

            <div id="Co">
                <label for="complemento"><strong> Complemento: </strong></label>
                <input type="text" name="complemento" class="form-control inputComplemento" placeholder="Escriba información complementaria" id="complemento" required>
                <div class="invalid-feedback">
                    Por favor introduce un complemento
                </div>
            </div>
            <br>

            <label for=""><strong> Teléfono adicional: </strong></label>
            <input type="number" class="form-control"  maxlength = "10" placeholder="Escriba un teléfono adicional" oninput="maxlengthTelephone(this);" id="telefonoAdicional"><br>

            <label for=""><strong> Tipo de teléfono adicional: </strong></label>
            <select class="form-select" name="" id="tipoTel">
                <option value="">Selecciona un tipo de teléfono</option>
                <option value="casa">Casa</option>
                <option value="celular">Celular</option>
            </select>
        </div>

        </div>

        <div class="container">
            <div class="row col-lg-12">

                <div class="col-lg-4">
                    <label for=""><strong> Quién contestó: </strong></label>
                    <select class="form-select" name="" id="quienContesto" required>
                        <option selected disabled value="">Selecciona quién contestó</option>
                        <option value="">CLIENTE</option>
                        <option value="">CONYUGE O PADRES</option>
                        <option value="">OTRO FAMILIAR</option>
                        <option value="">MENOR DE EDAD</option>
                        <option value="">NO SE IDENTIFICA</option>

                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona quién contestó la llamada
                    </div>
                </div>

                <div class="col-lg-4" >
                    <label for="finesGestion"><strong> Resultado de la llamada: </strong></label>
                    <select class="form-select" name="" id="finesGestion" required>

                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona un fin de gestión
                    </div>
                </div>

                <div class="col-lg-4">
                    <button class="btn text-white" type="submit" id="Finalizar">Finalizar</button>
                </div>

            </div>

        </div>



    </form>

    <br><br>

    <script>
        //Funciones de validacion en campos
        const maxlengthNumber = (obj) =>{
            console.log(obj.value);

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }

        const maxlengthTelephone = (obj)=> {
            console.log(obj.value);

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }

    </script>


    </section>


    <footer class="mt-5">

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>




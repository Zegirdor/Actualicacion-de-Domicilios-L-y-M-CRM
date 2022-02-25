var Inicia = function(){

    //Obtener la fecha actual
    let fecha = new Date();
    fecha = fecha.toISOString().split('T')[0];

    //Obtener número de cliente, número de teléfono y el id agente
    const variables = window.location.search;
    const ulrValores = new URLSearchParams(variables);

    //let numeroCliente   = ulrValores.get('clienteid');
    //let numeroTelefono  = ulrValores.get('answernumber');
    let idAgente        = ulrValores.get('username');
    let participanteId  = ulrValores.get('participanteId');


    console.log("Bienvenido has entrado al archivo js");


    const validaFormulario = () =>{

        debugger
        //Cuando el fin de gestión sea DOMICILIO CAPTURADO, validar los campos obligatorios
        if(selectFin.selectedIndex === 1){

               //Utilizando jQuery
               $("#sestado").prop("required");
               $("#municipio").prop("required");
               $("#colonia").prop("required");
               $("#calle").prop("required");
               $("#complemento").prop("required");

            (function() {
                'use strict';
                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                          console.log(form.checkValidity());
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      //Punto clave: si las condiciones se cumplieron, se registra la información del formulario
                      if(form.checkValidity() === true){
                        //form.classList.add('was-validated');
                        //finalizarLlamada();
                    }
                      form.classList.add('was-validated');
                    }, false);
                  });
              })();

              return;
        }

        //Cuando no se seleccione el QUIÉN CONTESTÓ o el RESULTADO DE LA LLAMADA
        if(selectFin.selectedIndex > 1 || selectContesto.selectedIndex === 0){
            console.log("Tienes que elegir un fin de gestion o quién contestó");

            //Utilizando jQuery
            $("#sestado").removeAttr("required");
            $("#municipio").removeAttr("required");
            $("#colonia").removeAttr("required");
            $("#calle").removeAttr("required");
            $("#complemento").removeAttr("required");

            (function() {
                'use strict';

                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      //Punto clave: si las condiciones se cumplieron, se registra la información del formulario
                      if(form.checkValidity() === true){
                        //form.classList.add('was-validated');
                        //finalizarLlamada();
                    }
                      form.classList.add('was-validated');
                    }, false);
                  });
              })();

             return;
        }
    }


    //Utilizado Arrow Function

    //Función que nos llena el CRM con los datos de cliente
    const llenaCRM = () =>{

        let informacion_Cliente = document.getElementById("Informacion_Cliente");
        let informacion_Credito = document.getElementById("Informacion_Credito");
        let informacionClienteHTML;
        let informacionCreditoHTML;

        /*Genesys Cloud nos proporciona en el campo Número de Cliente y en Número de teléfono los datos necesarios para obtener la información de nuestro cliente.
        Obtener estos campos:*/

        let numeroCliente = 201817039;
        let numeroTelefono = 6461011719;

        console.log(numeroCliente);
        console.log(numeroTelefono);

        /* Ajax */

        let parametros =    "opc=llenaCRM"   +
        "&numeroCliente="   + numeroCliente  +
        "&numeroTelefono="  + numeroTelefono +
        "&id="              + Math.random();
        $.ajax({
            type: 'POST',
            url:  'php/funciones.php',
            data: parametros,
            dataType: 'json',
            success: function(response){

                //Llenando apartado del CRM: INFORMACIÓN DEL CLIENTE

                for(let i = 0; i < response.arrayCliente.length; i++){

                    console.log("xd");
                    informacionClienteHTML = `
                    <div class="text-center mt-3 row container-fluid" id="Encabezados"><h4 class="text-white">INFORMACIÓN DEL CLIENTE</h4></div><br>

                    <div class="row container-fluid"> <label><strong> Fecha de Captura: <span class="input-group-text col-1" id="fechaCaptura">${fecha}</span></strong></label></div><br>

                    <div class="row container-fluid" >

                    <div class="col-4">
                        <label for=""><strong> Número de Cliente: </strong></label>
                        <span class="input-group-text" id="numeroCliente">201817039</span><br>
                        <label for=""><strong> Fecha de Nacimiento: </strong></label>
                        <span class="input-group-text" id="fechaNacimiento">${response.arrayCliente[i]['fechaNacimiento']}</span><br>
                    </div>

                    <div class="col-4">
                        <label for=""><strong> Nombre del Cliente: </strong></label>
                        <span class="input-group-text" id="nombreCliente">${response.arrayCliente[i]['nombreCliente']}</span><br>

                        <div class="row">
                            <div class="col-6">
                                <label for=""><strong> Sexo: </strong></label>
                                <span class="input-group-text" id="sexo">${response.arrayCliente[i]['sexo']}</span><br>
                            </div>

                            <div class="col-6">
                                <label for=""><strong> Estado Civil: </strong></label>
                                <span class="input-group-text" id="sestadoCivil">${response.arrayCliente[i]['sestadoCivil']}</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for=""><strong> Tipo teléfono: </strong></label>
                        <span class="input-group-text" id="tipotelefono">${response.arrayCliente[i]['tipotelefono']}</span><br>
                        <label for=""><strong> Número de teléfono: </strong></label>
                        <span class="input-group-text" id="numeroTelefono">6461011719</span><br>
                    </div><br>

                </div><br>

                <div class="row position-relative">
                    <div class="col-6 position-absolute start-50 translate-middle">
                        <label for=""><strong> Domicilio: </strong></label>
                        <span class="input-group-text" id="domicilio">${response.arrayCliente[i]['domicilio']}</span><br>
                    </div>
                </div>

                `;

                informacion_Cliente.innerHTML = informacionClienteHTML;


                //Llenando apartado del CRM: INFORMACIÓN DEL CRÉDITO

                informacionCreditoHTML = `

                <div class="row container-fluid">

                    <div class="text-center mt-3 container-fluid" id="Encabezados"><h4 class="text-white">INFORMACIÓN DEL CRÉDITO</h4></div><br><br>

                    <div class="row mt-1">
                        <div class="col-4">
                            <label for=""><strong> Puntualidad: </strong></label>
                            <span class="input-group-text" id="puntualidad">${response.arrayCliente[i]['puntualidad']}</span>
                        </div>

                        <div class="col-4 ">
                            <label for=""><strong> Situación especial: </strong></label>
                            <span class="input-group-text" id="situacionEspecial">${response.arrayCliente[i]['situacionEspecial']}</span>
                        </div>

                        <div class="col-4 ">
                            <label for=""><strong> Vencido: </strong></label>
                            <span class="input-group-text" id="vencido">${response.arrayCliente[i]['vencido']}</span>
                        </div>

                    </div>

                </div>

                `;

                informacion_Credito.innerHTML =  informacionCreditoHTML;
                //Llenando apartado del CRM: CAPTURA

                //Ingresamos la información recopilada hasta el momento del cliente. Utilizando JavaScript
                let sestado = document.getElementById('sestado');
                sestado.value = response.arrayCliente[i]['sestado'];

                let municipio = document.getElementById('municipio');
                municipio.value = response.arrayCliente[i]['municipio'];

                let colonia = document.getElementById('colonia');
                colonia.value = response.arrayCliente[i]['colonia'];

                let calle = document.getElementById('calle');
                calle.value = response.arrayCliente[i]['calle'];

                let entreCalles = document.getElementById('entreCalles');
                entreCalles.value = response.arrayCliente[i]['entreCalles'];

                let codigoPostal = document.getElementById('codigoPostal');
                codigoPostal.value = response.arrayCliente[i]['codigoPostal'];

                let numInterior = document.getElementById('numInterior');
                numInterior.value = response.arrayCliente[i]['numInterior'];

                let numExterior = document.getElementById('numExterior');
                numExterior.value = response.arrayCliente[i]['numExterior'];

                let edificio = document.getElementById('edificio');
                edificio.value = response.arrayCliente[i]['edificio'];

                let complemento = document.getElementById('complemento');
                complemento.value = response.arrayCliente[i]['complemento'];

                let telefonoAdicional = document.getElementById('telefonoAdicional');
                telefonoAdicional.value = response.arrayCliente[i]['telefonoAdicional'];

                }

            },
            error: function(xhr){
                console.log(xhr.responseText)
              }
        })

        console.log(numeroCliente);


    }

    //Función que despliega los fines de gestión de la campaña.
    const mostrarFinesGestion = () => {

        //Obtener id del select del combo
        let finesGestion = document.getElementById("finesGestion");
        console.log(finesGestion);
        let finesGestionHTML;

        //Despliegue de los fines de gestión

            /*Ajax*/

            let parametros =    "opc=mostrarFinesGestion" +
            "&id=" + Math.random();
            $.ajax({
                type:'POST',
                url:'php/funciones.php',
                data:parametros,
                dataType:'json',
                success: function(response){
                    console.log(response.sestado)

                    //Utilizando Template String e interpolación

                    finesGestionHTML = `
                    <option selected disabled value=""> Selecciona un resultado de llamada </option>
                    `

                    for(let i = 0; i < response.arrayCombo.length; i++){
                    finesGestionHTML +=
                        `
                            <option value="${response.arrayCombo[i]['descripcion']}" id="finGestion">${response.arrayCombo[i]['descripcion']}</option>
                    `};

                    finesGestion.innerHTML = finesGestionHTML;

                },
                error: function(xhr){
                    console.log(xhr.responseText)
                  }
            })

    }

    /* === PARA LOS COMBOS TIPO TELEFONO ADICIONAL, QUIEN CONTESTO Y RESULTADO DE LA LLAMADA === */
    //Función que nos indica el resultado de la llamada que el ejecutivo seleccione
    var selectFin = document.getElementById('finesGestion');
    selectFin.addEventListener('change',
    function(){
        let selectedFinGestion = this.options[selectFin.selectedIndex];
        console.log(selectedFinGestion + ': ' + selectedFinGestion.text);
    });

    //Función que nos indica el quién contestó la llamada que el ejecutivo seleccione
    var selectContesto = document.getElementById('quienContesto');
    selectContesto.addEventListener('change',
    function(){
        let selectedQuienContesto = this.options[selectContesto.selectedIndex];
        console.log(selectedQuienContesto + ': ' + selectedQuienContesto.text);
    });

    //Función que nos indica el quién contestó la llamada que el ejecutivo seleccione
    var selectTipoT = document.getElementById('tipoTel');
    selectTipoT.addEventListener('change',
    function(){
        let selectedTipoTel = this.options[selectTipoT.selectedIndex];
        console.log(selectedTipoTel + ': ' + selectedTipoTel.text);
    })



    /*-----------------------------------------------------------------------------------------------*/

    //Botón finalizar
    const finalizarLlamada = () =>{
        debugger

        //alert("El registro se guardó correctamente");
        console.log(selectTipoT.selectedIndex );


        //Obtener todos los campos

       // - INFORMACION DEL CLIENTE
       let  numeroCliente       = document.getElementById("numeroCliente").innerText;
            nombreCliente       = document.getElementById("nombreCliente").innerText;
            fechaNacimiento     = document.getElementById("fechaNacimiento").innerText;
            sexo                = document.getElementById("sexo").innerText;
            sestadoCivil        = document.getElementById("sestadoCivil").innerText;
            tipotelefono        = document.getElementById("tipotelefono").innerText;
            numeroTelefono      = document.getElementById("numeroTelefono").innerText;
            domicilio           = document.getElementById("domicilio").innerText;
            puntualidad         = document.getElementById("puntualidad").innerText;
            situacionEspecial   = document.getElementById("situacionEspecial").innerText;
            vencido             = document.getElementById("vencido").innerText;
        // - INFORMACION DEL CREDITO
            puntualidad         = document.getElementById("puntualidad");
            situacionEspecial   = document.getElementById("situacionEspecial");
            vencido             = document.getElementById("vencido");

                let parametros =             "opc=finalizarCRM"                       +
                "&fecha="                   +   fecha                                 +
                "&numeroCliente="           +   numeroCliente                         +
                "&nombreCliente="           +   nombreCliente                         +
                "&numeroTelefono="          +   numeroTelefono                        +
                "&fechaNacimiento="         +   fechaNacimiento                       +
                "&sexo="                    +   sexo                                  +
                "&sestadoCivil="            +   sestadoCivil                          +
                "&tipotelefono="            +   tipotelefono                          +
                "&domicilio="               +   domicilio                             +
                "&puntualidad="             +   puntualidad                           +
                "&situacionEspecial="       +   situacionEspecial                     +
                "&vencido="                 +   vencido                               +
                "&sestado="                 +   sestado.value                         +
                "&municipio="               +   municipio.value                       +
                "&colonia="                 +   colonia.value                         +
                "&calle="                   +   calle.value                           +
                "&entreCalles="             +   entreCalles.value                     +
                "&codigoPostal="            +   codigoPostal.value                    +
                "&numInterior="             +   numInterior.value                     +
                "&numExterior="             +   numExterior.value                     +
                "&edificio="                +   edificio.value                        +
                "&complemento="             +   complemento.value                     +
                "&telefonoAdicional="       +   telefonoAdicional.value               +
                "&tipoTelefonoAdicional="   +   selectTipoT.selectedIndex             +
                "&quienContesto="           +   selectContesto.selectedIndex          +
                "&id="                      +   Math.random();
                $.ajax({
                    type: 'POST',
                    url:  'php/funciones.php',
                    data: parametros,
                    dataType: 'json',
                    success: function(response){
                        console.log(response.mensaje);
                    },
                    error: function(xhr){
                        console.log(xhr.responseText)
                    }
                })

    }

    //Invocamos las funciones
    llenaCRM();
    mostrarFinesGestion();
    //Evento al botón de Finalizar

    let btnFinalizar = document.getElementById("Finalizar");
    btnFinalizar.addEventListener("click", finalizarLlamada, false);

}


document.addEventListener('DOMContentLoaded', Inicia, false);



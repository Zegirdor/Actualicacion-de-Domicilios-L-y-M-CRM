var Inicia = function(){

    //Obtener la fecha actual, la hora, minutos y segundos
    var fecha = new Date();   
    var hora = fecha.getHours();
    var minuto = fecha.getMinutes();
    var segundo = fecha.getSeconds();

    fecha = fecha.toISOString().split('T')[0];
    //var fec_horainicio =  fecha + " " +  hora + ":" + minuto + ":" + segundo;
    //console.log(fec_horainicio);


    

    //Obtener los parámetros de la URL
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

 

    function validaFormulario (){
       
        //El Quién Contestó y el Fin de gestión son obligatorios. Realizamos validación para obligar al usuario a seleccionarlos al Finalizar la Llamada
        if(selectFin.selectedIndex == 0 ){

            $("#sestado").removeAttr("required");
            $("#municipio").removeAttr("required");
            $("#colonia").removeAttr("required");
            $("#calle").removeAttr("required");
            $("#complemento").removeAttr("required");

            if(selectContesto.selectedIndex > 0){ $("#quienContesto").removeAttr("required");}
            //Utilizando jQuery



            (function() {
                'use strict';

                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() == false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
              })();

        }

        if(selectContesto.selectedIndex == 0){

            $("#sestado").removeAttr("required");
            $("#municipio").removeAttr("required");
            $("#colonia").removeAttr("required");
            $("#calle").removeAttr("required");
            $("#complemento").removeAttr("required");


            if(selectFin.selectedIndex > 0){ $("#finesGestion").removeAttr("required");}
            //Utilizando jQuery
            //$("#quienContesto").prop("required");

            (function() {
                'use strict';

                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() == false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
              })();
        }



        if(selectFin.selectedIndex > 1 && selectContesto.selectedIndex > 0){


            //("Tienes que elegir un fin de gestion o quién contestó");
            //(selectContesto.selectedIndex);

            //Utilizando jQuery
            $("#sestado").removeAttr("required");
            $("#municipio").removeAttr("required");
            $("#colonia").removeAttr("required");
            $("#calle").removeAttr("required");
            $("#complemento").removeAttr("required");
            $("#finesGestion").removeAttr("required");
            $("#quienContesto").removeAttr("required");

            (function() {
                'use strict';

                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() == false) {
                            event.preventDefault();
                            event.stopPropagation();
                          }

                        if (form.checkValidity() == true) {

                            finalizarLlamada();
                            return;
                          }
                          form.classList.add('was-validated');
                    }, false);
                  });
              })();

             return;
        }

         //Cuando el fin de gestión sea DOMICILIO CAPTURADO, validar los campos obligatorios
         if(selectFin.selectedIndex == 1){


               //Utilizando jQuery
               $("#sestado").prop('required', true);
               $("#municipio").prop('required', true);
               $("#colonia").prop('required', true);
               $("#calle").prop('required', true);
               $("#complemento").prop('required', true);
               $("#finesGestion").prop('required', false);
               if(selectContesto.selectedIndex > 0){ $("#quienContesto").prop('required', false);}

            (function() {
                'use strict';
                  var forms = document.getElementsByClassName('needs-validation');

                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() == false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }

                      if (form.checkValidity() == true) {

                        finalizarLlamada();
                        return;
                      }

                      form.classList.add('was-validated');
                    }, false);
                  });
              })();

              return;
        }


    }

    //Función para llenar la información del empleado que está en llamada
    function infoAgente(){
        let numeroAgenteURL = getParameterByName('ejecutivo');
        let informacionAgenteHTML;

        /* Ajax */
        let parametros      = "opc=llenaInfoAgente" +
        "&numeroAgente="    + numeroAgenteURL       +
        "&id=" + Math.random();
        $.ajax({
            type: 'POST',
            url:  'php/funciones.php',
            data:  parametros,
            dataType: 'json',
            success: function(response){

                //Llenar en la barra de negación la sección de la información del agente en llamada
                informacionAgenteHTML   =  '<label class="text-white texto_barra_navegacion col-lg-2 col-md-2" id="numeroAgente">' + numeroAgenteURL + '</label>'
                                        +  '<label class="text-white texto_barra_navegacion col-lg-5 col-md-3" id="nombreAgente">' + response.arrayAgente[0]['nombreAgente'] + '</label>';

                document.getElementById("info_agente").innerHTML = informacionAgenteHTML;

            },
            error: function(xhr){
                (xhr.responseText)
              }
        })
    }

    //Función que nos llena el CRM con los datos de cliente
    function llenaCRM(){

        //numeroCliente =   327620412,
        //  telefonoCliente = 6671361288;
        let numeroCliente = getParameterByName('num_cliente');
        let telefonoCliente = getParameterByName('telefono_contactado');

        let informacionClienteHTML;
        let informacionCreditoHTML;

        /* Ajax */

        let parametros =    "opc=llenaCRM"       +
        "&numeroCliente="    + numeroCliente     +
        "&telefonoCliente="  + telefonoCliente   +
        "&id=" + Math.random();
        $.ajax({
            type: 'POST',
            url:  'php/funciones.php',
            data: parametros,
            dataType: 'json',
            success: function(response){

                //Llenando apartado del CRM: INFORMACIÓN DEL CLIENTE


                    informacionClienteHTML = '<div class="text-center mt-3 container-fluid" id="Encabezados"><h4 class="text-white">INFORMACIÓN DE CLIENTE</h4></div><br>'

                     + '<div class="row container-fluid"> <label><strong> Fecha de Captura: <span class="input-group-text col-1" id="fechaCaptura">' + fecha + '</span></strong></label></div><br>'

                     + '<div class="row" >'

                     + '<div class="col-4">'
                     + '<label for=""><strong> Número de Cliente: </strong></label>'
                     + '<span class="input-group-text" id="numeroCliente">' + numeroCliente + '</span><br>'
                     + '<label for=""><strong> Fecha de Nacimiento: </strong></label>'
                     + '<span class="input-group-text" id="fechaNacimiento">' + response.arrayCliente[0].fechaNacimiento + '</span><br>'
                     + '</div>'

                     + '<div class="col-4">'
                     + '<label for=""><strong> Nombre del Cliente: </strong></label>'
                     + '<span class="input-group-text" id="nombreCliente">' + response.arrayCliente[0].nombreCliente + '</span><br>'

                     + '<div class="row">'
                     + '<div class="col-6">'
                     + '<label for=""><strong> Sexo: </strong></label>'
                     + '<span class="input-group-text" id="sexo">' + response.arrayCliente[0].sexo + '</span><br>'
                     + '</div>'

                     + '<div class="col-6">'
                     + '<label for=""><strong> Estado Civil: </strong></label>'
                     + '<span class="input-group-text" id="sestadoCivil">' + response.arrayCliente[0].sestadoCivil + '</span><br>'
                     + '</div>'
                     + '</div>'
                     + '</div>'

                     + '<div class="col-4">'
                         + '<label for=""><strong> Tipo teléfono: </strong></label>'
                         + '<span class="input-group-text" id="tipotelefono">' + response.arrayCliente[0].tipotelefono + '</span><br>'
                         + '<label for=""><strong> Número de teléfono: </strong></label>'
                         + '<span class="input-group-text" id="numeroTelefono">' + telefonoCliente + '</span><br>'
                     + '</div><br>'

                 + '</div><br>'

                + '<div class="row position-relative">'
                     + '<div class="col-6 position-absolute start-50 translate-middle">'
                         + '<label for=""><strong> Domicilio: </strong></label>'
                         + '<span class="input-group-text" id="domicilio">' + response.arrayCliente[0].domicilio + '</span><br>'
                     + '</div>'
                 + '</div>';


                //informacion_Cliente.innerHTML = informacionClienteHTML;
                document.getElementById("Informacion_Cliente").innerHTML = informacionClienteHTML;

                //Llenando apartado del CRM: INFORMACIÓN DEL CRÉDITO

                informacionCreditoHTML += '<div class="row">'

                    + '<div class="text-center mt-3 container-fluid" id="Encabezados"><h4 class="text-white">INFORMACIÓN DEL CRÉDITO</h4></div><br><br>'

                        + '<div class="col-4">'
                            + '<label for=""><strong> Puntualidad: </strong></label>'
                            + '<span class="input-group-text" id="puntualidad">' + response.arrayCliente[0].puntualidad + '</span>'
                        + '</div>'

                        + '<div class="col-4 ">'
                            + '<label for=""><strong> Situación especial: </strong></label>'
                            + '<span class="input-group-text" id="situacionEspecial">' + response.arrayCliente[0].situacionEspecial + '</span>'
                        + '</div>'

                        + '<div class="col-4 ">'
                            + '<label for=""><strong> Vencido: </strong></label>'
                            + '<span class="input-group-text" id="vencido">' + response.arrayCliente[0].vencido + '</span>'
                        + '</div>'



                + '</div>'

                //informacion_Credito.innerHTML =  informacionCreditoHTML;
                document.getElementById("Informacion_Credito").innerHTML = informacionCreditoHTML;
                //Llenando apartado del CRM: CAPTURA

                // //Ingresamos la información recopilada hasta el momento del cliente. Utilizando JavaScript
                // let sestado = document.getElementById('sestado');
                // sestado.value = response.arrayCliente[0].sestado;

                // let municipio = document.getElementById('municipio');
                // municipio.value = response.arrayCliente[0].municipio;

                // let colonia = document.getElementById('colonia');
                // colonia.value = response.arrayCliente[0].colonia;

                // let calle = document.getElementById('calle');
                // calle.value = response.arrayCliente[0].calle;

                // let entreCalles = document.getElementById('entreCalles');
                // entreCalles.value = response.arrayCliente[0].entreCalles;

                // let codigoPostal = document.getElementById('codigoPostal');
                // codigoPostal.value = response.arrayCliente[0].codigoPostal;

                // let numInterior = document.getElementById('numInterior');
                // numInterior.value = response.arrayCliente[0].numInterior;

                // let numExterior = document.getElementById('numExterior');
                // numExterior.value = response.arrayCliente[0].numExterior;

                // let edificio = document.getElementById('edificio');
                // edificio.value = response.arrayCliente[0].edificio;

                // let complemento = document.getElementById('complemento');
                // complemento.value = response.arrayCliente[0].complemento;

                // let telefonoAdicional = document.getElementById('telefonoAdicional');
                // telefonoAdicional.value = response.arrayCliente[0].telefonoAdicional;


                

                // let quienContesto = document.getElementById('quienContesto');

                // for(let i = 0; i < quienContesto.length; i++){
                //     if(quienContesto[i].value == response.arrayCliente[0].quienContesto){
                //         quienContesto.selectedIndex = response.arrayCliente[0].quienContesto
                //     }
                // }


            },
            error: function(xhr){
                alert(xhr.responseText);
              }
        })




    }

    //Función que despliega los fines de gestión de la campaña.
    function mostrarFinesGestion(){

        //Obtener id del select del combo
        let finesGestion = document.getElementById("finesGestion");
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

                    //Utilizando Template String e interpolación

                    finesGestionHTML += '<option selected disabled value=""> Selecciona un resultado de llamada </option>'

                    for(let i = 0; i < response.arrayCombo.length; i++){

                        finesGestionHTML += '<option value="" id="finGestion">' + response.arrayCombo[i]['descripcion'] + '</option>'
                    };

                    finesGestion.innerHTML = finesGestionHTML;

                },
                error: function(xhr){
                    //(xhr.responseText)
                  }
            })

    }
    

    /*-----------------------------------------------------------------------------------------------*/

    //Quitar acentos y tildes

    function simbolosRaros(campos){


        for(let i = 0; i < campos.length; i ++){

                //(campos[i]);
                campos[i] = campos[i].replace(/\Ñ/g, "#");
                campos[i] = campos[i].replace(/\Á/g, "A");
                campos[i] = campos[i].replace(/\É/g, "E");
                campos[i] = campos[i].replace(/\Í/g, "I");
                campos[i] = campos[i].replace(/\Ó/g, "O");
                campos[i] = campos[i].replace(/\Ú/g, "U");

        }

      }

    //Botón finalizar
    function finalizarLlamada(){

        //Gurdamos el valor de estos campos en variables, para aplicarles un método que nos va a limpiar de acentos y ñ
        let sestado                 = $("#sestado").val(),
            municipio               = $("#municipio").val(),
            colonia                 = $("#colonia").val(),
            calle                   = $("#calle").val(),
            entreCalles             = $("#entreCalles").val(),
            numInterior             = $("#numInterior").val(),
            numExterior             = $("#numExterior").val(),
            edificio                = $("#edificio").val(),
            complemento             = $("#complemento").val(),
            codigoPostal            = $("#codigoPostal").val(),
            telefonoAdicional       = $("#telefonoAdicional").val(),
            numeroAgente            = document.getElementById('numeroAgente').textContent;
            nombreAgente            = document.getElementById('nombreAgente').textContent;
            //numeroAgente            = $('#numeroAgente').value;
            //nombreAgente            = $('#nombreAgente').html();

        let fec_horainicio = $("#horainicio").val();
       


        // Creamos un arreglo para quitar las Ñ y los acentos
        var camposCRM = [sestado, municipio, colonia, calle, entreCalles, numInterior, numExterior, edificio, complemento];
        //Llamamos al método para eliminar acentos y Ñ, mandamos como parámetro nuestro arreglo
        simbolosRaros(camposCRM);

        //Obtener todos los campos

       // - INFORMACION DEL CLIENTE
       let  numeroCliente       = document.getElementById("numeroCliente").innerText,
            nombreCliente       = document.getElementById("nombreCliente").innerText,
            fechaNacimiento     = document.getElementById("fechaNacimiento").innerText,
            sexo                = document.getElementById("sexo").innerText,
            sestadoCivil        = document.getElementById("sestadoCivil").innerText,
            tipotelefono        = document.getElementById("tipotelefono").innerText,
            numeroTelefono      = document.getElementById("numeroTelefono").innerText,
            domicilio           = document.getElementById("domicilio").innerText;
            //nombreAgente        = document.getElementById('nombreAgente').textContent;



        // - INFORMACION DEL CREDITO
        let puntualidad         = document.getElementById("puntualidad").innerText,
            situacionEspecial   = document.getElementById("situacionEspecial").innerText,
            vencido             = document.getElementById("vencido").innerText;

                let parametros =             "opc=finalizarCRM"                       +
                "&numeroAgente="            +   numeroAgente                          +
                "&nombreAgente="            +   nombreAgente                          +
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
                "&sestado="                 +   camposCRM[0]                          +
                "&municipio="               +   camposCRM[1]                          +
                "&colonia="                 +   camposCRM[2]                          +
                "&calle="                   +   camposCRM[3]                          +
                "&entreCalles="             +   camposCRM[4]                          +
                "&codigoPostal="            +   codigoPostal                          +
                "&numInterior="             +   camposCRM[5]                          +
                "&numExterior="             +   camposCRM[6]                          +
                "&edificio="                +   camposCRM[7]                          +
                "&complemento="             +   camposCRM[8]                          +
                "&telefonoAdicional="       +   telefonoAdicional                     +
                "&tipoTelefonoAdicional="   +   selectTipoT.value                     +
                "&quienContesto="           +   selectContesto.selectedIndex          +
                "&resultadoLlamada="        +   selectFin.selectedIndex               +
                "&horainicio="              +   fec_horainicio                        +
                "&id="                      +   Math.random();
                $.ajax({
                    cache: false,
                    async: false,
                    //timeout: 5000,
                    url: 'php/funciones.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: parametros,
                    success: function(response){

                    },
                    complete:function(){
                        
                        
                        colgarLlamada();
                        //alert("xd");
                    },
                    error:function(xhr,status,error){
                        //$('#imgGuardaPreventiva').fadeOut(0);
                        alert(xhr.responseText);
                    }
            });


    }

    function obtenerIdLlamada(){

        let fines = document.getElementById('finesGestion');

            let infoFinGestion;
            let finGestionDescripcion = fines.options[fines.selectedIndex].text;
            console.log(finGestionDescripcion);
           

            //Realizamos una petición a nuestra BD, para saber qué id de fin de gestión le corresponde a la selección que hizo el usuario
            let parametros =       "opc=consultaIdFines"     +
            "&descripcion="     +  finGestionDescripcion     +
            "&id="              +  Math.random();
            $.ajax({
                cache: false,
                async: false,
                type: 'POST',
                url: 'php/funciones.php',
                dataType: 'JSON',
                data: parametros,
                success: function(response){
                
          
            

                //Lo pintamos en una parte de nuestro HTML para después tomarlo
                infoFinGestion = '<div hidden id="fg">' + response.arrayDescripcion[0]['id'] + '</div>';
                document.getElementById("idFinGestion").innerHTML = infoFinGestion;

                
                //alert(pruebaFin);
                //alert(pruebaFin2);

                },
                complete:function(){
                
                },
                error:function(xhr,status,error){
                    //$('#imgGuardaPreventiva').fadeOut(0);
                    alert(xhr.responseText);
                }
            });
    }


    
    var setCallResult = function (callResult) {
        var parameters = new Array();
        parameters['CallResult'] = callResult;
        return window.external.WorkspaceInvoke('SetCallResult', parameters);
    }

    var colgarLlamada = function(){

        let sdispositioncode = '0';
        
                
        obtenerIdLlamada();    
        
        let finGestion = document.getElementById("fg").innerHTML;
     

        if( finGestion < 10){
            sdispositioncode = '7'+ finGestion.toString();
        }else{
            sdispositioncode = '7'+ finGestion.toString();
        }

        try {
            ///Cambiar call result
            if (finGestion == 15) // NO RESPONDE
            {
                setCallResult('WRONG_NUMBER');
            }
            else if (finGestion == 13) // NO VIVE AHI
            {
                setCallResult('NO_DIAL_TONE');
            }
            else if (finGestion == 6) // EQUIVOCADO
            {
                setCallResult('SILENCE');
            }
            else if (finGestion == 9) // OCUPADO
            {
                setCallResult('WRONG_PARTY');
            }
            else if (finGestion == 8) //BUZON DE VOZ
            {
                setCallResult('ANSWERING_MACHINE');
            }
            else if (finGestion == 11) //CELULAR NO DISPONIBLE
            {
                setCallResult('PICKDUP');
            }
            setDispositionCodeGenesys(sdispositioncode);
        } catch (error) {
            setDispositionCodeGenesys("00");
        }

        setDispositionCodeGenesys(sdispositioncode);
        release(true,true);
        lblLlamando();
 
    }



    var markDone = function(){
        var parameters = new Array();
        return window.external.WorkspaceInvoke('MarkDone',parameters);
        return;
    }

    var release = function(markDone,agentReady){
        var parameters = new Array();
        parameters['MarkDone'] = markDone;
        parameters['AgentReady'] = agentReady;
        return window.external.WorkspaceInvoke('Release',parameters);
        return;
    }

    var setAgentReady = function(){
        var parameters = new Array();
        return window.external.WorkspaceInvoke('AgentReady',parameters);
        return;
    }
    var setDispositionCodeGenesys = function(dispositionCode){
        var parameters = new Array();
        //parameters['dispositionCode'] = document.getElementById('dispositionCode').value;
        parameters['dispositionCode'] = dispositionCode;
        return window.external.WorkspaceInvoke('SetDispositionCode',parameters);
        return;
    }

    var lblLlamando = function(){
    var htmlBarraEspLLamada='';
    htmlBarraEspLLamada+='<ul style="font-size:2.5em;text-align:center;" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">';
        htmlBarraEspLLamada+='Esperando llamada';
        htmlBarraEspLLamada+='<img style="width:25px;height:25px;margin-left:5px;" src="css/img/telefono-azul1.png">';
         htmlBarraEspLLamada+='<img style="width:2%;margin-left:5px;" src="css/img/3_puntos.gif">';
    htmlBarraEspLLamada+='</ul>';
    $("#contPrincipal").html(htmlBarraEspLLamada);
}

    /* === PARA LOS COMBOS TIPO TELEFONO ADICIONAL, QUIEN CONTESTO Y RESULTADO DE LA LLAMADA === */
    //Función que nos indica el resultado de la llamada que el ejecutivo seleccione
    
    var selectFin = document.getElementById('finesGestion');
    selectFin.addEventListener('change',
    function(){
        let selectedFinGestion = this.options[selectFin.selectedIndex];
    });

    //Función que nos indica el quién contestó la llamada que el ejecutivo seleccione
    var selectContesto = document.getElementById('quienContesto');
    selectContesto.addEventListener('change',
    function(){
        var selectedQuienContesto = this.options[selectContesto.selectedIndex];


    });

    //Función que nos indica el quién contestó la llamada que el ejecutivo seleccione
    var selectTipoT = document.getElementById('tipoTel');
    selectTipoT.addEventListener('change',
    function(){
        let selectedTipoTel = this.options[selectTipoT.selectedIndex];

    });

   
   
   

    //Invocamos las funciones
   
    infoAgente();
    llenaCRM();
    mostrarFinesGestion();

    

    //Evento al botón de Finalizar
    let btnFinalizar = document.getElementById("Finalizar");
    btnFinalizar.addEventListener("click", validaFormulario, false);
}

document.addEventListener('DOMContentLoaded', Inicia, false);


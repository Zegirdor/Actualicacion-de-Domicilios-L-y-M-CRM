var Inicia = function(){



    //Utilizado Arrow Function

    //Función que nos llena el CRM con los datos de cliente
    const llenaCRM = () =>{

        let informacion_Cliente = document.getElementById("Informacion_Cliente");
        let informacion_Credito = document.getElementById("Informacion_Credito");
        let informacionClienteHTML;
        let informacionCreditoHTML;
        let numeroCliente = 451330171;
        let numeroTelefono = 6461782655;

        /*Genesys Cloud nos proporciona en el campo Número de Cliente y en Número de teléfono los datos necesarios para obtener la información de nuestro cliente.
        Obtener estos campos:

        let numeroCliente  = document.getElementById("numeroCliente");
        let numeroTelefono = document.getElementById("numeroTelefono");
        */


        /* Ajax */

        let parametros =    "opc=llenaCRM"   +
        "&numeroCliente="   + numeroCliente  +
        "&id="              + Math.random();
        $.ajax({

            type: 'POST',
            url:  'php/funciones.php',
            data: parametros,
            dataType: 'json',
            success: function(response){

                //Llenando apartado del CRM: INFORMACIÓN DEL CLIENTE

                for(let i = 0; i < response.arrayCliente.length; i++){
                    informacionClienteHTML = `
                    <div class="text-center mt-3 row container-fluid" id="Encabezados"><h4 class="text-white">INFORMACIÓN DEL CLIENTE</h4></div><br>

                    <div class="row container-fluid"> <label><strong> Fecha de Captura: <span class="input-group-text col-1">18-02-2022</span></strong></label></div><br>

                    <div class="row container-fluid" >

                    <div class="col-4">
                        <label for=""><strong> Número de Cliente: </strong></label>
                        <span class="input-group-text" id="numeroCliente">451330171</span><br>
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
                                <span class="input-group-text" id="estadoCivil">${response.arrayCliente[i]['estadoCivil']}</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for=""><strong> Tipo teléfono: </strong></label>
                        <span class="input-group-text" id="tipotelefono">${response.arrayCliente[i]['tipotelefono']}</span><br>
                        <label for=""><strong> Número de teléfono: </strong></label>
                        <span class="input-group-text" id="numeroTelefono">6461782655</span><br>
                    </div><br>

                </div><br>

                <div class="row position-relative">
                    <div class="col-6 position-absolute start-50 translate-middle">
                        <label for=""><strong> Domicilio: </strong></label>
                        <span class="input-group-text" id="domicilio">${response.arrayCliente[i]['domicilio']}</span><br>
                    </div>
                </div>

                `;

                 //Llenando apartado del CRM: INFORMACIÓN DEL CRÉDITO


                }

                informacion_Cliente.innerHTML = informacionClienteHTML;





            },
            error: function(xhr){
                console.log(xhr.responseText)
              }
        })





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
                    console.log(response.estado)

                    //Utilizando Template String e interpolación

                    finesGestionHTML = `
                    <option value=""> Selecciona un resultado de llamada </option>
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

    //Función que guarda los datos capturados en el CRM
    const guardaCRM = () => {

       //Obtener todos los campos
        let numeroCliente      = document.getElementById("numeroCliente");
            fechaNacimiento     = document.getElementById("fechaNacimiento");
            sexo                = document.getElementById("sexo");
            estadoCivil         = document.getElementById("estadoCivil");
            tipotelefono        = document.getElementById("tipotelefono");
            numeroTelefono      = document.getElementById("numeroTelefono");
            domicilio           = document.getElementById("domicilio");
            puntualidad         = document.getElementById("puntualidad");
            situacionEspecial   = document.getElementById("situacionEspecial");
            vencido             = document.getElementById("vencido");
            numeroCliente       = document.getElementById("numeroCliente");
            //Obtener por jQuery la option seleccionada de Resultado de la Llamada


       console.log(numeroCliente);
       console.log(fechaNacimiento);
       console.log(sexo);
       console.log(estadoCivil);
       console.log(tipotelefono);
       console.log(numeroTelefono);
       console.log(domicilio);
       console.log(puntualidad);
       console.log(situacionEspecial);
       console.log(vencido);
       console.log(numeroCliente);

    }

    //Función que nos indica el resultado de la llamada que el ejecutivo seleccione
    var select = document.getElementById('finesGestion');
    select.addEventListener('change',
    function(){
        var selectedFinGestion = this.options[select.selectedIndex];
        console.log(selectedFinGestion + ': ' + selectedFinGestion.text);
    })



    //Invocamos las funciones
    llenaCRM();
    mostrarFinesGestion();
    guardaCRM();


}

document.addEventListener('DOMContentLoaded', Inicia, false);



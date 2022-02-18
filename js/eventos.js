var Inicia = function(){



    //Utilizado Arrow Function

    //Función que nos llena el CRM con los datos de cliente
    const llenaCRM = () =>{

        /*Genesys Cloud nos proporciona en el campo Número de Cliente y en Número de teléfono los datos necesarios para obtener la información de nuestro cliente.
        Obtener estos campos:*/
        let numeroCliente  = document.getElementById("numeroCliente");
        let numeroTelefono = document.getElementById("numeroTelefono");

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
        let numeroCliente      = document.getElementById("numeroCliente").innerText;
            fechaNacimiento     = document.getElementById("fechaNacimiento").innerText;
            sexo                = document.getElementById("sexo").innerText;
            estadoCivil         = document.getElementById("estadoCivil").innerText;
            tipotelefono        = document.getElementById("tipotelefono").innerText;
            numeroTelefono      = document.getElementById("numeroTelefono").innerText;
            domicilio           = document.getElementById("domicilio").innerText;
            puntualidad         = document.getElementById("puntualidad").innerText;
            situacionEspecial   = document.getElementById("situacionEspecial").innerText;
            vencido             = document.getElementById("vencido").innerText;
            numeroCliente       = document.getElementById("numeroCliente").innerText;
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



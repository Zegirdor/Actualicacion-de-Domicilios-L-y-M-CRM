var Inicia = function(){



    //Utilizado Arrow Function

    //Función que despliega los fines de gestión de la campaña.
    const  mostrarFinesGestion = () => {

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
        let numeroCliente      = document.getElementById("numeroCliente").innerHTML;
            fechaNacimiento     = document.getElementById("fechaNacimiento").innerHTML;
            sexo                = document.getElementById("sexo").innerHTML;
            estadoCivil         = document.getElementById("estadoCivil").innerHTML;
            tipotelefono        = document.getElementById("tipotelefono").innerHTML;
            numeroTelefono      = document.getElementById("numeroTelefono").innerHTML;
            domicilio           = document.getElementById("domicilio").innerHTML;
            puntualidad         = document.getElementById("puntualidad").innerHTML;
            situacionEspecial   = document.getElementById("situacionEspecial").innerHTML;
            vencido             = document.getElementById("vencido").innerHTML;
            numeroCliente       = document.getElementById("numeroCliente").innerHTML;
            //Obtener por jQuery la option seleccionada de Resultado de la Llamada
            finesGestion = $( "#finesGestion option:selected" ).text();


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
    mostrarFinesGestion();
    guardaCRM();

}

document.addEventListener('DOMContentLoaded', Inicia, false);



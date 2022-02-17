var Inicia = function(){

    //Utilizado Arrow Function
    const  mostrarFinesGestion = () => {

        //Obtener id del select del combo
        let finesGestion = document.getElementById("finesGestion");
        console.log(finesGestion);

        //Despliegue de los fines de gestiòn

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

                    for(let i = 0; i.response.arrayCombo.length; i++){
                    finesGestionHTML =
                        `
                            <option value="">${response.arrayCombo[i]['descripcion']}</option>
                    `};

                    finesGestion = finesGestionHTML.innerHTML;

                },
                error: function(xhr){
                    console.log(xhr.responseText)
                  }
            })




    }








    //Invocamos las funciones
    mostrarFinesGestion();
}

document.addEventListener('DOMContentLoaded', Inicia, false);



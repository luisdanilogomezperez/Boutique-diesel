$(document).ready(function(){

    $("#formIngresarAdministrador").validate({
    
        rules:
        {
            ingresarCorreoAdministrador:{required:true},
            ingresarContraseniaAdministrador:{required:true}
        },
        messages:
        {
            ingresarCorreoAdministrador:{required:'<p style="color:red;">✘</p>'},
            ingresarContraseniaAdministrador:{required:'<p style="color:red;">✘</p>'}
        },
        submitHandler:function(){
    
            var datos = {
                ingresarCorreoAdministrador: $("#ingresarCorreoAdministrador").val(),
                ingresarContraseniaAdministrador: $("#ingresarContraseniaAdministrador").val()
            }
    
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",
               
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },
                
                success: function (respuesta)
                {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Inicio Sesión!","Bienvenido a Boutique");
                    } else if(!respuesta["exito"]) {
                        respuestaError("Error!", "El Administrador no existe");
                    }
                },
                
                error: function(jqXHR,estado,error){
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });
    
    
        }

    });


    $("#formIngresar").validate({
    
        rules:
        {
          ingresarCorreo:{required:true},
          ingresarContrasenia:{required:true}
        },
        messages:
        {
          ingresarCorreo:{required:'<p style="color:red;">✘</p>'},
          ingresarContrasenia:{required:'<p style="color:red;">✘</p>'}
        },
    
        submitHandler:function(){
    
            var datos = {
                ingresarCorreo: $("#ingresarCorreo").val(),
                ingresarContrasenia: $("#ingresarContrasenia").val()
            }
    
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",
               
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },
                
                success: function (respuesta)
                {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Inicio Sesión!","Bienvenido a Boutique");
                    } else if(!respuesta["exito"]) {
                        respuestaError("Error!", "El Cliente no existe");
                    }
                },
                
                error: function(jqXHR,estado,error){
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });
    
        }
    
    });
    
    });
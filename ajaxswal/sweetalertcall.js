function llamadaASweetAlert(
    json,
    actionUrl,
    title,
    text,
    icon,
    confirmButtonText,
    denyButtonText,
    errorResult,
    titleSuccess,
    textSuccess,
    locationReplace = false,
    locationUrl = null
) { 
    let resultado
    let tituloResultado
    let mensajeResultado
    return Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        showDenyButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmButtonText,
        denyButtonText: denyButtonText,
        preConfirm: async () => {
            try {
                const response = await fetch(actionUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: json,
                });

                if (!response.ok) {
                    throw new Error(`Error: ${response.statusText}`);
                }

                const data = await response.json();
                resultado = data.resultado
                tituloResultado = data.titulo
                mensajeResultado = data.mensaje
                if (data.resultado === 0) {
                    Swal.showValidationMessage(errorResult+" "+data.mensaje);
                    resultado = data.resultado
                    tituloResultado = data.titulo
                    mensajeResultado = data.mensaje
                    
                }else if(data.resultado === 2){
                    resultado = data.resultado
                    tituloResultado = data.titulo
                    mensajeResultado = data.mensaje
                    Swal.fire({
                        title: "Usuario repetido",
                        text: data.mensaje,
                        icon: "error"
                    })
                }
                return data; // Retorna los datos procesados
            } catch (error) {
                Swal.showValidationMessage(`Error en la solicitud: ${error.mensaje}`);
                console.log(error.mensaje);
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        console.log(resultado)
        if (result.isConfirmed && resultado == 1) {
            Swal.fire({
                icon: "success",
                title: titleSuccess,
                text: textSuccess,
				showConfirmButton: true,
				confirmButtonText: "Volver"
            }).then((result)=>{
				if (result.isConfirmed && locationReplace) {
					location.replace(locationUrl); // Ejecuta el redireccionamiento
				}
			})
            
        }else if(resultado == 2){
            Swal.fire({
                title: tituloResultado,
                text: mensajeResultado,
                icon: "error"
            })
        }
    });
}

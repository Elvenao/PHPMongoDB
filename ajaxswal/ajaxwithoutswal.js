let resultadoAjax;
function llamadaAjax(
    json,
    actionUrl,
    locationReplace = false,
    locationUrl = null
) {
    fetch(actionUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: json,
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }
        return response.json();
    })
    .then((data) => {
        if (data.resultado === 0) {
            console.log(`Error: ${data.mensaje}`);
        } else if (data.resultado === 2) {
            console.log(`Usuario repetido: ${data.mensaje}`);
        } else if (data.resultado === 1) {
            // Insertar los datos en el contenedor HTML
            const container = document.getElementById("prodBtn");
            container.innerHTML = ""; // Limpiar contenido previo
            data.datos.forEach((producto) => {
                const button = document.createElement("button");
                button.className = "btn btn-light w-100 mb-2 text-start";
                button.textContent = producto.Nombre;
                button.value = JSON.stringify({
                    Id: producto.Id_Productos,
                    Nombre: producto.Nombre,
                    Precio: producto.Precio,
                });
                button.onclick = function() { addProducto(this.value); };
                container.appendChild(button);
            });

            if (locationReplace && locationUrl) {
                window.location.replace(locationUrl);
            }
        }
    })
    .catch((error) => {
        console.error("Error en la solicitud:", error);
        alert(`Error en la solicitud: ${error.message}`);
    });
}
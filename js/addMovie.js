function addMovie(){
    const formData = new FormData();
    let movieName = document.getElementById("movieName").value
    let description = document.getElementById("description").value
    let duration = document.getElementById("duration").value
    let director = document.getElementById("director").value
    let cast = document.getElementById("cast").value
    let poster = document.getElementById("poster").files[0]
    
    console.log()

    let documento = JSON.stringify({movieName, description, duration, director, cast, poster})
    formData.append('movieName',movieName)
    formData.append('description',description)
    formData.append('duration',duration)
    formData.append('director',director)
    formData.append('cast',cast)
    formData.append('poster',poster)
    let collection = "Movies"
    formData.append('collection',collection)
    let ruta = "<?php echo SITE_URL;?>Agregar/Peliculas"
    llamadaASweetAlertFormData(formData,"<?php echo SITE_URL;?>_controller/addMovieAjax.php","Agregar Pelicula","Agregar Pelicula","question","Agregar","Cancelar","No fue posible agregar la pelicula","Se agrego con exito","La pelicula fue agregada con exito",true,ruta)

}

function deleteUser(id){
    let colection = "Movies"
    let ruta = "<?php echo SITE_URL;?>Agregar/Peliculas"
    let datos = JSON.stringify({colection,id})
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/deleteUserAjax.php","Eliminar Pelicula","Eliminar Pelicula","question","Eliminar","Cancelar","No fue posible eliminar la pelicula","Se elimino con exito","La pelicula fue eliminada con exito",true,ruta)
}

function Regresar(){
    location.replace("<?php echo SITE_URL;?>")
}

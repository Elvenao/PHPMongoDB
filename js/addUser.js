function addUser(){

    const ahora = new Date();
    const año = ahora.getFullYear();
    const mes = String(ahora.getMonth() + 1).padStart(2, '0'); // Enero = 0
    const dia = String(ahora.getDate()).padStart(2, '0');
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    const segundos = String(ahora.getSeconds()).padStart(2, '0');

    const date = `${año}-${mes}-${dia}`
    

    const formData = new FormData();
    let userName = document.getElementById("userName").value
    let name = document.getElementById("name").value
    let birthDate = document.getElementById("birthDate").value
    let password = document.getElementById("password").value
    let email = document.getElementById("email").value
    let avatar = document.getElementById("avatar").files[0]
    let biography = document.getElementById("biography").value
    let genres = document.getElementById("genres").value
    let genresArray = genres.split(",")
    console.log(genresArray)

    let documento = JSON.stringify({userName, name, birthDate, password, email, avatar})
    formData.append('userName',userName)
    formData.append('name',name)
    formData.append('birthDate',birthDate)
    formData.append('password',password)
    formData.append('email',email)
    formData.append('avatar',avatar)
    formData.append('biography',biography)
    formData.append('genres',genresArray)
    formData.append('joiningDate',date)
    let collection = "Users"
    formData.append('collection',collection)
    let ruta = "<?php echo SITE_URL;?>Agregar/Usuarios"
    llamadaASweetAlertFormData(formData,"<?php echo SITE_URL;?>_controller/addUserAjax.php","Agregar Usuario","Agregar Usuario","question","Agregar","Cancelar","No fue posible agregar el usuario","Se agrego con exito","El usuario fue agregado con exito",true,ruta)

}

function deleteUser(id){
    let colection = "Users"
    let ruta = "<?php echo SITE_URL;?>Agregar/Usuarios"
    let datos = JSON.stringify({colection,id})
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/deleteUserAjax.php","Eliminar Usuario","Eliminar Usuario","question","Eliminar","Cancelar","No fue posible eliminar el usuario","Se eliminar con exito","El usuario fue eliminado con exito",true,ruta)
}

function Regresar(){
    location.replace("<?php echo SITE_URL;?>")
}

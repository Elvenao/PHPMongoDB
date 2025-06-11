function addUser(){
    let userName = document.getElementById("userName").value
    let name = document.getElementById("name").value
    let birthDate = document.getElementById("birthDate").value
    let password = document.getElementById("password").value
    let email = document.getElementById("email").value
    let avatar = document.getElementById("avatar").value

    let documento = JSON.stringify({userName, name, birthDate, password, email, avatar})
    let collection = "Users"
    let datos = JSON.stringify({collection,documento})
    let ruta = "<?php echo SITE_URL;?>Agregar/Usuario"
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/addUserAjax.php","Agregar Usuario","Agregar Usuario","question","Agregar","Cancelar","No fue posible agregar el usuario","Se agrego con exito","El usuario fue agregado con exito",true,ruta)

}

function deleteUser(id){
    let colection = "Users"
    let ruta = "<?php echo SITE_URL;?>"
    let datos = JSON.stringify({colection,id})
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/deleteUserAjax.php","Eliminar Usuario","Eliminar Usuario","question","Eliminar","Cancelar","No fue posible eliminar el usuario","Se eliminar con exito","El usuario fue eliminado con exito",true,ruta)
}

function Regresar(){
    location.replace("<?php echo SITE_URL;?>")
}

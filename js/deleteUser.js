function deleteUser(id){
    let colection = "Users"
    let ruta = "<?php echo SITE_URL;?>Agregar/Usuarios"
    let datos = JSON.stringify({colection,id})
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/deleteUserAjax.php","Eliminar Usuario","Eliminar Usuario","question","Eliminar","Cancelar","No fue posible eliminar el usuario","Se eliminar con exito","El usuario fue eliminado con exito",true,ruta)
}
function addPost(){
    const ahora = new Date();
    const año = ahora.getFullYear();
    const mes = String(ahora.getMonth() + 1).padStart(2, '0'); // Enero = 0
    const dia = String(ahora.getDate()).padStart(2, '0');
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    const segundos = String(ahora.getSeconds()).padStart(2, '0');

    const date = `${año}-${mes}-${dia}`
    const time = `${horas}:${minutos}:${segundos}`
  
    let selectUsuario = document.getElementById('usuario')
    let user = selectUsuario.options[selectUsuario.selectedIndex].text
    let content = document.getElementById("contenido").value
    let userId = selectUsuario.value
    let title = document.getElementById("title").value
    let documento = JSON.stringify({user, userId, title, content,date, time})

    let action = "add"
    let colection = "Posts"
    let datos = JSON.stringify({action,colection,documento})
    let ruta = "<?php echo SITE_URL;?>Agregar/Post"
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/PostAjax.php","Agregar Post","Agregar Post","question","Agregar","Cancelar","No fue posible agregar el usuario","Se agrego con exito","El usuario fue agregado con exito",true,ruta)

}

function deletePost(id){
    let action = "delete"
    let colection = "Posts"
    let ruta = "<?php echo SITE_URL;?>Agregar/Post"
    let datos = JSON.stringify({action,colection,id})
    llamadaASweetAlert(datos,"<?php echo SITE_URL;?>_controller/deleteUserAjax.php","Eliminar Post","Eliminar Post","question","Eliminar","Cancelar","No fue posible eliminar el post","Se elimino con exito","El post fue eliminado con exito",true,ruta)
}

function Regresar(){
    location.replace("<?php echo SITE_URL;?>")
}

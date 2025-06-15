<?php 
    require 'vendor/autoload.php';
    require_once 'config/global.php';
    $queryString = isset($_GET["querystring"]) ? $_GET["querystring"] : "";
    $uri = 'mongodb://127.0.0.1:27017';
    $client = new MongoDB\Client($uri);

// Seleccionas la base de datos "mi_base"
    $db = $client->selectDatabase('miApp');
    $queryString = str_ends_with($queryString, "/") ? $queryString : $queryString."/";
    $peticion = explode("/",$queryString);
    $controlador = isset($peticion[0]) ? $peticion[0] : "";
    $campo = isset($peticion[1]) ? $peticion[1] : "";
    switch($controlador){
        case "Agregar":
            if($campo == "Usuarios"){
                require_once "_controller/addUserController.php";
                $ctrl = new AddUserController();
            }else if($campo == "Post"){
                require_once "_controller/PostController.php";
                $ctrl = new PostController();
            }else if($campo == "Peliculas"){
                require_once "_controller/addMovieController.php";
                $ctrl = new PostController();
            }else if($campo == "Series"){
                require_once "_controller/PostController.php";
                $ctrl = new PostController();
            }else if($campo == "Videojuegos"){
                require_once "_controller/PostController.php";
                $ctrl = new PostController();
            }
            else{
                require_once "_controller/error404Controller.php";
                $ctrl = new Error404Controller();
            }
            
            break;
        default:
            require_once "_controller/menuController.php";
            $ctrl = new MenuController();
            break;
    }
    
    

    
    

   
    include "_view/master.html";
    
?>
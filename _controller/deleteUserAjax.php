<?php 
    require_once "../_model/MainModel.php";
    header("Content-Type: application/json");
    try {
        $documento = json_decode(file_get_contents("php://input"),true);
        $model = new MainModel();
        setcookie("Coleccion",$documento["colection"]);
        setcookie("Id",$documento["id"]);
        $resultado = $model->deleteDocument($documento["colection"],$documento["id"]);
        echo json_encode(["resultado" => 1, "datos" => $resultado]);
    } catch(Exception $e){
        echo json_encode(["resultado" => 0, "mensaje" => "Error interno: " . $e->getMessage()]);
    }
?>
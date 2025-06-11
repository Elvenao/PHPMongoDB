<?php 
    require_once "../_model/MainModel.php";
    header("Content-Type: application/json");
    try {
        $documento = json_decode(file_get_contents("php://input"),true);
        $model = new MainModel('mongodb://127.0.0.1:27017','miApp');
        setcookie("Coleccion",$documento["collection"]);
        setcookie("Datos",$documento["documento"]);
        $resultado = $model->addDocument($documento["collection"],$documento["documento"]);
        echo json_encode(["resultado" => 1, "datos" => $resultado]);
    } catch(Exception $e){
        echo json_encode(["resultado" => 0, "mensaje" => "Error interno: " . $e->getMessage()]);
    }
?>
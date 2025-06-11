<?php 
    require_once "../_model/MainModel.php";
    header("Content-Type: application/json");
    try {
        
        $documento = json_decode(file_get_contents("php://input"),true);
        if($documento["action"] == "add"){
            $model = new MainModel('mongodb://127.0.0.1:27017','miApp');
            setcookie("Coleccion",$documento["colection"]);
            setcookie("Datos",$documento["documento"]);
            $resultado = $model->addDocument($documento["colection"],$documento["documento"]);
            echo json_encode(["resultado" => 1, "datos" => $resultado]);
        }else if($documento["action"] == "delete"){
            $documento = json_decode(file_get_contents("php://input"),true);
            $model = new MainModel();
            setcookie("Coleccion",$documento["colection"]);
            setcookie("Id",$documento["id"]);
            $resultado = $model->deleteDocument($documento["colection"],$documento["id"]);
            echo json_encode(["resultado" => 1, "datos" => $resultado]);
        }
        
    } catch(Exception $e){
        echo json_encode(["resultado" => 0, "mensaje" => "Error interno: " . $e->getMessage()]);
    }
?>
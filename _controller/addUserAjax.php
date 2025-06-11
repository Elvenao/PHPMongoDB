<?php 
    $options = [
            'memory_cost' => 1 << 18, 
            'time_cost'   => 8,       
            'threads'     => 2        
        ];
    require_once "../config/global.php";
    require_once "../_model/MainModel.php";
    header("Content-Type: application/json");
    try {
        $model = new MainModel('mongodb://127.0.0.1:27017','miApp');
        $rutaDestino = 'C:/Users/emhdz/Documents/Programacion Movil/Imagenes/';
        
        $nombreArchivo = time() . '_' . basename($_FILES['avatar']['name']);
        $rutaVirtual = SERVER . "/Images/" . $nombreArchivo;
        $rutaFinal = $rutaDestino . $nombreArchivo;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $rutaFinal)) {
            // Recoger datos adicionales
            $userName = $_POST['userName']?? '';
            $name = $_POST['name']?? '';
            $birthDate = $_POST['birthDate']?? '';
            $password = $_POST['password']?? '';
            $email = $_POST['email']?? '';
            $collection = $_POST['collection'];

            $documento = json_encode([
                "userName" => $userName,
                "name" => $name,
                "birthDate" => $birthDate,
                "password" => $password = password_hash($password,PASSWORD_ARGON2ID,$options),
                "email" => $email,
                "avatar" =>$rutaVirtual
            ]);

            $resultado = $model->addDocument($collection,$documento);
            // Respuesta en JSON
            echo json_encode(["resultado" => 1, "datos" => $resultado]);
            exit;
        } else {
            echo json_encode(["success" => false, "mensaje" => "Error al guardar la imagen."]);
            exit;
        }
        
        
        
        
    } catch(Exception $e){
        echo json_encode(["resultado" => 0, "mensaje" => "Error interno: " . $e->getMessage()]);
    }
?>
<?php 
    
    require_once "../config/global.php";
    require_once "../_model/MainModel.php";
    header("Content-Type: application/json");

    $options = [
        'memory_cost' => 1 << 18, 
        'time_cost'   => 8,       
        'threads'     => 2        
    ];

    $clave = KEY;

    try {
        $model = new MainModel('mongodb://127.0.0.1:27017','miApp');
        $rutaDestino = $emilio. "Movies/";
        $nombreArchivo = time() . '_' . basename($_FILES['poster']['name']);
        $rutaVirtual =  "/Images/Movies/" . $nombreArchivo;
        $rutaFinal = $rutaDestino . $nombreArchivo;
        if (move_uploaded_file($_FILES['poster']['tmp_name'], $rutaFinal)) {
            shell_exec('icacls "' . $rutaFinal . '" /grant Everyone:(R) /T');
            // Recoger datos adicionales
            $movieName = $_POST['movieName']?? '';
            $description = $_POST['description']?? '';
            $duration = $_POST['duration']?? '';
            $director= $_POST['director']?? '';
            $cast = $_POST['cast'] ?? '';
            $gender = $_POST['gender'] ?? '';
            
            $collection = $_POST['collection'];

            $documento = json_encode([
                "movieName" => $movieName,
                "description" => $description,
                "duration" => $duration,
                "director" => $director,
                "cast" => $cast,
                "gender" => $gender,
                "poster" =>$rutaVirtual
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
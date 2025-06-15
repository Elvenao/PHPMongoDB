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
        $rutaDestino = $emilio;
        $nombreArchivo = time() . '_' . basename($_FILES['avatar']['name']);
        $rutaVirtual =  "/Images/" . $nombreArchivo;
        $rutaFinal = $rutaDestino . $nombreArchivo;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $rutaFinal)) {
            shell_exec('icacls "' . $rutaFinal . '" /grant Everyone:(R) /T');
            // Recoger datos adicionales
            $userName = $_POST['userName']?? '';
            $userName = encryptData($userName, $clave);
            $name = $_POST['name']?? '';
            $name = encryptData($name, $clave);
            $birthDate = $_POST['birthDate']?? '';
            $birthDate = encryptData($birthDate, $clave);
            $password = $_POST['password']?? '';
            $password = password_hash($password, PASSWORD_BCRYPT);
            $biography = $_POST['biography']?? '';
            $genresString = $_POST['genres'] ?? '';
            $genres = array_map('trim', explode(',', $genresString));
            $date = $_POST['joiningDate'];
            
            //$password = encryptData($password, $clave); Lo mejor es no cifrar debido a que a la hora de hacer el login hay que hacer busqueda en la base de datos
            $email = $_POST['email']?? '';
            //$email = encryptData($email, $clave); Lo mejor es no cifrar debido a que a la hora de hacer el login hay que hacer busqueda en la base de datos
            $collection = $_POST['collection'];

            $documento = json_encode([
                "userName" => $userName,
                "name" => $name,
                "biography" => $biography,
                "genres" => $genres,
                "birthDate" => $birthDate,
                "joiningDate" => $date,
                "password" => $password,
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

    function encryptData($data, $clave) {
        $ivLength = openssl_cipher_iv_length('aes-128-cbc');
        $iv = openssl_random_pseudo_bytes($ivLength);
        $ciphertext = openssl_encrypt($data, 'aes-128-cbc', $clave,  OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext);
    }
?>
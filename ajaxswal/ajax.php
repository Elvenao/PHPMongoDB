<?php
// Recibe datos JSON desde el cliente
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Asegúrate de validar los datos
if (isset($data['id'], $data['nombre'], $data['precio'])) {
    // Lógica para insertar en la base de datos (sólo un ejemplo)
    $id = $data['id'];
    $nombre = $data['nombre'];
    $precio = $data['precio'];

    // Simulación de inserción exitosa
    $resultado = 1; // Devuelve 1 en caso de éxito
} else {
    $resultado = 0; // Devuelve 0 en caso de error
}

// Devuelve la respuesta como JSON
echo json_encode(["resultado" => $resultado]);
?>

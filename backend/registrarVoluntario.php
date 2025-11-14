<?php
header('Content-Type: application/json');
require 'conectar.php';

// Asegúrate de usar comillas correctamente aquí 👇
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['nombre']) || !isset($data['correo'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$nombre = $data['nombre'];
$correo = $data['correo'];

try {
    $sql = "INSERT INTO voluntarios (nombre, correo) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $correo]);

    echo json_encode(['success' => true, 'message' => 'Voluntario registrado exitosamente']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al registrar: ' . $e->getMessage()]);
}
?>

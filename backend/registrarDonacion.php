<?php
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

// Verificar que todos los campos requeridos estén presentes
if (!isset($data['voluntarioId']) || !isset($data['monto']) || !isset($data['fecha'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$voluntario_id = $data['voluntarioId'];  // Asegúrate de usar 'voluntarioId' como en el frontend
$monto = $data['monto'];
$fecha = $data['fecha'];  // Obtener el valor de la fecha

// Asegurarse de que la fecha esté en un formato válido
if (!strtotime($fecha)) {
    echo json_encode(['success' => false, 'message' => 'Fecha inválida']);
    exit;
}

try {
    $sql = "INSERT INTO donaciones (voluntario_id, monto, fecha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$voluntario_id, $monto, $fecha]);

    echo json_encode(['success' => true, 'message' => 'Donación registrada']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

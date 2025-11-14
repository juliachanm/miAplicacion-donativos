<?php
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['voluntario_id']) || !isset($data['nombre']) || !isset($data['correo'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$voluntario_id = $data['voluntario_id'];
$nombre = $data['nombre'];
$correo = $data['correo'];

try {
    $sql = "UPDATE voluntarios SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $correo, $voluntario_id]);

    echo json_encode(['success' => true, 'message' => 'Voluntario actualizado']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

<?php
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['donacion_id']) || !isset($data['monto'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$donacion_id = $data['donacion_id'];
$monto = $data['monto'];

try {
    $sql = "UPDATE donaciones SET monto = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$monto, $donacion_id]);

    echo json_encode(['success' => true, 'message' => 'Donación actualizada']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

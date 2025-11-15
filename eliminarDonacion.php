<?php
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['donacion_id'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$donacion_id = $data['donacion_id'];

try {
    $sql = "DELETE FROM donaciones WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$donacion_id]);

    echo json_encode(['success' => true, 'message' => 'Donación eliminada']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

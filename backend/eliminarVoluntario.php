<?php
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['voluntario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$voluntario_id = $data['voluntario_id'];

try {
    $sql = "DELETE FROM voluntarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$voluntario_id]);

    echo json_encode(['success' => true, 'message' => 'Voluntario eliminado']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

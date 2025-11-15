<?php
header('Content-Type: application/json');
require 'conectar.php';

try {
    $sql = "SELECT d.id, v.nombre, v.correo, d.monto FROM donaciones d
            JOIN voluntarios v ON d.voluntario_id = v.id";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'donaciones' => $result]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener donaciones']);
}
?>

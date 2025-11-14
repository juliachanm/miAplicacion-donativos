<?php
header('Content-Type: application/json');
require 'conectar.php';

try {
    $sql = "SELECT d.id, v.nombre AS voluntario_nombre, v.correo AS voluntario_correo,d.monto, d.fecha
            FROM donaciones d
            JOIN voluntarios v ON d.voluntario_id = v.id
            ORDER BY d.fecha DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $donaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'donaciones' => $donaciones
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener las donaciones: ' . $e->getMessage()
    ]);
}
?>



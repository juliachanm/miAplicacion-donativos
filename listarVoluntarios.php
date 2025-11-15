<?php
header('Content-Type: application/json');
require 'conectar.php';

try {
    // Realizar la consulta
    $stmt = $pdo->query("SELECT * FROM voluntarios");
    $voluntarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los resultados en formato JSON
    echo json_encode(['success' => true, 'voluntarios' => $voluntarios]);

} catch (Exception $e) {
    // Retornar un mensaje de error
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener voluntarios',
        'error_details' => $e->getMessage()  // Detalles del error (solo para desarrollo)
    ]);
}
?>

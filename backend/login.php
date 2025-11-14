<?php
session_start();
header('Content-Type: application/json');
require 'conectar.php';

$data = json_decode(file_get_contents("php://input"), true);

$correo = $data['correo'];
$password = $data['password'];

$sql = "SELECT * FROM usuarios WHERE correo = ? AND password = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$correo, $password]);

if ($stmt->rowCount() > 0) {
    $_SESSION['usuario'] = $correo;
    echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
}
?>

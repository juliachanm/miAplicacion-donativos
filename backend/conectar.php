<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtener variables de entorno definidas en Railway
$host = getenv('DB_HOST');
$dbname = getenv('Nombre de la base de datos');
$username = getenv('USUARIO DE BD');
$password = getenv('DB_PASS');
$port = getenv('Puerto de base de datos') ?: 3306; // 3306 por defecto si no está definido

try {
    // Crear conexión PDO incluyendo el puerto y codificación UTF-8
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "¡Conectado correctamente a Railway!";
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>

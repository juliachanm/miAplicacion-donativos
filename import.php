<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Variables de entorno
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectado correctamente a la base de datos.<br>";

    // Ruta al archivo .sql
    $sqlFile = __DIR__ . '/schema.sql';

    // Leer el contenido
    $sql = file_get_contents($sqlFile);

    // Ejecutar las consultas
    $pdo->exec($sql);

    echo "Importación completada correctamente.";
} catch (PDOException $e) {
    die("Error de conexión o importación: " . $e->getMessage());
}
?>

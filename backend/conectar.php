<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$port = getenv('DB_PORT');

echo "Host: $host<br>";
echo "DB: $dbname<br>";
echo "User: $username<br>";
echo "Port: $port<br>";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "¡Conectado correctamente a Railway!";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>

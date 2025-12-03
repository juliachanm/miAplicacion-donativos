<?php
$dsn = 'mysql:host=shinkansen.proxy.rlwy.net;port=22059;dbname=railway;charset=utf8mb4';
$user = 'root';
$pass = 'srgoEkHGKCSHuEUyJAvwxtXyXrpeqmDe';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa<br>";

    $sql = "
    -- TABLA: USUARIOS
    CREATE TABLE IF NOT EXISTS usuarios (
      id INT AUTO_INCREMENT PRIMARY KEY,
      correo VARCHAR(100) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL
    );

    INSERT INTO usuarios (id, correo, password) VALUES
    (1, 'admin@correo.com', 'admin123');

    -- TABLA: VOLUNTARIOS
    CREATE TABLE IF NOT EXISTS voluntarios (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(100) NOT NULL,
      correo VARCHAR(100)
    );

    INSERT INTO voluntarios (id, nombre, correo) VALUES
    (1, 'MATIAS PEREZ SANCHEZ', 'admon@udg.com'),
    (2, 'MARCO RAMIREZ', 'marcoram65@gmail.com'),
    (3, 'LOURDES SANTILLAN PEREZ', 'lulu@correo.com'),
    (4, 'MARIA MENDEZ RUIZ', 'aux@udg.com'),
    (10, 'LETICIA VALLADAREZ MIJANGOS', ''),
    (11, 'JUAN MEDINA SALAZAR', 'recepcion_cfdi@fgt.com.mx'),
    (15, 'MIGUEL LOPEZ', 'admin@correo.com');

    -- TABLA: DONACIONES
    CREATE TABLE IF NOT EXISTS donaciones (
      id INT AUTO_INCREMENT PRIMARY KEY,
      voluntario_id INT NOT NULL,
      monto DECIMAL(10,2) NOT NULL,
      fecha DATETIME NOT NULL,
      FOREIGN KEY (voluntario_id) REFERENCES voluntarios(id)
    );

    INSERT INTO donaciones (id, voluntario_id, monto, fecha) VALUES
    (2, 2, 52590.00, '2025-05-18 00:27:38'),
    (4, 4, 56000.00, '2025-02-04 16:44:00'),
    (6, 1, 43000.00, '2024-09-18 02:25:00'),
    (8, 1, 7800.00, '2025-05-20 00:00:00'),
    (9, 10, 6789.00, '2025-01-06 00:00:00'),
    (10, 11, 4567.00, '2024-11-04 00:00:00'),
    (11, 15, 3400.00, '2025-05-02 00:00:00');
    ";

    $pdo->exec($sql);
    echo "Base y tablas creadas con registros de ejemplo.";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

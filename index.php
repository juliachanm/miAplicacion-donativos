<?php
// Conectar a la base de datos
include 'backend/conectar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Voluntarios y Donaciones</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script defer src="js/app.js"></script>
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido al Sistema de Gestión</h1>
        <nav id="menuNavegacion">
            <a href="index.php">Inicio</a>
        </nav>
    </header>

    <main>
        <section id="registro">
            <h2>Registrar Voluntario</h2>
            <form id="formRegistro">
                <input type="text" id="nombre" placeholder="Nombre completo" required>
                <input type="email" id="correo" placeholder="Correo electrónico" required>
                <button type="submit">Registrar</button>
            </form>
        </section>

        <section id="voluntarios">
            <h2>Lista de Voluntarios</h2>
            <button id="btnCargarVoluntarios">Ver Voluntarios</button>
            <div id="tablaVoluntarios"></div>
        </section>

        <section id="donar">
            <h2>Registrar Donación</h2>
            <form id="formDonacion">
                <select id="voluntarioSelect" required></select>
                <input type="number" id="monto" placeholder="Monto donado" required>
                <input type="datetime-local" id="fechaDonacion" required> 
                <button type="submit">Donar</button>
            </form>
        </section>

        <section id="donaciones">
            <h2>Seguimiento de Donaciones</h2>
            <button id="btnVerDonaciones">Ver Donaciones</button>
            <input type="text" id="filtro" placeholder="Buscar por nombre">
            <div id="tablaDonaciones" class="fade-in"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Gestión de Voluntarios y Donaciones</p>
    </footer>

    <script>
    // Tu JS existente para fetch, editar, eliminar
    </script>
</body>
</html>

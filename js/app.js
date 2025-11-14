document.addEventListener('DOMContentLoaded', () => {
    const formRegistro = document.getElementById('formRegistro');
    const btnVerDonaciones = document.getElementById('btnVerDonaciones');
    const tablaDonaciones = document.getElementById('tablaDonaciones');
    const btnCargarVoluntarios = document.getElementById('btnCargarVoluntarios');
    const fechaInput = document.getElementById('fechaDonacion');
    const voluntarioSelect = document.getElementById('voluntarioSelect');
    const montoInput = document.getElementById('monto');
    const tablaVoluntarios = document.getElementById('tablaVoluntarios'); // Tabla de voluntarios

    // Función para cargar voluntarios al cargar la página
    async function cargarVoluntarios() {
        const response = await fetch('backend/listarVoluntarios.php');
        const data = await response.json();

        if (data.success) {
            let html = '<table class="fade-in"><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Acciones</th></tr>';
            data.voluntarios.forEach(voluntario => {
                html += `
                    <tr id="voluntario-${voluntario.id}">
                        <td>${voluntario.id}</td>
                        <td>${voluntario.nombre}</td>
                        <td>${voluntario.correo}</td>
                        <td>
                            <button onclick="editarVoluntario(${voluntario.id})">Editar</button>
                            <button onclick="eliminarVoluntario(${voluntario.id})">Eliminar</button>
                        </td>
                    </tr>`;
            });
            html += '</table>';
            tablaVoluntarios.innerHTML = html; // Rellenar la tabla con los voluntarios
        } else {
            alert('Error al cargar los voluntarios');
        }
    }

    // Función para eliminar un voluntario
    window.eliminarVoluntario = async (id) => {
        const response = await fetch('backend/eliminarVoluntario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ voluntario_id: id })
        });

        const data = await response.json();

        if (data.success) {
            // Eliminar la fila correspondiente de la tabla
            const fila = document.getElementById(`voluntario-${id}`);
            if (fila) {
                fila.remove();
            }
        } else {
            alert('Error al eliminar el voluntario');
        }
    };

    // Función para editar un voluntario
    window.editarVoluntario = async (id) => {
        // Obtener la fila del voluntario
        const fila = document.getElementById(`voluntario-${id}`);
        const nombre = fila.querySelector('td:nth-child(2)').textContent;
        const correo = fila.querySelector('td:nth-child(3)').textContent;

        // Mostrar un formulario o prompt para editar
        const nuevoNombre = prompt('Editar nombre:', nombre);
        const nuevoCorreo = prompt('Editar correo:', correo);

        // Validar si los datos fueron modificados
        if (nuevoNombre && nuevoCorreo && (nuevoNombre !== nombre || nuevoCorreo !== correo)) {
            const response = await fetch('backend/editarVoluntario.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ voluntario_id: id, nombre: nuevoNombre, correo: nuevoCorreo })
            });

            const data = await response.json();

            if (data.success) {
                // Actualizar la tabla con los nuevos valores
                fila.querySelector('td:nth-child(2)').textContent = nuevoNombre;
                fila.querySelector('td:nth-child(3)').textContent = nuevoCorreo;
                alert('Voluntario actualizado');
            } else {
                alert('Error al actualizar el voluntario');
            }
        }
    };

    // Cargar voluntarios al iniciar la página
    cargarVoluntarios();

    // Función para registrar una donación
    const formDonacion = document.getElementById('formDonacion');
    formDonacion.addEventListener('submit', async (e) => {
        e.preventDefault();

        const voluntarioId = voluntarioSelect.value;
        const monto = montoInput.value;
        const fecha = fechaInput.value; // Obtener la fecha del formulario

        // Validar que todos los campos estén completos
        if (!voluntarioId || !monto || !fecha) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        // Enviar la donación al backend
        const response = await fetch('backend/registrarDonacion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ voluntarioId, monto, fecha })
        });

        const data = await response.json();
        alert(data.message);

        if (data.success) {
            // Crear la nueva fila en la tabla sin recargarla
            const donacion = data.donacion;
            const fechaFormateada = new Date(donacion.fecha).toLocaleString();
            const nuevaFila = `
                <tr id="donacion-${donacion.id}">
                    <td>${donacion.id}</td>
                    <td>${donacion.voluntario_nombre}</td>
                    <td>${donacion.voluntario_correo}</td>
                    <td>${donacion.monto}</td>
                    <td>${fechaFormateada}</td>
                    <td>
                        <button onclick="editarDonacion(${donacion.id})">Editar</button>
                        <button onclick="eliminarDonacion(${donacion.id})">Eliminar</button>
                    </td>
                </tr>
            `;
            tablaDonaciones.querySelector('table').insertAdjacentHTML('beforeend', nuevaFila);
            formDonacion.reset(); // Limpiar el formulario si la donación fue exitosa
        }
    });

    // Cargar las donaciones cuando se hace clic en el botón
    btnVerDonaciones.addEventListener('click', cargarDonaciones);

    // Función para cargar las donaciones
    async function cargarDonaciones() {
        const response = await fetch('backend/listarDonaciones.php');
        const data = await response.json();

        if (data.success) {
            const donaciones = data.donaciones;
            let html = '<table class="fade-in"><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Monto</th><th>Fecha</th><th>Acciones</th></tr>';

            donaciones.forEach(donacion => {
                const fecha = new Date(donacion.fecha);
                const fechaFormateada = `${fecha.getDate()}/${fecha.getMonth() + 1}/${fecha.getFullYear()} ${fecha.getHours()}:${fecha.getMinutes()}`;

                html += `<tr id="donacion-${donacion.id}">
                            <td>${donacion.id}</td>
                            <td>${donacion.voluntario_nombre}</td>
                            <td>${donacion.voluntario_correo}</td>
                            <td>${donacion.monto}</td>
                            <td>${fechaFormateada}</td>
                            <td>
                                <button onclick="editarDonacion(${donacion.id})">Editar</button>
                                <button onclick="eliminarDonacion(${donacion.id})">Eliminar</button>
                            </td>
                        </tr>`;
            });

            html += '</table>';
            tablaDonaciones.innerHTML = html;
        } else {
            alert('No se pudieron cargar las donaciones.');
        }
    }

    // Función para eliminar una donación
    window.eliminarDonacion = async (id) => {
        const response = await fetch(`backend/eliminarDonacion.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ donacion_id: id })
        });

        const data = await response.json();

        if (data.success) {
            // Eliminar la fila correspondiente de la tabla
            const fila = document.getElementById(`donacion-${id}`);
            if (fila) {
                fila.remove();
            }
        } else {
            alert('Error al eliminar la donación');
        }
    };

    // Función para editar una donación
    window.editarDonacion = async (id) => {
        const fila = document.getElementById(`donacion-${id}`);
        const monto = fila.querySelector('td:nth-child(4)').textContent;

        // Mostrar un prompt para editar el monto
        const nuevoMonto = prompt('Editar monto:', monto);
        if (nuevoMonto && nuevoMonto !== monto) {
            const response = await fetch('backend/editarDonacion.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ donacion_id: id, monto: nuevoMonto })
            });

            const data = await response.json();

            if (data.success) {
                // Actualizar el monto en la tabla
                fila.querySelector('td:nth-child(4)').textContent = nuevoMonto;
                alert('Donación actualizada');
            } else {
                alert('Error al actualizar la donación');
            }
        }
    };

    // Cargar las donaciones al iniciar
    cargarDonaciones();
});

document.addEventListener('DOMContentLoaded', async () => {
    const nav = document.getElementById('menuNavegacion');

    try {
        const response = await fetch('backend/verificarSesion.php');
        const data = await response.json();

        console.log('Verificación de sesión:', data);  // Añadido para depuración

        const link = document.createElement('a');

        if (data.loggedIn) {
            link.href = 'logout.php';
            link.textContent = 'Cerrar sesión';
        } else {
            link.href = 'login.html';
            link.textContent = 'Iniciar sesión';
        }

        nav.appendChild(link);
    } catch (error) {
        console.error('Error al verificar la sesión:', error);
    }
});

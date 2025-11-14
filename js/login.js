document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('formLogin');

    formLogin.addEventListener('submit', async (e) => {
        e.preventDefault();

        const correo = document.getElementById('correo').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!correo || !password) {
            alert("Por favor, ingrese ambos campos.");
            return;
        }

        const response = await fetch('backend/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ correo, password })
        });

        const data = await response.json();
        alert(data.message);

        if (data.success) {
            window.location.href = 'index.html';
        }
    });
});

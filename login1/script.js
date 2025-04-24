document.addEventListener("DOMContentLoaded", function () {
    const usuarioInput = document.getElementById("usuario");
    const contrasenaInput = document.getElementById("contrasena");
    const recordarCheck = document.getElementById("recordar");
    const loginForm = document.getElementById("loginForm");

    // Cargar usuario guardado en localStorage
    if (localStorage.getItem("recordar") === "true") {
        usuarioInput.value = localStorage.getItem("usuario") || "";
        recordarCheck.checked = true;
    }

    // Manejar el evento de login
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar que la página se recargue

        const usuario = usuarioInput.value;
        const contrasena = contrasenaInput.value;

        fetch("login.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `usuario=${usuario}&contrasena=${contrasena}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("¡Inicio de sesión exitoso!");

                // Guardar usuario si marcó "Recordar"
                if (recordarCheck.checked) {
                    localStorage.setItem("usuario", usuario);
                    localStorage.setItem("recordar", "true");
                } else {
                    localStorage.removeItem("usuario");
                    localStorage.removeItem("recordar");
                }

                // Redirigir a dashboard
window.location.href = "index3.html";

            } else {
                alert("Usuario o contraseña incorrectos");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});

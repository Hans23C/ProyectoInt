<?php
$host = "localhost";
$dbname = "tec_conect";
$user = "root"; // Cambia si tienes otro usuario
$pass = "jesus";     // Cambia si tu MySQL tiene contraseña

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];

// Verificar si el usuario ya existe
$sql = "SELECT id FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('El usuario ya existe'); window.location.href='registro.html';</script>";
} else {
    $stmt->close();

    // Insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario registrado con éxito'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error al registrar'); window.location.href='registro.html';</script>";
    }
}

$stmt->close();
$conn->close();
?>

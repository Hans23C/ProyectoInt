<?php
$host = "localhost";
$dbname = "tec_conect";
$user = "root"; // Cambia si usas otro usuario
$pass = "jesus"; // Cambia si tienes contraseña en MySQL

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];

// Buscar el usuario en la base de datos
$sql = "SELECT contrasena FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($password_bd);
$stmt->fetch();
$stmt->close();

// Validar la contraseña (En producción, usa password_hash)
if ($password_bd && $password_bd === $contrasena) {
    echo json_encode(["status" => "success", "message" => "Login exitoso"]);
} else {
    echo json_encode(["status" => "error", "message" => "Usuario o contraseña incorrectos"]);
}

$conn->close();
?>

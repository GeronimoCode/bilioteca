<?php
session_start();

if (!isset($_POST['Documento'], $_POST['password'])) {
    $_SESSION['mensaje'] = "❌ Debes completar todos los campos";
    $_SESSION['tipo'] = "error";
    header('Location: ../html/iniciarSesion.php');
    exit();
}

$doc = trim($_POST['Documento']);
$pass = $_POST['password'];

$conexion = new mysqli("localhost", "root", "", "sistemabiblioteca");
if ($conexion->connect_error) {
    $_SESSION['mensaje'] = "❌ Error de conexión a la base de datos";
    $_SESSION['tipo'] = "error";
    header('Location: ../html/iniciarSesion.php');
    exit();
}

$sql = "SELECT UsuarioID, Nombre, password FROM usuarios WHERE Documento = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $doc);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $user = $res->fetch_assoc();
    if ($pass === $user['password']) {
        $_SESSION['UsuarioID'] = $user['UsuarioID'];
        $_SESSION['Nombre'] = $user['Nombre']; // 👈 Guardamos el nombre

        $_SESSION['mensaje'] = "Bienvenid@ " . $user['Nombre'] . " a la biblioteca digital";
        $_SESSION['tipo'] = "success";

        header('Location: ../php/inicio.php');
        exit();
    }
}

// Si no coincide
$_SESSION['mensaje'] = "❌ Documento o contraseña incorrectos";
$_SESSION['tipo'] = "error";
header('Location: ../html/iniciarSesion.php');
exit();
?>

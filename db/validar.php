<?php
session_start();

$tipo = $_POST['tipo'] ?? '';
$documento = $_POST['documento'] ?? '';
$usuario = trim(strtolower($_POST['usuario'] ?? ''));
$password = $_POST['password'] ?? '';

if (empty($tipo) || empty($documento) || empty($usuario) || empty($password)) {
    $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
    $_SESSION['tipo'] = 'error';
    header('Location:  ../html/registrarme.php');
    exit();
}

require_once 'conexion.php';

try {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE tpdocumento = ? AND numdocumento = ? AND usuario = ?");
    $stmt->execute([$tipo, $documento, $usuario]);
    $usuarioDB = $stmt->fetch();

    if ($usuarioDB && password_verify($password, $usuarioDB['password'])) {
        $_SESSION['usuario'] = $usuarioDB['usuario'];
        $_SESSION['id_usuario'] = $usuarioDB['id'];
        header('Location: inicio.php');
        exit();
    } else {
        $_SESSION['mensaje'] = 'Usuario o contraseña incorrectos.';
        $_SESSION['tipo'] = 'error';
        header('Location:  ../html/registrarme.php');
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['mensaje'] = 'Error de conexión a la base de datos.';
    $_SESSION['tipo'] = 'error';
    header('Location:  ../html/registrarme.php');
    exit();
}
?>


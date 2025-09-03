<?php
$host = 'localhost';
$db = 'sistemabiblioteca';
$user = 'root';         // CORREGIDO: usa 'root'
$pass = '';             // CORREGIDO: sin contraseña (por defecto en XAMPP)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
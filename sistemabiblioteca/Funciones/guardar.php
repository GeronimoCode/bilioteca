<?php 
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistemabiblioteca");

if ($conexion->connect_error) {
    $_SESSION['mensaje'] = "Error de conexión a la base de datos: " . $conexion->connect_error;
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
    exit();
}

// Verificar que todos los campos estén presentes y no vacíos
$camposRequeridos = ['Documento', 'Nombre', 'Apellido', 'Email', 'Telefono', 'TipoUsuario', 'password'];
foreach ($camposRequeridos as $campo) {
    if (!isset($_POST[$campo]) || empty(trim($_POST[$campo]))) {
        $_SESSION['mensaje'] = "El campo $campo es obligatorio y no puede estar vacío";
        $_SESSION['tipo'] = 'error';
        header('Location: ../html/registrarme.php');
        exit();
    }
}

// Recoger y limpiar datos
$Documento = $conexion->real_escape_string(trim($_POST['Documento']));
$Nombre = $conexion->real_escape_string(trim($_POST['Nombre']));
$Apellido = $conexion->real_escape_string(trim($_POST['Apellido']));
$Email = $conexion->real_escape_string(trim($_POST['Email']));
$Telefono = $conexion->real_escape_string(trim($_POST['Telefono']));
$TipoUsuario = $conexion->real_escape_string(trim($_POST['TipoUsuario']));
$password = $conexion->real_escape_string(trim($_POST['password']));

// Validaciones básicas
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje'] = "El formato del correo electrónico no es válido";
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
    exit();
}

if (!preg_match('/^[0-9]+$/', $Telefono) || !preg_match('/^[0-9]+$/', $Documento)) {
    $_SESSION['mensaje'] = "El teléfono y documento solo deben contener números";
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
    exit();
}

$tiposPermitidos = ['Estudiante', 'Profesor', 'Empleado'];
if (!in_array($TipoUsuario, $tiposPermitidos)) {
    $_SESSION['mensaje'] = "Tipo de usuario no válido";
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
    exit();
}

// Validar si ya existe el email o el documento
$sql_verificar = "SELECT * FROM usuarios WHERE Email = ? OR Documento = ?";
$stmt_verificar = $conexion->prepare($sql_verificar);
$stmt_verificar->bind_param("ss", $Email, $Documento);
$stmt_verificar->execute();
$resultado = $stmt_verificar->get_result();
if ($resultado->num_rows > 0) {
    $_SESSION['mensaje'] = "El correo o el documento ya están registrados";
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
    exit();
}
$stmt_verificar->close();

// Insertar nuevo usuario (sin hash todavía)
$sql_insert = "INSERT INTO usuarios (Documento, Nombre, Apellido, Email, Telefono, TipoUsuario, password) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);
$stmt_insert->bind_param("sssssss", $Documento, $Nombre, $Apellido, $Email, $Telefono, $TipoUsuario, $password);

if ($stmt_insert->execute()) {
    $_SESSION['mensaje'] = "Registro exitoso. Ahora puedes iniciar sesión.";
    $_SESSION['tipo'] = 'success';
    header('Location: ../index.html');
} else {
    $_SESSION['mensaje'] = "❌ Error al registrar: " . $stmt_insert->error;
    $_SESSION['tipo'] = 'error';
    header('Location: ../html/registrarme.php');
}

$stmt_insert->close();
$conexion->close();
exit();

?>

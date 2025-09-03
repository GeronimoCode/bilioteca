<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistemabiblioteca");

if ($conexion->connect_error) {
    mostrarError("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Verificar campos requeridos
$camposRequeridos = ['Documento', 'Nombre', 'Apellido', 'Email', 'Telefono', 'TipoUsuario', 'password'];
foreach ($camposRequeridos as $campo) {
    if (!isset($_POST[$campo]) || empty(trim($_POST[$campo]))) {
        mostrarError("El campo $campo es obligatorio y no puede estar vacío");
    }
}

// Recoger y limpiar datos
$Documento = $conexion->real_escape_string(trim($_POST['Documento']));
$Nombre = $conexion->real_escape_string(trim($_POST['Nombre']));
$Apellido = $conexion->real_escape_string(trim($_POST['Apellido']));
$Email = $conexion->real_escape_string(trim($_POST['Email']));
$Telefono = $conexion->real_escape_string(trim($_POST['Telefono']));
$TipoUsuario = $conexion->real_escape_string(trim($_POST['TipoUsuario']));
$password = trim($_POST['password']);

// Validaciones
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    mostrarError("El formato del correo electrónico no es válido");
}

if (!preg_match('/^[0-9]{7,15}$/', $Telefono) || !preg_match('/^[0-9]{5,15}$/', $Documento)) {
    mostrarError("El teléfono y documento deben contener solo números válidos (entre 5 y 15 dígitos)");
}

if (strlen($password) < 8) {
    mostrarError("La contraseña debe tener al menos 8 caracteres");
}

$tiposPermitidos = ['Estudiante', 'Profesor', 'Empleado'];
if (!in_array($TipoUsuario, $tiposPermitidos)) {
    mostrarError("Tipo de usuario no válido");
}

// Verificar si ya existe email o documento
$sql_verificar = "SELECT Email, Documento FROM usuarios WHERE Email = ? OR Documento = ?";
$stmt_verificar = $conexion->prepare($sql_verificar);
$stmt_verificar->bind_param("ss", $Email, $Documento);
$stmt_verificar->execute();
$resultado = $stmt_verificar->get_result();

if ($resultado->num_rows > 0) {
    $mensajeError = "El correo o el documento ya están registrados";
    while ($row = $resultado->fetch_assoc()) {
        if ($row['Email'] === $Email) {
            $mensajeError = "El correo ya está registrado";
        } elseif ($row['Documento'] === $Documento) {
            $mensajeError = "El documento ya está registrado";
        }
    }
    mostrarError($mensajeError);
}
$stmt_verificar->close();

// Hashear la contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$sql_insert = "INSERT INTO usuarios (Documento, Nombre, Apellido, Email, Telefono, TipoUsuario, password) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);
$stmt_insert->bind_param("sssssss", $Documento, $Nombre, $Apellido, $Email, $Telefono, $TipoUsuario, $passwordHash);

if ($stmt_insert->execute()) {
    mostrarExito("✅ Registro exitoso. Ahora puedes <a href='../index.html'>iniciar sesión</a>.");
} else {
    mostrarError("❌ Error al registrar: " . $stmt_insert->error);
}

$stmt_insert->close();
$conexion->close();
exit();


// ----------------- FUNCIONES AUXILIARES -----------------------

function mostrarError($mensaje) {
    mostrarMensajeHTML($mensaje, 'error');
    exit();
}

function mostrarExito($mensaje) {
    mostrarMensajeHTML($mensaje, 'success');
    exit();
}

function mostrarMensajeHTML($mensaje, $tipo) {
    $tipoColor = $tipo === 'success' ? '#4CAF50' : '#f44336';

    echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 50px;
            text-align: center;
        }
        .mensaje {
            display: inline-block;
            padding: 20px 30px;
            border-radius: 5px;
            font-size: 18px;
            color: #fff;
            background-color: {$tipoColor};
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        a {
            color: #fff;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="mensaje">{$mensaje}</div>
</body>
</html>
HTML;
}
?>
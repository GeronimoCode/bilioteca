<!DOCTYPE html>
<html lang="es">

<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../css/iniciarSesion.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
      <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
        $mensaje = $_SESSION['mensaje'];
        $tipo = $_SESSION['tipo']; // success o error

        echo "<script>
            Swal.fire({
                icon: '$tipo',
                title: '$mensaje',
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#3085d6'
            });
        </script>";

        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo']);
    }
    ?>
   

    <form action="../Funciones/login.php" method="POST">

         <div class="Volver">
        <a href="../index.html">Volver</a>
        <img src="../img/ImagenDevolver.png" width="16">
    </div>
    
        <div class="login-container">
            <h2>Iniciar sesión</h2>

            <div class="input-group">
                <input class="input" type="text" id="usuario" name="Documento" placeholder="Documento" required>
            </div>

            <br><br>
            <div class="input-group">
                <input class="input" type="text" id="contrasena" name="password" placeholder="Contraseña" required>
            </div>

            <br>

            <button type="submit" class="login-button">Registrarme</button>

          
        </div>
    </form>
</body>

</html>
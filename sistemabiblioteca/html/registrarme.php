<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="../img/LogoSanLuis.png">
    <link rel="stylesheet" href="../css/registrarme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cal+Sans&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="background-slider">

   

    <div class="contenido">
        <div class="Volver">
            <a href="../index.html">Volver</a>
            <img src="../img/ImagenDevolver.png" width="16">
        </div>

        <img class="hola" src="img/logo_colegio.png" alt="">

        <form action="../Funciones/guardar.php" method="POST">
            <h1>Registro</h1>

            <label for="TipoUsuario">Digita tu tipo de usuario</label> <br>
            <select name="TipoUsuario" required>
                <option value="Estudiante">Estudiante</option>
                <option value="Profesor">Profesor</option>
                <option value="Empleado">Empleado</option>
            </select>

            <br><br>

            <label for="Documento">Digita tu Documento</label> <br>
            <input class="campos" type="text" name="Documento" placeholder="Documento" required>

            <br><br>

            <label for="Nombre">Digita tu Nombre</label> <br>
            <input class="campos" type="text" name="Nombre" placeholder="Nombre de usuario" required>

            <br><br><br>

            <label for="Apellido">Digita tus Apellidos</label> <br>
            <input class="campos" type="text" name="Apellido" placeholder="Apellidos" required>

            <br><br><br>

            <label for="Email">Digita tu Correo electronico</label> <br>
            <input class="campos" type="email" name="Email" placeholder="Correo electronico" required>

            <br><br><br>

            <label for="Telefono">Numero telefonico</label> <br>
            <input class="campos" type="text" name="Telefono" placeholder="telefono" required>
            <br><br><br>

            <label for="password">Crea tu contraseña</label> <br>
            <input class="campos" type="text" name="password" placeholder="Contraseña" required>
            <br><br><br>

            <button type="submit" class="Registrarme">Registrarme</button>


        </form>

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
        
          
        <br><br>

        <div class="enlace">
            <a href="https://www.youtube.com/" target="_blank">¿No sabes cómo registrarte?</a>
        </div>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página principal</title>
  <link rel="stylesheet" href="../css/inicio.css">
  <link rel="icon" href="../img/LogoSanLuis.png">
</head>

<body>
    
  <?php
  session_start();
  if (isset($_SESSION['mensaje'])) {
      $mensaje = $_SESSION['mensaje'];
      $tipo = $_SESSION['tipo'];

      echo "<script>
          Swal.fire({
              icon: '$tipo',
              title: '$mensaje',
              showConfirmButton: true,
              confirmButtonText: 'Entrar',
              confirmButtonColor: '#3085d6'
          });
      </script>";

      unset($_SESSION['mensaje']);
      unset($_SESSION['tipo']);
  }
  ?>

  <header class="header">
    <div class="header-left">
      <img src="../img/LogoSanLuis.png" class="logo">
    </div>
    <h1 class="titulo">Página principal</h1>
    <div class="header-right">
      <img src="../img/logosena.png" alt="Logo SENA" class="logo">


    </div>
  </header>

  <nav class="navbar">
    <?php 
          // 👇 Mostrar el nombre del usuario si existe
          if (isset($_SESSION['Nombre'])) {
              echo "<span class='usuario'> 👋 Hola, " . $_SESSION['Nombre'] . "</span>";
          }
        ?>
   <div class="nav-links">
    <a href="../php/inicio.html"><button class="navbutton">Inicio</button></a>

    <!-- Dropdown de géneros -->
    <div class="dropdown">
      <button class="navbutton">Géneros</button>
      <div class="contenido-generos">
       <a href="../php/Narrativo.php"> <button class="sub-button">Narrativo</button></a>
       <a href="../php/Naturales.php"><button class="sub-button">Ciencias Naturales</button></a>
       <a href="../php/Sociales.php"><button class="sub-button">Ciencias Sociales</button></a>
       <a href="../php/Matematicas.php"><button class="sub-button">Matemática</button></a> 
       <a href="../php/Psicologia.php"><button class="sub-button">Psicología</button></a>
      </div>
    </div>

    <button class="navbutton">Libros</button>
     <a href="../php/prestamos.php"><button class="navbutton">Prestamos</button></a>



      <div class="nav-links">
        <nav class="navbar">
          <input type="text" placeholder="Buscar..." class="search-bar" />
          <!-- <img src="../img/Buscador.png" alt="" class="header-right"> -->
        </nav>
        <br>

  </nav>


  <section class="gallery">
       <div class="gallery-container">
            <figure class="gallery-item">
                <img src="../img/imglibros/narrativo11.png" alt="imagen 1">
            </figure>
            <figure class="gallery-item">
                <img src="../img/imglibros/narrativo3.png" alt="imagen 2">
            </figure>
            <figure class="gallery-item">
                <img src="../img/imglibros/narrativo9.png" alt="imagen 3">
            </figure>
        </div>
        <nav class="gallery-navigation">
            <button class="nav-button prev-button"><span>&lt;</span></button>
            <button class="nav-button next-button"><span>&gt;</span></button>
        </nav>
  </section>

    <section class="libros">
    <img src="../img/imglibros/cienciasnaturales.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciasnaturales2.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciasnaturales3.png" alt="" class="Tlibros">
    </section>


    <script src="../js/script.js"></script>
</body>
</html>
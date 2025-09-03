<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página principal</title>
  <link rel="stylesheet" href="../css/inicio.css">
  <link rel="icon" href="../img/LogoSanLuis.png">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <h1 class="titulo">Biblioteca digital</h1>
    <div class="header-right">
      <img src="../img/logosena.png" alt="Logo SENA" class="logo">


    </div>
  </header>
  
 <!-- ! NAV -->
  <nav class="navbar">
    <?php 
          // 👇 Mostrar el nombre del usuario si existe
          if (isset($_SESSION['Nombre'])) {
              echo "<span class='usuario'> 👋 Hola, " . $_SESSION['Nombre'] . "</span>";
          }
        ?>
   <div class="nav-links">
    <a href="../php/inicio.php"><button class="navbutton">Inicio</button></a>

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

    <a href="#libro"><button class="navbutton">Libros</button></a>
    <a href="../php/prestamos.php"><button class="navbutton">Servicios</button></a>


      <div class="nav-links">
        <nav class="navbar">
          <input type="text" placeholder="Buscar..." class="search-bar" />
          <!-- <img src="../img/Buscador.png" alt="" class="header-right"> -->
        </nav>
        <br>

  </nav>

<!-- ! CARRUSEL -->
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

  <br><br>

  <!-- ! TODOS LOS LIBROS -->
  <section class="libros" id="libro">

    <a href="https://www.cesp.cl/gallery/Cupido-Es-Un-Murcielago-pdf.pdf" target="_blank"><img src="../img/imglibros/narrativo.png" alt="" class="Tlibros"></a>
    <a href="https://es.scribd.com/document/623672496/EL-JARDIN-DE-LA-EMPERATRIZ-CASIA-GABRIELLE-WANG " target="_blank"> <img src="../img/imglibros/narrativo2.png" alt="" class="Tlibros"></a>
    <a href="../img/afrocolombianas.pdf " target="_blank"> <img src="../img/imglibros/narrativo3.png" alt="" class="Tlibros"></a>
    <a href="https://es.scribd.com/document/840311689/Mitos-Griegos-Contados-Otra-Vez " target="_blank"> <img src="../img/imglibros/narrativo4.png" alt="" class="Tlibros"></a>
    <img src="../img/imglibros/narrativo5.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo6.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo7.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo8.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo9.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo10.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo11.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo12.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo13.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo14.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo15.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo16.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo17.png" alt="" class="Tlibros">
    <img src="../img/imglibros/narrativo18.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciasnaturales.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciasnaturales2.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciasnaturales3.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciassociales.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciassociales2.png" alt="" class="Tlibros">
    <img src="../img/imglibros/cienciassociales3.png" alt="" class="Tlibros">
    <img src="../img/imglibros/matematicas.png" alt="" class="Tlibros">
    <img src="../img/imglibros/matematicas2.png" alt="" class="Tlibros">
    <img src="../img/imglibros/matematicas3.png" alt="" class="Tlibros">
    <img src="../img/imglibros/psicologia.png" alt="" class="Tlibros">
    <img src="../img/imglibros/psicologia2.png" alt="" class="Tlibros">
    <img src="../img/imglibros/psicologia3.png" alt="" class="Tlibros">

  </section>

  
    <script src="../js/script.js"></script>
</body>

</html>
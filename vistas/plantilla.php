<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejemplo MVC</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Latest compiled FontAwesome-->
    <script src="https://kit.fontawesome.com/1acfd43bde.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <h3 class="text-center py-3">Logo</h3>
    </div>
    <!--botonera-->
    <div class="container-fluid bg-ligth">
        <div class="container">
            <ul class="nav nav-justified py-2 nav-pills">
                <?php if (isset($_GET["pagina"])) : ?>

                    <?php if ($_GET["pagina"] == "inicio") : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="inicio">Inicio</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link " href="inicio">Inicio</a>
                        </li>
                    <?php endif ?>


                    <?php if ($_GET["pagina"] == "registro") : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="registro">Registro</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="registro">Registro</a>
                        </li>
                    <?php endif ?>


                    <?php if ($_GET["pagina"] == "ingreso") : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="ingreso">Ingreso</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="ingreso">Ingreso</a>
                        </li>
                    <?php endif ?>


                    <?php if ($_GET["pagina"] == "salir") : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="salir">Salir</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="salir">Salir</a>
                        </li>
                    <?php endif ?>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link " href="inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ingreso">Ingreso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salir">Salir</a>
                    </li>

                <?php endif ?>
            </ul>
        </div>
    </div>
    <!--Contenido-->

    <div class="container-fluid py-5">
        <div class="container">
            <?php
            if (isset($_GET["pagina"])) {
                if (
                    $_GET["pagina"] == "registro" ||
                    $_GET["pagina"] == "inicio" ||
                    $_GET["pagina"] == "salir" ||
                    $_GET["pagina"] == "editar" ||
                    $_GET["pagina"] == "ingreso"
                ) {
                    include "paginas/" . $_GET["pagina"] . ".php";
                } else {
                    include "paginas/nofound.php";
                }
            } else {
                include "paginas/registro.php";
            }
            ?>
        </div>
    </div>


</body>

</html>
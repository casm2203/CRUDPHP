<?php
if (isset($_GET["token"])) {
    $item = "token";
    $valor = $_GET["token"];
    $usuario = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
}

?>
<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" value="<?php echo $usuario["nombre"]; ?>" id="nombre" placeholder="ingresa nombre" name="actualizar_nombre">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></i></span>
                </div>
                <input type="email" class="form-control" value="<?php echo $usuario["email"]; ?>" id="email" placeholder="ingresa email" name="actualizar_email">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="pwd" placeholder="ingresa password" name="actualizar_pwd">
                <input type="hidden" name="passwordActual" value="<?php echo $usuario["password"]; ?>">
                <input type="hidden" name="tokenUsuario" value="<?php echo $usuario["token"]; ?>">
            </div>
        </div>
        <?php

        $actualizar =  ControladorFormularios::ctrActualizarRegistro();

        if ($actualizar == "ok") {
            echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            </script>';

            echo '<div class="alert alert-success" >El Usuario ha sido Actualizado</div>
                <script>
                setTimeout(function(){
                
                window.location = "index.php?pagina=inicio";
                },3000)
                
                </script
                
                ';
        }
        if ($actualizar == "error") {
            echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            </script>';

            echo '<div class="alert alert-success" >Error al actualizar el usuario</div>';
        }
        ?>
        <button type="submit" class="btn btn-primary">Actualizar</button>

    </form>
</div>
<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="nombre" placeholder="Enter nombre" name="registro_nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Correo Eletronico:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></i></span>
                </div>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="registro_email">
            </div>
        </div>

        <div class="form-group">
            <label for="pwd">Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="registro_pwd">
            </div>
        </div>

        <?php
        // Forma no estatica
        #$registro = new ControladorFormularios();
        #$registro->Registro();
        // FORMA ESTATICA
        $registro = ControladorFormularios::Registro();
        if ($registro == "ok") {
            //Metodo para borrar caché y no se ejecute metodos post 
            echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            
            </script>';

            echo '<div class="alert alert-success" >El Usuario ha sido Registrado</div>';
        }
        if ($registro == "error") {
            //Metodo para borrar caché y no se ejecute metodos post 
            echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            
            </script>';

            echo '<div class="alert alert-danger" >Error: No es permitido caracteres especiales. </div>';
        }

        ?>
        <button type="submit" class="btn btn-primary">Enviar</button>

    </form>
</div>
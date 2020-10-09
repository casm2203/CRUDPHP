<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">
        <div class="form-group">
            <label for="email">Correo Eletronico:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></i></span>
                </div>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="ingreso_email">
            </div>
        </div>

        <div class="form-group">
            <label for="pwd">Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="ingreso_pwd">
            </div>
        </div>

        <?php

        $ingreso = new ControladorFormularios();
        $ingreso->ctrIngreso();

        ?>
        <button type="submit" class="btn btn-primary">Ingresar</button>

    </form>
</div>
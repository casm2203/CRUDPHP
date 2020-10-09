<?php
if (isset($_SESSION["validarIngreso"])) {
    if ($_SESSION["validarIngreso"] != "ok") {
        echo '<script> window.location = "index.php?pagina=ingreso";  </script>';
        return;
    }
} else {
    echo '<script> window.location = "index.php?pagina=ingreso";  </script>';
    return;
}



$usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);
// echo '<pre>';
// print_r($usuarios);
// echo '</pre>';



?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $key => $value) : ?>
            <tr>
                <td><?php echo $value["id"] ?></td>
                <td><?php echo $value["nombre"] ?></td>
                <td><?php echo $value["email"] ?></td>
                <td><?php echo $value["fecha"] ?></td>
                <td>
                    <div class="btn-group">
                        <div class="px-1">
                            <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>

                        </div>


                        <form method="POST">
                            <input type="hidden" name="eliminarRegistro" value="<?php echo $value["token"]; ?>">

                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

                            <?php
                            $eliminar = new ControladorFormularios();
                            $eliminar->ctrEliminarRegistro();

                            ?>


                        </form>



                    </div>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
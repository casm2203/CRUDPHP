<?php
class ControladorFormularios
{


    static public function Registro()
    {
        if (isset($_POST["registro_nombre"])) {
            if (
                preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/', $_POST["registro_nombre"]) &&
                preg_match(
                    '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_])*[@][a-zA-Z0-9_][a-zA-ZáéíóúÁÉÍÓÚ ]+([.][a-zA-Z0-9_])*[.][a-zA-Z]{2,4}$/',
                    $_POST["registro_email"]
                ) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["registro_pwd"])
            ) {
                $token = md5($_POST["registro_nombre"] . "+" . $_POST["registro_email"]);
                $tabla = "registros";
                $encriptarPwd = crypt($_POST["registro_pwd"], '$2a$07$usesomesillystringforsalt$');

                $datos = array(
                    "token" => $token,
                    "nombre" => $_POST["registro_nombre"],
                    "email" => $_POST["registro_email"],
                    "password" => $encriptarPwd
                );

                $repuesta = ModelosFormularios::mdlRegistro($tabla, $datos);

                return $repuesta;
            } else {
                $repuesta = "error";
                return $repuesta;
            }
        }
    }



    static public function ctrSeleccionarRegistros($item, $valor)
    {
        $tabla = "registros";

        $respuesta = ModelosFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

        return $respuesta;
    }

    public function ctrIngreso()
    {

        if (isset($_POST["ingreso_email"])) {
            $tabla = "registros";

            $item = "email";

            $valor = ($_POST["ingreso_email"]);

            $respuesta = ModelosFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            $encriptarPwd = crypt($_POST["ingreso_pwd"], '$2a$07$usesomesillystringforsalt$');

            if ($respuesta["email"] == $_POST["ingreso_email"] && $respuesta["password"] == $encriptarPwd) {
                $_SESSION["validarIngreso"] = "ok";
                ModelosFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);

                echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            
            window.location = "inicio";
            </script> ';
            } else {
                if ($respuesta["intentos_fallidos"] < 3) {

                    $intentos_fallidos =  $respuesta["intentos_fallidos"] + 1;
                    ModelosFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);
                    echo "<pre>";
                    echo print_r($intentos_fallidos);
                    echo "</pre>";
                } else {
                    echo '<div class="alert alert-warning" >RECAPTCHA: Debes validar que no eres un subnormal o robot ;)</div>';
                }

                echo '<script> 
            if(window.history.replaceState)
            {
            window.history.replaceState(null, null, window.location.href)
            }
            
            </script>';

                echo '<div class="alert alert-danger" >El Usuario no fue encontrado</div>';
            }
        }
    }

    static public function ctrActualizarRegistro()
    {
        if (isset($_POST["actualizar_nombre"])) {
            if (
                preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizar_nombre"]) &&
                preg_match(
                    '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_])*[@][a-zA-Z0-9_][a-zA-ZáéíóúÁÉÍÓÚ ]+([.][a-zA-Z0-9_])*[.][a-zA-Z]{2,4}$/',
                    $_POST["actualizar_email"]
                )
            ) {
                $usuario = ModelosFormularios::mdlSeleccionarRegistros("registros", "token", $_POST["tokenUsuario"]);
                $ComparaToken = md5($usuario["nombre"] . "+" . $usuario["email"]);

                if ($ComparaToken == $_POST["tokenUsuario"]) {

                    if ($_POST["actualizar_pwd"] != "") {
                        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["actualizar_pwd"])) {
                            $password = crypt($_POST["actualizar_pwd"], '$2a$07$usesomesillystringforsalt$');
                        }
                    } else {
                        $password =  $_POST["passwordActual"];
                    }
                    $tabla = "registros";
                    $datos = array(
                        "token" => $_POST["tokenUsuario"],
                        "nombre" => $_POST["actualizar_nombre"],
                        "email" => $_POST["actualizar_email"],
                        "password" => $password
                    );

                    $respuesta = ModelosFormularios::mdlActualizarRegistro($tabla, $datos);
                    return $respuesta;
                } else {
                    $respuesta = "error";
                    return $respuesta;
                }
            }
        }
    }


    public function ctrEliminarRegistro()
    {
        if (isset($_POST["eliminarRegistro"])) {
            $usuario = ModelosFormularios::mdlSeleccionarRegistros("registros", "token", $_POST["eliminarRegistro"]);
            $ComparaToken = md5($usuario["nombre"] . "+" . $usuario["email"]);

            if ($ComparaToken == $_POST["eliminarRegistro"]) {

                $tabla = "registros";
                $valor = $_POST["eliminarRegistro"];

                $respuesta = ModelosFormularios::mdlEliminarRegistro($tabla, $valor);
                if ($respuesta == "ok") {
                    echo '<script> 
                  if(window.history.replaceState)
                {
                     window.history.replaceState(null, null, window.location.href)
                    }
            
                  window.location = "inicio";
                </script> ';
                }
            }
        }
    }
}

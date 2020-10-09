<?php

require_once "conexion.php";

class  ModelosFormularios
{

    static public function mdlRegistro($tabla, $datos)
    {
        #prepare() buscar, prepara una sentencia SQL

        $stmt =  Conexion::conectar()->prepare("INSERT INTO $tabla (token, nombre, email, password) 
        VALUES (:token, :nombre, :email, :password)");

        #bindPram() vincula una variable de php a un parametro de sustitución con nombre o de signo de interrogación
        #correspondiente  de la sentenci sql que fue usada para prepara la setencia.
        $stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlSeleccionarRegistros($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt =  Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY ID DESC");
            $stmt->execute();

            return $stmt->fetchAll();
        } else {
            $stmt =  Conexion::conectar()->prepare("SELECT *FROM $tabla where $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

        $stmt->close();

        $stmt = null;
    }


    static public function mdlActualizarRegistro($tabla, $datos)
    {
        $stmt =  Conexion::conectar()->prepare("UPDATE $tabla SET  nombre =:nombre, email=:email, password=:password 
        WHERE token = :token");

        $stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarRegistro($tabla, $valor)
    {
        $stmt =  Conexion::conectar()->prepare("DELETE FROM $tabla WHERE token = :token");

        $stmt->bindParam(":token", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt->close();
        $stmt = null;
    }




    //actualizar intentos fallidos
    static public function mdlActualizarIntentosFallidos($tabla, $valor, $token)
    {
        $stmt =  Conexion::conectar()->prepare("UPDATE $tabla SET  intentos_fallidos = :intentos_fallidos 
        WHERE token = :token");
        $stmt->bindParam(":intentos_fallidos", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt->close();
        $stmt = null;
    }
}

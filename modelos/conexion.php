<?php

class Conexion
{
    static public function conectar()
    {
        #PDO. (host name; name BD; name user; contraseña)
        $link = new PDO("mysql:host=localhost;dbname=curso-php", "root", "carfer");

        $link->exec("set names utf8");

        return $link;
    }
}
<?php

class ConexionBase
{


    public static function bd()
    {
        $bd = new mysqli("localhost", "root", "", "ingresos_salas_db");
        return $bd;
    }
}

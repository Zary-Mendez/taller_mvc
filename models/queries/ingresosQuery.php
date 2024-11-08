<?php

namespace App\models\queries;

class IngresosQuery{
    static function all(){
        return "select * from ingresos";
    }
}
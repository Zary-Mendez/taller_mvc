<?php

class Ingresos
{

    private $db;
    private $registros;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->registros = array();
    }

    public function getSalas()
    {
        $sql = "SELECT * FROM salas";
        $respuesta = $this->db->query($sql);
        while ($row = $respuesta->fetch_assoc()) {
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getResponsables()
    {
        $sql = "SELECT * FROM responsables";
        $respuesta = $this->db->query($sql);
        while ($row = $respuesta->fetch_assoc()) {
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getProgramas()
    {
        $sql = "SELECT * FROM programas";
        $respuesta = $this->db->query($sql);
        while ($row = $respuesta->fetch_assoc()) {
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getRegistros()
    {
        $resultado = $this->db->query("SELECT * FROM ingresos");
        while ($row = $resultado->fetch_assoc()) {
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function CambioSalida($codigoSalida , )
    {
        $resultado = $this->db->query("UPDATE ingresos SET horaSalida = NOW() WHERE codigoEstudiante = '$codigoSalida'");
    }

    public function insertarRegistro($codigo, $nombre, $idPrograma, $fecha, $hora, $idSala, $idResponsable)
    {
        $resultado = $this->db->query("INSERT INTO ingresos(codigoEstudiante, nombreEstudiante, idPrograma, fechaIngreso, horaIngreso, horaSalida, idResponsable, idSala)values('$codigo', '$nombre', '$idPrograma', '$fecha', '$hora', '00:00' , '$idResponsable', '$idSala') ");
    }
}
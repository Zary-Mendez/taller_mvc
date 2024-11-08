<?php



class RegistrosController
{

    public function __construct()
    {
        require_once "models/registrosModel.php";
    }

    public function ControllerValidarCodigoSalida()
    {
        $controlador = new RegistrosModel();
        $data['registros'] = $controlador->getRegistros();
        $codigoSalida = $_POST['codigoSalida'];

        foreach ($data['registros'] as $dato) {
            if ($codigoSalida == $dato['codigoEstudiante']) {
                $controlador->CambioSalida($codigoSalida);
                $this->index();
            } else {
                $errorMessage = "El código ingresado no existe en los registros";
                require_once "views/errorView.php";
            }
        }
    }

    //Pagina principal

    public function index()
    {
        require_once "views/principalView.php";
    }

    public function ControllerSalidas()
    {
        require_once "views/formSalida.php";
    }

    //Obtener todas las salas de la base de datos

    public function ControllerGetSalas()
    {
        $registro = new RegistrosModel();
        $data['salas'] = $registro->getSalas();

        require_once "views/viewSalas.php";
    }

    //Obtener todos los programas de la base de datos

    public function ControllerGetProgramas()
    {
        $registro = new RegistrosModel();
        $data['programas'] = $registro->getProgramas();

        require_once "views/viewProgramas.php";
    }
    //Obtener todos los responsables de la base de datos

    public function ControllerGetResponsables()
    {
        $registro = new RegistrosModel();
        $data['responsables'] = $registro->getResponsables();

        require_once "views/viewResponsables.php";
    }

    //Obtener todos los registros de la base de datos

    public function ControllerGetRegistros()
    {
        $registro = new RegistrosModel();
        $data['registros'] = $registro->getRegistros();

        require_once "views/registroActual.php";
    }

    //Acceso al formulario de ingreso

    public function ControllerIngreso()
    {
        require_once "views/formIngreso.php";
    }

    //Guardar nuevo ingreso

    public function ControllerGuardar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $programa = $_POST['programa'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $sala = $_POST['sala'];
        $responsable = $_POST['responsable'];

        if ($this->ControllerValidarCodigo($codigo)) {
            if ($this->ControllerValidarProgramas($programa)) {
                $idPrograma = $this->ControllerObtenerIdPrograma($programa);
                if ($this->ControllerValidarFechas($fecha, $hora)) {
                    if ($this->ControllerValidarSalas($sala)) {
                        $idSala = $this->ControllerObtenerIdSala($sala);
                        if ($this->ControllerValidarResponsables($responsable)) {
                            $idResponsable = $this->ControllerObtenerIdResponsable($responsable);
                            $controlador = new RegistrosModel();
                            $controlador->insertarRegistro($codigo, $nombre, $idPrograma, $fecha, $hora, $idSala, $idResponsable);
                            $this->index();
                        } else {
                            $errorMessage = "ERROR: El responsable ingresado no existe";
                            require_once "views/errorView.php";
                        }
                    } else {
                        $errorMessage = "ERROR: La sala ingresada no existe";
                        require_once "views/errorView.php";
                    }
                } else {
                    $errorMessage = "ERROR: Solo hay fechas de Lunes a viernes de 7am a 8:50pm y Sabados de 7:00am a 4:30pm";
                    require_once "views/errorView.php";
                }
            } else {
                $errorMessage = "ERROR: El programa ingresado no existe";
                require_once "views/errorView.php";
            }
        } else {
            $errorMessage = "El codigo en los registros ya existe";
            require_once "views/errorView.php";
        }
    }

    /*Validaciones de existencia de variables*/

    public function ControllerValidarSalas($sala)
    {
        $registro = new RegistrosModel();
        $data['salas'] = $registro->getSalas();

        foreach ($data['salas'] as $dato) {
            if ($dato['nombre'] == $sala) {
                return true;
            }
        }
        return false;
    }

    public function ControllerValidarCodigo($codigo)
    {
        $registro = new RegistrosModel();
        $data['codigo'] = $registro->getRegistros();

        foreach ($data['codigo'] as $dato) {
            if ($dato['codigoEstudiante'] == $codigo) {
                return false;
            }
        }
        return true;
    }

    public function ControllerObtenerIdSala($sala)
    {
        $registro = new RegistrosModel();
        $data['salas'] = $registro->getSalas();

        foreach ($data['salas'] as $dato) {
            if ($dato['nombre'] == $sala) {
                $resultado = $dato['id'];
            }
        }
        return $resultado;
    }

    public function ControllerValidarProgramas($programa)
    {
        $registro = new RegistrosModel();
        $data['programas'] = $registro->getProgramas();

        foreach ($data['programas'] as $dato) {
            if ($dato['nombre'] == $programa) {
                return true;
            }
        }
        return false;
    }

    public function ControllerObtenerIdPrograma($programa)
    {
        $registro = new RegistrosModel();
        $data['programas'] = $registro->getProgramas();

        foreach ($data['programas'] as $dato) {
            if ($dato['nombre'] == $programa) {
                $resultado = $dato['id'];
            }
        }
        return $resultado;
    }

    public function ControllerValidarResponsables($responsable)
    {
        $registro = new RegistrosModel();
        $data['responsables'] = $registro->getResponsables();

        foreach ($data['responsables'] as $dato) {
            if ($dato['nombre'] == $responsable) {
                return true;
            }
        }
        return false;
    }

    public function ControllerObtenerIdResponsable($responsable)
    {
        $registro = new RegistrosModel();
        $data['responsables'] = $registro->getResponsables();

        foreach ($data['responsables'] as $dato) {
            if ($dato['nombre'] == $responsable) {
                $resultado = $dato['id'];
            }
        }
        return $resultado;
    }

    public function ControllerValidarFechas($fecha, $hora)
    {
        $fechaIngresada = new DateTime($fecha);
        $diaSemana = $fechaIngresada->format('N');

        $horaIngresada = new DateTime($hora);

        if ($diaSemana <= 5) { // de lunes a viernes
            $horaInicio = new DateTime('7:00');
            $horaFin = new DateTime('20:50');

            if ($horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
                return false;
            }
            return true;
        } elseif ($diaSemana == 6) { // sábado
            $horaInicio = new DateTime('7:00');
            $horaFin = new DateTime('16:30');

            if ($horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
                return false;
            }
            return true;
        }

        return false;
    }
}

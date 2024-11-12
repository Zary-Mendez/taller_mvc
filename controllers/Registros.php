<?php

class RegistrosController
{

    public function __construct()
    {
        require_once "models/registrosModel.php";
    }

    public function ControllerModificarRegistro()
    {
        $codigo = $_GET['codigo'];
        $controller = new Ingresos();
        $data['registro'] = $controller->getRegistros();

        foreach ($data['registro'] as $dato) {
            if ($codigo == $dato['codigoEstudiante']) {
                require_once "views/formModificar.php";
            }
        }
    }

    public function ControllerModificar()
    {
        $codigoViejo = $_POST['codigoViejo'];
        $nuevoCodigo = $_POST['codigoNuevo'];
        $nuevoNombre = $_POST['nombreNuevo'];

        $controller = new Ingresos();
        $data['registro'] = $controller->modificarUsuario($nuevoCodigo, $nuevoNombre, $codigoViejo);
        $this->index();
    }

    public function ControllerValidarCodigoSalida()
    {
        $controlador = new Ingresos();
        $data['registros'] = $controlador->getRegistros();
        $codigoSalida = $_POST['codigoSalida'];
        $salida = $_POST['horaSalida'];
        $codigoEncontrado = false;

        foreach ($data['registros'] as $dato) {
            if ($codigoSalida == $dato['codigoEstudiante']) {
                $codigoEncontrado = true;
                if ($dato['horaSalida'] == '00:00:00') {

                    $controlador->CambioSalida($codigoSalida);
                    $this->index();
                    return;
                } else {
                    $errorMsg = "ERROR: Ya se registró la salida de este usuario ";
                    require_once "views/errorView.php";
                    return;
                }
            }
        }

        if (!$codigoEncontrado) {
            $errorMsg = "ERROR: El código ingresado no existe en los registros ";
            require_once "views/errorView.php";
        }
    }

    public function index()
    {
        require_once "views/principalView.php";
    }

    public function ControllerSalidas()
    {

        require_once "views/formSalida.php";
    }

    public function ControllerRegistrosSalas()
    {
        require_once "views/formRegistrarSala.php";
    }

    public function ControllerGuardarRegistroSalas()
    {
        $dia = $_POST['dia'];
        $materia = $_POST['materiaCurso'];
        $horaInicio = $_POST['horaInicioCurso'];
        $horaSalida = $_POST['horaFinCurso'];
        $programa = $_POST['programaCurso'];
        $sala = $_POST['salaCurso'];

        if ($this->ControllerValidarProgramas($programa)) {
            $idPrograma = $this->ControllerObtenerIdPrograma($programa);
            if ($this->ControllerValidarSalas($sala)) {
                if ($this->ControllerValidarFechaRegistroSalas($dia, $horaInicio)) {
                    $idSala = $this->ControllerObtenerIdSala($sala);
                    if ($this->ControllerObtenerRegistrosSalas($idSala, $horaInicio, $horaSalida, $dia)) {
                        $controlador = new Ingresos();
                        $controlador->insertarRegistroSala($dia, $materia, $horaInicio, $horaSalida, $idPrograma, $idSala);
                        $this->index();
                    } else {
                        $errorMsg = "ERROR: La hora ingresada no es valida";
                        require_once "views/errorView.php";
                    }
                } else {
                    $errorMsg = "ERROR: La hora ingresada no es valida";
                    require_once "views/errorView.php";
                }
            } else {
                $errorMsg = "ERROR: La sala ingresada no es valida";
                require_once "views/errorView.php";
            }
        } else {
            $errorMsg = "ERROR: El programa ingresado no es valido ";
            require_once "views/errorView.php";
        }
    }

    public function ControllerGetSalas()
    {
        $registro = new Ingresos();
        $data['salas'] = $registro->getSalas();

        require_once "views/viewSalas.php";
    }

    public function ControllerGetProgramas()
    {
        $registro = new Ingresos();
        $data['programas'] = $registro->getProgramas();

        require_once "views/viewProgramas.php";
    }

    public function ControllerGetResponsables()
    {
        $registro = new Ingresos();
        $data['responsables'] = $registro->getResponsables();

        require_once "views/viewResponsables.php";
    }

    public function ControllerGetRegistros()
    {
        $registro = new Ingresos();
        $data['registros'] = $registro->getRegistros();

        require_once "views/registroActual.php";
    }

    public function ControllerIngreso()
    {
        require_once "views/formIngreso.php";
    }

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
                            if ($this->ControllerValidarRegistro($idSala, $hora, $fecha)) {
                                $idResponsable = $this->ControllerObtenerIdResponsable($responsable);
                                $controlador = new Ingresos();
                                $controlador->insertarRegistro($codigo, $nombre, $idPrograma, $fecha, $hora, $idSala, $idResponsable);
                                $this->index();
                            } else {
                                $errorMsg = "ERROR: La sala ya esta apartada para una clase en ese horario ";
                                require_once "views/errorView.php";
                            }
                        } else {
                            $errorMsg = "ERROR: El responsable ingresado no existe ";
                            require_once "views/errorView.php";
                        }
                    } else {
                        $errorMsg = "ERROR: La sala ingresada no existe ";
                        require_once "views/errorView.php";
                    }
                } else {
                    $errorMsg = "ERROR: Solo hay fechas de Lunes a viernes de 7am a 8:50pm y Sabados de 7:00am a 4:30pm ";
                    require_once "views/errorView.php";
                }
            } else {
                $errorMsg = "ERROR: El programa ingresado no existe ";
                require_once "views/errorView.php";
            }
        } else {
            $errorMsg = "ERROR: El codigo en los registros ya existe ";
            require_once "views/errorView.php";
        }
    }

    public function ControllerValidarSalas($sala)
    {
        $registro = new Ingresos();
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
        $registro = new Ingresos();
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
        $registro = new Ingresos();
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
        $registro = new Ingresos();
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
        $registro = new Ingresos();
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
        $registro = new Ingresos();
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
        $registro = new Ingresos();
        $data['responsables'] = $registro->getResponsables();

        foreach ($data['responsables'] as $dato) {
            if ($dato['nombre'] == $responsable) {
                $resultado = $dato['id'];
            }
        }
        return $resultado;
    }
    public function ControllerValidarRegistro($sala, $horaInicio, $dia)
    {
        $controller = new Ingresos();
        $data['registros'] = $controller->getRegistrosSalas();

        $horaInicioNueva = new DateTime($horaInicio);

        if (!($dia instanceof DateTime)) {
            $dia = new DateTime($dia);
        }

        $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $diaSemana = $diasSemana[$dia->format('w')];

        foreach ($data['registros'] as $dato) {
            $horaInicioExistente = new DateTime($dato['horaInicio']);
            $horaFinExistente = new DateTime($dato['horaFin']);
            $horaInicioNueva = new DateTime($horaInicio);
            if (
                $dato['dia'] == $diaSemana &&
                $dato['idSala'] == $sala &&
                ($horaInicioNueva >= $horaInicioExistente && $horaInicioNueva < $horaFinExistente)
            ) {
                $errorMsg = "ERROR: La sala ya está apartada para esa fecha en ese horario ";
                require_once "views/errorView.php";
                return false;
            }
        }
        return true;
    }

    public function ControllerObtenerRegistrosSalas($idSala, $horaInicio, $horaSalida, $dia)
    {
        $registro = new Ingresos();
        $data['registros'] = $registro->getRegistrosSalas();

        if ($this->ControllerValidarFechaRegistroSalas($dia, $horaInicio)) {
            foreach ($data['registros'] as $dato) {
                if ($dato['dia'] == $dia && $dato['idSala'] == $idSala) {
                    $horaInicioExistente = new DateTime($dato['horaInicio']);
                    $horaFinExistente = new DateTime($dato['horaFin']);
                    $horaInicioNueva = new DateTime($horaInicio);
                    $horaFinNueva = new DateTime($horaSalida);

                    if (($horaInicioNueva < $horaFinExistente) && ($horaFinNueva > $horaInicioExistente)) {
                        $errorMsg = "La sala ya está apartada para esa fecha en ese horario";
                        require_once "views/errorView.php";
                        return false;
                    }
                }
            }
        } else {
            $errorMsg = "ERROR: Solo hay fechas de Lunes a viernes de 7am a 8:50pm y Sabados de 7:00am a 4:30pm ";
            require_once "views/errorView.php";
            return false;
        }

        return true;
    }

    public function ControllerValidarFechas($fecha, $hora)
    {
        $fechaIngresada = new DateTime($fecha);
        $diaSemana = $fechaIngresada->format('N');

        $horaIngresada = new DateTime($hora);

        if ($diaSemana <= 5) { 
            $horaInicio = new DateTime('7:00');
            $horaFin = new DateTime('20:50');

            if ($horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
                return false;
            }
            return true;
        } elseif ($diaSemana == 6) { 
            $horaInicio = new DateTime('7:00');
            $horaFin = new DateTime('16:30');

            if ($horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
                return false;
            }
            return true;
        }

        return false;
    }

    public function ControllerValidarFechaRegistroSalas($fecha, $horaIngresada)
    {

        $horaIngresada = new DateTime($horaIngresada);
        if ($fecha == 'Lunes' || $fecha == 'Martes' || $fecha == 'Miercoles' || $fecha == 'Jueves' || $fecha == 'Viernes') {
            $horaInicio = new DateTime('7:00');
            $horaFin = new DateTime('20:50');

            if ($horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
                return false;
            }
            return true;
        } elseif ($fecha == 'Sabado') {
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

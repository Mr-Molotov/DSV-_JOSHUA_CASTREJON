<?php
require_once 'Tarea.php';

class TareaDesarrollo extends Tarea {
    private $lenguajeProgramacion;

    public function __construct($datos, $lenguajeProgramacion) {
        parent::__construct($datos);
        $this->lenguajeProgramacion = $lenguajeProgramacion;
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }
}
?>
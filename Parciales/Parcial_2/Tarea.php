<?php
class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = trim($estado);
    }

    public function getPrioridad(){
        return $this->prioridad;
    }

    public function setPrioridad($prioridad){
        $this->prioridad = trim($prioridad);
    }

    // Implementar estos getters
    // public function getEstado() { }
    // public function getPrioridad() { }
}

?>
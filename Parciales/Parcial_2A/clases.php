<?php
interface Detalles{
    public function obtenerDetallesEspecificos(): string;
}

abstract class Entrada implements Detalles
{
    public $id;
    public $create_date;
    public $type;

    abstract public function obtenerDetallesEspecificos(): string;

    public function __construct($id, $create_date, $type)
    {
        $this->$id = $id;
        $this->$create_date = $create_date;
        $this->$type = $type;
    }

    public function getId(){
        return $this->id;
    }

    public function getCreate_date(){
        return $this->create_date;
    }

    public function getType(){
        return $this->type;
    }

}

class EntradaUnaColumna extends Entrada
{
    private $titulo;
    private $descripcion;

    public function __construct($id, $create_date, $type, $titulo, $descripcion) {
        parent::__construct($id, $create_date, $type);
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: {$this->titulo}";
    }
}

class EntradaDosColumna extends Entrada{
    private $titulo;
    private $descripcion;
    private $titulo_2;
    private $descripcion_2;

    public function __construct($id, $create_date, $type, $titulo, $descripcion, $titulo_2, $descripcion_2) {
        parent::__construct($id, $create_date, $type);
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->titulo_2 = $titulo_2;
        $this->descripcion_2 = $descripcion_2;
    }
    
    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: {$this->titulo} | {$this->titulo_2}";
    }

}

class EntradaTresColumna extends Entrada{
    private $titulo;
    private $descripcion;
    private $titulo_2;
    private $descripcion_2;
    private $titulo_3;
    private $descripcion_3;

    public function __construct($id, $create_date, $type, $titulo, $descripcion, $titulo_2, $descripcion_2, $titulo_3, $descripcion_3) {
        parent::__construct($id, $create_date, $type);
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->titulo_2 = $titulo_2;
        $this->descripcion_2 = $descripcion_2;
        $this->titulo_3 = $titulo_3;
        $this->descripcion_3 = $descripcion_3;
    }
    
    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: {$this->titulo} | {$this->titulo_2} | {$this->titulo_3}";
    }

}

class GestorBlog {
    
}




?>
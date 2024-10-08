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
    private $entradas = [];

    public function cargarEntradas() {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                $this->entradas[] = new Entrada($entradaData);
            }
        }
    }

    public function guardarEntradas() {
        $data = array_map(function($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public function obtenerEntradas() {
        return $this->entradas;
    }

    // Método para agregar una nueva entrada
    public function agregarEntrada(Entrada $entrada) {
        $this->entradas[$entrada->id] = $entrada;
    }

    // Método para editar una entrada existente
    public function editarEntrada(Entrada $entrada) {
        if (isset($this->entradas[$entrada->id])) {
            $this->entradas[$entrada->id] = $entrada;
        } else {
            echo "Entrada no encontrada.\n";
        }
    }

    // Método para eliminar una entrada por su ID
    public function eliminarEntrada($id) {
        if (isset($this->entradas[$id])) {
            unset($this->entradas[$id]);
        } else {
            echo "Entrada no encontrada.\n";
        }
    }

    // Método para obtener una entrada específica por su ID
    public function obtenerEntrada($id) {
        if (isset($this->entradas[$id])) {
            return $this->entradas[$id];
        } else {
            echo "Entrada no encontrada.\n";
            return null;
        }
    }

    // Método para mover una entrada hacia arriba o abajo en la lista
    public function moverEntrada($id, $direccion) {
        if (!isset($this->entradas[$id])) {
            echo "Entrada no encontrada.\n";
            return;
        }

        $keys = array_keys($this->entradas);
        $index = array_search($id, $keys);

        if ($direccion === 'arriba' && $index > 0) {
            $temp = $keys[$index - 1];
            $keys[$index - 1] = $keys[$index];
            $keys[$index] = $temp;
        } elseif ($direccion === 'abajo' && $index < count($keys) - 1) {
            $temp = $keys[$index + 1];
            $keys[$index + 1] = $keys[$index];
            $keys[$index] = $temp;
        } else {
            echo "Movimiento no válido.\n";
            return;
        }

        $this->entradas = array_merge(array_flip($keys), $this->entradas);
    }
}






?>
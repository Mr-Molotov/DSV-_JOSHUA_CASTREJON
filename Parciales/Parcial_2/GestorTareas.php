<?php
class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }

    
}

// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea
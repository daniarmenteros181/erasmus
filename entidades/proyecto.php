<?php
class Proyecto {
    private $id;
    private $cod_proyecto;
    private $nombre;
    private $fechaInicio;
    private $fechaFin;

    public function __construct($cod_proyecto, $nombre, $fechaInicio, $fechaFin) {
        $this->cod_proyecto = $cod_proyecto;
        $this->nombre = $nombre;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function getId() {
        return $this->id;
    }

    public function getCodProyecto() {
        return $this->cod_proyecto;
    }

    public function setCodProyecto($cod_proyecto) {
        $this->cod_proyecto = $cod_proyecto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }
}

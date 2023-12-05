<?php
class Convocatoria {
    private $id;
    private $movilidades;
    private $tipo;
    private $fechaInicio;
    private $fechaFin;
    private $fechaInicioPrueba;
    private $fechaFinPrueba;
    private $fechaInicioDefinitiva;
    private $fkProyecto;

    public function __construct($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fkProyecto) {
        $this->movilidades = $movilidades;
        $this->tipo = $tipo;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->fechaInicioPrueba = $fechaInicioPrueba;
        $this->fechaFinPrueba = $fechaFinPrueba;
        $this->fechaInicioDefinitiva = $fechaInicioDefinitiva;
        $this->fkProyecto = $fkProyecto;
    }

    public function getId() {
        return $this->id;
    }

    public function getMovilidades() {
        return $this->movilidades;
    }

    public function setMovilidades($movilidades) {
        $this->movilidades = $movilidades;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
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

    public function getFechaInicioPrueba() {
        return $this->fechaInicioPrueba;
    }

    public function setFechaInicioPrueba($fechaInicioPrueba) {
        $this->fechaInicioPrueba = $fechaInicioPrueba;
    }

    public function getFechaFinPrueba() {
        return $this->fechaFinPrueba;
    }

    public function setFechaFinPrueba($fechaFinPrueba) {
        $this->fechaFinPrueba = $fechaFinPrueba;
    }

    public function getFechaInicioDefinitiva() {
        return $this->fechaInicioDefinitiva;
    }

    public function setFechaInicioDefinitiva($fechaInicioDefinitiva) {
        $this->fechaInicioDefinitiva = $fechaInicioDefinitiva;
    }

    public function getFkProyecto() {
        return $this->fkProyecto;
    }

    public function setFkProyecto($fkProyecto) {
        $this->fkProyecto = $fkProyecto;
    }
}

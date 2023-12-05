<?php
class Tutor {
    private $id;
    private $dni;
    private $nombre;
    private $apellidos;
    private $tlf;
    private $domicilio;

    public function __construct($dni, $nombre, $apellidos, $tlf, $domicilio) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->tlf = $tlf;
        $this->domicilio = $domicilio;
    }

    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getTlf() {
        return $this->tlf;
    }

    public function setTlf($tlf) {
        $this->tlf = $tlf;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }
}

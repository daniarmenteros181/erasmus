<?php
class Candidatos {
    private $id;
    private $dni;
    private $fechaNac;
    private $apellidos;
    private $nombre;
    private $tlf;
    private $correo;
    private $domicilio;
    private $fkTutor;
    private $fkDestinatario;
    private $contrasenia;
    private $rol;


    public function __construct($id, $dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio, $fkTutor, $fkDestinatario, $contrasenia,$rol) {
        $this->id = $id;
        $this->dni = $dni;
        $this->fechaNac = $fechaNac;
        $this->apellidos = $apellidos;
        $this->nombre = $nombre;
        $this->tlf = $tlf;
        $this->correo = $correo;
        $this->domicilio = $domicilio;
        $this->fkTutor = $fkTutor;
        $this->fkDestinatario = $fkDestinatario;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;

    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getFechaNac() {
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getTlf() {
        return $this->tlf;
    }

    public function setTlf($tlf) {
        $this->tlf = $tlf;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function getFkTutor() {
        return $this->fkTutor;
    }

    public function setFkTutor($fkTutor) {
        $this->fkTutor = $fkTutor;
    }

    public function getFkDestinatario() {
        return $this->fkDestinatario;
    }

    public function setFkDestinatario($fkDestinatario) {
        $this->fkDestinatario = $fkDestinatario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }
    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

}

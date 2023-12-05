<?php
class NivelesIdiomas {
    private $id;
    private $niveles;

    public function __construct($niveles) {
        $this->niveles = $niveles;
    }

    public function getId() {
        return $this->id;
    }

    public function getNiveles() {
        return $this->niveles;
    }

    public function setNiveles($niveles) {
        $this->niveles = $niveles;
    }
}

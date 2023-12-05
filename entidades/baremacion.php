<?php
class Baremacion {
    private $id;
    private $fkCandidatosBaremacion;
    private $fkConvocatoriasBaremacion;
    private $fkItemBaremo;
    private $notas;

    public function __construct($id, $fkCandidatosBaremacion, $fkConvocatoriasBaremacion, $fkItemBaremo, $notas) {
        $this->id = $id;
        $this->fkCandidatosBaremacion = $fkCandidatosBaremacion;
        $this->fkConvocatoriasBaremacion = $fkConvocatoriasBaremacion;
        $this->fkItemBaremo = $fkItemBaremo;
        $this->notas = $notas;
    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getFkCandidatosBaremacion() {
        return $this->fkCandidatosBaremacion;
    }

    public function setFkCandidatosBaremacion($fkCandidatosBaremacion) {
        $this->fkCandidatosBaremacion = $fkCandidatosBaremacion;
    }

    public function getFkConvocatoriasBaremacion() {
        return $this->fkConvocatoriasBaremacion;
    }

    public function setFkConvocatoriasBaremacion($fkConvocatoriasBaremacion) {
        $this->fkConvocatoriasBaremacion = $fkConvocatoriasBaremacion;
    }

    public function getFkItemBaremo() {
        return $this->fkItemBaremo;
    }

    public function setFkItemBaremo($fkItemBaremo) {
        $this->fkItemBaremo = $fkItemBaremo;
    }

    public function getNotas() {
        return $this->notas;
    }

    public function setNotas($notas) {
        $this->notas = $notas;
    }
}

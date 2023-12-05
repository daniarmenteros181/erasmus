<?php
class ConvocatoriaBaremo {
    private $id;
    private $requisito;
    private $notaMaxima;
    private $fkConvocatoria;
    private $fkItemBaremo;
    private $valorMinimo;
    private $aportaAlumno; 


    public function __construct($requisito, $notaMaxima, $fkConvocatoria, $fkItemBaremo, $valorMinimo, $aportaAlumno) {
        $this->requisito = $requisito;
        $this->notaMaxima = $notaMaxima;
        $this->fkConvocatoria = $fkConvocatoria;
        $this->fkItemBaremo = $fkItemBaremo;
        $this->valorMinimo = $valorMinimo;
        $this->aportaAlumno = $aportaAlumno;

    }

    public function getId() {
        return $this->id;
    }

    public function getRequisito() {
        return $this->requisito;
    }

    public function setRequisito($requisito) {
        $this->requisito = $requisito;
    }

    public function getNotaMaxima() {
        return $this->notaMaxima;
    }

    public function setNotaMaxima($notaMaxima) {
        $this->notaMaxima = $notaMaxima;
    }

    public function getFkConvocatoria() {
        return $this->fkConvocatoria;
    }

    public function setFkConvocatoria($fkConvocatoria) {
        $this->fkConvocatoria = $fkConvocatoria;
    }

    public function getFkItemBaremo() {
        return $this->fkItemBaremo;
    }

    public function setFkItemBaremo($fkItemBaremo) {
        $this->fkItemBaremo = $fkItemBaremo;
    }

    public function getValorMinimo() {
        return $this->valorMinimo;
    }

    public function setValorMinimo($valorMinimo) {
        $this->valorMinimo = $valorMinimo;
    }
    public function getAportaAlumno() {
        return $this->aportaAlumno;
    }

    public function setAportaAlumno($aportaAlumno) {
        $this->aportaAlumno = $aportaAlumno;
    }
}

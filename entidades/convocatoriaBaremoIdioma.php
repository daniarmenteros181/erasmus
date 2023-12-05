<?php
class ConvocatoriaBaremoIdioma {
    private $id;
    private $fkNivelesIdiomas;
    private $fkConvocatoriaBaremo;
    private $valor;

    public function __construct($fkNivelesIdiomas, $fkConvocatoriaBaremo, $valor) {
        $this->fkNivelesIdiomas = $fkNivelesIdiomas;
        $this->fkConvocatoriaBaremo = $fkConvocatoriaBaremo;
        $this->valor = $valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getFkNivelesIdiomas() {
        return $this->fkNivelesIdiomas;
    }

    public function setFkNivelesIdiomas($fkNivelesIdiomas) {
        $this->fkNivelesIdiomas = $fkNivelesIdiomas;
    }

    public function getFkConvocatoriaBaremo() {
        return $this->fkConvocatoriaBaremo;
    }

    public function setFkConvocatoriaBaremo($fkConvocatoriaBaremo) {
        $this->fkConvocatoriaBaremo = $fkConvocatoriaBaremo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
}

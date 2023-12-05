<?php
class CandidatosConvocatoria {
    private $id;
    private $idConvocatoria;
    private $idCandidato;

    public function __construct($idConvocatoria, $idCandidato) {
        $this->idConvocatoria = $idConvocatoria;
        $this->idCandidato = $idCandidato;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function getIdCandidato() {
        return $this->idCandidato;
    }

    public function setIdCandidato($idCandidato) {
        $this->idCandidato = $idCandidato;
    }
}

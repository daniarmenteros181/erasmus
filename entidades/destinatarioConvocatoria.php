<?php
class DestinatarioConvocatoria {
    private $id;
    private $idDestinatario;
    private $idConvocatoria;

    public function __construct($idDestinatario, $idConvocatoria) {
        $this->idDestinatario = $idDestinatario;
        $this->idConvocatoria = $idConvocatoria;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdDestinatario() {
        return $this->idDestinatario;
    }

    public function setIdDestinatario($idDestinatario) {
        $this->idDestinatario = $idDestinatario;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }
}
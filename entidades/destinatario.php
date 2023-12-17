<?php
class Destinatario {
    private $codGrupo;
    private $nombre;

    public function __construct($codGrupo, $nombre) {
        $this->codGrupo = $codGrupo;
        $this->nombre = $nombre;
    }

   
    public function getCodGrupo() {
        return $this->codGrupo;
    }

    public function setCodGrupo($codGrupo) {
        $this->codGrupo = $codGrupo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}

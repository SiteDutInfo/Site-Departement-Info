<?php

require_once("class.Pays.php");

class Ville extends Pays {
    private $adresse = null;
    private $cp = 0;

    private $lesEntreprises = array();


    // OPERATIONS
    public function Ville($adresse=null, $cp=0) {
        $this->adresse = $adresse;
        $this->cp = $cp;
    }

    public function getAdresse(){return $this->adresse;}
    public function getCp(){return $this->cp;}
    public function getLesEntreprises(){return $this->lesEntreprises;}

    public function setAdresse($adresse){$this->adresse=$adresse;}
    public function setCp($cp){$this->cp=$cp;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises=$lesEntreprises;}
}
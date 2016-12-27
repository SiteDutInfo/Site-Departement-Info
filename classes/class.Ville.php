<?php

require_once("class.Pays.php");

class Ville extends Pays {
    private $nomVille = 0;
    private $adresse = null;
    private $cp = 0;

    private $lesEntreprises = array();


    // OPERATIONS
    public function Ville($nomVille = 0, $adresse=null, $cp=0) {
        $this->nomVille = $nomVille;
        $this->adresse = $adresse;
        $this->cp = $cp;
    }

    public function getNomVille(){return $this->nomVille;}
    public function getAdresse(){return $this->adresse;}
    public function getCp(){return $this->cp;}
    public function getLesEntreprises(){return $this->lesEntreprises;}

    public function setNomVille($nomVille){$this->nomVille=$nomVille;}
    public function setAdresse($adresse){$this->adresse=$adresse;}
    public function setCp($cp){$this->cp=$cp;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises=$lesEntreprises;}
}
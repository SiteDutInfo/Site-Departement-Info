<?php

require_once("class.Pays.php");
require_once("class.Entreprise.php");

class Ville {
    private $id = 0;
    private $nom = null;
    private $adresse = null;
    private $cp = 0;

    private $lePays = null;
    private $lesEntreprises = array();


    // OPERATIONS
    public function Ville($id = 0, $nom = null, $adresse=null, $cp=0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->cp = $cp;
    }

    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getAdresse(){return $this->adresse;}
    public function getCp(){return $this->cp;}
    public function getLePays(){return $this->lePays;}
    public function getLesEntreprises(){return $this->lesEntreprises;}

    public function setId($id){$this->id=$id;}
    public function setNomVille($nom){$this->nom=$nom;}
    public function setAdresse($adresse){$this->adresse=$adresse;}
    public function setCp($cp){$this->cp=$cp;}
    public function setLePays($lePays){$this->lePays=$lePays;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises=$lesEntreprises;}
}
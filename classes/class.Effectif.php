<?php

require_once("class.Entreprise.php");

class Effectif {
    private $id = 0;
    private $qte = null;

    private $lesEntreprises = array();


    // OPERATIONS
    public function Effectif($id=0, $qte=null){
        $this->id=$id;
        $this->qte=$qte;
    }

    public function getId(){return $this->id;}
    public function getQte(){return $this->qte;}
    public function getLesEntreprises(){return $this->lesEntreprises;}

    public function setId($id){$this->id=$id;}
    public function setQte($qte){$this->qte=$qte;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises=$lesEntreprises;}
}
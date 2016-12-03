<?php

require_once("class.Entreprise.php");

class TypeEntreprise {
    private $id = 0;
    private $lib = null;

    private $lesEntreprises = array();


    // OPERATIONS
    public function TypeEntreprise($id=0, $lib=null){
        $this->id=$id;
        $this->lib=$lib;
    }

    public function getId(){return $this->id;}
    public function getLib(){return $this->lib;}
    public function getLesEntreprises(){return $this->lesEntreprises;}

    public function setId($id){$this->id=$id;}
    public function setLib($lib){$this->lib=$lib;}
    public function setLesEntreprises($lesEntreprises){$this->lesEntreprises=$lesEntreprises;}
}
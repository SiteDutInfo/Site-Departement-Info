<?php

require_once("class.Annonce.php");

class Administrateur {
    private $id = 0;
    private $login = null;
    private $mdp = null;

    private $lesAnnonces = array();


    // OPERATIONS
    public function Administrateur($id=0, $login=null, $mdp=null){
        $this->id=$id;
        $this->login=$login;
        $this->mdp=$mdp;
    }

    public function getId(){return $this->id;}
    public function getLogin(){return $this->login;}
    public function getMdp(){return $this->mdp;}
    public function getLesAnnonces(){return $this->lesAnnonces;}

    public function setId($id){$this->id=$id;}
    public function setLogin($login){$this->login=$login;}
    public function setMdp($mdp){$this->mdp=$mdp;}
    public function setLesAnnonces($lesAnnonces){$this->lesAnnonces=$lesAnnonces;}
}
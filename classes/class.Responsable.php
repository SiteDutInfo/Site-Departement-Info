<?php

require_once("class.Entreprise.php");

class Responsable {
    private $id = 0;
    private $nom = null;
    private $mail = null;
    private $tel = 0;

    private $entreprise = null;


    // OPERATIONS
    public function Responsable($id=0, $nom=null, $mail=null, $tel=0){
        $this->id=$id;
        $this->nom=$nom;
        $this->mail=$mail;
        $this->tel=$tel;
    }

    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getMail(){return $this->mail;}
    public function getTel(){return $this->tel;}
    public function getEntreprise(){return $this->entreprise;}

    public function setId($id){$this->id=$id;}
    public function setNom($nom){$this->nom=$nom;}
    public function setMail($mail){$this->mail=$mail;}
    public function setTel($tel){$this->tel=$tel;}
    public function setEntreprise($entreprise){$this->entreprise=$entreprise;}
}
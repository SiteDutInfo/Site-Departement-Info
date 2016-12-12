<?php

require_once("class.Entreprise.php");
require_once("class.Administrateur.php");

class Annonce {
    private $id = 0;
    private $posteRecherche = null;
    private $descPoste = null;
    private $profilRecherche = null;
    private $debut = null;
    private $fin = null;
    private $etatPublication = false;

    private $entreprise = null;
    private $admin = null;


    // OPERATIONS
    public function Annonce($id = 0, $posteRecherche = null, $descPoste = null,
                            $profilRecherche = null, $debut = null, $fin = null,
                            $etatPublication = false) {
        $this->id=$id;
        $this->posteRecherche=$posteRecherche;
        $this->descPoste=$descPoste;
        $this->profilRecherche=$profilRecherche;
        $this->debut=$debut;
        $this->fin=$fin;
        $this->etatPublication=$etatPublication;
    }

    public function getId(){return $this->id;}
    public function getPosteRecherche(){return $this->posteRecherche;}
    public function getDescPoste(){return $this->descPoste;}
    public function getProfilRecherche(){return $this->profilRecherche;}
    public function getDebut(){return $this->debut;}
    public function getFin(){return $this->fin;}
    public function getEtatPublication(){return $this->etatPublication;}
    public function getEntreprise(){return $this->entreprise;}
    public function getAdmin(){return $this->admin;}

    public function setId($id){$this->id=$id;}
    public function setPosteRecherche($posteRecherche){$this->posteRecherche=$posteRecherche;}
    public function setDescPoste($descPoste){$this->descPoste=$descPoste;}
    public function setProfilRecherche($profilRecherche){$this->profilRecherche=$profilRecherche;}
    public function setDebut($debut){$this->debut=$debut;}
    public function setFin($fin){$this->fin=$fin;}
    public function setEtatPublication($etatPublication){$this->etatPublication=$etatPublication;}
    public function setEntreprise($entreprise){$this->entreprise=$entreprise;}
    public function setAdmin($admin){$this->admin=$admin;}
}
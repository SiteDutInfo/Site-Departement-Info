<?php

require_once("class.Ville.php");
require_once("class.Responsable.php");
require_once("class.TypeEntreprise.php");
require_once("class.StatutJuridique.php");
require_once("class.Effectif.php");
require_once("class.Annonce.php");

class Entreprise {
    private $id = 0;
    private $nom = null;
    private $numSiret = null;
    private $codeApeNaf = null;
    private $url = null;
    private $desc = null;
    private $login = null;
    private $mdp = null;
    private $logo = null;

    private $laVille = null;
    private $leResponsable = null;
    private $leTypeEntreprise = null;
    private $leStatutJuridique = null;
    private $effectif = null;
    private $lesAnnonces = array();


    // OPERATIONS
    public function Entreprise($id = 0, $nom = null, $numSiret = null,
                               $codeApeNaf = null, $url = null, $desc = null,
                               $login = null, $mdp = null, $logo = null){
        $this->id=$id;
        $this->nom=$nom;
        $this->numSiret=$numSiret;
        $this->codeApeNaf=$codeApeNaf;
        $this->url=$url;
        $this->desc=$desc;
        $this->login=$login;
        $this->mdp=$mdp;
        $this->logo=$logo;
    }

    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getNumSiret(){return $this->numSiret;}
    public function getCodeApeNaf(){return $this->codeApeNaf;}
    public function getUrl(){return $this->url;}
    public function getDesc(){return $this->desc;}
    public function getLogin(){return $this->login;}
    public function getMdp(){return $this->mdp;}
    public function getLogo(){return $this->logo;}
    public function getLaVille(){return $this->laVille;}
    public function getLeResponsable(){return $this->leResponsable;}
    public function getLeTypeEnt(){return $this->leTypeEntreprise;}
    public function getLeStatutJur(){return $this->leStatutJuridique;}
    public function getEffectif(){return $this->effectif;}
    public function getLesAnnonces(){return $this->lesAnnonces;}

    public function setId($id){$this->id=$id;}
    public function setNom($nom){$this->nom=$nom;}
    public function setNumSiret($numSiret){$this->numSiret=$numSiret;}
    public function setCodeApeNaf($codeApeNaf){$this->codeApeNaf=$codeApeNaf;}
    public function setUrl($url){$this->url=$url;}
    public function setDesc($desc){$this->desc=$desc;}
    public function setLogin($login){$this->login=$login;}
    public function setMdp($mdp){$this->mdp=$mdp;}
    public function setLogo($logo){$this->logo=$logo;}
    public function setLaVille($laVille){$this->laVille=$laVille;}
    public function setLeResponsable($leResponsable){$this->leResponsable=$leResponsable;}
    public function setLeTypeEnt($leTypeEntreprise){$this->leTypeEntreprise=$leTypeEntreprise;}
    public function setLeStatutJur($leStatutJuridique){$this->leStatutJuridique=$leStatutJuridique;}
    public function setEffectif($effectif){$this->effectif=$effectif;}
    public function setLesAnnonces($lesAnnonces){$this->lesAnnonces=$lesAnnonces;}






}
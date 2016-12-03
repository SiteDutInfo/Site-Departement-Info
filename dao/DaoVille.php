<?php

require_once("Dao.php");
require_once("classes/class.Ville.php");

class DaoVille extends DaoPays {
    public function DaoVille(){
        parent::__construct();
        $this->bean = new Ville();
    }

    public function find($id) {
        $donnees = $this->findById("ville", "ID_VILLE", $id);
        $this->bean->setId($donnees['ID_VILLE']);
        $this->bean->setNom($donnees['NOM_VILLE']);
        $this->bean->setAdresse($donnees['ADRESSE']);
        $this->bean->setCp($donnees['CP']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM ville
                ORDER BY CP";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $ville = new Ville($donnees['ID_VILLE'], $donnees['NOM_VILLE'], $donnees['ADRESSE'], $donnees['CP']);
                $liste[] = $ville;
            }
        }
        return $liste;
    }

    public function create(){
    }

    public function update(){
    }

    public function delete(){
    }

    public function setLesEntreprises(){
        $sql = "SELECT *
                FROM ville, entreprise
                WHERE
                ville.ID_VILLE = ".$this->bean->getId()."
                AND ville.ID_ENT = entreprise.ID_ENT
                ORDER BY NOM_ENT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $entreprise = new Entreprise($donnees['ID_ENT'], $donnees['NOM_ENT'], $donnees['NUM_SIRET'], $donnees['CODE_APE_NAF'], $donnees['URL_ENT'], $donnees['DESC_ENT'], $donnees['LOGIN_ENT'], $donnees['MDP_ENT'], $donnees['LOGO']);
                $liste[] = $entreprise;
            }
            $this->bean->setLesEntreprises($liste);
        }
    }
}
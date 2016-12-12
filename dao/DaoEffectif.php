<?php

require_once("Dao.php");
require_once("classes/class.Effectif.php");

class DaoEffectif extends Dao {
    public function DaoEffectif(){
        parent::__construct();
        $this->bean = new Effectif();
    }

    public function find($id) {
        $donnees = $this->findById("effectif", "ID_EFF", $id);
        $this->bean->setId($donnees['ID_EFF']);
        $this->bean->setQte($donnees['QTE_EFF']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM effectif
                ORDER BY ID_EFF";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $effectif = new Effectif($donnees['ID_EFF'], $donnees['QTE_EFF']);
                $liste[] = $effectif;
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
                FROM effectif, entreprise
                WHERE
                effectif.ID_EFF = ".$this->bean->getId()."
                AND effectif.ID_ENT = entreprise.ID_ENT
                ORDER BY LIB_STATUT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $entreprise = new Entreprise(
                    $donnees['ID_ENT'],
                    $donnees['NOM_ENT'],
                    $donnees['NUM_SIRET'],
                    $donnees['CODE_APE_NAF'],
                    $donnees['URL_ENT'],
                    $donnees['DESC_ENT'],
                    $donnees['LOGIN_ENT'],
                    $donnees['MDP_ENT'],
                    $donnees['LOGO']
                );
                $liste[] = $entreprise;
            }
            $this->bean->setLesEntreprises($liste);
        }
    }
}
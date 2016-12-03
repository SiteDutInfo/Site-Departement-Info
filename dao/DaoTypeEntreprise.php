<?php

require_once("Dao.php");
require_once("classes/class.TypeEntreprise.php");

class DaoTypeEntreprise extends Dao {
    public function DaoTypeEntreprise(){
        parent::__construct();
        $this->bean = new TypeEntreprise();
    }

    public function find($id) {
        $donnees = $this->findById("type_entreprise", "ID_TYPE_ENT", $id);
        $this->bean->setId($donnees['ID_TYPE_ENT']);
        $this->bean->setLib($donnees['LIB_TYPE_ENT']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM type_entreprise
                ORDER BY LIB_TYPE_ENT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                    $typeEnt = new TypeEntreprise($donnees['ID_TYPE_ENT'], $donnees['LIB_TYPE_ENT']);
                $liste[] = $typeEnt;
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
                FROM type_entreprise, entreprise
                WHERE
                type_entreprise.ID_TYPE_ENT = ".$this->bean->getId()."
                AND type_entreprise.ID_ENT = entreprise.ID_ENT
                ORDER BY LIB_TYPE_ENT";
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
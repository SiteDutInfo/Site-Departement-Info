<?php

require_once("Dao.php");
require_once("classes/class.StatutJuridique.php");

class DaoStatutJuridique extends Dao {
    public function DaoStatutJuridique(){
        parent::__construct();
        $this->bean = new StatutJuridique();
    }

    public function find($id) {
        $donnees = $this->findById("statut_juridique", "ID_STATUT", $id);
        $this->bean->setId($donnees['ID_STATUT']);
        $this->bean->setLib($donnees['LIB_STATUT']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM statut_juridique
                ORDER BY LIB_STATUT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $statutJur = new StatutJuridique($donnees['ID_STATUT'], $donnees['LIB_STATUT']);
                $liste[] = $statutJur;
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
                FROM statut_juridique, entreprise
                WHERE
                statut_juridique.ID_STATUT = ".$this->bean->getId()."
                AND statut_juridique.ID_ENT = entreprise.ID_ENT
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
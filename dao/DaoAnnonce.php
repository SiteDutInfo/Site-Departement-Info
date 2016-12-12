<?php

require_once("Dao.php");
require_once("classes/class.Annonce.php");

class DaoAnnonce extends Dao {
    public function DaoAnnonce(){
        parent::__construct();
        $this->bean = new Annonce();
    }

    public function find($id) {
        $donnees = $this->findById("annonce", "ID_ANNONCE", $id);
        $this->bean->setId($donnees['ID_ANNONCE']);
        $this->bean->setPosteRecherche($donnees['POSTE_RECHERCHE']);
        $this->bean->setDescPoste($donnees['DESC_POSTE']);
        $this->bean->setProfilRecherche($donnees['PROFIL_RECHERCHE']);
        $this->bean->setDebut($donnees['DEBUT_STAGE']);
        $this->bean->setFin($donnees['FIN_STAGE']);
        $this->bean->setStage($donnees['STAGE']);
        $this->bean->setEtatPublication($donnees['ETAT_PUBLICATION']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM annonce
                ORDER BY DEBUT_STAGE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $annonce = new Annonce($donnees['ID_ANNONCE'], $donnees['POSTE_RECHERCHE'], $donnees['DESC_POSTE'], $donnees['PROFIL_RECHERCHE'], $donnees['DEBUT_STAGE'], $donnees['FIN_STAGE'], $donnees['STAGE'], $donnees['ETAT_PUBLICATION']);
                $liste[] = $annonce;
            }
        }
        return $liste;
    }

    public function create(){
        $sql = "INSERT INTO annonce(ID_ANNONCE, POSTE_RECHERCHE, DESC_POSTE, PROFIL_RECHERCHE, STAGE, ETAT_PUBLICATION, DEBUT_STAGE, FIN_STAGE)
               VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(2, $this->bean->getPosteRecherche());
        $requete->bindValue(3, $this->bean->getDescPoste());
        $requete->bindValue(4, $this->bean->getProfilRecherche());
        $requete->bindValue(5, $this->bean->getStage());
        $requete->bindValue(6, $this->bean->getEtatPublication());
        $requete->bindValue(7, $this->bean->getDebut());
        $requete->bindValue(8, $this->bean->getFin());


//        $requete->bindValue(9, $this->bean->getEntreprise()->getId());

        $requete->execute();
    }

    public function update(){
            $sql = "
                UPDATE annonce
                SET POSTE_RECHERCHE = '".$this->bean->getPosteRecherche()."' ,
                    DESC_POSTE = ".$this->bean->getDescPoste().",
                    PROFIL_RECHERCHE = ".$this->bean->getProfilRecherche().",
                    STAGE = ".$this->bean->getStage().",
                    ETAT_PUBLICATION = ".$this->bean->getEtatPublication().",
                    DEBUT_STAGE = ".$this->bean->getDebut().",
                    FIN_STAGE = ".$this->bean->getFin().",
                    ID_ENT = ".$this->bean->getEntreprise()->getId().",
                    ID_ADMIN = ".$this->bean->getAdmin()->getId()."
                WHERE ID_ANNONCE = ".$this->bean->getId();
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
        }


    public function delete(){
        $this->deleteById("annonce", "ID_ANNONCE", $this->bean->getId());

        $sql = "
                    DELETE FROM annonce
                    WHERE ID_ANNONCE = ".$this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        $requete->execute();
    }

    public function setEntreprise(){
        $sql = "SELECT *
                FROM annonce, entreprise
                WHERE
                annonce.ID_ANNONCE = ".$this->bean->getId()."
                AND annonce.ID_ENT = entreprise.ID_ENT
            ";

        $requete = $this->pdo->prepare($sql);
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
                $this->bean->setEntreprise($entreprise);
            }
        }
    }

    public function setAdmin(){
    $sql = "SELECT *
                FROM annonce, administrateur
                WHERE
                annonce.ID_ANNONCE = ".$this->bean->getId()."
                AND annonce.ID_ADMIN = administrateur.ID_ADMIN
            ";

    $requete = $this->pdo->prepare($sql);
    if($requete->execute()){
        while($donnees = $requete->fetch()){
            $admin = new Administrateur(
                $donnees['ID_ADMIN'],
                $donnees['LOGIN_ADMIN'],
                $donnees['MDP_ADMIN']
            );
            $this->bean->setAdmin($admin);
        }
    }
    }

}

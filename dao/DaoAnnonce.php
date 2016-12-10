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
                $annonce = new Annonce($donnees['ID_ANNONCE'], $donnees['POSTE_RECHERCHE'], $donnees['DESC_POSTE'], $donnees['PROFIL_RECHERCHE'], $donnees['DEBUT_STAGE'], $donnees['FIN_STAGE'], $donnees['ETAT_PUBLICATION']);
                $liste[] = $annonce;
            }
        }
        return $liste;
    }

    public function create(){
        $dateDebut = explode("/", $this->bean->getDebut());
        $debutStage = $dateDebut[2] . "-" . $dateDebut[1] . "-" . $dateDebut[0];

        $dateFin = explode("/", $this->bean->getFin());
        $finStage = $dateFin[2] . "-" . $dateFin[1] . "-" . $dateFin[0];

        $sql = "INSERT INTO annonce(ID_ANNONCE, POSTE_RECHERCHE, DESC_POSTE, PROFIL_RECHERCHE, DEBUT_STAGE, FIN_STAGE, ETAT_PUBLICATION, ID_ENT, ID_ADMIN)
               VALUES(?, ?, ?, ?, ?, ?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getId());
        $requete->bindValue(2, $this->bean->getPosteRecherche());
        $requete->bindValue(3, $this->bean->getDescPoste());
        $requete->bindValue(4, $this->bean->getProfilRecherche());
        $requete->bindValue(5, $debutStage);
        $requete->bindValue(6, $finStage);
        $requete->bindValue(7, $this->bean->getEtatPublication());
        $requete->bindValue(8, $this->bean->getEntreprise()->getId());
        $requete->bindValue(9, $this->bean->getAdmin()->getId());

        $requete->execute();
    }

    public function update(){
    }

    public function delete(){
        $this->deleteById("annonce", "ID_ANNONCE", $this->bean->getId());
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

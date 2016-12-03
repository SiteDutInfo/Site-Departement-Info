<?php

require_once("Dao.php");
require_once("classes/class.Responsable.php");

class DaoResponsable extends Dao {
    public function DaoResponsable(){
        parent::__construct();
        $this->bean = new Responsable();
    }

    public function find($id) {
        $donnees = $this->findById("responsable", "ID_RESP", $id);
        $this->bean->setId($donnees['ID_RESP']);
        $this->bean->setNom($donnees['NOM_RESP']);
        $this->bean->setMail($donnees['MAIL_RESP']);
        $this->bean->setTel($donnees['TEL_RESP']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM responsable
                ORDER BY NOM_RESP";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $responsable = new Responsable($donnees['ID_RESP'], $donnees['NOM_RESP'], $donnees['MAIL_RESP'], $donnees['TEL_RESP']);
                $liste[] = $responsable;
            }
        }
        return $liste;
    }

    public function create(){
        $sql = "INSERT INTO responsable(NOM_RESP, MAIL_RESP, TEL_RESP)
               VALUES(?, ?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getMail());
        $requete->bindValue(3, $this->bean->getTel());

        $requete->execute();
    }

    public function update(){
    }

    public function delete(){
    }

    public function setEntreprise(){
        $sql = "SELECT *
                FROM responsable, entreprise
                WHERE
                responsable.ID_RESP = ".$this->bean->getId()."
                AND responsable.ID_ENT = entreprise.ID_ENT
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
}
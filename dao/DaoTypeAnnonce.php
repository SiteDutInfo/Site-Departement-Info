<?php

require_once("Dao.php");
require_once("classes/class.TypeAnnonce.php");

class DaoTypeAnnonce extends DaoAnnonce {
    public function DaoTypeAnnonce(){
        parent::__construct();
        $this->bean = new TypeAnnonce();
    }

    public function find($id) {
        $donnees = $this->findById("type_annonce", "ID_TYPE_ANN", $id);
        $this->bean->setId($donnees['ID_TYPE_ANN']);
        $this->bean->setStage($donnees['STAGE']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM type_annonce
                ORDER BY STAGE";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $typeAnnonce = new TypeAnnonce($donnees['ID_TYPE_ANN'], $donnees['STAGE']);
                $liste[] = $typeAnnonce;
            }
        }
        return $liste;
    }

    public function create(){
        $sql = "INSERT INTO type_annonce(STAGE)
               VALUES(?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getStage());

        $requete->execute();
    }

    public function update(){
    }

    public function delete(){
    }
}
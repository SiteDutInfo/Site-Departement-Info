<?php

require_once("Dao.php");
require_once("classes/class.Pays.php");

class DaoPays extends Dao {
    public function DaoPays(){
        parent::__construct();
        $this->bean = new Pays();
    }

    public function find($id) {
        $donnees = $this->findById("pays", "ID_PAYS", $id);
        $this->bean->setId($donnees['ID_PAYS']);
        $this->bean->setNom($donnees['NOM_PAYS']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM pays
                ORDER BY NOM_PAYS";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $pays = new Pays($donnees['ID_PAYS'], $donnees['NOM_PAYS']);
                $liste[] = $pays;
            }
        }
        return $liste;
    }
    public function findByName($value){
        $sql = "SELECT * FROM pays WHERE NOM_PAYS = '$value'";
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            if($donnees = $requete->fetch()){
                $this->bean->setId($donnees['ID_PAYS']);
                $this->bean->setNom($donnees['NOM_PAYS']);
                return true;
            }
        }
        return false;
    }

    public function create(){
        $sql = "INSERT INTO pays(NOM_PAYS)
               VALUES(?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getNom());

        $requete->execute();
    }

    public function update(){
    }

    public function delete(){
    }
}
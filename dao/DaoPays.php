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

    public function create(){
    }

    public function update(){
    }

    public function delete(){
    }
}
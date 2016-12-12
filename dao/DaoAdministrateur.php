<?php

require_once("Dao.php");
require_once("classes/class.Administrateur.php");

class DaoAdministrateur extends Dao {
    public function DaoAdministrateur(){
        parent::__construct();
        $this->bean = new Administrateur();
    }

    public function find($id) {
        $donnees = $this->findById("administrateur", "ID_ADMIN", $id);
        $this->bean->setId($donnees['ID_ADMIN']);
        $this->bean->setLogin($donnees['LOGIN_ADMIN']);
        $this->bean->setMdp($donnees['MDP_ADMIN']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM administrateur
                ORDER BY ID";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $admin = new Administrateur(
                    $donnees['ID_ADMIN'],
                    $donnees['LOGIN_ADMIN'],
                    $donnees['MDP_ADMIN']
                );
                $liste[] = $admin;
            }
        }
        return $liste;
    }

    public function create(){
        $sql = "INSERT INTO administrateur(LOGIN_ADMIN, MDP_ADMIN)
               VALUES(?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getLogin());
        $requete->bindValue(2, $this->bean->getMdp());

        $requete->execute();
    }

    public function update(){
    }

    public function delete(){
    }

    public function setLesAnnonces(){
        $sql = "SELECT *
                FROM administrateur, annonce
                WHERE
                administrateur.ID_ADMIN = ".$this->bean->getId()."
                AND administrateur.ID_ANNONCE = annonce.ID_ANNONCE
                ORDER BY NOM_ENT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $annonce = new Annonce(
                    $donnees['ID_ANNONCE'],
                    $donnees['POSTE_RECHERCHE'],
                    $donnees['DESC_POSTE'],
                    $donnees['PROFIL_RECHERCHE'],
                    $donnees['DEBUT_STAGE'],
                    $donnees['FIN_STAGE'],
                    $donnees['ETAT_PUBLICATION']
                );
                $liste[] = $annonce;
            }
            $this->bean->setLesAnnonces($liste);
        }
    }

    public function cnx($login, $mdp){
        $sql = "SELECT *
                FROM administrateur
                WHERE
                administrateur.LOGIN_ADMIN = '".$login."'
                AND administrateur.MDP_ADMIN = '".$mdp."' ";
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $this->bean->setId($donnees['ID_ADMIN']);
                $this->bean->setLogin($donnees['LOGIN_ADMIN']);
                $this->bean->setMdp($donnees['MDP_ADMIN']);
            }
        }
    }
}

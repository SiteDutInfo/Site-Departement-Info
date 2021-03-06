<?php

require_once("Dao.php");
require_once 'classes/class.Entreprise.php';

class DaoEntreprise extends Dao {
    public function DaoEntreprise(){
        parent::__construct();
        $this->bean = new Entreprise();
    }


    public function find($id) {
        $donnees = $this->findById("entreprise", "ID_ENT", $id);
        $this->bean->setId($donnees['ID_ENT']);
        $this->bean->setNom($donnees['NOM_ENT']);
        $this->bean->setNumSiret($donnees['NUM_SIRET']);
        $this->bean->setCodeApeNaf($donnees['CODE_APE_NAF']);
        $this->bean->setUrl($donnees['URL_ENT']);
        $this->bean->setDesc($donnees['DESC_ENT']);
        $this->bean->setLogin($donnees['LOGIN_ENT']);
        $this->bean->setMdp($donnees['MDP_ENT']);
        $this->bean->setLogo($donnees['LOGO']);
        $this->bean->setCivilite($donnees['CIVILITE']);
        $this->bean->setNomResp($donnees['NOM_RESP']);
        $this->bean->setMailResp($donnees['MAIL_RESP']);
        $this->bean->setTelResp($donnees['TEL_RESP']);
    }

    public function getListe(){
        $sql = "SELECT *
                FROM entreprise
                ORDER BY NOM_ENT";
        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $entreprise = new Entreprise($donnees['ID_ENT'], $donnees['NOM_ENT'], $donnees['NUM_SIRET'], $donnees['CODE_APE_NAF'], $donnees['URL_ENT'],
                                                $donnees['DESC_ENT'], $donnees['LOGIN_ENT'], $donnees['MDP_ENT'], $donnees['LOGO'], $donnees['CIVILITE'],
                                                $donnees['NOM_RESP'], $donnees['MAIL_RESP'], $donnees['TEL_RESP']);
                $liste[] = $entreprise;
            }
        }
        return $liste;
    }

    public function create(){
        $sql = "INSERT INTO entreprise(NOM_ENT, NUM_SIRET, CODE_APE_NAF, URL_ENT, DESC_ENT, LOGIN_ENT, MDP_ENT, LOGO, CIVILITE, NOM_RESP, MAIL_RESP, TEL_RESP, ID_VILLE, ID_TYPE_ENT, ID_STATUT, ID_EFF)
               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->bindValue(1, $this->bean->getNom());
        $requete->bindValue(2, $this->bean->getNumSiret());
        $requete->bindValue(3, $this->bean->getCodeApeNaf());
        $requete->bindValue(4, $this->bean->getUrl());
        $requete->bindValue(5, $this->bean->getDesc());
        $requete->bindValue(6, $this->bean->getLogin());
        $requete->bindValue(7, $this->bean->getMdp());
        $requete->bindValue(8, $this->bean->getLogo());
        $requete->bindValue(9, $this->bean->getCivilite());
        $requete->bindValue(10, $this->bean->getNomResp());
        $requete->bindValue(11, $this->bean->getMailResp());
        $requete->bindValue(12, $this->bean->getTelResp());
        $requete->bindValue(13, $this->bean->getLaVille());
        $requete->bindValue(14, $this->bean->getLeTypeEnt());
        $requete->bindValue(15, $this->bean->getLeStatutJur());
        $requete->bindValue(16, $this->bean->getEffectif());

        $requete->execute();
    }

    public function update(){
        $sql = "
                UPDATE entreprise
                SET NOM_ENT = '".$this->bean->getNom()."' ,
                    NUM_SIRET = ".$this->bean->getNumSiret().",
                    CODE_APE_NAF = ".$this->bean->getCodeApeNaf().",
                    URL_ENT = ".$this->bean->getUrl().",
                    DESC_ENT = ".$this->bean->getDesc().",
                    LOGIN_ENT = ".$this->bean->getLogin().",
                    MDP_ENT = ".$this->bean->getMdp().",
                    LOGO = ".$this->bean->getLogo().",
                    CIVILITE = ".$this->bean->getCivilite().",
                    NOM_RESP = ".$this->bean->getNomResp().",
                    MAIL_RESP = ".$this->bean->getMailResp().",
                    TEL_RESP = ".$this->bean->getTelResp().",
                    ID_VILLE = ".$this->bean->getLaVille()->getId().",
                    ID_TYPE_ENT = ".$this->bean->getLeTypeEnt()->getId().",
                    ID_STATUT = ".$this->bean->getLeStatutJur()->getId().",
                    ID_EFF = ".$this->bean->getEffectif()->getId().",
                WHERE ID_ENT = ".$this->bean->getId();
        $requete = $this->pdo->prepare($sql);
        $requete->execute();
    }

    public function delete(){
    }

    public function setLaVille(){
        $sql = "SELECT *
                FROM entreprise, ville
                WHERE
                entreprise.ID_ENT = ".$this->bean->getId()."
                AND ville.ID_VILLE = entreprise.ID_VILLE
            ";

        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $ville = new Ville(
                    $donnees['NOM_VILLE']
                );
                $liste[] = $ville;
            }
            $this->bean->setLaVille($liste);
        }
    }

    public function setLeTypeEntreprise(){
        $sql = "SELECT *
                FROM entreprise, type_entreprise
                WHERE
                entreprise.ID_ENT = ".$this->bean->getId()."
                AND entreprise.ID_TYPE_ENT = type_entreprise.ID_TYPE_ENT
            ";

        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $typeEnt = new TypeEntreprise(
                    $donnees['ID_TYPE_ENT'],
                    $donnees['LIB_TYPE_ENT']
                );
                $liste[] = $typeEnt;
            }
            $this->bean->setLeTypeEnt($liste);
        }
    }

    public function setLeStatutJuridique(){
        $sql = "SELECT *
                FROM entreprise, statut_juridique
                WHERE
                entreprise.ID_ENT = ".$this->bean->getId()."
                AND entreprise.ID_STATUT = statut_juridique.ID_STATUT
            ";

        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $statutJuridique = new StatutJuridique(
                    $donnees['ID_STATUT'],
                    $donnees['LIB_STATUT']
                );
                $liste[] = $statutJuridique;
            }
            $this->bean->setLeStatutJur($liste);
        }
    }

    public function setEffectif(){
        $sql = "SELECT *
                FROM entreprise, effectif
                WHERE
                entreprise.ID_ENT = ".$this->bean->getId()."
                AND entreprise.ID_EFF = effectif.ID_EFF
            ";

        $requete = $this->pdo->prepare($sql);
        $liste = array();
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $effectif = new Effectif(
                    $donnees['ID_EFF'],
                    $donnees['QTE_EFF']
                );
                $liste[] = $effectif;
            }
            $this->bean->setEffectif($liste);
        }
    }

    public function setLesAnnonces(){
        $sql = "SELECT *
                FROM entreprise, annonce
                WHERE
                entreprise.ID_ENT = ".$this->bean->getId()."
                AND annonce.ID_ENT = ".$this->bean->getId()."
               ";
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
                    $donnees['STAGE'],
                    $donnees['ETAT_PUBLICATION']
                );
                $liste[] = $annonce;
            }
            $this->bean->setLesAnnonces($liste);
        }
    }

    public function cnx($login, $mdp){
        $sql = "SELECT *
                FROM entreprise
                WHERE
                entreprise.LOGIN_ENT = '".$login."'
                AND entreprise.MDP_ENT = '".$mdp."'";
        $requete = $this->pdo->prepare($sql);
        if($requete->execute()){
            while($donnees = $requete->fetch()){
                $this->bean->setId($donnees['ID_ENT']);
                $this->bean->setNom($donnees['NOM_ENT']);
                $this->bean->setNumSiret($donnees['NUM_SIRET']);
                $this->bean->setCodeApeNaf($donnees['CODE_APE_NAF']);
                $this->bean->setUrl($donnees['URL_ENT']);
                $this->bean->setDesc($donnees['DESC_ENT']);
                $this->bean->setLogin($donnees['LOGIN_ENT']);
                $this->bean->setMdp($donnees['MDP_ENT']);
                $this->bean->setLogo($donnees['LOGO']);
                $this->bean->setCivilite($donnees['CIVILITE']);
                $this->bean->setNomResp($donnees['NOM_RESP']);
                $this->bean->setMailResp($donnees['MAIL_RESP']);
                $this->bean->setTelResp($donnees['TEL_RESP']);
            }
        }
    }
}

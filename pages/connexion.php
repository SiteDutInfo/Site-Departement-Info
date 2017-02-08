<?php
//require_once ("dao/DaoEntreprise.php");
//
//
//$daoEnt = new DaoEntreprise();
//
//if(isset($_POST["valcnx"])){
//    $daoEnt->cnx($_POST['login'],$_POST['mdp']);
//    $_SESSION['toto'] = array();
//    $_SESSION['toto']['id'] = $daoEnt->bean->getId();
//    $_SESSION['toto']['nom'] = $daoEnt->bean->getNom();
//    $_SESSION['toto']['numSiret'] = $daoEnt->bean->getNumSiret();
//    $_SESSION['toto']['codeApeNaf'] = $daoEnt->bean->getCodeApeNaf();
//    $_SESSION['toto']['url'] = $daoEnt->bean->getUrl();
//    $_SESSION['toto']['desc'] = $daoEnt->bean->getDesc();
//    $_SESSION['toto']['login'] = $daoEnt->bean->getLogin();
//    $_SESSION['toto']['mdp'] = $daoEnt->bean->getMdp();
//    $_SESSION['toto']['logo'] = $daoEnt->bean->getLogo();
//    $_SESSION['toto']['civilite'] = $daoEnt->bean->getCivilite();
//    $_SESSION['toto']['nomResp'] = $daoEnt->bean->getNomResp();
//    $_SESSION['toto']['mailResp'] = $daoEnt->bean->getMailResp();
//    $_SESSION['toto']['telResp'] = $daoEnt->bean->getTelResp();
//    $daoEnt->setLaVille();
//    $_SESSION['toto']['ville'] = $daoEnt->bean->getLaVille();
//    $daoEnt->setLeTypeEntreprise();
//    $_SESSION['toto']['typeEnt'] = $daoEnt->bean->getLeTypeEnt();
//    $daoEnt->setLeStatutJuridique();
//    $_SESSION['toto']['statut'] = $daoEnt->bean->getLeStatutJur();
//    $daoEnt->setEffectif();
//    $_SESSION['toto']['effectif'] = $daoEnt->bean->getEffectif();
//    $daoEnt->setLesAnnonces();
//    $_SESSION['toto']['annonces'] = $daoEnt->bean->getLesAnnonces();
//        header('Location: index.php?page=monCompte');
//var_dump($_SESSION);
//}

require_once ("dao/DaoEntreprise.php");
require_once ("dao/DaoAdministrateur.php");


$daoEnt = new DaoEntreprise();
$daoAdmin = new DaoAdministrateur();

if(isset($_POST["valcnx"])){
    $daoAdmin->cnx($_POST["logincnx"], $_POST["pswcnx"]);
    $daoEnt->cnx($_POST["logincnx"], $_POST["pswcnx"]);

    if($daoAdmin->bean->getLogin()!=null) {
        $_SESSION['sessionAdmin'] = array();
        $_SESSION['sessionAdmin']['login'] = $daoAdmin->bean->getLogin();
        $_SESSION['sessionAdmin']['mdp'] = $daoAdmin->bean->getMdp();

        header("Location: index.php?page=monCompte");
    }
    elseif($daoEnt->bean->getLogin()!=null) {
        $_SESSION['sessionEnt'] = array();
        $_SESSION['sessionEnt']['id'] = $daoEnt->bean->getId();
        $_SESSION['sessionEnt']['nom'] = $daoEnt->bean->getNom();
        $_SESSION['sessionEnt']['numSiret'] = $daoEnt->bean->getNumSiret();
        $_SESSION['sessionEnt']['codeApeNaf'] = $daoEnt->bean->getCodeApeNaf();
        $_SESSION['sessionEnt']['url'] = $daoEnt->bean->getUrl();
        $_SESSION['sessionEnt']['desc'] = $daoEnt->bean->getDesc();
        $_SESSION['sessionEnt']['login'] = $daoEnt->bean->getLogin();
        $_SESSION['sessionEnt']['mdp'] = $daoEnt->bean->getMdp();
        $_SESSION['sessionEnt']['logo'] = $daoEnt->bean->getLogo();
        $_SESSION['sessionEnt']['civilite'] = $daoEnt->bean->getCivilite();
        $_SESSION['sessionEnt']['nomResp'] = $daoEnt->bean->getNomResp();
        $_SESSION['sessionEnt']['mailResp'] = $daoEnt->bean->getMailResp();
        $_SESSION['sessionEnt']['telResp'] = $daoEnt->bean->getTelResp();
        $daoEnt->setLaVille();
        $_SESSION['sessionEnt']['ville'] = $daoEnt->bean->getLaVille();
        $daoEnt->setLeTypeEntreprise();
        $_SESSION['sessionEnt']['typeEnt'] = $daoEnt->bean->getLeTypeEnt();
        $daoEnt->setLeStatutJuridique();
        $_SESSION['sessionEnt']['statut'] = $daoEnt->bean->getLeStatutJur();
        $daoEnt->setEffectif();
        $_SESSION['sessionEnt']['effectif'] = $daoEnt->bean->getEffectif();
        $daoEnt->setLesAnnonces();
        $_SESSION['sessionEnt']['annonces'] = $daoEnt->bean->getLesAnnonces();

        header("Location: index.php?page=monCompte");
    }
    else {
        $_SESSION["sessionAdmin"] = "null";
        $_SESSION["sessionEnt"] = "null";
    }
}




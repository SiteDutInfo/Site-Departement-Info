<?php

require_once('dao/DaoTypeEntreprise.php');
require_once('dao/DaoStatutJuridique.php');
require_once("dao/DaoEntreprise.php");
require_once("dao/DaoResponsable.php");
require_once("dao/DaoEffectif.php");
require_once("dao/DaoVille.php");
require_once("dao/DaoPays.php");


$daoResp = new DaoResponsable();
$daoVille = new DaoVille();
$daoPays = new DaoPays();

$daoTypeEnt = new DaoTypeEntreprise();
$listeTypeEnt = $daoTypeEnt->getListe();

$daoStatutJur = new DaoStatutJuridique();
$listeStatutJur = $daoStatutJur->getListe();

$daoEff = new DaoEffectif();
$listeEff = $daoEff->getListe();




if (isset($_POST["creerEntreprise"])) {

    $daoEnt = new DaoEntreprise();
    $daoEnt->bean->setLogin($_POST["loginEnt"]);

    if($_POST["pswEnt"] == $_POST["ConfirmedPsw"]) {
        $daoEnt->bean->setMdp($_POST["pswEnt"]);
    }

    $daoEnt->bean->setNom($_POST["nomEnt"]);
    $daoEnt->bean->setCodeApeNaf($_POST["codeAPENAF"]);
    $daoEnt->bean->setUrl($_POST["url"]);
//    $daoEnt->bean->setLogo($_POST["logoEnt"]);
    $daoEnt->bean->setDesc($_POST["desc"]);



    $daoVille = new DaoVille();
    $daoVille->findByName($_POST["ville"]);
    if($daoVille == null) {
        $daoVille->bean->setId();
        $daoVille->bean->setNom();
    }
    else {
        $daoVille->bean->getId();
    }
//    $daoVille->find($_POST["ville"]);
//    $daoEnt->bean->setLaVille($daoVille->bean);

//    $daoResp = new DaoResponsable();
////    $daoNomResp = $daoResp->findByName($_POST["nomResp"]);
////    if($daoNomResp == null) {
////        $daoResp->bean->setNom();
////    }
////    else {
////        $daoResp->bean->getId();
////    }
//    $daoResp->find($_POST["nomResp"]);
//    $daoEnt->bean->setLeResponsable($daoResp->bean);

    $daoPays = new DaoPays();
    $daoPays->findByName($_POST["pays"]);
    if($daoPays == null) {
        $daoPays->bean->setNom();
    }
    else {
        $daoPays->bean->getId();
    }

    $daoEff->find($_POST["effectif"]);
    $daoEnt->bean->setEffectif($daoEff->bean);

    $daoTypeEnt->find($_POST["typeEnt"]);
    $daoEnt->bean->setLeTypeEnt($daoTypeEnt->bean);

    $daoStatutJur->find($_POST["statutJur"]);
    $daoEnt->bean->setLeStatutJur($daoStatutJur->bean);


    $daoEnt->create();


    // redirection formulaire
    header('Location: index.php?page=index');
}

$param = array(
    "listeTypeEntreprise" => $listeTypeEnt,
    "listeStatutJuridique" => $listeStatutJur,
    "listeEff" => $listeEff
);

<?php

require_once('dao/DaoTypeEntreprise.php');
require_once('dao/DaoStatutJuridique.php');
require_once("dao/DaoEntreprise.php");
require_once("dao/DaoEffectif.php");
require_once("dao/DaoVille.php");
require_once("dao/DaoPays.php");

$daoVille = new DaoVille();
$daoPays = new DaoPays();

$daoTypeEnt = new DaoTypeEntreprise();
$listeTypeEnt = $daoTypeEnt->getListe();

$listeVilles = $daoVille->getListe();

$daoStatutJur = new DaoStatutJuridique();
$listeStatutJur = $daoStatutJur->getListe();

$daoEff = new DaoEffectif();
$listeEff = $daoEff->getListe();




if (isset($_POST["creerEntreprise"]) && ($_POST["pswEnt"] == $_POST["ConfirmedPsw"])) {

    $daoEnt = new DaoEntreprise();
    $daoEnt->bean->setLogin($_POST["loginEnt"]);
    $daoEnt->bean->setMdp(sha1($_POST["pswEnt"]));
    $daoEnt->bean->setNom($_POST["nomEnt"]);
    $daoEnt->bean->setNumSiret($_POST['numeroSiret']);
    $daoEnt->bean->setCodeApeNaf($_POST["codeAPENAF"]);
    $daoEnt->bean->setUrl($_POST["url"]);
//    $daoEnt->bean->setLogo($_POST["logoEnt"]);
    $daoEnt->bean->setNomResp($_POST['nomResp']);
    $daoEnt->bean->setMailResp($_POST['mail']);
    $daoEnt->bean->setTelResp($_POST['tel']);
    $daoEnt->bean->setLogo("null");
    if($_POST['civilite'] == "mme"){
        $daoAnn->bean->setCivilite(1);
    }
    else{
        $daoAnn->bean->setCivilite(0);
    }
    $daoEnt->bean->setDesc($_POST["desc"]);
    $daoEnt->bean->setLaVille((int)$_POST['ville']);
//    var_dump($daoEnt);

    $daoEnt->bean->setEffectif($_POST["effectif"]);

    $daoEnt->bean->setLeTypeEnt($_POST["typeEnt"]);

    $daoEnt->bean->setLeStatutJur($_POST["statutJur"]);
//    var_dump($daoEnt);
    $daoEnt->create();


    // redirection formulaire
    header('Location: index.php');
}

$param = array(
    "listeTypeEntreprise" => $listeTypeEnt,
    "listeVilles" => $listeVilles,
    "listeStatutJuridique" => $listeStatutJur,
    "listeEff" => $listeEff
);

<?php

require_once('dao/DaoAnnonce.php');


if (isset($_POST["creerAnnonce"])) {


    $daoAnn = new DaoAnnonce();

    if($_POST['typeAnnonce'] == "stage"){
        $daoAnn->bean->setStage(1);
    }
    else{
        $daoAnn->bean->setStage(0);
    }

    $daoAnn->bean->setPosteRecherche($_POST["posteRecherche"]);
    $daoAnn->bean->setDescPoste($_POST["descPoste"]);
    $daoAnn->bean->setProfilRecherche($_POST["profil"]);
    $daoAnn->bean->setDebut($_POST["dateDebut"]);
    $daoAnn->bean->setFin($_POST["dateFin"]);
    $daoAnn->bean->setEtatPublication(0);
    $daoAnn->bean->setEntreprise($_POST['idpost']);
//    var_dump($daoAnn);

    $daoAnn->create();


    // redirection formulaire
    header('Location: index.php?page=index');
}



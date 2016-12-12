<?php

require_once('dao/DaoAnnonce.php');
require_once('dao/DaoTypeAnnonce.php');


$daoTypeAnn = new DaoTypeAnnonce();


if (isset($_POST["creerAnnonce"])) {


    $daoAnn = new DaoAnnonce();
    $daoAnn->bean->setDescPoste($_POST["descPoste"]);
    $daoAnn->bean->setProfilRecherche($_POST["profil"]);
    $daoAnn->bean->setDebut($_POST["dateDebut"]);
    $daoAnn->bean->setFin($_POST["dateFin"]);

    $daoTypeAnn->find($_POST["typeAnnonce"]);
    $daoTypeAnn->bean->setStage($daoTypeAnn->bean);



    $daoAnn->create();


    // redirection formulaire
    header('Location: index.php?page=index');
}



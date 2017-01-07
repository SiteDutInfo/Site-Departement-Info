<?php
require_once("dao/DaoAnnonce.php");

$daoAnn = new DaoAnnonce();
$listeAnnAttente = $daoAnn->getAnnoncesAttente();

for($i=0;$i<count($listeAnnAttente); $i++){
    $daoAnn = new DaoAnnonce();
    $daoAnn->find($listeAnnAttente[$i]->getId());

    $daoAnn->setEntreprise();

    $listeAnnAttente[$i] = $daoAnn->bean;
}

if(isset($_POST["valAnnonce"])){

    $daoAnn->valAnnonce();

    header('Location: index.php?page=offres');
    exit();
}

if(isset($_POST["suppAnnonce"])){

    $daoAnn->delete();

    header('Location: index.php?page=offres');
    exit();
}

$param = array(
    "listeAnnonce" => $listeAnnAttente
);
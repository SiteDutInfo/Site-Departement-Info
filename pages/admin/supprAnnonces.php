<?php
require_once("dao/DaoAnnonce.php");

$daoAnn = new DaoAnnonce();
$listeAnnPubliees = $daoAnn->getAnnoncesPubliees();

for($i=0;$i<count($listeAnnPubliees); $i++){
    $daoAnn = new DaoAnnonce();
    $daoAnn->find($listeAnnPubliees[$i]->getId());

    $daoAnn->setEntreprise();

    $listeAnnPubliees[$i] = $daoAnn->bean;
}


// Traitement du formulaire
if(isset($_POST["suppAnnonce"])){
    // Suppression de la potion
    $daoAnn->delete();
    // Redirection sur la liste des potions
    header('Location: index.php?page=supprAnnonces');
    exit();
}


$param = array(
    "listeAnnonce" => $listeAnnPubliees
);
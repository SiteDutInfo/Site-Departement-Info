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

$param = array(
    "listeAnnonce" => $listeAnnPubliees
);
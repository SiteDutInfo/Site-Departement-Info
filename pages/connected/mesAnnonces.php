<?php

require_once("dao/DaoAnnonce.php");

$daoAnn = new DaoAnnonce();
$AnnoncesAttente = $daoAnn->getAnnoncesAttente();

$daoAnn->find($_GET['id']);

$param = array(
    "listeAnnonceAtt" => $AnnoncesAttente
);

if(isset($_POST["suppr"])){
$daoAnn->delete();
}
<?php
require_once("dao/DaoAnnonce.php");

$daoAnn = new DaoAnnonce();
$daoAnn->find($_GET["id"]);
$daoAnn->setEntreprise();

$listeResponsable = $daoAnn->setRespEnt();



$param = array(
    "annonce" => $daoAnn->bean,
    "listeResp" => $listeResponsable
);
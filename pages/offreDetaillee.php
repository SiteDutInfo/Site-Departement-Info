<?php
require_once("dao/DaoAnnonce.php");

$daoAnn = new DaoAnnonce();
$daoAnn->find($_GET["id"]);
$daoAnn->setEntreprise();



$param = array(
    "annonce" => $daoAnn->bean
);
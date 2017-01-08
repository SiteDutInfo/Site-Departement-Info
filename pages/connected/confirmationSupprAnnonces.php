<?php
require_once('dao/DaoAnnonce.php');

$daoAnn = new DaoAnnonce();
$daoAnn->find($_GET['id']);

if(isset($_POST["oui"])){

    $daoAnn->delete();

    header('Location: index.php?page=offres');
    exit();
}

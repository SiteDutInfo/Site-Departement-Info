<?php
require_once ("dao/DaoEntreprise.php");
require_once ("dao/DaoAdministrateur.php");


$daoEnt = new DaoEntreprise();
$daoAdmin = new DaoAdministrateur();

if(isset($_POST["valcnx"])){
    $daoAdmin->cnx($_POST["logincnx"], $_POST["pswcnx"]);
    $daoEnt->cnx($_POST["logincnx"], $_POST["pswcnx"]);

    if($daoAdmin->bean->getLogin()!=null) {
        $_SESSION["sessionAdmin"] = array();
        $_SESSION["sessionAdmin"]["login"] = $daoAdmin->bean->getLogin();

        header("Location: index.php?page=index");
    }
    elseif($daoEnt->bean->getLogin()!=null) {
        $_SESSION["sessionEnt"] = array();
        $_SESSION["sessionEnt"]["login"] = $daoEnt->bean->getLogin();

        header("Location: index.php?page=index");
    }
    else {
        $_SESSION["sessionAdmin"] = "null";
        $_SESSION["sessionEnt"] = "null";
    }
}


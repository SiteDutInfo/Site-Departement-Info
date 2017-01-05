<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoAdministrateur.php');

$daoEnt = new DaoEntreprise();
$listeEnt = $daoEnt->getListe();

$daoAdmin = new DaoAdministrateur();
$listeAdmin = $daoAdmin->getListe();

for($i=0;$i<count($listeEnt); $i++){
    $dao = new DaoEntreprise();
    $dao->find($listeEnt[$i]->getId());

    $dao->setLaVille();
    $dao->setLeResponsable();
    $dao->setLeTypeEntreprise();
    $dao->setLeStatutJuridique();
    $dao->setEffectif();
    $dao->setLesAnnonces();

    $listeEnt[$i] = $dao->bean;
}

for($i=0;$i<count($listeAdmin); $i++){
    $dao = new DaoAdministrateur();
    $dao->find($listeAdmin[$i]->getId());

    $listeAdmin[$i] = $dao->bean;
}


// On passe le liste de villageois en paramètre pour la vue
// ce tableau est tranféré par lae programme index.php
// à chaque template demandé
$param = array(
    "listeEnt" => $listeEnt,
    "listeAdmin" => $listeAdmin
    );
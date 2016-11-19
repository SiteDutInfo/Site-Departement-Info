<?php
// Appel de la classe de chargement du moteur
include_once('Twig/Autoloader.php');
// registration de Twig
Twig_Autoloader::register();

// Définition du répertoire des templates
$loader = new Twig_Loader_Filesystem('templates');
// Utilisation du répertoire des templates avec cache

//$twig = new Twig_Environment($loader, array('cache' => 'templates_c'));
$twig = new Twig_Environment($loader, array('cache' => false));

// routage des pages    
// Par défaut la page d'accueil
$uriDemandee = "index";
// Parsing du fichier des routes
$routes = parse_ini_file("param/routes.ini", true);
// Si une URI est demandée
if(isset($_GET["page"])){
	$uriDemandee = $_GET["page"];
}
$page = $routes[$uriDemandee]["page"];
$template = $routes[$uriDemandee]["template"];

// Tableau de paramètres
$param = array();

// Inclusion du fichier de traitement
if($page != null){
	include($page);
}

// Chargement du template
$template = $twig->loadTemplate($template);

// Affichage de la page concernée
// Avec passage d'un tableau de paramètre 
// fournit par les programmes de traitement
echo $template->render($param);

?>	
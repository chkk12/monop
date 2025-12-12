<?php
session_start();
include_once("src/model.php");

$position_joueur = 0;
$argent_joueur = 1500;
$resultat_de = 0;
$message_resultat = '';

traiterJeu($position_joueur, $argent_joueur, $resultat_de, $message_resultat);

$title = 'CyberSafe Monopoly - Jeu de Sensibilisation Cybersécurité';
$subtitle = 'Protégez votre entreprise des cybermenaces';
$content_file = 'template/index.php';
$page_header = false;
$modals = true;
$javascript_files = ['script.js'];

require('template/layout.php');
?>

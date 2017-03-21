<?php
require_once('inc/init.inc.php');
require_once('inc/fonctions.inc.php');

// Redirection vers connexion.php si user n'est pas connecté
if(!userConnecte()){
	header('location:connexion.php');
}

// récupérer les infos de User
var_dump($_SESSION);
extract($_SESSION['membre']);

$page = 'Profil';
require_once('inc/header.inc.php');
?>

<!-- __________________CODE HTML_________________________ -->

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
	</head>

	<body>
		<div>
			<ul>
				<li>Pseudo : <b><?= $pseudo ?></b></li>
				<li>Prénom : <b><?= $prenom ?></b></li>
				<li>Nom: <b><?= $nom ?></b></li>
			</ul>
		<div>

<?php 
require('inc/footer.inc.php');






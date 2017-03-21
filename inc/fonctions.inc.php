<?php

// fonction pour faire les debug : 
function debug($arg){
	echo '<div style="color: white; padding: 10px; background:#' . rand(111111,999999) . '" >';
	$trace = debug_backtrace(); // Nous retourne des infos sur l'emplacement où est exécuter la fonction actuelle. (sous forme de tableau multi)
	
	echo 'Le debug a été demandé dans le fichier : ' . $trace[0]['file'] . ' à la ligne : ' . $trace[0]['line'] . '<hr/>'; 
	
	echo '<pre>';
	print_r($arg);
	echo '</pre>';
	
	echo '</div>';
}

// Fonction pour voir si user est connecté :
function userConnecte(){
	if(isset($_SESSION['membre'])){
		return TRUE; 
	}
	else{
		return FALSE; 
	}
	// S'il existe une session/membre, cela signifie que l'utilisateur est connecté. On retourne TRUE, sinon FALSE. 
}

// Fonction pour voir si user est admin
function userAdmin(){
	if(userConnecte() && $_SESSION['membre']['statut'] == 1){
		return TRUE;
	}
	else{
		return FALSE;
	}
	// Si l'utilisateur est connecté et que dans le même temps son statut est égal à 1, alors cela signifie qu'il est admin. Je retourne TRUE, sinon je retourne FALSE. 
}

// Créer un panier

function creationPanier(){
	if(!isset($_SESSION['panier'])){
		$_SESSION['panier'] = array();
		$_SESSION['panier']['id_produit'] = array();
		$_SESSION['panier']['quantite'] = array();
		$_SESSION['panier']['titre'] = array();
		$_SESSION['panier']['photo'] = array();
		$_SESSION['panier']['prix'] = array();
	}
	return TRUE;
}

// Ajouter un produit au panier
function ajouterProduit($id_produit, $quantite, $titre, $photo, $prix){
	creationPanier(); // On crée le panier dans un premier temps. 
	
	// Nous vérifions si le produits existe déjà dans le panier :
	$positionPdt = array_search($id_produit, $_SESSION['panier']['id_produit']); 
	// Array_search() est une fonction qui me permet de cherche une info (valeur) dans un array. Si elle trouve elle retourne son emplacement, sinon FALSE. 
	
	if($positionPdt !== FALSE){
		$_SESSION['panier']['quantite'][$positionPdt] += $quantite; 
	}
	else{
		$_SESSION['panier']['id_produit'][] = $id_produit;
		$_SESSION['panier']['quantite'][] = $quantite;
		$_SESSION['panier']['prix'][] = $prix;
		$_SESSION['panier']['photo'][] = $photo;
		$_SESSION['panier']['titre'][] = $titre;
	}
}


// Compter le nombre de produits dans le panier
function quantitePanier(){
	$quantite = 0; 
	if(isset($_SESSION['panier']) && !empty($_SESSION['panier']['quantite'])){
		for($i = 0; $i < count($_SESSION['panier']['quantite']); $i++ ){
			$quantite += $_SESSION['panier']['quantite'][$i];
		}
	}
	//-------------------------
	if($quantite != 0){
		return $quantite;
	}
	else{
		return FALSE; 
	}
}

//Fonction pour calcul le montant total du panier :
function totalPanier(){
	$total = 0; 
	if(isset($_SESSION['panier']) && !empty($_SESSION['panier']['prix'])){
		for($i = 0; $i < count($_SESSION['panier']['prix']); $i++ ){
			$total += $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i] ;
		}
	}
	//-------------------------
	if($total != 0){
		return $total;
	}
	else{
		return FALSE; 
	}
}

// Fonction pour retirer un produit du panier : 

function retirerProduit($id_produit){
	$position_pdt_a_supprimer = array_search($id_produit, $_SESSION['panier']['id_produit']); 
	// Je cherche la position du produit à supprimer grâce à son ID afin de supprimer la ligne dans les 5 mini-tableaux de mon panier. 
	
	if($position_pdt_a_supprimer !== FALSE){
		array_splice($_SESSION['panier']['id_produit'], $position_pdt_a_supprimer, 1); 
		array_splice($_SESSION['panier']['quantite'], $position_pdt_a_supprimer, 1); 
		array_splice($_SESSION['panier']['titre'], $position_pdt_a_supprimer, 1); 
		array_splice($_SESSION['panier']['photo'], $position_pdt_a_supprimer, 1); 
		array_splice($_SESSION['panier']['prix'], $position_pdt_a_supprimer, 1); 
		
		//foreach($_SESSION['panier'] as $valeur){
			//array_splice($valeur, $position_pdt_a_supprimer, 1);
		//}
		
		
	}	
}














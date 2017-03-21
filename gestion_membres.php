<?php require_once('inc/init.inc.php');



include('inc/header.inc.php');
?>


<style type="text/css"> 
body{ 
	padding: 30px;
} 

#paragraphe-id{ 
	font-weight:bold; 
	color:green; 
} 

table {
width: 90%:;
margin: 0 auto;
}
table th, table td {
height: 50px;
width: 100px;
padding: 30px 60px;
text-align: center;
}

table th {
background-color: black;
color: white;
}

h1{
background-color: #5688C7;
color: #fff;
text-align: center;
margin-top: 10rem;
}


</style>





<h1>Gestion des membres</h1>




<div class="row">
	<div class="col-md-11 .col-md-offset-1">
		<?php
		$resultat = $pdo -> query("SELECT * FROM membre");

		echo '<table border="1">';
		echo '<tr>';
		for($i = 0; $i < $resultat -> columnCount(); $i++){
		// La boucle va tourner autant de fois qu'il y a de champs dans la table (ici c'est 7 fois)	
			$colonne = $resultat -> getColumnMeta($i); // Cette fonction me retourne un array avec tous les infos de chaque champs. 
			echo '<th>' . $colonne['name'] . '</th>';
		}
		echo '<th>Actions</th>';
		echo '</tr>';

		while($membres = $resultat -> fetch(PDO::FETCH_ASSOC)){
			echo '<tr>'; 
			foreach($membres as $valeur){
				echo '<td>' . $valeur . '</td>';
			}
			echo '<td><a href="">Voir</a><a href="">Modifier</a><a href="">Supprimer</a></td>';
			echo '</tr>'; 
		}
		echo '</table>'; 
		?>
	</div>
</div>



	<form action="" method="post">
		<div class="row">
			<div class="col-md-4 .col-md-offset-2">
				<label for="pseudo">Pseudo</label><br><input type="text" name="pseudo" placeholder="Votre pseudo"><br>
				<label for="mdp">Mot de passe</label><br><input type="text" name="mdp" placeholder="Votre mot de passe"><br>
				<label for="nom">Nom</label><br><input type="text" name="nom" placeholder="Votre nom"><br>
				<label for="prenom">Prénom</label><br><input type="text" name="prenom" placeholder="Votre prénom"><br>
			</div>
			<div class="col-md-4 .col-md-offset-2">
				<label for="email">Email</label><br><input type="email" name="email" placeholder="Votre email"><br>
				<label for="civilite">Civilité</label><br><select name="civilite">
							<option value="h">Homme</option>
							<option value="m">Femme</option>
						</select><br>
				<label for="statut">Statut</label><br><select name="statut">
							<option value="1">Admin</option>
							<option value="2">User</option>
						</select>
				<input type="submit" value="enregistrer">
			</div>
		</form>

</div>



<?php
$msg = "";
if($_POST) {
	if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])){
		if(preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo'])){	
			$resultat = $pdo -> prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut)");

			$resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
			$resultat -> bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
			$resultat -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
			$resultat -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
			$resultat -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
			$resultat -> bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
			$resultat -> bindParam(':statut', $_POST['statut'], PDO::PARAM_STR);

			$resultat -> execute();
		}
		else{
			$msg.= '<p style="color: red;">Veuillez n\'utiliser que des caractères autorisés</p>';
		}
	}
	else{
		$msg.= '<p style="color: red;">Veuillez remplir tous les champs !</p>';
	}
	echo $msg;
}


?>


<?php include('inc/footer.inc.php');?>

</body>
</html>
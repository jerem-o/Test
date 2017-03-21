<?php
require_once('inc/init.inc.php');


// Redirection si user est connecté
if(userConnecte()){
	header('location:profil.php');
}

// Traitement de la connexion : 
if($_POST){
	// - Vérifier si le pseudo existe
	if(!empty($_POST['pseudo'])){
		$resultat = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
		$resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$resultat -> execute();
		
		if($resultat -> rowCount() > 0){ // Le pseudo existe bien dans la BDD
			// - Vérifier si le MDP correspond au MDP en BDD
			$membre = $resultat -> fetch(PDO::FETCH_ASSOC);
			debug($membre);
			//echo md5($_POST['mdp']);
			//$test = '<br />TEST';
			
			if($membre['mdp'] == md5($_POST['mdp'])){ // Le MDP en BDD est le même que le MDP fourni dans le formulaire.
			
				// - Mettre toutes les infos de user dans la session
				foreach($membre as $indice => $valeur){
					if($indice != 'mdp'){
						$_SESSION['membre'][$indice] = $valeur;
					}
				}
				//debug($_SESSION);
				
				// - Redirection vers profil.php
				header('location:profil.php');
			}
			else{
				$msg .= '<div class="erreur">Erreur de MDP !</div>';
			}
		}
		else{
			$msg .= '<div class="erreur">Erreur de pseudo !</div>';
		}
	}
	else{
		$msg .= '<div class="erreur">Veuillez renseigner un pseudo !</div>'; 
	}
}

$page = 'Connexion';
require_once('inc/header.inc.php');
?>
<!--_________________________________CODE HTML_______________________________________-->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Connexion</title>
    </head>
    <body>
            <form action="" method="post">

            <h1>Connexion</h1>
			<?php var_dump($_SESSION); echo $test;?>

                <div>
                    <label for="pseudo">Pseudo :</label>
                    <br/>
                    <input type="text" id="pseudo" name ="pseudo" placeholder="Votre pseudo"/>
                </div>
                <br/>

                <div>
                    <label for="mdp">Mot de passe :</label>
                    <br/>
                    <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe"/>
                </div>
                <br/>

                <div>
                <input type="submit" value="Connexion" name="connexion"/>
                </div>

            </form>
        
    </body>
</html>
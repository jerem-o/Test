<?php
require_once('inc/init.inc.php');


// $tableauPost = array ('pseudo', 'mdp', 'nom', 'prenom', 'email');

print_r($_POST);


if($_POST) {
    // for($i=0; $i<count($tableauPost); $i++){
    //     if(!empty($_POST[$tableauPost[$i]])){
    //         echo $_POST[$tableauPost[$i]] . ' ';
    //     }
    // }


        if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['civilite'])){

            $resultat = $pdo -> prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, NOW())");

            $mdp = md5($_POST['mdp']);

            $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $resultat -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $resultat -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
            $resultat -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $resultat -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $resultat -> bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);

            $resultat -> execute();

        }
}


?>

<!--________________________________________________CODE HTML______________________________________________-->

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Formulaire d'inscription</title>  
    </head>

    <body>

        <form action="" method="post">

            <div>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" placeholder="Votre pseudo"/>
            </div>
            <br/>

            <div>
                <label for="mdp">Mot de passe :</label>
                <br/>
                <input type="password" name="mdp" placeholder="Votre mot de passe"/>
            </div>
            <br/>

            <div>
                <label for="nom">Nom :</label>
                <br/>
                <input type="text" name="nom" placeholder="Votre nom"/>
            </div>
            <br/>

            <div>
                <label for="prenom">Prénom :</label>
                <br/>
                <input type="text" name="prenom" placeholder="Votre prénom"/>
            </div>
            <br/>

            <div>
                <label for="email">Email :
                    <input type="email" name="email" placeholder="Votre email"/></label>
            </div>
            <br/>

            <div>
                <label for="civilite">Civilité :</label>
                <br/>
                <select name="civilite">
                    <option value="h" checked>Homme</option>
                    <option value="f">Femme</option>
                </select>
            </div>
            <br/>

            <div>
                <input type="submit" value="Enregistrer">
            </div>
        </form>

    </body>

</html>
<?php
require_once('inc/init.inc.php');

// Si user n'est pas admin : redirection
if(!userAdmin()){
	header('location:connexion.php');
}

// Traitement pour l'affichage de nos apparts
$resultat = $pdo -> query("SELECT * FROM appart");



// Traitement pour l'ajout dans la BDD
if($_POST) {

    debug($_POST);
	debug($_FILES);
	// Vérifications des données
	
	// traitement sur les photos :
    $nom_photo = 'default.jpg';

	if(!empty($_FILES['photo']['name'])){ // Si l'utilisateur nous a transmis une photo
		if($_FILES['photo']['error'] == 0){	
			$ext = explode('/', $_FILES['photo']['type']);
			$ext_autorisee = array('jpeg', 'gif', 'png');		
			if(in_array($ext[1], $ext_autorisee)){
				if($_FILES['photo']['size'] < 1000000){
			
                    // Vérification si le nom de la photo n'existe pas déjà
                    $resultat = $pdo -> prepare("SELECT * FROM appart WHERE photo = :photo");
                    $resultat -> bindParam(':photo', $_POST['photo'], PDO::PARAM_STR);
                    $resultat -> execute();  

                    if($resultat -> rowCount() > 0){ // Le nom de cette photo existe déjà, il faut donc la renommer
                        $nom_photo = $_FILES['photo']['name'] . '_' .rand(1, 32000) ;
                    } else { // Le nom est unique, on le garde
                        $nom_photo = $_FILES['photo']['name'];
                    }

                    // Decode de sécurité
					$nom_photo = utf8_decode($nom_photo);
					// enregistrer la photo dans le dossier photo/
					$chemin_photo = RACINE_SERVEUR . RACINE_SITE . 'img/' . $nom_photo;
					
					copy($_FILES['photo']['tmp_name'], $chemin_photo); // La fonction copy() permet de copier/coller un fichier d'un emplacement à un autre. Elle attend 2 args : 1/ L'emplacement du fichier à copier et 2/ l'emplacement définitif de la copie. 
					
				}
				else{
					$msg .= '<div class="error">Taille maximum des images : 1Mo</div>';
				}
			}
			else{
				$msg .= '<div class="error">Extensions autorisées : PNG, JPG, JPEG, GIF</div>';
			}
		}
		else{
			$msg .= '<div class="error">Veuillez sélectionner une nouvelle image</div>';
		}
	}
    // Je sors de cette condition avec $nom_photo ayant soit la valeur 'default.jpg', soit le nom de la photo chargée par User avec la référence, soit la photo du produit que je suis en train de modifier.

    // Enregistrement dans la BDD
    echo 'test1';
    //if(!empty($_POST['nomAppart']) && !empty($_POST['description']) && !empty($_POST['photo']) && !empty($_POST['pays']) && !empty($_POST['ville']) && !empty($_POST['adresse']) && !empty($_POST['cp']) && !empty($_POST['capacite']) && !empty($_POST['categorie'])){
        if (!empty($_POST['nomAppart'])){

        $resultat = $pdo -> prepare("INSERT INTO appart (titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categorie)");

        echo 'test2';

        $resultat -> bindParam(':titre', $_POST['nomAppart'], PDO::PARAM_STR);
        $resultat -> bindParam(':description', $_POST['description'], PDO::PARAM_STR);

        $nom_photo =  utf8_encode($nom_photo);
        $resultat -> bindParam(':photo', $nom_photo , PDO::PARAM_STR);

        $resultat -> bindParam(':pays', $_POST['pays'], PDO::PARAM_STR);
        $resultat -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
        $resultat -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $resultat -> bindParam(':cp', $_POST['cp'], PDO::PARAM_INT);
        $resultat -> bindParam(':capacite', $_POST['capacite'], PDO::PARAM_INT);
        $resultat -> bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
        
        $resultat -> execute();
        // if($resultat -> execute()){
        //     $last_id = $pdo-> lastInsertId();
        //     $msg .= '<div class="validation">Le logement N°' . $last_id . ' a été enregistré avec succès !</div>';
        // }
    }
}


require_once('inc/header.inc.php');
?>


<div class="container">
    <?= $msg ?>
    <div class="col-md-12">
        <table class="table">
            <tr>
                <th>id_appart</th>
                <th>Nom appart</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Capacité</th>
                <th>Catégorie</th>
                <th>Action</th>
            </tr>
            <?php while($appart = $resultat -> fetch(PDO::FETCH_ASSOC)) : ?>
                <?php foreach($appart as $value) : ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
                
            <?php endwhile; ?>
            <td>Modification</td>
        </table>
    </div>

    <div class="col-md-12">
        <form action="" method="post" enctype="multipart/form-data">
            <label>Nom appart<input type="text" name="nomAppart" /></label>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <label>Photo<input type="file" name="photo" /></label>
            <label>Capacité
                <select name="capacite" id="capacite">
                    <?php for($i=1; $i<21; $i++) :?>
                    <option value="<?=$i?>"><?=$i?></option>
                    <?php endfor; ?>
                </select>
            </label>
            <label>Catégorie
                <select name="categorie">
                    <option value="maison">Maison</option>
                    <option value="studio">Studio</option>
                    <option value="appartement">Appartement</option>
                </select>                
            </label>
            <label>Pays
                <select name="pays">
                    <option value="france">France</option>
                    <option value="espagne">Espagne</option>
                </select>
            </label>
            <label>Ville
                <select name="ville">
                    <option value="paris">Paris</option>
                    <option value="lyon">Lyon</option>
                </select>
            </label>
            <label for="adresse">Adresse</label>
            <textarea name="adresse" id="adresse" cols="30" rows="10"></textarea>
            <label>Code Postal<input type="text" name="cp" /></label>
            <button type="submit">Ajouter</button>
        </form>
    </div>

</div>

<?php
require_once('inc/footer.inc.php');
?>
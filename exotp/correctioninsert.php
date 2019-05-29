<!--
TP2 PHP - Gestion produits :
On souhaite pouvoir gérer les produits d’une boutique via une interface web.
Il faut pouvoir gérer ces données pour chaque produit :
Code produit - Obligatoire
Format : 3 lettres Tiret 3 chiffres Tiret Date du jour format yyyymmdd
Nom du produit - Obligatoire
Description du produit - Obligatoire
Prix - Obligatoire
Format : 2 chiffres après la virgule
Stock restant - Obligatoire
Catégorie - Facultatif
Il faut également un identifiant et la date de création de l’enregistrement.

Exercice :

Créer la tables mysql correspondante *
Créer dans une page le formulaire de création de produit *
Créer une autre page pour afficher tous les produits du plus récent au plus vieux. Vous afficherez toutes les informations (sauf ID et date de création) avec le html et le css que vous souhaitez. Pour chaque produit, il doit y avoir un bouton de modification et un autre de suppression.
Adaptez la page de création de produit pour qu’elle soit également une page de modification de produit. On arrive sur cette page grâce au clic du bouton “Modifier” dans la liste des produits.
Codez la suppression de produit
 
Remarques :

Pour le prix, il faudra faire attention : sur le site web, il faudra afficher les décimales après une virgule, alors qu’en base, c’est le point qui sépare les décimales. Trouver le type de données MySQL le plus adapté !
Pour les formulaires création et modification, vous devez gérer les erreurs en html5 mais également côté serveur.
 

Exos supplémentaires - stats :

Créer une page qui affiche le nom de toutes les catégories existantes dans les produits. Affichez à côté du nom des catégories le nombre de produits se trouvant dans ces catégories.
Ajoutez dans cette page un mini-formulaire avec un input numérique. Quand vous validez ce formulaire, la page doit se recharger mais n’afficher que les catégories où le nombre de produits est égal ou inférieur au nombre saisi dans ce champ.-->


<!--voir si le bouton a été cliqué pour creer nouveau produit-->

<?php


    if (isset($_POST['btn_create_product'])) {

   
        // 1- récupérer les valeurs envoyées depuis le formulaire
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price');
        $stock = filter_input(INPUT_POST, 'stock');
        $category = filter_input(INPUT_POST, 'category');

        

        // 2- vérifier que les données sont valides
        // verification des erreurs cote serveur obligatoire la plus importante
        $errors = [];
        if (!preg_match("/[a-zA-Z]{3}-[0-9]{3}/", $code)) {
            $errors[] = "Veuillez saisir un code produit valide";
        }
        if ($name == null || $name == "" || mb_strlen($name) > 150) {
            $errors[] = "Veuillez saisir un nom de produit valide";
        }
        if ($description == null || $description == "") {
            $errors[] = "Veuillez saisir une description";
        }
        //if (!preg_match("/[0-9]{5}(,[0-9]{1,2})?/", $price)) {
        if (!preg_match("/[0-9]{1,5}(.[0-9]{1,2})?/", $price)) {
            $errors[] = "Veuillez saisir un prix valide";
        }
        if (!preg_match("/[0-9]{1,5}/", $stock)) {
            $errors[] = "Veuillez saisir un stock";
        }
        $categories = ["Processeur", "Carte graphique", "Ecran"];
        // mb_strlen($category) > 50 : pas utile car la vérif d'après englobe cette vérif
        if ($category != "" && !in_array($category, $categories)) {
            $errors[] = "Veuillez sélectionner une catégorie valide";
        }

        if (count($errors) > 0) {
            echo "Merci de corriger ces erreurs :<br>";
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        }
        else {
            // enregistrement en bdd
            // 1- connexion à la base
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=php_formation;charset=UTF8", 'root', '');
            }

        //catch pdoexception attrape les erreurs et empeche de faire planter la base
        //get message pour afficher et pouvoir debeuger
            catch (PDOException $exception) {
                // pour le dev : debugger, le message d'erreur précis peut se récupérer comme ça :
                // $exception->getMessage();
                echo "Erreur de connexion à la base";
                exit;
            }

            // 2- formater les données
            // rajouter la partie manquante dans le format du code : la date générée automatique
            $code = $code."-".date('Ymd');
            // remplacer la virgule du price par un point
            $price = str_replace(',', '.', $price);
            // préparer la date/heure d'insertion
            $createdAt = date('Y-m-d H:i:s');

            // 3- requête d'insertion
            $statement = $pdo->prepare("
                            INSERT INTO product
                            (code, name, description, price, stock, category, created_at)
                            VALUES (:code,:name, :desc, :price, :stock, :cat, :created);
            ");

            // bindParam directement dans un tableau (passé en paramètre de la fonction execute)
            $result = $statement->execute([
                ':code' => $code,
                ':name' => $name,
                ':desc' => $description,
                ':price' => $price,
                ':stock' => $stock,
                ':cat' => $category,
                ':created' => $createdAt
            ]);

            if ($result) {
                echo "Produit bien enregistré en base";
            }
            else {
                echo "Erreur denregistrement en bdd";
            }
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Création de produits</title>
    </head>

    <body>
        <h1>Créer un produit</h1>
        <form method="post" action="">
            <input type="text" name="code" placeholder="Code produit (AAA-111)"
                   required pattern="[a-zA-Z]{3}-[0-9]{3}"/><br>
            <input type="text" name="name" placeholder="Nom du produit" required/><br>
            <textarea name="description" required maxlength=150></textarea><br>
            <input type="number" step="any" name="price" required pattern="[0-9]{5},[0-9]{1,2}"/><br>
            <!-- 5 chiffres de0 9 , et 2 chiffres de 0 a 9
              ? presente une fois ou pas  pas obligatoire pattern sur class room expression reguliere-->
            <input type="number" name="stock" required pattern="[0-9]{1,5}"/><br>
<!-- maxi 5 chiffres jusqu'a 5 chiffres verification html mais l'utilisateur peut modifier le code-->
            <select name="category">
                <option></option>
                <option>Processeur</option>
                <option>Carte graphique</option>
                <option>Ecran</option>
            </select><br>

            <input type="submit" name="btn_create_product" />
        </form>
    </body>

</html>

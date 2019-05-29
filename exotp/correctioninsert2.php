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
<!-- tout fait sur la meme page creation et modifier
delete-->
<?php
    if ($_GET['id_to_delete']) {
        // connexion à la base avec l'objet PDO
        $pdo = new PDO("mysql:host=localhost;dbname=php_formation;charset=UTF8", 'root', '');

        // requête de suppression
        $sql = "DELETE FROM produit WHERE id=:id";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute(['id'=> $_GET['id_to_delete']]);
        header('Location: correctionselect.php');
        exit;
    }
?>
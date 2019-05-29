<!DOCTYPE html>
<html>
<head>
  <title>TP</title>
  <style>
            table {
                border:1px solid;
                border-collapse: collapse;
            }

            td, th {
                padding: 7px;
                border:1px solid;
                text-align:center;
            }

            th {
                color:red;
            }
            h1 {
                text-align:center;
                border:3px solid;
                border-radius: 20px;
            }
    </style>
</head>
<body>

  <?php
        if (isset($_POST['btn_new_user'])) {
         // le formulaire a été validé
        $link = mysqli_connect("localhost", "root", "", "php_formation");
        if (!$link) {
        echo "Erreur : Impossible de se connecter à MySQL.";exit;
        }

        // 1- préparer la requêtes
        $codeProduit = filter_input(INPUT_POST, 'code');
        $nomProduit = filter_input(INPUT_POST, 'nom');
        $description =  filter_input(INPUT_POST, 'description_produit');
        $prix =  filter_input(INPUT_POST, 'prix');
        $stockRestant =  filter_input(INPUT_POST, 'stock_restant');
        $categories =  filter_input(INPUT_POST, 'categories');
        $dateCreation =  filter_input(INPUT_POST, 'date_creation');

   
        $dateNaissanceObjet = DateTime::createFromFormat("d/m/Y", $dateNaissance);
        $dateNaissance = $dateNaissanceObjet->format("Y-m-d");


        $result = mysqli_query($link, $sql);
   
 
        // 1- préparer la requête sans les valeurs
        $sql = "INSERT INTO utilisateur (id, code, nom, description_produit, prix, stock_restant, categories, date_creation) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";

        // 2- remplacer les ? par les valeurs
        $statement = mysqli_prepare($link, $sql);

        mysqli_stmt_bind_param($statement, "sss", $codeProduit, $nomProduit, $description, $prix,  $stockRestant, $categories, $dateCreation);

        $result = mysqli_stmt_execute($statement);


        $link = mysqli_connect("localhost", "root", "", "php_formation");
            if (!$link) {
                echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
                echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
                echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            mysqli_set_charset($link, "utf8");

            // envoyer une requête à la base
            // 1- préparer la requête sql
            $sql = "SELECT * FROM produit";
            // 2- envoyer la requête à mysql
            $result = mysqli_query($link, $sql);


            $produits = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($produits as $produit) {
                // afficher un utilisateur méthode 1
            echo $produit["id"]." ".$produit['code']." ".$produit['nom']." ".$produit['description']."".$prix['prix']."".$stockRestant['stock_restant']."".$categories['categories']."".$dateCreation['date_creation'];
            echo "<br>";
                  }
  ?>
 <h1>Liste des produits en BDD</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Date de création</th>
                <th>Code produit</th>
                <th>Nom du produit</th>
                <th>Description du produit</th>
                <th>Prix</th>
                <th>Stock restant</th>  
                <th>Catégorie</th>                
            </tr>
<?php
                  foreach ($produits as $produit) {
                    $dateCreationObjet = DateTime::createFromFormat("Y-m-d", $produit['date_creation']);
                    $dateCreation = $dateCreationObjet->format("d/m/Y");

         echo "<tr>
                                <td>".$produit['id']."</td>
                                 <td>".$dateCreation."</td>
                                <td>
                                <td>".$produit['code_produit']."</td>
                                <td>".$produit['nom_produit']."</td>
                                <td>".$produit['description_produit']."</td>
                                <td>".$produit['prix']."</td>
                                <td>".$produit['stock_restant']."</td>
                                <td>".$produit['categories']."</td>
                              


                              <a href='php-bdd2.php?id_to_remove=".$user['id']."'>
                                        <img width='15' src='image.png'/>
                                </a>
                               <a href='php-bdd2.php?id_to_update=".$user['id']."'>
                                        Modifier
                                    </a>
                                </td>
                            </tr>";
                }
            ?>


      <h1>Modifier un utilisateur en base de données</h1>
        <?php
            if (isset($_POST['id_to_update'])) {
                // récupérer l'id de l'utilisateur passé dans l'URL
                $idProduit = $_POST['id_to_update'];
                // récupérer les informations de cet utilisateur en particulier
                $statement = $pdo->prepare("SELECT * FROM produit WHERE id=:idProduit");
                $statement->bindParam(":idProduit", $idProduit);
                $statement->execute();
                $userToUpdate = $statement->fetch();

                // repasser la date au format FR
                $dateNaissanceObjet = DateTime::createFromFormat("Y-m-d", $userToUpdate['date_naissance']);
                $dateNaissance = $dateNaissanceObjet->format("d/m/Y");

        ?>

         <h1>BDD - Delete et Update</h1>

        <?php
            // suppression d'un enregistrement
            // supprimer un utilisateur
            // si un id a été passé dans l'url
            if (isset($_POST['id_to_remove'])) {
                $idToRemove = $_POST['id_to_remove'];
                $statement = $pdo->prepare("DELETE FROM produit WHERE id=:idProduit");
                $statement->bindParam(':idProduit', $idToRemove);
                $statement->execute();
            }

            // modifier un enregistrement
            // UPDATE utilisateur SET nom='Nouveau nom', email='nouvelemail@mail.fr'
            // WHERE id=10


            $statement = $pdo->query("SELECT * FROM produit");
            $produits = $statement->fetchAll(PDO::FETCH_ASSOC);


        ?>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
   <h1>Modifier un utilisateur en base de données</h1>
        <?php
            if (isset($_POST['id_to_update'])) {
                // récupérer l'id de l'utilisateur passé dans l'URL
                $idProduit = $_POST['id_to_update'];
                // récupérer les informations de cet utilisateur en particulier
                $statement = $pdo->prepare("SELECT * FROM produit WHERE id=:idProduit");
                $statement->bindParam(":idProduit", $idProduit);
                $statement->execute();
                $produitToUpdate = $statement->fetch();

?>

      <h1> inserer les produits<h1>
  <form method="POST" action="">
        
                    <input type="text" name="date_creation" placeholder="Date jj/mm/aaaa"/>
                           <br>
                           <br>
                           
                    <input type="text" name="code_produit" placeholder="Code produit"/>                   
                   <br>
                   <br>
                
                     <input type="text" name="nom_produit" placeholder="Nom du produit"/>
                     <br>
                     <br>
                   
                     <input type="text" name="description_produit" placeholder="Description du produit"/>
                     <br>
                     <br>
                   
                     <input type="number" name="prix" placeholder="Prix" />
                     <br>
                     <br>
                    
                     <input type="text" name="stock_restant" placeholder="Stock restant"/>
                     <br>
                     <br>
                   
                      <input type="text" name="categories" placeholder="Categories"/>
                      <br>
                     <br>
                    
                       <input type="submit" name="btn_edit_user"/>
                </form>


    <!--$produit   idProduit    dateCreation   date_creation-->


</body>
</html>
    
<!--Créer la classe Candidat avec les propriétés suivantes : 

Id
Nom
Email
Téléphone
Texte de motivation
Date de candidature
Compétences
La propriétés Compétences est un tableau d'objet Compétence.

Créer la classe Compétence : 

Id
Nom
Les candidatures peuvent être liées à plusieurs compétences, et les compétences peuvent être liées à plusieurs candidatures.

Créer la base de données avec les tables correspondantes : 3 tables au total.

Insérez quelques compétences dans la table associée, via phpmyadmin.

 

Créer le formulaire html en POST pour ajouter une candidature en base, en passant, côté PHP, par les objets précédemment créés.

Vous devez créer et utiliser les classes CandidatManager et CompetenceManager : CandidatManager pour enregistrer la candidature et CompetenceManager pour récupérer depuis la base les compétences à afficher dans le formulaire de candidature.

 

Faites dans un premier temps au moins la partie Candidature, puis ajoutez la partie Compétence si vous en avez les compétences !
-->


<?php


  
    $pdo = new PDO("mysql:host=localhost;dbname=php_formation;charset=UTF8", 'root', '');

    
    if (isset($_POST['btn_edit_user'])) {
        
      
        $name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $telephone = filter_input(INPUT_POST, "telephone");
        $texte = filter_input(INPUT_POST, "texte");
        $date = filter_input(INPUT_POST, "date");
        $competence = filter_input(INPUT_POST, "competence");
       
    
        $statement = $pdo->prepare("INSERT INTO candidat
                                ( name, email, telephone, texte,  date, competence)
                    VALUES (:name, :email, :telephone, :texte, :date, :competence)
                  ");
       
        $statement->execute([
               
                ':name' => $name,
                ':email' => $email,
                ':telephone' => $telephone,
                ':texte' => $texte,                
                ':date' => $date,
                ':competence' => $competence
                
        ]);
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mon formulaire</title>
        <meta charset="UTF-8">
        <style>
            h1 {
                text-align:center;
                border:3px solid;
                border-radius: 20px;
            }

        </style>
    </head>
<body>


        <h1>Mon formulaire de candidature</h1>


            <form method="POST" action="">
            <input type="text" name="name" placeholder="Nom"/><br><br>
            <input type="text" name="email" placeholder="Email"/><br><br>
            <input type="text" name="telephone" placeholder="Telephone"/><br><br>
            <textarea  name="texte"></textarea><br><br>
            <input type="text" name="date" placeholder="date jj/mm/aaaa"/><br><br>
             <select name="competence">
                <option name=1 value= "informatique">informatique</option>
                <option name=2  value = "relationnel">relationnel</option>
                <option name=3 value = "organisation">organisation</option>
             </select><br><br>
             
            <input type="submit" name="btn_edit_user" />
        </form>

</body>

 </html>
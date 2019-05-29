<?php
    function loadClass($class) {
        require "Entity/".$class.".php";
    }
    spl_autoload_register("loadClass");

    $pdo = new PDO("mysql:host=localhost;dbname=php_formation;charset=UTF8",
    'root', '');

    if (isset($_POST['btn_candidature'])) {
        // récupérer les données dans le formulaire
        $nom = filter_input(INPUT_POST, 'nom');
        $email = filter_input(INPUT_POST, 'email');
        $tel = filter_input(INPUT_POST, 'tel');
        $motivation = filter_input(INPUT_POST, 'motivation');
        $competencesId = filter_input(INPUT_POST, 'competences',
                                    FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $candidat = new Candidat($nom, $email, $tel, $motivation);
        $candidat->setCompetences($competencesId);

        $candidatManager = new CandidatManager($pdo);
        $candidatManager->insert($candidat);

        // on peut utiliser l'id qui vient d'être généré car on l'a récupérer
        // dans candidatManager
        // echo $candidat->getId();
    }

    $competenceManager = new CompetenceManager($pdo);
    $competences = $competenceManager->selectAll();
?>

<form action="" method="post">
    <input type="text" name="nom" placeholder="Nom" required/>
    <input type="email" name="email" placeholder="email" required pattern="[a-z0-9_\-]+@[a-z0-9_\-]+\.[a-z]{2,}"/>
    <input type="tel" name="tel" placeholder="Téléphone"  pattern="0(6|7)\d{8}"/>
    <textarea name="motivation" placeholder="Motivation"></textarea>

    <select multiple name="competences[]">
        <?php
            foreach ($competences as $competence) {
                echo "<option value='".$competence->getId()."'>".$competence->getNom()."</option>";
            }
        ?>
    </select>

    <input type="submit" name="btn_candidature" />
</form>

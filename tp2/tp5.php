 
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
class CompetenceManager {
public function selectAll() {
            // on récupère tous les enregistrements en bdd dans la table personnage
            $statement = $this->db->prepare("SELECT * FROM candidat");
            $statement->execute();
            $persosArray = $statement->fetchAll(PDO::FETCH_ASSOC);

            $candidats = [];
            // pour chaque enregistrement en bdd, on instancie un personnage
            foreach ($persosArray as $persoArray) {
                $candidat = new candidat($persoArray['name'],
                    $persoArray['email'],
                    $persoArray['telephone'],
                    $persoArray['texte'],
                    $persoArray['date'],
                    $persoArray['competence']
                );
                // on met ce personnage dans le tableau de personnages
                $candidats[] = $candidat;
            }

            return $candidats;
        }
    }


?>
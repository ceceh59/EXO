<?php
    class CandidatManager {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function insert($candidat) {
            // commencer une transaction : les transactions servent à s'assurer
            // que l'ensemble des requêtes vont fonctionner
            // avant de vraiment exécuter les insert into, update, delete

            // débuter la transaction : toutes les requêtes vont être testées
            // mais les données ne seront pas vraiment enregistrées. Cela uniquement à savoir
            // si toutes les vont fonctionner avant de les valider
            $this->db->beginTransaction();

            $statement = $this->db->prepare("INSERT INTO 
              candidat (nom, email, tel, motivation, date)
              VALUES (:nom, :email, :tel, :motivation, :date)");

            $resultCandidat = $statement->execute([
                ":nom" => $candidat->getNom(),
                ":email" => $candidat->getEmail(),
                ":tel" => $candidat->getTel(),
                ":motivation" => $candidat->getMotivation(),
                ":date" => $candidat->getDate()
            ]);

            // récupérer l'id qui vient d'être affecté à l'enregistrement
            $idInsere = $this->db->lastInsertId();
            $candidat->setId($idInsere);

            // enregistrer les competences
            $controlCompetenceOk = [];
            foreach ($candidat->getCompetences() as $competenceId) {
                $statement = $this->db->prepare("INSERT INTO 
                      candidat_competence (candidat_id, competence_id)
                      VALUES (:candidat_id, :competence_id)");

                $resultCompetence = $statement->execute([
                    ':candidat_id' => $candidat->getId(),
                    ':competence_id' => $competenceId,
                ]);

                $controlCompetenceOk[] = $resultCompetence;
            }

            // valider la transaction poure dire à mysql de vraiment
            // enregistrer les données
            if ($resultCandidat == true && !in_array(false, $controlCompetenceOk)) {
                $this->db->commit();
                return true;
            }

            // si au moins une des requêtes a planté, on annule tout
            else {
                $this->db->rollback();
                return false;
            }
        }

    }

?>
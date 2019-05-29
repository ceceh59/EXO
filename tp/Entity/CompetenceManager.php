<?php
       class CompetenceManager {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function selectAll() {
            $statement = $this->db->prepare("SELECT * FROM competence");
            $statement->execute();

            $competences = [];
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                $competence = new Competence($result['id'], $result['nom']);
                $competences[] = $competence;
            }

            return $competences;
        }

    }

?>
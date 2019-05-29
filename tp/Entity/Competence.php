<?php
    class Competence {
        private $id;
        private $nom;

        /**
         * Competence constructor.
         * @param $id
         * @param $nom
         */
        public function __construct($id, $nom)
        {
            $this->id = $id;
            $this->nom = $nom;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->nom;
        }

        /**
         * @param mixed $nom
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
        }




    }
?>
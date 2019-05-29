<?php
    class Candidat {
        private $id;
        private $nom;
        private $email;
        private $tel;
        private $motivation;
        private $date;
        private $competences;

        /**
         * Candidat constructor.
         * @param $id
         * @param $nom
         * @param $email
         * @param $tel
         * @param $motivation
         * @param $date
         */
        public function __construct($nom, $email, $tel, $motivation, $date=null, $id=null)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->email = $email;
            $this->tel = $tel;
            $this->motivation = $motivation;
            if ($date == null) {
                $this->date = date('Y-m-d H:i:s');
            }
            else {
                $this->date = $date;
            }
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

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getTel()
        {
            return $this->tel;
        }

        /**
         * @param mixed $tel
         */
        public function setTel($tel)
        {
            $this->tel = $tel;
        }

        /**
         * @return mixed
         */
        public function getMotivation()
        {
            return $this->motivation;
        }

        /**
         * @param mixed $motivation
         */
        public function setMotivation($motivation)
        {
            $this->motivation = $motivation;
        }

        /**
         * @return mixed
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @param mixed $date
         */
        public function setDate($date)
        {
            $this->date = $date;
        }



        /**
         * @return mixed
         */
        public function getCompetences()
        {
            return $this->competences;
        }

        /**
         * @param mixed $competences
         */
        public function setCompetences($competences)
        {
            $this->competences = $competences;
        }
    }
?>
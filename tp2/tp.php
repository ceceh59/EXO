<?php  
/*Créer la classe Candidat avec les propriétés suivantes : 

Id
Nom
Email
Téléphone
Texte de motivation
Date de candidature
Compétences
La propriété Compétences est un tableau d'objet Compétence.

Créer la classe Compétence : 

Id
Nom
Les candidatures peuvent être liées à plusieurs compétences, et les compétences peuvent être liées à plusieurs candidatures.

Créer la base de données avec les tables correspondantes : 3 tables au total.

Insérez quelques compétences dans la table associée, via phpmyadmin.

 

Créer le formulaire html en POST pour ajouter une candidature en base, en passant, côté PHP, par les objets précédemment créés.

Vous devez créer et utiliser les classes CandidatManager et CompetenceManager : CandidatManager pour enregistrer la candidature et CompetenceManager pour récupérer depuis la base les compétences à afficher dans le formulaire de candidature.

 

Faites dans un premier temps au moins la partie Candidature, puis ajoutez la partie Compétence si vous en avez les compétences !
*/



   /** OBJET **/
    class Candidat
    {
        // propriétés
        private $id;
        private $name;
        private $email;
        private $telephone;
        private $texte;
        private $date;
        private $competence;

        // constructeur
        public function __construct($name="", $email="",$telephone,$texte,$date,$competence)
        {
            //$this->name = $nom;
            $this->setName($id);
            $this->setName($name);
            $this->setEmail($email);
            $this->setTelephone($telephone);
            $this->setTexte($texte);
            $this->setDate($date);
			$this->setCompetence($competence);

        }



	        // méthodes : getter/setter ou accesseur/mutateur en fr
        // pour obtenir get et modifier la valeur set comme c'est en private


        public function getId() {
            return $this->id;
        }

        public function setId($id) {
           
            $this->id = $id;
        }



        
        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $name = mb_strtoupper($name);
            $this->name = $name;
        }

           public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            
            $this->email = $email;
        }

           public function getTelephone() {
            return $this->telephone;
        }

        public function setTelephone($telephone) {
           
            $this->telephone = $telephone;
        }

           public function getTexte() {
            return $this->texte;
        }

        public function setTexte($texte) {
           
            $this->texte = $texte;
        }

           public function getDate() {
            return $this->date;
        }

        public function setDate($date) {
            
            $this->date = $date;
        }



           public function getCompetence() {
            return $this->competence;
        }

        public function setCompetence($competence) {
            
            $this->competence = $competence;
        }


}

		//$competence =[$competences]
  ?>      
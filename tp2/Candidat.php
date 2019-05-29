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

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 19 Avril 2019 à 11:27
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `php_formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `motivation` text,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `candidat`
--

INSERT INTO `candidat` (`id`, `nom`, `email`, `tel`, `motivation`, `date`) VALUES
(1, 'test', 'test@gmail.com', '0620202020', ',hgn,hg,gh,', '2019-04-19 10:47:32');

-- --------------------------------------------------------

--
-- Structure de la table `candidat_competence`
--

CREATE TABLE `candidat_competence` (
  `candidat_id` int(11) NOT NULL,
  `competence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id`, `nom`) VALUES
(1, 'php'),
(2, 'javascript');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `couleur`
--

INSERT INTO `couleur` (`id`, `name`) VALUES
(1, 'Noir'),
(2, 'Jaune'),
(3, 'Vert');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(2, 'Belgique'),
(3, 'Italie'),
(4, 'Allemagne'),
(5, 'Espagne');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `nom` varchar(100) NOT NULL,
  `sante` smallint(6) NOT NULL,
  `_force` tinyint(4) NOT NULL,
  `experience` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personnage`
--

INSERT INTO `personnage` (`id`, `created_at`, `nom`, `sante`, `_force`, `experience`) VALUES
(1, '2019-04-17 10:15:01', 'Dragon', 59, 15, 50),
(2, '2019-04-17 10:15:01', 'Pikachu', -11, 8, 50),
(3, '2019-04-17 10:16:03', 'Dragon', -5, 19, 40),
(4, '2019-04-17 10:16:03', 'Pikachu', 0, 18, 40);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `stock` smallint(6) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `pays_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `description`, `price`, `stock`, `category`, `created_at`, `pays_id`) VALUES
(4, 'AGH-159-20190412', 'Produit 1', 'cswcsw', '15.00', 1, 'Carte graphique', '2019-04-12 14:43:06', 2),
(5, 'ABC-123-20190412', 'hthft', 'htfhfth', '15.89', 2, 'Carte graphique', '2019-04-12 14:43:16', 2),
(6, 'ECR-869-20190412', 'Ecran 19', 'FRGDRGRD', '156.00', 5, 'Ecran', '2019-04-12 16:12:23', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product_couleur`
--

CREATE TABLE `product_couleur` (
  `product_id` int(11) NOT NULL,
  `couleur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_couleur`
--

INSERT INTO `product_couleur` (`product_id`, `couleur_id`) VALUES
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `date_naissance`, `age`) VALUES
(20, 'test', 'test@gmail.com', '2010-10-10', 10),
(21, 'thomas56du59', 'test@mail.fr', '2017-02-02', 25),
(22, 'fab', 'test', '2016-01-01', 15),
(23, 'Ouja', 'test@mail.fr', '2018-02-02', 55),
(24, 'test', 'test45@gmail.com', '2018-02-02', 13),
(25, 'thomas', 'test@gmail.com', '2010-10-10', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `candidat_competence`
--
ALTER TABLE `candidat_competence`
  ADD PRIMARY KEY (`candidat_id`,`competence_id`),
  ADD KEY `FK_COMPETENCE` (`competence_id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PAYS` (`pays_id`);

--
-- Index pour la table `product_couleur`
--
ALTER TABLE `product_couleur`
  ADD PRIMARY KEY (`product_id`,`couleur_id`),
  ADD KEY `FK_COLOR` (`couleur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `candidat_competence`
--
ALTER TABLE `candidat_competence`
  ADD CONSTRAINT `FK_CANDIDAT` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`id`),
  ADD CONSTRAINT `FK_COMPETENCE` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_PAYS` FOREIGN KEY (`pays_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `product_couleur`
--
ALTER TABLE `product_couleur`
  ADD CONSTRAINT `FK_COLOR` FOREIGN KEY (`couleur_id`) REFERENCES `couleur` (`id`),
  ADD CONSTRAINT `FK_PRODUCT` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


   /** OBJET **/
    class Candidat
    {
        // propriétés
        private $id;
        private $nom;
        private $email;
        private $telephone;
        private $texte;
        private $date;
        private $competence;

        // constructeur
        public function __construct($nom="", $email="",$telephone,$texte,$date,$competence)
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
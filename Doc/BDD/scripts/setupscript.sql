-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.28 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour keepitfit
CREATE DATABASE IF NOT EXISTS `keepitfit` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `keepitfit`;

-- Listage de la structure de la table keepitfit. exercises
CREATE TABLE IF NOT EXISTS `exercises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise` varchar(45) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `repetition` int DEFAULT NULL,
  `time` int DEFAULT NULL,
  `difficulty` int NOT NULL,
  `materials_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Exercise_UNIQUE` (`exercise`),
  KEY `fk_exercises_materials1_idx` (`materials_id`),
  CONSTRAINT `fk_exercises_materials1` FOREIGN KEY (`materials_id`) REFERENCES `materials` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises : ~3 rows (environ)
DELETE FROM `exercises`;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;
INSERT INTO `exercises` (`id`, `exercise`, `image`, `description`, `repetition`, `time`, `difficulty`, `materials_id`) VALUES
	(14, 'test', 'musculation-pectoraux-pompes.jpg', 'Error!: SQLSTATE[42000]: ', 12, 12, 1, 6),
	(15, 'Grossmann', 'recto.jpg', 'fdsdfgb', 12, 12, 2, 6),
	(16, 'Pompes', 'musculation-pectoraux-pompes.jpg', 'Les pieds sont joints, et les mains écartées un peu plus loin que l&#039;envergure des épaules. Le but de l&#039;exercice est d&#039;abaisser tout le corps en restant droit, grâce à l&#039;unique travail des bras. Le corps descend jusqu&#039;à ce que la poitrine frôle le sol. Un abaissement et une remontée constituent une pompe.', 15, 0, 2, 6);
/*!40000 ALTER TABLE `exercises` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. exercises_practice_places
CREATE TABLE IF NOT EXISTS `exercises_practice_places` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise_id` int NOT NULL,
  `place_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Exercises_has_Places_Places1_idx` (`place_id`),
  KEY `fk_Exercises_has_Places_Exercises1_idx` (`exercise_id`),
  CONSTRAINT `fk_Exercises_has_Places_Exercises1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`),
  CONSTRAINT `fk_Exercises_has_Places_Places1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises_practice_places : ~3 rows (environ)
DELETE FROM `exercises_practice_places`;
/*!40000 ALTER TABLE `exercises_practice_places` DISABLE KEYS */;
INSERT INTO `exercises_practice_places` (`id`, `exercise_id`, `place_id`) VALUES
	(6, 14, 1),
	(7, 15, 1),
	(8, 16, 3);
/*!40000 ALTER TABLE `exercises_practice_places` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. exercises_use_targetedareas
CREATE TABLE IF NOT EXISTS `exercises_use_targetedareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise_id` int NOT NULL,
  `targetedarea_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Exercises_has_TargetedAreas_TargetedAreas1_idx` (`targetedarea_id`),
  KEY `fk_Exercises_has_TargetedAreas_Exercises1_idx` (`exercise_id`),
  CONSTRAINT `fk_Exercises_has_TargetedAreas_Exercises1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`),
  CONSTRAINT `fk_Exercises_has_TargetedAreas_TargetedAreas1` FOREIGN KEY (`targetedarea_id`) REFERENCES `targetedareas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises_use_targetedareas : ~3 rows (environ)
DELETE FROM `exercises_use_targetedareas`;
/*!40000 ALTER TABLE `exercises_use_targetedareas` DISABLE KEYS */;
INSERT INTO `exercises_use_targetedareas` (`id`, `exercise_id`, `targetedarea_id`) VALUES
	(6, 14, 10),
	(7, 15, 10),
	(8, 16, 3);
/*!40000 ALTER TABLE `exercises_use_targetedareas` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. materials
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.materials : ~6 rows (environ)
DELETE FROM `materials`;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` (`id`, `name`) VALUES
	(6, 'Aucun'),
	(5, 'Barre'),
	(2, 'Barre de traction'),
	(4, 'Barre EZ'),
	(1, 'Haltère'),
	(3, 'Kettlebell');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. places
CREATE TABLE IF NOT EXISTS `places` (
  `id` int NOT NULL AUTO_INCREMENT,
  `place` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `place_UNIQUE` (`place`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.places : ~5 rows (environ)
DELETE FROM `places`;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`id`, `place`) VALUES
	(1, 'Extérieur'),
	(2, 'Intérieur'),
	(3, 'Maison'),
	(5, 'Salle de CrossFit'),
	(4, 'Salle de Fitness');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. programs
CREATE TABLE IF NOT EXISTS `programs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.programs : ~3 rows (environ)
DELETE FROM `programs`;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` (`id`, `name`) VALUES
	(2, 'Cardio'),
	(1, 'Musculation'),
	(3, 'Renforcement');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.roles : ~2 rows (environ)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(2, 'Admin'),
	(1, 'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. sequencies
CREATE TABLE IF NOT EXISTS `sequencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise_id` int NOT NULL,
  `program_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Sequencies_Exercises1_idx` (`exercise_id`),
  KEY `fk_Sequencies_Programs1_idx` (`program_id`),
  CONSTRAINT `fk_Sequencies_Exercises1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`),
  CONSTRAINT `fk_Sequencies_Programs1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.sequencies : ~3 rows (environ)
DELETE FROM `sequencies`;
/*!40000 ALTER TABLE `sequencies` DISABLE KEYS */;
INSERT INTO `sequencies` (`id`, `exercise_id`, `program_id`) VALUES
	(6, 14, 2),
	(7, 15, 2),
	(8, 16, 1);
/*!40000 ALTER TABLE `sequencies` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. sequencies_has_users
CREATE TABLE IF NOT EXISTS `sequencies_has_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sequencie_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Sequencies_has_Users_Users1_idx` (`user_id`),
  KEY `fk_Sequencies_has_Users_Sequencies1_idx` (`sequencie_id`),
  CONSTRAINT `fk_Sequencies_has_Users_Sequencies1` FOREIGN KEY (`sequencie_id`) REFERENCES `sequencies` (`id`),
  CONSTRAINT `fk_Sequencies_has_Users_Users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.sequencies_has_users : ~0 rows (environ)
DELETE FROM `sequencies_has_users`;
/*!40000 ALTER TABLE `sequencies_has_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `sequencies_has_users` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. targetedareas
CREATE TABLE IF NOT EXISTS `targetedareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.targetedareas : ~10 rows (environ)
DELETE FROM `targetedareas`;
/*!40000 ALTER TABLE `targetedareas` DISABLE KEYS */;
INSERT INTO `targetedareas` (`id`, `name`) VALUES
	(10, 'Abdominaux'),
	(9, 'Avant Bras'),
	(2, 'Biceps'),
	(7, 'Fessier'),
	(8, 'Mollet'),
	(11, 'Obliques'),
	(3, 'Pectoraux'),
	(6, 'Quadriceps'),
	(5, 'Trapèze'),
	(4, 'Triceps');
/*!40000 ALTER TABLE `targetedareas` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `weight` int NOT NULL,
  `height` int NOT NULL,
  `password` varchar(60) NOT NULL,
  `birthday` date NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Users_Roles_idx` (`role_id`),
  CONSTRAINT `fk_Users_Roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.users : ~1 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `weight`, `height`, `password`, `birthday`, `role_id`) VALUES
	(1, 'admin@admin.com', 'Admin', 'Admin', 1, 1, '$2y$10$BBgfCzuL2zkYWUpoWGJHb.pul6IF7zTqaTKrbJNQHQ1g0jLmMNSMm', '2022-05-17', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

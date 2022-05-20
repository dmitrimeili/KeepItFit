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
  `description` varchar(1500) NOT NULL,
  `repetition` int DEFAULT NULL,
  `time` int DEFAULT NULL,
  `difficulty` int NOT NULL,
  `materials_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Exercise_UNIQUE` (`exercise`),
  KEY `fk_exercises_materials1_idx` (`materials_id`),
  CONSTRAINT `fk_exercises_materials1` FOREIGN KEY (`materials_id`) REFERENCES `materials` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises : ~3 rows (environ)
DELETE FROM `exercises`;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;
INSERT INTO `exercises` (`id`, `exercise`, `image`, `description`, `repetition`, `time`, `difficulty`, `materials_id`) VALUES
	(17, 'Pompes', 'musculation-pectoraux-pompes.jpg', 'Les pieds sont joints, et les mains écartées un peu plus loin que l&#039;envergure des épaules. Le but de l&#039;exercice est d&#039;abaisser tout le corps en restant droit, grâce à l&#039;unique travail des bras. Le corps descend jusqu&#039;à ce que la poitrine frôle le sol. Un abaissement et une remontée constituent une pompe', 15, 0, 2, 6),
	(18, 'Planche', 'Planche.jpg', 'Le dos est bien droit, parallèle au sol. Maintenez la position en contractant les abdominaux et les fessiers. Faites attention à ne pas lever les fesses trop haut et si vous avez mal en bas du dos, cela signifie que le bassin est trop bas. Votre corps doit réellement avoir l&#039;aspect d&#039;une planche.&quot;', 3, 60, 3, 6),
	(19, 'Sumo Deadlift', 'sumo-souleve-terre.jpg', 'Positionnez vous devant une barre droite chargée. Les mains en pronation ou en prise mixte et les pieds écartés plus que la largeur des épaules. Penchez votre buste vers l’avant tout en gardant le dos plat, les genoux fléchis et orientés vers l’extérieur puis saisissez la barre.\r\n\r\nFlechissez les jambes jusqu’à ce que vos cuisses soient à l’horizontale ou un peu au dessus (en fonction de votre morphologie). La barre doit être presque collée contre les tibias, le dos doit rester plat pendant tout le mouvement.\r\n\r\nPoussez sur les jambes pour décoller la barre qui doit suivre la ligne des tibias. Puis continuer l’extension des jambes à mi-mouvement tout en redressant le dos. Maintenez la contraction 2 secondes et redescendez la barre de la même façon que pour la montée en fléchissant les jambes sans arrondir le dos. En bodybuilding, il est plus intéressant de ne pas relâcher la barre au sol afin de conserver la tension musculaire et le gainage. Simplement toucher le sol et repartir. En Powerlifting, pour travailler lourd et en force il est plus simple de relâcher la barre avant de remonter.', 10, 0, 3, 5),
	(20, 'Biceps Curl', 'BicepsCurl.jpg', 'Placez les haltères sur le côté, les bras tendus vers le bas. C&#039;est la position de départ. Fléchissez les deux coudes et amenez les deux haltères à l&#039;avant de chaque épaule. Serrez, puis abaissez les deux haltères jusqu&#039;à ce que vos bras soient à nouveau tendus.', 10, 0, 2, 1),
	(21, 'Triceps Curl Ez', 'tricepscurlEz.png', 'Couché(e) sur un banc plat, une barre EZ dans les mains, écartement des mains de la largeur des épaules, les bras sont pliés derrière la tête (le dos des mains est pratiquement en appui sur le front). Levez la barre en tendant complètement les bras au dessus de la tête.', 10, 0, 2, 4),
	(22, 'Squat Barre', 'squat.png', 'Soulevez la barre dans un premier temps, en fléchissant les genoux et en conservant le dos bien droit, pour l&#039;amener contre le haut des cuisses. Une fois debout gardez la tête relevée et le regard droit devant, les épaules en arrière et les pectoraux sortis, et ne verrouillez pas les genoux.', 10, 0, 3, 5),
	(23, 'Front Squat', 'frontsquat.png', 'Le front squat ou squat avant est une variante du squat traditionnel qui consiste à réaliser le mouvement avec la barre devant soi. Cet exercice permet de travailler principalement les quadriceps (droit fémoral, vaste intermédiaire, vaste médial et latéral).', 10, 0, 3, 5),
	(24, 'Bicpes Curl Ez', 'BicepsCurlEz.jpg', 'Prenez une barre Ez (barre de musculation coudée) avec une prise assez large, les mains en supination et les coudes écartés légèrement plus que les poignets. Pliez vos bras en contractant vos biceps puis redescendez sans tendre complètement vos bras de façon à ne pas stresser l&#039;articulation du coude.', 10, 0, 2, 4),
	(25, 'Triceps Curl ', 'TricepsCurl.jpg', 'Assis bien droit, l’haltère saisit à deux mains derrière la nuque avec les bras tendus.\r\nInspirer et fléchissez les coudes pour laissez l’haltère descendre jusqu’à la nuque.\r\nContrôler la phase négative pour que la charge ne heurte pas votre tête.\r\nDéveloppez ensuite l’haltère jusqu’à l’extension complète des bras.\r\nIl est important de contracter la sangle abdominale pour éviter de cambrer le dos et, si possible, d’utiliser un banc à dossier court.', 10, 0, 1, 1),
	(26, 'Développer coucher haltères', 'DeveloppeCoucherHaltere.png', 'Montez les haltères au-dessus de vous jusqu&#039;à ce que vos bras soient tendus, mais sans verrouiller les coudes. Évitez de faire s&#039;entrechoquer les haltères, arrêtez-vous juste avant. Une fois en position haute tenez pendant 1 à 2 secondes pour une contraction optimale.', 10, 0, 2, 1),
	(27, 'Traction latéral câbles', 'Lat-Pull-Down.png', 'Prenez une poignée en main, les mains légèrement plus écartées que la largeur des épaules, et asseyez-vous sur le siège de la machine. Bloquez vos genoux sous les coussins d&#039;appui.\r\nGardez le haut du dos droit, tirez la barre vers le bas et ramenez-la vers la poitrine. Lorsque vous tirez vers le bas, serrez vos omoplates l&#039;une contre l&#039;autre et sentez les muscles du dos se contracter.\r\nEffectuez ce mouvement en utilisant vos muscles lombaires supérieurs et utilisez simplement les bras comme levier entre la barre et les lombaires.\r\nMaintenant, relâchez la barre avec un mouvement contrôlé et étirez vos lats autant que possible.\r\n\r\n', 10, 0, 1, 7),
	(28, 'Élévation latérale Haltères', 'ExEpauleLaterale.jpg', 'Saisissez les haltères, paumes de mains vers le sol. Le mouvement commence avec les haltères sur le côté des cuisses. Élevez les haltères simultanément jusqu&#039;à ce que vos bras atteignent une position horizontale, toujours en gardant les coudes légèrement fléchis', 10, 0, 3, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises_practice_places : ~3 rows (environ)
DELETE FROM `exercises_practice_places`;
/*!40000 ALTER TABLE `exercises_practice_places` DISABLE KEYS */;
INSERT INTO `exercises_practice_places` (`id`, `exercise_id`, `place_id`) VALUES
	(9, 17, 4),
	(10, 18, 4),
	(11, 19, 4),
	(12, 20, 4),
	(13, 21, 4),
	(14, 22, 4),
	(15, 23, 4),
	(16, 24, 4),
	(17, 25, 4),
	(18, 26, 4),
	(19, 27, 4),
	(20, 28, 4);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.exercises_use_targetedareas : ~3 rows (environ)
DELETE FROM `exercises_use_targetedareas`;
/*!40000 ALTER TABLE `exercises_use_targetedareas` DISABLE KEYS */;
INSERT INTO `exercises_use_targetedareas` (`id`, `exercise_id`, `targetedarea_id`) VALUES
	(9, 17, 3),
	(10, 18, 10),
	(11, 19, 7),
	(12, 20, 2),
	(13, 21, 4),
	(14, 22, 6),
	(15, 23, 6),
	(16, 24, 2),
	(17, 25, 4),
	(18, 26, 3),
	(19, 27, 12),
	(20, 28, 13);
/*!40000 ALTER TABLE `exercises_use_targetedareas` ENABLE KEYS */;

-- Listage de la structure de la table keepitfit. materials
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.materials : ~6 rows (environ)
DELETE FROM `materials`;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` (`id`, `name`) VALUES
	(6, 'Aucun'),
	(5, 'Barre'),
	(2, 'Barre de traction'),
	(4, 'Barre EZ'),
	(1, 'Haltère'),
	(3, 'Kettlebell'),
	(7, 'Machines à poulie et câbles');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.sequencies : ~3 rows (environ)
DELETE FROM `sequencies`;
/*!40000 ALTER TABLE `sequencies` DISABLE KEYS */;
INSERT INTO `sequencies` (`id`, `exercise_id`, `program_id`) VALUES
	(9, 17, 1),
	(10, 18, 3),
	(11, 19, 1),
	(12, 20, 1),
	(13, 21, 1),
	(14, 22, 1),
	(15, 23, 1),
	(16, 24, 1),
	(17, 25, 1),
	(18, 26, 1),
	(19, 27, 1),
	(20, 28, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.targetedareas : ~10 rows (environ)
DELETE FROM `targetedareas`;
/*!40000 ALTER TABLE `targetedareas` DISABLE KEYS */;
INSERT INTO `targetedareas` (`id`, `name`) VALUES
	(10, 'Abdominaux'),
	(9, 'Avant Bras'),
	(2, 'Biceps'),
	(12, 'Dos'),
	(13, 'Épaules'),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table keepitfit.users : ~1 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `weight`, `height`, `password`, `birthday`, `role_id`) VALUES
	(1, 'admin@admin.com', 'Admin', 'Admin', 1, 1, '$2y$10$BBgfCzuL2zkYWUpoWGJHb.pul6IF7zTqaTKrbJNQHQ1g0jLmMNSMm', '2022-05-17', 2),
	(2, 'test@test.com', 'test', 'test', 70, 170, '$2y$10$V1UNekpkcXy5dPbFk6pc9.r63OyXBukEqGznTq3CJpvQHEb3Im1MS', '2022-04-25', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

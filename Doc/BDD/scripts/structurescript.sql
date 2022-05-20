-- MySQL Workbench Synchronization
-- Generated: 2022-05-20 08:53
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Dmitri.MEILI

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `keepitfit`.`exercises` 
DROP FOREIGN KEY `fk_exercises_materials1`;

ALTER TABLE `keepitfit`.`users` 
DROP FOREIGN KEY `fk_Users_Roles`;

ALTER TABLE `keepitfit`.`exercises_practice_places` 
DROP FOREIGN KEY `fk_Exercises_has_Places_Exercises1`,
DROP FOREIGN KEY `fk_Exercises_has_Places_Places1`;

ALTER TABLE `keepitfit`.`exercises_use_targetedareas` 
DROP FOREIGN KEY `fk_Exercises_has_TargetedAreas_Exercises1`,
DROP FOREIGN KEY `fk_Exercises_has_TargetedAreas_TargetedAreas1`;

ALTER TABLE `keepitfit`.`sequencies` 
DROP FOREIGN KEY `fk_Sequencies_Exercises1`,
DROP FOREIGN KEY `fk_Sequencies_Programs1`;

ALTER TABLE `keepitfit`.`sequencies_has_users` 
DROP FOREIGN KEY `fk_Sequencies_has_Users_Sequencies1`,
DROP FOREIGN KEY `fk_Sequencies_has_Users_Users1`;

ALTER TABLE `keepitfit`.`exercises` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `description` `description` VARCHAR(1500) NOT NULL ;

ALTER TABLE `keepitfit`.`users` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`roles` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`targetedareas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`places` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`programs` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`exercises_practice_places` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`exercises_use_targetedareas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`sequencies` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`sequencies_has_users` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`materials` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `keepitfit`.`exercises` 
ADD CONSTRAINT `fk_exercises_materials1`
  FOREIGN KEY (`materials_id`)
  REFERENCES `keepitfit`.`materials` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `keepitfit`.`users` 
ADD CONSTRAINT `fk_Users_Roles`
  FOREIGN KEY (`role_id`)
  REFERENCES `keepitfit`.`roles` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `keepitfit`.`exercises_practice_places` 
ADD CONSTRAINT `fk_Exercises_has_Places_Exercises1`
  FOREIGN KEY (`exercise_id`)
  REFERENCES `keepitfit`.`exercises` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Exercises_has_Places_Places1`
  FOREIGN KEY (`place_id`)
  REFERENCES `keepitfit`.`places` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `keepitfit`.`exercises_use_targetedareas` 
ADD CONSTRAINT `fk_Exercises_has_TargetedAreas_Exercises1`
  FOREIGN KEY (`exercise_id`)
  REFERENCES `keepitfit`.`exercises` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Exercises_has_TargetedAreas_TargetedAreas1`
  FOREIGN KEY (`targetedarea_id`)
  REFERENCES `keepitfit`.`targetedareas` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `keepitfit`.`sequencies` 
ADD CONSTRAINT `fk_Sequencies_Exercises1`
  FOREIGN KEY (`exercise_id`)
  REFERENCES `keepitfit`.`exercises` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Sequencies_Programs1`
  FOREIGN KEY (`program_id`)
  REFERENCES `keepitfit`.`programs` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `keepitfit`.`sequencies_has_users` 
ADD CONSTRAINT `fk_Sequencies_has_Users_Sequencies1`
  FOREIGN KEY (`sequencie_id`)
  REFERENCES `keepitfit`.`sequencies` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Sequencies_has_Users_Users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `keepitfit`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

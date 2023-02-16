DROP DATABASE `document`;

CREATE DATABASE `document`;
USE `document`;

DROP TABLE IF EXISTS `help`;

CREATE TABLE `help` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '1/',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help_sec`;

CREATE TABLE `help_sec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `prim_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '2/',
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`prim_parent`),
  CONSTRAINT `prim_parent` FOREIGN KEY (`prim_parent`) REFERENCES `help` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help_ter`;

CREATE TABLE `help_ter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `sec_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '3/',
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`sec_parent`),
  CONSTRAINT `sec_parent` FOREIGN KEY (`sec_parent`) REFERENCES `help_sec` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help_cuat`;

CREATE TABLE `help_cuat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `ter_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '4/',
  PRIMARY KEY (`id`),
  KEY `ter_parent_idx` (`ter_parent`),
  CONSTRAINT `ter_parent` FOREIGN KEY (`ter_parent`) REFERENCES `help_ter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE VIEW `vw_help_prim_sec` AS select `help`.`id` AS `id_help_prim`,`help`.`title` AS `title_prim`,`help_sec`.`id` AS `id_help_sec`,`help_sec`.`title` AS `title_sec` from (`help` join `help_sec`) where (`help`.`id` = `help_sec`.`prim_parent`);

CREATE VIEW `vw_help_sec_ter` AS select `help_sec`.`id` AS `id_help_sec`,`help_sec`.`title` AS `title_sec`,`help_ter`.`id` AS `id_help_ter`,`help_ter`.`title` AS `title_ter` from (`help_sec` join `help_ter`) where (`help_sec`.`id` = `help_ter`.`sec_parent`);

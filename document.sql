DROP DATABASE IF EXISTS `document`;
CREATE DATABASE IF NOT EXISTS `gamera_ayuda`;
USE `gamera_ayuda`;

DROP TABLE IF EXISTS `help_par`;
CREATE TABLE `help_par` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '0/',
  `filename` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help`;
CREATE TABLE `help` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '1/',
  `filename` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `content_UNIQUE` (`content`(250))
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help_sec`;
CREATE TABLE `help_sec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `prim_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '2/',
  `filename` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `content_UNIQUE` (`content`(250)),
  KEY `hierarchy_idx` (`prim_parent`),
  CONSTRAINT `prim_parent` FOREIGN KEY (`prim_parent`) REFERENCES `help` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `help_ter`;
CREATE TABLE `help_ter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `sec_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '3/',
  `filename` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `content_UNIQUE` (`content`(250)),
  KEY `hierarchy_idx` (`sec_parent`),
  CONSTRAINT `sec_parent` FOREIGN KEY (`sec_parent`) REFERENCES `help_sec` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT;

DROP TABLE IF EXISTS `help_cuat`;
CREATE TABLE `help_cuat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `ter_parent` int NOT NULL,
  `folder` char(2) NOT NULL DEFAULT '4/',
  `filename` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `content_UNIQUE` (`content`(250)),
  KEY `ter_parent_idx` (`ter_parent`),
  CONSTRAINT `ter_parent` FOREIGN KEY (`ter_parent`) REFERENCES `help_ter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
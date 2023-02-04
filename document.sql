CREATE DATABASE  IF NOT EXISTS `document`;
USE `document`;

DROP TABLE IF EXISTS `help`;

CREATE TABLE `help` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18;

INSERT INTO `help` VALUES (1,'punto 1','<p>No se que ta pasando aqui</p>'),(2,'Libera animas','<p>Omnius fidelium de functurus,</p>'),(3,'Lorem ipsum','<p>Dolor sit </p>'),(4,'Ola (de mar)','<p>Pescado</p>'),(5,'asdfghjk','<p>tgbtb6fv6rfv<strong>tyghun7vr</strong><span class=\"ql-cursor\">﻿</span></p>'),(12,'panaderia','<p><img src=\"https://www.glaad.org/sites/default/files/styles/750px/public/images/2015-09/pansexual final.png?itok=au15i1ho\" jsaction=\"load:XAeZkd;\" jsname=\"HiaYvf\" class=\"n3VNCb KAlRDb\" alt=\"What is pansexuality? 4 pan celebs explain in their own words | GLAAD\" data-noaft=\"1\" style=\"width: 467px; height: 249.067px; margin: 3.56667px 0px;\"></p>'),(13,'brendant','<p><img src=\"http://brendamcmorrow.com/wp-content/uploads/2021/07/editBrenda11-06-21DSCF3439-2-cropped.jpg\" alt=\"Brenda McMorrow Kirtan and Chanting Brenda McMorrow\"></p>'),(16,'fotico','<p><br></p><p><img src=\"./img/prueba1.jpg\"></p>'),(17,'dfghjkl','<p>dfghjklkjhgfdscvbnkl</p>');

DROP TABLE IF EXISTS `help_sec`;

CREATE TABLE `help_sec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `prim_parent` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`prim_parent`),
  CONSTRAINT `prim_parent` FOREIGN KEY (`prim_parent`) REFERENCES `help` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2;

INSERT INTO `help_sec` VALUES (1,'dffghjkl;','<p>;ksbfvlia aoivap fvaiuf ufusons f</p>',17);

DROP TABLE IF EXISTS `help_ter`;

CREATE TABLE `help_ter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `sec_parent` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hierarchy_idx` (`sec_parent`),
  CONSTRAINT `sec_parent` FOREIGN KEY (`sec_parent`) REFERENCES `help_sec` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2;

INSERT INTO `help_ter` VALUES (1,'dffghjkl;','<p>;ksbfvlia aoivap </p>',1);

DROP TABLE IF EXISTS `vw_help_prim_sec`;

CREATE VIEW vw_help_prim_sec AS SELECT help.id AS id_help_prim, help.title AS title_prim, help_sec.id AS id_help_sec, help_sec.title AS title_sec FROM help, help_sec WHERE help.id = help_sec.prim_parent;

DROP TABLE IF EXISTS `vw_help_sec_ter`;

CREATE VIEW vw_help_sec_ter AS SELECT help_sec.id AS id_help_sec, help_sec.title AS title_sec, help_ter.id AS id_help_ter, help_ter.title AS title_ter FROM help_sec, help_ter WHERE help_sec.id = help_ter.sec_parent;
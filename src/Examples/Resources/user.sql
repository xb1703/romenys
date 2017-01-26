CREATE DATABASE IF NOT EXISTS `romenys`;

USE `romenys`;

CREATE TABLE IF NOT EXISTS `romenys`.`user` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `email` VARCHAR(50) NOT NULL DEFAULT '',
  `avatar` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB;

ALTER TABLE `romenys`.`user` ADD COLUMN `profile` VARCHAR(255) NOT NULL DEFAULT '' AFTER `avatar`;

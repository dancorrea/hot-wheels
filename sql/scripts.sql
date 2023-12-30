CREATE TABLE `hotwheels`.`serie` ( `id` INT NOT NULL AUTO_INCREMENT , `colecao` VARCHAR(250) NOT NULL , `total` INT(3) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 


CREATE TABLE `hotwheels`.`item` ( `id` INT NOT NULL AUTO_INCREMENT , `colecao` INT NULL , `marca` VARCHAR(100) NOT NULL , `modelo` VARCHAR(100) NOT NULL , `ano` INT(4) NULL , `numero` VARCHAR(10) NULL , `foto` VARCHAR(250) NULL , `dt_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
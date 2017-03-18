CREATE TABLE `cgolin_localhost`.`convite_modelo_dimensao` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`nome` VARCHAR(50) NOT NULL,
`modelo` INT UNSIGNED NOT NULL,
`altura` INT NOT NULL,
`largura` INT NOT NULL,
PRIMARY KEY (`id`),
INDEX `fk_conviteModeloDimensao_conviteModelo_idx` (`modelo` ASC),
CONSTRAINT `fk_conviteModeloDimensao_conviteModelo`
FOREIGN KEY (`modelo`)
REFERENCES `cgolin_localhost`.`convite_modelo` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT);

ALTER TABLE `cgolin_localhost`.`convite_modelo_dimensao` 
DROP FOREIGN KEY `fk_conviteModeloDimensao_conviteModelo`;
ALTER TABLE `cgolin_localhost`.`convite_modelo_dimensao` 
CHANGE COLUMN `modelo` `modelo` INT(11) UNSIGNED NOT NULL ,
CHANGE COLUMN `altura` `altura` INT(5) NOT NULL ,
CHANGE COLUMN `largura` `largura` INT(5) NOT NULL ;
ALTER TABLE `cgolin_localhost`.`convite_modelo_dimensao` 
ADD CONSTRAINT `fk_conviteModeloDimensao_conviteModelo`
FOREIGN KEY (`modelo`)
REFERENCES `cgolin_localhost`.`convite_modelo` (`id`);
ALTER TABLE `cgolin_localhost`.`convite_modelo_dimensao` 
ADD COLUMN `destino` INT(2) NOT NULL AFTER `largura`;
ALTER TABLE `cgolin_localhost`.`convite_modelo_dimensao` 
COMMENT = 'O campo destino contém as variaveis numéricas:\n0 - Dimensão Final\n1 - Cartão\n2 - Envelope\n-1 - Serve tanto para Cartão/Envelope' ;


ALTER TABLE `cgolin_localhost`.`convite_modelo` 
DROP COLUMN `envelope_largura`,
DROP COLUMN `envelope_altura`,
DROP COLUMN `cartao_largura`,
DROP COLUMN `cartao_altura`,
DROP COLUMN `largura_final`,
DROP COLUMN `altura_final`;

-- Setando a dimensao para valor 2 (porque ele exite na tabela para evitar erro da foreign key) --
ALTER TABLE `cgolin_localhost`.`cartao_papel` 
ADD COLUMN `dimensao` INT(11) UNSIGNED NOT NULL DEFAULT 2 AFTER `papel`;

ALTER TABLE `cgolin_localhost`.`cartao_papel` 
ADD INDEX `fk_cartaoPapel_conviteModeloDimensao_idx` (`dimensao` ASC);
ALTER TABLE `cgolin_localhost`.`cartao_papel` 
ADD CONSTRAINT `fk_cartaoPapel_conviteModeloDimensao`
FOREIGN KEY (`dimensao`)
REFERENCES `cgolin_localhost`.`convite_modelo_dimensao` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE `cgolin_localhost`.`envelope_papel` 
ADD COLUMN `dimensao` INT(11) UNSIGNED NOT NULL DEFAULT 2 AFTER `papel`;

ALTER TABLE `cgolin_localhost`.`envelope_papel` 
ADD INDEX `fk_envelopePapel_conviteModeloDimensao_idx` (`dimensao` ASC);
ALTER TABLE `cgolin_localhost`.`envelope_papel` 
ADD CONSTRAINT `fk_envelopePapel_conviteModeloDimensao`
FOREIGN KEY (`dimensao`)
REFERENCES `cgolin_localhost`.`convite_modelo_dimensao` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;






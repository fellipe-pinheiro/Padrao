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

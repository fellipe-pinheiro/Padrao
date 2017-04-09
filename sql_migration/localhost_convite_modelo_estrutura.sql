/*
executado no dev e local

ALTER TABLE `orcas394_db_dev`.`convite_modelo` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`convite_modelo` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`personalizado_modelo` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`personalizado_modelo` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`acabamento` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`acabamento` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`acessorio` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`acessorio` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`fita` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `valor_70mm`;
ALTER TABLE `orcas394_db_dev`.`fita` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`fita_laco` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`fita_laco` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`fita_material` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`fita_material` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`impressao` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `impressao_area`;
ALTER TABLE `orcas394_db_dev`.`impressao` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`impressao_area` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`impressao_area` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`papel` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`papel` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`papel_linha` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`papel_linha` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`fonte` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `nome`;
ALTER TABLE `orcas394_db_dev`.`fonte` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`produto` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `produto_categoria`;
ALTER TABLE `orcas394_db_dev`.`produto` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`produto_categoria` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`produto_categoria` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`assessor` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `comissao`;
ALTER TABLE `orcas394_db_dev`.`assessor` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`evento` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `nome`;
ALTER TABLE `orcas394_db_dev`.`evento` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`forma_pagamento` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `descricao`;
ALTER TABLE `orcas394_db_dev`.`forma_pagamento` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`loja` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `email`;
ALTER TABLE `orcas394_db_dev`.`loja` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`loja` 
ADD COLUMN `ativo` TINYINT(1) NOT NULL DEFAULT 1 AFTER `email`;
ALTER TABLE `orcas394_db_dev`.`loja` 
CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL ;


CREATE TABLE `orcas394_db_dev`.`convite_modelo_dimensao` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`nome` VARCHAR(50) NOT NULL,
`modelo` INT UNSIGNED NOT NULL,
`altura` INT NOT NULL,
`largura` INT NOT NULL,
PRIMARY KEY (`id`),
INDEX `fk_conviteModeloDimensao_conviteModelo_idx` (`modelo` ASC),
CONSTRAINT `fk_conviteModeloDimensao_conviteModelo`
FOREIGN KEY (`modelo`)
REFERENCES `orcas394_db_dev`.`convite_modelo` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT);

ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
DROP FOREIGN KEY `fk_conviteModeloDimensao_conviteModelo`;
ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
CHANGE COLUMN `modelo` `modelo` INT(11) UNSIGNED NOT NULL ,
CHANGE COLUMN `altura` `altura` INT(5) NOT NULL ,
CHANGE COLUMN `largura` `largura` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
ADD CONSTRAINT `fk_conviteModeloDimensao_conviteModelo`
FOREIGN KEY (`modelo`)
REFERENCES `orcas394_db_dev`.`convite_modelo` (`id`);
ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
ADD COLUMN `destino` INT(2) NOT NULL AFTER `largura`;
ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
COMMENT = 'O campo destino contém as variaveis numéricas:\n0 - Dimensão Final\n1 - Cartão\n2 - Envelope\n-1 - Serve tanto para Cartão/Envelope' ;


ALTER TABLE `orcas394_db_dev`.`convite_modelo` 
DROP COLUMN `envelope_largura`,
DROP COLUMN `envelope_altura`,
DROP COLUMN `cartao_largura`,
DROP COLUMN `cartao_altura`,
DROP COLUMN `largura_final`,
DROP COLUMN `altura_final`;

-- Setando a dimensao para valor 2 (porque ele exite na tabela para evitar erro da foreign key) --
ALTER TABLE `orcas394_db_dev`.`cartao_papel` 
ADD COLUMN `dimensao` INT(11) UNSIGNED NOT NULL DEFAULT 2 AFTER `papel`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel` 
ADD INDEX `fk_cartaoPapel_conviteModeloDimensao_idx` (`dimensao` ASC);

ALTER TABLE `orcas394_db_dev`.`envelope_papel` 
ADD COLUMN `dimensao` INT(11) UNSIGNED NOT NULL DEFAULT 2 AFTER `papel`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel` 
ADD INDEX `fk_envelopePapel_conviteModeloDimensao_idx` (`dimensao` ASC);

ALTER TABLE `orcas394_db_dev`.`personalizado_modelo` 
DROP COLUMN `formato`;

CREATE TABLE `personalizado_modelo_dimensao` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`nome` varchar(50) NOT NULL,
`modelo` int(11) unsigned NOT NULL,
`altura` int(5) NOT NULL,
`largura` int(5) NOT NULL,
PRIMARY KEY (`id`),
KEY `fk_personalizadoModeloDimensao_personalizadoModelo_idx` (`modelo`),
CONSTRAINT `fk_personalizadoModeloDimensao_personalizadoModelo` FOREIGN KEY (`modelo`) REFERENCES `personalizado_modelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel` 
ADD COLUMN `dimensao` INT(11) UNSIGNED NOT NULL AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel` 
ADD INDEX `fk_personalizadoPapel_personalizadoModeloDimensao_idx` (`dimensao` ASC);
ALTER TABLE `orcas394_db_dev`.`personalizado_papel` 
ADD CONSTRAINT `fk_personalizadoPapel_personalizadoModeloDimensao`
FOREIGN KEY (`dimensao`)
REFERENCES `orcas394_db_dev`.`personalizado_modelo_dimensao` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `orcas394_db_dev`.`papel_acabamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_almofada` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_corte_laser` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_corte_vinco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_douracao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_empastamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_faca` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_laminacao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`cartao_papel_relevo_seco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_almofada` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_corte_laser` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_corte_vinco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_douracao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_empastamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_faca` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_laminacao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`envelope_papel_relevo_seco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_almofada` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_corte_laser` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_corte_vinco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_douracao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_empastamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_faca` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_laminacao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`personalizado_papel_relevo_seco` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;

ALTER TABLE `orcas394_db_dev`.`sistema` 
DROP COLUMN `id`,
DROP PRIMARY KEY;

ALTER TABLE `orcas394_db_dev`.`convite_modelo_dimensao` 
ENGINE = InnoDB ;

ALTER TABLE `orcas394_db_dev`.`cartao_papel` 
ADD CONSTRAINT `fk_cartaoPapel_conviteModeloDimensao`
FOREIGN KEY (`dimensao`)
REFERENCES `orcas394_db_dev`.`convite_modelo_dimensao` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `orcas394_db_dev`.`envelope_papel` 
ADD CONSTRAINT `fk_envelopePapel_conviteModeloDimensao`
FOREIGN KEY (`dimensao`)
REFERENCES `orcas394_db_dev`.`convite_modelo_dimensao` (`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `orcas394_db_dev`.`forma_pagamento` 
ADD COLUMN `parcelamento_maximo` INT(11) NOT NULL DEFAULT 12 AFTER `ativo`,
ADD COLUMN `valor_minimo` DECIMAL(10,2) NOT NULL DEFAULT 100 AFTER `parcelamento_maximo`;
ALTER TABLE `orcas394_db_dev`.`forma_pagamento` 
CHANGE COLUMN `parcelamento_maximo` `parcelamento_maximo` INT(11) NOT NULL ,
CHANGE COLUMN `valor_minimo` `valor_minimo` DECIMAL(10,2) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`impressao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `ativo`;
ALTER TABLE `orcas394_db_dev`.`impressao` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`cartao_impressao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`cartao_impressao` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`envelope_impressao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`envelope_impressao` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`personalizado_impressao` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`personalizado_impressao` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;



ALTER TABLE `orcas394_db_dev`.`acabamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `ativo`;
ALTER TABLE `orcas394_db_dev`.`acabamento` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`cartao_acabamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`cartao_acabamento` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`envelope_acabamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`envelope_acabamento` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`personalizado_acabamento` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 100 AFTER `valor`;
ALTER TABLE `orcas394_db_dev`.`personalizado_acabamento` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

ALTER TABLE `orcas394_db_dev`.`produto` 
ADD COLUMN `qtd_minima` INT(5) NOT NULL DEFAULT 20 AFTER `ativo`;
ALTER TABLE `orcas394_db_dev`.`produto` 
CHANGE COLUMN `qtd_minima` `qtd_minima` INT(5) NOT NULL ;

*/

CREATE TABLE `cartao_papel_hot_stamping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel_acabamento` int(11) unsigned NOT NULL,
  `cartao_papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `adicionar` tinyint(1) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca_cliche` tinyint(1) NOT NULL,
  `corte_laser_minutos` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cartao_papel_hot_stamping` (`papel_acabamento`),
  KEY `fk_cartaoPapelHotStamping_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelHotStamping_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelHotStamping_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `envelope_papel_hot_stamping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel_acabamento` int(11) unsigned NOT NULL,
  `envelope_papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `adicionar` tinyint(1) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca_cliche` tinyint(1) NOT NULL,
  `corte_laser_minutos` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_envelope_papel_hot_stamping` (`papel_acabamento`),
  KEY `fk_ep_hot_stamping` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelHotStamping_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelHotStamping_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `personalizado_papel_hot_stamping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel_acabamento` int(11) unsigned NOT NULL,
  `personalizado_papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `adicionar` tinyint(1) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca_cliche` tinyint(1) NOT NULL,
  `corte_laser_minutos` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personalizado_papel_hot_stamping` (`papel_acabamento`),
  KEY `fk_personalizadoPapelHotStamping_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelHotStamping_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelHotStamping_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER SCHEMA `cgolin_localhost`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE `cliche` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cliche_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cliche` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_cliche` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `cgolin_localhost`.`cliche_dimensao` 
ADD INDEX `fk__idx` (`cliche` ASC);
ALTER TABLE `cgolin_localhost`.`cliche_dimensao` 
ADD CONSTRAINT `fk_clicheDimensao_cliche`
  FOREIGN KEY (`cliche`)
  REFERENCES `cgolin_localhost`.`cliche` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;


--INICIO: Ajustes na tabela do cartao_papel,envelope_papel,personalizado_papel
--Alterando a coluna da gramatura das tabelas acima descritas para UNSIGNED
ALTER TABLE `cgolin_localhost`.`cartao_papel` 
DROP FOREIGN KEY `fk_cartaoPapel_papelgramatura`;
ALTER TABLE `cgolin_localhost`.`envelope_papel` 
DROP FOREIGN KEY `fk_envelopePapel_papelgramatura`;
ALTER TABLE `cgolin_localhost`.`personalizado_papel` 
DROP FOREIGN KEY `fk_personalizadoPapel_papelGramatura`;
ALTER TABLE `cgolin_localhost`.`papel_gramatura` 
CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ;
ALTER TABLE `cgolin_localhost`.`cartao_papel` 
CHANGE COLUMN `gramatura` `gramatura` INT(11) UNSIGNED NOT NULL ;
ALTER TABLE `cgolin_localhost`.`cartao_papel` 
ADD CONSTRAINT `fk_cartaoPapel_papelgramatura`
  FOREIGN KEY (`gramatura`)
  REFERENCES `cgolin_localhost`.`papel_gramatura` (`id`);
ALTER TABLE `cgolin_localhost`.`envelope_papel` 
CHANGE COLUMN `gramatura` `gramatura` INT(11) UNSIGNED NOT NULL ;
ALTER TABLE `cgolin_localhost`.`envelope_papel` 
ADD CONSTRAINT `fk_envelopePapel_papelgramatura`
  FOREIGN KEY (`gramatura`)
  REFERENCES `cgolin_localhost`.`papel_gramatura` (`id`);
ALTER TABLE `cgolin_localhost`.`personalizado_papel` 
CHANGE COLUMN `gramatura` `gramatura` INT(11) UNSIGNED NOT NULL ;
ALTER TABLE `cgolin_localhost`.`personalizado_papel` 
ADD CONSTRAINT `fk_personalizadoPapel_papelGramatura`
  FOREIGN KEY (`gramatura`)
  REFERENCES `cgolin_localhost`.`papel_gramatura` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
--FIM :Ajustes na tabela do cartao_papel,envelope_papel,personalizado_papel

CREATE TABLE `cartao_cliche` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `cliche` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_cliche` tinyint(1) NOT NULL,
  `descricao` text,
  `cliche_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_cliche` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `cgolin_localhost`.`cartao_cliche` 
ADD INDEX `fk_cartaoCliche_cartao_idx` (`cartao` ASC),
ADD INDEX `fk_cartaoCliche_cliche_idx` (`cliche` ASC),
ADD INDEX `fk_cartaoCliche_clicheDimensao_idx` (`cliche_dimensao` ASC);
ALTER TABLE `cgolin_localhost`.`cartao_cliche` 
ADD CONSTRAINT `fk_cartaoCliche_cartao`
  FOREIGN KEY (`cartao`)
  REFERENCES `cgolin_localhost`.`cartao` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_cartaoCliche_cliche`
  FOREIGN KEY (`cliche`)
  REFERENCES `cgolin_localhost`.`cliche` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_cartaoCliche_clicheDimensao`
  FOREIGN KEY (`cliche_dimensao`)
  REFERENCES `cgolin_localhost`.`cliche_dimensao` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

CREATE TABLE `envelope_cliche` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `cliche` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_cliche` tinyint(1) NOT NULL,
  `descricao` text,
  `cliche_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_cliche` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `cgolin_localhost`.`envelope_cliche` 
ADD INDEX `fk_envelopeCliche_envelope_idx` (`envelope` ASC),
ADD INDEX `fk_envelopeCliche_cliche_idx` (`cliche` ASC),
ADD INDEX `fk_envelopeCliche_clicheDimensao_idx` (`cliche_dimensao` ASC);
ALTER TABLE `cgolin_localhost`.`envelope_cliche` 
ADD CONSTRAINT `fk_envelopeCliche_envelope`
  FOREIGN KEY (`envelope`)
  REFERENCES `cgolin_localhost`.`envelope` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_envelopeCliche_cliche`
  FOREIGN KEY (`cliche`)
  REFERENCES `cgolin_localhost`.`cliche` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_envelopeCliche_clicheDimensao`
  FOREIGN KEY (`cliche_dimensao`)
  REFERENCES `cgolin_localhost`.`cliche_dimensao` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

  CREATE TABLE `personalizado_cliche` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `cliche` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_cliche` tinyint(1) NOT NULL,
  `descricao` text,
  `cliche_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_cliche` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `cgolin_localhost`.`personalizado_cliche` 
ADD INDEX `fk_personalizadoCliche_personalizado_idx` (`personalizado` ASC),
ADD INDEX `fk_personalizadoCliche_cliche_idx` (`cliche` ASC),
ADD INDEX `fk_personalizadoCliche_clicheDimensao_idx` (`cliche_dimensao` ASC);
ALTER TABLE `cgolin_localhost`.`personalizado_cliche` 
ADD CONSTRAINT `fk_personalizadoCliche_personalizado`
  FOREIGN KEY (`personalizado`)
  REFERENCES `cgolin_localhost`.`personalizado` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_personalizadoCliche_cliche`
  FOREIGN KEY (`cliche`)
  REFERENCES `cgolin_localhost`.`cliche` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT `fk_personalizadoCliche_clicheDimensao`
  FOREIGN KEY (`cliche_dimensao`)
  REFERENCES `cgolin_localhost`.`cliche_dimensao` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

CREATE TABLE `faca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `faca_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `faca` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_faca` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__idx` (`faca`),
  CONSTRAINT `fk_facaDimensao_faca` FOREIGN KEY (`faca`) REFERENCES `faca` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
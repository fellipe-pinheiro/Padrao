-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: cgolin_localhost
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acabamento`
--

DROP TABLE IF EXISTS `acabamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acabamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `acessorio`
--

DROP TABLE IF EXISTS `acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acessorio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adicional`
--

DROP TABLE IF EXISTS `adicional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adicional` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pedido` int(11) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `usuario` int(11) unsigned NOT NULL,
  `loja` int(11) unsigned NOT NULL,
  `desconto` decimal(10,2) NOT NULL,
  `descricao` text CHARACTER SET utf8,
  `condicoes` text CHARACTER SET utf8 NOT NULL,
  `cancelado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adicional_usuario` (`usuario`),
  KEY `fk_adicional_loja` (`loja`),
  KEY `pedido` (`pedido`),
  KEY `id` (`id`),
  CONSTRAINT `fk_adicional_loja` FOREIGN KEY (`loja`) REFERENCES `loja` (`id`),
  CONSTRAINT `fk_adicional_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`id`),
  CONSTRAINT `fk_adicional_usuario` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adicional_convite`
--

DROP TABLE IF EXISTS `adicional_convite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adicional_convite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adicional` int(11) unsigned NOT NULL,
  `orcamento_convite` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `valor_extra` decimal(10,2) NOT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `producao` varchar(100) DEFAULT NULL,
  `disponivel` varchar(100) DEFAULT NULL,
  `retirado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adicionalConvite_orcamentoConvite` (`orcamento_convite`),
  KEY `adicional` (`adicional`),
  CONSTRAINT `fk_adicionalConvite_adicional` FOREIGN KEY (`adicional`) REFERENCES `adicional` (`id`),
  CONSTRAINT `fk_adicionalConvite_orcamentoConvite` FOREIGN KEY (`orcamento_convite`) REFERENCES `orcamento_convite` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adicional_personalizado`
--

DROP TABLE IF EXISTS `adicional_personalizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adicional_personalizado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adicional` int(11) unsigned NOT NULL,
  `orcamento_personalizado` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `valor_extra` decimal(10,2) NOT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `producao` varchar(100) DEFAULT NULL,
  `disponivel` varchar(100) DEFAULT NULL,
  `retirado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adicionalpersonalizado_adicional` (`adicional`),
  KEY `fk_adicionalpersonalizado_personalizado` (`orcamento_personalizado`),
  KEY `adicional` (`adicional`),
  CONSTRAINT `fk_adicionalPersonalizado_adicional` FOREIGN KEY (`adicional`) REFERENCES `adicional` (`id`),
  CONSTRAINT `fk_adicionalPersonalizado_orcamentoPersonalizado` FOREIGN KEY (`orcamento_personalizado`) REFERENCES `orcamento_personalizado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adicional_produto`
--

DROP TABLE IF EXISTS `adicional_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adicional_produto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adicional` int(11) unsigned NOT NULL,
  `orcamento_produto` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `valor_extra` decimal(10,2) NOT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `producao` varchar(100) DEFAULT NULL,
  `disponivel` varchar(100) DEFAULT NULL,
  `retirado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adicionalProduto_adicional` (`adicional`),
  KEY `fk_adicionalProduto_produto` (`orcamento_produto`),
  KEY `adicional` (`adicional`),
  CONSTRAINT `fk_adicionalProduto_adicional` FOREIGN KEY (`adicional`) REFERENCES `adicional` (`id`),
  CONSTRAINT `fk_adicionalProduto_orcamentoProduto` FOREIGN KEY (`orcamento_produto`) REFERENCES `orcamento_produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `assessor`
--

DROP TABLE IF EXISTS `assessor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `descricao` text NOT NULL,
  `comissao` int(3) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao`
--

DROP TABLE IF EXISTS `cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_acabamento`
--

DROP TABLE IF EXISTS `cartao_acabamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_acabamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `acabamento` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartaoAcabamento_cartao_fk` (`cartao`),
  KEY `cartaoAcabamento_acabamento_fk` (`acabamento`),
  CONSTRAINT `fk_cartaoAcabamento_acabamento` FOREIGN KEY (`acabamento`) REFERENCES `acabamento` (`id`),
  CONSTRAINT `fk_cartaoAcabamento_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_acessorio`
--

DROP TABLE IF EXISTS `cartao_acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_acessorio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `acessorio` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartaoAcessorio_cartao_fk` (`cartao`),
  KEY `cartaoAcessorio_acessorio_fk` (`acessorio`),
  CONSTRAINT `fk_cartaoAcessorio_acessorio` FOREIGN KEY (`acessorio`) REFERENCES `acessorio` (`id`),
  CONSTRAINT `fk_cartaoAcessorio_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_cliche`
--

DROP TABLE IF EXISTS `cartao_cliche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`),
  KEY `fk_cartaoCliche_cartao_idx` (`cartao`),
  KEY `fk_cartaoCliche_cliche_idx` (`cliche`),
  KEY `fk_cartaoCliche_clicheDimensao_idx` (`cliche_dimensao`),
  CONSTRAINT `fk_cartaoCliche_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_cartaoCliche_cliche` FOREIGN KEY (`cliche`) REFERENCES `cliche` (`id`),
  CONSTRAINT `fk_cartaoCliche_clicheDimensao` FOREIGN KEY (`cliche_dimensao`) REFERENCES `cliche_dimensao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_faca`
--

DROP TABLE IF EXISTS `cartao_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_faca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `faca` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca` tinyint(1) NOT NULL,
  `descricao` text,
  `faca_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_faca` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cartaoFaca_cartao_idx` (`cartao`),
  KEY `fk_cartaoFaca_faca_idx` (`faca`),
  KEY `fk_cartaoFaca_facaDimensao_idx` (`faca_dimensao`),
  CONSTRAINT `fk_cartaoFaca_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_cartaoFaca_faca` FOREIGN KEY (`faca`) REFERENCES `faca` (`id`),
  CONSTRAINT `fk_cartaoFaca_facaDimensao` FOREIGN KEY (`faca_dimensao`) REFERENCES `faca_dimensao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_fita`
--

DROP TABLE IF EXISTS `cartao_fita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_fita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `fita` int(11) unsigned NOT NULL,
  `espessura` int(3) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartaoFita_cartao_fk` (`cartao`),
  KEY `cartaoFita_fita_fk` (`fita`),
  CONSTRAINT `fk_cartaoFita_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_cartaoFita_fita` FOREIGN KEY (`fita`) REFERENCES `fita` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_impressao`
--

DROP TABLE IF EXISTS `cartao_impressao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_impressao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `impressao` int(11) unsigned NOT NULL,
  `descricao` text,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartaoImpressao_cartao_fk` (`cartao`),
  KEY `cartaoImpressao_impressao_fk` (`impressao`),
  CONSTRAINT `fk_cartaoImpressao_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_cartaoImpressao_impressao` FOREIGN KEY (`impressao`) REFERENCES `impressao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel`
--

DROP TABLE IF EXISTS `cartao_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cartao` int(11) unsigned NOT NULL,
  `papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `gramatura` int(11) unsigned NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dimensao` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartaoPapel_cartao_fk` (`cartao`),
  KEY `fk_cartaoPapel_papel_idx` (`papel`),
  KEY `fk_cartaoPapel_papelGramatura_idx` (`gramatura`),
  KEY `fk_cartaoPapel_conviteModeloDimensao_idx` (`dimensao`),
  CONSTRAINT `fk_cartaoPapel_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_cartaoPapel_conviteModeloDimensao` FOREIGN KEY (`dimensao`) REFERENCES `convite_modelo_dimensao` (`id`),
  CONSTRAINT `fk_cartaoPapel_papel` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`),
  CONSTRAINT `fk_cartaoPapel_papelgramatura` FOREIGN KEY (`gramatura`) REFERENCES `papel_gramatura` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_almofada`
--

DROP TABLE IF EXISTS `cartao_papel_almofada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_almofada` (
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
  KEY `fk_cartao_papel_almofada` (`papel_acabamento`),
  KEY `fk_cartaoPapelAlmofada_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelAlmofada_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelAlmofada_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_corte_laser`
--

DROP TABLE IF EXISTS `cartao_papel_corte_laser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_corte_laser` (
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
  KEY `fk_cartao_papel_corte_laser` (`papel_acabamento`),
  KEY `fk_cartaoPapelCorteLaser_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelCorteLaser_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelCorteLaser_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_corte_vinco`
--

DROP TABLE IF EXISTS `cartao_papel_corte_vinco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_corte_vinco` (
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
  KEY `fk_cartaoPapelCorteVinco_papelAcabamento` (`papel_acabamento`),
  KEY `fk_cartaoPapelCorteVinco_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelCorteVinco_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelCorteVinco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_douracao`
--

DROP TABLE IF EXISTS `cartao_papel_douracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_douracao` (
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
  KEY `fk_cartao_papel_douracao` (`papel_acabamento`),
  KEY `fk_cartaoPapelDouracao_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelDouracao_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelDouracao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_empastamento`
--

DROP TABLE IF EXISTS `cartao_papel_empastamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_empastamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel_acabamento` int(11) unsigned NOT NULL,
  `cartao_papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `adicionar` tinyint(1) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca_cliche` tinyint(1) NOT NULL,
  `corte_laser_minutos` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  KEY `fk_cartao_papel_empastamento` (`papel_acabamento`),
  KEY `fk_cartaoPapelEmpastamento_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelEmpastamento_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelEmpastamento_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_faca`
--

DROP TABLE IF EXISTS `cartao_papel_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_faca` (
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
  KEY `fk_cartao_papel_faca` (`papel_acabamento`),
  KEY `fk_cartaoPapelFaca_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelFaca_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelFaca_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_hot_stamping`
--

DROP TABLE IF EXISTS `cartao_papel_hot_stamping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_laminacao`
--

DROP TABLE IF EXISTS `cartao_papel_laminacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_laminacao` (
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
  KEY `fk_cartao_papel_laminacao` (`papel_acabamento`),
  KEY `fk_cartaoPapelLaminacao_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelLaminacao_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelLaminacao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartao_papel_relevo_seco`
--

DROP TABLE IF EXISTS `cartao_papel_relevo_seco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_papel_relevo_seco` (
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
  KEY `fk_cartao_papel_relevo_seco` (`papel_acabamento`),
  KEY `fk_cartaoPapelRelevoSeco_cartaoPapel` (`cartao_papel`),
  CONSTRAINT `fk_cartaoPapelRelevoSeco_cartaoPapel` FOREIGN KEY (`cartao_papel`) REFERENCES `cartao_papel` (`id`),
  CONSTRAINT `fk_cartaoPapelRelevoSeco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliche`
--

DROP TABLE IF EXISTS `cliche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliche` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliche_dimensao`
--

DROP TABLE IF EXISTS `cliche_dimensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliche_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cliche` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_cliche` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__idx` (`cliche`),
  CONSTRAINT `fk_clicheDimensao_cliche` FOREIGN KEY (`cliche`) REFERENCES `cliche` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `nome2` varchar(30) DEFAULT NULL,
  `sobrenome2` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `observacao` text,
  `uf` varchar(2) DEFAULT NULL,
  `razao_social` varchar(150) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `ie` varchar(30) DEFAULT NULL,
  `im` varchar(30) DEFAULT NULL,
  `pessoa_tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_cliente_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente_conta`
--

DROP TABLE IF EXISTS `cliente_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_conta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` int(11) unsigned NOT NULL,
  `pedido` int(11) unsigned NOT NULL,
  `vencimento` date DEFAULT NULL,
  `forma_pagamento` int(2) unsigned DEFAULT NULL,
  `descricao` text,
  `data` date NOT NULL,
  `debito` tinyint(1) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `n_parcela` int(11) DEFAULT NULL,
  `codigo_bancario` varchar(50) DEFAULT NULL,
  `debito_referencia` int(11) unsigned DEFAULT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `adicional` tinyint(1) NOT NULL,
  `multa` tinyint(1) NOT NULL,
  `adicional_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clienteConta_usuario` (`usuario`),
  KEY `fk_clienteConta_formaPagamento` (`forma_pagamento`),
  KEY `adicional_id` (`adicional_id`),
  KEY `id` (`id`),
  KEY `pedido` (`pedido`),
  KEY `pedido_2` (`pedido`),
  KEY `adicional_id_2` (`adicional_id`),
  KEY `debito_referencia` (`debito_referencia`),
  CONSTRAINT `fk_clienteContaId_clienteContaDebitoReferencia` FOREIGN KEY (`debito_referencia`) REFERENCES `cliente_conta` (`id`),
  CONSTRAINT `fk_clienteConta_formaPagamento` FOREIGN KEY (`forma_pagamento`) REFERENCES `forma_pagamento` (`id`),
  CONSTRAINT `fk_clienteConta_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`id`),
  CONSTRAINT `fk_clienteConta_usuario` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_contaCliente_adicional` FOREIGN KEY (`adicional_id`) REFERENCES `adicional` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convite`
--

DROP TABLE IF EXISTS `convite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` int(11) unsigned NOT NULL,
  `cartao` int(11) unsigned DEFAULT NULL,
  `envelope` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `convite_modelo_convite_fk` (`modelo`),
  KEY `convite_cartao_fk` (`cartao`),
  KEY `convite_envelope_fk` (`envelope`),
  CONSTRAINT `fk_convite_cartao` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
  CONSTRAINT `fk_convite_conviteModelo` FOREIGN KEY (`modelo`) REFERENCES `convite_modelo` (`id`),
  CONSTRAINT `fk_convite_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convite_modelo`
--

DROP TABLE IF EXISTS `convite_modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convite_modelo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `empastamento_borda` int(5) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_convite_modelo_codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `convite_modelo_dimensao`
--

DROP TABLE IF EXISTS `convite_modelo_dimensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convite_modelo_dimensao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `modelo` int(11) unsigned NOT NULL,
  `altura` int(5) NOT NULL,
  `largura` int(5) NOT NULL,
  `destino` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conviteModeloDimensao_conviteModelo_idx` (`modelo`),
  CONSTRAINT `fk_conviteModeloDimensao_conviteModelo` FOREIGN KEY (`modelo`) REFERENCES `convite_modelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='O campo destino contém as variaveis numéricas:\n0 - Dimensão Final\n1 - Cartão\n2 - Envelope\n-1 - Serve tanto para Cartão/Envelope';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope`
--

DROP TABLE IF EXISTS `envelope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_acabamento`
--

DROP TABLE IF EXISTS `envelope_acabamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_acabamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `acabamento` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelopeAcabamento_envelope_fk` (`envelope`),
  KEY `envelopeAcabamento_acabamento_fk` (`acabamento`),
  CONSTRAINT `fk_envelopeAcabamento_acabamento` FOREIGN KEY (`acabamento`) REFERENCES `acabamento` (`id`),
  CONSTRAINT `fk_envelopeAcabamento_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_acessorio`
--

DROP TABLE IF EXISTS `envelope_acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_acessorio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `acessorio` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelopeAcessorio_envelope_fk` (`envelope`),
  KEY `envelopeAcessorio_acessorio_fk` (`acessorio`),
  CONSTRAINT `fk_envelopeAcessorio_acessorio` FOREIGN KEY (`acessorio`) REFERENCES `acessorio` (`id`),
  CONSTRAINT `fk_envelopeAcessorio_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_cliche`
--

DROP TABLE IF EXISTS `envelope_cliche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`),
  KEY `fk_envelopeCliche_envelope_idx` (`envelope`),
  KEY `fk_envelopeCliche_cliche_idx` (`cliche`),
  KEY `fk_envelopeCliche_clicheDimensao_idx` (`cliche_dimensao`),
  CONSTRAINT `fk_envelopeCliche_cliche` FOREIGN KEY (`cliche`) REFERENCES `cliche` (`id`),
  CONSTRAINT `fk_envelopeCliche_clicheDimensao` FOREIGN KEY (`cliche_dimensao`) REFERENCES `cliche_dimensao` (`id`),
  CONSTRAINT `fk_envelopeCliche_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_faca`
--

DROP TABLE IF EXISTS `envelope_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_faca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `faca` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca` tinyint(1) NOT NULL,
  `descricao` text,
  `faca_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_faca` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_envelopeFaca_envelope_idx` (`envelope`),
  KEY `fk_envelopeFaca_faca_idx` (`faca`),
  KEY `fk_envelopeFaca_facaDimensao_idx` (`faca_dimensao`),
  CONSTRAINT `fk_envelopeFaca_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
  CONSTRAINT `fk_envelopeFaca_faca` FOREIGN KEY (`faca`) REFERENCES `faca` (`id`),
  CONSTRAINT `fk_envelopeFaca_facaDimensao` FOREIGN KEY (`faca_dimensao`) REFERENCES `faca_dimensao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_fita`
--

DROP TABLE IF EXISTS `envelope_fita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_fita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `fita` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `espessura` int(3) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelopeFita_envelope_fk` (`envelope`),
  KEY `envelopeFita_fita_fk` (`fita`),
  CONSTRAINT `fk_envelopeFita_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
  CONSTRAINT `fk_envelopeFita_fita` FOREIGN KEY (`fita`) REFERENCES `fita` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_impressao`
--

DROP TABLE IF EXISTS `envelope_impressao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_impressao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `impressao` int(11) unsigned NOT NULL,
  `descricao` text,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelopeImpressao_envelope_fk` (`envelope`),
  KEY `envelopeImpressao_impressao_fk` (`impressao`),
  CONSTRAINT `fk_envelopeImpressao_envelope` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
  CONSTRAINT `fk_envelopeImpressao_impressao` FOREIGN KEY (`impressao`) REFERENCES `impressao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel`
--

DROP TABLE IF EXISTS `envelope_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `envelope` int(11) unsigned NOT NULL,
  `papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `gramatura` int(11) unsigned NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dimensao` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelopePapel_envelope_fk` (`envelope`),
  KEY `envelopePapel_papel_fk_idx` (`papel`),
  KEY `fk_envelopePapel_papelGramatura_idx` (`gramatura`),
  KEY `fk_envelopePapel_conviteModeloDimensao_idx` (`dimensao`),
  CONSTRAINT `envelopePapel_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
  CONSTRAINT `envelopePapel_papel_fk` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`),
  CONSTRAINT `fk_envelopePapel_conviteModeloDimensao` FOREIGN KEY (`dimensao`) REFERENCES `convite_modelo_dimensao` (`id`),
  CONSTRAINT `fk_envelopePapel_papelgramatura` FOREIGN KEY (`gramatura`) REFERENCES `papel_gramatura` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_almofada`
--

DROP TABLE IF EXISTS `envelope_papel_almofada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_almofada` (
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
  KEY `fk_envelope_papel_almofada` (`papel_acabamento`),
  KEY `fk_ep_almofada` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelAlmofada_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelAlmofada_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_corte_laser`
--

DROP TABLE IF EXISTS `envelope_papel_corte_laser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_corte_laser` (
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
  KEY `fk_envelope_papel_corte_laser` (`papel_acabamento`),
  KEY `fk_ep_corte_laser` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelCorteLaser_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_envelopePapelCorteLaser_papelAcabamento_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_corte_vinco`
--

DROP TABLE IF EXISTS `envelope_papel_corte_vinco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_corte_vinco` (
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
  KEY `fk_envelope_papel_corte_vinco` (`papel_acabamento`),
  KEY `fk_ep_epcv` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelCorteVinco_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelCorteVinco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_douracao`
--

DROP TABLE IF EXISTS `envelope_papel_douracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_douracao` (
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
  KEY `fk_envelope_papel_douracao` (`papel_acabamento`),
  KEY `fk_ep_douracao` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelDouracao_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelDouracao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_empastamento`
--

DROP TABLE IF EXISTS `envelope_papel_empastamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_empastamento` (
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
  KEY `fk_envelope_papel_empastamento` (`papel_acabamento`),
  KEY `fk_ep_empastamento` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelEmpastamento_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelEmpastamento_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_faca`
--

DROP TABLE IF EXISTS `envelope_papel_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_faca` (
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
  KEY `fk_envelope_papel_faca` (`papel_acabamento`),
  KEY `fk_ep_faca` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelFaca_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelFaca_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_hot_stamping`
--

DROP TABLE IF EXISTS `envelope_papel_hot_stamping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_laminacao`
--

DROP TABLE IF EXISTS `envelope_papel_laminacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_laminacao` (
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
  KEY `fk_envelope_papel_laminacao` (`papel_acabamento`),
  KEY `fk_ep_laminacao` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelLaminacao_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelLaminacao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envelope_papel_relevo_seco`
--

DROP TABLE IF EXISTS `envelope_papel_relevo_seco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envelope_papel_relevo_seco` (
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
  KEY `fk_envelope_papel_relevo_seco` (`papel_acabamento`),
  KEY `fk_ep_relevo_seco` (`envelope_papel`),
  CONSTRAINT `fk_envelopePapelRelevoSeco_envelopePapel` FOREIGN KEY (`envelope_papel`) REFERENCES `envelope_papel` (`id`),
  CONSTRAINT `fk_envelopePapelRelevoSeco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_evento` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faca`
--

DROP TABLE IF EXISTS `faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faca_dimensao`
--

DROP TABLE IF EXISTS `faca_dimensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faca_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `faca` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_faca` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__idx` (`faca`),
  CONSTRAINT `fk_facaDimensao_faca` FOREIGN KEY (`faca`) REFERENCES `faca` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fita`
--

DROP TABLE IF EXISTS `fita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fita_laco` int(11) unsigned NOT NULL,
  `fita_material` int(11) unsigned NOT NULL,
  `valor_03mm` decimal(10,2) NOT NULL,
  `valor_07mm` decimal(10,2) NOT NULL,
  `valor_10mm` decimal(10,2) NOT NULL,
  `valor_15mm` decimal(10,2) NOT NULL,
  `valor_22mm` decimal(10,2) NOT NULL,
  `valor_38mm` decimal(10,2) NOT NULL,
  `valor_50mm` decimal(10,2) NOT NULL,
  `valor_70mm` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fita_fita_laco_fk` (`fita_laco`),
  KEY `fita_fita_material_fk` (`fita_material`),
  KEY `fita_fita_espessura_fk` (`valor_03mm`),
  CONSTRAINT `fita_fita_laco_fk` FOREIGN KEY (`fita_laco`) REFERENCES `fita_laco` (`id`),
  CONSTRAINT `fita_fita_material_fk` FOREIGN KEY (`fita_material`) REFERENCES `fita_material` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fita_espessura`
--

DROP TABLE IF EXISTS `fita_espessura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fita_espessura` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `esp_03mm` varchar(20) NOT NULL DEFAULT '03mm',
  `esp_07mm` varchar(20) NOT NULL DEFAULT '07mm',
  `esp_10mm` varchar(20) NOT NULL DEFAULT '10mm',
  `esp_15mm` varchar(20) NOT NULL DEFAULT '15mm',
  `esp_22mm` varchar(20) NOT NULL DEFAULT '22mm',
  `esp_38mm` varchar(20) NOT NULL DEFAULT '38mm',
  `esp_50mm` varchar(20) NOT NULL DEFAULT '50mm',
  `esp_70mm` varchar(20) NOT NULL DEFAULT '70mm',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fita_laco`
--

DROP TABLE IF EXISTS `fita_laco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fita_laco` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fita_material`
--

DROP TABLE IF EXISTS `fita_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fita_material` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fonte`
--

DROP TABLE IF EXISTS `fonte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonte` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text,
  `ativo` tinyint(1) NOT NULL,
  `parcelamento_maximo` int(11) NOT NULL,
  `valor_minimo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `impressao`
--

DROP TABLE IF EXISTS `impressao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impressao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `impressao_area` int(11) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `impressao_impressao_area_fk` (`impressao_area`),
  CONSTRAINT `impressao_impressao_area_fk` FOREIGN KEY (`impressao_area`) REFERENCES `impressao_area` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `impressao_area`
--

DROP TABLE IF EXISTS `impressao_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impressao_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `impressao_cor`
--

DROP TABLE IF EXISTS `impressao_cor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impressao_cor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `loja`
--

DROP TABLE IF EXISTS `loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loja` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `unidade` varchar(50) DEFAULT NULL,
  `razao_social` varchar(150) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `ie` varchar(30) DEFAULT NULL,
  `im` varchar(30) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `telefone2` varchar(15) NOT NULL,
  `telefone3` varchar(15) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_loja` (`unidade`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mao_obra`
--

DROP TABLE IF EXISTS `mao_obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mao_obra` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` int(11) unsigned NOT NULL,
  `assessor` int(11) unsigned DEFAULT NULL,
  `usuario` int(11) unsigned NOT NULL,
  `assessor_comissao` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `descricao` text,
  `data_evento` date NOT NULL,
  `evento` int(11) unsigned NOT NULL,
  `loja` int(11) unsigned NOT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orcamento_cliente_fk` (`cliente`),
  KEY `orcamento_assessor_fk` (`assessor`),
  KEY `fk_orcamento_evento` (`evento`),
  KEY `fk_orcamento_loja` (`loja`),
  KEY `usuario` (`usuario`),
  KEY `id` (`id`),
  CONSTRAINT `fk_orcamento_evento` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`),
  CONSTRAINT `fk_orcamento_loja` FOREIGN KEY (`loja`) REFERENCES `loja` (`id`),
  CONSTRAINT `fk_orcamento_users` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`),
  CONSTRAINT `orcamento_assessor_fk` FOREIGN KEY (`assessor`) REFERENCES `assessor` (`id`),
  CONSTRAINT `orcamento_cliente_fk` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orcamento_convite`
--

DROP TABLE IF EXISTS `orcamento_convite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamento_convite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) unsigned NOT NULL,
  `convite` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `mao_obra` int(11) unsigned NOT NULL,
  `mao_obra_valor` decimal(10,2) NOT NULL,
  `comissao` int(3) NOT NULL,
  `descricao` text,
  `data_entrega` date DEFAULT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `recebimento_dados` varchar(100) DEFAULT NULL,
  `desenvolvimento_layout` varchar(100) DEFAULT NULL,
  `envio_layout` varchar(100) DEFAULT NULL,
  `aprovado` varchar(100) DEFAULT NULL,
  `producao` varchar(100) DEFAULT NULL,
  `disponivel` varchar(100) DEFAULT NULL,
  `retirado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orcamentoConvite_convite_fk` (`convite`),
  KEY `orcamentoConvite_orcamento_fk` (`orcamento`),
  KEY `fk_orcamentoConvite_maoObra` (`mao_obra`),
  KEY `orcamento` (`orcamento`),
  CONSTRAINT `fk_orcamentoConvite_maoObra` FOREIGN KEY (`mao_obra`) REFERENCES `mao_obra` (`id`),
  CONSTRAINT `orcamentoConvite_convite_fk` FOREIGN KEY (`convite`) REFERENCES `convite` (`id`),
  CONSTRAINT `orcamentoConvite_orcamento_fk` FOREIGN KEY (`orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orcamento_personalizado`
--

DROP TABLE IF EXISTS `orcamento_personalizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamento_personalizado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) unsigned NOT NULL,
  `personalizado_produto` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `mao_obra` int(11) unsigned NOT NULL,
  `mao_obra_valor` decimal(10,2) NOT NULL,
  `comissao` int(3) NOT NULL,
  `descricao` text CHARACTER SET utf8,
  `data_entrega` date DEFAULT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `recebimento_dados` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `desenvolvimento_layout` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `envio_layout` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `aprovado` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `producao` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `disponivel` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `retirado` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orcamentoPersonalizadoProduto_orcamento` (`orcamento`),
  KEY `fk_orcamentoPersonalizadoProduto_personalizadoProduto` (`personalizado_produto`),
  KEY `fk_orcamentoPersonalizadoProduto_maoObra` (`mao_obra`),
  KEY `orcamento` (`orcamento`),
  CONSTRAINT `fk_orcamentoPersonalizadoProduto_maoObra` FOREIGN KEY (`mao_obra`) REFERENCES `mao_obra` (`id`),
  CONSTRAINT `fk_orcamentoPersonalizadoProduto_orcamento` FOREIGN KEY (`orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `fk_orcamentoPersonalizadoProduto_personalizadoProduto` FOREIGN KEY (`personalizado_produto`) REFERENCES `personalizado_produto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orcamento_produto`
--

DROP TABLE IF EXISTS `orcamento_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamento_produto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) unsigned NOT NULL,
  `produto` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  `comissao` int(3) NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `recebimento_dados` varchar(100) DEFAULT NULL,
  `desenvolvimento_layout` varchar(100) DEFAULT NULL,
  `envio_layout` varchar(100) DEFAULT NULL,
  `aprovado` varchar(100) DEFAULT NULL,
  `producao` varchar(100) DEFAULT NULL,
  `disponivel` varchar(100) DEFAULT NULL,
  `retirado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orcamento_id_fk` (`orcamento`),
  KEY `produto_id_fk` (`produto`),
  KEY `orcamento` (`orcamento`),
  CONSTRAINT `orcamento_id_fk` FOREIGN KEY (`orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `produto_id_fk` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papel`
--

DROP TABLE IF EXISTS `papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel_linha` int(11) unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `papel_dimensao` int(11) unsigned NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`papel_linha`),
  KEY `papel_papel_linha_fk` (`papel_linha`),
  KEY `papel_papel_dimensao_fk_idx` (`papel_dimensao`),
  CONSTRAINT `papel_papel_dimensao_fk` FOREIGN KEY (`papel_dimensao`) REFERENCES `papel_dimensao` (`id`),
  CONSTRAINT `papel_papel_linha_fk` FOREIGN KEY (`papel_linha`) REFERENCES `papel_linha` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=374 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papel_acabamento`
--

DROP TABLE IF EXISTS `papel_acabamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papel_acabamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_papel_acabamento_codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papel_dimensao`
--

DROP TABLE IF EXISTS `papel_dimensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papel_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `altura` int(4) NOT NULL,
  `largura` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papel_gramatura`
--

DROP TABLE IF EXISTS `papel_gramatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papel_gramatura` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `papel` int(11) unsigned NOT NULL,
  `gramatura` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gramatura_papel_idx` (`papel`),
  CONSTRAINT `fk_gramatura_papel` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papel_linha`
--

DROP TABLE IF EXISTS `papel_linha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papel_linha` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `condicoes` text,
  `cancelado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_orcamento` (`orcamento`),
  CONSTRAINT `fk_pedido_orcamento` FOREIGN KEY (`orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado`
--

DROP TABLE IF EXISTS `personalizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_acabamento`
--

DROP TABLE IF EXISTS `personalizado_acabamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_acabamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `acabamento` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizadoAcabamento_personalizado_fk` (`personalizado`),
  KEY `personalizadoAcabamento_acabamento_fk` (`acabamento`),
  CONSTRAINT `fk_personalizadoAcabamento_acabamento` FOREIGN KEY (`acabamento`) REFERENCES `acabamento` (`id`),
  CONSTRAINT `fk_personalizadoAcabamento_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_acessorio`
--

DROP TABLE IF EXISTS `personalizado_acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_acessorio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `acessorio` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizadoAcessorio_personalizado_fk` (`personalizado`),
  KEY `personalizadoAcessorio_acessorio_fk` (`acessorio`),
  CONSTRAINT `fk_personalizadoAcessorio_acessorio` FOREIGN KEY (`acessorio`) REFERENCES `acessorio` (`id`),
  CONSTRAINT `fk_personalizadoAcessorio_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_categoria`
--

DROP TABLE IF EXISTS `personalizado_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_categoria` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `descricao` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_personalizado_categoria` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_cliche`
--

DROP TABLE IF EXISTS `personalizado_cliche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`),
  KEY `fk_personalizadoCliche_personalizado_idx` (`personalizado`),
  KEY `fk_personalizadoCliche_cliche_idx` (`cliche`),
  KEY `fk_personalizadoCliche_clicheDimensao_idx` (`cliche_dimensao`),
  CONSTRAINT `fk_personalizadoCliche_cliche` FOREIGN KEY (`cliche`) REFERENCES `cliche` (`id`),
  CONSTRAINT `fk_personalizadoCliche_clicheDimensao` FOREIGN KEY (`cliche_dimensao`) REFERENCES `cliche_dimensao` (`id`),
  CONSTRAINT `fk_personalizadoCliche_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_faca`
--

DROP TABLE IF EXISTS `personalizado_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_faca` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `faca` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cobrar_servico` tinyint(1) NOT NULL,
  `cobrar_faca` tinyint(1) NOT NULL,
  `descricao` text,
  `faca_dimensao` int(11) unsigned NOT NULL,
  `valor_servico` decimal(10,2) NOT NULL,
  `valor_faca` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personalizadoFaca_personalizado_idx` (`personalizado`),
  KEY `fk_personalizadoFaca_faca_idx` (`faca`),
  KEY `fk_personalizadoFaca_facaDimensao_idx` (`faca_dimensao`),
  CONSTRAINT `fk_personalizadoFaca_faca` FOREIGN KEY (`faca`) REFERENCES `faca` (`id`),
  CONSTRAINT `fk_personalizadoFaca_facaDimensao` FOREIGN KEY (`faca_dimensao`) REFERENCES `faca_dimensao` (`id`),
  CONSTRAINT `fk_personalizadoFaca_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_fita`
--

DROP TABLE IF EXISTS `personalizado_fita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_fita` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `fita` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `espessura` int(3) NOT NULL,
  `descricao` text,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizadoFita_personalizado_fk` (`personalizado`),
  KEY `personalizadoFita_fita_fk` (`fita`),
  CONSTRAINT `fk_personalizadoFita_fita` FOREIGN KEY (`fita`) REFERENCES `fita` (`id`),
  CONSTRAINT `fk_personalizadoFita_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_impressao`
--

DROP TABLE IF EXISTS `personalizado_impressao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_impressao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `impressao` int(11) unsigned NOT NULL,
  `descricao` text,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizadoImpressao_personalizado_fk` (`personalizado`),
  KEY `personalizadoImpressao_impressao_fk` (`impressao`),
  CONSTRAINT `fk_personalizadoImpressao_impressao` FOREIGN KEY (`impressao`) REFERENCES `impressao` (`id`),
  CONSTRAINT `fk_personalizadoImpressao_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_modelo`
--

DROP TABLE IF EXISTS `personalizado_modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_modelo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `personalizado_categoria` int(11) unsigned NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_personalizado_modelo_codigo` (`codigo`),
  KEY `fk_personalizado_categoria` (`personalizado_categoria`),
  CONSTRAINT `fk_personalizado_categoria` FOREIGN KEY (`personalizado_categoria`) REFERENCES `personalizado_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_modelo_dimensao`
--

DROP TABLE IF EXISTS `personalizado_modelo_dimensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_modelo_dimensao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `modelo` int(11) unsigned NOT NULL,
  `altura` int(5) NOT NULL,
  `largura` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personalizadoModeloDimensao_personalizadoModelo_idx` (`modelo`),
  CONSTRAINT `fk_personalizadoModeloDimensao_personalizadoModelo` FOREIGN KEY (`modelo`) REFERENCES `personalizado_modelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel`
--

DROP TABLE IF EXISTS `personalizado_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalizado` int(11) unsigned NOT NULL,
  `papel` int(11) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `gramatura` int(11) unsigned NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dimensao` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizadoPapel_personalizado_fk` (`personalizado`),
  KEY `fk_personalizadoPapel_papel_idx` (`papel`),
  KEY `fk_personalizadoPapel_papelGramatura_idx` (`gramatura`),
  KEY `fk_personalizadoPapel_personalizadoModeloDimensao_idx` (`dimensao`),
  CONSTRAINT `fk_personalizadoPapel_papel` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`),
  CONSTRAINT `fk_personalizadoPapel_papelGramatura` FOREIGN KEY (`gramatura`) REFERENCES `papel_gramatura` (`id`),
  CONSTRAINT `fk_personalizadoPapel_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`),
  CONSTRAINT `fk_personalizadoPapel_personalizadoModeloDimensao` FOREIGN KEY (`dimensao`) REFERENCES `personalizado_modelo_dimensao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_almofada`
--

DROP TABLE IF EXISTS `personalizado_papel_almofada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_almofada` (
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
  KEY `fk_personalizado_papel_almofada` (`papel_acabamento`),
  KEY `fk_personalizadoPapelAlmofada_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelAlmofada_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelAlmofada_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_corte_laser`
--

DROP TABLE IF EXISTS `personalizado_papel_corte_laser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_corte_laser` (
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
  KEY `fk_personalizado_papel_corte_laser` (`papel_acabamento`),
  KEY `fk_personalizadoPapelCorteLaser_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelCorteLaser_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelCorteLaser_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_corte_vinco`
--

DROP TABLE IF EXISTS `personalizado_papel_corte_vinco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_corte_vinco` (
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
  KEY `fk_personalizadoPapelCorteVinco_papelAcabamento` (`papel_acabamento`),
  KEY `fk_personalizadoPapelCorteVinco_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelCorteVinco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelCorteVinco_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_douracao`
--

DROP TABLE IF EXISTS `personalizado_papel_douracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_douracao` (
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
  KEY `fk_personalizado_papel_douracao` (`papel_acabamento`),
  KEY `fk_personalizadoPapelDouracao_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelDouracao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelDouracao_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_empastamento`
--

DROP TABLE IF EXISTS `personalizado_papel_empastamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_empastamento` (
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
  KEY `fk_personalizado_papel_empastamento` (`papel_acabamento`),
  KEY `fk_personalizadoPapelEmpastamento_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelEmpastamento_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelEmpastamento_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_faca`
--

DROP TABLE IF EXISTS `personalizado_papel_faca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_faca` (
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
  KEY `fk_personalizado_papel_faca` (`papel_acabamento`),
  KEY `fk_personalizadoPapelFaca_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelFaca_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelFaca_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_hot_stamping`
--

DROP TABLE IF EXISTS `personalizado_papel_hot_stamping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_laminacao`
--

DROP TABLE IF EXISTS `personalizado_papel_laminacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_laminacao` (
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
  KEY `fk_personalizado_papel_laminacao` (`papel_acabamento`),
  KEY `fk_personalizadoPapelLaminacao_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelLaminacao_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelLaminacao_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_papel_relevo_seco`
--

DROP TABLE IF EXISTS `personalizado_papel_relevo_seco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_papel_relevo_seco` (
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
  KEY `fk_personalizado_papel_relevo_seco` (`papel_acabamento`),
  KEY `fk_personalizadoPapelRelevoSeco_personalizadoPapel` (`personalizado_papel`),
  CONSTRAINT `fk_personalizadoPapelRelevoSeco_papelAcabamento` FOREIGN KEY (`papel_acabamento`) REFERENCES `papel_acabamento` (`id`),
  CONSTRAINT `fk_personalizadoPapelRelevoSeco_personalizadoPapel` FOREIGN KEY (`personalizado_papel`) REFERENCES `personalizado_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizado_produto`
--

DROP TABLE IF EXISTS `personalizado_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizado_produto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` int(11) unsigned NOT NULL,
  `personalizado` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personalizadoProduto_personalizado` (`personalizado`),
  KEY `fk_personalizadoProduto_personalizadoModelo` (`modelo`),
  CONSTRAINT `fk_personalizadoProduto_personalizado` FOREIGN KEY (`personalizado`) REFERENCES `personalizado` (`id`),
  CONSTRAINT `fk_personalizadoProduto_personalizadoModelo` FOREIGN KEY (`modelo`) REFERENCES `personalizado_modelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producao_adicional_convite`
--

DROP TABLE IF EXISTS `producao_adicional_convite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producao_adicional_convite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adicional_convite` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adicional_convite` (`adicional_convite`),
  KEY `fk_producao_adicionalConvite_idx` (`adicional_convite`),
  CONSTRAINT `fk_producao_adicionalConvite` FOREIGN KEY (`adicional_convite`) REFERENCES `adicional_convite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producao_orcamento_convite`
--

DROP TABLE IF EXISTS `producao_orcamento_convite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producao_orcamento_convite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento_convite` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orcamento_convite` (`orcamento_convite`),
  KEY `fk_producao_orcamentoConvite_idx` (`orcamento_convite`),
  CONSTRAINT `fk_producao_orcamentoConvite` FOREIGN KEY (`orcamento_convite`) REFERENCES `orcamento_convite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `produto_categoria` int(11) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `qtd_minima` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_categoria_fk` (`produto_categoria`),
  CONSTRAINT `produto_categoria_fk` FOREIGN KEY (`produto_categoria`) REFERENCES `produto_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produto_categoria`
--

DROP TABLE IF EXISTS `produto_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_categoria` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sistema`
--

DROP TABLE IF EXISTS `sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistema` (
  `nome` varchar(50) NOT NULL,
  `valor` varchar(100) NOT NULL,
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `v_lista_compra_papel`
--

DROP TABLE IF EXISTS `v_lista_compra_papel`;
/*!50001 DROP VIEW IF EXISTS `v_lista_compra_papel`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_lista_compra_papel` (
  `pedido` tinyint NOT NULL,
  `cliente_id` tinyint NOT NULL,
  `cliente` tinyint NOT NULL,
  `data_evento` tinyint NOT NULL,
  `produto_id` tinyint NOT NULL,
  `qtd_pedido` tinyint NOT NULL,
  `data_entrega` tinyint NOT NULL,
  `gramatura` tinyint NOT NULL,
  `qtd_papel` tinyint NOT NULL,
  `papel_id` tinyint NOT NULL,
  `papel` tinyint NOT NULL,
  `papel_linha` tinyint NOT NULL,
  `pap_inteiro_alt` tinyint NOT NULL,
  `pap_inteiro_larg` tinyint NOT NULL,
  `modelo_codigo` tinyint NOT NULL,
  `modelo_nome` tinyint NOT NULL,
  `altura_final` tinyint NOT NULL,
  `larguar_final` tinyint NOT NULL,
  `empastamento_borda` tinyint NOT NULL,
  `formato` tinyint NOT NULL,
  `adicional` tinyint NOT NULL,
  `adicional_id` tinyint NOT NULL,
  `ad_produto_id` tinyint NOT NULL,
  `produto_tipo` tinyint NOT NULL,
  `composicao` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_materiais_servicos_cartao`
--

DROP TABLE IF EXISTS `v_materiais_servicos_cartao`;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_cartao`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_materiais_servicos_cartao` (
  `pedido_id` tinyint NOT NULL,
  `orcamento_id` tinyint NOT NULL,
  `produto_id` tinyint NOT NULL,
  `item_id` tinyint NOT NULL,
  `grupo` tinyint NOT NULL,
  `item` tinyint NOT NULL,
  `material` tinyint NOT NULL,
  `quantidade` tinyint NOT NULL,
  `descricao` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_materiais_servicos_envelope`
--

DROP TABLE IF EXISTS `v_materiais_servicos_envelope`;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_envelope`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_materiais_servicos_envelope` (
  `pedido_id` tinyint NOT NULL,
  `orcamento_id` tinyint NOT NULL,
  `produto_id` tinyint NOT NULL,
  `item_id` tinyint NOT NULL,
  `grupo` tinyint NOT NULL,
  `item` tinyint NOT NULL,
  `material` tinyint NOT NULL,
  `quantidade` tinyint NOT NULL,
  `descricao` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_materiais_servicos_personalizado`
--

DROP TABLE IF EXISTS `v_materiais_servicos_personalizado`;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_personalizado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_materiais_servicos_personalizado` (
  `pedido_id` tinyint NOT NULL,
  `orcamento_id` tinyint NOT NULL,
  `produto_id` tinyint NOT NULL,
  `item_id` tinyint NOT NULL,
  `grupo` tinyint NOT NULL,
  `item` tinyint NOT NULL,
  `material` tinyint NOT NULL,
  `quantidade` tinyint NOT NULL,
  `descricao` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_papel`
--

DROP TABLE IF EXISTS `v_papel`;
/*!50001 DROP VIEW IF EXISTS `v_papel`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_papel` (
  `id` tinyint NOT NULL,
  `papel` tinyint NOT NULL,
  `linha` tinyint NOT NULL,
  `altura` tinyint NOT NULL,
  `largura` tinyint NOT NULL,
  `gramatura` tinyint NOT NULL,
  `valor` tinyint NOT NULL,
  `descricao` tinyint NOT NULL,
  `ativo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_papel_gramatura_group`
--

DROP TABLE IF EXISTS `v_papel_gramatura_group`;
/*!50001 DROP VIEW IF EXISTS `v_papel_gramatura_group`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_papel_gramatura_group` (
  `id` tinyint NOT NULL,
  `papel` tinyint NOT NULL,
  `linha` tinyint NOT NULL,
  `altura` tinyint NOT NULL,
  `largura` tinyint NOT NULL,
  `gramaturas` tinyint NOT NULL,
  `descricao` tinyint NOT NULL,
  `ativo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_produtos_entrega`
--

DROP TABLE IF EXISTS `v_produtos_entrega`;
/*!50001 DROP VIEW IF EXISTS `v_produtos_entrega`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_produtos_entrega` (
  `pedido_id` tinyint NOT NULL,
  `documento` tinyint NOT NULL,
  `orcamento_id` tinyint NOT NULL,
  `produto_id` tinyint NOT NULL,
  `data_evento` tinyint NOT NULL,
  `adicional` tinyint NOT NULL,
  `adicional_id` tinyint NOT NULL,
  `ad_produto_id` tinyint NOT NULL,
  `produto_tipo` tinyint NOT NULL,
  `produto_nome` tinyint NOT NULL,
  `produto_codigo` tinyint NOT NULL,
  `quantidade` tinyint NOT NULL,
  `data_entrega` tinyint NOT NULL,
  `cancelado` tinyint NOT NULL,
  `recebimento_dados` tinyint NOT NULL,
  `desenvolvimento_layout` tinyint NOT NULL,
  `envio_layout` tinyint NOT NULL,
  `aprovado` tinyint NOT NULL,
  `producao` tinyint NOT NULL,
  `disponivel` tinyint NOT NULL,
  `retirado` tinyint NOT NULL,
  `cliente_id` tinyint NOT NULL,
  `cliente` tinyint NOT NULL,
  `unidade` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_lista_compra_papel`
--

/*!50001 DROP TABLE IF EXISTS `v_lista_compra_papel`*/;
/*!50001 DROP VIEW IF EXISTS `v_lista_compra_papel`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_lista_compra_papel` AS select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`orc_conv`.`id` AS `produto_id`,`orc_conv`.`quantidade` AS `qtd_pedido`,`orc_conv`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`cart_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`conv_mod`.`codigo` AS `modelo_codigo`,`conv_mod`.`nome` AS `modelo_nome`,`conv_mod_dim`.`altura` AS `altura_final`,`conv_mod_dim`.`largura` AS `larguar_final`,`conv_mod`.`empastamento_borda` AS `empastamento_borda`,NULL AS `formato`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,('cartao' collate utf8_general_ci) AS `composicao` from (((((((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_conv`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `cart_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `cart_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `conv`.`modelo`))) join `convite_modelo_dimensao` `conv_mod_dim` on((`conv_mod_dim`.`id` = `cart_pap`.`dimensao`))) union all select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`ad_conv`.`orcamento_convite` AS `produto_id`,`ad_conv`.`quantidade` AS `qtd_pedido`,`ad_conv`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`cart_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`conv_mod`.`codigo` AS `modelo_codigo`,`conv_mod`.`nome` AS `modelo_nome`,`conv_mod_dim`.`altura` AS `altura_final`,`conv_mod_dim`.`largura` AS `larguar_final`,`conv_mod`.`empastamento_borda` AS `empastamento_borda`,NULL AS `formato`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_conv`.`id` AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,('cartao' collate utf8_general_ci) AS `composicao` from (((((((((((((`adicional_convite` `ad_conv` join `adicional` `ad` on((`ad`.`id` = `ad_conv`.`adicional`))) join `orcamento_convite` `orc_conv` on((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`))) join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_conv`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `cart_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `cart_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `conv`.`modelo`))) join `convite_modelo_dimensao` `conv_mod_dim` on((`conv_mod_dim`.`id` = `cart_pap`.`dimensao`))) union all select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`orc_conv`.`id` AS `produto_id`,`orc_conv`.`quantidade` AS `qtd_pedido`,`orc_conv`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`env_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`conv_mod`.`codigo` AS `modelo_codigo`,`conv_mod`.`nome` AS `modelo_nome`,`conv_mod_dim`.`altura` AS `altura_final`,`conv_mod_dim`.`largura` AS `larguar_final`,`conv_mod`.`empastamento_borda` AS `empastamento_borda`,NULL AS `formato`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,('envelope' collate utf8_general_ci) AS `composicao` from (((((((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_conv`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `env_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `env_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `conv`.`modelo`))) join `convite_modelo_dimensao` `conv_mod_dim` on((`conv_mod_dim`.`id` = `env_pap`.`dimensao`))) union all select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`ad_conv`.`orcamento_convite` AS `produto_id`,`ad_conv`.`quantidade` AS `qtd_pedido`,`ad_conv`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`env_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`conv_mod`.`codigo` AS `modelo_codigo`,`conv_mod`.`nome` AS `modelo_nome`,`conv_mod_dim`.`altura` AS `altura_final`,`conv_mod_dim`.`largura` AS `larguar_final`,`conv_mod`.`empastamento_borda` AS `empastamento_borda`,NULL AS `formato`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_conv`.`id` AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,('envelope' collate utf8_general_ci) AS `composicao` from (((((((((((((`adicional_convite` `ad_conv` join `adicional` `ad` on((`ad`.`id` = `ad_conv`.`adicional`))) join `orcamento_convite` `orc_conv` on((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`))) join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_conv`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `env_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `env_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `conv`.`modelo`))) join `convite_modelo_dimensao` `conv_mod_dim` on((`conv_mod_dim`.`id` = `env_pap`.`dimensao`))) union all select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`orc_pers`.`id` AS `produto_id`,`orc_pers`.`quantidade` AS `qtd_pedido`,`orc_pers`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`pers_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`pers_mod`.`codigo` AS `modelo_codigo`,`pers_mod`.`nome` AS `modelo_nome`,`pers_mod_dim`.`altura` AS `altura_final`,`pers_mod_dim`.`largura` AS `larguar_final`,NULL AS `empastamento_borda`,NULL AS `formato`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('personalizado' collate utf8_general_ci) AS `produto_tipo`,('personalizado' collate utf8_general_ci) AS `composicao` from (((((((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_pers`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `personalizado_produto` `pers_prod` on((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers_prod`.`personalizado`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `pers_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `pers_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `personalizado_modelo` `pers_mod` on((`pers_mod`.`id` = `pers_prod`.`modelo`))) join `personalizado_modelo_dimensao` `pers_mod_dim` on((`pers_mod_dim`.`id` = `pers_pap`.`dimensao`))) union all select `ped`.`id` AS `pedido`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`orc`.`data_evento` AS `data_evento`,`ad_pers`.`orcamento_personalizado` AS `produto_id`,`ad_pers`.`quantidade` AS `qtd_pedido`,`ad_pers`.`data_entrega` AS `data_entrega`,`pap_gram`.`gramatura` AS `gramatura`,`pers_pap`.`quantidade` AS `qtd_papel`,`pap`.`id` AS `papel_id`,`pap`.`nome` AS `papel`,`pap_lin`.`nome` AS `papel_linha`,`pap_dim`.`altura` AS `pap_inteiro_alt`,`pap_dim`.`largura` AS `pap_inteiro_larg`,`pers_mod`.`codigo` AS `modelo_codigo`,`pers_mod`.`nome` AS `modelo_nome`,`pers_mod_dim`.`altura` AS `altura_final`,`pers_mod_dim`.`largura` AS `larguar_final`,NULL AS `empastamento_borda`,NULL AS `formato`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_pers`.`id` AS `ad_produto_id`,('personalizado' collate utf8_general_ci) AS `produto_tipo`,('personalizado' collate utf8_general_ci) AS `composicao` from (((((((((((((`adicional_personalizado` `ad_pers` join `adicional` `ad` on((`ad`.`id` = `ad_pers`.`adicional`))) join `orcamento_personalizado` `orc_pers` on((`orc_pers`.`id` = `ad_pers`.`orcamento_personalizado`))) join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `orc_pers`.`orcamento`))) join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) join `personalizado_produto` `pers_prod` on((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers_prod`.`personalizado`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `pers_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `pers_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) join `papel_dimensao` `pap_dim` on((`pap_dim`.`id` = `pap`.`papel_dimensao`))) join `personalizado_modelo` `pers_mod` on((`pers_mod`.`id` = `pers_prod`.`modelo`))) join `personalizado_modelo_dimensao` `pers_mod_dim` on((`pers_mod_dim`.`id` = `pers_pap`.`dimensao`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_materiais_servicos_cartao`
--

/*!50001 DROP TABLE IF EXISTS `v_materiais_servicos_cartao`*/;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_cartao`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_materiais_servicos_cartao` AS select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('papel' collate utf8_general_ci) AS `item`,concat(`pap_lin`.`nome`,' ',`pap`.`nome`,' ',`pap_gram`.`gramatura`,'g') AS `material`,`cart_pap`.`quantidade` AS `quantidade`,NULL AS `descricao` from (((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `cart_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `cart_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('almofada' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_alm`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_almofada` `cart_pap_alm` on((`cart_pap_alm`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_alm`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_laser' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_laser`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_corte_laser` `cart_pap_laser` on((`cart_pap_laser`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_laser`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_vinco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_corte_vinco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_corte_vinco` `cart_pap_corte_vinco` on((`cart_pap_corte_vinco`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_corte_vinco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('douracao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_douracao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_douracao` `cart_pap_douracao` on((`cart_pap_douracao`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_douracao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('empastamento' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_emp`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_empastamento` `cart_pap_emp` on((`cart_pap_emp`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_emp`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('faca' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_faca`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_faca` `cart_pap_faca` on((`cart_pap_faca`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_faca`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('laminacao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_laminacao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_laminacao` `cart_pap_laminacao` on((`cart_pap_laminacao`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_laminacao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_pap`.`id` AS `item_id`,(concat('#',`cart_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('relevo_seco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`cart_pap_relevo_seco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_papel` `cart_pap` on((`cart_pap`.`cartao` = `conv`.`cartao`))) join `cartao_papel_relevo_seco` `cart_pap_relevo_seco` on((`cart_pap_relevo_seco`.`cartao_papel` = `cart_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `cart_pap_relevo_seco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_imp`.`id` AS `item_id`,(concat('#',`cart_imp`.`id`,'_impressao') collate utf8_general_ci) AS `grupo`,('impressao' collate utf8_general_ci) AS `item`,concat(`imp`.`nome`,' : Area ',`imp_area`.`nome`) AS `material`,`cart_imp`.`quantidade` AS `quantidade`,`cart_imp`.`descricao` AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_impressao` `cart_imp` on((`cart_imp`.`cartao` = `conv`.`cartao`))) join `impressao` `imp` on((`imp`.`id` = `cart_imp`.`impressao`))) join `impressao_area` `imp_area` on((`imp_area`.`id` = `imp`.`impressao_area`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_acab`.`id` AS `item_id`,(concat('#',`cart_acab`.`id`,'_acabamento') collate utf8_general_ci) AS `grupo`,('acabamento' collate utf8_general_ci) AS `item`,`acab`.`nome` AS `material`,`cart_acab`.`quantidade` AS `quantidade`,`cart_acab`.`descricao` AS `descricao` from (((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_acabamento` `cart_acab` on((`cart_acab`.`cartao` = `conv`.`cartao`))) join `acabamento` `acab` on((`acab`.`id` = `cart_acab`.`acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_aces`.`id` AS `item_id`,(concat('#',`cart_aces`.`id`,'_acessorio') collate utf8_general_ci) AS `grupo`,('acessorio' collate utf8_general_ci) AS `item`,`aces`.`nome` AS `material`,`cart_aces`.`quantidade` AS `quantidade`,`cart_aces`.`descricao` AS `descricao` from (((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_acessorio` `cart_aces` on((`cart_aces`.`cartao` = `conv`.`cartao`))) join `acessorio` `aces` on((`aces`.`id` = `cart_aces`.`acessorio`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`cart_fita`.`id` AS `item_id`,(concat('#',`cart_fita`.`id`,'_fita') collate utf8_general_ci) AS `grupo`,('fita' collate utf8_general_ci) AS `item`,concat(`fita_material`.`nome`,' ( ',`cart_fita`.`espessura`,'mm ) : ',`fita_laco`.`nome`) AS `material`,`cart_fita`.`quantidade` AS `quantidade`,`cart_fita`.`descricao` AS `descricao` from (((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `cartao_fita` `cart_fita` on((`cart_fita`.`cartao` = `conv`.`cartao`))) join `fita` on((`fita`.`id` = `cart_fita`.`fita`))) join `fita_laco` on((`fita_laco`.`id` = `fita`.`fita_laco`))) join `fita_material` on((`fita_material`.`id` = `fita`.`fita_material`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_materiais_servicos_envelope`
--

/*!50001 DROP TABLE IF EXISTS `v_materiais_servicos_envelope`*/;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_envelope`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_materiais_servicos_envelope` AS select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('papel' collate utf8_general_ci) AS `item`,concat(`pap_lin`.`nome`,' ',`pap`.`nome`,' ',`env_pap`.`gramatura`,'g') AS `material`,`env_pap`.`quantidade` AS `quantidade`,NULL AS `descricao` from (((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `env_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `env_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('almofada' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_alm`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_almofada` `env_pap_alm` on((`env_pap_alm`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_alm`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_laser' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_laser`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_corte_laser` `env_pap_laser` on((`env_pap_laser`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_laser`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_vinco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_corte_vinco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_corte_vinco` `env_pap_corte_vinco` on((`env_pap_corte_vinco`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_corte_vinco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('douracao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_douracao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_douracao` `env_pap_douracao` on((`env_pap_douracao`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_douracao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('empastamento' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_emp`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_empastamento` `env_pap_emp` on((`env_pap_emp`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_emp`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('faca' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_faca`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_faca` `env_pap_faca` on((`env_pap_faca`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_faca`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('laminacao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_laminacao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_laminacao` `env_pap_laminacao` on((`env_pap_laminacao`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_laminacao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_pap`.`id` AS `item_id`,(concat('#',`env_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('relevo_seco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`env_pap_relevo_seco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_papel` `env_pap` on((`env_pap`.`envelope` = `conv`.`envelope`))) join `envelope_papel_relevo_seco` `env_pap_relevo_seco` on((`env_pap_relevo_seco`.`envelope_papel` = `env_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `env_pap_relevo_seco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_imp`.`id` AS `item_id`,(concat('#',`env_imp`.`id`,'_impressao') collate utf8_general_ci) AS `grupo`,('impressao' collate utf8_general_ci) AS `item`,concat(`imp`.`nome`,' : Area ',`imp_area`.`nome`) AS `material`,`env_imp`.`quantidade` AS `quantidade`,`env_imp`.`descricao` AS `descricao` from ((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_impressao` `env_imp` on((`env_imp`.`envelope` = `conv`.`envelope`))) join `impressao` `imp` on((`imp`.`id` = `env_imp`.`impressao`))) join `impressao_area` `imp_area` on((`imp_area`.`id` = `imp`.`impressao_area`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_acab`.`id` AS `item_id`,(concat('#',`env_acab`.`id`,'_acabamento') collate utf8_general_ci) AS `grupo`,('acabamento' collate utf8_general_ci) AS `item`,`acab`.`nome` AS `material`,`env_acab`.`quantidade` AS `quantidade`,`env_acab`.`descricao` AS `descricao` from (((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_acabamento` `env_acab` on((`env_acab`.`envelope` = `conv`.`envelope`))) join `acabamento` `acab` on((`acab`.`id` = `env_acab`.`acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_aces`.`id` AS `item_id`,(concat('#',`env_aces`.`id`,'_acessorio') collate utf8_general_ci) AS `grupo`,('acessorio' collate utf8_general_ci) AS `item`,`aces`.`nome` AS `material`,`env_aces`.`quantidade` AS `quantidade`,`env_aces`.`descricao` AS `descricao` from (((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_acessorio` `env_aces` on((`env_aces`.`envelope` = `conv`.`envelope`))) join `acessorio` `aces` on((`aces`.`id` = `env_aces`.`acessorio`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`env_fita`.`id` AS `item_id`,(concat('#',`env_fita`.`id`,'_fita') collate utf8_general_ci) AS `grupo`,('fita' collate utf8_general_ci) AS `item`,concat(`fita_material`.`nome`,' ( ',`env_fita`.`espessura`,'mm ) : ',`fita_laco`.`nome`) AS `material`,`env_fita`.`quantidade` AS `quantidade`,`env_fita`.`descricao` AS `descricao` from (((((((`orcamento_convite` `orc_conv` join `pedido` `ped` on((`ped`.`orcamento` = `orc_conv`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `convite` `conv` on((`conv`.`id` = `orc_conv`.`convite`))) join `envelope_fita` `env_fita` on((`env_fita`.`envelope` = `conv`.`envelope`))) join `fita` on((`fita`.`id` = `env_fita`.`fita`))) join `fita_laco` on((`fita_laco`.`id` = `fita`.`fita_laco`))) join `fita_material` on((`fita_material`.`id` = `fita`.`fita_material`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_materiais_servicos_personalizado`
--

/*!50001 DROP TABLE IF EXISTS `v_materiais_servicos_personalizado`*/;
/*!50001 DROP VIEW IF EXISTS `v_materiais_servicos_personalizado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_materiais_servicos_personalizado` AS select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('papel' collate utf8_general_ci) AS `item`,concat(`pap_lin`.`nome`,' ',`pap`.`nome`,' ',`pers_pap`.`gramatura`,'g') AS `material`,`pers_pap`.`quantidade` AS `quantidade`,NULL AS `descricao` from (((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `papel_gramatura` `pap_gram` on((`pap_gram`.`id` = `pers_pap`.`gramatura`))) join `papel` `pap` on((`pap`.`id` = `pers_pap`.`papel`))) join `papel_linha` `pap_lin` on((`pap_lin`.`id` = `pap`.`papel_linha`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('almofada' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_alm`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_almofada` `pers_pap_alm` on((`pers_pap_alm`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_alm`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_laser' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_laser`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_corte_laser` `pers_pap_laser` on((`pers_pap_laser`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_laser`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('corte_vinco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_corte_vinco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_corte_vinco` `pers_pap_corte_vinco` on((`pers_pap_corte_vinco`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_corte_vinco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('douracao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_douracao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_douracao` `pers_pap_douracao` on((`pers_pap_douracao`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_douracao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('empastamento' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_emp`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_empastamento` `pers_pap_emp` on((`pers_pap_emp`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_emp`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('faca' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_faca`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_faca` `pers_pap_faca` on((`pers_pap_faca`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_faca`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('laminacao' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_laminacao`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_laminacao` `pers_pap_laminacao` on((`pers_pap_laminacao`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_laminacao`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_pap`.`id` AS `item_id`,(concat('#',`pers_pap`.`id`,'_papel') collate utf8_general_ci) AS `grupo`,('relevo_seco' collate utf8_general_ci) AS `item`,`pap_acab`.`nome` AS `material`,`pers_pap_relevo_seco`.`quantidade` AS `quantidade`,NULL AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_papel` `pers_pap` on((`pers_pap`.`personalizado` = `pers`.`personalizado`))) join `personalizado_papel_relevo_seco` `pers_pap_relevo_seco` on((`pers_pap_relevo_seco`.`personalizado_papel` = `pers_pap`.`id`))) join `papel_acabamento` `pap_acab` on((`pap_acab`.`id` = `pers_pap_relevo_seco`.`papel_acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_imp`.`id` AS `item_id`,(concat('#',`pers_imp`.`id`,'_impressao') collate utf8_general_ci) AS `grupo`,('impressao' collate utf8_general_ci) AS `item`,concat(`imp`.`nome`,' : Area ',`imp_area`.`nome`) AS `material`,`pers_imp`.`quantidade` AS `quantidade`,`pers_imp`.`descricao` AS `descricao` from ((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_impressao` `pers_imp` on((`pers_imp`.`personalizado` = `pers`.`personalizado`))) join `impressao` `imp` on((`imp`.`id` = `pers_imp`.`impressao`))) join `impressao_area` `imp_area` on((`imp_area`.`id` = `imp`.`impressao_area`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_acab`.`id` AS `item_id`,(concat('#',`pers_acab`.`id`,'_acabamento') collate utf8_general_ci) AS `grupo`,('acabamento' collate utf8_general_ci) AS `item`,`acab`.`nome` AS `material`,`pers_acab`.`quantidade` AS `quantidade`,`pers_acab`.`descricao` AS `descricao` from (((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_acabamento` `pers_acab` on((`pers_acab`.`personalizado` = `pers`.`personalizado`))) join `acabamento` `acab` on((`acab`.`id` = `pers_acab`.`acabamento`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_aces`.`id` AS `item_id`,(concat('#',`pers_aces`.`id`,'_acessorio') collate utf8_general_ci) AS `grupo`,('acessorio' collate utf8_general_ci) AS `item`,`aces`.`nome` AS `material`,`pers_aces`.`quantidade` AS `quantidade`,`pers_aces`.`descricao` AS `descricao` from (((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_acessorio` `pers_aces` on((`pers_aces`.`personalizado` = `pers`.`personalizado`))) join `acessorio` `aces` on((`aces`.`id` = `pers_aces`.`acessorio`))) union all select `ped`.`id` AS `pedido_id`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`pers_fita`.`id` AS `item_id`,(concat('#',`pers_fita`.`id`,'_fita') collate utf8_general_ci) AS `grupo`,('fita' collate utf8_general_ci) AS `item`,concat(`fita_material`.`nome`,' ( ',`pers_fita`.`espessura`,'mm ) : ',`fita_laco`.`nome`) AS `material`,`pers_fita`.`quantidade` AS `quantidade`,`pers_fita`.`descricao` AS `descricao` from (((((((`orcamento_personalizado` `orc_pers` join `pedido` `ped` on((`ped`.`orcamento` = `orc_pers`.`orcamento`))) join `orcamento` `orc` on((`orc`.`id` = `ped`.`orcamento`))) join `personalizado_produto` `pers` on((`pers`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_fita` `pers_fita` on((`pers_fita`.`personalizado` = `pers`.`personalizado`))) join `fita` on((`fita`.`id` = `pers_fita`.`fita`))) join `fita_laco` on((`fita_laco`.`id` = `fita`.`fita_laco`))) join `fita_material` on((`fita_material`.`id` = `fita`.`fita_material`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_papel`
--

/*!50001 DROP TABLE IF EXISTS `v_papel`*/;
/*!50001 DROP VIEW IF EXISTS `v_papel`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_papel` AS select `p`.`id` AS `id`,`p`.`nome` AS `papel`,`pl`.`nome` AS `linha`,`pd`.`altura` AS `altura`,`pd`.`largura` AS `largura`,`pg`.`gramatura` AS `gramatura`,`pg`.`valor` AS `valor`,`p`.`descricao` AS `descricao`,`p`.`ativo` AS `ativo` from (((`papel` `p` left join `papel_linha` `pl` on((`p`.`papel_linha` = `pl`.`id`))) left join `papel_dimensao` `pd` on((`p`.`papel_dimensao` = `pd`.`id`))) left join `papel_gramatura` `pg` on((`p`.`id` = `pg`.`papel`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_papel_gramatura_group`
--

/*!50001 DROP TABLE IF EXISTS `v_papel_gramatura_group`*/;
/*!50001 DROP VIEW IF EXISTS `v_papel_gramatura_group`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_papel_gramatura_group` AS select `p`.`id` AS `id`,`p`.`nome` AS `papel`,`pl`.`nome` AS `linha`,`pd`.`altura` AS `altura`,`pd`.`largura` AS `largura`,group_concat(`pg`.`gramatura` order by `pg`.`gramatura` ASC separator ' ') AS `gramaturas`,`p`.`descricao` AS `descricao`,`p`.`ativo` AS `ativo` from (((`papel` `p` left join `papel_linha` `pl` on((`p`.`papel_linha` = `pl`.`id`))) left join `papel_dimensao` `pd` on((`p`.`papel_dimensao` = `pd`.`id`))) left join `papel_gramatura` `pg` on((`p`.`id` = `pg`.`papel`))) group by `p`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_produtos_entrega`
--

/*!50001 DROP TABLE IF EXISTS `v_produtos_entrega`*/;
/*!50001 DROP VIEW IF EXISTS `v_produtos_entrega`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_produtos_entrega` AS select `ped`.`id` AS `pedido_id`,('pedido' collate utf8_general_ci) AS `documento`,`orc`.`id` AS `orcamento_id`,`orc_conv`.`id` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,`conv_mod`.`nome` AS `produto_nome`,`conv_mod`.`codigo` AS `produto_codigo`,`orc_conv`.`quantidade` AS `quantidade`,`orc_conv`.`data_entrega` AS `data_entrega`,`orc_conv`.`cancelado` AS `cancelado`,`orc_conv`.`recebimento_dados` AS `recebimento_dados`,`orc_conv`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_conv`.`envio_layout` AS `envio_layout`,`orc_conv`.`aprovado` AS `aprovado`,`orc_conv`.`producao` AS `producao`,`orc_conv`.`disponivel` AS `disponivel`,`orc_conv`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from ((((((`pedido` `ped` left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `orcamento_convite` `orc_conv` on((`orc_conv`.`orcamento` = `orc`.`id`))) join `convite` `c` on((`c`.`id` = `orc_conv`.`convite`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `c`.`modelo`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) union all select `ad`.`pedido` AS `pedido_id`,('adicional' collate utf8_general_ci) AS `documento`,`ped`.`orcamento` AS `orcamento_id`,`ad_conv`.`orcamento_convite` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_conv`.`id` AS `ad_produto_id`,('convite' collate utf8_general_ci) AS `produto_tipo`,`conv_mod`.`nome` AS `produto_nome`,`conv_mod`.`codigo` AS `produto_codigo`,`ad_conv`.`quantidade` AS `quantidade`,`ad_conv`.`data_entrega` AS `data_entrega`,`ad_conv`.`cancelado` AS `cancelado`,`orc_conv`.`recebimento_dados` AS `recebimento_dados`,`orc_conv`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_conv`.`envio_layout` AS `envio_layout`,`orc_conv`.`aprovado` AS `aprovado`,`ad_conv`.`producao` AS `producao`,`ad_conv`.`disponivel` AS `disponivel`,`ad_conv`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from ((((((((`adicional` `ad` left join `pedido` `ped` on((`ad`.`pedido` = `ped`.`id`))) left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `adicional_convite` `ad_conv` on((`ad_conv`.`adicional` = `ad`.`id`))) join `orcamento_convite` `orc_conv` on((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`))) join `convite` `c` on((`c`.`id` = `orc_conv`.`convite`))) join `convite_modelo` `conv_mod` on((`conv_mod`.`id` = `c`.`modelo`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) union all select `ped`.`id` AS `pedido_id`,('pedido' collate utf8_general_ci) AS `documento`,`orc`.`id` AS `orcamento_id`,`orc_pers`.`id` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('personalizado' collate utf8_general_ci) AS `produto_tipo`,`pers_mod`.`nome` AS `produto_nome`,`pers_mod`.`codigo` AS `produto_codigo`,`orc_pers`.`quantidade` AS `quantidade`,`orc_pers`.`data_entrega` AS `data_entrega`,`orc_pers`.`cancelado` AS `cancelado`,`orc_pers`.`recebimento_dados` AS `recebimento_dados`,`orc_pers`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_pers`.`envio_layout` AS `envio_layout`,`orc_pers`.`aprovado` AS `aprovado`,`orc_pers`.`producao` AS `producao`,`orc_pers`.`disponivel` AS `disponivel`,`orc_pers`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from ((((((`pedido` `ped` left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `orcamento_personalizado` `orc_pers` on((`orc_pers`.`orcamento` = `orc`.`id`))) join `personalizado_produto` `pers_prod` on((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_modelo` `pers_mod` on((`pers_mod`.`id` = `pers_prod`.`modelo`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) union all select `ad`.`pedido` AS `pedido_id`,('adicional' collate utf8_general_ci) AS `documento`,`ped`.`orcamento` AS `orcamento_id`,`ad_pers`.`orcamento_personalizado` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_pers`.`id` AS `ad_produto_id`,('personalizado' collate utf8_general_ci) AS `produto_tipo`,`pers_mod`.`nome` AS `produto_nome`,`pers_mod`.`codigo` AS `produto_codigo`,`ad_pers`.`quantidade` AS `quantidade`,`ad_pers`.`data_entrega` AS `data_entrega`,`ad_pers`.`cancelado` AS `cancelado`,`orc_pers`.`recebimento_dados` AS `recebimento_dados`,`orc_pers`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_pers`.`envio_layout` AS `envio_layout`,`orc_pers`.`aprovado` AS `aprovado`,`ad_pers`.`producao` AS `producao`,`ad_pers`.`disponivel` AS `disponivel`,`ad_pers`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from ((((((((`adicional` `ad` left join `pedido` `ped` on((`ad`.`pedido` = `ped`.`id`))) left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `adicional_personalizado` `ad_pers` on((`ad_pers`.`adicional` = `ad`.`id`))) join `orcamento_personalizado` `orc_pers` on((`orc_pers`.`id` = `ad_pers`.`orcamento_personalizado`))) join `personalizado_produto` `pers_prod` on((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`))) join `personalizado_modelo` `pers_mod` on((`pers_mod`.`id` = `pers_prod`.`modelo`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) union all select `ped`.`id` AS `pedido_id`,('pedido' collate utf8_general_ci) AS `documento`,`orc`.`id` AS `orcamento_id`,`orc_prod`.`id` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,0 AS `adicional`,NULL AS `adicional_id`,NULL AS `ad_produto_id`,('produto' collate utf8_general_ci) AS `produto_tipo`,`prod`.`nome` AS `produto_nome`,NULL AS `produto_codigo`,`orc_prod`.`quantidade` AS `quantidade`,`orc_prod`.`data_entrega` AS `data_entrega`,`orc_prod`.`cancelado` AS `cancelado`,`orc_prod`.`recebimento_dados` AS `recebimento_dados`,`orc_prod`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_prod`.`envio_layout` AS `envio_layout`,`orc_prod`.`aprovado` AS `aprovado`,`orc_prod`.`producao` AS `producao`,`orc_prod`.`disponivel` AS `disponivel`,`orc_prod`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from (((((`pedido` `ped` left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `orcamento_produto` `orc_prod` on((`orc_prod`.`orcamento` = `orc`.`id`))) join `produto` `prod` on((`prod`.`id` = `orc_prod`.`produto`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) union all select `ad`.`pedido` AS `pedido_id`,('adicional' collate utf8_general_ci) AS `documento`,`ped`.`orcamento` AS `orcamento_id`,`ad_prod`.`orcamento_produto` AS `produto_id`,`orc`.`data_evento` AS `data_evento`,1 AS `adicional`,`ad`.`id` AS `adicional_id`,`ad_prod`.`id` AS `ad_produto_id`,('produto' collate utf8_general_ci) AS `produto_tipo`,`prod`.`nome` AS `produto_nome`,NULL AS `produto_codigo`,`ad_prod`.`quantidade` AS `quantidade`,`ad_prod`.`data_entrega` AS `data_entrega`,`ad_prod`.`cancelado` AS `cancelado`,`orc_prod`.`recebimento_dados` AS `recebimento_dados`,`orc_prod`.`desenvolvimento_layout` AS `desenvolvimento_layout`,`orc_prod`.`envio_layout` AS `envio_layout`,`orc_prod`.`aprovado` AS `aprovado`,`ad_prod`.`producao` AS `producao`,`ad_prod`.`disponivel` AS `disponivel`,`ad_prod`.`retirado` AS `retirado`,`cli`.`id` AS `cliente_id`,concat(`cli`.`nome`,' ',`cli`.`sobrenome`) AS `cliente`,`loj`.`unidade` AS `unidade` from (((((((`adicional` `ad` left join `pedido` `ped` on((`ad`.`pedido` = `ped`.`id`))) left join `orcamento` `orc` on((`ped`.`orcamento` = `orc`.`id`))) join `adicional_produto` `ad_prod` on((`ad_prod`.`adicional` = `ad`.`id`))) join `orcamento_produto` `orc_prod` on((`orc_prod`.`id` = `ad_prod`.`orcamento_produto`))) join `produto` `prod` on((`prod`.`id` = `orc_prod`.`produto`))) left join `cliente` `cli` on((`cli`.`id` = `orc`.`cliente`))) left join `loja` `loj` on((`loj`.`id` = `orc`.`loja`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-10 23:30:34

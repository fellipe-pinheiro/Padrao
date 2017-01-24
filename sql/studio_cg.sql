-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2016 às 07:58
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studio_cg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acabamento`
--

CREATE TABLE IF NOT EXISTS `acabamento` (
`id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acabamento`
--

INSERT INTO `acabamento` (`id`, `nome`, `descricao`, `valor`) VALUES
(28, 'Corte e Vinco', 'Descrição Acabamento 1', '60.00'),
(29, 'Laminação', 'Descrição Acabamento 2', '130.00'),
(30, 'Empastamento', 'Descrição Acabamento 3', '120.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessorio`
--

CREATE TABLE IF NOT EXISTS `acessorio` (
`id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acessorio`
--

INSERT INTO `acessorio` (`id`, `nome`, `descricao`, `valor`) VALUES
(1, 'Swarovski', 'Pedra Brilhante', '0.50'),
(3, 'Strass', 'Pedra de segunda mão 25 de março', '0.20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `assessor`
--

CREATE TABLE IF NOT EXISTS `assessor` (
`id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `descricao` text NOT NULL,
  `comissao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `assessor`
--

INSERT INTO `assessor` (`id`, `nome`, `sobrenome`, `empresa`, `email`, `telefone`, `descricao`, `comissao`) VALUES
(1, 'Maria', 'Silva', 'Buffet Alegria', 'maria@buffetalegria.com', '(11) 95412-9806', 'Funcionária do buffet alegria.....', 10),
(2, 'Joaquim', 'Oliveira', 'Assessoria Tamu Junto', 'joaquim@atj.com.br', '(11)98723-9944', 'Assessor Excelente', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao`
--

CREATE TABLE IF NOT EXISTS `cartao` (
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_acabamento`
--

CREATE TABLE IF NOT EXISTS `cartao_acabamento` (
`id` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `acabamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_acessorio`
--

CREATE TABLE IF NOT EXISTS `cartao_acessorio` (
`id` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `acessorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_fita`
--

CREATE TABLE IF NOT EXISTS `cartao_fita` (
`id` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `fita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_impressao`
--

CREATE TABLE IF NOT EXISTS `cartao_impressao` (
`id` int(11) NOT NULL,
  `impressao` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_papel`
--

CREATE TABLE IF NOT EXISTS `cartao_papel` (
`id` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `papel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `nome2` varchar(20) DEFAULT NULL,
  `sobrenome2` varchar(50) DEFAULT NULL,
  `email2` varchar(50) NOT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  `rg` varchar(15) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `observacao` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `sobrenome`, `email`, `telefone`, `nome2`, `sobrenome2`, `email2`, `telefone2`, `rg`, `cpf`, `rua`, `numero`, `complemento`, `estado`, `bairro`, `cidade`, `cep`, `observacao`) VALUES
(2, 'Rafael', 'Nicolas Felipe Carvalho', 'rncarvalho@trimempresas.com.br', '(69) 3650-0483', 'Lara', 'Bruna Rocha', '', '(69) 9303-7858', '43.612.698-9', '272.246.563-99', 'Rua São Paulo', '867', '1234', 'RO', 'Setor 05', 'Ariquemes', '76870-650', 'IMPORTANTE: Nosso gerador online de Pessoa tem como intenção ajudar estudantes, programadores, analistas e testadores a gerar documentos. Normalmente necessários parar testar seus softwares em desenvolvimento. \r\nA má utilização dos dados aqui gerados é de total responsabilidade do usuário. \r\nOs números são gerados de forma aleatória, respeitando as regras de criação de cada documento.'),
(3, 'Rafaela', 'Laura Costa', 'rlcosta@centerdiesel.com.br', '(14) 2870-1894', 'Maria', 'da Penha', '', '(14) 98100-4871', '22.905.419-5', '387.670.261-50', 'Rua Regente Feijó', '477', '9999', 'SP', 'Centro', 'Pederneiras', '17280-972', 'Fique sabendo das novidades do nosso site! Cadastre seu email abaixo. \r\nE relaxe que também odeio spam! :) ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite`
--

CREATE TABLE IF NOT EXISTS `convite` (
`id` int(11) NOT NULL,
  `convite_modelo` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `envelope` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite_modelo`
--

CREATE TABLE IF NOT EXISTS `convite_modelo` (
`id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `altura_final` int(5) NOT NULL,
  `largura_final` int(5) NOT NULL,
  `cartao_altura` int(5) NOT NULL,
  `cartao_largura` int(5) NOT NULL,
  `envelope_altura` int(5) NOT NULL,
  `envelope_largura` int(5) NOT NULL,
  `empastamento_borda` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `convite_modelo`
--

INSERT INTO `convite_modelo` (`id`, `codigo`, `nome`, `altura_final`, `largura_final`, `cartao_altura`, `cartao_largura`, `envelope_altura`, `envelope_largura`, `empastamento_borda`, `descricao`) VALUES
(1, 'CG123', 'Convite', 150, 200, 150, 200, 320, 330, 7, 'Lorem ipsum Adipisicing ut deserunt minim tempor aute ea eu eiusmod esse sint.'),
(2, 'CD789', 'Convite 4', 101, 201, 101, 201, 301, 401, 7, 'Lorem ipsum Reprehenderit in ea non sed mollit ad ea cupidatat cupidatat nulla deserunt minim do cillum exercitation elit aute ullamco dolore esse esse ullamco in eiusmod dolor ut labore est mollit aute incididunt mollit quis non fugiat adipisicing fugiat.\r\nLorem ipsum Reprehenderit in ea non sed mollit ad ea cupidatat cupidatat nulla deserunt minim do cillum exercitation elit aute ullamco dolore esse esse ullamco in eiusmod dolor ut labore est mollit aute incididunt mollit quis non fugiat adipisicing fugiat.'),
(3, 'teste', 'Teste', 10, 20, 320, 330, 240, 330, 7, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `crud`
--

CREATE TABLE IF NOT EXISTS `crud` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `idade` int(11) NOT NULL,
  `data` date NOT NULL,
  `celular` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `crud`
--

INSERT INTO `crud` (`id`, `nome`, `idade`, `data`, `celular`) VALUES
(1, 'Fellipe', 23, '2016-09-03', '(11)979991641');

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope`
--

CREATE TABLE IF NOT EXISTS `envelope` (
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_acabamento`
--

CREATE TABLE IF NOT EXISTS `envelope_acabamento` (
`id` int(11) NOT NULL,
  `envelope` int(11) NOT NULL,
  `acabamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_acessorio`
--

CREATE TABLE IF NOT EXISTS `envelope_acessorio` (
`id` int(11) NOT NULL,
  `envelope` int(11) NOT NULL,
  `acessorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_fita`
--

CREATE TABLE IF NOT EXISTS `envelope_fita` (
`id` int(11) NOT NULL,
  `envelope` int(11) NOT NULL,
  `fita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_impressao`
--

CREATE TABLE IF NOT EXISTS `envelope_impressao` (
`id` int(11) NOT NULL,
  `impressao` int(11) NOT NULL,
  `envelope` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_papel`
--

CREATE TABLE IF NOT EXISTS `envelope_papel` (
`id` int(11) NOT NULL,
  `envelope` int(11) NOT NULL,
  `papel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita`
--

CREATE TABLE IF NOT EXISTS `fita` (
`id` int(11) NOT NULL,
  `fita_laco` int(11) NOT NULL,
  `fita_material` int(11) NOT NULL,
  `valor_03mm` decimal(10,2) NOT NULL,
  `valor_07mm` decimal(10,2) NOT NULL,
  `valor_10mm` decimal(10,2) NOT NULL,
  `valor_15mm` decimal(10,2) NOT NULL,
  `valor_22mm` decimal(10,2) NOT NULL,
  `valor_38mm` decimal(10,2) NOT NULL,
  `valor_50mm` decimal(10,2) NOT NULL,
  `valor_70mm` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fita`
--

INSERT INTO `fita` (`id`, `fita_laco`, `fita_material`, `valor_03mm`, `valor_07mm`, `valor_10mm`, `valor_15mm`, `valor_22mm`, `valor_38mm`, `valor_50mm`, `valor_70mm`) VALUES
(3, 3, 1, '0.50', '0.60', '0.80', '1.00', '1.50', '1.80', '2.50', '3.00'),
(4, 1, 1, '1.00', '1.00', '1.00', '1.00', '2.00', '2.00', '3.00', '4.00'),
(5, 1, 2, '1.50', '1.50', '1.50', '1.50', '2.00', '2.00', '4.00', '6.00'),
(6, 2, 1, '1.00', '1.00', '1.00', '1.00', '1.50', '1.50', '2.50', '5.00'),
(7, 2, 2, '1.50', '1.50', '1.50', '1.50', '3.00', '3.00', '6.00', '8.00'),
(8, 4, 1, '2.00', '2.00', '2.00', '2.00', '3.00', '3.00', '5.00', '6.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita_espessura`
--

CREATE TABLE IF NOT EXISTS `fita_espessura` (
`id` int(11) NOT NULL,
  `esp_03mm` varchar(20) NOT NULL DEFAULT '03mm',
  `esp_07mm` varchar(20) NOT NULL DEFAULT '07mm',
  `esp_10mm` varchar(20) NOT NULL DEFAULT '10mm',
  `esp_15mm` varchar(20) NOT NULL DEFAULT '15mm',
  `esp_22mm` varchar(20) NOT NULL DEFAULT '22mm',
  `esp_38mm` varchar(20) NOT NULL DEFAULT '38mm',
  `esp_50mm` varchar(20) NOT NULL DEFAULT '50mm',
  `esp_70mm` varchar(20) NOT NULL DEFAULT '70mm'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fita_espessura`
--

INSERT INTO `fita_espessura` (`id`, `esp_03mm`, `esp_07mm`, `esp_10mm`, `esp_15mm`, `esp_22mm`, `esp_38mm`, `esp_50mm`, `esp_70mm`) VALUES
(1, '03mm', '07mm', '10mm', '15mm', '22mm', '38mm', '50mm', '70mm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita_laco`
--

CREATE TABLE IF NOT EXISTS `fita_laco` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fita_laco`
--

INSERT INTO `fita_laco` (`id`, `nome`, `descricao`) VALUES
(1, 'Chanel Básico', 'Laço chanel com uma onda...'),
(2, 'Chanel Duplo', 'Laço chanel com duas ondas...'),
(3, 'Laço Borboleta', 'Laço de amarração comum estilo borboleta'),
(4, 'Chanel Básico + Strass ', 'Descrição'),
(5, 'Chanel Duplo + Strass ', 'Descrição');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita_material`
--

CREATE TABLE IF NOT EXISTS `fita_material` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fita_material`
--

INSERT INTO `fita_material` (`id`, `nome`, `descricao`) VALUES
(1, 'Cetim', 'Descrição Cetim'),
(2, 'Gorgurão', 'Descrição Gorgurão'),
(3, 'Aveludada', 'Descrição Aveludada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fonte`
--

CREATE TABLE IF NOT EXISTS `fonte` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fonte`
--

INSERT INTO `fonte` (`id`, `nome`) VALUES
(1, 'Arial'),
(2, 'Times New Roman');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao`
--

CREATE TABLE IF NOT EXISTS `impressao` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `impressao_area` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impressao`
--

INSERT INTO `impressao` (`id`, `nome`, `descricao`, `valor`, `impressao_area`) VALUES
(6, 'Baixo Relevo', 'Descriçaõ Baixo Relevo', '100.00', 1),
(7, 'Baixo Relevo', 'Descrição Baixo Relevo', '150.00', 2),
(8, 'Baixo Relevo', 'Descrição Baixo Relevo', '200.00', 4),
(9, 'Alto Relevo', 'Descrição Alto Relevo', '140.00', 1),
(10, 'Alto Relevo', 'Descrição Alto Relevo', '180.00', 2),
(11, 'Alto Relevo', 'Descrição Alto Relevo', '250.00', 4),
(12, 'Digital', 'Descrição Digital', '80.00', 1),
(13, 'Digital', 'Descrição Digital', '110.00', 2),
(14, 'Digital', 'Descrição Digital', '150.00', 4),
(15, 'Metalic', 'Descrição metalic', '150.00', 1),
(16, 'Metalic', 'Descrição metalic', '200.00', 2),
(17, 'Metalic', 'Descrição metalic', '300.00', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao_area`
--

CREATE TABLE IF NOT EXISTS `impressao_area` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impressao_area`
--

INSERT INTO `impressao_area` (`id`, `nome`, `descricao`) VALUES
(1, 'Pequena', 'Compreende a escritas, brasões ou pequenas figuras impressas'),
(2, 'Grande', 'Compreende a estampas com grande área impressa como arabescos, etc'),
(4, 'Total', 'Compreende a impressão de toda extenção do papel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao_cor`
--

CREATE TABLE IF NOT EXISTS `impressao_cor` (
`id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `descricao` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impressao_cor`
--

INSERT INTO `impressao_cor` (`id`, `nome`, `referencia`, `descricao`) VALUES
(1, 'Cor 1', 'xyz', 'descrição'),
(2, 'Cor 2', 'abc', 'Descrição'),
(3, 'Cor 3', '123', 'asdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mao_obra`
--

CREATE TABLE IF NOT EXISTS `mao_obra` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mao_obra`
--

INSERT INTO `mao_obra` (`id`, `nome`, `valor`, `descricao`) VALUES
(1, 'Fácil', '1.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae ultrices erat. Donec viverra, nunc eget accumsan sodales, neque lacus viverra erat, quis pulvinar velit mi nec lorem. Duis pretium leo id viverra porta. '),
(2, 'Médio', '1.50', 'Duis et erat non magna finibus mollis. In dictum semper velit, eget mattis magna imperdiet at. Integer turpis velit, elementum ac semper in, facilisis vel libero. Aliquam eget est sed tellus ultricies tincidunt eu vel sem. Nunc et ornare eros. Donec viverra mauris felis.'),
(3, 'Difícil', '2.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae ultrices erat. Donec viverra, nunc eget accumsan sodales, neque lacus viverra erat, quis pulvinar velit mi nec lorem. Duis pretium leo id viverra porta. Duis et erat non magna finibus mollis. In dictum semper velit, eget mattis magna imperdiet at. Integer turpis velit, elementum ac semper in, facilisis vel libero. Aliquam eget est sed tellus ultricies tincidunt eu vel sem. Nunc et ornare eros. Donec viverra mauris felis.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
`id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `assessor` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_convite`
--

CREATE TABLE IF NOT EXISTS `orcamento_convite` (
`id` int(11) NOT NULL,
  `orcamento` int(11) NOT NULL,
  `convite` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `desconto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel`
--

CREATE TABLE IF NOT EXISTS `papel` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `papel_linha` int(11) NOT NULL,
  `papel_dimensao` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `papel`
--

INSERT INTO `papel` (`id`, `nome`, `papel_linha`, `papel_dimensao`, `descricao`) VALUES
(8, 'Majorca', 7, 2, 'Descrição Majorca'),
(9, 'Aspen', 7, 2, ''),
(10, 'Los Angeles', 11, 2, ''),
(11, 'Stile Naturale', 8, 2, ''),
(12, 'Rives Natural White', 7, 2, ''),
(13, 'Teste Papel', 12, 2, ''),
(14, 'Natural White', 13, 3, 'Descrição...');

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel_catalogo`
--

CREATE TABLE IF NOT EXISTS `papel_catalogo` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `papel_catalogo`
--

INSERT INTO `papel_catalogo` (`id`, `nome`, `descricao`) VALUES
(1, 'Color Plus', 'Catálogo Color Plus VSP'),
(2, 'Relux', 'Catálogo RELUX VSP'),
(3, 'Marakech', 'Catálogo Nova Papel'),
(4, 'Diamond', 'Catalogo Nova Papel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel_dimensao`
--

CREATE TABLE IF NOT EXISTS `papel_dimensao` (
`id` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `largura` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `papel_dimensao`
--

INSERT INTO `papel_dimensao` (`id`, `altura`, `largura`, `descricao`) VALUES
(2, 660, 960, ''),
(3, 700, 1000, ''),
(4, 700, 1200, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel_gramatura`
--

CREATE TABLE IF NOT EXISTS `papel_gramatura` (
`id` int(11) NOT NULL,
  `gramatura` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `papel_gramatura`
--

INSERT INTO `papel_gramatura` (`id`, `gramatura`) VALUES
(8, 80),
(2, 120),
(3, 180),
(4, 240),
(5, 250),
(6, 300),
(7, 400);

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel_linha`
--

CREATE TABLE IF NOT EXISTS `papel_linha` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `papel_catalogo` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `valor_80g` decimal(10,2) NOT NULL,
  `valor_120g` decimal(10,2) NOT NULL,
  `valor_180g` decimal(10,2) NOT NULL,
  `valor_250g` decimal(10,2) NOT NULL,
  `valor_300g` decimal(10,2) NOT NULL,
  `valor_350g` decimal(10,2) NOT NULL,
  `valor_400g` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `papel_linha`
--

INSERT INTO `papel_linha` (`id`, `nome`, `papel_catalogo`, `descricao`, `valor_80g`, `valor_120g`, `valor_180g`, `valor_250g`, `valor_300g`, `valor_350g`, `valor_400g`) VALUES
(7, 'Sparkle', 2, 'Papéis - Metálicos - Sparkle\r\nPapéis com acabamento de partículas cintilantes e reluzentes, aplicado como coating em uma das faces de papéis previamente coloridos na massa. Essa linha é composta por oito cores holográficas, seis cores metálicas e sete cores fluorescentes ou cítricas, ideal para projetos irreverentes.\r\nCoating: 1 face\r\nFormatos: folhas – 65x95cm e cut-size sob encomenda\r\nTipos de impressão: relevo seco, hot stamping, serigrafia\r\nAcabamentos: corte e vinco\r\nSugestões de aplicação: embalagens, convites diversos, entre outras\r\nPRODUTO FORA DE LINHA - disponível até final de estoque.', '0.80', '1.20', '1.80', '2.50', '3.00', '3.50', '4.00'),
(8, 'Color Plus Metálico', 1, 'Papéis - Metálicos - Color Plus Metálico\r\nEm cores inéditas, e agora texturizados, os papéis dessa linha apresentam excelente qualidade de impressão e acabamento. Disponíveis em sete cores no padrão liso, e na versão texturizada Linear (micro cotelê), em cinco opções de cores.\r\nCoating: 2 faces\r\nFormatos: folhas – 66x96cm / 65x95cm (Copper e Gold) e cut-size sob encomenda.\r\nTipos de impressão: offset, relevos seco e americano, hot stamping e serigrafia\r\nAcabamentos: corte e vinco\r\nSugestões de aplicação: embalagens, convites diversos, cartões de visita, catálogos, entre outras.', '0.85', '1.25', '1.85', '2.55', '3.00', '3.50', '4.50'),
(11, 'Marakech', 3, '', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00'),
(12, 'Diamond', 4, '', '1.10', '1.30', '1.50', '1.70', '1.90', '2.10', '2.30'),
(13, 'Rives', 1, 'Descrição', '1.00', '1.10', '1.20', '1.30', '1.40', '1.50', '1.60');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
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
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'CJoqzwvLuVoKfxT1sEx7l.', 1268889823, 1473036741, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', NULL, '$2y$08$krXwn5JYRpM7D8GBMNqpmO6Pj2MvMTVUVB/elb6dCfIghSfTOlFDe', NULL, 'fellipe@fellipe.com', NULL, NULL, NULL, 'nSoGO4GM2RqIuOTjrKQGrO', 1473004007, 1473036691, 1, 'fellipe', 'pinheiro', 'minha casa', '1112345678'),
(3, '::1', NULL, '$2y$08$4hiTZUZZCTxBznoAp9LiEe1WGLFt9.TICnnYYJ4nZeKqB.tQSGToa', NULL, 'erick@erick.com', NULL, NULL, NULL, '/G1alc/jpAau3xJ291IcNO', 1473036820, 1474005393, 1, 'Erick', '--', 'minha casa', '1112345678');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(5, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acabamento`
--
ALTER TABLE `acabamento`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acessorio`
--
ALTER TABLE `acessorio`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessor`
--
ALTER TABLE `assessor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartao`
--
ALTER TABLE `cartao`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
 ADD PRIMARY KEY (`id`), ADD KEY `cartaoAcabamento_cartao_fk` (`cartao`), ADD KEY `cartaoAcabamento_acabamento_fk` (`acabamento`);

--
-- Indexes for table `cartao_acessorio`
--
ALTER TABLE `cartao_acessorio`
 ADD PRIMARY KEY (`id`), ADD KEY `cartaoAcessorio_cartao_fk` (`cartao`), ADD KEY `cartaoAcessorio_acessorio_fk` (`acessorio`);

--
-- Indexes for table `cartao_fita`
--
ALTER TABLE `cartao_fita`
 ADD PRIMARY KEY (`id`), ADD KEY `cartaoFita_cartao_fk` (`cartao`), ADD KEY `cartaoFita_fita_fk` (`fita`);

--
-- Indexes for table `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
 ADD PRIMARY KEY (`id`), ADD KEY `cartaoImpressao_cartao_fk` (`cartao`), ADD KEY `cartaoImpressao_impressao_fk` (`impressao`);

--
-- Indexes for table `cartao_papel`
--
ALTER TABLE `cartao_papel`
 ADD PRIMARY KEY (`id`), ADD KEY `cartaoPapel_cartao_fk` (`cartao`), ADD KEY `cartaoPapel_papel_fk` (`papel`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`,`rg`,`cpf`);

--
-- Indexes for table `convite`
--
ALTER TABLE `convite`
 ADD PRIMARY KEY (`id`), ADD KEY `convite_modelo_convite_fk` (`convite_modelo`), ADD KEY `convite_cartao_fk` (`cartao`), ADD KEY `convite_envelope_fk` (`envelope`);

--
-- Indexes for table `convite_modelo`
--
ALTER TABLE `convite_modelo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `envelope`
--
ALTER TABLE `envelope`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
 ADD PRIMARY KEY (`id`), ADD KEY `envelopeAcabamento_envelope_fk` (`envelope`), ADD KEY `envelopeAcabamento_acabamento_fk` (`acabamento`);

--
-- Indexes for table `envelope_acessorio`
--
ALTER TABLE `envelope_acessorio`
 ADD PRIMARY KEY (`id`), ADD KEY `envelopeAcessorio_envelope_fk` (`envelope`), ADD KEY `envelopeAcessorio_acessorio_fk` (`acessorio`);

--
-- Indexes for table `envelope_fita`
--
ALTER TABLE `envelope_fita`
 ADD PRIMARY KEY (`id`), ADD KEY `envelopeFita_envelope_fk` (`envelope`), ADD KEY `envelopeFita_fita_fk` (`fita`);

--
-- Indexes for table `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
 ADD PRIMARY KEY (`id`), ADD KEY `envelopeImpressao_envelope_fk` (`envelope`), ADD KEY `envelopeImpressao_impressao_fk` (`impressao`);

--
-- Indexes for table `envelope_papel`
--
ALTER TABLE `envelope_papel`
 ADD PRIMARY KEY (`id`), ADD KEY `envelopePapel_envelope_fk` (`envelope`), ADD KEY `envelopePapel_papel_fk` (`papel`);

--
-- Indexes for table `fita`
--
ALTER TABLE `fita`
 ADD PRIMARY KEY (`id`), ADD KEY `fita_fita_laco_fk` (`fita_laco`), ADD KEY `fita_fita_material_fk` (`fita_material`), ADD KEY `fita_fita_espessura_fk` (`valor_03mm`);

--
-- Indexes for table `fita_espessura`
--
ALTER TABLE `fita_espessura`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fita_laco`
--
ALTER TABLE `fita_laco`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fita_material`
--
ALTER TABLE `fita_material`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonte`
--
ALTER TABLE `fonte`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impressao`
--
ALTER TABLE `impressao`
 ADD PRIMARY KEY (`id`), ADD KEY `impressao_impressao_area_fk` (`impressao_area`);

--
-- Indexes for table `impressao_area`
--
ALTER TABLE `impressao_area`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impressao_cor`
--
ALTER TABLE `impressao_cor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mao_obra`
--
ALTER TABLE `mao_obra`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
 ADD PRIMARY KEY (`id`), ADD KEY `orcamento_cliente_fk` (`cliente`), ADD KEY `orcamento_assessor_fk` (`assessor`);

--
-- Indexes for table `orcamento_convite`
--
ALTER TABLE `orcamento_convite`
 ADD PRIMARY KEY (`id`), ADD KEY `orcamentoConvite_convite_fk` (`convite`), ADD KEY `orcamentoConvite_orcamento_fk` (`orcamento`);

--
-- Indexes for table `papel`
--
ALTER TABLE `papel`
 ADD PRIMARY KEY (`id`), ADD KEY `papel_papel_linha_fk` (`papel_linha`), ADD KEY `papel_papel_dimensao_fk` (`papel_dimensao`);

--
-- Indexes for table `papel_catalogo`
--
ALTER TABLE `papel_catalogo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papel_dimensao`
--
ALTER TABLE `papel_dimensao`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papel_gramatura`
--
ALTER TABLE `papel_gramatura`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nome` (`gramatura`);

--
-- Indexes for table `papel_linha`
--
ALTER TABLE `papel_linha`
 ADD PRIMARY KEY (`id`,`papel_catalogo`), ADD KEY `papel_linha_catalogo_fk` (`papel_catalogo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acabamento`
--
ALTER TABLE `acabamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `acessorio`
--
ALTER TABLE `acessorio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `assessor`
--
ALTER TABLE `assessor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cartao`
--
ALTER TABLE `cartao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao_acessorio`
--
ALTER TABLE `cartao_acessorio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao_fita`
--
ALTER TABLE `cartao_fita`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cartao_papel`
--
ALTER TABLE `cartao_papel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `convite`
--
ALTER TABLE `convite`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `convite_modelo`
--
ALTER TABLE `convite_modelo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `envelope`
--
ALTER TABLE `envelope`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `envelope_acessorio`
--
ALTER TABLE `envelope_acessorio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `envelope_fita`
--
ALTER TABLE `envelope_fita`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `envelope_papel`
--
ALTER TABLE `envelope_papel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fita`
--
ALTER TABLE `fita`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fita_espessura`
--
ALTER TABLE `fita_espessura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fita_laco`
--
ALTER TABLE `fita_laco`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fita_material`
--
ALTER TABLE `fita_material`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fonte`
--
ALTER TABLE `fonte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `impressao`
--
ALTER TABLE `impressao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `impressao_area`
--
ALTER TABLE `impressao_area`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `impressao_cor`
--
ALTER TABLE `impressao_cor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mao_obra`
--
ALTER TABLE `mao_obra`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orcamento_convite`
--
ALTER TABLE `orcamento_convite`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `papel`
--
ALTER TABLE `papel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `papel_catalogo`
--
ALTER TABLE `papel_catalogo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `papel_dimensao`
--
ALTER TABLE `papel_dimensao`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `papel_gramatura`
--
ALTER TABLE `papel_gramatura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `papel_linha`
--
ALTER TABLE `papel_linha`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
ADD CONSTRAINT `cartaoAcabamento_acabamento_fk` FOREIGN KEY (`acabamento`) REFERENCES `acabamento` (`id`),
ADD CONSTRAINT `cartaoAcabamento_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`);

--
-- Limitadores para a tabela `cartao_acessorio`
--
ALTER TABLE `cartao_acessorio`
ADD CONSTRAINT `cartaoAcessorio_acessorio_fk` FOREIGN KEY (`acessorio`) REFERENCES `acessorio` (`id`),
ADD CONSTRAINT `cartaoAcessorio_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`);

--
-- Limitadores para a tabela `cartao_fita`
--
ALTER TABLE `cartao_fita`
ADD CONSTRAINT `cartaoFita_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
ADD CONSTRAINT `cartaoFita_fita_fk` FOREIGN KEY (`fita`) REFERENCES `fita` (`id`);

--
-- Limitadores para a tabela `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
ADD CONSTRAINT `cartaoImpressao_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
ADD CONSTRAINT `cartaoImpressao_impressao_fk` FOREIGN KEY (`impressao`) REFERENCES `impressao` (`id`);

--
-- Limitadores para a tabela `cartao_papel`
--
ALTER TABLE `cartao_papel`
ADD CONSTRAINT `cartaoPapel_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
ADD CONSTRAINT `cartaoPapel_papel_fk` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`);

--
-- Limitadores para a tabela `convite`
--
ALTER TABLE `convite`
ADD CONSTRAINT `convite_cartao_fk` FOREIGN KEY (`cartao`) REFERENCES `cartao` (`id`),
ADD CONSTRAINT `convite_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
ADD CONSTRAINT `convite_modelo_convite_fk` FOREIGN KEY (`convite_modelo`) REFERENCES `convite_modelo` (`id`);

--
-- Limitadores para a tabela `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
ADD CONSTRAINT `envelopeAcabamento_acabamento_fk` FOREIGN KEY (`acabamento`) REFERENCES `acabamento` (`id`),
ADD CONSTRAINT `envelopeAcabamento_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`);

--
-- Limitadores para a tabela `envelope_acessorio`
--
ALTER TABLE `envelope_acessorio`
ADD CONSTRAINT `envelopeAcessorio_acessorio_fk` FOREIGN KEY (`acessorio`) REFERENCES `acessorio` (`id`),
ADD CONSTRAINT `envelopeAcessorio_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`);

--
-- Limitadores para a tabela `envelope_fita`
--
ALTER TABLE `envelope_fita`
ADD CONSTRAINT `envelopeFita_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
ADD CONSTRAINT `envelopeFita_fita_fk` FOREIGN KEY (`fita`) REFERENCES `fita` (`id`);

--
-- Limitadores para a tabela `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
ADD CONSTRAINT `envelopeImpressao_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
ADD CONSTRAINT `envelopeImpressao_impressao_fk` FOREIGN KEY (`impressao`) REFERENCES `impressao` (`id`);

--
-- Limitadores para a tabela `envelope_papel`
--
ALTER TABLE `envelope_papel`
ADD CONSTRAINT `envelopePapel_envelope_fk` FOREIGN KEY (`envelope`) REFERENCES `envelope` (`id`),
ADD CONSTRAINT `envelopePapel_papel_fk` FOREIGN KEY (`papel`) REFERENCES `papel` (`id`);

--
-- Limitadores para a tabela `fita`
--
ALTER TABLE `fita`
ADD CONSTRAINT `fita_fita_laco_fk` FOREIGN KEY (`fita_laco`) REFERENCES `fita_laco` (`id`),
ADD CONSTRAINT `fita_fita_material_fk` FOREIGN KEY (`fita_material`) REFERENCES `fita_material` (`id`);

--
-- Limitadores para a tabela `impressao`
--
ALTER TABLE `impressao`
ADD CONSTRAINT `impressao_impressao_area_fk` FOREIGN KEY (`impressao_area`) REFERENCES `impressao_area` (`id`);

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
ADD CONSTRAINT `orcamento_assessor_fk` FOREIGN KEY (`assessor`) REFERENCES `assessor` (`id`),
ADD CONSTRAINT `orcamento_cliente_fk` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);

--
-- Limitadores para a tabela `orcamento_convite`
--
ALTER TABLE `orcamento_convite`
ADD CONSTRAINT `orcamentoConvite_convite_fk` FOREIGN KEY (`convite`) REFERENCES `convite` (`id`),
ADD CONSTRAINT `orcamentoConvite_orcamento_fk` FOREIGN KEY (`orcamento`) REFERENCES `orcamento` (`id`);

--
-- Limitadores para a tabela `papel`
--
ALTER TABLE `papel`
ADD CONSTRAINT `papel_papel_dimensao_fk` FOREIGN KEY (`papel_dimensao`) REFERENCES `papel_dimensao` (`id`),
ADD CONSTRAINT `papel_papel_linha_fk` FOREIGN KEY (`papel_linha`) REFERENCES `papel_linha` (`id`);

--
-- Limitadores para a tabela `papel_linha`
--
ALTER TABLE `papel_linha`
ADD CONSTRAINT `papel_linha_catalogo_fk` FOREIGN KEY (`papel_catalogo`) REFERENCES `papel_catalogo` (`id`);

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

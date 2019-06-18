-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jun-2019 às 02:51
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_votacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_deputado` int(11) DEFAULT NULL,
  `id_presidente` int(11) DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `comentario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_comentario` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_deputado`, `id_presidente`, `id_projeto`, `comentario`, `data_comentario`) VALUES
(1, NULL, 1, 15, 'Bacanaa, curti hein!', '2019-05-25 17:38:02'),
(2, NULL, 1, 15, 'Taokey!', '2019-05-25 17:38:06'),
(3, 1, NULL, 15, 'Bora!', '2019-05-25 17:38:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `deputados`
--

CREATE TABLE `deputados` (
  `id_deputado` int(11) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `deputados`
--

INSERT INTO `deputados` (`id_deputado`, `id_pais`, `nome`, `email`, `senha`) VALUES
(1, 1, 'Tiririca', 'tiririca@brasil.com', '$2y$10$QfHRDc898jtvx5RvKTK5Jeenbv6y.WLmFmI1upLF1nLo1az3TDWmS'),
(2, 1, 'Rodrigo Mais', 'rodrigo@brasil.com', '$2y$10$UrYJjsEPs5NiLBB3pLIwZOL9NiAEt0XzSiEg7/ZNOsah9y/Jj6mi6'),
(3, 1, 'Marco Feliciano', 'marcio@brasil.com', '$2y$10$6OAO8XEjBd6gD2.yKAaPa.v/Rq857BFlN0oqclv3IMyo.Vl2oYGHy'),
(4, 3, 'Deputado chines', 'deputado@china.com', '$2y$10$GKeS9e6.CzfYASpYqH5kWObSNHfhgKag3CfGXRL3LOqZuZRVZ.ZX6'),
(5, 3, 'Deputado 2 ', 'deputado2@china.com', '$2y$10$eqQSr5Bvcc6MvnvsgyiJ0.I5gdenlSr/6LzA.M1lq.hixj0/Dyy7S'),
(6, 4, 'Deputado americano', 'deputado@americano.com', '$2y$10$bWw/ICJ5IS5ORoMfRhRJTe.SNNI807/lqi3QZfSSwSLSbBUcORwuu'),
(7, 5, 'Deputado de Honduras', 'deputado@honduras.com', '$2y$10$/V0CMAWub39El7wfVyhx0uFfg4.3BXqyCh6t8LYNeIjiUKcUlvy2W'),
(8, 6, 'Deputado do Congo', 'deputado@congo.com', '$2y$10$YMEp/fVQjN1cyMD772TgR.skQX43UybUD/HEiiRI2aqZ/4dUehNTm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id_pais`, `nome`, `sigla`) VALUES
(1, 'Brasil', 'BR'),
(3, 'China', 'CN'),
(4, 'Estados Unidos', 'US'),
(5, 'Honduras', 'HN'),
(6, 'Congo', 'CG'),
(7, 'Peru', 'PR'),
(8, 'Inglaterra', 'IG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `presidentes`
--

CREATE TABLE `presidentes` (
  `id_presidente` int(11) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `presidentes`
--

INSERT INTO `presidentes` (`id_presidente`, `id_pais`, `nome`, `email`, `senha`) VALUES
(1, 1, 'Jair Bolsonaro', 'bolsonaro@brasil.com', '$2y$10$nliPOZPX1tFjDT6iIYBCIu5vK14vr5Ud.lSuoR0V4pnS/K.LM2dFi'),
(3, 3, 'Chines kkk', 'presidente@china.com', '$2y$10$k5pWuq907XiZnRYkMsk0m.qykbPpCrU9UDwYf7XdnbYDsoa7qxMGS'),
(4, 4, 'Donald Trump', 'trump@eua.com', '$2y$10$NVs.4HgDW5.dEgytDL8gb.9ccaxdG./yp7upaq4Z1YZOiWXIwechO'),
(5, 5, 'Presidente de Honduras', 'presidente@honduras.com', '$2y$10$nVWHFneELd./dD8GqYa7PO8Jq2GcIVhB9YzHAM6LLSSHPVOrfBsaq'),
(6, 6, 'Presidente do congo', 'presidente@congo.com.br', '$2y$10$O7xRz5yUsXE3Gd/M2b6.H.e2VZKKzhf0ZhiJnLMJh7kPWus6dSRf.'),
(7, 7, 'Presidente do Peru', 'presidente@peru.com', '$2y$10$oyVFHmTfDOh7ZifWNyFTQ.WQy2F6lqjkhI85eyuG86w1jcZ2.11c.'),
(8, 8, 'Elizabeth', 'elizabeth@inglaterra.com', '$2y$10$9Et3QwYUoypPUQ/Z3VM.XeQLr1rNfvFK1eR31s5rsr0C79gtCSjny');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL,
  `id_deputado` int(11) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0',
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `data_resultado` datetime DEFAULT NULL,
  `id_presidente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `id_deputado`, `id_pais`, `data_criacao`, `status`, `titulo`, `descricao`, `data_resultado`, `id_presidente`) VALUES
(1, NULL, 1, '2019-05-25 17:25:02', 0, 'Novas oportunidades!', 'Novas oportunidades estão chegando  no brasil!!!!', NULL, 1),
(2, NULL, 1, '2019-05-25 17:25:53', 0, 'Titulo projeto aqui', 'Aulas de natações vão chegar para todos!!!', NULL, 1),
(3, NULL, 1, '2019-05-25 17:26:37', 0, 'TItulo projeto aqui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem. Vestibulum vehicula velit arcu, eu sodales diam eleifend vitae.', NULL, 1),
(4, NULL, 1, '2019-05-25 17:27:14', 0, 'Titulooooooo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem. Vestibulum vehicula velit arcu, eu sodales diam eleifend vitae.', NULL, 1),
(5, NULL, 1, '2019-05-25 17:27:14', 0, 'Titulooooooo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem. Vestibulum vehicula velit arcu, eu sodales diam eleifend vitae.', NULL, 1),
(6, NULL, 1, '2019-05-25 17:27:55', 0, 'Manha', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem. Vestibulum vehicula velit arcu, eu sodales diam eleifend vitae.', NULL, 1),
(7, NULL, 1, '2019-05-25 17:29:52', 0, 'Nome projeto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(8, NULL, 1, '2019-05-25 17:31:22', 0, 'TItuloooooo novo aqui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(9, NULL, 1, '2019-05-25 17:31:40', 4, 'Churrasco', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(10, NULL, 1, '2019-05-25 17:32:06', 0, 'Black friday', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(11, NULL, 1, '2019-05-25 17:32:32', 4, 'Pirogues', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(12, NULL, 1, '2019-05-25 17:32:45', 4, 'Pirogues o que é?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(13, NULL, 1, '2019-05-25 17:32:58', 1, 'PCcc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(14, NULL, 1, '2019-05-25 17:33:12', 3, 'Natal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(15, NULL, 1, '2019-05-25 17:33:27', 2, 'Italianos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 1),
(16, NULL, 3, '2019-05-25 17:43:29', 0, 'Chinesesssss', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 3),
(17, NULL, 3, '2019-05-25 17:43:48', 0, 'Chines ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 3),
(18, NULL, 3, '2019-05-25 17:43:50', 0, 'Chines ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 3),
(19, NULL, 4, '2019-05-25 17:46:49', 0, 'Americaaaa', 'dasdsadasdsadsadsadsa', NULL, 4),
(20, NULL, 5, '2019-05-25 17:48:27', 0, 'Projeto 1 Honduras', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 5),
(21, NULL, 5, '2019-05-25 17:48:31', 0, 'Projeto 2 Honduras', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus, sapien nec rutrum tempor, eros erat iaculis sem, vitae eleifend urna dolor ut lorem.', NULL, 5),
(22, 1, 1, '2019-06-17 21:29:48', 0, 'Novo titulo aqui', 'dsadsdsadsadsadsadsa', NULL, NULL),
(23, 1, 1, '2019-06-17 21:29:54', 0, 'Novo titulo aqui', 'dsadsdsadsadsadsadsa', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos`
--

CREATE TABLE `votos` (
  `id_voto` int(11) NOT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `id_deputado` int(11) DEFAULT NULL,
  `aprovado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `votos`
--

INSERT INTO `votos` (`id_voto`, `id_projeto`, `id_deputado`, `aprovado`) VALUES
(1, 15, 1, 1),
(2, 14, 1, 1),
(3, 15, 2, 1),
(4, 14, 2, 0),
(5, 15, 3, 0),
(6, 14, 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_deputado` (`id_deputado`),
  ADD KEY `id_presidente` (`id_presidente`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- Indexes for table `deputados`
--
ALTER TABLE `deputados`
  ADD PRIMARY KEY (`id_deputado`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indexes for table `presidentes`
--
ALTER TABLE `presidentes`
  ADD PRIMARY KEY (`id_presidente`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indexes for table `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`),
  ADD KEY `id_deputado` (`id_deputado`),
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `id_presidente` (`id_presidente`);

--
-- Indexes for table `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_projeto` (`id_projeto`),
  ADD KEY `id_deputado` (`id_deputado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deputados`
--
ALTER TABLE `deputados`
  MODIFY `id_deputado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `presidentes`
--
ALTER TABLE `presidentes`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_deputado`) REFERENCES `deputados` (`id_deputado`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_presidente`) REFERENCES `presidentes` (`id_presidente`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`);

--
-- Limitadores para a tabela `deputados`
--
ALTER TABLE `deputados`
  ADD CONSTRAINT `deputados_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Limitadores para a tabela `presidentes`
--
ALTER TABLE `presidentes`
  ADD CONSTRAINT `presidentes_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Limitadores para a tabela `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `projetos_ibfk_1` FOREIGN KEY (`id_deputado`) REFERENCES `deputados` (`id_deputado`),
  ADD CONSTRAINT `projetos_ibfk_2` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`),
  ADD CONSTRAINT `projetos_ibfk_3` FOREIGN KEY (`id_presidente`) REFERENCES `presidentes` (`id_presidente`);

--
-- Limitadores para a tabela `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`),
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`id_deputado`) REFERENCES `deputados` (`id_deputado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

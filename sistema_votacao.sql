-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Maio-2019 às 02:44
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 5.6.40

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
(1, 1, 'Tiririca', 'tiririca@brasil.com', '$2y$10$88vd/aq.Fa3HQjgC8sFFQO.3Wywqdg2tiaQUMLvk0vTFV2TIe.EVi'),
(2, 3, 'Eduardo', 'eduardo@peru.com', '$2y$10$0H4E8IEPweoCwlkeYEdK9e9k5ArFgA.sJgFrR1KeoT2Y2V9YMx8du');

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
(2, 'Estados Unidos', 'US'),
(3, 'Peru', 'PR');

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
(1, 1, 'Bolsonaro', 'bolsonaro@brasil.com', '$2y$10$NJPajiulpF3HoWQ3tq5ghOF3BjJv0XAGpIefh/MB4rNclSBlwlRiS'),
(2, 2, 'Trump', 'trump@eua.com', '$2y$10$OxEr9CHTjtlxXgIjF8Pbm.EUU1cvs4hHwIJIs2D8HIwhbrTgQRo6.'),
(3, 3, 'Martín', 'martin@peru.com', '$2y$10$WYSOfnfjx4TbAj95sjUmz.0oU//YFH1BWSKKLg7sQ6OAjoMg0X5CG');

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
  `descricao` text COLLATE utf8_unicode_ci,
  `data_resultado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `id_deputado`, `id_pais`, `data_criacao`, `status`, `titulo`, `descricao`, `data_resultado`) VALUES
(1, 1, 1, '2019-05-15 19:33:33', 0, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(2, 1, 1, '2019-05-15 19:33:39', 0, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(3, 1, 1, '2019-05-15 19:34:02', 0, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(4, 2, 3, '2019-05-15 21:10:53', 0, 'Abominação do Peru', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(5, 1, 1, '2019-05-15 21:31:15', 0, 'Noite do sol', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(6, 1, 1, '2019-05-15 21:31:26', 0, 'Manha', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(7, 1, 1, '2019-05-15 21:31:38', 0, 'Madrugada', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL);

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
  ADD PRIMARY KEY (`id_deputado`);

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
  ADD KEY `id_pais` (`id_pais`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deputados`
--
ALTER TABLE `deputados`
  MODIFY `id_deputado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presidentes`
--
ALTER TABLE `presidentes`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limitadores para a tabela `presidentes`
--
ALTER TABLE `presidentes`
  ADD CONSTRAINT `presidentes_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Limitadores para a tabela `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `projetos_ibfk_1` FOREIGN KEY (`id_deputado`) REFERENCES `deputados` (`id_deputado`),
  ADD CONSTRAINT `projetos_ibfk_2` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

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

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Maio-2019 às 21:52
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
(1, 1, 'Tiririca', 'tiririca@brasil.com', '$2y$10$cGwZ30w5RSF3/Ic8PBp69.ktqlUCNS/Q6q8z22PpCN.2IGs69vlAq'),
(2, 1, 'Eduardo', 'eduardo@brasil.com', '$2y$10$EZ0v/3UL8bVNDEN02CsXJu6y9E6VwY.BimfAS19Fqn0KzlUqCx5/S'),
(3, 1, 'Bruno', 'bruno@brasil.com', '$2y$10$pfjGDlOtmeFbCIc3YEUxfucZg9xyq7NvEVEpPU7FBKI/4Yivz/Zg.'),
(4, 1, 'Ratinho Jr', 'ratinho@brasil.com', '$2y$10$nVkzDxuTCB6wSUhoptj7o.svH4vE10Kc0gfgdRebr5Mla3f.ZjzeK'),
(5, 2, 'Pedro', 'pedro@eua.com', '$2y$10$CK8lulNJgKmJ5gqyu8c2.uOizlCjvArNY3P6kiPBUt3pO3FQ6/EYC'),
(6, 2, 'Jorge', 'jorge@eua.com', '$2y$10$0yBKUclKgVZdq1Y9BHI45OjmlqgNo4X2Ek1z1J.Ck5xgb3fm85DlK'),
(7, 2, 'Amanda', 'amanda@eua.com', '$2y$10$MNgi/kB4l3ba/B51eyJDlekx.YH9WB5ybF/47kP/AuuoxfnzFz0Fu'),
(8, 2, 'Hudson', 'hudson@eua.com', '$2y$10$TAGdptLyKdR.1HJnV//YUuQshMQfUGvsbydXS6jzbkyp8NzgslBci'),
(9, 3, 'Carlos', 'carlos@peru.com', '$2y$10$zXCc5v9BezGxIA8jIbdkxODxHVYHP0qAf64FrfDHXvJpIMvPiY0EK'),
(10, 3, 'Cristina', 'cristina@peru.com', '$2y$10$zasb/VC/0PTytIi0dngCkeXFW1jEY5rmpmBmhOCrPmquaFXGb5hDG'),
(11, 3, 'Maria', 'maria@peru.com', '$2y$10$W.SKHQDb9Ycuso39jnNgTuRYw3rofGU94Xp95GXASslQOpJlOQ6C6'),
(12, 3, 'Silvio', 'silvio@peru.com', '$2y$10$sh2anZpzQNqpuUx/MsDOveaLxdeRJGhMcjbRqUUDOLAHdTLIh11sS'),
(13, 4, 'Ana', 'ana@inglaterra.com', '$2y$10$D/ZvVd9UjaBXfmvMWotUs.pxai195nv56OWpLeY9wsTDdMEc4u13S'),
(14, 4, 'Silmara', 'silmara@inglaterra.com', '$2y$10$/yXBv0Sb1G041aF1PDko..2ULCZ/Wm1SitnSdkppd0O.Tz/P3aV1a'),
(15, 4, 'Helton', 'helton@inglaterra.com', '$2y$10$fOiWHykbYPSFEZj9CO13C.zOrHJ9.BEfTMF47y2WuQiChEUww7UHK'),
(16, 4, 'Kelvin', 'kelvin@inglaterra.com', '$2y$10$.MWrOmzQ0jFDZJGrPVWiI.1h3W5FQGFlfbKlf307xGApgfY9J0KcK'),
(17, 5, 'Catarina', 'catarina@congo.com', '$2y$10$aDdkXC/1UcGF4ibSkDoFWe604EnrFyaEmQNmhDxYSr3uooD1BYPIm'),
(18, 5, 'Gustavo', 'gustavo@congo.com', '$2y$10$8u82W6/EfGER0lge7NXi1OIxl58UfEEYNe8dtLByQp6GtaRZ1dqFa'),
(19, 5, 'Cassio', 'cassio@congo.com', '$2y$10$4MVzQWKrt54SZbgfbgZKlObmS.rQNd.Uhh8wnxOlPa7TrEE3FNt5G'),
(20, 5, 'Isabella', 'isabella@congo.com', '$2y$10$TV64a0TnpgyrNn5bK/5Hwue43iO2z0YfwYFPMBWwuqg4Va51HSYuq'),
(21, 6, 'Dylan', 'dylan@china.com', '$2y$10$IwSLWQ5n4xhHOYehvtVBvOd9atozeKweC6iF21cufZQtYLGks60iq'),
(22, 6, 'Andre', 'andre@china.com', '$2y$10$wWar1JhUDnKuCo2tLKm/h.DBz5sTzFX0/MiZHluraAAtLHCDS/GF6'),
(23, 6, 'Vitoria', 'vitoria@china.com', '$2y$10$n83hLaK1DRDnVb52NPs4x.FYLGCLeGV6wHPXto5Hl7P4.SLvmAx5q'),
(24, 6, 'Jaime', 'jaime@china.com', '$2y$10$frZIwKg5lXsStSwyrAyPq.i4RumNy3ZLHiQRu9oOhgaQ3yX4K1AsK');

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
(2, 'Estados Unidos da América', 'US'),
(3, 'Peru', 'PR'),
(4, 'Inglaterra', 'IG'),
(5, 'Congo', 'CN'),
(6, 'China', 'CH');

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
(1, 1, 'Jair Bolsonaro', 'bolsonaro@brasil.com', '$2y$10$3DEwaxgJTpmAZ..hftJwNuMj3nq4rPcYrZYtBVYMcNJRM8AhJiRaW'),
(2, 2, 'Donald Trump', 'trump@eua.com', '$2y$10$tfQ/j487K7rLbNYFtEZyh.dispjlpR0LfEqyKczrnyWUgDDMTIEV.'),
(3, 3, 'Martín Vizcarra', 'martin@peru.com', '$2y$10$z//k5vFGHGQQi3alF8ihNu1hYd85QMYtSQfjelArMZ15Lp91suxee'),
(4, 4, 'Elizabeth II', 'elizabeth@inglaterra.com', '$2y$10$l..56Mi02p2s.c5lNR/dwuzVj.6z7XV3OKC8pJveWbHRRm2KUXCx2'),
(5, 5, 'Denis Sassou Nguesso', 'denis@congo.com', '$2y$10$3kJdgLfKYvnJeSu4BNBhveAFfF3G6z5SUHkQNhqV4wHW6qriwCifC'),
(6, 6, 'Xi Jinping', 'xi@china.com', '$2y$10$5SnOrZBRxZ/LqjNQ0PzROeOc7JrPxprj6M8J9LCRi9SmUkzbtrkCW');

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
  `data_resultado` datetime DEFAULT NULL,
  `id_presidente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `id_deputado`, `id_pais`, `data_criacao`, `status`, `titulo`, `descricao`, `data_resultado`, `id_presidente`) VALUES
(1, NULL, 1, '2019-05-23 16:42:53', 0, 'Brasil 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie gravida lectus, sed mollis ante consequat imperdiet.', NULL, 1);

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
  MODIFY `id_deputado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `presidentes`
--
ALTER TABLE `presidentes`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

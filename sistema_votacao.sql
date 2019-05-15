-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Maio-2019 às 04:21
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
  `comentario` varchar(255) NOT NULL,
  `data_comentario` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deputados`
--

CREATE TABLE `deputados` (
  `id_deputado` int(11) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `id_presidente` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id_pais`, `id_presidente`, `nome`, `sigla`) VALUES
(3, 4, 'Brasil', 'BR'),
(4, 5, 'Estados Unidos', 'US'),
(5, 6, 'Peru', 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `presidentes`
--

CREATE TABLE `presidentes` (
  `id_presidente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `presidentes`
--

INSERT INTO `presidentes` (`id_presidente`, `nome`, `email`, `senha`) VALUES
(4, 'Eduardo Moreira', 'contato@eduardoem.com.br', '$2y$10$uZfudAja4LgJrbeNcSx3AuDEtKJ6h58E3xh6e62OhPM/WsS7Rjpr.'),
(5, 'Donald Trump', 'trump@teste.com', '$2y$10$h9SaqRm9BcELsHyMUDh37e8ecgR5idpfWgLCmX48KAD2mcB0uPWVq'),
(6, 'Presidente do Peru', 'peru@teste.com', '$2y$10$RLDME5HI8e6BrwMmpqPF9.QPYAlpi4zzzdA6/ax4EmmJWwtRUjd.O');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL,
  `id_deputado` int(11) DEFAULT NULL,
  `id_presidente` int(11) DEFAULT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0',
  `titulo` varchar(255) NOT NULL,
  `descricao` text,
  `imagem` varchar(255) NOT NULL,
  `data_resultado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos`
--

CREATE TABLE `votos` (
  `id_voto` int(11) NOT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `id_deputado` int(11) DEFAULT NULL,
  `aprovado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id_pais`),
  ADD KEY `id_presidente` (`id_presidente`);

--
-- Indexes for table `presidentes`
--
ALTER TABLE `presidentes`
  ADD PRIMARY KEY (`id_presidente`);

--
-- Indexes for table `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`),
  ADD KEY `id_deputado` (`id_deputado`),
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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deputados`
--
ALTER TABLE `deputados`
  MODIFY `id_deputado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `presidentes`
--
ALTER TABLE `presidentes`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limitadores para a tabela `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `projetos_ibfk_1` FOREIGN KEY (`id_deputado`) REFERENCES `deputados` (`id_deputado`),
  ADD CONSTRAINT `projetos_ibfk_2` FOREIGN KEY (`id_presidente`) REFERENCES `presidentes` (`id_presidente`);

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

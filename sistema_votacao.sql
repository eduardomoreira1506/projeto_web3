-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Maio-2019 às 22:47
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

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_deputado`, `id_presidente`, `id_projeto`, `comentario`, `data_comentario`) VALUES
(1, NULL, 1, 1, 'sacanagem hein meu!!!!', '2019-05-16 12:01:21'),
(2, NULL, 1, 1, 'donsaodnaodnsao', '2019-05-16 12:08:17'),
(3, NULL, 1, 1, 'dsadas', '2019-05-16 12:08:43'),
(4, NULL, 1, 1, 'dsadasdasdsa', '2019-05-16 12:08:50'),
(5, NULL, 1, 1, 'dsadsa', '2019-05-16 12:09:22'),
(6, NULL, 1, 1, 'dsadsa', '2019-05-16 12:10:28'),
(7, NULL, 1, 1, 'dsadsa', '2019-05-16 12:10:44'),
(8, 1, NULL, 8, 'é tiriricaaaaaa', '2019-05-16 17:49:04'),
(9, NULL, 1, 8, 'porra tiririca teu cu viadinho!', '2019-05-16 17:50:13'),
(10, NULL, 1, 8, 'dsadsa', '2019-05-16 19:48:36'),
(11, 3, NULL, 9, 'bodnsaosdnaodsa', '2019-05-16 21:40:06'),
(12, NULL, 4, 9, 'dsadsa', '2019-05-16 21:40:42');

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
(2, 3, 'Eduardo', 'eduardo@peru.com', '$2y$10$0H4E8IEPweoCwlkeYEdK9e9k5ArFgA.sJgFrR1KeoT2Y2V9YMx8du'),
(3, 4, 'Bruno', 'bruno@mexico.com', '$2y$10$XgTE34QTpQWYaHb53OqAIeqnnPEm9SYsUNUzH9I1SFdTzE7W1q6/O'),
(4, 4, 'Edu', 'edu@mexico.com', '$2y$10$T3qfhRCMOj03m2qjiuJ7TuhfHvaPaMP9wC2/UNBRwjNaAZw11M1Bi'),
(5, 4, 'Marcio', 'marcio@mexico.com', '$2y$10$kZaMPMghfEnZxXsaP.lZb.eYkOD9IwC5S8HCJ21TA9UYbjJKAtMKG');

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
(3, 'Peru', 'PR'),
(4, 'Mexico', 'ME');

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
(3, 3, 'Martín', 'martin@peru.com', '$2y$10$WYSOfnfjx4TbAj95sjUmz.0oU//YFH1BWSKKLg7sQ6OAjoMg0X5CG'),
(4, 4, 'Andrés Manuel López Obrador', 'andres@mexico.com', '$2y$10$fDVzinwSkkM3OnJWwV82oOSCnLV9p2M9Gf7PnRxjgLCE0Nm3jejMe');

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
(1, 1, 1, '2019-05-15 19:33:33', 2, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(2, 1, 1, '2019-05-15 19:33:39', 1, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(3, 1, 1, '2019-05-15 19:34:02', 2, 'Projeto de Guarapuava', 'Você já pensou em aliviar as dores do corpo e, ao mesmo tempo, praticar um dos esportes mais saudáveis do mundo? A Academia Primeiro Estilo oferece aulas de hidroterapia, que auxiliam diretamente no tratamento e no alívio de diversas dores do corpo.\r\n\r\n“A', NULL),
(4, 2, 3, '2019-05-15 21:10:53', 0, 'Abominação do Peru', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(5, 1, 1, '2019-05-15 21:31:15', 3, 'Noite do sol', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(6, 1, 1, '2019-05-15 21:31:26', 1, 'Manha', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(7, 1, 1, '2019-05-15 21:31:38', 2, 'Madrugada', 'El juez Jorge Chávez, titular del Tercer Juzgado de Investigación Preparatoria Especializado en Delitos de Corrupción, dictó prisión preventiva por 18 meses para el exgerente municipal José Miguel Castro por los aportes ilegales de OAS y Odebrecht a la campaña por el No a la revocatoria de la entonces alcaldesa de Lima, Susana Villarán (2013), y su reelección (2014).\r\n\r\nEn la audiencia judicial, la fiscal Ángela Zuloaga dijo que el exgerente municipal amenazaba a la empresa OAS para conseguir el dinero. \"Influía miedo para sus requerimientos\", manifestó.\r\n\r\nEl representante del Ministerio Público señaló también que dicha empresa brasileña entregó 3 millones de dólares para la campaña contra la revocatoria y 4 millones para su reelección, a cambio de ser favorecida en la concesión del proyecto Línea Amarilla.\r\n\r\nEn este caso también están implicados Gabriel Prado, exgerente de Seguridad Ciudadana; Luis Ernesto Gómez Cornejo Rotalde, César Simón Meiggs Rojas y Óscar Ricardo Vidaurreta Yzaga. La Fiscalía ha solicitado para todos ellos 36 meses de prisión preventiva.\r\n\r\nA todas estas personas se les acusa de integrar una red criminal que buscaba mantener en el poder a Susana Villarán, quien habría liderado la organización, para lo cual solicitaron aportes a las compañías brasileñas, quienes posteriormente serían beneficiadas en concesiones municipales.', NULL),
(8, 1, 1, '2019-05-16 12:51:26', 4, 'Produtos HMUL', 'HMULTI\r\n   \r\narray(11) { [\"cpf_cnpj\"]=> string(18) \"25.114.822/0001-24\" [\"razao_social\"]=> string(42) \"LICIANNE DE CASSIA LOPES SILVA 78932203253\" [\"tel\"]=> string(14) \"(91) 9813-7607\" [\"email\"]=> string(45) \"masilva_39@hotmail.com,nana.marcoos@gmail.com\" [\"cod_iugu\"]=> string(32) \"355C57567D014008A970C6DCCE732B0B\" [\"status\"]=> string(8) \"PENDENTE\" [\"referencia\"]=> string(10) \"27/05/2017\" [\"vencimento\"]=> string(10) \"06/07/2017\" [\"nomeFantasia\"]=> string(19) \"NORTE GPS UNIVERSAL\" [\"valorTotalFatura\"]=> string(18) \"1178.0999546051025\" [\"idFatura\"]=> string(4) \"5499\" }\r\nNORTE GPS UNIVERSAL\r\n   \r\narray(11) { [\"cpf_cnpj\"]=> string(18) \"25.114.822/0001-24\" [\"razao_social\"]=> string(42) \"LICIANNE DE CASSIA LOPES SILVA 78932203253\" [\"tel\"]=> string(14) \"(91) 9813-7607\" [\"email\"]=> string(45) \"masilva_39@hotmail.com,nana.marcoos@gmail.com\" [\"cod_iugu\"]=> string(32) \"355C57567D014008A970C6DCCE732B0B\" [\"status\"]=> string(8) \"PENDENTE\" [\"referencia\"]=> string(10) \"27/05/2017\" [\"vencimento\"]=> string(10) \"06/07/2017\" [\"nomeFantasia\"]=> string(19) \"NORTE GPS UNIVERSAL\" [\"valorTotalFatura\"]=> string(18) \"1178.0999546051025\" [\"idFatura\"]=> string(4) \"5499\" }\r\nNORTE GPS UNIVERSAL\r\n   \r\narray(11) { [\"cpf_cnpj\"]=> string(18) \"25.114.822/0001-24\" [\"razao_social\"]=> string(42) \"LICIANNE DE CASSIA LOPES SILVA 78932203253\" [\"tel\"]=> string(14) \"(91) 9813-7607\" [\"email\"]=> string(45) \"masilva_39@hotmail.com,nana.marcoos@gmail.com\" [\"cod_iugu\"]=> string(32) \"355C57567D014008A970C6DCCE732B0B\" [\"status\"]=> string(8) \"PENDENTE\" [\"referencia\"]=> string(10) \"27/05/2017\" [\"vencimento\"]=> string(10) \"06/07/2017\" [\"nomeFantasia\"]=> string(19) \"NORTE GPS UNIVERSAL\" [\"valorTotalFatura\"]=> string(18) \"1178.0999546051025\" [\"idFatura\"]=> string(4) \"5499\" }\r\nNORTE GPS UNIVERSAL\r\n   \r\narray(11) { [\"cpf_cnpj\"]=> string(18) \"25.114.822/0001-24\" [\"razao_social\"]=> string(42) \"LICIANNE DE CASSIA LOPES SILVA 78932203253\" [\"tel\"]=> string(14) \"(91) 9813-7607\" [\"email\"]=> string(45) \"masilva_39@hotmail.com,nana.marcoos@gmail.com\" [\"cod_iugu\"]=> string(32) \"355C57567D014008A970C6DCCE732B0B\" [\"status\"]=> string(8) \"PENDENTE\" [\"referencia\"]=> string(10) \"27/05/2017\" [\"vencimento\"]=> string(10) \"06/07/2017\" [\"nomeFantasia\"]=> string(19) \"NORTE GPS UNIVERSAL\" [\"valorTotalFatura\"]=> string(18) \"1178.0999546051025\" [\"idFatura\"]=> string(4) \"5499\" }\r\nNORTE GPS UNIVERSAL\r\n   \r\narray(11) { [\"cpf_cnpj\"]=> string(18) \"25.114.822/0001-24\" [\"razao_social\"]=> string(42) \"LICIANNE DE CASSIA LOPES SILVA 78932203253\" [\"tel\"]=> string(14) \"(91) 9813-7607\" [\"email\"]=> string(45) \"masilva_39@hotmail.com,nana.marcoos@gmail.com\" [\"cod_iugu\"]=> string(32) \"355C57567D014008A970C6DCCE732B0B\" [\"status\"]=> string(8) \"PENDENTE\" [\"referencia\"]=> string(10) \"27/05/2017\" [\"vencimento\"]=> string(10) \"06/07/2017\" [\"nomeFantasia\"]=> string(19) \"NORTE GPS UNIVERSAL\" [\"valorTotalFatura\"]=> string(18) \"1178.0999546051025\" [\"idFatura\"]=> string(4) \"5499\" }\r\nNORTE GPS UNIVERSAL', NULL),
(9, 3, 4, '2019-05-16 21:39:22', 2, 'Mexicooooo dsanod', 'Eleição\r\nDesde 1934, as eleições presidenciais ocorrem a cada seis anos, sendo completamente democráticas desde 1994. O presidente é eleito por sufrágio universal e direto para o mandato de seis anos conhecido popularmente como sexênio. Qualquer um dos candidatos que vencer uma simples pluralidade do voto nacional já é considerado eleito; tendo sido assim nas eleições de Carlos Salinas, Ernesto Zedillo, Vicente Fox, e Felipe Calderón. Desde a queda de Porfirio Díaz até 1929, o México não teve um sistema eleitoral democrático. Isto só se concretizou com a formação do Partido Revolucionário Institucional. Até 1988, o PRI instituiu um país unipartidário.\r\n\r\nExigências\r\nDe acordo com o Artigo nº 82 da Constituição mexicana, para se candidatar a Presidente o indivíduo necessita, entre outros:\r\n\r\nSer cidadão mexicano por nascimento e gozando de seus plenos direitos, filho de pai ou mãe mexicanos e residir no México nos últimos 20 anos;\r\nTer 35 (trinta e cinco) anos cumpridos à altura das eleições;\r\nTer residido no país no mínimo 1 ano antes do dia das eleições;\r\nNão pertencer ao clero nem ser ministro de culto;\r\nNão ocupar cargo público à época das eleições.\r\nPalácios presidenciais\r\nLos Pinos: Foi a residência oficial do presidente de 1935 a 2018, situada no centro do Bosque de Chapultepec, Cidade do México. Tornou-se a residência presidencial quando Lázaro Cárdenas recusou-se a residir no Castelo de Chapultepec, transformando este em sede do Museu Nacional de História.\r\nPalácio Nacional: É a sede do poder executivo e abriga as principais cerimônias oficias envolvendo o presidente. Foi durante o período do México colonial, a residência dos vice-reis.\r\nEx-presidentes\r\nO México possui seis ex-presidentes vivos. Os ex-presidentes permanecem com o tratamento de \"Presidente\" antes do primeiro nome e recebem uma pensão do Estado, sendo que podem a recusar. O único remanescente do governo de um ex-presidente é sua segurança, realizada pelo Estado Mayor Presidencial.', NULL),
(10, 1, 1, '2019-05-22 16:31:30', 0, 'dsaaaaaaaasdadsadsa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis, nibh vel sollicitudin malesuada, dolor ipsum pharetra augue, et maximus sapien ipsum nec augue. Proin sodales aliquam pellentesque. Sed dapibus ipsum nec dapibus cursus. Mauris eu volutpat ex. Donec tellus est, mollis nec porta a, egestas vulputate nibh. Aenean in ullamcorper risus. Nullam dolor dolor, congue at leo vitae, tristique volutpat urna. Vivamus non porttitor mauris. Sed quis hendrerit velit, ut mattis neque. Sed hendrerit ante a pellentesque euismod. Mauris tristique arcu ut hendrerit tristique. Phasellus ut odio lectus. Vivamus porttitor molestie varius. Mauris consectetur elit at congue ullamcorper. Sed ornare cursus mauris ac varius.\r\n\r\nNulla ut tempus magna. Suspendisse nec interdum sapien, sed fermentum augue. Nulla sit amet vehicula urna. Aliquam erat volutpat. Vivamus consectetur nisl egestas ipsum auctor, ut iaculis tellus ultrices. Phasellus vestibulum lobortis eleifend. Donec pharetra nisi sed blandit cursus. Nunc elementum sapien dui, sit amet vulputate erat tempor vel. Fusce sollicitudin congue efficitur. Donec eu neque eget metus fermentum semper a a ipsum.\r\n\r\nSed viverra hendrerit turpis, eget feugiat mauris lobortis sed. Phasellus justo enim, cursus ultrices enim ut, sollicitudin faucibus urna. Sed et justo leo. Etiam quis diam quis ante pharetra cursus. Nam molestie molestie placerat. Sed aliquam mauris nec interdum dictum. Nulla vestibulum nisl sit amet nisl ornare, sit amet tempor purus rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean ipsum tortor, tincidunt convallis purus ac, efficitur pulvinar nulla. Sed placerat tortor ac ligula tempor, ac pretium est finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nCurabitur et massa lacus. In ultrices enim ac semper malesuada. Morbi tempus orci sed ante finibus malesuada. Suspendisse rhoncus arcu nec tincidunt maximus. Nullam eu elit venenatis, tempor magna vitae, pharetra urna. Quisque imperdiet massa eu nisl aliquet, in rhoncus tellus interdum. Cras semper magna vel ornare auctor.\r\n\r\nInteger condimentum ut leo quis cursus. Etiam malesuada mi sit amet quam sagittis, sed eleifend arcu elementum. Etiam in felis tortor. Aenean placerat, eros sed commodo condimentum, nulla odio bibendum ligula, vel dapibus quam ex ut libero. Pellentesque enim odio, condimentum vel metus ut, accumsan malesuada ipsum. Nunc nec faucibus lorem, malesuada ultricies quam. Nunc pretium, ex non sodales posuere, erat ex malesuada enim, a dictum felis sapien sit amet diam. Pellentesque tincidunt magna sem, non dignissim elit elementum vitae. Sed efficitur porta quam, nec imperdiet arcu suscipit et.', NULL),
(11, 1, 1, '2019-05-22 16:31:55', 0, 'Titulo do projeto aqui', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis, nibh vel sollicitudin malesuada, dolor ipsum pharetra augue, et maximus sapien ipsum nec augue. Proin sodales aliquam pellentesque. Sed dapibus ipsum nec dapibus cursus. Mauris eu volutpat ex. Donec tellus est, mollis nec porta a, egestas vulputate nibh. Aenean in ullamcorper risus. Nullam dolor dolor, congue at leo vitae, tristique volutpat urna. Vivamus non porttitor mauris. Sed quis hendrerit velit, ut mattis neque. Sed hendrerit ante a pellentesque euismod. Mauris tristique arcu ut hendrerit tristique. Phasellus ut odio lectus. Vivamus porttitor molestie varius. Mauris consectetur elit at congue ullamcorper. Sed ornare cursus mauris ac varius.\r\n\r\nNulla ut tempus magna. Suspendisse nec interdum sapien, sed fermentum augue. Nulla sit amet vehicula urna. Aliquam erat volutpat. Vivamus consectetur nisl egestas ipsum auctor, ut iaculis tellus ultrices. Phasellus vestibulum lobortis eleifend. Donec pharetra nisi sed blandit cursus. Nunc elementum sapien dui, sit amet vulputate erat tempor vel. Fusce sollicitudin congue efficitur. Donec eu neque eget metus fermentum semper a a ipsum.\r\n\r\nSed viverra hendrerit turpis, eget feugiat mauris lobortis sed. Phasellus justo enim, cursus ultrices enim ut, sollicitudin faucibus urna. Sed et justo leo. Etiam quis diam quis ante pharetra cursus. Nam molestie molestie placerat. Sed aliquam mauris nec interdum dictum. Nulla vestibulum nisl sit amet nisl ornare, sit amet tempor purus rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean ipsum tortor, tincidunt convallis purus ac, efficitur pulvinar nulla. Sed placerat tortor ac ligula tempor, ac pretium est finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nCurabitur et massa lacus. In ultrices enim ac semper malesuada. Morbi tempus orci sed ante finibus malesuada. Suspendisse rhoncus arcu nec tincidunt maximus. Nullam eu elit venenatis, tempor magna vitae, pharetra urna. Quisque imperdiet massa eu nisl aliquet, in rhoncus tellus interdum. Cras semper magna vel ornare auctor.\r\n\r\nInteger condimentum ut leo quis cursus. Etiam malesuada mi sit amet quam sagittis, sed eleifend arcu elementum. Etiam in felis tortor. Aenean placerat, eros sed commodo condimentum, nulla odio bibendum ligula, vel dapibus quam ex ut libero. Pellentesque enim odio, condimentum vel metus ut, accumsan malesuada ipsum. Nunc nec faucibus lorem, malesuada ultricies quam. Nunc pretium, ex non sodales posuere, erat ex malesuada enim, a dictum felis sapien sit amet diam. Pellentesque tincidunt magna sem, non dignissim elit elementum vitae. Sed efficitur porta quam, nec imperdiet arcu suscipit et.', NULL),
(12, 1, 1, '2019-05-22 16:32:23', 0, 'Titulo sistema', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis, nibh vel sollicitudin malesuada, dolor ipsum pharetra augue, et maximus sapien ipsum nec augue. Proin sodales aliquam pellentesque. Sed dapibus ipsum nec dapibus cursus. Mauris eu volutpat ex. Donec tellus est, mollis nec porta a, egestas vulputate nibh. Aenean in ullamcorper risus. Nullam dolor dolor, congue at leo vitae, tristique volutpat urna. Vivamus non porttitor mauris. Sed quis hendrerit velit, ut mattis neque. Sed hendrerit ante a pellentesque euismod. Mauris tristique arcu ut hendrerit tristique. Phasellus ut odio lectus. Vivamus porttitor molestie varius. Mauris consectetur elit at congue ullamcorper. Sed ornare cursus mauris ac varius.\r\n\r\nNulla ut tempus magna. Suspendisse nec interdum sapien, sed fermentum augue. Nulla sit amet vehicula urna. Aliquam erat volutpat. Vivamus consectetur nisl egestas ipsum auctor, ut iaculis tellus ultrices. Phasellus vestibulum lobortis eleifend. Donec pharetra nisi sed blandit cursus. Nunc elementum sapien dui, sit amet vulputate erat tempor vel. Fusce sollicitudin congue efficitur. Donec eu neque eget metus fermentum semper a a ipsum.\r\n\r\nSed viverra hendrerit turpis, eget feugiat mauris lobortis sed. Phasellus justo enim, cursus ultrices enim ut, sollicitudin faucibus urna. Sed et justo leo. Etiam quis diam quis ante pharetra cursus. Nam molestie molestie placerat. Sed aliquam mauris nec interdum dictum. Nulla vestibulum nisl sit amet nisl ornare, sit amet tempor purus rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean ipsum tortor, tincidunt convallis purus ac, efficitur pulvinar nulla. Sed placerat tortor ac ligula tempor, ac pretium est finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nCurabitur et massa lacus. In ultrices enim ac semper malesuada. Morbi tempus orci sed ante finibus malesuada. Suspendisse rhoncus arcu nec tincidunt maximus. Nullam eu elit venenatis, tempor magna vitae, pharetra urna. Quisque imperdiet massa eu nisl aliquet, in rhoncus tellus interdum. Cras semper magna vel ornare auctor.\r\n\r\nInteger condimentum ut leo quis cursus. Etiam malesuada mi sit amet quam sagittis, sed eleifend arcu elementum. Etiam in felis tortor. Aenean placerat, eros sed commodo condimentum, nulla odio bibendum ligula, vel dapibus quam ex ut libero. Pellentesque enim odio, condimentum vel metus ut, accumsan malesuada ipsum. Nunc nec faucibus lorem, malesuada ultricies quam. Nunc pretium, ex non sodales posuere, erat ex malesuada enim, a dictum felis sapien sit amet diam. Pellentesque tincidunt magna sem, non dignissim elit elementum vitae. Sed efficitur porta quam, nec imperdiet arcu suscipit et.', NULL),
(13, 1, 1, '2019-05-22 16:32:33', 0, 'TIdjsao', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis, nibh vel sollicitudin malesuada, dolor ipsum pharetra augue, et maximus sapien ipsum nec augue. Proin sodales aliquam pellentesque. Sed dapibus ipsum nec dapibus cursus. Mauris eu volutpat ex. Donec tellus est, mollis nec porta a, egestas vulputate nibh. Aenean in ullamcorper risus. Nullam dolor dolor, congue at leo vitae, tristique volutpat urna. Vivamus non porttitor mauris. Sed quis hendrerit velit, ut mattis neque. Sed hendrerit ante a pellentesque euismod. Mauris tristique arcu ut hendrerit tristique. Phasellus ut odio lectus. Vivamus porttitor molestie varius. Mauris consectetur elit at congue ullamcorper. Sed ornare cursus mauris ac varius.\r\n\r\nNulla ut tempus magna. Suspendisse nec interdum sapien, sed fermentum augue. Nulla sit amet vehicula urna. Aliquam erat volutpat. Vivamus consectetur nisl egestas ipsum auctor, ut iaculis tellus ultrices. Phasellus vestibulum lobortis eleifend. Donec pharetra nisi sed blandit cursus. Nunc elementum sapien dui, sit amet vulputate erat tempor vel. Fusce sollicitudin congue efficitur. Donec eu neque eget metus fermentum semper a a ipsum.\r\n\r\nSed viverra hendrerit turpis, eget feugiat mauris lobortis sed. Phasellus justo enim, cursus ultrices enim ut, sollicitudin faucibus urna. Sed et justo leo. Etiam quis diam quis ante pharetra cursus. Nam molestie molestie placerat. Sed aliquam mauris nec interdum dictum. Nulla vestibulum nisl sit amet nisl ornare, sit amet tempor purus rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean ipsum tortor, tincidunt convallis purus ac, efficitur pulvinar nulla. Sed placerat tortor ac ligula tempor, ac pretium est finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nCurabitur et massa lacus. In ultrices enim ac semper malesuada. Morbi tempus orci sed ante finibus malesuada. Suspendisse rhoncus arcu nec tincidunt maximus. Nullam eu elit venenatis, tempor magna vitae, pharetra urna. Quisque imperdiet massa eu nisl aliquet, in rhoncus tellus interdum. Cras semper magna vel ornare auctor.\r\n\r\nInteger condimentum ut leo quis cursus. Etiam malesuada mi sit amet quam sagittis, sed eleifend arcu elementum. Etiam in felis tortor. Aenean placerat, eros sed commodo condimentum, nulla odio bibendum ligula, vel dapibus quam ex ut libero. Pellentesque enim odio, condimentum vel metus ut, accumsan malesuada ipsum. Nunc nec faucibus lorem, malesuada ultricies quam. Nunc pretium, ex non sodales posuere, erat ex malesuada enim, a dictum felis sapien sit amet diam. Pellentesque tincidunt magna sem, non dignissim elit elementum vitae. Sed efficitur porta quam, nec imperdiet arcu suscipit et.', NULL);

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
(1, 7, 1, 1),
(2, 5, 1, 0),
(3, 1, 1, 1),
(4, 3, 1, 1),
(5, 9, 3, 1),
(6, 9, 5, 1),
(7, 9, 4, 0);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deputados`
--
ALTER TABLE `deputados`
  MODIFY `id_deputado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `presidentes`
--
ALTER TABLE `presidentes`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

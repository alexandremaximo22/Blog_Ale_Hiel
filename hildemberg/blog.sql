-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3310
-- Tempo de geração: 25-Abr-2024 às 22:05
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL,
  `data` text NOT NULL,
  `hora` text NOT NULL,
  `likePost` int(11) NOT NULL,
  `DesLike` int(11) NOT NULL,
  `RA` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `post`, `data`, `hora`, `likePost`, `DesLike`, `RA`) VALUES
(1, 'PHP é a melho linguagem de programação', '21-04-2024', '16:15', 203, 35, '2806'),
(2, 'JavaScript é muito fácil!!!', '22-04-2024', '12:30', 39, 16, '2806'),
(4, 'Programando com JavaScript e PHP!', '24-04-2024', '16:34:38', 9, 8, '972244'),
(5, 'Conteúdo do post', '2024-04-25', '12:00:00', 3, 3, '822729'),
(6, 'teste', '25/04/2024', '14:57', 4, 3, '2806'),
(7, 'Evitando bugs no banco de dados...será que deu certo?!', '25-04-2024', '15:02:32', 10, 6, '972244'),
(8, 'Ordenando posts via SQL ', '25-04-2024', '15:06:23', 6, 2, '972244'),
(9, 'TestAlex', '2024-04-25', '16:34', 7, 8, '979675'),
(9, 'TestAlex', '2024-04-25', '16:34', 7, 8, '979675'),
(10, 'hildemberg 1', '2024-04-11', '16:34', 0, 0, '822729'),
(10, 'hildemberg 1', '2024-04-11', '16:34', 0, 0, '822729'),
(0, 'Estou pensando no Cosme cabeludo', '2024-04-25', '12:00:00', 0, 0, ''),
(12, 'sdsdsd', '2024-04-09', '18:48', 0, 0, '4785'),
(12, 'sdsdsd', '2024-04-09', '18:48', 0, 0, '4785'),
(13, 'mouse do jose', '2024-04-09', '18:48', 0, 0, '4785'),
(13, 'mouse do jose', '2024-04-09', '18:48', 0, 0, '4785'),
(14, 'Fagammon', '2024-04-26', '19:54', 0, 0, '1257'),
(14, 'Fagammon', '2024-04-26', '19:54', 0, 0, '1257'),
(15, 'testecaio ', '2024-04-25', '16:56', 0, 0, '979881'),
(16, 'Fagammon 24', '2024-04-26', '19:54', 0, 0, '1257'),
(16, 'Fagammon 24', '2024-04-26', '19:54', 0, 0, '1257'),
(17, 'Garrafa de Suco', '2024-04-26', '22:04', 0, 0, '99999999'),
(17, 'Garrafa de Suco', '2024-04-26', '22:04', 0, 0, '99999999');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

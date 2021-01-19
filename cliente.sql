-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jan-2021 às 05:12
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cuco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `datacriacao` timestamp NULL DEFAULT current_timestamp(),
  `fdeletado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `telefone`, `datanascimento`, `datacriacao`, `fdeletado`) VALUES
(9, 'Jhow', '321.498.798-79', '(35) 9706-7711', '1990-03-21', '2021-01-19 01:59:53', NULL),
(10, 'arthur', '456.789.123-99', '(97) 0677-1133', '2020-04-18', '2021-01-19 02:03:24', NULL),
(11, 'teste', '387.469.028-80', '(35) 9706-7711', '2021-01-18', '2021-01-19 02:16:23', 1),
(12, 'JOSE', '222.333.798-99', '(35) 9706-5544', '1988-03-11', '2021-01-19 03:43:09', NULL),
(13, 'ARIMATEIA', '222.333.798-99', '(35) 9706-5544', '1988-03-11', '2021-01-19 03:44:04', NULL),
(14, 'RAFAEL', '222.333.798-99', '(35) 9706-5544', '1988-03-11', '2021-01-19 03:51:03', NULL),
(15, 'JOAQUINA', '222.333.798-99', '(35) 9706-5544', '1988-03-11', '2021-01-19 03:52:21', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

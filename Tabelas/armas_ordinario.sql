-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 12-Out-2021 às 14:19
-- Versão do servidor: 8.0.17
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_pm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `armas_ordinario`
--

CREATE TABLE `armas_ordinario` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `MARCA` text,
  `MODELO` text,
  `n_serie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `PATR` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `LOCALIZAÇÃO` text,
  `SITUAÇÃO` text,
  `CAUTELA` text,
  `OBS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `armas_ordinario`
--
ALTER TABLE `armas_ordinario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `armas_ordinario`
--
ALTER TABLE `armas_ordinario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Dez-2024 às 15:24
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola_horarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_horarios`
--

CREATE TABLE `tb_horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_materia` bigint(20) UNSIGNED NOT NULL,
  `id_professor` bigint(20) UNSIGNED NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_horarios`
--

INSERT INTO `tb_horarios` (`id`, `id_materia`, `id_professor`, `hora_inicio`, `hora_fim`) VALUES
(1, 1, 1, '11:17:00', '12:17:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_materias`
--

CREATE TABLE `tb_materias` (
  `id_materia` bigint(20) UNSIGNED NOT NULL,
  `nome_materia` varchar(80) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_materias`
--

INSERT INTO `tb_materias` (`id_materia`, `nome_materia`, `id_professor`) VALUES
(1, 'ATEMATICA', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professores`
--

CREATE TABLE `tb_professores` (
  `id_professores` bigint(20) UNSIGNED NOT NULL,
  `nome_professores` varchar(65) DEFAULT NULL,
  `sobrenome_professores` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_professores`
--

INSERT INTO `tb_professores` (`id_professores`, `nome_professores`, `sobrenome_professores`) VALUES
(1, 'J0ORGE', 'KAKA');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materia` (`id_materia`),
  ADD KEY `fk_professor` (`id_professor`);

--
-- Índices para tabela `tb_materias`
--
ALTER TABLE `tb_materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Índices para tabela `tb_professores`
--
ALTER TABLE `tb_professores`
  ADD PRIMARY KEY (`id_professores`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_materias`
--
ALTER TABLE `tb_materias`
  MODIFY `id_materia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_professores`
--
ALTER TABLE `tb_professores`
  MODIFY `id_professores` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  ADD CONSTRAINT `fk_materia` FOREIGN KEY (`id_materia`) REFERENCES `tb_materias` (`id_materia`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_professor` FOREIGN KEY (`id_professor`) REFERENCES `tb_professores` (`id_professores`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

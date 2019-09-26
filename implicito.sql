-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Set-2019 às 13:47
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `implicito`
--

CREATE TABLE `implicito` (
  `idExplicito` int(11) NOT NULL,
  `tempo_b1` float NOT NULL,
  `erros_b1` int(11) NOT NULL,
  `tempo_b2` float NOT NULL,
  `erros_b2` int(11) NOT NULL,
  `tempo_b3` float NOT NULL,
  `erros_b3` int(11) NOT NULL,
  `tempos_b4` float NOT NULL,
  `erros_b4` int(11) NOT NULL,
  `tempo_b5` float NOT NULL,
  `erros_b5` int(11) NOT NULL,
  `tempo_b6` float NOT NULL,
  `erros_b6` int(11) NOT NULL,
  `tempo_b7` float NOT NULL,
  `erros_b7` int(11) NOT NULL,
  `score` float NOT NULL,
  `severity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `implicito`
--
ALTER TABLE `implicito`
  ADD PRIMARY KEY (`idExplicito`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `implicito`
--
ALTER TABLE `implicito`
  ADD CONSTRAINT `fk_implicito` FOREIGN KEY (`idExplicito`) REFERENCES `explicito` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Set-2019 às 02:56
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
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `modalidade`) VALUES
(1, 'Agronegócio', 1),
(2, 'Agronomia', 1),
(3, 'Cooperativismo', 1),
(4, 'Engenharia Agrícola e Ambiental', 1),
(5, 'Engenharia Florestal', 1),
(6, 'Zootecnia', 1),
(7, 'Bioquímica', 1),
(8, 'Ciências Biológicas - Bacharelado', 1),
(9, 'Ciências Biológicas - Licenciatura', 1),
(10, 'Educação Física - Bacharelado', 1),
(11, 'Educação Física - Licenciatura', 1),
(12, 'Enfermagem', 1),
(13, 'Medicina', 1),
(14, 'Medicina Veterinária', 1),
(15, 'Nutrição', 1),
(16, 'Arquitetura e Urbanismo', 1),
(17, 'Ciência da Computação', 1),
(18, 'Ciência e Tecnologia de Laticínios', 1),
(19, 'Engenharia Ambiental', 1),
(20, 'Engenharia Civil', 1),
(21, 'Engenharia de Agrimensura e Cartográfica', 1),
(22, 'Engenharia de Alimentos', 1),
(23, 'Engenharia de Produção', 1),
(24, 'Engenharia Elétrica', 1),
(25, 'Engenharia Mecânica', 1),
(26, 'Engenharia Química', 1),
(27, 'Física - Bacharelado', 1),
(28, 'Física - Licenciatura', 1),
(29, 'Matemática - Bacharelado', 1),
(30, 'Matemática - Licenciatura', 1),
(31, 'Química - Licenciatura', 1),
(32, 'Química - Bacharelado', 1),
(33, 'Administração', 1),
(34, 'Ciências Contábeis', 1),
(35, 'Ciências Econômicas', 1),
(36, 'Ciências Sociais - Licenciatura', 1),
(37, 'Ciências Sociais - Bacharelado', 1),
(38, 'Comunicação Social - Jornalismo', 1),
(39, 'Dança - Bacharelado', 1),
(40, 'Dança - Licenciatura', 1),
(41, 'Direito', 1),
(42, 'Economia Doméstica', 1),
(43, 'Educação do Campo', 1),
(44, 'Educação Infantil', 1),
(45, 'Geografia - Bacharelado', 1),
(46, 'Geografia - Licenciatura', 1),
(47, 'História - Bacharelado', 1),
(48, 'História - Licenciatura', 1),
(49, 'Pedagogia', 1),
(50, 'Secretariado Executivo Trilingue', 1),
(51, 'Serviço Social', 1),
(52, 'Tecnologia em Gestão Ambiental', 1),
(53, 'Ciências Biológicas (Ênfase em Conservação da Biodiversidade)', 1),
(54, 'Ciências de Alimentos', 1),
(55, 'Química (Ênfase em Química Ambiental)', 1),
(56, 'Sistemas de Informação', 1),
(57, 'Mestrado em Administração', 2),
(58, 'Mestrado em Agroecologia', 2),
(59, 'Mestrado em Agroquímica', 2),
(60, 'Mestrado em Arquitetura e Urbanismo', 2),
(61, 'Mestrado em Biologia', 2),
(62, 'Mestrado em Biologia Celular e Estrutural', 2),
(63, 'Mestrado em Bioquímica Aplicada', 2),
(64, 'Mestrado em Botânica', 2),
(65, 'Mestrado em Ciência da Computação', 2),
(66, 'Mestrado em Ciência da Nutrição', 2),
(67, 'Mestrado Profissional em Ciência da Saúde', 2),
(68, 'Mestrado em Ciência e Tecnologia de Alimentos', 2),
(69, 'Mestrado em Ciência Florestal', 2),
(70, 'Mestrado Profissional em Defesa Sanitária Vegetal', 2),
(71, 'Mestrado em Ecologia', 2),
(72, 'Mestrado em Economia', 2),
(73, 'Mestrado em Economia Aplicada', 2),
(74, 'Mestrado em Economia Doméstica', 2),
(75, 'Mestrado em Educação', 2),
(76, 'Mestrado em Educação Física', 2),
(77, 'Mestrado em Engenharia Agrícola', 2),
(78, 'Mestrado em Engenharia Civil', 2),
(79, 'Mestrado em Engenharia Química', 2),
(80, 'Mestrado em Entomologia', 2),
(81, 'Mestrado em Estatística Aplicada e Biometria', 2),
(82, 'Mestrado em Extensão Rural', 2),
(83, 'Mestrado em Ensino em Física', 2),
(84, 'Mestrado em Física', 2),
(85, 'Mestrado em Fisiologia Vegetal', 2),
(86, 'Mestrado em Fitopatologia', 2),
(87, 'Mestrado em Fitotecnia', 2),
(88, 'Mestrado em Genética e Melhoramento', 2),
(89, 'Mestrado em Geografia', 2),
(90, 'Mestrado em Letras', 2),
(91, 'Mestrado em Matemática', 2),
(92, 'Mestrado em Medicina Veterinária', 2),
(93, 'Mestrado em Meteorologia Aplicada', 2),
(94, 'Mestrado em Microbiologia Agrícola', 2),
(95, 'Multicêntrico em Química de Minas Gerais', 2),
(96, 'Mestrado Profissional em Patrimônio Cultural, Paisagens e Cidadania', 2),
(97, 'Mestrado em Solos e Nutrição de Plantas', 2),
(98, 'Mestrado em Zootecnia', 2),
(99, 'Doutorado em Administração', 2),
(100, 'Doutorado em Agroquímica', 2),
(101, 'Doutorado em Arquitetura e Urbanismo', 2),
(102, 'Doutorado em Biologia Animal', 2),
(103, 'Doutorado em Biologia Celular e Estrutural', 2),
(104, 'Doutorado em Bioquímica Aplicada', 2),
(105, 'Doutorado em Botânica', 2),
(106, 'Doutorado em Ciência da Computação', 2),
(107, 'Doutorado em Ciência da Nutrição', 2),
(108, 'Doutorado em Ciência e Tecnologia de Alimentos', 2),
(109, 'Doutorado em Ciência Florestal', 2),
(110, 'Doutorado em Ecologia', 2),
(111, 'Doutorado em Economia Aplicada', 2),
(112, 'Doutorado em Economia Doméstica', 2),
(113, 'Doutorado em Educação Física', 2),
(114, 'Doutorado em Engenharia Agrícola', 2),
(115, 'Doutorado em Engenharia Civil', 2),
(116, 'Doutorado em Entomologia', 2),
(117, 'Doutorado em Estatística Aplicada e Biometria', 2),
(118, 'Doutorado em Extensão Rural', 2),
(119, 'Doutorado em Física', 2),
(120, 'Doutorado em Fisiologia Vegetal', 2),
(121, 'Doutorado em Fitopatologia', 2),
(122, 'Doutorado em Fitotecnia', 2),
(123, 'Doutorado em Genética e Melhoramento', 2),
(124, 'Doutorado em Medicina Veterinária', 2),
(125, 'Doutorado em Meteorologia Aplicada', 2),
(126, 'Doutorado em Microbiologia Agrícola', 2),
(127, 'Doutorado em Solos e Nutrição de Plantas', 2),
(128, 'Doutorado em Zootecnia', 2),
(129, 'Mestrado em Biologia Animal', 2),
(130, 'Mestrado Profissional em Química em Rede Nacional', 2),
(131, 'Mestrado Profissional em Tecnologia e Celulose de Papel', 2),
(132, 'Mestrado Profissional em Zootecnia', 2),
(133, 'Mestrado em Agronomia (Produção Vegetal)', 2),
(134, 'Mestrado Profissional em Administração Pública em Rede Nacional - PROFIAP', 2),
(135, 'Manejo e Conservação de Ecossistemas Naturais e Agrários', 2),
(136, 'Mestrado Profissional em Matemática em Rede Nacional', 2),
(137, 'Biologia Molecular Aplicada às Análises Químicas', 3),
(138, 'Futebol', 3),
(139, 'Gestão de Produção', 3),
(140, 'Gestão de Cooperativas', 3),
(141, 'Gestão do Agronegócio', 3),
(142, 'Residência em Medicina Veterinária', 3),
(143, 'Tecnologia de Celulose e Papel', 3),
(144, 'Automação e Controle de Processos Agrícolas e Industriais', 3),
(145, 'Proteção de Plantas', 3),
(146, 'Recuperação de Áreas Degradadas', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `explicito`
--

CREATE TABLE `explicito` (
  `id` int(11) NOT NULL,
  `sexo` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `idade` int(11) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `q6` varchar(100) NOT NULL,
  `q7` varchar(100) NOT NULL,
  `q8` varchar(100) NOT NULL,
  `q9` varchar(100) NOT NULL,
  `q10a` varchar(100) NOT NULL,
  `q10b` varchar(100) NOT NULL,
  `q10c` varchar(100) NOT NULL,
  `q10d` varchar(100) NOT NULL,
  `q10e` varchar(100) NOT NULL,
  `q10f` varchar(100) NOT NULL,
  `q11a` varchar(100) NOT NULL,
  `q11b` varchar(100) NOT NULL,
  `q11c` varchar(100) NOT NULL,
  `genero` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `explicito`
--

INSERT INTO `explicito` (`id`, `sexo`, `curso`, `idade`, `cor`, `q6`, `q7`, `q8`, `q9`, `q10a`, `q10b`, `q10c`, `q10d`, `q10e`, `q10f`, `q11a`, `q11b`, `q11c`, `genero`) VALUES
(1, 1, 17, 0, 'Branca', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(2, 0, 2, 11, 'Parda', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(3, 0, 33, 50, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(4, 0, 33, 18, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(5, 0, 33, 20, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(6, 0, 33, 10, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(7, 0, 33, 20, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino'),
(8, 0, 33, 1, 'Preta', 'Fortemente masculino', 'Fortemente masculino', 'Gosto Muito', 'Gosto Muito', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Extremamente importante', 'Se identifica fortemente com o masculino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavras`
--

CREATE TABLE `palavras` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavras`
--

INSERT INTO `palavras` (`id`, `nome`, `categoria`) VALUES
(1, 'homem', 1),
(2, 'filho', 1),
(3, 'menino', 1),
(4, 'tio', 1),
(5, 'marido', 1),
(6, 'ele', 1),
(7, 'dele', 1),
(8, 'mulher', 2),
(9, 'filha', 2),
(10, 'menina', 2),
(11, 'tia', 2),
(12, 'esposa', 2),
(13, 'ela', 2),
(14, 'dela', 2),
(15, 'matemática', 3),
(16, 'engenharia', 3),
(17, 'física', 3),
(18, 'astronomia', 3),
(19, 'química', 3),
(20, 'geologia', 3),
(21, 'estatística', 3),
(22, 'português', 4),
(23, 'literatura', 4),
(24, 'filosofia', 4),
(25, 'história', 4),
(26, 'sociologia', 4),
(27, 'pedagogia', 4),
(28, 'jornalismo', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explicito`
--
ALTER TABLE `explicito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curso` (`curso`);

--
-- Indexes for table `palavras`
--
ALTER TABLE `palavras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `explicito`
--
ALTER TABLE `explicito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `palavras`
--
ALTER TABLE `palavras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `explicito`
--
ALTER TABLE `explicito`
  ADD CONSTRAINT `fk_curso` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

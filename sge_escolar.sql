-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Maio-2020 às 18:41
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sgescolar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
`idAluno` int(11) NOT NULL,
  `cod_aluno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idClasse` int(11) NOT NULL,
  `idPessoa` int(11) NOT NULL,
  `data_registo_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `cod_aluno`, `idClasse`, `idPessoa`, `data_registo_alteracao`) VALUES
(7, '003433824HO034', 1, 25, '2020-04-22 20:48:09'),
(8, '55555555BO555', 2, 28, '2020-04-22 20:48:09'),
(10, '003433824HO034', 2, 25, '2020-04-22 20:48:09'),
(11, '5555', 2, 28, '2020-04-23 18:24:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
`idClasse` int(11) NOT NULL,
  `designacao` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor_propina` float DEFAULT NULL,
  `valor_matricula` float DEFAULT NULL,
  `valor_confirmacao` float DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  `data_registo_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`idClasse`, `designacao`, `valor_propina`, `valor_matricula`, `valor_confirmacao`, `idHorario`, `data_registo_alteracao`) VALUES
(1, 'Pre-Escolar', 2000, 2000, 1000, NULL, '2020-04-22 20:45:34'),
(2, '2', 2000, 2000, 1000, NULL, '2020-04-22 20:45:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe_tem_disciplina`
--

CREATE TABLE IF NOT EXISTS `classe_tem_disciplina` (
  `idClasse` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
`idDisciplina` int(11) NOT NULL,
  `designacao` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE IF NOT EXISTS `funcao` (
`idFuncao` int(11) NOT NULL,
  `designacao` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`idFuncao`, `designacao`) VALUES
(1, 'DIRECTOR '),
(2, 'SUBD.PEDAGOGICO'),
(3, 'SUBD.ADMINISTRATIVO'),
(4, 'PROFESSOR'),
(5, 'FINANCA'),
(6, 'SEC.PEDAGOGICA'),
(7, 'SEC.ADMINISTRATIVO'),
(8, 'AUX.LIMPEZA'),
(9, 'AG.SEGURANCA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
`idFuncionario` int(11) NOT NULL,
  `num_identif` int(11) NOT NULL,
  `salario` float DEFAULT NULL,
  `inicio_funcao` date DEFAULT NULL,
  `data_registo` datetime NOT NULL,
  `idFuncao` int(11) NOT NULL,
  `idPessoa` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `num_identif`, `salario`, `inicio_funcao`, `data_registo`, `idFuncao`, `idPessoa`) VALUES
(2, 12020, NULL, NULL, '2020-03-21 12:39:27', 1, 1),
(3, 55555, NULL, NULL, '2020-03-26 10:32:42', 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
`idHorario` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corpo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rodape` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
`idMatricula` int(11) NOT NULL,
  `num_processo` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `tipo` enum('ANTIGA','NOVA') COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL,
  `idAluno` int(11) NOT NULL,
  `data_registo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`idMatricula`, `num_processo`, `ano_lectivo`, `tipo`, `valor`, `idAluno`, `data_registo`) VALUES
(11, '003433824HO0342020', 2020, 'ANTIGA', 1500, 7, '2020-04-22 20:08:16'),
(12, '55555555BO5552020', 2020, 'ANTIGA', 1500, 8, '2020-05-02 16:39:39'),
(14, '003433824HO0342021', 2021, 'ANTIGA', 0, 7, '2020-04-19 19:30:42'),
(15, '55555555BO5552020', 2021, 'ANTIGA', 0, 8, '2020-05-02 17:00:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE IF NOT EXISTS `morada` (
`idMorada` int(11) NOT NULL,
  `municipio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `casa_num` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`idMorada`, `municipio`, `bairro`, `rua`, `casa_num`) VALUES
(2, 'CACUACO', 'BOA ESPERANÇA', 'BANCO BFA', NULL),
(3, 'CACUACO', 'IBA', 'IBA', NULL),
(38, 'CACUACO', 'CERAMICA', 'BALUMUKA', 0),
(42, 'CACUACO', 'IMBONDEIROS', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento_propina`
--

CREATE TABLE IF NOT EXISTS `pagamento_propina` (
`idPagamento_Propina` int(11) NOT NULL,
  `mes` enum('JANEIRO','FEVEREIRO','MARCO','ABRIL','MAIO','JUNHO','JULHO','AGOSTO','SETEMBRO','OUTUBRO','NOVEMBRO','DEZEMBRO') COLLATE utf8_unicode_ci NOT NULL,
  `obs` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_pagamento` datetime NOT NULL,
  `idAluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pauta`
--

CREATE TABLE IF NOT EXISTS `pauta` (
`idPauta` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `corpo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rodape` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `data_actualizacao` datetime NOT NULL,
  `idAluno` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idFuncionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
`idPessoa` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nome_pai` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nome_mae` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascim` date NOT NULL,
  `genero` enum('MASCULINO','FEMININO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `naturalidade` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bi_cp` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idMorada` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idPessoa`, `nome`, `sobrenome`, `nome_pai`, `nome_mae`, `data_nascim`, `genero`, `naturalidade`, `bi_cp`, `telefone`, `foto`, `idMorada`) VALUES
(1, 'Euclides', 'Jorge', 'Jorge Paulo', 'Ana Fernando', '1999-08-21', 'MASCULINO', 'Uíge', '000065324UE021', '912468075', NULL, 2),
(2, 'António ', 'Pedro', 'Pedro Simão', 'Joana Tomás', '1989-08-12', 'MASCULINO', 'Luanda', '005555343LA041', '922222222', NULL, 3),
(25, 'PAULO', 'CARLOS', 'CARLOS PAULO', 'LAURETA JOVITA', '1989-08-23', 'MASCULINO', 'BAILUNDO', '003433824HO034', '925 491 439', NULL, 38),
(28, 'ELIAS', 'AVELINO', 'CARLOS PAULO', 'LAURETA JOVITA', '2004-11-10', NULL, 'BAILUNDO', '55555555BO555', '925 491 439', NULL, 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
`idTurma` int(11) NOT NULL,
  `designacao` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `director_turma` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idClasse` int(11) NOT NULL,
  `turno` enum('MANHA','TARDE') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE IF NOT EXISTS `utilizador` (
`idUtilizador` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `backup` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idFuncionario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`idUtilizador`, `username`, `password`, `backup`, `idFuncionario`) VALUES
(1, 'euc.lides', '9ca88cf6af4cf2943773d33b2ad290269cb79b6f05b3b37fc4c7a471e21848b6', NULL, 2),
(2, 'antonio.pedro', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
 ADD PRIMARY KEY (`idAluno`), ADD KEY `fk_Aluno_Classe1_idx` (`idClasse`), ADD KEY `fk_Aluno_Pessoa1_idx` (`idPessoa`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
 ADD PRIMARY KEY (`idClasse`), ADD KEY `fk_Classe_Horario1_idx` (`idHorario`);

--
-- Indexes for table `classe_tem_disciplina`
--
ALTER TABLE `classe_tem_disciplina`
 ADD PRIMARY KEY (`idClasse`,`idDisciplina`), ADD KEY `fk_Classe_has_Disciplina_Disciplina1_idx` (`idDisciplina`), ADD KEY `fk_Classe_has_Disciplina_Classe1_idx` (`idClasse`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
 ADD PRIMARY KEY (`idDisciplina`);

--
-- Indexes for table `funcao`
--
ALTER TABLE `funcao`
 ADD PRIMARY KEY (`idFuncao`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`idFuncionario`), ADD KEY `fk_Funcionario_Funcao_idx` (`idFuncao`), ADD KEY `fk_Funcionario_Pessoa1_idx` (`idPessoa`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
 ADD PRIMARY KEY (`idHorario`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
 ADD PRIMARY KEY (`idMatricula`), ADD KEY `fk_Matricula_Aluno1_idx` (`idAluno`);

--
-- Indexes for table `morada`
--
ALTER TABLE `morada`
 ADD PRIMARY KEY (`idMorada`);

--
-- Indexes for table `pagamento_propina`
--
ALTER TABLE `pagamento_propina`
 ADD PRIMARY KEY (`idPagamento_Propina`), ADD KEY `fk_Pagamento_Propina_Aluno1_idx` (`idAluno`);

--
-- Indexes for table `pauta`
--
ALTER TABLE `pauta`
 ADD PRIMARY KEY (`idPauta`), ADD KEY `fk_Pauta_Aluno1_idx` (`idAluno`), ADD KEY `fk_Pauta_Disciplina1_idx` (`idDisciplina`), ADD KEY `fk_Pauta_Funcionario1_idx` (`idFuncionario`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
 ADD PRIMARY KEY (`idPessoa`), ADD KEY `fk_Pessoa_Morada1_idx` (`idMorada`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
 ADD PRIMARY KEY (`idTurma`), ADD KEY `fk_Turma_Classe1_idx` (`idClasse`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
 ADD PRIMARY KEY (`idUtilizador`), ADD KEY `fk_Utilizador_Funcionario1_idx` (`idFuncionario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
MODIFY `idAluno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
MODIFY `idFuncao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `morada`
--
ALTER TABLE `morada`
MODIFY `idMorada` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `pagamento_propina`
--
ALTER TABLE `pagamento_propina`
MODIFY `idPagamento_Propina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pauta`
--
ALTER TABLE `pauta`
MODIFY `idPauta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
MODIFY `idUtilizador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
ADD CONSTRAINT `fk_Aluno_Classe1` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Aluno_Pessoa1` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `classe`
--
ALTER TABLE `classe`
ADD CONSTRAINT `fk_Classe_Horario1` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `classe_tem_disciplina`
--
ALTER TABLE `classe_tem_disciplina`
ADD CONSTRAINT `fk_Classe_has_Disciplina_Classe1` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Classe_has_Disciplina_Disciplina1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
ADD CONSTRAINT `fk_Funcionario_Funcao` FOREIGN KEY (`idFuncao`) REFERENCES `funcao` (`idFuncao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Funcionario_Pessoa1` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
ADD CONSTRAINT `fk_Matricula_Aluno1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pagamento_propina`
--
ALTER TABLE `pagamento_propina`
ADD CONSTRAINT `fk_Pagamento_Propina_Aluno1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pauta`
--
ALTER TABLE `pauta`
ADD CONSTRAINT `fk_Pauta_Aluno1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Pauta_Disciplina1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Pauta_Funcionario1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
ADD CONSTRAINT `fk_Pessoa_Morada1` FOREIGN KEY (`idMorada`) REFERENCES `morada` (`idMorada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
ADD CONSTRAINT `fk_Turma_Classe1` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
ADD CONSTRAINT `fk_Utilizador_Funcionario1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

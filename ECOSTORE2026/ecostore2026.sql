-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/06/2026 às 02:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecostore2026`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `statusPedido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idProduto`, `idUsuario`, `preco`, `data`, `statusPedido`) VALUES
(4, 7, 3, 3.00, '0000-00-00', 'Entregue'),
(15, 6, 2, 5.00, '0000-00-00', 'em processamento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL,
  `fotoProduto` varchar(255) NOT NULL,
  `descricaoProduto` varchar(255) NOT NULL,
  `nomeProduto` varchar(255) NOT NULL,
  `precoProduto` decimal(10,2) NOT NULL,
  `dataProduto` date NOT NULL,
  `horaProduto` time NOT NULL,
  `statusProduto` varchar(100) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `fotoProduto`, `descricaoProduto`, `nomeProduto`, `precoProduto`, `dataProduto`, `horaProduto`, `statusProduto`, `Usuarios_idUsuario`) VALUES
(4, 'assets/img/colher.png', 'A colher de madeira (ou colher de pau) é um utensílio clássico e sustentável, ideal para o preparo diário de alimentos. Feita em madeira maciça, protege o revestimento de panelas antiaderentes, possui cabo alongado para maior controle térmico e confere um', 'Kit Colher de Madeira', 54.00, '2026-06-20', '13:38:30', 'disponivel', 1),
(5, 'assets/img/copometal.png', 'Um copo de metal é a escolha ideal para manter suas bebidas na temperatura perfeita. Altamente durável, inquebrável e livre de BPA, ele combina design ergonômico com tecnologia de isolamento térmico. Perfeito para viagens, escritório ou momentos de lazer.', 'Copo de Metal', 59.90, '2026-06-20', '13:40:37', 'disponivel', 1),
(6, 'assets/img/coporetra.png', 'O copo retrátil é um recipiente dobrável e reutilizável, ideal para substituir copos plásticos descartáveis. Compacto e portátil, ele reduz a geração de resíduos. Fabricado em silicone de grau alimentício ou polipropileno, é livre de BPA, atóxico e suport', 'Copo Retratil', 5.00, '2026-06-20', '13:42:07', 'finalizado', 1),
(7, 'assets/img/garrafabiodegradavel.png', 'Uma garrafa biodegradável é uma embalagem inovadora projetada para se decompor naturalmente após o uso. Feita a partir de fontes naturais (como biopolímeros, bagaço de plantas ou algas), ela não deixa resíduos tóxicos ou microplásticos no solo e nos ocean', 'Garrafa Biodegradavel', 3.00, '2026-06-20', '13:43:36', 'finalizado', 1),
(8, 'assets/img/shampo.png', 'O shampoo em barra (ou sólido) limpa o couro cabeludo e remove a oleosidade como a versão líquida, mas sem usar água em sua fórmula. Concentrado e sustentável, ele é prensado em formato de barra, dispensa embalagens plásticas e pode render até 80 lavagens', 'Shampoo Em Barra', 56.00, '2026-06-20', '13:44:57', 'disponivel', 1),
(9, 'assets/img/escovapremium.png', 'A Escova de Cabelo de Bambu une sustentabilidade e cuidado capilar. Suas cerdas naturais massageiam o couro cabeludo, estimulando o crescimento saudável. O material reduz a eletricidade estática, controlando o frizz e distribuindo a oleosidade natural ao ', 'Escova de Cabelo de Bambu', 59.99, '2026-06-27', '20:21:17', 'disponivel', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `fotoUsuario` varchar(150) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `dataNascUsuario` date NOT NULL,
  `telefoneUsuario` varchar(11) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `nivelUsuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fotoUsuario`, `nomeUsuario`, `dataNascUsuario`, `telefoneUsuario`, `emailUsuario`, `senhaUsuario`, `nivelUsuario`) VALUES
(1, 'assets/img/admin.jpg', 'Kauane Estampreski', '2007-12-03', '43999899463', '03kauanetamara@gmail.com', '9db02f37b26dc814ed0bb7d820752e79', 'administrador'),
(2, 'assets/img/admin.jpg', 'Usuario', '2000-11-11', '43999899464', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'usuario'),
(3, 'assets/img/teste.jpg', 'Dona Clotilde', '1935-12-06', '43999899465', 'rocksenhora@gmail.com', '9a1f30943126974075dbd4d13c8018ac', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idProduto` (`idProduto`),
  ADD KEY `idCliente` (`idUsuario`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `produtos` (`Usuarios_idUsuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

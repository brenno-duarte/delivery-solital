-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 03-Jan-2021 às 22:49
-- Versão do servidor: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.3.25-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_delivery`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_analytics`
--

CREATE TABLE `tb_analytics` (
  `idAnalytic` int(11) NOT NULL,
  `views` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_analytics`
--

INSERT INTO `tb_analytics` (`idAnalytic`, `views`, `url`, `created_at`) VALUES
(12, 7, '/product/4/carla_davis/', '2020-07-30 18:43:05'),
(13, 2, '/product/5/lee_kidd/', '2020-07-30 18:53:42'),
(14, 1, '/product/4/carla_davis/', '2020-08-01 11:57:41'),
(15, 4, '/product/5/lee_kidd/', '2020-08-01 11:57:50'),
(16, 2, '/product/8/quincy_hendrix/?page=2', '2020-08-01 12:38:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_auth`
--

CREATE TABLE `tb_auth` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_auth`
--

INSERT INTO `tb_auth` (`id_user`, `username`, `pass`) VALUES
(1, 'solital@email.com', '$2y$10$caZsHBy5/uPkCREwLCSlmOzQHIcCWlYre1IQuX3cxY/zRPyROEflC'),
(2, 'brennoduarte2015@outlook.com', '$2y$10$wVBkIBZIldq1bit5i8G6iOmCWyEZR35O6QbsIel8fXhLwQ1qgNYn6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_category`
--

CREATE TABLE `tb_category` (
  `idCategory` int(11) NOT NULL,
  `nameCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_category`
--

INSERT INTO `tb_category` (`idCategory`, `nameCategory`) VALUES
(1, 'Bebidas'),
(3, 'Doces'),
(4, 'Sobremesa'),
(5, 'Frios e gelados'),
(6, 'Açaí');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_order`
--

CREATE TABLE `tb_order` (
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idSession` varchar(100) NOT NULL,
  `qtd` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `number` int(5) NOT NULL,
  `complement` varchar(100) DEFAULT NULL,
  `payment` varchar(50) NOT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_order`
--

INSERT INTO `tb_order` (`idOrder`, `idProduct`, `idSession`, `qtd`, `address`, `district`, `city`, `number`, `complement`, `payment`, `order_status`, `created_at`) VALUES
(16, 3, 't3hocnq9phocovi3s46po7eier', 2, 'Maxime tempora moles', 'Ullam dolor voluptat', 'Non possimus sunt c', 634, 'Nesciunt sunt a aut', 'Cartão', 'Recebido', '2020-07-23 18:58:50'),
(17, 2, 't3hocnq9phocovi3s46po7eier', 2, 'Maxime tempora moles', 'Ullam dolor voluptat', 'Non possimus sunt c', 634, 'Nesciunt sunt a aut', 'Cartão', 'Recebido', '2020-07-23 18:58:50'),
(18, 2, 'kgcfl4rihuhasm37ga7mb2kd0q', 2, 'Asperiores ea velit ', 'Ut dolor architecto ', 'Nulla aliquam laudan', 375, 'Nobis est explicabo', 'Pagamento na entrega', 'Entregue', '2020-07-23 20:01:39'),
(20, 2, '70bskd086mrf7p63gunf5llca5', 3, 'Irure sunt excepteur', 'Inventore sunt et id', 'Magnam et aut et aut', 987, 'Ut est delectus vo', 'Pagamento na entrega', 'Entregue', '2020-07-23 20:04:13'),
(21, 3, '70bskd086mrf7p63gunf5llca5', 2, 'Irure sunt excepteur', 'Inventore sunt et id', 'Magnam et aut et aut', 987, 'Ut est delectus vo', 'Pagamento na entrega', 'Entregue', '2020-07-23 20:04:13'),
(23, 3, '2heepsnnv1oqvpvqs3q9j8nn7n', 3, 'Assumenda consequat', 'Adipisicing et volup', 'Qui nobis non offici', 100, 'Fugit in doloremque', 'Pagamento na entrega', 'Entregue', '2020-07-23 20:04:16'),
(24, 2, '2heepsnnv1oqvpvqs3q9j8nn7n', 1, 'Assumenda consequat', 'Adipisicing et volup', 'Qui nobis non offici', 100, 'Fugit in doloremque', 'Pagamento na entrega', 'Entregue', '2020-07-23 20:04:16'),
(25, 3, 'bi8qlhfuka3b2f8cjbhllbtmeo', 1, 'Eos numquam volupta', 'Voluptas recusandae', 'Deleniti et enim eiu', 557, 'Autem in quos volupt', 'Cartão', 'Retornado', '2020-07-24 11:50:45'),
(26, 3, '3985qoh1uhlnfo3d15qrc671cc', 3, 'In dolore necessitat', 'Cum qui nihil aspern', 'Quia cupiditate cons', 274, 'Et distinctio Facer', 'Pagamento na entrega', 'Entregue', '2020-07-30 11:03:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_photos`
--

CREATE TABLE `tb_photos` (
  `idPhoto` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `namePhoto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_photos`
--

INSERT INTO `tb_photos` (`idPhoto`, `idProduct`, `namePhoto`) VALUES
(9, 4, 'IMG-5f22b4a2dc3dc.jpg'),
(10, 4, 'IMG-5f22b4a2e6709.jpg'),
(11, 4, 'IMG-5f22b4a2f0b6f.jpg'),
(12, 4, 'IMG-5f22b4a280ab4.jpg'),
(13, 5, 'IMG-5f2317315b827.jpg'),
(14, 5, 'IMG-5f23173165a9c.jpg'),
(15, 5, 'IMG-5f2317317a0a6.jpg'),
(16, 5, 'IMG-5f23173137406.jpg'),
(17, 6, 'IMG-5f2561628ba52.jpg'),
(18, 6, 'IMG-5f2561629befe.jpg'),
(19, 6, 'IMG-5f256162ae468.jpg'),
(20, 6, 'IMG-5f25616235f15.jpg'),
(21, 7, 'IMG-5f256174dee88.jpg'),
(22, 7, 'IMG-5f2561750f685.jpg'),
(23, 7, 'IMG-5f256174bb234.jpg'),
(24, 8, 'IMG-5f25618b07239.png'),
(25, 8, 'IMG-5f25618b1150a.png'),
(26, 8, 'IMG-5f25618acdef6.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_product`
--

CREATE TABLE `tb_product` (
  `idProduct` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `nameProduct` varchar(200) NOT NULL,
  `price` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `mainPhoto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_product`
--

INSERT INTO `tb_product` (`idProduct`, `idCategory`, `nameProduct`, `price`, `description`, `stock`, `mainPhoto`) VALUES
(4, 3, 'Carla Davis', '537', 'Aut qui ipsum sed ob', 40, 'IMG-5f22b4a280ab4.jpg'),
(5, 1, 'Lee Kidd', '504', 'Voluptas asperiores ', 100, 'IMG-5f23173137406.jpg'),
(6, 1, 'Curran Pittman', '225', 'Vel hic magni qui qu', 83, 'IMG-5f25616235f15.jpg'),
(7, 3, 'Cooper Lang', '300', 'Ut autem officiis ut', 61, 'IMG-5f256174bb234.jpg'),
(8, 3, 'Quincy Hendrix', '835', 'Voluptas saepe quibu', 29, 'IMG-5f25618acdef6.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_settings`
--

CREATE TABLE `tb_settings` (
  `idSet` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `number` int(11) NOT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_settings`
--

INSERT INTO `tb_settings` (`idSet`, `companyName`, `phone`, `email`, `address`, `district`, `state`, `number`, `logo`) VALUES
(2, 'Delivery Master', '(88) 99854-7297', 'delivery@email.com', 'Rua dos sonhos', 'Jacaré', 'MG', 123, 'IMG-5f1c33d627b87.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_analytics`
--
ALTER TABLE `tb_analytics`
  ADD PRIMARY KEY (`idAnalytic`);

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `order_product_fk` (`idProduct`);

--
-- Indexes for table `tb_photos`
--
ALTER TABLE `tb_photos`
  ADD PRIMARY KEY (`idPhoto`),
  ADD KEY `product_fk` (`idProduct`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `category_fk` (`idCategory`);

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`idSet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_analytics`
--
ALTER TABLE `tb_analytics`
  MODIFY `idAnalytic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_auth`
--
ALTER TABLE `tb_auth`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tb_photos`
--
ALTER TABLE `tb_photos`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `idSet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `order_product_fk` FOREIGN KEY (`idProduct`) REFERENCES `tb_product` (`idProduct`);

--
-- Limitadores para a tabela `tb_photos`
--
ALTER TABLE `tb_photos`
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`idProduct`) REFERENCES `tb_product` (`idProduct`);

--
-- Limitadores para a tabela `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`idCategory`) REFERENCES `tb_category` (`idCategory`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

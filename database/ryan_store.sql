-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 04:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ryan_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cart_id` int(15) NOT NULL,
  `product_id` int(20) NOT NULL,
  `product_quantity` int(20) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `cart_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `cart_id`, `product_id`, `product_quantity`, `sub_total`, `username`, `cart_date`) VALUES
(84, 1, 14, 1, '198.00', 'butch123', '2022-10-18'),
(93, 1, 40, 3, '23697.00', 'ryan123', '2022-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'slippers'),
(2, 'shoes'),
(3, 'bags'),
(4, 'hats');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `product_id` int(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` int(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date_order` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `product_id`, `product_quantity`, `sub_total`, `username`, `date_order`) VALUES
(87, 24, 14, 1, '99.00', 'ryan123', '2022-09-26'),
(88, 24, 9, 1, '8999.99', 'ryan123', '2022-09-26'),
(89, 25, 14, 4, '99.00', 'butch123', '2022-10-05'),
(90, 26, 21, 1, '799.00', 'butch123', '2022-10-05'),
(91, 27, 17, 5, '1099.00', 'butch123', '2022-10-09'),
(92, 27, 20, 4, '2598.00', 'butch123', '2022-10-09'),
(93, 28, 17, 1, '1099.00', 'butch123', '2022-10-09'),
(94, 29, 22, 2, '1798.00', 'rhenalyn', '2022-10-09'),
(95, 30, 9, 2, '26999.97', 'rhenalyn', '2022-10-09'),
(96, 30, 33, 2, '41391.00', 'rhenalyn', '2022-10-09'),
(97, 31, 14, 6, '198.00', 'butch123', '2022-10-12'),
(98, 31, 28, 2, '10998.00', 'butch123', '2022-10-12'),
(99, 32, 37, 2, '999.90', 'ryan123', '2022-10-18'),
(100, 33, 4, 2, '4000.00', 'ryan123', '2022-10-18'),
(101, 33, 36, 2, '598.00', 'ryan123', '2022-10-18'),
(102, 33, 17, 2, '2198.00', 'ryan123', '2022-10-18'),
(103, 34, 31, 2, '478.00', 'ryan123', '2022-10-18'),
(104, 34, 38, 2, '210.00', 'ryan123', '2022-10-18'),
(105, 34, 20, 3, '3897.00', 'ryan123', '2022-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL,
  `category_id` int(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_price`, `product_image`, `product_description`) VALUES
(4, 3, 'jansport', 2000, 'jansport.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(9, 2, 'jordan', 8999.99, 'jordan.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(10, 4, 'levis', 5699, 'levis.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(17, 1, 'Crocs', 1099, 'crocs.webp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(19, 2, 'Converse', 3299, 'converse.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(20, 3, 'Habagat', 1299, 'habagat.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(21, 3, 'Hawk', 799, 'hawk.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(22, 3, 'Heart Strings', 899, 'heartstrings.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(23, 4, 'Lock & Co. Hatters', 5299, 'Lock & Co. Hatters.webp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(24, 4, 'LA Dodgers', 1999.99, 'LA Dodgers.webp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(25, 4, 'Goorin', 5299, 'Goorin.webp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(27, 3, 'Gucci', 10199, 'gucci.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(28, 3, 'North Face', 5499, 'northface.webp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i'),
(31, 1, 'sandugo', 239, 'sandugo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(32, 1, 'havaianas', 356, 'havaianas.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(33, 2, 'sperry', 4599, 'sperry.jpg.crdownload', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(34, 1, 'iguana', 199, 'iguana.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(35, 2, 'Nike Rosche', 3999, 'Nike Rosche.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(36, 1, 'Islander Red', 299, 'islander.jfif', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(37, 1, 'Adidas', 499.95, 'images (7).jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(38, 1, 'Spartan', 105, 'spartan-removebg-preview.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing'),
(40, 1, 'Balenciaga', 7899, 'balenciaga.webp', 'Balenciaga SA is a luxury fashion house founded in 1919 by the Spanish designer Cristóbal Balenciaga in San Sebastian, Spain. Called \"the master of us all\" by Christian Dior, Balenciaga had a reputation as a couturier of uncompromising standards.');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `order_id` int(15) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `username` varchar(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `home_address` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`order_id`, `order_total`, `username`, `first_name`, `middle_name`, `last_name`, `home_address`, `phone_number`, `email`, `order_date`, `order_status`) VALUES
(24, '9098.99', 'ryan123', 'ryan', '', 'mamac', 'secret', '321654980', 'test_ryan@gmail.com', '2022-09-26', 1),
(25, '99.00', 'butch123', 'Butch', '', 'Mamac', 'Punta Princesa', '321654987', 'test_ryan@gmail.com', '2022-10-05', 1),
(26, '799.00', 'butch123', 'Butch', '', 'Mamac', 'Punta Princesa', '321654987', 'test_ryan@gmail.com', '2022-10-05', 1),
(27, '3697.00', 'butch123', 'Butch', '', 'Mamac', 'Punta Princesa', '321654987', 'test_ryan@gmail.com', '2022-10-09', 1),
(28, '1099.00', 'butch123', 'Butch', '', 'Mamac', 'Punta Princesa', '321654987', 'test_ryan@gmail.com', '2022-10-09', 1),
(29, '1798.00', 'rhenalyn', 'Marivic', 'A', 'Amado', 'Alopez Cebu City', '09123555555', 'test_ryan@email.com', '2022-10-09', 1),
(30, '68390.97', 'rhenalyn', 'Rhenalyn', 'A', 'Amado', 'Alopez Cebu City', '09123555555', 'test_ryan@email.com', '2022-10-09', 1),
(31, '11196.00', 'butch123', 'Butch', '', 'Mamac', 'Banilad', '321654987', 'test_ryan@gmail.com', '2022-10-12', 1),
(32, '999.90', 'ryan123', 'ryan', '', 'mamac', 'Sunberry Homes', '321654980', 'test_ryan@gmail.com', '2022-10-18', 1),
(33, '6796.00', 'ryan123', 'ryan', '', 'mamac', 'secret', '321654980', 'test_ryan@gmail.com', '2022-10-18', 1),
(34, '4585.00', 'ryan123', 'drey', '', 'bantilan', 'Manggahan', '321654980', 'test_ryan@gmail.com', '2022-10-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `passcode` varchar(50) NOT NULL,
  `id_number` int(50) NOT NULL,
  `user_type` int(2) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `passcode`, `id_number`, `user_type`, `first_name`, `middle_name`, `last_name`, `home_address`, `phone_number`, `email`, `register_date`) VALUES
('mamac123', '682a3ef72f6031e4be8bd93f00073807a1b1e791', 8, 2, 'Ryan', 'Gealon', 'Mamac', 'Cebu', '321654987', 'test_ryan@gmail.com', '2022-09-09'),
('rhenalyn123', '9678a0f17bc50e37197871942a8a6df37bd386a1', 10, 2, 'Rhenalyn', 'Taboada', 'Amado', 'Alopez', '987654321', 'test_ryan@gmail.com', '2022-09-09'),
('butch123', '060e6aadd810d02b55d263c06ffe3187c0a83cbe', 11, 2, 'Butch', '', 'Mamac', 'Punta Princesa', '321654987', 'test_ryan@gmail.com', '2022-09-14'),
('admin123', 'a70c6b353f19a8d95caa75be364df4a5b3d7ff1f', 12, 1, 'Administrator', '', 'Admin', 'Secret', '321654987', 'test_ryan@gmail.com', '2022-09-21'),
('ryan123', '545c415b8ae94cb15c6059e558933c570a92914d', 13, 2, 'ryan', '', 'mamac', 'secret', '321654980', 'test_ryan@gmail.com', '2022-09-22'),
('rhenalyn', 'ffc7e7b233cc31cc8cae5b2db5835a5ee28ee91e', 14, 2, 'Rhenalyn', 'A', 'Amado', 'Alopez Cebu City', '09123555555', 'test_ryan@email.com', '2022-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `user_type` int(10) NOT NULL,
  `user_define` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`user_type`, `user_define`) VALUES
(1, 'Admin'),
(2, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `order_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_number` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `user_type` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

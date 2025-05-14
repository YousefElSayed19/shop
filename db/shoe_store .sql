-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 07:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoe_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `original_price` float NOT NULL,
  `discounted_price` float NOT NULL,
  `rating` varchar(255) NOT NULL,
  `on_offer` varchar(255) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `original_price`, `discounted_price`, `rating`, `on_offer`, `image`) VALUES
(1, 'Women’s Green Training', 'any thing', 150, 50, '3', 'yes', 0x2e2e2f696d616765732f70726f64756374732f313734353536383531395f4932432d4c43442d446973706c61792d50696e6f75742e706e67),
(2, 'Women’s Green Training', 'dasasd', 3124, 150, '3', 'yes', 0x2e2e2f696d616765732f70726f64756374732f313734353630383834305f636f64652e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `image` blob NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `email`, `age`, `phone`, `image`, `role`) VALUES
(2, 'Yousef El Sayed', 'yousafe15', 'helloworld', 'yousafe2042005@gmail.com', 15, '', 0x2e2e2f75706c6f6164732f313734353536383333305f666132663030303738383364626130342e6a7067, 'admin'),
(3, 'Ahmed Mohamed', 'ahmed15', 'helloworld', 'mm8755179@gmail.com', 18, '', 0x2e2e2f75706c6f6164732f313734353536383336395f636f64652e706e67, 'user'),
(4, 'Kemo Ahmed', 'kemo15', 'hello', 'ysmm3fcf@gmail.com', 20, '', 0x2e2e2f75706c6f6164732f313734353735333637355f6176617461722d30342e706e67, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

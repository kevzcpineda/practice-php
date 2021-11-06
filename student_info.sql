-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 06:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_quantity`
--

CREATE TABLE `add_quantity` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_listing_price` decimal(20,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_quantity`
--

INSERT INTO `add_quantity` (`id`, `product`, `category`, `brand_name`, `quantity`, `total_listing_price`, `date`) VALUES
(28, 'sample 1', 'category 1', 'brand 1', 4, '200.00', '2021-10-20'),
(29, 'sample 2', 'category 2', 'brand 2', 4, '400.00', '2021-10-20'),
(30, 'sample 2', 'category 2', 'brand 2', 1, '100.00', '2021-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `brand_table`
--

CREATE TABLE `brand_table` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_table`
--

INSERT INTO `brand_table` (`id`, `brand_name`) VALUES
(4, 'brand 1'),
(5, 'brand 2');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`id`, `category`) VALUES
(4, 'category 1'),
(5, 'category 2');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `studentId` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middlleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `studentId`, `firstName`, `middlleName`, `lastName`, `amount`) VALUES
(4, '9', 'chester', 'parunga', 'pineda', '1234'),
(5, '8', 'kevib', 'parunga', 'pineda', '20000'),
(6, '5', 'kevib', 'asdkjg', 'dzskg', '34'),
(7, '10', 'kenzy', 'parunga', 'pineda', '10000'),
(8, '11', 'kenneth', 'par', 'pineds', '9999'),
(9, '11', 'kenneth', 'par', 'pineds', '999999'),
(10, '10', 'kenzy', 'parunga', 'pineda', '478'),
(11, '5', 'kevib', 'asdkjg', 'dzskg', '1234'),
(12, '9', 'chester', 'parunga', 'pineda', '324'),
(13, '10', 'kenzy', 'parunga', 'pineda', '324'),
(14, '9', 'chester', 'parunga', 'pineda', '34'),
(15, '9', 'chester', 'parunga', 'pineda', '34'),
(16, '9', 'chester', 'parunga', 'pineda', '1234'),
(17, '9', 'chester', 'parunga', 'pineda', '1234'),
(18, '9', 'chester', 'parunga', 'pineda', '324'),
(19, '9', 'chester', 'parunga', 'pineda', '1234'),
(20, '9', 'chester', 'parunga', 'pineda', '34'),
(21, '9', 'chester', 'parunga', 'pineda', '1234'),
(22, '9', 'chester', 'parunga', 'pineda', '1234'),
(23, '10', 'kenzy', 'parunga', 'pineda', '324');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `customer_name`, `total`, `date`) VALUES
(16, 'jayz', '0.00', '2021-10-20'),
(17, 'kevin', '0.00', '2021-10-20'),
(18, 'test', '0.00', '2021-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `sale_record`
--

CREATE TABLE `sale_record` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `quantity` int(255) NOT NULL,
  `total_listing_price` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_record`
--

INSERT INTO `sale_record` (`id`, `product_id`, `product_name`, `brand`, `category`, `price`, `quantity`, `total_listing_price`, `total`, `date`) VALUES
(55, 16, 'sample 1', 'brand 1', 'category 1', '100.00', 1, '50.00', '100.00', '2021-10-20'),
(56, 16, 'sample 2', 'brand 2', 'category 2', '200.00', 2, '100.00', '400.00', '2021-10-20'),
(57, 17, 'sample 1', 'brand 1', 'category 1', '100.00', 2, '50.00', '200.00', '2021-10-20'),
(58, 17, 'sample 2', 'brand 2', 'category 2', '200.00', 2, '100.00', '400.00', '2021-10-20'),
(59, 18, 'sample 1', 'brand 1', 'category 1', '100.00', 1, '50.00', '100.00', '2021-10-20'),
(60, 18, 'sample 2', 'brand 2', 'category 2', '200.00', 1, '100.00', '200.00', '2021-10-20'),
(61, 0, '', '', '', '500.00', 3, '100.00', '300.00', '2021-01-13'),
(62, 0, '', '', '', '500.00', 1, '100.00', '200.00', '2021-01-01'),
(63, 0, '', '', '', '0.00', 0, '0.00', '500.00', '2021-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `listing_price` decimal(20,2) NOT NULL,
  `retail_price` decimal(20,2) NOT NULL,
  `stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `product`, `category`, `brand`, `listing_price`, `retail_price`, `stock`) VALUES
(100, 'sample 1', 'category 1', 'brand 1', '6.00', '50.00', 0),
(101, 'sample 2', 'category 2', 'brand 2', '3.00', '100.00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_quantity`
--
ALTER TABLE `add_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_table`
--
ALTER TABLE `brand_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_record`
--
ALTER TABLE `sale_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_quantity`
--
ALTER TABLE `add_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `brand_table`
--
ALTER TABLE `brand_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale_record`
--
ALTER TABLE `sale_record`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

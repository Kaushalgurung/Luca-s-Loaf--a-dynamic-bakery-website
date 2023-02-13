-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 05:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `role`, `date`) VALUES
(50, 'Ms. Luca', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '2023-02-12 04:41:39'),
(51, 'Ms. Sayron', 'manager', 'manager@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Manager', '2023-02-12 04:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`, `featured`, `active`) VALUES
(35, 'Sandwich', 'food_category_6742.jpg', 'Yes', 'Yes'),
(37, 'Burger', 'food_category_2421.jpg', 'Yes', 'Yes'),
(38, 'Pizza', 'food_category_6618.jpg', 'Yes', 'Yes'),
(49, 'Bread', '', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `price`, `image`, `description`, `category_id`, `featured`, `active`) VALUES
(36, 'Burger', '5.00', 'food-name-4206.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 37, 'Yes', 'Yes'),
(37, 'Pizza', '7.00', 'food-name-4369.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 38, 'Yes', 'Yes'),
(38, 'Sandwich', '6.00', 'food-name-8723.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 35, 'Yes', 'Yes'),
(39, 'Pizza', '8.00', 'food-name-1849.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 38, 'Yes', 'Yes'),
(40, 'Burger', '5.00', 'food-name-9069.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 37, 'Yes', 'Yes'),
(41, 'Pizza', '8.00', 'food-name-4445.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 38, 'Yes', 'Yes'),
(42, 'Sandwich', '6.00', 'food-name-4413.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 35, 'Yes', 'Yes'),
(43, 'Pizza', '8.00', 'food-name-1770.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 35, 'Yes', 'Yes'),
(44, 'Sandwich', '7.00', 'food-name-2854.jpg', 'Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani Culpa assumenda ani ', 35, 'Yes', 'Yes'),
(54, 'sourdough white bread .', '7.00', 'food-name-5406.jfif', 'Our standard sourdough', 49, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`id`, `title`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(159, 'sourdough white bread .', '7.00', 1, '7.00', '2023-02-12 03:11:25', 'On Delivery', 'Sayron Bam', '1345679', 'sayronbam0@gmail.com', 'Nepal\r\nBoudha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

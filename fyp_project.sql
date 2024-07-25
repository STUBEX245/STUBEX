-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2024 at 08:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `email`, `home_address`, `zip`, `state`, `area`, `phone_number`) VALUES
(12, 'ahmadnabil1@gmail.com', 'No 33, Jalan Panglima Mustika, Taman Mustika', '05350', 'Alor Setar', 'Kedah', '01132529851'),
(13, 'zubai333@gmail.com', 'N15, Taman Desa Kenari', '05350', 'Alor Setar', 'Kedah', '0179687753'),
(14, 'shahman2@gmail.com', '56 Jalan Tengku Razak', '30000', 'Ipoh', 'Perak', '0198348830');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) NOT NULL,
  `totalPrice` double(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ikey` varchar(255) NOT NULL,
  `seller_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'All Product'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4\r\n'),
(5, 'Semester 5'),
(6, 'Semester 6'),
(7, 'Additional Book');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int NOT NULL,
  `from_id` varchar(255) NOT NULL,
  `to_id` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int NOT NULL,
  `user_1` varchar(255) NOT NULL,
  `user_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `transaction_id` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) NOT NULL,
  `totalPrice` double(10,2) NOT NULL,
  `custemail` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `zip` int DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `seller_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`transaction_id`, `id`, `title`, `category`, `quantity`, `price`, `image`, `description`, `totalPrice`, `custemail`, `time`, `payment_method`, `payment_status`, `order_status`, `delivery_address`, `zip`, `state`, `area`, `seller_id`) VALUES
('0YVLCPQS4JPSF', 'EXP_94340', 'Financial and Management Accounting', 'Semester 3', 1, 20.00, 'financial and management accounting.jpg', 'Buku financial untuk  dilepaskan', 20.00, 'ahmadnabil1@gmail.com', '2024-07-25 07:59:24', 'COD', 'Paid', 'Completed', 'No 33, Jalan Panglima Mustika, Taman Mustika, 05350, Alor Setar, Kedah, 01132529851', NULL, NULL, NULL, 'zubai333@gmail.com'),
('4UJ5DI7F5TBIN', 'KYR_86799', 'Fundamental of Management Second Edition', 'Semester 2', 1, 25.00, 'mgt.jpg', 'MGT', 25.00, 'shahman2@gmail.com', '2024-07-24 13:00:16', 'COD', 'Paid', 'Completed', '56 Jalan Tengku Razak, 30000, Ipoh, Perak, 0198348830', NULL, NULL, NULL, 'ahmadnabil1@gmail.com'),
('7OXW6FUZX6UUW', 'EXP_94340', 'Financial and Management Accounting', 'Semester 3', 1, 20.00, 'financial and management accounting.jpg', 'Buku financial untuk  dilepaskan', 20.00, 'ahmadnabil1@gmail.com', '2024-07-24 09:49:37', 'COD', 'Paid', 'Completed', 'No 33, Jalan Panglima Mustika, Taman Mustika, 05350, Alor Setar, Kedah, 01132529851', NULL, NULL, NULL, 'zubai333@gmail.com'),
('PCSAGF4IP4F5J', 'BID_57993', 'Arabic (TAC) Level 2', 'Semester 4\r\n', 1, 15.00, 'arab level 2.jpg', 'TAC book ', 15.00, 'ahmadnabil1@gmail.com', '2024-07-24 13:04:02', 'COD', 'Un-Paid', 'Cancelled', 'No 33, Jalan Panglima Mustika, Taman Mustika, 05350, Alor Setar, Kedah, 01132529851', NULL, NULL, NULL, 'shahman2@gmail.com'),
('XJSV6W47HKENG', 'BID_57993', 'Arabic (TAC) Level 2', 'Semester 4\r\n', 1, 15.00, 'arab level 2.jpg', 'TAC book ', 15.00, 'ahmadnabil1@gmail.com', '2024-07-25 08:00:13', 'COD', 'Paid', 'Completed', 'No 33, Jalan Panglima Mustika, Taman Mustika, 05350, Alor Setar, Kedah, 01132529851', NULL, NULL, NULL, 'shahman2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'All Product',
  `quantity` int NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) NOT NULL,
  `status` varchar(100) DEFAULT 'Pending',
  `seller_id` varchar(255) DEFAULT NULL,
  `shelf` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'on',
  `seller_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `category`, `quantity`, `price`, `image`, `description`, `status`, `seller_id`, `shelf`, `seller_username`) VALUES
('BID_57993', 'Arabic (TAC) Level 2', 'Semester 4\r\n', 1, 15.00, 'arab level 2.jpg', 'TAC book ', 'approve', 'shahman2@gmail.com', 'on', 'Shahirah Mansor'),
('EXP_94340', 'Financial and Management Accounting', 'Semester 3', 0, 20.00, 'financial and management accounting.jpg', 'Buku financial untuk  dilepaskan', 'approve', 'zubai333@gmail.com', 'on', 'zubaidah'),
('GZF_22003', 'Principles of Administrative Law in Malaysia', 'Semester 3', 1, 35.00, 'business law.jpg', 'Buku untuk dilepaskan', 'approve', 'zubai333@gmail.com', 'on', 'zubaidah'),
('KYR_86799', 'Fundamental of Management Second Edition', 'Semester 2', 2, 25.00, 'mgt.jpg', 'MGT', 'approve', 'ahmadnabil1@gmail.com', 'on', 'Ahmad Nabil'),
('RDZ_85092', 'Mandarin Level 1', 'Semester 2', 2, 15.00, 'mandarin.jpg', 'Mandarin Level 1 textbook for first sem of Mandarin subject', 'approve', 'ahmadnabil1@gmail.com', 'on', 'Ahmad Nabil'),
('UXA_53605', 'TMC', 'Semester 3', 1, 20.00, 'mandarin.jpg', 'TMC level 1 untuk diletgo', 'approve', 'ahmadnabil1@gmail.com', 'on', 'Ahmad Nabil');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT 'Customer',
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `Type`, `address`, `zip`, `state`, `area`, `phone_number`) VALUES
(1, 'owner', 'owner@owner.com', '72122ce96bfec66e2396d2e25225d70a', 'Owner', '-', '-', '-', '-', '-'),
(2, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '-', '-', '-', '-', '-'),
(3, 'Ahmad Nabil', 'ahmadnabil1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Customer', 'No 33, Jalan Panglima Mustika, Taman Mustika', '05350', 'Alor Setar', 'Kedah', '01132529851'),
(4, 'zubaidah', 'zubai333@gmail.com', '202cb962ac59075b964b07152d234b70', 'Customer', 'N15, Taman Desa Kenari', '05350', 'Alor Setar', 'Kedah', '0179687753'),
(5, 'Shahirah Mansor', 'shahman2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Customer', '56 Jalan Tengku Razak', '30000', 'Ipoh', 'Perak', '0198348830');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ikey`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

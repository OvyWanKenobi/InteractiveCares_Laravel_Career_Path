-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 10:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lcp_bangubank`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `unique_id`, `name`, `email`, `password`, `created_on`) VALUES
(1, 'JbXucaB', 'Ashiqur Rahman', 'abcds@gmail.com', '$2y$10$EAiO7G24/TVwUN/2McokHuzEOAOsh7EB.zo6BLZ6N4NLLQC0jK.gu', '2024-08-27 00:34:23'),
(2, 'CETSJU8', 'qwerty qwerty', 'qwerty@gmail.com', '$2y$10$J3a/6psdsFAyqikK/NziTOMQL9W8czX.iqXFNuDCmrnT8GKk8hJbK', '2024-08-27 01:28:26'),
(3, 'admin', 'Admin', 'admin@bangubank.com', '$2y$10$58Cb3UPPrt..0dwijcKqtuQBLwop3529y.87bIhj7lZ6ttxkBC2fa', '2024-08-27 01:39:51'),
(4, 'WUWCs8c', 'dr yunus', 'dryunus@gmail.com', '$2y$10$wyifJ4KFNEXs/i1qgyQs9.QXicBYc9v0w5bvLyN7ibXBZUM3EdPiq', '2024-08-27 01:41:06'),
(5, 'qjvo84M', 'optimus prime', 'abc@gmail.com', '$2y$10$tgEalX6AxsRp2gARcvVQAuDMsCgZMqLVHaPjGWtmqSaMDYRYV/u8O', '2024-08-27 02:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(7) NOT NULL,
  `type` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `transfer_to` varchar(7) DEFAULT NULL,
  `transfer_from` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `type`, `amount`, `date`, `transfer_to`, `transfer_from`) VALUES
(1, 'JbXucaB', 'deposit', '5555.00', '2024-08-26 20:35:55', '', ''),
(2, 'JbXucaB', 'deposit', '100.00', '2024-08-26 21:22:50', '', ''),
(3, 'JbXucaB', 'deposit', '45.00', '2024-08-26 21:24:04', '', ''),
(4, 'JbXucaB', 'withdraw', '20.00', '2024-08-26 21:24:18', '', ''),
(5, 'JbXucaB', 'withdraw', '125.00', '2024-08-26 21:24:22', '', ''),
(6, 'JbXucaB', 'withdraw', '555.00', '2024-08-26 21:27:25', '', ''),
(7, 'CETSJU8', 'deposit', '60000.00', '2024-08-26 21:28:54', '', ''),
(8, 'CETSJU8', 'transfer', '452.00', '2024-08-26 21:30:31', 'JbXucaB', NULL),
(9, 'JbXucaB', 'received', '452.00', '2024-08-26 21:30:31', NULL, 'CETSJU8'),
(10, 'CETSJU8', 'deposit', '10.00', '2024-08-26 21:34:17', '', ''),
(11, 'CETSJU8', 'deposit', '10.00', '2024-08-26 21:34:20', '', ''),
(12, 'CETSJU8', 'withdraw', '20.00', '2024-08-26 21:34:24', '', ''),
(13, 'CETSJU8', 'withdraw', '48.00', '2024-08-26 21:34:27', '', ''),
(14, 'CETSJU8', 'transfer', '500.00', '2024-08-26 21:34:33', 'JbXucaB', NULL),
(15, 'JbXucaB', 'received', '500.00', '2024-08-26 21:34:33', NULL, 'CETSJU8'),
(16, 'CETSJU8', 'transfer', '10000.00', '2024-08-26 21:34:39', 'JbXucaB', NULL),
(17, 'JbXucaB', 'received', '10000.00', '2024-08-26 21:34:39', NULL, 'CETSJU8'),
(18, 'CETSJU8', 'transfer', '9000.00', '2024-08-26 21:34:55', 'JbXucaB', NULL),
(19, 'JbXucaB', 'received', '9000.00', '2024-08-26 21:34:55', NULL, 'CETSJU8'),
(20, 'JbXucaB', 'withdraw', '4952.00', '2024-08-26 21:35:53', '', ''),
(21, 'JbXucaB', 'deposit', '5000.00', '2024-08-26 21:36:03', '', ''),
(22, 'JbXucaB', 'transfer', '4545.00', '2024-08-26 21:36:13', 'CETSJU8', NULL),
(23, 'CETSJU8', 'received', '4545.00', '2024-08-26 21:36:13', NULL, 'JbXucaB'),
(24, 'JbXucaB', 'transfer', '455.00', '2024-08-26 21:42:01', 'WUWCs8c', NULL),
(25, 'WUWCs8c', 'received', '455.00', '2024-08-26 21:42:01', NULL, 'JbXucaB'),
(26, 'JbXucaB', 'deposit', '200.00', '2024-08-26 22:19:41', '', ''),
(27, 'JbXucaB', 'withdraw', '4000.00', '2024-08-26 22:19:45', '', ''),
(28, 'JbXucaB', 'transfer', '2000.00', '2024-08-26 22:20:00', 'qjvo84M', ''),
(29, 'qjvo84M', 'received', '2000.00', '2024-08-26 22:20:00', '', 'JbXucaB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `customer_transaction_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`unique_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

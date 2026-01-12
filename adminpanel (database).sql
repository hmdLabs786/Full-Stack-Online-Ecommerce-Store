-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 05:22 PM
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
-- Database: `adminpanel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTopCategories` (IN `top_count` INT)   BEGIN
    SELECT * FROM vw_top_categories
    ORDER BY total_revenue DESC
    LIMIT top_count;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTopClients` (IN `top_count` INT)   BEGIN
    SELECT * FROM vw_top_clients
    ORDER BY total_spent DESC, total_orders DESC
    LIMIT top_count;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTopProducts` (IN `top_count` INT)   BEGIN
    SELECT * FROM vw_top_products
    ORDER BY total_quantity_sold DESC, total_revenue DESC
    LIMIT top_count;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `all_orders_backup`
--

CREATE TABLE `all_orders_backup` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `proname` varchar(255) NOT NULL,
  `proprice` decimal(10,2) NOT NULL,
  `proqty` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `work_phone` varchar(20) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_img` varchar(255) NOT NULL,
  `tracking_number` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `selected_color` varchar(50) DEFAULT NULL,
  `selected_size` varchar(50) DEFAULT NULL,
  `shirt_type` varchar(100) DEFAULT NULL,
  `delivery_area` varchar(100) DEFAULT NULL,
  `shipping_charges` decimal(10,2) DEFAULT 0.00,
  `item_tax` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_time` datetime DEFAULT current_timestamp(),
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `deleted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_orders_backup`
--

INSERT INTO `all_orders_backup` (`id`, `uid`, `uname`, `proname`, `proprice`, `proqty`, `name`, `address`, `email`, `work_phone`, `product_id`, `product_img`, `tracking_number`, `quantity`, `selected_color`, `selected_size`, `shirt_type`, `delivery_area`, `shipping_charges`, `item_tax`, `total_amount`, `order_time`, `order_status`, `city`, `country`, `postal_code`, `home_phone`, `cancel_reason`, `deleted_at`) VALUES
(44, 0, 'Jawad', 'Now Mode On', 1500.00, 1, 'Jawad Ul Bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 2, '1753975249_1.png', 'G21YRPQFJ0', 1, 'Red', 'M', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-03 15:04:05', 'cancelled', NULL, NULL, NULL, NULL, 'Not good', '2025-08-03 15:14:48'),
(46, 0, 'Guest', 'Now Mode On', 1500.00, 1, 'jawad-ul-bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 2, '1753975249_1.png', 'XRF75J4L06', 1, 'Red', 'S', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-04 01:31:48', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-04 14:32:38'),
(47, 0, 'Guest', 'Now Mode On', 1500.00, 1, 'jawad-ul-bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 1, '1753975094_3.png', 'POD8GREQBJ', 1, 'Blue', 'S', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-04 01:31:48', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-04 14:32:48'),
(48, 0, 'Guest', 'Now Mode On', 1500.00, 1, 'Jawad Ul Bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 1, '1753975094_3.png', '6YQEAMXF2P', 1, 'Blue', 'S', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-04 01:33:03', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-04 14:31:27'),
(49, 0, 'Guest', 'Now Mode On', 1500.00, 1, 'Jawad Ul Bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 4, '1753986978_2.png', 'NUKRDLH76M', 1, 'Green', 'S', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-04 01:33:03', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-04 14:32:27'),
(50, 0, 'Guest', 'Now Mode On', 1500.00, 1, 'Jawad Ul Bahar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 2, '1753975249_1.png', '7YW1EBUSOJ', 1, 'Red', 'L', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-04 12:40:17', 'cancelled', NULL, NULL, NULL, NULL, 'gdjkl', '2025-08-04 14:32:16'),
(119, 0, 'Jawad', '', 1500.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 2, '1753975249_1.png', 'T2R7FEJ8W3', 1, '', '', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-05 21:14:36', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-05 21:37:56'),
(123, 0, 'Jawad', '', 1500.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 2, '1753975249_1.png', 'GT9Z7EW5KI', 1, '', '', 'Oversized Tee', 'Saddar', 300.00, 150.00, 1950.00, '2025-08-05 22:40:11', 'cancelled', NULL, NULL, NULL, NULL, 'GT9Z7EW5KI', '2025-08-05 22:41:41'),
(136, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 5, '7.png', 'CN56MRWK8V', 1, 'Red', '40', 'Structured Polo', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-06 20:17:02', 'pending', NULL, NULL, NULL, NULL, NULL, '2025-08-06 20:50:51'),
(159, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 35, '1754743162_main_7988.png', '19K6VJELQ2', 1, 'Maroon', 'S', 'Oversized Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-10 16:50:58', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 16:56:13'),
(164, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 36, '1754743724_9044.png', 'Y31I7CUVO6', 1, 'Black', 'S', 'Structured Polo', 'Gulistan e Johar', 250.00, 200.00, 2450.00, '2025-08-10 20:33:43', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 20:34:38'),
(167, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 35, '1754743162_1830.png', 'V5TUWM8XNR', 1, 'Green', 'S', 'Oversized Tee', 'Gulistan e Johar', 250.00, 200.00, 2450.00, '2025-08-10 20:52:35', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 20:53:10'),
(169, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 35, '1754743162_main_7988.png', 'GQDRVSWO0F', 1, 'Maroon', 'S', 'Oversized Tee', 'Gulistan e Johar', 250.00, 200.00, 2450.00, '2025-08-10 20:59:07', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 20:59:33'),
(174, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 36, '1754746333_2114.png', '3GFY5J1ZMP', 1, 'Green', 'M', 'Structured Polo', 'Gulistan e Johar', 250.00, 200.00, 2450.00, '2025-08-12 14:32:05', 'cancelled', 'karachi', 'Pakistan', '75500', '03133998234', 'blah blskdkd', '2025-08-12 14:33:45'),
(179, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 35, '1754743162_main_7988.png', 'JINA8QUDZR', 1, 'Maroon', 'XL', 'Oversized Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-18 15:51:39', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-18 15:54:47'),
(181, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 37, '1754745857_5311.png', '0COJB2WDVF', 1, 'Purple', 'S', 'Regular Fit Tee', 'Korangi', 200.00, 200.00, 2400.00, '2025-08-18 17:36:19', 'pending', 'karachi', 'Pakistan', '75500', '03133998234', NULL, '2025-08-21 15:47:24'),
(188, 0, 'Jawad', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 37, '1754745857_9724.png', 'TB1QF8NHP2', 1, 'Green', 'S', 'Regular Fit Tee', 'Gulistan e Johar', 250.00, 200.00, 2450.00, '2025-08-21 15:52:19', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 15:52:47'),
(193, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 41, '1755778148_3700.png', '3GEXS1FDB6', 1, 'Maroon', 'S', 'Henley Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-21 19:36:25', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:37:37'),
(194, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 39, '1755777465_4141.png', 'I7MPXVAJOF', 1, 'Blue', 'S', 'Oversized Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-21 19:42:45', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:43:14'),
(195, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 41, '1755778148_main_6740.png', 'OEC13VZYF8', 1, 'Black', 'S', 'Henley Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-21 19:44:17', 'pending', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:44:48'),
(196, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 43, '1755784950_main_3734.png', 'M2KPJ4QXNA', 1, 'Maroon', 'S', 'Structured Polo', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-21 19:45:42', 'cancelled', 'karachi', 'Pakistan', '75500', '03021357103', 'No reason', '2025-08-21 19:47:27'),
(197, 0, 'Guest', '', 2000.00, 1, '', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 'jawadulbahar@gmail.com', '03133998234', 39, '1755777465_main_8557.png', 'OHLGNQW6X2', 1, 'Green', 'S', 'Oversized Tee', 'Saddar', 300.00, 200.00, 2500.00, '2025-08-21 19:49:49', 'cancelled', 'karachi', 'Pakistan', '75500', '03021357103', 'No reason\r\n', '2025-08-21 19:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `proid` int(11) DEFAULT NULL,
  `proname` varchar(255) DEFAULT NULL,
  `proprice` int(11) DEFAULT NULL,
  `proqty` int(11) DEFAULT NULL,
  `proimg` varchar(255) DEFAULT NULL,
  `selected_size` varchar(50) DEFAULT NULL,
  `selected_color` varchar(50) DEFAULT NULL,
  `shirt_type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tracking_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `session_id`, `proid`, `proname`, `proprice`, `proqty`, `proimg`, `selected_size`, `selected_color`, `shirt_type`, `created_at`, `tracking_number`) VALUES
(30, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'L', 'Blue', 'Oversized Tee', '2025-08-04 18:33:02', 'QLCKIJ8D2P'),
(31, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-04 19:21:13', '4DCYOUT8IL'),
(32, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 5, 'Retro Reboot', 2000, 1, '7.png', '40', 'Red', 'Structured Polo', '2025-08-04 19:35:32', '1JNU5EYDKZ'),
(33, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'L', 'Blue', 'Oversized Tee', '2025-08-04 19:47:17', 'SM72JW9LVB'),
(34, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-04 20:10:49', '7ZLOHX8S1K'),
(35, 0, 'hcsgvaeqkq6l9oensn68ae60pu', 9, 'Retro Reboot', 2000, 1, '10.png', '40', 'Green', 'Structured Polo', '2025-08-04 20:11:00', '7ZLOHX8S1K'),
(36, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 08:59:12', 'J5BTE682YX'),
(37, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 13, 'Evergreen Ease', 2500, 1, '12.png', '40', 'Green', 'Regular Fit Tee', '2025-08-05 08:59:28', 'J5BTE682YX'),
(38, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 6, 'Retro Reboot', 2000, 1, '6.png', '40', 'Green', 'Structured Polo', '2025-08-05 09:17:01', '45RNL7H18A'),
(39, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 13, 'Evergreen Ease', 2500, 1, '12.png', '44', 'Black', 'Regular Fit Tee', '2025-08-05 09:17:31', '45RNL7H18A'),
(40, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 09:23:13', 'X4ROTD8MZI'),
(41, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'L', 'Black', 'Oversized Tee', '2025-08-05 09:28:24', 'X4ROTD8MZI'),
(42, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 09:32:32', 'JITNVGAL2P'),
(43, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'L', 'Black', 'Oversized Tee', '2025-08-05 09:32:45', 'JITNVGAL2P'),
(44, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'L', 'Blue', 'Oversized Tee', '2025-08-05 09:47:33', '9AEQ46HOYV'),
(45, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 8, 'Retro Reboot', 2000, 1, '9.png', '40', 'Green', 'Structured Polo', '2025-08-05 09:50:08', '3X5N7YCGJM'),
(46, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'M', 'Red', 'Oversized Tee', '2025-08-05 09:51:32', '3POZCEFDVL'),
(47, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 10:33:09', 'IC2QHB9OK0'),
(48, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 10:41:25', '3AY19NRG7O'),
(49, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'L', 'Red', 'Oversized Tee', '2025-08-05 10:42:41', 'L9I3J75821'),
(50, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 11:05:40', 'X8J2A36MOU'),
(51, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 10, 'Evergreen Ease', 2500, 1, '11.png', '40', 'Black', 'Regular Fit Tee', '2025-08-05 11:05:52', 'X8J2A36MOU'),
(52, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 11:11:58', 'WCSH1NVI6L'),
(53, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'M', 'Black', 'Oversized Tee', '2025-08-05 11:12:07', 'WCSH1NVI6L'),
(54, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 6, 'Retro Reboot', 2000, 1, '6.png', '42', 'Green', 'Structured Polo', '2025-08-05 11:31:47', 'MS9N1J4T60'),
(55, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 11:31:58', 'MS9N1J4T60'),
(56, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 12:29:46', '074P6TQBJM'),
(57, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 12, 'Evergreen Ease', 2500, 2, '15.png', '42', 'Green', 'Regular Fit Tee', '2025-08-05 12:30:02', '074P6TQBJM'),
(58, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 12:36:30', 'PJ6H8MKR49'),
(59, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 3, '1753975249_1.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 12:36:51', 'PJ6H8MKR49'),
(60, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 6, 'Retro Reboot', 2000, 1, '6.png', '40', 'Green', 'Structured Polo', '2025-08-05 14:03:35', 'OTV74Z9XBU'),
(61, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 14:03:46', 'OTV74Z9XBU'),
(62, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 14:23:17', '1D07GSCLTE'),
(63, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 8, 'Retro Reboot', 2000, 1, '9.png', '42', 'Green', 'Structured Polo', '2025-08-05 14:23:25', '1D07GSCLTE'),
(64, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 14:42:26', 'D7S3RI1Z5G'),
(65, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'L', 'Black', 'Oversized Tee', '2025-08-05 14:42:35', 'D7S3RI1Z5G'),
(66, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'M', 'Blue', 'Oversized Tee', '2025-08-05 14:42:46', 'D7S3RI1Z5G'),
(67, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 14:43:01', 'D7S3RI1Z5G'),
(68, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 14:46:55', 'DBORNFQ3XK'),
(69, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 8, 'Retro Reboot', 2000, 1, '9.png', '40', 'Red', 'Structured Polo', '2025-08-05 14:47:07', 'DBORNFQ3XK'),
(70, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 15:11:20', 'KSPO0YNFTZ'),
(71, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 15:26:10', 'VTYOIMS4EG'),
(73, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'S', 'Black', 'Oversized Tee', '2025-08-05 15:26:52', 'VTYOIMS4EG'),
(74, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 15:28:21', 'ZCKY46LAW7'),
(75, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Red', 'Oversized Tee', '2025-08-05 15:28:30', 'ZCKY46LAW7'),
(76, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 15:59:11', '1LCEYIS5B7'),
(77, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', '', '', 'Oversized Tee', '2025-08-05 16:14:26', 'T2R7FEJ8W3'),
(78, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'M', 'Blue', 'Oversized Tee', '2025-08-05 16:40:46', 'W9PJQSNO43'),
(79, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 1, 'Now Mode On', 1500, 1, '1753975094_3.png', 'S', 'Blue', 'Oversized Tee', '2025-08-05 17:35:20', 'MTK3FYA6O2'),
(80, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Green', 'Oversized Tee', '2025-08-05 17:35:40', 'MTK3FYA6O2'),
(81, 0, 'ksj2anu7kih03tffg5r1cqpf1o', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'L', 'Green', 'Oversized Tee', '2025-08-05 17:39:57', 'GT9Z7EW5KI'),
(82, 0, 'm4b859dompe7tsi208tdc12tp8', 1, 'Now Mode On', 1500, 2, '1753975094_3.png', 'M', '', 'Oversized Tee', '2025-08-06 09:21:34', 'TCMD7VF38N'),
(83, 0, 'm4b859dompe7tsi208tdc12tp8', 9, 'Retro Reboot', 2000, 1, '10.png', '40', 'Green', 'Structured Polo', '2025-08-06 09:21:46', 'TCMD7VF38N'),
(84, 0, 'm4b859dompe7tsi208tdc12tp8', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'L', 'Red', 'Oversized Tee', '2025-08-06 10:00:54', 'V5XB80IHWY'),
(86, 0, 'm4b859dompe7tsi208tdc12tp8', 4, 'Now Mode On', 1500, 3, '1753986978_2.png', 'L', '', 'Oversized Tee', '2025-08-06 10:23:46', 'V5XB80IHWY'),
(87, 0, 'm4b859dompe7tsi208tdc12tp8', 6, 'Retro Reboot', 2000, 1, '6.png', '40', 'Red', 'Structured Polo', '2025-08-06 12:26:38', 'PDBRKL8Z4G'),
(88, 0, 'm4b859dompe7tsi208tdc12tp8', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'M', 'Red', 'Oversized Tee', '2025-08-06 12:33:25', 'TADM50P3FN'),
(89, 0, 'm4b859dompe7tsi208tdc12tp8', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'M', 'Red', 'Oversized Tee', '2025-08-06 13:21:39', 'GPM8RJAI45'),
(90, 0, 'm4b859dompe7tsi208tdc12tp8', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'M', 'Red', 'Oversized Tee', '2025-08-06 13:48:07', 'OE5U7KLHIX'),
(91, 0, 'm4b859dompe7tsi208tdc12tp8', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'L', 'Black', 'Oversized Tee', '2025-08-06 13:48:52', 'WHIZ93E281'),
(92, 0, 'm4b859dompe7tsi208tdc12tp8', 2, 'Now Mode On', 1500, 1, '1753975249_1.png', 'M', 'Red', 'Oversized Tee', '2025-08-06 13:49:40', '6RAWXPFO8S'),
(93, 0, 'm4b859dompe7tsi208tdc12tp8', 4, 'Now Mode On', 1500, 1, '1753986978_2.png', 'S', 'Red', 'Oversized Tee', '2025-08-06 14:06:17', 'AM2QTJ5BNP'),
(94, 0, 'm4b859dompe7tsi208tdc12tp8', 5, 'Retro Reboot', 2000, 1, '7.png', '40', 'Red', 'Structured Polo', '2025-08-06 15:15:59', 'CN56MRWK8V'),
(95, 0, 'm4b859dompe7tsi208tdc12tp8', 3, 'Now Mode On', 1500, 1, '1753986878_5.png', 'M', 'Blue', 'Oversized Tee', '2025-08-06 15:16:10', 'CN56MRWK8V'),
(96, 0, 't5bk7qt7mcmo333ob8lji4dd7m', 24, 'The Rebel Tee', 2000, 1, '1754566251_bone1.jpg', 'S', 'Green', 'Oversized Tee', '2025-08-07 15:44:59', 'RCZ9BO4EJW'),
(97, 0, 't5bk7qt7mcmo333ob8lji4dd7m', 26, 'The Rebel Tee', 2000, 1, 'default.png', 'S', 'Green', 'Oversized Tee', '2025-08-07 20:16:41', 'RP9C2XEFD4'),
(99, 0, '5j5o3psci6899it0cuqmnachtp', 28, 'The Rebel Tee', 2000, 1, '1754600184_4669.jpg', 'S', 'Green', 'Oversized Tee', '2025-08-08 07:05:37', 'O4EX8VMDRG'),
(100, 0, 'c4r19je8ui7bh8t9is019n39lb', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-09 20:27:01', 'XAGEHNK9MF'),
(102, 0, 'fqbkuq4be6o594cgspgldvpqnu', 37, 'The No-Filter Tee', 2000, 2, '1754745857_5311.png', 'S', 'Purple', 'Regular Fit Tee', '2025-08-10 04:55:48', 'FK0VSOZG6B'),
(103, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 05:13:38', '6UWCDHABPJ'),
(104, 0, 'fqbkuq4be6o594cgspgldvpqnu', 38, 'The Quiet Collar', 2000, 1, '1754748438_4706.png', 'M', 'Green', 'Henley Tee', '2025-08-10 05:13:48', '6UWCDHABPJ'),
(105, 0, 'fqbkuq4be6o594cgspgldvpqnu', 36, 'The Statement Polo', 2000, 1, '1754743724_1682.png', 'S', 'Blue', 'Structured Polo', '2025-08-10 05:25:59', 'WYRMD7GZX9'),
(106, 0, 'fqbkuq4be6o594cgspgldvpqnu', 37, 'The No-Filter Tee', 2000, 1, '1754745857_5311.png', 'M', 'Purple', 'Regular Fit Tee', '2025-08-10 05:26:08', 'WYRMD7GZX9'),
(107, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 05:35:43', 'GVB46C1QL0'),
(108, 0, 'fqbkuq4be6o594cgspgldvpqnu', 36, 'The Statement Polo', 2000, 1, '1754743724_9044.png', 'S', 'Black', 'Structured Polo', '2025-08-10 05:35:51', 'GVB46C1QL0'),
(109, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-10 09:34:35', 'CE4SJPZ52H'),
(110, 0, 'fqbkuq4be6o594cgspgldvpqnu', 38, 'The Quiet Collar', 2000, 1, '1754748438_6715.png', 'S', 'Red', 'Henley Tee', '2025-08-10 09:34:47', 'CE4SJPZ52H'),
(111, 0, 'fqbkuq4be6o594cgspgldvpqnu', 36, 'The Statement Polo', 2000, 1, '1754743724_1682.png', 'S', 'Blue', 'Structured Polo', '2025-08-10 09:35:04', 'CE4SJPZ52H'),
(112, 0, 'fqbkuq4be6o594cgspgldvpqnu', 36, 'The Statement Polo', 2000, 1, '1754743724_1682.png', 'M', 'Blue', 'Structured Polo', '2025-08-10 10:02:42', '7PDCI6Y8FM'),
(113, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-10 10:07:15', 'TZUX3JQA6Y'),
(114, 0, 'fqbkuq4be6o594cgspgldvpqnu', 36, 'The Statement Polo', 2000, 2, '1754746333_2114.png', 'S', 'Green', 'Structured Polo', '2025-08-10 10:16:25', '1WG82ZLFND'),
(115, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 11:02:06', '7TVG10F2JH'),
(116, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 11:08:25', '3NT6KGXHOW'),
(117, 0, 'fqbkuq4be6o594cgspgldvpqnu', 37, 'The No-Filter Tee', 2000, 1, '1754745857_9724.png', 'S', 'Green', 'Regular Fit Tee', '2025-08-10 11:08:34', '3NT6KGXHOW'),
(118, 0, 'fqbkuq4be6o594cgspgldvpqnu', 38, 'The Quiet Collar', 2000, 3, '1754748438_6715.png', 'S', 'Red', 'Henley Tee', '2025-08-10 11:08:45', '3NT6KGXHOW'),
(121, 0, 'fqbkuq4be6o594cgspgldvpqnu', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 11:50:01', '19K6VJELQ2'),
(122, 0, '80acqkuj5dlajgsl350hnfcfpj', 38, 'The Quiet Collar', 2000, 1, '1754748438_4706.png', 'S', 'Green', 'Henley Tee', '2025-08-10 15:21:12', 'OV8EILDRPQ'),
(123, 0, '80acqkuj5dlajgsl350hnfcfpj', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-10 15:21:23', 'OV8EILDRPQ'),
(124, 0, '80acqkuj5dlajgsl350hnfcfpj', 36, 'The Statement Polo', 2000, 1, '1754743724_9044.png', 'S', 'Black', 'Structured Polo', '2025-08-10 15:21:36', 'OV8EILDRPQ'),
(125, 0, '80acqkuj5dlajgsl350hnfcfpj', 37, 'The No-Filter Tee', 2000, 2, '1754745857_5311.png', 'M', 'Purple', 'Regular Fit Tee', '2025-08-10 15:21:51', 'OV8EILDRPQ'),
(126, 0, '80acqkuj5dlajgsl350hnfcfpj', 36, 'The Statement Polo', 2000, 1, '1754743724_9044.png', 'S', 'Black', 'Structured Polo', '2025-08-10 15:33:10', 'Y31I7CUVO6'),
(127, 0, '80acqkuj5dlajgsl350hnfcfpj', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 15:37:21', '031HVRMBJK'),
(128, 0, '80acqkuj5dlajgsl350hnfcfpj', 38, 'The Quiet Collar', 2000, 2, '1754748438_main_5976.png', 'S', 'White', 'Henley Tee', '2025-08-10 15:37:35', '031HVRMBJK'),
(129, 0, '80acqkuj5dlajgsl350hnfcfpj', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-10 15:52:13', 'V5TUWM8XNR'),
(130, 0, '80acqkuj5dlajgsl350hnfcfpj', 37, 'The No-Filter Tee', 2000, 1, '1754745857_5311.png', 'L', 'Purple', 'Regular Fit Tee', '2025-08-10 15:57:27', 'VIUM5C4KJ8'),
(131, 0, '80acqkuj5dlajgsl350hnfcfpj', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-10 15:58:51', 'GQDRVSWO0F'),
(132, 0, '80acqkuj5dlajgsl350hnfcfpj', 36, 'The Statement Polo', 2000, 1, '1754743724_9044.png', 'S', 'Black', 'Structured Polo', '2025-08-10 16:01:18', 'JNEABCKD4L'),
(133, 0, 'vlqaigmj74f5dr1n5g82u46grp', 37, 'The No-Filter Tee', 2000, 1, '1754745857_9724.png', 'L', 'Green', 'Regular Fit Tee', '2025-08-12 06:08:23', 'UMBLPWJK75'),
(134, 0, 'vlqaigmj74f5dr1n5g82u46grp', 38, 'The Quiet Collar', 2000, 1, '1754748438_6715.png', 'M', 'Red', 'Henley Tee', '2025-08-12 06:11:37', 'UMBLPWJK75'),
(135, 0, 'vlqaigmj74f5dr1n5g82u46grp', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'M', 'Green', 'Oversized Tee', '2025-08-12 09:25:59', 'UMBLPWJK75'),
(136, 0, 'vlqaigmj74f5dr1n5g82u46grp', 36, 'The Statement Polo', 2000, 1, '1754746333_2114.png', 'M', 'Green', 'Structured Polo', '2025-08-12 09:31:35', '3GFY5J1ZMP'),
(137, 0, 'vlqaigmj74f5dr1n5g82u46grp', 38, 'The Quiet Collar', 2000, 1, '1754748438_6715.png', 'L', 'Red', 'Henley Tee', '2025-08-12 09:39:22', 'HRM5V4TUZ3'),
(138, 0, 'vlqaigmj74f5dr1n5g82u46grp', 38, 'The Quiet Collar', 2000, 8, '1754748438_4706.png', 'L', 'Green', 'Henley Tee', '2025-08-12 09:42:00', '4398SUJTZH'),
(142, 0, 'ifk6g62raeo8q2iejc0p27elep', 38, 'The Quiet Collar', 2000, 2, '1754748438_4706.png', 'S', 'Green', 'Henley Tee', '2025-08-18 09:01:55', 'TXHGCYED3A'),
(143, 0, 'ifk6g62raeo8q2iejc0p27elep', 35, 'The Rebel Tee', 2000, 2, '1754743162_main_7988.png', 'S', 'Maroon', 'Oversized Tee', '2025-08-18 09:02:35', 'TXHGCYED3A'),
(146, 0, '4jduovrhujkhtckogfd6rui3cd', 35, 'The Rebel Tee', 2000, 1, '1754743162_main_7988.png', 'XL', 'Maroon', 'Oversized Tee', '2025-08-18 10:51:21', 'JINA8QUDZR'),
(147, 0, '771lnladcsvo9c4frauak9cq7h', 35, 'The Rebel Tee', 2000, 1, '1754743162_4642.png', 'L', 'White', 'Oversized Tee', '2025-08-18 11:44:26', 'H4YITV17XK'),
(150, 0, 'pspap1chn39bm0urg3bv9s2qgr', 37, 'The No-Filter Tee', 2000, 1, '1754745857_5311.png', 'S', 'Purple', 'Regular Fit Tee', '2025-08-18 12:25:46', '0COJB2WDVF'),
(153, 0, 'qvb5h61049qnhlavhpcifv1i4r', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-18 15:22:39', 'YVKCPX8BU9'),
(155, 0, '3kh6iiin3sgduadn3242cap9jh', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'XL', 'Green', 'Oversized Tee', '2025-08-18 19:01:48', 'FL87WSRN4U'),
(156, 0, '31epirbj9tq1oa5lnu1m1nhp6u', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-18 20:06:00', '0NZDXOM13L'),
(157, 0, '3kh6iiin3sgduadn3242cap9jh', 35, 'The Rebel Tee', 2000, 2, '1754743162_1830.png', 'XL', 'Green', 'Oversized Tee', '2025-08-18 20:07:11', 'COJWX74S0U'),
(158, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 35, 'The Rebel Tee', 2000, 1, '1754743162_1830.png', 'S', 'Green', 'Oversized Tee', '2025-08-21 06:31:45', 'P1EJWRH6KZ'),
(159, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 38, 'The Quiet Collar', 2000, 1, '1754748438_4706.png', 'S', 'Green', 'Henley Tee', '2025-08-21 07:59:43', '5OJF796BHA'),
(161, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 37, 'The No-Filter Tee', 2000, 1, '1754745857_9724.png', 'S', 'Green', 'Regular Fit Tee', '2025-08-21 10:52:02', 'TB1QF8NHP2'),
(163, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 39, 'The Rebel Tee', 2000, 2, '1755777465_4141.png', 'S', 'Blue', 'Oversized Tee', '2025-08-21 14:04:08', 'CJEGXINY3R'),
(164, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 43, 'The Statement Polo', 2000, 3, '1755784950_8808.png', 'M', 'Black', 'Structured Polo', '2025-08-21 14:04:29', 'CJEGXINY3R'),
(165, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 39, 'The Rebel Tee', 2000, 1, '1755777465_4141.png', 'M', 'Blue', 'Oversized Tee', '2025-08-21 14:24:52', '9PJU82530C'),
(166, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 40, 'The No-Filter Tee', 2000, 1, '1755777816_main_2445.jpg', 'S', 'Blue', 'Regular Fit Tee', '2025-08-21 14:33:56', 'R2NUT9HI16'),
(167, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 41, 'The Quiet Collar', 2000, 1, '1755778148_3700.png', 'S', 'Maroon', 'Henley Tee', '2025-08-21 14:36:05', '3GEXS1FDB6'),
(168, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 39, 'The Rebel Tee', 2000, 1, '1755777465_4141.png', 'S', 'Blue', 'Oversized Tee', '2025-08-21 14:42:29', 'I7MPXVAJOF'),
(169, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 41, 'The Quiet Collar', 2000, 1, '1755778148_main_6740.png', 'S', 'Black', 'Henley Tee', '2025-08-21 14:44:06', 'OEC13VZYF8'),
(170, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 43, 'The Statement Polo', 2000, 1, '1755784950_main_3734.png', 'S', 'Maroon', 'Structured Polo', '2025-08-21 14:45:27', 'M2KPJ4QXNA'),
(171, 0, '7k75vt4oh5h4mdtm6bc5ibdo1j', 39, 'The Rebel Tee', 2000, 1, '1755777465_main_8557.png', 'S', 'Green', 'Oversized Tee', '2025-08-21 14:49:38', 'OHLGNQW6X2');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_des` varchar(300) NOT NULL,
  `image` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_des`, `image`) VALUES
(4, 'Gen Z Fashion', 'Bold creativity defined by trend-driven individuality.', 'black2.jpg'),
(5, 'Millennial Fashion', 'Refined minimalism with a polished, modern touch.', 'millcatimg.png'),
(7, 'Boomer Fashion', 'Tailored elegance grounded in timeless confidence.', 'boomcatimg.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `client_sales_summary`
-- (See below for the actual view)
--
CREATE TABLE `client_sales_summary` (
`uname` varchar(255)
,`total_orders` bigint(21)
,`total_spending` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `proname` varchar(255) NOT NULL,
  `proqty` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `proprice` int(11) DEFAULT NULL,
  `selected_color` varchar(50) DEFAULT NULL,
  `selected_size` varchar(50) DEFAULT NULL,
  `shirt_type` varchar(100) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `selected_gender` varchar(50) DEFAULT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `work_phone` varchar(20) DEFAULT NULL,
  `delivery_area` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `shipping_charges` int(11) DEFAULT NULL,
  `item_tax` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Processing',
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`id`, `uid`, `tracking_number`, `quantity`, `product_id`, `proname`, `proqty`, `name`, `proprice`, `selected_color`, `selected_size`, `shirt_type`, `product_img`, `selected_gender`, `uname`, `email`, `work_phone`, `delivery_area`, `address`, `shipping_charges`, `item_tax`, `total_amount`, `order_status`, `city`, `country`, `postal_code`, `home_phone`, `cancel_reason`, `order_time`, `completed_at`) VALUES
(34, NULL, 'D7S3RI1Z5G', NULL, 1, 'Now Mode On', 1, NULL, 1500, 'Blue', 'S', 'Oversized Tee', '1753975094_3.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Shipped', NULL, NULL, NULL, NULL, NULL, '2025-08-05 19:43:16', '2025-08-05 19:44:19'),
(35, NULL, 'D7S3RI1Z5G', NULL, 2, 'Now Mode On', 1, NULL, 1500, 'Green', 'S', 'Oversized Tee', '1753975249_1.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-05 19:43:16', '2025-08-05 19:44:19'),
(36, NULL, 'D7S3RI1Z5G', NULL, 3, 'Now Mode On', 1, NULL, 1500, 'Blue', 'M', 'Oversized Tee', '1753986878_5.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-05 19:43:16', '2025-08-05 19:44:19'),
(37, NULL, 'D7S3RI1Z5G', NULL, 4, 'Now Mode On', 1, NULL, 1500, 'Black', 'L', 'Oversized Tee', '1753986978_2.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-05 19:43:16', '2025-08-05 19:44:19'),
(38, NULL, 'KSPO0YNFTZ', NULL, 1, 'Now Mode On', 1, NULL, 1500, 'Blue', 'S', 'Oversized Tee', '1753975094_3.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Delivered', NULL, NULL, NULL, NULL, NULL, '2025-08-05 20:11:45', '2025-08-05 20:12:56'),
(39, NULL, '074P6TQBJM', NULL, 2, 'Now Mode On', 1, NULL, 1500, 'Red', 'S', 'Oversized Tee', '1753975249_1.png', NULL, 'Jawad', 'jasim@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Delivered', NULL, NULL, NULL, NULL, NULL, '2025-08-05 17:30:26', '2025-08-05 20:50:58'),
(40, NULL, '074P6TQBJM', NULL, 12, 'Evergreen Ease', 2, NULL, 2500, 'Green', '42', 'Regular Fit Tee', '15.png', NULL, 'Jawad', 'jasim@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 500, 5800, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-05 17:30:26', '2025-08-05 20:50:58'),
(41, NULL, 'MTK3FYA6O2', NULL, 1, 'Now Mode On', 1, NULL, 1500, '', '', 'Oversized Tee', '1753975094_3.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Delivered', NULL, NULL, NULL, NULL, NULL, '2025-08-05 22:36:08', '2025-08-05 22:37:18'),
(42, NULL, 'MTK3FYA6O2', NULL, 4, 'Now Mode On', 1, NULL, 1500, '', '', 'Oversized Tee', '1753986978_2.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 150, 1950, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-05 22:36:08', '2025-08-05 22:37:18'),
(43, NULL, 'TCMD7VF38N', NULL, 1, 'Now Mode On', 2, NULL, 1500, '', '', 'Oversized Tee', '1753975094_3.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 300, 3600, 'Out for Delivery', NULL, NULL, NULL, NULL, NULL, '2025-08-06 14:22:54', '2025-08-06 14:23:43'),
(44, NULL, 'TCMD7VF38N', NULL, 9, 'Retro Reboot', 1, NULL, 2000, '', '', 'Structured Polo', '10.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', NULL, NULL, NULL, NULL, NULL, '2025-08-06 14:22:54', '2025-08-06 14:23:43'),
(45, NULL, 'CE4SJPZ52H', NULL, 35, 'The Rebel Tee', 1, NULL, 2000, 'Green', 'S', 'Oversized Tee', '1754743162_1830.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03133998234', NULL, '2025-08-10 14:41:09', '2025-08-10 14:57:52'),
(46, NULL, 'CE4SJPZ52H', NULL, 36, 'The Statement Polo', 1, NULL, 2000, 'Blue', 'S', 'Structured Polo', '1754743724_1682.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03133998234', NULL, '2025-08-10 14:41:09', '2025-08-10 14:57:52'),
(47, NULL, 'CE4SJPZ52H', NULL, 38, 'The Quiet Collar', 1, NULL, 2000, 'Red', 'S', 'Henley Tee', '1754748438_6715.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03133998234', NULL, '2025-08-10 14:41:09', '2025-08-10 14:57:52'),
(48, NULL, '7PDCI6Y8FM', NULL, 36, 'The Statement Polo', 1, NULL, 2000, 'Blue', 'M', 'Structured Polo', '1754743724_1682.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Shipped', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 15:02:59', '2025-08-10 15:03:47'),
(49, NULL, 'TZUX3JQA6Y', NULL, 35, 'The Rebel Tee', 1, NULL, 2000, 'Green', 'S', 'Oversized Tee', '1754743162_1830.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03133998234', NULL, '2025-08-10 15:07:29', '2025-08-10 15:08:31'),
(50, NULL, '1WG82ZLFND', NULL, 36, 'The Statement Polo', 2, NULL, 2000, 'Green', 'S', 'Structured Polo', '1754746333_2114.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 400, 4700, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 15:16:39', '2025-08-10 15:17:07'),
(51, NULL, '3NT6KGXHOW', NULL, 35, 'The Rebel Tee', 1, NULL, 2000, 'Maroon', 'S', 'Oversized Tee', '1754743162_main_7988.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 16:09:03', '2025-08-10 16:10:29'),
(52, NULL, '3NT6KGXHOW', NULL, 37, 'The No-Filter Tee', 1, NULL, 2000, 'Green', 'S', 'Regular Fit Tee', '1754745857_9724.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 16:09:03', '2025-08-10 16:10:29'),
(53, NULL, '3NT6KGXHOW', NULL, 38, 'The Quiet Collar', 3, NULL, 2000, 'Red', 'S', 'Henley Tee', '1754748438_6715.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 600, 6900, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 16:09:03', '2025-08-10 16:10:29'),
(54, NULL, 'VIUM5C4KJ8', NULL, 37, 'The No-Filter Tee', 1, NULL, 2000, 'Purple', 'L', 'Regular Fit Tee', '1754745857_5311.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Gulistan e Johar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 250, 200, 2450, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-10 20:57:42', '2025-08-10 20:58:16'),
(55, NULL, 'UMBLPWJK75', NULL, 35, 'The Rebel Tee', 1, NULL, 2000, 'Green', 'M', 'Oversized Tee', '1754743162_1830.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Gulistan e Johar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 250, 200, 2450, 'Shipped', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-12 14:26:44', '2025-08-12 14:27:51'),
(56, NULL, 'UMBLPWJK75', NULL, 37, 'The No-Filter Tee', 1, NULL, 2000, 'Green', 'L', 'Regular Fit Tee', '1754745857_9724.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Gulistan e Johar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 250, 200, 2450, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-12 14:26:44', '2025-08-12 14:27:51'),
(57, NULL, 'UMBLPWJK75', NULL, 38, 'The Quiet Collar', 1, NULL, 2000, 'Red', 'M', 'Henley Tee', '1754748438_6715.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Gulistan e Johar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 250, 200, 2450, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-12 14:26:44', '2025-08-12 14:27:51'),
(58, NULL, 'TXHGCYED3A', NULL, 35, 'The Rebel Tee', 2, NULL, 2000, 'Maroon', 'S', 'Oversized Tee', '1754743162_main_7988.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 400, 4700, 'Out for Delivery', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-18 14:03:12', '2025-08-18 14:04:47'),
(59, NULL, 'TXHGCYED3A', NULL, 38, 'The Quiet Collar', 2, NULL, 2000, 'Green', 'S', 'Henley Tee', '1754748438_4706.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 400, 4700, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-18 14:03:12', '2025-08-18 14:04:47'),
(60, NULL, '0NZDXOM13L', NULL, 35, 'The Rebel Tee', 1, NULL, 2000, 'Green', 'S', 'Oversized Tee', '1754743162_1830.png', NULL, 'Jawad', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-19 01:06:30', '2025-08-20 17:40:56'),
(61, NULL, 'CJEGXINY3R', NULL, 39, 'The Rebel Tee', 2, NULL, 2000, 'Blue', 'S', 'Oversized Tee', '1755777465_4141.png', NULL, 'Guest', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 400, 4700, 'Out for Delivery', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:04:59', '2025-08-21 19:19:29'),
(62, NULL, 'CJEGXINY3R', NULL, 43, 'The Statement Polo', 3, NULL, 2000, 'Black', 'M', 'Structured Polo', '1755784950_8808.png', NULL, 'Guest', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 600, 6900, 'Processing', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:04:59', '2025-08-21 19:19:29'),
(63, NULL, '9PJU82530C', NULL, 39, 'The Rebel Tee', 1, NULL, 2000, 'Blue', 'M', 'Oversized Tee', '1755777465_4141.png', NULL, 'Guest', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Delivered', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:25:09', '2025-08-21 19:29:21'),
(64, NULL, 'R2NUT9HI16', NULL, 40, 'The No-Filter Tee', 1, NULL, 2000, 'Blue', 'S', 'Regular Fit Tee', '1755777816_main_2445.jpg', NULL, 'Guest', 'jawadulbahar@gmail.com', '03133998234', 'Saddar', 'House no F79, Defence veiw, Phase 2, near Majid e Attar', 300, 200, 2500, 'Shipped', 'karachi', 'Pakistan', '75500', '03021357103', NULL, '2025-08-21 19:34:10', '2025-08-21 19:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_settings`
--

CREATE TABLE `delivery_settings` (
  `id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_settings`
--

INSERT INTO `delivery_settings` (`id`, `area_name`, `charges`, `updated_at`) VALUES
(2, 'Saddar', 300.00, '2025-07-23 20:11:39'),
(3, 'Korangi', 200.00, '2025-07-23 20:13:50'),
(4, 'Gulistan e Johar', 250.00, '2025-07-23 20:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `proname` varchar(255) NOT NULL,
  `proprice` decimal(10,2) NOT NULL,
  `proqty` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `work_phone` varchar(20) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_img` varchar(255) NOT NULL,
  `tracking_number` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `selected_color` varchar(50) DEFAULT NULL,
  `selected_size` varchar(50) DEFAULT NULL,
  `shirt_type` varchar(100) DEFAULT NULL,
  `delivery_area` varchar(100) DEFAULT NULL,
  `shipping_charges` decimal(10,2) DEFAULT 0.00,
  `item_tax` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_time` datetime DEFAULT current_timestamp(),
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `cancel_reason` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `colors` varchar(255) DEFAULT NULL,
  `shirt_type` varchar(100) DEFAULT NULL,
  `sizes` varchar(100) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(4000) NOT NULL,
  `tax_percent` decimal(5,2) DEFAULT 0.00,
  `show_tax` tinyint(1) DEFAULT 0,
  `avg_rating` decimal(3,2) DEFAULT 0.00,
  `total_ratings` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `qty`, `colors`, `shirt_type`, `sizes`, `cat_id`, `image`, `tax_percent`, `show_tax`, `avg_rating`, `total_ratings`) VALUES
(39, 'The Rebel Tee', 'A relaxed, street-inspired essential with effortless edge.', '2000', 10, 'Green, Blue, White', 'Oversized Tee', 'S, M, L, XL', 4, '1755777465_main_8557.png', 10.00, 1, 2.00, 1),
(40, 'The No-Filter Tee', 'A sharp, modern polo that balances casual and refined.', '2000', 10, 'Blue, Green', 'Regular Fit Tee', 'S, M, L, XL', 5, '1755777816_main_2445.jpg', 10.00, 1, 0.00, 0),
(41, 'The Quiet Collar', 'A subtle button-front classic with understated character.', '2000', 10, 'Black, Maroon', 'Henley Tee', 'S, M, L, XL', 5, '1755778148_main_6740.png', 10.00, 1, 0.00, 0),
(43, 'The Statement Polo', 'A sharp, modern polo that balances casual and refined.', '2000', 10, 'Maroon, Green, Black, Purple', 'Structured Polo', 'S, M, L, XL', 7, '1755784950_main_3734.png', 10.00, 1, 2.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('front','back') NOT NULL DEFAULT 'front'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `color`, `image`, `type`) VALUES
(110, 39, 'Green', '1755777465_main_8557.png', 'front'),
(111, 39, 'Green', '1755777465_6331.png', 'back'),
(112, 39, 'Blue', '1755777465_4141.png', 'front'),
(113, 39, 'Blue', '1755777465_1935.png', 'back'),
(114, 39, 'White', '1755777465_6850.png', 'front'),
(115, 39, 'White', '1755777465_9311.png', 'back'),
(116, 40, 'Blue', '1755777816_main_2445.jpg', 'front'),
(117, 40, 'Blue', '1755777816_6565.jpg', 'back'),
(118, 40, 'Green', '1755777816_3352.png', 'front'),
(119, 40, 'Green', '1755777816_2468.png', 'back'),
(120, 41, 'Black', '1755778148_main_6740.png', 'front'),
(121, 41, 'Black', '1755778148_3397.png', 'back'),
(122, 41, 'Maroon', '1755778148_3700.png', 'front'),
(123, 41, 'Maroon', '1755778148_8363.png', 'back'),
(125, 43, 'Maroon', '1755784950_main_3734.png', 'front'),
(126, 43, 'Maroon', '1755784950_5153.png', 'back'),
(127, 43, 'Green', '1755784950_5462.png', 'front'),
(128, 43, 'Green', '1755784950_5569.png', 'back'),
(129, 43, 'Black', '1755784950_8808.png', 'front'),
(130, 43, 'Black', '1755784950_6926.png', 'back'),
(131, 43, 'Purple', '1755784950_2670.png', 'front'),
(132, 43, 'Purple', '1755784950_6917.png', 'back');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `user_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 36, '694162', 1, '2025-08-21 07:53:49', '2025-08-21 08:06:41'),
(2, 37, '694162', 2, '2025-08-21 07:55:50', '2025-08-21 07:57:40'),
(3, 35, '694162', 2, '2025-08-21 07:57:51', '2025-08-21 07:57:51'),
(4, 38, '694162', 1, '2025-08-21 07:57:54', '2025-08-21 08:06:24'),
(5, 35, 'guest_68a6d9817fa2b_1755765121', 5, '2025-08-21 08:32:01', '2025-08-21 08:32:01'),
(6, 37, 'guest_68a6e95d45466_1755769181', 5, '2025-08-21 09:39:41', '2025-08-21 09:39:41'),
(7, 39, '632815', 2, '2025-08-21 11:58:24', '2025-08-21 11:58:24'),
(8, 43, '632815', 2, '2025-08-21 14:03:13', '2025-08-21 14:03:13');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_sales_summary`
-- (See below for the actual view)
--
CREATE TABLE `product_sales_summary` (
);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_reports`
--

CREATE TABLE `sales_reports` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `total_quantity_sold` int(11) DEFAULT NULL,
  `total_product_revenue` int(11) DEFAULT NULL,
  `total_tax` int(11) DEFAULT NULL,
  `total_shipping` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `last_completed_at` datetime DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_reports`
--

INSERT INTO `sales_reports` (`id`, `product_id`, `product_name`, `total_quantity_sold`, `total_product_revenue`, `total_tax`, `total_shipping`, `grand_total`, `last_completed_at`, `generated_at`) VALUES
(1, 1, 'Now Mode On', 5, 7500, 750, 1200, 9450, '2025-08-06 14:23:43', '2025-08-06 09:23:43'),
(2, 2, 'Now Mode On', 2, 3000, 300, 600, 3900, '2025-08-05 20:50:58', '2025-08-06 09:23:43'),
(3, 4, 'Now Mode On', 2, 3000, 300, 600, 3900, '2025-08-05 22:37:18', '2025-08-06 09:23:43'),
(4, 15, 'For Test', 1, 1500, 150, 300, 1950, '2025-07-29 19:24:51', '2025-07-29 14:24:51'),
(6, 11, 'Evergreen Ease', 1, 2500, 250, 300, 3050, '2025-08-02 18:40:26', '2025-08-05 14:24:06'),
(14, 3, 'Now Mode On', 1, 1500, 150, 300, 1950, '2025-08-05 19:44:19', '2025-08-06 09:23:43'),
(21, 6, 'Retro Reboot', 2, 4000, 400, 550, 4950, '2025-08-05 19:22:07', '2025-08-05 14:24:06'),
(23, 13, 'Evergreen Ease', 1, 2500, 250, 300, 3050, '2025-08-05 14:21:06', '2025-08-05 14:24:06'),
(28, 8, 'Retro Reboot', 1, 2000, 200, 300, 2500, '2025-08-05 19:24:06', '2025-08-05 14:24:06'),
(33, 12, 'Evergreen Ease', 2, 5000, 500, 300, 5800, '2025-08-05 20:50:58', '2025-08-06 09:23:43'),
(35, 9, 'Retro Reboot', 1, 2000, 200, 300, 2500, '2025-08-06 14:23:43', '2025-08-06 09:23:43'),
(37, 35, 'The Rebel Tee', 7, 14000, 1400, 1750, 17150, '2025-08-20 17:40:56', '2025-08-20 12:40:56'),
(38, 36, 'The Statement Polo', 4, 8000, 800, 900, 9700, '2025-08-10 15:17:07', '2025-08-20 12:40:56'),
(39, 38, 'The Quiet Collar', 7, 14000, 1400, 1150, 16550, '2025-08-18 14:04:47', '2025-08-20 12:40:56'),
(43, 37, 'The No-Filter Tee', 3, 6000, 600, 800, 7400, '2025-08-12 14:27:51', '2025-08-20 12:40:56'),
(49, 39, 'The Rebel Tee', 3, 6000, 600, 600, 7200, '2025-08-21 19:29:21', '2025-08-21 14:34:42'),
(50, 43, 'The Statement Polo', 3, 6000, 600, 300, 6900, '2025-08-21 19:19:29', '2025-08-21 14:34:42'),
(53, 40, 'The No-Filter Tee', 1, 2000, 200, 300, 2500, '2025-08-21 19:34:42', '2025-08-21 14:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `pass`, `role`) VALUES
(1, 'Jawad', ' Bahar', 'jawadulbahar@gmail.com', '123', 'admin'),
(2, 'Ali', ' Hyder', 'ali@gmail.com', '123', 'user'),
(4, 'Abdul', 'Rehman', 'rehman@gmail.com', '321', 'user'),
(5, 'Abdullah', 'Murshid', 'abdullah@gmail.com', '321', 'admin'),
(6, 'Jawad', 'U l Bahar', 'jawadulbahar@gmail.com', '112', 'admin'),
(7, 'Ali ', 'Usama', 'aliusama@gmail.com', 'ali1', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_top_categories`
-- (See below for the actual view)
--
CREATE TABLE `vw_top_categories` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_top_clients`
-- (See below for the actual view)
--
CREATE TABLE `vw_top_clients` (
`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(50)
,`total_orders` bigint(21)
,`total_items_purchased` decimal(32,0)
,`total_spent` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_top_products`
-- (See below for the actual view)
--
CREATE TABLE `vw_top_products` (
);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(65, '174351', 1),
(1, '423923', 1),
(2, '423923', 2),
(3, '423923', 3),
(4, '423923', 4),
(7, '423923', 6),
(6, '423923', 8),
(5, '423923', 9),
(8, '423923', 12),
(9, '423923', 123),
(143, '442581', 35),
(83, '447760', 37),
(11, '504307', 123),
(70, '565782', 17),
(10, '648685', 123),
(82, '783424', 38),
(23, '838302', 2),
(42, '867487', 2),
(134, '878324', 38),
(145, '931606', 35),
(63, 'hcsgvaeqkq6l9oensn68ae60pu', 1),
(64, 'hcsgvaeqkq6l9oensn68ae60pu', 2);

-- --------------------------------------------------------

--
-- Structure for view `client_sales_summary`
--
DROP TABLE IF EXISTS `client_sales_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_sales_summary`  AS SELECT `o`.`uname` AS `uname`, count(0) AS `total_orders`, coalesce(sum(`o`.`proqty` * `o`.`proprice`),0) AS `total_spending` FROM `orders` AS `o` WHERE `o`.`uname` is not null GROUP BY `o`.`uname` ORDER BY coalesce(sum(`o`.`proqty` * `o`.`proprice`),0) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `product_sales_summary`
--
DROP TABLE IF EXISTS `product_sales_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_sales_summary`  AS SELECT `p`.`name` AS `proname`, coalesce(sum(`o`.`proqty`),0) AS `total_quantity_sold`, coalesce(sum(`o`.`proqty` * `o`.`proprice`),0) AS `total_revenue` FROM (`products` `p` left join `orders` `o` on(`p`.`id` = `o`.`proid`)) GROUP BY `p`.`id`, `p`.`name` ORDER BY coalesce(sum(`o`.`proqty`),0) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_top_categories`
--
DROP TABLE IF EXISTS `vw_top_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_top_categories`  AS SELECT `c`.`cat_name` AS `cat_name`, `c`.`cat_des` AS `description`, count(distinct `p`.`id`) AS `total_products`, coalesce(sum(`o`.`proqty`),0) AS `total_items_sold`, coalesce(sum(`o`.`proprice` * `o`.`proqty`),0) AS `total_revenue` FROM ((`categories` `c` left join `products` `p` on(`c`.`id` = `p`.`cat_id`)) left join `orders` `o` on(`p`.`id` = `o`.`proid`)) GROUP BY `c`.`id`, `c`.`cat_name`, `c`.`cat_des` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_top_clients`
--
DROP TABLE IF EXISTS `vw_top_clients`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_top_clients`  AS SELECT `u`.`fname` AS `first_name`, `u`.`lname` AS `last_name`, `u`.`email` AS `email`, count(`o`.`uid`) AS `total_orders`, coalesce(sum(`o`.`proqty`),0) AS `total_items_purchased`, coalesce(sum(`o`.`proprice` * `o`.`proqty`),0) AS `total_spent` FROM (`users` `u` left join `orders` `o` on(`u`.`fname` = `o`.`uname`)) WHERE `u`.`role` = 'user' GROUP BY `u`.`id`, `u`.`fname`, `u`.`lname`, `u`.`email` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_top_products`
--
DROP TABLE IF EXISTS `vw_top_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_top_products`  AS SELECT `p`.`id` AS `product_id`, `p`.`name` AS `product_name`, `p`.`price` AS `unit_price`, `p`.`qty` AS `current_stock`, coalesce(sum(`o`.`proqty`),0) AS `total_quantity_sold`, coalesce(sum(`o`.`proprice` * `o`.`proqty`),0) AS `total_revenue`, `c`.`cat_name` AS `category_name`, CASE WHEN `p`.`qty` <= 10 THEN 'Low Stock' WHEN `p`.`qty` <= 30 THEN 'Medium Stock' ELSE 'Sufficient Stock' END AS `stock_status` FROM ((`products` `p` left join `orders` `o` on(`p`.`id` = `o`.`proid`)) join `categories` `c` on(`p`.`cat_id` = `c`.`id`)) GROUP BY `p`.`id`, `p`.`name`, `p`.`price`, `p`.`qty`, `c`.`cat_name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_orders_backup`
--
ALTER TABLE `all_orders_backup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_products` (`product_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_settings`
--
ALTER TABLE `delivery_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_products` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product_rating` (`product_id`,`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rating` (`rating`),
  ADD KEY `idx_product_ratings_product_id` (`product_id`),
  ADD KEY `idx_product_ratings_user_id` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_reports`
--
ALTER TABLE `sales_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_orders_backup`
--
ALTER TABLE `all_orders_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `delivery_settings`
--
ALTER TABLE `delivery_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_reports`
--
ALTER TABLE `sales_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orders_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 11:43 AM
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
-- Database: `coffee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` enum('small','medium','large') NOT NULL,
  `milk_type` varchar(50) NOT NULL,
  `sweetness` varchar(50) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `size`, `milk_type`, `sweetness`, `special_instructions`, `price`, `created_at`, `updated_at`) VALUES
(2, 28, 2, 1, 'large', 'almond', 'light', '', 6.00, '2025-11-14 02:29:44', '2025-11-14 02:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipping_address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `total_amount`, `status`, `created_at`, `updated_at`, `shipping_address`, `phone`, `payment_method`, `order_date`) VALUES
(6, 'ORD-000006', 28, 6.00, 'pending', '2025-11-14 02:51:54', '2025-11-14 13:02:13', NULL, NULL, NULL, '2025-11-14 19:39:19'),
(7, 'ORD-000007', 29, 4.75, 'pending', '2025-11-14 02:53:14', '2025-11-14 13:02:13', NULL, NULL, NULL, '2025-11-14 19:39:19'),
(8, 'ORD-000008', 29, 24.00, 'pending', '2025-11-14 04:21:19', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'credit_card', '2025-11-14 12:21:19'),
(9, 'ORD-000009', 29, 24.00, 'pending', '2025-11-14 04:21:51', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'credit_card', '2025-11-14 12:21:51'),
(10, 'ORD-000010', 29, 24.00, 'pending', '2025-11-14 04:22:06', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-14 12:22:06'),
(11, 'ORD-000011', 29, 24.00, 'pending', '2025-11-14 04:29:00', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'credit_card', '2025-11-14 12:29:00'),
(12, 'ORD-000012', 29, 24.00, 'pending', '2025-11-14 04:31:14', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'credit_card', '2025-11-14 12:31:14'),
(13, 'ORD-000013', 29, 24.00, 'pending', '2025-11-14 04:33:29', '2025-11-14 13:02:13', 'Tondo Manila', '0961 236 0247', 'credit_card', '2025-11-14 12:33:29'),
(16, 'ORD-000016', 29, 24.00, 'pending', '2025-11-14 04:58:05', '2025-11-14 13:02:13', 'Tondo', '0961 236 0247', 'cash', '2025-11-14 20:58:05'),
(17, 'ORD-000017', 29, 4.75, 'pending', '2025-11-14 05:06:40', '2025-11-14 05:06:40', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-14 21:06:40'),
(18, 'ORD-000018', 29, 9.50, 'pending', '2025-11-14 05:07:50', '2025-11-14 05:07:50', 'Lian', '0961 236 0247', 'cash', '2025-11-14 21:07:50'),
(19, 'ORD-2025111413131178', 29, 9.50, 'pending', '2025-11-14 05:13:11', '2025-11-14 05:13:11', 'Manila', '0961 236 0247', 'card', '2025-11-14 21:13:11'),
(20, 'ORD-2025111413154559', 29, 4.00, 'pending', '2025-11-14 05:15:45', '2025-11-14 05:15:45', 'DITO SA KANTO', '0961 236 0247', 'cash', '2025-11-14 21:15:45'),
(21, 'ORD-2025111413231583', 29, 4.25, 'pending', '2025-11-14 05:23:15', '2025-11-14 05:23:15', 'dito', '0961 236 0247', 'cash', '2025-11-14 21:23:15'),
(22, 'ORD-2025111413263895', 29, 4.75, 'pending', '2025-11-14 05:26:38', '2025-11-14 05:26:38', 'g', '0961 236 0247', 'cash', '2025-11-14 21:26:38'),
(23, 'ORD-2025111413400218', 29, 118.75, 'completed', '2025-11-14 05:40:02', '2025-11-14 05:40:02', 'j', '0961 236 0247', 'cash', '2025-11-14 21:40:02'),
(24, 'ORD-2025111413404620', 29, 324.00, 'completed', '2025-11-14 05:40:46', '2025-11-14 05:40:46', 'Tondo', '0961 236 0247', 'cash', '2025-11-14 21:40:46'),
(25, 'ORD-2025111413411159', 29, 36.00, 'completed', '2025-11-14 05:41:11', '2025-11-14 05:41:11', 'sa tabi tabi ', '0961 236 0247', 'cash', '2025-11-14 21:41:11'),
(26, 'ORD-2025111413431641', 3, 5.25, 'completed', '2025-11-14 05:43:16', '2025-11-14 05:43:16', 'tondo', '0961 236 0247', 'cash', '2025-11-14 21:43:16'),
(27, 'ORD-2025111413452039', 3, 4.75, 'completed', '2025-11-14 05:45:20', '2025-11-14 05:45:20', 'f', '0961 236 0247', 'cash', '2025-11-14 21:45:20'),
(28, 'ORD-2025111513210558', 3, 4.75, 'completed', '2025-11-15 05:21:05', '2025-11-15 05:21:05', 'Tondo Manila ', '0961 236 0247', 'cash', '2025-11-15 21:21:05'),
(29, 'ORD-2025111608153985', 3, 8.75, 'completed', '2025-11-16 00:15:39', '2025-11-16 00:15:39', 'Tondo ', '0961 236 0247', 'card', '2025-11-16 16:15:39'),
(30, 'ORD-2025111608544740', 3, 4.75, 'completed', '2025-11-16 00:54:47', '2025-11-16 00:54:47', 'Manila', '0961 236 0247', 'cash', '2025-11-16 16:54:47'),
(31, 'ORD-2025111610375840', 30, 4.75, 'completed', '2025-11-16 02:37:58', '2025-11-16 02:37:58', 'Tabi tabi', '0961 236 0247', 'cash', '2025-11-16 18:37:58'),
(32, 'ORD-2025111611334921', 30, 4.00, 'completed', '2025-11-16 03:33:49', '2025-11-16 03:33:49', 'Tondo', '0961 236 0247', 'cash', '2025-11-16 19:33:49'),
(33, 'ORD-2025111614092690', 3, 8.75, 'completed', '2025-11-16 06:09:26', '2025-11-16 06:09:26', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-16 22:09:26'),
(34, 'ORD-2025111614113014', 3, 5.50, 'completed', '2025-11-16 06:11:30', '2025-11-16 06:11:30', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-16 22:11:30'),
(35, 'ORD-2025111614155136', 3, 4.00, 'completed', '2025-11-16 06:15:51', '2025-11-16 06:15:51', 'Tondo', '0961 236 0247', 'cash', '2025-11-16 22:15:51'),
(36, 'ORD-2025111614200352', 3, 5.50, 'completed', '2025-11-16 06:20:03', '2025-11-16 06:20:03', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-16 22:20:03'),
(37, 'ORD-2025111614304913', 3, 5.50, 'completed', '2025-11-16 06:30:49', '2025-11-16 06:30:49', 'Manila', '0961 236 0247', 'cash', '2025-11-16 22:30:49'),
(38, 'ORD-2025111614341146', 3, 5.50, 'completed', '2025-11-16 06:34:11', '2025-11-16 06:34:11', 'Manila', '0961 236 0247', 'cash', '2025-11-16 22:34:11'),
(39, 'ORD-2025111614363093', 32, 4.50, 'completed', '2025-11-16 06:36:30', '2025-11-16 06:36:30', 'Mindanao', '0961 236 0247', 'cash', '2025-11-16 22:36:30'),
(40, 'ORD-2025111614422237', 33, 5.50, 'completed', '2025-11-16 06:42:22', '2025-11-16 06:42:22', 'Bulacan', '0923 456 7890', 'cash', '2025-11-16 22:42:22'),
(42, 'ORD-2025111706035556', 3, 5.25, 'completed', '2025-11-16 22:03:55', '2025-11-16 22:03:55', 'Tondo Manila', '0961 236 0247', 'cash', '2025-11-17 14:03:55'),
(43, 'ORD-2025111706144341', 3, 11.00, 'completed', '2025-11-16 22:14:43', '2025-11-16 22:14:43', 'Tondo Manila', '0923 456 7890', 'cash', '2025-11-17 14:14:43'),
(44, 'ORD-2025111707102767', 3, 12.00, 'completed', '2025-11-16 23:10:27', '2025-11-16 23:10:27', 'Tondo', '0961 236 0247', 'cash', '2025-11-17 15:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `size` varchar(20) DEFAULT 'medium',
  `milk_type` varchar(50) DEFAULT 'whole',
  `sweetness` varchar(20) DEFAULT 'regular',
  `special_instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `size`, `milk_type`, `sweetness`, `special_instructions`) VALUES
(1, 16, 6, 1, 4.50, '2025-11-14 04:58:05', 'medium', 'whole', 'light', ''),
(2, 16, 3, 1, 5.25, '2025-11-14 04:58:05', 'medium', 'whole', 'light', ''),
(3, 16, 2, 3, 4.75, '2025-11-14 04:58:05', 'medium', 'whole', 'light', ''),
(4, 19, 2, 2, 4.75, '2025-11-14 05:13:11', 'medium', 'whole', 'light', ''),
(5, 20, 1, 1, 4.00, '2025-11-14 05:15:45', 'medium', 'whole', 'light', ''),
(6, 21, 5, 1, 4.25, '2025-11-14 05:23:15', 'medium', 'whole', 'light', ''),
(7, 22, 2, 1, 4.75, '2025-11-14 05:26:38', 'medium', 'whole', 'light', ''),
(8, 23, 2, 5, 23.75, '2025-11-14 05:40:02', 'medium', 'whole', 'light', ''),
(9, 24, 1, 9, 36.00, '2025-11-14 05:40:46', 'medium', 'whole', 'light', ''),
(10, 25, 1, 3, 12.00, '2025-11-14 05:41:11', 'medium', 'whole', 'light', ''),
(11, 26, 3, 1, 5.25, '2025-11-14 05:43:16', 'medium', 'whole', 'light', ''),
(12, 27, 2, 1, 4.75, '2025-11-14 05:45:20', 'medium', 'whole', 'light', ''),
(13, 28, 2, 1, 4.75, '2025-11-15 05:21:05', 'medium', 'whole', 'regular', ''),
(14, 29, 1, 1, 4.00, '2025-11-16 00:15:39', 'medium', 'whole', 'light', ''),
(15, 29, 2, 1, 4.75, '2025-11-16 00:15:39', 'medium', 'whole', 'light', ''),
(16, 30, 2, 1, 4.75, '2025-11-16 00:54:47', 'medium', 'whole', 'light', ''),
(17, 31, 2, 1, 4.75, '2025-11-16 02:37:58', 'medium', 'whole', 'light', ''),
(18, 32, 1, 1, 4.00, '2025-11-16 03:33:49', 'medium', 'whole', 'light', ''),
(19, 33, 2, 1, 4.75, '2025-11-16 06:09:26', 'medium', 'whole', 'light', ''),
(20, 33, 1, 1, 4.00, '2025-11-16 06:09:26', 'medium', 'whole', 'light', ''),
(21, 34, 7, 1, 5.50, '2025-11-16 06:11:30', 'medium', 'whole', 'light', ''),
(22, 35, 1, 1, 4.00, '2025-11-16 06:15:51', 'medium', 'whole', 'light', ''),
(23, 36, 4, 1, 5.50, '2025-11-16 06:20:03', 'medium', 'whole', 'light', ''),
(24, 37, 11, 1, 5.50, '2025-11-16 06:30:49', 'medium', 'whole', 'light', ''),
(25, 38, 4, 1, 5.50, '2025-11-16 06:34:11', 'medium', 'whole', 'light', ''),
(26, 39, 9, 1, 4.50, '2025-11-16 06:36:30', 'medium', 'whole', 'light', ''),
(27, 40, 7, 1, 5.50, '2025-11-16 06:42:22', 'medium', 'whole', 'none', ''),
(29, 42, 3, 1, 5.25, '2025-11-16 22:03:55', 'medium', 'whole', 'light', ''),
(30, 43, 7, 1, 5.50, '2025-11-16 22:14:43', 'medium', 'whole', 'light', ''),
(31, 43, 11, 1, 5.50, '2025-11-16 22:14:43', 'medium', 'whole', 'light', ''),
(32, 44, 1, 3, 4.00, '2025-11-16 23:10:27', 'medium', 'whole', 'light', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `category` varchar(100) DEFAULT NULL,
  `is_featured` tinyint(4) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `stock`, `category`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Espresso', 'Strong and concentrated coffee', 3.50, '1763292404_5460bc0be22103fc2916.jpg', 44, 'Coffee', 1, 'active', '2025-11-03 12:02:45', '2025-11-16 23:10:27'),
(2, 'Cappuccino', 'Espresso with steamed milk foam', 4.25, '1763295736_65d2c4e643828871efa8.jpg', 48, 'Coffee', 1, 'active', '2025-11-03 12:02:45', '2025-11-16 06:09:26'),
(3, 'Latte', 'Espresso with steamed milk', 4.75, '1763295698_9c42081cd940106b7f12.jpg', 38, 'Coffee', 0, 'active', '2025-11-03 12:02:45', '2025-11-16 22:03:55'),
(4, 'Mocha', 'Chocolate flavored coffee', 5.00, '1763295749_86727e9f054d7045d6d6.avif', 33, 'Coffee', 1, 'active', '2025-11-03 12:02:45', '2025-11-16 06:34:11'),
(5, 'Americano', 'Espresso with hot water', 3.75, '1763295760_dfe45e856ee00462454c.webp', 55, 'Coffee', 0, 'active', '2025-11-03 12:02:45', '2025-11-16 04:22:40'),
(6, 'Macchiato', 'Espresso with a dollop of milk', 4.50, '1763295777_23db066277826ece433c.png', 30, 'Coffee', 0, 'active', '2025-11-03 12:02:45', '2025-11-16 06:48:19'),
(7, 'Matcha Latte', 'Experience pure Japanese matcha', 5.00, '1763295655_e0c43a1f26dbfc0b4ccf.jpg', 21, 'Coffee', 0, 'active', '2025-11-16 04:15:02', '2025-11-16 22:14:43'),
(9, 'Turkish Coffee', 'Finely ground coffee boiled in a pot (cezve)', 4.00, '1763297249_c8f31ac6a4617c2fd7af.jpg', 22, 'Coffee', 0, 'active', '2025-11-16 04:47:29', '2025-11-16 06:36:30'),
(10, 'Vietnamese Iced Coffee', 'Strong dark roast with sweetened condensed milk', 2.00, '1763297319_20d4658a41534f99142a.jpg', 23, 'Coffee', 0, 'active', '2025-11-16 04:48:39', '2025-11-16 06:47:45'),
(11, 'Café au Lait', 'French drink of strong brewed coffee with steamed milk', 5.00, '1763297378_a62a62e3a92c348b5475.jpg', 21, 'Coffee', 0, 'active', '2025-11-16 04:49:38', '2025-11-16 22:14:43'),
(12, 'Greek Frappé', 'A frothy, iced instant coffee drink.', 5.05, '1763302747_21b24f698d2c561d5de9.png', 50, 'Coffee', 0, 'active', '2025-11-16 04:52:16', '2025-11-16 23:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@coffeeshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-03 12:02:45', '2025-11-07 02:45:26'),
(3, 'Joshua Gabriel Ureta', 'joshuagabrielu@gmail.com', '$2y$10$PPImwy72E6kKFtvIHqXD8uqoTYtANCAiaK6zjZhfOmLaakxq7Mtsa', 'customer', '1763363455_624b4f7da2c249905f6e.jpg', '2025-11-03 04:29:08', '2025-11-16 23:11:05'),
(6, 'kate', 'kateu@gmail.com', '$2y$10$vuoVSbVjulJ8uwSKGgYXuOqTVQQD3j.sIKCwq7.QaJnKfxnQNhgSa', 'customer', NULL, '2025-11-03 05:02:38', '2025-11-07 01:54:17'),
(7, 'letecia', 'letecia@gmail.com', '$2y$10$xAvqmXcjbk9/UpLs10pE8OHcHivUh8EK3blH.68F6YYO4byvG7CR.', 'customer', NULL, '2025-11-03 05:02:56', '2025-11-03 05:02:56'),
(9, 'admin', 'barondejesus@gmail.com', '$2y$10$FNJn54Q/zgIHQqZu92aoxugSbal5ybdpiJgzNXAALdpZYYadaDcP2', 'admin', NULL, '2025-11-03 05:38:18', '2025-11-07 02:44:28'),
(10, 'haha', '202311379@fit.edu.ph', '$2y$10$LS3lOwLmruQJlw.xWnE.heaYPV/0VY6Al/7czwV3enGsu9t0Es45S', 'customer', NULL, '2025-11-07 01:58:16', '2025-11-07 01:58:16'),
(11, 'terrence', 'terrence@gmail.com', '$2y$10$1TYEMMe3SvSGSEvl148heuOUTc2XBbN2r9UStootFqL.rb25Qz.VG', 'customer', NULL, '2025-11-07 01:59:21', '2025-11-07 01:59:21'),
(12, 'ryyy', 'ry@gmail.com', '$2y$10$o1BFRROp9Ohhpr97E3WEFeS2BLkRemRnKUAdLP82Ss6kKpcHZ8O.O', 'admin', NULL, '2025-11-07 01:59:46', '2025-11-07 02:05:05'),
(13, 'john_do', 'john.doe@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 02:40:30'),
(15, 'mike_wilson', 'mike.wilson@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(16, 'sarah_jones', 'sarah.jones@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(17, 'admin_user', 'admin@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(18, 'robert_brown', 'robert.brown@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(19, 'lisa_taylor', 'lisa.taylor@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(20, 'david_clark', 'david.clark@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2025-11-07 10:08:40', '2025-11-16 02:00:53'),
(21, 'emily_white', 'emily.white@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(22, 'chris_miller', 'chris.miller@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(23, 'amanda_lee', 'amanda.lee@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(24, 'kevin_garcia', 'kevin.garcia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(25, 'jennifer_martin', 'jennifer.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(26, 'super_admin', 'super.admin@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(27, 'thomas_king', 'thomas.king@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, '2025-11-07 10:08:40', '2025-11-07 10:08:40'),
(28, 'raia', 'raia@gmail.com', '$2y$10$NZ11zRoRrUhDyTOwtj8/oO.5m1QYj5rJH8OVyj1xIXe6fm6rYuPQq', 'customer', NULL, '2025-11-09 06:48:25', '2025-11-09 06:48:25'),
(29, 'baro', 'rdj@gmail.com', '$2y$10$xiHn.GoEc2BnWizoFjj.tOMe7VjAikuV5CeRMx3VVGWYQXfPdxSd6', 'customer', NULL, '2025-11-14 02:52:48', '2025-11-14 07:32:31'),
(30, 'josh', 'jgpu23@gmail.com', '$2y$10$gK/z.h83cKK5NaTILFZFb.3U/1/pfkQUnftIE88LxBIOTvqw1KkZ2', 'customer', NULL, '2025-11-16 01:17:43', '2025-11-16 21:46:34'),
(31, 'tata', 'tata@gmail.com', '$2y$10$zCwhiNxwmoyDwwUsRLEq/OjYYlM72A9ngaVxOFwAqAMNX6J6pxwke', 'customer', NULL, '2025-11-16 04:35:23', '2025-11-16 04:35:23'),
(32, 'Nahmae', 'mendeznahmae@gmail.com', '$2y$10$bZJmXoLA778S79aOvRnckOtx.o/QGgMOxzTyC7nzbnpTS7pqVNzeS', 'customer', NULL, '2025-11-16 06:35:58', '2025-11-16 06:35:58'),
(33, 'myka', 'ryzaabraham.m@gmail.com', '$2y$10$wzJ7tvqUnvMnaEzXleBjEOdk88jIznUNxg9CXMSN4pyVAG5fyY94W', 'customer', NULL, '2025-11-16 06:41:39', '2025-11-16 06:41:39'),
(35, 'admin', 'asdfg@gmail.com', '$2y$10$m2a/pk9dAOx8Hy8PbYjxN.3Iod7BvDHGkWNMdkK05ba6BjEES9.Sm', 'customer', NULL, '2025-11-16 23:22:21', '2025-11-16 23:22:21'),
(36, 'Clinton', 'jcpureta@gmail.com', '$2y$10$WcCBFN4Dxiq/4/5cz/G11OU5LC6xsgO7UJK/n.gx35GY4mpdWYi46', 'customer', NULL, '2025-11-17 01:43:01', '2025-11-17 01:43:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

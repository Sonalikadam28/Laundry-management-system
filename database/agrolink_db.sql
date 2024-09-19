-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 25, 2024 at 07:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrolink_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyproductrequest`
--

CREATE TABLE `buyproductrequest` (
  `id` int(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_totalamt` decimal(10,2) NOT NULL,
  `seller_id` varchar(255) NOT NULL,
  `buyer_id` varchar(255) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyproductrequest`
--

INSERT INTO `buyproductrequest` (`id`, `product_id`, `transaction_id`, `invoice_id`, `product_name`, `product_qty`, `product_price`, `product_totalamt`, `seller_id`, `buyer_id`, `reg_date`, `status`) VALUES
(9, '4', 'OD25032024353', 'INV25032024670', 'Tomato', '41', '99.00', '4059.00', '4', '8', '2024-03-25', 2),
(10, '4', 'OD25032024948', 'INV25032024314', 'Watermelon', '120', '56.00', '6720.00', '4', '8', '2024-03-25', 1),
(11, '7', 'OD25032024302', 'INV25032024726', 'Green Mango', '400', '30.00', '12000.00', '7', '1', '2024-03-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(255) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`) VALUES
(1, 'Admin', 'admin', 7620166324, 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-05-21 07:30:00', 1),
(2, 'Ujjwal Gulhane', 'ujwal31', 1234567891, 'ujwal@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', '2023-05-21 07:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbuyer`
--

CREATE TABLE `tblbuyer` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobno` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location_id` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbuyer`
--

INSERT INTO `tblbuyer` (`id`, `fullname`, `email`, `mobno`, `address`, `location_id`, `password`, `reg_date`, `last_seen`) VALUES
(1, 'Anurag Gulhane', 'anurag@gmail.com', '2147483647', 'Laxmi Nagar, MIDC', 3, '1a1dc91c907325c69271ddf0c944bc72', '2024-03-24', '2024-03-25 17:29:58'),
(8, 'Yashswi Holey', 'ujwalgulhane31@gmail.com', '7620166324', 'Ravi Nagar, MIDC', 3, '1a1dc91c907325c69271ddf0c944bc72', '2024-03-24', '2024-03-25 17:00:50'),
(12, 'Shreyash Pande', 'shreyash@gmail.com', '9631597536', 'Badnera', 3, '1a1dc91c907325c69271ddf0c944bc72', '2024-03-25', '2024-03-25 23:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblchats`
--

CREATE TABLE `tblchats` (
  `chat_id` int(255) NOT NULL,
  `from_id` int(255) NOT NULL,
  `to_id` int(255) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblchats`
--

INSERT INTO `tblchats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(4, 8, 4, '1', 1, '2024-03-25 12:04:47'),
(5, 8, 4, 'hi', 1, '2024-03-25 12:04:51'),
(6, 8, 7, 'hello sir, \ni want 500 kg mango', 0, '2024-03-25 12:30:57'),
(7, 4, 8, 'May I bother you about your product information', 1, '2024-03-25 16:33:07'),
(8, 8, 4, 'I want new car', 1, '2024-03-25 16:33:40'),
(9, 8, 4, 'asdf', 1, '2024-03-25 16:35:34'),
(10, 4, 8, 'hello\n', 1, '2024-03-25 16:35:43'),
(11, 4, 8, 'i want 5 kg mangoes\n', 1, '2024-03-25 16:36:01'),
(12, 8, 4, 'hi\n', 1, '2024-03-25 16:38:31'),
(13, 8, 4, 'hi', 1, '2024-03-25 16:42:08'),
(14, 4, 8, 'hi\nasdf', 1, '2024-03-25 16:42:13'),
(17, 1, 4, 'hi, how are you', 1, '2024-03-25 16:57:34'),
(18, 1, 7, 'Good Morning', 1, '2024-03-25 16:57:55'),
(19, 4, 1, 'hi how are you?', 1, '2024-03-25 16:58:42'),
(20, 7, 1, 'how are you', 1, '2024-03-25 16:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `tblconversations`
--

CREATE TABLE `tblconversations` (
  `conversation_id` int(255) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblconversations`
--

INSERT INTO `tblconversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(2, 8, 4),
(3, 8, 7),
(5, 1, 4),
(6, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tblfarmer`
--

CREATE TABLE `tblfarmer` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobno` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location_id` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfarmer`
--

INSERT INTO `tblfarmer` (`id`, `fullname`, `email`, `mobno`, `address`, `location_id`, `password`, `reg_date`, `last_seen`) VALUES
(4, 'Amar Gulhane', 'ujwalgulhane31@gmail.com', '9890821403', 'VMV Road, MIDC', 3, '1a1dc91c907325c69271ddf0c944bc72', '2024-03-24', '2024-03-25 16:58:44'),
(7, 'Shreyash Isal', 'ujjwalgulhane2002@gmail.com', '9890821403', 'Gopal Nagar', 3, '1a1dc91c907325c69271ddf0c944bc72', '2024-03-25', '2024-03-25 16:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocations`
--

CREATE TABLE `tbllocations` (
  `id` int(255) NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllocations`
--

INSERT INTO `tbllocations` (`id`, `location_name`) VALUES
(1, 'Ahmednagar'),
(2, 'Akola'),
(3, 'Amravati'),
(4, 'Aurangabad'),
(5, 'Beed'),
(6, 'Bhandara'),
(7, 'Buldhana'),
(8, 'Chandrapur'),
(9, 'Dhule'),
(10, 'Gadchiroli'),
(11, 'Gondia'),
(12, 'Hingoli'),
(13, 'Jalgaon'),
(14, 'Jalna'),
(15, 'Kolhapur'),
(16, 'Latur'),
(17, 'Mumbai City'),
(18, 'Mumbai Suburban'),
(19, 'Nagpur'),
(20, 'Nanded'),
(21, 'Nandurbar'),
(22, 'Nashik'),
(23, 'Osmanabad'),
(24, 'Palghar'),
(25, 'Parbhani'),
(26, 'Pune'),
(27, 'Raigad'),
(28, 'Ratnagiri'),
(29, 'Sangli'),
(30, 'Satara'),
(31, 'Sindhudurg'),
(32, 'Solapur'),
(33, 'Thane'),
(34, 'Wardha'),
(35, 'Washim'),
(37, 'Yavatmal');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `addedby` varchar(255) NOT NULL,
  `addedbyno` varchar(255) NOT NULL,
  `regdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `quantity`, `description`, `price`, `image`, `address`, `location_id`, `addedby`, `addedbyno`, `regdate`) VALUES
(20, 'Tomato', '1', 'Good', '99.00', 'bg_4.jpg', 'Samara Nagar', '14', 'Amar Gulhane', '4', '2024-03-24'),
(22, 'Watermelon', '1', 'jhv', '56.00', 'istockphoto-1285378409-1024x1024.jpg', 'Gadge Nagar', '1', 'Amar Gulhane', '4', '2024-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `tblrequirements`
--

CREATE TABLE `tblrequirements` (
  `id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `addedbybuyer_name` varchar(255) NOT NULL,
  `addedbyno` varchar(255) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrequirements`
--

INSERT INTO `tblrequirements` (`id`, `product_name`, `quantity`, `price`, `total_amount`, `address`, `location_id`, `description`, `addedbybuyer_name`, `addedbyno`, `reg_date`) VALUES
(1, 'Potato', '10', '100.00', '1000.00', 'Badnera', '3', '', 'Anurag Gulhane', '1', '2024-03-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyproductrequest`
--
ALTER TABLE `buyproductrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbuyer`
--
ALTER TABLE `tblbuyer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblchats`
--
ALTER TABLE `tblchats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `tblconversations`
--
ALTER TABLE `tblconversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `tblfarmer`
--
ALTER TABLE `tblfarmer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbllocations`
--
ALTER TABLE `tbllocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrequirements`
--
ALTER TABLE `tblrequirements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyproductrequest`
--
ALTER TABLE `buyproductrequest`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbuyer`
--
ALTER TABLE `tblbuyer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblchats`
--
ALTER TABLE `tblchats`
  MODIFY `chat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblconversations`
--
ALTER TABLE `tblconversations`
  MODIFY `conversation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblfarmer`
--
ALTER TABLE `tblfarmer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbllocations`
--
ALTER TABLE `tbllocations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblrequirements`
--
ALTER TABLE `tblrequirements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

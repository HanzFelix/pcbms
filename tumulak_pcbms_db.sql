-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 04:58 AM
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
-- Database: `tumulak_pcbms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `consigned_details`
--

CREATE TABLE `consigned_details` (
  `cd_id` int(10) NOT NULL,
  `supp_id` smallint(6) NOT NULL,
  `empid` smallint(6) NOT NULL,
  `date_delivered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consigned_details`
--

INSERT INTO `consigned_details` (`cd_id`, `supp_id`, `empid`, `date_delivered`) VALUES
(1, 3, 1, '2023-06-04'),
(2, 2, 1, '2023-08-14'),
(5, 1, 1, '2023-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `consigned_product`
--

CREATE TABLE `consigned_product` (
  `cp_id` int(11) NOT NULL,
  `cd_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `barcode` varchar(12) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `expiry_date` date NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` mediumint(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consigned_product`
--

INSERT INTO `consigned_product` (`cp_id`, `cd_id`, `prod_id`, `barcode`, `particulars`, `expiry_date`, `unit_price`, `selling_price`, `quantity`, `amount`) VALUES
(1, 1, 3, '78123791', '15 grams', '2023-06-14', '20.00', '30.00', 12, '300.00'),
(2, 1, 4, '78123792', '15 grams', '2023-06-18', '20.00', '30.00', 12, '300.00'),
(13, 1, 6, '6795658', '15ml', '2023-08-22', '20.00', '24.00', 15, '300.00'),
(14, 2, 3, '4564646', '15 grams', '2023-08-23', '20.00', '25.00', 20, '600.00'),
(15, 5, 4, '123456789', '50 grams', '2023-09-30', '20.00', '24.00', 30, '600.00'),
(16, 5, 6, '123456799', '40 grams', '2023-09-27', '20.00', '24.00', 15, '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `name`, `address`) VALUES
(1, 'Anonymous', 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` bigint(20) NOT NULL,
  `empid` smallint(6) NOT NULL,
  `log` datetime NOT NULL,
  `state` enum('in','out') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id`, `empid`, `log`, `state`) VALUES
(1, 1, '2023-08-17 04:47:56', 'in'),
(2, 1, '2023-08-17 05:00:00', 'out'),
(3, 1, '2023-08-18 06:04:49', 'in'),
(4, 1, '2023-08-18 06:04:51', 'out'),
(5, 1, '2023-08-18 06:12:18', 'in'),
(6, 1, '2023-08-18 06:26:50', 'out'),
(7, 1, '2023-09-01 06:52:04', 'in'),
(8, 1, '2023-09-01 06:52:08', 'out');

-- --------------------------------------------------------

--
-- Table structure for table `expired_details`
--

CREATE TABLE `expired_details` (
  `ed_id` int(11) NOT NULL,
  `supp_id` smallint(6) NOT NULL,
  `empid` smallint(6) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_details`
--

INSERT INTO `expired_details` (`ed_id`, `supp_id`, `empid`, `return_date`) VALUES
(1, 3, 1, '2023-08-26'),
(2, 3, 1, '2023-08-29'),
(3, 3, 1, '2023-08-29'),
(4, 3, 1, '2023-08-17'),
(5, 3, 1, '2023-08-23'),
(6, 3, 1, '2023-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `expired_product`
--

CREATE TABLE `expired_product` (
  `ep_id` int(11) NOT NULL,
  `ed_id` int(11) NOT NULL,
  `cp_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_product`
--

INSERT INTO `expired_product` (`ep_id`, `ed_id`, `cp_id`, `quantity`) VALUES
(1, 1, 1, 12),
(2, 6, 2, 12),
(3, 6, 13, 15);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `supp_id` smallint(6) NOT NULL,
  `emp_id` smallint(6) NOT NULL,
  `order_date` date NOT NULL,
  `status` enum('Pending','Received','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_id`, `supp_id`, `emp_id`, `order_date`, `status`) VALUES
(1, 1, 1, '2023-08-23', 'Received'),
(2, 2, 1, '2023-08-31', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `op_id` int(11) NOT NULL,
  `od_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`op_id`, `od_id`, `prod_id`, `quantity`) VALUES
(1, 1, 1, 12),
(2, 1, 6, 24),
(4, 2, 4, 123);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `empid` smallint(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`empid`, `fname`, `mname`, `lname`) VALUES
(1, 'Julius', 'Copell', 'Hearth');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `shelf_life` int(10) UNSIGNED NOT NULL,
  `unit` enum('piece','pack','bottle','bag') NOT NULL,
  `appreciation` decimal(7,2) NOT NULL,
  `max_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `shelf_life`, `unit`, `appreciation`, `max_quantity`) VALUES
(1, 'Jeremy\'s Kamote Chips', 23, 'bag', '20.00', 30),
(3, 'Carabao Milk', 2, 'bottle', '20.00', 20),
(4, 'Cassava Chips', 200, 'pack', '15.00', 10),
(6, 'Dried Mango Products', 30, 'pack', '20.00', 50),
(7, 'Banana Chips', 24, 'bottle', '20.00', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `sd_id` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `empid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`sd_id`, `date_issued`, `cust_id`, `empid`) VALUES
(1, '2023-09-01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_product`
--

CREATE TABLE `sale_product` (
  `sp_id` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `cp_id` int(11) NOT NULL,
  `qty_sold` int(11) NOT NULL,
  `amount_sold` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_product`
--

INSERT INTO `sale_product` (`sp_id`, `sd_id`, `cp_id`, `qty_sold`, `amount_sold`) VALUES
(1, 1, 15, 5, '120.00'),
(2, 1, 16, 4, '96.00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supp_id` smallint(6) NOT NULL,
  `company` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `sex` enum('Male','Female','Non-binary') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supp_id`, `company`, `contact_person`, `sex`, `phone`, `address`) VALUES
(1, 'ThatCompanya', 'ThatPersona', 'Male', '09291234567', 'ThatPlace, ThatIsland'),
(2, 'SomeOrganization', 'SomePerson', 'Female', '+639123456789', 'Somewhere, OutThere'),
(3, 'Large Companya', 'Goodman Johnson', 'Female', 'No phone', 'North City, Califivia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` smallint(6) NOT NULL,
  `empid` smallint(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('manager','cashier','personnel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `empid`, `username`, `password`, `role`) VALUES
(1, 1, 'user1', 'password', 'manager'),
(2, 1, 'user1', 'password', 'personnel'),
(3, 1, 'user1', 'password', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consigned_details`
--
ALTER TABLE `consigned_details`
  ADD PRIMARY KEY (`cd_id`),
  ADD KEY `consigned_to_supplier` (`supp_id`),
  ADD KEY `consigned_to_personnel` (`empid`);

--
-- Indexes for table `consigned_product`
--
ALTER TABLE `consigned_product`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `cd_to_consigned` (`cd_id`),
  ADD KEY `cd_to_product` (`prod_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dtr_to_emp` (`empid`);

--
-- Indexes for table `expired_details`
--
ALTER TABLE `expired_details`
  ADD PRIMARY KEY (`ed_id`),
  ADD KEY `expired_to_supplier` (`supp_id`),
  ADD KEY `expired_to_personnel` (`empid`);

--
-- Indexes for table `expired_product`
--
ALTER TABLE `expired_product`
  ADD PRIMARY KEY (`ep_id`),
  ADD KEY `ei_to_cp` (`cp_id`),
  ADD KEY `ei_to_expired` (`ed_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `orders_to_supplier` (`supp_id`),
  ADD KEY `orders_to_personnel` (`emp_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`op_id`),
  ADD KEY `od_to_product` (`prod_id`),
  ADD KEY `od_to_order` (`od_id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`sd_id`),
  ADD KEY `sales_to_customer` (`cust_id`),
  ADD KEY `sales_to_emp` (`empid`);

--
-- Indexes for table `sale_product`
--
ALTER TABLE `sale_product`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `sp_to_cp` (`cp_id`),
  ADD KEY `sp_to_sd` (`sd_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `users_to_personnel` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consigned_details`
--
ALTER TABLE `consigned_details`
  MODIFY `cd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consigned_product`
--
ALTER TABLE `consigned_product`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expired_details`
--
ALTER TABLE `expired_details`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expired_product`
--
ALTER TABLE `expired_product`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `empid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `sd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_product`
--
ALTER TABLE `sale_product`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consigned_details`
--
ALTER TABLE `consigned_details`
  ADD CONSTRAINT `consigned_to_personnel` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`),
  ADD CONSTRAINT `consigned_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`);

--
-- Constraints for table `consigned_product`
--
ALTER TABLE `consigned_product`
  ADD CONSTRAINT `cd_to_consigned` FOREIGN KEY (`cd_id`) REFERENCES `consigned_details` (`cd_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cd_to_product` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dtr`
--
ALTER TABLE `dtr`
  ADD CONSTRAINT `dtr_to_emp` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`);

--
-- Constraints for table `expired_details`
--
ALTER TABLE `expired_details`
  ADD CONSTRAINT `expired_to_personnel` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`),
  ADD CONSTRAINT `expired_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`);

--
-- Constraints for table `expired_product`
--
ALTER TABLE `expired_product`
  ADD CONSTRAINT `ei_to_cp` FOREIGN KEY (`cp_id`) REFERENCES `consigned_product` (`cp_id`),
  ADD CONSTRAINT `ei_to_expired` FOREIGN KEY (`ed_id`) REFERENCES `expired_details` (`ed_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `orders_to_personnel` FOREIGN KEY (`emp_id`) REFERENCES `personnel` (`empid`),
  ADD CONSTRAINT `orders_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `od_to_order` FOREIGN KEY (`od_id`) REFERENCES `order_details` (`od_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `od_to_product` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sales_to_customer` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `sales_to_emp` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`);

--
-- Constraints for table `sale_product`
--
ALTER TABLE `sale_product`
  ADD CONSTRAINT `sp_to_cp` FOREIGN KEY (`cp_id`) REFERENCES `consigned_product` (`cp_id`),
  ADD CONSTRAINT `sp_to_sd` FOREIGN KEY (`sd_id`) REFERENCES `sale_details` (`sd_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_to_personnel` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 07:28 AM
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
  `userid` smallint(6) NOT NULL,
  `date_delivered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consigned_details`
--

INSERT INTO `consigned_details` (`cd_id`, `supp_id`, `userid`, `date_delivered`) VALUES
(1, 3, 1, '2023-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `consigned_product`
--

CREATE TABLE `consigned_product` (
  `item_id` int(11) NOT NULL,
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

INSERT INTO `consigned_product` (`item_id`, `cd_id`, `prod_id`, `barcode`, `particulars`, `expiry_date`, `unit_price`, `selling_price`, `quantity`, `amount`) VALUES
(1, 1, 3, '78123791', '15 grams per bag', '2023-06-14', '20.50', '30.00', 12, '300.00'),
(2, 1, 4, '78123791', '15 grams per set', '2023-06-18', '20.50', '30.00', 12, '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `expired`
--

CREATE TABLE `expired` (
  `exp_id` int(11) NOT NULL,
  `supp_id` smallint(6) NOT NULL,
  `userid` smallint(6) NOT NULL,
  `assess_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expired_items`
--

CREATE TABLE `expired_items` (
  `item_no` int(11) NOT NULL,
  `expired_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `or_id` int(11) NOT NULL,
  `supp_id` smallint(6) NOT NULL,
  `userid` smallint(6) NOT NULL,
  `order_date` date NOT NULL,
  `status` enum('Pending','Received','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `item_no` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'user', 'n', 'ame');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `shelf_life` int(10) UNSIGNED NOT NULL,
  `unit` enum('piece','pack','bottle','bag') NOT NULL,
  `appreciation` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `shelf_life`, `unit`, `appreciation`) VALUES
(1, 'kamote leaves', 23, 'bag', '2.00'),
(3, 'eggplant leaves', 2, 'pack', '2.00'),
(4, 'dried mango', 200, 'pack', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `date_issued` datetime NOT NULL,
  `customer` int(11) NOT NULL,
  `userid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `item_no` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty_sold` int(11) NOT NULL,
  `amount_sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'ThatCompany', 'ThatPersona', 'Male', '09291234567', 'ThatPlace, ThatIsland'),
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
(1, 1, 'username', 'password', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consigned_details`
--
ALTER TABLE `consigned_details`
  ADD PRIMARY KEY (`cd_id`),
  ADD KEY `consigned_to_supplier` (`supp_id`),
  ADD KEY `consigned_to_user` (`userid`);

--
-- Indexes for table `consigned_product`
--
ALTER TABLE `consigned_product`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cd_to_product` (`prod_id`),
  ADD KEY `cd_to_consigned` (`cd_id`);

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
-- Indexes for table `expired`
--
ALTER TABLE `expired`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `expired_to_supplier` (`supp_id`),
  ADD KEY `expired_to_user` (`userid`);

--
-- Indexes for table `expired_items`
--
ALTER TABLE `expired_items`
  ADD PRIMARY KEY (`item_no`),
  ADD KEY `ei_to_expired` (`expired_id`),
  ADD KEY `ei_to_cd` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `orders_to_supplier` (`supp_id`),
  ADD KEY `orders_to_user` (`userid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`item_no`),
  ADD KEY `od_to_order` (`order_id`),
  ADD KEY `od_to_product` (`item_id`);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `sales_to_customer` (`customer`),
  ADD KEY `sales_to_user` (`userid`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`item_no`),
  ADD KEY `sd_to_sales` (`sale_id`);

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
  MODIFY `cd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consigned_product`
--
ALTER TABLE `consigned_product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expired`
--
ALTER TABLE `expired`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expired_items`
--
ALTER TABLE `expired_items`
  MODIFY `item_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `item_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `empid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `item_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consigned_details`
--
ALTER TABLE `consigned_details`
  ADD CONSTRAINT `consigned_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`),
  ADD CONSTRAINT `consigned_to_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `consigned_product`
--
ALTER TABLE `consigned_product`
  ADD CONSTRAINT `cd_to_consigned` FOREIGN KEY (`cd_id`) REFERENCES `consigned_details` (`cd_id`),
  ADD CONSTRAINT `cd_to_product` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `dtr`
--
ALTER TABLE `dtr`
  ADD CONSTRAINT `dtr_to_emp` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`);

--
-- Constraints for table `expired`
--
ALTER TABLE `expired`
  ADD CONSTRAINT `expired_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`),
  ADD CONSTRAINT `expired_to_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `expired_items`
--
ALTER TABLE `expired_items`
  ADD CONSTRAINT `ei_to_cd` FOREIGN KEY (`item_id`) REFERENCES `consigned_product` (`item_id`),
  ADD CONSTRAINT `ei_to_expired` FOREIGN KEY (`expired_id`) REFERENCES `expired` (`exp_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_to_supplier` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`supp_id`),
  ADD CONSTRAINT `orders_to_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `od_to_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`or_id`),
  ADD CONSTRAINT `od_to_product` FOREIGN KEY (`item_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_to_customer` FOREIGN KEY (`customer`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `sales_to_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sd_to_cd` FOREIGN KEY (`item_no`) REFERENCES `consigned_product` (`item_id`),
  ADD CONSTRAINT `sd_to_sales` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_to_personnel` FOREIGN KEY (`empid`) REFERENCES `personnel` (`empid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

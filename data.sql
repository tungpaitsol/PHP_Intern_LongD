-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 03:58 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager_cabaret`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `date_check_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_check_out` timestamp NULL DEFAULT NULL,
  `tax` int(11) NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `total_money` float NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `table_id`, `date_check_in`, `date_check_out`, `tax`, `discount`, `total_money`, `status`) VALUES
(1, 1, '2019-07-14 00:00:00', '2019-07-10 11:00:00', 10, 0, 1622500, 0),
(2, 2, '2019-07-14 01:00:00', '2019-07-14 07:00:00', 10, 0, 800910, 0),
(3, 3, '2019-07-14 02:00:00', '2019-07-11 03:00:00', 10, 0, 500500, 0),
(4, 4, '2019-07-14 03:00:00', '2019-07-12 09:00:00', 10, 0, 533500, 0),
(5, 5, '2019-07-14 04:00:00', '2019-07-12 08:00:00', 10, 0, 726000, 0),
(6, 6, '2019-07-14 05:30:00', '2019-07-13 11:00:00', 10, 0, 71500, 0),
(7, 7, '2019-07-14 14:00:00', '2019-07-14 15:20:00', 10, 0, 803000, 0),
(8, 8, '2019-07-14 15:00:00', '2019-07-14 15:50:00', 10, 0, 1199000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill_food_info`
--

CREATE TABLE `bill_food_info` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `tax` int(11) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_food_info`
--

INSERT INTO `bill_food_info` (`id`, `food_id`, `bill_id`, `quantity`, `tax`, `price`) VALUES
(1, 1, 1, 3, 10, 50000),
(2, 6, 1, 6, 0, 5000),
(3, 2, 2, 3, 10, 33000),
(4, 6, 2, 1, 10, 40000),
(5, 9, 3, 5, 0, 32000),
(6, 14, 3, 3, 0, 5000),
(7, 10, 1, 3, 0, 50000),
(8, 3, 2, 4, 10, 33000),
(9, 4, 4, 1, 10, 50000),
(10, 5, 5, 10, 10, 60000),
(11, 6, 6, 13, 0, 5000),
(12, 7, 7, 10, 0, 55000),
(13, 8, 8, 15, 0, 66000);

-- --------------------------------------------------------

--
-- Table structure for table `bill_staff_info`
--

CREATE TABLE `bill_staff_info` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `start_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_datetime` timestamp NULL DEFAULT NULL,
  `member_type` int(11) NOT NULL DEFAULT 0,
  `service_money` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_staff_info`
--

INSERT INTO `bill_staff_info` (`id`, `member_id`, `bill_id`, `start_datetime`, `end_datetime`, `member_type`, `service_money`) VALUES
(1, 1, 1, '2019-07-14 00:15:00', '2019-07-14 05:45:00', 1, 300000),
(2, 2, 1, '2019-07-14 00:45:00', '2019-07-14 09:15:00', 0, 460000),
(3, 3, 1, '2019-07-14 02:30:00', '2019-07-14 08:15:00', 0, 280000),
(4, 4, 2, '2019-07-14 01:00:00', '2019-07-14 07:00:00', 1, 430000),
(5, 5, 3, '2019-07-14 02:00:00', '2019-07-14 03:00:00', 0, 140000),
(6, 6, 3, '2019-07-14 02:00:00', '2019-07-14 03:00:00', 0, 140000),
(7, 7, 4, '2019-07-14 03:00:00', '2019-07-14 09:00:00', 0, 430000),
(8, 2, 7, '2019-07-14 14:00:00', '2019-07-14 15:00:00', 1, 180000),
(9, 5, 8, '2019-07-14 15:00:00', '2019-07-14 15:30:00', 1, 100000),
(10, 1, 1, '2019-07-14 09:45:00', '2019-07-14 11:00:00', 0, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'No Name',
  `food_category_id` int(11) NOT NULL,
  `alcohol` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `food_category_id`, `alcohol`, `price`) VALUES
(1, 'Rượu sake Nihonshu', 1, 40, 50000),
(2, 'Rượu Shochu', 1, 40, 20000),
(3, 'Rượu mơ Nhật Umeshu', 1, 40, 33000),
(4, 'Rượu Nigorizake', 1, 40, 40000),
(5, 'Rượu gạo Nhật Amazake', 1, 40, 60000),
(6, 'Sukiyaki', 3, 0, 5000),
(7, 'Tempura', 3, 0, 55000),
(8, 'Sushi', 3, 0, 66000),
(9, 'Sashimi', 3, 0, 32000),
(10, 'Kaiseki Ryori', 3, 0, 80000),
(11, 'Yakitori', 3, 0, 64000),
(12, 'Lavie', 2, 0, 5000),
(13, 'Coca Cola', 2, 0, 5000),
(14, '7Up', 2, 0, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'No Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `name`) VALUES
(1, 'Rượu'),
(2, 'Nước'),
(3, 'Đồ ăn');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL DEFAULT 'No Name',
  `gender` int(11) NOT NULL DEFAULT 0,
  `salary` float NOT NULL DEFAULT 0,
  `total_work_time` float NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `full_name`, `gender`, `salary`, `total_work_time`, `status`) VALUES
(1, 'Nguyen Van A', 0, 50000, 0, 0),
(2, 'Nguyen Thi B', 1, 40000, 0, 0),
(3, 'Nguyen Van C', 0, 30000, 0, 0),
(4, 'Nguyen Xuan P', 0, 40000, 0, 0),
(5, 'Nguyen Ngoc T', 1, 30000, 0, 0),
(6, 'Nguyen Thi Z', 1, 40000, 0, 0),
(7, 'Bui Thi K', 1, 40000, 0, 0),
(8, 'Bui Thi Y', 1, 40000, 0, 0),
(9, 'Dinh Van L', 0, 60000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_money`
--

CREATE TABLE `service_money` (
  `id` int(11) NOT NULL,
  `work_hour` int(11) NOT NULL DEFAULT 0,
  `first_staff` float NOT NULL DEFAULT 0,
  `second_staff` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_money`
--

INSERT INTO `service_money` (`id`, `work_hour`, `first_staff`, `second_staff`) VALUES
(1, 1, 10000, 80000),
(2, 2, 80000, 60000),
(3, 3, 50000, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `table_food`
--

CREATE TABLE `table_food` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'No Name',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_food`
--

INSERT INTO `table_food` (`id`, `name`, `status`) VALUES
(1, 'Bàn 1', 1),
(2, 'Bàn 2', 1),
(3, 'Bàn 3', 1),
(4, 'Bàn 4', 1),
(5, 'Bàn 5', 1),
(6, 'Bàn 6', 1),
(7, 'Bàn 7', 1),
(8, 'Bàn 8', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_ibfk_1` (`table_id`);

--
-- Indexes for table `bill_food_info`
--
ALTER TABLE `bill_food_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_food_info_ibfk_1` (`bill_id`),
  ADD KEY `bill_food_info_ibfk_2` (`food_id`);

--
-- Indexes for table `bill_staff_info`
--
ALTER TABLE `bill_staff_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_staff_info_ibfk_1` (`member_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_ibfk_1` (`food_category_id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_money`
--
ALTER TABLE `service_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_food`
--
ALTER TABLE `table_food`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bill_food_info`
--
ALTER TABLE `bill_food_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bill_staff_info`
--
ALTER TABLE `bill_staff_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_money`
--
ALTER TABLE `service_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_food`
--
ALTER TABLE `table_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `table_food` (`id`);

--
-- Constraints for table `bill_food_info`
--
ALTER TABLE `bill_food_info`
  ADD CONSTRAINT `bill_food_info_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `bill_food_info_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Constraints for table `bill_staff_info`
--
ALTER TABLE `bill_staff_info`
  ADD CONSTRAINT `bill_staff_info_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`food_category_id`) REFERENCES `food_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

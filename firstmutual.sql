-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 10:57 PM
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
-- Database: `firstmutual`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `username`, `password`, `firstname`, `surname`, `phone_number`, `email`) VALUES
('3287382', 'momo', 'momoadmin', 'Momo', 'Admin', 780948948, 'momo@admin.c.z');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medical_aid`
--

CREATE TABLE `tbl_medical_aid` (
  `med_id` varchar(12) NOT NULL,
  `employer` varchar(40) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_medical_aid`
--

INSERT INTO `tbl_medical_aid` (`med_id`, `employer`, `issue_date`, `expiry_date`) VALUES
('4242423423', 'Something', '2024-09-24', '2024-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

CREATE TABLE `tbl_prescriptions` (
  `presc_id` varchar(12) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `img` blob NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sale_id` varchar(12) NOT NULL,
  `sale_date` date NOT NULL,
  `presc_id` varchar(12) NOT NULL,
  `staff_id` varchar(12) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`sale_id`, `sale_date`, `presc_id`, `staff_id`, `total`) VALUES
('sal_35044120', '2024-09-29', '00000', '39283892', 0),
('sal_62221601', '2024-09-30', '00000', '39283892', 0),
('sal_62634248', '2024-09-29', '00000', '39283892', 0),
('sal_90659328', '2024-09-29', '00000', '39283892', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_items`
--

CREATE TABLE `tbl_sales_items` (
  `sale_id` varchar(12) NOT NULL,
  `stock_id` varchar(12) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `nat_id_number` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `staff_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `username`, `password`, `firstname`, `surname`, `nat_id_number`, `email`, `phone_number`, `staff_type`) VALUES
('39283892', 'momo', 'momo1', 'Momo', 'Momosomting', '63-2387132R71', 'momo@momo.co.zw', 780948498, 'pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` varchar(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(500) NOT NULL,
  `threshold` int(12) NOT NULL,
  `price` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `name`, `description`, `threshold`, `price`, `balance`) VALUES
('32938', 'Paracetamol', 'White round pill', 10, 12, 32),
('4342', 'Cocodamol', 'White round pill', 5, 12, 105);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_entries`
--

CREATE TABLE `tbl_stock_entries` (
  `stock_id` varchar(12) NOT NULL,
  `supplier` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock_entries`
--

INSERT INTO `tbl_stock_entries` (`stock_id`, `supplier`, `date`, `amount`) VALUES
('32938', 'Momo', '2024-09-29', 3),
('329383', 'sadsakj', '2024-09-29', 232),
('4342', 'Momo', '2024-09-21', 25),
('32938', 'Someone', '2024-09-30', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `nat_id_number` varchar(14) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `med_aid` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `firstname`, `surname`, `nat_id_number`, `dob`, `phone_number`, `email`, `med_aid`) VALUES
('934394', 'momo', 'momopassword', 'Momo', 'Momosur', '63-2387132R71', '2004-06-25', '0780948498', 'mufarodkaseke@gmail.', '328738273'),
('usr_145139', 'momo', 'momo', 'Mufaro', 'Kaseke', '36237263', '2024-09-23', '0774139082', 'mufarodarlington@gma', '8989834943'),
('usr_473377', 'momo', 'kdasdkljsklj', 'Mufaro', 'Kaseke', '362372132389', '2024-09-24', '0774139082', 'mufar2323@gmail.com', '339231098'),
('usr_745705', 'momo', 'momo', 'Mufaro', 'Kaseke', '3232323', '2024-09-22', '0774139082', 'mufaroeiwoqueiwu@gma', '4242423423');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `tbl_medical_aid`
--
ALTER TABLE `tbl_medical_aid`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  ADD PRIMARY KEY (`presc_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nat_id_number` (`nat_id_number`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `med_aid` (`med_aid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nat_id_number` (`nat_id_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

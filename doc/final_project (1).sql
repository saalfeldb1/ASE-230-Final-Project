-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 09:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `total_Order` int(11) NOT NULL,
  `order_ID` int(64) NOT NULL,
  `product_ID` int(64) UNSIGNED NOT NULL,
  `quantity` int(64) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`total_Order`, `order_ID`, `product_ID`, `quantity`) VALUES
(1, 38, 20, 1),
(2, 38, 21, 1),
(3, 39, 20, 2),
(5, 39, 23, 1),
(6, 40, 20, 2),
(8, 41, 25, 1),
(10, 41, 23, 1),
(11, 38, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_progress`
--

CREATE TABLE `orders_progress` (
  `orderID` int(64) NOT NULL,
  `userID` int(64) NOT NULL,
  `OrderDate` date NOT NULL,
  `Status` varchar(64) NOT NULL,
  `TotalAmount` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(64) NOT NULL,
  `userID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `StockQuantity` int(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `userID`, `Name`, `Description`, `Price`, `StockQuantity`, `Image`) VALUES
(20, 36, 'Cornhole Board', 'Amazing board with a handle!', '25.99', 0, 'product_657cab564d700_1702669142.jpg'),
(21, 36, 'Wood Chair', 'Authentic Chair', '14.99', 0, 'product_657c8fc339956_1702662083.jpg'),
(22, 36, 'Best Corn Hole Boards', 'These are the best wood and material for playing with your friends!', '22.99', 0, 'product_657c90b3df63e_1702662323.jpg'),
(23, 36, 'Homemade Bird Feeder', 'Simple birdfeeder for the avid p90pp9bird watcher!', '9.99', 0, 'product_657cab6bc175d_1702669163.jpg'),
(24, 36, 'Custom Homemade Bird Feeder', 'This birdfeeder is amazing!', '15.99', 0, 'product_657c921fc3488_1702662687.jpg'),
(25, 36, 'Homemade Organic Maple Syrup', 'Actually bottle and make own maple syrup at home!', '8', 0, 'product_657c92752508b_1702662773.jpg'),
(26, 36, 'Fake Product 1', 'This is a made up product and a picture of a tree', '99.99', 0, 'product_657c9313d2fe2_1702662931.jpg'),
(27, 37, 'Wood Boring Bee Trap', 'Homemade trap to stop the bees from burrowing into the wood of your house!', '9.99', 0, 'product_657c9366a5c79_1702663014.jpg'),
(28, 37, 'Wood Coasters Engraved (Set of 4)', 'These coasters are laser engraved and sealed for years of durable use!', '9.99', 0, 'product_657c93d7a56b7_1702663127.jpg'),
(33, 41, 'Fake Product 2', 'Fake product', '19.99', 0, 'product_657ca54968b66_1702667593.jpg'),
(38, 38, 'Better wood chair', 'Best chair ever!', '19.99', 0, 'product_657cadfeaf644_1702669822.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(64) NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(64) DEFAULT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `username`, `password`, `address`, `usertype`) VALUES
(36, 'Brayden', 'Saalfeld', 'saalfeldb1@mymail.nku.edu', 'saalfeldb1', '$2y$10$CgQdJb2xdqmBvGtHAZUzsO64UyW4h.0WjicEGOe7TCk8g/zVpgXlG', NULL, 'admin'),
(37, 'user', 'test', 'user@gmail.com', 'user', '$2y$10$sexU8hfm4/.GQyF6J7GGieu1wGxkMz5Om86nCpEFcXx7KhyNqSGyG', NULL, 'user'),
(38, 'admin', 'controls', 'admin@gmail.com', 'admin', '$2y$10$RZb4DacmHfqkSxoJG7VzneUO5SDMRoxCFHZmm2Sc8Zp1EKlIVkYC.', NULL, 'admin'),
(39, 'test', 'user', 'test@gmail.com', 'test1', '$2y$10$rrKJfTcF9e3PLUt1Fw/BxOyiJkb9sKnd0P/IHIILa9vvDZ5Lme/di', NULL, 'user'),
(40, 'Testuser', 'test', 'testuser@gmail.com', 'testuser', '$2y$10$1iyLrSPusgcdGOblmL5/RedDibilIPYtMKO9XvSK.svxH2fZ7Wwt.', NULL, 'user'),
(41, 'testuser1', 'test', 'testuser1@gmail.com', 'testuser1', '$2y$10$nZPEHlnIErXnTza3nfu1.ujjB5CDQcUfKjUcZ.vGzscyx8Fhe/lmK', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`total_Order`);

--
-- Indexes for table `orders_progress`
--
ALTER TABLE `orders_progress`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `total_Order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_progress`
--
ALTER TABLE `orders_progress`
  MODIFY `orderID` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_progress`
--
ALTER TABLE `orders_progress`
  ADD CONSTRAINT `orders_progress_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 02:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Dhruv', 'dhrv@qwer.ty', 'c62d929e7b7e7b6165923a5dfc60cb56', 1, '2021-02-24 14:34:08', '2021-03-18 03:01:15'),
(6, 'Kvl', 'keval@somemail.com', '1dec7b4fbf4eafe03f2734d08849dd1f', 1, '2021-03-10 13:32:34', '2021-03-10 13:32:34'),
(9, 'test', 'test@te.st', '098f6bcd4621d373cade4e832627b4f6', 1, '2021-03-18 03:08:15', '2021-03-18 03:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parentId` int(11) DEFAULT 0,
  `path` varchar(256) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parentId`, `path`, `name`, `status`, `description`) VALUES
(1, 0, '1', 'Electronics', 1, 'Electronic devices'),
(2, 1, '1,2', 'Appliances', 1, 'Home and Office appliences'),
(3, 0, '3', 'Hygiene', 1, 'Cleaning products'),
(4, 0, '4', 'Clothing', 1, 'Clothing products edited'),
(5, 4, '4,5', 'Accessories', 1, 'Wearable accessories'),
(6, 0, '6', 'Health', 1, 'Health products edited'),
(42, 2, '1,2,42', 'Kitchen Appliances', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `identifier` varchar(20) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(3, 'About Us', 'about_us', '&lt;h1&gt;About Us&lt;/h1&gt;&lt;p&gt;lorem&lt;/p&gt;', 1, '2021-03-18 12:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `groupId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 1, 'Dhruv', 'Bhavsar', 'dhrv.bhvsr@qwer.ty', 'c62d929e7b7e7b6165923a5dfc60cb56', 1, '2021-02-16 05:45:55', '2021-03-15 12:21:06'),
(2, 2, 'Stephan', 'Smith', 'ste.poe@qwer.ty', '42d8aa7cde9c78c4757862d84620c335', 1, '2021-02-16 05:45:55', '2021-03-10 13:38:16'),
(3, 1, 'Neil', 'Craig', 'ne.cra@qwer.ty', '1cd87f5976c0893cb50d0758f528963f', 1, '2021-02-16 05:45:55', '2021-03-01 05:43:28'),
(4, 2, 'Ivy Jr.', 'Chandler', 'ivy.chand@qwer.ty', 'd41d8cd98f00b204e9800998ecf8427e', 1, '2021-02-16 05:45:55', '2021-02-19 05:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `zipcode`, `country`, `type`) VALUES
(1, 1, 'test', 'test', 'test', '123456', 'test', 'billing'),
(2, 1, 'test', 'test', 'test', '123456', 'test', 'shipping'),
(3, 2, 'test 2 1', 'test 2 1', 'test 2 1', '234567', 'test 2 1', 'billing'),
(4, 2, 'test 2 2', 'test 2 2', 'test 2 2', '234789', 'test 2 2', 'shipping'),
(7, 4, 'test', 'test', 'test', '169961', 'test', 'billing'),
(8, 4, 'test', 'test', 'test', '125690', 'test', 'shipping'),
(17, 3, 'abc', 'abc', 'xyz', '85633', 'xyz', 'billing'),
(18, 3, 'abc', 'abc', 'xyz', '85633', 'xyz', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `default`, `createdDate`) VALUES
(1, 'Retail', 1, '2021-03-02 05:55:21'),
(2, 'Wholesale', 0, '2021-03-02 05:55:21'),
(8, 'Group 1', 0, '2021-03-09 12:03:56'),
(9, 'group 2', 0, '2021-03-09 12:04:02'),
(10, 'Group 3', 0, '2021-03-10 05:11:36'),
(11, 'test', 0, '2021-03-10 07:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `entity_attribute`
--

CREATE TABLE `entity_attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `inputTypeId` varchar(40) NOT NULL,
  `backendType` varchar(40) NOT NULL,
  `backendModel` varchar(40) NOT NULL,
  `sortOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entity_attribute`
--

INSERT INTO `entity_attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputTypeId`, `backendType`, `backendModel`, `sortOrder`) VALUES
(7, 1, 'Color', 'color', 'select', 'VARCHAR(250)', 'model_color', 1),
(8, 1, 'Material', 'material', 'select', 'INT', 'model_material', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entity_attribute_option`
--

CREATE TABLE `entity_attribute_option` (
  `optionId` int(11) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sortOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entity_attribute_option`
--

INSERT INTO `entity_attribute_option` (`optionId`, `attributeId`, `name`, `sortOrder`) VALUES
(12, 8, 'Metal', 0),
(13, 8, 'Plastic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entityTypeId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `tableName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entityTypeId`, `name`, `tableName`) VALUES
(1, 'Product', 'product'),
(2, 'Category', 'category'),
(3, 'Customer', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(1, 'payment 1', 'pm_1', 'about payment 1', 1, '2021-02-17 07:56:25'),
(2, 'payment 2', 'pm_2', 'about payment 2', 1, '2021-02-17 07:56:25'),
(3, 'payment 3', 'pm_3', 'about payment 3', 1, '2021-02-17 07:56:25'),
(4, 'payment 4', 'pm_4', 'about payment 4', 1, '2021-02-17 07:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `color` varchar(250) DEFAULT NULL,
  `material` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `material`) VALUES
(1, 'PR001', 'Laptop edited', 69000, 10, 7, 'Laptop with 4GB ram, 500GB HDD, i5', 1, '2021-02-15 18:20:00', '2021-03-18 07:51:29', NULL, NULL),
(2, 'PR002', 'Mobile', 16000, 5, 70, 'Mobile 6GB ram, 64GB storage', 1, '2021-02-15 18:20:00', '2021-03-10 11:39:21', NULL, NULL),
(3, 'PR003', 'Soap', 100, 0, 100, 'Branded fragrance soap edited', 1, '2021-02-15 18:20:00', '2021-03-18 04:42:26', NULL, NULL),
(4, 'PR004', 'Watch', 2000, 1, 30, 'Branded Watch edited', 1, '2021-02-15 18:20:00', '2021-03-02 18:59:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `productId`, `categoryId`) VALUES
(5, 3, 3),
(6, 3, 6),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `groupId`, `productId`, `price`) VALUES
(1, 1, 1, 67499),
(2, 2, 1, 63000),
(3, 8, 1, 67000),
(4, 9, 1, 68000),
(5, 1, 2, 15800),
(6, 2, 2, 13600),
(7, 8, 2, 15750),
(8, 9, 2, 14400),
(9, 10, 2, 15200),
(10, 10, 1, 55000),
(11, 11, 1, 50000),
(13, 1, 3, 95),
(14, 2, 3, 70),
(15, 8, 3, 80),
(16, 9, 3, 85),
(17, 10, 3, 89),
(18, 11, 3, 92),
(20, 11, 2, 15599),
(28, 1, 4, 1990),
(29, 2, 4, 1850),
(30, 8, 4, 1960),
(31, 9, 4, 1975),
(32, 10, 4, 2099),
(33, 11, 4, 1949);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`id`, `productId`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(1, 1, 'sunset', 0, 0, 0, 0),
(3, 1, '6985550-cool-desktop-backgrounds', 0, 1, 0, 1),
(7, 1, 'meme', 1, 0, 1, 0),
(8, 1, 'calm-body-of-water-1363876', 0, 0, 0, 1),
(12, 3, 'phone-call', 1, 0, 1, 1),
(13, 3, 'avatar', 0, 1, 0, 0),
(14, 4, 'phone-call', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shippingmethod`
--

CREATE TABLE `shippingmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippingmethod`
--

INSERT INTO `shippingmethod` (`id`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(1, 'shipping 1', 'sh_1', '100', 'about shipping 1', 1, '2021-02-17 08:00:52'),
(2, 'shipping 2', 'sh_2', '200', 'about shipping 2', 0, '2021-02-17 08:00:52'),
(3, 'shipping 3', 'sh_3', '300', 'about shipping 3', 1, '2021-02-17 08:00:52'),
(4, 'shipping 4', 'sh_4', '400', 'about shipping 4', 1, '2021-02-17 08:00:52'),
(5, 'shipping 5', 'sh_5', '500', 'about shipping 5', 1, '2021-02-17 08:00:52'),
(11, 'test', 'test', '123', 'test', 0, '2021-03-16 07:28:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id_constraint` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `entity_attribute`
--
ALTER TABLE `entity_attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `entity_attribute_option`
--
ALTER TABLE `entity_attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entityTypeId`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `entity_attribute`
--
ALTER TABLE `entity_attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `entity_attribute_option`
--
ALTER TABLE `entity_attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entityTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `group_id_constraint` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entity_attribute_option`
--
ALTER TABLE `entity_attribute_option`
  ADD CONSTRAINT `entity_attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `entity_attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_group_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

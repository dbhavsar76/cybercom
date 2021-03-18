-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 04:27 PM
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
(1, 0, '1', 'Bedroom', 1, 'Bedroom'),
(2, 0, '2', 'Living Room', 1, 'Living Room'),
(3, 0, '3', 'Dining & Kitchen', 1, 'Dining & Kitchen'),
(4, 0, '4', 'Office', 1, 'Office'),
(5, 0, '5', 'Bar & Game Room', 1, 'Bar & Game Room'),
(6, 0, '6', 'Accessories', 1, 'Accessories'),
(7, 0, '7', 'Outdoor', 1, 'Outdoor'),
(8, 0, '8', 'Entry & Mudroom', 1, 'Entry & Mudroom'),
(9, 1, '1,9', 'Bedroom Sets', 1, 'Bedroom Sets\r\n'),
(10, 1, '1,10', 'Beds', 1, 'Beds'),
(11, 1, '1,11', 'Nightstands', 1, 'Nightstands'),
(12, 1, '1,12', 'Dressers', 1, 'Dressers'),
(13, 1, '1,13', 'Dresser Mirrors', 1, 'Dresser Mirrors'),
(14, 1, '1,14', 'Chests', 1, 'Chests'),
(15, 1, '1,15', 'Bedroom Benches', 1, 'Bedroom Benches'),
(16, 1, '1,16', 'Bed Frames & Headboards', 1, 'Bed Frames & Headboards'),
(17, 1, '1,17', 'Armoires and Wardrobes', 1, 'Armoires and Wardrobes'),
(18, 1, '1,18', 'Bedroom Vanities', 1, 'Bedroom Vanities'),
(19, 1, '1,19', 'Media Chests', 1, 'Media Chests'),
(20, 1, '1,20', 'Jewelry Armoires', 1, 'Jewelry Armoires'),
(21, 1, '1,21', 'Day Beds and Futons', 1, 'Day Beds and Futons'),
(22, 1, '1,22', 'Kids Room', 1, 'Kids Room'),
(23, 1, '1,23', 'Kids and Youth Furniture', 1, 'Kids and Youth Furniture'),
(24, 1, '1,24', 'Baby Furniture', 1, 'Baby Furniture'),
(25, 1, '1,25', 'Mattresses', 1, 'Mattresses'),
(26, 1, '1,26', 'Box Springs & Foundations', 0, 'Box Springs & Foundations'),
(27, 1, '1,27', 'Adjustable Beds', 1, 'Adjustable Beds'),
(28, 1, '1,28', 'Pillows', 1, 'Pillows'),
(29, 1, '1,29', 'Bedding and Comforter Sets', 1, 'Bedding and Comforter Sets'),
(30, 2, '2,30', 'Living Room Sets', 1, 'Living Room Sets'),
(31, 2, '2,31', 'Sectionals', 1, 'Sectionals'),
(32, 2, '2,32', 'Sofas', 1, 'Sofas'),
(33, 2, '2,33', 'Loveseats', 1, 'Loveseats'),
(34, 2, '2,34', 'Reclining Loveseats', 1, 'Reclining Loveseats'),
(35, 2, '2,35', 'Sleeper Sofas', 1, 'Sleeper Sofas'),
(36, 2, '2,36', 'Recliners and Rockers', 1, 'Recliners and Rockers'),
(37, 2, '2,37', 'Theater Seating', 1, 'Theater Seating'),
(38, 2, '2,38', 'Chairs', 1, 'Chairs'),
(39, 2, '2,39', 'Accent Chairs', 1, 'Accent Chairs'),
(40, 2, '2,40', 'Chaises', 1, 'Chaises'),
(41, 2, '2,41', 'Ottomans', 1, 'Ottomans'),
(42, 2, '2,42', 'Futons', 1, 'Futons'),
(43, 2, '2,43', 'Leather Furniture', 1, 'Leather Furniture'),
(44, 2, '2,44', 'Occasional Table Sets', 1, 'Occasional Table Sets'),
(45, 2, '2,45', 'Sofa Tables', 1, 'Sofa Tables'),
(46, 2, '2,46', 'Accent Chests and Cabinets', 1, 'Accent Chests and Cabinets'),
(47, 2, '2,47', 'Console Tables', 1, 'Console Tables'),
(48, 2, '2,48', 'Coffee and Cocktail Tables', 1, 'Coffee and Cocktail Tables'),
(49, 2, '2,49', 'End Tables', 1, 'End Tables'),
(50, 2, '2,50', 'Accent Tables', 1, 'Accent Tables'),
(51, 2, '2,51', 'Side Tables', 1, 'Side Tables'),
(52, 2, '2,52', 'Rugs and Accessories', 1, 'Rugs and Accessories'),
(53, 2, '2,53', 'Entertainment Centers and Wall', 1, 'Entertainment Centers and Walls'),
(54, 2, '2,54', 'TV Stands and TV Consoles', 1, 'TV Stands and TV Consoles'),
(55, 2, '2,55', 'CD and DVD Media Storage', 1, 'CD and DVD Media Storage'),
(56, 3, '3,56', 'Dining Sets', 1, 'Dining Sets'),
(57, 3, '3,57', 'Dinette Sets', 1, 'Dinette Sets'),
(58, 3, '3,58', 'Dining Chairs', 1, 'Dining Chairs'),
(59, 3, '3,59', 'Dining Tables', 1, 'Dining Tables'),
(60, 3, '3,60', 'Dining Benches', 1, 'Dining Benches'),
(61, 3, '3,61', 'China Cabinets', 1, 'China Cabinets'),
(62, 3, '3,62', 'Curios & Displays', 1, 'Curios & Displays'),
(63, 3, '3,63', 'Kitchen Island, Kitchen Cart', 1, 'Kitchen Island, Kitchen Cart'),
(64, 3, '3,64', 'Servers, Sideboards & Buffets', 1, 'Servers, Sideboards & Buffets'),
(65, 4, '4,65', 'Home Office Sets', 1, 'Home Office Sets'),
(66, 4, '4,66', 'Office Chairs', 1, 'Office Chairs'),
(67, 4, '4,67', 'Desks & Hutches', 1, 'Desks & Hutches'),
(68, 4, '4,68', 'Modular Office Furniture', 1, 'Modular Office Furniture'),
(69, 4, '4,69', 'Conference Room', 1, 'Conference Room'),
(70, 4, '4,70', 'Filing Cabinets and Storage', 1, 'Filing Cabinets and Storage'),
(71, 4, '4,71', 'Bookcases, Book Shelves', 1, 'Bookcases, Book Shelves'),
(72, 4, '4,72', 'Office Accessories', 1, 'Office Accessories'),
(73, 4, '4,73', 'Miscellaneous', 1, 'Miscellaneous'),
(74, 5, '5,74', 'Home Bar Sets', 1, 'Home Bar Sets'),
(75, 5, '5,75', 'Bistro and Bar Table Sets', 1, 'Bistro and Bar Table Sets'),
(76, 5, '5,76', 'Game Table Sets', 1, 'Game Table Sets'),
(77, 5, '5,77', 'Bar Tables and Pub Tables', 1, 'Bar Tables and Pub Tables'),
(78, 5, '5,78', 'Barstools', 1, 'Barstools'),
(79, 5, '5,79', 'Wine Racks', 1, 'Wine Racks'),
(80, 5, '5,80', 'Game Tables', 1, 'Game Tables'),
(81, 5, '5,81', 'Game Room Chairs', 1, 'Game Room Chairs'),
(82, 5, '5,82', 'Bar and Wine Cabinets', 1, 'Bar and Wine Cabinets'),
(83, 6, '6,83', 'Rugs', 1, 'Rugs'),
(84, 6, '6,84', 'Wall Art', 1, 'Wall Art'),
(85, 6, '6,85', 'Accent and Storage Benches', 1, 'Accent and Storage Benches'),
(86, 6, '6,86', 'Accent Mirrors', 1, 'Accent Mirrors'),
(87, 6, '6,87', 'Curios', 1, 'Curios'),
(88, 6, '6,88', 'Pillows and Throws', 1, 'Pillows and Throws'),
(89, 6, '6,89', 'Decorative Accessories', 1, 'Decorative Accessories'),
(90, 6, '6,90', 'Entryway Furniture', 1, 'Entryway Furniture'),
(91, 6, '6,91', 'Storage and Organization', 1, 'Storage and Organization'),
(92, 6, '6,92', 'Etageres', 1, 'Etageres'),
(93, 6, '6,93', 'Clocks', 1, 'Clocks'),
(94, 6, '6,94', 'Artificial Plants', 1, 'Artificial Plants'),
(95, 6, '6,95', 'Picture Frames', 1, 'Picture Frames'),
(96, 6, '6,96', 'Lighting', 1, 'Lighting'),
(97, 6, '6,97', 'Desk and Buffet Lamps', 1, 'Desk and Buffet Lamps'),
(98, 6, '6,98', 'Lamp Sets', 1, 'Lamp Sets'),
(99, 6, '6,99', 'Floor Lamps', 1, 'Floor Lamps'),
(100, 6, '6,100', 'Pendant Lighting', 1, 'Pendant Lighting'),
(101, 6, '6,101', 'Wall Sconces', 1, 'Wall Sconces'),
(102, 6, '6,102', 'Bathroom Furniture', 1, 'Bathroom Furniture'),
(103, 7, '7,103', 'Outdoor Conversation Sets', 1, 'Outdoor Conversation Sets'),
(104, 7, '7,104', 'Outdoor Dining Furniture', 1, 'Outdoor Dining Furniture'),
(105, 7, '7,105', 'Outdoor Tables', 1, 'Outdoor Tables'),
(106, 7, '7,106', 'Outdoor Chairs', 1, 'Outdoor Chairs'),
(107, 7, '7,107', 'Outdoor Sofas & Loveseats', 1, 'Outdoor Sofas & Loveseats'),
(108, 7, '7,108', 'Outdoor Chaise Loungers', 1, 'Outdoor Chaise Loungers'),
(109, 7, '7,109', 'Outdoor Bar Furniture', 1, 'Outdoor Bar Furniture'),
(110, 7, '7,110', 'Outdoor Accessories', 1, 'Outdoor Accessories'),
(111, 7, '7,111', 'Outdoor Fireplaces', 1, 'Outdoor Fireplaces'),
(112, 7, '7,112', 'Outdoor Benches', 1, 'Outdoor Benches'),
(113, 7, '7,113', 'Outdoor Ottomans', 1, 'Outdoor Ottomans'),
(114, 8, '8,114', 'Console Tables', 1, 'Console Tables'),
(115, 8, '8,115', 'Storage Benches', 1, 'Storage Benches'),
(116, 8, '8,116', 'Hall Trees', 1, 'Hall Trees'),
(117, 8, '8,117', 'Coat Racks', 1, 'Coat Racks');

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
(10, 'Group 3', 0, '2021-03-10 05:11:36');

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
  `sku` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`) VALUES
(2, 'B720-57-54-96;B720-92', 'Birlanny Silver Upholstered Panel Bedroom', '1496.00', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:27', '2021-03-18 14:24:16'),
(3, 'B733-77-74-98;B733-92', 'Lettner Light Gray Sleigh Bedroom Set', '731.70', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(4, '?B647-54-77-96;B647-191', 'Bolanburg White Louvered Panel Bedroom Set', '819.30', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(5, '?B647-54-77-96;B647-192', 'Bolanburg White Panel Bedroom Set ', '1100.00', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(6, '?B647-54-77-96;B647-193', 'Lettner Light Gray Panel Storage Bedroom Set ', '2100.00', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(7, '?B647-54-77-96;B647-194', 'Lettner Light Gray Panel Bedroom Set ', '230.00', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(8, '?B647-54-77-96;B647-195', 'Magnolia Manor Antique White Upholstered Panel Bedroom Set ', '500.00', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(9, '?B647-54-77-96;B647-196', 'Mirage Panel Bedroom Set ', '490.00', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(10, '?B647-54-77-96;B647-197', 'Cassimore Pearl Silver Panel Bedroom Set ', '2300.00', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(11, '?B647-54-77-96;B647-198', 'Cassimore North Shore Pearl Silver Panel Bedroom Set ', '1167.08', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(12, '?B647-54-77-96;B647-199', 'North Shore Panel Bedroom Set ', '1183.45', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(13, '?B647-54-77-96;B647-200', 'North Shore Sleigh Bedroom Set ', '1199.82', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(14, '?B647-54-77-96;B647-201', 'Flynnter Medium Brown Sleigh Storage Bedroom Set ', '1216.20', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(15, '?B647-54-77-96;B647-202', 'Allyson Park Wire Brushed White Panel Bedroom Set ', '1232.57', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(16, '?B647-54-77-96;B647-203', 'Seville Storage Bedroom Set ', '1248.94', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(17, '?B647-54-77-96;B647-204', 'Tacoma Panel Bedroom Set ', '1265.31', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:28', '2021-03-18 14:21:28'),
(18, '?B647-54-77-96;B647-205', 'Linda Bookcase Storage Bedroom Set (Black) ', '1281.68', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(19, '?B647-54-77-96;B647-206', 'Lyssa Panel Bedroom Set ', '1298.05', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(20, '?B647-54-77-96;B647-207', 'Crown Mark Furniture Emily Captain\'s Bedroom Set in Black ', '1314.43', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(21, '?B647-54-77-96;B647-208', 'Naples White Lacquer Platform Bedroom Set ', '1330.80', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(22, '?B647-54-77-96;B647-209', 'Celandine Silver Panel Bedroom Set ', '1347.17', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(23, '?B647-54-77-96;B647-210', 'Sheffield Panel Bedroom Set (Antique Grey) ', '1363.54', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(24, '?B647-54-77-96;B647-211', 'Farrow Panel Bedroom Set (Chocolate) ', '1379.91', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(25, '?B647-54-77-96;B647-212', 'Stanley Sleigh Bedroom Set ', '1396.28', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(26, '?B647-54-77-96;B647-213', 'Turin Light Grey and Black Lacquer Platform Bedroom Set ', '1412.66', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(27, '?B647-54-77-96;B647-214', 'Global Furniture Hudson Platform Bedroom Set in Zebra...', '1429.03', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(28, '?B647-54-77-96;B647-215', 'Bracco Brown Platform Storage Bedroom Set ', '1445.40', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(29, '?B647-54-77-96;B647-216', 'Lucca Black Lacquer Platform Bedroom Set ', '1461.77', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(30, '?B647-54-77-96;B647-217', 'Global Furniture Linda/8269 Platform Bedroom Set in...', '1478.14', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(31, '?B647-54-77-96;B647-218', 'Barcelona Platform Bedroom Set ', '1494.51', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(32, '?B647-54-77-96;B647-219', 'Madison II Bookcase Storage Bedroom Set ', '1510.89', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(33, '?B647-54-77-96;B647-220', 'Madison Espresso Platform Bedroom Set ', '1527.26', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(34, '?B647-54-77-96;B647-221', 'Albright Driftwood Gray Upholstered Bedroom Set ', '1543.63', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(35, '?B647-54-77-96;B647-222', 'Janeiro Rustic Natural Bedroom Set ', '1560.00', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:29', '2021-03-18 14:21:29'),
(36, '?B647-54-77-96;B647-223', 'Porto Natural Light Grey Lacquer Platform Bedroom Set ', '1576.37', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(37, '?B647-54-77-96;B647-224', 'Balfour Brown Cherry Panel Storage Bedroom Set ', '1592.74', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(38, '?B647-54-77-96;B647-225', 'Marley Sleigh Bedroom Set (Silver) ', '1609.12', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(39, '?B647-54-77-96;B647-226', 'Flandreau Brown Panel Bedroom Set ', '1625.49', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(40, '?B647-54-77-96;B647-227', 'Deryn Park Poster Bedroom Set ', '1641.86', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(41, '?B647-54-77-96;B647-228', 'Braga Natural Grey Lacquer Platform Bedroom Set ', '1658.23', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(42, '?B647-54-77-96;B647-229', 'Platinum Legno Bedroom Set ', '1674.60', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(43, '?B647-54-77-96;B647-230', 'Barocco Bedroom Set (Ivory) ', '1690.97', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(44, '?B647-54-77-96;B647-231', 'Royal Highlands Rich Cherry Panel Bedroom Set ', '1707.35', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(45, '?B647-54-77-96;B647-232', 'Tamblin Panel Bedroom Set ', '1723.72', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(46, '?B647-54-77-96;B647-233', 'Sanremo B Platform Bedroom Set ', '1740.09', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(47, '?B647-54-77-96;B647-234', 'Cotterill Cherry Panel Bedroom Set ', '1756.46', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(48, '?B647-54-77-96;B647-235', 'Rhapsody Brown Panel Bedroom Set ', '1772.83', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(49, '?B647-54-77-96;B647-236', 'Ireland White Youth Bookcase Storage Bedroom Set', '1789.20', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(50, '?B647-54-77-96;B647-237', 'Paris Light Gray Platform Bedroom Set ', '1805.58', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(51, '?B647-54-77-96;B647-238', 'Louis Philippe Antique Gray Sleigh Bedroom Set ', '1821.95', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:30', '2021-03-18 14:21:30'),
(52, '?B647-54-77-96;B647-239', 'Rustic Hills Spiced Cream Poster Bedroom Set ', '1838.32', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(53, '?B647-54-77-96;B647-240', 'Crown Mark Furniture Evan Bedroom Set in Warm Brown ', '1854.69', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(54, '?B647-54-77-96;B647-241', 'Panang Mahogany Panel Storage Bedroom Set ', '1871.06', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(55, '?B647-54-77-96;B647-242', 'Barcelona Storage Bedroom Set ', '1887.43', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(56, '?B647-54-77-96;B647-243', 'Mar Panel Wall Bedroom Set ', '1903.81', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(57, '?B647-54-77-96;B647-244', 'Ambra Panel Bedroom Set ', '1920.18', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(58, '?B647-54-77-96;B647-245', 'Carmen Platform Bedroom Set (Walnut) ', '1936.55', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(59, '?B647-54-77-96;B647-246', 'Lorraine Dark Grey Upholstered Storage Platform Bedroom Set ', '1952.92', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(60, '?B647-54-77-96;B647-247', 'Tranquility White Panel Bedroom Set ', '1969.29', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(61, '?B647-54-77-96;B647-248', 'Curated Sloane White Living Room Set ', '1985.66', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(62, '?B647-54-77-96;B647-249', 'Mila Living Room Set ', '2002.04', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(63, '?B647-54-77-96;B647-250', 'Morgan Rose Accolade Living Room Set ', '2018.41', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(64, '?B647-54-77-96;B647-251', 'Greeley Double Reclining Living Room Set ', '2034.78', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(65, '?B647-54-77-96;B647-252', 'Braelyn Living Room Set (Black / Red) ', '2051.15', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:31', '2021-03-18 14:21:31'),
(66, '?B647-54-77-96;B647-253', 'Pierre Black Living Room Set ', '2067.52', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(67, '?B647-54-77-96;B647-254', 'A973 Black Italian Leather Living Room Set ', '2083.89', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(68, '?B647-54-77-96;B647-255', 'Parma Ivory Leatherette Living Room Set ', '2100.27', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(69, '?B647-54-77-96;B647-256', 'Jamael Brown Living Room Set ', '2116.64', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(70, '?B647-54-77-96;B647-257', 'Julian Living Room Set (Grey/ Chrome) ', '2133.01', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(71, '?B647-54-77-96;B647-258', 'Poppy Living Room Set Grey ', '2149.38', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(72, '?B647-54-77-96;B647-259', 'Mitzy Living Room Set ', '2165.75', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(73, '?B647-54-77-96;B647-260', 'Meridian Ferrara 2 Piece Living Room Set in Grey ', '2182.12', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(74, '?B647-54-77-96;B647-261', 'Meridian Bowery 2 Piece Living Room Set ', '2198.50', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(75, '?B647-54-77-96;B647-262', 'Meridian Naomi 2pc Velvet Living Room Set in Black', '2214.87', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(76, '?B647-54-77-96;B647-263', 'Rawcliffe Parchment Oversized Accent Ottoman ', '2231.24', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(77, '?B647-54-77-96;B647-264', 'Accrington Oversized Accent Ottoman ', '2247.61', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(78, '?B647-54-77-96;B647-265', 'Curated Sloane White Chair ', '2263.98', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(79, '?B647-54-77-96;B647-266', 'Branson Camel Lay Flat Power Reclining Sofa ', '2280.35', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(80, '?B647-54-77-96;B647-267', 'Liberty Furniture Mirage 7-Piece Trestle Dining Table Set in...', '2296.73', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(81, '?B647-54-77-96;B647-268', 'Liberty Furniture Mirage 5-Piece Round Dining Table Set in...', '2313.10', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(82, '?B647-54-77-96;B647-269', 'Coviar Brown 6 Piece Dining Room Set ', '2329.47', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(83, '?B647-54-77-96;B647-270', 'Havenbrook Rustic Russet Trestle Dining Room Set ', '2345.84', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:32', '2021-03-18 14:21:32'),
(84, '?B647-54-77-96;B647-271', 'Meridian Furniture Pierre 5pcs Dining Room Set in Rich Gold...', '2362.21', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(85, '?B647-54-77-96;B647-272', 'Meridian Furniture Alexis 5pcs Dining Room Set in Rich...', '2378.58', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(86, '?B647-54-77-96;B647-273', 'Deryn Park Cherry Extendable Leg Dining Room Set ', '2394.96', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(87, '?B647-54-77-96;B647-274', 'Amina Champagne Round Dining Room Set ', '2411.33', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(88, '?B647-54-77-96;B647-275', 'D1628 Dining Room Set w/ Two-Tone Chairs ', '2427.70', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(89, '?B647-54-77-96;B647-276', 'Avesta 45.28 Mid-Century Modern High Double Cabinet...', '2444.07', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(90, '?B647-54-77-96;B647-277', 'Shabby Chic Cottage Antique Gray 1 Door Accent Cabinet ', '2460.44', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(91, '?B647-54-77-96;B647-278', 'Keegan Buffet and Hutch ', '2476.81', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(92, '?B647-54-77-96;B647-279', 'Arcadia File Cabinet ZARC-6010 ', '2493.19', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(93, '?B647-54-77-96;B647-280', 'Milam Cream 2 Door Drop Lid Cabinet ', '2509.56', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(94, '?B647-54-77-96;B647-281', 'Tashay Beige Wicker 3 Piece Patio Bistro Set ', '2525.93', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(95, '?B647-54-77-96;B647-282', 'Mardin Dining Set ', '2542.30', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(96, '?B647-54-77-96;B647-283', 'Bradbury Dark Slate Grey and Beige 5-Piece Dining Set', '2558.67', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(97, '?B647-54-77-96;B647-284', 'Charissa Antique Black Patio Dining Room Set ', '2575.04', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(98, '?B647-54-77-96;B647-285', 'Grasson Lane Brown And Blue Outdoor Chaise Lounger With...', '2591.42', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(99, '?B647-54-77-96;B647-286', 'Island Estate Lanai Chaise ', '2607.79', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(100, '?B647-54-77-96;B647-287', 'Solano Black and White Sunlounger ', '2624.16', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(101, '?B647-54-77-96;B647-288', 'Pavlova Chaise Lounge ', '2640.53', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:33', '2021-03-18 14:21:33'),
(102, '?B647-54-77-96;B647-289', 'Aviano Chaise Lounge ', '2656.90', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(103, 'SKU', 'NAME', '0.00', 0, 0, 'DISCRIPTION', 0, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(104, 'B720-57-54-96;B720-92', 'Birlanny Silver Upholstered Panel Bedroom', '1496.00', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(105, 'B733-77-74-98;B733-92', 'Lettner Light Gray Sleigh Bedroom Set', '731.70', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(106, '?B647-54-77-96;B647-191', 'Bolanburg White Louvered Panel Bedroom Set', '819.30', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(107, '?B647-54-77-96;B647-192', 'Bolanburg White Panel Bedroom Set ', '1100.00', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(108, '?B647-54-77-96;B647-193', 'Lettner Light Gray Panel Storage Bedroom Set ', '2100.00', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:34', '2021-03-18 14:21:34'),
(109, '?B647-54-77-96;B647-194', 'Lettner Light Gray Panel Bedroom Set ', '230.00', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(110, '?B647-54-77-96;B647-195', 'Magnolia Manor Antique White Upholstered Panel Bedroom Set ', '500.00', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(111, '?B647-54-77-96;B647-196', 'Mirage Panel Bedroom Set ', '490.00', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(112, '?B647-54-77-96;B647-197', 'Cassimore Pearl Silver Panel Bedroom Set ', '2300.00', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(113, '?B647-54-77-96;B647-198', 'Cassimore North Shore Pearl Silver Panel Bedroom Set ', '1167.08', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(114, '?B647-54-77-96;B647-199', 'North Shore Panel Bedroom Set ', '1183.45', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(115, '?B647-54-77-96;B647-200', 'North Shore Sleigh Bedroom Set ', '1199.82', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(116, '?B647-54-77-96;B647-201', 'Flynnter Medium Brown Sleigh Storage Bedroom Set ', '1216.20', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(117, '?B647-54-77-96;B647-202', 'Allyson Park Wire Brushed White Panel Bedroom Set ', '1232.57', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(118, '?B647-54-77-96;B647-203', 'Seville Storage Bedroom Set ', '1248.94', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(119, '?B647-54-77-96;B647-204', 'Tacoma Panel Bedroom Set ', '1265.31', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(120, '?B647-54-77-96;B647-205', 'Linda Bookcase Storage Bedroom Set (Black) ', '1281.68', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(121, '?B647-54-77-96;B647-206', 'Lyssa Panel Bedroom Set ', '1298.05', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:35', '2021-03-18 14:21:35'),
(122, '?B647-54-77-96;B647-207', 'Crown Mark Furniture Emily Captain\'s Bedroom Set in Black ', '1314.43', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(123, '?B647-54-77-96;B647-208', 'Naples White Lacquer Platform Bedroom Set ', '1330.80', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(124, '?B647-54-77-96;B647-209', 'Celandine Silver Panel Bedroom Set ', '1347.17', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(125, '?B647-54-77-96;B647-210', 'Sheffield Panel Bedroom Set (Antique Grey) ', '1363.54', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(126, '?B647-54-77-96;B647-211', 'Farrow Panel Bedroom Set (Chocolate) ', '1379.91', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(127, '?B647-54-77-96;B647-212', 'Stanley Sleigh Bedroom Set ', '1396.28', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(128, '?B647-54-77-96;B647-213', 'Turin Light Grey and Black Lacquer Platform Bedroom Set ', '1412.66', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(129, '?B647-54-77-96;B647-214', 'Global Furniture Hudson Platform Bedroom Set in Zebra...', '1429.03', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(130, '?B647-54-77-96;B647-215', 'Bracco Brown Platform Storage Bedroom Set ', '1445.40', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(131, '?B647-54-77-96;B647-216', 'Lucca Black Lacquer Platform Bedroom Set ', '1461.77', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(132, '?B647-54-77-96;B647-217', 'Global Furniture Linda/8269 Platform Bedroom Set in...', '1478.14', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(133, '?B647-54-77-96;B647-218', 'Barcelona Platform Bedroom Set ', '1494.51', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(134, '?B647-54-77-96;B647-219', 'Madison II Bookcase Storage Bedroom Set ', '1510.89', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(135, '?B647-54-77-96;B647-220', 'Madison Espresso Platform Bedroom Set ', '1527.26', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(136, '?B647-54-77-96;B647-221', 'Albright Driftwood Gray Upholstered Bedroom Set ', '1543.63', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(137, '?B647-54-77-96;B647-222', 'Janeiro Rustic Natural Bedroom Set ', '1560.00', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(138, '?B647-54-77-96;B647-223', 'Porto Natural Light Grey Lacquer Platform Bedroom Set ', '1576.37', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(139, '?B647-54-77-96;B647-224', 'Balfour Brown Cherry Panel Storage Bedroom Set ', '1592.74', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(140, '?B647-54-77-96;B647-225', 'Marley Sleigh Bedroom Set (Silver) ', '1609.12', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(141, '?B647-54-77-96;B647-226', 'Flandreau Brown Panel Bedroom Set ', '1625.49', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:36', '2021-03-18 14:21:36'),
(142, '?B647-54-77-96;B647-227', 'Deryn Park Poster Bedroom Set ', '1641.86', 10, 3, 'Part of Bolanburg Collection.Crafted from acacia veneers and solids.Textured antique white finish.Shelter style panel bed.Louvered design', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(143, '?B647-54-77-96;B647-228', 'Braga Natural Grey Lacquer Platform Bedroom Set ', '1658.23', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(144, '?B647-54-77-96;B647-229', 'Platinum Legno Bedroom Set ', '1674.60', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(145, '?B647-54-77-96;B647-230', 'Barocco Bedroom Set (Ivory) ', '1690.97', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(146, '?B647-54-77-96;B647-231', 'Royal Highlands Rich Cherry Panel Bedroom Set ', '1707.35', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(147, '?B647-54-77-96;B647-232', 'Tamblin Panel Bedroom Set ', '1723.72', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(148, '?B647-54-77-96;B647-233', 'Sanremo B Platform Bedroom Set ', '1740.09', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(149, '?B647-54-77-96;B647-234', 'Cotterill Cherry Panel Bedroom Set ', '1756.46', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(150, '?B647-54-77-96;B647-235', 'Rhapsody Brown Panel Bedroom Set ', '1772.83', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(151, '?B647-54-77-96;B647-236', 'Ireland White Youth Bookcase Storage Bedroom Set', '1789.20', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(152, '?B647-54-77-96;B647-237', 'Paris Light Gray Platform Bedroom Set ', '1805.58', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(153, '?B647-54-77-96;B647-238', 'Louis Philippe Antique Gray Sleigh Bedroom Set ', '1821.95', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(154, '?B647-54-77-96;B647-239', 'Rustic Hills Spiced Cream Poster Bedroom Set ', '1838.32', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:37', '2021-03-18 14:21:37'),
(155, '?B647-54-77-96;B647-240', 'Crown Mark Furniture Evan Bedroom Set in Warm Brown ', '1854.69', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(156, '?B647-54-77-96;B647-241', 'Panang Mahogany Panel Storage Bedroom Set ', '1871.06', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(157, '?B647-54-77-96;B647-242', 'Barcelona Storage Bedroom Set ', '1887.43', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(158, '?B647-54-77-96;B647-243', 'Mar Panel Wall Bedroom Set ', '1903.81', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(159, '?B647-54-77-96;B647-244', 'Ambra Panel Bedroom Set ', '1920.18', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(160, '?B647-54-77-96;B647-245', 'Carmen Platform Bedroom Set (Walnut) ', '1936.55', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(161, '?B647-54-77-96;B647-246', 'Lorraine Dark Grey Upholstered Storage Platform Bedroom Set ', '1952.92', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(162, '?B647-54-77-96;B647-247', 'Tranquility White Panel Bedroom Set ', '1969.29', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(163, '?B647-54-77-96;B647-248', 'Curated Sloane White Living Room Set ', '1985.66', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(164, '?B647-54-77-96;B647-249', 'Mila Living Room Set ', '2002.04', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(165, '?B647-54-77-96;B647-250', 'Morgan Rose Accolade Living Room Set ', '2018.41', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(166, '?B647-54-77-96;B647-251', 'Greeley Double Reclining Living Room Set ', '2034.78', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38');
INSERT INTO `product` (`id`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`) VALUES
(167, '?B647-54-77-96;B647-252', 'Braelyn Living Room Set (Black / Red) ', '2051.15', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(168, '?B647-54-77-96;B647-253', 'Pierre Black Living Room Set ', '2067.52', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(169, '?B647-54-77-96;B647-254', 'A973 Black Italian Leather Living Room Set ', '2083.89', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(170, '?B647-54-77-96;B647-255', 'Parma Ivory Leatherette Living Room Set ', '2100.27', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:38', '2021-03-18 14:21:38'),
(171, '?B647-54-77-96;B647-256', 'Jamael Brown Living Room Set ', '2116.64', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(172, '?B647-54-77-96;B647-257', 'Julian Living Room Set (Grey/ Chrome) ', '2133.01', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(173, '?B647-54-77-96;B647-258', 'Poppy Living Room Set Grey ', '2149.38', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(174, '?B647-54-77-96;B647-259', 'Mitzy Living Room Set ', '2165.75', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(175, '?B647-54-77-96;B647-260', 'Meridian Ferrara 2 Piece Living Room Set in Grey ', '2182.12', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(176, '?B647-54-77-96;B647-261', 'Meridian Bowery 2 Piece Living Room Set ', '2198.50', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(177, '?B647-54-77-96;B647-262', 'Meridian Naomi 2pc Velvet Living Room Set in Black', '2214.87', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(178, '?B647-54-77-96;B647-263', 'Rawcliffe Parchment Oversized Accent Ottoman ', '2231.24', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(179, '?B647-54-77-96;B647-264', 'Accrington Oversized Accent Ottoman ', '2247.61', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(180, '?B647-54-77-96;B647-265', 'Curated Sloane White Chair ', '2263.98', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(181, '?B647-54-77-96;B647-266', 'Branson Camel Lay Flat Power Reclining Sofa ', '2280.35', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(182, '?B647-54-77-96;B647-267', 'Liberty Furniture Mirage 7-Piece Trestle Dining Table Set in...', '2296.73', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(183, '?B647-54-77-96;B647-268', 'Liberty Furniture Mirage 5-Piece Round Dining Table Set in...', '2313.10', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(184, '?B647-54-77-96;B647-269', 'Coviar Brown 6 Piece Dining Room Set ', '2329.47', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(185, '?B647-54-77-96;B647-270', 'Havenbrook Rustic Russet Trestle Dining Room Set ', '2345.84', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(186, '?B647-54-77-96;B647-271', 'Meridian Furniture Pierre 5pcs Dining Room Set in Rich Gold...', '2362.21', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(187, '?B647-54-77-96;B647-272', 'Meridian Furniture Alexis 5pcs Dining Room Set in Rich...', '2378.58', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(188, '?B647-54-77-96;B647-273', 'Deryn Park Cherry Extendable Leg Dining Room Set ', '2394.96', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(189, '?B647-54-77-96;B647-274', 'Amina Champagne Round Dining Room Set ', '2411.33', 10, 3, 'Grace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters', 1, '2021-03-18 14:21:39', '2021-03-18 14:21:39'),
(190, '?B647-54-77-96;B647-275', 'D1628 Dining Room Set w/ Two-Tone Chairs ', '2427.70', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(191, '?B647-54-77-96;B647-276', 'Avesta 45.28 Mid-Century Modern High Double Cabinet...', '2444.07', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(192, '?B647-54-77-96;B647-277', 'Shabby Chic Cottage Antique Gray 1 Door Accent Cabinet ', '2460.44', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(193, '?B647-54-77-96;B647-278', 'Keegan Buffet and Hutch ', '2476.81', 10, 3, 'Part of Lettner Collection from Ashley.Crafted fom select birch veneers and hardwood solids.Burnished light gray finish.Nightstand, Dresser & Chest features patinated silver color knob and back plate drawers, Dovetail Drawer Construction , color finish drawer interior, ball bearing drawer glides & felt drawer bottoms on select drawers', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(194, '?B647-54-77-96;B647-279', 'Arcadia File Cabinet ZARC-6010 ', '2493.19', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(195, '?B647-54-77-96;B647-280', 'Milam Cream 2 Door Drop Lid Cabinet ', '2509.56', 10, 3, 'Lose yourself in luxury with this Brilanny Silver Upholstered Panel Bedroom Set, created by the master furniture crafters of Signature Design by Ashley.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(196, '?B647-54-77-96;B647-281', 'Tashay Beige Wicker 3 Piece Patio Bistro Set ', '2525.93', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(197, '?B647-54-77-96;B647-282', 'Mardin Dining Set ', '2542.30', 10, 3, 'Accent a room with the bolanburg bed that exudes a mix of styles including shabby chic casual cottage and a touch of down home country.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(198, '?B647-54-77-96;B647-283', 'Bradbury Dark Slate Grey and Beige 5-Piece Dining Set', '2558.67', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(199, '?B647-54-77-96;B647-284', 'Charissa Antique Black Patio Dining Room Set ', '2575.04', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(200, '?B647-54-77-96;B647-285', 'Grasson Lane Brown And Blue Outdoor Chaise Lounger With...', '2591.42', 10, 3, 'Savor every moment outdoors with this contemporary dining set. Designed with gorgeous natural eucalyptus wood for value and versatility, friends and family will spend hours in one of the four comfy armchairs that surround its generous dining table.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(201, '?B647-54-77-96;B647-286', 'Island Estate Lanai Chaise ', '2607.79', 10, 3, 'Part of Tashay Collection from ACME Furniture.Upholstered in green fabric.Weather wicker frame.Square side table.', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(202, '?B647-54-77-96;B647-287', 'Solano Black and White Sunlounger ', '2624.16', 10, 3, 'Cypress Point Ocean Terrace features a distinctive V-pattern of all-weather woven wicker, aluminum frames in a custom aged iron finish?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(203, '?B647-54-77-96;B647-288', 'Pavlova Chaise Lounge ', '2640.53', 10, 3, 'Designs in Island Estate Lanai celebrate the natural beauty and classic look of woven wicker.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40'),
(204, '?B647-54-77-96;B647-289', 'Aviano Chaise Lounge ', '2656.90', 10, 3, 'With designs highlighted by sweeping contours and graceful lines, the Pavlova collections offers a fresh interpretation of classic contemporary styling.?', 1, '2021-03-18 14:21:40', '2021-03-18 14:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(34, 1, 2, 1496),
(35, 2, 2, 1300),
(36, 8, 2, 1450),
(37, 9, 2, 1420),
(38, 10, 2, 1400);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_media_ibfk_1` (`productId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

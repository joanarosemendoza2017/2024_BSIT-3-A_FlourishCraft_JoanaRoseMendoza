-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 02:59 AM
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
-- Database: `flourish_craft`
--

-- --------------------------------------------------------

--
-- Table structure for table `cost_raw_materials`
--

CREATE TABLE `cost_raw_materials` (
  `cost_raw_materials_ID` int(11) NOT NULL,
  `raw_materials_name` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost_raw_materials`
--

INSERT INTO `cost_raw_materials` (`cost_raw_materials_ID`, `raw_materials_name`, `cost`) VALUES
(1, 'Rose', '30'),
(2, 'Wrap', '15'),
(3, 'Cloud Nine', '10'),
(4, 'Goya Take It', '15'),
(5, 'Choco Mucho', '10'),
(6, 'Toblerone', '150'),
(7, 'Dairy Milk 100g', '35'),
(8, 'Kisses', '60'),
(9, 'Goya', '25'),
(10, 'Mini Choco Mucho', '3'),
(11, 'Fairy Lights', '50');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL,
  `House_Number` varchar(255) DEFAULT NULL,
  `Zone` varchar(255) DEFAULT NULL,
  `Barangay` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `Region` varchar(255) DEFAULT NULL,
  `Zip_Code` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `Name`, `Age`, `Gender`, `Phone_Number`, `House_Number`, `Zone`, `Barangay`, `City`, `Province`, `Region`, `Zip_Code`, `Email`, `Username`, `Password`, `user_status`, `user_type`) VALUES
(1, 'Kendra Villar', '21', 'Female', '09052816697', '124', '3', 'Salvacion', 'Polangui', 'Albay', 'V', '4506', 'kendramaivillar21@gmail.com', 'kendra', '0000', 'A', 'A'),
(2, 'Kendra Villar', '21', 'Female', '09052816697', '124', '3', 'Salvacion', 'Polangui', 'Albay', 'V', '4506', 'kendramaivillar21@gmail.com', 'kendra', '0000', 'A', 'C'),
(3, 'Alliah', '20', 'Female', '905 281 6697', '124', '3', 'Salvacion', 'Polangui', 'Albay', 'V', '4506', 'alliah@gmail', 'alliah', '2004', 'A', 'C'),
(4, 'Alliah', '20', 'Female', '905 281 6697', '124', '3', 'Salvacion', 'Polangui', 'Albay', 'V', '4506', 'alliah@gmail', 'alliah', '2004', 'A', 'C'),
(5, 'Andrei Bongalon', '19', 'M', '091111111', '12', '9', 'Ponso', 'Polangui', 'Albay', '5', '4506', 'drei@yahoo.com', 'andrei', '123456', 'A', 'C'),
(6, 'Jap', '19', 'M', '0912121211', '121', '8', 'Alnay', 'Polangui', 'Albay', '5', '4506', 'aaaa@gmail.com', 'Anese', 'Japanese', 'A', 'C'),
(11, 'Paul', '19', 'M', '00291833181', '11', '4', 'Napo', 'Polangui', 'Albay', '5', '4506', 'Powl@gmail.com', 'Powl', '321', 'A', 'C'),
(12, 'Paulygon', '12', 'Female', '0987654321', '44', '3', 'Ponso', 'Polangui', 'Albay', '7', '1212', 'paulygon@gmail.com', 'wow', '1234', 'A', 'C'),
(13, 'Ken', '43', 'M', '091234533', '09', '3', 'Basud', 'Polangui', 'Albay', '5', '4506', 'ken@gg.com', 'kenken', '345', 'A', 'A'),
(14, 'Jonas', '20', 'M', '095431345', '8', '6', 'Anopol', 'Polangui', 'Albay', '5', '4506', 'son@gg.com', 'jonas', 'jonas', 'A', 'C'),
(15, 'John', '20', 'M', '095168865555', '101', '5', 'Mendez', 'Polangui', 'Albay', '5', '4506', 'john@gg.com', 'Jdoe', '3333', 'A', 'C'),
(16, 'Joana Rose Mendoza', '20', 'Male', '09155101670', '#0074', 'Zone 3', 'Salvacion', 'Polangui', 'Albay', 'V1', '4506', 'joanarosemendoza17@gmail.com', 'joanarose', '12345', 'A', 'C'),
(17, 'Rhea Mai', '22', 'F', '05555554', '58', '7', 'ponso', 'polangui', 'a', 'v', '515', 'mama@gmail.com', 'rhea', '121212', 'A', 'C'),
(18, 'Jimboy Estrada', '24', 'M', '09388708645', '526', '2', 'Ponso', 'Polangui', 'Albay', 'V', '4506', 'jimboyboy@gmail.com', 'jimboy', '12345', 'A', 'C'),
(19, 'Jericho Padilla', '20', 'Male', '09155101670s', '101', '7', 'Ponso', 'Polangui', 'Albay', 'V', '4506', 'jek@gmail.com', 'jekjek', '123', 'A', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_ID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Set_Name` varchar(255) DEFAULT NULL,
  `Variation` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `Price` varchar(255) DEFAULT NULL,
  `Delivery_Date` timestamp NULL DEFAULT current_timestamp(),
  `mode_of_payment` varchar(255) NOT NULL,
  `mode_of_delivery` varchar(255) NOT NULL,
  `Order_Date` date DEFAULT curdate(),
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `shipping_status` varchar(50) NOT NULL DEFAULT 'otw',
  `archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_ID`, `Customer_ID`, `Set_Name`, `Variation`, `Quantity`, `Price`, `Delivery_Date`, `mode_of_payment`, `mode_of_delivery`, `Order_Date`, `order_status`, `shipping_status`, `archived`) VALUES
(40, 17, 'SET D', 'yellow', '4', '320', '2024-06-02 16:00:00', 'gcash', 'delivery', '2024-06-03', 'delivered', 'otw', 1),
(41, 17, 'SET C', 'brown', '1', '450', '2024-06-02 16:00:00', 'cod', 'delivery', '2024-06-03', 'delivered', 'delivered', 1),
(42, 17, 'SET I', 'pink', '2', '1100', '2024-06-02 16:00:00', 'gcash', 'pickup', '2024-05-03', 'delivered', 'otw', 1),
(43, 17, 'SET B', 'pink', '1', '500', '2024-06-02 16:00:00', 'cod', 'delivery', '2024-06-03', 'delivered', 'otw', 1),
(44, 17, 'SET C', 'red', '1', '450', '2024-06-02 16:00:00', 'cod', 'pickup', '2024-06-03', 'delivered', 'otw', 1),
(45, 16, 'SET A', 'red', '1', '700', '2024-06-02 16:00:00', 'gcash', 'pickup', '2024-06-03', 'received', 'delivered', 0),
(46, 16, 'SET A', 'blue', '1', '700', '2024-06-02 16:00:00', 'cod', 'delivery', '2024-06-04', 'received', 'delivered', 0),
(47, 16, 'SET A', 'brown', '1', '700', '2024-06-02 16:00:00', 'cod', 'delivery', '2024-06-04', 'received', 'delivered', 0),
(48, 16, 'SET E', 'red', '1', '70', '2024-06-02 16:00:00', 'gcash', 'delivery', '2024-06-04', 'received', 'delivered', 0),
(49, 13, 'SET E', 'red', '1', '70', '2024-06-02 16:00:00', 'gcash', 'delivery', '2024-06-04', 'received', 'otw', 0),
(50, 17, 'SET D', 'pink', '1', '80', '2024-06-02 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(51, 16, 'SET I', 'red', '1', '550', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'delivered', 0),
(52, 16, 'SET A', 'red', '1', '700', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'otw', 0),
(53, 15, 'SET E', 'red', '1', '70', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 0),
(54, 15, 'SET A', 'red', '1', '700', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'delivered', 0),
(55, 15, 'SET F', 'red', '1', '250', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'otw', 1),
(56, 15, 'SET D', 'red', '1', '80', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(57, 15, 'SET B', 'red', '1', '500', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(58, 16, 'SET H', 'red', '1', '800', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(59, 16, 'SET F', 'red', '1', '250', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(60, 16, 'lime', 'red', '1', '100', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'delivered', 1),
(61, 17, 'SET E', 'red', '2', '140', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'otw', 1),
(62, 17, 'SET F', 'red', '1', '250', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'delivered', 1),
(63, 16, 'SET A', 'yellow', '1', '700', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'otw', 1),
(64, 16, 'SET B', 'red', '1', '500', '2024-06-03 16:00:00', 'gcash', 'pickup', '2024-06-04', 'pending', 'otw', 0),
(65, 18, 'SET B', 'red', '1', '600', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'otw', 1),
(66, 13, 'SET A', 'red', '1', '1100', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'pending', 'otw', 0),
(67, 13, 'SET B', 'red', '1', '500', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'pending', 'otw', 0),
(68, 16, 'SET B', 'red', '1', '500', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'delivered', 'delivered', 1),
(69, 16, 'SET A', 'red', '1', '1100', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'pending', 'otw', 0),
(70, 16, 'SET B', 'red', '1', '600', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'pending', 'otw', 0),
(71, 16, 'SET A', 'red', '1', '1100', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-04', 'pending', 'otw', 0),
(72, 16, 'SET B', 'red', '1', '600', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'delivered', 'delivered', 1),
(73, 19, 'SET B', 'red', '1', '500', '2024-06-08 16:00:00', 'cod', 'pickup', '2024-06-04', 'received', 'delivered', 1),
(74, 19, 'SET A', 'red', '2', '2300', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-04', 'received', 'delivered', 1),
(75, 19, 'SET A', 'red', '1', '1200', '2024-06-03 16:00:00', 'gcash', 'delivery', '2024-06-05', 'received', 'delivered', 1),
(76, 19, 'SET F', 'red', '1', '250', '2024-06-03 16:00:00', 'gcash', 'pickup', '2024-06-05', 'received', 'delivered', 1),
(77, 19, 'SET A', 'red', '1', '1100', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-05', 'delivered', 'otw', 1),
(78, 19, 'SET A', 'violet', '3', '3300', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-05', 'delivered', 'otw', 1),
(79, 17, 'SET I', 'yellow', '1', '550', '2024-06-03 16:00:00', 'cod', 'pickup', '2024-06-05', 'received', 'delivered', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Order_ID` int(11) DEFAULT NULL,
  `Mode_of_Payment` varchar(50) DEFAULT NULL,
  `Account_Name` varchar(255) DEFAULT NULL,
  `Account_Number` varchar(255) DEFAULT NULL,
  `Reference_Number` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Order_ID`, `Mode_of_Payment`, `Account_Name`, `Account_Number`, `Reference_Number`, `Amount`) VALUES
(8, 34, 'gcash', 'kapaykpay', '090909090', '97726621', 1400.00),
(9, 35, 'gcash', 'Rhea', '096454854', '25564554', 500.00),
(10, 36, 'gcash', 'ken', '069712545', '5544777845', 700.00),
(11, 37, 'gcash', 'Kim', '09898767374', '2ii38242978y3', 1400.00),
(12, 38, 'gcash', 'kimi', '989473', 'dfe49934u5', 1000.00),
(13, 39, 'gcash', 'klim', '99999', '99999', 700.00),
(14, 40, 'gcash', 'Rhea Mae O. Samaniego', '035541465', '22315546112', 320.00),
(15, 41, 'cod', NULL, NULL, NULL, NULL),
(16, 42, 'gcash', 'tata', '4454', '44', 1100.00),
(17, 43, 'cod', NULL, NULL, NULL, NULL),
(18, 44, 'cod', NULL, NULL, NULL, NULL),
(19, 45, 'gcash', 'joana', '54', '665', 700.00),
(20, 46, 'cod', NULL, NULL, NULL, NULL),
(21, 47, 'cod', NULL, NULL, NULL, NULL),
(22, 48, 'gcash', 'kimi', '1233', '1232', 70.00),
(23, 49, 'gcash', 'kala', '7', '8', 70.00),
(24, 50, 'cod', NULL, NULL, NULL, NULL),
(25, 51, 'cod', NULL, NULL, NULL, NULL),
(26, 52, 'gcash', 'Joana Rose', '09111913', '12138423', 700.00),
(27, 53, 'cod', NULL, NULL, NULL, NULL),
(28, 54, 'gcash', 'qqqq', '12122121', '1212121', 700.00),
(29, 55, 'gcash', 'John Doe', '12312313', '12312323', 250.00),
(30, 56, 'cod', NULL, NULL, NULL, NULL),
(31, 57, 'cod', NULL, NULL, NULL, NULL),
(32, 58, 'cod', NULL, NULL, NULL, NULL),
(33, 59, 'cod', NULL, NULL, NULL, NULL),
(34, 60, 'gcash', 'kind', '0989', '3155611564', 100.00),
(35, 61, 'cod', NULL, NULL, NULL, NULL),
(36, 62, 'cod', NULL, NULL, NULL, NULL),
(37, 63, 'gcash', 'wjwiejw', '9900', '88', 700.00),
(38, 64, 'gcash', 'j', '00', '111', 0.00),
(39, 65, 'gcash', 'Jimboy Estrada', '0911122911', 'DDSDFPS1121213', 600.00),
(40, 66, 'cod', NULL, NULL, NULL, NULL),
(41, 67, 'cod', NULL, NULL, NULL, NULL),
(42, 68, 'cod', NULL, NULL, NULL, NULL),
(43, 69, 'cod', NULL, NULL, NULL, NULL),
(44, 70, 'gcash', 'Rhea Mae O. Samaniego', '0912192192', '123213', 600.00),
(45, 71, 'cod', NULL, NULL, NULL, NULL),
(46, 72, 'gcash', 'Rhea', '09618589268', '11213213', 600.00),
(47, 73, 'cod', NULL, NULL, NULL, NULL),
(48, 74, 'gcash', 'Jericho Padilla', '09511688282', '12981290831290', 2300.00),
(49, 75, 'gcash', 'Kendra Andrico', '09887655', '123123', 1200.00),
(50, 76, 'gcash', 'kapaykpay', '09618589268', '97726621', 250.00),
(51, 77, 'cod', NULL, NULL, NULL, NULL),
(52, 78, 'cod', NULL, NULL, NULL, NULL),
(53, 79, 'cod', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `Price_ID` int(11) NOT NULL,
  `Price` varchar(255) DEFAULT NULL,
  `Start_Date` varchar(255) DEFAULT NULL,
  `End_Date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`Price_ID`, `Price`, `Start_Date`, `End_Date`) VALUES
(1, '700', NULL, NULL),
(2, '500', NULL, NULL),
(3, '450', NULL, NULL),
(4, '80', NULL, NULL),
(5, '70', NULL, NULL),
(6, '250', NULL, NULL),
(7, '199', NULL, NULL),
(8, '800', NULL, NULL),
(9, '550', NULL, NULL),
(10, '380', NULL, NULL),
(11, '9202', NULL, NULL),
(12, '109', NULL, NULL),
(13, '160', NULL, NULL),
(14, '1627', NULL, NULL),
(15, '47', NULL, NULL),
(16, '1100', NULL, NULL),
(17, '1000', NULL, NULL),
(18, '999999', NULL, NULL),
(19, '90000', NULL, NULL),
(20, '122', NULL, NULL),
(21, '99999', NULL, NULL),
(22, '9000', NULL, NULL),
(23, '0', NULL, NULL),
(24, '1110', NULL, NULL),
(25, '110', NULL, NULL),
(26, '5000', NULL, NULL),
(27, '12', NULL, NULL),
(28, '100', NULL, NULL),
(29, '60', NULL, NULL),
(30, '50', NULL, NULL),
(31, '750', NULL, NULL),
(32, '755', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(11) NOT NULL,
  `Customer_Review` varchar(255) DEFAULT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Set_Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_ID`, `Customer_Review`, `Customer_ID`, `Set_Name`) VALUES
(17, 'I LOVE IT', 16, 'SET F'),
(19, 'Satisfied Customer here!', 16, 'SET E'),
(20, 'Ang ganda po, legit seller!', 16, 'SET E'),
(21, 'Sir sana flat 1, pa pizza naman hehehe!!!!', 16, 'SET E'),
(22, 'i really like it to the highest level go go go !!', 16, 'lime'),
(23, 'I LIKE IT SO MUCH', 16, 'SET B'),
(24, 'WOW GANDA', 19, 'SET B'),
(25, 'nice', 19, 'SET A');

-- --------------------------------------------------------

--
-- Table structure for table `set`
--

CREATE TABLE `set` (
  `Set_ID` int(11) NOT NULL,
  `Set_Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Variation` varchar(255) DEFAULT NULL,
  `Cost` varchar(255) DEFAULT NULL,
  `Price_ID` int(11) DEFAULT NULL,
  `set_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set`
--

INSERT INTO `set` (`Set_ID`, `Set_Name`, `Description`, `Variation`, `Cost`, `Price_ID`, `set_img`) VALUES
(1, 'SET A', '5 satin rose\r\n2 toblerone big\r\n5 dairy milk\r\n2 kisses\r\n', 'COLOR', '775', 16, 'SetA.png'),
(2, 'SET B', '3 satin rose\r\n5 cloud 9\r\n5 goya', '', '295', 2, 'SetB.png'),
(3, 'SET C', '3 dairy milk\r\n2 goya \r\n3 satin rose', '', '275', 3, 'SetC.png'),
(4, 'SET D', '3 mini choco mucho\r\n1 satin rose', '', '54', 4, 'SetD.png'),
(5, 'SET E', '1 single rose', '', '45', 5, 'SetE.png'),
(6, 'SET F', '3 choco mucho\r\n3 cloud 9\r\n3 satin rose', '', '180', 6, 'SetF.png'),
(7, 'SET G', '3 satin rose', '', '120', 7, 'SetG.png'),
(8, 'SET H', '8 goya\r\n6 take it\r\n5 satin rose\r\nwith fairy lights', '', '535', 8, 'SetH.png'),
(9, 'SET I', '10 satin rose', '', '345', 9, 'SetI.png');

-- --------------------------------------------------------

--
-- Table structure for table `sets_raw_materials`
--

CREATE TABLE `sets_raw_materials` (
  `sets_raw_materials_ID` int(11) NOT NULL,
  `cost_raw_materials_ID` int(11) DEFAULT NULL,
  `Qty` varchar(255) DEFAULT NULL,
  `Set_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sets_raw_materials`
--

INSERT INTO `sets_raw_materials` (`sets_raw_materials_ID`, `cost_raw_materials_ID`, `Qty`, `Set_ID`) VALUES
(58, 1, '5', 1),
(59, 2, '2', 1),
(60, 6, '2', 1),
(61, 7, '5', 1),
(62, 8, '2', 1),
(63, 1, '3', 2),
(64, 2, '2', 2),
(65, 3, '5', 2),
(66, 9, '5', 2),
(67, 1, '3', 3),
(68, 2, '2', 3),
(69, 7, '3', 3),
(70, 9, '2', 3),
(71, 1, '1', 4),
(72, 2, '1', 4),
(73, 10, '3', 4),
(74, 1, '1', 5),
(75, 2, '1', 5),
(76, 1, '3', 6),
(77, 2, '2', 6),
(78, 3, '3', 6),
(79, 5, '3', 6),
(80, 1, '3', 7),
(81, 2, '2', 7),
(82, 1, '5', 8),
(83, 2, '3', 8),
(84, 4, '6', 8),
(85, 9, '8', 8),
(86, 11, '1', 8),
(87, 1, '10', 9),
(88, 2, '3', 9);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `Shipping_ID` int(11) NOT NULL,
  `Tracking_Number` varchar(255) DEFAULT NULL,
  `Order_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`Shipping_ID`, `Tracking_Number`, `Order_ID`) VALUES
(13, NULL, NULL),
(14, '1111', 39),
(15, '100299181', 38),
(16, '122222', 36),
(17, '8888998', 34),
(18, '09521', 37),
(19, '25644', 35),
(20, '100', 40),
(21, '1111111', 41),
(22, '12121412', 43),
(23, '121', 46),
(24, NULL, 45),
(25, '1235545', 47),
(26, '456122', 48),
(27, '78', 49),
(28, NULL, 50),
(29, NULL, 51),
(30, 'hfjhfdshfiuhqiuwd', 52),
(31, NULL, 53),
(32, '1111111', 54),
(33, '696969', 55),
(34, NULL, 56),
(35, NULL, 44),
(36, NULL, 57),
(37, NULL, 58),
(38, NULL, 59),
(39, '564842124', 60),
(40, NULL, 61),
(41, NULL, 62),
(42, NULL, 42),
(43, '121293', 63),
(44, 'hffhjddfs', 65),
(45, NULL, 68),
(46, 'ajfhadjfhdakjf', 72),
(47, NULL, 73),
(48, '1111111', 74),
(49, '243442', 75),
(50, NULL, 76),
(51, NULL, 78),
(52, NULL, 77),
(53, NULL, 79);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Full_name` varchar(255) DEFAULT NULL,
  `Age` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL,
  `House_Number` varchar(255) DEFAULT NULL,
  `Zone` varchar(255) DEFAULT NULL,
  `Barangay` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `Region` varchar(255) DEFAULT NULL,
  `Zip_Code` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Username` int(50) DEFAULT NULL,
  `Password` int(50) DEFAULT NULL,
  `user_status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Full_name`, `Age`, `Gender`, `Phone_Number`, `House_Number`, `Zone`, `Barangay`, `City`, `Province`, `Region`, `Zip_Code`, `Email`, `Username`, `Password`, `user_status`, `user_type`) VALUES
(1, 'Drei', '12', 'M', '0911111111', '12', '9', 'Ponso', 'Polangui', 'Albay', '5', '4506', 'drei@gmail.com', 0, 1234, 'A', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost_raw_materials`
--
ALTER TABLE `cost_raw_materials`
  ADD PRIMARY KEY (`cost_raw_materials_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`Price_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `Customer_ID2` (`Customer_ID`);

--
-- Indexes for table `set`
--
ALTER TABLE `set`
  ADD PRIMARY KEY (`Set_ID`),
  ADD KEY `Price_ID` (`Price_ID`);

--
-- Indexes for table `sets_raw_materials`
--
ALTER TABLE `sets_raw_materials`
  ADD PRIMARY KEY (`sets_raw_materials_ID`),
  ADD KEY `Set_ID2` (`Set_ID`),
  ADD KEY `cost_raw_materials_ID` (`cost_raw_materials_ID`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`Shipping_ID`),
  ADD KEY `Order_ID3` (`Order_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cost_raw_materials`
--
ALTER TABLE `cost_raw_materials`
  MODIFY `cost_raw_materials_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `Price_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `set`
--
ALTER TABLE `set`
  MODIFY `Set_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sets_raw_materials`
--
ALTER TABLE `sets_raw_materials`
  MODIFY `sets_raw_materials_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `Shipping_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Customer_ID` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `Customer_ID2` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`);

--
-- Constraints for table `set`
--
ALTER TABLE `set`
  ADD CONSTRAINT `set_ibfk_1` FOREIGN KEY (`Price_ID`) REFERENCES `price` (`Price_ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `sets_raw_materials`
--
ALTER TABLE `sets_raw_materials`
  ADD CONSTRAINT `Set_ID2` FOREIGN KEY (`Set_ID`) REFERENCES `set` (`Set_ID`),
  ADD CONSTRAINT `cost_raw_materials_ID` FOREIGN KEY (`cost_raw_materials_ID`) REFERENCES `cost_raw_materials` (`cost_raw_materials_ID`);

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `Order_ID3` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

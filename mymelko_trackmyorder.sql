-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2021 at 07:54 PM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymelko_trackmyorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `fldCategoryID` int(11) NOT NULL,
  `fldCategoryName` varchar(255) DEFAULT NULL,
  `fldCategoryDescription` text DEFAULT NULL,
  `fldCategoryCreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`fldCategoryID`, `fldCategoryName`, `fldCategoryDescription`, `fldCategoryCreatedAt`) VALUES
(7, 'Detector', 'Gold & Metal Detector', '2020-12-21 01:50:04'),
(8, 'Security', 'Security Device', '2020-12-21 02:26:31'),
(9, 'Boats', 'Boats', '2020-12-21 02:26:51'),
(10, 'X-ray', 'All X-ray products', '2020-12-21 03:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `fldcustomerid` int(11) NOT NULL,
  `fldcustomerfirstname` text DEFAULT NULL,
  `fldcustomermiddlename` text DEFAULT NULL,
  `fldcustomerlastname` text DEFAULT NULL,
  `fldcustomerdateadded` timestamp NULL DEFAULT current_timestamp(),
  `fldcustomeraddress` text DEFAULT NULL,
  `fldcustomeremail` text DEFAULT NULL,
  `fldcustomeragentid` int(11) DEFAULT NULL,
  `fldcustomerstatus` int(11) DEFAULT 1,
  `fldcustomercontactnumber` text DEFAULT NULL,
  `fldcustomerachive` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`fldcustomerid`, `fldcustomerfirstname`, `fldcustomermiddlename`, `fldcustomerlastname`, `fldcustomerdateadded`, `fldcustomeraddress`, `fldcustomeremail`, `fldcustomeragentid`, `fldcustomerstatus`, `fldcustomercontactnumber`, `fldcustomerachive`) VALUES
(1, 'Rondine', NULL, 'Macadaeg', '2020-12-29 07:43:55', 'Cagayan Province', 'ronniemac8@gmail.com', 20, 1, '09056648460', 1),
(2, 'Geoffrey', 'B', 'Mabutas', '2020-12-29 07:44:48', 'Sibonga, Cebu', 'User@gmail.com', 20, 1, '09123456789', 1),
(6, 'test customer', 'test12', 'test', '2020-12-29 09:04:16', '23 F. Gomez St. Brgy. Kanluran', 'manggaph.paduamark@gmail.com', 20, 1, '09198828715', 2),
(7, 'Romeo', 'R', 'Insigne', '2020-12-30 01:47:08', 'Rh Gasoline Station Pob. Imelda Zamboanga Sibugay', NULL, 20, 1, '09989500119', 1),
(8, 'Janeth', NULL, 'Errua', '2021-01-05 01:23:51', 'Mabini St. Magugpo South Tagum City', 'errua.janeth78@gmail.com', 20, 1, '09129547662', 2),
(9, 'Ernesto', NULL, 'Tugade', '2021-01-11 07:06:55', 'Pangasinan', NULL, 20, 1, '09166430650', 1),
(10, 'Janeth', NULL, 'Errua', '2021-01-13 08:23:52', 'Tagum City', 'errua.janeth78@gmail.com', 20, 1, '09129547662', 1),
(11, 'Darious', NULL, 'Santos', '2021-02-03 03:08:08', 'Cavite', 'gernyboyito@gmail.com', 20, 1, '09959007256', 1),
(12, 'Zayd', NULL, 'Fernandez', '2021-02-05 05:00:14', 'Zamboanga', 'hakigaming3@gmail.com', 20, 1, '09106136730', 1),
(13, 'CATHERINE', NULL, 'TADIAMAN', '2021-02-20 07:22:33', 'PARANAQUE CITY', 'cathy.udmc@gmail.com', 20, 1, '0998-586-9498', 1),
(14, 'BOGZ', NULL, 'DELA CRUZ', '2021-02-22 04:24:34', 'MANILA', NULL, 23, 1, '0917-578-0203', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `fldOrderID` int(11) NOT NULL,
  `fldOrderNumber` varchar(255) DEFAULT NULL,
  `fldOrderQuantity` text DEFAULT NULL,
  `fldOrderDateReceived` text DEFAULT NULL,
  `fldOrderCustomerID` int(11) NOT NULL,
  `fldOrderProductID` text DEFAULT NULL,
  `fldOrderAgentID` int(11) NOT NULL,
  `fldOrderTrackNumber` varchar(255) DEFAULT NULL,
  `fldOrderCreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `fldOrderStatus` int(11) DEFAULT NULL,
  `fldOrderCustomPrice` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`fldOrderID`, `fldOrderNumber`, `fldOrderQuantity`, `fldOrderDateReceived`, `fldOrderCustomerID`, `fldOrderProductID`, `fldOrderAgentID`, `fldOrderTrackNumber`, `fldOrderCreatedAt`, `fldOrderStatus`, `fldOrderCustomPrice`) VALUES
(28, '#ORN00000028', 'a:1:{i:0;s:1:\"1\";}', NULL, 1, 'a:1:{i:0;s:2:\"49\";}', 20, 'TRN-1AEHQ6JYJ', '2020-12-21 01:57:14', 1, NULL),
(29, '#ORN00000029', 'a:1:{i:0;s:1:\"1\";}', NULL, 2, 'a:1:{i:0;s:2:\"82\";}', 20, 'TRN-FFVGIA956', '2020-12-22 07:28:06', 1, 'a:1:{i:0;s:6:\"200000\";}'),
(30, '#ORN00000030', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;N;}', 7, 'a:1:{i:0;s:2:\"52\";}', 20, 'TRN-F9YB0I67V', '2020-12-30 01:49:40', 1, 'a:1:{i:0;s:6:\"320000\";}'),
(31, '#ORN00000031', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;N;}', 8, 'a:1:{i:0;s:2:\"49\";}', 20, 'TRN-VNNVUYH0R', '2021-01-05 01:25:16', 1, 'a:1:{i:0;s:6:\"480000\";}'),
(32, '#ORN00000032', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;N;}', 9, 'a:1:{i:0;s:2:\"49\";}', 20, 'TRN-0XY4CDWIQ', '2021-01-11 07:08:36', 1, 'a:1:{i:0;s:6:\"570000\";}'),
(37, '#ORN00000033', 'a:2:{i:0;s:1:\"2\";i:1;s:1:\"1\";}', 'a:2:{i:0;s:10:\"2021-02-06\";i:1;N;}', 6, 'a:2:{i:0;s:2:\"50\";i:1;s:2:\"49\";}', 17, 'TRN-T9VGQGM9U', '2021-01-30 09:14:20', 1, 'a:2:{i:0;N;i:1;s:6:\"550000\";}'),
(38, '#ORN00000038', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;s:10:\"2021-01-15\";}', 11, 'a:1:{i:0;s:2:\"49\";}', 20, 'TRN-HD2HA7KKH', '2021-02-03 03:11:50', 1, 'a:1:{i:0;s:6:\"530000\";}'),
(39, '#ORN00000039', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;s:10:\"2021-01-02\";}', 12, 'a:1:{i:0;s:2:\"83\";}', 20, 'TRN-RTBTMUW7H', '2021-02-05 05:07:44', 1, 'a:1:{i:0;s:6:\"187500\";}'),
(40, '#ORN00000040', 'a:1:{i:0;s:1:\"1\";}', 'a:1:{i:0;s:10:\"2021-01-02\";}', 12, 'a:1:{i:0;s:2:\"83\";}', 20, 'TRN-BRZQA0X96', '2021-02-05 05:08:09', 1, 'a:1:{i:0;s:6:\"187500\";}');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `fldProductID` int(11) NOT NULL,
  `fldProductName` varchar(255) DEFAULT NULL,
  `fldProductDescription` text DEFAULT NULL,
  `fldProductPrice` decimal(11,2) DEFAULT NULL,
  `fldProductCategoryID` int(11) DEFAULT NULL,
  `fldProductImage` text DEFAULT NULL,
  `fldProductCreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`fldProductID`, `fldProductName`, `fldProductDescription`, `fldProductPrice`, `fldProductCategoryID`, `fldProductImage`, `fldProductCreatedAt`) VALUES
(49, 'Deep Seeker', 'Deep Seeker Metal and Gold Detector:\r\n\r\nThe latest product by GER DETECT the great German metal detectors manufacturer\r\n\r\nDeep seeker has Five different search systems gathered on a single device that can set targets up to 40 meters underground depth and 3000 meters Surface Search range\r\n\r\nDeep seeker is the first device of its kind which is designed with five integrated search systems to detect natural treasures in the ground such as gold treasures and antiquities and precious metals.', 600000.00, 7, 'Deep Seeker_49_1608516356626.6png', '2020-12-21 01:51:40'),
(50, 'Titan Ger 1000', 'Long range detection system\r\nIonic fields detection search system\r\n3D imaging detection search system\r\nMagnetometer detection search system\r\nPulse induction detection search system\r\nThe front range of the device is 2500-meter square and the depth is 45', 900000.00, 7, 'Titan Ger 1000_50_1608518057854.5png', '2020-12-21 02:34:17'),
(51, 'Easy Way Device', 'easy way underground metal and cavity scanner.\r\nSpecialized in prospecting and searching for burials, caves and cavities in the ground with all confidentiality and ease.\r\neasy way metal scanner for treasure hunting.\r\nThe device is completely digital with modern technology and unique in the world.\r\n3D GER analyzer is available in several languages: English, German, Arabic, Turkish, Russian, and French.\r\nThe depth of search in the Easy way plus can reach 18 meters deep with the possibility of determining the depth by meters and centimeters in the ground.\r\nEASY WAY device 3D Imaging system.\r\nEasy Way Plus is one of the best German innovations.\r\nThe device is small in size, light weight and easy to use.\r\nThis device is designed to be used in all countries and regions', 325000.00, 7, 'Easy Way Device_51_1608519249066.8jpg', '2020-12-21 02:54:09'),
(52, 'Easy Way Smart Dual System', 'Specialized in underground detection of gold, treasures, ancient antiquities, voids, caves, and tombs.\r\nThe unique technology in its kind that gathers two systems in one device, in addition the device is completely concealable.\r\nThe front range of the device is 2000-meter square and the depth is 18 meters underground.', 400000.00, 7, 'Easy Way Smart Dual System_52_1608519412680.7png', '2020-12-21 02:56:52'),
(53, 'Gold Hunter Long Locator', 'GOLD HUNTER DEVICE Long Range system specialized in underground detection of gold, silver, diamond, gemstones, and voids.\r\nEase of use, accuracy of performance, and lightness in weight.\r\nThe front range of the device is 2,000-meter square and the depth is 35 meters underground.', 180000.00, 7, 'Gold Hunter Long Locator_53_1608519508780.1jpg', '2020-12-21 02:58:28'),
(54, 'Gold Seeker Device', 'GOLD SEEKER DEVICEPulse Induction System\r\nThe fastest, easiest for using, most modern and accurate system to detect gold, and the coins under the ground.\r\nGold Seeker device works by two systems to determine between the precious and non-precious metals.\r\nReaches up to 3.5 meters deep in the ground.\r\nGold seeker has the ability to penetrate ground layers to great depths that are difficult for many other devices to reach.', 180000.00, 7, 'Gold Seeker Device_54_1608519635897.3jpg', '2020-12-21 03:00:35'),
(55, 'Pinponter', 'Uig pointer with a high capacity to distinguish between precious and non-precious metals underground', 20000.00, 7, 'Pinponter_55_1608519716852.8jpg', '2020-12-21 03:01:56'),
(56, 'Diamond Hunter Device', 'DIAMOND HUNTER DEVICELong Range system specialized in underground detection of diamond and gemstones.\r\nEase of use, accuracy of performance, and lightness in weight.\r\nThe front range of the device is 2,000-meter square and the depth is 35 meters underground', 187937.00, 7, 'Diamond Hunter Device_56_1608519783904.3png', '2020-12-21 03:03:03'),
(57, 'Gold AKS LR-TR( 2018)', 'Search System: microcomputer CPU control and reflection conductivity and P6FE1M algorithm smart development.\r\nSearch Range: up to 5000M\r\nDetecting Depth: up to 70M\r\nEnergy: 12V 1600mAh\r\nLaunch Frequency: 5.6-6KHz\r\nSignal Frequency: 360-440Hz\r\nPackage Weight: 3 Kilogram\r\nDetection Type: gold, silver, copper, precious stones.\r\nShell Material: Aluminium', 187500.00, 7, 'Gold AKS LR-TR( 2018)_57_1608519859073.1png', '2020-12-21 03:04:19'),
(58, 'Gold AKS LR-TR PRO', 'Search System: microcomputer CPU control and reflection conductivity and P6FE1M algorithm smart development.\r\nSearch Range: up to 5000M\r\nDetecting Depth: up to 75M\r\nEnergy: 12V 1600mAh\r\nLaunch Frequency: 5.6-6KHz\r\nSignal Frequency: 360-440Hz\r\nPackage Weight: 3 Kilogram\r\nDetection Type: gold, silver, copper, precious stones.\r\nShell Material: Aluminium', 202500.00, 7, 'Gold AKS LR-TR PRO_58_1608519937561.4jpg', '2020-12-21 03:05:37'),
(59, 'Gold AKS LR-TR Multi', 'Search System: New High Tech Bionic Computer MainChip.\r\nconductivity and P6FE1Z algorithm smart development.\r\nSearch Range: up to 5000M\r\nDetecting Depth: up to 75M\r\nEnergy: 12V 1600mAh\r\nLaunch Frequency: 5.6-6KHz\r\nSignal Frequency: 360-440Hz\r\nPackage Weight: 3.5 Kilogram\r\nDetection Type: Special for gold, silver & rm.', 225000.00, 7, 'Gold AKS LR-TR Multi_59_1608520001028.4jpg', '2020-12-21 03:06:41'),
(60, 'AKS Aqua', 'Adapter Model: KDL-121000\r\nAdapter Input: 100-240V\r\n50-60Hz 0.3A\r\nAdapter Output: 12V 1A\r\nWorking Temperature: 0°-40°\r\nCase Material: ip67 plastic waterproof military type\r\nCharging Methods:\r\nThis device has installed rechargeable batteries, charging\r\ntime 4 hours.\r\n\r\nSearch System: New High Tech Bionic Computer MainChip.\r\nconductivity and P6FE1Z algorithm smart development.\r\nSearch Range: up to 5000M\r\nDetecting Depth: up to 1300M\r\nEnergy: 12V 1600mAh\r\nLaunch Frequency: 5.6-6KHz\r\nSignal Frequency: 360-440Hz\r\nPackage Weight: 3.5 Kilogram\r\nDetection Type: natural water, artesian water, water wells and more.\r\nShell Material: Aluminium\r\nCase Size: Approx.40x30x15 CM', 202500.00, 7, 'AKS Aqua_60_1608520072134.7png', '2020-12-21 03:07:52'),
(61, 'AKS Diamond Finder', 'AKS DIAMOND FINDER\r\nProfessional ID of precious gemstones and of course diamonds. It is a device with the ability to transmit and receive special waves at very specific frequencies for the identification and positioning of raw gems including diamonds, sapphire and emerald.\r\nHere you can read in detail about this device including its features and all professional data. We are reminded once again to beware of imitations – there are a lot of imitations of AKS devices all over the world. You must purchase an original AKS device with a compatible serial number.\r\nAll Packages Includes:\r\nMain Unit\r\nControl Unit\r\nWall Charger\r\n6 Antennas\r\nUser Manual\r\nMilitary Case\r\nCar Charger\r\nAnti Fraud Check\r\nDepth Measurement Button', 202500.00, 7, 'AKS Diamond Finder_61_1608520186558.6jpg', '2020-12-21 03:09:46'),
(62, 'PD5030A X-ray Scanner', 'Tunnel Size: 500（W）×300（H）mm\r\nConveyor Max Load: 60 kg\r\nSingle inspection dosage < 1.5µGy\r\nWire Resolution: 0.1mm metal line\r\nSteel Penetration: 34MM armor plate\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <<0.05 μGy/h (at a distance of 5cm From external housing)\r\nOrientation: Vertically Upward\r\nTube Current: 0.4~0.5MA（adjustable）\r\nAnode Voltage: 80 KV\r\nAngle: 80°\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.0 KW (Max)\r\nNoise： <65DB\r\n1PCS/CARTON/ 1.63cbm\r\nCARTON SIZE: 171CM*78CM*122CM\r\nWeight/carton: 400kgs', 1264000.00, 10, 'PD5030A X-ray Scanner_62_1608520370148.4PNG', '2020-12-21 03:12:50'),
(63, 'PD5030C X-ray Machine', 'Tunnel Size: 500（W）×300（H）mm\r\nConveyor Max Load: 150 kg Conveyor Speed: 0.22m/s\r\nSingle inspection dosage <1.4μGy/h Penetrate resolution: Dia 0.511mm\r\nWire Resolution: <0.101mm Metal Wire Spatial resolution: Level: dia1.0mm, Vertical: dia1.3mm\r\nSteel Penetration: 32MM armor plate Dose per Inspection: <2.9 uGy/h\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <0.05 μGy/h (at a distance of 5cm From external housing)\r\nOutput Additional Conveyor：80cm (L)\r\nOrientation: Vertically Upward Through resolution:φ0.202mm\r\nTube Current: 0.4~0.5MA（adjustable）\r\nAnode Voltage: 80 KV Anode power: 0.4 to 0.5mA\r\nAngle: 80° Image Max Resolution: 1024 * 1280pixel\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.0 KW (Max)\r\nNoise： <65DB\r\n1PCS/CARTON/ 1.63cbm\r\nCARTON SIZE: 171CM*78CM*122CM', 1891200.00, 10, 'PD5030C X-ray Machine_63_1608520469652.4PNG', '2020-12-21 03:14:29'),
(64, 'PD6550 X-RAY MACHINE', 'Tunnel Size: 650（W）×500（H）mm\r\nConveyor Speed: 0.22 m/s\r\nConveyor Max Load: 100 kg\r\nSingle inspection dosage < 1.5µGy\r\nWire Resolution: 0.1mm metal line\r\nSteel Penetration: 36MM armor plate\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <0.3µGY/H\r\nOrientation: Vertically Upward\r\nTube Current: 0.4~1.2MA（adjustable）\r\nAnode Voltage: 100-160 KV(adjustable）\r\nAngle: 80°\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.0 KW (Max)\r\nNoise： <65DB\r\n1PCS/CARTON/ 2.51cbm\r\nCARTON SIZE: 203CM*95CM*130CM\r\nWeight/carton: 500kgs', 1840000.00, 10, 'PD6550 X-RAY MACHINE_64_1608520570332PNG', '2020-12-21 03:16:10'),
(65, 'PD8065 X-ray Machine', 'Tunnel Size: 800（W）× 650（H）mm\r\nConveyor Speed: 0.22 m/s\r\nConveyor Max Load: 150 kg\r\nSingle inspection dosage < 1.5µGy\r\nWire Resolution: 0.1mm metal line\r\nSteel Penetration: 36MM armor plate\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <0.3µGY/H\r\nOrientation: Vertically Upward\r\nTube Current: 0.4~1.2MA（adjustable）\r\nAnode Voltage: 100-160 KV(adjustable）\r\nAngle: 80°\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.2 KW (Max)\r\nNoise： <65DB\r\n1PCS/BOX/ 4.28cbm\r\nBOX SIZE: 240CM*115CM*155CM\r\nWeight/carton: 780kgs', 2752000.00, 10, 'PD8065 X-ray Machine_65_1608520805013.9PNG', '2020-12-21 03:20:05'),
(66, 'PD10080 X-ray Machine', 'Tunnel Size: 1000（W）× 800（H）mm\r\nConveyor Speed: 0.22 m/s\r\nConveyor Max Load: 200 kg\r\nSingle inspection dosage < 1.5µGy\r\nWire Resolution: 0.1mm metal line\r\nSteel Penetration: 38MM armor plate\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <0.3µGY/H\r\nOrientation: Vertically Upward\r\nTube Current: 0.4~1.2MA（adjustable）\r\nAnode Voltage: 100-160 KV(adjustable）\r\nAngle: 80°\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.5 KW (Max)\r\nNoise： <65DB\r\n1PCS/BOX/ 7.80cbm\r\nBOX SIZE: 340CM*135CM*170CM\r\nWeight/carton: 970kgs', 3016000.00, 10, 'PD10080 X-ray Machine_66_1608521299979.3PNG', '2020-12-21 03:28:19'),
(67, 'PD100100 X-ray Machine', 'Tunnel Size: 1000（W）× 1000（H）mm\r\nConveyor Speed: 0.22 m/s\r\nConveyor Max Load: 200 kg\r\nSingle inspection dosage < 1.5µGy\r\nWire Resolution: 0.1mm metal line\r\nSteel Penetration: 38MM armor plate\r\nFilm Safety: For ISO 1600\r\nMaximum leakage radiation <0.3µGY/H\r\nOrientation: Vertically Upward\r\nTube Current: 0.4~1.2MA（adjustable）\r\nAnode Voltage: 100-160 KV(adjustable）\r\nAngle: 80°\r\nGenerator cooling/working periods Sealed oil bath with forced air/100％\r\nStorage Temperature: -20ºC to 60ºC\r\nOperating Temperature: 0ºC to 45ºC\r\nRelative Humidity: 20 to 95% non-condensing\r\nSystem Power: 220 VAC (±10%) 50±3HZ\r\nPower wastage：1.5 KW (Max)\r\nNoise： <65DB\r\n1PCS/BOX/ 9.72cbm\r\nBOX SIZE: 360CM*135CM*200CM\r\nWeight/carton: 1100kgs', 3600000.00, 10, 'PD100100 X-ray Machine_67_1608521943484.8PNG', '2020-12-21 03:39:03'),
(68, 'PD-100B- Economy Model (UN-waterproof)', '*1 zones pinpoint detection\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Self calibration once power on\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and Alarm', 41600.00, 8, 'PD-100B- Economy Model (UN-waterproof)_68_1608522049053.7PNG', '2020-12-21 03:40:49'),
(69, 'PD-1000- Economy Model- (UN Waterproof)', '*6 zones pinpoint detection\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Self calibration once power on\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and Alarm', 51200.00, 8, 'PD-1000- Economy Model- (UN Waterproof)_69_1608522122238.9PNG', '2020-12-21 03:42:02'),
(70, 'PD-2000 -Economy Model', '*6 zones pinpoint detection\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Self calibration once power on\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 65600.00, 8, 'PD-2000 -Economy Model_70_1608522185503.3PNG', '2020-12-21 03:43:05'),
(71, 'PD-3000- Economy Model-(Waterproof)', '*6 zones pinpoint detection\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Self calibration once power on\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 73600.00, 8, 'PD-3000- Economy Model-(Waterproof)_71_1608522269968.4PNG', '2020-12-21 03:44:29'),
(72, 'PD-5000A-Pinpoint Model', '*6  zones pinpoint detection    7inch LCD Screen\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Pinpoint Zone Detection: 6 zones shows precise target locations on the left, center and right side of the body from head to toe.\r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Long standby\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 78400.00, 8, 'PD-5000A-Pinpoint Model_72_1608522363875.8PNG', '2020-12-21 03:46:03'),
(73, 'PD-5000C-Pinpoint Model', '*18 zones pinpoint detection with 6inch LCD screen\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Pinpoint Zone Detection: 33 zones shows precise target locations on the left, center and right side of the body from head to toe.\r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Long standby\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 83200.00, 8, 'PD-5000C-Pinpoint Model_73_1608522505718.9PNG', '2020-12-21 03:48:25'),
(74, 'PD-6500I- Brand Garrett', '*33 zones pinpoint detection (GARRETT)   （with 9 kinds Language)\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2030(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Pinpoint Zone Detection: 33 zones shows precise target locations on the left, center and right side of the body from head to toe.\r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*IP65 waterproof PVC meterial Long standby\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 192000.00, 8, 'PD-6500I- Brand Garrett_74_1608522646374.6PNG', '2020-12-21 03:50:46'),
(75, 'EN-6S - Brand Rapiscan Model', '6 zones pinpoint detection (PINPOINT)  Rapiscan Metro 6S\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Pinpoint Zone Detection: 6 zones shows precise target locations on the left, center and right side of the body from head to toe.\r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*IP65 waterproof PVC meterial Long standby\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 216000.00, 8, 'EN-6S - Brand Rapiscan Model_75_1608522700608.4PNG', '2020-12-21 03:51:40'),
(76, 'PD-888-Pinpoint', '*6 zone Portable walkthrough metal detector (PINPOINT)\r\n*Outer frame : 2200(h) *800(w) *600mm(d)\r\n*Inner frame :  2050(h) *700(w) *600mm(d) \r\n*Working power: AC:110V-220V\r\n*Work envionment : -20℃— +65℃  \r\n*Pinpoint Zone Detection: 6 zones\r\n*Sensitivity from 0-99, total 100 levels.\r\n*Led display on the both sides\r\n*DSP and Microprocessor controlled\r\n*Long standby\r\n*One-key restoration of factory setting\r\n*One set gate should be packed in two cartons:Door panel Carton size:229*73*25CM & Base Unit Carton size: 75*30*27CM\r\n*Total gross weight of one set: 80kgs\r\n*Warranty :Limited 12 months, parts and labor\r\n*Sound and LED alarm', 448000.00, 8, 'PD-888-Pinpoint_76_1608522861279.4PNG', '2020-12-21 03:54:21'),
(77, 'Treasure Light', 'This is smallest and most portable 3D gold and metal detector on the market available, still offering all great features of its biggest brothers. It is undercovered and looks just like a flashlight, beside that it can be also used as flashlight and is very easy to use. Ready to discover precious metals like gold, silver and ancient bronze objects as well chests, boxes, hidden rooms, graves and tunnels.\r\nBasic 3D ground scan for object visualization\r\n- 2D/3D view mode with advanced zooming and browsing feature\r\n- Detect object up to 20m/65ft\r\n- Determine object depth\r\n- Possibility to save scan and analyze it later\r\n- Possibility to save geographic location of scan\r\n- Export data to PC for further analysis\r\n- Possibility to select different scan modes, sensitivity, volume, scan area size\r\n- Battery indication\r\n- Works with Android & iOS devices (iPhone)', 165000.00, 7, 'Treasure Light_77_1608522951236.2PNG', '2020-12-21 03:55:51'),
(78, 'Itreasure Hunter', 'Basic 3D ground scan for object visualization\r\n- 2D/3D view mode with advanced zooming and browsing feature\r\n- Detect object up to 25m/80ft\r\n- Determine object depth\r\n- Possibility to save a scan and analyze it later\r\n- Possibility to save the geographic location of a scan\r\n- Export data to PC for further analysis\r\n- Possibility to select different scan modes, sensitivity, volume, scan area size\r\n- Battery indication\r\n- Works with Android & iOS devices (iPhone)', 180000.00, 7, 'Itreasure Hunter_78_1608523005679.7PNG', '2020-12-21 03:56:45'),
(79, 'ELIC LB-2', 'elic lb-2 is a new generation proton elic series, lb-2 has 2 customized lidar and 64 pxs thermal sensors as well as 2 cesium magnetic multisensors.\r\nLb-2 has a range of 1000 meters and penetrates to a depth of 50 meters in good soil conditions and correct use.\r\nIt has 3d-4d presentation with its own customized program (metal discrimination, depth detection, distance information, and the lidar sensor that calculates the target to punctuate it, detailed analysis when requested. for (-dat-and grıd) file translation)', 350000.00, 7, 'ELIC LB-2_79_1608523093762PNG', '2020-12-21 03:58:13'),
(80, 'ELIC LB-4', 'elic lb-4 is a new generation proton elic series, lb-4 has 4 customized lidar and 64 pxs thermal sensors as well as 4 cesium magnetic multisensors.\r\n\r\nLb-4 has a range of 1000 meters and penetrates to a depth of 50 meters in good soil conditions and correct use. It has 3d-4d presentation with its own customized program (metal discrimination, depth detection, distance information, and the lidar sensor that calculates the target to punctuate it', 437500.00, 7, 'ELIC LB-4_80_1608523141996.5PNG', '2020-12-21 03:59:01'),
(81, 'ELIC LB-8', 'Thermal + Magnetic + Lidar\r\nCustomized\r\n8 Sensors\r\nThe system can either sweat or work selectively, after collecting data from all sensors, and sends the data to the computer software via Bluetooth, along with the direction information it looks at.\r\nThe Camera At The Center Of A Sphere In The Computer Environment, Looks At The Shell Of The Sphere From Inside And Paints The Inner Surface Of The Sphere In The Corresponding Color According To The Received Sensor Information.\r\nSuperior Positioning\r\nIt Can Detect Gaps or Metals in Detection of Tunnel-Room-Warehouse-Style Formations and Buried Metals (Reinforced Concrete-Horasan-Rock-Soil)', 700000.00, 7, 'ELIC LB-8_81_1608523197718.4PNG', '2020-12-21 03:59:57'),
(82, 'Golden Eye Plus', 'GoldenEye Plus provides a new visualization of Professional 3D ground scans. Whit its 160x higher scan resolution and level 5 sensitivity, is the best gold and metal detector among previous models. GoldenEye Plus is capable of providing Most Accurate performance of 3D ground scan on Larger areas. With the latest Augmented Reality technology, is capable of providing an amazing Treasure hunting Experience, like you never seen before. \r\n\r\nIt is small and portable, integrated into carbon hiking stick that is extendable and very easy to use. Ready to discover precious metals like gold, silver and ancient bronze objects as well as chests, boxes, hidden rooms, graves, and tunnels.', 220000.00, 7, 'Golden Eye Plus_82_1608619086118.1jpg', '2020-12-22 06:38:06'),
(83, 'AKS GoldAKS LR-TR Locator Gold Detector USA', 'Search System: microcomputer CPU control and reflection conductivity and P6FE1M algorithm\r\nsmart development.\r\nSearch Range: up to 5000M✔\r\nDetecting Depth: up to 70M✔\r\nEnergy: 12V 1600mAh\r\nLaunch Frequency: 5.6-6KHz\r\nSignal Frequency: 360-440Hz\r\nPackage Weight: 3 Kilogram\r\nDetection Type: gold, silver, copper, precious stones.\r\nShell Material: Aluminium\r\n\r\nThe Real GOLD AKS LR-TR is the first-star device from AKS GROUP. This detector was\r\nlaunched to the public at the end of 2017. It is a device that many companies around the\r\nworld try to imitate and counterfeit without success. Please note that we have a system to\r\ntest the authenticity of the device on manufacturer website.\r\nLONG RANGE DETECTION - Experience the power of geolocator technology that\r\nfunctions as a deep seeking detector plus long-range target locator. Distinguish between\r\nvaluable & non-valuable metals.\r\n\r\nTREASURE FINDER - The ultimate in gold and silver hunting capability! This detector is\r\nbuilt to accurately locate everything from gold, silver, coins & jewelry to older relics and\r\nlarger treasures.\r\n4 SEARCH SYSTEMS - You can choose your search system: gold, copper, silver, and\r\ndiamond.\r\nSuperior deep seeking technology lets you become your own archaeologist and treasure\r\nhunter!\r\n Microcomputer CPU control and reflection conductivity and P6FE1M smart\r\ndevelopment algorithm.\r\n GOLD AKS LR-TR can reach a distance up to 5000 meters.\r\n This Deep Seeking Detector will locate metals and targets up to 70 meters depth to\r\nfind great treasures that have been buried for many years.\r\n This device is characterized by the speed of response to the targets above other\r\ndevices operating on the same system.\r\n Fine Tuning and easy to use.\r\nThe Real Gold AKS LR TR package include:\r\n Main unit.\r\n Control unit.\r\n Wall charger.\r\n 6 antennas.\r\n User manual.\r\n Unique Serial Number.\r\n Military Style Protective Case.', 187500.00, 7, 'AKS GoldAKS LR-TR Locator Gold Detector USA_83_1612501574286.4PNG', '2021-02-05 05:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `fldroleid` int(11) NOT NULL,
  `fldrolename` text NOT NULL,
  `fldroleaccess` text NOT NULL,
  `fldroledateadded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`fldroleid`, `fldrolename`, `fldroleaccess`, `fldroledateadded`) VALUES
(1, 'Administrator', 'a:7:{i:0;s:7:\"product\";i:1;s:18:\"product_categories\";i:2;s:4:\"user\";i:3;s:14:\"customer_order\";i:4;s:5:\"order\";i:5;s:8:\"customer\";i:6;s:5:\"roles\";}', '2020-12-20 05:28:32'),
(2, 'Agent', 'a:5:{i:0;s:7:\"product\";i:1;s:18:\"product_categories\";i:2;s:4:\"user\";i:3;s:14:\"customer_order\";i:4;s:5:\"order\";}', '2020-12-20 06:30:58'),
(3, 'Customer', 'a:0:{}', '2020-12-20 08:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbltrackstatus`
--

CREATE TABLE `tbltrackstatus` (
  `fldTrackStatusID` int(11) NOT NULL,
  `fldTrackStatusDate` varchar(255) DEFAULT NULL,
  `fldTrackStatusPlace` text DEFAULT NULL,
  `fldTrackStatusMessage` text DEFAULT NULL,
  `fldTrackStatusOrderID` int(11) DEFAULT NULL,
  `fldTrackStatusCreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltrackstatus`
--

INSERT INTO `tbltrackstatus` (`fldTrackStatusID`, `fldTrackStatusDate`, `fldTrackStatusPlace`, `fldTrackStatusMessage`, `fldTrackStatusOrderID`, `fldTrackStatusCreatedAt`) VALUES
(18, '2020-12-31', 'test place', 'for testing', 27, '2020-12-20 09:03:46'),
(19, '2020-12-31', 'test place', 'test', 27, '2020-12-20 09:04:37'),
(21, '2020-12-10', 'Turkey', 'Confirmation payment from the manufacturer', 28, '2020-12-21 02:01:50'),
(22, '2020-12-17', 'Turkey', 'Label Created', 28, '2020-12-21 02:02:52'),
(23, '2020-12-22', 'Payment', 'Payment Confirm by the company', 29, '2020-12-22 07:29:26'),
(24, '2020-12-10', 'Turkey', 'Confirmation Payment from the manufacturer', 30, '2020-12-30 02:03:57'),
(25, '2020-12-18', 'Turkey', 'Label Created', 30, '2020-12-30 02:05:00'),
(27, '2020-12-16', 'Turkey', 'Confirmation payment from the manufacturer', 31, '2021-01-05 01:28:20'),
(29, '2020-12-29', 'Turkey', 'Label created', 31, '2021-01-05 01:29:29'),
(30, '2021-01-05', 'Turkey', 'Forwarded to Quality Check', 31, '2021-01-05 01:33:29'),
(31, '2021-01-05', 'Turkey', 'Forwarded to Quality Check', 30, '2021-01-11 06:58:54'),
(32, '2021-01-05', 'Turkey', 'Forwarded to Quality Check', 28, '2021-01-11 07:01:32'),
(33, '2020-12-30', 'Turkey', 'Label Created', 29, '2021-01-11 07:02:46'),
(34, '2021-01-05', 'Turkey', 'Forwarded to Quality Check', 29, '2021-01-11 07:04:42'),
(35, '2021-01-05', 'Turkey', 'Label Created', 32, '2021-01-11 07:09:06'),
(36, '2021-01-11', 'Turkey', 'Forwarded to Quality Check', 32, '2021-01-11 07:09:33'),
(37, '2021-01-08', 'Turkey', 'Inspect by Quality Control', 30, '2021-01-23 07:49:16'),
(39, '2021-01-14', 'Turkey', 'Ready for Packaging', 30, '2021-01-23 07:50:31'),
(40, '2021-01-31', 'manila', 'test', 37, '2021-01-30 09:24:16'),
(41, '2021-01-15', 'Payment Recieve', 'Confirm Payment From Client to Company', 38, '2021-02-03 03:15:40'),
(42, '2021-01-19', 'Turkey', 'Confirm Payment From the manufacturer', 38, '2021-02-03 03:16:55'),
(43, '2021-01-25', 'Turkey', 'Label Created!', 38, '2021-02-03 03:17:59'),
(44, '2021-01-29', 'Turkey', 'Forwarded to Quality Check!', 38, '2021-02-03 03:18:30'),
(45, '2021-01-02', 'Payment', 'Payment receive from the client to company', 39, '2021-02-05 05:09:23'),
(46, '2021-01-08', 'USA', 'Confirmed payment from company to manufacturer!', 39, '2021-02-05 05:13:49'),
(49, '2021-01-14', 'USA', 'Label Created!', 39, '2021-02-05 05:16:43'),
(50, '2021-01-20', 'USA', 'Forwarded To Quality Check!', 39, '2021-02-05 05:17:07'),
(51, '2021-01-28', 'USA', 'Ready for packaging!', 39, '2021-02-05 06:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `fldUserID` int(11) NOT NULL,
  `fldUserLastname` varchar(255) DEFAULT NULL,
  `fldUserMiddlename` varchar(255) DEFAULT NULL,
  `fldUserFirstname` varchar(255) DEFAULT NULL,
  `fldUserContactNumber` varchar(255) DEFAULT NULL,
  `fldUserEmail` varchar(255) DEFAULT NULL,
  `fldUserAddress` text DEFAULT NULL,
  `fldUserRoles` varchar(255) DEFAULT NULL,
  `fldUserStatus` varchar(100) DEFAULT NULL,
  `fldUserPassword` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `fldUserCreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`fldUserID`, `fldUserLastname`, `fldUserMiddlename`, `fldUserFirstname`, `fldUserContactNumber`, `fldUserEmail`, `fldUserAddress`, `fldUserRoles`, `fldUserStatus`, `fldUserPassword`, `remember_token`, `fldUserCreatedAt`) VALUES
(12, 'Admin', 'test', 'Melko', '09976540115', 'admin@gmail.com', 'n/a', '1', 'active', '$2y$10$QWTPbQBynre3FhaqqWDDUuHHMDHvTBEgS82midzCBXTs/QDvIFSIK', 'khD9PBlvsS', '2020-12-15 06:41:20'),
(19, 'Macadaeg', NULL, 'Rondine', '09056648460', 'ronniemac8@gmail.com', 'Cagayan Province', '3', 'active', '$2y$10$cD3sBdyksE5MZkLw8zGQwO5FhJm08A.rxtfym92mmaFGvPogcMNuK', 'o6kaGnsEJP', '2020-12-21 01:49:05'),
(20, 'Service', NULL, 'Customer', '09052172290', 'mymelkoph.customerservice@gmail.com', '#23 F.Gomez st. brgy. kanluran sta.rosa laguna', '2', 'active', '$2y$10$GHf.Yb.wy5oEb3sqhKjCsOuM5bQ/1WZQgcKaPtYxk5kZiJTgx9cTK', 'GroLzoqt42', '2020-12-21 01:55:25'),
(21, 'Mabutas', 'B', 'Geoffrey', '09123456789', 'User@gmail.com', 'Sibonga, Cebu', '3', 'active', '$2y$10$uu3Z8PEfO8iJh/anZvbJ/Oox3EFJTwYEJs2X9bz9Kjdk3VzccMuuq', 'OVbfeYvEvT', '2020-12-22 07:26:48'),
(22, 'Navarro', NULL, 'Mic Mik', '09052172290', 'micnavarro03@gmail.com', '--', '2', 'active', '$2y$10$rWs.UCZx11YE8NAB4tf5j.4sxBPTzp3gJ.tJOEM18jGKxyPZd7iwe', '6R5iCSrPx7', '2021-02-20 07:25:02'),
(23, 'Muyco', 'Love', 'Rose', '09052172290', 'kaiserkitamura@gmail.com', '--', '2', 'active', '$2y$10$8kuBa44pFtJvlYHb7YD0quZhpHb8gN4dPY0vTdWFSw4qKKAI5Nc8K', '2nPNIXBuc1', '2021-02-20 07:25:49'),
(24, 'Salgado', NULL, 'Chan', '09052172290', 'rm.christiansalgado@gmail.com', '--', '2', 'active', '$2y$10$YqceISXpKIz2FC5pK3dPt.CO55XbZhRY7oO.ys2EzYmqKgRj.OcYK', 'A68H1oDECA', '2021-02-20 07:26:48'),
(25, 'Wang', NULL, 'Jennica', '09052172290', 'jenmelko123@gmail.com', '--', '2', 'active', '$2y$10$nXHaV0HuU6hIiyE.2eNJgeSechT445SNZKdxudrmrKutZDNcFOK8O', 'j0kNxcvgX8', '2021-02-20 07:28:17'),
(26, 'Flores', NULL, 'Maciel', '09052172290', '27martciel@gmail.com', '--', '2', 'active', '$2y$10$xp//SyVg.RXKNNIWtzFPFO/Rb4Tu322sFnxmrxluYqCuOz2RkoRAm', 'LdtC0VBKB9', '2021-02-20 07:29:17'),
(27, 'Mabalcon', NULL, 'Divine Grace', '09052172290', 'mymelkophdivinegrace@gmail.com', '--', '2', 'active', '$2y$10$4bvXGjvZ2wLED5A.aLDHDO47mqQZ9ijXEb2PwpKAGHqN4yXS2ap5G', 'Zyj0988xWT', '2021-02-20 07:30:37'),
(28, 'Cabangisan', NULL, 'Joan', '09052172290', 'melkojoan123@gmail.com', '--', '2', 'active', '$2y$10$W9zm7iUao1MrcOqOQsLr6OkU5qYvQFOQXKtcpf9gAk3NJDAMqkFIy', 'zFv0UFrj2I', '2021-02-20 07:34:37'),
(29, 'Orquejo', NULL, 'Mark', '09052172290', 'markorquejo27@gmail.com', '--', '2', 'active', '$2y$10$e19F718UfIE1tb1sfS9nqeIRf19dTqrzLPBmtmKLo2mbWdDToFqLa', 'V1JnspIvwN', '2021-02-20 07:44:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`fldCategoryID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`fldcustomerid`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`fldOrderID`),
  ADD UNIQUE KEY `fldOrderNumber` (`fldOrderNumber`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`fldProductID`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`fldroleid`);

--
-- Indexes for table `tbltrackstatus`
--
ALTER TABLE `tbltrackstatus`
  ADD PRIMARY KEY (`fldTrackStatusID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`fldUserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `fldCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `fldcustomerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `fldOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `fldProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `fldroleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbltrackstatus`
--
ALTER TABLE `tbltrackstatus`
  MODIFY `fldTrackStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `fldUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

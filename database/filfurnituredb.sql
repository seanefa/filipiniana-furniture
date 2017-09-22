-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2017 at 03:34 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filfurnituredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblattributes`
--

CREATE TABLE `tblattributes` (
  `attributeID` int(11) NOT NULL,
  `attributeName` varchar(150) CHARACTER SET latin1 NOT NULL,
  `attributeStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblattributes`
--

INSERT INTO `tblattributes` (`attributeID`, `attributeName`, `attributeStatus`) VALUES
(8, 'Size', 'Archived'),
(9, 'Color', 'Active'),
(10, 'Type', 'Active'),
(11, 'Weight', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblattribute_measure`
--

CREATE TABLE `tblattribute_measure` (
  `amID` int(11) NOT NULL,
  `attributeID` int(11) NOT NULL,
  `uncategoryID` int(11) NOT NULL,
  `amStatus` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblattribute_measure`
--

INSERT INTO `tblattribute_measure` (`amID`, `attributeID`, `uncategoryID`, `amStatus`) VALUES
(8, 8, 11, 'Active'),
(9, 9, 0, 'Active'),
(10, 10, 0, 'Active'),
(11, 11, 14, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblbank_accounts`
--

CREATE TABLE `tblbank_accounts` (
  `accountID` int(11) NOT NULL,
  `accountName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `accountNumber` varchar(50) CHARACTER SET utf8 NOT NULL,
  `accountStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `accountRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranches`
--

CREATE TABLE `tblbranches` (
  `branchID` int(11) NOT NULL,
  `branchLocation` varchar(45) CHARACTER SET utf8 NOT NULL,
  `branchAddress` varchar(450) CHARACTER SET utf8 NOT NULL,
  `branchRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `branchStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbranches`
--

INSERT INTO `tblbranches` (`branchID`, `branchLocation`, `branchAddress`, `branchRemarks`, `branchStatus`) VALUES
(1, 'Bacoor', 'Talaba II, Bacoor Cavite', NULL, 'Listed'),
(2, 'Silang', 'Silangan, Silang Cavite', NULL, 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblcheck_details`
--

CREATE TABLE `tblcheck_details` (
  `check_detailsID` int(11) NOT NULL,
  `p_detailsID` int(11) NOT NULL,
  `checkNumber` int(11) NOT NULL,
  `checkAmount` double NOT NULL,
  `checkRemarks` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcheck_details`
--

INSERT INTO `tblcheck_details` (`check_detailsID`, `p_detailsID`, `checkNumber`, `checkAmount`, `checkRemarks`) VALUES
(1, 7, 32232, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany_info`
--

CREATE TABLE `tblcompany_info` (
  `comp_recID` int(11) NOT NULL,
  `comp_logo` varchar(450) CHARACTER SET latin1 NOT NULL,
  `comp_name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `comp_num` int(11) NOT NULL,
  `comp_email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `comp_address` varchar(150) CHARACTER SET latin1 NOT NULL,
  `comp_about` varchar(450) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcompany_info`
--

INSERT INTO `tblcompany_info` (`comp_recID`, `comp_logo`, `comp_name`, `comp_num`, `comp_email`, `comp_address`, `comp_about`) VALUES
(1, 'filipiniana-furniture-logo.png', 'Filipiniana Furnitures', 63, 'filipiniana_furn@gmail.com', 'Aguinaldo Hi-way, Talaba II, Bacoor, Cavite', 'A furniture shop');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `customerID` int(11) NOT NULL,
  `customerFirstName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerMiddleName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `customerLastName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerAddress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `customerContactNum` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerEmail` varchar(80) CHARACTER SET utf8 NOT NULL,
  `customerDP` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `customerNewsletter` int(11) NOT NULL,
  `customerStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`customerID`, `customerFirstName`, `customerMiddleName`, `customerLastName`, `customerAddress`, `customerContactNum`, `customerEmail`, `customerDP`, `customerNewsletter`, `customerStatus`) VALUES
(18, 'Cyreil Neil', '', 'Basilio', '', '09876542572', 'cyreilneil@gmail.com', '', 0, ''),
(19, 'Aira', 'Coronado', 'Coronado', '#123 Kagawad Street Batasan Hills Quezon City', '09994145004', 'hongkaira@gmail.com', '', 0, 'active'),
(20, 'Mark Angelo', 'Barrameda', 'Coronado', '#62 Resolution Street Batasan Hills Quezon CIty', '09091543726', 'angelong123@yahoo.com', '', 0, 'Active'),
(21, 'Rhodora', 'Barrameda', 'Coronado', '3E Adult Ward PHC Quezon City', '+63 (921) 698-2449', 'rhodoramabr@yahoo.com', '', 0, 'Active'),
(22, 'Rhodora', 'Barrameda', 'Coronado', '3E Adult Ward PHC Quezon City', '+63 (921) 698-2449', 'rhodoramabr@yahoo.com', '', 0, 'Active'),
(23, 'Donita', 'Rose', 'Aber', '#1234 Anuna Street BHQC', '+63 (930) 678-2267', 'anunadonita@yahoo.com', '', 0, 'Active'),
(24, 'Gillian May', 'Piloton', 'Anyayahan', '#1234 Alton Street BHQC', '+63 (999) 516-9790', 'gilanyapilksoo@gmail.com', '', 0, 'Active'),
(25, 'Zyrnn Joice', 'Lasay', 'Tibre', '#1234 Saret Street BHQC', '+63 (099) 999-9999', 'zytibs@gmail.com', '', 0, 'Active'),
(26, 'Angelu', 'Balicuatro', 'Atienza', '#1234 One Way Street BHQC', '+63 (977) 546-7173', 'angeluat@gmail.com', '', 0, 'Active'),
(27, 'Shaira', 'Joy', 'Flores', '#1234 Bagong Silangan Veteran QC', '+63 (738) 138-7219', 'shairajhoy@gmail.com', '', 0, 'Active'),
(28, 'Sheyne', 'Smth', 'Laristan', '#1234 Somewhere Street Brgy. Litex BHQC', '+63 (967) 136-7192', 'sheynelaristan@gmail.com', '', 0, 'Active'),
(29, 'Roselyn', 'M', 'Melgar', '#1234 Taas na Street BHQC', '+63 (972) 713-8731', 'binastedsikuya@gmail.com', '', 0, 'Active'),
(30, 'Gendy', 'Lopez', 'Uy', '329 San jose st. buenlag east mangaldan, pangasinan', '+63 (935) 366-7068', 'gendylopez08@gmail.com', '', 0, 'Active'),
(31, 'M', 'A', 'C', '#62 Resolution Street Batasan Hills Quezon City', '09726827318', 'hh@yahoo.com', '', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomize_request`
--

CREATE TABLE `tblcustomize_request` (
  `customizedID` int(11) NOT NULL,
  `accountdetailsID` int(11) NOT NULL,
  `customizedPic` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `customizedDescription` varchar(250) CHARACTER SET utf8 NOT NULL,
  `customFrameID` int(11) DEFAULT NULL,
  `customFabricID` int(11) DEFAULT NULL,
  `customStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcust_req_images`
--

CREATE TABLE `tblcust_req_images` (
  `cust_req_imagesID` int(11) NOT NULL,
  `cust_req_ID` int(11) NOT NULL,
  `cust_req_images` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cust_req_imageStat` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `deliveryID` int(11) NOT NULL,
  `deliveryEmpAssigned` int(11) NOT NULL,
  `deliveryReleaseID` int(11) NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `deliveryRate` double NOT NULL,
  `deliveryAddress` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `deliveryRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `deliveryStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbldelivery`
--

INSERT INTO `tbldelivery` (`deliveryID`, `deliveryEmpAssigned`, `deliveryReleaseID`, `deliveryDate`, `deliveryRate`, `deliveryAddress`, `deliveryRemarks`, `deliveryStatus`) VALUES
(1, 1, 2, '2017-09-29 00:00:00', 0, '#123 Alton Street BHQCMNL', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery_rates`
--

CREATE TABLE `tbldelivery_rates` (
  `delivery_rateID` int(11) NOT NULL,
  `delBranchID` int(11) NOT NULL,
  `delLocation` varchar(100) CHARACTER SET utf8 NOT NULL,
  `delRateType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `delRate` varchar(45) CHARACTER SET utf8 NOT NULL,
  `delRateStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbldelivery_rates`
--

INSERT INTO `tbldelivery_rates` (`delivery_rateID`, `delBranchID`, `delLocation`, `delRateType`, `delRate`, `delRateStatus`) VALUES
(5, 1, 'Metro Manila', 'Amount', '1000', 'Listed'),
(6, 1, 'Provincial', 'Amount', '3000', 'Listed'),
(7, 2, 'Quezon City', 'Amount', '400', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tbldesign_phase`
--

CREATE TABLE `tbldesign_phase` (
  `d_phaseID` int(11) NOT NULL,
  `p_design` int(11) NOT NULL,
  `d_phase` int(11) NOT NULL,
  `d_phaseStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbldesign_phase`
--

INSERT INTO `tbldesign_phase` (`d_phaseID`, `p_design`, `d_phase`, `d_phaseStatus`) VALUES
(1, 2, 1, 'Active'),
(2, 2, 2, 'Active'),
(3, 2, 5, 'Active'),
(4, 1, 1, 'Active'),
(5, 1, 2, 'Active'),
(6, 1, 5, 'Active'),
(7, 3, 1, 'Active'),
(8, 3, 2, 'Active'),
(9, 3, 3, 'Active'),
(10, 3, 4, 'Active'),
(11, 3, 5, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbldownpayment`
--

CREATE TABLE `tbldownpayment` (
  `downpaymentID` int(11) NOT NULL,
  `downpaymentPercentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbldownpayment`
--

INSERT INTO `tbldownpayment` (`downpaymentID`, `downpaymentPercentage`) VALUES
(1, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `empID` int(11) NOT NULL,
  `empFirstName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `empLastName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `empMidName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `empRemarks` varchar(100) CHARACTER SET utf8 NOT NULL,
  `empStatus` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`empID`, `empFirstName`, `empLastName`, `empMidName`, `empRemarks`, `empStatus`) VALUES
(1, 'Aira', 'Coronado', 'Barrameda', 'An employee', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblemp_job`
--

CREATE TABLE `tblemp_job` (
  `emp_jobID` int(11) NOT NULL,
  `emp_empID` int(11) NOT NULL,
  `emp_jobDescID` int(11) NOT NULL,
  `emp_jobStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfabrics`
--

CREATE TABLE `tblfabrics` (
  `fabricID` int(11) NOT NULL,
  `fabricName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `fabricTypeID` int(11) NOT NULL,
  `fabricPatternID` int(11) NOT NULL,
  `fabricColor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fabricRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fabricPic` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fabricStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfabrics`
--

INSERT INTO `tblfabrics` (`fabricID`, `fabricName`, `fabricTypeID`, `fabricPatternID`, `fabricColor`, `fabricRemarks`, `fabricPic`, `fabricStatus`) VALUES
(9, 'Gold Rani', 4, 8, 'Yellow and White', 'A soft weaved cotton fabric in yellow and white sunflowers pattern', '2017-08-241503587847.png', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_pattern`
--

CREATE TABLE `tblfabric_pattern` (
  `f_patternID` int(11) NOT NULL,
  `f_patternName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `f_patternRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `f_patternStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfabric_pattern`
--

INSERT INTO `tblfabric_pattern` (`f_patternID`, `f_patternName`, `f_patternRemarks`, `f_patternStatus`) VALUES
(7, 'Floral', 'Combination of many flowers in one print', 'Listed'),
(8, 'Sunflowers', 'Yellowish designs in the form of sunflowers', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_texture`
--

CREATE TABLE `tblfabric_texture` (
  `textureID` int(11) NOT NULL,
  `textureName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `textureDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `textureRating` int(11) DEFAULT NULL,
  `textureStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfabric_texture`
--

INSERT INTO `tblfabric_texture` (`textureID`, `textureName`, `textureDescription`, `textureRating`, `textureStatus`) VALUES
(13, 'Smooth', 'Smooth', 0, 'Listed'),
(14, 'Very Smooth', 'Very smooth', 0, 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_type`
--

CREATE TABLE `tblfabric_type` (
  `f_typeID` int(11) NOT NULL,
  `f_typeName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `f_typeWeaves` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `f_typeTextureID` int(11) NOT NULL,
  `f_typeStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfabric_type`
--

INSERT INTO `tblfabric_type` (`f_typeID`, `f_typeName`, `f_typeWeaves`, `f_typeTextureID`, `f_typeStatus`) VALUES
(4, 'Cotton', 'Heavily-Weaved', 14, 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblframeworks`
--

CREATE TABLE `tblframeworks` (
  `frameworkID` int(11) NOT NULL,
  `frameworkFurnType` int(11) NOT NULL,
  `frameworkName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `frameworkPic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `framedesignID` int(11) NOT NULL,
  `materialUsedID` int(11) NOT NULL,
  `frameworkRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `frameworkStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblframeworks`
--

INSERT INTO `tblframeworks` (`frameworkID`, `frameworkFurnType`, `frameworkName`, `frameworkPic`, `framedesignID`, `materialUsedID`, `frameworkRemarks`, `frameworkStatus`) VALUES
(9, 15, 'Side Victorian Floral', '2017-08-241503588358.png', 5, 1, ' Victorian Floral Design on the sides', 'Listed'),
(10, 17, 'Basic Frame', '2017-08-241503588427.png', 6, 1, ' Checkered basic design ', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblframe_design`
--

CREATE TABLE `tblframe_design` (
  `designID` int(11) NOT NULL,
  `designName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `designDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `designStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblframe_design`
--

INSERT INTO `tblframe_design` (`designID`, `designName`, `designDescription`, `designStatus`) VALUES
(5, 'Victorian Classic', ' A victorian classic design', 'Listed'),
(6, 'Checkered', ' Checkered carving design', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblframe_material`
--

CREATE TABLE `tblframe_material` (
  `materialID` int(11) NOT NULL,
  `materialName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `materialRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `materialStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblframe_material`
--

INSERT INTO `tblframe_material` (`materialID`, `materialName`, `materialRemarks`, `materialStatus`) VALUES
(1, 'Narra Wood', 'Narra wood is a very sturdy kind of wood', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfurn_category`
--

CREATE TABLE `tblfurn_category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `categoryStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `categoryRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfurn_category`
--

INSERT INTO `tblfurn_category` (`categoryID`, `categoryName`, `categoryStatus`, `categoryRemarks`) VALUES
(6, 'Living Room', 'Listed', ' Living Area'),
(7, 'Bedroom', 'Listed', 'Bedroom'),
(8, 'Outdoor', 'Listed', 'Outdoor Furnitures'),
(9, 'DIning Room', 'Listed', ' Dining Area'),
(10, 'Others', 'Listed', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `tblfurn_design`
--

CREATE TABLE `tblfurn_design` (
  `designID` int(11) NOT NULL,
  `designName` varchar(45) CHARACTER SET latin1 NOT NULL,
  `designStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfurn_design`
--

INSERT INTO `tblfurn_design` (`designID`, `designName`, `designStatus`) VALUES
(1, 'Pure', 'Active'),
(2, 'Weaved', 'Active'),
(3, 'Upholstered', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblfurn_type`
--

CREATE TABLE `tblfurn_type` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `typeDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `typeStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `typeCategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfurn_type`
--

INSERT INTO `tblfurn_type` (`typeID`, `typeName`, `typeDescription`, `typeStatus`, `typeCategoryID`) VALUES
(13, 'Beds', 'A piece of furniture that people sleep on', 'Listed', 7),
(14, 'Bedside Tables', ' A piece of furniture usually found beside the bed. ', 'Listed', 7),
(15, 'Accent Tables', 'Often used as a great decoration. Any piece of accent furniture worthy of being called that goes bey', 'Listed', 6),
(16, 'Display and Utility Cabinets', 'Piece of furniture that usually has doors and shelves', 'Listed', 6),
(17, 'Sectional Sofas', ' A huge L shaped couch that takes up most of the living room', 'Listed', 6),
(18, 'Bar Folding Pantry Table', 'Tables usually found in the kitchen or dining area', 'Listed', 9),
(19, 'Dining Chair', 'Chairs that surrounds the dining table. Found in the dining area.', 'Listed', 9),
(20, 'Dining Table', ' Tables for the dining area', 'Listed', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoicedetails`
--

CREATE TABLE `tblinvoicedetails` (
  `invoiceID` int(11) NOT NULL,
  `invorderID` int(11) NOT NULL,
  `balance` double NOT NULL,
  `dateIssued` date NOT NULL,
  `invoiceStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `invoiceRemarks` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `invDelrateID` int(11) DEFAULT NULL,
  `invPenID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblinvoicedetails`
--

INSERT INTO `tblinvoicedetails` (`invoiceID`, `invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES
(1, 1, 105000, '2017-08-28', 'Pending', 'Initial Invoice', 1, 1),
(2, 6, 35000, '2017-08-29', 'Pending', 'Initial Invoice', 1, 1),
(3, 7, 35000, '2017-08-29', 'Pending', 'Initial Invoice', 1, 1),
(4, 8, 105000, '2017-08-29', 'Pending', 'Initial Invoice', 1, 1),
(5, 9, 120000, '2017-08-30', 'Pending', 'Initial Invoice', 1, 1),
(6, 10, 25000, '2017-08-30', 'Pending', 'Initial Invoice', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbljobs`
--

CREATE TABLE `tbljobs` (
  `jobID` int(11) NOT NULL,
  `jobName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `jobDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `jobStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbljobs`
--

INSERT INTO `tbljobs` (`jobID`, `jobName`, `jobDescription`, `jobStatus`) VALUES
(7, 'Carpenter', 'Build the frame of the furniture. Also carved if the employee can.', 'Listed'),
(8, 'Carver', 'Carved the specified design of the furniture on the frames or carved the furniture to be in shape', 'Listed'),
(9, 'Upholsterer', 'Sew the fabrics on the furniture, also the one who fills the foam on every sofa-like or upholstered ', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `logID` int(11) NOT NULL,
  `category` varchar(250) CHARACTER SET latin1 NOT NULL,
  `action` varchar(150) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `description` varchar(450) CHARACTER SET latin1 NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`logID`, `category`, `action`, `date`, `description`, `userID`) VALUES
(8, 'Supplier', 'New', '2017-08-24', 'Added new supplier SMENT Fabrics and Prints, ID = 16', 1),
(9, 'Supplier', 'Update', '2017-08-24', 'Updated supplier SMENT Fabrics and Prints, ID = 16', 1),
(10, 'Category', 'New', '2017-08-24', 'Added new category Living Room, ID = 6', 1),
(11, 'Category', 'New', '2017-08-24', 'Added new category Bedroom, ID = 7', 1),
(12, 'Category', 'New', '2017-08-24', 'Added new category Outdoor, ID = 8', 1),
(13, 'Category', 'New', '2017-08-24', 'Added new category DIning Room, ID = 9', 1),
(14, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Beds, ID = 13', 1),
(15, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Bedside Tables, ID = 14', 1),
(16, 'Furniture Type', 'Update', '2017-08-24', 'Updated furniture type Bedside Tables, ID = 14', 1),
(17, 'Furniture Type', 'Update', '2017-08-24', 'Updated furniture type Bedside Tables, ID = 14', 1),
(18, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Accent Tables, ID = 15', 1),
(19, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Display and Utility Cabinets, ID = 16', 1),
(20, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Sectional Sofas, ID = 17', 1),
(21, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Bar Folding Pantry Table, ID = 18', 1),
(22, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Dining Chair, ID = 19', 1),
(23, 'Furniture Type', 'New', '2017-08-24', 'Added new furniture type Dining Table, ID = 20', 1),
(24, 'Fabric Texture', 'New', '2017-08-24', 'Added new fabric texture Smooth, ID = 13', 1),
(25, 'Fabric Texture', 'New', '2017-08-24', 'Added new fabric texture Very Smooth, ID = 14', 1),
(26, 'Fabric Type', 'New', '2017-08-24', 'Added new fabric type Cotton, ID = 4', 1),
(27, 'Fabric Pattern', 'New', '2017-08-24', 'Added new fabric pattern Floral, ID = 7', 1),
(28, 'Fabric Pattern', 'New', '2017-08-24', 'Added new fabric pattern Sunflowers, ID = 8', 1),
(29, 'Fabric Pattern', 'Update', '2017-08-24', 'Updated fabric pattern Floral, ID = 7', 1),
(30, 'Fabrics Formed', 'New', '2017-08-24', 'Added new fabric Gold Rani, ID = 9', 1),
(31, 'Frame Design', 'New', '2017-08-24', 'Added new frame design Victorian Classic, ID = 5', 1),
(32, 'Frame Design', 'New', '2017-08-24', 'Added new frame design Checkered, ID = 6', 1),
(33, 'Frame Material', 'Update', '2017-08-24', 'Updated frame material Narra Wood, ID = 1', 1),
(34, 'Frameworks', 'New', '2017-08-24', 'Added new framework Side Victorian Floral, ID = 9', 1),
(35, 'Frameworks', 'New', '2017-08-24', 'Added new framework Basic Frame, ID = 10', 1),
(36, 'Products', 'New', '2017-08-24', 'Added new product Queen, ID = 16', 1),
(37, 'Jobs', 'New', '2017-08-24', 'Added new job Carpenter, ID = 7', 1),
(38, 'Jobs', 'New', '2017-08-24', 'Added new job Carver, ID = 8', 1),
(39, 'Jobs', 'New', '2017-08-24', 'Added new job Upholsterer, ID = 9', 1),
(40, 'Jobs', 'Update', '2017-08-24', 'Updated job Upholsterer, ID = 9', 1),
(41, 'Promos', 'New', '2017-08-24', 'Added new promo Grand Opening Promo, ID = 0', 1),
(42, 'Promos', 'New', '2017-08-24', 'Added new promo Grand Opening Promo, ID = 6', 1),
(43, 'Delivery Rates', 'New', '2017-08-24', 'Added new delivery rate 1000, ID = 5', 1),
(44, 'Delivery Rates', 'New', '2017-08-24', 'Added new delivery rate 3000, ID = 6', 1),
(45, 'Category', 'New', '2017-08-24', 'Added new category Others, ID = 10', 1),
(46, 'Category', 'New', '2017-08-25', 'Added new category , ID = 11', 1),
(47, 'Unit of Measurement', 'New', '2017-08-26', 'Added new unit of measurement Feet, ID = 14', 1),
(48, 'Unit of Measurement', 'New', '2017-08-26', 'Added new unit of measurement Meter, ID = 15', 1),
(49, 'Unit of Measurement Category', 'New', '2017-08-26', 'Added new unit of measurement category Length, ID = 11', 1),
(50, 'Material Attribute', 'New', '2017-08-26', 'Added new material attribute Size, ID = 8', 1),
(51, 'Material Type', 'New', '2017-08-26', 'Added new material type Wood, ID = 1', 1),
(52, 'Materials', 'New', '2017-08-26', 'Added new material FNC, ID = 10', 1),
(53, 'Material Type', 'New', '2017-08-26', 'Added new material type Fabric, ID = 2', 1),
(54, 'Material Type', 'New', '2017-08-26', 'Added new material type Paint, ID = 3', 1),
(55, 'Material Type', 'New', '2017-08-26', 'Added new material type Varnish, ID = 4', 1),
(56, 'Material Type', 'New', '2017-08-26', 'Added new material type Rattan, ID = 5', 1),
(57, 'Supplier', 'New', '2017-08-27', 'Added new supplier AA, ID = 17', 4),
(58, 'Order', 'New', '2017-08-28', 'New order #OR83', 1),
(59, 'Order', 'New', '2017-08-28', 'New order #OR84', 1),
(60, 'Order', 'New', '2017-08-28', 'New order #OR000085', 1),
(61, 'Order', 'New', '2017-08-28', 'New order #OR000086', 1),
(62, 'Order', 'New', '2017-08-28', 'New order #OR000087', 1),
(63, 'Order', 'New', '2017-08-28', 'New order #OR000088', 1),
(64, 'Order', 'New', '2017-08-28', 'New order #OR000089', 1),
(65, 'Order', 'New', '2017-08-28', 'New order #OR000090', 1),
(66, 'Order', 'New', '2017-08-28', 'New order #OR000091', 1),
(67, 'Order', 'New', '2017-08-28', 'New order #OR000092', 1),
(68, 'Order', 'New', '2017-08-28', 'New order #OR000093', 1),
(69, 'Order', 'New', '2017-08-28', 'New order #OR000094', 1),
(70, 'Order', 'New', '2017-08-28', 'New order #OR000095', 1),
(71, 'Order', 'New', '2017-08-28', 'New order #OR000096', 1),
(72, 'Products', 'New', '2017-08-28', 'Added new product Elizabeth, ID = 17', 1),
(73, 'Products', 'Update', '2017-08-28', 'Updated product Queen, ID = 16', 1),
(74, 'Order', 'New', '2017-08-28', 'New order #OR000001', 1),
(75, 'Unit of Measurement Category', 'New', '2017-08-29', 'Added new unit of measurement category Area, ID = 13', 1),
(76, 'Unit of Measurement Category', 'New', '2017-08-29', 'Added new unit of measurement category Weight, ID = 14', 1),
(77, 'Unit of Measurement', 'New', '2017-08-29', 'Added new unit of measurement Gram, ID = 16', 1),
(78, 'Unit of Measurement Category', 'Deactivate', '2017-08-29', 'Deactivated unit of measurement category , ID = 13', 1),
(79, 'Unit of Measurement', 'New', '2017-08-29', 'Added new unit of measurement Inch, ID = 17', 1),
(80, 'Material Attribute', 'Deactivate', '2017-08-29', 'Deactivated material attribute , ID = 8', 1),
(81, 'Material Attribute', 'New', '2017-08-29', 'Added new material attribute Color, ID = 9', 1),
(82, 'Material Attribute', 'New', '2017-08-29', 'Added new material attribute Type, ID = 10', 1),
(83, 'Material Attribute', 'New', '2017-08-29', 'Added new material attribute Weight, ID = 11', 1),
(84, 'Materials', 'New', '2017-08-29', 'Added new material Liza Varnish, ID = 11', 1),
(85, 'Materials', 'New', '2017-08-29', 'Added new material Mela Varnish, ID = 12', 1),
(86, 'Supplier', 'Update', '2017-08-29', 'Updated supplier FNCENT Trees and Woods Inc., ID = 15', 1),
(87, 'Supplier', 'Update', '2017-08-29', 'Updated supplier AA, ID = 17', 1),
(88, 'Products', 'New', '2017-08-30', 'Added new product Manilenia, ID = 18', 1),
(89, 'Products', 'Update', '2017-08-30', 'Updated product Manilenia, ID = 18', 1),
(90, 'Order', 'New', '2017-08-30', 'New order #OR000009', 1),
(91, 'Delivery Rates', 'New', '2017-08-30', 'Added new delivery rate 400, ID = 7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterials`
--

CREATE TABLE `tblmaterials` (
  `materialID` int(11) NOT NULL,
  `materialType` int(11) NOT NULL,
  `materialName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `materialMeasurement` varchar(450) CHARACTER SET utf8 NOT NULL,
  `materialStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmaterials`
--

INSERT INTO `tblmaterials` (`materialID`, `materialType`, `materialName`, `materialMeasurement`, `materialStatus`) VALUES
(10, 1, 'FNC', '', 'Listed'),
(11, 4, 'Liza Varnish', '', 'Listed'),
(12, 4, 'Mela Varnish', '', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_actions`
--

CREATE TABLE `tblmat_actions` (
  `mat_actionsID` int(11) NOT NULL,
  `mat_intID` int(11) NOT NULL,
  `mat_quantity` int(11) NOT NULL,
  `mat_actionRemarks` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_deliveries`
--

CREATE TABLE `tblmat_deliveries` (
  `mat_deliveriesID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `totalQuantity` int(11) NOT NULL,
  `mat_deliveryRemarks` varchar(450) NOT NULL,
  `mat_deliveryStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_deliverydetails`
--

CREATE TABLE `tblmat_deliverydetails` (
  `del_detailsID` int(11) NOT NULL,
  `del_matDelID` int(11) NOT NULL,
  `del_matVarID` int(11) NOT NULL,
  `del_quantity` int(11) NOT NULL,
  `del_remarks` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_inventory`
--

CREATE TABLE `tblmat_inventory` (
  `mat_inventoryID` int(11) NOT NULL,
  `matVariantID` int(11) NOT NULL,
  `matVarQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_type`
--

CREATE TABLE `tblmat_type` (
  `matTypeID` int(11) NOT NULL,
  `matTypeName` varchar(450) CHARACTER SET latin1 NOT NULL,
  `matTypeMeasure` varchar(450) CHARACTER SET latin1 NOT NULL,
  `matTypeRemarks` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `matTypeStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmat_type`
--

INSERT INTO `tblmat_type` (`matTypeID`, `matTypeName`, `matTypeMeasure`, `matTypeRemarks`, `matTypeStatus`) VALUES
(1, 'Wood', 'measuring is on materials', 'Wood', 'Listed'),
(2, 'Fabric', 'measuring is on materials', 'Fabric', 'Listed'),
(3, 'Paint', 'measuring is on materials', 'Paint', 'Listed'),
(4, 'Varnish', 'measuring is on materials', 'Varnish', 'Listed'),
(5, 'Rattan', 'measuring is on materials', 'Rattan', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_var`
--

CREATE TABLE `tblmat_var` (
  `mat_varID` int(11) NOT NULL,
  `materialID` int(11) NOT NULL,
  `mat_varDescription` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `mat_varStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmat_var`
--

INSERT INTO `tblmat_var` (`mat_varID`, `materialID`, `mat_varDescription`, `mat_varStatus`) VALUES
(257, 11, 'Odorless  / brown ', 'Active'),
(258, 11, 'Odorless  / red ', 'Active'),
(259, 11, 'Odorless  / transparent ', 'Active'),
(260, 11, 'Original  / brown ', 'Active'),
(261, 11, 'Original  / red ', 'Active'),
(262, 11, 'Original  / transparent ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodeofpayment`
--

CREATE TABLE `tblmodeofpayment` (
  `modeofpaymentID` int(11) NOT NULL,
  `modeofpaymentDesc` varchar(45) CHARACTER SET utf8 NOT NULL,
  `modeofpaymentStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmodeofpayment`
--

INSERT INTO `tblmodeofpayment` (`modeofpaymentID`, `modeofpaymentDesc`, `modeofpaymentStatus`) VALUES
(1, 'Cash', 'Active'),
(2, 'Check', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblonhand`
--

CREATE TABLE `tblonhand` (
  `onHandID` int(11) NOT NULL,
  `ohProdID` int(11) NOT NULL,
  `ohQuantity` int(11) NOT NULL,
  `ohRemarks` varchar(450) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblonhand`
--

INSERT INTO `tblonhand` (`onHandID`, `ohProdID`, `ohQuantity`, `ohRemarks`) VALUES
(3, 17, 4, NULL),
(4, 18, 10, NULL),
(5, 18, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `orderID` int(11) NOT NULL,
  `receivedbyUserID` int(11) DEFAULT NULL,
  `dateOfReceived` date NOT NULL,
  `dateOfRelease` date NOT NULL,
  `custOrderID` int(11) NOT NULL,
  `orderPrice` double NOT NULL,
  `orderStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `shippingAddress` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `orderType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `orderRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`orderID`, `receivedbyUserID`, `dateOfReceived`, `dateOfRelease`, `custOrderID`, `orderPrice`, `orderStatus`, `shippingAddress`, `orderType`, `orderRemarks`) VALUES
(1, 1, '2017-08-28', '2017-08-24', 18, 105000, 'Ready for release', '#62 Resolution ', 'Pre-Order', 'An order.'),
(4, NULL, '2017-08-29', '2017-08-29', 23, 35000, 'Cancelled', 'N/A', 'On-Hand', 'No reason.'),
(6, 1, '2017-08-29', '2017-08-29', 21, 35000, 'Finished', 'N/A', 'On-Hand', 'An order.'),
(7, 1, '2017-08-29', '2017-08-29', 26, 35000, 'Finished', 'N/A', 'On-Hand', 'An order.'),
(8, 1, '2017-08-29', '2017-08-29', 24, 105000, 'Finished', 'N/A', 'On-Hand', 'An order.'),
(9, 1, '2017-08-30', '2017-08-31', 19, 120000, 'Ongoing', 'N/A', 'Pre-Order', ''),
(10, 1, '2017-08-30', '2017-08-30', 30, 25000, 'Pending', 'N/A', 'On-Hand', 'An order.');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_actions`
--

CREATE TABLE `tblorder_actions` (
  `orActionID` int(11) NOT NULL,
  `orOrderID` int(11) NOT NULL,
  `orAction` varchar(450) CHARACTER SET latin1 NOT NULL,
  `orReason` varchar(450) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblorder_actions`
--

INSERT INTO `tblorder_actions` (`orActionID`, `orOrderID`, `orAction`, `orReason`) VALUES
(3, 4, 'Cancelled', 'No reason.');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_customization`
--

CREATE TABLE `tblorder_customization` (
  `orCustID` int(11) NOT NULL,
  `orOrderReqID` int(11) NOT NULL,
  `orFabricID` int(11) DEFAULT NULL,
  `orFrameworkID` int(11) DEFAULT NULL,
  `orSizeSpecs` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `orDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_request`
--

CREATE TABLE `tblorder_request` (
  `order_requestID` int(11) NOT NULL,
  `tblOrdersID` int(11) NOT NULL,
  `orderProductID` int(11) DEFAULT NULL,
  `prodUnitPrice` double NOT NULL,
  `orderRemarks` int(11) NOT NULL,
  `orderPackageID` int(11) DEFAULT NULL,
  `orderQuantity` int(11) NOT NULL,
  `orderRequestStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblorder_request`
--

INSERT INTO `tblorder_request` (`order_requestID`, `tblOrdersID`, `orderProductID`, `prodUnitPrice`, `orderRemarks`, `orderPackageID`, `orderQuantity`, `orderRequestStatus`) VALUES
(1, 1, 17, 35000, 0, NULL, 3, 'Ready for release'),
(3, 6, 17, 35000, 0, NULL, 1, 'Released'),
(4, 6, 17, 35000, 0, NULL, 1, 'Released'),
(5, 7, 17, 35000, 0, NULL, 1, 'Released'),
(6, 8, 17, 35000, 0, NULL, 3, 'Released'),
(7, 9, 17, 35000, 0, NULL, 2, 'Active'),
(8, 9, 16, 50000, 0, NULL, 1, 'Active'),
(9, 10, 18, 25000, 0, NULL, 1, 'Ready for release');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_return`
--

CREATE TABLE `tblorder_return` (
  `returnID` int(11) NOT NULL,
  `dateReturned` date NOT NULL,
  `returnRemarks` varchar(450) NOT NULL,
  `returnStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_return_details`
--

CREATE TABLE `tblorder_return_details` (
  `rdetailsID` int(11) NOT NULL,
  `tblreturnID` int(11) NOT NULL,
  `tblorderreqID` int(11) NOT NULL,
  `returnReason` varchar(450) NOT NULL,
  `returnAssessment` varchar(100) NOT NULL,
  `rdetailsStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

CREATE TABLE `tblpackages` (
  `packageID` int(11) NOT NULL,
  `packagePrice` double NOT NULL,
  `packageDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `packageStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage_inclusions`
--

CREATE TABLE `tblpackage_inclusions` (
  `package_inclusionID` int(11) NOT NULL,
  `product_incID` int(11) NOT NULL,
  `package_incID` int(11) NOT NULL,
  `package_incStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment_details`
--

CREATE TABLE `tblpayment_details` (
  `payment_detailsID` int(11) NOT NULL,
  `invID` int(11) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `amountPaid` double NOT NULL,
  `mopID` int(11) NOT NULL,
  `paymentStatus` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblpayment_details`
--

INSERT INTO `tblpayment_details` (`payment_detailsID`, `invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES
(1, 1, '2017-08-28 17:23:52', 52500, 1, 'Paid'),
(2, 2, '2017-08-29 21:16:54', 35000, 1, 'Paid'),
(3, 3, '2017-08-29 21:18:05', 35000, 1, 'Paid'),
(4, 4, '2017-08-29 21:22:19', 10500, 1, 'Paid'),
(5, 5, '2017-08-30 09:00:32', 60000, 1, 'Paid'),
(6, 5, '2017-08-30 09:19:40', 5000, 1, 'Paid'),
(7, 6, '2017-08-30 09:31:31', 2, 2, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tblpenalty`
--

CREATE TABLE `tblpenalty` (
  `penaltyID` int(11) NOT NULL,
  `penaltyName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `penaltyRateType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `penaltyRate` double NOT NULL,
  `penaltyRemarks` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `penStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblpenalty`
--

INSERT INTO `tblpenalty` (`penaltyID`, `penaltyName`, `penaltyRateType`, `penaltyRate`, `penaltyRemarks`, `penStatus`) VALUES
(1, 'Storage Fee', 'Amount', 500, 'Overdue Orders', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblphases`
--

CREATE TABLE `tblphases` (
  `phaseID` int(11) NOT NULL,
  `phaseName` varchar(250) CHARACTER SET utf8 NOT NULL,
  `phaseIcon` varchar(450) CHARACTER SET utf8 NOT NULL,
  `phaseStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblphases`
--

INSERT INTO `tblphases` (`phaseID`, `phaseName`, `phaseIcon`, `phaseStatus`) VALUES
(1, 'Carpentry', 'carpentry.png', 'Active'),
(2, 'Carving', 'carving.png', 'Active'),
(3, 'Filling', 'filling.png', 'Active'),
(4, 'Upholstery', 'upholstery.png', 'Active'),
(5, 'Finishing', 'finishing.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblprodsonpromo`
--

CREATE TABLE `tblprodsonpromo` (
  `onpromoID` int(11) NOT NULL,
  `prodPromoID` int(11) NOT NULL,
  `promoDescID` int(11) NOT NULL,
  `onPromoStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `productID` int(11) NOT NULL,
  `prodCatID` int(11) NOT NULL,
  `prodTypeID` int(11) NOT NULL,
  `prodFrameworkID` int(11) NOT NULL,
  `prodDesign` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prodFabricID` int(11) DEFAULT NULL,
  `productName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `productDescription` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `productPrice` double NOT NULL,
  `prodMainPic` varchar(100) CHARACTER SET utf8 NOT NULL,
  `prodSizeSpecs` varchar(100) CHARACTER SET utf8 NOT NULL,
  `prodStat` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`productID`, `prodCatID`, `prodTypeID`, `prodFrameworkID`, `prodDesign`, `prodFabricID`, `productName`, `productDescription`, `productPrice`, `prodMainPic`, `prodSizeSpecs`, `prodStat`) VALUES
(16, 7, 13, 9, '1', 0, 'Queen', 'A queen sized bed', 50000, '2017-08-241503588669.png', '', 'Pre-Order'),
(17, 6, 17, 9, '3', 9, 'Elizabeth', 'A marvelous sofa', 35000, '2017-08-281503930441.png', ' L16.3â€³ x W16.3â€³ x H36.9â€³', 'Pre-Order'),
(18, 7, 13, 10, '1', 0, 'Manilenia', '', 25000, '2017-08-301504075842.png', '', 'Pre-Order');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduction`
--

CREATE TABLE `tblproduction` (
  `productionID` int(11) NOT NULL,
  `productionOrderReq` int(11) NOT NULL,
  `prodStartDate` date DEFAULT NULL,
  `prodEndDate` date DEFAULT NULL,
  `productionRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `productionStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblproduction`
--

INSERT INTO `tblproduction` (`productionID`, `productionOrderReq`, `prodStartDate`, `prodEndDate`, `productionRemarks`, `productionStatus`) VALUES
(33, 1, NULL, NULL, NULL, 'Finished'),
(34, 8, NULL, NULL, NULL, 'Ongoing'),
(35, 7, NULL, NULL, NULL, 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduction_phase`
--

CREATE TABLE `tblproduction_phase` (
  `prodHistID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `prodPhase` int(11) NOT NULL,
  `prodEmp` int(11) DEFAULT NULL,
  `prodDateStart` date DEFAULT NULL,
  `prodDateEnd` date DEFAULT NULL,
  `prodRemarks` varchar(450) CHARACTER SET latin1 DEFAULT NULL,
  `prodStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblproduction_phase`
--

INSERT INTO `tblproduction_phase` (`prodHistID`, `prodID`, `prodPhase`, `prodEmp`, `prodDateStart`, `prodDateEnd`, `prodRemarks`, `prodStatus`) VALUES
(101, 33, 1, 1, '2017-08-31', '2017-09-02', ' ', 'Finished'),
(102, 33, 2, 1, '2017-08-31', '2017-09-13', ' ', 'Finished'),
(103, 33, 3, 1, '2017-09-14', '2017-09-12', ' ', 'Finished'),
(104, 33, 4, 1, '2017-09-15', '2017-09-15', ' ', 'Finished'),
(105, 33, 5, 1, '2017-09-21', '2017-09-14', ' ', 'Finished'),
(106, 34, 1, 1, '2017-09-22', NULL, ' ', 'Ongoing'),
(107, 34, 2, NULL, NULL, NULL, NULL, 'Pending'),
(108, 34, 5, NULL, NULL, NULL, NULL, 'Pending'),
(109, 35, 1, NULL, NULL, NULL, NULL, 'Pending'),
(110, 35, 2, NULL, NULL, NULL, NULL, 'Pending'),
(111, 35, 3, NULL, NULL, NULL, NULL, 'Pending'),
(112, 35, 4, NULL, NULL, NULL, NULL, 'Pending'),
(113, 35, 5, NULL, NULL, NULL, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_images`
--

CREATE TABLE `tblprod_images` (
  `prodImageID` int(11) NOT NULL,
  `prodImgID` int(11) NOT NULL,
  `prodImageName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `prodImgStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_info`
--

CREATE TABLE `tblprod_info` (
  `prodInfoID` int(11) NOT NULL,
  `prodInfoProduct` int(11) NOT NULL,
  `prodInfoPhase` int(11) NOT NULL,
  `prodInfoStatus` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_materials`
--

CREATE TABLE `tblprod_materials` (
  `p_matID` int(11) NOT NULL,
  `p_prodInfoID` int(11) NOT NULL,
  `p_matMaterialID` int(11) NOT NULL,
  `p_matDescID` int(11) NOT NULL,
  `p_matQuantity` varchar(250) CHARACTER SET utf8 NOT NULL,
  `p_matUnit` varchar(45) CHARACTER SET utf8 NOT NULL,
  `p_matStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpromos`
--

CREATE TABLE `tblpromos` (
  `promoID` int(11) NOT NULL,
  `promoName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `promoDescription` varchar(450) CHARACTER SET utf8 NOT NULL,
  `promoStartDate` date NOT NULL,
  `promoEnd` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `promoImage` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `promoStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblpromos`
--

INSERT INTO `tblpromos` (`promoID`, `promoName`, `promoDescription`, `promoStartDate`, `promoEnd`, `promoImage`, `promoStatus`) VALUES
(6, 'Grand Opening Promo', 'Promo for the grand opening', '2017-08-24', '2017-08-25', '2017-08-241503589175.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo_condition`
--

CREATE TABLE `tblpromo_condition` (
  `conditionID` int(11) NOT NULL,
  `conPromoID` int(11) NOT NULL,
  `conCategory` varchar(45) CHARACTER SET latin1 NOT NULL,
  `conData` varchar(450) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblpromo_condition`
--

INSERT INTO `tblpromo_condition` (`conditionID`, `conPromoID`, `conCategory`, `conData`) VALUES
(6, 6, 'Amount', '50,000');

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo_promotion`
--

CREATE TABLE `tblpromo_promotion` (
  `promotionID` int(11) NOT NULL,
  `proPromoID` int(11) NOT NULL,
  `proCategory` varchar(45) CHARACTER SET latin1 NOT NULL,
  `proData` varchar(450) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblpromo_promotion`
--

INSERT INTO `tblpromo_promotion` (`promotionID`, `proPromoID`, `proCategory`, `proData`) VALUES
(6, 6, 'Others', ' 1 table');

-- --------------------------------------------------------

--
-- Table structure for table `tblrelease`
--

CREATE TABLE `tblrelease` (
  `releaseID` int(11) NOT NULL,
  `releaseDate` datetime NOT NULL,
  `releaseType` int(11) NOT NULL,
  `releaseRemarks` varchar(450) DEFAULT NULL,
  `releaseStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrelease`
--

INSERT INTO `tblrelease` (`releaseID`, `releaseDate`, `releaseType`, `releaseRemarks`, `releaseStatus`) VALUES
(1, '2017-09-11 00:00:00', 0, '', 'Released'),
(2, '2017-09-11 00:00:00', 0, 'TBD', 'Released'),
(3, '2017-09-11 00:00:00', 0, 'PICKED UP', 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `tblrelease_details`
--

CREATE TABLE `tblrelease_details` (
  `rel_detailsID` int(11) NOT NULL,
  `tblreleaseID` int(11) NOT NULL,
  `rel_orderReqID` int(11) NOT NULL,
  `rel_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrelease_details`
--

INSERT INTO `tblrelease_details` (`rel_detailsID`, `tblreleaseID`, `rel_orderReqID`, `rel_quantity`) VALUES
(1, 1, 5, 1),
(2, 2, 6, 3),
(3, 3, 3, 1),
(4, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplierID` int(11) NOT NULL,
  `supCompName` varchar(250) CHARACTER SET utf8 NOT NULL,
  `supCompAdd` varchar(100) CHARACTER SET utf8 NOT NULL,
  `supCompNum` varchar(20) CHARACTER SET utf8 NOT NULL,
  `supContactPerson` varchar(100) CHARACTER SET utf8 NOT NULL,
  `supPosition` varchar(45) CHARACTER SET utf8 NOT NULL,
  `supStatus` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplierID`, `supCompName`, `supCompAdd`, `supCompNum`, `supContactPerson`, `supPosition`, `supStatus`) VALUES
(15, 'FNCENT Trees and Woods Inc.', '1234 Bill Street Batasan Hills Quezon City', '+63 (124) 534-3414', 'Mr. Jung', 'Manager', 'Listed'),
(16, 'SMENT Fabrics and Prints', '111 Gangnamgu Seoul South Korea', '+63 (999) 414-5004', 'Lee Soo Man', 'Manager', 'Listed'),
(17, 'AA', '111 Resolution Rd. Batasan Hills Quezon City', '+63 (237) 642-9312', 'Mr. Lee', 'Manager', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblunitofmeasure`
--

CREATE TABLE `tblunitofmeasure` (
  `unID` int(11) NOT NULL,
  `unType` varchar(50) CHARACTER SET utf8 NOT NULL,
  `unUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `unStatus` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblunitofmeasure`
--

INSERT INTO `tblunitofmeasure` (`unID`, `unType`, `unUnit`, `unStatus`) VALUES
(14, 'Feet', 'ft', 'Active'),
(15, 'Meter', 'm', 'Active'),
(16, 'Gram', 'g', 'Active'),
(17, 'Inch', 'in', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblunitofmeasurement_category`
--

CREATE TABLE `tblunitofmeasurement_category` (
  `uncategoryID` int(11) NOT NULL,
  `uncategoryName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `uncategoryDescription` varchar(50) CHARACTER SET latin1 NOT NULL,
  `uncategoryStatus` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblunitofmeasurement_category`
--

INSERT INTO `tblunitofmeasurement_category` (`uncategoryID`, `uncategoryName`, `uncategoryDescription`, `uncategoryStatus`) VALUES
(0, 'Description', '', 'Hidden'),
(11, 'Length', ' Length', 'Active'),
(13, 'Area', ' ', 'Archived'),
(14, 'Weight', ' ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblunit_cat`
--

CREATE TABLE `tblunit_cat` (
  `unitcatID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `uncategoryID` int(11) NOT NULL,
  `unitcatStatus` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblunit_cat`
--

INSERT INTO `tblunit_cat` (`unitcatID`, `unitID`, `uncategoryID`, `unitcatStatus`) VALUES
(20, 16, 14, 'Active'),
(21, 17, 11, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userID` int(11) NOT NULL,
  `userName` varchar(80) CHARACTER SET utf8 NOT NULL,
  `userPassword` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userCustID` int(20) DEFAULT NULL,
  `userEmpID` int(11) DEFAULT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `userName`, `userPassword`, `userStatus`, `userType`, `userCustID`, `userEmpID`, `dateCreated`) VALUES
(1, 'eyembisi', 'admin', 'Active', 'admin', NULL, 1, '2017-08-24'),
(4, 'airaem', 'admin', 'active', 'customer', 19, NULL, '2017-08-27'),
(5, 'hongkaisoo', 'admin', 'active', 'customer', 31, NULL, '2017-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblvariant_detail`
--

CREATE TABLE `tblvariant_detail` (
  `variantDetailID` int(11) NOT NULL,
  `materialID` int(11) NOT NULL,
  `variantCounter` int(11) NOT NULL,
  `mat_varID` int(11) NOT NULL,
  `variantDetailStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblattributes`
--
ALTER TABLE `tblattributes`
  ADD PRIMARY KEY (`attributeID`);

--
-- Indexes for table `tblattribute_measure`
--
ALTER TABLE `tblattribute_measure`
  ADD PRIMARY KEY (`amID`),
  ADD KEY `attribute_idx` (`attributeID`),
  ADD KEY `unit_idx` (`uncategoryID`);

--
-- Indexes for table `tblbank_accounts`
--
ALTER TABLE `tblbank_accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `tblbranches`
--
ALTER TABLE `tblbranches`
  ADD PRIMARY KEY (`branchID`);

--
-- Indexes for table `tblcheck_details`
--
ALTER TABLE `tblcheck_details`
  ADD PRIMARY KEY (`check_detailsID`),
  ADD KEY `payDet_idx` (`p_detailsID`);

--
-- Indexes for table `tblcompany_info`
--
ALTER TABLE `tblcompany_info`
  ADD PRIMARY KEY (`comp_recID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `tblcustomize_request`
--
ALTER TABLE `tblcustomize_request`
  ADD PRIMARY KEY (`customizedID`),
  ADD KEY `accounttinfoID_idx` (`accountdetailsID`),
  ADD KEY `cstmfabric_idx` (`customFabricID`),
  ADD KEY `cstmframework_idx` (`customFrameID`);

--
-- Indexes for table `tblcust_req_images`
--
ALTER TABLE `tblcust_req_images`
  ADD PRIMARY KEY (`cust_req_imagesID`),
  ADD KEY `cust_req_ID_idx` (`cust_req_ID`);

--
-- Indexes for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`deliveryID`),
  ADD KEY `tblreleaseid_tbldelivery_idx` (`deliveryReleaseID`);

--
-- Indexes for table `tbldelivery_rates`
--
ALTER TABLE `tbldelivery_rates`
  ADD PRIMARY KEY (`delivery_rateID`),
  ADD KEY `fromBranch_idx` (`delBranchID`);

--
-- Indexes for table `tbldesign_phase`
--
ALTER TABLE `tbldesign_phase`
  ADD PRIMARY KEY (`d_phaseID`),
  ADD KEY `design_idx` (`p_design`),
  ADD KEY `phase_idx` (`d_phase`),
  ADD KEY `d_idx` (`p_design`);

--
-- Indexes for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  ADD PRIMARY KEY (`downpaymentID`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `tblemp_job`
--
ALTER TABLE `tblemp_job`
  ADD PRIMARY KEY (`emp_jobID`),
  ADD KEY `empName_idx` (`emp_empID`),
  ADD KEY `jobName_idx` (`emp_jobDescID`);

--
-- Indexes for table `tblfabrics`
--
ALTER TABLE `tblfabrics`
  ADD PRIMARY KEY (`fabricID`),
  ADD KEY `ftype_idx` (`fabricTypeID`),
  ADD KEY `fpattern_idx` (`fabricPatternID`);

--
-- Indexes for table `tblfabric_pattern`
--
ALTER TABLE `tblfabric_pattern`
  ADD PRIMARY KEY (`f_patternID`);

--
-- Indexes for table `tblfabric_texture`
--
ALTER TABLE `tblfabric_texture`
  ADD PRIMARY KEY (`textureID`);

--
-- Indexes for table `tblfabric_type`
--
ALTER TABLE `tblfabric_type`
  ADD PRIMARY KEY (`f_typeID`),
  ADD KEY `texture_idx` (`f_typeTextureID`);

--
-- Indexes for table `tblframeworks`
--
ALTER TABLE `tblframeworks`
  ADD PRIMARY KEY (`frameworkID`),
  ADD KEY `design_idx` (`framedesignID`),
  ADD KEY `material_idx` (`materialUsedID`),
  ADD KEY `furn_type_idx` (`frameworkFurnType`);

--
-- Indexes for table `tblframe_design`
--
ALTER TABLE `tblframe_design`
  ADD PRIMARY KEY (`designID`);

--
-- Indexes for table `tblframe_material`
--
ALTER TABLE `tblframe_material`
  ADD PRIMARY KEY (`materialID`);

--
-- Indexes for table `tblfurn_category`
--
ALTER TABLE `tblfurn_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `tblfurn_design`
--
ALTER TABLE `tblfurn_design`
  ADD PRIMARY KEY (`designID`);

--
-- Indexes for table `tblfurn_type`
--
ALTER TABLE `tblfurn_type`
  ADD PRIMARY KEY (`typeID`),
  ADD KEY `furn_category_idx` (`typeCategoryID`);

--
-- Indexes for table `tblinvoicedetails`
--
ALTER TABLE `tblinvoicedetails`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `orderinv_idx` (`invorderID`);

--
-- Indexes for table `tbljobs`
--
ALTER TABLE `tbljobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `user_idx` (`userID`);

--
-- Indexes for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  ADD PRIMARY KEY (`materialID`),
  ADD KEY `matType_idx` (`materialType`);

--
-- Indexes for table `tblmat_actions`
--
ALTER TABLE `tblmat_actions`
  ADD PRIMARY KEY (`mat_actionsID`),
  ADD KEY `matInventory_idx` (`mat_intID`);

--
-- Indexes for table `tblmat_deliveries`
--
ALTER TABLE `tblmat_deliveries`
  ADD PRIMARY KEY (`mat_deliveriesID`),
  ADD KEY `supplier_idx` (`supplierID`);

--
-- Indexes for table `tblmat_deliverydetails`
--
ALTER TABLE `tblmat_deliverydetails`
  ADD PRIMARY KEY (`del_detailsID`),
  ADD KEY `matDeliveries_idx` (`del_matDelID`),
  ADD KEY `matVarID_idx` (`del_matVarID`);

--
-- Indexes for table `tblmat_inventory`
--
ALTER TABLE `tblmat_inventory`
  ADD PRIMARY KEY (`mat_inventoryID`),
  ADD KEY `matVariant_idx` (`matVariantID`);

--
-- Indexes for table `tblmat_type`
--
ALTER TABLE `tblmat_type`
  ADD PRIMARY KEY (`matTypeID`);

--
-- Indexes for table `tblmat_var`
--
ALTER TABLE `tblmat_var`
  ADD PRIMARY KEY (`mat_varID`),
  ADD KEY `material_idx` (`materialID`);

--
-- Indexes for table `tblmodeofpayment`
--
ALTER TABLE `tblmodeofpayment`
  ADD PRIMARY KEY (`modeofpaymentID`);

--
-- Indexes for table `tblonhand`
--
ALTER TABLE `tblonhand`
  ADD PRIMARY KEY (`onHandID`),
  ADD KEY `product_idx` (`ohProdID`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `tlbuserID_idx` (`receivedbyUserID`),
  ADD KEY `tblcustID_idx` (`custOrderID`);

--
-- Indexes for table `tblorder_actions`
--
ALTER TABLE `tblorder_actions`
  ADD PRIMARY KEY (`orActionID`),
  ADD KEY `ordertbl_idx` (`orOrderID`);

--
-- Indexes for table `tblorder_customization`
--
ALTER TABLE `tblorder_customization`
  ADD PRIMARY KEY (`orCustID`,`orOrderReqID`),
  ADD KEY `orderReq_idx` (`orOrderReqID`),
  ADD KEY `fabricReq_idx` (`orFabricID`),
  ADD KEY `frameworkReq_idx` (`orFrameworkID`);

--
-- Indexes for table `tblorder_request`
--
ALTER TABLE `tblorder_request`
  ADD PRIMARY KEY (`order_requestID`),
  ADD KEY `prod_idx` (`orderProductID`),
  ADD KEY `order_idx` (`tblOrdersID`),
  ADD KEY `pack_idx` (`orderPackageID`);

--
-- Indexes for table `tblorder_return`
--
ALTER TABLE `tblorder_return`
  ADD PRIMARY KEY (`returnID`);

--
-- Indexes for table `tblorder_return_details`
--
ALTER TABLE `tblorder_return_details`
  ADD PRIMARY KEY (`rdetailsID`),
  ADD KEY `returntblid_idx` (`tblreturnID`);

--
-- Indexes for table `tblpackages`
--
ALTER TABLE `tblpackages`
  ADD PRIMARY KEY (`packageID`);

--
-- Indexes for table `tblpackage_inclusions`
--
ALTER TABLE `tblpackage_inclusions`
  ADD PRIMARY KEY (`package_inclusionID`),
  ADD KEY `prodID_idx` (`product_incID`),
  ADD KEY `packID_idx` (`package_incID`);

--
-- Indexes for table `tblpayment_details`
--
ALTER TABLE `tblpayment_details`
  ADD PRIMARY KEY (`payment_detailsID`),
  ADD KEY `mop_idx` (`mopID`),
  ADD KEY `invoice_idx` (`invID`);

--
-- Indexes for table `tblpenalty`
--
ALTER TABLE `tblpenalty`
  ADD PRIMARY KEY (`penaltyID`);

--
-- Indexes for table `tblphases`
--
ALTER TABLE `tblphases`
  ADD PRIMARY KEY (`phaseID`);

--
-- Indexes for table `tblprodsonpromo`
--
ALTER TABLE `tblprodsonpromo`
  ADD PRIMARY KEY (`onpromoID`),
  ADD KEY `prodsOnSale_idx` (`prodPromoID`),
  ADD KEY `promodescid_idx` (`promoDescID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `framworkcodeID_idx` (`prodFrameworkID`),
  ADD KEY `fabricodeID_idx` (`prodFabricID`),
  ADD KEY `type_idx` (`prodTypeID`),
  ADD KEY `categ_idx` (`prodCatID`);

--
-- Indexes for table `tblproduction`
--
ALTER TABLE `tblproduction`
  ADD PRIMARY KEY (`productionID`),
  ADD KEY `orReq_idx` (`productionOrderReq`);

--
-- Indexes for table `tblproduction_phase`
--
ALTER TABLE `tblproduction_phase`
  ADD PRIMARY KEY (`prodHistID`),
  ADD KEY `production_idx` (`prodID`),
  ADD KEY `phase_idx` (`prodPhase`),
  ADD KEY `employee_idx` (`prodEmp`);

--
-- Indexes for table `tblprod_images`
--
ALTER TABLE `tblprod_images`
  ADD PRIMARY KEY (`prodImageID`),
  ADD KEY `productinclusionID_idx` (`prodImgStatus`),
  ADD KEY `prodInfo_idx` (`prodImgID`);

--
-- Indexes for table `tblprod_info`
--
ALTER TABLE `tblprod_info`
  ADD PRIMARY KEY (`prodInfoID`),
  ADD KEY `prod_idx` (`prodInfoProduct`),
  ADD KEY `ph_idx` (`prodInfoPhase`);

--
-- Indexes for table `tblprod_materials`
--
ALTER TABLE `tblprod_materials`
  ADD PRIMARY KEY (`p_matID`),
  ADD KEY `prodInfo_idx` (`p_prodInfoID`),
  ADD KEY `p_mat_idx` (`p_matMaterialID`),
  ADD KEY `p_desc_idx` (`p_matDescID`);

--
-- Indexes for table `tblpromos`
--
ALTER TABLE `tblpromos`
  ADD PRIMARY KEY (`promoID`);

--
-- Indexes for table `tblpromo_condition`
--
ALTER TABLE `tblpromo_condition`
  ADD PRIMARY KEY (`conditionID`),
  ADD KEY `promo_idx` (`conPromoID`);

--
-- Indexes for table `tblpromo_promotion`
--
ALTER TABLE `tblpromo_promotion`
  ADD PRIMARY KEY (`promotionID`),
  ADD KEY `promo_idx` (`proPromoID`);

--
-- Indexes for table `tblrelease`
--
ALTER TABLE `tblrelease`
  ADD PRIMARY KEY (`releaseID`);

--
-- Indexes for table `tblrelease_details`
--
ALTER TABLE `tblrelease_details`
  ADD PRIMARY KEY (`rel_detailsID`),
  ADD KEY `tblreleaseid_tblreleasedetails_idx` (`tblreleaseID`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `tblunitofmeasure`
--
ALTER TABLE `tblunitofmeasure`
  ADD PRIMARY KEY (`unID`);

--
-- Indexes for table `tblunitofmeasurement_category`
--
ALTER TABLE `tblunitofmeasurement_category`
  ADD PRIMARY KEY (`uncategoryID`);

--
-- Indexes for table `tblunit_cat`
--
ALTER TABLE `tblunit_cat`
  ADD PRIMARY KEY (`unitcatID`),
  ADD KEY `unitID_idx` (`uncategoryID`),
  ADD KEY `uniofmeasureID_idx` (`unitID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userID`,`userName`),
  ADD KEY `cust_idx` (`userCustID`),
  ADD KEY `emp_idx` (`userEmpID`);

--
-- Indexes for table `tblvariant_detail`
--
ALTER TABLE `tblvariant_detail`
  ADD PRIMARY KEY (`variantDetailID`),
  ADD KEY `materialID` (`materialID`,`mat_varID`),
  ADD KEY `mat_varID` (`mat_varID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblattributes`
--
ALTER TABLE `tblattributes`
  MODIFY `attributeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblattribute_measure`
--
ALTER TABLE `tblattribute_measure`
  MODIFY `amID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblbank_accounts`
--
ALTER TABLE `tblbank_accounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblbranches`
--
ALTER TABLE `tblbranches`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblcheck_details`
--
ALTER TABLE `tblcheck_details`
  MODIFY `check_detailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcompany_info`
--
ALTER TABLE `tblcompany_info`
  MODIFY `comp_recID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tblcustomize_request`
--
ALTER TABLE `tblcustomize_request`
  MODIFY `customizedID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcust_req_images`
--
ALTER TABLE `tblcust_req_images`
  MODIFY `cust_req_imagesID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  MODIFY `deliveryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbldelivery_rates`
--
ALTER TABLE `tbldelivery_rates`
  MODIFY `delivery_rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbldesign_phase`
--
ALTER TABLE `tbldesign_phase`
  MODIFY `d_phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  MODIFY `downpaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblemp_job`
--
ALTER TABLE `tblemp_job`
  MODIFY `emp_jobID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfabrics`
--
ALTER TABLE `tblfabrics`
  MODIFY `fabricID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblfabric_pattern`
--
ALTER TABLE `tblfabric_pattern`
  MODIFY `f_patternID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblfabric_texture`
--
ALTER TABLE `tblfabric_texture`
  MODIFY `textureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblfabric_type`
--
ALTER TABLE `tblfabric_type`
  MODIFY `f_typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblframeworks`
--
ALTER TABLE `tblframeworks`
  MODIFY `frameworkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblframe_design`
--
ALTER TABLE `tblframe_design`
  MODIFY `designID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblframe_material`
--
ALTER TABLE `tblframe_material`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblfurn_category`
--
ALTER TABLE `tblfurn_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblfurn_design`
--
ALTER TABLE `tblfurn_design`
  MODIFY `designID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblfurn_type`
--
ALTER TABLE `tblfurn_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tblinvoicedetails`
--
ALTER TABLE `tblinvoicedetails`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbljobs`
--
ALTER TABLE `tbljobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblmat_actions`
--
ALTER TABLE `tblmat_actions`
  MODIFY `mat_actionsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmat_deliveries`
--
ALTER TABLE `tblmat_deliveries`
  MODIFY `mat_deliveriesID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmat_deliverydetails`
--
ALTER TABLE `tblmat_deliverydetails`
  MODIFY `del_detailsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmat_inventory`
--
ALTER TABLE `tblmat_inventory`
  MODIFY `mat_inventoryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmat_type`
--
ALTER TABLE `tblmat_type`
  MODIFY `matTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblmat_var`
--
ALTER TABLE `tblmat_var`
  MODIFY `mat_varID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;
--
-- AUTO_INCREMENT for table `tblmodeofpayment`
--
ALTER TABLE `tblmodeofpayment`
  MODIFY `modeofpaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblonhand`
--
ALTER TABLE `tblonhand`
  MODIFY `onHandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblorder_actions`
--
ALTER TABLE `tblorder_actions`
  MODIFY `orActionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblorder_customization`
--
ALTER TABLE `tblorder_customization`
  MODIFY `orCustID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_request`
--
ALTER TABLE `tblorder_request`
  MODIFY `order_requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblorder_return`
--
ALTER TABLE `tblorder_return`
  MODIFY `returnID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_return_details`
--
ALTER TABLE `tblorder_return_details`
  MODIFY `rdetailsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpackage_inclusions`
--
ALTER TABLE `tblpackage_inclusions`
  MODIFY `package_inclusionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpayment_details`
--
ALTER TABLE `tblpayment_details`
  MODIFY `payment_detailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblpenalty`
--
ALTER TABLE `tblpenalty`
  MODIFY `penaltyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblphases`
--
ALTER TABLE `tblphases`
  MODIFY `phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblprodsonpromo`
--
ALTER TABLE `tblprodsonpromo`
  MODIFY `onpromoID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblproduction`
--
ALTER TABLE `tblproduction`
  MODIFY `productionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tblproduction_phase`
--
ALTER TABLE `tblproduction_phase`
  MODIFY `prodHistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `tblprod_images`
--
ALTER TABLE `tblprod_images`
  MODIFY `prodImageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblprod_info`
--
ALTER TABLE `tblprod_info`
  MODIFY `prodInfoID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblprod_materials`
--
ALTER TABLE `tblprod_materials`
  MODIFY `p_matID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpromos`
--
ALTER TABLE `tblpromos`
  MODIFY `promoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblpromo_condition`
--
ALTER TABLE `tblpromo_condition`
  MODIFY `conditionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblpromo_promotion`
--
ALTER TABLE `tblpromo_promotion`
  MODIFY `promotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblrelease`
--
ALTER TABLE `tblrelease`
  MODIFY `releaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblrelease_details`
--
ALTER TABLE `tblrelease_details`
  MODIFY `rel_detailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tblunitofmeasure`
--
ALTER TABLE `tblunitofmeasure`
  MODIFY `unID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tblunitofmeasurement_category`
--
ALTER TABLE `tblunitofmeasurement_category`
  MODIFY `uncategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblunit_cat`
--
ALTER TABLE `tblunit_cat`
  MODIFY `unitcatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblattribute_measure`
--
ALTER TABLE `tblattribute_measure`
  ADD CONSTRAINT `attribute` FOREIGN KEY (`attributeID`) REFERENCES `tblattributes` (`attributeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit` FOREIGN KEY (`uncategoryID`) REFERENCES `tblunitofmeasurement_category` (`uncategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcheck_details`
--
ALTER TABLE `tblcheck_details`
  ADD CONSTRAINT `payDet` FOREIGN KEY (`p_detailsID`) REFERENCES `tblpayment_details` (`payment_detailsID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcustomize_request`
--
ALTER TABLE `tblcustomize_request`
  ADD CONSTRAINT `cstmUser` FOREIGN KEY (`accountdetailsID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cstmfabric` FOREIGN KEY (`customFabricID`) REFERENCES `tblfabrics` (`fabricID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cstmframework` FOREIGN KEY (`customFrameID`) REFERENCES `tblframeworks` (`frameworkID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcust_req_images`
--
ALTER TABLE `tblcust_req_images`
  ADD CONSTRAINT `cust_req_ID` FOREIGN KEY (`cust_req_ID`) REFERENCES `tblcustomize_request` (`customizedID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD CONSTRAINT `tblreleaseid_tbldelivery` FOREIGN KEY (`deliveryReleaseID`) REFERENCES `tblrelease` (`releaseID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbldelivery_rates`
--
ALTER TABLE `tbldelivery_rates`
  ADD CONSTRAINT `fromBranch` FOREIGN KEY (`delBranchID`) REFERENCES `tblbranches` (`branchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldesign_phase`
--
ALTER TABLE `tbldesign_phase`
  ADD CONSTRAINT `d` FOREIGN KEY (`p_design`) REFERENCES `tblfurn_design` (`designID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p` FOREIGN KEY (`d_phase`) REFERENCES `tblphases` (`phaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblemp_job`
--
ALTER TABLE `tblemp_job`
  ADD CONSTRAINT `empName` FOREIGN KEY (`emp_empID`) REFERENCES `tblemployee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobName` FOREIGN KEY (`emp_jobDescID`) REFERENCES `tbljobs` (`jobID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfabrics`
--
ALTER TABLE `tblfabrics`
  ADD CONSTRAINT `fabric_type` FOREIGN KEY (`fabricTypeID`) REFERENCES `tblfabric_type` (`f_typeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pattern` FOREIGN KEY (`fabricPatternID`) REFERENCES `tblfabric_pattern` (`f_patternID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfabric_type`
--
ALTER TABLE `tblfabric_type`
  ADD CONSTRAINT `texture` FOREIGN KEY (`f_typeTextureID`) REFERENCES `tblfabric_texture` (`textureID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblframeworks`
--
ALTER TABLE `tblframeworks`
  ADD CONSTRAINT `design` FOREIGN KEY (`framedesignID`) REFERENCES `tblframe_design` (`designID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `furn_type` FOREIGN KEY (`frameworkFurnType`) REFERENCES `tblfurn_type` (`typeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material` FOREIGN KEY (`materialUsedID`) REFERENCES `tblframe_material` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfurn_type`
--
ALTER TABLE `tblfurn_type`
  ADD CONSTRAINT `furn_category` FOREIGN KEY (`typeCategoryID`) REFERENCES `tblfurn_category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblinvoicedetails`
--
ALTER TABLE `tblinvoicedetails`
  ADD CONSTRAINT `orderinv` FOREIGN KEY (`invorderID`) REFERENCES `tblorders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  ADD CONSTRAINT `matType` FOREIGN KEY (`materialType`) REFERENCES `tblmat_type` (`matTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblmat_actions`
--
ALTER TABLE `tblmat_actions`
  ADD CONSTRAINT `matInventory` FOREIGN KEY (`mat_intID`) REFERENCES `tblmat_inventory` (`mat_inventoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblmat_deliveries`
--
ALTER TABLE `tblmat_deliveries`
  ADD CONSTRAINT `supplier` FOREIGN KEY (`supplierID`) REFERENCES `tblsupplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblmat_var`
--
ALTER TABLE `tblmat_var`
  ADD CONSTRAINT `m` FOREIGN KEY (`materialID`) REFERENCES `tblmaterials` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2017 at 05:10 PM
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
  `attributeName` varchar(150) NOT NULL,
  `attributeStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattributes`
--

INSERT INTO `tblattributes` (`attributeID`, `attributeName`, `attributeStatus`) VALUES
(2, 'Color', 'Active'),
(3, 'Pattern', 'Archived'),
(5, 'Name', 'Archived'),
(6, 'Type', 'Active'),
(7, 'Size', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblattribute_measure`
--

CREATE TABLE `tblattribute_measure` (
  `amID` int(11) NOT NULL,
  `attributeID` int(11) NOT NULL,
  `uncategoryID` int(11) NOT NULL,
  `amStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattribute_measure`
--

INSERT INTO `tblattribute_measure` (`amID`, `attributeID`, `uncategoryID`, `amStatus`) VALUES
(1, 7, 1, 'Active'),
(2, 7, 2, 'Active'),
(3, 7, 6, 'Active'),
(4, 6, 0, 'Active'),
(5, 7, 1, 'Active'),
(6, 7, 2, 'Active'),
(7, 7, 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblbank_accounts`
--

CREATE TABLE `tblbank_accounts` (
  `accountID` int(11) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `accountNumber` varchar(50) NOT NULL,
  `accountStatus` varchar(45) NOT NULL,
  `accountRemarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranches`
--

CREATE TABLE `tblbranches` (
  `branchID` int(11) NOT NULL,
  `branchLocation` varchar(45) NOT NULL,
  `branchAddress` varchar(80) NOT NULL,
  `branchRemarks` varchar(100) DEFAULT NULL,
  `branchStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbranches`
--

INSERT INTO `tblbranches` (`branchID`, `branchLocation`, `branchAddress`, `branchRemarks`, `branchStatus`) VALUES
(1, 'Silang', '#123 Silang Cavite', 'Second Extension', 'Listed'),
(2, 'Bacoor City', '#442 Talaba II ', 'Main Store', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblcheck_details`
--

CREATE TABLE `tblcheck_details` (
  `check_detailsID` int(11) NOT NULL,
  `p_detailsID` int(11) NOT NULL,
  `checkNumber` int(11) NOT NULL,
  `checkAmount` decimal(5,2) NOT NULL,
  `checkRemarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany_info`
--

CREATE TABLE `tblcompany_info` (
  `comp_recID` int(11) NOT NULL,
  `comp_logo` varchar(450) NOT NULL,
  `comp_name` varchar(150) NOT NULL,
  `comp_num` int(11) NOT NULL,
  `comp_address` varchar(150) NOT NULL,
  `comp_about` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany_info`
--

INSERT INTO `tblcompany_info` (`comp_recID`, `comp_logo`, `comp_name`, `comp_num`, `comp_address`, `comp_about`) VALUES
(1, 'filipiniana-furniture-logo.png', 'Filipiniana Furnitures', 2147483647, '#123 Bacoor Cavite', 'A furniture shop');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `customerID` int(11) NOT NULL,
  `customerFirstName` varchar(45) NOT NULL,
  `customerMiddleName` varchar(45) DEFAULT NULL,
  `customerLastName` varchar(45) NOT NULL,
  `customerAddress` varchar(100) NOT NULL,
  `customerContactNum` varchar(45) NOT NULL,
  `customerEmail` varchar(80) NOT NULL,
  `customerStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`customerID`, `customerFirstName`, `customerMiddleName`, `customerLastName`, `customerAddress`, `customerContactNum`, `customerEmail`, `customerStatus`) VALUES
(1, 'Na', 'Oh', 'Cor', '#1635 HAHAHAHA ', '0982376338', 'hongkaira@gmail.com', 'Active'),
(2, 'May', 'Rhodora', 'Barrameda', '#1234 BHQC', '09994145004', 'hongkaira@yahoo.com', 'Active'),
(3, 'May', 'Rhodora', 'Barrameda', '#1234 BHQC', '09994145004', 'hongkaira@yahoo.com', 'Active'),
(4, 'May', 'Rhodora', 'Barrameda', '#1234 BHQC', '09994145004', 'hongkaira@yahoo.com', 'Active'),
(5, 'May', 'Rhodora', 'Barrameda', '#1234 BHQC', '09994145004', 'hongkaira@yahoo.com', 'Active'),
(6, '', 'Daniel', 'Padilla', '#1234 Street Name, Brgy. Anuna QC', '09994145004', 'hongkaira@gmail.com', 'Active'),
(7, '', 'Kathryn', 'Bernardo', '#123 Street Brgy Anuna QC', '0921458475', 'eyembisi@yahoo.com', 'Active'),
(8, 'A', 'A', 'A', 'a', '989872', 'hongkaira@gmail.com', 'Active'),
(9, '', 'Lauro', 'Pabalan', '', '09998563123178', 'lala@lala.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomize_request`
--

CREATE TABLE `tblcustomize_request` (
  `customizedID` int(11) NOT NULL,
  `customizedPic` varchar(45) DEFAULT NULL,
  `customizedDescription` varchar(250) NOT NULL,
  `accountdetailsID` int(11) NOT NULL,
  `customFrameID` int(11) DEFAULT NULL,
  `customFabricID` int(11) DEFAULT NULL,
  `customStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcust_req_images`
--

CREATE TABLE `tblcust_req_images` (
  `cust_req_imagesID` int(11) NOT NULL,
  `cust_req_ID` int(11) NOT NULL,
  `cust_req_images` varchar(100) NOT NULL,
  `cust_req_imageStat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `deliveryID` int(11) NOT NULL,
  `deliveryOrdReq` int(11) NOT NULL,
  `deliveryEmpAssigned` int(11) DEFAULT NULL,
  `deliveryStatus` varchar(45) NOT NULL,
  `deliveryRecStatus` varchar(45) NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `deliveryRemarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery_rates`
--

CREATE TABLE `tbldelivery_rates` (
  `delivery_rateID` int(11) NOT NULL,
  `delBranchID` int(11) NOT NULL,
  `delLocation` varchar(100) NOT NULL,
  `delRateType` varchar(45) NOT NULL,
  `delRate` varchar(45) NOT NULL,
  `delRateStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldelivery_rates`
--

INSERT INTO `tbldelivery_rates` (`delivery_rateID`, `delBranchID`, `delLocation`, `delRateType`, `delRate`, `delRateStatus`) VALUES
(1, 2, 'Manila', 'Amount', '999.99', 'Listed'),
(2, 1, 'Visayas', 'Percentage', '5.00', 'Listed'),
(3, 1, 'Cavite', 'Amount', '1000', 'Listed'),
(4, 2, 'Cotabato City', 'Percentage', '5', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tbldesign_phase`
--

CREATE TABLE `tbldesign_phase` (
  `d_phaseID` int(11) NOT NULL,
  `p_design` int(11) NOT NULL,
  `d_phase` int(11) NOT NULL,
  `d_phaseStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldesign_phase`
--

INSERT INTO `tbldesign_phase` (`d_phaseID`, `p_design`, `d_phase`, `d_phaseStatus`) VALUES
(1, 2, 1, 'Active'),
(2, 2, 2, 'Active'),
(3, 2, 3, 'Archived'),
(4, 2, 4, 'Archived'),
(5, 2, 5, 'Active'),
(6, 1, 1, 'Active'),
(7, 1, 2, 'Active'),
(8, 1, 3, 'Archived'),
(9, 1, 4, 'Archived'),
(10, 1, 5, 'Active'),
(11, 1, 6, 'Active'),
(12, 3, 1, 'Active'),
(13, 3, 2, 'Active'),
(14, 3, 3, 'Active'),
(15, 3, 4, 'Active'),
(16, 3, 5, 'Active'),
(17, 3, 6, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbldownpayment`
--

CREATE TABLE `tbldownpayment` (
  `downpaymentID` int(11) NOT NULL,
  `downpaymentPercentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldownpayment`
--

INSERT INTO `tbldownpayment` (`downpaymentID`, `downpaymentPercentage`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `empID` int(11) NOT NULL,
  `empFirstName` varchar(45) NOT NULL,
  `empLastName` varchar(45) NOT NULL,
  `empMidName` varchar(45) DEFAULT NULL,
  `empJobID` int(11) NOT NULL,
  `empRemarks` varchar(100) NOT NULL,
  `empStatus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`empID`, `empFirstName`, `empLastName`, `empMidName`, `empJobID`, `empRemarks`, `empStatus`) VALUES
(1, 'Aira', 'Lee', 'Marie', 2, 'Good job', 'Active'),
(2, 'Lee', 'Ki', 'Hong', 4, 'La', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabrics`
--

CREATE TABLE `tblfabrics` (
  `fabricID` int(11) NOT NULL,
  `fabricName` varchar(45) NOT NULL,
  `fabricTypeID` int(11) NOT NULL,
  `fabricPatternID` int(11) NOT NULL,
  `fabricColor` varchar(255) NOT NULL,
  `fabricRemarks` varchar(100) DEFAULT NULL,
  `fabricPic` varchar(100) DEFAULT NULL,
  `fabricStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfabrics`
--

INSERT INTO `tblfabrics` (`fabricID`, `fabricName`, `fabricTypeID`, `fabricPatternID`, `fabricColor`, `fabricRemarks`, `fabricPic`, `fabricStatus`) VALUES
(1, 'Gold Rand', 2, 1, '#ffffff', '', 'image', 'Listed'),
(2, 'Crimson Sky', 1, 1, '#8c0606', ' ', '', 'Listed'),
(3, 'Test', 1, 1, '#000000,#2eb715,#00e8e8', ' ', '', 'Listed'),
(4, 'Bru', 1, 1, '#3555d2,#c6da34', ' Talaga ba?', 'chair1.png', 'Archived'),
(5, 'gfghjfdeh1qhi', 3, 3, '#000000,#000000,#000000,#000000,#000000,#000000,#000000,#000000', ' ', '', 'Archived'),
(6, 'Roosevelt', 3, 3, '#000000,#be11cc', ' Haha', 'DD7jGryU0AA37lQ.jpg', 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_pattern`
--

CREATE TABLE `tblfabric_pattern` (
  `f_patternID` int(11) NOT NULL,
  `f_patternName` varchar(45) NOT NULL,
  `f_patternRemarks` varchar(100) DEFAULT NULL,
  `f_patternStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfabric_pattern`
--

INSERT INTO `tblfabric_pattern` (`f_patternID`, `f_patternName`, `f_patternRemarks`, `f_patternStatus`) VALUES
(1, 'Ikat', 'Leaves', 'Listed'),
(2, 'Geometric', 'Anuna', 'Archived'),
(3, 'Diamonds', 'Diamonds', 'Listed'),
(4, '', '', 'Archived'),
(5, 'Geometrical', 'Circles', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_texture`
--

CREATE TABLE `tblfabric_texture` (
  `textureID` int(11) NOT NULL,
  `textureName` varchar(45) NOT NULL,
  `textureDescription` varchar(100) DEFAULT NULL,
  `textureStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfabric_texture`
--

INSERT INTO `tblfabric_texture` (`textureID`, `textureName`, `textureDescription`, `textureStatus`) VALUES
(1, 'New Texture', 'Good One', 'Archived'),
(2, 'Nice Texture', '', 'Archived'),
(3, 'New----', 'Bes', 'Archived'),
(4, 'New', 'New Texture', 'Listed'),
(5, 'sdjhsjkd', 'kjsdhkajh', 'Archived'),
(6, 'Silky', 'Silky Texture', 'Listed'),
(7, 'Hello!@#$%^&*&^%$#@', '', 'Archived'),
(8, '"425trw8wef"', '', 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `tblfabric_type`
--

CREATE TABLE `tblfabric_type` (
  `f_typeID` int(11) NOT NULL,
  `f_typeName` varchar(50) NOT NULL,
  `f_typeWeaves` varchar(100) DEFAULT NULL,
  `f_typeTextureID` int(11) NOT NULL,
  `f_typeStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfabric_type`
--

INSERT INTO `tblfabric_type` (`f_typeID`, `f_typeName`, `f_typeWeaves`, `f_typeTextureID`, `f_typeStatus`) VALUES
(1, 'Leather', 'Compact-weaved', 4, 'Listed'),
(2, 'Cotton', 'Softly-weaved', 4, 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblframeworks`
--

CREATE TABLE `tblframeworks` (
  `frameworkID` int(11) NOT NULL,
  `frameworkFurnType` int(11) NOT NULL,
  `frameworkName` varchar(45) NOT NULL,
  `frameworkPic` varchar(255) NOT NULL,
  `framedesignID` int(11) NOT NULL,
  `materialUsedID` int(11) NOT NULL,
  `frameworkRemarks` varchar(100) DEFAULT NULL,
  `frameworkStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblframeworks`
--

INSERT INTO `tblframeworks` (`frameworkID`, `frameworkFurnType`, `frameworkName`, `frameworkPic`, `framedesignID`, `materialUsedID`, `frameworkRemarks`, `frameworkStatus`) VALUES
(1, 0, 'Classical Victorian Frame', '', 3, 1, ' Bru', 'Archived'),
(2, 0, 'Classical Victorian Frame', '', 1, 1, ' Bru', 'Archived'),
(4, 1, 'Diamond', 'chair6.png', 3, 5, 'Checkered Victorian Classic', 'Listed'),
(5, 0, 'Floral Frame', 'chair2.png', 3, 4, 'A victorian classic floral frame', 'Listed'),
(6, 0, 'Frame2', 'DD-NGPiUwAE6ANZ.jpg', 1, 4, ' Lol', 'Archived'),
(7, 0, 'Lol', '', 1, 1, ' Anuna', 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `tblframe_design`
--

CREATE TABLE `tblframe_design` (
  `designID` int(11) NOT NULL,
  `designName` varchar(45) NOT NULL,
  `designDescription` varchar(250) DEFAULT NULL,
  `designStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblframe_design`
--

INSERT INTO `tblframe_design` (`designID`, `designName`, `designDescription`, `designStatus`) VALUES
(1, 'New Frame', 'Dont leave this empty', 'Listed'),
(2, 'A Frame', 'A nice frame', 'Listed'),
(3, 'Victorian Classic', ' Heavy detailed design', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblframe_material`
--

CREATE TABLE `tblframe_material` (
  `materialID` int(11) NOT NULL,
  `materialName` varchar(45) NOT NULL,
  `materialRemarks` varchar(100) DEFAULT NULL,
  `materialStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblframe_material`
--

INSERT INTO `tblframe_material` (`materialID`, `materialName`, `materialRemarks`, `materialStatus`) VALUES
(1, 'Narra Wood', ' Narra', 'Listed'),
(2, 'Anu', ' Lul', 'Archived'),
(3, 'Nail', ' Description,Size', 'Archived'),
(4, 'Mahogany Wood', ' Wood', 'Listed'),
(5, 'Bamboo Wood', ' Bamboo', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblfurn_category`
--

CREATE TABLE `tblfurn_category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryStatus` varchar(45) NOT NULL,
  `categoryRemarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfurn_category`
--

INSERT INTO `tblfurn_category` (`categoryID`, `categoryName`, `categoryStatus`, `categoryRemarks`) VALUES
(1, 'Living Area', 'Listed', 'Sala'),
(2, 'Bed Room', 'Archived', 'Sleeping Area'),
(3, 'Dining Area', 'Listed', ' Kainan'),
(4, 'Bedroom', 'Listed', 'Tulugan'),
(5, 'Kitchen', 'Listed', ' Kusina');

-- --------------------------------------------------------

--
-- Table structure for table `tblfurn_design`
--

CREATE TABLE `tblfurn_design` (
  `designID` int(11) NOT NULL,
  `designName` varchar(45) NOT NULL,
  `designStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `typeName` varchar(45) NOT NULL,
  `typeDescription` varchar(100) DEFAULT NULL,
  `typeStatus` varchar(45) NOT NULL,
  `typeCategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfurn_type`
--

INSERT INTO `tblfurn_type` (`typeID`, `typeName`, `typeDescription`, `typeStatus`, `typeCategoryID`) VALUES
(1, 'Divan', 'Higaan sa Salad', 'Listed', 1),
(2, 'Pls', 'Ajejejej', 'Archived', 3),
(3, 'Dining Table', ' Hapag-kainan', 'Listed', 3),
(4, 'Chair', ' ', 'Listed', 3),
(5, 'Hi-Chair', ' ', 'Listed', 3),
(6, 'Bed', ' ', 'Listed', 4),
(7, 'Side-Table', ' Table beside the bed', 'Listed', 4),
(8, 'Rocking Chair', ' ', 'Listed', 1),
(9, 'Cabinet', ' ', 'Listed', 1),
(10, 'Cabinett', ' ', 'Archived', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory_logs`
--

CREATE TABLE `tblinventory_logs` (
  `inLogID` int(11) NOT NULL,
  `inLogDescription` varchar(450) NOT NULL,
  `inLogDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblinventory_logs`
--

INSERT INTO `tblinventory_logs` (`inLogID`, `inLogDescription`, `inLogDate`) VALUES
(1, 'FNC Ent supplied 250 pcs of YON! ', '2017-05-19'),
(2, 'FNC Ent supplied 0 pcs of Lily,Red,Black,Cotton', '2017-05-19'),
(3, 'FNC Ent supplied 20 pcs of Lily,Red,Black,Cotton', '2017-05-19'),
(4, 'FNC Ent supplied 125 pcs of ', '2017-05-19'),
(5, 'FNC Ent supplied 100 pcs of ', '2017-05-19'),
(6, 'FNC Ent supplied 200 pcs of Lily,Red,Black,Cotton Fabric', '2017-05-19'),
(7, ' supplied 0 pcs of Lily,Red,Black,Cotton Fabric', '2017-05-19'),
(8, 'Deducted 50 pcs of Lily,Red,Black,Cotton Fabric. Missing.', '2017-05-19'),
(9, 'Deducted 5 pcs of Lily,Red,Black,Cotton Fabric. Pull-Out.', '2017-05-19'),
(10, 'FNC Ent supplied 2500 pcs of Ruby, Red Fabric', '2017-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoicedetails`
--

CREATE TABLE `tblinvoicedetails` (
  `invoiceID` int(11) NOT NULL,
  `invorderID` int(11) NOT NULL,
  `balance` double NOT NULL,
  `dateIssued` date NOT NULL,
  `invoiceStatus` varchar(45) NOT NULL,
  `invoiceRemarks` varchar(250) DEFAULT NULL,
  `invDelrateID` int(11) DEFAULT NULL,
  `invPenID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblinvoicedetails`
--

INSERT INTO `tblinvoicedetails` (`invoiceID`, `invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES
(5, 22, 999.99, '2017-07-31', 'Pending', 'Initial Invoice', 1, 1),
(6, 23, 240000, '2017-07-31', 'Pending', 'Initial Invoice', 1, 1),
(7, 25, 190000, '2017-08-01', 'Pending', 'Initial Invoice', 1, 1),
(8, 26, 260000, '2017-08-01', 'Pending', 'Initial Invoice', 1, 1),
(9, 27, 50000, '2017-08-02', 'Pending', 'Initial Invoice', 1, 1),
(10, 28, 120000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(11, 29, 180000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(12, 30, 180000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(13, 31, 180000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(14, 32, 120000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(15, 33, 120000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(16, 34, 60000, '2017-08-03', 'Pending', 'Initial Invoice', 1, 1),
(17, 35, 180000, '2017-08-04', 'Pending', 'Initial Invoice', 1, 1),
(18, 41, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(19, 42, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(20, 43, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(21, 44, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(22, 45, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(23, 46, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(24, 47, 120000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1),
(25, 48, 60000, '2017-08-09', 'Pending', 'Initial Invoice', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbljobs`
--

CREATE TABLE `tbljobs` (
  `jobID` int(11) NOT NULL,
  `jobName` varchar(45) NOT NULL,
  `jobDescription` varchar(100) DEFAULT NULL,
  `jobStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbljobs`
--

INSERT INTO `tbljobs` (`jobID`, `jobName`, `jobDescription`, `jobStatus`) VALUES
(1, 'Nails', 'Pako ', 'Archived'),
(2, 'Carver', 'Carves', 'Listed'),
(3, 'test', 'ok', 'Archived'),
(4, 'Carpentry', 'Upholstered', 'Listed'),
(5, 'Cashier', 'Cashier', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `logID` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `action` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(450) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterials`
--

CREATE TABLE `tblmaterials` (
  `materialID` int(11) NOT NULL,
  `materialType` varchar(150) DEFAULT NULL,
  `materialName` varchar(45) NOT NULL,
  `materialMeasurement` varchar(450) NOT NULL,
  `materialStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmaterials`
--

INSERT INTO `tblmaterials` (`materialID`, `materialType`, `materialName`, `materialMeasurement`, `materialStatus`) VALUES
(1, '3', 'Water-Based', '', 'Listed'),
(2, '3', 'Acrilyc', '', 'Archived'),
(3, '5', 'Clear', '5', 'Listed'),
(4, '2', 'Cotton', '2,3,4', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_attribs`
--

CREATE TABLE `tblmat_attribs` (
  `mat_attribsID` int(11) NOT NULL,
  `matID` int(11) NOT NULL,
  `attribID` varchar(150) NOT NULL,
  `mat_attribStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmat_attribs`
--

INSERT INTO `tblmat_attribs` (`mat_attribsID`, `matID`, `attribID`, `mat_attribStatus`) VALUES
(1, 1, '2', 'Active'),
(2, 3, '1', 'Active'),
(3, 3, '2', 'Active'),
(4, 4, '1', 'Active'),
(5, 4, '2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_type`
--

CREATE TABLE `tblmat_type` (
  `matTypeID` int(11) NOT NULL,
  `matTypeName` varchar(450) NOT NULL,
  `matTypeMeasure` varchar(450) NOT NULL,
  `matTypeRemarks` varchar(45) DEFAULT NULL,
  `matTypeStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmat_type`
--

INSERT INTO `tblmat_type` (`matTypeID`, `matTypeName`, `matTypeMeasure`, `matTypeRemarks`, `matTypeStatus`) VALUES
(1, 'Nail', '', 'Pako', 'Archived'),
(2, 'Fabric', 'Length,Width,Height', 'Tela ', 'Listed'),
(3, 'Paint ', 'Liters', 'Pintura', 'Listed'),
(4, 'Wood ', 'Length,Width,Height', 'Kahoy', 'Listed'),
(5, 'Varnish', 'Liters', 'Barnis', 'Listed'),
(6, 'Sample', 'Sample', 'Sample', 'Archived'),
(7, 'Rattan ', 'Length,Yards', 'For weaved', 'Listed'),
(8, 'Pintura', '', 'HAHAHA', 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblmat_var`
--

CREATE TABLE `tblmat_var` (
  `variantID` int(11) NOT NULL,
  `mat_varID` int(11) NOT NULL,
  `variantQuantity` int(11) DEFAULT NULL,
  `variantMeasurement` varchar(45) NOT NULL,
  `variantRemarks` varchar(250) DEFAULT NULL,
  `variantStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmat_var`
--

INSERT INTO `tblmat_var` (`variantID`, `mat_varID`, `variantQuantity`, `variantMeasurement`, `variantRemarks`, `variantStatus`) VALUES
(1, 1, 0, '', NULL, 'Listed'),
(2, 1, 0, '', NULL, 'Listed'),
(3, 3, 0, '', NULL, 'Listed'),
(4, 3, 0, '', NULL, 'Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodeofpayment`
--

CREATE TABLE `tblmodeofpayment` (
  `modeofpaymentID` int(11) NOT NULL,
  `modeofpaymentDesc` varchar(45) NOT NULL,
  `modeofpaymentStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `ohRemarks` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblonhand`
--

INSERT INTO `tblonhand` (`onHandID`, `ohProdID`, `ohQuantity`, `ohRemarks`) VALUES
(1, 9, 6, NULL);

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
  `orderStatus` varchar(45) NOT NULL,
  `shippingAddress` varchar(45) DEFAULT NULL,
  `orderType` varchar(45) NOT NULL,
  `orderRemarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`orderID`, `receivedbyUserID`, `dateOfReceived`, `dateOfRelease`, `custOrderID`, `orderPrice`, `orderStatus`, `shippingAddress`, `orderType`, `orderRemarks`) VALUES
(8, NULL, '2017-07-31', '2017-08-05', 1, 330000, 'Archived', '', 'Pre-Order', 'This is a remark'),
(9, NULL, '2017-07-31', '2017-08-17', 1, 290000, 'Archived', '', 'Pre-Order', 'Remark'),
(10, NULL, '2017-07-31', '2017-08-17', 1, 290000, 'Archived', '', 'Pre-Order', 'Remark'),
(11, NULL, '2017-07-31', '2017-08-17', 1, 290000, 'Archived', '', 'Pre-Order', 'Remark'),
(12, NULL, '2017-07-31', '2017-08-17', 1, 290000, 'Archived', '', 'Pre-Order', 'Remark'),
(13, NULL, '2017-07-31', '2017-08-17', 1, 290000, 'Archived', '', 'Pre-Order', 'Remark'),
(14, NULL, '2017-07-31', '2017-07-20', 2, 290000, 'Archived', '', 'Pre-Order', 'Anu'),
(15, NULL, '2017-07-31', '2017-07-20', 3, 290000, 'Archived', '', 'Pre-Order', 'Anu'),
(16, NULL, '2017-07-31', '2017-07-20', 4, 290000, 'Archived', '', 'Pre-Order', 'Anu'),
(17, NULL, '2017-07-31', '2017-07-20', 5, 290000, 'Archived', '', 'Pre-Order', 'Anu'),
(18, NULL, '2017-07-31', '2017-08-24', 1, 380000, 'Archived', '', 'Pre-Order', 'A remark'),
(19, NULL, '2017-07-31', '2017-08-31', 1, 240000, 'Archived', '', 'Pre-Order', 'A remark'),
(20, NULL, '2017-07-31', '2017-08-31', 1, 240000, 'Archived', '', 'Pre-Order', 'A remark'),
(21, NULL, '2017-07-31', '2017-08-31', 1, 240000, 'Archived', '', 'Pre-Order', 'A remark'),
(22, NULL, '2017-07-31', '2017-08-31', 1, 240000, 'Cancelled', '', 'Pre-Order', ''),
(23, NULL, '2017-07-31', '2017-08-31', 1, 360000, 'Pending', '', 'Pre-Order', 'A remark'),
(24, NULL, '2017-08-01', '2017-08-17', 2, 480000, 'Pending', '', 'Pre-Order', NULL),
(25, NULL, '2017-08-01', '2017-08-24', 6, 190000, 'Pending', '', 'Pre-Order', 'A remark'),
(26, NULL, '2017-08-01', '2017-08-17', 7, 260000, 'Pending', '', 'Pre-Order', 'A remark'),
(27, NULL, '2017-08-02', '2017-08-31', 2, 50000, 'Pending', '', 'Pre-Order', 'A remark'),
(28, NULL, '2017-08-03', '2017-08-23', 3, 120000, 'Pending', '', 'Pre-Order', 'Remark'),
(29, NULL, '2017-08-03', '2017-08-25', 8, 180000, 'Cancelled', '', 'Pre-Order', 'No reason.'),
(30, NULL, '2017-08-03', '2017-08-17', 8, 180000, 'Cancelled', '', 'Pre-Order', ''),
(31, NULL, '2017-08-03', '2017-08-17', 8, 180000, 'Pending', '', 'Pre-Order', 'A remark'),
(32, NULL, '2017-08-03', '2017-08-24', 8, 120000, 'Pending', '', 'Pre-Order', 'A remark'),
(33, NULL, '2017-08-03', '2017-08-24', 8, 120000, 'Pending', '', 'Pre-Order', 'A remark'),
(34, NULL, '2017-08-03', '2017-08-24', 1, 60000, 'Pending', '', 'Pre-Order', 'Somebody let me know'),
(35, NULL, '2017-08-04', '2017-08-18', 1, 180000, 'Rejected', '', 'Pre-Order', 'No reason.'),
(36, NULL, '2017-08-04', '2017-08-31', 1, 25000, 'Pending', ', , ', 'Pre-order', ''),
(41, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(42, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(43, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(44, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(45, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(46, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(47, NULL, '2017-08-09', '2017-08-25', 7, 120000, 'Pending', 'Array', 'Pre-Order', 'A REMARK'),
(48, NULL, '2017-08-09', '2017-08-24', 9, 60000, 'Pending', '', 'Pre-Order', 'A remarks');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_actions`
--

CREATE TABLE `tblorder_actions` (
  `orActionID` int(11) NOT NULL,
  `orOrderID` int(11) NOT NULL,
  `orAction` varchar(450) NOT NULL,
  `orDescription` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_customization`
--

CREATE TABLE `tblorder_customization` (
  `orCustID` int(11) NOT NULL,
  `orOrderReqID` int(11) NOT NULL,
  `orFabricID` int(11) DEFAULT NULL,
  `orFrameworkID` int(11) DEFAULT NULL,
  `orSizeSpecs` varchar(150) DEFAULT NULL,
  `orDescription` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_request`
--

CREATE TABLE `tblorder_request` (
  `order_requestID` int(11) NOT NULL,
  `orderProductID` int(11) DEFAULT NULL,
  `tblOrdersID` int(11) DEFAULT NULL,
  `orderRemarks` int(11) NOT NULL,
  `orderQuantity` int(11) DEFAULT NULL,
  `orderRequestStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder_request`
--

INSERT INTO `tblorder_request` (`order_requestID`, `orderProductID`, `tblOrdersID`, `orderRemarks`, `orderQuantity`, `orderRequestStatus`) VALUES
(1, 11, 8, 0, 3, 'Active'),
(2, 11, 8, 0, 3, 'Active'),
(3, 10, 8, 0, 3, 'Active'),
(4, 10, 8, 0, 3, 'Active'),
(5, 11, 9, 0, 4, 'Active'),
(6, 11, 9, 0, 1, 'Active'),
(7, 10, 9, 0, 4, 'Active'),
(8, 10, 9, 0, 1, 'Active'),
(9, 11, 10, 0, 4, 'Active'),
(10, 11, 10, 0, 1, 'Active'),
(11, 10, 10, 0, 4, 'Active'),
(12, 10, 10, 0, 1, 'Active'),
(13, 11, 11, 0, 4, 'Active'),
(14, 11, 11, 0, 1, 'Active'),
(15, 10, 11, 0, 4, 'Active'),
(16, 10, 11, 0, 1, 'Active'),
(17, 11, 12, 0, 4, 'Active'),
(18, 10, 12, 0, 1, 'Active'),
(19, 11, 13, 0, 4, 'Active'),
(20, 10, 13, 0, 1, 'Active'),
(21, 8, 14, 0, 2, 'Active'),
(22, 10, 15, 0, 2, 'Active'),
(23, 10, 16, 0, 3, 'Active'),
(24, 8, 16, 0, 2, 'Active'),
(25, 10, 17, 0, 3, 'Active'),
(26, 8, 17, 0, 2, 'Active'),
(27, 10, 18, 0, 2, 'Active'),
(28, 2, 18, 0, 3, 'Active'),
(29, 9, 18, 0, 2, 'Active'),
(30, 10, 19, 0, 2, 'Active'),
(31, 9, 19, 0, 2, 'Active'),
(32, 10, 20, 0, 2, 'Active'),
(33, 9, 20, 0, 2, 'Active'),
(34, 10, 21, 0, 2, 'Active'),
(35, 9, 21, 0, 2, 'Active'),
(36, 10, 22, 0, 2, 'Active'),
(37, 9, 22, 0, 2, 'Active'),
(38, 10, 23, 0, 2, 'Active'),
(39, 9, 23, 0, 2, 'Active'),
(40, 11, 2, 0, 8, 'Active'),
(41, 11, 25, 0, 2, 'Active'),
(42, 8, 25, 0, 1, 'Active'),
(43, 11, 26, 0, 2, 'Active'),
(44, 9, 26, 0, 2, 'Active'),
(45, 10, 27, 0, 1, 'Active'),
(46, 11, 28, 0, 2, 'Active'),
(47, 11, 29, 0, 3, 'Active'),
(48, 11, 30, 0, 3, 'Active'),
(49, 11, 31, 0, 3, 'Active'),
(50, 11, 32, 0, 2, 'Active'),
(51, 11, 33, 0, 2, 'Active'),
(52, 11, 34, 0, 1, 'Active'),
(53, 11, 35, 0, 3, 'Active'),
(54, 11, 41, 0, 2, 'Active'),
(55, 11, 42, 0, 2, 'Active'),
(56, 11, 43, 0, 2, 'Active'),
(57, 11, 44, 0, 2, 'Active'),
(58, 11, 45, 0, 2, 'Active'),
(59, 11, 46, 0, 2, 'Active'),
(60, 11, 47, 0, 2, 'Active'),
(61, 11, 48, 0, 1, 'Active'),
(62, 11, 23, 0, 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

CREATE TABLE `tblpackages` (
  `packageID` int(11) NOT NULL,
  `packagePrice` double NOT NULL,
  `packageDescription` varchar(250) DEFAULT NULL,
  `packageStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`packageID`, `packagePrice`, `packageDescription`, `packageStatus`) VALUES
(0, 600, 'Package 1', 'Archived'),
(1, 6, 'Christmas Packages', 'Archived'),
(2, 990, 'Bessy', 'Archived'),
(3, 25, 'Good For 2', 'Listed'),
(4, 50, 'Christmas Package', 'Listed'),
(5, 10, 'Birthday Package', 'Listed'),
(6, 306, 'Bday1', 'Archived'),
(7, 306, 'Bday1', 'Archived'),
(8, 306, 'Bday1', 'Archived'),
(9, 173, 'Why Tho', 'Archived'),
(10, 306, 'Bday1', 'Archived'),
(11, 183, 'Name', 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage_inclusions`
--

CREATE TABLE `tblpackage_inclusions` (
  `package_inclusionID` int(11) NOT NULL,
  `product_incID` int(11) NOT NULL,
  `package_incID` int(11) NOT NULL,
  `package_incStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpackage_inclusions`
--

INSERT INTO `tblpackage_inclusions` (`package_inclusionID`, `product_incID`, `package_incID`, `package_incStatus`) VALUES
(1, 1, 0, 'Listed'),
(2, 2, 0, 'Listed'),
(3, 1, 1, 'Listed'),
(4, 2, 1, 'Listed'),
(5, 1, 2, 'Listed'),
(6, 2, 2, 'Listed'),
(7, 2, 3, 'Listed'),
(8, 3, 3, 'Listed'),
(9, 4, 4, 'Archived'),
(10, 5, 4, 'Listed'),
(11, 4, 4, 'Listed'),
(12, 5, 4, 'Listed'),
(13, 8, 5, 'Listed'),
(14, 9, 5, 'Listed'),
(15, 8, 5, 'Listed'),
(16, 9, 5, 'Listed'),
(17, 4, 6, 'Archived'),
(18, 5, 6, 'Archived'),
(19, 8, 6, 'Listed'),
(20, 4, 6, 'Listed'),
(21, 5, 6, 'Archived'),
(22, 8, 6, 'Listed'),
(23, 4, 7, 'Listed'),
(24, 5, 7, 'Listed'),
(25, 8, 7, 'Listed'),
(26, 4, 7, 'Listed'),
(27, 5, 7, 'Listed'),
(28, 8, 7, 'Listed'),
(29, 4, 8, 'Listed'),
(30, 5, 8, 'Listed'),
(31, 8, 8, 'Listed'),
(32, 4, 8, 'Listed'),
(33, 5, 8, 'Listed'),
(34, 8, 8, 'Listed'),
(35, 3, 9, 'Listed'),
(36, 4, 9, 'Archived'),
(37, 2, 9, 'Archived'),
(38, 5, 9, 'Listed'),
(39, 4, 10, 'Listed'),
(40, 5, 10, 'Listed'),
(41, 8, 10, 'Listed'),
(42, 4, 10, 'Listed'),
(43, 5, 10, 'Listed'),
(44, 8, 10, 'Listed'),
(45, 5, 11, 'Listed'),
(46, 8, 11, 'Listed'),
(47, 3, 4, 'Listed');

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
  `paymentStatus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpayment_details`
--

INSERT INTO `tblpayment_details` (`payment_detailsID`, `invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES
(5, 5, '2017-07-31 20:13:08', 9999.99, 1, 'Paid'),
(6, 6, '2017-07-31 20:14:02', 200000, 1, 'Paid'),
(7, 7, '2017-08-01 14:43:58', 100000, 1, 'Paid'),
(8, 8, '2017-08-01 14:46:44', 20000, 1, 'Paid'),
(9, 9, '2017-08-02 13:01:31', 30000, 1, 'Paid'),
(10, 10, '2017-08-03 12:10:21', 650000, 1, 'Paid'),
(11, 11, '2017-08-03 17:06:33', 50000, 1, 'Paid'),
(12, 12, '2017-08-03 17:07:45', 50000, 1, 'Paid'),
(13, 13, '2017-08-03 17:08:23', 50000, 1, 'Paid'),
(14, 14, '2017-08-03 17:09:23', 6000, 1, 'Paid'),
(15, 15, '2017-08-03 17:10:11', 6000, 1, 'Paid'),
(16, 16, '2017-08-03 17:29:14', 50000, 1, 'Paid'),
(17, 17, '2017-08-04 08:28:15', 50000, 1, 'Paid'),
(18, 18, '2017-08-09 06:33:03', 70000, 1, 'Paid'),
(19, 19, '2017-08-09 07:10:40', 70000, 1, 'Paid'),
(20, 20, '2017-08-09 07:15:55', 70000, 1, 'Paid'),
(21, 21, '2017-08-09 07:20:09', 70000, 1, 'Paid'),
(22, 22, '2017-08-09 07:58:33', 70000, 1, 'Paid'),
(23, 23, '2017-08-09 07:59:56', 70000, 1, 'Paid'),
(24, 24, '2017-08-09 08:02:38', 70000, 1, 'Paid'),
(25, 25, '2017-08-09 13:24:34', 50000, 1, 'Paid'),
(26, 5, '2017-08-12 17:14:34', 0, 1, 'Paid'),
(27, 5, '2017-08-12 17:14:54', 50000, 1, 'Paid'),
(28, 0, '2017-08-12 17:32:15', 250000, 1, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tblpenalty`
--

CREATE TABLE `tblpenalty` (
  `penaltyID` int(11) NOT NULL,
  `penaltyName` varchar(45) NOT NULL,
  `penaltyRateType` varchar(45) NOT NULL,
  `penaltyRate` decimal(6,2) NOT NULL,
  `penaltyRemarks` varchar(250) DEFAULT NULL,
  `penStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblphases`
--

CREATE TABLE `tblphases` (
  `phaseID` int(11) NOT NULL,
  `phaseName` varchar(250) NOT NULL,
  `phaseIcon` varchar(450) NOT NULL,
  `phaseStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblphases`
--

INSERT INTO `tblphases` (`phaseID`, `phaseName`, `phaseIcon`, `phaseStatus`) VALUES
(1, 'Carpentry', 'brush.png', 'Active'),
(2, 'Carving', 'brush.png', 'Active'),
(3, 'Filling', 'brush.png', 'Active'),
(4, 'Upholstery', 'brush.png', 'Active'),
(5, 'Finishing', 'brush.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblprodsonpromo`
--

CREATE TABLE `tblprodsonpromo` (
  `onpromoID` int(11) NOT NULL,
  `prodPromoID` int(11) NOT NULL,
  `promoDescID` int(11) NOT NULL,
  `onPromoStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprodsonpromo`
--

INSERT INTO `tblprodsonpromo` (`onpromoID`, `prodPromoID`, `promoDescID`, `onPromoStatus`) VALUES
(1, 11, 4, 'Active'),
(2, 10, 4, 'Active'),
(3, 2, 3, 'Active'),
(4, 3, 3, 'Active'),
(5, 4, 3, 'Active'),
(6, 5, 3, 'Active'),
(7, 8, 3, 'Active'),
(8, 9, 3, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `productID` int(11) NOT NULL,
  `prodCatID` int(11) NOT NULL,
  `prodTypeID` int(11) NOT NULL,
  `prodFrameworkID` int(11) NOT NULL,
  `prodDesign` varchar(50) NOT NULL,
  `prodFabricID` int(11) DEFAULT NULL,
  `productName` varchar(45) NOT NULL,
  `productDescription` varchar(450) DEFAULT NULL,
  `productPrice` double NOT NULL,
  `prodMainPic` varchar(100) NOT NULL,
  `prodSizeSpecs` varchar(100) NOT NULL,
  `prodStat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`productID`, `prodCatID`, `prodTypeID`, `prodFrameworkID`, `prodDesign`, `prodFabricID`, `productName`, `productDescription`, `productPrice`, `prodMainPic`, `prodSizeSpecs`, `prodStat`) VALUES
(1, 1, 1, 2, '2', 0, 'Mani gidalreo', ' ', 70000, '', 'Height-34 inch, Width-34 inch, Depth 45 inch', 'Archived'),
(2, 1, 1, 4, '1', 0, 'Never', ' A description', 70000, 'DEmGhv4WsAEntLU.jpg', '32,12,32', 'On-Hand'),
(3, 1, 1, 2, '1', 0, 'Rocky', ' ', 70000, 'DDsSANoUAAAs2ed.jpg', 'LALAL66', 'Pre-Order'),
(4, 1, 1, 2, '3', 1, 'Manille', ' ', 70000, '', '322', 'Pre-Order'),
(5, 1, 1, 2, '', 0, 'White', ' ', 70000, '', '23,23,23', 'Pre-Order'),
(6, 0, 2, 2, '', 0, 'Manillenia', ' Lul', 70000, 'KnittedSet.jpg', 'H-34,W-36,D-5', 'Archived'),
(7, 0, 2, 2, '', 0, 'Laguna', ' ', 70000, 'chair2.png', '12,32,12', 'Archived'),
(8, 3, 3, 6, '3', 1, 'Eliza', ' A great dining table for 8 persons', 70000, '', '5,6,7', 'On-Hand'),
(9, 4, 6, 2, '1', 0, 'Queen', ' A queen size bed for 5', 70000, '', '4,4,4', 'On-Hand'),
(10, 3, 5, 6, '3', 1, 'Jollibee', 'Hi-chair for jolly kids', 50000, '', '5,3,4', 'Pre-Order'),
(11, 1, 1, 5, '1', 0, 'Aira', 'Floral Frame ', 60000, '17240315_1375401649150049_4621152707863733699_o.jpg', '6,5,4', 'Pre-Order');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduction`
--

CREATE TABLE `tblproduction` (
  `productionID` int(11) NOT NULL,
  `productionOrderReq` int(11) NOT NULL,
  `productionEmp` int(11) DEFAULT NULL,
  `prodPhase` varchar(45) DEFAULT NULL,
  `productionStatus` varchar(45) NOT NULL,
  `prodRecordStatus` varchar(45) NOT NULL,
  `prodDateStart` date NOT NULL,
  `prodDateEnd` date DEFAULT NULL,
  `productionRemarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproduction`
--

INSERT INTO `tblproduction` (`productionID`, `productionOrderReq`, `productionEmp`, `prodPhase`, `productionStatus`, `prodRecordStatus`, `prodDateStart`, `prodDateEnd`, `productionRemarks`) VALUES
(1, 10, 1, '1', 'Pending', 'Active', '2017-07-07', NULL, 'Prod'),
(2, 38, 1, '1', 'Pending', 'Active', '2017-08-13', NULL, 'Production'),
(3, 39, 1, '1', 'Pending', 'Active', '2017-08-13', NULL, 'Lala'),
(4, 62, 1, '1', 'Pending', 'Active', '2017-08-13', NULL, 'haha');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduction_history`
--

CREATE TABLE `tblproduction_history` (
  `prodHistID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `prodPhase` int(11) NOT NULL,
  `prodDateStart` date NOT NULL,
  `prodDateEnd` date NOT NULL,
  `prodRemarks` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_images`
--

CREATE TABLE `tblprod_images` (
  `prodImageID` int(11) NOT NULL,
  `prodImgID` int(11) NOT NULL,
  `prodImageName` varchar(100) NOT NULL,
  `prodImgStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_info`
--

CREATE TABLE `tblprod_info` (
  `prodInfoID` int(11) NOT NULL,
  `prodInfoProduct` int(11) NOT NULL,
  `prodInfoPhase` int(11) NOT NULL,
  `prodInfoStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblprod_info`
--

INSERT INTO `tblprod_info` (`prodInfoID`, `prodInfoProduct`, `prodInfoPhase`, `prodInfoStatus`) VALUES
(1, 4, 1, 'Active'),
(2, 4, 2, 'Archived'),
(3, 0, 1, 'Active'),
(4, 9, 1, 'Active'),
(5, 8, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_materials`
--

CREATE TABLE `tblprod_materials` (
  `p_matID` int(11) NOT NULL,
  `p_prodInfoID` int(11) NOT NULL,
  `p_matMaterialID` int(11) NOT NULL,
  `p_matDescID` int(11) NOT NULL,
  `p_matQuantity` varchar(250) NOT NULL,
  `p_matUnit` varchar(45) NOT NULL,
  `p_matStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprod_materials`
--

INSERT INTO `tblprod_materials` (`p_matID`, `p_prodInfoID`, `p_matMaterialID`, `p_matDescID`, `p_matQuantity`, `p_matUnit`, `p_matStatus`) VALUES
(1, 1, 2, 3, '500', '1', 'Archived'),
(2, 1, 2, 1, '50', '1', 'Archived'),
(3, 2, 2, 3, '5', '1', 'Active'),
(4, 2, 2, 1, '50', '1', 'Active'),
(5, 3, 4, 5, '5', '1', 'Active'),
(6, 3, 4, 5, '0', '1', 'Active'),
(7, 4, 2, 1, '5', '1', 'Active'),
(8, 4, 4, 5, '0', '1', 'Active'),
(9, 5, 3, 0, '5', '9', 'Active'),
(10, 5, 3, 0, '5', '9', 'Active'),
(11, 5, 5, 0, '6', '9', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpromos`
--

CREATE TABLE `tblpromos` (
  `promoID` int(11) NOT NULL,
  `promoName` varchar(45) NOT NULL,
  `promoDescription` varchar(450) NOT NULL,
  `promoStartDate` date NOT NULL,
  `promoEnd` varchar(450) DEFAULT NULL,
  `promoImage` varchar(450) DEFAULT NULL,
  `promoStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpromos`
--

INSERT INTO `tblpromos` (`promoID`, `promoName`, `promoDescription`, `promoStartDate`, `promoEnd`, `promoImage`, `promoStatus`) VALUES
(1, 'Grand Opening  Promo', 'Buy 1 Take 1 on any specified products', '2017-07-23', '2017-07-23', 'DE7If2LUwAAqvAR.png', 'Active'),
(3, 'New Beginning Promo', 'Buy as least Php 50,000 worth of furniture and bring home a free coffee table', '2017-07-23', '2017-07-23', 'DE7If2LUwAAqvAR.png', 'Active'),
(4, 'Back to School Promo', '5 Chairs Free 1 stool', '2017-08-02', '2017-08-31', '19553445_1435850453104539_877905206_n.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo_condition`
--

CREATE TABLE `tblpromo_condition` (
  `conditionID` int(11) NOT NULL,
  `conCategory` varchar(45) NOT NULL,
  `conData` varchar(450) NOT NULL,
  `conPromoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpromo_condition`
--

INSERT INTO `tblpromo_condition` (`conditionID`, `conCategory`, `conData`, `conPromoID`) VALUES
(1, 'Pieces', '1', 1),
(2, 'Amount', '50,000', 3),
(3, 'Pieces', '5', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo_promotion`
--

CREATE TABLE `tblpromo_promotion` (
  `promotionID` int(11) NOT NULL,
  `proPromoID` int(11) NOT NULL,
  `proCategory` varchar(45) NOT NULL,
  `proData` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpromo_promotion`
--

INSERT INTO `tblpromo_promotion` (`promotionID`, `proPromoID`, `proCategory`, `proData`) VALUES
(1, 1, 'Pieces', '1'),
(2, 3, 'Others', ' Free coffee table'),
(3, 4, 'Pieces', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplierID` int(11) NOT NULL,
  `supCompName` varchar(250) NOT NULL,
  `supCompAdd` varchar(100) NOT NULL,
  `supCompNum` varchar(20) NOT NULL,
  `supContactPerson` varchar(100) NOT NULL,
  `supPosition` varchar(45) NOT NULL,
  `supStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplierID`, `supCompName`, `supCompAdd`, `supCompNum`, `supContactPerson`, `supPosition`, `supStatus`) VALUES
(1, 'FNC Ent', '111 Gangnamgu Seoul South Korea', '09093399112', 'Lee Hongki', 'Best Vocalist Ever', 'Listed'),
(2, 'Sampl', 'Sampl', '2098s', 'askdh', 'iwd', 'Archived'),
(3, 'SMENT', '#GANGNAMGU', '284288', 'Lee Soo Man', 'CEO', 'Listed'),
(4, 'JYP Ent', '#1234 Gangnam', '374676', 'JYP', 'CEO', 'Listed'),
(5, 'CUBEENT              ', 'AAAA', '3324', 'DFEFREF', 'DFDFADGA', 'Archived'),
(6, '                          ', '', '', '', '', 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `tblunitofmeasure`
--

CREATE TABLE `tblunitofmeasure` (
  `unID` int(11) NOT NULL,
  `unType` varchar(50) NOT NULL,
  `unUnit` varchar(10) NOT NULL,
  `unStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblunitofmeasure`
--

INSERT INTO `tblunitofmeasure` (`unID`, `unType`, `unUnit`, `unStatus`) VALUES
(1, 'Box', 'box', 'Archived'),
(2, 'Yard', 'yard', 'Active'),
(3, 'Set', 'set', 'Archived'),
(4, 'Pieces', 'pcs', 'Active'),
(5, '', '', 'Archived'),
(6, '', '', 'Archived'),
(7, 'Bes', 'bs', 'Archived'),
(8, 'Bes                    ', 'bs        ', 'Archived'),
(9, 'Liter', 'l', 'Active'),
(10, 'Feet', 'ft', 'Active'),
(11, 'Meter', 'm', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblunitofmeasurement_category`
--

CREATE TABLE `tblunitofmeasurement_category` (
  `uncategoryID` int(11) NOT NULL,
  `uncategoryName` varchar(50) NOT NULL,
  `uncategoryDescription` varchar(50) NOT NULL,
  `uncategoryStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblunitofmeasurement_category`
--

INSERT INTO `tblunitofmeasurement_category` (`uncategoryID`, `uncategoryName`, `uncategoryDescription`, `uncategoryStatus`) VALUES
(1, 'Length', 'measurable', 'Active'),
(2, 'Width', ' Measurable itu', 'Active'),
(3, 'Weight', ' ', 'Active'),
(4, 'Distance', ' ', 'Active'),
(5, 'Volume', ' ', 'Active'),
(6, 'Height', ' ', 'Active'),
(7, 'Radius', ' ', 'Active'),
(8, 'Diameter', ' ', 'Active'),
(9, 'Circumference', ' ', 'Active'),
(10, 'Thickness', ' ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblunit_cat`
--

CREATE TABLE `tblunit_cat` (
  `unitcatID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `uncategoryID` int(11) NOT NULL,
  `unitcatStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblunit_cat`
--

INSERT INTO `tblunit_cat` (`unitcatID`, `unitID`, `uncategoryID`, `unitcatStatus`) VALUES
(1, 11, 1, 'Active'),
(2, 11, 2, 'Active'),
(3, 12, 1, 'Active'),
(4, 12, 2, 'Active'),
(5, 12, 4, 'Active'),
(6, 12, 6, 'Active'),
(7, 12, 7, 'Active'),
(8, 12, 8, 'Active'),
(9, 12, 9, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userID` int(11) NOT NULL,
  `userName` varchar(80) NOT NULL,
  `userPassword` varchar(45) NOT NULL,
  `userStatus` varchar(45) NOT NULL,
  `userType` varchar(45) NOT NULL,
  `userCustID` int(20) DEFAULT NULL,
  `userEmpID` int(11) DEFAULT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `userName`, `userPassword`, `userStatus`, `userType`, `userCustID`, `userEmpID`, `dateCreated`) VALUES
(1, 'admin', 'admin', 'active', 'customer', 8, NULL, '2017-08-02'),
(2, 'admin1', 'admin', 'active', 'admin', NULL, 2, '2017-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblvariant_desc`
--

CREATE TABLE `tblvariant_desc` (
  `variant_descID` int(11) NOT NULL,
  `varAttribID` varchar(45) NOT NULL,
  `varMatvarID` varchar(45) NOT NULL,
  `varVariantDesc` varchar(150) NOT NULL,
  `varStatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvariant_desc`
--

INSERT INTO `tblvariant_desc` (`variant_descID`, `varAttribID`, `varMatvarID`, `varVariantDesc`, `varStatus`) VALUES
(1, 'Color', '1', 'Red', 'Listed'),
(2, 'Color', '2', 'Yellow', 'Listed'),
(3, 'Brand', '3', 'Collen', 'Listed'),
(4, 'Color', '3', 'Yellow', 'Listed'),
(5, 'Brand', '4', 'Collen', 'Listed'),
(6, 'Color', '4', 'White', 'Listed');

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
  ADD PRIMARY KEY (`amID`);

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
  ADD PRIMARY KEY (`cust_req_imagesID`);

--
-- Indexes for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`deliveryID`),
  ADD KEY `orderReqID_idx` (`deliveryOrdReq`),
  ADD KEY `empAssignedID_idx` (`deliveryEmpAssigned`);

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
  ADD PRIMARY KEY (`d_phaseID`);

--
-- Indexes for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  ADD PRIMARY KEY (`downpaymentID`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `employeeJob_idx` (`empJobID`);

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
  ADD KEY `material_idx` (`materialUsedID`);

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
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `tblinventory_logs`
--
ALTER TABLE `tblinventory_logs`
  ADD PRIMARY KEY (`inLogID`);

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
  ADD PRIMARY KEY (`materialID`);

--
-- Indexes for table `tblmat_attribs`
--
ALTER TABLE `tblmat_attribs`
  ADD PRIMARY KEY (`mat_attribsID`);

--
-- Indexes for table `tblmat_type`
--
ALTER TABLE `tblmat_type`
  ADD PRIMARY KEY (`matTypeID`);

--
-- Indexes for table `tblmat_var`
--
ALTER TABLE `tblmat_var`
  ADD PRIMARY KEY (`variantID`);

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
  ADD PRIMARY KEY (`order_requestID`);

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
  ADD PRIMARY KEY (`payment_detailsID`);

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
  ADD KEY `orReq_idx` (`productionOrderReq`),
  ADD KEY `empAssigned_idx` (`productionEmp`);

--
-- Indexes for table `tblproduction_history`
--
ALTER TABLE `tblproduction_history`
  ADD PRIMARY KEY (`prodHistID`),
  ADD KEY `production_idx` (`prodID`),
  ADD KEY `phase_idx` (`prodPhase`);

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
  ADD PRIMARY KEY (`prodInfoID`);

--
-- Indexes for table `tblprod_materials`
--
ALTER TABLE `tblprod_materials`
  ADD PRIMARY KEY (`p_matID`),
  ADD KEY `prodInfo_idx` (`p_prodInfoID`);

--
-- Indexes for table `tblpromos`
--
ALTER TABLE `tblpromos`
  ADD PRIMARY KEY (`promoID`);

--
-- Indexes for table `tblpromo_condition`
--
ALTER TABLE `tblpromo_condition`
  ADD PRIMARY KEY (`conditionID`);

--
-- Indexes for table `tblpromo_promotion`
--
ALTER TABLE `tblpromo_promotion`
  ADD PRIMARY KEY (`promotionID`);

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
  ADD PRIMARY KEY (`unitcatID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userID`,`userName`),
  ADD KEY `cust_idx` (`userCustID`),
  ADD KEY `emp_idx` (`userEmpID`);

--
-- Indexes for table `tblvariant_desc`
--
ALTER TABLE `tblvariant_desc`
  ADD PRIMARY KEY (`variant_descID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblattributes`
--
ALTER TABLE `tblattributes`
  MODIFY `attributeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblattribute_measure`
--
ALTER TABLE `tblattribute_measure`
  MODIFY `amID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `check_detailsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcompany_info`
--
ALTER TABLE `tblcompany_info`
  MODIFY `comp_recID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `deliveryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldelivery_rates`
--
ALTER TABLE `tbldelivery_rates`
  MODIFY `delivery_rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbldesign_phase`
--
ALTER TABLE `tbldesign_phase`
  MODIFY `d_phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  MODIFY `downpaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblfabrics`
--
ALTER TABLE `tblfabrics`
  MODIFY `fabricID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblfabric_pattern`
--
ALTER TABLE `tblfabric_pattern`
  MODIFY `f_patternID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblfabric_texture`
--
ALTER TABLE `tblfabric_texture`
  MODIFY `textureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblfabric_type`
--
ALTER TABLE `tblfabric_type`
  MODIFY `f_typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblframeworks`
--
ALTER TABLE `tblframeworks`
  MODIFY `frameworkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblframe_design`
--
ALTER TABLE `tblframe_design`
  MODIFY `designID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblframe_material`
--
ALTER TABLE `tblframe_material`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblfurn_category`
--
ALTER TABLE `tblfurn_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblfurn_design`
--
ALTER TABLE `tblfurn_design`
  MODIFY `designID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblfurn_type`
--
ALTER TABLE `tblfurn_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblinventory_logs`
--
ALTER TABLE `tblinventory_logs`
  MODIFY `inLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblinvoicedetails`
--
ALTER TABLE `tblinvoicedetails`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbljobs`
--
ALTER TABLE `tbljobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblmat_attribs`
--
ALTER TABLE `tblmat_attribs`
  MODIFY `mat_attribsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblmat_type`
--
ALTER TABLE `tblmat_type`
  MODIFY `matTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblmat_var`
--
ALTER TABLE `tblmat_var`
  MODIFY `variantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblmodeofpayment`
--
ALTER TABLE `tblmodeofpayment`
  MODIFY `modeofpaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblonhand`
--
ALTER TABLE `tblonhand`
  MODIFY `onHandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tblorder_actions`
--
ALTER TABLE `tblorder_actions`
  MODIFY `orActionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_customization`
--
ALTER TABLE `tblorder_customization`
  MODIFY `orCustID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_request`
--
ALTER TABLE `tblorder_request`
  MODIFY `order_requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `tblpackage_inclusions`
--
ALTER TABLE `tblpackage_inclusions`
  MODIFY `package_inclusionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tblpayment_details`
--
ALTER TABLE `tblpayment_details`
  MODIFY `payment_detailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tblpenalty`
--
ALTER TABLE `tblpenalty`
  MODIFY `penaltyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblphases`
--
ALTER TABLE `tblphases`
  MODIFY `phaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblprodsonpromo`
--
ALTER TABLE `tblprodsonpromo`
  MODIFY `onpromoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblproduction`
--
ALTER TABLE `tblproduction`
  MODIFY `productionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblproduction_history`
--
ALTER TABLE `tblproduction_history`
  MODIFY `prodHistID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblprod_images`
--
ALTER TABLE `tblprod_images`
  MODIFY `prodImageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblprod_info`
--
ALTER TABLE `tblprod_info`
  MODIFY `prodInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblprod_materials`
--
ALTER TABLE `tblprod_materials`
  MODIFY `p_matID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblpromos`
--
ALTER TABLE `tblpromos`
  MODIFY `promoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblpromo_condition`
--
ALTER TABLE `tblpromo_condition`
  MODIFY `conditionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblpromo_promotion`
--
ALTER TABLE `tblpromo_promotion`
  MODIFY `promotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblunitofmeasure`
--
ALTER TABLE `tblunitofmeasure`
  MODIFY `unID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblunitofmeasurement_category`
--
ALTER TABLE `tblunitofmeasurement_category`
  MODIFY `uncategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblunit_cat`
--
ALTER TABLE `tblunit_cat`
  MODIFY `unitcatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblvariant_desc`
--
ALTER TABLE `tblvariant_desc`
  MODIFY `variant_descID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcheck_details`
--
ALTER TABLE `tblcheck_details`
  ADD CONSTRAINT `payDet` FOREIGN KEY (`p_detailsID`) REFERENCES `tblpayment_details` (`payment_detailsID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcustomize_request`
--
ALTER TABLE `tblcustomize_request`
  ADD CONSTRAINT `cstmfabric` FOREIGN KEY (`customFabricID`) REFERENCES `tblfabrics` (`fabricID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cstmframework` FOREIGN KEY (`customFrameID`) REFERENCES `tblframeworks` (`frameworkID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD CONSTRAINT `empAssignedID` FOREIGN KEY (`deliveryEmpAssigned`) REFERENCES `tblemployee` (`empID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderReqID` FOREIGN KEY (`deliveryOrdReq`) REFERENCES `tblorder_request` (`order_requestID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbldelivery_rates`
--
ALTER TABLE `tbldelivery_rates`
  ADD CONSTRAINT `fromBranch` FOREIGN KEY (`delBranchID`) REFERENCES `tblbranches` (`branchID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD CONSTRAINT `employeeJob` FOREIGN KEY (`empJobID`) REFERENCES `tbljobs` (`jobID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfabrics`
--
ALTER TABLE `tblfabrics`
  ADD CONSTRAINT `pattern` FOREIGN KEY (`fabricPatternID`) REFERENCES `tblfabric_pattern` (`f_patternID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfabric_type`
--
ALTER TABLE `tblfabric_type`
  ADD CONSTRAINT `texture` FOREIGN KEY (`f_typeTextureID`) REFERENCES `tblfabric_texture` (`textureID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblframeworks`
--
ALTER TABLE `tblframeworks`
  ADD CONSTRAINT `design` FOREIGN KEY (`framedesignID`) REFERENCES `tblframe_design` (`designID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `material` FOREIGN KEY (`materialUsedID`) REFERENCES `tblframe_material` (`materialID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblinvoicedetails`
--
ALTER TABLE `tblinvoicedetails`
  ADD CONSTRAINT `orderinv` FOREIGN KEY (`invorderID`) REFERENCES `tblorders` (`orderID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblonhand`
--
ALTER TABLE `tblonhand`
  ADD CONSTRAINT `product` FOREIGN KEY (`ohProdID`) REFERENCES `tblproduct` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD CONSTRAINT `tblcustID` FOREIGN KEY (`custOrderID`) REFERENCES `tblcustomer` (`customerID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tlbuserID` FOREIGN KEY (`receivedbyUserID`) REFERENCES `tbluser` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblorder_actions`
--
ALTER TABLE `tblorder_actions`
  ADD CONSTRAINT `ordertbl` FOREIGN KEY (`orOrderID`) REFERENCES `tblorders` (`orderID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblorder_customization`
--
ALTER TABLE `tblorder_customization`
  ADD CONSTRAINT `fabricReq` FOREIGN KEY (`orFabricID`) REFERENCES `tblfabrics` (`fabricID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `frameworkReq` FOREIGN KEY (`orFrameworkID`) REFERENCES `tblframeworks` (`frameworkID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderReq` FOREIGN KEY (`orOrderReqID`) REFERENCES `tblorder_request` (`order_requestID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblpackage_inclusions`
--
ALTER TABLE `tblpackage_inclusions`
  ADD CONSTRAINT `packID` FOREIGN KEY (`package_incID`) REFERENCES `tblpackages` (`packageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prodID` FOREIGN KEY (`product_incID`) REFERENCES `tblproduct` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprodsonpromo`
--
ALTER TABLE `tblprodsonpromo`
  ADD CONSTRAINT `prodc` FOREIGN KEY (`prodPromoID`) REFERENCES `tblproduct` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `promodescid` FOREIGN KEY (`promoDescID`) REFERENCES `tblpromos` (`promoID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD CONSTRAINT `framworkcodeID` FOREIGN KEY (`prodFrameworkID`) REFERENCES `tblframeworks` (`frameworkID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `type` FOREIGN KEY (`prodTypeID`) REFERENCES `tblfurn_type` (`typeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproduction`
--
ALTER TABLE `tblproduction`
  ADD CONSTRAINT `empAssigned` FOREIGN KEY (`productionEmp`) REFERENCES `tblemployee` (`empID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orReq` FOREIGN KEY (`productionOrderReq`) REFERENCES `tblorder_request` (`order_requestID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproduction_history`
--
ALTER TABLE `tblproduction_history`
  ADD CONSTRAINT `phase` FOREIGN KEY (`prodPhase`) REFERENCES `tblphases` (`phaseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `production` FOREIGN KEY (`prodID`) REFERENCES `tblproduction` (`productionID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprod_images`
--
ALTER TABLE `tblprod_images`
  ADD CONSTRAINT `prodInfo` FOREIGN KEY (`prodImgID`) REFERENCES `tblproduct` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `cust` FOREIGN KEY (`userCustID`) REFERENCES `tblcustomer` (`customerID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `emp` FOREIGN KEY (`userEmpID`) REFERENCES `tblemployee` (`empID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

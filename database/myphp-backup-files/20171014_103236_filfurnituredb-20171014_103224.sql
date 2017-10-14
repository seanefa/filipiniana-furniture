CREATE DATABASE IF NOT EXISTS `filfurnituredb`;

USE filfurnituredb;

DROP TABLE IF EXISTS `tblattribute_measure`;

CREATE TABLE `tblattribute_measure` (
  `amID` int(11) NOT NULL AUTO_INCREMENT,
  `attributeID` int(11) NOT NULL,
  `uncategoryID` int(11) NOT NULL,
  `amStatus` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`amID`),
  KEY `attribute_idx` (`attributeID`),
  KEY `unit_idx` (`uncategoryID`),
  CONSTRAINT `attribute` FOREIGN KEY (`attributeID`) REFERENCES `tblattributes` (`attributeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unit` FOREIGN KEY (`uncategoryID`) REFERENCES `tblunitofmeasurement_category` (`uncategoryID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblattribute_measure` VALUES("8","8","11","Active");
INSERT INTO `tblattribute_measure` VALUES("9","9","0","Active");
INSERT INTO `tblattribute_measure` VALUES("10","10","0","Active");
INSERT INTO `tblattribute_measure` VALUES("11","11","14","Active");
INSERT INTO `tblattribute_measure` VALUES("12","12","11","Active");



DROP TABLE IF EXISTS `tblattributes`;

CREATE TABLE `tblattributes` (
  `attributeID` int(11) NOT NULL AUTO_INCREMENT,
  `attributeName` varchar(150) CHARACTER SET latin1 NOT NULL,
  `attributeStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`attributeID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblattributes` VALUES("8","Size","Archived");
INSERT INTO `tblattributes` VALUES("9","Color","Active");
INSERT INTO `tblattributes` VALUES("10","Type","Active");
INSERT INTO `tblattributes` VALUES("11","Weight","Active");
INSERT INTO `tblattributes` VALUES("12","Dimension","Active");



DROP TABLE IF EXISTS `tblbank_accounts`;

CREATE TABLE `tblbank_accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `accountName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `accountNumber` varchar(50) CHARACTER SET utf8 NOT NULL,
  `accountStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `accountRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `bankLink` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblbank_accounts` VALUES("1","Aira Barrameda","201402207MN0","Active","Landbank","");
INSERT INTO `tblbank_accounts` VALUES("2","Sean Lester Efa","201728127NB0","Active","BDO","");



DROP TABLE IF EXISTS `tblbranches`;

CREATE TABLE `tblbranches` (
  `branchID` int(11) NOT NULL AUTO_INCREMENT,
  `branchLocation` varchar(45) CHARACTER SET utf8 NOT NULL,
  `branchAddress` varchar(450) CHARACTER SET utf8 NOT NULL,
  `branchRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `branchStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`branchID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblbranches` VALUES("1","Bacoor","Talaba II, Bacoor Cavite","","Listed");
INSERT INTO `tblbranches` VALUES("2","Silang","Silangan, Silang Cavite","","Listed");



DROP TABLE IF EXISTS `tblcheck_details`;

CREATE TABLE `tblcheck_details` (
  `check_detailsID` int(11) NOT NULL AUTO_INCREMENT,
  `p_detailsID` int(11) NOT NULL,
  `checkNumber` int(11) NOT NULL,
  `checkAmount` double NOT NULL,
  `checkRemarks` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`check_detailsID`),
  KEY `payDet_idx` (`p_detailsID`),
  CONSTRAINT `payDet` FOREIGN KEY (`p_detailsID`) REFERENCES `tblpayment_details` (`payment_detailsID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblcheck_details` VALUES("1","7","32232","2","");



DROP TABLE IF EXISTS `tblcompany_info`;

CREATE TABLE `tblcompany_info` (
  `comp_recID` int(11) NOT NULL AUTO_INCREMENT,
  `comp_logo` varchar(450) CHARACTER SET latin1 NOT NULL,
  `comp_name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `comp_num` int(11) NOT NULL,
  `comp_email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `comp_address` varchar(150) CHARACTER SET latin1 NOT NULL,
  `comp_about` varchar(450) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`comp_recID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblcompany_info` VALUES("1","2017-10-141507950286.png","Filipiniana Furniture","2147483647","filfurnitures@gmail.com","#123 street","Petmalu");



DROP TABLE IF EXISTS `tblcust_req_images`;

CREATE TABLE `tblcust_req_images` (
  `cust_req_imagesID` int(11) NOT NULL AUTO_INCREMENT,
  `cust_req_ID` int(11) NOT NULL,
  `cust_req_images` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cust_req_imagesID`),
  KEY `cust_req_ID_idx` (`cust_req_ID`),
  CONSTRAINT `cust_req_ID` FOREIGN KEY (`cust_req_ID`) REFERENCES `tblcustomize_request` (`customizedID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tblcustomer`;

CREATE TABLE `tblcustomer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerFirstName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerMiddleName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `customerLastName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerAddress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `customerContactNum` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customerEmail` varchar(80) CHARACTER SET utf8 NOT NULL,
  `customerDP` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `customerNewsletter` int(11) NOT NULL,
  `customerStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblcustomer` VALUES("18","Cyreil Neil","","Basilio","","09876542572","cyreilneil@gmail.com","","0","");
INSERT INTO `tblcustomer` VALUES("19","Aira","Coronado","Coronado","#123 Kagawad Street Batasan Hills Quezon City","09994145004","hongkaira@gmail.com","","0","active");
INSERT INTO `tblcustomer` VALUES("20","Mark Angelo","Barrameda","Coronado","#62 Resolution Street Batasan Hills Quezon CIty","09091543726","angelong123@yahoo.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("21","Rhodora","Barrameda","Coronado","3E Adult Ward PHC Quezon City","+63 (921) 698-2449","rhodoramabr@yahoo.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("22","Rhodora","Barrameda","Coronado","3E Adult Ward PHC Quezon City","+63 (921) 698-2449","rhodoramabr@yahoo.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("23","Donita","Rose","Aber","#1234 Anuna Street BHQC","+63 (930) 678-2267","anunadonita@yahoo.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("24","Gillian May","Piloton","Anyayahan","#1234 Alton Street BHQC","+63 (999) 516-9790","gilanyapilksoo@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("25","Zyrnn Joice","Lasay","Tibre","#1234 Saret Street BHQC","+63 (099) 999-9999","zytibs@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("26","Angelu","Balicuatro","Atienza","#1234 One Way Street BHQC","+63 (977) 546-7173","angeluat@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("27","Shaira","Joy","Flores","#1234 Bagong Silangan Veteran QC","+63 (738) 138-7219","shairajhoy@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("28","Sheyne","Smth","Laristan","#1234 Somewhere Street Brgy. Litex BHQC","+63 (967) 136-7192","sheynelaristan@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("29","Roselyn","M","Melgar","#1234 Taas na Street BHQC","+63 (972) 713-8731","binastedsikuya@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("30","Gendy","Lopez","Ma","329 San jose st. buenlag east mangaldan, pangasinan","+63 (935) 366-7068","gendylopez08@gmail.com","","0","Active");
INSERT INTO `tblcustomer` VALUES("31","M","A","C","#62 Resolution Street Batasan Hills Quezon City","09726827318","hh@yahoo.com","","0","active");
INSERT INTO `tblcustomer` VALUES("32","Sehun","Broken","Oh","#872 Tralala Stree BHQC","0923987238","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("33","Jongin","","Kim","#111 Gangnamgu Ksoohearteu Seoul","09827389101","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("34","Kyungsoo","","Do","#9837 Alalalala","0923972148","hongkaira@yahoo.com","","1","active");
INSERT INTO `tblcustomer` VALUES("35","Junmyeon","","Kim","#762 tralalalal","09287428","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("36","Jongdae","","Kim","#7236 SOUKOR","09289048","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("37","Kyungsoo","","Do","#26367 Seoul South Korea","093827388349","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("38","Harpa","","Marcelo","#1234 Seoul SOUKOR","092837746982","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("39","A","A","A","#26735 jahdakjdh","092382897","hongkaira@gmail.com","","1","active");
INSERT INTO `tblcustomer` VALUES("40","Kyungsoo","","DO","#12234 Seoul SOUKOR","091291873","hongkaira@gmail.com","","1","active");



DROP TABLE IF EXISTS `tblcustomize_request`;

CREATE TABLE `tblcustomize_request` (
  `customizedID` int(11) NOT NULL AUTO_INCREMENT,
  `tblcustomerID` int(11) NOT NULL,
  `customizedPic` varchar(45) CHARACTER SET utf8 NOT NULL,
  `customizedDescription` varchar(450) CHARACTER SET utf8 NOT NULL,
  `customStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`customizedID`),
  KEY `accounttinfoID_idx` (`tblcustomerID`),
  CONSTRAINT `cstmUser` FOREIGN KEY (`tblcustomerID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tbldelivery`;

CREATE TABLE `tbldelivery` (
  `deliveryID` int(11) NOT NULL AUTO_INCREMENT,
  `deliveryEmpAssigned` int(11) NOT NULL,
  `deliveryReleaseID` int(11) NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `deliveryRate` double NOT NULL,
  `deliveryAddress` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `deliveryRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `deliveryStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`deliveryID`),
  KEY `tblreleaseid_tbldelivery_idx` (`deliveryReleaseID`),
  CONSTRAINT `tblreleaseid_tbldelivery` FOREIGN KEY (`deliveryReleaseID`) REFERENCES `tblrelease` (`releaseID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbldelivery` VALUES("1","1","2","2017-09-29 00:00:00","0","#123 Alton Street BHQCMNL","","Start Delivery");
INSERT INTO `tbldelivery` VALUES("2","1","8","0000-00-00 00:00:00","1000","#123 Alton Street","","Pending");



DROP TABLE IF EXISTS `tbldelivery_history`;

CREATE TABLE `tbldelivery_history` (
  `delHistID` int(11) NOT NULL AUTO_INCREMENT,
  `delHist_recID` int(11) NOT NULL,
  `delHistDate` date NOT NULL,
  `delHistDeliveryMan` int(11) NOT NULL,
  `delHistRemarks` varchar(45) DEFAULT NULL,
  `delHistStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`delHistID`),
  KEY `delRecID_indx_idx` (`delHist_recID`),
  KEY `delMan_indx_idx` (`delHistDeliveryMan`),
  CONSTRAINT `delMan_indx` FOREIGN KEY (`delHistDeliveryMan`) REFERENCES `tblemployee` (`empID`) ON UPDATE CASCADE,
  CONSTRAINT `delRecID_indx` FOREIGN KEY (`delHist_recID`) REFERENCES `tbldelivery` (`deliveryID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `tbldelivery_history` VALUES("1","2","2017-10-05","1","","Pending");
INSERT INTO `tbldelivery_history` VALUES("2","1","2017-10-06","1","","Start Delivery");
INSERT INTO `tbldelivery_history` VALUES("3","1","2017-10-05","1","","Pending");
INSERT INTO `tbldelivery_history` VALUES("8","1","2017-10-05","1","","Start Delivery");
INSERT INTO `tbldelivery_history` VALUES("9","1","2017-10-12","1","","Start Delivery");



DROP TABLE IF EXISTS `tbldelivery_rates`;

CREATE TABLE `tbldelivery_rates` (
  `delivery_rateID` int(11) NOT NULL AUTO_INCREMENT,
  `delBranchID` int(11) NOT NULL,
  `delLocation` varchar(100) CHARACTER SET utf8 NOT NULL,
  `delRateType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `delRate` varchar(45) CHARACTER SET utf8 NOT NULL,
  `delRateStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`delivery_rateID`),
  KEY `fromBranch_idx` (`delBranchID`),
  CONSTRAINT `fromBranch` FOREIGN KEY (`delBranchID`) REFERENCES `tblbranches` (`branchID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbldelivery_rates` VALUES("5","1","Metro Manila","Amount","1000","Listed");
INSERT INTO `tbldelivery_rates` VALUES("6","1","Provincial","Amount","3000","Listed");
INSERT INTO `tbldelivery_rates` VALUES("7","2","Quezon City","Amount","400","Listed");



DROP TABLE IF EXISTS `tbldelivery_status`;

CREATE TABLE `tbldelivery_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tbldelivery_status` VALUES("1","Pending");
INSERT INTO `tbldelivery_status` VALUES("2","On-Hold");
INSERT INTO `tbldelivery_status` VALUES("3","Cancelled");



DROP TABLE IF EXISTS `tbldesign_phase`;

CREATE TABLE `tbldesign_phase` (
  `d_phaseID` int(11) NOT NULL AUTO_INCREMENT,
  `p_design` int(11) NOT NULL,
  `d_phase` int(11) NOT NULL,
  `d_phaseStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`d_phaseID`),
  KEY `design_idx` (`p_design`),
  KEY `phase_idx` (`d_phase`),
  KEY `d_idx` (`p_design`),
  CONSTRAINT `d` FOREIGN KEY (`p_design`) REFERENCES `tblfurn_design` (`designID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p` FOREIGN KEY (`d_phase`) REFERENCES `tblphases` (`phaseID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbldesign_phase` VALUES("1","2","1","Active");
INSERT INTO `tbldesign_phase` VALUES("2","2","2","Active");
INSERT INTO `tbldesign_phase` VALUES("3","2","5","Active");
INSERT INTO `tbldesign_phase` VALUES("4","1","1","Active");
INSERT INTO `tbldesign_phase` VALUES("5","1","2","Active");
INSERT INTO `tbldesign_phase` VALUES("6","1","5","Active");
INSERT INTO `tbldesign_phase` VALUES("7","3","1","Active");
INSERT INTO `tbldesign_phase` VALUES("8","3","2","Active");
INSERT INTO `tbldesign_phase` VALUES("9","3","3","Active");
INSERT INTO `tbldesign_phase` VALUES("10","3","4","Active");
INSERT INTO `tbldesign_phase` VALUES("11","3","5","Active");



DROP TABLE IF EXISTS `tbldownpayment`;

CREATE TABLE `tbldownpayment` (
  `downpaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `downpaymentPercentage` double NOT NULL,
  PRIMARY KEY (`downpaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbldownpayment` VALUES("1","0.5");



DROP TABLE IF EXISTS `tblemp_job`;

CREATE TABLE `tblemp_job` (
  `emp_jobID` int(11) NOT NULL AUTO_INCREMENT,
  `emp_empID` int(11) NOT NULL,
  `emp_jobDescID` int(11) NOT NULL,
  `emp_jobStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`emp_jobID`),
  KEY `empName_idx` (`emp_empID`),
  KEY `jobName_idx` (`emp_jobDescID`),
  CONSTRAINT `empName` FOREIGN KEY (`emp_empID`) REFERENCES `tblemployee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jobName` FOREIGN KEY (`emp_jobDescID`) REFERENCES `tbljobs` (`jobID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tblemployee`;

CREATE TABLE `tblemployee` (
  `empID` int(11) NOT NULL AUTO_INCREMENT,
  `empFirstName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `empLastName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `empMidName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `empRemarks` varchar(100) CHARACTER SET utf8 NOT NULL,
  `empStatus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`empID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblemployee` VALUES("1","Aira","Coronado","Barrameda","An employee","Active");



DROP TABLE IF EXISTS `tblfabric_pattern`;

CREATE TABLE `tblfabric_pattern` (
  `f_patternID` int(11) NOT NULL AUTO_INCREMENT,
  `f_patternName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `f_patternRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `f_patternStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`f_patternID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfabric_pattern` VALUES("7","Floral","Combination of many flowers in one print","Listed");
INSERT INTO `tblfabric_pattern` VALUES("8","Sunflowers","Yellowish designs in the form of sunflowers","Listed");



DROP TABLE IF EXISTS `tblfabric_texture`;

CREATE TABLE `tblfabric_texture` (
  `textureID` int(11) NOT NULL AUTO_INCREMENT,
  `textureName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `textureDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `textureRating` int(11) DEFAULT NULL,
  `textureStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`textureID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfabric_texture` VALUES("13","Smooth","Smooth","1","Listed");
INSERT INTO `tblfabric_texture` VALUES("14","Very Smooth","Very smooth","4","Listed");
INSERT INTO `tblfabric_texture` VALUES("15","Smooth 3","Very very smooth","3","Listed");



DROP TABLE IF EXISTS `tblfabric_type`;

CREATE TABLE `tblfabric_type` (
  `f_typeID` int(11) NOT NULL AUTO_INCREMENT,
  `f_typeName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `f_typeWeaves` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `f_typeTextureID` int(11) NOT NULL,
  `f_typeStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`f_typeID`),
  KEY `texture_idx` (`f_typeTextureID`),
  CONSTRAINT `texture` FOREIGN KEY (`f_typeTextureID`) REFERENCES `tblfabric_texture` (`textureID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfabric_type` VALUES("4","Cotton","Heavily-Weaved","14","Listed");



DROP TABLE IF EXISTS `tblfabrics`;

CREATE TABLE `tblfabrics` (
  `fabricID` int(11) NOT NULL AUTO_INCREMENT,
  `fabricName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `fabricTypeID` int(11) NOT NULL,
  `fabricPatternID` int(11) NOT NULL,
  `fabricColor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fabricRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fabricPic` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fabricStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`fabricID`),
  KEY `ftype_idx` (`fabricTypeID`),
  KEY `fpattern_idx` (`fabricPatternID`),
  CONSTRAINT `fabric_type` FOREIGN KEY (`fabricTypeID`) REFERENCES `tblfabric_type` (`f_typeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pattern` FOREIGN KEY (`fabricPatternID`) REFERENCES `tblfabric_pattern` (`f_patternID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfabrics` VALUES("9","Gold Rani","4","8","Yellow and White","A soft weaved cotton fabric in yellow and white sunflowers pattern","2017-08-241503587847.png","Listed");



DROP TABLE IF EXISTS `tblframe_design`;

CREATE TABLE `tblframe_design` (
  `designID` int(11) NOT NULL AUTO_INCREMENT,
  `designName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `designDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `designStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`designID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblframe_design` VALUES("5","Victorian Classic"," A victorian classic design","Listed");
INSERT INTO `tblframe_design` VALUES("6","Checkered"," Checkered carving design","Listed");



DROP TABLE IF EXISTS `tblframe_material`;

CREATE TABLE `tblframe_material` (
  `materialID` int(11) NOT NULL AUTO_INCREMENT,
  `materialName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `materialRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `materialStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`materialID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblframe_material` VALUES("1","Narra Wood","Narra wood is a very sturdy kind of wood","Listed");
INSERT INTO `tblframe_material` VALUES("2","Mahogany Wood"," Mahogany Woods are amazing type of wood","Listed");



DROP TABLE IF EXISTS `tblframeworks`;

CREATE TABLE `tblframeworks` (
  `frameworkID` int(11) NOT NULL AUTO_INCREMENT,
  `frameworkFurnType` int(11) NOT NULL,
  `frameworkName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `frameworkPic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `framedesignID` int(11) NOT NULL,
  `materialUsedID` int(11) NOT NULL,
  `frameworkRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `frameworkStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`frameworkID`),
  KEY `design_idx` (`framedesignID`),
  KEY `material_idx` (`materialUsedID`),
  KEY `furn_type_idx` (`frameworkFurnType`),
  CONSTRAINT `design` FOREIGN KEY (`framedesignID`) REFERENCES `tblframe_design` (`designID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `furn_type` FOREIGN KEY (`frameworkFurnType`) REFERENCES `tblfurn_type` (`typeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `material` FOREIGN KEY (`materialUsedID`) REFERENCES `tblframe_material` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblframeworks` VALUES("9","15","Side Victorian Floral","2017-08-241503588358.png","5","1"," Victorian Floral Design on the sides","Listed");
INSERT INTO `tblframeworks` VALUES("10","17","Basic Frame","2017-08-241503588427.png","6","1"," Checkered basic design ","Listed");



DROP TABLE IF EXISTS `tblfurn_category`;

CREATE TABLE `tblfurn_category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `categoryStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `categoryRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfurn_category` VALUES("6","Living Room","Listed"," Living Area");
INSERT INTO `tblfurn_category` VALUES("7","Bedroom","Listed","Bedroom");
INSERT INTO `tblfurn_category` VALUES("8","Outdoor","Listed","Outdoor Furnitures");
INSERT INTO `tblfurn_category` VALUES("9","DIning Room","Listed"," Dining Area");
INSERT INTO `tblfurn_category` VALUES("10","Others","Listed"," ");



DROP TABLE IF EXISTS `tblfurn_design`;

CREATE TABLE `tblfurn_design` (
  `designID` int(11) NOT NULL AUTO_INCREMENT,
  `designName` varchar(45) CHARACTER SET latin1 NOT NULL,
  `designStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`designID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfurn_design` VALUES("1","Pure","Active");
INSERT INTO `tblfurn_design` VALUES("2","Weaved","Active");
INSERT INTO `tblfurn_design` VALUES("3","Upholstered","Active");



DROP TABLE IF EXISTS `tblfurn_type`;

CREATE TABLE `tblfurn_type` (
  `typeID` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `typeDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `typeStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `typeCategoryID` int(11) NOT NULL,
  PRIMARY KEY (`typeID`),
  KEY `furn_category_idx` (`typeCategoryID`),
  CONSTRAINT `furn_category` FOREIGN KEY (`typeCategoryID`) REFERENCES `tblfurn_category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblfurn_type` VALUES("13","Beds","A piece of furniture that people sleep on","Listed","7");
INSERT INTO `tblfurn_type` VALUES("14","Bedside Tables"," A piece of furniture usually found beside the bed. ","Listed","7");
INSERT INTO `tblfurn_type` VALUES("15","Accent Tables","Often used as a great decoration. Any piece of accent furniture worthy of being called that goes bey","Listed","6");
INSERT INTO `tblfurn_type` VALUES("16","Display and Utility Cabinets","Piece of furniture that usually has doors and shelves","Listed","6");
INSERT INTO `tblfurn_type` VALUES("17","Sectional Sofas"," A huge L shaped couch that takes up most of the living room","Listed","6");
INSERT INTO `tblfurn_type` VALUES("18","Bar Folding Pantry Table","Tables usually found in the kitchen or dining area","Listed","9");
INSERT INTO `tblfurn_type` VALUES("19","Dining Chair","Chairs that surrounds the dining table. Found in the dining area.","Listed","9");
INSERT INTO `tblfurn_type` VALUES("20","Dining Table"," Tables for the dining area","Listed","9");
INSERT INTO `tblfurn_type` VALUES("21","Side Table"," Table beside the bed","Listed","7");



DROP TABLE IF EXISTS `tblinvoicedetails`;

CREATE TABLE `tblinvoicedetails` (
  `invoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `invorderID` int(11) NOT NULL,
  `balance` double NOT NULL,
  `dateIssued` date NOT NULL,
  `invoiceStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `invoiceRemarks` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `invDelrateID` int(11) DEFAULT NULL,
  `invPenID` int(11) DEFAULT NULL,
  PRIMARY KEY (`invoiceID`),
  KEY `orderinv_idx` (`invorderID`),
  CONSTRAINT `orderinv` FOREIGN KEY (`invorderID`) REFERENCES `tblorders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblinvoicedetails` VALUES("1","1","105000","2017-08-28","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("2","6","35000","2017-08-29","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("3","7","35000","2017-08-29","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("4","8","105000","2017-08-29","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("5","9","120000","2017-08-30","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("6","10","25000","2017-08-30","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("7","11","60000","2017-09-24","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("8","12","100000","2017-10-02","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("9","13","100000","2017-10-02","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("10","17","25000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("11","18","105000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("12","19","50000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("13","20","35000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("14","21","35000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("15","22","25000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("16","23","50000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("17","24","35000","2017-10-04","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("18","25","25000","2017-10-05","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("19","26","25000","2017-10-05","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("20","27","25000","2017-10-05","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("21","28","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("22","29","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("23","30","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("24","31","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("25","32","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("26","33","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("27","34","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("28","35","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("29","36","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("30","37","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("31","38","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("32","39","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("33","40","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("34","41","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("35","42","115000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("36","43","90000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("37","44","35000","2017-10-10","Pending","Initial Invoice","0","0");
INSERT INTO `tblinvoicedetails` VALUES("38","46","25000","2017-10-12","Pending","Initial Invoice","0","1");



DROP TABLE IF EXISTS `tbljobs`;

CREATE TABLE `tbljobs` (
  `jobID` int(11) NOT NULL AUTO_INCREMENT,
  `jobName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `jobDescription` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `jobStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`jobID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbljobs` VALUES("7","Carpenter","Build the frame of the furniture. Also carved if the employee can.","Listed");
INSERT INTO `tbljobs` VALUES("8","Carver","Carved the specified design of the furniture on the frames or carved the furniture to be in shape","Listed");
INSERT INTO `tbljobs` VALUES("9","Upholsterer","Sew the fabrics on the furniture, also the one who fills the foam on every sofa-like or upholstered ","Listed");



DROP TABLE IF EXISTS `tbllogs`;

CREATE TABLE `tbllogs` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(250) CHARACTER SET latin1 NOT NULL,
  `action` varchar(150) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `description` varchar(450) CHARACTER SET latin1 NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`logID`),
  KEY `user_idx` (`userID`),
  CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbllogs` VALUES("8","Supplier","New","2017-08-24","Added new supplier SMENT Fabrics and Prints, ID = 16","1");
INSERT INTO `tbllogs` VALUES("9","Supplier","Update","2017-08-24","Updated supplier SMENT Fabrics and Prints, ID = 16","1");
INSERT INTO `tbllogs` VALUES("10","Category","New","2017-08-24","Added new category Living Room, ID = 6","1");
INSERT INTO `tbllogs` VALUES("11","Category","New","2017-08-24","Added new category Bedroom, ID = 7","1");
INSERT INTO `tbllogs` VALUES("12","Category","New","2017-08-24","Added new category Outdoor, ID = 8","1");
INSERT INTO `tbllogs` VALUES("13","Category","New","2017-08-24","Added new category DIning Room, ID = 9","1");
INSERT INTO `tbllogs` VALUES("14","Furniture Type","New","2017-08-24","Added new furniture type Beds, ID = 13","1");
INSERT INTO `tbllogs` VALUES("15","Furniture Type","New","2017-08-24","Added new furniture type Bedside Tables, ID = 14","1");
INSERT INTO `tbllogs` VALUES("16","Furniture Type","Update","2017-08-24","Updated furniture type Bedside Tables, ID = 14","1");
INSERT INTO `tbllogs` VALUES("17","Furniture Type","Update","2017-08-24","Updated furniture type Bedside Tables, ID = 14","1");
INSERT INTO `tbllogs` VALUES("18","Furniture Type","New","2017-08-24","Added new furniture type Accent Tables, ID = 15","1");
INSERT INTO `tbllogs` VALUES("19","Furniture Type","New","2017-08-24","Added new furniture type Display and Utility Cabinets, ID = 16","1");
INSERT INTO `tbllogs` VALUES("20","Furniture Type","New","2017-08-24","Added new furniture type Sectional Sofas, ID = 17","1");
INSERT INTO `tbllogs` VALUES("21","Furniture Type","New","2017-08-24","Added new furniture type Bar Folding Pantry Table, ID = 18","1");
INSERT INTO `tbllogs` VALUES("22","Furniture Type","New","2017-08-24","Added new furniture type Dining Chair, ID = 19","1");
INSERT INTO `tbllogs` VALUES("23","Furniture Type","New","2017-08-24","Added new furniture type Dining Table, ID = 20","1");
INSERT INTO `tbllogs` VALUES("24","Fabric Texture","New","2017-08-24","Added new fabric texture Smooth, ID = 13","1");
INSERT INTO `tbllogs` VALUES("25","Fabric Texture","New","2017-08-24","Added new fabric texture Very Smooth, ID = 14","1");
INSERT INTO `tbllogs` VALUES("26","Fabric Type","New","2017-08-24","Added new fabric type Cotton, ID = 4","1");
INSERT INTO `tbllogs` VALUES("27","Fabric Pattern","New","2017-08-24","Added new fabric pattern Floral, ID = 7","1");
INSERT INTO `tbllogs` VALUES("28","Fabric Pattern","New","2017-08-24","Added new fabric pattern Sunflowers, ID = 8","1");
INSERT INTO `tbllogs` VALUES("29","Fabric Pattern","Update","2017-08-24","Updated fabric pattern Floral, ID = 7","1");
INSERT INTO `tbllogs` VALUES("30","Fabrics Formed","New","2017-08-24","Added new fabric Gold Rani, ID = 9","1");
INSERT INTO `tbllogs` VALUES("31","Frame Design","New","2017-08-24","Added new frame design Victorian Classic, ID = 5","1");
INSERT INTO `tbllogs` VALUES("32","Frame Design","New","2017-08-24","Added new frame design Checkered, ID = 6","1");
INSERT INTO `tbllogs` VALUES("33","Frame Material","Update","2017-08-24","Updated frame material Narra Wood, ID = 1","1");
INSERT INTO `tbllogs` VALUES("34","Frameworks","New","2017-08-24","Added new framework Side Victorian Floral, ID = 9","1");
INSERT INTO `tbllogs` VALUES("35","Frameworks","New","2017-08-24","Added new framework Basic Frame, ID = 10","1");
INSERT INTO `tbllogs` VALUES("36","Products","New","2017-08-24","Added new product Queen, ID = 16","1");
INSERT INTO `tbllogs` VALUES("37","Jobs","New","2017-08-24","Added new job Carpenter, ID = 7","1");
INSERT INTO `tbllogs` VALUES("38","Jobs","New","2017-08-24","Added new job Carver, ID = 8","1");
INSERT INTO `tbllogs` VALUES("39","Jobs","New","2017-08-24","Added new job Upholsterer, ID = 9","1");
INSERT INTO `tbllogs` VALUES("40","Jobs","Update","2017-08-24","Updated job Upholsterer, ID = 9","1");
INSERT INTO `tbllogs` VALUES("41","Promos","New","2017-08-24","Added new promo Grand Opening Promo, ID = 0","1");
INSERT INTO `tbllogs` VALUES("42","Promos","New","2017-08-24","Added new promo Grand Opening Promo, ID = 6","1");
INSERT INTO `tbllogs` VALUES("43","Delivery Rates","New","2017-08-24","Added new delivery rate 1000, ID = 5","1");
INSERT INTO `tbllogs` VALUES("44","Delivery Rates","New","2017-08-24","Added new delivery rate 3000, ID = 6","1");
INSERT INTO `tbllogs` VALUES("45","Category","New","2017-08-24","Added new category Others, ID = 10","1");
INSERT INTO `tbllogs` VALUES("46","Category","New","2017-08-25","Added new category , ID = 11","1");
INSERT INTO `tbllogs` VALUES("47","Unit of Measurement","New","2017-08-26","Added new unit of measurement Feet, ID = 14","1");
INSERT INTO `tbllogs` VALUES("48","Unit of Measurement","New","2017-08-26","Added new unit of measurement Meter, ID = 15","1");
INSERT INTO `tbllogs` VALUES("49","Unit of Measurement Category","New","2017-08-26","Added new unit of measurement category Length, ID = 11","1");
INSERT INTO `tbllogs` VALUES("50","Material Attribute","New","2017-08-26","Added new material attribute Size, ID = 8","1");
INSERT INTO `tbllogs` VALUES("51","Material Type","New","2017-08-26","Added new material type Wood, ID = 1","1");
INSERT INTO `tbllogs` VALUES("52","Materials","New","2017-08-26","Added new material FNC, ID = 10","1");
INSERT INTO `tbllogs` VALUES("53","Material Type","New","2017-08-26","Added new material type Fabric, ID = 2","1");
INSERT INTO `tbllogs` VALUES("54","Material Type","New","2017-08-26","Added new material type Paint, ID = 3","1");
INSERT INTO `tbllogs` VALUES("55","Material Type","New","2017-08-26","Added new material type Varnish, ID = 4","1");
INSERT INTO `tbllogs` VALUES("56","Material Type","New","2017-08-26","Added new material type Rattan, ID = 5","1");
INSERT INTO `tbllogs` VALUES("57","Supplier","New","2017-08-27","Added new supplier AA, ID = 17","4");
INSERT INTO `tbllogs` VALUES("58","Order","New","2017-08-28","New order #OR83","1");
INSERT INTO `tbllogs` VALUES("59","Order","New","2017-08-28","New order #OR84","1");
INSERT INTO `tbllogs` VALUES("60","Order","New","2017-08-28","New order #OR000085","1");
INSERT INTO `tbllogs` VALUES("61","Order","New","2017-08-28","New order #OR000086","1");
INSERT INTO `tbllogs` VALUES("62","Order","New","2017-08-28","New order #OR000087","1");
INSERT INTO `tbllogs` VALUES("63","Order","New","2017-08-28","New order #OR000088","1");
INSERT INTO `tbllogs` VALUES("64","Order","New","2017-08-28","New order #OR000089","1");
INSERT INTO `tbllogs` VALUES("65","Order","New","2017-08-28","New order #OR000090","1");
INSERT INTO `tbllogs` VALUES("66","Order","New","2017-08-28","New order #OR000091","1");
INSERT INTO `tbllogs` VALUES("67","Order","New","2017-08-28","New order #OR000092","1");
INSERT INTO `tbllogs` VALUES("68","Order","New","2017-08-28","New order #OR000093","1");
INSERT INTO `tbllogs` VALUES("69","Order","New","2017-08-28","New order #OR000094","1");
INSERT INTO `tbllogs` VALUES("70","Order","New","2017-08-28","New order #OR000095","1");
INSERT INTO `tbllogs` VALUES("71","Order","New","2017-08-28","New order #OR000096","1");
INSERT INTO `tbllogs` VALUES("72","Products","New","2017-08-28","Added new product Elizabeth, ID = 17","1");
INSERT INTO `tbllogs` VALUES("73","Products","Update","2017-08-28","Updated product Queen, ID = 16","1");
INSERT INTO `tbllogs` VALUES("74","Order","New","2017-08-28","New order #OR000001","1");
INSERT INTO `tbllogs` VALUES("75","Unit of Measurement Category","New","2017-08-29","Added new unit of measurement category Area, ID = 13","1");
INSERT INTO `tbllogs` VALUES("76","Unit of Measurement Category","New","2017-08-29","Added new unit of measurement category Weight, ID = 14","1");
INSERT INTO `tbllogs` VALUES("77","Unit of Measurement","New","2017-08-29","Added new unit of measurement Gram, ID = 16","1");
INSERT INTO `tbllogs` VALUES("78","Unit of Measurement Category","Deactivate","2017-08-29","Deactivated unit of measurement category , ID = 13","1");
INSERT INTO `tbllogs` VALUES("79","Unit of Measurement","New","2017-08-29","Added new unit of measurement Inch, ID = 17","1");
INSERT INTO `tbllogs` VALUES("80","Material Attribute","Deactivate","2017-08-29","Deactivated material attribute , ID = 8","1");
INSERT INTO `tbllogs` VALUES("81","Material Attribute","New","2017-08-29","Added new material attribute Color, ID = 9","1");
INSERT INTO `tbllogs` VALUES("82","Material Attribute","New","2017-08-29","Added new material attribute Type, ID = 10","1");
INSERT INTO `tbllogs` VALUES("83","Material Attribute","New","2017-08-29","Added new material attribute Weight, ID = 11","1");
INSERT INTO `tbllogs` VALUES("84","Materials","New","2017-08-29","Added new material Liza Varnish, ID = 11","1");
INSERT INTO `tbllogs` VALUES("85","Materials","New","2017-08-29","Added new material Mela Varnish, ID = 12","1");
INSERT INTO `tbllogs` VALUES("86","Supplier","Update","2017-08-29","Updated supplier FNCENT Trees and Woods Inc., ID = 15","1");
INSERT INTO `tbllogs` VALUES("87","Supplier","Update","2017-08-29","Updated supplier AA, ID = 17","1");
INSERT INTO `tbllogs` VALUES("88","Products","New","2017-08-30","Added new product Manilenia, ID = 18","1");
INSERT INTO `tbllogs` VALUES("89","Products","Update","2017-08-30","Updated product Manilenia, ID = 18","1");
INSERT INTO `tbllogs` VALUES("90","Order","New","2017-08-30","New order #OR000009","1");
INSERT INTO `tbllogs` VALUES("91","Delivery Rates","New","2017-08-30","Added new delivery rate 400, ID = 7","1");
INSERT INTO `tbllogs` VALUES("92","Material Type","New","2017-09-23","Added new material type Foam, ID = 6","1");
INSERT INTO `tbllogs` VALUES("93","Materials","New","2017-09-23","Added new material Uratex Foam, ID = 13","1");
INSERT INTO `tbllogs` VALUES("94","Material Variants","New","2017-09-23","Added new material variant 13, ID = ","1");
INSERT INTO `tbllogs` VALUES("95","Material Variants","New","2017-09-23","Added new material variant 12, ID = ","1");
INSERT INTO `tbllogs` VALUES("96","Supplier","New","2017-09-25","Added new supplier l;efjdor2093729ueij, ID = 18","1");
INSERT INTO `tbllogs` VALUES("97","Furniture Type","New","2017-09-25","Added new furniture type Side Table, ID = 21","1");
INSERT INTO `tbllogs` VALUES("98","Fabric Texture","New","2017-09-25","Added new fabric texture Smooth 3, ID = 15","1");
INSERT INTO `tbllogs` VALUES("99","Fabric Texture","Update","2017-09-25","Updated fabric texture Very Smooth, ID = 14","1");
INSERT INTO `tbllogs` VALUES("100","Fabric Texture","Update","2017-09-25","Updated fabric texture Smooth, ID = 13","1");
INSERT INTO `tbllogs` VALUES("101","Frame Material","New","2017-09-25","Added new frame material Mahogany Wood, ID = 2","1");
INSERT INTO `tbllogs` VALUES("102","Jobs","Update","2017-09-25","Updated job Carpenter, ID = 7","1");
INSERT INTO `tbllogs` VALUES("103","Employees","Update","2017-09-25","Updated employee Aira Barrameda Coronado, ID = 1","1");
INSERT INTO `tbllogs` VALUES("104","Material Attribute","New","2017-10-01","Added new material attribute Dimension, ID = 12","1");
INSERT INTO `tbllogs` VALUES("105","Unit of Measurement","New","2017-10-01","Added new unit of measurement Pieces, ID = 18","1");
INSERT INTO `tbllogs` VALUES("106","Unit of Measurement","New","2017-10-01","Added new unit of measurement Centimeters, ID = 25","1");
INSERT INTO `tbllogs` VALUES("107","Material Variants","New","2017-10-01","Added new material variant 16, ID = ","1");
INSERT INTO `tbllogs` VALUES("108","Material Variants","New","2017-10-01","Added new material variant 15, ID = ","1");
INSERT INTO `tbllogs` VALUES("109","Material Variants","New","2017-10-01","Added new material variant 18, ID = ","1");
INSERT INTO `tbllogs` VALUES("110","Material Variants","New","2017-10-01","Added new material variant 18, ID = ","1");
INSERT INTO `tbllogs` VALUES("111","Production Information","New","2017-10-01","Added new production information 18, ID = 6","1");
INSERT INTO `tbllogs` VALUES("112","Production Information","New","2017-10-02","Added new production information 18, ID = 8","1");
INSERT INTO `tbllogs` VALUES("113","Production Information","Deactivate","2017-10-02","Deactivated production information , ID = 1","1");
INSERT INTO `tbllogs` VALUES("114","Order","New","2017-10-02","New order #OR000000","1");
INSERT INTO `tbllogs` VALUES("115","Order","New","2017-10-02","New order #OR000012","1");
INSERT INTO `tbllogs` VALUES("116","Order","New","2017-10-02","New order #OR000013","1");
INSERT INTO `tbllogs` VALUES("117","Order","New","2017-10-03","New management order #OR000000","1");
INSERT INTO `tbllogs` VALUES("118","Order","New","2017-10-03","New management order #OR000000","1");
INSERT INTO `tbllogs` VALUES("119","Order","New","2017-10-03","New management order #OR000016","1");
INSERT INTO `tbllogs` VALUES("120","Order","New","2017-10-04","New order #OR000017","1");
INSERT INTO `tbllogs` VALUES("121","Order","New","2017-10-04","New order #OR000018","1");
INSERT INTO `tbllogs` VALUES("122","Order","New","2017-10-04","New order #OR000019","1");
INSERT INTO `tbllogs` VALUES("123","Order","New","2017-10-04","New order #OR000020","1");
INSERT INTO `tbllogs` VALUES("124","Order","New","2017-10-04","New order #OR000021","1");
INSERT INTO `tbllogs` VALUES("125","Order","New","2017-10-04","New order #OR000022","1");
INSERT INTO `tbllogs` VALUES("126","Order","New","2017-10-04","New order #OR000023","1");
INSERT INTO `tbllogs` VALUES("127","Order","New","2017-10-04","New order #OR000024","1");
INSERT INTO `tbllogs` VALUES("128","Production Information","New","2017-10-08","Added new production information 17, ID = 10","1");
INSERT INTO `tbllogs` VALUES("129","Material Deliveries","New","2017-10-10","Added new frame material , ID = 2","1");
INSERT INTO `tbllogs` VALUES("130","Material Deliveries","New","2017-10-10","Added new frame material , ID = 8","1");
INSERT INTO `tbllogs` VALUES("131","Material Deliveries","New","2017-10-10","Added new frame material , ID = 0","1");
INSERT INTO `tbllogs` VALUES("132","Material Deliveries","New","2017-10-10","Added new frame material , ID = 9","1");
INSERT INTO `tbllogs` VALUES("133","Material Deliveries","New","2017-10-10","Added new frame material , ID = 10","1");
INSERT INTO `tbllogs` VALUES("134","Packages","New","2017-10-10","Added new packages Fabulous Package, ID = 0","1");
INSERT INTO `tbllogs` VALUES("135","Order","New","2017-10-10","New order #OR000028","1");
INSERT INTO `tbllogs` VALUES("136","Order","New","2017-10-10","New order #OR000029","1");
INSERT INTO `tbllogs` VALUES("137","Order","New","2017-10-10","New order #OR000030","1");
INSERT INTO `tbllogs` VALUES("138","Order","New","2017-10-10","New order #OR000031","1");
INSERT INTO `tbllogs` VALUES("139","Order","New","2017-10-10","New order #OR000032","1");
INSERT INTO `tbllogs` VALUES("140","Order","New","2017-10-10","New order #OR000033","1");
INSERT INTO `tbllogs` VALUES("141","Order","New","2017-10-10","New order #OR000034","1");
INSERT INTO `tbllogs` VALUES("142","Order","New","2017-10-10","New order #OR000035","1");
INSERT INTO `tbllogs` VALUES("143","Order","New","2017-10-10","New order #OR000036","1");
INSERT INTO `tbllogs` VALUES("144","Order","New","2017-10-10","New order #OR000037","1");
INSERT INTO `tbllogs` VALUES("145","Order","New","2017-10-10","New order #OR000038","1");
INSERT INTO `tbllogs` VALUES("146","Order","New","2017-10-10","New order #OR000039","1");
INSERT INTO `tbllogs` VALUES("147","Order","New","2017-10-10","New order #OR000040","1");
INSERT INTO `tbllogs` VALUES("148","Order","New","2017-10-10","New order #OR000041","1");
INSERT INTO `tbllogs` VALUES("149","Order","New","2017-10-10","New order #OR000042","1");
INSERT INTO `tbllogs` VALUES("150","Order","New","2017-10-10","New order #OR000043","1");
INSERT INTO `tbllogs` VALUES("151","Order","New","2017-10-10","New order #OR000044","1");
INSERT INTO `tbllogs` VALUES("152","Order","New","2017-10-11","New management order #OR000045","1");
INSERT INTO `tbllogs` VALUES("153","Order","New","2017-10-12","New order #OR000046","1");



DROP TABLE IF EXISTS `tblmat_actions`;

CREATE TABLE `tblmat_actions` (
  `mat_actionsID` int(11) NOT NULL AUTO_INCREMENT,
  `mat_intID` int(11) NOT NULL,
  `mat_quantity` int(11) NOT NULL,
  `mat_actionRemarks` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`mat_actionsID`),
  KEY `matInventory_idx` (`mat_intID`),
  CONSTRAINT `matInventory` FOREIGN KEY (`mat_intID`) REFERENCES `tblmat_inventory` (`mat_inventoryID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `tblmat_deductdetails`;

CREATE TABLE `tblmat_deductdetails` (
  `mat_deductID` int(11) NOT NULL AUTO_INCREMENT,
  `mat_inventoryID` int(11) NOT NULL,
  `mat_deductQuantity` int(11) NOT NULL,
  `mat_deductRemarks` varchar(45) NOT NULL,
  PRIMARY KEY (`mat_deductID`),
  KEY `mat_inventoryID` (`mat_inventoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `tblmat_deliveries`;

CREATE TABLE `tblmat_deliveries` (
  `mat_deliveriesID` int(11) NOT NULL AUTO_INCREMENT,
  `supplierID` int(11) NOT NULL,
  `totalQuantity` int(11) NOT NULL,
  `mat_deliveryRemarks` varchar(450) NOT NULL,
  `mat_deliveryStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`mat_deliveriesID`),
  KEY `supplier_idx` (`supplierID`),
  CONSTRAINT `supplier` FOREIGN KEY (`supplierID`) REFERENCES `tblsupplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `tblmat_deliveries` VALUES("1","16","750","Listed","Listed");
INSERT INTO `tblmat_deliveries` VALUES("2","17","600","Listed","Listed");
INSERT INTO `tblmat_deliveries` VALUES("3","17","1","Listed","Listed");
INSERT INTO `tblmat_deliveries` VALUES("4","17","500","Listed","Listed");
INSERT INTO `tblmat_deliveries` VALUES("5","17","500","Listed","Listed");



DROP TABLE IF EXISTS `tblmat_deliverydetails`;

CREATE TABLE `tblmat_deliverydetails` (
  `del_detailsID` int(11) NOT NULL AUTO_INCREMENT,
  `del_matDelID` int(11) NOT NULL,
  `del_matVarID` int(11) NOT NULL,
  `del_quantity` int(11) NOT NULL,
  `del_remarks` varchar(450) NOT NULL,
  PRIMARY KEY (`del_detailsID`),
  KEY `matDeliveries_idx` (`del_matDelID`),
  KEY `matVarID_idx` (`del_matVarID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `tblmat_deliverydetails` VALUES("1","1","321","500","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("2","1","322","250","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("3","2","264","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("4","2","263","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("5","2","265","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("6","2","266","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("7","2","267","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("8","2","268","100","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("9","3","263","1","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("10","4","257","500","Listed");
INSERT INTO `tblmat_deliverydetails` VALUES("11","5","313","500","Listed");



DROP TABLE IF EXISTS `tblmat_inventory`;

CREATE TABLE `tblmat_inventory` (
  `mat_inventoryID` int(11) NOT NULL AUTO_INCREMENT,
  `matVariantID` int(11) NOT NULL,
  `matVarQuantity` int(11) NOT NULL,
  PRIMARY KEY (`mat_inventoryID`),
  KEY `matVariant_idx` (`matVariantID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `tblmat_inventory` VALUES("1","321","500");
INSERT INTO `tblmat_inventory` VALUES("2","322","250");
INSERT INTO `tblmat_inventory` VALUES("3","264","100");
INSERT INTO `tblmat_inventory` VALUES("4","263","101");
INSERT INTO `tblmat_inventory` VALUES("5","265","100");
INSERT INTO `tblmat_inventory` VALUES("6","266","100");
INSERT INTO `tblmat_inventory` VALUES("7","267","100");
INSERT INTO `tblmat_inventory` VALUES("8","268","100");
INSERT INTO `tblmat_inventory` VALUES("9","257","500");
INSERT INTO `tblmat_inventory` VALUES("10","313","496");



DROP TABLE IF EXISTS `tblmat_type`;

CREATE TABLE `tblmat_type` (
  `matTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `matTypeName` varchar(450) CHARACTER SET latin1 NOT NULL,
  `matTypeMeasure` varchar(450) CHARACTER SET latin1 NOT NULL,
  `matTypeRemarks` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `matTypeStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`matTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblmat_type` VALUES("1","Wood","measuring is on materials","Wood","Listed");
INSERT INTO `tblmat_type` VALUES("2","Fabric","measuring is on materials","Fabric","Listed");
INSERT INTO `tblmat_type` VALUES("3","Paint","measuring is on materials","Paint","Listed");
INSERT INTO `tblmat_type` VALUES("4","Varnish","measuring is on materials","Varnish","Listed");
INSERT INTO `tblmat_type` VALUES("5","Rattan","measuring is on materials","Rattan","Listed");
INSERT INTO `tblmat_type` VALUES("6","Foam","measuring is on materials","","Listed");



DROP TABLE IF EXISTS `tblmat_var`;

CREATE TABLE `tblmat_var` (
  `mat_varID` int(11) NOT NULL AUTO_INCREMENT,
  `materialID` int(11) NOT NULL,
  `mat_varDescription` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `mat_varStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`mat_varID`),
  KEY `material_idx` (`materialID`),
  CONSTRAINT `m` FOREIGN KEY (`materialID`) REFERENCES `tblmaterials` (`materialID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblmat_var` VALUES("257","11","Odorless  / brown ","Active");
INSERT INTO `tblmat_var` VALUES("258","11","Odorless  / red ","Active");
INSERT INTO `tblmat_var` VALUES("259","11","Odorless  / transparent ","Active");
INSERT INTO `tblmat_var` VALUES("260","11","Original  / brown ","Active");
INSERT INTO `tblmat_var` VALUES("261","11","Original  / red ","Active");
INSERT INTO `tblmat_var` VALUES("262","11","Original  / transparent ","Active");
INSERT INTO `tblmat_var` VALUES("263","13","White  / Feather ","Active");
INSERT INTO `tblmat_var` VALUES("264","13","White  / Spring ","Active");
INSERT INTO `tblmat_var` VALUES("265","13","Pink  / Feather ","Active");
INSERT INTO `tblmat_var` VALUES("266","13","Pink  / Spring ","Active");
INSERT INTO `tblmat_var` VALUES("267","13","Blue  / Feather ","Active");
INSERT INTO `tblmat_var` VALUES("268","13","Blue  / Spring ","Active");
INSERT INTO `tblmat_var` VALUES("269","12","white  / odorless  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("270","12","white  / odorless  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("271","12","white  / odorless  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("272","12","white  / odorless  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("273","12","white  / odorless  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("274","12","white  / original  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("275","12","white  / original  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("276","12","white  / original  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("277","12","white  / original  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("278","12","white  / original  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("279","12","blue  / odorless  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("280","12","blue  / odorless  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("281","12","blue  / odorless  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("282","12","blue  / odorless  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("283","12","blue  / odorless  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("284","12","blue  / original  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("285","12","blue  / original  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("286","12","blue  / original  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("287","12","blue  / original  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("288","12","blue  / original  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("289","12","pink  / odorless  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("290","12","pink  / odorless  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("291","12","pink  / odorless  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("292","12","pink  / odorless  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("293","12","pink  / odorless  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("294","12","pink  / original  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("295","12","pink  / original  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("296","12","pink  / original  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("297","12","pink  / original  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("298","12","pink  / original  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("299","12","green  / odorless  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("300","12","green  / odorless  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("301","12","green  / odorless  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("302","12","green  / odorless  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("303","12","green  / odorless  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("304","12","green  / original  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("305","12","green  / original  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("306","12","green  / original  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("307","12","green  / original  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("308","12","green  / original  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("309","12","purple  / odorless  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("310","12","purple  / odorless  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("311","12","purple  / odorless  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("312","12","purple  / odorless  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("313","12","purple  / odorless  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("314","12","purple  / original  / 25 g","Active");
INSERT INTO `tblmat_var` VALUES("315","12","purple  / original  / 35 g","Active");
INSERT INTO `tblmat_var` VALUES("316","12","purple  / original  / 45 g","Active");
INSERT INTO `tblmat_var` VALUES("317","12","purple  / original  / 55 g","Active");
INSERT INTO `tblmat_var` VALUES("318","12","purple  / original  / 65 g","Active");
INSERT INTO `tblmat_var` VALUES("319","16","White  / Odorless ","Active");
INSERT INTO `tblmat_var` VALUES("320","16","Brown  / Odorless ","Active");
INSERT INTO `tblmat_var` VALUES("321","15","Red  / Soft ","Active");
INSERT INTO `tblmat_var` VALUES("322","15","Yellow Green  / Soft ","Active");
INSERT INTO `tblmat_var` VALUES("323","18","Brown ","Active");
INSERT INTO `tblmat_var` VALUES("324","18","Light-Brown ","Active");
INSERT INTO `tblmat_var` VALUES("325","18","20 ","Active");
INSERT INTO `tblmat_var` VALUES("326","18","50 ","Active");
INSERT INTO `tblmat_var` VALUES("327","18","150 ","Active");



DROP TABLE IF EXISTS `tblmaterials`;

CREATE TABLE `tblmaterials` (
  `materialID` int(11) NOT NULL AUTO_INCREMENT,
  `materialType` int(11) NOT NULL,
  `materialName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `materialMeasurement` varchar(450) CHARACTER SET utf8 NOT NULL,
  `materialStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `dateCreated` date DEFAULT NULL,
  PRIMARY KEY (`materialID`),
  KEY `matType_idx` (`materialType`),
  CONSTRAINT `matType` FOREIGN KEY (`materialType`) REFERENCES `tblmat_type` (`matTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblmaterials` VALUES("10","1","Narra Wood","","Listed","");
INSERT INTO `tblmaterials` VALUES("11","4","Liza Varnish","","Listed","");
INSERT INTO `tblmaterials` VALUES("12","4","Mela Varnish","","Listed","");
INSERT INTO `tblmaterials` VALUES("13","6","Uratex Foam","","Listed","");
INSERT INTO `tblmaterials` VALUES("14","2","Lira Leather","","Listed","");
INSERT INTO `tblmaterials` VALUES("15","2","Hyena Cotton","","Listed","");
INSERT INTO `tblmaterials` VALUES("16","3","Boysen Paint","","Listed","");
INSERT INTO `tblmaterials` VALUES("17","3","Canon Paint","","Listed","");
INSERT INTO `tblmaterials` VALUES("18","5","Viola","","Listed","");



DROP TABLE IF EXISTS `tblmodeofpayment`;

CREATE TABLE `tblmodeofpayment` (
  `modeofpaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `modeofpaymentDesc` varchar(45) CHARACTER SET utf8 NOT NULL,
  `modeofpaymentStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`modeofpaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblmodeofpayment` VALUES("1","Cash","Active");
INSERT INTO `tblmodeofpayment` VALUES("2","Check","Active");
INSERT INTO `tblmodeofpayment` VALUES("3","Deposit Slip","Active");



DROP TABLE IF EXISTS `tblnotification`;

CREATE TABLE `tblnotification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tblcustomerID` int(11) NOT NULL,
  `tblorderID` int(11) NOT NULL,
  `amountPaid` double NOT NULL,
  `datePaid` date NOT NULL,
  `bankBranch` varchar(450) NOT NULL,
  `proofPicture` varchar(450) NOT NULL,
  `notifStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerid_ref_idx` (`tblcustomerID`),
  KEY `orderid_ref_idx` (`tblorderID`),
  CONSTRAINT `customerid_ref` FOREIGN KEY (`tblcustomerID`) REFERENCES `tblcustomer` (`customerID`) ON UPDATE CASCADE,
  CONSTRAINT `orderid_ref` FOREIGN KEY (`tblorderID`) REFERENCES `tblorders` (`orderID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tblnotification` VALUES("1","34","44","25000","2017-10-10","BDO","2017-10-101507655702.png","Confirmed");



DROP TABLE IF EXISTS `tblonhand`;

CREATE TABLE `tblonhand` (
  `onHandID` int(11) NOT NULL AUTO_INCREMENT,
  `ohProdID` int(11) NOT NULL,
  `ohQuantity` int(11) NOT NULL,
  `ohRemarks` varchar(450) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`onHandID`),
  KEY `product_idx` (`ohProdID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblonhand` VALUES("3","17","6","");
INSERT INTO `tblonhand` VALUES("4","18","10","");



DROP TABLE IF EXISTS `tblorder_actions`;

CREATE TABLE `tblorder_actions` (
  `orActionID` int(11) NOT NULL AUTO_INCREMENT,
  `orOrderID` int(11) NOT NULL,
  `orAction` varchar(450) CHARACTER SET latin1 NOT NULL,
  `orReason` varchar(450) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`orActionID`),
  KEY `ordertbl_idx` (`orOrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblorder_actions` VALUES("3","4","Cancelled","No reason.");



DROP TABLE IF EXISTS `tblorder_customization`;

CREATE TABLE `tblorder_customization` (
  `orCustID` int(11) NOT NULL AUTO_INCREMENT,
  `orOrderReqID` int(11) NOT NULL,
  `orFabricID` int(11) DEFAULT NULL,
  `orFrameworkID` int(11) DEFAULT NULL,
  `orSizeSpecs` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `orDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`orCustID`,`orOrderReqID`),
  KEY `orderReq_idx` (`orOrderReqID`),
  KEY `fabricReq_idx` (`orFabricID`),
  KEY `frameworkReq_idx` (`orFrameworkID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tblorder_request`;

CREATE TABLE `tblorder_request` (
  `order_requestID` int(11) NOT NULL AUTO_INCREMENT,
  `tblOrdersID` int(11) NOT NULL,
  `orderProductID` int(11) DEFAULT NULL,
  `prodUnitPrice` double NOT NULL,
  `orderRemarks` int(11) NOT NULL,
  `orderPackageID` int(11) DEFAULT NULL,
  `orderQuantity` int(11) NOT NULL,
  `orderRequestStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`order_requestID`),
  KEY `prod_idx` (`orderProductID`),
  KEY `order_idx` (`tblOrdersID`),
  KEY `pack_idx` (`orderPackageID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblorder_request` VALUES("1","1","17","35000","0","","3","Archived");
INSERT INTO `tblorder_request` VALUES("3","6","17","35000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("4","6","17","35000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("5","7","17","35000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("6","8","17","35000","0","","3","Released");
INSERT INTO `tblorder_request` VALUES("7","9","17","35000","0","","2","Active");
INSERT INTO `tblorder_request` VALUES("8","9","16","50000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("9","10","18","25000","0","","2","Ready for release");
INSERT INTO `tblorder_request` VALUES("10","10","18","25000","0","","1","Deleted");
INSERT INTO `tblorder_request` VALUES("11","10","17","0","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("12","11","18","25000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("13","11","17","35000","0","","4","Released");
INSERT INTO `tblorder_request` VALUES("14","12","16","50000","0","","2","Active");
INSERT INTO `tblorder_request` VALUES("15","13","16","50000","0","","2","Active");
INSERT INTO `tblorder_request` VALUES("16","16","18","25000","0","","1","Finished");
INSERT INTO `tblorder_request` VALUES("17","17","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("18","18","17","35000","0","","3","Active");
INSERT INTO `tblorder_request` VALUES("19","19","16","50000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("20","20","17","35000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("21","21","17","35000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("22","22","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("23","23","16","50000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("24","24","17","35000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("25","25","18","25000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("26","26","18","25000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("27","27","18","25000","0","","1","Released");
INSERT INTO `tblorder_request` VALUES("28","29","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("29","30","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("30","31","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("31","32","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("32","33","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("33","34","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("34","35","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("35","36","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("36","37","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("37","38","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("38","38","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("39","39","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("40","40","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("41","41","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("42","42","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("43","42","16","0","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("44","42","17","0","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("45","43","","90000","0","0","1","Active");
INSERT INTO `tblorder_request` VALUES("46","44","17","35000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("47","45","18","25000","0","","1","Active");
INSERT INTO `tblorder_request` VALUES("48","46","18","25000","0","","1","Active");



DROP TABLE IF EXISTS `tblorder_requestcnt`;

CREATE TABLE `tblorder_requestcnt` (
  `orreq_cntID` int(11) NOT NULL AUTO_INCREMENT,
  `orreq_ID` int(11) NOT NULL,
  `orreq_quantity` int(11) NOT NULL,
  `orreq_prodFinish` int(11) DEFAULT NULL,
  `orreq_returned` int(11) DEFAULT NULL,
  `orreq_released` int(11) DEFAULT NULL,
  PRIMARY KEY (`orreq_cntID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `tblorder_requestcnt` VALUES("1","18","3","0","0","1");
INSERT INTO `tblorder_requestcnt` VALUES("2","16","1","0","0","1");
INSERT INTO `tblorder_requestcnt` VALUES("3","6","3","0","0","3");
INSERT INTO `tblorder_requestcnt` VALUES("4","25","1","0","0","1");
INSERT INTO `tblorder_requestcnt` VALUES("5","5","1","0","0","1");
INSERT INTO `tblorder_requestcnt` VALUES("6","26","1","0","0","1");
INSERT INTO `tblorder_requestcnt` VALUES("7","27","1","0","0","1");



DROP TABLE IF EXISTS `tblorder_return`;

CREATE TABLE `tblorder_return` (
  `returnID` int(11) NOT NULL AUTO_INCREMENT,
  `tblorderReqID` int(11) NOT NULL,
  `dateReturned` date NOT NULL,
  `returnReason` varchar(450) NOT NULL,
  `returnAssessment` varchar(45) NOT NULL,
  `returnRemarks` varchar(450) NOT NULL,
  `estDateReleased` date NOT NULL,
  `returnStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`returnID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tblorder_return` VALUES("1","3","2017-09-22","Nisnis","Repair","Tatahiin nalang po","2017-09-30","Production Ongoing");



DROP TABLE IF EXISTS `tblorders`;

CREATE TABLE `tblorders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `receivedbyUserID` int(11) NOT NULL,
  `dateOfReceived` date NOT NULL,
  `dateOfRelease` date NOT NULL,
  `custOrderID` int(11) DEFAULT NULL,
  `orderPrice` double NOT NULL,
  `orderStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `shippingAddress` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `orderType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `orderRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `tlbuserID_idx` (`receivedbyUserID`),
  CONSTRAINT `userID_indx` FOREIGN KEY (`receivedbyUserID`) REFERENCES `tbluser` (`userID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblorders` VALUES("1","1","2017-08-28","2017-08-24","18","105000","Ready for release","#62 Resolution ","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("4","1","2017-08-29","2017-08-29","23","35000","Archived","N/A","On-Hand","No reason.");
INSERT INTO `tblorders` VALUES("6","1","2017-08-29","2017-08-29","21","35000","Ongoing","N/A","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("7","1","2017-08-29","2017-08-29","26","35000","Finished","N/A","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("8","1","2017-08-29","2017-08-29","24","105000","Finished","N/A","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("9","1","2017-08-30","2017-08-31","19","120000","Ongoing","N/A","Pre-Order","");
INSERT INTO `tblorders` VALUES("10","1","2017-08-30","2017-08-30","30","0","Archived","N/A","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("11","1","2017-09-24","2017-09-24","24","60000","Pending","N/A. This order is for pick-up","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("12","1","2017-10-02","2017-10-18","28","100000","Ongoing","N/A. This order is for pick-up","Pre-Order","a");
INSERT INTO `tblorders` VALUES("13","1","2017-10-02","2017-10-18","29","100000","Pending","N/A. This order is for pick-up","Pre-Order","a");
INSERT INTO `tblorders` VALUES("16","1","2017-10-03","2017-11-04","0","25000","Finished","For management","Management Order","Waley");
INSERT INTO `tblorders` VALUES("17","1","2017-10-04","2017-10-04","31","25000","Pending","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("18","1","2017-10-04","2017-10-04","31","105000","Ongoing","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("19","1","2017-10-04","2017-10-04","31","50000","Ongoing","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("20","1","2017-10-04","2017-10-04","31","35000","Archived","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("21","1","2017-10-04","2017-10-04","31","35000","Archived","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("22","1","2017-10-04","2017-10-04","31","25000","Archived","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("23","1","2017-10-04","2017-10-04","31","50000","Archived","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("24","1","2017-10-04","2017-10-04","31","35000","Archived","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("25","1","2017-10-05","2017-10-05","25","25000","Finished","N/A. This order is for pick-up","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("26","1","2017-10-05","2017-10-05","27","25000","Finished","N/A. This order is for pick-up","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("27","1","2017-10-05","2017-10-05","27","25000","Finished","N/A. This order is for pick-up","On-Hand","An order.");
INSERT INTO `tblorders` VALUES("28","1","2017-10-10","2017-10-11","27","90000","Ongoing","N/A","Pre-Order","a");
INSERT INTO `tblorders` VALUES("29","1","2017-10-10","2017-10-31","28","115000","Archived","N/A","Pre-Order","a");
INSERT INTO `tblorders` VALUES("30","1","2017-10-10","2017-10-12","22","90000","Archived","N/A","Pre-Order","a");
INSERT INTO `tblorders` VALUES("31","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("32","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("33","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("34","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("35","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("36","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("37","1","2017-10-10","2017-11-04","23","90000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("38","1","2017-10-10","2017-11-04","25","115000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("39","1","2017-10-10","2017-11-04","25","115000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("40","1","2017-10-10","2017-11-04","25","115000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("41","1","2017-10-10","2017-11-04","25","115000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("42","1","2017-10-10","2017-11-04","25","115000","Archived","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("43","1","2017-10-10","2017-11-04","27","90000","Ongoing","N/A","Pre-Order","An order.");
INSERT INTO `tblorders` VALUES("44","1","2017-10-10","2017-10-10","34","35000","WFA","N/A. This order is for pick-up","Pre-Order","");
INSERT INTO `tblorders` VALUES("45","1","2017-10-11","2017-10-20","0","25000","Pending","For management","Management Order","");
INSERT INTO `tblorders` VALUES("46","1","2017-10-12","2017-11-06","35","25000","Ongoing","N/A","Pre-Order","An order.");



DROP TABLE IF EXISTS `tblpackage_inclusions`;

CREATE TABLE `tblpackage_inclusions` (
  `package_inclusionID` int(11) NOT NULL AUTO_INCREMENT,
  `product_incID` int(11) NOT NULL,
  `package_incID` int(11) NOT NULL,
  `package_incStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`package_inclusionID`),
  KEY `prodID_idx` (`product_incID`),
  KEY `packID_idx` (`package_incID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpackage_inclusions` VALUES("1","17","1","Listed");
INSERT INTO `tblpackage_inclusions` VALUES("2","16","1","Listed");



DROP TABLE IF EXISTS `tblpackage_orderreq`;

CREATE TABLE `tblpackage_orderreq` (
  `por_ID` int(11) NOT NULL AUTO_INCREMENT,
  `por_orReqID` int(11) NOT NULL,
  `por_prID` int(11) NOT NULL,
  PRIMARY KEY (`por_ID`),
  KEY `product_indx_idx` (`por_prID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `tblpackage_orderreq` VALUES("1","45","16");
INSERT INTO `tblpackage_orderreq` VALUES("2","45","17");



DROP TABLE IF EXISTS `tblpackages`;

CREATE TABLE `tblpackages` (
  `packageID` int(11) NOT NULL,
  `packagePrice` double NOT NULL,
  `packageDescription` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `packageStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`packageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpackages` VALUES("1","90000","Fabulous Package","Listed");



DROP TABLE IF EXISTS `tblpayment_details`;

CREATE TABLE `tblpayment_details` (
  `payment_detailsID` int(11) NOT NULL AUTO_INCREMENT,
  `invID` int(11) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `amountPaid` double NOT NULL,
  `mopID` int(11) NOT NULL,
  `paymentStatus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`payment_detailsID`),
  KEY `mop_idx` (`mopID`),
  KEY `invoice_idx` (`invID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpayment_details` VALUES("1","1","2017-08-28 17:23:52","52500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("2","2","2017-08-29 21:16:54","35000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("3","3","2017-08-29 21:18:05","35000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("4","4","2017-08-29 21:22:19","10500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("5","5","2017-08-30 09:00:32","60000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("6","5","2017-08-30 09:19:40","5000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("7","6","2017-08-30 09:31:31","2","2","Paid");
INSERT INTO `tblpayment_details` VALUES("8","7","2017-09-24 19:58:16","50000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("9","1","2017-09-27 10:16:09","25000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("10","8","2017-10-02 15:22:17","50000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("11","9","2017-10-02 15:24:31","50000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("12","18","2017-10-05 17:45:01","25000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("13","19","2017-10-05 17:58:56","25000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("14","20","2017-10-05 18:00:38","25000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("15","5","2017-10-08 19:27:09","3000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("16","5","2017-10-08 19:29:16","2000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("17","11","2017-10-08 19:56:16","50000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("18","21","2017-10-10 09:12:32","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("19","22","2017-10-10 09:31:36","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("20","23","2017-10-10 09:35:07","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("21","24","2017-10-10 10:00:54","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("22","25","2017-10-10 10:03:48","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("23","26","2017-10-10 10:04:05","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("24","27","2017-10-10 10:04:39","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("25","28","2017-10-10 10:05:27","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("26","29","2017-10-10 10:05:55","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("27","30","2017-10-10 10:06:32","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("28","31","2017-10-10 10:20:38","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("29","32","2017-10-10 10:35:35","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("30","33","2017-10-10 10:36:17","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("31","34","2017-10-10 10:36:39","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("32","35","2017-10-10 10:40:13","57500","1","Paid");
INSERT INTO `tblpayment_details` VALUES("33","36","2017-10-10 10:51:37","45000","1","Paid");
INSERT INTO `tblpayment_details` VALUES("34","37","2017-10-10 20:21:23","25000","3","Paid");
INSERT INTO `tblpayment_details` VALUES("35","38","2017-10-12 19:15:10","12500","1","Paid");



DROP TABLE IF EXISTS `tblpenalty`;

CREATE TABLE `tblpenalty` (
  `penaltyID` int(11) NOT NULL AUTO_INCREMENT,
  `penaltyName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `penaltyRateType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `penaltyRate` double NOT NULL,
  `penaltyRemarks` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `penStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`penaltyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpenalty` VALUES("1","Storage Fee","Amount","500","","Active");
INSERT INTO `tblpenalty` VALUES("2","Cancellation Fee","Amount","500","","Active");



DROP TABLE IF EXISTS `tblphases`;

CREATE TABLE `tblphases` (
  `phaseID` int(11) NOT NULL AUTO_INCREMENT,
  `phaseName` varchar(250) CHARACTER SET utf8 NOT NULL,
  `phaseIcon` varchar(450) CHARACTER SET utf8 NOT NULL,
  `phaseStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`phaseID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblphases` VALUES("1","Carpentry","carpentry.png","Active");
INSERT INTO `tblphases` VALUES("2","Carving","carving.png","Active");
INSERT INTO `tblphases` VALUES("3","Filling","filling.png","Active");
INSERT INTO `tblphases` VALUES("4","Upholstery","upholstery.png","Active");
INSERT INTO `tblphases` VALUES("5","Finishing","finishing.png","Active");



DROP TABLE IF EXISTS `tblprod_images`;

CREATE TABLE `tblprod_images` (
  `prodImageID` int(11) NOT NULL AUTO_INCREMENT,
  `prodImgID` int(11) NOT NULL,
  `prodImageName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `prodImgStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`prodImageID`),
  KEY `productinclusionID_idx` (`prodImgStatus`),
  KEY `prodInfo_idx` (`prodImgID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tblprod_info`;

CREATE TABLE `tblprod_info` (
  `prodInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `prodInfoProduct` int(11) NOT NULL,
  `prodInfoPhase` int(11) NOT NULL,
  `prodInfoStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`prodInfoID`),
  KEY `prod_idx` (`prodInfoProduct`),
  KEY `ph_idx` (`prodInfoPhase`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblprod_info` VALUES("1","18","1","Active");
INSERT INTO `tblprod_info` VALUES("2","18","3","Active");
INSERT INTO `tblprod_info` VALUES("3","17","4","Active");
INSERT INTO `tblprod_info` VALUES("4","18","5","Active");
INSERT INTO `tblprod_info` VALUES("5","18","5","Active");
INSERT INTO `tblprod_info` VALUES("6","16","1","Active");



DROP TABLE IF EXISTS `tblprod_materials`;

CREATE TABLE `tblprod_materials` (
  `p_matID` int(11) NOT NULL AUTO_INCREMENT,
  `p_prodInfoID` int(11) NOT NULL,
  `p_matDescID` int(11) NOT NULL,
  `p_matQuantity` varchar(250) CHARACTER SET utf8 NOT NULL,
  `p_matStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`p_matID`),
  KEY `prodInfo_idx` (`p_prodInfoID`),
  KEY `p_desc_idx` (`p_matDescID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblprod_materials` VALUES("1","1","321","2","Active");
INSERT INTO `tblprod_materials` VALUES("2","1","263","2","Active");
INSERT INTO `tblprod_materials` VALUES("3","1","319","2","Active");
INSERT INTO `tblprod_materials` VALUES("4","1","323","2","Active");
INSERT INTO `tblprod_materials` VALUES("5","1","326","2","Active");
INSERT INTO `tblprod_materials` VALUES("6","1","257","2","Active");
INSERT INTO `tblprod_materials` VALUES("7","2","263","3","Active");
INSERT INTO `tblprod_materials` VALUES("8","2","322","3","Active");
INSERT INTO `tblprod_materials` VALUES("9","3","322","2","Active");
INSERT INTO `tblprod_materials` VALUES("10","3","263","2","Active");
INSERT INTO `tblprod_materials` VALUES("11","4","257","2","Archived");
INSERT INTO `tblprod_materials` VALUES("12","5","313","2","Active");
INSERT INTO `tblprod_materials` VALUES("13","6","324","2","Active");



DROP TABLE IF EXISTS `tblprodphase_materials`;

CREATE TABLE `tblprodphase_materials` (
  `pph_matID` int(11) NOT NULL AUTO_INCREMENT,
  `pphID` int(11) NOT NULL,
  `pph_matDescID` int(11) NOT NULL,
  `pph_matQuan` int(11) NOT NULL,
  `pph_matStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`pph_matID`),
  KEY `pphID_idx` (`pphID`),
  KEY `mateID_idx` (`pph_matDescID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `tblprodphase_materials` VALUES("1","135","322","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("2","135","263","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("5","145","323","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("6","145","326","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("7","147","313","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("8","147","313","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("9","147","313","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("10","147","313","2","Active");
INSERT INTO `tblprodphase_materials` VALUES("11","147","313","2","Active");



DROP TABLE IF EXISTS `tblprodsonpromo`;

CREATE TABLE `tblprodsonpromo` (
  `onpromoID` int(11) NOT NULL AUTO_INCREMENT,
  `prodPromoID` int(11) NOT NULL,
  `promoDescID` int(11) NOT NULL,
  `onPromoStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`onpromoID`),
  KEY `prodsOnSale_idx` (`prodPromoID`),
  KEY `promodescid_idx` (`promoDescID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS `tblproduct`;

CREATE TABLE `tblproduct` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
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
  `prodStat` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `framworkcodeID_idx` (`prodFrameworkID`),
  KEY `fabricodeID_idx` (`prodFabricID`),
  KEY `type_idx` (`prodTypeID`),
  KEY `categ_idx` (`prodCatID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblproduct` VALUES("16","7","13","9","1","0","Queen","A queen sized bed","50000","2017-08-241503588669.png","","Pre-Order");
INSERT INTO `tblproduct` VALUES("17","6","17","9","3","9","Elizabeth","A marvelous sofa","35000","2017-08-281503930441.png"," L16.3â€³ x W16.3â€³ x H36.9â€³","Pre-Order");
INSERT INTO `tblproduct` VALUES("18","7","13","10","1","0","Manilenia","An amazing furn","25000","2017-08-301504075842.png","","Pre-Order");



DROP TABLE IF EXISTS `tblproduction`;

CREATE TABLE `tblproduction` (
  `productionID` int(11) NOT NULL AUTO_INCREMENT,
  `productionOrderReq` int(11) DEFAULT NULL,
  `productionPackReq` int(11) DEFAULT NULL,
  `prodStartDate` date DEFAULT NULL,
  `prodEndDate` date DEFAULT NULL,
  `productionRemarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `productionStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`productionID`),
  KEY `orReq_idx` (`productionOrderReq`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblproduction` VALUES("33","1","","","","","Finished");
INSERT INTO `tblproduction` VALUES("34","8","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("35","7","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("36","3","","2017-10-11","","","Ongoing");
INSERT INTO `tblproduction` VALUES("37","13","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("38","12","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("39","18","","","","","Finished");
INSERT INTO `tblproduction` VALUES("40","18","","2017-10-18","","","Ongoing");
INSERT INTO `tblproduction` VALUES("41","18","","2017-10-10","","","Ongoing");
INSERT INTO `tblproduction` VALUES("42","19","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("43","16","","2017-10-10","2017-10-11","","Finished");
INSERT INTO `tblproduction` VALUES("44","0","1","","2017-10-12","","Finished");
INSERT INTO `tblproduction` VALUES("45","0","2","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("46","14","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("47","14","","","","","Ongoing");
INSERT INTO `tblproduction` VALUES("48","48","","","","","Ongoing");



DROP TABLE IF EXISTS `tblproduction_phase`;

CREATE TABLE `tblproduction_phase` (
  `prodHistID` int(11) NOT NULL AUTO_INCREMENT,
  `prodID` int(11) NOT NULL,
  `prodPhase` int(11) NOT NULL,
  `prodEmp` int(11) DEFAULT NULL,
  `prodDateStart` date DEFAULT NULL,
  `prodDateEnd` date DEFAULT NULL,
  `prodEstDate` date DEFAULT NULL,
  `prodRemarks` varchar(450) CHARACTER SET latin1 DEFAULT NULL,
  `prodStatus` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`prodHistID`),
  KEY `production_idx` (`prodID`),
  KEY `phase_idx` (`prodPhase`),
  KEY `employee_idx` (`prodEmp`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblproduction_phase` VALUES("101","33","1","1","2017-08-31","2017-09-02",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("102","33","2","1","2017-08-31","2017-09-13",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("103","33","3","1","2017-09-14","2017-09-12",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("104","33","4","1","2017-09-15","2017-09-15",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("105","33","5","1","2017-09-21","2017-09-14",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("106","34","1","1","2017-09-22","",""," ","Ongoing");
INSERT INTO `tblproduction_phase` VALUES("107","34","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("108","34","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("109","35","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("110","35","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("111","35","3","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("112","35","4","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("113","35","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("114","36","1","1","2017-10-11","","2017-10-13"," ","Ongoing");
INSERT INTO `tblproduction_phase` VALUES("115","36","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("116","36","3","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("117","36","4","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("118","36","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("119","37","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("120","37","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("121","37","3","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("122","37","4","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("123","37","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("124","38","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("125","38","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("126","38","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("127","39","1","1","2017-10-19","2017-10-18",""," sss","Finished");
INSERT INTO `tblproduction_phase` VALUES("128","39","2","1","2017-10-19","2017-10-19",""," aaa","Finished");
INSERT INTO `tblproduction_phase` VALUES("129","39","3","1","2017-10-20","2017-10-11",""," aaa","Finished");
INSERT INTO `tblproduction_phase` VALUES("130","39","4","1","2017-10-20","2017-10-19",""," aaa","Finished");
INSERT INTO `tblproduction_phase` VALUES("131","39","5","1","2017-10-20","2017-10-25",""," aaaaa","Finished");
INSERT INTO `tblproduction_phase` VALUES("132","40","1","1","2017-10-18","2017-10-19",""," aaa","Finished");
INSERT INTO `tblproduction_phase` VALUES("133","40","2","1","2017-10-07","2017-10-09",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("134","40","3","1","2017-10-19","2017-10-12",""," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("135","40","4","1","2017-10-10","2017-10-12","2017-10-12"," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("136","40","5","1","2017-10-11","","2017-10-13"," ","Ongoing");
INSERT INTO `tblproduction_phase` VALUES("137","41","1","1","2017-10-10","","2017-10-12"," aaa","Pending");
INSERT INTO `tblproduction_phase` VALUES("138","41","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("139","41","3","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("140","41","4","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("141","41","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("142","42","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("143","42","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("144","42","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("145","43","1","1","2017-10-10","2017-10-11","2017-10-12"," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("146","43","2","1","2017-10-10","2017-10-11","2017-10-12"," aa","Finished");
INSERT INTO `tblproduction_phase` VALUES("147","43","5","1","2017-10-10","2017-10-11","2017-10-12"," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("148","44","1","1","2017-10-10","2017-10-10","2017-10-12"," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("149","44","2","1","2017-10-10","2017-10-11","2017-10-12","","Finished");
INSERT INTO `tblproduction_phase` VALUES("150","44","5","1","2017-10-10","2017-10-12","2017-10-12"," ","Finished");
INSERT INTO `tblproduction_phase` VALUES("151","45","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("152","45","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("153","45","3","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("154","45","4","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("155","45","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("156","46","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("157","46","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("158","46","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("159","47","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("160","47","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("161","47","5","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("162","48","1","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("163","48","2","","","","","","Pending");
INSERT INTO `tblproduction_phase` VALUES("164","48","5","","","","","","Pending");



DROP TABLE IF EXISTS `tblpromo_condition`;

CREATE TABLE `tblpromo_condition` (
  `conditionID` int(11) NOT NULL AUTO_INCREMENT,
  `conPromoID` int(11) NOT NULL,
  `conCategory` varchar(45) CHARACTER SET latin1 NOT NULL,
  `conData` varchar(450) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`conditionID`),
  KEY `promo_idx` (`conPromoID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpromo_condition` VALUES("6","6","Amount","50,000");



DROP TABLE IF EXISTS `tblpromo_promotion`;

CREATE TABLE `tblpromo_promotion` (
  `promotionID` int(11) NOT NULL AUTO_INCREMENT,
  `proPromoID` int(11) NOT NULL,
  `proCategory` varchar(45) CHARACTER SET latin1 NOT NULL,
  `proData` varchar(450) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`promotionID`),
  KEY `promo_idx` (`proPromoID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpromo_promotion` VALUES("6","6","Others"," 1 table");



DROP TABLE IF EXISTS `tblpromos`;

CREATE TABLE `tblpromos` (
  `promoID` int(11) NOT NULL AUTO_INCREMENT,
  `promoName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `promoDescription` varchar(450) CHARACTER SET utf8 NOT NULL,
  `promoStartDate` date NOT NULL,
  `promoEnd` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `promoImage` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `promoStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`promoID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblpromos` VALUES("6","Grand Opening Promo","Promo for the grand opening","2017-08-24","2017-08-25","2017-08-241503589175.png","Active");



DROP TABLE IF EXISTS `tblpull_out`;

CREATE TABLE `tblpull_out` (
  `pulloutID` int(11) NOT NULL AUTO_INCREMENT,
  `pullout_fID` int(11) NOT NULL,
  `pullout_Date` date NOT NULL,
  `pullout_quantity` int(11) NOT NULL,
  `pullout_reason` varchar(45) NOT NULL,
  `pullout_Remarks` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`pulloutID`),
  KEY `fID_indx_idx` (`pullout_fID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tblpull_out` VALUES("1","18","2017-10-05","1","3","");



DROP TABLE IF EXISTS `tblrelease`;

CREATE TABLE `tblrelease` (
  `releaseID` int(11) NOT NULL AUTO_INCREMENT,
  `releaseDate` datetime NOT NULL,
  `releaseType` varchar(50) NOT NULL,
  `releaseRemarks` varchar(450) DEFAULT NULL,
  `releaseStatus` varchar(45) NOT NULL,
  PRIMARY KEY (`releaseID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `tblrelease` VALUES("1","2017-09-11 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("2","2017-09-11 00:00:00","0","TBD","Released");
INSERT INTO `tblrelease` VALUES("3","2017-09-11 00:00:00","0","PICKED UP","Released");
INSERT INTO `tblrelease` VALUES("4","2017-10-05 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("5","2017-10-05 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("6","2017-10-05 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("7","2017-10-05 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("8","2017-10-05 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("9","2017-10-11 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("10","2017-10-11 00:00:00","0","","Released");
INSERT INTO `tblrelease` VALUES("11","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("12","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("13","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("14","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("15","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("16","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("17","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("18","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("19","2017-10-11 00:00:00","Pick-up","","Released");
INSERT INTO `tblrelease` VALUES("20","2017-10-12 00:00:00","Pick-up","","Released");



DROP TABLE IF EXISTS `tblrelease_details`;

CREATE TABLE `tblrelease_details` (
  `rel_detailsID` int(11) NOT NULL AUTO_INCREMENT,
  `tblreleaseID` int(11) NOT NULL,
  `rel_orderReqID` int(11) NOT NULL,
  `rel_quantity` int(11) NOT NULL,
  PRIMARY KEY (`rel_detailsID`),
  KEY `tblreleaseid_tblreleasedetails_idx` (`tblreleaseID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `tblrelease_details` VALUES("1","1","5","1");
INSERT INTO `tblrelease_details` VALUES("2","2","6","3");
INSERT INTO `tblrelease_details` VALUES("3","3","3","1");
INSERT INTO `tblrelease_details` VALUES("4","3","4","1");
INSERT INTO `tblrelease_details` VALUES("5","16","18","1");
INSERT INTO `tblrelease_details` VALUES("6","17","25","1");
INSERT INTO `tblrelease_details` VALUES("8","19","26","1");
INSERT INTO `tblrelease_details` VALUES("9","20","27","1");



DROP TABLE IF EXISTS `tblsupplier`;

CREATE TABLE `tblsupplier` (
  `supplierID` int(11) NOT NULL AUTO_INCREMENT,
  `supCompName` varchar(250) CHARACTER SET utf8 NOT NULL,
  `supCompAdd` varchar(100) CHARACTER SET utf8 NOT NULL,
  `supCompNum` varchar(20) CHARACTER SET utf8 NOT NULL,
  `supContactPerson` varchar(100) CHARACTER SET utf8 NOT NULL,
  `supPosition` varchar(45) CHARACTER SET utf8 NOT NULL,
  `supStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`supplierID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblsupplier` VALUES("15","FNCENT Trees and Woods Inc.","1234 Bill Street Batasan Hills Quezon City","+63 (124) 534-3414","Mr. Jung","Manager","Listed");
INSERT INTO `tblsupplier` VALUES("16","SMENT Fabrics and Prints","111 Gangnamgu Seoul South Korea","+63 (999) 414-5004","Lee Soo Man","Manager","Listed");
INSERT INTO `tblsupplier` VALUES("17","AA","111 Resolution Rd. Batasan Hills Quezon City","+63 (237) 642-9312","Mr. Lee","Manager","Listed");
INSERT INTO `tblsupplier` VALUES("18","l;efjdor2093729ueij","skdjksaljdklwjde1913982938209`o!!22jkeljd","+63 (922) 938-7812","idaskhdkjahsoi","u398139817872egwajhzgwHJSW","Listed");



DROP TABLE IF EXISTS `tblunit_cat`;

CREATE TABLE `tblunit_cat` (
  `unitcatID` int(11) NOT NULL AUTO_INCREMENT,
  `unitID` int(11) NOT NULL,
  `uncategoryName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unitcatStatus` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`unitcatID`),
  KEY `unitID_idx` (`uncategoryName`),
  KEY `uniofmeasureID_idx` (`unitID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblunit_cat` VALUES("20","16","Weight","Active");
INSERT INTO `tblunit_cat` VALUES("21","17","Length","Active");
INSERT INTO `tblunit_cat` VALUES("29","25","Length","Active");



DROP TABLE IF EXISTS `tblunitofmeasure`;

CREATE TABLE `tblunitofmeasure` (
  `unID` int(11) NOT NULL AUTO_INCREMENT,
  `unType` varchar(50) CHARACTER SET utf8 NOT NULL,
  `unUnit` varchar(10) CHARACTER SET utf8 NOT NULL,
  `unStatus` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`unID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblunitofmeasure` VALUES("14","Feet","ft","Active");
INSERT INTO `tblunitofmeasure` VALUES("15","Meter","m","Active");
INSERT INTO `tblunitofmeasure` VALUES("16","Gram","g","Active");
INSERT INTO `tblunitofmeasure` VALUES("17","Inch","in","Active");
INSERT INTO `tblunitofmeasure` VALUES("18","Pieces","pcs","Active");
INSERT INTO `tblunitofmeasure` VALUES("25","Centimeters","cm","Active");



DROP TABLE IF EXISTS `tblunitofmeasurement_category`;

CREATE TABLE `tblunitofmeasurement_category` (
  `uncategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `uncategoryName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `uncategoryStatus` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`uncategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tblunitofmeasurement_category` VALUES("0","Description","Hidden");
INSERT INTO `tblunitofmeasurement_category` VALUES("11","Length","Active");
INSERT INTO `tblunitofmeasurement_category` VALUES("13","Area","Archived");
INSERT INTO `tblunitofmeasurement_category` VALUES("14","Weight","Active");
INSERT INTO `tblunitofmeasurement_category` VALUES("19","Amount","Active");



DROP TABLE IF EXISTS `tbluser`;

CREATE TABLE `tbluser` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(80) CHARACTER SET utf8 NOT NULL,
  `userPassword` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userStatus` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userType` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userCustID` int(20) DEFAULT NULL,
  `userEmpID` int(11) DEFAULT NULL,
  `dateCreated` date NOT NULL,
  `confirmedUser` int(2) DEFAULT NULL,
  PRIMARY KEY (`userID`,`userName`),
  KEY `cust_idx` (`userCustID`),
  KEY `emp_idx` (`userEmpID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbluser` VALUES("1","eyembisi","admin","Active","admin","","1","2017-08-24","");
INSERT INTO `tbluser` VALUES("4","airaem","admin","active","customer","19","","2017-08-27","");
INSERT INTO `tbluser` VALUES("5","hongkaisoo","admin","active","customer","31","","2017-09-01","");
INSERT INTO `tbluser` VALUES("6","kuyasehun","kuyasehun","active","customer","32","","2017-10-10","");
INSERT INTO `tbluser` VALUES("7","kuyajongin","kuyajongin","active","customer","33","","2017-10-10","");
INSERT INTO `tbluser` VALUES("8","kuyaksoo","kuyaksoo","active","customer","34","","2017-10-10","1");
INSERT INTO `tbluser` VALUES("9","kuyasuho","kuyasuho","active","customer","35","","2017-10-11","");
INSERT INTO `tbluser` VALUES("10","kuyajongdae","kuyajongdae","active","customer","36","","2017-10-11","");
INSERT INTO `tbluser` VALUES("11","kuyakyung","kuyakyung","active","customer","37","","2017-10-11","");
INSERT INTO `tbluser` VALUES("12","harpa","harpa","active","customer","38","","2017-10-11","");
INSERT INTO `tbluser` VALUES("13","aa","aa","active","customer","39","","2017-10-11","");
INSERT INTO `tbluser` VALUES("14","ksoo","ksoo","active","customer","40","","2017-10-11","1");




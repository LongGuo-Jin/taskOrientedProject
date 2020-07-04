/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : taskoriented

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-06-25 10:28:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `houseNumber` int(11) DEFAULT NULL,
  `additionalLine` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cityID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_135` (`cityID`),
  CONSTRAINT `FK_135` FOREIGN KEY (`cityID`) REFERENCES `city` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', 'Višegradska', '15', 'Hello additional Lin', 'note', '1');
INSERT INTO `address` VALUES ('2', 'Kozaračka', '146', null, null, '2');

-- ----------------------------
-- Table structure for `attachment`
-- ----------------------------
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE `attachment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmpFileName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personID` int(11) DEFAULT NULL,
  `taskID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `personID` (`personID`),
  KEY `taskID` (`taskID`),
  CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `attachment_ibfk_2` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of attachment
-- ----------------------------
INSERT INTO `attachment` VALUES ('5', 'toprojects_taskoriented.sql', '20191229025025_toprojects_taskoriented.sql', 'sql', '29.12.2019 02:50', '1', '55');
INSERT INTO `attachment` VALUES ('6', '07-budget.jpg', '20191230074401_07-budget.jpg', 'jpg', '30.12.2019 07:44', '1', '55');
INSERT INTO `attachment` VALUES ('7', '07-noWeight.jpg', '20191230085844_07-noWeight.jpg', 'jpg', '30.12.2019 08:58', '1', '88');
INSERT INTO `attachment` VALUES ('8', '07-noWeight2.jpg', '20191230085854_07-noWeight2.jpg', 'jpg', '30.12.2019 08:58', '1', '88');
INSERT INTO `attachment` VALUES ('9', '08-focus bug.jpg', '20191230090040_08-focus bug.jpg', 'jpg', '30.12.2019 09:00', '1', '80');
INSERT INTO `attachment` VALUES ('10', '08-focus bug2.jpg', '20191230105047_08-focus bug2.jpg', 'jpg', '30.12.2019 10:51', '1', '80');
INSERT INTO `attachment` VALUES ('11', '09-PiC2.jpg', '20191230111504_09-PiC2.jpg', 'jpg', '30.12.2019 11:15', '1', '86');
INSERT INTO `attachment` VALUES ('12', '10-ActionUpdate.jpg', '20191230112725_10-ActionUpdate.jpg', 'jpg', '30.12.2019 11:27', '5', '82');
INSERT INTO `attachment` VALUES ('13', '11-addExpense.jpg', '20191231125825_11-addExpense.jpg', 'jpg', '31.12.2019 12:58', '5', '91');
INSERT INTO `attachment` VALUES ('14', '11-addExpense.jpg', '20191231010914_11-addExpense.jpg', 'jpg', '31.12.2019 01:09', '1', '91');
INSERT INTO `attachment` VALUES ('15', '11-addExpense.jpg', '20191231011002_11-addExpense.jpg', 'jpg', '31.12.2019 01:10', '1', '84');
INSERT INTO `attachment` VALUES ('16', '11-addExpense.jpg', '20191231011025_11-addExpense.jpg', 'jpg', '31.12.2019 01:10', '1', '85');
INSERT INTO `attachment` VALUES ('17', '11-addExpense.jpg', '20191231011458_11-addExpense.jpg', 'jpg', '31.12.2019 01:14', '1', '80');
INSERT INTO `attachment` VALUES ('18', '20191227014329_Budget.pdf', '20191231013128_20191227014329_Budget.pdf', 'pdf', '31.12.2019 01:31', '1', '81');
INSERT INTO `attachment` VALUES ('19', '12-path-filename.jpg', '20191231013839_12-path-filename.jpg', 'jpg', '31.12.2019 01:38', '1', '81');
INSERT INTO `attachment` VALUES ('20', '13-breadcrumbs.jpg', '20191231014310_13-breadcrumbs.jpg', 'jpg', '31.12.2019 01:43', '1', '87');
INSERT INTO `attachment` VALUES ('21', '07-noWeight.jpg', '20191231110543_07-noWeight.jpg', 'jpg', '31.12.2019 11:05', '1', '81');
INSERT INTO `attachment` VALUES ('22', '14-progress.jpg', '20191231111108_14-progress.jpg', 'jpg', '31.12.2019 11:11', '1', '93');
INSERT INTO `attachment` VALUES ('25', '15-presetWeight.jpg', '20200103102105_15-presetWeight.jpg', 'jpg', '03.01.2020 10:24', '1', '97');
INSERT INTO `attachment` VALUES ('26', '17-memo.jpg', '20200103103322_17-memo.jpg', 'jpg', '03.01.2020 10:34', '1', '100');
INSERT INTO `attachment` VALUES ('27', '18-newTaskStatus.jpg', '20200103104337_18-newTaskStatus.jpg', 'jpg', '03.01.2020 10:43', '1', '103');
INSERT INTO `attachment` VALUES ('28', '19-statusIcons.jpg', '20200103032238_19-statusIcons.jpg', 'jpg', '03.01.2020 03:22', '1', '78');
INSERT INTO `attachment` VALUES ('29', 'a1 Ubiparipović.pdf', '20200106122143_a1 Ubiparipović.pdf', 'pdf', '06.01.2020 12:21', '1', '115');

-- ----------------------------
-- Table structure for `budget`
-- ----------------------------
DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personID` int(19) DEFAULT NULL,
  `taskID` int(19) DEFAULT NULL,
  `income` double(20,2) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `personID` (`personID`) USING BTREE,
  KEY `budget_ibfk_2` (`taskID`) USING BTREE,
  CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of budget
-- ----------------------------
INSERT INTO `budget` VALUES ('14', '29.12.2019', '1', '82', '5000.00', 'Invoice 75/2019');
INSERT INTO `budget` VALUES ('15', '29.12.2019', '1', '55', '5000.00', 'Invoice 7644-19');
INSERT INTO `budget` VALUES ('16', '30.12.2019', '1', '58', '759.00', 'Cables');
INSERT INTO `budget` VALUES ('17', '06.01.2020', '1', '55', '3500.00', 'Aneks');

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cityCode` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `countryID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_146` (`countryID`),
  CONSTRAINT `FK_146` FOREIGN KEY (`countryID`) REFERENCES `country` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', 'City1', '31106', 'City1_note', '1');
INSERT INTO `city` VALUES ('2', 'Pančevo', '26000', 'City2_note', '2');
INSERT INTO `city` VALUES ('3', 'City3', '03', 'City2_note', '3');

-- ----------------------------
-- Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typeID` int(11) NOT NULL,
  `value` linestring NOT NULL,
  `note` linestring DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_74` (`typeID`),
  CONSTRAINT `FK_74` FOREIGN KEY (`typeID`) REFERENCES `contacttype` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contact
-- ----------------------------

-- ----------------------------
-- Table structure for `contacttype`
-- ----------------------------
DROP TABLE IF EXISTS `contacttype`;
CREATE TABLE `contacttype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `note` multilinestring DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contacttype
-- ----------------------------

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephoneCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `internetCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'Republika Srbija', '000001', '000001', '000001', 'note');
INSERT INTO `country` VALUES ('2', 'Srbija', '000002', '000002', '000002', 'note');
INSERT INTO `country` VALUES ('3', 'Slovenija', '000003', '000003', '000003', 'note');

-- ----------------------------
-- Table structure for `expence`
-- ----------------------------
DROP TABLE IF EXISTS `expence`;
CREATE TABLE `expence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `value` float NOT NULL,
  `currencyID` int(11) NOT NULL,
  `note` multilinestring DEFAULT NULL,
  `taskID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_156` (`taskID`),
  CONSTRAINT `FK_156` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of expence
-- ----------------------------

-- ----------------------------
-- Table structure for `expense`
-- ----------------------------
DROP TABLE IF EXISTS `expense`;
CREATE TABLE `expense` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personID` int(19) DEFAULT NULL,
  `taskID` int(19) DEFAULT NULL,
  `expense` double(20,2) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `personID` (`personID`) USING BTREE,
  KEY `taskID` (`taskID`) USING BTREE,
  CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `expense_ibfk_2` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of expense
-- ----------------------------
INSERT INTO `expense` VALUES ('9', '29.12.2019', '1', '82', '1000.00', 'Materials');
INSERT INTO `expense` VALUES ('10', '29.12.2019', '1', '55', '1000.00', 'Materials');
INSERT INTO `expense` VALUES ('11', '29.12.2019', '1', '56', '500.00', 'Gasoline');
INSERT INTO `expense` VALUES ('12', '29.12.2019', '2', '62', '500.00', 'Gasoline');
INSERT INTO `expense` VALUES ('13', '30.12.2019', '1', '58', '235.00', 'Cables');
INSERT INTO `expense` VALUES ('14', '30.12.2019', '1', '55', '230.00', 'Visa');
INSERT INTO `expense` VALUES ('15', '31.12.2019', '5', '91', '5.00', 'test123');
INSERT INTO `expense` VALUES ('16', '31.12.2019', '1', '80', '0.80', 't23');
INSERT INTO `expense` VALUES ('17', '31.12.2019', '1', '55', '0.80', 't23');
INSERT INTO `expense` VALUES ('18', '31.12.2019', '1', '81', '25.00', 't45');
INSERT INTO `expense` VALUES ('19', '06.01.2020', '1', '60', '60.00', 'Ura');

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `history`
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `personID` int(11) NOT NULL,
  `taskID` int(11) NOT NULL,
  `event` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventDate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `personID` (`personID`) USING BTREE,
  KEY `taskID` (`taskID`) USING BTREE,
  CONSTRAINT `history_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `history_ibfk_2` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of history
-- ----------------------------
INSERT INTO `history` VALUES ('7', '1', '55', 'Attachment added: toprojects_taskoriented.sql', '29.12.2019 02:50');
INSERT INTO `history` VALUES ('8', '1', '83', 'Created.', '29.12.2019 02:51');
INSERT INTO `history` VALUES ('9', '1', '84', 'Created.', '29.12.2019 02:52');
INSERT INTO `history` VALUES ('10', '1', '83', 'Status change: On hold', '29.12.2019 02:53');
INSERT INTO `history` VALUES ('11', '1', '85', 'Created.', '29.12.2019 02:54');
INSERT INTO `history` VALUES ('12', '1', '85', 'Status change: On hold', '29.12.2019 02:54');
INSERT INTO `history` VALUES ('13', '1', '86', 'Created.', '29.12.2019 03:10');
INSERT INTO `history` VALUES ('14', '1', '86', 'Status change: On hold', '29.12.2019 03:11');
INSERT INTO `history` VALUES ('15', '1', '55', 'Attachment added: 07-budget.jpg', '30.12.2019 07:44');
INSERT INTO `history` VALUES ('16', '1', '87', 'Created.', '30.12.2019 08:31');
INSERT INTO `history` VALUES ('17', '1', '87', 'Status change: On hold', '30.12.2019 08:32');
INSERT INTO `history` VALUES ('18', '1', '83', 'Status change: Finished', '30.12.2019 08:50');
INSERT INTO `history` VALUES ('19', '1', '81', 'Status change: On hold', '30.12.2019 08:52');
INSERT INTO `history` VALUES ('20', '1', '82', 'Status change: On hold', '30.12.2019 08:55');
INSERT INTO `history` VALUES ('21', '1', '88', 'Created.', '30.12.2019 08:58');
INSERT INTO `history` VALUES ('22', '1', '88', 'Attachment added: 07-noWeight.jpg', '30.12.2019 08:58');
INSERT INTO `history` VALUES ('23', '1', '88', 'Attachment added: 07-noWeight2.jpg', '30.12.2019 08:58');
INSERT INTO `history` VALUES ('24', '1', '80', 'Attachment added: 08-focus bug.jpg', '30.12.2019 09:00');
INSERT INTO `history` VALUES ('25', '1', '89', 'Created.', '30.12.2019 09:05');
INSERT INTO `history` VALUES ('26', '1', '89', 'Status change: Active', '30.12.2019 09:06');
INSERT INTO `history` VALUES ('27', '1', '80', 'Status change: Finished', '30.12.2019 09:52');
INSERT INTO `history` VALUES ('28', '1', '88', 'Status change: Finished', '30.12.2019 09:53');
INSERT INTO `history` VALUES ('29', '1', '80', 'Attachment added: 08-focus bug2.jpg', '30.12.2019 10:51');
INSERT INTO `history` VALUES ('30', '1', '80', 'Status change: Active', '30.12.2019 10:51');
INSERT INTO `history` VALUES ('31', '1', '85', 'Status change: Active', '30.12.2019 10:52');
INSERT INTO `history` VALUES ('32', '1', '83', 'Status change: Active', '30.12.2019 10:52');
INSERT INTO `history` VALUES ('33', '1', '84', 'Status change: Finished', '30.12.2019 10:52');
INSERT INTO `history` VALUES ('34', '1', '90', 'Created.', '30.12.2019 10:58');
INSERT INTO `history` VALUES ('35', '5', '79', 'Status change: Active', '30.12.2019 11:06');
INSERT INTO `history` VALUES ('36', '5', '79', 'Status change: Finished', '30.12.2019 11:06');
INSERT INTO `history` VALUES ('37', '5', '81', 'Status change: Active', '30.12.2019 11:06');
INSERT INTO `history` VALUES ('38', '5', '87', 'Status change: Active', '30.12.2019 11:06');
INSERT INTO `history` VALUES ('39', '5', '86', 'Status change: Finished', '30.12.2019 11:10');
INSERT INTO `history` VALUES ('40', '1', '86', 'Attachment added: 09-PiC2.jpg', '30.12.2019 11:15');
INSERT INTO `history` VALUES ('41', '1', '86', 'Status change: Active', '30.12.2019 11:15');
INSERT INTO `history` VALUES ('42', '5', '76', 'Status change: Active', '30.12.2019 11:22');
INSERT INTO `history` VALUES ('43', '5', '78', 'Status change: Active', '30.12.2019 11:24');
INSERT INTO `history` VALUES ('44', '5', '82', 'Status change: Active', '30.12.2019 11:26');
INSERT INTO `history` VALUES ('45', '5', '82', 'Attachment added: 10-ActionUpdate.jpg', '30.12.2019 11:27');
INSERT INTO `history` VALUES ('46', '1', '80', 'Status change: Finished', '31.12.2019 12:52');
INSERT INTO `history` VALUES ('47', '1', '85', 'Status change: Finished', '31.12.2019 12:53');
INSERT INTO `history` VALUES ('48', '1', '86', 'Status change: Finished', '31.12.2019 12:55');
INSERT INTO `history` VALUES ('49', '5', '91', 'Created.', '31.12.2019 12:57');
INSERT INTO `history` VALUES ('50', '5', '91', 'Attachment added: 11-addExpense.jpg', '31.12.2019 12:58');
INSERT INTO `history` VALUES ('51', '5', '91', 'Status change: Active', '31.12.2019 12:58');
INSERT INTO `history` VALUES ('52', '1', '91', 'Attachment added: 11-addExpense.jpg', '31.12.2019 01:09');
INSERT INTO `history` VALUES ('53', '1', '84', 'Attachment added: 11-addExpense.jpg', '31.12.2019 01:10');
INSERT INTO `history` VALUES ('54', '1', '85', 'Attachment added: 11-addExpense.jpg', '31.12.2019 01:10');
INSERT INTO `history` VALUES ('55', '1', '80', 'Attachment added: 11-addExpense.jpg', '31.12.2019 01:14');
INSERT INTO `history` VALUES ('56', '1', '91', 'Status change: Finished', '31.12.2019 01:16');
INSERT INTO `history` VALUES ('57', '1', '90', 'Status change: Finished', '31.12.2019 01:17');
INSERT INTO `history` VALUES ('58', '1', '83', 'Status change: Finished', '31.12.2019 01:17');
INSERT INTO `history` VALUES ('59', '1', '81', 'Attachment added: 20191227014329_Budget.pdf', '31.12.2019 01:31');
INSERT INTO `history` VALUES ('60', '1', '81', 'Attachment added: 12-path-filename.jpg', '31.12.2019 01:38');
INSERT INTO `history` VALUES ('61', '1', '87', 'Attachment added: 13-breadcrumbs.jpg', '31.12.2019 01:43');
INSERT INTO `history` VALUES ('62', '1', '92', 'Created.', '31.12.2019 01:43');
INSERT INTO `history` VALUES ('63', '1', '92', 'Status change: Active', '31.12.2019 01:44');
INSERT INTO `history` VALUES ('64', '1', '81', 'Status change: Finished', '31.12.2019 04:18');
INSERT INTO `history` VALUES ('65', '1', '87', 'Status change: Finished', '31.12.2019 04:19');
INSERT INTO `history` VALUES ('66', '1', '76', 'Status change: Finished', '31.12.2019 04:20');
INSERT INTO `history` VALUES ('67', '1', '78', 'Status change: Finished', '31.12.2019 04:21');
INSERT INTO `history` VALUES ('68', '1', '82', 'Status change: Finished', '31.12.2019 04:22');
INSERT INTO `history` VALUES ('69', '1', '89', 'Status change: Finished', '31.12.2019 04:22');
INSERT INTO `history` VALUES ('70', '1', '92', 'Status change: Finished', '31.12.2019 04:23');
INSERT INTO `history` VALUES ('71', '1', '73', 'Status change: Finished', '31.12.2019 11:04');
INSERT INTO `history` VALUES ('72', '1', '81', 'Attachment added: 07-noWeight.jpg', '31.12.2019 11:05');
INSERT INTO `history` VALUES ('73', '1', '87', 'Status change: Active', '31.12.2019 11:07');
INSERT INTO `history` VALUES ('74', '1', '87', 'Status change: Finished', '31.12.2019 11:07');
INSERT INTO `history` VALUES ('75', '1', '93', 'Created.', '31.12.2019 11:11');
INSERT INTO `history` VALUES ('76', '1', '93', 'Attachment added: 14-progress.jpg', '31.12.2019 11:11');
INSERT INTO `history` VALUES ('77', '1', '73', 'Status change: Active', '31.12.2019 11:12');
INSERT INTO `history` VALUES ('78', '1', '74', 'Status change: Finished', '31.12.2019 11:12');
INSERT INTO `history` VALUES ('79', '1', '76', 'Status change: Active', '31.12.2019 11:15');
INSERT INTO `history` VALUES ('80', '1', '78', 'Status change: Active', '31.12.2019 11:15');
INSERT INTO `history` VALUES ('81', '1', '94', 'Created.', '31.12.2019 11:16');
INSERT INTO `history` VALUES ('82', '1', '94', 'Status change: Paused', '31.12.2019 11:17');
INSERT INTO `history` VALUES ('83', '1', '95', 'Created.', '31.12.2019 11:17');
INSERT INTO `history` VALUES ('84', '1', '96', 'Created.', '31.12.2019 11:17');
INSERT INTO `history` VALUES ('85', '1', '95', 'Status change: Finished', '31.12.2019 11:17');
INSERT INTO `history` VALUES ('86', '1', '96', 'Status change: On hold', '31.12.2019 11:17');
INSERT INTO `history` VALUES ('87', '1', '74', 'Status change: Active', '31.12.2019 11:18');
INSERT INTO `history` VALUES ('88', '1', '97', 'Created.', '31.12.2019 11:19');
INSERT INTO `history` VALUES ('89', '1', '76', 'Status change: Finished', '03.01.2020 08:13');
INSERT INTO `history` VALUES ('90', '1', '93', 'Status change: Finished', '03.01.2020 10:17');
INSERT INTO `history` VALUES ('91', '1', '98', 'Created.', '03.01.2020 10:18');
INSERT INTO `history` VALUES ('92', '1', '98', 'Status change: On hold', '03.01.2020 10:19');
INSERT INTO `history` VALUES ('93', '1', '99', 'Created.', '03.01.2020 10:19');
INSERT INTO `history` VALUES ('96', '1', '97', 'Attachment added: 15-presetWeight.jpg', '03.01.2020 10:24');
INSERT INTO `history` VALUES ('97', '1', '100', 'Created.', '03.01.2020 10:33');
INSERT INTO `history` VALUES ('98', '1', '100', 'Attachment added: 17-memo.jpg', '03.01.2020 10:34');
INSERT INTO `history` VALUES ('99', '1', '100', 'Status change: Active', '03.01.2020 10:34');
INSERT INTO `history` VALUES ('100', '1', '101', 'Created.', '03.01.2020 10:34');
INSERT INTO `history` VALUES ('101', '1', '101', 'Status change: On hold', '03.01.2020 10:35');
INSERT INTO `history` VALUES ('102', '1', '102', 'Created.', '03.01.2020 10:42');
INSERT INTO `history` VALUES ('103', '1', '103', 'Created.', '03.01.2020 10:43');
INSERT INTO `history` VALUES ('104', '1', '103', 'Attachment added: 18-newTaskStatus.jpg', '03.01.2020 10:43');
INSERT INTO `history` VALUES ('105', '1', '104', 'Created.', '03.01.2020 10:46');
INSERT INTO `history` VALUES ('106', '1', '105', 'Created.', '03.01.2020 03:02');
INSERT INTO `history` VALUES ('107', '1', '104', 'Status change: Finished', '03.01.2020 03:02');
INSERT INTO `history` VALUES ('108', '1', '103', 'Status change: Finished', '03.01.2020 03:06');
INSERT INTO `history` VALUES ('109', '1', '106', 'Created.', '03.01.2020 03:06');
INSERT INTO `history` VALUES ('110', '1', '102', 'Status change: Finished', '03.01.2020 03:06');
INSERT INTO `history` VALUES ('111', '1', '107', 'Created.', '03.01.2020 03:07');
INSERT INTO `history` VALUES ('112', '1', '97', 'Status change: Finished', '03.01.2020 03:07');
INSERT INTO `history` VALUES ('113', '1', '108', 'Created.', '03.01.2020 03:14');
INSERT INTO `history` VALUES ('114', '1', '101', 'Status change: Paused', '03.01.2020 03:17');
INSERT INTO `history` VALUES ('115', '1', '101', 'Status change: Active', '03.01.2020 03:18');
INSERT INTO `history` VALUES ('116', '1', '101', 'Status change: Finished', '03.01.2020 03:18');
INSERT INTO `history` VALUES ('117', '1', '101', 'Status change: Paused', '03.01.2020 03:18');
INSERT INTO `history` VALUES ('118', '1', '101', 'Status change: Canceled', '03.01.2020 03:18');
INSERT INTO `history` VALUES ('119', '1', '100', 'Status change: Finished', '03.01.2020 03:20');
INSERT INTO `history` VALUES ('120', '1', '100', 'Status change: Active', '03.01.2020 03:21');
INSERT INTO `history` VALUES ('121', '1', '78', 'Attachment added: 19-statusIcons.jpg', '03.01.2020 03:22');
INSERT INTO `history` VALUES ('122', '1', '109', 'Created.', '03.01.2020 03:47');
INSERT INTO `history` VALUES ('123', '1', '110', 'Created.', '03.01.2020 03:47');
INSERT INTO `history` VALUES ('124', '1', '111', 'Created.', '03.01.2020 03:48');
INSERT INTO `history` VALUES ('125', '1', '112', 'Created.', '03.01.2020 03:50');
INSERT INTO `history` VALUES ('126', '1', '113', 'Created.', '03.01.2020 03:53');
INSERT INTO `history` VALUES ('127', '1', '78', 'Status change: Finished', '03.01.2020 03:57');
INSERT INTO `history` VALUES ('128', '1', '71', 'Status change: Finished', '03.01.2020 04:58');
INSERT INTO `history` VALUES ('129', '1', '69', 'Status change: On hold', '03.01.2020 04:58');
INSERT INTO `history` VALUES ('130', '1', '70', 'Status change: On hold', '03.01.2020 04:58');
INSERT INTO `history` VALUES ('131', '1', '114', 'Created.', '05.01.2020 10:03');
INSERT INTO `history` VALUES ('132', '1', '63', 'Status change: Finished', '06.01.2020 12:17');
INSERT INTO `history` VALUES ('133', '1', '64', 'Status change: On hold', '06.01.2020 12:17');
INSERT INTO `history` VALUES ('134', '1', '65', 'Status change: On hold', '06.01.2020 12:17');
INSERT INTO `history` VALUES ('135', '1', '64', 'Status change: Finished', '06.01.2020 12:18');
INSERT INTO `history` VALUES ('136', '1', '115', 'Created.', '06.01.2020 12:20');
INSERT INTO `history` VALUES ('137', '1', '115', 'Attachment added: a1 Ubiparipović.pdf', '06.01.2020 12:21');
INSERT INTO `history` VALUES ('138', '1', '116', 'Created.', '06.01.2020 12:26');
INSERT INTO `history` VALUES ('139', '1', '117', 'Created.', '06.01.2020 12:28');
INSERT INTO `history` VALUES ('140', '1', '118', 'Created.', '06.01.2020 12:42');
INSERT INTO `history` VALUES ('141', '1', '119', 'Created.', '06.01.2020 12:44');
INSERT INTO `history` VALUES ('142', '1', '120', 'Created.', '07.01.2020 12:37');
INSERT INTO `history` VALUES ('143', '1', '121', 'Created.', '07.01.2020 12:37');
INSERT INTO `history` VALUES ('144', '1', '122', 'Created.', '07.01.2020 12:39');
INSERT INTO `history` VALUES ('145', '1', '123', 'Created.', '07.01.2020 12:40');
INSERT INTO `history` VALUES ('146', '1', '121', 'Status change: Finished', '07.01.2020 12:40');

-- ----------------------------
-- Table structure for `memo`
-- ----------------------------
DROP TABLE IF EXISTS `memo`;
CREATE TABLE `memo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` varchar(19) COLLATE utf8_unicode_ci NOT NULL,
  `personID` int(11) NOT NULL,
  `taskID` int(11) NOT NULL,
  `Message` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `personID` (`personID`),
  KEY `taskID` (`taskID`),
  CONSTRAINT `personID` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `taskID` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of memo
-- ----------------------------
INSERT INTO `memo` VALUES ('10', '28.12.2019 12:39', '1', '76', 'just testing.123 233');
INSERT INTO `memo` VALUES ('11', '30.12.2019 10:51', '1', '80', 'Better, but still not perfect - check pic2');
INSERT INTO `memo` VALUES ('12', '03.01.2020 10:24', '1', '97', 'See the subtasks test1 and 2. Both were quick created, but 1 was later updated - i did not change status, priority or weight, but they got set after update anyway. test 2 was just quick created, and it has no main attributes.');
INSERT INTO `memo` VALUES ('13', '03.01.2020 02:09', '1', '100', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
INSERT INTO `memo` VALUES ('14', '03.01.2020 03:00', '1', '73', 'See the subtasks test1 and 2. Both were quick created, but 1 was later updated - i did not change status, priority or weight, but they got set after update anyway. test 2 was just quick created, and it has no main attributes.');
INSERT INTO `memo` VALUES ('15', '03.01.2020 03:16', '1', '73', 'See the subtasks test1 and 2. Both were quick created, but 1 was later updated - i did not change status, priority or weight, but they got set after update anyway. test 2 was just quick created, and it has no main attributes.');
INSERT INTO `memo` VALUES ('16', '03.01.2020 03:57', '1', '73', 'See the subtasks test1 and 2. Both were quick created, but 1 was later updated - i did not change status, priority or weight, but they got set after update anyway. test 2 was just quick created, and it has no main attributes.');
INSERT INTO `memo` VALUES ('17', '06.01.2020 12:21', '1', '115', 'test');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for `organization`
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `administrativeID` linestring DEFAULT NULL,
  `name` linestring NOT NULL,
  `addressID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_122` (`addressID`),
  CONSTRAINT `FK_122` FOREIGN KEY (`addressID`) REFERENCES `address` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of organization
-- ----------------------------

-- ----------------------------
-- Table structure for `organizationcontact`
-- ----------------------------
DROP TABLE IF EXISTS `organizationcontact`;
CREATE TABLE `organizationcontact` (
  `contactID` int(11) NOT NULL,
  `organiozationID` int(11) NOT NULL,
  KEY `fkIdx_118` (`contactID`),
  KEY `fkIdx_121` (`organiozationID`),
  CONSTRAINT `FK_118` FOREIGN KEY (`contactID`) REFERENCES `contact` (`ID`),
  CONSTRAINT `FK_121` FOREIGN KEY (`organiozationID`) REFERENCES `organization` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of organizationcontact
-- ----------------------------

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `person`
-- ----------------------------
DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nameFirst` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nameMiddle` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nameFamily` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roleID` int(11) NOT NULL DEFAULT 2,
  `addressID` int(11) NOT NULL DEFAULT 1,
  `administrativeID` int(11) NOT NULL DEFAULT 1,
  `userID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `fkIdx_51` (`addressID`),
  CONSTRAINT `FK_51` FOREIGN KEY (`addressID`) REFERENCES `address` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of person
-- ----------------------------
INSERT INTO `person` VALUES ('1', 'Afred', null, 'Antonijević', '1', '1', '1', '11', '2020-06-22 05:28:39', '2020-06-22 05:28:39');
INSERT INTO `person` VALUES ('2', 'Ivan', null, 'Balan', '2', '2', '1', '12', '2020-06-22 05:28:41', '2020-06-22 05:28:41');
INSERT INTO `person` VALUES ('3', 'Bitenc', null, 'Bitenc', '2', '2', '1', '13', '2020-06-22 05:28:42', '2020-06-22 05:28:42');
INSERT INTO `person` VALUES ('4', 'Bojanović', null, 'Bojanović', '4', '1', '1', '14', '2020-06-22 05:28:45', '2020-06-22 05:28:45');
INSERT INTO `person` VALUES ('5', 'Yang', null, 'Zhen', '2', '1', '1', '15', '2020-06-22 05:29:49', '2020-06-22 05:29:49');
INSERT INTO `person` VALUES ('6', 'Jin', null, 'Balan', '4', '1', '1', '16', '2020-06-22 05:30:00', '2020-06-22 05:30:00');
INSERT INTO `person` VALUES ('17', 'Xiao', null, 'Zhen', '4', '1', '1', '27', '2020-06-25 05:07:24', '2020-06-25 11:07:24');

-- ----------------------------
-- Table structure for `personcontact`
-- ----------------------------
DROP TABLE IF EXISTS `personcontact`;
CREATE TABLE `personcontact` (
  `contactID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  KEY `fkIdx_63` (`contactID`),
  KEY `fkIdx_66` (`personID`),
  CONSTRAINT `FK_63` FOREIGN KEY (`contactID`) REFERENCES `contact` (`ID`),
  CONSTRAINT `FK_66` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of personcontact
-- ----------------------------

-- ----------------------------
-- Table structure for `personorganization`
-- ----------------------------
DROP TABLE IF EXISTS `personorganization`;
CREATE TABLE `personorganization` (
  `personID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  KEY `fkIdx_110` (`personID`),
  KEY `fkIdx_113` (`organizationID`),
  CONSTRAINT `FK_110` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `FK_113` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of personorganization
-- ----------------------------

-- ----------------------------
-- Table structure for `personpersonrelation`
-- ----------------------------
DROP TABLE IF EXISTS `personpersonrelation`;
CREATE TABLE `personpersonrelation` (
  `ID` int(11) NOT NULL,
  `relationTypeID` int(11) NOT NULL,
  `personMainID` int(11) NOT NULL,
  `personRelatedID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_193` (`relationTypeID`),
  KEY `fkIdx_196` (`personMainID`),
  KEY `fkIdx_199` (`personRelatedID`),
  CONSTRAINT `FK_193` FOREIGN KEY (`relationTypeID`) REFERENCES `relationtype` (`ID`),
  CONSTRAINT `FK_196` FOREIGN KEY (`personMainID`) REFERENCES `person` (`ID`),
  CONSTRAINT `FK_199` FOREIGN KEY (`personRelatedID`) REFERENCES `person` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of personpersonrelation
-- ----------------------------

-- ----------------------------
-- Table structure for `relationtype`
-- ----------------------------
DROP TABLE IF EXISTS `relationtype`;
CREATE TABLE `relationtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `note` multilinestring DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of relationtype
-- ----------------------------

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tagtype` int(11) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `note` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='1. system tag\r\n2. organizations tag\r\n3. task tag\r\n4. personal tag';

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', 'IA', '4', '1', '1');
INSERT INTO `tag` VALUES ('2', 'NB', '4', '1', '1');
INSERT INTO `tag` VALUES ('3', 'JB', '4', '1', '1');
INSERT INTO `tag` VALUES ('4', 'Nab', '4', '1', '1');
INSERT INTO `tag` VALUES ('5', 'Project', '1', '1', '<span class=\'kt-badge kt-badge--success kt-badge--inline\'>PROJECT</span>');
INSERT INTO `tag` VALUES ('6', 'Milestone', '1', '1', '<span class=\'kt-badge kt-badge--warning  kt-badge--inline kt-badge--pill\'>Milestone</span>');
INSERT INTO `tag` VALUES ('7', 'ToDo', '1', '1', '<span class=\'kt-badge kt-badge--danger  kt-badge--inline kt-badge--pill\'>ToDo</span>');
INSERT INTO `tag` VALUES ('8', 'Customer', '1', '1', '<span class=\'kt-badge kt-badge--success  kt-badge--inline kt-badge--pill\'>Customer</span>');
INSERT INTO `tag` VALUES ('9', 'Overdue', '1', '1', '<span class=\'kt-badge kt-badge--check  kt-badge--inline kt-badge--pill\'>Overdue</span>');
INSERT INTO `tag` VALUES ('10', 'New', '1', '1', '<span class=\'kt-badge kt-badge--warning  kt-badge--inline kt-badge--pill\'>New</span>');
INSERT INTO `tag` VALUES ('11', 'A', '4', '1', '1');
INSERT INTO `tag` VALUES ('12', 'J', '4', '1', '1');

-- ----------------------------
-- Table structure for `tagorganization`
-- ----------------------------
DROP TABLE IF EXISTS `tagorganization`;
CREATE TABLE `tagorganization` (
  `tagID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  KEY `fkIdx_148` (`tagID`),
  KEY `fkIdx_151` (`organizationID`),
  CONSTRAINT `FK_148` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`),
  CONSTRAINT `FK_151` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tagorganization
-- ----------------------------

-- ----------------------------
-- Table structure for `tagperson`
-- ----------------------------
DROP TABLE IF EXISTS `tagperson`;
CREATE TABLE `tagperson` (
  `tagID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  KEY `fkIdx_141` (`tagID`),
  KEY `fkIdx_144` (`personID`),
  CONSTRAINT `FK_141` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_144` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tagperson
-- ----------------------------
INSERT INTO `tagperson` VALUES ('1', '1', null, null);
INSERT INTO `tagperson` VALUES ('2', '2', null, null);
INSERT INTO `tagperson` VALUES ('3', '3', null, null);
INSERT INTO `tagperson` VALUES ('4', '4', null, null);
INSERT INTO `tagperson` VALUES ('11', '5', null, null);
INSERT INTO `tagperson` VALUES ('12', '6', null, null);
INSERT INTO `tagperson` VALUES ('10', '3', null, null);
INSERT INTO `tagperson` VALUES ('10', '17', '2020-06-25 11:07:14', '2020-06-25 11:07:14');

-- ----------------------------
-- Table structure for `tagtask`
-- ----------------------------
DROP TABLE IF EXISTS `tagtask`;
CREATE TABLE `tagtask` (
  `tagID` int(11) NOT NULL,
  `taskID` int(11) NOT NULL,
  KEY `fkIdx_131` (`tagID`),
  KEY `fkIdx_134` (`taskID`),
  CONSTRAINT `FK_131` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`),
  CONSTRAINT `FK_134` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tagtask
-- ----------------------------

-- ----------------------------
-- Table structure for `tag_people`
-- ----------------------------
DROP TABLE IF EXISTS `tag_people`;
CREATE TABLE `tag_people` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tag_people
-- ----------------------------

-- ----------------------------
-- Table structure for `task`
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `datePlanStart` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePlanEnd` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateActualStart` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateActualEnd` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL,
  `priorityID` int(11) DEFAULT NULL,
  `weightID` int(11) DEFAULT NULL,
  `personID` int(11) DEFAULT NULL,
  `budgetAllocated` float DEFAULT NULL,
  `hoursAllocated` float DEFAULT NULL,
  `hourSpent` float DEFAULT NULL,
  `hourCost` float DEFAULT NULL,
  `organizationID` int(11) DEFAULT NULL,
  `locationID` int(11) DEFAULT NULL,
  `parentID` int(11) DEFAULT NULL,
  `tags` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creatAt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updateAt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `taskCreatorID` int(11) NOT NULL,
  `deleteFlag` int(1) unsigned zerofill NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkIdx_100` (`weightID`),
  KEY `fkIdx_116` (`organizationID`),
  KEY `fkIdx_119` (`locationID`),
  KEY `fkIdx_172` (`parentID`),
  KEY `fkIdx_46` (`personID`),
  KEY `fkIdx_82` (`statusID`),
  KEY `fkIdx_91` (`priorityID`),
  KEY `FK_92` (`taskCreatorID`),
  CONSTRAINT `FK_100` FOREIGN KEY (`weightID`) REFERENCES `taskweight` (`ID`),
  CONSTRAINT `FK_116` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`),
  CONSTRAINT `FK_119` FOREIGN KEY (`locationID`) REFERENCES `address` (`ID`),
  CONSTRAINT `FK_172` FOREIGN KEY (`parentID`) REFERENCES `task` (`ID`),
  CONSTRAINT `FK_46` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`),
  CONSTRAINT `FK_82` FOREIGN KEY (`statusID`) REFERENCES `taskstatus` (`ID`),
  CONSTRAINT `FK_91` FOREIGN KEY (`priorityID`) REFERENCES `taskpriority` (`ID`),
  CONSTRAINT `FK_92` FOREIGN KEY (`taskCreatorID`) REFERENCES `person` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('55', 'BMW Stutgart', '12.01.2019', '12.31.2019', '2019-12-30 07:44:09', null, '2', '1', '7', '1', null, null, null, null, null, null, null, '5,10', null, '2019-12-27 04:43:53', '2019-12-30 07:44:09', '1', '0');
INSERT INTO `task` VALUES ('56', 'Črni pasat', '27.12.2019', '03.04.2019', null, '2019-12-29 02:56:52', '4', '4', '1', '1', null, null, null, null, null, null, '55', '7', null, '2019-12-27 04:44:29', '2019-12-29 02:56:52', '1', '0');
INSERT INTO `task` VALUES ('57', 't32', '27.12.2019', '27.12.2019', null, null, '1', '1', '1', '3', null, null, null, null, null, null, '55', null, null, '2019-12-27 04:45:16', '2019-12-27 04:45:16', '1', '1');
INSERT INTO `task` VALUES ('58', 'Priprava orodja in materialov', '27.12.2019', '20.02.2020', null, '2020-01-06 12:17:56', '5', '1', '6', '2', null, null, null, null, null, null, '55', null, null, '2019-12-27 04:49:17', '2020-01-06 12:17:56', '1', '0');
INSERT INTO `task` VALUES ('59', 'Potrjevanje načrtov', '27.12.2019', '27.12.2019', null, null, '1', '2', '10', '3', null, null, null, null, null, null, '55', '7', null, '2019-12-27 05:02:21', '2019-12-27 05:02:21', '1', '0');
INSERT INTO `task` VALUES ('60', 'Polaganje kablov', '27.12.2019', '27.12.2019', null, null, '1', '1', '1', '2', null, null, null, null, null, null, '55', '7', null, '2019-12-27 05:04:47', '2019-12-27 05:04:47', '1', '0');
INSERT INTO `task` VALUES ('61', 'Priklop in testiranje', '27.12.2019', '27.12.2019', null, null, '1', '1', '1', '2', null, null, null, null, null, null, '55', null, null, '2019-12-27 05:05:23', '2019-12-27 05:05:23', '1', '0');
INSERT INTO `task` VALUES ('62', 'Voznik', '27.12.2019', '27.12.2019', null, null, null, null, null, '2', null, null, null, null, null, null, '56', null, null, '2019-12-27 05:06:09', '2019-12-27 05:06:09', '1', '0');
INSERT INTO `task` VALUES ('63', 'Preveri orodje', '27.12.2019', '27.12.2019', null, '2020-01-06 12:17:01', '4', '1', '4', '1', null, null, null, null, null, null, '58', null, null, '2019-12-27 05:06:33', '2020-01-06 12:17:01', '1', '0');
INSERT INTO `task` VALUES ('64', 'Nabava kablov', '27.12.2019', '27.12.2019', null, '2020-01-06 12:18:11', '4', '1', '8', '3', null, null, null, null, null, null, '58', null, null, '2019-12-27 05:06:52', '2020-01-06 12:18:11', '1', '0');
INSERT INTO `task` VALUES ('65', 'Nabava potrošnega materiala', '27.12.2019', '27.12.2019', null, null, '1', '1', '4', '1', null, null, null, null, null, null, '58', null, null, '2019-12-27 05:07:13', '2020-01-06 12:17:19', '1', '0');
INSERT INTO `task` VALUES ('66', 'Pregled', '27.12.2019', '27.12.2019', null, null, null, null, null, '3', null, null, null, null, null, null, '59', null, null, '2019-12-27 05:07:31', '2019-12-27 05:07:31', '1', '0');
INSERT INTO `task` VALUES ('67', 'Potrditev', '27.12.2019', '27.12.2019', null, null, null, null, null, '1', null, null, null, null, null, null, '59', null, null, '2019-12-27 05:07:42', '2019-12-27 05:07:42', '1', '0');
INSERT INTO `task` VALUES ('68', 'Metalfabrike Duseldorf', '12.10.2019', '07.23.2020', null, null, '3', '1', '6', '1', null, null, null, null, null, null, null, '5', null, '2019-12-27 05:10:25', '2019-12-27 05:10:25', '1', '0');
INSERT INTO `task` VALUES ('69', 'Načrtovanje', '27.12.2019', '27.12.2019', null, null, '1', '1', '6', '1', null, null, null, null, null, null, '68', null, null, '2019-12-27 05:10:56', '2020-01-03 04:58:49', '1', '0');
INSERT INTO `task` VALUES ('70', 'Priprava pogodbe', '27.12.2019', '27.12.2019', null, null, '1', '1', '9', '1', null, null, null, null, null, null, '68', null, null, '2019-12-27 05:12:10', '2020-01-03 04:58:54', '1', '0');
INSERT INTO `task` VALUES ('71', 'Predstavitev pri stranki', '27.12.2019', '27.12.2019', null, '2020-01-03 04:58:39', '4', '1', '5', '3', null, null, null, null, null, null, '68', null, null, '2019-12-27 05:12:26', '2020-01-03 04:58:39', '1', '0');
INSERT INTO `task` VALUES ('72', 'Poslovno kosilo', '27.12.2019', '27.12.2019', null, null, null, null, null, '2', null, null, null, null, null, null, '68', null, null, '2019-12-27 05:12:44', '2019-12-27 05:12:44', '1', '0');
INSERT INTO `task` VALUES ('73', 'Bug Fix', '28.12.2019', '03.01.2020', '2020-01-03 03:57:43', '2019-12-31 11:04:59', '2', '1', '10', '1', null, null, null, null, null, null, null, '7', 'Bugs and errors', '2019-12-28 12:35:32', '2020-01-03 03:57:43', '1', '0');
INSERT INTO `task` VALUES ('74', 'Missing functionality', '28.12.2019', '29.12.2019', '2019-12-31 11:18:02', '2019-12-31 11:12:59', '2', '1', '1', '1', null, null, null, null, null, null, null, null, null, '2019-12-28 12:36:02', '2019-12-31 11:18:02', '1', '0');
INSERT INTO `task` VALUES ('75', 'UX', '28.12.2019', '31.12.2019', null, null, '1', '1', '1', '1', null, null, null, null, null, null, null, null, 'Interface and design issues', '2019-12-28 12:36:33', '2019-12-31 01:51:36', '1', '0');
INSERT INTO `task` VALUES ('76', 'Display type icon', '28.12.2019', '28.12.2019', '2019-12-31 11:15:33', '2020-01-03 08:13:36', '4', '1', '3', '3', null, null, null, null, null, null, '75', null, 'Dont use cog for display type icon - it is for settings,\r\nShow selected display type icon.\r\n----\r\nShow icon of the display type that is being currenty used.', '2019-12-28 12:37:48', '2020-01-03 08:13:36', '1', '0');
INSERT INTO `task` VALUES ('77', 'Missing breadcrumbs', '28.12.2019', '28.12.2019', null, null, '1', '1', '1', '1', null, null, null, null, null, null, '75', null, 'Breadcrumbs are missing above the task title in details panel', '2019-12-28 12:40:38', '2019-12-28 12:41:08', '1', '1');
INSERT INTO `task` VALUES ('78', 'New task icon', '28.12.2019', '28.12.2019', '2020-01-03 03:23:47', '2020-01-03 03:57:31', '4', '1', '3', null, null, null, null, null, null, null, '75', null, 'New task icon (page with lines) for status is not needed. Set all new tasks to \"on hold\".\r\nAlso, it does not fit in the group.\r\n--- not done', '2019-12-28 12:43:06', '2020-01-03 03:57:31', '1', '0');
INSERT INTO `task` VALUES ('79', 'Preselect user in add task', '28.12.2019', '28.12.2019', '2019-12-30 11:06:10', '2019-12-30 11:06:21', '4', '1', '6', null, null, null, null, null, null, null, '74', null, null, '2019-12-28 12:43:46', '2019-12-30 11:06:21', '1', '0');
INSERT INTO `task` VALUES ('80', 'Focus issue', '28.12.2019', '28.12.2019', '2019-12-30 10:51:13', '2019-12-31 01:14:59', '4', '1', '5', '1', null, null, null, null, null, null, '73', null, 'This is description.', '2019-12-28 12:46:02', '2019-12-31 01:14:59', '1', '0');
INSERT INTO `task` VALUES ('81', 'Attachments', '28.12.2019', '28.12.2019', '2019-12-31 01:38:40', '2019-12-31 11:05:51', '4', '2', '10', null, null, null, null, null, null, null, '74', null, 'Show selected file after file is selected for upload. After file is selected show name/path in input field', '2019-12-28 03:52:29', '2019-12-31 11:05:51', '1', '0');
INSERT INTO `task` VALUES ('82', 'Remove dialog stating what was done', '28.12.2019', '28.12.2019', '2019-12-30 11:27:39', '2019-12-31 04:22:22', '4', '3', '5', null, null, null, null, null, null, null, '75', null, 'no need for', '2019-12-28 03:53:25', '2019-12-31 04:22:22', '1', '0');
INSERT INTO `task` VALUES ('83', 'Budget', '29.12.2019', '29.12.2019', '2019-12-30 10:52:41', '2019-12-31 01:17:49', '4', '1', '7', '1', null, null, null, null, null, null, '73', null, null, '2019-12-29 02:51:56', '2019-12-31 01:17:49', '1', '0');
INSERT INTO `task` VALUES ('84', 'Cumulative budget', '29.12.2019', '29.12.2019', null, '2019-12-31 01:10:02', '4', '1', '5', '1', null, null, null, null, null, null, '83', null, null, '2019-12-29 02:52:17', '2019-12-31 01:10:02', '1', '0');
INSERT INTO `task` VALUES ('85', 'Adding quick expense', '29.12.2019', '29.12.2019', '2019-12-30 10:52:34', '2019-12-31 01:10:26', '4', '1', '6', '1', null, null, null, null, null, null, '83', null, 'quick expense not working', '2019-12-29 02:54:08', '2019-12-31 01:10:26', '1', '0');
INSERT INTO `task` VALUES ('86', 'Person in Charge changes', '29.12.2019', '29.12.2019', '2019-12-30 11:15:17', '2019-12-31 12:55:56', '4', '1', '10', '3', null, null, null, null, null, null, '73', null, 'Some PiC settings are lost', '2019-12-29 03:10:23', '2019-12-31 12:55:56', '1', '0');
INSERT INTO `task` VALUES ('87', 'Breacrumbs', '30.12.2019', '30.12.2019', '2019-12-31 11:07:26', '2019-12-31 11:07:47', '4', '1', '4', '3', null, null, null, null, null, null, '74', null, 'make font smaller, it takes too much space', '2019-12-30 08:31:56', '2019-12-31 11:07:47', '1', '0');
INSERT INTO `task` VALUES ('88', 'Weight status bug', '30.12.2019', '30.12.2019', null, '2019-12-30 09:53:11', '4', '1', '10', '1', null, null, null, null, null, null, '73', null, null, '2019-12-30 08:58:35', '2019-12-30 09:53:11', '1', '0');
INSERT INTO `task` VALUES ('89', 'Preselected Priority = M', '30.12.2019', '30.12.2019', '2019-12-30 09:07:23', '2019-12-31 04:22:55', '4', '2', '2', '1', null, null, null, null, null, null, '75', null, null, '2019-12-30 09:05:46', '2019-12-31 04:22:55', '1', '0');
INSERT INTO `task` VALUES ('90', 'Progress ahead bar', '30.12.2019', '30.12.2019', '2019-12-30 10:58:32', '2019-12-31 01:17:19', '4', '2', '4', '1', null, null, null, null, null, null, '73', null, 'Progress bar colors well, if progress is behind time, but not OK if ahead. If progress is ahead, time spent line should be on top of green progress line, to show how much ahead we are.', '2019-12-30 10:58:32', '2019-12-31 01:17:19', '1', '0');
INSERT INTO `task` VALUES ('91', 'Add expense input is shifted', '31.12.2019', '31.12.2019', '2019-12-31 01:13:09', '2019-12-31 01:16:46', '4', '1', '4', '1', null, null, null, null, null, null, '83', null, 'see pic', '2019-12-31 12:57:28', '2019-12-31 01:16:46', '5', '0');
INSERT INTO `task` VALUES ('92', 'Progress bar fix for 1 day tasks', '31.12.2019', '31.12.2019', '2019-12-31 01:44:13', '2019-12-31 04:23:38', '4', '2', '5', '1', null, null, null, null, null, null, '75', null, null, '2019-12-31 01:43:59', '2019-12-31 04:23:38', '1', '0');
INSERT INTO `task` VALUES ('93', 'Progress bar', '31.12.2019', '31.12.2019', null, '2020-01-03 10:17:34', '4', '2', '8', '1', null, null, null, null, null, null, '73', null, 'Progress bar does not show progress made - task is finished, but bar shows only 30-50 % completed. See pic', '2019-12-31 11:11:02', '2020-01-03 10:17:34', '1', '0');
INSERT INTO `task` VALUES ('94', 'Test', '31.12.2019', '31.12.2019', null, null, '3', '2', '1', '1', null, null, null, null, null, null, null, null, null, '2019-12-31 11:16:48', '2019-12-31 11:17:04', '1', '1');
INSERT INTO `task` VALUES ('95', 'T1', '31.12.2019', '31.12.2019', null, '2019-12-31 11:17:29', '4', '1', '3', '1', null, null, null, null, null, null, '94', null, null, '2019-12-31 11:17:13', '2019-12-31 11:17:29', '1', '1');
INSERT INTO `task` VALUES ('96', 'T2', '31.12.2019', '31.12.2019', null, null, '1', '1', '4', '1', null, null, null, null, null, null, '94', null, null, '2019-12-31 11:17:19', '2019-12-31 11:17:50', '1', '1');
INSERT INTO `task` VALUES ('97', 'Preset Weight = 0', '31.12.2019', '31.12.2019', null, '2020-01-03 03:07:46', '4', '2', '6', '1', null, null, null, null, null, null, '74', null, 'Preset weight must be zero, but it looks like it is NIL. Maybe that is where progress errors originate from.\r\ntest', '2019-12-31 11:19:05', '2020-01-03 03:07:46', '1', '0');
INSERT INTO `task` VALUES ('98', 'test1', '03.01.2020', '03.01.2020', null, null, '1', '1', '1', '1', null, null, null, null, null, null, '97', null, 'test', '2020-01-03 10:18:04', '2020-01-03 10:43:27', '1', '0');
INSERT INTO `task` VALUES ('99', 'test 2', '03.01.2020', '03.01.2020', null, null, null, null, null, '1', null, null, null, null, null, null, '97', null, null, '2020-01-03 10:19:14', '2020-01-03 10:19:14', '1', '0');
INSERT INTO `task` VALUES ('100', 'Memo text is cut', '03.01.2020', '03.01.2020', '2020-01-03 03:21:01', '2020-01-03 03:20:56', '2', '2', '10', '1', null, null, null, null, null, null, '73', null, 'Memo text is cut; i think quick fix is to move it under the timestamp and user line', '2020-01-03 10:33:04', '2020-01-03 03:21:01', '1', '0');
INSERT INTO `task` VALUES ('101', 'Unexplained error', '03.01.2020', '03.01.2020', '2020-01-03 03:18:03', '2020-01-03 03:18:33', '5', '1', '6', '1', null, null, null, null, null, null, '73', null, 'See the subtasks test1 and 2. Both were quick created, but 1 was later updated - i did not change status, priority or weight, but they got set after update anyway. test 2 was just quick created, and it has no main attributes.', '2020-01-03 10:34:53', '2020-01-03 03:18:33', '1', '0');
INSERT INTO `task` VALUES ('102', 'Breadcrumbs must have links', '03.01.2020', '03.01.2020', null, '2020-01-03 03:06:59', '4', '2', '6', '1', null, null, null, null, null, null, '74', null, 'Breadcrumbs must have link to the up-tasks in task hierarchy.\r\nIf i click on one of the previous tasks in bradcrumbs, that task must be selected.', '2020-01-03 10:42:14', '2020-01-03 03:06:59', '1', '0');
INSERT INTO `task` VALUES ('103', 'New task status', '03.01.2020', '03.01.2020', null, '2020-01-03 03:06:10', '4', '2', '8', '1', null, null, null, null, null, null, '74', null, 'When I create new task from the top column button, i can not change status - it has no drop down field', '2020-01-03 10:43:31', '2020-01-03 03:06:10', '1', '0');
INSERT INTO `task` VALUES ('104', 'Quick add task priority', '03.01.2020', '03.01.2020', null, '2020-01-03 03:02:37', '4', '2', '1', '1', null, null, null, null, null, null, '73', null, 'Quick add task still has priority set to H, while it should be M', '2020-01-03 10:46:04', '2020-01-03 03:02:37', '1', '0');
INSERT INTO `task` VALUES ('105', 'test3', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '104', null, null, '2020-01-03 03:02:19', '2020-01-03 03:02:19', '1', '0');
INSERT INTO `task` VALUES ('106', 'test 1', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '102', null, null, '2020-01-03 03:06:37', '2020-01-03 03:06:37', '1', '0');
INSERT INTO `task` VALUES ('107', 'test 3', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '97', null, null, '2020-01-03 03:07:34', '2020-01-03 03:07:34', '1', '0');
INSERT INTO `task` VALUES ('108', 'dfsdfsdfsd', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, null, null, null, '2020-01-03 03:14:32', '2020-01-03 03:14:32', '1', '1');
INSERT INTO `task` VALUES ('109', 'test status', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '78', null, null, '2020-01-03 03:47:12', '2020-01-03 03:47:12', '1', '0');
INSERT INTO `task` VALUES ('110', 'test status 2', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '78', null, null, '2020-01-03 03:47:36', '2020-01-03 03:47:36', '1', '0');
INSERT INTO `task` VALUES ('111', 'test status 3', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '78', null, null, '2020-01-03 03:48:19', '2020-01-03 03:48:19', '1', '0');
INSERT INTO `task` VALUES ('112', 'test status 4', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '78', null, null, '2020-01-03 03:50:00', '2020-01-03 03:50:00', '1', '0');
INSERT INTO `task` VALUES ('113', 'test status 5', '03.01.2020', '03.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '78', null, null, '2020-01-03 03:53:02', '2020-01-03 03:53:02', '1', '0');
INSERT INTO `task` VALUES ('114', 'Test task', '15.01.2020', '22.01.2020', '2020-01-05 10:03:28', null, '2', '3', '3', '2', null, null, null, null, null, null, null, '5,7', null, '2020-01-05 10:03:28', '2020-01-05 10:03:28', '1', '0');
INSERT INTO `task` VALUES ('115', 'Pregled opreme', '08.01.2020', '10.01.2020', '2020-01-06 12:21:45', null, '2', '3', '3', '3', null, null, null, null, null, null, '58', '7', null, '2020-01-06 12:20:50', '2020-01-06 12:21:45', '1', '0');
INSERT INTO `task` VALUES ('116', 'Elektroinštalacije', '06.01.2020', '06.01.2020', null, null, '1', '2', '1', '2', null, null, null, null, null, null, '60', null, null, '2020-01-06 12:26:09', '2020-01-06 12:26:09', '1', '0');
INSERT INTO `task` VALUES ('117', 'Elektroinštalacije', '06.01.2020', '06.01.2020', null, null, '1', '2', '1', '3', null, null, null, null, null, null, '60', null, null, '2020-01-06 12:28:26', '2020-01-06 12:28:26', '1', '0');
INSERT INTO `task` VALUES ('118', 'Janez Bitenc', '06.01.2020', '06.01.2020', null, null, '1', '2', '1', '3', null, null, null, null, null, null, '55', null, null, '2020-01-06 12:42:18', '2020-01-06 12:42:18', '1', '0');
INSERT INTO `task` VALUES ('119', 'x', '06.01.2020', '06.01.2020', null, null, '1', '2', '1', '2', null, null, null, null, null, null, '60', null, null, '2020-01-06 12:44:15', '2020-01-06 12:44:15', '1', '0');
INSERT INTO `task` VALUES ('120', 'Pozar', '07.01.2020', '07.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, null, null, null, '2020-01-07 12:37:08', '2020-01-07 12:37:08', '1', '0');
INSERT INTO `task` VALUES ('121', 'Visok riziko', '07.01.2020', '07.01.2020', null, '2020-01-07 12:40:36', '4', '2', '1', '1', null, null, null, null, null, null, '120', null, null, '2020-01-07 12:37:42', '2020-01-07 12:40:36', '1', '0');
INSERT INTO `task` VALUES ('122', 'srednji riziko', '07.01.2020', '07.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '120', null, null, '2020-01-07 12:39:59', '2020-01-07 12:39:59', '1', '0');
INSERT INTO `task` VALUES ('123', 'nizek riziko', '07.01.2020', '07.01.2020', null, null, '1', '2', '1', '1', null, null, null, null, null, null, '120', null, null, '2020-01-07 12:40:17', '2020-01-07 12:40:17', '1', '0');

-- ----------------------------
-- Table structure for `taskpriority`
-- ----------------------------
DROP TABLE IF EXISTS `taskpriority`;
CREATE TABLE `taskpriority` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(19) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `note` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of taskpriority
-- ----------------------------
INSERT INTO `taskpriority` VALUES ('1', 'H', '1', 'High');
INSERT INTO `taskpriority` VALUES ('2', 'M', '2', 'Medium');
INSERT INTO `taskpriority` VALUES ('3', 'L', '3', 'Low');
INSERT INTO `taskpriority` VALUES ('4', 'O', '4', 'O');

-- ----------------------------
-- Table structure for `taskstatus`
-- ----------------------------
DROP TABLE IF EXISTS `taskstatus`;
CREATE TABLE `taskstatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of taskstatus
-- ----------------------------
INSERT INTO `taskstatus` VALUES ('1', 'On hold', '<i class=\"fa fa-circle\"></i>');
INSERT INTO `taskstatus` VALUES ('2', 'Active', '<i class=\'flaticon2-arrow lg\'></i>');
INSERT INTO `taskstatus` VALUES ('3', 'Paused', '<i class=\'fa fa-pause\'></i>');
INSERT INTO `taskstatus` VALUES ('4', 'Finished', '<i class=\'flaticon2-check-mark\'></i>');
INSERT INTO `taskstatus` VALUES ('5', 'Canceled', '<i class=\'flaticon2-hexagonal\'></i>');

-- ----------------------------
-- Table structure for `taskweight`
-- ----------------------------
DROP TABLE IF EXISTS `taskweight`;
CREATE TABLE `taskweight` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` int(20) NOT NULL,
  `order` int(11) NOT NULL,
  `note` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of taskweight
-- ----------------------------
INSERT INTO `taskweight` VALUES ('1', '0', '1', 'note_1');
INSERT INTO `taskweight` VALUES ('2', '1', '2', 'note_2');
INSERT INTO `taskweight` VALUES ('3', '2', '3', 'note_3');
INSERT INTO `taskweight` VALUES ('4', '3', '4', 'note_4');
INSERT INTO `taskweight` VALUES ('5', '4', '5', 'note_5');
INSERT INTO `taskweight` VALUES ('6', '5', '6', 'note_6');
INSERT INTO `taskweight` VALUES ('7', '6', '7', 'note_7');
INSERT INTO `taskweight` VALUES ('8', '7', '8', 'note_8');
INSERT INTO `taskweight` VALUES ('9', '8', '9', 'note_9');
INSERT INTO `taskweight` VALUES ('10', '9', '9', 'note_10');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nameFirst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameFamily` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('11', 'Afred', 'Antonijević', 'test@test.com', null, '$2y$10$2vRuB4GGvyBuO/cXFaRIQOR9w7/7VLeg6MCuqu3I4nDrxpgbDqxU.', null, '2020-06-22 11:27:04', '2020-06-22 11:27:04');
INSERT INTO `users` VALUES ('12', 'Ivan', 'Balan', 'test1@test.com', null, '$2y$10$lPt3XJuXpqdnjZW93wZCNeI/zlZE8AGhqHKoo1hiA2qTnXeZPibUO', null, '2020-06-22 11:27:04', '2020-06-22 11:27:04');
INSERT INTO `users` VALUES ('13', 'Bitenc', 'Bitenc', 'test2@test.com', null, '$2y$10$s2ah04FUXyNXs5g9YGFxxOmrkqH2MpJlqCU8RgRlWi6Yq7EirWxYK', null, '2020-06-22 11:27:04', '2020-06-22 11:27:04');
INSERT INTO `users` VALUES ('14', 'Bojanovic', 'Bojanović', 'test3@test.com', null, '$2y$10$JE9vbjKZSvwkCHgTdweuRu8Fm6WKKgaK0H5kqlNfuo5M4BUa8U2g6', null, '2020-06-22 11:27:05', '2020-06-22 11:27:05');
INSERT INTO `users` VALUES ('15', 'Yang', 'Zhen', 'test4@test.com', null, '$2y$10$bFW36btqoiNZLy3IhqNCfeS4uU8u2R.mKC.B84wA.Rm3.zou8PjCW', null, '2020-06-22 11:27:05', '2020-06-22 11:27:05');
INSERT INTO `users` VALUES ('16', 'Jin', 'Balan', 'test5@test.com', null, '$2y$10$ZopfKjZXfVTFxS1/YrnVv.PlIaYnIV38XkdFGr5likumH6ypxNJp6', null, '2020-06-22 11:27:05', '2020-06-22 11:27:05');

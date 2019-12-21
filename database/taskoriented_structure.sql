/*
 Navicat Premium Data Transfer

 Source Server         : localhost_mysql
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : taskoriented

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 19/12/2019 18:41:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `street` linestring NULL,
  `houseNumber` int(11) NULL DEFAULT NULL,
  `additionalLine` linestring NULL,
  `note` multilinestring NULL,
  `cityID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_135`(`cityID`) USING BTREE,
  CONSTRAINT `FK_135` FOREIGN KEY (`cityID`) REFERENCES `city` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` linestring NOT NULL,
  `cityCode` linestring NULL,
  `note` multilinestring NULL,
  `countryID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_146`(`countryID`) USING BTREE,
  CONSTRAINT `FK_146` FOREIGN KEY (`countryID`) REFERENCES `country` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typeID` int(11) NOT NULL,
  `value` linestring NOT NULL,
  `note` linestring NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_74`(`typeID`) USING BTREE,
  CONSTRAINT `FK_74` FOREIGN KEY (`typeID`) REFERENCES `contacttype` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contacttype
-- ----------------------------
DROP TABLE IF EXISTS `contacttype`;
CREATE TABLE `contacttype`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` linestring NOT NULL,
  `postCode` linestring NULL,
  `telephoneCode` linestring NULL,
  `internetCode` linestring NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for expence
-- ----------------------------
DROP TABLE IF EXISTS `expence`;
CREATE TABLE `expence`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `value` float NOT NULL,
  `currencyID` int(11) NOT NULL,
  `note` multilinestring NULL,
  `taskID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_156`(`taskID`) USING BTREE,
  CONSTRAINT `FK_156` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for memo
-- ----------------------------
DROP TABLE IF EXISTS `memo`;
CREATE TABLE `memo`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` datetime(0) NOT NULL,
  `personID` int(11) NOT NULL,
  `taskID` int(11) NOT NULL,
  `ID_1` int(11) NOT NULL,
  `ID_1_1` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_165`(`ID_1`) USING BTREE,
  INDEX `fkIdx_168`(`ID_1_1`) USING BTREE,
  CONSTRAINT `FK_165` FOREIGN KEY (`ID_1`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_168` FOREIGN KEY (`ID_1_1`) REFERENCES `task` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for organization
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `administrativeID` linestring NULL,
  `name` linestring NOT NULL,
  `addressID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_122`(`addressID`) USING BTREE,
  CONSTRAINT `FK_122` FOREIGN KEY (`addressID`) REFERENCES `address` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for organizationcontact
-- ----------------------------
DROP TABLE IF EXISTS `organizationcontact`;
CREATE TABLE `organizationcontact`  (
  `contactID` int(11) NOT NULL,
  `organiozationID` int(11) NOT NULL,
  INDEX `fkIdx_118`(`contactID`) USING BTREE,
  INDEX `fkIdx_121`(`organiozationID`) USING BTREE,
  CONSTRAINT `FK_118` FOREIGN KEY (`contactID`) REFERENCES `contact` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_121` FOREIGN KEY (`organiozationID`) REFERENCES `organization` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for person
-- ----------------------------
DROP TABLE IF EXISTS `person`;
CREATE TABLE `person`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nameFirst` linestring NOT NULL,
  `nameMiddle` linestring NULL,
  `nameFamily` linestring NOT NULL,
  `roleID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL,
  `administrativeID` linestring NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_51`(`addressID`) USING BTREE,
  CONSTRAINT `FK_51` FOREIGN KEY (`addressID`) REFERENCES `address` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personcontact
-- ----------------------------
DROP TABLE IF EXISTS `personcontact`;
CREATE TABLE `personcontact`  (
  `contactID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  INDEX `fkIdx_63`(`contactID`) USING BTREE,
  INDEX `fkIdx_66`(`personID`) USING BTREE,
  CONSTRAINT `FK_63` FOREIGN KEY (`contactID`) REFERENCES `contact` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_66` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personorganization
-- ----------------------------
DROP TABLE IF EXISTS `personorganization`;
CREATE TABLE `personorganization`  (
  `personID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  INDEX `fkIdx_110`(`personID`) USING BTREE,
  INDEX `fkIdx_113`(`organizationID`) USING BTREE,
  CONSTRAINT `FK_110` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_113` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personpersonrelation
-- ----------------------------
DROP TABLE IF EXISTS `personpersonrelation`;
CREATE TABLE `personpersonrelation`  (
  `ID` int(11) NOT NULL,
  `relationTypeID` int(11) NOT NULL,
  `personMainID` int(11) NOT NULL,
  `personRelatedID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_193`(`relationTypeID`) USING BTREE,
  INDEX `fkIdx_196`(`personMainID`) USING BTREE,
  INDEX `fkIdx_199`(`personRelatedID`) USING BTREE,
  CONSTRAINT `FK_193` FOREIGN KEY (`relationTypeID`) REFERENCES `relationtype` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_196` FOREIGN KEY (`personMainID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_199` FOREIGN KEY (`personRelatedID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for relationtype
-- ----------------------------
DROP TABLE IF EXISTS `relationtype`;
CREATE TABLE `relationtype`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` linestring NOT NULL,
  `systemTag` int(11) NULL DEFAULT NULL,
  `color` int(11) NULL DEFAULT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tagorganization
-- ----------------------------
DROP TABLE IF EXISTS `tagorganization`;
CREATE TABLE `tagorganization`  (
  `tagID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  INDEX `fkIdx_148`(`tagID`) USING BTREE,
  INDEX `fkIdx_151`(`organizationID`) USING BTREE,
  CONSTRAINT `FK_148` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_151` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tagperson
-- ----------------------------
DROP TABLE IF EXISTS `tagperson`;
CREATE TABLE `tagperson`  (
  `tagID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  INDEX `fkIdx_141`(`tagID`) USING BTREE,
  INDEX `fkIdx_144`(`personID`) USING BTREE,
  CONSTRAINT `FK_141` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_144` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tagtask
-- ----------------------------
DROP TABLE IF EXISTS `tagtask`;
CREATE TABLE `tagtask`  (
  `tagID` int(11) NOT NULL,
  `taskID` int(11) NOT NULL,
  INDEX `fkIdx_131`(`tagID`) USING BTREE,
  INDEX `fkIdx_134`(`taskID`) USING BTREE,
  CONSTRAINT `FK_131` FOREIGN KEY (`tagID`) REFERENCES `tag` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_134` FOREIGN KEY (`taskID`) REFERENCES `task` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `datePlanStart` datetime(0) NULL DEFAULT NULL,
  `datePlanEnd` datetime(0) NULL DEFAULT NULL,
  `dateActualStart` datetime(0) NULL DEFAULT NULL,
  `dateActualEnd` datetime(0) NULL DEFAULT NULL,
  `statusID` int(11) NOT NULL,
  `priorityID` int(11) NOT NULL,
  `weightID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `budgetAllocated` float NULL DEFAULT NULL,
  `hoursAllocated` float NULL DEFAULT NULL,
  `hourSpent` float NULL DEFAULT NULL,
  `hourCost` float NULL DEFAULT NULL,
  `organizationID` int(11) NULL DEFAULT NULL,
  `locationID` int(11) NULL DEFAULT NULL,
  `parentID` int(11) NULL DEFAULT NULL,
  `description` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fkIdx_100`(`weightID`) USING BTREE,
  INDEX `fkIdx_116`(`organizationID`) USING BTREE,
  INDEX `fkIdx_119`(`locationID`) USING BTREE,
  INDEX `fkIdx_172`(`parentID`) USING BTREE,
  INDEX `fkIdx_46`(`personID`) USING BTREE,
  INDEX `fkIdx_82`(`statusID`) USING BTREE,
  INDEX `fkIdx_91`(`priorityID`) USING BTREE,
  CONSTRAINT `FK_100` FOREIGN KEY (`weightID`) REFERENCES `taskweight` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_116` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_119` FOREIGN KEY (`locationID`) REFERENCES `address` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_172` FOREIGN KEY (`parentID`) REFERENCES `task` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_46` FOREIGN KEY (`personID`) REFERENCES `person` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_82` FOREIGN KEY (`statusID`) REFERENCES `taskstatus` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_91` FOREIGN KEY (`priorityID`) REFERENCES `taskpriority` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for taskpriority
-- ----------------------------
DROP TABLE IF EXISTS `taskpriority`;
CREATE TABLE `taskpriority`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `order` int(11) NOT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for taskstatus
-- ----------------------------
DROP TABLE IF EXISTS `taskstatus`;
CREATE TABLE `taskstatus`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for taskweight
-- ----------------------------
DROP TABLE IF EXISTS `taskweight`;
CREATE TABLE `taskweight`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` linestring NOT NULL,
  `order` int(11) NOT NULL,
  `note` multilinestring NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

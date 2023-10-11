/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - encore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`encore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `encore`;

/*Table structure for table `activities` */

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activities` */

insert  into `activities`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Medical Camp',1,1,'2023-10-02 12:19:32','2023-10-02 12:19:32'),
(2,'Social activities',1,1,'2023-10-02 12:19:47','2023-10-02 12:20:28');

/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

insert  into `activity_log`(`id`,`log_name`,`description`,`subject_type`,`event`,`subject_id`,`causer_type`,`causer_id`,`properties`,`batch_uuid`,`created_at`,`updated_at`) values 
(1,'default','created','App\\Models\\User','created',29,NULL,NULL,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@gmail.com\",\"password\":\"$2y$10$dk5\\/2qBnnMyO6Z8Uv7ORBuYPoxOzRLHT4wzkq\\/rzIPqIO\\/Z8oOdJe\",\"active\":0}}',NULL,'2023-10-02 07:49:00','2023-10-02 07:49:00'),
(2,'default','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1},\"old\":{\"name\":\"arpita\",\"email\":\"admin@mail.com\",\"password\":\"$2y$10$yRljs\\/zceTjd3cA323iv7.1zmM\\/9oq\\/i23S85bUDBXPAFizWcIGKq\",\"active\":1}}',NULL,'2023-10-02 11:50:43','2023-10-02 11:50:43'),
(3,'default','created','App\\Models\\User','created',30,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"ABHINAV\",\"email\":\"abhinav@encore.com\",\"password\":\"$2y$10$m2BoNuDR9hVNgHLFJih8s.e84naCAOjS9SDafZ8gXvL.ThvxB6r3e\",\"active\":1}}',NULL,'2023-10-05 08:10:47','2023-10-05 08:10:47'),
(4,'default','created','App\\Models\\User','created',31,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"ABHINAV\",\"email\":\"abhinav@encore.com\",\"password\":\"$2y$10$pLXvefEEjz11Tyk\\/dq1f3ue.rp948I1ysw3lnY7kKTJT9y2qR4X1q\",\"active\":1}}',NULL,'2023-10-05 08:12:27','2023-10-05 08:12:27'),
(5,'default','created','App\\Models\\User','created',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$l2CG.4Bn5p8BQlpVYLPIW.uBTAQFKi7PqX\\/fNvwh8VlGyHvvbDn66\",\"active\":1}}',NULL,'2023-10-09 05:22:14','2023-10-09 05:22:14'),
(6,'default','created','App\\Models\\User','created',3,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Abhishek\",\"email\":\"abhishek@encore.com\",\"password\":\"$2y$10$cxOIvuyE.9MZDjfdul1pGuvapcOfRb80G\\/uZIGKWFnwHkT1SjnHpm\",\"active\":1}}',NULL,'2023-10-09 05:25:00','2023-10-09 05:25:00'),
(7,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$fUmX7.ablcRDHhnm6fqAeOg85R86dSuTq15MZvtvtQV7eubr05SSq\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$l2CG.4Bn5p8BQlpVYLPIW.uBTAQFKi7PqX\\/fNvwh8VlGyHvvbDn66\",\"active\":1}}',NULL,'2023-10-09 05:25:23','2023-10-09 05:25:23'),
(8,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$vPDmGDqU\\/k3QQGsb2ZmJFetZzXc8RMbfCA0mjvMMepGJbv1ifX4SC\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$fUmX7.ablcRDHhnm6fqAeOg85R86dSuTq15MZvtvtQV7eubr05SSq\",\"active\":1}}',NULL,'2023-10-09 05:25:24','2023-10-09 05:25:24'),
(9,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$Y3Ii.Fq7GgGjCH.ycIdBX.gFQfIljtiCWAo.ozkwhcGr5kMKJdqjS\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$vPDmGDqU\\/k3QQGsb2ZmJFetZzXc8RMbfCA0mjvMMepGJbv1ifX4SC\",\"active\":1}}',NULL,'2023-10-09 05:25:55','2023-10-09 05:25:55'),
(10,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$RNhV9jDX9i0R.Ln3eZCRLusTCEP1fcjMh9ixqh4KRo\\/TAqfEFiOz2\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$Y3Ii.Fq7GgGjCH.ycIdBX.gFQfIljtiCWAo.ozkwhcGr5kMKJdqjS\",\"active\":1}}',NULL,'2023-10-09 05:39:37','2023-10-09 05:39:37'),
(11,'default','updated','App\\Models\\User','updated',3,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Abhishek\",\"email\":\"abhishek@encore.com\",\"password\":\"$2y$10$b\\/AXaW7wIpNoJKfutjitJOTqb8SgAJAYErXftf32JyVkx66kugsgy\",\"active\":1},\"old\":{\"name\":\"Abhishek\",\"email\":\"abhishek@encore.com\",\"password\":\"$2y$10$cxOIvuyE.9MZDjfdul1pGuvapcOfRb80G\\/uZIGKWFnwHkT1SjnHpm\",\"active\":1}}',NULL,'2023-10-09 05:39:46','2023-10-09 05:39:46'),
(12,'default','created','App\\Models\\User','created',4,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$AfZ3Qon1F0RF\\/AeWg0XO..9hbsf2KtsveaBVCHkD0G\\/EHjtBnl3bS\",\"active\":1}}',NULL,'2023-10-09 05:46:48','2023-10-09 05:46:48'),
(13,'default','created','App\\Models\\User','created',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$gXNGA7z9oKEhm2FEmBJzCu1Yral\\/sjkZid7Liq1mVNe3iIlz48bkS\",\"active\":1}}',NULL,'2023-10-09 05:48:27','2023-10-09 05:48:27'),
(14,'default','created','App\\Models\\User','created',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$4IcGQtr8mXW8Uav4Izgri.rUpvX7KHEiX5AMsSfTCEwSik\\/.NADry\",\"active\":1}}',NULL,'2023-10-09 05:48:30','2023-10-09 05:48:30'),
(15,'default','created','App\\Models\\User','created',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$lKnfCOfbrgvNhaRTPMaUp.1jcnp31OfxHw4Kk6.VUzb45gmvJfN\\/y\",\"active\":1}}',NULL,'2023-10-09 05:48:31','2023-10-09 05:48:31'),
(16,'default','created','App\\Models\\User','created',8,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$.GonB.M4a8Vv7v2OD7By0uTFWQwbkqpRSjI6Ot4PZJ4hnf7\\/b\\/ls.\",\"active\":1}}',NULL,'2023-10-09 05:48:32','2023-10-09 05:48:32'),
(17,'default','created','App\\Models\\User','created',9,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$ZEqlpUonY4W521b2mISFAudrajOPuwrKk2K\\/rlyDnZqQUTc5Aq5z.\",\"active\":1}}',NULL,'2023-10-09 05:48:34','2023-10-09 05:48:34'),
(18,'default','created','App\\Models\\User','created',10,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$5cWIeUqWisxHKPHcwHJMk.pulML9ZcZqBSvF30KI7oa1E5EfTvk\\/6\",\"active\":1}}',NULL,'2023-10-09 05:48:36','2023-10-09 05:48:36'),
(19,'default','created','App\\Models\\User','created',11,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$RaCKs\\/zLGj\\/yc8zkTq2Bk.bJ6RXdO9mnp0NqoXO1eUbYmuYG5CXSu\",\"active\":1}}',NULL,'2023-10-09 05:48:37','2023-10-09 05:48:37'),
(20,'default','created','App\\Models\\User','created',12,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$I.indtq.YdhYW2IBysgJXe8PFcvcvr1HYAgtQExoji0zjheYCgZY2\",\"active\":1}}',NULL,'2023-10-09 05:48:39','2023-10-09 05:48:39'),
(21,'default','created','App\\Models\\User','created',13,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$ishCZy1409kpOKluQ.m3WO96LCUlqcwAm4UPYnejtFJFPEMOkcV.u\",\"active\":1}}',NULL,'2023-10-09 05:48:40','2023-10-09 05:48:40'),
(22,'default','created','App\\Models\\User','created',14,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$bbB2Dd6eiOBG6ctG13EeOO4yF2EhXQJYE8DPU2bLdgYZfZwLfGjoO\",\"active\":1}}',NULL,'2023-10-09 05:49:41','2023-10-09 05:49:41'),
(23,'default','created','App\\Models\\User','created',15,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$ZDXZJs0p8xJQOCA01Fqd2OzgFwnho.3WkyY4WStC2rlrnHCyFey72\",\"active\":1}}',NULL,'2023-10-09 05:52:55','2023-10-09 05:52:55'),
(24,'default','created','App\\Models\\User','created',16,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$\\/hywGHtF4o29MHYS2ynjGeRhCU8FerpDszlTdl8R\\/E39iy775W9NS\",\"active\":1}}',NULL,'2023-10-09 05:52:57','2023-10-09 05:52:57'),
(25,'default','created','App\\Models\\User','created',17,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$tLiLi7lVUqdDpeSycOjJzeDFme1HLHYf36ekprhSQBetypg5eZmfq\",\"active\":1}}',NULL,'2023-10-09 05:53:20','2023-10-09 05:53:20'),
(26,'default','created','App\\Models\\User','created',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$g3UHWPSZTj7c2HS6UIUti.2Scc3YV\\/Vac4StFRK5jXeBRpbgGjoHC\",\"active\":1}}',NULL,'2023-10-09 05:55:42','2023-10-09 05:55:42'),
(27,'default','created','App\\Models\\User','created',3,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Abhishek\",\"email\":\"abhishek@encore.com\",\"password\":\"$2y$10$p1kX7L5iPC9\\/nrcKeTeKE.HIyIVfsQJM180wm.tYiNAddPe9LLVxm\",\"active\":1}}',NULL,'2023-10-09 05:57:21','2023-10-09 05:57:21'),
(28,'default','created','App\\Models\\User','created',4,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"chhaya\",\"email\":\"chhaya@encore.com\",\"password\":\"$2y$10$wu.4sYr7cgee82Yd.TPze.m2rsMefDKincl\\/eoy0yynNpmZrIXsbG\",\"active\":1}}',NULL,'2023-10-09 05:59:25','2023-10-09 05:59:25'),
(29,'default','created','App\\Models\\User','created',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pardip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$5vu.QK8NgLUJMzYa8eMPH.pSDTUehPinknWsoo42lxerwXnxnyT2q\",\"active\":1}}',NULL,'2023-10-09 06:05:07','2023-10-09 06:05:07'),
(30,'default','created','App\\Models\\User','created',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"bina\",\"email\":\"bina@encore.com\",\"password\":\"$2y$10$zCr8UKvdb8eL93NQMNJR.ukuG2uNLkm50ewfCZbuAAAaooalf7uOa\",\"active\":1}}',NULL,'2023-10-09 06:12:40','2023-10-09 06:12:40'),
(31,'default','created','App\\Models\\User','created',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"dattta\",\"email\":\"datta@encore.com\",\"password\":\"$2y$10$VIj26ZBlyQMC39baNwkOEu6PGOOrX8OwRaGjFufYyn2st5xpJ.TQa\",\"active\":1}}',NULL,'2023-10-09 06:14:46','2023-10-09 06:14:46'),
(32,'default','created','App\\Models\\User','created',8,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$0Hr6Aq11YeJ35kmHOHnjMuIkQiiZWSkRXsCWx5LOsyBReEDBhwxwi\",\"active\":1}}',NULL,'2023-10-09 06:16:28','2023-10-09 06:16:28'),
(33,'default','created','App\\Models\\User','created',9,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$sDOyPq648f31IXlzZf0fyOPSvdMjLXlCVc4XHf.JNpDeTJXpUxLVi\",\"active\":1}}',NULL,'2023-10-09 06:26:19','2023-10-09 06:26:19'),
(34,'default','updated','App\\Models\\User','updated',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pardip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$9mCTMyPo4ATnazuCngNZh..1vnFLBe5OoWqNuJGX8GpyAst6qbySO\",\"active\":1},\"old\":{\"name\":\"pardip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$5vu.QK8NgLUJMzYa8eMPH.pSDTUehPinknWsoo42lxerwXnxnyT2q\",\"active\":1}}',NULL,'2023-10-09 06:34:32','2023-10-09 06:34:32'),
(35,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$uldsSFWVr5qUcZsfawTRYu7M7StrYvS4e44.L21R7wskUSKzRfnJe\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$g3UHWPSZTj7c2HS6UIUti.2Scc3YV\\/Vac4StFRK5jXeBRpbgGjoHC\",\"active\":1}}',NULL,'2023-10-09 07:44:01','2023-10-09 07:44:01'),
(36,'default','updated','App\\Models\\User','updated',8,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$HN.m3U\\/OvtuOZl6Hs5y6KeGgeENWazTIcDBVKqrVYSZA18EyTMnAO\",\"active\":1},\"old\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$0Hr6Aq11YeJ35kmHOHnjMuIkQiiZWSkRXsCWx5LOsyBReEDBhwxwi\",\"active\":1}}',NULL,'2023-10-09 08:28:36','2023-10-09 08:28:36'),
(37,'default','updated','App\\Models\\User','updated',9,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$D2TzDeO4RMlGO47GezZvNuIrZJPt.AC6VSRKUu5y0jY7z.y5IiuFi\",\"active\":1},\"old\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$sDOyPq648f31IXlzZf0fyOPSvdMjLXlCVc4XHf.JNpDeTJXpUxLVi\",\"active\":1}}',NULL,'2023-10-09 08:44:24','2023-10-09 08:44:24');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Derma',1,1,'2023-10-02 11:38:43','2023-10-02 11:38:43'),
(2,'Non-Derma',1,1,'2023-10-02 11:38:58','2023-10-02 11:39:38');

/*Table structure for table `chemists` */

DROP TABLE IF EXISTS `chemists`;

CREATE TABLE `chemists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chemist` varchar(255) DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `territory_id` bigint(20) unsigned DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_no_1` varchar(255) DEFAULT NULL,
  `contact_no_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `chemists` */

insert  into `chemists`(`id`,`chemist`,`employee_id`,`class`,`address`,`territory_id`,`contact_person`,`contact_no_1`,`contact_no_2`,`email`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'AARSH MEDI.',2,NULL,'CHITTORGARH',1,'ABHIJEET SINGH','9887567898','9745127989','a@encore.com',1,1,'2023-10-05 16:56:20','2023-10-09 06:45:01'),
(2,'YASH MEDICOSE',3,NULL,'BUS STAND ROAD',2,'yash','9210308792','9414166608','ajay@encore.com',1,1,'2023-10-09 06:56:39','2023-10-09 07:05:25'),
(3,'SHRIPRABHU MEDICAL',4,NULL,'PARATWADA',2,'vipul','9975318528','9096979119','prabhu@encore.com',1,1,'2023-10-09 07:04:12','2023-10-09 07:04:12');

/*Table structure for table `doctor_business_monitorings` */

DROP TABLE IF EXISTS `doctor_business_monitorings`;

CREATE TABLE `doctor_business_monitorings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id_1` varchar(255) DEFAULT NULL,
  `employee_id_2` varchar(255) DEFAULT NULL,
  `employee_id_3` varchar(255) DEFAULT NULL,
  `roi` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `mpl_no` int(10) DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL,
  `location` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `doctor_business_monitorings` */

insert  into `doctor_business_monitorings`(`id`,`employee_id_1`,`employee_id_2`,`employee_id_3`,`roi`,`date`,`doctor_id`,`mpl_no`,`speciality`,`location`,`month`,`amount`,`code`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'2','4','6','M19','2023-10-31','1',333,'PED','hq','Oct /2023',6000.00,'3',1,1,'2023-10-11 00:53:53','2023-10-11 00:53:53'),
(2,'2','4','6','M30','2023-12-13','3',222,'PED','hq','Dec /2023',7000.00,'5',1,1,'2023-10-11 01:46:09','2023-10-11 04:44:40');

/*Table structure for table `doctors` */

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(255) DEFAULT NULL,
  `doctor_address` varchar(255) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `hospital_address` varchar(255) DEFAULT NULL,
  `contact_no_1` varchar(20) DEFAULT NULL,
  `contact_no_2` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `qualification_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `territory_id` bigint(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `dow` date DEFAULT NULL,
  `hq` varchar(20) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `type` enum('ex','hq') NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mpl_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `doctors` */

insert  into `doctors`(`id`,`doctor_name`,`doctor_address`,`hospital_name`,`hospital_address`,`contact_no_1`,`contact_no_2`,`email`,`employee_id`,`qualification_id`,`category_id`,`territory_id`,`state`,`city`,`speciality`,`designation`,`dob`,`dow`,`hq`,`class`,`type`,`created_by`,`updated_by`,`created_at`,`updated_at`,`mpl_no`) values 
(1,'Amit','MIDC','Nehete hospital','Nashik','9977865432','9745127989','amit1@nehete.com',1,1,1,1,'MH','Nashik','PED','MEHQ','2023-10-18','2023-10-16','Udaipur','dd','hq',1,1,'2023-10-05 06:54:30','2023-10-06 08:18:21','111'),
(2,'Vishal Jain','NEAR GSS SCHOOL','Jain Hospital','KANORE','9782319135','9582422022','vishal@gmail.com',4,2,2,1,'RJ','KANORE','G PRC','MEHQ','2000-01-05','2023-04-04','UDAIPUR',NULL,'hq',1,1,'2023-10-05 07:53:36','2023-10-05 07:53:36',NULL),
(3,'DR D MOHAN RAO','AMBERPET/SKIN HAIR & VD','OSMANIA HOSPITAL','AMBERPET','9210308792','9096979119','rao@gmail.com',6,2,2,2,'ANDHRAPRADESH','HYDERABAD','PED','ME','2023-10-09','2023-10-10','UDAIPUR',NULL,'hq',1,1,'2023-10-09 11:12:55','2023-10-09 11:27:17','222');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no_1` varchar(20) DEFAULT NULL,
  `contact_no_2` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `state_name` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `fieldforce_name` varchar(20) DEFAULT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reporting_office_1` int(11) DEFAULT NULL,
  `reporting_office_2` int(11) DEFAULT NULL,
  `reporting_office_3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`name`,`email`,`contact_no_1`,`contact_no_2`,`address`,`designation`,`state_name`,`city`,`fieldforce_name`,`employee_code`,`dob`,`created_by`,`updated_by`,`created_at`,`updated_at`,`reporting_office_1`,`reporting_office_2`,`reporting_office_3`) values 
(2,'Anamika','anamika@encore.com','9887567898','9987564278','MADHUBAN','Zonal Manager','RAJASTHAN','UDAIPUR','UDAIPUR HQ','ENMKT0761','1989-02-07',1,1,'2023-10-09 05:55:42','2023-10-09 07:44:01',NULL,NULL,NULL),
(3,'Abhishek','abhishek@encore.com','9887567898','9987564278','near SHARMA HOSPITAL','Zonal Manager','UTTAR PRADESH','GHAZIABAD','GHAZIABAD 1 HQ','ENMKT0815','2000-06-06',1,1,'2023-10-09 05:57:21','2023-10-09 05:57:21',NULL,NULL,NULL),
(4,'chhaya','chhaya@encore.com','9479836261','7000345593','SHANKER GHEE BHANDAR K PAS','Area Manager','MADHYA PRADESH','JABALPUR','JABALPUR 1 HQ','ENMKT0826','1990-03-13',1,1,'2023-10-09 05:59:25','2023-10-09 05:59:25',2,NULL,NULL),
(5,'pardip','pradip@encore.com','9425068761','9424567761','near RAY CLINIC','Area Manager','MAHARASHTRA','NASHIK','NASHIK 1 HQ','ENMKT0787','1999-03-15',1,1,'2023-10-09 06:05:07','2023-10-09 06:05:07',3,NULL,NULL),
(6,'bina','bina@encore.com','9414296968','9414166608','dadar','Managing Executive','MAHARASHTRA','Mumbai','DADAR HQ','ENMKT0832','1991-02-12',1,1,'2023-10-09 06:12:40','2023-10-09 06:12:40',2,4,NULL),
(7,'dattta','datta@encore.com','9975318528','7798602992','CESSTLE MIL','Managing Executive','MAHARASHTRA','Mumbai','THANE HQ','ENMKT0791','1997-06-17',1,1,'2023-10-09 06:14:46','2023-10-09 06:14:46',3,5,NULL),
(8,'avinash','avinash@encore.com','9869059380','986905897','SHOP NO 48 F1 SAROVAR TOWER THAKUR VILLEGE KANDIWALI WEST','Operator','Maharashtra','Mumbai','BORIAVLI HQ','ENMKT0824','1987-10-07',1,1,'2023-10-09 06:16:28','2023-10-09 08:28:36',3,5,7),
(9,'laxmi','laxmi@encore.com','9210308792','9223458792','KHANAWALI KHANDWA','Operator','MADHYA PRADESH','KHANDWA','KHARGAON HQ','ENMKT0850','1997-03-04',1,1,'2023-10-09 06:26:19','2023-10-09 08:44:24',2,4,6);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `grant_approval_details` */

DROP TABLE IF EXISTS `grant_approval_details`;

CREATE TABLE `grant_approval_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grant_approval_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `reason` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `grant_approval_details` */

insert  into `grant_approval_details`(`id`,`grant_approval_id`,`status`,`amount`,`reason`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,2,'Area Manager Approved',3000.00,NULL,4,4,'2023-10-10 06:44:18','2023-10-10 06:44:18'),
(2,6,'Area Manager Approved',17000.00,NULL,4,4,'2023-10-10 07:35:17','2023-10-10 07:35:17'),
(3,3,'Area Manager Rejected',6000.00,NULL,4,4,'2023-10-10 07:37:21','2023-10-10 07:37:21'),
(4,5,'Area Manager Rejected',7000.00,NULL,4,4,'2023-10-10 07:39:17','2023-10-10 07:39:17'),
(5,4,'Cancel',9000.00,NULL,6,6,'2023-10-10 07:41:32','2023-10-10 07:41:32');

/*Table structure for table `grant_approvals` */

DROP TABLE IF EXISTS `grant_approvals`;

CREATE TABLE `grant_approvals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id_1` varchar(255) DEFAULT NULL,
  `employee_id_2` varchar(255) DEFAULT NULL,
  `employee_id_3` varchar(20) DEFAULT NULL,
  `doctor_id` bigint(20) unsigned DEFAULT NULL,
  `mpl_no` int(10) DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `proposal_date` date DEFAULT NULL,
  `activity_id` bigint(20) unsigned DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `approval_amount` decimal(10,2) DEFAULT 0.00,
  `code` varchar(255) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `approved_on` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proposal_month` varchar(20) DEFAULT NULL,
  `approved_by_area` tinyint(1) DEFAULT 0,
  `approved_by_zonal` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `grant_approvals_doctor_id_foreign` (`doctor_id`),
  KEY `grant_approvals_activity_id_foreign` (`activity_id`),
  CONSTRAINT `grant_approvals_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  CONSTRAINT `grant_approvals_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grant_approvals` */

insert  into `grant_approvals`(`id`,`employee_id_1`,`employee_id_2`,`employee_id_3`,`doctor_id`,`mpl_no`,`speciality`,`location`,`date`,`proposal_date`,`activity_id`,`amount`,`approval_amount`,`code`,`email`,`contact_no`,`status`,`approved_on`,`created_by`,`updated_by`,`created_at`,`updated_at`,`proposal_month`,`approved_by_area`,`approved_by_zonal`) values 
(1,'6','4','2',3,222,'PED','hq','2023-10-31',NULL,2,10000.00,0.00,'G00001','bina@mail.com',NULL,'Open',NULL,6,6,'2023-10-10 06:29:56','2023-10-10 06:29:56','Oct /2023',0,0),
(2,'6','4','2',1,111,'PED','hq','2023-11-01',NULL,1,4000.00,3000.00,'G00002','bina@hmail.com',NULL,'Area Manager Approved',NULL,6,4,'2023-10-10 06:30:31','2023-10-10 06:44:18','Nov /2023',1,0),
(3,'6','4','2',1,333,'PED','hq','2023-10-31',NULL,1,6000.00,0.00,'G00003','b@mail.com',NULL,'Area Manager Rejected',NULL,6,4,'2023-10-10 07:20:34','2023-10-10 07:37:21','Oct /2023',0,0),
(4,'6','4','2',2,NULL,'G PRC','hq','2023-11-07',NULL,1,9000.00,0.00,'G00004','bina@gmail.com',NULL,'Cancel',NULL,6,6,'2023-10-10 07:29:19','2023-10-10 07:41:32','Nov /2023',0,0),
(5,'6','4','2',3,222,'PED','hq','2023-12-13',NULL,1,7000.00,0.00,'G00005','b@gmail.com',NULL,'Area Manager Rejected',NULL,6,4,'2023-10-10 07:30:13','2023-10-10 07:39:17','Dec /2023',0,0),
(6,'6','4','2',2,NULL,'G PRC','hq','2023-11-15',NULL,2,20000.00,17000.00,'G00006','b@hmail.com',NULL,'Area Manager Approved',NULL,6,4,'2023-10-10 07:31:03','2023-10-10 07:35:17','Nov /2023',1,0),
(7,'7','5','3',1,111,'PED','hq','2023-10-31',NULL,1,2000.00,0.00,'G00007','datta@mail.com',NULL,'Open',NULL,7,7,'2023-10-10 08:07:42','2023-10-10 08:07:42','Oct /2023',0,0),
(8,'7','5','3',3,222,'PED','hq','2023-12-27',NULL,2,45000.00,0.00,'G00008','datta@hmail1.com',NULL,'Open',NULL,7,7,'2023-10-10 08:11:00','2023-10-10 08:17:09','Dec /2023',0,0);

/*Table structure for table `media` */

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) unsigned NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `media` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_08_21_121532_create_permission_tables',2),
(6,'2023_08_25_064711_create_activity_log_table',3),
(7,'2023_08_25_064712_add_event_column_to_activity_log_table',3),
(8,'2023_08_25_064713_add_batch_uuid_column_to_activity_log_table',3),
(9,'2023_08_31_091519_create_clients_table',4),
(10,'2023_09_01_053211_create_country_table',5),
(11,'2023_09_01_055545_create_countries_table',6),
(12,'2023_09_01_061552_create_states_table',7),
(13,'2023_09_01_101318_create_cities_table',8),
(14,'2023_09_06_101409_create_client_details_table',9),
(15,'2023_09_08_072332_create_services_table',10),
(16,'2023_09_09_065450_create_employees_table',11),
(17,'2023_09_11_072647_create_media_table',12),
(18,'2023_09_18_072901_add_created_by_clients',13),
(19,'2023_09_18_073001_add_updated_by_clients',13),
(20,'2023_09_18_074040_add_created_by_employees',14),
(21,'2023_09_18_074055_add_updated_by_employees',14),
(22,'2023_09_18_074256_add_created_by_services',15),
(23,'2023_09_18_074308_add_updated_by_services',15),
(24,'2023_09_18_074448_add_created_by_enquiries',16),
(25,'2023_09_18_074549_add_updated_by_enquiries',16),
(26,'2023_09_27_074924_create_invoice_details_table',17),
(27,'2023_10_02_092947_create_products_table',18),
(28,'2023_10_02_093019_create_territories_table',18),
(29,'2023_10_02_093041_create_qualifications_table',18),
(30,'2023_10_02_093105_create_categories_table',18),
(31,'2023_10_02_120114_create_activities_table',19),
(32,'2023_10_03_050759_create_employees_table',20),
(33,'2023_10_03_053413_create_employees_details_table',20),
(34,'2023_10_03_073055_add_reporting_office_1_employees_table',21),
(35,'2023_10_03_073107_add_reporting_office_2_employees_table',21),
(36,'2023_10_03_073115_add_reporting_office_3_employees_table',21),
(37,'2023_10_05_051942_create_doctors_table',22),
(38,'2023_10_05_053819_create_stockists_table',21),
(39,'2023_10_05_052954_create_chemists_table',23),
(40,'2023_10_06_064807_create_grant_approvals_table',24),
(41,'2023_10_06_070034_add_mpl_no_doctors_table',24),
(42,'2023_10_07_070133_create_doctor_business_monitorings_table',25),
(43,'2023_10_09_121619_add_proposal_month_grant_approvals',26),
(44,'2023_10_10_051234_add_approved_by_area_grant_approvals',27),
(45,'2023_10_10_051301_add_approved_by_zonal_grant_approvals',27),
(46,'2023_10_10_102159_create_product_details_table',28),
(47,'2023_10_10_131020_alter_table_product_details',29);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',1),
(2,'App\\Models\\User',18),
(2,'App\\Models\\User',19),
(2,'App\\Models\\User',27),
(2,'App\\Models\\User',28),
(7,'App\\Models\\User',2),
(7,'App\\Models\\User',3),
(7,'App\\Models\\User',10),
(7,'App\\Models\\User',11),
(7,'App\\Models\\User',12),
(7,'App\\Models\\User',13),
(7,'App\\Models\\User',14),
(7,'App\\Models\\User',15),
(7,'App\\Models\\User',16),
(7,'App\\Models\\User',17),
(8,'App\\Models\\User',4),
(8,'App\\Models\\User',5),
(9,'App\\Models\\User',6),
(9,'App\\Models\\User',7),
(10,'App\\Models\\User',8),
(10,'App\\Models\\User',9);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

insert  into `password_reset_tokens`(`email`,`token`,`created_at`) values 
('vinod.s@sanmishatech.com','$2y$10$VLqhlUJqwABOAnLv8362KOmIEnRO4aQ2awNL239j0jwVdO3lzNFkK','2023-08-30 06:16:49'),
('vinod@gmail.com','$2y$10$Qd.xIJmwDin.fB8gRRgCcO6zcqWwELWkQ7Favw5rqPmsMgCWxfmi2','2023-08-28 07:50:22'),
('vs10201020@gamil.com','$2y$10$qUTzmrYYVlr/k/lGoeVLMOpkwWG/nNfNaUewE/PnHNEVWYAuOwqtC','2023-08-28 08:07:04');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'sanctum.csrf-cookie','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(2,'dashboard','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(3,'login','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(4,'roles.index','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(5,'roles.create','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(6,'roles.store','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(7,'roles.show','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(8,'roles.edit','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(9,'roles.update','web','2023-10-02 11:19:05','2023-10-02 11:19:05'),
(10,'roles.destroy','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(11,'permissions.index','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(12,'permissions.create','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(13,'permissions.store','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(14,'permissions.show','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(15,'permissions.edit','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(16,'permissions.update','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(17,'permissions.destroy','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(18,'users.index','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(19,'users.create','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(20,'users.store','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(21,'users.show','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(22,'users.edit','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(23,'users.update','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(24,'users.destroy','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(25,'products.index','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(26,'products.create','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(27,'products.store','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(28,'products.show','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(29,'products.edit','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(30,'products.update','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(31,'products.destroy','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(32,'register','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(33,'password.request','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(34,'password.email','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(35,'password.reset','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(36,'password.store','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(37,'verification.notice','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(38,'verification.verify','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(39,'verification.send','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(40,'password.confirm','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(41,'password.update','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(42,'logout','web','2023-10-02 11:19:06','2023-10-02 11:19:06'),
(43,'territories.index','web','2023-10-02 11:22:01','2023-10-02 11:22:01'),
(44,'territories.create','web','2023-10-02 11:22:01','2023-10-02 11:22:01'),
(45,'territories.store','web','2023-10-02 11:22:01','2023-10-02 11:22:01'),
(46,'territories.show','web','2023-10-02 11:22:01','2023-10-02 11:22:01'),
(47,'territories.edit','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(48,'territories.update','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(49,'territories.destroy','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(50,'qualifications.index','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(51,'qualifications.create','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(52,'qualifications.store','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(53,'qualifications.show','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(54,'qualifications.edit','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(55,'qualifications.update','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(56,'qualifications.destroy','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(57,'categories.index','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(58,'categories.create','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(59,'categories.store','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(60,'categories.show','web','2023-10-02 11:22:02','2023-10-02 11:22:02'),
(61,'categories.edit','web','2023-10-02 11:22:03','2023-10-02 11:22:03'),
(62,'categories.update','web','2023-10-02 11:22:03','2023-10-02 11:22:03'),
(63,'categories.destroy','web','2023-10-02 11:22:03','2023-10-02 11:22:03'),
(64,'activities.index','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(65,'activities.create','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(66,'activities.store','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(67,'activities.show','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(68,'activities.edit','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(69,'activities.update','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(70,'activities.destroy','web','2023-10-02 12:14:31','2023-10-02 12:14:31'),
(71,'employees.index','web','2023-10-03 06:20:34','2023-10-03 06:20:34'),
(72,'employees.create','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(73,'employees.store','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(74,'employees.show','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(75,'employees.edit','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(76,'employees.update','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(77,'employees.destroy','web','2023-10-03 06:20:35','2023-10-03 06:20:35'),
(78,'employees.getReportingOfficer3','web','2023-10-04 08:36:51','2023-10-04 08:36:51'),
(79,'stockists.index','web','2023-10-04 11:31:31','2023-10-04 11:31:31'),
(80,'stockists.create','web','2023-10-04 11:31:31','2023-10-04 11:31:31'),
(81,'stockists.store','web','2023-10-04 11:31:32','2023-10-04 11:31:32'),
(82,'stockists.show','web','2023-10-04 11:31:32','2023-10-04 11:31:32'),
(83,'stockists.edit','web','2023-10-04 11:31:32','2023-10-04 11:31:32'),
(84,'stockists.update','web','2023-10-04 11:31:32','2023-10-04 11:31:32'),
(85,'stockists.destroy','web','2023-10-04 11:31:32','2023-10-04 11:31:32'),
(86,'doctors.index','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(87,'doctors.create','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(88,'doctors.store','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(89,'doctors.show','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(90,'doctors.edit','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(91,'doctors.update','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(92,'doctors.destroy','web','2023-10-05 05:51:53','2023-10-05 05:51:53'),
(93,'chemists.index','web','2023-10-05 10:08:02','2023-10-05 10:08:02'),
(94,'chemists.create','web','2023-10-05 10:08:02','2023-10-05 10:08:02'),
(95,'chemists.store','web','2023-10-05 10:08:03','2023-10-05 10:08:03'),
(96,'chemists.show','web','2023-10-05 10:08:03','2023-10-05 10:08:03'),
(97,'chemists.edit','web','2023-10-05 10:08:03','2023-10-05 10:08:03'),
(98,'chemists.update','web','2023-10-05 10:08:03','2023-10-05 10:08:03'),
(99,'chemists.destroy','web','2023-10-05 10:08:03','2023-10-05 10:08:03'),
(100,'grant_approvals.index','web','2023-10-06 07:08:04','2023-10-06 07:08:04'),
(101,'grant_approvals.create','web','2023-10-06 07:08:04','2023-10-06 07:08:04'),
(102,'grant_approvals.store','web','2023-10-06 07:08:04','2023-10-06 07:08:04'),
(103,'grant_approvals.show','web','2023-10-06 07:08:04','2023-10-06 07:08:04'),
(104,'grant_approvals.edit','web','2023-10-06 07:08:04','2023-10-06 07:08:04'),
(105,'grant_approvals.update','web','2023-10-06 07:08:05','2023-10-06 07:08:05'),
(106,'grant_approvals.destroy','web','2023-10-06 07:08:05','2023-10-06 07:08:05'),
(107,'profile.change','web','2023-10-06 11:30:40','2023-10-06 11:30:40'),
(108,'employees.getEmployees','web','2023-10-06 11:30:41','2023-10-06 11:30:41'),
(109,'profile.edit','web','2023-10-06 11:30:41','2023-10-06 11:30:41'),
(110,'profile.update','web','2023-10-06 11:30:41','2023-10-06 11:30:41'),
(111,'grant_approvals.approval','web','2023-10-07 05:45:00','2023-10-07 05:45:00'),
(112,'grant_approvals.rejected','web','2023-10-07 05:45:00','2023-10-07 05:45:00'),
(113,'grant_approvals.cancel','web','2023-10-07 05:57:21','2023-10-07 05:57:21'),
(114,'doctor_business_monitorings.index','web','2023-10-10 08:21:23','2023-10-10 08:21:23'),
(115,'doctor_business_monitorings.create','web','2023-10-10 08:21:23','2023-10-10 08:21:23'),
(116,'doctor_business_monitorings.store','web','2023-10-10 08:21:23','2023-10-10 08:21:23'),
(117,'doctor_business_monitorings.show','web','2023-10-10 08:21:23','2023-10-10 08:21:23'),
(118,'doctor_business_monitorings.edit','web','2023-10-10 08:21:23','2023-10-10 08:21:23'),
(119,'doctor_business_monitorings.update','web','2023-10-10 08:21:24','2023-10-10 08:21:24'),
(120,'doctor_business_monitorings.destroy','web','2023-10-10 08:21:24','2023-10-10 08:21:24');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product_details` */

DROP TABLE IF EXISTS `product_details`;

CREATE TABLE `product_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_business_monitoring_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `nrv` decimal(10,2) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avg_business_units` int(10) unsigned DEFAULT NULL,
  `avg_business_value` decimal(10,2) DEFAULT NULL,
  `exp_vol` decimal(10,2) DEFAULT NULL,
  `exp_vol_1` decimal(10,2) DEFAULT NULL,
  `exp_vol_2` decimal(10,2) DEFAULT NULL,
  `exp_vol_3` decimal(10,2) DEFAULT NULL,
  `exp_vol_4` decimal(10,2) DEFAULT NULL,
  `exp_vol_5` decimal(10,2) DEFAULT NULL,
  `exp_vol_6` decimal(10,2) DEFAULT NULL,
  `total_exp_vol` decimal(10,2) DEFAULT NULL,
  `total_exp_val` decimal(10,2) DEFAULT NULL,
  `scheme` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_details` */

insert  into `product_details`(`id`,`doctor_business_monitoring_id`,`product_id`,`nrv`,`created_by`,`updated_by`,`created_at`,`updated_at`,`avg_business_units`,`avg_business_value`,`exp_vol`,`exp_vol_1`,`exp_vol_2`,`exp_vol_3`,`exp_vol_4`,`exp_vol_5`,`exp_vol_6`,`total_exp_vol`,`total_exp_val`,`scheme`) values 
(1,1,1,256.89,1,1,'2023-10-11 00:53:53','2023-10-11 00:53:53',100,10.00,100.00,10.00,100.00,10.00,100.00,10.00,100.00,10.00,100.00,'10'),
(2,1,4,84.21,1,1,'2023-10-11 00:53:53','2023-10-11 00:53:53',200,20.00,200.00,20.00,200.00,20.00,200.00,20.00,200.00,20.00,200.00,'20'),
(3,2,6,70.07,1,1,'2023-10-11 01:46:09','2023-10-11 04:44:40',10,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,'10'),
(31,2,1,256.89,NULL,NULL,'2023-10-11 04:44:40','2023-10-11 04:44:40',20,200.00,20.00,20.00,20.00,200.00,20.00,20.00,20.00,20.00,20.00,'10');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `nrv` decimal(10,2) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`nrv`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'ALverise Creams',256.89,1,1,'2023-10-02 11:33:11','2023-10-05 10:53:17'),
(4,'CLINRED GEL 20G (TP)',84.21,1,1,'2023-10-10 10:46:33','2023-10-10 10:46:33'),
(5,'D-WIK DROPS 15 ML (TP)',54.64,1,1,'2023-10-10 10:46:45','2023-10-10 10:46:45'),
(6,'FE-SENCY DROPS 30 ML (TP)',70.07,1,1,'2023-10-10 10:47:00','2023-10-10 10:47:00');

/*Table structure for table `qualifications` */

DROP TABLE IF EXISTS `qualifications`;

CREATE TABLE `qualifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `qualifications` */

insert  into `qualifications`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'MBBS',1,1,'2023-10-02 11:36:39','2023-10-02 11:36:39'),
(2,'MS',1,1,'2023-10-02 11:37:39','2023-10-02 11:38:06');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(25,7),
(25,8),
(25,9),
(25,10),
(26,1),
(26,7),
(26,8),
(26,9),
(26,10),
(27,1),
(27,7),
(27,8),
(27,9),
(27,10),
(28,1),
(28,7),
(28,8),
(28,9),
(28,10),
(29,1),
(29,7),
(29,8),
(29,9),
(29,10),
(30,1),
(30,7),
(30,8),
(30,9),
(30,10),
(31,1),
(31,7),
(31,8),
(31,9),
(31,10),
(32,1),
(32,7),
(32,8),
(32,9),
(33,1),
(33,7),
(33,8),
(33,9),
(34,1),
(34,7),
(34,8),
(34,9),
(35,1),
(35,7),
(35,8),
(35,9),
(36,1),
(36,7),
(36,8),
(36,9),
(37,1),
(37,7),
(37,8),
(37,9),
(38,1),
(38,7),
(38,8),
(38,9),
(39,1),
(39,7),
(39,8),
(39,9),
(40,1),
(40,7),
(40,8),
(40,9),
(41,1),
(41,7),
(41,8),
(41,9),
(42,1),
(42,7),
(42,8),
(42,9),
(43,1),
(43,7),
(43,8),
(43,9),
(43,10),
(44,1),
(44,7),
(44,8),
(44,9),
(44,10),
(45,1),
(45,7),
(45,8),
(45,9),
(45,10),
(46,1),
(46,7),
(46,8),
(46,9),
(46,10),
(47,1),
(47,7),
(47,8),
(47,9),
(47,10),
(48,1),
(48,7),
(48,8),
(48,9),
(48,10),
(49,1),
(49,7),
(49,8),
(49,9),
(49,10),
(50,1),
(50,7),
(50,8),
(50,9),
(50,10),
(51,1),
(51,7),
(51,8),
(51,9),
(51,10),
(52,1),
(52,7),
(52,8),
(52,9),
(52,10),
(53,1),
(53,7),
(53,8),
(53,9),
(53,10),
(54,1),
(54,7),
(54,8),
(54,9),
(54,10),
(55,1),
(55,7),
(55,8),
(55,9),
(55,10),
(56,1),
(56,7),
(56,8),
(56,9),
(56,10),
(57,1),
(57,7),
(57,8),
(57,9),
(57,10),
(58,1),
(58,7),
(58,8),
(58,9),
(58,10),
(59,1),
(59,7),
(59,8),
(59,9),
(59,10),
(60,1),
(60,7),
(60,8),
(60,9),
(60,10),
(61,1),
(61,7),
(61,8),
(61,9),
(61,10),
(62,1),
(62,7),
(62,8),
(62,9),
(62,10),
(63,1),
(63,7),
(63,8),
(63,9),
(63,10),
(64,1),
(64,7),
(64,8),
(64,9),
(64,10),
(65,1),
(65,7),
(65,8),
(65,9),
(65,10),
(66,1),
(66,7),
(66,8),
(66,9),
(66,10),
(67,1),
(67,7),
(67,8),
(67,9),
(67,10),
(68,1),
(68,7),
(68,8),
(68,9),
(68,10),
(69,1),
(69,7),
(69,8),
(69,9),
(69,10),
(70,1),
(70,7),
(70,8),
(70,9),
(70,10),
(71,1),
(71,7),
(71,8),
(71,9),
(71,10),
(72,1),
(72,7),
(72,8),
(72,9),
(72,10),
(73,1),
(73,7),
(73,8),
(73,9),
(73,10),
(74,1),
(74,7),
(74,8),
(74,9),
(74,10),
(75,1),
(75,7),
(75,8),
(75,9),
(75,10),
(76,1),
(76,7),
(76,8),
(76,9),
(76,10),
(77,1),
(77,7),
(77,8),
(77,9),
(77,10),
(78,1),
(78,7),
(78,8),
(78,9),
(78,10),
(79,1),
(79,7),
(79,8),
(79,9),
(79,10),
(80,1),
(80,7),
(80,8),
(80,9),
(80,10),
(81,1),
(81,7),
(81,8),
(81,9),
(81,10),
(82,1),
(82,7),
(82,8),
(82,9),
(82,10),
(83,1),
(83,7),
(83,8),
(83,9),
(83,10),
(84,1),
(84,7),
(84,8),
(84,9),
(84,10),
(85,1),
(85,7),
(85,8),
(85,9),
(85,10),
(86,1),
(86,7),
(86,8),
(86,9),
(86,10),
(87,1),
(87,7),
(87,8),
(87,9),
(87,10),
(88,1),
(88,7),
(88,8),
(88,9),
(88,10),
(89,1),
(89,7),
(89,8),
(89,9),
(89,10),
(90,1),
(90,7),
(90,8),
(90,9),
(90,10),
(91,1),
(91,7),
(91,8),
(91,9),
(91,10),
(92,1),
(92,7),
(92,8),
(92,9),
(92,10),
(93,1),
(93,7),
(93,8),
(93,9),
(93,10),
(94,1),
(94,7),
(94,8),
(94,9),
(94,10),
(95,1),
(95,7),
(95,8),
(95,9),
(95,10),
(96,1),
(96,7),
(96,8),
(96,9),
(96,10),
(97,1),
(97,7),
(97,8),
(97,9),
(97,10),
(98,1),
(98,7),
(98,8),
(98,9),
(98,10),
(99,1),
(99,7),
(99,8),
(99,9),
(99,10),
(100,1),
(100,7),
(100,8),
(100,9),
(100,10),
(101,1),
(101,7),
(101,8),
(101,9),
(101,10),
(102,1),
(102,7),
(102,8),
(102,9),
(102,10),
(103,1),
(103,7),
(103,8),
(103,9),
(103,10),
(104,1),
(104,7),
(104,8),
(104,9),
(104,10),
(105,1),
(105,7),
(105,8),
(105,9),
(105,10),
(106,1),
(106,7),
(106,8),
(106,9),
(106,10),
(107,1),
(107,7),
(107,8),
(107,9),
(108,1),
(108,7),
(108,8),
(108,9),
(108,10),
(109,1),
(109,7),
(109,8),
(109,9),
(110,1),
(110,7),
(110,8),
(110,9),
(111,1),
(111,7),
(111,8),
(111,10),
(112,1),
(112,7),
(112,8),
(112,10),
(113,1),
(113,7),
(113,9),
(113,10),
(114,1),
(115,1),
(116,1),
(117,1),
(118,1),
(119,1),
(120,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'Admin','web','2023-08-21 18:50:12','2023-08-21 18:50:14'),
(2,'User','web','2023-09-01 11:04:15','2023-08-25 11:04:18'),
(6,'Marketing','web','2023-09-12 10:27:23','2023-09-12 10:27:23'),
(7,'Zonal Manager','web','2023-10-05 16:58:12','2023-10-09 05:31:57'),
(8,'Area Manager','web','2023-10-05 16:59:34','2023-10-09 05:32:30'),
(9,'Managing Executive','web','2023-10-05 17:00:55','2023-10-09 05:32:50'),
(10,'Operator','web','2023-10-09 05:31:38','2023-10-09 05:31:38');

/*Table structure for table `stockists` */

DROP TABLE IF EXISTS `stockists`;

CREATE TABLE `stockists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id_1` int(11) DEFAULT NULL,
  `employee_id_2` int(11) DEFAULT NULL,
  `employee_id_3` int(11) DEFAULT NULL,
  `stockist` varchar(255) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stockists` */

insert  into `stockists`(`id`,`employee_id_1`,`employee_id_2`,`employee_id_3`,`stockist`,`updated_by`,`created_by`,`updated_at`,`created_at`) values 
(1,3,5,7,'ATC MEDICARE PRIVATE LIMITED',1,1,'2023-10-09 07:12:49','2023-10-04 11:47:06'),
(2,2,4,6,'GAYATRI ENTERPRISES',1,1,'2023-10-09 07:10:34','2023-10-09 07:10:34');

/*Table structure for table `territories` */

DROP TABLE IF EXISTS `territories`;

CREATE TABLE `territories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `territories` */

insert  into `territories`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Udaipur',1,1,'2023-10-02 11:35:25','2023-10-02 11:35:25'),
(2,'Shirhoi',1,1,'2023-10-02 11:35:40','2023-10-02 11:36:15');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`active`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Admin','admin@encore.com',NULL,'$2y$10$2zoI5I6WXWLI2haGg/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe',NULL,1,NULL,NULL,'2023-07-12 08:28:19','2023-10-02 11:50:43'),
(2,'Anamika','anamika@encore.com',NULL,'$2y$10$uldsSFWVr5qUcZsfawTRYu7M7StrYvS4e44.L21R7wskUSKzRfnJe',NULL,1,NULL,NULL,'2023-10-09 05:55:42','2023-10-09 07:44:01'),
(3,'Abhishek','abhishek@encore.com',NULL,'$2y$10$p1kX7L5iPC9/nrcKeTeKE.HIyIVfsQJM180wm.tYiNAddPe9LLVxm',NULL,1,NULL,NULL,'2023-10-09 05:57:21','2023-10-09 05:57:21'),
(4,'chhaya','chhaya@encore.com',NULL,'$2y$10$wu.4sYr7cgee82Yd.TPze.m2rsMefDKincl/eoy0yynNpmZrIXsbG',NULL,1,NULL,NULL,'2023-10-09 05:59:25','2023-10-09 05:59:25'),
(5,'pardip','pradip@encore.com',NULL,'$2y$10$9mCTMyPo4ATnazuCngNZh..1vnFLBe5OoWqNuJGX8GpyAst6qbySO',NULL,1,NULL,NULL,'2023-10-09 06:05:07','2023-10-09 06:34:32'),
(6,'bina','bina@encore.com',NULL,'$2y$10$zCr8UKvdb8eL93NQMNJR.ukuG2uNLkm50ewfCZbuAAAaooalf7uOa',NULL,1,NULL,NULL,'2023-10-09 06:12:40','2023-10-09 06:12:40'),
(7,'dattta','datta@encore.com',NULL,'$2y$10$VIj26ZBlyQMC39baNwkOEu6PGOOrX8OwRaGjFufYyn2st5xpJ.TQa',NULL,1,NULL,NULL,'2023-10-09 06:14:46','2023-10-09 06:14:46'),
(8,'avinash','avinash@encore.com',NULL,'$2y$10$HN.m3U/OvtuOZl6Hs5y6KeGgeENWazTIcDBVKqrVYSZA18EyTMnAO',NULL,1,NULL,NULL,'2023-10-09 06:16:28','2023-10-09 08:28:36'),
(9,'laxmi','laxmi@encore.com',NULL,'$2y$10$D2TzDeO4RMlGO47GezZvNuIrZJPt.AC6VSRKUu5y0jY7z.y5IiuFi',NULL,1,NULL,NULL,'2023-10-09 06:26:19','2023-10-09 08:44:24');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

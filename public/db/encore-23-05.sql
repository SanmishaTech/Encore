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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activities` */

insert  into `activities`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Medical Camp',1,1,'2023-10-02 12:19:32','2023-10-02 12:19:32'),
(2,'Social activities',1,1,'2023-10-02 12:19:47','2023-10-02 12:20:28'),
(3,'Conference',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20'),
(4,'Committee',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20'),
(5,'Healthcare event',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20'),
(6,'Medical event',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20'),
(7,'IDA camp',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20'),
(8,'IMA camp',1,1,'2023-10-13 10:33:20','2023-10-13 10:33:20');

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(37,'default','updated','App\\Models\\User','updated',9,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$D2TzDeO4RMlGO47GezZvNuIrZJPt.AC6VSRKUu5y0jY7z.y5IiuFi\",\"active\":1},\"old\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$sDOyPq648f31IXlzZf0fyOPSvdMjLXlCVc4XHf.JNpDeTJXpUxLVi\",\"active\":1}}',NULL,'2023-10-09 08:44:24','2023-10-09 08:44:24'),
(38,'default','created','App\\Models\\User','created',10,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"BHASKAR GUPTA\",\"email\":\"bhaskar@encore.com\",\"password\":\"$2y$10$kEO\\/qyuv87VFPnOzXhrIF.xd1pVhmNm.VVpWGzLDlhFKrkvqWsncG\",\"active\":1}}',NULL,'2023-10-11 11:07:25','2023-10-11 11:07:25'),
(39,'default','created','App\\Models\\User','created',11,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"B.L VERMA\",\"email\":\"verma@encore.com\",\"password\":\"$2y$10$x9kw2fVSwrOys52D9kLlZ.m80hOLj.T24LiMMqhT1jrWlMXdG6EOy\",\"active\":1}}',NULL,'2023-10-12 06:28:18','2023-10-12 06:28:18'),
(40,'default','updated','App\\Models\\User','updated',11,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"B.L VERMA\",\"email\":\"verma@encore.com\",\"password\":\"$2y$10$Bc27E.n9mwdOrohsWAcGxOljTBjoIG0O4a5Fm1Pq.OyOSEJNzuNzW\",\"active\":1},\"old\":{\"name\":\"B.L VERMA\",\"email\":\"verma@encore.com\",\"password\":\"$2y$10$x9kw2fVSwrOys52D9kLlZ.m80hOLj.T24LiMMqhT1jrWlMXdG6EOy\",\"active\":1}}',NULL,'2023-10-12 06:38:11','2023-10-12 06:38:11'),
(41,'default','updated','App\\Models\\User','updated',8,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$0W98fK8VDicP18OPr\\/wiOemoTi1d4LpD8qEWHEk1ENakLTdeJzFWq\",\"active\":1},\"old\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$HN.m3U\\/OvtuOZl6Hs5y6KeGgeENWazTIcDBVKqrVYSZA18EyTMnAO\",\"active\":1}}',NULL,'2023-10-12 07:56:46','2023-10-12 07:56:46'),
(42,'default','created','App\\Models\\User','created',12,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"H.C.SONI\",\"email\":\"soni@encore.com\",\"password\":\"$2y$10$4\\/rf0dpZcrPlltoR0q8OLeEQF5\\/gH3EUBuvF7K508jNvj.DKcUOla\",\"active\":1}}',NULL,'2023-10-12 07:59:03','2023-10-12 07:59:03'),
(43,'default','created','App\\Models\\User','created',15,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Nisha N Mehta\",\"email\":\"nisha@encore.com\",\"password\":\"$2y$10$l5JJ5SimFXwh3z2fExGdcOgXj8.83MMMpHfVp6u2hU.rYS550VDzK\",\"active\":1}}',NULL,'2023-10-13 11:53:21','2023-10-13 11:53:21'),
(44,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$XRb9AlaVAMI.NtMNc7MG9.jlMLfWJCfOwgSzhnK1afV\\/gJWO12szK\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$uldsSFWVr5qUcZsfawTRYu7M7StrYvS4e44.L21R7wskUSKzRfnJe\",\"active\":1}}',NULL,'2023-10-13 11:59:16','2023-10-13 11:59:16'),
(45,'default','updated','App\\Models\\User','updated',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$\\/DtDdXOhglEvZxjJeTe.VuZG\\/kUiAvIV3crLdTRLWYzWvrgOTzSZa\",\"active\":1},\"old\":{\"name\":\"pardip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$9mCTMyPo4ATnazuCngNZh..1vnFLBe5OoWqNuJGX8GpyAst6qbySO\",\"active\":1}}',NULL,'2023-10-16 07:36:06','2023-10-16 07:36:06'),
(46,'default','created','App\\Models\\User','created',16,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"YAMINI ROY\",\"email\":null,\"password\":\"$2y$10$iIMvfTTGwvZfpq58Ur08BO6NeIWue\\/RgtbrQoEASA5wLyY2VkkoWm\",\"active\":1}}',NULL,'2023-10-16 08:24:25','2023-10-16 08:24:25'),
(47,'default','deleted','App\\Models\\User','deleted',16,'App\\Models\\User',1,'{\"old\":{\"name\":\"YAMINI ROY\",\"email\":null,\"password\":\"$2y$10$iIMvfTTGwvZfpq58Ur08BO6NeIWue\\/RgtbrQoEASA5wLyY2VkkoWm\",\"active\":1}}',NULL,'2023-10-16 08:26:44','2023-10-16 08:26:44'),
(48,'default','created','App\\Models\\User','created',17,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"YAMINI ROY\",\"email\":\"yamini@encore.com\",\"password\":\"$2y$10$FbNferwn\\/NJE\\/O\\/YpLuM5OyjvVPED81a3VYyWWChpMhc\\/bOYtV..2\",\"active\":1}}',NULL,'2023-10-16 08:28:00','2023-10-16 08:28:00'),
(49,'default','deleted','App\\Models\\User','deleted',17,'App\\Models\\User',1,'{\"old\":{\"name\":\"YAMINI ROY\",\"email\":\"yamini@encore.com\",\"password\":\"$2y$10$FbNferwn\\/NJE\\/O\\/YpLuM5OyjvVPED81a3VYyWWChpMhc\\/bOYtV..2\",\"active\":1}}',NULL,'2023-10-16 08:33:00','2023-10-16 08:33:00'),
(50,'default','created','App\\Models\\User','created',18,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"YAMINI ROY\",\"email\":\"yamini@encore.com\",\"password\":\"$2y$10$GXqN2xoxHHhYDMqDJZjgjelJYmpVTW8Fly\\/5P1bLB2K.xbHjDoM0a\",\"active\":1}}',NULL,'2023-10-16 08:41:09','2023-10-16 08:41:09'),
(51,'default','created','App\\Models\\User','created',19,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"VINITA KOLHE\",\"email\":\"vinita@encore.com\",\"password\":\"$2y$10$kJKSJXW43M.FURIF121zfOF.5St75w7AQg6y8FqSfHSW32YmTREg2\",\"active\":1}}',NULL,'2023-10-16 08:50:49','2023-10-16 08:50:49'),
(52,'default','deleted','App\\Models\\User','deleted',19,'App\\Models\\User',1,'{\"old\":{\"name\":\"VINITA KOLHE\",\"email\":\"vinita@encore.com\",\"password\":\"$2y$10$kJKSJXW43M.FURIF121zfOF.5St75w7AQg6y8FqSfHSW32YmTREg2\",\"active\":1}}',NULL,'2023-10-16 08:51:23','2023-10-16 08:51:23'),
(53,'default','created','App\\Models\\User','created',20,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"VINITA KOLHE\",\"email\":\"vinita@encore.com\",\"password\":\"$2y$10$\\/UVQ3WkC9AWxBAF3ghM2euqTnAkt4wp7ulHKX9rNe4eSSQOY8MphW\",\"active\":1}}',NULL,'2023-10-16 08:52:16','2023-10-16 08:52:16'),
(54,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"employee1\",\"email\":\"employee1@encore.com\",\"password\":\"$2y$10$qFyFf852Qf2vtnb\\/7fT3FeiWYwTVSZKAakXa4NZ3e8fH2XH7dE.Ne\",\"active\":1},\"old\":{\"name\":\"bina\",\"email\":\"bina@encore.com\",\"password\":\"$2y$10$zCr8UKvdb8eL93NQMNJR.ukuG2uNLkm50ewfCZbuAAAaooalf7uOa\",\"active\":1}}',NULL,'2023-10-18 08:21:30','2023-10-18 08:21:30'),
(55,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"manager1\",\"email\":\"manager1@encore.com\",\"password\":\"$2y$10$px4oxct4BN6zmyJwNI\\/KxeqC3uuO5z4rMJgwBHMlERZ1N8Fh.oWkO\",\"active\":1},\"old\":{\"name\":\"employee1\",\"email\":\"employee1@encore.com\",\"password\":\"$2y$10$qFyFf852Qf2vtnb\\/7fT3FeiWYwTVSZKAakXa4NZ3e8fH2XH7dE.Ne\",\"active\":1}}',NULL,'2023-10-18 08:21:52','2023-10-18 08:21:52'),
(56,'default','updated','App\\Models\\User','updated',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"manager2\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$gmkQkw.smBNhtYkYr9baL.d3YRQc85GvEKttDTIbcjsvB6yOxg4nO\",\"active\":1},\"old\":{\"name\":\"dattta\",\"email\":\"datta@encore.com\",\"password\":\"$2y$10$VIj26ZBlyQMC39baNwkOEu6PGOOrX8OwRaGjFufYyn2st5xpJ.TQa\",\"active\":1}}',NULL,'2023-10-18 08:31:26','2023-10-18 08:31:26'),
(57,'default','updated','App\\Models\\User','updated',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"manager2\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$L0IifpZpxuSBTtwvH\\/EV.O00RP8R5TXHJhkcKRzWhj9mCVF9D04By\",\"active\":1},\"old\":{\"name\":\"manager2\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$gmkQkw.smBNhtYkYr9baL.d3YRQc85GvEKttDTIbcjsvB6yOxg4nO\",\"active\":1}}',NULL,'2023-10-18 08:31:36','2023-10-18 08:31:36'),
(58,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"manager1\",\"email\":\"manager1@encore.com\",\"password\":\"$2y$10$uh4GWvntNOQ9oTsUA\\/JM9OOXB3p8Kc1non2XF\\/CaC7vBXyS5.gTnO\",\"active\":1},\"old\":{\"name\":\"manager1\",\"email\":\"manager1@encore.com\",\"password\":\"$2y$10$px4oxct4BN6zmyJwNI\\/KxeqC3uuO5z4rMJgwBHMlERZ1N8Fh.oWkO\",\"active\":1}}',NULL,'2023-10-18 08:32:13','2023-10-18 08:32:13'),
(59,'default','updated','App\\Models\\User','updated',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$Ie6fqkvbo6p0L\\/D6Gevyh.bOfsQ6Lc4tBxpgZvb5DWB8nYe8nwpnO\",\"active\":1},\"old\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$\\/DtDdXOhglEvZxjJeTe.VuZG\\/kUiAvIV3crLdTRLWYzWvrgOTzSZa\",\"active\":1}}',NULL,'2023-10-18 08:34:29','2023-10-18 08:34:29'),
(60,'default','updated','App\\Models\\User','updated',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Avinash\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$53deLE9Yy2VlAp5JW4SWP.Vrr7UFsiuTwD5fYPTFuvC1\\/DSqDRizi\",\"active\":1},\"old\":{\"name\":\"manager2\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$L0IifpZpxuSBTtwvH\\/EV.O00RP8R5TXHJhkcKRzWhj9mCVF9D04By\",\"active\":1}}',NULL,'2023-10-18 08:34:53','2023-10-18 08:34:53'),
(61,'default','updated','App\\Models\\User','updated',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$lyx2YoM206IWGLknUsAHoemC6xK1kxvLDjyHjl3IuveOQM4BlELF.\",\"active\":1},\"old\":{\"name\":\"Avinash\",\"email\":\"manager2@encore.com\",\"password\":\"$2y$10$53deLE9Yy2VlAp5JW4SWP.Vrr7UFsiuTwD5fYPTFuvC1\\/DSqDRizi\",\"active\":1}}',NULL,'2023-10-18 08:35:30','2023-10-18 08:35:30'),
(62,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$Rpez3qhaA0SdpldsM2jujOvTk7Jm8Zb0uTmNnP3B3sibdtCkyFRYC\",\"active\":1},\"old\":{\"name\":\"manager1\",\"email\":\"manager1@encore.com\",\"password\":\"$2y$10$uh4GWvntNOQ9oTsUA\\/JM9OOXB3p8Kc1non2XF\\/CaC7vBXyS5.gTnO\",\"active\":1}}',NULL,'2023-10-18 08:37:02','2023-10-18 08:37:02'),
(63,'default','updated','App\\Models\\User','updated',7,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$NSs6F52IN9wntxgqldyYbum.PNBWDyT1aJvJ7JJ5T0oGePQPBQ0CK\",\"active\":1},\"old\":{\"name\":\"Avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$lyx2YoM206IWGLknUsAHoemC6xK1kxvLDjyHjl3IuveOQM4BlELF.\",\"active\":1}}',NULL,'2023-10-18 08:37:26','2023-10-18 08:37:26'),
(64,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$0vZPDJZBisSguEudtu\\/CaeudM6sfU7HaWKsAYQwpZffZDqYZypE66\",\"active\":1},\"old\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$Rpez3qhaA0SdpldsM2jujOvTk7Jm8Zb0uTmNnP3B3sibdtCkyFRYC\",\"active\":1}}',NULL,'2023-10-18 08:37:36','2023-10-18 08:37:36'),
(65,'default','updated','App\\Models\\User','updated',4,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"chhaya\",\"email\":\"chhaya@encore.com\",\"password\":\"$2y$10$bn6zbQstOZllPPq8CiaVDeOiz9g2B9elkDhRT6iduRUczIWb7JFcC\",\"active\":1},\"old\":{\"name\":\"chhaya\",\"email\":\"chhaya@encore.com\",\"password\":\"$2y$10$wu.4sYr7cgee82Yd.TPze.m2rsMefDKincl\\/eoy0yynNpmZrIXsbG\",\"active\":1}}',NULL,'2023-10-18 08:38:17','2023-10-18 08:38:17'),
(66,'default','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Admins\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1},\"old\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1}}',NULL,'2023-10-18 08:40:35','2023-10-18 08:40:35'),
(67,'default','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1},\"old\":{\"name\":\"Admins\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1}}',NULL,'2023-10-18 08:40:42','2023-10-18 08:40:42'),
(68,'default','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$iB6lmJ2rSCQHELZP4r\\/Am.6pWIeDLjxSAVis9Ikrrw0jl7b0PYepO\",\"active\":1},\"old\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1}}',NULL,'2023-10-18 08:43:01','2023-10-18 08:43:01'),
(69,'default','deleted','App\\Models\\User','deleted',20,'App\\Models\\User',1,'{\"old\":{\"name\":\"VINITA KOLHE\",\"email\":\"vinita@encore.com\",\"password\":\"$2y$10$\\/UVQ3WkC9AWxBAF3ghM2euqTnAkt4wp7ulHKX9rNe4eSSQOY8MphW\",\"active\":1}}',NULL,'2023-10-18 09:17:28','2023-10-18 09:17:28'),
(70,'default','deleted','App\\Models\\User','deleted',18,'App\\Models\\User',1,'{\"old\":{\"name\":\"YAMINI ROY\",\"email\":\"yamini@encore.com\",\"password\":\"$2y$10$GXqN2xoxHHhYDMqDJZjgjelJYmpVTW8Fly\\/5P1bLB2K.xbHjDoM0a\",\"active\":1}}',NULL,'2023-10-18 09:17:42','2023-10-18 09:17:42'),
(71,'default','deleted','App\\Models\\User','deleted',15,'App\\Models\\User',1,'{\"old\":{\"name\":\"Nisha N Mehta\",\"email\":\"nisha@encore.com\",\"password\":\"$2y$10$l5JJ5SimFXwh3z2fExGdcOgXj8.83MMMpHfVp6u2hU.rYS550VDzK\",\"active\":1}}',NULL,'2023-10-18 09:17:45','2023-10-18 09:17:45'),
(72,'default','deleted','App\\Models\\User','deleted',12,'App\\Models\\User',1,'{\"old\":{\"name\":\"H.C.SONI\",\"email\":\"soni@encore.com\",\"password\":\"$2y$10$4\\/rf0dpZcrPlltoR0q8OLeEQF5\\/gH3EUBuvF7K508jNvj.DKcUOla\",\"active\":1}}',NULL,'2023-10-18 09:17:49','2023-10-18 09:17:49'),
(73,'default','deleted','App\\Models\\User','deleted',11,'App\\Models\\User',1,'{\"old\":{\"name\":\"B.L VERMA\",\"email\":\"verma@encore.com\",\"password\":\"$2y$10$Bc27E.n9mwdOrohsWAcGxOljTBjoIG0O4a5Fm1Pq.OyOSEJNzuNzW\",\"active\":1}}',NULL,'2023-10-18 09:17:52','2023-10-18 09:17:52'),
(74,'default','deleted','App\\Models\\User','deleted',10,'App\\Models\\User',1,'{\"old\":{\"name\":\"BHASKAR GUPTA\",\"email\":\"bhaskar@encore.com\",\"password\":\"$2y$10$kEO\\/qyuv87VFPnOzXhrIF.xd1pVhmNm.VVpWGzLDlhFKrkvqWsncG\",\"active\":1}}',NULL,'2023-10-18 09:17:55','2023-10-18 09:17:55'),
(75,'default','deleted','App\\Models\\User','deleted',9,'App\\Models\\User',1,'{\"old\":{\"name\":\"laxmi\",\"email\":\"laxmi@encore.com\",\"password\":\"$2y$10$D2TzDeO4RMlGO47GezZvNuIrZJPt.AC6VSRKUu5y0jY7z.y5IiuFi\",\"active\":1}}',NULL,'2023-10-18 09:18:05','2023-10-18 09:18:05'),
(76,'default','deleted','App\\Models\\User','deleted',8,'App\\Models\\User',1,'{\"old\":{\"name\":\"avinash\",\"email\":\"avinash@encore.com\",\"password\":\"$2y$10$0W98fK8VDicP18OPr\\/wiOemoTi1d4LpD8qEWHEk1ENakLTdeJzFWq\",\"active\":1}}',NULL,'2023-10-18 09:18:09','2023-10-18 09:18:09'),
(77,'default','updated','App\\Models\\User','updated',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$JKeGMp9IgUc24FumHyCT4uDNktVY8LiTtjNExyGLh3fNT\\/nMy3YFC\",\"active\":1},\"old\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$Ie6fqkvbo6p0L\\/D6Gevyh.bOfsQ6Lc4tBxpgZvb5DWB8nYe8nwpnO\",\"active\":1}}',NULL,'2023-10-27 04:49:08','2023-10-27 04:49:08'),
(78,'default','updated','App\\Models\\User','updated',5,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$xGhUmUxEmt8nqhTkoucOZefA\\/TaluLe8eJn93b5GHlHhTRq3SKI9S\",\"active\":1},\"old\":{\"name\":\"pradip\",\"email\":\"pradip@encore.com\",\"password\":\"$2y$10$JKeGMp9IgUc24FumHyCT4uDNktVY8LiTtjNExyGLh3fNT\\/nMy3YFC\",\"active\":1}}',NULL,'2023-10-27 04:49:21','2023-10-27 04:49:21'),
(79,'default','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$2sZ3uSLOB340D9yGFu.FPecF7bQ1x\\/LCdUlLGCQFr\\/iDkaqOqylNC\",\"active\":1},\"old\":{\"name\":\"Anamika\",\"email\":\"anamika@encore.com\",\"password\":\"$2y$10$XRb9AlaVAMI.NtMNc7MG9.jlMLfWJCfOwgSzhnK1afV\\/gJWO12szK\",\"active\":1}}',NULL,'2023-12-08 04:35:30','2023-12-08 04:35:30'),
(80,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$KJ\\/68s2oRvARwYdPvSCk5.haQsgXBri3R8hVEDz2osUvfXZ.FlyZ6\",\"active\":1},\"old\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$0vZPDJZBisSguEudtu\\/CaeudM6sfU7HaWKsAYQwpZffZDqYZypE66\",\"active\":1}}',NULL,'2023-12-08 05:31:37','2023-12-08 05:31:37'),
(81,'default','updated','App\\Models\\User','updated',6,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$lTRRQqtIQbpBrxsuUsd50OQgVGyLMndOnM8sek.\\/pfP7uBbRqQCPi\",\"active\":1},\"old\":{\"name\":\"Vilas\",\"email\":\"vilas@encore.com\",\"password\":\"$2y$10$KJ\\/68s2oRvARwYdPvSCk5.haQsgXBri3R8hVEDz2osUvfXZ.FlyZ6\",\"active\":1}}',NULL,'2023-12-08 05:32:51','2023-12-08 05:32:51'),
(82,'default','created','App\\Models\\User','created',9,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Jitendra Shah\",\"email\":\"jitendra@encore.com\",\"password\":\"$2y$10$f73X\\/sAyrIgvi70ZI4YLF.p8d48zkCG3h5tHA1q.epbDXpWCU.5ni\",\"active\":1}}',NULL,'2023-12-08 08:26:57','2023-12-08 08:26:57'),
(83,'default','created','App\\Models\\User','created',10,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Yugal Shah\",\"email\":\"yugal@encore.com\",\"password\":\"$2y$10$Q8QfMiAdOKUZk4wxp3ohcOqLAsGfFQmjC0C\\/i\\/DRXICHmFS0Drqfm\",\"active\":1}}',NULL,'2023-12-08 08:28:08','2023-12-08 08:28:08'),
(84,'default','created','App\\Models\\User','created',11,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Vedansh Shah\",\"email\":\"vedansh@encore.com\",\"password\":\"$2y$10$v7g00BkvCZCV7DAmBtIcxebF\\/jR.cvoRwAcHSHQCY8obEjqa\\/LA3i\",\"active\":1}}',NULL,'2023-12-08 08:28:50','2023-12-08 08:28:50'),
(85,'default','updated','App\\Models\\User','updated',11,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Vedansh Shah\",\"email\":\"vedansh@encore.com\",\"password\":\"$2y$10$CXXTk85Ay4RBIgtra4hefu\\/It2v3xBp.AG2vo1X77ScnykHC8xKJG\",\"active\":1},\"old\":{\"name\":\"Vedansh Shah\",\"email\":\"vedansh@encore.com\",\"password\":\"$2y$10$v7g00BkvCZCV7DAmBtIcxebF\\/jR.cvoRwAcHSHQCY8obEjqa\\/LA3i\",\"active\":1}}',NULL,'2023-12-08 08:29:13','2023-12-08 08:29:13'),
(86,'default','updated','App\\Models\\User','updated',10,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Yugal Shah\",\"email\":\"yugal@encore.com\",\"password\":\"$2y$10$6WUuxb7Xn6PjPOdcYe1UlO87leqxM8wVEuotkh.S96wLDsCTzXWBC\",\"active\":1},\"old\":{\"name\":\"Yugal Shah\",\"email\":\"yugal@encore.com\",\"password\":\"$2y$10$Q8QfMiAdOKUZk4wxp3ohcOqLAsGfFQmjC0C\\/i\\/DRXICHmFS0Drqfm\",\"active\":1}}',NULL,'2023-12-08 08:29:23','2023-12-08 08:29:23'),
(87,'default','updated','App\\Models\\User','updated',9,'App\\Models\\User',8,'{\"attributes\":{\"name\":\"Jitendra Shah\",\"email\":\"jitendra@encore.com\",\"password\":\"$2y$10$JDo.TTcSv9Q81YR57vWTL.heoHTtykG4Ek5cpoapd78Ez.77l1feC\",\"active\":1},\"old\":{\"name\":\"Jitendra Shah\",\"email\":\"jitendra@encore.com\",\"password\":\"$2y$10$f73X\\/sAyrIgvi70ZI4YLF.p8d48zkCG3h5tHA1q.epbDXpWCU.5ni\",\"active\":1}}',NULL,'2023-12-08 08:29:34','2023-12-08 08:29:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Derma',1,1,'2023-10-02 11:38:43','2023-10-02 11:38:43'),
(2,'Non-Derma',1,1,'2023-10-02 11:38:58','2023-10-02 11:39:38'),
(4,'SCPAED',1,1,'2023-10-11 10:55:34','2023-10-11 10:55:34'),
(5,'practitioner',1,1,'2023-10-13 10:15:32','2023-10-13 10:15:32'),
(7,'Homeopathy',1,1,'2023-10-13 10:15:32','2023-10-17 05:53:38'),
(8,'ayurved',1,1,'2023-10-13 10:15:32','2023-10-13 10:15:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `chemists` */

insert  into `chemists`(`id`,`chemist`,`employee_id`,`class`,`address`,`territory_id`,`contact_person`,`contact_no_1`,`contact_no_2`,`email`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'AARSH MEDI.',2,NULL,'CHITTORGARH',1,'ABHIJEET SINGH','9887567898','9745127989','a@encore.com',1,1,'2023-10-05 16:56:20','2023-10-09 06:45:01'),
(2,'YASH MEDICOSE',3,NULL,'BUS STAND ROAD',2,'yash','9210308792','9414166608','ajay@encore.com',1,1,'2023-10-09 06:56:39','2023-10-09 07:05:25'),
(3,'SHRIPRABHU MEDICAL',4,NULL,'PARATWADA',2,'vipul','9975318528','9096979119','prabhu@encore.com',1,1,'2023-10-09 07:04:12','2023-10-09 07:04:12'),
(4,'ANJU MEDICAL',NULL,NULL,'GANAPATI NAGAR UDAIPUR',NULL,'ABHIJEET SINGH','9414688279','7568707099','anju@gmail.com',1,1,'2023-10-12 12:25:27','2023-10-12 12:25:27'),
(5,'Mahavir MEDICAL',2,NULL,'UDAIPUR',1,'ABHIJEET Patil','3456788279','7568745637','mahavir1@gmail.com',1,1,'2023-10-13 11:17:47','2023-10-13 11:25:39'),
(6,'MAURYA MEDICAL',2,NULL,'VARANASI',4,'Nitin','9000088279','9975045637','maurya@gmail.com',1,1,'2023-10-16 07:09:48','2023-10-16 07:09:48'),
(7,'SHIVANS SKIN CLINIC',NULL,NULL,'AZAMGARH',3,'SIDDHI','9975088924','9810566293','shivans@gmail.com',1,1,'2023-10-16 07:30:52','2023-10-16 07:30:52'),
(8,'AKOLA MED',2,NULL,'CIVIL LINE ',2,'ASHWIN RAJENDRA INGLE','9955667789','9233679876','akola@gmail.com',1,1,'2023-10-16 07:33:52','2023-10-16 07:33:52'),
(9,'ASHRAY MEDICAL',12,NULL,'OLD CITY AKOLA-444001',2,'ANSHUL SINGH','9098767789','9233676897','ashray@gmail.com',1,1,'2023-10-16 07:39:39','2023-10-16 07:39:39');

/*Table structure for table `doctor_business_monitoring_details` */

DROP TABLE IF EXISTS `doctor_business_monitoring_details`;

CREATE TABLE `doctor_business_monitoring_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_business_monitoring_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `doctor_business_monitoring_details` */

insert  into `doctor_business_monitoring_details`(`id`,`doctor_business_monitoring_id`,`status`,`amount`,`reason`,`created_at`,`updated_at`) values 
(1,11,'Level 1 Approved',9000.00,NULL,'2023-11-06 11:26:05','2023-11-06 11:26:05'),
(2,11,'Level 2 Approved',8200.00,NULL,'2023-11-06 11:28:17','2023-11-06 11:28:17'),
(3,10,'Level 1 Approved',6500.00,NULL,'2023-11-06 11:29:14','2023-11-06 11:29:14'),
(4,10,'Level 2 Rejected',7000.00,NULL,'2023-11-06 11:31:30','2023-11-06 11:31:30');

/*Table structure for table `doctor_business_monitorings` */

DROP TABLE IF EXISTS `doctor_business_monitorings`;

CREATE TABLE `doctor_business_monitorings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grant_approval_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `roi` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_expected_value` decimal(10,2) DEFAULT NULL,
  `total_business_value` decimal(10,2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `approval_level_1` int(10) unsigned DEFAULT NULL,
  `approval_level_2` int(10) unsigned DEFAULT NULL,
  `approved_on` date DEFAULT NULL,
  `approval_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `doctor_business_monitorings` */

insert  into `doctor_business_monitorings`(`id`,`grant_approval_id`,`doctor_id`,`roi`,`date`,`month`,`amount`,`created_by`,`updated_by`,`created_at`,`updated_at`,`total_expected_value`,`total_business_value`,`status`,`approval_level_1`,`approval_level_2`,`approved_on`,`approval_amount`) values 
(1,12,NULL,111.00,'2023-11-01','Nov /2023',20000.00,1,1,'2023-10-16 05:49:18','2023-10-16 05:49:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(2,8,NULL,101.00,'2023-12-27','Dec /2023',45000.00,1,1,'2023-10-17 07:11:02','2023-10-17 07:11:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,5,NULL,0.00,'2023-12-13','Dec /2023',7000.00,1,1,'2023-11-03 09:53:35','2023-11-03 11:24:14',43562.85,8256.30,NULL,NULL,NULL,NULL,NULL),
(4,3,NULL,10.54,'2023-10-31','Oct /2023',6000.00,1,1,'2023-11-03 11:08:23','2023-11-03 11:08:23',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(5,4,NULL,3.45,'2023-11-07','Nov /2023',9000.00,1,4,'2023-11-04 07:56:20','2023-11-04 08:20:55',31083.69,2825.79,'Level 1 Approved',1,NULL,NULL,7000.00),
(6,2,NULL,5.78,'2023-11-01','Nov /2023',4000.00,1,4,'2023-11-04 08:31:25','2023-11-04 08:36:02',23120.10,1284.45,'Level 1 Rejected',0,NULL,NULL,NULL),
(7,5,NULL,3.63,'2023-12-13','Dec /2023',7000.00,1,1,'2023-11-04 10:43:02','2023-11-04 10:43:02',25412.77,2019.11,'Open',NULL,NULL,NULL,NULL),
(8,2,NULL,0.00,'2023-11-01','Nov /2023',4000.00,1,1,'2023-11-04 12:12:25','2023-11-04 12:12:25',0.00,0.00,'Open',NULL,NULL,NULL,NULL),
(9,1,NULL,10.72,'2023-10-31','Oct /2023',10000.00,1,1,'2023-11-04 12:28:44','2023-11-06 09:01:34',107194.50,1244.88,'Open',NULL,NULL,NULL,NULL),
(10,5,NULL,3.05,'2023-12-13','Dec /2023',7000.00,7,2,'2023-11-06 11:20:57','2023-11-06 11:31:30',21357.00,152.55,'Level 2 Rejected',1,0,NULL,6500.00),
(11,1,NULL,0.72,'2023-10-31','Oct /2023',10000.00,6,2,'2023-11-06 11:24:35','2023-11-06 11:28:17',7192.92,513.78,'Level 2 Approved',1,1,NULL,8200.00),
(12,4,NULL,0.00,'2023-11-07','Nov /2023',9000.00,1,1,'2023-11-06 13:33:26','2023-11-06 13:33:26',0.00,0.00,'Open',NULL,NULL,NULL,NULL);

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
  `mpl_no` varchar(255) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `dow` date DEFAULT NULL,
  `hq` varchar(20) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `type` enum('ex','hq') DEFAULT NULL,
  `reporting_office_1` int(10) unsigned DEFAULT NULL,
  `reporting_office_2` int(10) unsigned DEFAULT NULL,
  `reporting_office_3` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `doctors` */

insert  into `doctors`(`id`,`doctor_name`,`doctor_address`,`hospital_name`,`hospital_address`,`contact_no_1`,`contact_no_2`,`email`,`employee_id`,`qualification_id`,`category_id`,`territory_id`,`state`,`city`,`speciality`,`mpl_no`,`designation`,`dob`,`dow`,`hq`,`class`,`type`,`reporting_office_1`,`reporting_office_2`,`reporting_office_3`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Amit','MIDC','Nehete hospital','Nashik','9977865432','9745127989','amit1@nehete.com',7,1,1,1,'Maharashtra','Nashik','PED','111','MEHQ','2023-10-18','2023-10-16','Udaipur','dd','hq',10,11,8,1,1,'2023-10-05 06:54:30','2023-10-12 08:39:54'),
(2,'Vishal Jain','NEAR GSS SCHOOL','Jain Hospital','KANORE','9782319135','9582422022','vishal@gmail.com',4,2,2,1,'Karnataka','KANORE','G PRC','111','MEHQ','2000-01-05','2023-04-04','UDAIPUR',NULL,'hq',3,5,7,1,1,'2023-10-05 07:53:36','2023-10-12 08:36:20'),
(3,'DR D MOHAN RAO','AMBERPET/SKIN HAIR & VD','OSMANIA HOSPITAL','AMBERPET','9210308792','9096979119','rao@gmail.com',6,2,2,2,'ANDHRAPRADESH','HYDERABAD','PED','222','ME','2023-10-09','2023-10-10','UDAIPUR',NULL,'hq',NULL,NULL,NULL,1,1,'2023-10-09 11:12:55','2023-10-09 11:27:17'),
(4,'anuja','dynamic crest, khidkali, thane','neon','thane','8996554321','9987564278','anuja1@gmail.com',NULL,1,1,1,'maharashtra','mumbai','PED','111','manager','2023-10-18','2023-10-31','THANE','dd','ex',3,5,7,1,1,'2023-10-11 13:37:21','2023-10-11 13:37:53'),
(5,'DR H P TYAGI','RAJ NAGAR','tyagi hsp','KHAJORI','9311444110',NULL,'tyagi@encore.com',NULL,1,2,4,'Delhi','DELHI','G PRC','202','ME','1989-08-22','2000-04-04','DELHI 1',NULL,'ex',10,11,12,1,1,'2023-10-12 06:49:21','2023-10-12 08:01:18'),
(6,'HABDE ALI BOHRA','BHINDER','R.K.HOSPITAL','BHINDER','9414688279','7568707099','bohra@encore.com',NULL,NULL,NULL,NULL,'RAJASTHAN','BHINDER','PHY','111','ME',NULL,NULL,'UDAIPUR',NULL,'ex',NULL,NULL,NULL,1,1,'2023-10-12 12:05:24','2023-10-12 12:05:24'),
(7,'Prachi Khadayate','Indore','Krishna Hospital','Indore','9414622768','7568707099','prachi@encore.com',NULL,2,4,2,'Madhya Pradesh','Indore','MD','234','ME','2023-10-13','2023-10-13','INDORE',NULL,'hq',9,10,11,1,8,'2023-10-13 12:14:24','2023-12-08 08:37:29'),
(8,'SUGANITA','BARABANKI NEAR','HIND HOSPITAL BARABANKI','FATEHPUR','7080285555','9140074109','suganita@encore.com',NULL,1,1,1,'Uttar Pradesh','BARABANKI','DER','98','ME','2023-10-16','2023-10-16','LUCKNOW','dd','ex',10,11,8,1,1,'2023-10-16 08:03:52','2023-10-16 08:04:22'),
(9,'Kunal Shah',NULL,'Anjana Multispeciality',NULL,'8551322987',NULL,'kunal@encore1.com',NULL,4,2,1,'Maharashtra','Nashik','Dentist','789','Dentist','1983-02-07','2011-03-08',NULL,NULL,'ex',9,10,11,8,8,'2023-12-08 08:31:22','2023-12-08 08:31:22');

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
  `dob` date DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reporting_office_1` int(11) DEFAULT NULL,
  `reporting_office_2` int(11) DEFAULT NULL,
  `reporting_office_3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`name`,`email`,`contact_no_1`,`contact_no_2`,`address`,`designation`,`state_name`,`city`,`fieldforce_name`,`employee_code`,`dob`,`created_by`,`updated_by`,`created_at`,`updated_at`,`reporting_office_1`,`reporting_office_2`,`reporting_office_3`) values 
(2,'Anamika','anamika@encore.com','9887567898','9987564278','MADHUBAN','Zonal Manager','Kerala','UDAIPUR','UDAIPUR HQ','ENMKT0761','1989-02-07',1,1,'2023-10-09 05:55:42','2023-12-08 04:35:30',2,NULL,NULL),
(3,'Abhishek','abhishek@encore.com','9887567898','9987564278','near SHARMA HOSPITAL','Zonal Manager','UTTAR PRADESH','GHAZIABAD','GHAZIABAD 1 HQ','ENMKT0815','2000-06-06',1,1,'2023-10-09 05:57:21','2023-10-09 05:57:21',NULL,NULL,NULL),
(4,'chhaya','chhaya@encore.com','9479836261','7000345593','SHANKER GHEE BHANDAR K PAS','Area Manager','Karnataka','JABALPUR','Karnataka1 HQ','ENMKT0826','1990-03-13',1,1,'2023-10-09 05:59:25','2023-10-18 08:38:17',2,NULL,NULL),
(5,'pradip','pradip@encore.com','9425068761','9424567761','near RAY CLINIC','Area Manager','Gujarat','NASHIK','Gujrat  HQ','ENMKT0787','1999-03-15',1,1,'2023-10-09 06:05:07','2023-10-18 08:34:29',3,NULL,NULL),
(6,'Vilas','vilas@encore.com','9414296968','9414166608','dadar','Marketing Executive','Karnataka','Mumbai','Karnataka HQ','ENMKT0832','1991-02-12',1,1,'2023-10-09 06:12:40','2023-12-08 05:32:51',2,4,NULL),
(7,'Avinash','avinash@encore.com','9975318528','7798602992','CESSTLE MIL','Managing Executive','Gujarat','Mumbai','Gujarat HQ','ENMKT0791','1997-06-17',1,1,'2023-10-09 06:14:46','2023-10-18 08:37:25',3,5,NULL),
(9,'Jitendra Shah','jitendra@encore.com','8790761234',NULL,NULL,'Zonal Manager','Maharashtra','Nanded','Nanded HQ','ENMKT0779','1960-03-08',8,8,'2023-12-08 08:26:57','2023-12-08 08:26:57',2,NULL,NULL),
(10,'Yugal Shah','yugal@encore.com','8790761234',NULL,NULL,'Area Manager','Maharashtra','Nanded','Nanded HQ','ENMKT0780','1989-05-09',8,8,'2023-12-08 08:28:08','2023-12-08 08:28:08',9,NULL,NULL),
(11,'Vedansh Shah','vedansh@encore.com','8790761234',NULL,NULL,'Marketing Executive','Maharashtra','Nanded','Nanded HQ','ENMKT0781','1999-04-06',8,8,'2023-12-08 08:28:50','2023-12-08 08:28:50',9,10,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `grant_approval_details` */

insert  into `grant_approval_details`(`id`,`grant_approval_id`,`status`,`amount`,`reason`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,2,'Area Manager Approved',3000.00,NULL,4,4,'2023-10-10 06:44:18','2023-10-10 06:44:18'),
(2,6,'Area Manager Approved',17000.00,NULL,4,4,'2023-10-10 07:35:17','2023-10-10 07:35:17'),
(3,3,'Area Manager Rejected',6000.00,NULL,4,4,'2023-10-10 07:37:21','2023-10-10 07:37:21'),
(4,5,'Area Manager Rejected',7000.00,NULL,4,4,'2023-10-10 07:39:17','2023-10-10 07:39:17'),
(5,4,'Cancel',9000.00,NULL,6,6,'2023-10-10 07:41:32','2023-10-10 07:41:32'),
(6,8,'Level 1 Approved',40000.00,NULL,5,5,'2023-10-11 06:53:13','2023-10-11 06:53:13'),
(7,8,'Level 2 Approved',38000.00,NULL,3,3,'2023-10-11 07:02:47','2023-10-11 07:02:47'),
(8,11,'Level 1 Approved',15000.00,NULL,5,5,'2023-10-11 07:04:10','2023-10-11 07:04:10'),
(9,11,'Level 2 Rejected',NULL,NULL,3,3,'2023-10-11 07:04:27','2023-10-11 07:04:27'),
(10,12,'Level 1 Approved',15000.00,NULL,4,4,'2023-10-11 10:25:49','2023-10-11 10:25:49'),
(11,12,'Level 2 Approved',16000.00,NULL,2,2,'2023-10-11 10:29:13','2023-10-11 10:29:13'),
(12,13,'Level 1 Approved',22500.00,NULL,5,5,'2023-10-27 04:49:56','2023-10-27 04:49:56'),
(13,13,'Level 2 Approved',23000.00,NULL,3,3,'2023-10-27 04:51:00','2023-10-27 04:51:00'),
(14,15,'Level 1 Approved',7000.00,NULL,10,10,'2023-12-08 08:38:51','2023-12-08 08:38:51'),
(15,14,'Level 1 Approved',17000.00,NULL,10,10,'2023-12-08 08:39:12','2023-12-08 08:39:12'),
(16,15,'Level 2 Rejected',NULL,NULL,9,9,'2023-12-08 08:39:47','2023-12-08 08:39:47'),
(17,14,'Level 2 Approved',16000.00,NULL,9,9,'2023-12-08 08:40:01','2023-12-08 08:40:01');

/*Table structure for table `grant_approvals` */

DROP TABLE IF EXISTS `grant_approvals`;

CREATE TABLE `grant_approvals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `doctor_id` bigint(20) unsigned DEFAULT NULL,
  `activity_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `proposal_date` date DEFAULT NULL,
  `proposal_month` varchar(20) DEFAULT NULL,
  `proposal_amount` decimal(10,2) DEFAULT 0.00,
  `approval_amount` decimal(10,2) DEFAULT 0.00,
  `status` varchar(250) DEFAULT NULL,
  `approval_level_1` tinyint(1) DEFAULT 0,
  `approval_level_2` tinyint(1) DEFAULT 0,
  `approved_on` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grant_approvals_doctor_id_foreign` (`doctor_id`),
  KEY `grant_approvals_activity_id_foreign` (`activity_id`),
  CONSTRAINT `grant_approvals_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  CONSTRAINT `grant_approvals_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grant_approvals` */

insert  into `grant_approvals`(`id`,`code`,`employee_id`,`doctor_id`,`activity_id`,`email`,`contact_no`,`date_of_issue`,`proposal_date`,`proposal_month`,`proposal_amount`,`approval_amount`,`status`,`approval_level_1`,`approval_level_2`,`approved_on`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'G00001',6,3,2,'bina@mail.com',NULL,'2023-10-31',NULL,'Oct /2023',10000.00,0.00,'Open',0,0,NULL,6,6,'2023-10-10 06:29:56','2023-10-10 06:29:56'),
(2,'G00002',6,1,1,'bina@hmail.com',NULL,'2023-11-01',NULL,'Nov /2023',4000.00,3000.00,'Level 1 Approved',1,0,NULL,6,4,'2023-10-10 06:30:31','2023-10-10 06:44:18'),
(3,'G00003',6,1,1,'b@mail.com',NULL,'2023-10-31',NULL,'Oct /2023',6000.00,0.00,'Level 1 Approved',1,0,NULL,6,4,'2023-10-10 07:20:34','2023-10-10 07:37:21'),
(4,'G00004',6,2,1,'bina@gmail.com',NULL,'2023-11-07',NULL,'Nov /2023',9000.00,0.00,'Cancel',0,0,NULL,6,6,'2023-10-10 07:29:19','2023-10-10 07:41:32'),
(5,'G00005',6,3,1,'b@gmail.com',NULL,'2023-12-13',NULL,'Dec /2023',7000.00,0.00,'Level 1 Approved',1,0,NULL,6,4,'2023-10-10 07:30:13','2023-10-10 07:39:17'),
(6,'G00006',6,2,2,'b@hmail.com',NULL,'2023-11-15',NULL,'Nov /2023',20000.00,17000.00,'Level 2 Approved',1,1,NULL,6,4,'2023-10-10 07:31:03','2023-10-10 07:35:17'),
(7,'G00007',7,1,1,'datta@mail.com',NULL,'2023-10-31',NULL,'Oct /2023',2000.00,0.00,'Open',0,0,NULL,7,7,'2023-10-10 08:07:42','2023-10-10 08:07:42'),
(8,'G00008',7,3,2,'datta@hmail1.com',NULL,'2023-12-27',NULL,'Dec /2023',45000.00,38000.00,'Level 2 Approved',1,1,NULL,7,3,'2023-10-10 08:11:00','2023-10-11 07:02:47'),
(11,'G00009',7,1,1,'vs',NULL,'2020-10-10',NULL,'May /2023',100000.00,15000.00,'Level 2 Rejected',1,0,NULL,7,3,'2023-10-11 06:40:33','2023-10-11 07:04:27'),
(12,'G00010',6,3,1,'bca@gmail.com',NULL,'2023-11-01',NULL,'Nov /2023',20000.00,16000.00,'Level 2 Approved',1,1,NULL,6,2,'2023-10-11 10:22:40','2023-10-11 10:29:13'),
(13,'G00011',7,2,8,'sanjeev@sanmisha.com',NULL,'2023-11-10',NULL,'Nov /2023',25000.00,23000.00,'Level 2 Approved',1,1,NULL,7,3,'2023-10-27 04:47:35','2023-10-27 04:51:00'),
(14,'G00012',11,9,1,'vedansh@mail.com','8976543210','2024-01-20',NULL,'Jan / 2024',18000.00,16000.00,'Level 2 Approved',1,1,NULL,11,9,'2023-12-08 08:35:59','2023-12-08 08:40:01'),
(15,'G00013',11,7,2,'vedansh@gmail.com','9875641236','2024-03-12',NULL,'Mar / 2024',8000.00,7000.00,'Level 2 Rejected',1,0,NULL,11,9,'2023-12-08 08:38:15','2023-12-08 08:39:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(47,'2023_10_10_131020_alter_table_product_details',29),
(48,'2023_10_11_125631_alter_table_doctors',30),
(49,'2023_10_16_074725_create_roi_accountability_reports_table',31),
(50,'2023_10_16_103609_create_roi_accountability_report_details_table',31);

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
(2,'App\\Models\\User',27),
(2,'App\\Models\\User',28),
(7,'App\\Models\\User',2),
(7,'App\\Models\\User',3),
(7,'App\\Models\\User',9),
(7,'App\\Models\\User',13),
(7,'App\\Models\\User',18),
(8,'App\\Models\\User',4),
(8,'App\\Models\\User',5),
(8,'App\\Models\\User',10),
(8,'App\\Models\\User',15),
(8,'App\\Models\\User',20),
(8,'App\\Models\\User',21),
(9,'App\\Models\\User',6),
(9,'App\\Models\\User',7),
(9,'App\\Models\\User',11),
(9,'App\\Models\\User',12),
(9,'App\\Models\\User',14),
(12,'App\\Models\\User',8);

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
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(120,'doctor_business_monitorings.destroy','web','2023-10-10 08:21:24','2023-10-10 08:21:24'),
(121,'import','web','2023-10-11 12:35:19','2023-10-11 12:35:19'),
(122,'activities.import','web','2023-10-12 05:13:42','2023-10-12 05:13:42'),
(123,'importExcel','web','2023-10-12 05:13:42','2023-10-12 05:13:42'),
(124,'products.import','web','2023-10-12 07:04:39','2023-10-12 07:04:39'),
(125,'importProductExcel','web','2023-10-12 07:12:11','2023-10-12 07:12:11'),
(126,'territories.import','web','2023-10-12 07:18:22','2023-10-12 07:18:22'),
(127,'importTerritoryExcel','web','2023-10-12 07:26:49','2023-10-12 07:26:49'),
(128,'qualifications.import','web','2023-10-12 07:35:59','2023-10-12 07:35:59'),
(129,'importQualificationExcel','web','2023-10-12 07:35:59','2023-10-12 07:35:59'),
(130,'categories.import','web','2023-10-12 07:47:05','2023-10-12 07:47:05'),
(131,'importCategoriesExcel','web','2023-10-12 07:47:05','2023-10-12 07:47:05'),
(132,'doctors.import','web','2023-10-12 11:45:21','2023-10-12 11:45:21'),
(133,'importDoctorsExcel','web','2023-10-12 11:45:21','2023-10-12 11:45:21'),
(134,'chemists.import','web','2023-10-12 12:21:34','2023-10-12 12:21:34'),
(135,'importChemistsExcel','web','2023-10-12 12:21:34','2023-10-12 12:21:34'),
(136,'stockists.import','web','2023-10-12 12:35:00','2023-10-12 12:35:00'),
(137,'importStockistsExcel','web','2023-10-12 12:35:00','2023-10-12 12:35:00'),
(138,'employees.import','web','2023-10-12 13:18:00','2023-10-12 13:18:00'),
(139,'importEmployeesExcel','web','2023-10-12 13:18:00','2023-10-12 13:18:00'),
(140,'grant_approvals.report','web','2023-10-14 05:40:06','2023-10-14 05:40:06'),
(141,'GrantApprovalsController.report','web','2023-10-14 08:00:48','2023-10-14 08:00:48'),
(142,'reportPDF','web','2023-10-14 08:00:48','2023-10-14 08:00:48'),
(143,'doctor_business_monitorings.report','web','2023-10-14 10:32:30','2023-10-14 10:32:30'),
(144,'reportCDBM','web','2023-10-14 10:33:40','2023-10-14 10:33:40'),
(145,'roi_accountability_reports.index','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(146,'roi_accountability_reports.create','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(147,'roi_accountability_reports.store','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(148,'roi_accountability_reports.show','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(149,'roi_accountability_reports.edit','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(150,'roi_accountability_reports.update','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(151,'roi_accountability_reports.destroy','web','2023-10-16 10:52:33','2023-10-16 10:52:33'),
(152,'roi_accountability_reports.report','web','2023-10-17 06:21:48','2023-10-17 06:21:48'),
(153,'reportRAR','web','2023-10-17 06:21:48','2023-10-17 06:21:48'),
(154,'doctor_business_monitorings.approval','web','2023-12-08 08:50:03','2023-12-08 08:50:03'),
(155,'doctor_business_monitorings.rejected','web','2023-12-08 08:50:04','2023-12-08 08:50:04'),
(156,'doctor_business_monitorings.cancel','web','2023-12-08 08:50:04','2023-12-08 08:50:04'),
(157,'doctors.getDoctors','web','2023-12-08 08:50:04','2023-12-08 08:50:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_details` */

insert  into `product_details`(`id`,`doctor_business_monitoring_id`,`product_id`,`nrv`,`created_by`,`updated_by`,`created_at`,`updated_at`,`avg_business_units`,`avg_business_value`,`exp_vol`,`exp_vol_1`,`exp_vol_2`,`exp_vol_3`,`exp_vol_4`,`exp_vol_5`,`exp_vol_6`,`total_exp_vol`,`total_exp_val`,`scheme`) values 
(1,1,11,128.56,1,1,'2023-10-16 05:49:18','2023-10-16 05:49:18',10,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,'10'),
(2,1,1,256.89,1,1,'2023-10-16 05:49:18','2023-10-16 05:49:18',20,20.00,20.00,20.00,20.00,20.00,20.00,20.00,20.00,20.00,20.00,'20'),
(3,2,1,256.89,1,1,'2023-10-17 07:11:02','2023-10-17 07:11:02',100,200.00,100.00,200.00,100.00,200.00,100.00,200.00,100.00,200.00,100.00,'5'),
(4,3,4,84.21,7,7,'2023-10-27 04:59:57','2023-10-27 04:59:57',100,8421.00,200.00,200.00,200.00,200.00,200.00,200.00,0.00,1200.00,101052.00,'10'),
(5,3,7,152.55,7,7,'2023-10-27 04:59:57','2023-10-27 04:59:57',50,7625.00,50.00,50.00,50.00,50.00,50.00,50.00,0.00,300.00,45750.00,'20');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`nrv`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'ALverise Creams',256.89,1,1,'2023-10-02 11:33:11','2023-10-05 10:53:17'),
(4,'CLINRED GEL 20G (TP)',84.21,1,1,'2023-10-10 10:46:33','2023-10-10 10:46:33'),
(5,'D-WIK DROPS 15 ML (TP)',54.64,1,1,'2023-10-10 10:46:45','2023-10-10 10:46:45'),
(7,'SOTIL LOTION 1X60 ML (TP)',152.55,1,1,'2023-10-11 10:47:48','2023-10-11 10:47:48'),
(8,'GLAMWITE CREAM (TP)',256.89,1,1,'2023-10-13 10:00:04','2023-10-13 10:00:04'),
(9,'GLAMWITE FACE WASH (TP)',103.73,1,1,'2023-10-13 10:00:04','2023-10-13 10:00:04'),
(10,'JIMLIG CAPSULES 100 MG (TP)',83.56,1,1,'2023-10-13 10:00:04','2023-10-13 10:00:04'),
(11,'JIMLIG CAPSULES 200 MG (TP)',128.56,1,1,'2023-10-13 10:00:04','2023-10-13 10:00:04'),
(12,'MASKOFUNG 30 GM (TP)',192.84,1,1,'2023-10-17 05:45:45','2023-10-17 05:46:56'),
(13,'LULIPORUS',100.00,1,1,'2023-12-08 04:29:28','2023-12-08 04:30:12'),
(14,'LULIPORUS-XL 50 GM (TP)',157.49,1,1,'2023-12-08 04:30:21','2023-12-08 04:30:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `qualifications` */

insert  into `qualifications`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'MBBS',1,1,'2023-10-02 11:36:39','2023-10-02 11:36:39'),
(2,'MBBS.DNB',1,1,'2023-10-02 11:37:39','2023-10-11 10:54:25'),
(4,'MD',1,1,'2023-10-11 10:53:29','2023-10-11 10:53:29'),
(5,'Gynac',1,1,'2023-10-13 10:09:50','2023-10-13 10:09:50'),
(6,'Pediatrician',1,1,'2023-10-13 10:09:50','2023-10-17 05:52:13'),
(8,'Medicine',1,1,'2023-10-17 05:51:42','2023-10-17 05:51:42'),
(9,'General',1,1,'2023-10-17 05:51:42','2023-10-17 05:51:42');

/*Table structure for table `roi_accountability_report_details` */

DROP TABLE IF EXISTS `roi_accountability_report_details`;

CREATE TABLE `roi_accountability_report_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roi_accountability_report_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `nrv` decimal(10,2) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `act_vol` decimal(10,2) DEFAULT NULL,
  `act_val` decimal(10,2) DEFAULT NULL,
  `scheme` varchar(20) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=424112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roi_accountability_report_details` */

insert  into `roi_accountability_report_details`(`id`,`roi_accountability_report_id`,`product_id`,`nrv`,`month`,`act_vol`,`act_val`,`scheme`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,33,1,256.89,'jan/2023',100.00,200.00,'10',1,1,'2023-10-17 04:51:47','2023-10-17 04:51:47'),
(2,33,11,128.56,'feb/2023',200.00,300.00,'20',1,1,'2023-10-17 04:51:47','2023-10-17 04:51:47'),
(3,34,8,256.89,'Jul /2023',10.00,100.00,'5',1,1,'2023-10-17 05:29:30','2023-10-17 05:29:30'),
(4,35,9,103.73,'Nov /2023',10.00,200.00,'15',1,1,'2023-10-17 05:38:27','2023-10-17 05:39:08'),
(41,35,8,256.89,'May /2023',20.00,100.00,'5',NULL,NULL,'2023-10-17 05:39:08','2023-10-17 05:39:08'),
(42,36,1,256.89,'Dec /2023',10.00,200.00,'10',1,1,'2023-11-01 10:24:44','2023-11-01 10:49:14'),
(421,36,12,192.84,'Nov /2023',20.00,100.00,'15',NULL,NULL,'2023-11-01 10:49:14','2023-11-01 10:49:14'),
(422,37,1,256.89,'Jan /2023',100.00,7000.00,'10',1,1,'2023-11-03 12:53:54','2023-11-06 12:44:32'),
(423,37,7,152.55,'May /2023',200.00,5000.00,'15',1,1,'2023-11-03 12:53:54','2023-11-06 12:44:32'),
(424,37,12,192.84,'Dec /2023',300.00,3000.00,'20',1,1,'2023-11-03 12:53:54','2023-11-06 12:44:32'),
(4241,37,8,256.89,'Mar /2023',100.00,2000.00,'10',NULL,NULL,'2023-11-03 13:15:12','2023-11-06 12:44:32'),
(4242,38,8,256.89,'Sep /2023',100.00,7000.00,'15',1,1,'2023-11-04 06:19:42','2023-11-04 06:19:42'),
(4243,38,5,54.64,'May /2023',20.00,5000.00,'10',1,1,'2023-11-04 06:19:42','2023-11-04 06:19:42'),
(4244,39,4,84.21,'Dec /2023',100.00,100.00,'10',1,1,'2023-11-06 10:59:59','2023-11-06 10:59:59'),
(4245,39,5,54.64,'Dec /2023',20.00,200.00,'20',1,1,'2023-11-06 10:59:59','2023-11-06 10:59:59'),
(4246,40,1,256.89,'Jan /2023',10.00,500.00,'15',1,1,'2023-11-06 12:13:32','2024-01-09 18:54:28'),
(4247,40,9,103.73,'Apr /2023',23.00,234.00,'15',1,1,'2023-11-06 12:13:32','2024-01-09 18:54:28'),
(42411,37,4,84.21,'Dec /2023',50.00,100.00,'14',NULL,NULL,'2023-11-06 12:44:32','2023-11-06 12:44:32'),
(42471,40,14,157.49,'Nov /2023',9.00,200.00,'15',NULL,NULL,'2024-01-09 18:54:28','2024-01-09 18:54:28'),
(424111,37,7,152.55,'Jun /2023',15.00,568.00,'12',NULL,NULL,'2023-11-06 12:44:32','2023-11-06 12:44:32');

/*Table structure for table `roi_accountability_reports` */

DROP TABLE IF EXISTS `roi_accountability_reports`;

CREATE TABLE `roi_accountability_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grant_approval_id` bigint(20) unsigned DEFAULT NULL,
  `rar_date` date DEFAULT NULL,
  `proposal_month` varchar(20) DEFAULT NULL,
  `roi` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_actual_value` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roi_accountability_reports` */

insert  into `roi_accountability_reports`(`id`,`grant_approval_id`,`rar_date`,`proposal_month`,`roi`,`amount`,`created_by`,`updated_by`,`created_at`,`updated_at`,`total_actual_value`) values 
(33,6,'2023-11-15','Nov /2023',100.00,20000.00,1,1,'2023-10-17 04:51:47','2023-10-17 04:51:47',NULL),
(34,12,'2023-11-01','Nov /2023',101.00,20000.00,1,1,'2023-10-17 05:29:30','2023-10-17 05:29:30',NULL),
(35,8,'2023-12-27','Dec /2023',102.00,45000.00,1,1,'2023-10-17 05:38:27','2023-10-17 05:39:08',NULL),
(36,6,'2023-11-15','Nov /2023',100.00,20000.00,1,1,'2023-11-01 10:24:44','2023-11-01 10:49:14',NULL),
(37,13,'2023-11-09','Nov /2023',1.47,12000.00,1,1,'2023-11-03 12:53:54','2023-11-06 12:44:32',17668.00),
(38,6,'2023-11-15','Nov /2023',0.60,20000.00,1,1,'2023-11-04 06:19:42','2023-11-04 06:19:42',12000.00),
(39,8,'2023-12-27','Dec /2023',0.01,45000.00,1,1,'2023-11-06 10:59:59','2023-11-06 10:59:59',300.00),
(40,12,'2023-11-01','Nov /2023',0.04,20000.00,1,1,'2023-11-06 12:13:32','2024-01-09 18:54:28',934.00);

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
(1,12),
(2,1),
(2,12),
(3,1),
(3,12),
(4,12),
(5,12),
(6,12),
(7,12),
(8,12),
(9,12),
(10,12),
(11,12),
(12,12),
(13,12),
(14,12),
(15,12),
(16,12),
(17,12),
(18,12),
(19,12),
(20,12),
(21,12),
(22,12),
(23,12),
(24,12),
(25,1),
(25,12),
(26,1),
(26,12),
(27,1),
(27,12),
(28,1),
(28,9),
(28,12),
(29,1),
(29,12),
(30,1),
(30,12),
(31,1),
(31,12),
(32,1),
(32,12),
(33,1),
(33,12),
(34,1),
(34,12),
(35,1),
(35,12),
(36,1),
(36,12),
(37,1),
(37,12),
(38,1),
(38,12),
(39,1),
(39,12),
(40,1),
(40,12),
(41,1),
(41,12),
(42,1),
(42,12),
(43,1),
(43,12),
(44,1),
(44,12),
(45,1),
(45,12),
(46,1),
(46,12),
(47,1),
(47,12),
(48,1),
(48,12),
(49,1),
(49,12),
(50,1),
(50,12),
(51,1),
(51,12),
(52,1),
(52,12),
(53,1),
(53,12),
(54,1),
(54,12),
(55,1),
(55,12),
(56,1),
(56,12),
(57,1),
(57,12),
(58,1),
(58,12),
(59,1),
(59,12),
(60,1),
(60,12),
(61,1),
(61,12),
(62,1),
(62,12),
(63,1),
(63,12),
(64,1),
(64,12),
(65,1),
(65,12),
(66,1),
(66,12),
(67,1),
(67,12),
(68,1),
(68,12),
(69,1),
(69,12),
(70,1),
(70,12),
(71,1),
(71,12),
(72,1),
(72,12),
(73,1),
(73,12),
(74,1),
(74,12),
(75,1),
(75,12),
(76,1),
(76,12),
(77,1),
(77,12),
(78,1),
(78,7),
(78,8),
(78,9),
(78,12),
(79,1),
(79,12),
(80,1),
(80,12),
(81,1),
(81,12),
(82,1),
(82,12),
(83,1),
(83,12),
(84,1),
(84,12),
(85,1),
(85,12),
(86,1),
(86,9),
(86,12),
(87,1),
(87,9),
(87,12),
(88,1),
(88,9),
(88,12),
(89,1),
(89,7),
(89,8),
(89,9),
(89,12),
(90,1),
(90,9),
(90,12),
(91,1),
(91,9),
(91,12),
(92,1),
(92,12),
(93,1),
(93,12),
(94,1),
(94,12),
(95,1),
(95,12),
(96,1),
(96,12),
(97,1),
(97,12),
(98,1),
(98,12),
(99,1),
(99,12),
(100,1),
(100,7),
(100,8),
(100,9),
(100,12),
(101,1),
(101,7),
(101,8),
(101,9),
(101,12),
(102,1),
(102,7),
(102,8),
(102,9),
(102,12),
(103,1),
(103,7),
(103,8),
(103,9),
(103,12),
(104,1),
(104,7),
(104,8),
(104,9),
(104,12),
(105,1),
(105,7),
(105,8),
(105,9),
(105,12),
(106,1),
(106,7),
(106,8),
(106,9),
(106,12),
(107,1),
(107,12),
(108,1),
(108,7),
(108,8),
(108,9),
(108,12),
(109,1),
(109,12),
(110,1),
(110,12),
(111,1),
(111,7),
(111,8),
(111,9),
(111,12),
(112,1),
(112,7),
(112,8),
(112,9),
(112,12),
(113,1),
(113,7),
(113,8),
(113,9),
(113,12),
(114,1),
(114,7),
(114,8),
(114,9),
(114,12),
(115,1),
(115,7),
(115,8),
(115,9),
(115,12),
(116,1),
(116,7),
(116,8),
(116,9),
(116,12),
(117,1),
(117,7),
(117,8),
(117,9),
(117,12),
(118,1),
(118,7),
(118,8),
(118,9),
(118,12),
(119,1),
(119,7),
(119,8),
(119,9),
(119,12),
(120,1),
(120,7),
(120,8),
(120,9),
(120,12),
(121,1),
(121,12),
(122,1),
(122,12),
(123,1),
(123,12),
(124,1),
(124,12),
(125,1),
(125,12),
(126,1),
(126,12),
(127,1),
(127,12),
(128,1),
(128,12),
(129,1),
(129,12),
(130,1),
(130,12),
(131,1),
(131,12),
(132,1),
(132,12),
(133,1),
(133,12),
(134,1),
(134,12),
(135,1),
(135,12),
(136,1),
(136,12),
(137,1),
(137,12),
(138,1),
(138,12),
(139,1),
(139,12),
(140,1),
(140,12),
(141,1),
(141,12),
(142,1),
(142,12),
(143,1),
(143,8),
(143,12),
(144,1),
(144,8),
(144,12),
(145,1),
(145,12),
(146,1),
(146,12),
(147,1),
(147,12),
(148,1),
(148,12),
(149,1),
(149,12),
(150,1),
(150,12),
(151,1),
(151,12),
(152,1),
(152,12),
(153,1),
(153,12),
(154,1),
(154,8),
(154,9),
(154,12),
(155,1),
(155,8),
(155,12),
(156,1),
(156,8),
(156,12),
(157,1),
(157,7),
(157,8),
(157,12);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'Admin','web','2023-08-21 18:50:12','2023-08-21 18:50:14'),
(2,'User','web','2023-09-01 11:04:15','2023-08-25 11:04:18'),
(6,'Marketing','web','2023-09-12 10:27:23','2023-09-12 10:27:23'),
(7,'Zonal Manager','web','2023-10-05 16:58:12','2023-10-09 05:31:57'),
(8,'Area Manager','web','2023-10-05 16:59:34','2023-10-09 05:32:30'),
(9,'Marketing Executive','web','2023-10-05 17:00:55','2023-10-30 05:07:13'),
(12,'Root','web','2023-11-07 13:11:30','2023-11-07 13:11:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stockists` */

insert  into `stockists`(`id`,`employee_id_1`,`employee_id_2`,`employee_id_3`,`stockist`,`updated_by`,`created_by`,`updated_at`,`created_at`) values 
(1,3,5,7,'ATC MEDICARE PRIVATE LIMITED',1,1,'2023-10-09 07:12:49','2023-10-04 11:47:06'),
(2,2,4,6,'GAYATRI ENTERPRISES',1,1,'2023-10-09 07:10:34','2023-10-09 07:10:34'),
(9,NULL,NULL,NULL,'ANAND PHARMA DISTRIBUTORS',1,1,'2023-10-13 10:41:19','2023-10-13 10:41:19'),
(10,NULL,NULL,NULL,'MANISH MEDICAL CORPORATION',1,1,'2023-10-13 10:41:19','2023-10-13 10:41:19'),
(11,NULL,NULL,NULL,'MODI DRUG AGENCY',1,1,'2023-10-13 10:41:20','2023-10-13 10:41:20'),
(12,NULL,NULL,NULL,'ANKUR MEDICINES',1,1,'2023-10-13 10:41:20','2023-10-13 10:41:20'),
(13,NULL,NULL,NULL,'KRISHNA MEDICAL AGENCY',1,1,'2023-10-13 10:41:20','2023-10-13 10:41:20'),
(14,10,11,8,'RELIEF DRUG AGENCY',1,1,'2023-10-16 07:55:37','2023-10-16 07:55:37'),
(15,1,15,12,'AKASH MEDICAL AGENCY',1,1,'2023-10-16 07:55:37','2023-10-16 07:55:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `territories` */

insert  into `territories`(`id`,`name`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Udaipur',1,1,'2023-10-02 11:35:25','2023-10-02 11:35:25'),
(2,'Shirhoi',1,1,'2023-10-02 11:35:40','2023-10-02 11:36:15'),
(3,'BHILWARA',1,1,'2023-10-13 09:33:48','2023-10-13 09:33:48'),
(4,'RAJSAMAD',1,1,'2023-10-13 09:33:48','2023-10-13 09:33:48'),
(6,'PRATAP GARH',1,1,'2023-10-17 05:49:22','2023-10-17 05:49:22'),
(7,'DUNGARPUR',1,1,'2023-10-17 05:49:22','2023-10-17 05:49:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`active`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Admin','admin@encore.com',NULL,'$2y$10$iB6lmJ2rSCQHELZP4r/Am.6pWIeDLjxSAVis9Ikrrw0jl7b0PYepO',NULL,1,NULL,NULL,'2023-07-12 08:28:19','2023-10-18 08:43:01'),
(2,'Anamika','anamika@encore.com',NULL,'$2y$10$2sZ3uSLOB340D9yGFu.FPecF7bQ1x/LCdUlLGCQFr/iDkaqOqylNC',NULL,1,NULL,NULL,'2023-10-09 05:55:42','2023-12-08 04:35:30'),
(3,'Abhishek','abhishek@encore.com',NULL,'$2y$10$p1kX7L5iPC9/nrcKeTeKE.HIyIVfsQJM180wm.tYiNAddPe9LLVxm',NULL,1,NULL,NULL,'2023-10-09 05:57:21','2023-10-09 05:57:21'),
(4,'chhaya','chhaya@encore.com',NULL,'$2y$10$bn6zbQstOZllPPq8CiaVDeOiz9g2B9elkDhRT6iduRUczIWb7JFcC',NULL,1,NULL,NULL,'2023-10-09 05:59:25','2023-10-18 08:38:17'),
(5,'pradip','pradip@encore.com',NULL,'$2y$10$xGhUmUxEmt8nqhTkoucOZefA/TaluLe8eJn93b5GHlHhTRq3SKI9S',NULL,1,NULL,NULL,'2023-10-09 06:05:07','2023-10-27 04:49:21'),
(6,'Vilas','vilas@encore.com',NULL,'$2y$10$lTRRQqtIQbpBrxsuUsd50OQgVGyLMndOnM8sek./pfP7uBbRqQCPi',NULL,1,NULL,NULL,'2023-10-09 06:12:40','2023-12-08 05:32:51'),
(7,'Avinash','avinash@encore.com',NULL,'$2y$10$NSs6F52IN9wntxgqldyYbum.PNBWDyT1aJvJ7JJ5T0oGePQPBQ0CK',NULL,1,NULL,NULL,'2023-10-09 06:14:46','2023-10-18 08:37:26'),
(8,'Root','root@encore.com',NULL,'$2y$10$iB6lmJ2rSCQHELZP4r/Am.6pWIeDLjxSAVis9Ikrrw0jl7b0PYepO',NULL,1,NULL,NULL,'2023-11-08 10:06:04','2023-11-08 10:06:06'),
(9,'Jitendra Shah','jitendra@encore.com',NULL,'$2y$10$JDo.TTcSv9Q81YR57vWTL.heoHTtykG4Ek5cpoapd78Ez.77l1feC',NULL,1,NULL,NULL,'2023-12-08 08:26:57','2023-12-08 08:29:34'),
(10,'Yugal Shah','yugal@encore.com',NULL,'$2y$10$6WUuxb7Xn6PjPOdcYe1UlO87leqxM8wVEuotkh.S96wLDsCTzXWBC',NULL,1,NULL,NULL,'2023-12-08 08:28:08','2023-12-08 08:29:23'),
(11,'Vedansh Shah','vedansh@encore.com',NULL,'$2y$10$CXXTk85Ay4RBIgtra4hefu/It2v3xBp.AG2vo1X77ScnykHC8xKJG',NULL,1,NULL,NULL,'2023-12-08 08:28:50','2023-12-08 08:29:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

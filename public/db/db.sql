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
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

insert  into `activity_log`(`id`,`log_name`,`description`,`subject_type`,`event`,`subject_id`,`causer_type`,`causer_id`,`properties`,`batch_uuid`,`created_at`,`updated_at`) values 
(1,'default','created','App\\Models\\User','created',29,NULL,NULL,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@gmail.com\",\"password\":\"$2y$10$dk5\\/2qBnnMyO6Z8Uv7ORBuYPoxOzRLHT4wzkq\\/rzIPqIO\\/Z8oOdJe\",\"active\":0}}',NULL,'2023-10-02 07:49:00','2023-10-02 07:49:00'),
(2,'default','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@encore.com\",\"password\":\"$2y$10$2zoI5I6WXWLI2haGg\\/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe\",\"active\":1},\"old\":{\"name\":\"arpita\",\"email\":\"admin@mail.com\",\"password\":\"$2y$10$yRljs\\/zceTjd3cA323iv7.1zmM\\/9oq\\/i23S85bUDBXPAFizWcIGKq\",\"active\":1}}',NULL,'2023-10-02 11:50:43','2023-10-02 11:50:43');

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
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(31,'2023_10_02_120114_create_activities_table',19);

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
(2,'App\\Models\\User',17),
(2,'App\\Models\\User',18),
(2,'App\\Models\\User',19),
(2,'App\\Models\\User',27),
(2,'App\\Models\\User',28),
(3,'App\\Models\\User',2),
(3,'App\\Models\\User',3),
(3,'App\\Models\\User',21),
(3,'App\\Models\\User',22),
(3,'App\\Models\\User',23),
(3,'App\\Models\\User',24),
(4,'App\\Models\\User',9),
(4,'App\\Models\\User',11),
(4,'App\\Models\\User',12),
(4,'App\\Models\\User',20),
(5,'App\\Models\\User',7),
(5,'App\\Models\\User',13),
(5,'App\\Models\\User',15),
(5,'App\\Models\\User',25),
(6,'App\\Models\\User',10);

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(70,'activities.destroy','web','2023-10-02 12:14:31','2023-10-02 12:14:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`nrv`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Alverise Cream',256.89,1,1,'2023-10-02 11:33:11','2023-10-02 11:33:11'),
(2,'CLINRED-A GEL (TP)',84.21,1,1,'2023-10-02 11:34:00','2023-10-02 11:34:45');

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
(26,1),
(27,1),
(28,1),
(29,1),
(30,1),
(31,1),
(32,1),
(33,1),
(34,1),
(35,1),
(36,1),
(37,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(43,1),
(44,1),
(45,1),
(46,1),
(47,1),
(48,1),
(49,1),
(50,1),
(51,1),
(52,1),
(53,1),
(54,1),
(55,1),
(56,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(62,1),
(63,1),
(64,1),
(65,1),
(66,1),
(67,1),
(68,1),
(69,1),
(70,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'Admin','web','2023-08-21 18:50:12','2023-08-21 18:50:14'),
(2,'User','web','2023-09-01 11:04:15','2023-08-25 11:04:18'),
(3,'Client','web','2023-08-16 11:04:26','2023-08-16 11:04:29'),
(4,'Designer','web','2023-09-11 12:11:17','2023-09-11 12:11:17'),
(5,'Developer','web','2023-09-11 12:13:50','2023-09-11 12:13:50'),
(6,'Marketing','web','2023-09-12 10:27:23','2023-09-12 10:27:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`active`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'Admin','admin@encore.com',NULL,'$2y$10$2zoI5I6WXWLI2haGg/31eOpg2svsU0KXZiVBpESoNx0IZ.XYQGjWe',NULL,1,NULL,NULL,'2023-07-12 08:28:19','2023-10-02 11:50:43'),
(2,'shilpa','shilpa@mail.com',NULL,'$2y$10$YzWKCsKp7Fim/rYaZsKkV.Vdb8b6DKq8NFlrYgkgsT8HAbjgwcYzy',NULL,1,NULL,NULL,'2023-08-25 05:48:04','2023-09-18 08:43:27'),
(3,'Pranavi sarode','pranavi@laravel.com',NULL,'$2y$10$YzWKCsKp7Fim/rYaZsKkV.Vdb8b6DKq8NFlrYgkgsT8HAbjgwcYzy',NULL,0,NULL,1,'2023-08-25 05:49:04','2023-08-25 07:44:52'),
(7,'Vinod','vinod.s@sanmishatech.com',NULL,'$2y$10$ZzQl3q5rA4/vW4A6WMeGa.SHXld5qvVWuALv/xfXryovdRi1lB5G6','aoCIZYxrG1wCUBShxtI21xEx0iKOoX7Mo17FJTSUvlMprHyAC2wivzax1aio',1,NULL,NULL,'2023-08-28 07:50:03','2023-08-28 08:10:22'),
(9,'mithi','mithi.mehta@mail.com',NULL,'$2y$10$RzqMXM2GimIWtzecFCI87.VPLKuwrI.jZyINIBmGKSSn1//BUZRiu',NULL,1,NULL,NULL,'2023-09-11 08:14:12','2023-09-14 09:46:10'),
(10,'punit','punit1@mail.com',NULL,'$2y$10$JeAQEf.11jDje14sftIhZ.MoCmbMVYwtMBnxwJPm1P1SFuEojCvVi',NULL,1,NULL,NULL,'2023-09-11 10:19:26','2023-09-13 08:30:44'),
(11,'neha','neha@mail.com',NULL,'$2y$10$iA0Bjhly6n63TTIVO6v7GO4n.8vANLB6.fY6t65u5BhQNgJp6vLHm',NULL,1,NULL,NULL,'2023-09-11 11:20:02','2023-09-11 11:20:02'),
(12,'smita','smita@mail.com',NULL,'$2y$10$U4CinWgmj8gaW6KPingScOhk30.Ip0w0tud5yEnZhj.A8DpIjR5ZC',NULL,1,NULL,NULL,'2023-09-11 11:30:38','2023-09-11 11:30:38'),
(13,'nisha','nisha@mail.com',NULL,'$2y$10$wWwL6gYK0Wb0RQSG9.U.D.RxgV1tsdEZQT2j.KeFDibw9RxUK4m6K',NULL,1,NULL,NULL,'2023-09-11 11:47:02','2023-09-11 11:47:02'),
(15,'tejal','tejal@mail.com',NULL,'$2y$10$gfvR04ZchimpFidrXCHRrOr5Jlt9L.71HjL6ZzDi7UpWOZpM5TWdq',NULL,1,NULL,NULL,'2023-09-11 11:50:21','2023-09-11 11:50:21'),
(17,'mina','mina@mail.com',NULL,'$2y$10$T277SJ0MHjB8GggZ58VyOefYj06oJMDKHrjFVEbgdCXVjc.Y2ujDq',NULL,1,NULL,NULL,'2023-09-11 11:55:53','2023-09-11 11:55:53'),
(18,'ashwini','ashwini@mail.com',NULL,'$2y$10$K/tJzdiRZhzUqVz3mL497ueU6.TbMMRPAn/.e6nOi/HRp/wsJtOJi',NULL,1,NULL,NULL,'2023-09-11 11:57:16','2023-09-16 05:45:30'),
(19,'ashish','ashsih@mail.com',NULL,'$2y$10$DXB4yvx4WoRMY3bQZsN4buWeXpo1VGlepqphcq.0D0vT7H5FmSMke',NULL,1,NULL,NULL,'2023-09-11 12:02:23','2023-09-11 12:02:23'),
(20,'trupti','trupti@gmail.com',NULL,'$2y$10$Xsl2ArDU3Sc3r25vnuIrG.QOAedKZ.ZXZRt8XpK1r2LaQczD788iG',NULL,1,NULL,NULL,'2023-09-13 15:55:31','2023-09-13 15:55:31'),
(21,'rita','rita@mail.com',NULL,'$2y$10$n61jH.Rt92eVu0ZoCsTMJu7Orwr4d84Z4S1EaDVd45qjt1XJsV54K',NULL,0,NULL,NULL,'2023-09-13 16:07:38','2023-09-13 16:08:26'),
(22,'vasudha','vasudha@mail.com',NULL,'$2y$10$aNp41JTqhL1jFR03wDQ8jegZ/MUQ7G0jQ7W3BBs4cuu055UQBaGvC',NULL,1,NULL,NULL,'2023-09-14 10:03:38','2023-09-23 10:16:40'),
(23,'kavita','kavita@mail.com',NULL,'$2y$10$jGs8AOh2NylyK6MRPrxAT.I7INNGiKlfi2mW77NK64B3GrsG7q6Sm',NULL,1,NULL,NULL,'2023-09-15 10:06:01','2023-09-16 05:45:49'),
(24,'rashmi','r@laravel.com',NULL,'$2y$10$ir2A3wK00hp8QesEb1GtQuHA4Pbd2o5.5bdnAxF.DW9501qYgHcgi',NULL,1,NULL,NULL,'2023-09-15 10:07:43','2023-09-15 10:07:43'),
(25,'pooja','poojan@gmail.com',NULL,'$2y$10$athsXAra.SBHZXKDjY/STuDuf0jhyxFllbEXdvWjLtmYBNaFi3hR6',NULL,1,NULL,NULL,'2023-09-16 09:50:34','2023-09-16 09:51:22'),
(27,'Nandini','nandini@mail.com',NULL,'$2y$10$cF9Ozo9syNyobdGXFhPmveIU9bcC/StlPkP/ue2sSD2ueUZQAP15q',NULL,1,NULL,NULL,'2023-09-23 07:19:12','2023-09-23 07:19:12'),
(28,'Rishabh','rishabh@mail.com',NULL,'$2y$10$wDwQOgmv8Dm/vS2rG0T.J.haxhTrv5iKhPRMfoFyS6S2k5mx4SGwm',NULL,0,NULL,NULL,'2023-09-23 08:26:05','2023-09-23 08:33:08'),
(29,'Admin','admin@gmail.com',NULL,'$2y$10$dk5/2qBnnMyO6Z8Uv7ORBuYPoxOzRLHT4wzkq/rzIPqIO/Z8oOdJe',NULL,0,NULL,NULL,'2023-10-02 07:49:00','2023-10-02 07:49:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

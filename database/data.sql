-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.36 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para echamelamano
CREATE DATABASE IF NOT EXISTS `echamelamano` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `echamelamano`;

-- Volcando estructura para tabla echamelamano.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  `cat_status` varchar(1) DEFAULT NULL,
  `cat_uuid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.category: 5 rows
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`cat_id`, `cat_name`, `cat_status`, `cat_uuid`) VALUES
	(1, 'Cliente', 'A', 'ed62df7b-02a7-4e81-83ca-02f0311cf001'),
	(2, 'Cliente Basico', 'A', '4a96626c-07c5-4767-a13e-35eb27dce5d8'),
	(3, 'Cliente Premium', 'A', 'c7089ee0-aab1-4686-a38f-22c41f144e37'),
	(4, 'Test', 'A', '44ca8dca-f0f0-4656-8c84-7e33460f5939'),
	(5, 'Test2', 'A', 'ea446f75-c5ee-4f48-9f06-42a77870761b');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `uuid` varchar(50) NOT NULL DEFAULT '',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(13) NOT NULL,
  `andress` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(150) DEFAULT NULL,
  `validate` varchar(1) DEFAULT NULL,
  `id_category` varchar(90) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `rang` varchar(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suscription` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__category` (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.clients: 1 rows
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`uuid`, `id`, `email`, `phone`, `andress`, `description`, `validate`, `id_category`, `photo`, `rang`, `active`, `name`, `last_name`, `suscription`) VALUES
	('wiqeujiwq', 1, 'test@gmailc.om', 'sin numero', 'dwdw', 'dwdwd', '1', '0', 'd', '0', 1, 'Jhon', 'Doe', NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `comments_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `publications_id` bigint(20) DEFAULT '0',
  `id` bigint(20) DEFAULT '0',
  `content` text,
  `id_user_comments` text,
  `reactions` bigint(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.comments: 0 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla echamelamano.failed_jobs: 0 rows
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla echamelamano.migrations: 4 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla echamelamano.password_resets: 0 rows
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla echamelamano.personal_access_tokens: 0 rows
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.publications
CREATE TABLE IF NOT EXISTS `publications` (
  `publications_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `reactions` bigint(20) NOT NULL DEFAULT '0',
  `id_user` varchar(100) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `uuid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`publications_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.publications: 2 rows
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` (`publications_id`, `status`, `content`, `reactions`, `id_user`, `date`, `uuid`) VALUES
	(1, 1, 'mI PRIMERA PUBLICACIONE', 10, 'wiqeujiwq', '2023-02-09 22:36:54', 'wewe'),
	(2, 1, 'Hola mundo', 1, 'wiqeujiwq', '2023-02-08 22:46:37', 'ewewew');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.sub_category
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(50) DEFAULT NULL,
  `sub_status` varchar(50) DEFAULT NULL,
  `id_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.sub_category: 1 rows
/*!40000 ALTER TABLE `sub_category` DISABLE KEYS */;
INSERT INTO `sub_category` (`id_sub`, `sub_name`, `sub_status`, `id_category`) VALUES
	(1, 'sub1', 'A', '1');
/*!40000 ALTER TABLE `sub_category` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.suscription
CREATE TABLE IF NOT EXISTS `suscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL DEFAULT '0',
  `limit_publilications` int(11) NOT NULL DEFAULT '0',
  `limit_user` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `lag` int(11) NOT NULL DEFAULT '0',
  `log` int(11) NOT NULL DEFAULT '0',
  `setting_one` int(11) NOT NULL DEFAULT '0',
  `setting_two` int(11) NOT NULL DEFAULT '0',
  `setting_tree` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.suscription: 0 rows
/*!40000 ALTER TABLE `suscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `suscription` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla echamelamano.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@echamelamano.com', NULL, '$2y$10$yV2VhL7NauiKEKntl3.UDOMhAty1gIBY9j1UdoMzlXvngpaZxGC..', 'lrKAmhp7UqkkEI0C5ZwOZ1IdUoUmghJVBhUelbjic1rjaaOurXPLWXJ2re3E', '2022-11-25 14:09:14', '2022-11-25 14:09:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla echamelamano.views
CREATE TABLE IF NOT EXISTS `views` (
  `id_view` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `state` varchar(1) DEFAULT NULL,
  `nameTable` varchar(50) DEFAULT NULL,
  `database1` varchar(50) DEFAULT NULL,
  `database2` varchar(50) DEFAULT NULL,
  `nameTable2` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `join` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_view`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla echamelamano.views: 1 rows
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` (`id_view`, `name`, `url`, `state`, `nameTable`, `database1`, `database2`, `nameTable2`, `id_user`, `join`) VALUES
	(1, 'categorias', 'categorias', 'A', 'Categorias Lista', 'category', 'sub_category', 'Sub Categorias', NULL, 1);
/*!40000 ALTER TABLE `views` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

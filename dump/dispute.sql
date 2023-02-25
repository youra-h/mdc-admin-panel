-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.19 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица guffi.i18n_category
CREATE TABLE IF NOT EXISTS `i18n_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descr` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы guffi.i18n_category: ~3 rows (приблизительно)
INSERT INTO `i18n_category` (`id`, `name`, `descr`, `parent_id`, `status`) VALUES
	(1, 'backend', NULL, NULL, 1),
	(2, 'login', NULL, 1, 1),
	(3, 'main', NULL, 1, 1);

-- Дамп структуры для таблица guffi.i18n_locale
CREATE TABLE IF NOT EXISTS `i18n_locale` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `locale` (`locale`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы guffi.i18n_locale: ~2 rows (приблизительно)
INSERT INTO `i18n_locale` (`id`, `code`, `locale`, `name`, `status`) VALUES
	(1, 'ru', 'ru-RU', 'Русский', 1),
	(2, 'en', 'en-EN', 'English', 1);

-- Дамп структуры для таблица guffi.i18n_message
CREATE TABLE IF NOT EXISTS `i18n_message` (
  `source_message_id` int NOT NULL,
  `locale_id` int NOT NULL,
  `translation` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`source_message_id`,`locale_id`),
  KEY `fk_locale_id_to_locale` (`locale_id`),
  CONSTRAINT `fk_locale_id_to_locale` FOREIGN KEY (`locale_id`) REFERENCES `i18n_locale` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_source_message_id_to_source_message` FOREIGN KEY (`source_message_id`) REFERENCES `i18n_source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы guffi.i18n_message: ~18 rows (приблизительно)
INSERT INTO `i18n_message` (`source_message_id`, `locale_id`, `translation`) VALUES
	(1, 1, NULL),
	(1, 2, NULL),
	(2, 1, NULL),
	(2, 2, 'Control panel'),
	(3, 1, NULL),
	(3, 2, NULL),
	(4, 1, NULL),
	(4, 2, NULL),
	(5, 1, NULL),
	(5, 2, NULL),
	(6, 1, NULL),
	(6, 2, NULL),
	(7, 1, NULL),
	(7, 2, NULL),
	(8, 1, NULL),
	(8, 2, NULL),
	(9, 1, NULL),
	(9, 2, NULL);

-- Дамп структуры для таблица guffi.i18n_source_message
CREATE TABLE IF NOT EXISTS `i18n_source_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы guffi.i18n_source_message: ~9 rows (приблизительно)
INSERT INTO `i18n_source_message` (`id`, `category`, `message`, `status`) VALUES
	(1, 'backend/login', '{name-project} - вход в панель управления', 1),
	(2, 'backend/login', 'Панель управления', 1),
	(3, 'backend/login', 'Введите логин', 1),
	(4, 'backend/login', 'email | логин', 1),
	(5, 'backend/login', 'Введите пароль', 1),
	(6, 'backend/login', 'Запомнить меня', 1),
	(7, 'backend/login', 'Войти', 1),
	(8, 'backend/login', 'Проверка данных', 1),
	(9, 'backend/main', '{name-project} - Панель управления', 1);

-- Дамп структуры для таблица guffi.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы guffi.message: ~18 rows (приблизительно)
INSERT INTO `message` (`id`, `language`, `translation`) VALUES
	(1, 'en-EN', NULL),
	(1, 'ru-RU', NULL),
	(2, 'en-EN', 'Control panel'),
	(2, 'ru-RU', NULL),
	(3, 'en-EN', NULL),
	(3, 'ru-RU', NULL),
	(4, 'en-EN', NULL),
	(4, 'ru-RU', NULL),
	(5, 'en-EN', NULL),
	(5, 'ru-RU', NULL),
	(6, 'en-EN', NULL),
	(6, 'ru-RU', NULL),
	(7, 'en-EN', NULL),
	(7, 'ru-RU', NULL),
	(8, 'en-EN', NULL),
	(8, 'ru-RU', NULL),
	(9, 'en-EN', NULL),
	(9, 'ru-RU', NULL);

-- Дамп структуры для таблица guffi.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы guffi.migration: ~4 rows (приблизительно)
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1603801501),
	('m130524_201442_init', 1603801503),
	('m150207_210500_i18n_init', 1608376434),
	('m190124_110200_add_verification_token_column_to_user_table', 1603801504);

-- Дамп структуры для таблица guffi.source_message
CREATE TABLE IF NOT EXISTS `source_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы guffi.source_message: ~9 rows (приблизительно)
INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
	(1, 'backend/login', '{name-project} - вход в панель управления'),
	(2, 'backend/login', 'Панель управления'),
	(3, 'backend/login', 'Введите логин'),
	(4, 'backend/login', 'email | логин'),
	(5, 'backend/login', 'Введите пароль'),
	(6, 'backend/login', 'Запомнить меня'),
	(7, 'backend/login', 'Войти'),
	(8, 'backend/login', 'Проверка данных'),
	(9, 'backend/main', '{name-project} - Панель управления');

-- Дамп структуры для таблица guffi.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы guffi.user: ~102 rows (приблизительно)
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
	(8, 'admin', 'aFTjiW3RsF6YOXYdbYIPn87P0NiJCt7U', '$2y$13$RoRREDdWtQ1aL2emoRKNUul.ELgSfO2qC5Ta70b7fm9N9iEoFC1ea', NULL, 'admin@example.ru', 10, 1603803813, 1603803813, NULL),
	(9, 'user', 'aFTjiW3RsF6YOXYdbYIPn87P0NiJCt7U', '$2y$13$RoRREDdWtQ1aL2emoRKNUul.ELgSfO2qC5Ta70b7fm9N9iEoFC1ea', NULL, 'user@example.ru', 10, 1603803813, 1603803813, NULL),
	(10, 'Johnathon', 'nNeGnBp81y-sAQB86EhSkVy1Z9mFFqY7', '$2y$13$HMr7x4bwQJWPNcgMDaQdHeFfpue7LjfY99D95I552e5JAWDKsXS3i', NULL, 'Johnathon@example.ru', 10, 1613557691, 1613557691, NULL),
	(11, 'Anthony', 'Xwibi5jYqYEnLfPZr_vbgmcodv2fnmxh', '$2y$13$tFhxwVHzxylU0feqpHK9C.CWuYvbtZ768.pcgpV2o9X6ZU/eGpfNO', NULL, 'Anthony@example.ru', 10, 1613557691, 1613557691, NULL),
	(12, 'Erasmo', 'o0WBiEknAlUTrnwXkM8hoTfWGu-DLPf8', '$2y$13$LTAODtN9fHr221JhL17wF.wbOKCpnAVzT7tUBxXrFQW7bhnjwtIOO', NULL, 'Erasmo@example.ru', 10, 1613557692, 1613557692, NULL),
	(13, 'Raleigh', 'pACY_ute9-pU-gUYB4uXWx2x2mZkByB_', '$2y$13$uGOfW761L.DLJrmvYPCrJeQBhrEl2q1kFPDui0E3VZ9NqcKIZmYzS', NULL, 'Raleigh@example.ru', 10, 1613557693, 1613557693, NULL),
	(14, 'Nancie', 'TAu00r7wPGPaDRTB3p-0LNLzvXikMQtp', '$2y$13$8YYREh7QY9Yec6cggFzAR.ZDOMkD7bWqDMjrFm4uNNTK4E4UocvRW', NULL, 'Nancie@example.ru', 10, 1613557693, 1613557693, NULL),
	(15, 'Tama', 'TOgFcUquV8xxXZTRbOaUrmDcVw7DbbNE', '$2y$13$duj2zxs6ODQxtJmGkU/DcO0PEYSOo4UY6X6WgQ5wJHB9fRkkEyACS', NULL, 'Tama@example.ru', 10, 1613557694, 1613557694, NULL),
	(16, 'Camellia', '1YodANdV9_4xeaxvreL1kiPnQlRQduL7', '$2y$13$Fp0/88Rp67PAOGkaNDI6fOhtpBKJyu1ZQFXJuhfLjlzVENc19CC2W', NULL, 'Camellia@example.ru', 10, 1613557695, 1613557695, NULL),
	(17, 'Augustine', 'gucDlaYKKULUibcxZpM_pa9f4G7bvL5K', '$2y$13$mMTsfc3xa7x80qy5cmPQ2eGV6WCftxoKlcanOBiVeOdfq4FWwrv02', NULL, 'Augustine@example.ru', 10, 1613557696, 1613557696, NULL),
	(18, 'Christeen', 'iFJKwNJf_T7uu_kC5B0d_TidyEvI-YET', '$2y$13$/.6qLC/RwWjTLcEheeUQqOhBu5eLfXNXkyezdveYqGrHwRTB1kIpy', NULL, 'Christeen@example.ru', 10, 1613557696, 1613557696, NULL),
	(19, 'Luz', 'DyqrX4p1dAfY7iN87KvwHMyoaiOCfFwu', '$2y$13$mhCQlNyTX9m//ykl/FY6COa/CWO5VUAsWcZNrzPtpvOeH5p0hHwCK', NULL, 'Luz@example.ru', 10, 1613557697, 1613557697, NULL),
	(20, 'Diego', 'Gocv67Gc_7ocDN0tCCknUrGJ19zvWP7Q', '$2y$13$SpxaiiFaWFe4e5a4DxMCP.ac7SXQqZKR5gn7kGJzHIskZ33KsOi26', NULL, 'Diego@example.ru', 10, 1613557698, 1613557698, NULL),
	(21, 'Lyndia', 'Hl5hMYCDlgKP7cmek_JZWa1L09z610Ka', '$2y$13$MZoFSi1pfNHfn0E2oZvZMuLcMcA.E3tLD7w1sw47i2OfzupnF2BxC', NULL, 'Lyndia@example.ru', 10, 1613557698, 1613557698, NULL),
	(22, 'Thomas', 'T2soSaTaPQGhWljUbVpg0w5Hlmet_mtc', '$2y$13$bgl8Hoys7UFJTM6UIJ7VMe5ORqDBrGSlBX8hu11MvIv2muSrNzGOm', NULL, 'Thomas@example.ru', 10, 1613557699, 1613557699, NULL),
	(23, 'Georgianna', '00JVH6kcdY3gJ8AvJoLapD6B44tZbJze', '$2y$13$kMppYvKQKDn0t8AIbCtMo.5IM2TeC6a/jEe85Ct62c8ODN.PIZPFm', NULL, 'Georgianna@example.ru', 10, 1613557700, 1613557700, NULL),
	(24, 'Leigha', 'IjWAesnjd7PsBld7XexzOyrH2IdzFYDf', '$2y$13$uldpCNrXTJQKQ4dfsrWa5e3PDEuBZUG4cRd1zD3nkYXmW.S0l3oh.', NULL, 'Leigha@example.ru', 10, 1613557700, 1613557700, NULL),
	(25, 'Alejandro', '-xKvc9FF7Wsj4FtPp2PG9nrNg2X28did', '$2y$13$N5W/QXhwxZAKYDWid7CETOJywED3mH2Vt3.feb.P0vmvDdo1CW2Zy', NULL, 'Alejandro@example.ru', 10, 1613557701, 1613557701, NULL),
	(26, 'Marquis', 'yLUN1Nm6BfjjqaOAu2Z4qP8KkUyUWAdI', '$2y$13$LyFKoKuFTpn5tuOMY11w8OpbGsXBDhItzXyW/8KROv.LlXkah5Sye', NULL, 'Marquis@example.ru', 10, 1613557702, 1613557702, NULL),
	(27, 'Joan', 'QarMN4AxYQET6B2zZ5X73nk8Pd7eel1X', '$2y$13$OZ5LNmRoyrJqy0M.mYYZn.AL8fmhjUiRrUiEizk3C/GiuX//1rOJa', NULL, 'Joan@example.ru', 10, 1613557702, 1613557702, NULL),
	(28, 'Stephania', 'OUTaU7kltsG-wJr1LvlXgQ6eVR6tied1', '$2y$13$xOulZfRXGOVsXY4UKhrhe.8iDWAH4mxmSa01r.OHmlOMo4DB6oJa2', NULL, 'Stephania@example.ru', 10, 1613557703, 1613557703, NULL),
	(29, 'Elroy', 'rQppnmW3GjKSkidhJZ4tSXTp3zkbsbGN', '$2y$13$z50Foc/mTmc96HqAlbVciui4E2rn19jBxxG5TRc3zLUkJLJFxDXMe', NULL, 'Elroy@example.ru', 10, 1613557704, 1613557704, NULL),
	(30, 'Zonia', 'hosKnTBYKnNnCMSCnJwyeOnPjHrB7n_g', '$2y$13$12u2wO/F1PQ/Va3X.O2caO7GE0mZHQP4e72rR65pReDheWy7l2HYe', NULL, 'Zonia@example.ru', 10, 1613557704, 1613557704, NULL),
	(31, 'Buffy', 'clrmB0QZpidG6NqPPilTcOVLGYSdB2Ms', '$2y$13$nOeS1AmsE1.XqQsHcPrkHOSk38C6Pir.cdQcPOl3IjKVvo8w.qD9q', NULL, 'Buffy@example.ru', 10, 1613557705, 1613557705, NULL),
	(32, 'Sharie', 'E-FoGO_VCJsYu1vPkfJ_Jw9TtqoO_qFv', '$2y$13$Tx4GMpmgJiKkfpxEuJKwI.p5CVdDPjY2mh2HKKpLSV1C7dJkjDQYS', NULL, 'Sharie@example.ru', 10, 1613557706, 1613557706, NULL),
	(33, 'Blythe', 'XJpeAnirqEoglCt9cNDDgV2mRgiaZt6P', '$2y$13$zuEBmQILkcYEqg6NCKWCz.LG1PrPrkRqdrci9urkIiQ6Gfa2fopSC', NULL, 'Blythe@example.ru', 10, 1613557706, 1613557706, NULL),
	(34, 'Gaylene', '4nwJu-j0G6X6vRnxAnwLZm4z1ZOM5QlU', '$2y$13$CpRwZqkDBU/IZSB2iJiHF.eZqKlHuuOjKaweU0ZZcxdPcjwUdTWvi', NULL, 'Gaylene@example.ru', 10, 1613557707, 1613557707, NULL),
	(35, 'Elida', 'RqTSRUlFDw7QvGwjchZ33jjwFrxbeyJg', '$2y$13$zm.A7N7PYucxAOkNZpiX5.ceZg8eC/dCh7GiDQYmvx1dFV2i.LAtO', NULL, 'Elida@example.ru', 10, 1613557708, 1613557708, NULL),
	(36, 'Randy', '2Iok4csMWCqiptjo8KgrUH66myh8Z_xv', '$2y$13$0GiY6lx1l2ikEh1QT4KNJuZqQv9zyYv8K44wWB94AS/xI89HHqr7O', NULL, 'Randy@example.ru', 10, 1613557708, 1613557708, NULL),
	(37, 'Margarete', 'a1G4zrn9t3kJ4h5xJD0SkA4QI59BM8nY', '$2y$13$0uSdH9Em1oAUTXKnun1R2uk4DbaVTkeS70WLxmGNFIxlk34GdfJV6', NULL, 'Margarete@example.ru', 10, 1613557709, 1613557709, NULL),
	(38, 'Margarett', '__BMNoB0oPFAJgmOp6jOPSS8AJypl7Ia', '$2y$13$sUH4lucm1q0eCe4iBAil..ljUuUWsCdBPVNXHPmM/lNx.LmJ.R9Y2', NULL, 'Margarett@example.ru', 10, 1613557710, 1613557710, NULL),
	(39, 'Dion', 'FUPLWWnwcG2ABmuosBeblzs9-4iPrOPO', '$2y$13$d6j/pSfJLVIrMcWHF/Uo2Ov/fbdRAy1xgZ21n6UuuC1FxL2e.KXGO', NULL, 'Dion@example.ru', 10, 1613557711, 1613557711, NULL),
	(40, 'Tomi', 'FEQrkx1873HY6BZwKXuYSQa21aJBY43T', '$2y$13$xeOfcqp9k2B5Wr702z18R.tJJXCX9HXmONkLr.fJWLCwCtDc6tWZm', NULL, 'Tomi@example.ru', 10, 1613557711, 1613557711, NULL),
	(41, 'Arden', 'rri3lCAYhXlDcNEEbf745v9rVlbOIHSm', '$2y$13$FtCpenGwM0wycbhEeLYGgOVUvFJjT69sepDsxIWCrhkobyYvjfCou', NULL, 'Arden@example.ru', 10, 1613557712, 1613557712, NULL),
	(42, 'Clora', '4NOVYOwtfN0JlTDhSQfij3bvm105UNse', '$2y$13$JKrVbMnoUoFc58IfFH.ct.bitt4zLgTThD7bOiqIV9rOz/tBwyYpm', NULL, 'Clora@example.ru', 10, 1613557713, 1613557713, NULL),
	(43, 'Laine', 'eGDSnYx7oHB_Bj6-q97XV5UcWH5eVPTy', '$2y$13$917d3AtZTaR7hvSAZnurA.VwF9oHoNW/w1avtZ52XKZA3oquzNSx.', NULL, 'Laine@example.ru', 10, 1613557713, 1613557713, NULL),
	(44, 'Becki', '5xQaZlxF8l5Q0H-1EttWuCaKJgh6YJZx', '$2y$13$Igxqc5NMZYS72V74Gosm5e/umpYjw/ywVl9q.8tqSUh/PjB/BBR6G', NULL, 'Becki@example.ru', 10, 1613557714, 1613557714, NULL),
	(45, 'Margherita', 'lNyZO8wEo5rFOEekC0rt1ifePtCMenNC', '$2y$13$30QM321qonkEHu2N17K2UuL/BNfLH3z.oVo4LeeFhnms6pXaO6TG.', NULL, 'Margherita@example.ru', 10, 1613557715, 1613557715, NULL),
	(46, 'Bong', 'qqx5kLMlnBPQ5oC9XzuwNu9gKUuUncnK', '$2y$13$MRWf4U4c8Nm57KbXaPAJJOXhRAIPv9vfI1PIy3vMtc7GvUye03/uW', NULL, 'Bong@example.ru', 10, 1613557715, 1613557715, NULL),
	(47, 'Jeanice', '6TfvmXWZrr_XE4cppgZ-jyT02XO-DsGv', '$2y$13$nRvB9PAvjVlohQkBSAAyUeLr2I4SUre6U5RZ5INMx3KuM7WiFE3ia', NULL, 'Jeanice@example.ru', 10, 1613557716, 1613557716, NULL),
	(48, 'Qiana', 'eed3R9nF4il3u_Gx_HocQLicsdmYLLN7', '$2y$13$gJtBe36fZ/n8tgaiMVLO9.hW2BAi18IcTFAdeFyPFC7l6/eopJ9la', NULL, 'Qiana@example.ru', 10, 1613557717, 1613557717, NULL),
	(49, 'Lawanda', 'B6pYj3wNFARIIVgtNU009aNPYV8WoLBC', '$2y$13$HLTODknG//oXG5WrXpPez.GDA18Q8N8jQE.Vfc1Bf1Q9222H3DKRW', NULL, 'Lawanda@example.ru', 10, 1613557717, 1613557717, NULL),
	(50, 'Rebecka', 'r851g79DZ9y7TFEg9Jad22SKG9KBoZ3U', '$2y$13$Mpej2M3eo4us7GSqEraeHOvdhisWIptRIqs87SidhTOtiK92QKUhe', NULL, 'Rebecka@example.ru', 10, 1613557718, 1613557718, NULL),
	(51, 'Maribel', 'UBhaI57KQfubbae-GapoPaiR5Ex2ID9p', '$2y$13$wJquZ6152ZTUcnc2z1tQg.Icxlx7mimXW06DVYuFZYqfFm9TKpzKy', NULL, 'Maribel@example.ru', 10, 1613557719, 1613557719, NULL),
	(52, 'Tami', 'yZboNy4ZTssaIqDFQbbV9d-_2mtF7hT3', '$2y$13$dc72IfZkNbPu6On2WNqk9usPinCyQO9VJLcU5AZGA4LhChc2UTqBC', NULL, 'Tami@example.ru', 10, 1613557719, 1613557719, NULL),
	(53, 'Yuri', 'Qf6d0zTzFiCwuU9dMEOwsEtFvCBWo1ZO', '$2y$13$lVgpoe8NReT9BVA0LAII.u9BYSYatewCqRiHr417vHpn/tbPwBz6.', NULL, 'Yuri@example.ru', 10, 1613557720, 1613557720, NULL),
	(54, 'Michele', 'TbMjaYGT_KtWNZwebtbQK8ofZ3JPw2Gw', '$2y$13$lJApzA2K0GOmdTNd.JVIweZu./8DTgWYrLB1EDjK/NGZARjEJaluu', NULL, 'Michele@example.ru', 10, 1613557721, 1613557721, NULL),
	(55, 'Rubi', 'F2ogjNs-pPj2Vt7QpasXTPO_c3IjJpQS', '$2y$13$WIIuIYFlM.L/Dl0Gp/A0n.H7Lbn1HiFFAvlTVcHDsjcJ7MBiQgtfW', NULL, 'Rubi@example.ru', 10, 1613557722, 1613557722, NULL),
	(56, 'Larisa', 'U4V5ECvToX4YXYG7mzx2xHpyrfmGwcUd', '$2y$13$GgoTV8aPN0TOujzec1Ug3efxwluflV8bA2rG3..uRjuffKQY0LylO', NULL, 'Larisa@example.ru', 10, 1613557722, 1613557722, NULL),
	(57, 'Lloyd', 'hv6FQJr61KAQiHvLzCfxGXNqS1BNQmxS', '$2y$13$e9f2Sx15V.6ID0.4bj0/EulZJeOMVQrM0y5SfGD17wOT3xuDIZH6u', NULL, 'Lloyd@example.ru', 10, 1613557723, 1613557723, NULL),
	(58, 'Tyisha', 'XWWIgofNFqWV0Ob9eyD_kt9fISkhSZ6u', '$2y$13$SW9ATEUqdNM91DyNHps/GeYHNz9iqe1aWChlLb7V0/hLR7IYyg3ka', NULL, 'Tyisha@example.ru', 10, 1613557724, 1613557724, NULL),
	(59, 'Samatha', 'MDvunyoKFIg9AXtoM9TrgEGyoI7kSOk3', '$2y$13$pvCokPkD69LXXKKSgmYc6uxXscOje1d.yfekMSrzkeekTR9313tG.', NULL, 'Samatha@example.ru', 10, 1613557724, 1613557724, NULL),
	(60, 'Mischke', 'fuIQhph3UIhyiT2Wq_eqz7Ifuq3jVHPX', '$2y$13$KjrLRG764rOypyj5aH/PXODuefqxwY7Kx9dhj8Vn8z1xHXigCpHo2', NULL, 'Mischke@example.ru', 10, 1613557725, 1613557725, NULL),
	(61, 'Serna', 'nrhpIhmRVA2Y8o4rX6m5MUvrTqEZMRGK', '$2y$13$lwQoVOqeE5l0ksOjMZ1.fe7iIhDkqR7qZTZHFzoRfSUGLuLN7DsXO', NULL, 'Serna@example.ru', 10, 1613557726, 1613557726, NULL),
	(62, 'Pingree', 'CN40mEzuEN0F41Ilz30l5O79FBq9TQbi', '$2y$13$OHCqyOWrZzDwOFBMpQ0.HOK5Q4IvpZveZVW5mmvuPLY3ZTa0hy5hm', NULL, 'Pingree@example.ru', 10, 1613557726, 1613557726, NULL),
	(63, 'Mcnaught', 'FOiXwbKdxAEE6VDfMKsSyZbA3rwyNidh', '$2y$13$RtPyVS23j/FwaeVB6IPP6OQp.LtIT5hENsnbWI5cNXkI3gLWwfqeK', NULL, 'Mcnaught@example.ru', 10, 1613557727, 1613557727, NULL),
	(64, 'Pepper', 'xWgNoEgZ5TloqYzDnDqzuOtEez2rKKWi', '$2y$13$qQp9GB9QqRCVjgA252TSfO9//PNQ4iKJiJQlJwBAk6Hd.WPbDYHsi', NULL, 'Pepper@example.ru', 10, 1613557728, 1613557728, NULL),
	(65, 'Schildgen', 'sNo18ysuJWiyVLbeyRfXsUUjqmYLilxv', '$2y$13$XunJwJpwbNbpamT2Ty0aieoyV048LJEUK3p77GLJn5dnIen/.k7fy', NULL, 'Schildgen@example.ru', 10, 1613557728, 1613557728, NULL),
	(66, 'Mongold', 'RdeNTn7FPhHIVCzaLVxC8jZKnK9czAap', '$2y$13$3yi8WOqCEODiyDz92jego.1HYMQSOGkGJ5/z1V3YXJIF3fSYLBB4O', NULL, 'Mongold@example.ru', 10, 1613557729, 1613557729, NULL),
	(67, 'Wrona', '8OA9X3dRFoPudAk2krMYsat6mbc5D0-z', '$2y$13$q0OZmzmVTY7Cx5TKEi1Spe33LyhY7qk05GUhS5XELCK7v5UyL4hZS', NULL, 'Wrona@example.ru', 10, 1613557730, 1613557730, NULL),
	(68, 'Geddes', '4HT_ER9ljzjBU0DCdQp55vuqoVHRGEXy', '$2y$13$xeUTfrMXUoUZS1z8adWNQu0TTxBAzAIvDtuoWyfpfdxZ2eFptgNDe', NULL, 'Geddes@example.ru', 10, 1613557730, 1613557730, NULL),
	(69, 'Lanz', 'K9j7VzeAGcOvWRpMDWX0Xz359H10U6bw', '$2y$13$dVa18Mu9uTIFVtmg9zTlzuGT/6wm/ZXuXPNXYZQ7VwnegNjtaNH2.', NULL, 'Lanz@example.ru', 10, 1613557731, 1613557731, NULL),
	(70, 'Fetzer', 'qLuIztCo4SfvL6lrsQm4mm5fov_7nLcF', '$2y$13$KgstPbpP8J2kIV6uRFyaKuGpdq62oPGVTf2SsTTNY/yw7aX21UbSC', NULL, 'Fetzer@example.ru', 10, 1613557732, 1613557732, NULL),
	(71, 'Schroeder', 'qqRlgf8RNo0cf26qb2WQvpz3oV6L4Ag2', '$2y$13$bdSABLIuXOpjQuvs8XQeK.z9vSzy3Fcpe5dFWT.legzKNixRKoGcK', NULL, 'Schroeder@example.ru', 10, 1613557732, 1613557732, NULL),
	(72, 'Block', 'J8PPIzKdLj6_U96urnWuoivA7ZEe-fNh', '$2y$13$1MpDUNMC8XiL8GxSWJsbJe06lUUxCRNa7ZEsIGljjn5ixmm1.1yy2', NULL, 'Block@example.ru', 10, 1613557733, 1613557733, NULL),
	(73, 'Mayoral', 't0NiHLWzuUSVtpGpF0QTuMh7kWmanWzJ', '$2y$13$U2Zh0A0BXwYnHAiJobeIJezR5ULzy1nGOfIMZxvaqNyXhlHmCJtgS', NULL, 'Mayoral@example.ru', 10, 1613557734, 1613557734, NULL),
	(74, 'Fleishman', 'eCNrpOeagIeztOiEBEMOQRXb2iBJIWRU', '$2y$13$oO0rUnhnAb59MCKQwq/.mu1.g0VBkci8ZJ4xOL7Hzxi1ZvjnjzIL.', NULL, 'Fleishman@example.ru', 10, 1613557735, 1613557735, NULL),
	(75, 'Roberie', 'UgpltCobzbH8unZ2K0UkGxiBJmdOogwO', '$2y$13$klGEcMEF.ishRuCiP/kOjOkEgA/ZXl6XK00vXAqsWIT5Rc/H8gSge', NULL, 'Roberie@example.ru', 10, 1613557735, 1613557735, NULL),
	(76, 'Latson', 'w-8GWwbwXbAmpy_LlXbmAUH76wm06DDX', '$2y$13$aaJU6OrX.X6xuJyH11kwFuN9pU8qsbpdDkKSszAqqb3FWG/UmTIfy', NULL, 'Latson@example.ru', 10, 1613557736, 1613557736, NULL),
	(77, 'Lupo', 'raLx-I8uu66bUBki7aFyfDmCrVZFohFw', '$2y$13$tlS2J.EYDTHPPp1c5.3e8OEslEktNJ0XRkJMACb9bVi2gQzE.u102', NULL, 'Lupo@example.ru', 10, 1613557737, 1613557737, NULL),
	(78, 'Motsinger', 'cEMjRKX7XThBE1nVkIYKq82F6z_OtV5R', '$2y$13$fXm3SkjgjpVPmNszFVR2l.PRXsJO4qu/mQ1BGjmRiCttrM0kbNWhi', NULL, 'Motsinger@example.ru', 10, 1613557737, 1613557737, NULL),
	(79, 'Drews', '9baLNB_24ZLx_k0VKsvhdZG0G0vA5Dxz', '$2y$13$6U6kByblKwo8M6S5KW2S9u7cKj6HXHmlZnllHCjmqR8RTZsTvksSS', NULL, 'Drews@example.ru', 10, 1613557738, 1613557738, NULL),
	(80, 'Coby', '1beBqQdcN7fpXLMgbGBdJvgAAF2qWoDw', '$2y$13$TmxfRLdf/tlgzCxMgtM/2.U2Zlq.B2M59L5WKMKvnQBxMB1q7j7YS', NULL, 'Coby@example.ru', 10, 1613557739, 1613557739, NULL),
	(81, 'Redner', 'ipE93smQxdWb2XoumOUpSVu_gIjYNu8m', '$2y$13$hQhHP3IxSoJfi7xB935lXeim5xW4q9DPNw/l92ajsCrS8LXxOIJDO', NULL, 'Redner@example.ru', 10, 1613557739, 1613557739, NULL),
	(82, 'Culton', 'BJHb-e6x10FjKenxFtwTnqEaZqp2C50j', '$2y$13$8mgOZX/PoGn6G0/PfJbDZ.cWgqWgyVc8NidCQ2jbw5KRNmLXdQXj6', NULL, 'Culton@example.ru', 10, 1613557740, 1613557740, NULL),
	(83, 'Howe', 'Vzd5CEn5JFb3g3JFQ0OxgHHJOnrju8bG', '$2y$13$5dktok459Imth35epATahegiRciAyYGTD4V3fozauecHMVSjXup/6', NULL, 'Howe@example.ru', 10, 1613557741, 1613557741, NULL),
	(84, 'Stoval', 'CMr1k9r2zKtb6n2BE-4R_2euDGdedSGN', '$2y$13$vYagQNGdppC691jSJfd6gu3kDWWxESTwQynRLZOLWCCgGJkMhST3.', NULL, 'Stoval@example.ru', 10, 1613557741, 1613557741, NULL),
	(85, 'Michaud', 'KEYvgboCwxMLqxDvtb6kHimEKsnsX2NV', '$2y$13$eflwA0sYtkgoxHDy9u3CNu7QQ7fS2XIW9llKPJ.zGjTSWIGwHurs2', NULL, 'Michaud@example.ru', 10, 1613557742, 1613557742, NULL),
	(86, 'Mote', 'gqzWcNPtQr_Eart1AFhStuLDFng2nThr', '$2y$13$anFqJhc40.kjaSvrFX1iFuWzq76IMpmLcgz0.4kq/AQ9iuhFKhzNW', NULL, 'Mote@example.ru', 10, 1613557743, 1613557743, NULL),
	(87, 'Menjivar', 'dOHSLTb8wEY3-h0Mvg8QqGyKM4hjx7bQ', '$2y$13$lgvbbtDsiyajSTu7zfNr8O/vSiVGuM3rm6rOgIIFIgQQ/r20DlPpe', NULL, 'Menjivar@example.ru', 10, 1613557743, 1613557743, NULL),
	(88, 'Wiers', '2_dUw0wfGCMZQFrBi9o23dWQTRjqeFg0', '$2y$13$3oJ.CVb0sczHrGQ2nTXDQeBRMjRaF1A5XOQzl42hVTK1yih1U3iXe', NULL, 'Wiers@example.ru', 10, 1613557744, 1613557744, NULL),
	(89, 'Paris', 'Gco-YuSnn2DVAElOFzNlbvOFWGPIzfdg', '$2y$13$AsG49EpJP1PqtePJqIdXi.F9Q75KIasX8vaXV3iikl9R9Fmr1CSQC', NULL, 'Paris@example.ru', 10, 1613557745, 1613557745, NULL),
	(90, 'Grisby', 'sCWjQIatI7D0DVoZc3xm4TNQYn4VeQRa', '$2y$13$PKBZf8V37YbbxhAeGkKrA.j711eiqWvmYXDxhWw/8ND.OnppKVTWK', NULL, 'Grisby@example.ru', 10, 1613557745, 1613557745, NULL),
	(91, 'Noren', '8D5AP56VlCG0t22hj1_CuI3m7XX5FYR-', '$2y$13$9RHC6paD8ugmijFefub/l.vcJ7DtnlBBxejAwe54HLEPhB9eN/W2K', NULL, 'Noren@example.ru', 10, 1613557746, 1613557746, NULL),
	(92, 'Damron', 'cdJhtmm3Y1hTKD0ozR65RirljksoD3mK', '$2y$13$4kcle/2mlP71QovFdaai8uNHWxdDwBwv663jMQ75HHOp1T2vWhZvG', NULL, 'Damron@example.ru', 10, 1613557747, 1613557747, NULL),
	(93, 'Kazmierczak', 'PKCdZc3kUgMXf3Oj2ClhyTamGL0E9kFk', '$2y$13$c4yqeROs7KzfNmJekYICwetICQPRlMi/JUtg3Et8ROYft/pAqq6Ai', NULL, 'Kazmierczak@example.ru', 10, 1613557747, 1613557747, NULL),
	(94, 'Haslett', '9kWOuHzD_VRaAC_V33OMJKzZ7uy2eWoe', '$2y$13$8QDGySH3b0/B4aLnWz8W9.4iPOgKH/2wJ.mkxH/pTqN5rxdo0j3i6', NULL, 'Haslett@example.ru', 10, 1613557748, 1613557748, NULL),
	(95, 'Guillemette', 'uEHfqr1ZT_aSyWRUHpCStWotDDUenZ-X', '$2y$13$XhrKNlAaD80orF5CbV89MeWN1DpdPKiIqIp8.TCvVjzsEIvpThWSa', NULL, 'Guillemette@example.ru', 10, 1613557749, 1613557749, NULL),
	(96, 'Buresh', 'vsur-g2OdXXaTPkTJgJmnJ_cUrtGTOCt', '$2y$13$jMQpDn0Uf5xScFK2ZlTeierV6HWUU8NEAaIhyewU221HxhLf88wuy', NULL, 'Buresh@example.ru', 10, 1613557749, 1613557749, NULL),
	(97, 'Center', '-lNXr4T9nj_jvBNY9UjvPUQP_0GdVuc3', '$2y$13$eyMes9b0QE2Pn0EXEjrMfOxJSkAzfz0sZiwzRnnX.STEnGfVjDYYK', NULL, 'Center@example.ru', 10, 1613557750, 1613557750, NULL),
	(98, 'Kucera', 'MbeH0UZWdFIUBPZrTG21HEqIMeMNT5Ij', '$2y$13$o80zM9x5AmMG6ftWEY1J5.HlwR48.SmJgbjzcquxM8l6CE/PBGjRe', NULL, 'Kucera@example.ru', 10, 1613557751, 1613557751, NULL),
	(99, 'Catt', 'q9_ymnv_dLtWQ_ld_LEg7z5XzE32V1hS', '$2y$13$S6VQWPXo8Knqj83dhVPiCeVP6BN5zegRNu72MhWw0tY.JTvD9/MnW', NULL, 'Catt@example.ru', 10, 1613557751, 1613557751, NULL),
	(100, 'Badon', 'MdOJtF_CjudS7iIqD4X56pMzT9DS9jfD', '$2y$13$v5EBmA.c4lP6fp/Lum8iC.N93tVFlSnULj6ld7F06YNOk1WYc4UfG', NULL, 'Badon@example.ru', 10, 1613557752, 1613557752, NULL),
	(101, 'Grumbles', 'Sn1kUNxqCiFZC8CMpsS3fTc5488HK6fr', '$2y$13$UEq.vhD8//NMu2X0VT3xmuvJ8G3xucAfdX8RrOQRiv4om3nSlB5n2', NULL, 'Grumbles@example.ru', 10, 1613557753, 1613557753, NULL),
	(102, 'Antes', 't989LJqILILNsCQFOxEwA5SjXPhl_x1k', '$2y$13$x2zXrW0gaplfDP48EUppE.U6XcTw0PE8bRzDpXC5/ToPZWGoYmZhy', NULL, 'Antes@example.ru', 10, 1613557754, 1613557754, NULL),
	(103, 'Byron', '32vBfUz9Xba5cwsK0Ta19N6GgEJYQoUH', '$2y$13$BATO/RaASRZMQhXmS9aNf.eUPXlPnZgRNQV6G2i4tWFqNi9Xn.dQq', NULL, 'Byron@example.ru', 10, 1613557755, 1613557755, NULL),
	(104, 'Volkman', 'w99wrpm1TcM8o22-FPz83OWuOzahRQkF', '$2y$13$HMD070S/Zr1aCWJMA5kRdekdBcimKgtHtgukd4CxqGV3KL1TcH.YK', NULL, 'Volkman@example.ru', 10, 1613557755, 1613557755, NULL),
	(105, 'Klemp', 'o4mnu40Ood91q5GpEx3CfoWofCzXKqPm', '$2y$13$W6iihCCt4C/4AGQo7xofpOwhe3/jlsWrFfn8dUIXjVNTyIer7R9uS', NULL, 'Klemp@example.ru', 10, 1613557756, 1613557756, NULL),
	(106, 'Pekar', 'yuDRE9Xe_1cXYyhjBAraM6AaSbW_SEZu', '$2y$13$EEh9VQ.UBR5M1BhfvW7adObF7tc5QHxWEIvTLbG5.c97BOoD9EJFK', NULL, 'Pekar@example.ru', 10, 1613557757, 1613557757, NULL),
	(107, 'Pecora', '6FlIHVdLEQbEYU7hu_9y070NpbcYJMS-', '$2y$13$klyLI4O9KY7q/yo0n4g7Mu/HGV4vyPMCXP.GtcW5PyAQtZDZH2U9C', NULL, 'Pecora@example.ru', 10, 1613557757, 1613557757, NULL),
	(108, 'Schewe', 'oGWjP7QtLTSlfy_BENhjM7Io5e0DsjVT', '$2y$13$yoJKF5cZ2VtVlZ5odvU0FutxKaoIL2bCUNw3h/2WcyCM0KBIMonj.', NULL, 'Schewe@example.ru', 10, 1613557758, 1613557758, NULL),
	(109, 'Ramage', 'ym6Zn-TkNU68wfbnYzDatb-OZqblLA1h', '$2y$13$/bkrjaU/Lqc6xflymrvumONNAUJz.WSHcMLL4qN8L0ZiOL8q5axM.', NULL, 'Ramage@example.ru', 10, 1613557759, 1613557759, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

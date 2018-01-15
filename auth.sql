-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 13 2018 г., 04:00
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auth`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_08_112721_CreateRolesTable', 2),
(4, '2018_01_08_113138_CreatePermissionsTable', 2),
(5, '2018_01_08_113255_CreatePermissionRoleTable', 2),
(6, '2018_01_08_113354_CreateUserRoleTable', 2),
(7, '2018_01_08_114632_ChangeUserRoleTable', 3),
(8, '2018_01_08_114707_ChangePermissionRoleTable', 3),
(9, '2018_01_12_225532_create_social_providers_table', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@test.com', '$2y$10$AiXhBtAWhcTpmDC0S26YFenBjaHuJ3rKGyufdn6PiS8CtmU0Fb5f.', '2018-01-08 07:08:13'),
('kolya96@gmail.com', '$2y$10$qbGrxesS3rL8suekZFS4E.GLVEVCULKmzqMrVyzvWbmjHJx1.HElW', '2018-01-09 22:41:36'),
('kolya@gmail.com', '$2y$10$f/81GzfBa7w/0Ak33iMODeavZs7weVkD9PIs3/n/82JRRivuU6buK', '2018-01-09 22:44:19');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'VIEW_ADMIN', NULL, NULL),
(2, 'EDIT_PERMISSIONS', NULL, NULL),
(3, 'EDIT_USERS', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `permission_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`id`, `created_at`, `updated_at`, `role_id`, `permission_id`) VALUES
(1, NULL, NULL, 1, 1),
(2, NULL, NULL, 1, 2),
(3, NULL, NULL, 1, 3),
(12, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Aдмин', NULL, NULL),
(2, 'Модератор', NULL, NULL),
(3, 'Гость', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `friend_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@test.com', '$2y$10$JvVVZ2JfvleSdeXcoP0hi.ltB1JtfaR8PLzqTn7rVX17wj0T6hZ4G', 'FbFH18b1MUEzQHkXAOmbGHkdVZqp997MzU8p4bl2T2rHEYkUfdyDZSagTiAH', NULL, '2018-01-08 06:53:48', '2018-01-08 06:53:48'),
(3, 'Катя', 'caterine@gmail.com', '$2y$10$s0R2hizbjGUd/Ct5QAlBnOPXk.2Knv6D4I7SeStig4kqEJL28eDji', '0BTpYdpjjq1pQV0MhIYpmT28194OhxasbNyhq3c6VhV63aFyHa0PSN2xHKa7', NULL, '2018-01-08 19:44:07', '2018-01-08 19:44:07'),
(4, 'Коля', 'kolya@gmail.com', '$2y$10$HGum0EwylftX44q.VVmcLuTN8kkU6eD/B4vAKCGZSO.a1fCst6pGO', 'WZM067pJfOtDk7xRYoKDTTs2Y5lxPH7xJ3pKGSekZf0spk2I29uefMYh1CPK', NULL, '2018-01-09 06:39:07', '2018-01-09 06:39:07'),
(5, 'ada', 'ad2@WDD.ru', '$2y$10$bXoTRhJaj0jDdXSeUMoGTu0RnhpL.SThna6ZjM4kGAJPV6SzqLMPS', NULL, NULL, '2018-01-09 10:30:51', '2018-01-10 08:54:07'),
(7, 'dada', 'adad@dad.ru', '$2y$10$knAcKL72ZWtdazh2tlP2Ke4UWBGvInm1GDPMBwMAYdZsZXpSK2Qk2', NULL, NULL, '2018-01-09 11:24:32', '2018-01-10 07:28:12'),
(8, 'kolya', 'kolya96@gmail.com', '$2y$10$IKnM3t87nEdXB4Zow7o4EeFUBdTYY/wsOT51z/jk/qGcDDQF9y3bm', 'fG5nqOCGdsWY6PmOzqyay7YNLCHJH3chljPY97ffqggEv2XHIEOfVmtQzd3K', NULL, '2018-01-09 19:16:04', '2018-01-10 07:29:22'),
(10, 'user1', 'user@gmail.com', '$2y$10$K6ga//8oc.4BO1Oie2uxZOzwI70MwD8xxyfsW..SD.q8iGXR48qwm', NULL, NULL, '2018-01-10 07:30:28', '2018-01-10 07:30:28'),
(11, 'user2', 'user2@gmail.com', '$2y$10$LLIvMT6nCFrBlxGZxF9CIeCcoXQBhPaA7uEfiHnwGVXY3G7Wv.5Zi', 'bq9Xu6HPunmdGUxwPsG3TF5TxDv57sCBgYr2by4r1JZqu5UFxtBZ24GZ0MNq', NULL, '2018-01-10 08:07:32', '2018-01-10 08:07:32'),
(12, 'user3', 'user3@gmail.com', '$2y$10$B20V2KPKsFdsdbttM/29kuLLnnu3LUwYsoFILmIn33K2fUJLjR0M2', 'iLhREXKWZtyQhwuJNjguT3pWimtwl42MozAyD2wYGrKDmRQDRqLDPo4mYNcF', NULL, '2018-01-10 08:22:32', '2018-01-10 08:22:32'),
(13, 'user4', 'user4@gmail.com', '$2y$10$feVmIpjsMGd6vMZCAC7JhuGZJ9cpyGvq0HDNLOk3j0M3DmOMH2MOi', 'w1bKFIycNitHICTLD0HNjDoVSPCGDA4uQK39dIcgoWf00eTsVA8ffE6gqZM7', 12, '2018-01-10 08:25:42', '2018-01-10 08:25:42'),
(14, 'user5', 'user5@gmail.com', '$2y$10$4L2HzGZZFD0kp7OiFyrEMOpAyy8icanRFnCK1MzQGANTXd43cacXi', NULL, NULL, '2018-01-12 06:00:16', '2018-01-12 06:00:16'),
(15, 'Kate', 'hakj1@ad.ru', '$2y$10$Z0R9xYBQCg3vGcIC8jlGKOH/oyv4G37EVXvaj3x4.SX3dc/27ITdO', NULL, NULL, '2018-01-12 07:32:17', '2018-01-12 07:37:25'),
(16, 'User6', 'user6@gmail.com', '$2y$10$P68CmQ4K2B2VJPGSI8.GmuXvsAMkdjsqvKfVIMWODDT38jeCDWB3e', NULL, NULL, '2018-01-12 07:39:34', '2018-01-12 07:39:34');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, NULL, NULL, 1, 1),
(2, NULL, NULL, 4, 3),
(6, NULL, NULL, 3, 2),
(11, NULL, NULL, 7, 3),
(12, NULL, NULL, 8, 2),
(13, NULL, NULL, 10, 3),
(14, NULL, NULL, 12, 3),
(15, NULL, NULL, 13, 3),
(16, NULL, NULL, 11, 3),
(17, NULL, NULL, 5, 3),
(18, NULL, NULL, 14, 3),
(20, NULL, NULL, 15, 3),
(21, NULL, NULL, 16, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_users_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `social_providers`
--
ALTER TABLE `social_providers`
  ADD CONSTRAINT `user_id_users_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

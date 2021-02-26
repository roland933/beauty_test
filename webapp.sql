-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2021. Feb 26. 13:33
-- Kiszolgáló verziója: 10.1.36-MariaDB
-- PHP verzió: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webapp`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `tax_number` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `street` varchar(100) NOT NULL,
  `zipcode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `name`, `tax_number`, `city`, `region`, `street`, `zipcode`) VALUES
(82, 12, 'Teszt Elek company', '', 'Szeged', 'Csongrád', 'Ismeretlen utca 11/a', '6726');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `date`) VALUES
(187, 12, '51 Sorszámú szállítási cím frissítésre került', '2021-02-26 10:27:36'),
(188, 12, 'Összes szállítási cím törlésre került', '2021-02-26 10:29:34'),
(189, 12, 'Új szállítási  cím felvételre került', '2021-02-26 10:29:40'),
(190, 12, 'Új számlázási cím felvételre került', '2021-02-26 10:29:48'),
(191, 12, 'Összes számlázási cím törlésre került', '2021-02-26 10:29:51'),
(192, 12, 'Összes szállítási cím törlésre került', '2021-02-26 10:29:51'),
(193, 12, 'Új szállítási  cím felvételre került', '2021-02-26 10:30:40'),
(194, 12, '54 Sorszámú szállítási cím törölve lett', '2021-02-26 10:30:41'),
(195, 12, 'Új számlázási cím felvételre került', '2021-02-26 10:30:48'),
(196, 12, 'Összes számlázási cím törlésre került', '2021-02-26 10:30:51'),
(197, 13, 'Új szállítási  cím felvételre került', '2021-02-26 11:27:04'),
(198, 13, '55 Sorszámú szállítási cím frissítésre került', '2021-02-26 11:27:09'),
(199, 13, 'Új számlázási cím felvételre került', '2021-02-26 11:27:53'),
(200, 13, '80 Sorszámú számlázási cím törölésre került', '2021-02-26 11:27:56'),
(201, 13, 'Összes szállítási cím törlésre került', '2021-02-26 11:27:58'),
(202, 13, 'Új szállítási  cím felvételre került', '2021-02-26 11:29:41'),
(203, 13, '56 Sorszámú szállítási cím törölve lett', '2021-02-26 11:30:30'),
(204, 13, 'Új számlázási cím felvételre került', '2021-02-26 11:30:36'),
(205, 13, '81 Sorszámú számlázási cím törölésre került', '2021-02-26 11:30:45'),
(206, 12, 'Új szállítási  cím felvételre került', '2021-02-26 11:53:32'),
(207, 12, 'Új számlázási cím felvételre került', '2021-02-26 11:54:13'),
(208, 12, 'Személyes adatok frissítésre kerültek', '2021-02-26 11:57:15'),
(209, 12, 'Személyes adatok frissítésre kerültek', '2021-02-26 11:57:32'),
(210, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:03:37'),
(211, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:03:52'),
(212, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:04:45'),
(213, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:05:53'),
(214, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:06:17'),
(215, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:06:22'),
(216, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:07:52'),
(217, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:08:04'),
(218, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:08:11'),
(219, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:08:16'),
(220, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:09:26'),
(221, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:10:25'),
(222, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:10:31'),
(223, 12, '82 Sorszámú számlázási cím frissítésre került', '2021-02-26 12:11:45'),
(224, 12, 'Új szállítási  cím felvételre került', '2021-02-26 12:13:08'),
(225, 12, '58 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:13:29'),
(226, 14, 'Új szállítási  cím felvételre került', '2021-02-26 12:24:58'),
(227, 14, 'Összes szállítási cím törlésre került', '2021-02-26 12:24:59'),
(228, 14, 'Új számlázási cím felvételre került', '2021-02-26 12:25:19'),
(229, 14, 'Összes számlázási cím törlésre került', '2021-02-26 12:25:21'),
(230, 12, '58 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:31:20'),
(231, 12, '57 Sorszámú szállítási cím frissítésre került', '2021-02-26 12:33:11');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `region` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(8) NOT NULL,
  `street` varchar(100) NOT NULL,
  `set_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `user_id`, `name`, `region`, `city`, `zipcode`, `street`, `set_default`) VALUES
(57, 12, 'Teszt Elek', 'Csongrád', 'Szeged', '6726', 'Példa utca 11', 1),
(58, 12, 'Mészáros Roland', 'Csongrád', 'Szeged', '6726', 'Traktor utca 109', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(12, 'Teszt', 'Elek', 'test@hotmail.com', '$2y$10$EACi1eWYisvKKbTWE/3JbeZpHrqNLfVLL9d6RhuGkuq7JB5enhVGe');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT a táblához `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT a táblához `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

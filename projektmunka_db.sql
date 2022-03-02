-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 02. 09:15
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `projektmunka_db`
--
CREATE DATABASE IF NOT EXISTS `projektmunka_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `projektmunka_db`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkalmazott`
--

DROP TABLE IF EXISTS `alkalmazott`;
CREATE TABLE `alkalmazott` (
  `alk_ID` int(255) NOT NULL COMMENT 'Alkalmazott (user) egyedi azonosítója.',
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.',
  `alk_pw` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazotti jelszó.',
  `alk_jog` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazotti jogok pl. admin.',
  `alk_aj` int(10) NOT NULL COMMENT 'Adóazonosító jel - alkalmazotti egyedi azonosító (humán).',
  `alk_nev0` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Név előjel: Dr., PHD, PROF...',
  `alk_nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott neve: 1.név + 2.név + ...',
  `alk_szhely` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Születési hely - város.',
  `alk_szido` date NOT NULL COMMENT 'Alkalmazott születési ideje: év-hónap-nap',
  `alk_mail` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott e-mail címe.',
  `alk_tel` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott telefonszáma.',
  `alk_beoszt` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott beosztása.',
  `alk_vez` tinyint(1) NOT NULL COMMENT 'Vezető alkalmazott.',
  `alk_p` tinyint(1) NOT NULL COMMENT 'Portás alkalmazott.',
  `alk_regido` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Alkalmazott regisztrációjának ideje.',
  `alk_s` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazotti státusz: fizetés nélkülin, táppénzen...',
  `alk_ki` tinyint(1) NOT NULL COMMENT 'Kilépett alkalmazott.',
  `alk_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Egyéb megjegyzések, commentek.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beki`
--

DROP TABLE IF EXISTS `beki`;
CREATE TABLE `beki` (
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.',
  `alk_be` timestamp NULL DEFAULT NULL COMMENT 'Alkalmazotti belépés ideje.',
  `alk_ki` timestamp NULL DEFAULT NULL COMMENT 'Alkalmazotti kilépés ideje.',
  `alk_ip` int(255) NOT NULL COMMENT 'Milyen ip címről lépett be?',
  `alk_ses` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Session - aktuális munkamenet.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gjarmu`
--

DROP TABLE IF EXISTS `gjarmu`;
CREATE TABLE `gjarmu` (
  `g_rsz` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű rendszáma.',
  `g_tip` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű típusa.',
  `g_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű megjegyzések, pl. szervízben van...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gjarmu_km`
--

DROP TABLE IF EXISTS `gjarmu_km`;
CREATE TABLE `gjarmu_km` (
  `g_ID` int(255) NOT NULL COMMENT 'Gépjármű belépési azonosító.',
  `g_rsz` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű rendszáma.',
  `g_km_0` int(255) NOT NULL COMMENT 'Céges gépjármű km-óra állása felvételkor.',
  `g_km_1` int(255) NOT NULL COMMENT 'Céges gépjármű km-óra állása leadáskor.',
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulcsfel`
--

DROP TABLE IF EXISTS `kulcsfel`;
CREATE TABLE `kulcsfel` (
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.',
  `k_ID` int(50) NOT NULL COMMENT 'Kulcsazonosító.',
  `k_ido_0` timestamp NULL DEFAULT NULL COMMENT 'Kulcs felvételének ideje.',
  `k_ido_1` timestamp NULL DEFAULT NULL COMMENT 'Kulcs leadásának ideje.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulcsok`
--

DROP TABLE IF EXISTS `kulcsok`;
CREATE TABLE `kulcsok` (
  `k_ID` int(50) NOT NULL COMMENT 'Kulcsaznosító.',
  `th_nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely neve.',
  `k_leir` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Kulcs megnevezése, minek a kulcsa? Műhely, raktár...',
  `k_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Kulccsal kapcsolatos megjegyzések, pl. elveszett, 3 példányos...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulsos`
--

DROP TABLE IF EXISTS `kulsos`;
CREATE TABLE `kulsos` (
  `kls_ID` int(50) NOT NULL COMMENT 'Külsős szervezeti azonosító.',
  `kls_sznev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezet neve.',
  `kls_rsz` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezeti gépjármű rendszáma.',
  `kls_be` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Külsős szervezeti gépjármű belépés.',
  `kls_ki` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Külsős szervezeti gépjármű kilépés.',
  `kls_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezeti megjegyzések, pl. heti egyszer csütörtökönként szállít...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telephely`
--

DROP TABLE IF EXISTS `telephely`;
CREATE TABLE `telephely` (
  `th_ID` int(50) NOT NULL COMMENT 'Telephely azonosító.',
  `th_nev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely neve.',
  `th_irsz` int(10) NOT NULL COMMENT 'Telephely irányítószáma.',
  `th_v` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely városa.',
  `th_cim` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely címe.',
  `th_gynev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely gyűjtőnév.',
  `th_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Telephely megjegyzések.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `telephely`
--

INSERT INTO `telephely` (`th_ID`, `th_nev`, `th_irsz`, `th_v`, `th_cim`, `th_gynev`, `th_mj`) VALUES
(1, 'Népliget Center C épület', 1097, 'Budapest', 'Könyves Kálmán körút 11.', 'Központi létesítmény', ''),
(2, 'HÉV telephely 1', 1163, 'Budapest', 'Nagyicce sor 2.', 'HÉV telephelyek', ''),
(3, 'HÉV telephely 2', 1164, 'Budapest', 'Állomás tér 2.', 'HÉV telephelyek', ''),
(4, 'HÉV telephely 3', 1212, 'Budapest', 'II. Rákóczi Ferenc út 174.', 'HÉV telephelyek', ''),
(5, 'HÉV telephely 4', 1201, 'Budapest', 'Helsinki út 170196 hrsz.', 'HÉV telephelyek', ''),
(6, 'HÉV fióktelep 1', 2000, 'Szentendre', 'Vasúti villasor 4.', 'HÉV fióktelepek', ''),
(7, 'HÉV fióktelep 2', 2300, 'Ráckeve', 'Kossuth Lajos utca 117.', 'HÉV fióktelepek', ''),
(8, 'HÉV fióktelep 3', 2330, 'Dunaharaszti', 'Fő út 1.', 'HÉV fióktelepek', ''),
(9, 'HÉV fióktelep 4', 2011, 'Budakalász', 'Budakalász állomás 1236/13.', 'HÉV fióktelepek', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `alkalmazott`
--
ALTER TABLE `alkalmazott`
  ADD PRIMARY KEY (`alk_ID`);

--
-- A tábla indexei `beki`
--
ALTER TABLE `beki`
  ADD PRIMARY KEY (`alk_fnev`);

--
-- A tábla indexei `gjarmu`
--
ALTER TABLE `gjarmu`
  ADD PRIMARY KEY (`g_rsz`);

--
-- A tábla indexei `gjarmu_km`
--
ALTER TABLE `gjarmu_km`
  ADD PRIMARY KEY (`g_ID`);

--
-- A tábla indexei `kulcsfel`
--
ALTER TABLE `kulcsfel`
  ADD PRIMARY KEY (`k_ID`);

--
-- A tábla indexei `kulcsok`
--
ALTER TABLE `kulcsok`
  ADD PRIMARY KEY (`k_ID`);

--
-- A tábla indexei `kulsos`
--
ALTER TABLE `kulsos`
  ADD PRIMARY KEY (`kls_ID`);

--
-- A tábla indexei `telephely`
--
ALTER TABLE `telephely`
  ADD PRIMARY KEY (`th_ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `alkalmazott`
--
ALTER TABLE `alkalmazott`
  MODIFY `alk_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Alkalmazott (user) egyedi azonosítója.';

--
-- AUTO_INCREMENT a táblához `kulcsok`
--
ALTER TABLE `kulcsok`
  MODIFY `k_ID` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Kulcsaznosító.';

--
-- AUTO_INCREMENT a táblához `kulsos`
--
ALTER TABLE `kulsos`
  MODIFY `kls_ID` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Külsős szervezeti azonosító.';

--
-- AUTO_INCREMENT a táblához `telephely`
--
ALTER TABLE `telephely`
  MODIFY `th_ID` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Telephely azonosító.', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

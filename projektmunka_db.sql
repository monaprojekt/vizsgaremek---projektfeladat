-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 15. 22:23
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
  `jog_ID` int(255) NOT NULL COMMENT 'Alkalmazotti jogok megnevezése pl. admin.',
  `jog_s` tinyint(1) NOT NULL COMMENT 'Jog státusza (aktív, megszűnt)',
  `alk_aj` int(10) NOT NULL COMMENT 'Adóazonosító jel - alkalmazotti egyedi azonosító (humán).',
  `alk_nev0` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Név előjel: Dr., PHD, PROF...',
  `alk_nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott neve: 1.név + 2.név + ...',
  `alk_jv_0` date DEFAULT NULL COMMENT 'Jogviszony kezdete.',
  `alk_jv_1` date DEFAULT NULL COMMENT 'Jogviszony vége.',
  `alk_szhely` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Születési hely - város.',
  `alk_szido` date NOT NULL COMMENT 'Alkalmazott születési ideje: év-hónap-nap',
  `alk_mail` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott e-mail címe.',
  `alk_tel` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott telefonszáma.',
  `alk_beoszt` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott beosztása.',
  `alk_vez` tinyint(1) NOT NULL COMMENT 'Vezető alkalmazott.',
  `alk_p` tinyint(1) NOT NULL COMMENT 'Portás alkalmazott.',
  `alk_regido` datetime NOT NULL COMMENT 'Alkalmazott regisztrációjának ideje.',
  `alk_s` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazotti státusz: fizetés nélkülin, táppénzen...',
  `alk_ki` tinyint(1) NOT NULL COMMENT 'Kilépett alkalmazott.',
  `alk_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Egyéb megjegyzések, commentek.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `alkalmazott`
--

INSERT INTO `alkalmazott` (`alk_ID`, `alk_fnev`, `alk_pw`, `jog_ID`, `jog_s`, `alk_aj`, `alk_nev0`, `alk_nev`, `alk_jv_0`, `alk_jv_1`, `alk_szhely`, `alk_szido`, `alk_mail`, `alk_tel`, `alk_beoszt`, `alk_vez`, `alk_p`, `alk_regido`, `alk_s`, `alk_ki`, `alk_mj`) VALUES
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661', 1, 0, 1234567898, 'dr.', 'Teszt Admin', '2021-08-03', '0000-00-00', 'Budapest', '1987-09-24', 'admin@teszt.com', '06201231234', 'főmunkatárs', 0, 0, '2022-03-06 17:42:02', 'aktív', 0, ''),
(8, 'user', '0cc175b9c0f1b6a831c399e269772661', 5, 0, 1234567898, '', 'Teszt User', '2016-03-01', '0000-00-00', 'Baja', '1987-12-01', 'tesztuser@teszt.hu', '06203457655', 'portás', 0, 1, '2022-03-07 08:28:46', 'aktív', 0, ''),
(9, 'tesztvezeto', '0cc175b9c0f1b6a831c399e269772661', 0, 0, 2121212123, '', 'Teszt Vezető', '2022-03-01', NULL, 'Miskolc', '1988-01-23', 'tesztvezeto@teszt.hu', '06303456522', 'főreferens', 1, 0, '2022-03-07 08:39:24', 'aktív', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beki`
--

DROP TABLE IF EXISTS `beki`;
CREATE TABLE `beki` (
  `beki_ID` int(255) NOT NULL,
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.	',
  `alk_be` datetime NOT NULL COMMENT 'Alkalmazotti belépés ideje.',
  `alk_ki` datetime NOT NULL COMMENT 'Alkalmazotti kilépés ideje.',
  `alk_ip` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Milyen ip címről lépett be?',
  `alk_ses` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Session - aktuális munkamenet.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gjarmu`
--

DROP TABLE IF EXISTS `gjarmu`;
CREATE TABLE `gjarmu` (
  `g_ID` int(255) NOT NULL COMMENT 'Céges gépjármű azonosító.',
  `g_rsz` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű rendszáma.',
  `g_feng` text COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Gépjármű forgalmi engedélyének száma.',
  `g_tip` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű típusa.',
  `g_s` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Gépjármű státusza (pl. forgalomból kivont...)',
  `g_t` tinyint(1) NOT NULL COMMENT 'Törölt gépjármű.',
  `g_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű megjegyzések, pl. szervízben van...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `gjarmu`
--

INSERT INTO `gjarmu` (`g_ID`, `g_rsz`, `g_feng`, `g_tip`, `g_s`, `g_t`, `g_mj`) VALUES
(1, 'q', 'kmkkkk', '', '', 0, ''),
(2, 'j', 'j', 'j', '', 1, 'j'),
(3, 'l', 'l', 'l', '', 1, ''),
(4, 'k', 'k', 'k', '', 1, ''),
(5, 'MNM89898', 'mjnm 8997b 69699 ', 'jfldsajfé sjdlfjélds jfl jlfdsajf lsafas ldajflsa fa', 'állományban', 0, 'dsmnlékda f jfdélksa jflksjf lkaflkjflksj flkdsjflksajdfkd mmmmmmmmmmmmmm mmmmmmmmmmmmmmmmm mmmmmmmmm mmmmmmmmmmmmmmmmmmmmmmmmmmmmmm   mmmmmmmmmm mmmmmmmmmmm mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm mmmmmmmm mmmmmmmmmmmmmmm'),
(6, 's', 's', 's', 's', 0, 's'),
(7, 'ww', 'ww', 'ww', '', 0, ''),
(8, '2', '2', '2', '2', 1, ''),
(9, '11', '1', '1', '11', 1, ''),
(10, 'e', 'e', 'e', '', 0, ''),
(11, 'f', 'f', 'f', '', 0, ''),
(12, 'x', 'x', 'x', '', 0, ''),
(13, 'cc', 'cc', 'c', '', 0, ''),
(14, 'y', 'y', 'y', '', 1, ''),
(15, 'w', 'e', 'w', '', 1, ''),
(16, '8', '8', '8', '8', 1, '8'),
(17, '9', '9', '9', '9', 0, '9'),
(18, 'm', 'm', 'm', '', 0, ''),
(19, '4', '44', '4', '4', 0, '4'),
(20, 'a', 'a', 'a', '', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gjarmu_km`
--

DROP TABLE IF EXISTS `gjarmu_km`;
CREATE TABLE `gjarmu_km` (
  `g_km_ID` int(255) NOT NULL COMMENT 'Gépjármű belépési azonosító.',
  `g_rsz` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Céges gépjármű rendszáma.',
  `g_km_0` int(255) NOT NULL COMMENT 'Céges gépjármű km-óra állása felvételkor.',
  `g_fel` datetime NOT NULL COMMENT 'Céges gépjármű felvételének ideje.',
  `g_km_1` int(255) NOT NULL COMMENT 'Céges gépjármű km-óra állása leadáskor.',
  `g_le` datetime NOT NULL COMMENT 'Céges gépjármű leadásának ideje.',
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jogok`
--

DROP TABLE IF EXISTS `jogok`;
CREATE TABLE `jogok` (
  `jog_ID` int(255) NOT NULL COMMENT 'Jog azonosító.',
  `jog_nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Jog megnevezése.',
  `jog_t` tinyint(1) NOT NULL COMMENT 'Törölt jog.',
  `jog_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Joggal kapcsolatos megjegyzések.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `jogok`
--

INSERT INTO `jogok` (`jog_ID`, `jog_nev`, `jog_t`, `jog_mj`) VALUES
(1, 'szadmin', 1, 'Szerver admin.'),
(2, 'kadmin', 1, 'Kliens admin.'),
(4, 'kuser', 0, 'Kliens felhasználó.'),
(5, 'szuser', 0, 'Szerver felhasználó.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulcsfel`
--

DROP TABLE IF EXISTS `kulcsfel`;
CREATE TABLE `kulcsfel` (
  `k_fel_ID` int(255) NOT NULL COMMENT 'Kulcs felvételének azonosítója.',
  `k_ID` int(50) NOT NULL COMMENT 'Kulcsazonosító.',
  `alk_fnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Alkalmazott felhasználóneve.',
  `k_ido_0` datetime NOT NULL COMMENT 'Kulcs felvételének ideje.',
  `k_ido_1` datetime NOT NULL COMMENT 'Kulcs leadásának ideje.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulcsok`
--

DROP TABLE IF EXISTS `kulcsok`;
CREATE TABLE `kulcsok` (
  `k_ID` int(255) NOT NULL COMMENT 'Kulcsazonosító.',
  `th_ID` int(50) NOT NULL COMMENT 'Telephely azonosítója.',
  `k_leir` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Kulcs megnevezése, minek a kulcsa? Műhely, raktár...',
  `k_t` tinyint(1) NOT NULL COMMENT 'Törölt kulcs.',
  `k_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Kulccsal kapcsolatos megjegyzések, pl. elveszett, 3 példányos...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kulsos`
--

DROP TABLE IF EXISTS `kulsos`;
CREATE TABLE `kulsos` (
  `kls_ID` int(255) NOT NULL COMMENT 'Külsős szervezeti azonosító.',
  `kls_sznev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezet neve.',
  `kls_rsz` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezeti gépjármű rendszáma.',
  `kls_be` datetime NOT NULL COMMENT 'Külsős szervezeti gépjármű belépés ideje.',
  `kls_ki` datetime NOT NULL COMMENT 'Külsős szervezeti gépjármű kilépés ideje.',
  `kls_mj` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Külsős szervezeti megjegyzések, pl. heti egyszer csütörtökönként szállít...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telephely`
--

DROP TABLE IF EXISTS `telephely`;
CREATE TABLE `telephely` (
  `th_ID` int(255) NOT NULL COMMENT 'Telephely azonosító.',
  `th_t` int(11) NOT NULL COMMENT 'Törölt telephely.',
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

INSERT INTO `telephely` (`th_ID`, `th_t`, `th_nev`, `th_irsz`, `th_v`, `th_cim`, `th_gynev`, `th_mj`) VALUES
(1, 0, 'Népliget Center C épület', 1097, 'Budapest', 'Könyves Kálmán körút 11.', 'Központi létesítmény', ''),
(2, 0, 'HÉV telephely 1', 1163, 'Budapest', 'Nagyicce sor 2.', 'HÉV telephelyek', ''),
(3, 0, 'HÉV telephely 2', 1164, 'Budapest', 'Állomás tér 2.', 'HÉV telephelyek', ''),
(4, 0, 'HÉV telephely 3', 1212, 'Budapest', 'II. Rákóczi Ferenc út 174.', 'HÉV telephelyek', ''),
(5, 0, 'HÉV telephely 4', 1201, 'Budapest', 'Helsinki út 170196 hrsz.', 'HÉV telephelyek', ''),
(6, 0, 'HÉV fióktelep 1', 2000, 'Szentendre', 'Vasúti villasor 4.', 'HÉV fióktelepek', ''),
(7, 0, 'HÉV fióktelep 2', 2300, 'Ráckeve', 'Kossuth Lajos utca 117.', 'HÉV fióktelepek', ''),
(8, 0, 'HÉV fióktelep 3', 2330, 'Dunaharaszti', 'Fő út 1.', 'HÉV fióktelepek', ''),
(9, 0, 'HÉV fióktelep 4', 2011, 'Budakalász', 'Budakalász állomás 1236/13.', 'HÉV fióktelepek', '');

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
  ADD PRIMARY KEY (`beki_ID`);

--
-- A tábla indexei `gjarmu`
--
ALTER TABLE `gjarmu`
  ADD PRIMARY KEY (`g_ID`);

--
-- A tábla indexei `gjarmu_km`
--
ALTER TABLE `gjarmu_km`
  ADD PRIMARY KEY (`g_km_ID`);

--
-- A tábla indexei `jogok`
--
ALTER TABLE `jogok`
  ADD PRIMARY KEY (`jog_ID`);

--
-- A tábla indexei `kulcsfel`
--
ALTER TABLE `kulcsfel`
  ADD PRIMARY KEY (`k_fel_ID`);

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
  MODIFY `alk_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Alkalmazott (user) egyedi azonosítója.', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `beki`
--
ALTER TABLE `beki`
  MODIFY `beki_ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `gjarmu`
--
ALTER TABLE `gjarmu`
  MODIFY `g_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Céges gépjármű azonosító.', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `gjarmu_km`
--
ALTER TABLE `gjarmu_km`
  MODIFY `g_km_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Gépjármű belépési azonosító.';

--
-- AUTO_INCREMENT a táblához `jogok`
--
ALTER TABLE `jogok`
  MODIFY `jog_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Jog azonosító.', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `kulcsfel`
--
ALTER TABLE `kulcsfel`
  MODIFY `k_fel_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Kulcs felvételének azonosítója.';

--
-- AUTO_INCREMENT a táblához `kulcsok`
--
ALTER TABLE `kulcsok`
  MODIFY `k_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Kulcsazonosító.';

--
-- AUTO_INCREMENT a táblához `kulsos`
--
ALTER TABLE `kulsos`
  MODIFY `kls_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Külsős szervezeti azonosító.';

--
-- AUTO_INCREMENT a táblához `telephely`
--
ALTER TABLE `telephely`
  MODIFY `th_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Telephely azonosító.', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

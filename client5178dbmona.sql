-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2022. Ápr 24. 21:50
-- Kiszolgáló verziója: 10.4.18-MariaDB-1:10.4.18+maria~stretch
-- PHP verzió: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `client5178dbmona`
--
CREATE DATABASE IF NOT EXISTS `client5178dbmona` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `client5178dbmona`;

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
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661', 1, 0, 2147483647, 'dr.', 'Teszt', '0000-00-00', '0000-00-00', 'Budapest', '1987-09-11', 'admin@teszt.com', '06201231234', 'gyakornok', 0, 0, '2022-03-06 17:42:02', 'aktÃ­v', 0, ''),
(38, 'tesztvezető', '0cc175b9c0f1b6a831c399e269772661', 0, 0, 2147483647, '', 'Teszt Vezető', '0000-00-00', '0000-00-00', 'Miskolc', '1988-01-23', 'tesztvezeto@teszt.hu', '06303456522', 'referens', 1, 0, '2022-03-07 08:39:24', 'aktí­v', 0, 'Gazdasági Igazgatóság'),
(45, 'bela1980', '7e54ba568835d7a5f9c53e163948e8d4', 1, 1, 12234490, '', 'KovÃ¡cs BÃ©la', '2022-03-01', '0000-00-00', 'Budapest', '1980-03-24', 'bela1980@gmail.com', '06201213155', 'Alkalmazott', 0, 0, '2022-04-24 20:18:34', '1', 0, ''),
(46, 'dani77', 'fb2ca5a5a51b84b66552137bddf9888a', 1, 1, 828383839, '', 'SzabÃ³ DÃ¡niel', '2022-02-17', '0000-00-00', 'Budapest', '1986-04-24', 'dani18888@gmail.com', '06202780000', 'Alkalmazott', 0, 0, '2022-04-24 20:23:08', '1', 0, ''),
(47, 'Zoli77', '1dbf90584dcd45ca4b1f44ab2a7aebd5', 1, 1, 2147483647, '', 'SzabÃ³ ZoltÃ¡n', '2022-01-18', '0000-00-00', 'Budapest', '1991-03-24', 'zoli@gmail.com', '06202007000', 'Alkalmazott', 0, 0, '2022-04-24 20:25:22', '1', 0, ''),
(48, 'Balazs75', '373ee8d771bb083d38a743e2c5e011b7', 1, 1, 828392999, '', 'KovÃ¡cs BalÃ¡zs', '2021-12-21', '0000-00-00', 'Budapest', '1967-04-24', 'balazs@gmail.com', '06305555550', 'Alkalmazott', 0, 0, '2022-04-24 20:26:35', '1', 0, ''),
(49, 'JuditVarga', '36997dcd208f5c547d95cc843b5d6264', 1, 1, 82738499, '', 'Varga Judit', '2021-10-12', '0000-00-00', 'Szolnok', '1975-04-24', 'judit@gmail.com', '06202788888', 'Alkalmazott ', 0, 0, '2022-04-24 20:27:40', '1', 0, ''),
(50, 'Kata100', '8c388d6b32345882fb635f3b54ebf70b', 3, 1, 929399999, '', 'HorvÃ¡th Kata', '2022-11-24', '2022-09-30', 'Budapest', '1972-04-24', 'kata@gmail.com', '06207288888', 'Alkalmazott', 0, 0, '2022-04-24 20:29:17', '1', 0, ''),
(51, 'Horvath50', 'a61a4223a30113c5d77b2644e90e10ed', 4, 1, 288883827, '', 'HorvÃ¡th Ã‰va', '2014-04-24', '0000-00-00', 'Szeged', '1975-04-24', 'eva@gmail.com', '06304888299', 'Alkalmazott', 0, 0, '2022-04-24 20:31:24', '1', 0, ''),
(52, 'Bambi20', 'b003d0186f92c3dd0295b1fb47a40bc3', 3, 1, 72838999, '', 'HorvÃ¡th IldikÃ³', '2021-11-22', '0000-00-00', 'Budapest', '1980-04-12', 'bambi@gmail.com', '06301122000', 'Alkalmazott', 0, 0, '2022-04-24 20:34:34', '1', 0, ''),
(53, 'Geza100', '7daa834e2bb203c014ae4db20e45b689', 3, 1, 919293939, 'Dr', 'Kis GÃ©za', '2022-07-24', '0000-00-00', 'Szeged', '1964-11-24', 'geza@gmail.com', '06202555890', 'Alkalmazott', 0, 0, '2022-04-24 20:38:13', '1', 0, ''),
(54, 'Ildiko66', '98a2070769321b73f788de651c85b094', 2, 1, 828299999, '', 'Varga IldikÃ³', '2019-04-24', '2023-01-08', 'Szeged', '1971-04-24', 'ildiko@gmail.com', '06306555554', 'Alkalmazott', 0, 0, '2022-04-24 20:39:30', '1', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beki`
--

DROP TABLE IF EXISTS `beki`;
CREATE TABLE `beki` (
  `beki_ID` int(255) NOT NULL COMMENT 'Be-, kilépés egyedi azonosítója.',
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
(5, 'MNM89898', 'mjnm 8997b 69699 ', 'jfldsajfé sjdlfjélds jfl jlfdsajf lsafas ldajflsa fa', 'állományban', 0, 'dsmnlékda f jfdélksa jflksjf lkaflkjflksj flkdsjflksajdfkd mmmmmmmmmmmmmm mmmmmmmmmmmmmmmmm mmmmmmmmm mmmmmmmmmmmmmmmmmmmmmmmmmmmmmm   mmmmmmmmmm mmmmmmmmmmm mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm mmmmmmmm mmmmmmmmmmmmmmm'),
(6, 's', 'sss', 's', 's', 0, 's'),
(7, 'ww', 'ww', 'ww', '', 0, ''),
(10, 'e', 'e123', 'e', '', 0, ''),
(11, 'f', 'f', 'f', '', 0, ''),
(12, 'x', 'x', 'x', '', 0, ''),
(17, '223322', '23323', '23232', '', 0, '');

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
(1, 'szadmin', 0, 'Szerver admin.'),
(2, 'szuser', 0, 'Szerver felhasználó.'),
(3, 'kadmin', 0, 'Kliens admin.'),
(4, 'kuser', 0, 'Kliens felhasználó.');

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

--
-- A tábla adatainak kiíratása `kulcsok`
--

INSERT INTO `kulcsok` (`k_ID`, `th_ID`, `k_leir`, `k_t`, `k_mj`) VALUES
(4, 4, 'qw', 0, 'jnnn');

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
(2, 0, 'HÉV telephely 0', 1163, 'Budapest', 'Nagyicce sor 2.', 'HÉV telephelyek', ''),
(3, 0, 'HÉV telephely 2', 1164, 'Budapest', 'Állomás tér 2.', 'HÉV telephelyek', ''),
(4, 0, 'HÉV telephely 3', 1212, 'Budapest', 'II. Rákóczi Ferenc út 174.', 'HÉV telephelyek', ''),
(5, 0, 'HÉV telephely 4', 1201, 'Budapest', 'Helsinki út 170196 hrsz.', 'HÉV telephelyek', ''),
(6, 0, 'HÉV fióktelep 1', 2000, 'Szentendre', 'Vasúti villasor 4.', 'HÉV fióktelepek', ''),
(7, 0, 'HÉV fióktelep 2', 2300, 'Ráckeve', 'Kossuth Lajos utca 117.', 'HÉV fióktelepek', ''),
(8, 0, 'HÉV fióktelep 3', 2330, 'Dunaharaszti', 'Fő út 1.', 'HÉV fióktelepek', ''),
(9, 0, 'HÉV fióktelep 4', 2011, 'Budakalász', 'Budakalász Állomás 1236/13.', 'HÉV fióktelepek', '');

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
  MODIFY `alk_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Alkalmazott (user) egyedi azonosítója.', AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT a táblához `beki`
--
ALTER TABLE `beki`
  MODIFY `beki_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Be-, kilépés egyedi azonosítója.';

--
-- AUTO_INCREMENT a táblához `gjarmu`
--
ALTER TABLE `gjarmu`
  MODIFY `g_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Céges gépjármű azonosító.', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `gjarmu_km`
--
ALTER TABLE `gjarmu_km`
  MODIFY `g_km_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Gépjármű belépési azonosító.';

--
-- AUTO_INCREMENT a táblához `jogok`
--
ALTER TABLE `jogok`
  MODIFY `jog_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Jog azonosító.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `kulcsfel`
--
ALTER TABLE `kulcsfel`
  MODIFY `k_fel_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Kulcs felvételének azonosítója.';

--
-- AUTO_INCREMENT a táblához `kulcsok`
--
ALTER TABLE `kulcsok`
  MODIFY `k_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Kulcsazonosító.', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `kulsos`
--
ALTER TABLE `kulsos`
  MODIFY `kls_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Külsős szervezeti azonosító.';

--
-- AUTO_INCREMENT a táblához `telephely`
--
ALTER TABLE `telephely`
  MODIFY `th_ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Telephely azonosító.', AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

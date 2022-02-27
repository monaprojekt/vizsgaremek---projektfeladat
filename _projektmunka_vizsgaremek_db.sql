-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Feb 27. 20:11
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
-- Adatbázis: `#projektmunka_vizsgaremek_db`
--
CREATE DATABASE IF NOT EXISTS `#projektmunka_vizsgaremek_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `#projektmunka_vizsgaremek_db`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkalmazottak`
--

DROP TABLE IF EXISTS `alkalmazottak`;
CREATE TABLE `alkalmazottak` (
  `ID` int(255) NOT NULL COMMENT 'User egyedi azonosítója',
  `Felhasznalonev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Jelszo` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Adoazonosito_jel` int(10) NOT NULL,
  `Nev_elotag` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Dr., PHD, PROF...',
  `Nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT '1.név, 2.név...',
  `Szuletesi_hely` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT 'Város',
  `Szuletesi_ido` date NOT NULL COMMENT 'év-hónap-nap',
  `E-mail` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Mobiltelefon` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Beosztas` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Vezeto(igen/nem)` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `belepes-kilepes`
--

DROP TABLE IF EXISTS `belepes-kilepes`;
CREATE TABLE `belepes-kilepes` (
  `Felhasznalonev` varchar(50) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `Belepes_ideje` timestamp NULL DEFAULT NULL,
  `Kilepes_ideje` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gepjarmu`
--

DROP TABLE IF EXISTS `gepjarmu`;
CREATE TABLE `gepjarmu` (
  `Tipus` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Rendszam` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `km_oraallas_felvetel` int(255) NOT NULL,
  `km_oraallas_leadas` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `regisztracio`
--

DROP TABLE IF EXISTS `regisztracio`;
CREATE TABLE `regisztracio` (
  `Felhasznalonev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Regisztracio_ideje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telephelyek`
--

DROP TABLE IF EXISTS `telephelyek`;
CREATE TABLE `telephelyek` (
  `Telephelynev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Iranyitoszam` int(4) NOT NULL,
  `Varos` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Cim` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Gyujtonev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `telephelyek`
--

INSERT INTO `telephelyek` (`Telephelynev`, `Iranyitoszam`, `Varos`, `Cim`, `Gyujtonev`) VALUES
('Népliget Center C épület', 1097, 'Budapest', 'Könyves Kálmán körút 11.', 'Központi létesítmény'),
('HÉV telephely 1', 1163, 'Budapest', 'Nagyicce sor 2.', 'HÉV telephelyek'),
('HÉV telephely 2', 1164, 'Budapest', 'Állomás tér 2.', 'HÉV telephelyek'),
('HÉV telephely 3', 1212, 'Budapest', 'II. Rákóczi Ferenc út 174.', 'HÉV telephelyek'),
('HÉV telephely 4', 1201, 'Budapest', 'Helsinki út 170196 hrsz.', 'HÉV telephelyek'),
('HÉV fióktelep 1', 2000, 'Szentendre', 'Vasúti villasor 4.', 'HÉV fióktelepek'),
('HÉV fióktelep 2', 2300, 'Ráckeve', 'Kossuth Lajos utca 117.', 'HÉV fióktelepek'),
('HÉV fióktelep 3', 2330, 'Dunaharaszti', 'Fő út 1.', 'HÉV fióktelepek'),
('HÉV fióktelep 4', 2011, 'Budakalász', 'Budakalász állomás 1236/13.', 'HÉV fióktelepek');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `alkalmazottak`
--
ALTER TABLE `alkalmazottak`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `regisztracio`
--
ALTER TABLE `regisztracio`
  ADD PRIMARY KEY (`Felhasznalonev`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `alkalmazottak`
--
ALTER TABLE `alkalmazottak`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT COMMENT 'User egyedi azonosítója';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

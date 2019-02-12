-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Jan 13. 09:02
-- Kiszolgáló verziója: 10.1.21-MariaDB
-- PHP verzió: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `db_taskmaster`
--
CREATE DATABASE IF NOT EXISTS `db_taskmaster` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_taskmaster`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `belepesi_adatok`
--

CREATE TABLE `belepesi_adatok` (
  `azonosito` int(11) NOT NULL,
  `felhasznalo_nev` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `jogosultsag` varchar(20) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `belepesi_adatok`
--

INSERT INTO `belepesi_adatok` (`azonosito`, `felhasznalo_nev`, `jelszo`, `jogosultsag`) VALUES
(1, 'novaka', 'kesztyu', 'admin'),
(2, 'laszlom', 'labda', 'admin'),
(3, 'kovacsa', 'karika', 'user'),
(4, 'adamikl', 'virag', 'user'),
(5, 'kocsisn', 'kifli', 'user'),
(6, 'vidaa', 'korte', 'user'),
(7, 'sebokb', 'szek', 'user'),
(8, 'barabasr', 'cipo', 'user'),
(9, 'csikosm', 'kenyer', 'user'),
(10, 'mihalikcs', 'kacsa', 'user'),
(11, 'nagye', 'eger', 'user'),
(12, 'dobakg', 'macska', 'user'),
(13, 'pasztorsz', 'nap', 'user'),
(14, 'morvain', 'vodor', 'user'),
(15, 'rajtikt', 'auto', 'root'),
(16, 'user', 'user', 'user'),
(17, 'admin', 'admin', 'admin'),
(18, 'root', 'root', 'root'),
(19, 'nagyel', '123456', 'client'),
(20, 'lovaszis', '123456', 'client'),
(21, 'kerian', '123456', 'client'),
(22, 'ovegesma', '123456', 'client'),
(23, 'szatmarigyu', '123456', 'client'),
(24, 'homonnayan', '123456', 'client');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozo`
--

CREATE TABLE `dolgozo` (
  `azonosito` int(11) NOT NULL,
  `nev` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `szul_datum` date NOT NULL,
  `lakohely` varchar(80) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` varchar(20) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `nem` tinyint(1) NOT NULL,
  `pozicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `pont` int(11) NOT NULL,
  `belepo_az` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`azonosito`, `nev`, `szul_datum`, `lakohely`, `telefonszam`, `nem`, `pozicio`, `pont`, `belepo_az`) VALUES
(1, 'Novák Álmos', '1975-10-01', 'Szeged', '+36(30)6547891', 1, 'cégvezető', 0, 1),
(2, 'László Mária', '1985-05-11', 'Mórahalom', '+36(70)6787825', 0, 'projekt manager', 0, 2),
(3, 'Kovács Attila', '1988-01-09', 'Szeged', '+36(30)7547221', 1, 'pénzügyintéző', 0, 3),
(4, 'Adamik László', '1990-05-20', 'Zsombó', '+36(20)4587422', 1, 'szoftverfejlesztő', 0, 4),
(5, 'Kocsis Noel', '1991-07-17', 'Kistelek', '+36(70)1140250', 1, 'értékesítő', 0, 5),
(6, 'Vida Anna', '1993-03-11', 'Makó', '+36(70)9965855', 0, 'grafikus', 0, 6),
(7, 'Sebők Barbara', '1989-05-22', 'Makó', '+36(30)1202772', 0, 'marketinges', 0, 7),
(8, 'Barabás Réka', '1990-11-29', 'Szeged', '+36(30)4561237', 0, 'webfejlesztő', 0, 8),
(9, 'Csikós Máté', '1990-08-23', 'Szeged', '+36(30)2581478', 1, 'szoftverfejlesztő gyakornok', 0, 9),
(10, 'Mihalik Csaba', '1988-04-13', 'Szeged', '+36(20)1074745', 1, 'értékesítő', 0, 10),
(11, 'Nagy Enikő', '1992-12-12', 'Kiskundorozsma', '+36(30)8989655', 0, 'webfejlesztő gyakornok', 0, 11),
(12, 'Dobák Gabriella', '1986-09-05', 'Szeged', '+36(30)3585654', 0, 'asszisztens', 0, 12),
(13, 'Pásztor Szilvia', '1992-05-17', 'Szeged', '+36(30)2585855', 0, 'szoftverfejlesztő', 0, 13),
(14, 'Morvai Norbert', '1990-06-01', 'Deszk', '+36(20)3214562', 1, 'szoftvertesztelő', 0, 14),
(15, 'Rajtik Tibor', '1984-08-20', 'Makó', '+36(30)7337917', 1, 'rendszergazda', 0, 15),
(16, 'user', '1975-10-01', 'Szeged', '+36(30)6547891', 1, 'user', 0, 16),
(17, 'admin', '1975-10-01', 'Szeged', '+36(30)6547891', 1, 'user', 0, 17),
(18, 'root', '1975-10-01', 'Szeged', '+36(30)6547891', 1, 'user', 0, 18);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megrendelo`
--

CREATE TABLE `megrendelo` (
  `azonosito` int(11) NOT NULL,
  `cegnev` varchar(255) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `ugyfel_nev` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `ugyfel_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` varchar(20) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `kedvezmeny` tinyint(1) NOT NULL,
  `belepo_az` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `megrendelo`
--

INSERT INTO `megrendelo` (`azonosito`, `cegnev`, `ugyfel_nev`, `ugyfel_email`, `telefonszam`, `kedvezmeny`, `belepo_az`) VALUES
(1, 'Nagy ?s Tsai Kft.', 'Nagy Elek', 'nagyelek@teszt.hu', '+36(30)1187825', 0, 19),
(2, 'Brownman Kft.', 'Lov?sz Istv?n', 'lovaszistvan@teszt.hu', '+36(20)1102772', 0, 20),
(3, 'SecureIT Kft.', 'K?ri Annam?ria', 'kerianna@teszt.hu', '+36(70)1189655', 0, 21),
(4, 'Grafolog 2016 Kft.', '?veges M?t?', 'ovegesmate@teszt.hu', '+36(30)1114562', 0, 22),
(5, 'Shine Napelem Kft.', 'Szatm?ri Gyula', 'szatmarigyula@teszt.hu', '+36(30)1165855', 0, 23),
(6, 'Homonnay Andr?s ev.', 'Homonnay Andr?s', 'homonnayandras@teszt.hu', '+36(20)1156789', 0, 24);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

CREATE TABLE `projekt` (
  `azonosito` int(11) NOT NULL,
  `nev` varchar(255) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `koltseg` int(11) NOT NULL,
  `hatarido` date NOT NULL,
  `megrendelo_az` int(11) NOT NULL,
  `dolgozo_az` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `projekt`
--

INSERT INTO `projekt` (`azonosito`, `nev`, `koltseg`, `hatarido`, `megrendelo_az`, `dolgozo_az`) VALUES
(1, 'Jegykelez? szoftver', 800000, '2019-12-01', 1, 5),
(2, 'Jegykelez? szoftver', 800000, '2019-12-01', 1, 6),
(3, 'Jegykelez? szoftver', 800000, '2019-12-01', 1, 7),
(4, 'Modell?gyn?ks?g adwords kamp?ny', 50000, '2019-06-30', 2, 7),
(5, 'B?tor rakt?rkezel?', 1500000, '2019-12-01', 3, 8),
(6, 'Navigation Mobile App', 2000000, '2020-01-01', 4, 12),
(7, 'Audit ?tterem weblap', 150000, '2019-07-25', 6, 9),
(8, 'Scrum rendszer', 1200000, '2019-08-30', 5, 9);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `belepesi_adatok`
--
ALTER TABLE `belepesi_adatok`
  ADD PRIMARY KEY (`azonosito`);

--
-- A tábla indexei `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD PRIMARY KEY (`azonosito`),
  ADD UNIQUE KEY `belepo_az` (`belepo_az`);

--
-- A tábla indexei `megrendelo`
--
ALTER TABLE `megrendelo`
  ADD PRIMARY KEY (`azonosito`),
  ADD UNIQUE KEY `belepo_az` (`belepo_az`);

--
-- A tábla indexei `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`azonosito`),
  ADD UNIQUE KEY `megrendelo_az` (`megrendelo_az`,`dolgozo_az`),
  ADD KEY `dolgozoaz` (`dolgozo_az`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `belepesi_adatok`
--
ALTER TABLE `belepesi_adatok`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT a táblához `megrendelo`
--
ALTER TABLE `megrendelo`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

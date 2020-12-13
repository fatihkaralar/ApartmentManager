-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Ara 2020, 23:27:59
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `apartment_management`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mail` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `phoneNumber` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `password`, `name`, `mail`, `phoneNumber`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Fatih KARALAR', 'admin@gmail.com', '05551919191'),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'Mehmet KARALAR', 'mehmet@hotmail.com', '6545231895'),
(4, 'beratbabaed', '5558c735c7c8205d04666df5c8dd452d', 'berat', 'beratbabaed@outlook.com.tr', '0555555555');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `surname` text COLLATE utf8_turkish_ci NOT NULL,
  `aptNo` int(11) NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mail` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `rentDebt` int(11) NOT NULL,
  `phoneNumber` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `name`, `surname`, `aptNo`, `status`, `mail`, `rentDebt`, `phoneNumber`) VALUES
(46, 'fatihkaralar', '4589b842babc2d8be93358e8fed692f7', 'Fatih', 'KARALAR', 1, 'Owner', 'fatih_karalar@gmail.com', 0, 'NULL');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

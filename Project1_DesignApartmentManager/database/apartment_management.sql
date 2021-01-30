-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 20 Ara 2020, 15:53:48
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
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'Mehmet KARALAR', 'mehmet@hotmail.com', '6545231895');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `expenses`
--

CREATE TABLE `expenses` (
  `expenseID` int(11) NOT NULL,
  `amount` float NOT NULL,
  `details` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `adminID` int(11) NOT NULL,
  `currentdate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `expenses`
--

INSERT INTO `expenses` (`expenseID`, `amount`, `details`, `adminID`, `currentdate`) VALUES
(2, 320, 'elevator maintenance', 1, '2020/12/20'),
(3, 160, 'Monthly Debt', 2, '2020/12/20'),
(4, 1350, 'Camera Maintenance', 2, '2020/12/20'),
(5, 125, 'Electrical infrastructure maintenance', 2, '2020/12/20'),
(6, 3600, '\r\nBuilding maintenance and repair.', 1, '2020/12/20'),
(7, 170, 'Other', 1, '2020/12/20'),
(8, 180, 'test', 1, '2020/12/20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paymenthistory`
--

CREATE TABLE `paymenthistory` (
  `paymentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `expenseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

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
  `rentDebt` float NOT NULL,
  `phoneNumber` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `name`, `surname`, `aptNo`, `status`, `mail`, `rentDebt`, `phoneNumber`) VALUES
(71, 'bulentkaralar', '4589b842babc2d8be93358e8fed692f7', 'bulent', 'karalar', 55, 'Tenant', 'bulentkaralar@hotmail.com', 381.632, 'NULL'),
(72, 'mehmetkarakas', 'fbff7e8a9de31cd958596eea364ac3ac', 'Mehmet', 'karakas', 6, 'Tenant', 'mehmetkarakas@hotmail.com', 381.632, 'NULL'),
(73, 'ozanyavuz', 'd4e520d9130bddccba586603dd622562', 'ozan', 'yavuz', 8, 'Owner', 'oznyvz_02@hotmail.com', 381.632, 'NULL'),
(75, 'furkanatabak', '176cf3f913523e4ecae398206527ec31', 'Furkan', 'Atabak', 10, 'Tenant', 'frknatabak@gmail.com', 381.632, 'NULL'),
(76, 'suatkarakeci', '4ce86b2f8fb5e0987e3aab8755d999c4', 'Suat', 'Karakeci', 11, 'Tenant', 'suatkarakeci@outlook.com.tr', 381.632, 'NULL'),
(78, 'eminedalgic', '6536708fdb56c9147ed342d28ab18a1d', 'Emine', 'dalgic', 12, 'Tenant', 'eminedlgc@hotmail.com.tr', 381.632, 'NULL'),
(82, 'fatihkaralar', '4589b842babc2d8be93358e8fed692f7', 'Fatih', 'KARALar', 21, 'Owner', 'fatih_ralarak@hotmail.com', 381.632, 'NULL'),
(84, 'eyupdanis', '257ffa69697c2d5144f0b4b76b51ae95', 'Eyup', 'Danis', 17, 'Tenant', 'eyup_danis@hotmail.com', 381.632, 'NULL'),
(85, 'mehmetkaralar', '4589b842babc2d8be93358e8fed692f7', 'Mehmet', 'KARALAR', 1, 'Owner', 'mehmetkaralar@gmail.com', 381.632, 'NULL'),
(86, 'erkamatabak', '176cf3f913523e4ecae398206527ec31', 'Erkam', 'Atabak', 2, 'Owner', 'erkamatabak@gmail.com', 381.632, 'NULL'),
(87, 'cumaliozdemir', '4f20db56517dd3851416a9434e55cbc1', 'Cumali', 'Ozdemir', 5, 'Owner', 'cumaliozdemir_07@hotmail.com', 381.632, 'NULL'),
(88, 'recaisezgin', 'c2c5f3350bc3857219a8b943cf0463ad', 'recai', 'sezgin', 28, 'Owner', 'recaiszgn@gmail.com', 381.632, 'NULL'),
(89, 'ceydaguler', '8a4dc1f133d036c57f7ec5aefcdf1b65', 'Ceyda', 'guler', 33, 'Tenant', 'cydaguler@hotmail.com', 381.632, 'NULL'),
(90, 'sedatyilmaz', 'bc07f07a9bfb5f5cdc16d27da9b50420', 'Sedat', 'yilmaz', 45, 'Owner', 'sedatyilmaz@outlook.com.tr', 381.632, 'NULL'),
(91, 'ugursavas', 'c083f62d604f6ab0123485012892a401', 'ugur', 'savas', 3, 'Owner', 'ugursvs@outlook.com.tr', 381.632, 'NULL'),
(95, 'baharkul', '212747dc84369b811b3bd8611c78422f', 'bahar', 'kul', 78, 'Tenant', 'baharkul@hotmail.com.tr', 19.4444, 'NULL'),
(96, 'necatidagdeviren', '17a1d9e2a1e1c0f80d51b0ba4fb6796f', 'Necati', 'dagdeviren', 100, 'Tenant', 'necatidagdevirent@hotmail.com.tr', 19.4444, 'NULL'),
(97, 'elanurbicer', 'f0a29c8c399e589492ff5eff5d5b50db', 'elanur', 'bicer', 42, 'Owner', 'elanurbicer@hotmail.com.tr', 19.4444, 'NULL');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Tablo için indeksler `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenseID`),
  ADD KEY `adminID` (`adminID`);

--
-- Tablo için indeksler `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `userID` (`userID`,`expenseID`),
  ADD KEY `expenseID` (`expenseID`);

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
-- Tablo için AUTO_INCREMENT değeri `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admins` (`adminID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Tablo kısıtlamaları `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD CONSTRAINT `paymenthistory_ibfk_1` FOREIGN KEY (`expenseID`) REFERENCES `expenses` (`expenseID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `paymenthistory_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

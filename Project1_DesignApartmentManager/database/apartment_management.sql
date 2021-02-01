-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 30 Oca 2021, 15:15:32
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
(1, 'admin', '5558c735c7c8205d04666df5c8dd452d', 'Fatih KARALAR', 'admin@gmail.com', '5511812340'),
(2, 'admin2', '5558c735c7c8205d04666df5c8dd452d', 'Mehmet KARALAR', 'mehmet@hotmail.com', '5511812351');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `debts`
--

CREATE TABLE `debts` (
  `debtID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `amount` float NOT NULL,
  `details` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `isPaid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `debts`
--

INSERT INTO `debts` (`debtID`, `userID`, `amount`, `details`, `isPaid`) VALUES
(82, 82, 100, 'su giderleri', 0),
(84, 88, 100, 'su giderleri', 0),
(85, 89, 100, 'su giderleri', 0),
(86, 90, 100, 'su giderleri', 1),
(87, 91, 100, 'su giderleri', 0),
(89, 96, 100, 'su giderleri', 0),
(90, 97, 100, 'su giderleri', 0),
(91, 101, 100, 'su giderleri', 0),
(92, 103, 100, 'su giderleri', 0),
(93, 104, 100, 'su giderleri', 0),
(94, 109, 100, 'su giderleri', 0),
(98, 82, 200, 'Su giderleri', 0),
(100, 88, 200, 'Su giderleri', 0),
(101, 89, 200, 'Su giderleri', 0),
(102, 90, 200, 'Su giderleri', 1),
(103, 91, 200, 'Su giderleri', 0),
(105, 96, 200, 'Su giderleri', 0),
(106, 97, 200, 'Su giderleri', 0),
(107, 101, 200, 'Su giderleri', 0),
(108, 103, 200, 'Su giderleri', 0),
(109, 104, 200, 'Su giderleri', 0),
(110, 109, 200, 'Su giderleri', 0),
(114, 82, 100, 'Aidat', 0),
(116, 88, 100, 'Aidat', 0),
(117, 89, 100, 'Aidat', 0),
(118, 90, 100, 'Aidat', 1),
(119, 91, 100, 'Aidat', 0),
(121, 96, 100, 'Aidat', 0),
(122, 97, 100, 'Aidat', 0),
(123, 101, 100, 'Aidat', 0),
(124, 103, 100, 'Aidat', 0),
(125, 104, 100, 'Aidat', 0),
(126, 109, 100, 'Aidat', 0),
(130, 82, 100, 'test', 0),
(132, 88, 100, 'test', 0),
(133, 89, 100, 'test', 0),
(134, 90, 100, 'test', 1),
(135, 91, 100, 'test', 0),
(137, 96, 100, 'test', 0),
(138, 97, 100, 'test', 0),
(139, 101, 100, 'test', 0),
(140, 103, 100, 'test', 0),
(141, 104, 100, 'test', 0),
(142, 109, 100, 'test', 0);

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
(49, 1600, 'Electric expenses\r\n', 1, '2021/01/29'),
(50, 1600, 'electric expense', 1, '2021/01/29'),
(51, 1600, 'su giderleri', 1, '2021/01/29'),
(52, 3200, 'Su giderleri', 1, '2021/01/29'),
(53, 1600, 'Aidat', 1, '2021/01/29'),
(54, 1600, 'test', 1, '2021/01/29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paymenthistory`
--

CREATE TABLE `paymenthistory` (
  `paymentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `debtID` int(11) NOT NULL,
  `amount` float NOT NULL,
  `details` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `currentdate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `paymenthistory`
--

INSERT INTO `paymenthistory` (`paymentID`, `userID`, `debtID`, `amount`, `details`, `currentdate`) VALUES
(122, 90, 134, 100, 'test', '2021/01/30'),
(123, 90, 86, 100, 'su giderleri', '2021/01/30'),
(124, 90, 102, 200, 'Su giderleri', '2021/01/30'),
(125, 90, 118, 100, 'Aidat', '2021/01/30');

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
  `phoneNumber` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `name`, `surname`, `aptNo`, `status`, `mail`, `phoneNumber`) VALUES
(82, 'fatihkaralar', 'e6b717f7492c087984f3f2d909fd812d', 'Fatih', 'KARALar', 8, 'Owner', 'fatihralarak@hotmail.com', '5555555555'),
(88, 'recaisezgin', 'c2c5f3350bc3857219a8b943cf0463ad', 'recai', 'sezgin', 16, 'Owner', 'recaiszgn@gmail.com', 'NULL'),
(89, 'ceydaguler', '55bdd028d1a5cef528961df2d8d45300', 'Ceyda', 'guler', 15, 'Tenant', 'cydaguler@hotmail.com', '5458982029'),
(90, 'sedatyilmaz', '5558c735c7c8205d04666df5c8dd452d', 'Sedat', 'yilmaz', 13, 'Tenant', 'sedatyilmaz@outlook.com.tr', '5558982645'),
(91, 'ugursavas', 'a49007137f2c3e2cc5d7c375e1344fda', 'ugur', 'savas', 17, 'Owner', 'ugursavas@outlook.com.tr', '5458882005'),
(96, 'necatidagdeviren', '17a1d9e2a1e1c0f80d51b0ba4fb6796f', 'Necati', 'dagdeviren', 5, 'Owner', 'necatidagdevirent@hotmail.com.tr', 'NULL'),
(97, 'elanurbicer', 'f0a29c8c399e589492ff5eff5d5b50db', 'elanur', 'bicer', 14, 'Owner', 'elanurbicer@hotmail.com.tr', 'NULL'),
(101, 'fulyatokgezen', 'ca8314ddfe1054601bce0022a8282e73', 'fulya', 'tokgezen', 9, 'Tenant', 'fulyatokgezen@hotmail.com', 'NULL'),
(103, 'aykutgunpinar', '36ffe4a787992ac589d9db22576c9cfb', 'Aykut', 'gunpinar', 1, 'Owner', 'aykutgnpnr@outlook.com.tr', 'NULL'),
(104, 'vecihihurkus', '67d1fda1f79b027d20bf5875246536d3', 'vecihi', 'hurkus', 6, 'Owner', 'vecihihurkus@gmail.com.tr', 'NULL'),
(109, 'testtest', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', 10, 'Owner', 'test@gmail.com', 'NULL');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Tablo için indeksler `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`debtID`),
  ADD KEY `userID` (`userID`);

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
  ADD KEY `userID` (`userID`),
  ADD KEY `debtID` (`debtID`);

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
-- Tablo için AUTO_INCREMENT değeri `debts`
--
ALTER TABLE `debts`
  MODIFY `debtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Tablo için AUTO_INCREMENT değeri `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `debts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Tablo kısıtlamaları `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admins` (`adminID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Tablo kısıtlamaları `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD CONSTRAINT `paymenthistory_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `paymenthistory_ibfk_3` FOREIGN KEY (`debtID`) REFERENCES `debts` (`debtID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

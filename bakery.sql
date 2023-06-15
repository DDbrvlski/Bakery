-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2023, 13:49
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bakery`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employee`
--

CREATE TABLE `employee` (
  `Name` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `Surname` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `EmployeeID` int(10) NOT NULL,
  `Password` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `employee`
--

INSERT INTO `employee` (`Name`, `Surname`, `EmployeeID`, `Password`) VALUES
('Adam', 'Małysz', 200, 'demo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filling`
--

CREATE TABLE `filling` (
  `FillingID` int(11) NOT NULL,
  `Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `filling`
--

INSERT INTO `filling` (`FillingID`, `Name`) VALUES
(1, 'Bez nadzienia'),
(2, 'Nadzienie śmietankowe'),
(3, 'Dżem owocowy'),
(4, 'Dżem truskawkowy'),
(5, 'Nadzienie czekoladowe'),
(6, 'Nadzienie orzechowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `glaze`
--

CREATE TABLE `glaze` (
  `GlazeID` int(11) NOT NULL,
  `Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `glaze`
--

INSERT INTO `glaze` (`GlazeID`, `Name`) VALUES
(1, 'Bez polewy'),
(2, 'Biała czekolada'),
(3, 'Mleczna czekolada'),
(4, 'Polewa cukrowa'),
(7, 'Gorzka czekolada'),
(8, 'Polewa truskawkowa'),
(9, 'Polewa karmelowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `OrderNumber` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `AmountOnStock` int(11) NOT NULL,
  `Glaze` int(2) DEFAULT NULL,
  `Sprinkle` int(2) DEFAULT NULL,
  `Filling` int(2) DEFAULT NULL,
  `ImageID` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `Hashtag` varchar(40) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Price`, `AmountOnStock`, `Glaze`, `Sprinkle`, `Filling`, `ImageID`, `Hashtag`) VALUES
(1, 'Sprinkle Classic', '11.99', 20, 1, 1, 1, 'white_glazed.jpg', 'SprinkleWhiteChocolate'),
(2, 'Raspberry Sprinkle', '12.99', 15, 1, 1, 2, 'sprinkle_pink.jpg', 'RaspberrySprinkle'),
(3, 'Orange Party', '13.99', 12, 3, 2, 2, 'orangebits.jpg', 'OrangeBits'),
(4, 'Oreo Supreme', '15.99', 5, 3, 2, 2, 'oreo.jpg', 'Oreo'),
(5, 'Sugar Snow', '13.99', 8, 2, 1, 1, 'powder.jpg', 'SugarPowder'),
(7, 'Salty Carmel', '11.99', 11, 2, 2, 1, 'salted_carmel.jpg', 'SaltedCarmel'),
(8, 'Donut Classic', '9.99', 22, 1, 1, 1, 'glazed.jpg', 'Classic'),
(35, 'Merry Berry', '14.00', 17, 8, 2, 3, 'berry.JPG', 'berry'),
(36, 'Caramel Sweetness', '10.00', 14, 9, 1, 1, 'caramel.JPG', 'caramel'),
(37, 'Coconut Marvel', '13.00', 10, 2, 3, 2, 'coconut.JPG', 'coconut'),
(38, 'Classic Donut', '8.00', 14, 4, 1, 1, 'classic.JPG', 'classic'),
(39, 'Hazelnut Forest', '14.00', 5, 3, 6, 6, 'hazelnut.JPG', 'hazelnut'),
(40, 'Choco Sprinkle', '12.99', 18, 7, 2, 1, 'sprinkle.JPG', 'sprinkle'),
(41, 'Almond Heaven', '15.00', 25, 7, 6, 5, 'almond.JPG', 'almond'),
(42, 'Choco Coco', '17.00', 15, 3, 3, 2, 'coconut_chocolate.JPG', 'coconut_chocolate');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprinkle`
--

CREATE TABLE `sprinkle` (
  `SprinkleID` int(11) NOT NULL,
  `Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sprinkle`
--

INSERT INTO `sprinkle` (`SprinkleID`, `Name`) VALUES
(1, 'Bez posypki'),
(2, 'Kolorowa posypka'),
(3, 'Posypka kokosowa'),
(4, 'Cukier puder'),
(5, 'Różowa posypka'),
(6, 'Posypka orzechowa'),
(7, 'Posypka cynamonowa'),
(8, 'Posypka pomarańczowa'),
(9, 'Posypka ciasteczkowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `Name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Surname` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `UserID` int(10) NOT NULL,
  `Password` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`Name`, `Surname`, `email`, `UserID`, `Password`) VALUES
('Adam', 'Małysz', 'adam@gmail.com', 1, 'demo');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indeksy dla tabeli `filling`
--
ALTER TABLE `filling`
  ADD PRIMARY KEY (`FillingID`);

--
-- Indeksy dla tabeli `glaze`
--
ALTER TABLE `glaze`
  ADD PRIMARY KEY (`GlazeID`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indeksy dla tabeli `sprinkle`
--
ALTER TABLE `sprinkle`
  ADD PRIMARY KEY (`SprinkleID`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT dla tabeli `filling`
--
ALTER TABLE `filling`
  MODIFY `FillingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `glaze`
--
ALTER TABLE `glaze`
  MODIFY `GlazeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `sprinkle`
--
ALTER TABLE `sprinkle`
  MODIFY `SprinkleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

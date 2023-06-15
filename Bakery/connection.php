<?php
//funkcja odpowiedzialna za łączenie się z bazą danych
function openConnection(){
    global $serwer;
    $serwer = mysqli_connect("localhost", "root", "") or exit("Nieudane połączenie z serwerem");
    $base = 'bakery';
	try{
		mysqli_select_db($serwer, $base);
	}
	catch(Exception){
		createDatabase();
		mysqli_select_db($serwer, $base);
		createTables();
		insertData();
	}
    mysqli_set_charset($serwer, "utf8");
}

function closeConnection(){
    global $serwer;
	mysqli_close($serwer);
}

function createDatabase(){
	$serwer = mysqli_connect("localhost", "root", "") or exit("Nieudane połączenie z serwerem");
	$base = 'bakery';
	
	mysqli_query($serwer, "CREATE DATABASE `$base` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;") 
	or exit("Błąd w zapytaniu tworzącym bazę");
}

function createTables(){
	global $serwer;

	$zapytanie ="CREATE TABLE `employee` (
				`Name` varchar(20) NOT NULL,
				`Surname` varchar(40) NOT NULL,
				`EmployeeID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Password` varchar(30) NOT NULL
	  			)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `filling` (
				`FillingID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
	  			)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `glaze` (
				`GlazeID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
	  			)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `order` (
				`OrderID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`OrderNumber` int(11) NOT NULL,
				`UserID` int(11) NOT NULL,
				`ProductID` int(11) NOT NULL,
				`Quantity` int(11) NOT NULL,
				`Price` double NOT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `product` (
				`ProductID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Name` varchar(40) NOT NULL,
				`Price` decimal(5,2) NOT NULL,
				`AmountOnStock` int(11) NOT NULL,
				`Glaze` int(2) DEFAULT NULL,
				`Sprinkle` int(2) DEFAULT NULL,
				`Filling` int(2) DEFAULT NULL,
				`ImageID` varchar(50) DEFAULT NULL,
				`Hashtag` varchar(40) DEFAULT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `sprinkle` (
				`SprinkleID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Name` varchar(40) COLLATE utf8_polish_ci NOT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `user` (
				`Name` varchar(30) NOT NULL,
				`Surname` varchar(40) NOT NULL,
				`email` varchar(40) NOT NULL,
				`UserID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Password` varchar(30) NOT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");
}

function insertData(){
	global $serwer;
	mysqli_set_charset($serwer, "utf8");

	$zapytanie ="INSERT INTO `employee` (`Name`, `Surname`, `EmployeeID`, `Password`) VALUES
				('Adam', 'Małysz', 200, 'demo')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="INSERT INTO `filling` (`FillingID`, `Name`) VALUES
				(1, 'Bez nadzienia'),
				(2, 'Nadzienie śmietankowe'),
				(3, 'Dżem owocowy'),
				(4, 'Dżem truskawkowy'),
				(5, 'Nadzienie czekoladowe'),
				(6, 'Nadzienie orzechowe')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="INSERT INTO `glaze` (`GlazeID`, `Name`) VALUES
				(1, 'Bez polewy'),
				(2, 'Biała czekolada'),
				(3, 'Mleczna czekolada'),
				(4, 'Polewa cukrowa'),
				(7, 'Gorzka czekolada'),
				(8, 'Polewa truskawkowa'),
				(9, 'Polewa karmelowa')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="INSERT INTO `product` (`ProductID`, `Name`, `Price`, `AmountOnStock`, `Glaze`, `Sprinkle`, `Filling`, `ImageID`, `Hashtag`) VALUES
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
				(42, 'Choco Coco', '17.00', 15, 3, 3, 2, 'coconut_chocolate.JPG', 'coconut_chocolate')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="INSERT INTO `sprinkle` (`SprinkleID`, `Name`) VALUES
				(1, 'Bez posypki'),
				(2, 'Kolorowa posypka'),
				(3, 'Posypka kokosowa'),
				(4, 'Cukier puder'),
				(5, 'Różowa posypka'),
				(6, 'Posypka orzechowa'),
				(7, 'Posypka cynamonowa'),
				(8, 'Posypka pomarańczowa'),
				(9, 'Posypka ciasteczkowa')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="INSERT INTO `user` (`Name`, `Surname`, `email`, `UserID`, `Password`) VALUES
				('Adam', 'Małysz', 'adam@gmail.com', 1, 'demo')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");
}
?>
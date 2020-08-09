-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-08-09 03:10:37
-- 伺服器版本： 10.4.13-MariaDB
-- PHP 版本： 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `homework_0807`
--
CREATE DATABASE IF NOT EXISTS `homework_0807_Wei_Chen` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `homework_0807_Wei_Chen`;

-- --------------------------------------------------------

--
-- 資料表結構 `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `employees`
--

INSERT INTO `employees` (`EmployeeID`, `Name`, `Address`, `Phone`) VALUES
(000000000001, '王大大', '台中市西屯區光明三路三號', '0912345678'),
(000000000002, '陳小明', '台中市南屯區光明三路二號', '0935123456'),
(000000000003, '江小胖', '台中市北屯區光明三路一號', '0988888888'),
(000000000004, '黃小虎', '台中市北屯區光明三路四號', '0966666666');

-- --------------------------------------------------------

--
-- 資料表結構 `employees_orders`
--

CREATE TABLE `employees_orders` (
  `EOID` int(12) UNSIGNED ZEROFILL NOT NULL,
  `EmployeeID` int(12) UNSIGNED ZEROFILL NOT NULL,
  `OrderID` int(12) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `employees_orders`
--

INSERT INTO `employees_orders` (`EOID`, `EmployeeID`, `OrderID`) VALUES
(000000000001, 000000000001, 000000000001),
(000000000002, 000000000002, 000000000002),
(000000000003, 000000000003, 000000000003),
(000000000004, 000000000004, 000000000001);

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetails`
--

CREATE TABLE `orderdetails` (
  `EOID` int(12) UNSIGNED ZEROFILL NOT NULL,
  `ProductID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `UnitPrice` int(12) NOT NULL,
  `Quantity` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orderdetails`
--

INSERT INTO `orderdetails` (`EOID`, `ProductID`, `UnitPrice`, `Quantity`) VALUES
(000000000001, 001, 70, 1),
(000000000001, 002, 15, 1),
(000000000001, 003, 30, 1),
(000000000001, 004, 45, 1),
(000000000004, 001, 70, 1),
(000000000004, 005, 80, 2),
(000000000002, 006, 75, 1),
(000000000002, 007, 25, 1),
(000000000003, 009, 50, 1),
(000000000003, 010, 50, 1),
(000000000003, 011, 50, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(12) UNSIGNED ZEROFILL NOT NULL,
  `OrderDate` datetime NOT NULL,
  `RequiredDate` datetime NOT NULL,
  `PaymentStatus` varchar(1) NOT NULL,
  `OrdersStatus` varchar(10) DEFAULT NULL
) ;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `RequiredDate`, `PaymentStatus`, `OrdersStatus`) VALUES
(000000000001, '2020-05-24 00:00:00', '2020-05-27 00:13:30', 'X', '訂單成立'),
(000000000002, '2020-05-24 00:00:00', '2020-05-27 00:13:30', 'X', '訂單成立'),
(000000000003, '2020-07-23 00:00:00', '2020-07-24 00:13:30', 'V', '付款成功'),
(000000000004, '2020-12-12 00:00:00', '2020-12-12 00:13:30', 'V', '餐點送達，完成訂單');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `RestaurantID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `ProductID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `Item` varchar(40) NOT NULL DEFAULT '',
  `UnitPrice` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`RestaurantID`, `ProductID`, `Item`, `UnitPrice`) VALUES
(00001, 001, '黑胡椒鐵板麵', 70),
(00001, 002, '花生厚片', 15),
(00001, 003, '薯條', 30),
(00001, 004, '蘿蔔糕', 75),
(00001, 005, '牛肉漢堡', 85),
(00002, 006, '雞肉飯便當', 70),
(00002, 007, '單點-爌肉', 25),
(00002, 008, '單點-滷蛋', 15),
(00003, 009, '慈母手中麵', 50),
(00003, 010, '鐵杵磨成繡花麵', 50),
(00003, 011, '大王叫我來巡麵', 50);

-- --------------------------------------------------------

--
-- 資料表結構 `restaurants`
--

CREATE TABLE `restaurants` (
  `RestaurantID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `RestaurantName` varchar(40) NOT NULL DEFAULT '',
  `ContactName` varchar(30) DEFAULT NULL,
  `ContactTitle` varchar(30) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Phone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `restaurants`
--

INSERT INTO `restaurants` (`RestaurantID`, `RestaurantName`, `ContactName`, `ContactTitle`, `Address`, `Phone`) VALUES
(00001, '早早早餐店', '甲渣等', '店長', '台中西屯區西屯路四段1號', '(03) 3557-9981'),
(00002, '只賣雞肉飯', '嘉益仁', '店長', '台中西屯區西屯路三段2號', '(03) 1234-1234'),
(00003, '麵麵俱到', '宗部壬', '店長', '台中西屯區西屯路二段3號', '(03) 5555-5555');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- 資料表索引 `employees_orders`
--
ALTER TABLE `employees_orders`
  ADD PRIMARY KEY (`EOID`),
  ADD KEY `Employees_EO` (`EmployeeID`),
  ADD KEY `Orders_EO` (`OrderID`);

--
-- 資料表索引 `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `EO_OrderDetails` (`EOID`),
  ADD KEY `Products_OrderDetails` (`ProductID`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `Restaurants_Products` (`RestaurantID`);

--
-- 資料表索引 `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`RestaurantID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employees_orders`
--
ALTER TABLE `employees_orders`
  MODIFY `EOID` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `RestaurantID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `employees_orders`
--
ALTER TABLE `employees_orders`
  ADD CONSTRAINT `Employees_EO` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Orders_EO` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE;

--
-- 資料表的限制式 `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `EO_OrderDetails` FOREIGN KEY (`EOID`) REFERENCES `employees_orders` (`EOID`),
  ADD CONSTRAINT `Products_OrderDetails` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- 資料表的限制式 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Restaurants_Products` FOREIGN KEY (`RestaurantID`) REFERENCES `restaurants` (`RestaurantID`) ON DELETE CASCADE;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

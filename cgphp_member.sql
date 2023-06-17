-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-26 04:31:36
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `vvrzmwkq_home`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cgphp_member`
--

CREATE TABLE `cgphp_member` (
  `ID` int(11) NOT NULL,
  `uid` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `enable` enum('true','false') COLLATE utf8mb4_bin NOT NULL,
  `administrator` enum('true','false') COLLATE utf8mb4_bin NOT NULL,
  `createAt` int(11) NOT NULL,
  `updateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `cgphp_member`
--

INSERT INTO `cgphp_member` (`ID`, `uid`, `username`, `password`, `email`, `enable`, `administrator`, `createAt`, `updateAt`) VALUES
(1, '1111', 'test', '1679797690', 'test@email.com', 'true', 'false', 0, '2023-03-26 02:28:10'),
(2, '1112', 'test2', 'test', 'test@email.com', 'true', 'false', 1, '2023-03-26 01:51:15');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cgphp_member`
--
ALTER TABLE `cgphp_member`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cgphp_member`
--
ALTER TABLE `cgphp_member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-01-18 10:42:59
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `game`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cart_username` varchar(50) NOT NULL,
  `cart_product` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `cart_username`, `cart_product`, `cart_quantity`) VALUES
(66, '1', 112, 4);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(6) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Game A'),
(2, 'Game B'),
(3, 'Game C'),
(4, 'Game D');

-- --------------------------------------------------------

--
-- 表的结构 `favourite`
--

CREATE TABLE `favourite` (
  `favourite_id` int(11) NOT NULL,
  `favourite_user` varchar(10) NOT NULL,
  `favourite_helper` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `favourite`
--

INSERT INTO `favourite` (`favourite_id`, `favourite_user`, `favourite_helper`) VALUES
(45, '', ''),
(47, '1', '111');

-- --------------------------------------------------------

--
-- 表的结构 `helper`
--

CREATE TABLE `helper` (
  `helper_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `bank_acc` int(20) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `postcode` int(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `status` int(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `ic_pic` varchar(50) NOT NULL,
  `admin_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `helper`
--

INSERT INTO `helper` (`helper_id`, `name`, `ic`, `bank_name`, `bank_acc`, `address1`, `postcode`, `state`, `status`, `photo`, `ic_pic`, `admin_id`) VALUES
('1', '1231', '123', 'RHB', 123, '1asda', 123, 'dad', 2, './../images/123/photo.png', './../images/123/ic.png', 'admin'),
('helper123', 'Tan Ah kao', '324', 'CIMB', 1111111, 'dfsf', 24, '234', 2, './../images/324/photo.png', './../images/324/ic.png', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `contant` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `date` date NOT NULL,
  `create_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `notice`
--

INSERT INTO `notice` (`notice_id`, `title`, `contant`, `status`, `date`, `create_by`) VALUES
(7, 'New Update !!!!', 'Just a joke', 1, '2022-01-12', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `ord_product_id` int(11) NOT NULL,
  `ord_user_id` varchar(20) NOT NULL,
  `ord_helper_id` varchar(20) NOT NULL,
  `ord_type` varchar(20) NOT NULL,
  `ord_quantity` int(11) NOT NULL,
  `ord_price` int(11) NOT NULL,
  `ord_discount` int(11) NOT NULL,
  `ord_status` int(2) NOT NULL,
  `ord_rate` int(2) NOT NULL,
  `ord_comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `order_detail`
--

INSERT INTO `order_detail` (`id`, `ord_product_id`, `ord_user_id`, `ord_helper_id`, `ord_type`, `ord_quantity`, `ord_price`, `ord_discount`, `ord_status`, `ord_rate`, `ord_comment`, `date`, `rate_time`) VALUES
(1, 114, 'User Testing', 'helper123', 'Game A', 1, 5, 0, 4, 4, 'Good,', '2022-01-17 05:51:09', '2022-01-17 13:52:25'),
(2, 115, 'User Testing', 'helper3123', 'Game B', 1, 6, 0, 4, 2, 'Not Worth', '2022-01-17 05:51:10', '2022-01-17 13:52:36'),
(3, 116, 'User Testing', 'helper9123', 'Game B', 1, 6, 0, 4, 5, 'Very Good', '2022-01-17 05:51:10', '2022-01-17 13:52:46'),
(4, 117, 'User Testing', 'helper129483', 'Game C', 1, 3, 0, 4, 1, 'Sucks', '2022-01-17 05:51:13', '2022-01-17 13:52:56'),
(5, 112, 'user123', 'helper123', 'Game A', 9, 27, 0, 11, 0, '', '2022-01-17 05:55:52', '0000-00-00 00:00:00'),
(6, 112, 'user123', 'helper123', 'Game A', 1, 3, 0, 4, 0, '', '2022-01-17 07:49:34', '0000-00-00 00:00:00'),
(7, 112, 'user123', 'helper123', 'Game A', 6, 18, 0, 4, 0, '', '2022-01-17 08:27:28', '0000-00-00 00:00:00'),
(8, 112, 'user123', 'helper123', 'Game A', 1, 3, 0, 4, 0, '', '2022-01-17 08:41:33', '0000-00-00 00:00:00'),
(9, 112, 'user123', 'helper123', 'Game A', 1, 3, 0, 4, 0, '', '2022-01-17 13:29:48', '0000-00-00 00:00:00'),
(10, 112, 'user123', 'helper123', 'Game A', 1, 3, 0, 3, 0, '', '2022-01-17 13:32:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `type` varchar(11) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `available` int(2) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `product_detail`
--

INSERT INTO `product_detail` (`id`, `username`, `type`, `price`, `quantity`, `available`, `description`) VALUES
(112, 'helper123', 'Game A', 3, 181, 1, 'Very Goooooooood!!!! haha'),
(114, 'helper1823', 'Game A', 5, 199, 1, ''),
(115, 'helper3123', 'Game B', 6, 199, 1, ''),
(116, 'helper9123', 'Game B', 6, 199, 1, ''),
(117, 'helper129483', 'Game C', 3, 199, 1, ''),
(118, 'helper1298498', 'Game C', 8, 200, 1, ''),
(119, 'helper2256461', 'Game D', 6, 200, 1, ''),
(120, 'GG Helper', 'Game D', 3, 200, 1, ''),
(121, 'Elite Nigas', 'Game A', 5, 200, 1, ''),
(122, 'helper1223', 'Game B', 99, 200, 1, ''),
(123, 'Testing Helper', 'Game C', 3, 200, 1, ''),
(124, 'Wtf_helper', 'Game D', 30, 200, 1, ''),
(125, 'haha', 'Game A', 3, 200, 1, ''),
(126, 'it\'s me', 'Game B', 33, 200, 1, 'Very Goooooooood!!!! haha'),
(127, 'Yeah', 'Game C', 20, 200, 1, 'Very Goooooooood!!!! haha'),
(128, 'helper99', 'Game D', 55, 200, 1, 'Very Goooooooood!!!! haha');

-- --------------------------------------------------------

--
-- 表的结构 `report`
--

CREATE TABLE `report` (
  `id` int(20) NOT NULL,
  `ord_id` int(20) NOT NULL,
  `reason` varchar(20) NOT NULL,
  `status` int(2) NOT NULL,
  `description` varchar(200) NOT NULL,
  `evidence` varchar(50) NOT NULL,
  `report_time` datetime NOT NULL,
  `respone_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `report`
--

INSERT INTO `report` (`id`, `ord_id`, `reason`, `status`, `description`, `evidence`, `report_time`, `respone_time`) VALUES
(45, 5, 'Undone', 2, 'adw', 'evidence/5/evidence.pdf', '2022-01-17 15:40:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `target`
--

CREATE TABLE `target` (
  `id` int(2) NOT NULL,
  `user_topup` int(10) NOT NULL,
  `profit` int(10) NOT NULL,
  `helper_earn` int(10) NOT NULL,
  `all_time_sales` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `target`
--

INSERT INTO `target` (`id`, `user_topup`, `profit`, `helper_earn`, `all_time_sales`) VALUES
(1, 1000, 500, 300, 800);

-- --------------------------------------------------------

--
-- 表的结构 `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(50) NOT NULL,
  `order_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `request_date` datetime NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `evidence` varchar(255) NOT NULL,
  `admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `order_id`, `username`, `amount`, `request_date`, `transaction_date`, `status`, `evidence`, `admin`) VALUES
(32, 1, 'User Testing', 5, '0000-00-00 00:00:00', '2022-01-17 13:51:09', 1, '', ''),
(33, 2, 'User Testing', 6, '0000-00-00 00:00:00', '2022-01-17 13:51:10', 2, '', ''),
(34, 3, 'User Testing', 6, '0000-00-00 00:00:00', '2022-01-17 13:51:10', 2, '', ''),
(35, 4, 'User Testing', 3, '0000-00-00 00:00:00', '2022-01-17 13:51:13', 2, '', ''),
(36, 5, 'user123', 27, '0000-00-00 00:00:00', '2022-01-17 13:55:52', 2, '', ''),
(37, 5, 'user123', 27, '0000-00-00 00:00:00', '2022-01-17 15:45:09', 6, '', 'admin'),
(38, 6, 'user123', 3, '0000-00-00 00:00:00', '2022-01-17 15:49:34', 2, '', ''),
(39, 0, 'helper123', 2.4, '2022-01-17 15:54:56', '2022-01-17 15:56:24', 5, '../images/evidence/39/evidence.png', 'admin'),
(40, 0, 'user123', 20, '0000-00-00 00:00:00', '2022-01-17 16:25:39', 1, '', ''),
(41, 7, 'user123', 18, '0000-00-00 00:00:00', '2022-01-17 16:27:28', 2, '', ''),
(42, 7, 'helper123', 14.4, '0000-00-00 00:00:00', '2022-01-17 16:28:58', 3, '', ''),
(43, 0, 'helper123', 10, '2022-01-17 16:38:06', '2022-01-17 16:39:07', 5, '../images/evidence_transaction/43/evidence.png', 'admin'),
(56, 10, 'helper123', 2.4, '0000-00-00 00:00:00', '2022-01-17 21:39:20', 3, '', ''),
(66, 9, 'helper123', 2.4, '0000-00-00 00:00:00', '2022-01-17 21:44:11', 3, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `credits` double NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`, `credits`, `contact`, `email`, `facebook`, `profile_pic`, `status`, `role`) VALUES
('1', 'c4ca4238a0b923820dcc509a6f75849b', 0, 114455689, '1@gmail.com', '', 'images/defult_pic.png', 1, 1),
('2', 'c81e728d9d4c2f636f067f89cc14862c', 0, 215468546, '222@gmail.com', '', 'images/defult_pic.png', 1, 1),
('helper123', '757412601b692881a20eeae90fdfbfd4', 1009.6, 114455689, 'helper123@gmail.com', '', '', 1, 1),
('user123', '6ad14ba9986e3615423dfca256d04e3f', 258, 114455689, 'user123@gmail.com', '', '', 1, 1);

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`favourite_id`);

--
-- 表的索引 `helper`
--
ALTER TABLE `helper`
  ADD PRIMARY KEY (`helper_id`);

--
-- 表的索引 `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- 表的索引 `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 使用表AUTO_INCREMENT `favourite`
--
ALTER TABLE `favourite`
  MODIFY `favourite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 使用表AUTO_INCREMENT `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- 使用表AUTO_INCREMENT `report`
--
ALTER TABLE `report`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 使用表AUTO_INCREMENT `target`
--
ALTER TABLE `target`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

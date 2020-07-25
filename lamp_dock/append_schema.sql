-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2020 年 7 月 25 日 12:42
-- サーバのバージョン： 5.7.31
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `sample`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `detail_id` int(11) NOT NULL COMMENT '購入詳細番号',
  `history_id` int(11) NOT NULL COMMENT '注文番号',
  `purchase_price` int(11) NOT NULL COMMENT '購入時の商品価格',
  `amount` int(11) NOT NULL COMMENT '数量',
  `item_id` int(11) NOT NULL COMMENT '商品番号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `purchase_history`
--

CREATE TABLE `purchase_history` (
  `history_id` int(11) NOT NULL COMMENT '注文番号',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `created` datetime NOT NULL COMMENT '購入日時',
  `total_price` int(11) NOT NULL COMMENT '合計金額'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- テーブルのインデックス `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`history_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '購入詳細番号';

--
-- テーブルのAUTO_INCREMENT `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '注文番号';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

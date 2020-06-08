-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 08 日 19:13
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hometter`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post` (
  `id` int(12) NOT NULL,
  `player` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`id`, `player`, `text`, `created_at`) VALUES
(9, '＠冨井洋佑', 'ありがとう', '2020-06-07 07:53:49'),
(10, '＠冨井洋佑', '一緒に頑張ろう！', '2020-06-07 21:46:22'),
(11, '＠冨井洋佑', '一緒に頑張ろう！', '2020-06-07 21:56:48'),
(12, '＠山田', '一緒に頑張ろう！', '2020-06-08 14:03:53'),
(13, '＠山田孝之', '演技うますぎ', '2020-06-08 20:23:25'),
(14, '＠山田孝之', '演技うますぎ', '2020-06-08 20:25:51');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
